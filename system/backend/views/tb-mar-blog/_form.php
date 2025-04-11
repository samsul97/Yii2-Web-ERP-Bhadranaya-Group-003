<?php

use backend\models\MrBlogCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\TbMarBlog */
/* @var $form yii\widgets\ActiveForm */
$select_category = ArrayHelper::map(MrBlogCategory::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
?>

<div class="tb-mar-blog-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'id_blog_category')->widget(Select2::classname(),[
                'data' => $select_category,
                'options' => [
                    'placeholder' => 'Pilih Kategori',
                    'value' => $model->isNewRecord ? 0 : $model->id_blog_category,
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]);
        ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'contents')->textarea(['rows' => 6]) ?>
        
        </div>

        <div class="col-lg-6">
        
        <?php
            $image = $model->image && is_file(Yii::getAlias('@webroot') . $model->image) ? $model->image : '/images/no_photo_box.jpg';
        ?>
        <?= $form->field($model, 'image', [
                'template' => '
                {label}
                <div id="preview">
                <img id="img-preview" src="'. Url::base() . $image .'" alt="assets image" />
                </div>
                {input}
                {error}',
            ])->fileInput(['accept' => 'image/*'])
        ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<< JS

$('#tbmarblog-image').on('change', function(e) {
    e.preventDefault();
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#img-preview').attr('src', '$image');
    }
}

JS;

$css = <<< CSS

#preview {
    border: 1px solid #ddd;
    padding: 20px;
    margin: 0 0 20px;
}

#preview img {
    width: 100%;
    max-height: 220px;
}

CSS;

$this->registerJs($js);
$this->registerCss($css);
