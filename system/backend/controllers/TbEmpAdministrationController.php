<?php

namespace backend\controllers;

use Yii;
use backend\models\TbEmpAdministration;
use backend\models\TbEmpAdministrationSearch;
use backend\models\TbEmployee;
use backend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * TbEmpAdministrationController implements the CRUD actions for TbEmpAdministration model.
 */
class TbEmpAdministrationController extends Controller
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
     * Lists all TbEmpAdministration models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbEmpAdministrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $level = Yii::$app->user->identity->level;
        $user = Yii::$app->user->identity->id;
        $users = User::findOne(['id' => $user]);

        if ($level) {
            $dataProvider->query->andWhere(['tb_emp_administration.id_employee' => $users->id_employee]);
        } 
        if ($level == '2fae3af091b358426e15064175a896df') {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        if ($level == '6fb4f22992a0d164b77267fde5477248') {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        // if ($level == '6fb4f22992a0d164b77267fde5477248') {
        // }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbEmpAdministration model.
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
     * Creates a new TbEmpAdministration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbEmpAdministration();

        $employee = Yii::$app->request->post('employee');
        $sm_position = Yii::$app->request->post('sm_position');
        $dm_position = Yii::$app->request->post('dm_position');
        $pr_position = Yii::$app->request->post('pr_position');
        $act_position = Yii::$app->request->post('act_position');
        $sm_division = Yii::$app->request->post('sm_division');
        $salary = Yii::$app->request->post('salary');
        $company = Yii::$app->request->post('company');
        $tkp = Yii::$app->request->post('tkp');

        $model->created_at = date('Y-m-d h:i:sa');
        $model->id_user = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->id_letter == 1) {
                $model->id_employee = $employee;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save();
            }
            if ($model->id_letter == 2) {
                $model->id_employee = $employee;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save();
            }
            if ($model->id_letter == 3) {
                $model->id_employee = $employee;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save();
            }
            if ($model->id_letter == 6) {
                $model->id_employee = $employee;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save();
            }
            if ($model->id_letter == 9) {
                $model->id_employee = $employee;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save();
            }

            // Surat Mutasi
            if ($model->id_letter == 4) {
                $model->id_employee = $employee;
                $model->sm_old_position = $sm_position;
                $model->sm_old_division = $sm_division;
                $model->sm_old_company = $company;
                $model->sm_old_tkp = $tkp;
                $model->pr_old_position = null;
                $model->dm_old_position = null;
                $model->act_old_position = null;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save(false);
            }
            // Surat Demosi
            if ($model->id_letter == 5) {
                $model->id_employee = $employee;
                $model->sm_old_position = null;
                $model->sm_old_division = null;
                $model->sm_old_company = null;
                $model->sm_old_tkp = null;
                $model->pr_old_position = null;
                $model->dm_old_position = $dm_position;
                $model->act_old_position = null;
                $model->save(false);
            }
            // Surat Promosi
            if ($model->id_letter == 7) {
                $model->id_employee = $employee;
                $model->pr_old_position = $pr_position;
                $model->pr_old_salary = $salary;
                $model->sm_old_position = null;
                $model->sm_old_division = null;
                $model->sm_old_company = null;
                $model->sm_old_tkp = null;
                $model->dm_old_position = null;
                $model->act_old_position = null;
                $model->save(false);
            }
            // Surat Jabatan
            if ($model->id_letter == 8) {
                $model->id_employee = $employee;
                $model->pr_old_position = null;
                $model->pr_old_salary = null;
                $model->sm_old_position = null;
                $model->sm_old_division = null;
                $model->sm_old_company = null;
                $model->sm_old_tkp = null;
                $model->dm_old_position = null;
                $model->act_old_position = $act_position;
                $model->save(false);
            }
            Yii::$app->getSession()->setFlash('surat_create_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Surat',
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
                Yii::$app->getSession()->setFlash('surat_create_failed', [
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
     * Updates an existing TbEmpAdministration model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $employee = Yii::$app->request->post('employee');
        $sm_position = Yii::$app->request->post('sm_position');
        $dm_position = Yii::$app->request->post('dm_position');
        $pr_position = Yii::$app->request->post('pr_position');
        $act_position = Yii::$app->request->post('act_position');
        $sm_division = Yii::$app->request->post('sm_division');
        $salary = Yii::$app->request->post('salary');
        $company = Yii::$app->request->post('company');
        $tkp = Yii::$app->request->post('tkp');

        $model->created_at = date('Y-m-d h:i:sa');
        $model->id_user = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->id_letter == 1) {
                $model->id_employee = $employee;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save();
            }
            if ($model->id_letter == 2) {
                $model->id_employee = $employee;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save();
            }
            if ($model->id_letter == 3) {
                $model->id_employee = $employee;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save();
            }
            if ($model->id_letter == 6) {
                $model->id_employee = $employee;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save();
            }
            if ($model->id_letter == 9) {
                $model->id_employee = $employee;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save();
            }

            // Surat Mutasi
            if ($model->id_letter == 4) {
                $model->id_employee = $employee;
                $model->sm_old_position = $sm_position;
                $model->sm_old_division = $sm_division;
                $model->sm_old_company = $company;
                $model->sm_old_tkp = $tkp;
                $model->pr_old_position = null;
                $model->dm_old_position = null;
                $model->act_old_position = null;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save(false);
            }
            // Surat Demosi
            if ($model->id_letter == 5) {
                $model->id_employee = $employee;
                $model->sm_old_position = null;
                $model->sm_old_division = null;
                $model->sm_old_company = null;
                $model->sm_old_tkp = null;
                $model->pr_old_position = null;
                $model->dm_old_position = $dm_position;
                $model->act_old_position = null;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save(false);
            }
            // Surat Promosi
            if ($model->id_letter == 7) {
                $model->id_employee = $employee;
                $model->pr_old_position = $pr_position;
                $model->pr_old_salary = $salary;
                $model->sm_old_position = null;
                $model->sm_old_division = null;
                $model->sm_old_company = null;
                $model->sm_old_tkp = null;
                $model->dm_old_position = null;
                $model->act_old_position = null;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save(false);
            }
            // Surat Jabatan
            if ($model->id_letter == 8) {
                $model->id_employee = $employee;
                $model->pr_old_position = null;
                $model->pr_old_salary = null;
                $model->sm_old_position = null;
                $model->sm_old_division = null;
                $model->sm_old_company = null;
                $model->sm_old_tkp = null;
                $model->dm_old_position = null;
                $model->act_old_position = $act_position;
                $model->act_date = null;
                $model->act_date_expired = null;
                $model->save(false);
            }
            Yii::$app->getSession()->setFlash('surat_update_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Surat',
                'message'  => 'Data Berhasil di Edit !',
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
                Yii::$app->getSession()->setFlash('surat_update_failed', [
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
     * Deletes an existing TbEmpAdministration model.
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
     * Finds the TbEmpAdministration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbEmpAdministration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbEmpAdministration::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionSuratPeringatanSatu($id)
    {
        $model = TbEmpAdministration::findOne($id);
        $content = $this->renderPartial('/tb-emp-administration/surat/suratperingatan1', [
                     'model' => $model,
                     'id' => $id,
                     ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 20,
            'marginRight' => 20,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Surat Peringatan 1'],
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);
        $date = date('Y-m-d His');
        $pdf->filename = "Surat Peringatan I - ".$date.".pdf";
        return $pdf->render();
    }
    public function actionSuratPeringatanDua($id)
    {
        $model = TbEmpAdministration::findOne($id);
        $content = $this->renderPartial('/tb-emp-administration/surat/suratperingatan2', [
                     'model' => $model,
                     'id' => $id,
                     ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            'format' => Pdf::FORMAT_LEGAL,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Surat Peringatan'],
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);
        $date = date('Y-m-d His');
        $pdf->filename = "Surat Peringatan II - ".$date.".pdf";
        return $pdf->render();
    }
    public function actionSuratPeringatanTiga($id)
    {
        $model = TbEmpAdministration::findOne($id);
        $content = $this->renderPartial('/tb-emp-administration/surat/suratperingatan3', [
                     'model' => $model,
                     'id' => $id,
                     ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            'format' => Pdf::FORMAT_LEGAL,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Surat Peringatan'],
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);
        $date = date('Y-m-d His');
        $pdf->filename = "Surat Peringatan III - ".$date.".pdf";
        return $pdf->render();
    }
    public function actionSuratPromosi($id)
    {
        $model = TbEmpAdministration::findOne($id);
        $content = $this->renderPartial('/tb-emp-administration/surat/suratpromosi', [
                     'model' => $model,
                     'id' => $id,
                     ]);
        
        $cssInline = <<<CSS
        table {
            *border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .table-pdf td, .table-pdf th {
            padding: 5px;
            border: 1px solid #0000;
            text-align: left;
        }
        .table-pdf th {
            border: 1px solid #0000;
            /* background-color: #eee; */
            text-align: left;
        }
        CSS;

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            'format' => Pdf::FORMAT_LEGAL,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssInline' => $cssInline,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Surat Promosi'],
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);
        $date = date('Y-m-d His');
        $pdf->filename = "Surat Promosi - ".$date.".pdf";
        return $pdf->render();
        // return 'surat promosi';
    }
    public function actionSuratAktingJabatan($id)
    {
        $model = TbEmpAdministration::findOne($id);
        $content = $this->renderPartial('/tb-emp-administration/surat/suratactingjabatan', [
                     'model' => $model,
                     'id' => $id,
                     ]);

        $cssInline = <<<CSS
        table {
            *border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .table-pdf td, .table-pdf th {
            padding: 5px;
            border: 1px solid #0000;
            text-align: left;
        }
        .table-pdf th {
            border: 1px solid #0000;
            /* background-color: #eee; */
            text-align: left;
        }
        CSS;

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            'format' => Pdf::FORMAT_LEGAL,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssInline' => $cssInline,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Surat Akting Jabatan'],
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);
        $date = date('Y-m-d His');
        $pdf->filename = "Surat Akting Jabatan - ".$date.".pdf";
        return $pdf->render();
        // return 'surat akting jabatan';
    }
    public function actionSuratPenetapanJabatan($id)
    {
        $model = TbEmpAdministration::findOne($id);
        $content = $this->renderPartial('/tb-emp-administration/surat/suratpenetapanjabatan', [
                     'model' => $model,
                     'id' => $id,
                     ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            'format' => Pdf::FORMAT_LEGAL,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Surat Penetapan Jabatan'],
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);
        $date = date('Y-m-d His');
        $pdf->filename = "Surat Penetapan Jabatan - ".$date.".pdf";
        return $pdf->render();
        // return 'surat penetapan jabatan';
    }
    public function actionSuratPenetapanDemosi($id)
    {
        $model = TbEmpAdministration::findOne($id);
        $content = $this->renderPartial('/tb-emp-administration/surat/suratpenetapandemosi', [
                     'model' => $model,
                     'id' => $id,
                     ]);

        $cssInline = <<<CSS
        table {
            *border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .table-pdf td, .table-pdf th {
            padding: 5px;
            border: 1px solid #0000;
            text-align: left;
        }
        .table-pdf th {
            border: 1px solid #0000;
            /* background-color: #eee; */
            text-align: left;
        }
        CSS;
        

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            'format' => Pdf::FORMAT_LEGAL,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssInline' => $cssInline,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Surat Penetapan Demosi'],
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);
        
        $date = date('Y-m-d His');
        $pdf->filename = "Surat Penetapan Demosi - ".$date.".pdf";
        return $pdf->render();
        // return 'surat penetapan demosi';
    }
    public function actionSuratMutasi($id)
    {
        $model = TbEmpAdministration::findOne($id);
        $content = $this->renderPartial('/tb-emp-administration/surat/suratmutasi', [
                     'model' => $model,
                     'id' => $id,
                     ]);

        $cssInline = <<<CSS
        table {
            *border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .table-pdf td, .table-pdf th {
            padding: 5px;
            border: 1px solid #0000;
            text-align: left;
        }
        .table-pdf th {
            border: 1px solid #0000;
            /* background-color: #eee; */
            text-align: left;
        }
        CSS;
        

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            'format' => Pdf::FORMAT_LEGAL,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssInline' => $cssInline,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Surat Mutasi Karyawan'],
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);
        
        $date = date('Y-m-d His');
        $pdf->filename = "Surat Mutasi Karyawan - ".$date.".pdf";
        return $pdf->render();
        // return 'surat penetapan demosi';
    }
    public function actionSuratPaklaring($id)
    {
        $model = TbEmpAdministration::findOne($id);
        $content = $this->renderPartial('/tb-emp-administration/surat/suratpaklaring', [
                     'model' => $model,
                     'id' => $id,
                     ]);

        $cssInline = <<<CSS
        table {
            *border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .table-pdf td, .table-pdf th {
            padding: 5px;
            border: 1px solid #0000;
            text-align: left;
        }
        .table-pdf th {
            border: 1px solid #0000;
            /* background-color: #eee; */
            text-align: left;
        }
        CSS;
        

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            'format' => Pdf::FORMAT_LEGAL,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssInline' => $cssInline,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Surat Paklaring'],
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);
        
        $date = date('Y-m-d His');
        $pdf->filename = "Surat Paklaring - ".$date.".pdf";
        return $pdf->render();
        // return 'surat penetapan demosi';
    }
    public function actionSelect($id)
    {
        $employee = TbEmployee::findOne(['id' => $id]);

        return json_encode(array(
                'sm_position' => $employee->position,
                'sm_division' => $employee->department,
                'dm_position' => $employee->position,
                'pr_position' => $employee->position,
                'act_position' => $employee->position,
                'salary' => $employee->salary,
                'company' => $employee->id_company,
                'tkp' => $employee->id_tkp,
            )
        );
    }
}
