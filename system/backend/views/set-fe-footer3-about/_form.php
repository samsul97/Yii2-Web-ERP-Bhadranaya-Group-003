<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeFooter3About */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="set-fe-footer3-about-form">

    <?php $form = ActiveForm::begin(['id' => 'formSubmit']); ?>

    <?= $form->field($model, 'desc')->widget(CKEditor::className(), [
		'options' => ['rows' => 6],
		'preset' => 'full'
	]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
// $urlTrace = Url::to(['set-fe-footer3-about/update?id=1']);
$js = <<< JS
$('#formSubmit').on("submit",function(e){
      var formData = new FormData(this);
      var formURL = $("#formSubmit").attr("action");
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
    //   e.preventDefault();
    //   e.unbind();
  });
JS;

$this->registerJs($js);
?>