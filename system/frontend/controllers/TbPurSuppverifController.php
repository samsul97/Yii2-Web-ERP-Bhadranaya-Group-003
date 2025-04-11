<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TbPurSuppverif;
use frontend\models\TbPurSuppverifSearch;
use frontend\models\TbPurSuppvletter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseStringHelper;
use yii\web\UploadedFile;

/**
 * TbPurSuppverifController implements the CRUD actions for TbPurSuppverif model.
 */
class TbPurSuppverifController extends Controller
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
     * Lists all TbPurSuppverif models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $searchModel = new TbPurSuppverifSearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    //     return $this->render('index', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    /**
     * Displays a single TbPurSuppverif model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionView($id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    /**
     * Creates a new TbPurSuppverif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbPurSuppverif();

        $model->created_at = date('Y-m-d');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // $code_digit  = 3;
            // $code_company    = 'HBG';
            // $code_model  = TbPurSuppverif::find()->where(['LIKE', 'no_vendor', $code_company])->max('no_vendor');
            // $code_init   = (int) BaseStringHelper::byteSubstr($code_model, strlen($code_company), strlen($code_company) + $code_digit);
            // $code_seq    = str_pad($code_init + 1 , $code_digit, '0', STR_PAD_LEFT);
            // $code_vendor = $code_company . $code_seq;
            // $model->no_vendor = $code_vendor;
            $cek = 'HBG-'. date('dm');
            $model->no_vendor = $cek. Yii::$app->security->generateRandomString(3);

            $image1 = UploadedFile::getInstance($model, 'img_nib');
            if ($image1)
            {
                $file = Yii::$app->params['frontend'] . 'img_dynamic/tb_pur_suppverif/img_nib/' . $model->no_vendor . '.' . $image1->extension;
                $path = Yii::getAlias('@webroot') . $file;
                // var_dump($path);
                // die;
                $image1->saveAs($path);
                $model->img_nib = $file;
            }
            // if(empty($image1)) {
            //     $message = 'Semua berkas wajib di isi';
            //         Yii::$app->getSession()->setFlash('image1_required', [
            //             'type'     => 'error',
            //             'duration' => 5000,
            //             'title'  => 'Error',
            //             'message'  => $message,
            //         ]
            //     );
            //     return $this->redirect(['create']);
            // }
            $image2 = UploadedFile::getInstance($model, 'img_npwp');
            if ($image2)
            {
                $file = Yii::$app->params['frontend'] . 'img_dynamic/tb_pur_suppverif/img_npwp/' . $model->no_vendor . '.' . $image2->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image2->saveAs($path);
                $model->img_npwp = $file;
            }
            if(empty($image2)) {
                $message = 'Foto NPWP wajib di isi';
                    Yii::$app->getSession()->setFlash('image2_required', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
                return $this->redirect(['create']);
            }
            $image3 = UploadedFile::getInstance($model, 'img_directur');
            if ($image3)
            {
                $file = Yii::$app->params['frontend'] . 'img_dynamic/tb_pur_suppverif/img_directur/' . $model->no_vendor . '.' . $image3->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image3->saveAs($path);
                $model->img_directur = $file;
            }
            if(empty($image3)) {
                $message = 'Foto Direktur wajib di isi';
                    Yii::$app->getSession()->setFlash('image1_required', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
                return $this->redirect(['create']);
            }
            $offer = UploadedFile::getInstance($model, 'offering_letter');
            if ($offer)
            {
                $file = Yii::$app->params['frontend'] . 'file/tb_pur_suppverif/offering_letter/' . $model->no_vendor . '.' . $offer->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $offer->saveAs($path);
                $model->offering_letter = $file;
            }
            if(empty($offer)) {
                $message = 'Surat Penawaran wajib di isi';
                    Yii::$app->getSession()->setFlash('offer_required', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
                return $this->redirect(['create']);
            }
            $sk_menkeh = UploadedFile::getInstance($model, 'sk_menkeh');
            if ($sk_menkeh)
            {
                $file = Yii::$app->params['frontend'] . 'file/tb_pur_suppverif/sk_menkeh/' . $model->no_vendor . '.' . $sk_menkeh->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $sk_menkeh->saveAs($path);
                $model->sk_menkeh = $file;
            }
            // if(empty($sk_menkeh)) {
            //     $message = 'Semua berkas wajib di isi';
            //         Yii::$app->getSession()->setFlash('skmenkeh_required', [
            //             'type'     => 'error',
            //             'duration' => 5000,
            //             'title'  => 'Error',
            //             'message'  => $message,
            //         ]
            //     );
            //     return $this->redirect(['create']);
            // }
            

            // Yii::$app->mailer->compose('@common/mail/vendor',['model' => $model])
            //     ->setFrom('vendor@holycowsteak.com')
            //     ->setTo(array('it@holycowsteak.com', 'syifasarini@holycowsteak.com', 'dyanidarwis@holycowsteak.com', 'wyndamardio@holycowsteak.com'))
            //     // ->setToCc()
            //     ->setSubject('Surat Penawaran Vendor')
            //     ->send();

            Yii::$app->getSession()->setFlash('vendorverif_create_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Data Vendor',
                'message'  => 'Data Berhasil ditambah !',
            ]);

            $model->save();
            return $this->redirect(['aftercreate', 'id' => $model->id]);
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
                Yii::$app->getSession()->setFlash('vendorverif_create_failed', [
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
     * Updates an existing TbPurSuppverif model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing TbPurSuppverif model.
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
     * Finds the TbPurSuppverif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbPurSuppverif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbPurSuppverif::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAftercreate()
    {
        return $this->render('aftercreate');
    }
    public function actionLetter($novendor)
    {
        $vendor = TbPurSuppverif::findOne($novendor);
        return json_encode(array(
            'name' => $vendor->name,
            'date' => $vendor->created_at,
        ));
    }
    public function actionOfferletter() {
        $model = new TbPurSuppvletter();
        $model->created_at = date('Y-m-d');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $novendor_validate = TbPurSuppverif::find()->where(['no_vendor' => $model->no_vendor])->one();
            // echo '<pre>';
            // var_dump($novendor_validate);
            // die;
            // $check = $model->no_vendor != $novendor_validate;
            
            if ($novendor_validate == NULL) {
                $message = 'No vendor tidak ada';
                    Yii::$app->getSession()->setFlash('letter_nothing', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
                return $this->redirect(['offerletter']);
            }

            $offer = UploadedFile::getInstance($model, 'offering_letter');
            if ($offer)
            {
                $file = Yii::$app->params['frontend'] . 'file/tb_pur_suppverif/offering_letter/' . $model->no_vendor . '.' . $offer->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $offer->saveAs($path);
                $model->offering_letter = $file;
            }
            if(empty($offer)) {
                $message = 'Berkas wajib di isi';
                    Yii::$app->getSession()->setFlash('offer_required', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
                return $this->redirect(['offerletter']);
            }
            Yii::$app->getSession()->setFlash('letter_create_success', [
                'type'     => 'success',
                'duration' => 5000,
                'title'    => 'Surat Penawaran',
                'message'  => 'Data Berhasil ditambah !',
            ]);

            $model->save();
            return $this->redirect(['aftercreate', 'id' => $model->id]);
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
                Yii::$app->getSession()->setFlash('letter_create_failed', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('letter_create', [
            'model' => $model,
        ]);
    }
}
