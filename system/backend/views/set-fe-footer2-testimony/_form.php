<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeFooter2Testimony */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="set-fe-footer2-testimony-form">

    <?php $form = ActiveForm::begin([
        'id' => 'formPhoto',
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="row">
        <div class="col-lg-6">
            <?php
                $image = $model->photo && is_file(Yii::getAlias('@webroot') . $model->photo) ? $model->photo : '/images/no_photo.jpg';
            ?>
            <?= $form->field($model, 'photo', [
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
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<< JS
$('#setfefooter2testimony-photo').on('change', function(e) {
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

$('#formPhoto').on("submit",function(e){
      var formData = new FormData(this);
      var formURL = $("#formPhoto").attr("action");
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
                text: "Data berhasil ditambah",
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
?>