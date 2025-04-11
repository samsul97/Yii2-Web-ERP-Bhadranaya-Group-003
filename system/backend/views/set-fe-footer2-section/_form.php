<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;
use yii\helpers\url;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeFooter2Section */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="set-fe-footer2-section-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'id' => 'formImage']); ?>
    <div class="row">
        <div class="col-lg-6">
            <?php
                $image = $model->group_logo && is_file(Yii::getAlias('@webroot') . $model->group_logo) ? $model->group_logo : '/images/no_photo_box.jpg';
            ?>
            <?= $form->field($model, 'group_logo', [
                    'template' => '
                    {label}
                    <div id="preview">
                    <img id="img-preview" src="'. Url::base() . $image .'" alt="user image" />
                    </div>
                    {input}
                    {error}',
                ])->fileInput(['accept' => 'image/*'])
            ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'section_color')->widget(ColorInput::classname(), [
                'options' => ['placeholder' => 'Select color ...'],
                ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
// $urlLoc = Url::to(['set-fe-footer2-section/update?id=1']);
$js = <<< JS
$('#setfefooter2section-group_logo').on('change', function(e) {
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

$('#formImage').on("submit",function(e){
      var formData = new FormData(this);
      var formURL = $("#formImage").attr("action");
      $.ajax(
      {
          url : formURL,
          type: "POST",
          data : formData,
          contentType: false,
          processData: false,
          success:function(data, textStatus, jqXHR) 
          {
            swal.fire({
                title: "Success!",
                text: "Data berhasil diedit",
                icon: "success",
                timer: 1000,
            });
          },
          error: function(jqXHR, textStatus, errorThrown) 
          {
            swal.fire("Error!", "Data gagal diedit", "error");
          }
      });
  });
JS;

$css = <<< CSS

#preview {
    border: 1px solid #ddd;
    padding: 20px;
    margin: 0 0 20px;
}

#preview img {
    width: 100%;
    max-height: 250px;
}

CSS;

$this->registerJs($js);
$this->registerCss($css);