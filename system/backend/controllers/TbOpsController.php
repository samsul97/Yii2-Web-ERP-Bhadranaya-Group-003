<?php

namespace backend\controllers;

use Yii;
use backend\models\TbOps;
use backend\models\TbOpsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TbOpsController implements the CRUD actions for TbOps model.
 */
class TbOpsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    /**
     * @inheritdoc
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
     * Lists all TbOps models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbOpsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            // 'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbOps model.
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
     * Creates a new TbOps model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbOps();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TbOps model.
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
     * Deletes an existing TbOps model.
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
     * Finds the TbOps model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbOps the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbOps::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /* ====== SALES TKP VIEW WEBDAV ===== */
    public function actionEod()
    {
        // EOD TKP
        return $this->render('salestkp/eod');
    }

    /* ====== SALES MIX DATABASE POS ===== */
    public function actionItemsalesmix()
    {
        // Item Mix
        return $this->render('salesmix/item');
    }
    public function actionKategorisalesmix()
    {
        // Kategori Mix
        return $this->render('salesmix/kategori');
    }
    public function actionPromosalesmix()
    {
        // Promo
        return $this->render('salesmix/promosi');
    }
    public function actionTopsalesmix()
    {
        // Top Kategori
        return $this->render('salesmix/top');
    }
    public function actionPenjualansalesmix()
    {
        // Waktu Penjualan Produk
        return $this->render('salesmix/penjualan');
    }

    /* ====== SUMMARY DATABASE POS ===== */
    public function actionGrosssummary()
    {
        // Ringkasan untung kotor
        return $this->render('summary/gross');
    }
    public function actionDiscsummary()
    {
        // Ringkasan Diskon
        return $this->render('summary/disc');
    }
    public function actionPaymentsummary()
    {
        // Jenis Pembayaran
        return $this->render('summary/payment');
    }

    /* ====== DASHBOARD GRAFIK DATABASE POS ===== */
    public function actionGrafik()
    {
        return $this->render('grafik/grafik');
    }
    public function actionDetail()
    {
        return $this->renderPartial('salestkp/eod');
    }
}
