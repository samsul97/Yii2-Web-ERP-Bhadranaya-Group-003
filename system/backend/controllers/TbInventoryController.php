<?php

namespace backend\controllers;

use backend\models\MrInType;
use Yii;
use backend\models\TbInventory;
use backend\models\TbInventorySearch;
use backend\models\TbInvManagement;
use backend\models\TbInvManagementSearch;
use backend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseStringHelper;

/**
 * TbInventoryController implements the CRUD actions for TbInventory model.
 */
class TbInventoryController extends Controller
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
     * Lists all TbInventory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbInventorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $level = Yii::$app->user->identity->level;
        $inv = Yii::$app->user->identity->id;
        
        if ($level) {
            $dataProvider->query->andWhere(['tb_inventory.id_user' => $inv]);
        }

        if ($level == '6fb4f22992a0d164b77267fde5477248') {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbInventory model.
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

    /**
     * Creates a new TbInventory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbInventory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('inv_create_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Inventori',
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
                Yii::$app->getSession()->setFlash('inv_create_failed', [
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
     * Updates an existing TbInventory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TbInventory model.
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
     * Finds the TbInventory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbInventory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbInventory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // inventory cost control
    public function actionCostcontrol($id)
    {
        $inventory = $this->findModel($id);
        $invManagement = new TbInvManagement();
        $check_inventory = TbInvManagement::find()->where(['id_inventory' => $inventory, 'updated_at' => date("Y-m-d")])->one();
        $wasinput = $check_inventory ? $check_inventory->load(Yii::$app->request->post()) : $invManagement;

        /* ======== PARAMETER UPDATE ========*/
        if ($check_inventory) {
            // create rumus
            $begin_selling = $check_inventory->in_selling + $check_inventory->begin_stock;
            $minus = $check_inventory->out_sales + $check_inventory->out_non_sales + $check_inventory->waste + $check_inventory->spoiled;
            $sum = $begin_selling - $minus;
            $check_inventory->last_stock = $sum;
            $check_inventory->save(false);

            if ($check_inventory->last_stock < 0) {
                $message = 'Last Stock Tidak Boleh Kurang Dari 0, Harap Isi dengan Benar!';
                    Yii::$app->getSession()->setFlash('laststock_update_validation_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]);
                return $this->redirect(['costcontrol', 'id' => $id]);
            }

            // relation table inventory
            $check_inventory->id_inventory = $inventory->id; 
            $check_inventory->id_in_type = $inventory->id_in_type;
            $check_inventory->id_user = $inventory->id_user;
            $check_inventory->updated_at = date('Y-m-d');
            $check_inventory->save(false);

            /* parameter barang kosong (beginstock value from in_arrival) */
            // if ($check_inventory->begin_stock == 0) {
            //     $check_inventory->in_selling = NULL;
            //     $check_inventory->out_sales = NULL;
            //     $check_inventory->out_non_sales = NULL;
            //     $check_inventory->waste = NULL;
            //     $check_inventory->spoiled = NULL;
            //     $check_inventory->begin_stock = $check_inventory->in_arrival;
            //     $check_inventory->last_stock = $check_inventory->begin_stock;
            //     $check_inventory->save(false);
            // }
            
            // if ($check_inventory->last_stock == 0 && $check_inventory->begin_stock == 0) {
            //     $check_inventory->begin_stock = $check_inventory->last_stock;
            //     $check_inventory->save(false);
            // }

            return $this->render('ainput_management', [
                'inv_management' => $invManagement,
                'select_inv' => $inventory,
                'check_inventory' => $check_inventory,
            ]);
        }
        else
        {
            /* ======== PARAMETER CREATE ========*/
            if($invManagement->load(Yii::$app->request->post())) {
                // create rumus
                $begin_selling = (int)$invManagement->in_selling + (int)$invManagement->begin_stock;
                $minus = (int)$invManagement->out_sales + (int)$invManagement->out_non_sales + (int)$invManagement->waste + (int)$invManagement->spoiled;
                $sum = $begin_selling - $minus;
                $invManagement->last_stock = $sum;

                if ($invManagement->last_stock < 0) {
                    $message = 'Last Stock Tidak Boleh Kurang Dari 0, Harap Isi dengan Benar!';
                        Yii::$app->getSession()->setFlash('laststock_create_validation_failed', [
                            'type'     => 'error',
                            'duration' => 5000,
                            'title'  => 'Error',
                            'message'  => $message,
                        ]);
                    return $this->redirect(['aupdate_management']);
                }

                // if ($invManagement->last_stock == 0) {
                //     $invManagement->last_stock = $invManagement->in_arrival;
                //     $invManagement->save(false);
                // }

                // if ($invManagement->begin_stock == 0) {
                //     $invManagement->in_selling = NULL;
                //     $invManagement->out_sales = NULL;
                //     $invManagement->out_non_sales = NULL;
                //     $invManagement->waste = NULL;
                //     $invManagement->spoiled = NULL;
                //     $invManagement->begin_stock = $invManagement->in_arrival;
                //     $invManagement->last_stock = $invManagement->begin_stock;
                //     $invManagement->save(false);
                // }
                
                // from table inventory
                $invManagement->id_inventory = $inventory->id; 
                $invManagement->id_in_type = $inventory->id_in_type;
                $invManagement->id_user = $inventory->id_user;
                $invManagement->updated_at = date('Y-m-d');
                $invManagement->save(false);

                Yii::$app->getSession()->setFlash('inv_management_create_success', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'  => 'Data Inventory',
                    'message'  => 'Data berhasil di Tambah ',
                ]);
                return $this->redirect(['index']);
            }
            return $this->render('aupdate_management', [
                'inv_management' => $invManagement,
                'select_inv' => $inventory,
                // 'wasinput' => $wasinput,
                'check_inventory' => $check_inventory,
            ]);
        }
    }

    // inventory report
    public function actionReport()
    {
        $searchModel = new TbInvManagementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $level = Yii::$app->user->identity->level;
        $inv = Yii::$app->user->identity->id;
        
        if ($level) {
            $dataProvider->query->andWhere(['tb_inv_management.id_user' => $inv]);
        }

        if ($level == '6fb4f22992a0d164b77267fde5477248') {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        $dataProvider->setSort([
            'defaultOrder' => [
                'remarks' => SORT_DESC,
            ]
        ]);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // generated SKU ITEM
    public function actionGeneratedsku($user)
    {
        $code_digit  = 2;
        $code_tgl    = date('Ymd');
        $cek         = User::findOne($user);
        $code_prefix = $cek->code . '-' . $code_tgl;
        $code_model  = TbInventory::find()->where(['LIKE', 'sku', $code_prefix])->max('sku');
        $code_init   = (int) BaseStringHelper::byteSubstr($code_model, strlen($code_prefix), strlen($code_prefix) + $code_digit);
        $code_seq    = str_pad($code_init + 1 , $code_digit, '0', STR_PAD_LEFT);
        $code_format = $code_prefix . '-' . $code_seq;
        return $code_format;
    }

    // Print Barcode Inventory
    public function actionPrintBarcode()
    {
        $level = Yii::$app->user->identity->level;
        $user = Yii::$app->user->identity->id;
        
        if ($level) {
            $datas = TbInventory::find()->where(['id_user' => $user])->all();
        }
        if ($level == '6fb4f22992a0d164b77267fde5477248') {
            $datas = TbInventory::find()->all();
        }
        return $this->render('barcode-pdf', [
            'datas' => $datas,
        ]);
    }
}
