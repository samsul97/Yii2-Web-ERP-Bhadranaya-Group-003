<?php

namespace backend\controllers;

use Yii;
use backend\models\TbMarVoucher;
use backend\models\TbMarVoucherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TbMarVoucherController implements the CRUD actions for TbMarVoucher model.
 */
class TbMarVoucherController extends Controller
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
     * Lists all TbMarVoucher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbMarVoucherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $level = Yii::$app->user->identity->level;
        $voucher = Yii::$app->user->identity->id;

        // var_dump($level);
        // die;
        if ($level) {
            $dataProvider->query->andWhere(['tb_mar_voucher.id_user' => $voucher]);
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
     * Displays a single TbMarVoucher model.
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
     * Creates a new TbMarVoucher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbMarVoucher();

        $model->created_at = date('Y-m-d h:i:sa');
        $model->id_user = Yii::$app->user->identity->id;
        $model->status = 1; //status hanya 2, yaitu 1 belum di klaim dan 2 sudah di klaim.

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->getSession()->setFlash('voucher_create_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Voucher',
                'message'  => 'Data Berhasil ditambah !',
            ]);

            $model->save();
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
                Yii::$app->getSession()->setFlash('voucher_create_failed', [
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
     * Updates an existing TbMarVoucher model.
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
     * Deletes an existing TbMarVoucher model.
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
     * Finds the TbMarVoucher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbMarVoucher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbMarVoucher::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEditStatus($id, $status)
    {
        $model = $this->findModel($id);
        $model->status = $status;
        if ($model->save(false)) {
            Yii::$app->getSession()->setFlash('voucher_status_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Status Voucher',
                'message'  => 'Status Berhasil diubah !',
            ]);
            return $this->redirect(['tb-mar-voucher/index']);
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
                Yii::$app->getSession()->setFlash('voucher_status_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }
    }
}
