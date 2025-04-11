<?php

namespace backend\controllers;

use Yii;
use backend\models\SetFeFooter2Testimony;
use backend\models\SetFeFooter2TestimonySearch;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SetFeFooter2TestimonyController implements the CRUD actions for SetFeFooter2Testimony model.
 */
class SetFeFooter2TestimonyController extends Controller
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
     * Lists all SetFeFooter2Testimony models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SetFeFooter2TestimonySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $html = $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        return json_encode($html);
    }

    /**
     * Displays a single SetFeFooter2Testimony model.
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
     * Creates a new SetFeFooter2Testimony model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SetFeFooter2Testimony();

        if (!Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'photo');
            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'testimony/' . $model->name . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);
                $model->photo = $file;
            }
            $model->save(false);
            return $this->goBack(Yii::$app->request->referrer);
        } 
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SetFeFooter2Testimony model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'photo');
            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'testimony/' . $model->name . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);
                $model->photo = $file;
            }
            else
            {
                $path = $this->findModel($id);
                $model->photo = $path->photo;
            }
            $model->save(false);

            if (!Yii::$app->request->isAjax) {
                return $this->goBack(Yii::$app->request->referrer);
            }
            // return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing SetFeFooter2Testimony model.
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
     * Finds the SetFeFooter2Testimony model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SetFeFooter2Testimony the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SetFeFooter2Testimony::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
