<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
//use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <link rel="shortcut icon" href="<?= Yii::getAlias('@web').'/frontend/img_static/holy_logo.png' ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    // NavBar::begin([
    //     'brandLabel' => Yii::$app->name,
    //     'brandUrl' => Yii::$app->homeUrl,
    //     'options' => [
    //         'class' => 'navbar navbar-expand-lg navbar-dark bg-primary navbar-fixed-top',
    //     ],
    // ]);
    $menuItems = [
        // ['label' => 'Login', 'url' => ['/tb-pur-suppverif/create']],
        // ['label' => 'About', 'url' => ['/site/about']],
        // ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        // $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        // $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    // echo Nav::widget([
    //     'options' => ['class' => 'navbar-nav navbar-right'],
    //     'items' => $menuItems,
    // ]);
    // NavBar::end();
    ?>

    <div class="container">
        
        <!-- <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?> -->
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?php //date('Y') ?></p>
        <p class="pull-right">Powered By Holycow Bhadranaya Group</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
<script type="text/javascript">
/* Animated Loading */
jQuery(window).on('load', function() { $('.loadingin').fadeOut(1000); });
</script>
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
        $title = !empty($message["title"]) ? $message["title"]: "Title Not Set!";
        $text  = !empty($message["message"]) ? $message["message"] : "Message Not Set!";
        $type  = !empty($message["type"]) ? $message["type"] : "error";
        $timer = !empty($message["duration"]) ? $message["duration"] : 3000;
    ?>
    <script>
        jQuery(document).ready(function(e) {
            swal.fire({
                title: '<?=$title?>',
                text: '<?=$text?>',
                icon: '<?=$type?>',
                timer: <?=$timer?>,
                showCancelButton: false,
                showConfirmButton: true
            });
        });
    </script>
<?php endforeach; ?>
</html>
<?php $this->endPage() ?>
