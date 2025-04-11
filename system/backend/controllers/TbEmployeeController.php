<?php

namespace backend\controllers;

use backend\models\TbEmpLeave;
use backend\models\TbEmpLeaveSearch;
use Yii;
use backend\models\TbEmployee;
use backend\models\TbEmployeeSearch;
use backend\models\TbEmpRecContract;
use backend\models\TbEmpRecTkp;
use backend\models\User;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TbEmployeeController implements the CRUD actions for TbEmployee model.
 */
class TbEmployeeController extends Controller
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
     * Lists all TbEmployee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbEmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // $status = TbEmployee::find()->where(['status' => 'Resign'])->all();
        // if ($status) {
        //     $dataProvider = $status;
        // }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbEmployee model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new TbEmpLeaveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort([
            'defaultOrder' => [
                'timestamp' => SORT_DESC,
            ]
        ]);

        $start_date = Yii::$app->request->get('start_date');
        $end_date = Yii::$app->request->get('till_date');

        if ($start_date && $end_date) {
            $start_date = explode('/', $start_date);
            $start_date = sprintf('%s-%s-%s', $start_date[2], $start_date[1], $start_date[0]) . ' 00:00:00';
            $end_date = explode('/', $end_date);
            $end_date = sprintf('%s-%s-%s', $end_date[2], $end_date[1], $end_date[0]) . ' 23:59:59';
            $dataProvider->query->andFilterWhere(['between', 'datetime', $start_date, $end_date]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new TbEmployee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbEmployee();

        $user = new User();


        // $user->password_hash = 'PASSWORD_HASH';
        $user->auth_key = 'AUTH_KEY';
        $user->created_at = time();
        $user->updated_at = time();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($model->facilities == NULL) {
                $model->facilities;
            }
            if ($model->facilities){
                $facilities = implode(",", $model['facilities']);
                $model->facilities = $facilities;
            }

            $image = UploadedFile::getInstance($model, 'image');
            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'employee/' . $model->nie . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);
                $model->image = $file;
            }
            $model->save();
            
            $user->username = $model->nie;
            $user->name = $model->name;
            $user->email = $model->email;
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->password_hash = '$2y$13$l7HTp83mZdDudkQOG62sH.1KPAUTB43uzBEDNtHKGBWmNonUFV0FO';
            $user->level = 'f4078c01743a307c59b45913b9cce2a8';
            $user->status = 10;
            $user->code = 'KYW';

            $user->id_employee = $model->id;
            $user->save(false);

            Yii::$app->getSession()->setFlash('employee_create', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Karyawan',
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
                Yii::$app->getSession()->setFlash('employee_failed', [
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
     * Updates an existing TbEmployee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $rec_tkp = new TbEmpRecTkp();
        $rec_contract = new TbEmpRecContract();
        

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $tkp_exist = $this->findModel($id);
            

            if ((int) $model->id_tkp !== $tkp_exist->id_tkp) {
                $rec_tkp->id_employee = $model->id;
                $rec_tkp->id_tkp_origin = $tkp_exist->id_tkp;
                $rec_tkp->id_tkp_destination = $model->id_tkp;
                $rec_tkp->dot = date('Y-m-d h:i:sa');
                $rec_tkp->save(false);
            }

            $contract_exist = $this->findModel($id);

            if ((int) $model->status_contract !== $contract_exist->status_contract) {
                $rec_contract->id_employee = $model->id;
                $rec_contract->status_contract_origin = $contract_exist->status_contract;
                $rec_contract->status_contract_destination = $model->status_contract;
                $rec_contract->doc = date('Y-m-d h:i:sa');
                $rec_contract->save(false);
            }

            // $facilities = implode(",", $model['facilities']);
            // $model->facilities = $facilities;

            if ($model->facilities == NULL) {
                $model->facilities;
            }
            if ($model->facilities){
                $facilities = implode(",", $model['facilities']);
                $model->facilities = $facilities;
            }
            
            $image = UploadedFile::getInstance($model, 'image');
            
            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'employee/' . $model->nie . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);
                $model->image = $file;
            }
            else
            {
                $path = $this->findModel($id);
                $model->image = $path->image;
            }

            $model->save();

            Yii::$app->getSession()->setFlash('employee_update_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Karyawan',
                'message'  => 'Data Berhasil di Edit !',
            ]
        );
            
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
                Yii::$app->getSession()->setFlash('employee_update_failed', [
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
     * Deletes an existing TbEmployee model.
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
     * Finds the TbEmployee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbEmployee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbEmployee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionSistemold() {
        return $this->render('sistemlama');
    }
}
