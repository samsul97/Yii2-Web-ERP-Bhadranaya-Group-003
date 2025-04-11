<?php

namespace backend\controllers;

use Yii;
use backend\models\TbEmpLeave;
use backend\models\TbEmpLeaveFilter;
use backend\models\TbEmpLeaveSearch;
use backend\models\TbEmpLoan;
use backend\models\TbEmployee;
use backend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TbEmpLeaveController implements the CRUD actions for TbEmpLeave model.
 */
class TbEmpLeaveController extends Controller
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
     * Lists all TbEmpLeave models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbEmpLeaveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $level = Yii::$app->user->identity->level;
        $user = Yii::$app->user->identity->id;
        $users = User::findOne(['id' => $user]);

        if ($level) {
            $dataProvider->query->andWhere(['tb_emp_leave.id_employee' => $users->id_employee]);
        } 
        if ($level == '2fae3af091b358426e15064175a896df') {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        if ($level == '6fb4f22992a0d164b77267fde5477248') {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

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
            $dataProvider->query->andFilterWhere(['between', 'timestamp', $start_date, $end_date]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbEmpLeave model.
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

    public function actionSelect($id)
    {
        // Mencari karyawan jika sudah setahun maka value leave_total reset menjadi 12, jika tidak maka value total cuti dari db (select total cuti tahun ini di tabel emp_leave)
        // sisa cuti karyawan
        $years_now = date('Y');
        $sum_leave_total = TbEmpLeaveFilter::find()->where(['id_employee'=> $id, 'leave_years' => $years_now])->sum('leave_total');
        $total = 12 - $sum_leave_total;
        // $total = $sum_leave_total ? $sum_leave_total : 12;
        return json_encode(array(
            'leave_off_employee' => $total,
            )
        );
    }

    /**
     * Creates a new TbEmpLeave model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbEmpLeave();
        $employee = Yii::$app->request->post('employee');
        $employee_off = Yii::$app->request->post('leave_off_employee');

        if ($model->load(Yii::$app->request->post())) {
            // ========== Coding Versi Adyoi ==========
            // ========== validasi jumlah cuti max 12 pertahun mulai dari april ketemu april ==========
            $datetime1 = new \DateTime($model->start_date);
            $datetime2 = new \DateTIme($model->till_date);
            $interval = $datetime1->diff($datetime2);
            $interval_sum = $interval->format('%a') + 1;
            $hitung = $employee_off - $interval_sum;

            if ($hitung < 0) {
                    $message = 'Jumlah Cuti Max 12';
                    Yii::$app->getSession()->setFlash('leave_validation_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
                return $this->redirect(['create']);
            }

            $save_filter = new TbEmpLeaveFilter();
            $save_filter->id_employee = $employee;
            $save_filter->leave_years = date("Y");
            $save_filter->leave_total = $interval_sum;
            $save_filter->save(false);
            $model->id_employee = $employee;
            $model->save(false);
            
            // ========== validasi tanggal dan tahun yang sudah pernah digunakan ==========
            
            // ========== validasi till date gabisa mundur dari start date ==========

            // $leave_filter->save(false);
            //$tahun = [];
            // $n = 1;

            // $years_now = date('Y');
            // $sum_leave_total = TbEmpLeaveFilter::find()->where(['id_employee'=> $employee, 'leave_years' => $years_now])->sum('leave_total');

            // if ($hitung == 0) {
            //     $message = 'Jumlah Cuti Max 12';
            //         Yii::$app->getSession()->setFlash('leave_validation_failed', [
            //             'type'     => 'error',
            //             'duration' => 5000,
            //             'title'  => 'Error',
            //             'message'  => $message,
            //         ]
            //     );
            //     return $this->redirect(['create']);
            // }

            // for($i = $datetime1; $i <= $datetime2; $i->modify('+1 day')) {
                
                // $check_save_filter = TbEmpLeaveFilter::find()->where(['id_employee' => $employee, 'leave_years' =>  $i->format("Y")])->one();

                // if ($check_save_filter) {
                //     $check_save_filter->id_employee = $employee;
                //     $check_save_filter->leave_years = $i->format("Y");
                //     $check_save_filter->leave_total = $n++;
                //     $check_save_filter->save(false);
                    
                // } else {
                    // $save_filter = new TbEmpLeaveFilter();
                    // $save_filter->id_employee = $employee;
                    // $save_filter->leave_years = $i->format("Y");
                    // $save_filter->leave_total = $n++;
                    // $save_filter->save(false);
                // }
                
            // }
            // if ($start_date[0] == $sum > 12) {
            //     $message = 'Jumlah Cuti Max 12';
            //         Yii::$app->getSession()->setFlash('leave_validation_failed', [
            //             'type'     => 'error',
            //             'duration' => 5000,
            //             'title'  => 'Error',
            //             'message'  => $message,
            //         ]
            //     );
            //     return $this->redirect(['create']);
            // }

            // ========== Coding Versi Samsul ==========
            // $datetime1 = new \DateTime($model->start_date);
            // $datetime2 = new \DateTIme($model->till_date);
            // $interval = $datetime1->diff($datetime2);

            // $employee_off = TbEmployee::findOne(['id' => $employee]);
            // var_dump($employee_off);
            // die;
            // $employee_off->leave_off = $interval->format('%a') + 1;
            // $employee_off->save(false);

            // $model->leave_total = $interval->format('%a') + 1;
            // $model->save(false);

            // $employee = TbEmployee::find()->where(['id' => $model->id_employee])->one();
            // $sum = TbEmpLeave::find()->where(['id_employee' => $employee])->sum('leave_total');
            // if ($sum > 12) {
            //     $message = 'Jumlah Cuti Max 12';
            //         Yii::$app->getSession()->setFlash('leave_validation_failed', [
            //             'type'     => 'error',
            //             'duration' => 5000,
            //             'title'  => 'Error',
            //             'message'  => $message,
            //         ]
            //     );
            //     return $this->redirect(['create']);
            // }
            Yii::$app->getSession()->setFlash('leave_create_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Cuti',
                'message'  => 'Data Berhasil di Tambah !',
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
                Yii::$app->getSession()->setFlash('surat_update_failed', [
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
            'employees' => $employee,
        ]);
    }

    /**
     * Updates an existing TbEmpLeave model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $employee = Yii::$app->request->post('employee');
        $employee_off = Yii::$app->request->post('leave_off_employee');

        if ($model->load(Yii::$app->request->post())) {
            // ========== Coding Versi Adyoi ==========
            // ========== validasi jumlah cuti max 12 pertahun mulai dari april ketemu april ==========
            $datetime1 = new \DateTime($model->start_date);
            $datetime2 = new \DateTIme($model->till_date);
            $interval = $datetime1->diff($datetime2);
            $interval_sum = $interval->format('%a') + 1;
            $hitung = $employee_off - $interval_sum;

            if ($hitung < 0) {
                    $message = 'Jumlah Cuti Max 12';
                    Yii::$app->getSession()->setFlash('leave_validation_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
                return $this->redirect(['create']);
            }

            $data_exist = $this->findModel($id);

            if ((int) $employee == $data_exist->id_employee) {

                $save_filter = new TbEmpLeaveFilter();
                $save_filter->id_employee = $data_exist->id_employee;
                $save_filter->leave_years = date("Y");
                $save_filter->leave_total = $interval_sum;
                $save_filter->save(false);
                $model->id_employee = $employee;
                $model->save(false);
            
            }
            Yii::$app->getSession()->setFlash('leave_update_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Cuti',
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
                Yii::$app->getSession()->setFlash('leave_update_failed', [
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
            'employees' => $employee,
        ]);
    }

    /**
     * Deletes an existing TbEmpLeave model.
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
     * Finds the TbEmpLeave model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbEmpLeave the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbEmpLeave::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
