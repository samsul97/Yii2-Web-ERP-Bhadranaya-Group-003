<?php

namespace backend\controllers;

use backend\models\Model;
use backend\models\Tbinvpochild;
use backend\models\Tbinvpoin;
use Yii;
use backend\models\Tbinvpoparent;
use backend\models\TbinvpoparentSearch;
use kartik\mpdf\Pdf;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TbinvpoparentController implements the CRUD actions for Tbinvpoparent model.
 */
class TbinvpoparentController extends Controller
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
     * Lists all Tbinvpoparent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbinvpoparentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $level = Yii::$app->user->identity->level;
        $inv = Yii::$app->user->identity->id;
        
        if ($level) {
            $dataProvider->query->andWhere(['tbinvpoparent.id_user' => $inv]);
        }

        if ($level == '6fb4f22992a0d164b77267fde5477248') {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        if ($level == '0fe808a4a397918a63827606c08b8461') {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tbinvpoparent model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // $modelParent = new Tbinvpoparent();
        // $modelChild = new Tbinvpochild();
        // $modelPoin = new Tbinvpoin();

        // $modelPoAnak = Tbinvpochild::find()->where(['id_inv_po_parent' => $id])->asArray()->all();
        // $modelPoInv = Tbinvpoin::find()->where(['id_inv_po_child' => $modelChild->id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            // 'modelPoAnak' => $modelPoAnak,
            // 'modelPoInv' => $modelPoInv,
        ]);
    }

    /**
     * Creates a new Tbinvpoparent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelParent = new Tbinvpoparent;
        $modelsChild = [new Tbinvpochild];
        $modelsInv = [[new Tbinvpoin]];

        if ($modelParent->load(Yii::$app->request->post())) {

            $modelsHouse = Model::createMultiple(Tbinvpochild::classname());
            echo $modelsHouse;
            die;
            Model::loadMultiple($modelsHouse, Yii::$app->request->post());

            // validate person and houses models
            $valid = $modelParent->validate();
            $valid = Model::validateMultiple($modelsHouse) && $valid;

            if (isset($_POST['Tbinvpoin'][0][0])) {
                foreach ($_POST['Tbinvpoin'] as $indexHouse => $rooms) {
                    foreach ($rooms as $indexRoom => $room) {
                        $data['Tbinvpoin'] = $room;
                        $modelRoom = new Tbinvpoin;
                        $modelRoom->load($data);
                        $modelsRoom[$indexHouse][$indexRoom] = $modelRoom;
                        $valid = $modelRoom->validate();
                    }
                }
            }

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelParent->save(false)) {
                        foreach ($modelsHouse as $indexHouse => $modelHouse) {

                            if ($flag === false) {
                                break;
                            }

                            $modelHouse->id_inv_po_parent = $modelParent->id;

                            if (!($flag = $modelHouse->save(false))) {
                                break;
                            }

                            if (isset($modelsRoom[$indexHouse]) && is_array($modelsRoom[$indexHouse])) {
                                foreach ($modelsRoom[$indexHouse] as $indexRoom => $modelRoom) {
                                    $modelRoom->id_inv_po_child = $modelHouse->id;
                                    if (!($flag = $modelRoom->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelParent->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (NotFoundHttpException $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelParent' => $modelParent,
            'modelsChild' => (empty($modelsChild)) ? [new Tbinvpochild] : $modelsChild,
            'modelsInv' => (empty($modelsInv)) ? [[new Tbinvpoin]] : $modelsInv,
        ]);
    }

    /**
     * Updates an existing Tbinvpoparent model.
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
     * Deletes an existing Tbinvpoparent model.
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
     * Finds the Tbinvpoparent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tbinvpoparent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tbinvpoparent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionTravelDocument($id)
    {
        // echo "surat jalan TKP";
        $model = Tbinvpoparent::findOne($id);
        $content = $this->renderPartial('/tbinvpoparent/print/suratjalan', [
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
            'options' => ['title' => 'Surat Jalan'],
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);
        $date = date('Y-m-d His');
        $pdf->filename = "Surat Jalan - ".$date.".pdf";
        return $pdf->render();
    }
}
