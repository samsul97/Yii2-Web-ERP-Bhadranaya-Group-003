<?php

namespace backend\controllers;

use Yii;
use backend\models\TbAssets;
use backend\models\TbAssetsSearch;
use backend\models\TbAssetsRepair;
use backend\models\TbAssetsRepairSearch;
use backend\models\TbAssetsBroken;
use backend\models\TbAssetsBrokenSearch;
use backend\models\TbAssetsMove;
use backend\models\TbAssetsMoveSearch;
use backend\models\MrInCategory;
use backend\models\MrTkp;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseStringHelper;
use kartik\mpdf\Pdf;
// use barcode\barcode\BarcodeGenerator;

/**
 * TbAssetsController implements the CRUD actions for TbAssets model.
 */
class TbAssetsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => [
                'class' => \common\components\AccessRule::className()],
                'rules' => \common\components\AccessRule::getRules(),
                ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        /* Application Log */
        Yii::$app->application->log($action->id);
        if (!parent::beforeAction($action)) {
            return false;
        }
        // Another code here
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        // Code here
        return $result;
    }

    /**
     * Lists all TbAssets models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbAssetsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $level = Yii::$app->user->identity->level;
        $category = Yii::$app->user->identity->id;

        // it dan maintenance
        if ($level) {
            $dataProvider->query->andWhere(['tb_assets.id_user' => $category]);
        }
        if($level == '6fb4f22992a0d164b77267fde5477248') {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbAssets model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDetail($id)
    {
        $model = TbAssets::findOne(['id' => $id]);

        $model_broken = TbAssetsBroken::find()->where(['id_tb_assets' => $id])->all();
        $sum_qty_broken = TbAssetsBroken::find()->where(['id_tb_assets' => $model_broken])->sum('qty_broken');
        
        $model_move = TbAssetsMove::find()->where(['id_tb_assets' => $id])->all();
        $sum_qty_move = TbAssetsMove::find()->where(['id_tb_assets' => $model_move])->sum('qty_move');
        
        $model_repair = TbAssetsRepair::find()->where(['id_tb_assets' => $id])->all();
        $sum_qty_repair = TbAssetsRepair::find()->where(['id_tb_assets' => $model_repair])->sum('qty_repair');

        // if (Yii::$app->request->isAjax) {
            return $this->renderPartial('_detail', [
                'model' => $model,
                'model_broken' => $sum_qty_broken,
                'model_move' => $sum_qty_move,
                'model_repair' => $sum_qty_repair
            ]);
        // }
        // else {
        //     return $this->render('_detail', [
        //         'model' => $this->findModel($id),
        //     ]);
        // }
    }

    public function actionGenerated($kategori)
    {
        //foreach (range(1,10) as $key => $value) {
        //  # code...
        //}
        //for ($i=1; $i</*$model->qty*/1; $i++)
        //{
        //  # code...
        //}
        $code_digit  = 3;
        $code_tgl    = date('Ymd');
        $cek         = MrInCategory::findOne($kategori);
        $code_prefix = $cek->code . $code_tgl;
        $code_model  = TbAssets::find()->where(['LIKE', 'sku', $code_prefix])->max('sku');
        $code_init   = (int) BaseStringHelper::byteSubstr($code_model, strlen($code_prefix), strlen($code_prefix) + $code_digit);
        $code_seq    = str_pad($code_init + 1 , $code_digit, '0', STR_PAD_LEFT);
        $code_format = $code_prefix . $code_seq;
        return $code_format;
        // $model = new Model();
        // $model->sku = $code_format;
        // $model->save(false);
    }

    /**
     * Creates a new TbAssets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $repair = new TbAssetsRepair();
        // $broken = new TbAssetsBroken();
        $model = new TbAssets();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->id_user = Yii::$app->user->identity->id;
            // $model->is_condition = 'Good';
            $model->qty_current = $model->qty;

            $code_digit  = 3;
            $code_tgl    = date('Ymd');
            $cek         = MrInCategory::find()->where(['id' => $model->id_in_category])->one();
            $tkp         = MrTkp::find()->where(['id' => $model->id_tkp])->one();
            $code_prefix = $cek->code . $tkp->code;
            $code_model  = TbAssets::find()->where(['LIKE', 'sku', $code_prefix])->max('sku');
            $code_init   = (int) BaseStringHelper::byteSubstr($code_model, strlen($code_prefix), strlen($code_prefix) + $code_digit);
            $code_seq    = str_pad($code_init + 1 , $code_digit, '0', STR_PAD_LEFT);
            $code_format = $code_prefix . $code_seq;
            $model->sku = $code_format;

            $image = UploadedFile::getInstance($model, 'image');
            if ($image)
            {
                if ($model->id_tkp == 1) {
                    // radal
                    $file = Yii::$app->params['upload'] . 'assets/01radal/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 2) {
                    // kemang
                    $file = Yii::$app->params['upload'] . 'assets/02kemang/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 3) {
                    // sabang
                    $file = Yii::$app->params['upload'] . 'assets/03sabang/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 4) {
                    // bsd
                    $file = Yii::$app->params['upload'] . 'assets/04bsd/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 5) {
                    // benhil
                    $file = Yii::$app->params['upload'] . 'assets/05benhil/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 6) {
                    // bandung
                    $file = Yii::$app->params['upload'] . 'assets/06bandung/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 7) {
                    // semarang
                    $file = Yii::$app->params['upload'] . 'assets/07semarang/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 8) {
                    // kokas
                    $file = Yii::$app->params['upload'] . 'assets/08kokas/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 9) {
                    // bintaro
                    $file = Yii::$app->params['upload'] . 'assets/09bintaro/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 10) {
                    // gancit
                    $file = Yii::$app->params['upload'] . 'assets/10gancit/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 11) {
                    // halim
                    $file = Yii::$app->params['upload'] . 'assets/11halim/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 12) {
                    // karawaci
                    $file = Yii::$app->params['upload'] . 'assets/12karawaci/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 13) {
                    // sency
                    $file = Yii::$app->params['upload'] . 'assets/13sency/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 14) {
                    // moritz
                    $file = Yii::$app->params['upload'] . 'assets/14moritz/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 15) {
                    // depok
                    $file = Yii::$app->params['upload'] . 'assets/15depok/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 16) {
                    // cibubur
                    $file = Yii::$app->params['upload'] . 'assets/16cibubur/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 17) {
                    // blokm
                    $file = Yii::$app->params['upload'] . 'assets/17blokm/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 18) {
                    // office
                    $file = Yii::$app->params['upload'] . 'assets/18office/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 19) {
                    // cupcakes
                    $file = Yii::$app->params['upload'] . 'assets/19cupcakes/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 20) {
                    // sabiwok tebet
                    $file = Yii::$app->params['upload'] . 'assets/stebet/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 21) {
                    // sabiwok bonjer
                    $file = Yii::$app->params['upload'] . 'assets/sbonjer/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 22) {
                    // sabiwok pondok gede
                    $file = Yii::$app->params['upload'] . 'assets/sgede/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 23) {
                    // sabiwok bogor
                    $file = Yii::$app->params['upload'] . 'assets/sbogor/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 24) {
                    // sabiwok tomang
                    $file = Yii::$app->params['upload'] . 'assets/stomang/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 25) {
                    // sabiwok sawah besar
                    $file = Yii::$app->params['upload'] . 'assets/sbesar/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 26) {
                    // holysteak tebet
                    $file = Yii::$app->params['upload'] . 'assets/rgi_tebet/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 27) {
                    // holysteak bonjer
                    $file = Yii::$app->params['upload'] . 'assets/rgi_bonjer/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 28) {
                    // holysteak pondok gede
                    $file = Yii::$app->params['upload'] . 'assets/rgi_gede/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 29) {
                    // holysteak bogor
                    $file = Yii::$app->params['upload'] . 'assets/rgi_bogor/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 30) {
                    // holysteak tomang
                    $file = Yii::$app->params['upload'] . 'assets/rgi_tomang/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 31) {
                    // holysteak sawah besar
                    $file = Yii::$app->params['upload'] . 'assets/rgi_sawahbesar/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 32) {
                    // gudang ho
                    $file = Yii::$app->params['upload'] . 'assets/gudangho/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 33) {
                    // holysteak tendean
                    $file = Yii::$app->params['upload'] . 'assets/rgi_tendean/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 34) {
                    // pekan baru
                    $file = Yii::$app->params['upload'] . 'assets/20pku/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 35) {
                    // holysteak gi
                    $file = Yii::$app->params['upload'] . 'assets/rgi_imajikarasa/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 36) {
                    // holysteak gi
                    $file = Yii::$app->params['upload'] . 'assets/rgi_setiabudi/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 37) {
                    // holysteak laswi
                    $file = Yii::$app->params['upload'] . 'assets/rgi_laswi/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                // $file = Yii::$app->params['upload'] . 'assets/' . $model->sku . '.' . $image->extension;
                // $path = Yii::getAlias('@webroot') . $file;
                // $image->saveAs($path);
                // $model->image = $file;
            }
            $model->save();

            Yii::$app->getSession()->setFlash('aset_create_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Aset',
                'message'  => 'Data Berhasil ditambah !',
            ]);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2;
                    }
                }
                Yii::$app->getSession()->setFlash('aset_create_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TbAssets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // $repair = new TbAssetsRepair();
        // $broken = new TbAssetsBroken();
        // $move = new TbAssetsMove();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->id_user = Yii::$app->user->identity->id;

            $model->qty_current = $model->qty;

            // generate sku
            $code_digit  = 3;
            $code_tgl    = date('Ymd');
            $cek         = MrInCategory::find()->where(['id' => $model->id_in_category])->one();
            $tkp         = MrTkp::find()->where(['id' => $model->id_tkp])->one();
            $code_prefix = $cek->code . $tkp->code;
            $code_model  = TbAssets::find()->where(['LIKE', 'sku', $code_prefix])->max('sku');
            $code_init   = (int) BaseStringHelper::byteSubstr($code_model, strlen($code_prefix), strlen($code_prefix) + $code_digit);
            $code_seq    = str_pad($code_init + 1 , $code_digit, '0', STR_PAD_LEFT);
            $code_format = $code_prefix . $code_seq;
            $model->sku = $code_format;

            $image = UploadedFile::getInstance($model, 'image');
            if ($image)
            {
                if ($model->id_tkp == 1) {
                    // radal
                    $file = Yii::$app->params['upload'] . 'assets/01radal/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 2) {
                    // kemang
                    $file = Yii::$app->params['upload'] . 'assets/02kemang/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 3) {
                    // sabang
                    $file = Yii::$app->params['upload'] . 'assets/03sabang/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 4) {
                    // bsd
                    $file = Yii::$app->params['upload'] . 'assets/04bsd/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 5) {
                    // benhil
                    $file = Yii::$app->params['upload'] . 'assets/05benhil/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 6) {
                    // bandung
                    $file = Yii::$app->params['upload'] . 'assets/06bandung/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 7) {
                    // semarang
                    $file = Yii::$app->params['upload'] . 'assets/07semarang/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 8) {
                    // kokas
                    $file = Yii::$app->params['upload'] . 'assets/08kokas/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 9) {
                    // bintaro
                    $file = Yii::$app->params['upload'] . 'assets/09bintaro/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 10) {
                    // gancit
                    $file = Yii::$app->params['upload'] . 'assets/10gancit/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 11) {
                    // halim
                    $file = Yii::$app->params['upload'] . 'assets/11halim/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 12) {
                    // karawaci
                    $file = Yii::$app->params['upload'] . 'assets/12karawaci/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 13) {
                    // sency
                    $file = Yii::$app->params['upload'] . 'assets/13sency/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 14) {
                    // moritz
                    $file = Yii::$app->params['upload'] . 'assets/14moritz/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 15) {
                    // depok
                    $file = Yii::$app->params['upload'] . 'assets/15depok/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 16) {
                    // cibubur
                    $file = Yii::$app->params['upload'] . 'assets/16cibubur/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 17) {
                    // blokm
                    $file = Yii::$app->params['upload'] . 'assets/17blokm/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 18) {
                    // office
                    $file = Yii::$app->params['upload'] . 'assets/18office/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 19) {
                    // cupcakes
                    $file = Yii::$app->params['upload'] . 'assets/19cupcakes/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 20) {
                    // sabiwok tebet
                    $file = Yii::$app->params['upload'] . 'assets/stebet/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 21) {
                    // sabiwok bonjer
                    $file = Yii::$app->params['upload'] . 'assets/sbonjer/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 22) {
                    // sabiwok pondok gede
                    $file = Yii::$app->params['upload'] . 'assets/sgede/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 23) {
                    // sabiwok bogor
                    $file = Yii::$app->params['upload'] . 'assets/sbogor/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 24) {
                    // sabiwok tomang
                    $file = Yii::$app->params['upload'] . 'assets/stomang/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 25) {
                    // sabiwok sawah besar
                    $file = Yii::$app->params['upload'] . 'assets/sbesar/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 26) {
                    // holysteak tebet
                    $file = Yii::$app->params['upload'] . 'assets/rgi_tebet/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 27) {
                    // holysteak bonjer
                    $file = Yii::$app->params['upload'] . 'assets/rgi_bonjer/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 28) {
                    // holysteak pondok gede
                    $file = Yii::$app->params['upload'] . 'assets/rgi_gede/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 29) {
                    // holysteak bogor
                    $file = Yii::$app->params['upload'] . 'assets/rgi_bogor/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 30) {
                    // holysteak tomang
                    $file = Yii::$app->params['upload'] . 'assets/rgi_tomang/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 31) {
                    // holysteak sawah besar
                    $file = Yii::$app->params['upload'] . 'assets/rgi_sawahbesar/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 32) {
                    // gudang ho
                    $file = Yii::$app->params['upload'] . 'assets/gudangho/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 33) {
                    // holysteak tendean
                    $file = Yii::$app->params['upload'] . 'assets/rgi_tendean/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 34) {
                    // pekan baru
                    $file = Yii::$app->params['upload'] . 'assets/20pku/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 35) {
                    // holysteak gi
                    $file = Yii::$app->params['upload'] . 'assets/rgi_imajikarasa/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 36) {
                    // holysteak gi
                    $file = Yii::$app->params['upload'] . 'assets/rgi_setiabudi/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                if ($model->id_tkp == 37) {
                    // holysteak laswi
                    $file = Yii::$app->params['upload'] . 'assets/rgi_laswi/' . $model->sku . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);
                    $model->image = $file;
                }
                // $file = Yii::$app->params['upload'] . 'assets/' . $model->sku . '.' . $image->extension;
                // $path = Yii::getAlias('@webroot') . $file;
                // $image->saveAs($path);
                // $model->image = $file;
            }
            else
            {
                $path = $this->findModel($id);
                $model->image = $path->image;
            }
            $model->save(false);
            Yii::$app->getSession()->setFlash('aset_update_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Aset',
                'message'  => 'Data Berhasil di Edit !',
            ]);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2;
                    }
                }
                Yii::$app->getSession()->setFlash('aset_update_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TbAssets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbAssets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbAssets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbAssets::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /* ============ Assets Repair ============= */
    // findmodel repair
    protected function findModelRepair($id)
    {
        if (($modelRepair = TbAssetsRepair::findOne($id)) !== null) {
            return $modelRepair;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    // index repair
    public function actionRepair()
    {
        $searchModel = new TbAssetsRepairSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('arepair_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // create repair
    public function actionCreateRepair($id_tb_assets = null)
    {
        $modelRepair = new TbAssetsRepair();
        $modelRepair->id_tb_assets = $id_tb_assets;
        $aset_current = TbAssets::findOne(['id' => $id_tb_assets]);
        $aset = Yii::$app->request->post('assets');
        $current = Yii::$app->request->post('qty_now');

        if ($modelRepair->load(Yii::$app->request->post())) {
            $modelRepair->id_tb_assets = (int)$aset;
            $modelRepair->id_user = Yii::$app->user->identity->id;
            $modelRepair->dor = date('Y-m-d h:i:sa');
            if ($modelRepair->qty_repair > $current) {
                $message = 'Kuantiti Barang tidak sama';
                    Yii::$app->getSession()->setFlash('status_rusak_update_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
                return $this->redirect(['create-repair']);
            }
            $modelRepair->save(false);

            Yii::$app->getSession()->setFlash('create_repair_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Perbaikan Barang',
                'message'  => 'Data Berhasil ditambah !',
            ]);
            return $this->redirect(['repair']);
        }
        else
        {
            if ($modelRepair->errors)
            {
                $message = "";
                foreach ($modelRepair->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2;
                    }
                }
                Yii::$app->getSession()->setFlash('create_repair_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('arepair_create', [
            'model' => $modelRepair,
            'currents' => $aset_current,
        ]);
    }

    public function actionRepairForm($id)
    {
        $model = $this->findModel($id);
        $repair = new TbAssetsRepair();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            if ($model->is_condition == $repair->is_condition) {
                $repair->is_condition = $model->is_condition;
                $repair->condition_issue = $model->condition_issue;
                $repair->status = $model->status;
                $repair->id_user = $model->id_user;
                $repair->id_tb_assets = $model->id;
                $repair->dor = date('Y-m-d h:i:sa');
                $model->save();

                Yii::$app->getSession()->setFlash('aset_repair_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Perbaikan Barang',
                'message'  => 'Data Berhasil di Edit !',
            ]);
            return $this->redirect(['tb-assets/index-repair']);
            }
        }
        else
        {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2;
                    }
                }
                Yii::$app->getSession()->setFlash('aset_repair_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }
        
        return $this->render('arepair', [
            'model' => $model,
        ]);
    }

    // detail record repair
    public function actionDetailRecordRepair($id_tb_assets) {
        return $this->render('arepair_detail_record', [
            'model' => $this->findModel($id_tb_assets),
        ]);
    }


    /* ============ Assets Move ============= */
    // findmodel move
    protected function findModelMove($id)
    {
        if (($modelMove = TbAssetsMove::findOne($id)) !== null) {
            return $modelMove;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    // index move
    public function actionMove()
    {
        $searchModel = new TbassetsMoveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('amove_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // create move
    public function actionCreateMove($id_tb_assets = null)
    {
        $modelMove = new TbAssetsMove();
        $modelMove->id_tb_assets = $id_tb_assets;
        $aset = Yii::$app->request->post('assets');
        $aset_current = TbAssets::findOne(['id' => $id_tb_assets]);
        $current = Yii::$app->request->post('qty_now');
        $tkp_before = Yii::$app->request->post('tkp_now');

        if ($modelMove->load(Yii::$app->request->post())) {
            if ($modelMove->qty_move > $current) {
                $message = 'Kuantiti Barang tidak sama';
                    Yii::$app->getSession()->setFlash('status_rusak_update_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
                return $this->redirect(['create-move']);
            }
            if ($modelMove->id_tkp == $tkp_before) {
                $message = 'TKP Asal dengan TKP Tujuan Harus Berbeda';
                    Yii::$app->getSession()->setFlash('status_rusak_update_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
                return $this->redirect(['create-move']);
            }

            $modelMove->id_tb_assets = (int)$aset;
            $modelMove->id_user = Yii::$app->user->identity->id;
            $modelMove->id_tkp_origin = (int)$tkp_before;
            $modelMove->dom = date('Y-m-d h:i:sa');
            $modelMove->save();

            Yii::$app->getSession()->setFlash('create_move_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Pindah Barang',
                'message'  => 'Data Berhasil ditambah !',
            ]);
            return $this->redirect(['move']);
        }
        else
        {
            if ($modelMove->errors)
            {
                $message = "";
                foreach ($modelMove->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2;
                    }
                }
                Yii::$app->getSession()->setFlash('create_move_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }
        
        return $this->render('amove_create', [
            'model' => $modelMove,
            'currents' => $aset_current,
        ]);
    }

    // detail record move
    public function actionDetailRecordMove($id_tb_assets) {
        return $this->render('amove_detail_record', [
            'model' => $this->findModel($id_tb_assets),
        ]);
    }
    

    /* ============ Assets Broken ============= */
    // findmodel broken
    protected function findModelBroken($id)
    {
        if (($modelBroken = TbAssetsBroken::findOne($id)) !== null) {
            return $modelBroken;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    // index broken
    public function actionBroken()
    {
        $searchModel = new TbAssetsBrokenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('abroken_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    // update broken
    public function actionUpdateBroken($id)
    {
        $modelBroken = $this->findModelBroken($id);
        
        if ($modelBroken->load(Yii::$app->request->post()) && $modelBroken->validate()) {
            if ($modelBroken->status == 'Dijual') {
                $modelBroken->is_sale_date = date('Y-m-d h:i:sa');
            }
            if ($modelBroken->status == 'Dibuang') {
                $modelBroken->is_waste_date = date('Y-m-d h:i:sa');
            }
            $modelBroken->save(false);
            Yii::$app->getSession()->setFlash('status_rusak_update_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Status Barang Rusak',
                'message'  => 'Data Berhasil di Edit !',
            ]);
            return $this->redirect(['view-broken', 'id' => $modelBroken->id]);
        }
        else
        {
            if ($modelBroken->errors)
            {
                $message = "";
                foreach ($modelBroken->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2;
                    }
                }
                Yii::$app->getSession()->setFlash('status_rusak_update_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }
        return $this->render('abroken', [
            'model' => $modelBroken,
        ]);
    }
    // view broken
    public function actionViewBroken($id)
    {
        return $this->render('abroken_view', [
            'model' => $this->findModelBroken($id),
        ]);
    }
    // create broken
    public function actionCreateBroken($id_tb_assets = null)
    {
        $modelAset = new TbAssets();
        $modelBroken = new TbAssetsBroken();
        $modelBroken->id_tb_assets = $id_tb_assets;
        $aset_current = TbAssets::findOne(['id' => $id_tb_assets]);
        $current = Yii::$app->request->post('qty_now');
        $assets = Yii::$app->request->post('assets');

        if ($modelBroken->load(Yii::$app->request->post()) && $modelBroken->validate()) {
            // if (!abs($modelBroken->qty_broken)) { 
            //     $message = 'Mohon tidak menggunakan 0 di depan angka atau tanda (+) dan (-)';
            //         Yii::$app->getSession()->setFlash('status_rusak_update_failed', [
            //             'type'     => 'error',
            //             'duration' => 5000,
            //             'title'  => 'Error',
            //             'message'  => $message,
            //         ]
            //     );
            //     return $this->redirect(['create-broken']);
            // }
            // validasi jumlah barang (if qty_broken > qty_current then validate run)
            if ($modelBroken->qty_broken > $current) {
                $message = 'Kuantiti Barang tidak sama';
                    Yii::$app->getSession()->setFlash('status_rusak_update_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
                return $this->redirect(['create-broken']);
            }

            // perhitungan jumlah barang
            $modelAset = TbAssets::find()->where(['id' => $assets])->one();
            $modelAset->qty_current = (int)$current - $modelBroken->qty_broken;
            $modelAset->save(false);

            $modelBroken->id_tb_assets = $assets;
            $modelBroken->id_user = Yii::$app->user->identity->id;
            $modelBroken->is_condition = 'Abnormal';
            $modelBroken->dob = date('Y-m-d h:i:sa');
            $modelBroken->save(false);

            Yii::$app->getSession()->setFlash('broken_create_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Barang Rusak',
                'message'  => 'Data Berhasil di Tambah !',
            ]);
            return $this->redirect(['view-broken', 'id' => $modelBroken->id]);
        }
        else
        {
            if ($modelBroken->errors)
            {
                $message = "";
                foreach ($modelBroken->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2;
                    }
                }
                Yii::$app->getSession()->setFlash('status_rusak_update_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }
        return $this->render('abroken_create', [
            'model' => $modelBroken,
            // json_encode(array(
            'currents' => $aset_current,
            // ))
        ]);
    }

    // detail record broken
    public function actionDetailRecordBroken($id_tb_assets) {
        return $this->render('abroken_detail_record', [
            'model' => $this->findModel($id_tb_assets),
        ]);
    }


    /* ================= scan barcode ===================== */
    public function actionScanner($number = null)
    {
        $awb = $number;
        $shipment = TbAssets::find()
                    ->where(['sku' => $awb])
                    ->asArray()
                    ->one();

        $data_trace = array(
            'shipment' => array(
                'id'  => $shipment['id'],
                'sku'  => $shipment['sku'],
                'name'  => $shipment['name'],
                'qty_current' => $shipment['qty_current'],
                // 'id_tkp' => $shipment['id_tkp'],
            ),
        );
        return $this->render('scanner', [
            'data_trace' => $awb ? $data_trace : null,
        ]);
    }

    /* ================= select form Jquery ===================== */
    public function actionSelect($id)
    {
        // mencari barang
        $qty = TbAssets::findOne(['id' => $id]);
        $tkp = TbAssets::findOne(['id' => $id]);

        // initial flag
        $tkp_exist = "<option value=''>-</option>";
        
        // search qty barang berdasarkan id
        $model = MrTkp::find()->where(['id' => $tkp['id_tkp']])->asArray()->all();

        // perulangan pencarian qty barang now
        foreach ($model as $key => $value)
        {
            $tkp_exist.= '<option value="' . $value['id'] . '">' .  $value['name'] . '</option>';
        }

        return json_encode(array(
                'qty_now' => $qty->qty_current,
                'tkp_now' => $tkp_exist,
            )
        );
    }

    /* ================ print barcode pdf ==================== */
    public function actionPrintBarcodePdf() 
    {
        
        $searchModel = new TbAssets();
        $searchModel = $searchModel->find()->all();

        $content = $this->renderPartial('/tb-assets/print_barcode/barcode_pdf',['model' => $searchModel]);

        $cssInline = <<<CSS
        
        table {
            *border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .table-pdf td, .table-pdf th {
            padding: 10px;
            border: 1px solid #0000;
            text-align: center;
        }
        .table-pdf th {
            border: 1px solid #0000;
            background-color: #eee;
            text-align: center;
        }
        
        CSS;

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => $cssInline,
             // set mPDF properties on the fly
            'options' => ['title' => 'Cetak Barcode PDF'],
             // call mPDF methods on the fly
            'methods' => [
                // 'SetHeader'=> [null],
                // 'SetFooter'=> [null],
                'SetHeader' => ['Bhadranaya Group||' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');

        $time = time();
        $pdf->filename = $time . "_Barcode.pdf";
        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionBarcodePrint() {
        return $this->render('barcode');
    }
}
