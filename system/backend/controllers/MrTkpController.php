<?php

namespace backend\controllers;

use backend\models\MrCctvSearch;
use backend\models\MrCompany;
use backend\models\MrCompanySearch;
use Yii;
use backend\models\MrTkp;
use backend\models\MrTkpSearch;
use backend\models\MrWifiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MrTkpController implements the CRUD actions for MrTkp model.
 */
class MrTkpController extends Controller
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
     * Lists all MrTkp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MrTkpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MrTkp model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // $searchModel1 = new MrCompanySearch();
        // $searchModel2 = new MrWifiSearch();
        // $searchModel3 = new MrCctvSearch();
        // $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);
        // $dataProvider3 = $searchModel3->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            // 'searchModel1' => $searchModel1,
            // 'searchModel2' => $searchModel2,
            // 'searchModel3' => $searchModel3,
            // 'dataProvider1' => $dataProvider1,
            // 'dataProvider2' => $dataProvider2,
            // 'dataProvider3' => $dataProvider3,
        ]);
    }

    /**
     * Creates a new MrTkp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MrTkp();

        $model->created_at = date('Y-m-d h:i:sa');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->getSession()->setFlash('tkp_create', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data TKP',
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
                Yii::$app->getSession()->setFlash('tkp_failed', [
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
     * Updates an existing MrTkp model.
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
     * Deletes an existing MrTkp model.
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
     * Finds the MrTkp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MrTkp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MrTkp::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
