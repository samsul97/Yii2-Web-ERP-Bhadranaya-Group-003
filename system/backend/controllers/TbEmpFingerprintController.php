<?php

namespace backend\controllers;

use Yii;
use backend\models\TbEmpFingerprint;
use backend\models\TbEmpFingerprintSearch;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

/**
 * TbEmpFingerprintController implements the CRUD actions for TbEmpFingerprint model.
 */
class TbEmpFingerprintController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TbEmpFingerprint models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbEmpFingerprintSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbEmpFingerprint model.
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
     * Creates a new TbEmpFingerprint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbEmpFingerprint();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TbEmpFingerprint model.
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
     * Deletes an existing TbEmpFingerprint model.
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
     * Finds the TbEmpFingerprint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbEmpFingerprint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbEmpFingerprint::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionImport()
    {
        $modelImport = new \yii\base\DynamicModel([
            'fileImport' => 'File Import',
        ]);

        $modelImport->addRule(['fileImport'], 'required');
        $modelImport->addRule(['fileImport'], 'file', ['extensions' => 'xls,xlsx']);

        if (Yii::$app->request->post()) {
            ini_set('max_execution_time', 600);
            $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport, 'fileImport');
            
            
            if ($modelImport->fileImport) {
                // $reader = new Xlsx();
                // $reader->setReadDataOnly(true);
                // $spreadsheet = $reader->load($modelImport->fileImport->tempName);
                // $sheetData = $spreadsheet->getActiveSheet()->toArray([1]);
                // $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                // $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                
                $inputFileType = IOFactory::identify($modelImport->fileImport->tempName);
                
                $objReader = IOFactory::createReader($inputFileType);
                
                $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(true,true,true,true);
                
                $baseRow = 2;
                while(!empty($sheetData[$baseRow]['A'])){
                    $model = new TbEmpFingerprint();

                    $model->empnum = (string)$sheetData[$baseRow]['A'];
                    
                    $model->noid = (string)$sheetData[$baseRow]['B'];

                    $model->nik = (string)$sheetData[$baseRow]['C'];

                    $model->name = (string)$sheetData[$baseRow]['D'];
                    
                    $model->timestamp = (string)$sheetData[$baseRow]['E'];
                    
                    $model->checkin = (string)$sheetData[$baseRow]['F'];
                    
                    $model->checkout = (string)$sheetData[$baseRow]['G'];
                    
                    $model->checkin2 = (string)$sheetData[$baseRow]['H'];
                    
                    $model->checkout2 = (string)$sheetData[$baseRow]['I'];
                    
                    $model->checkin3 = (string)$sheetData[$baseRow]['J'];
                    
                    $model->checkout3 = (string)$sheetData[$baseRow]['K'];
                    
                    $model->checkin4 = (string)$sheetData[$baseRow]['L'];
                    
                    $model->checkout4 = (string)$sheetData[$baseRow]['M'];
                    
                    $model->checkin5 = (string)$sheetData[$baseRow]['N'];
                    
                    $model->checkout5 = (string)$sheetData[$baseRow]['O'];
                    
                    $model->total_hours = (string)$sheetData[$baseRow]['P'];
                    // var_dump($model->total_hours);
                    // die;
                    $model->save();
                    $baseRow++;
                }
                // Yii::$app->getSession()->setFlash('success', 'Success');

                Yii::$app->getSession()->setFlash('fingerprint_create_success', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Created !',
                ]);

                return $this->redirect(['index']);
            }
            $message = 'Error';
            Yii::$app->getSession()->setFlash('user_create', [
                'type'     => 'error',
                'duration' => 5000,
                'title'  => 'Error',
                'message'  => $message,
            ]);
            // Yii::$app->getSession()->setFlash('error', 'Error');
        }
        return $this->render('import', [
            'modelImport' => $modelImport,
        ]);
    }
}
