<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="table-responsive table-nowrap">
    <!-- <p> -->
        <h5>Foto Product</h5>
        <?php
        $image = $model['image'] && is_file(Yii::getAlias('@webroot') . $model['image']) ? $model['image'] : '../images/no_photo.jpg';
        echo Html::img(Url::base().$image, ['height' => '150', 'width' => '300']);
        ?>
    <!-- </p> -->
    <p>
        <h5>Jenis Product</h5>
        <?= $in_type['name'] ?>
    </p>

    <!-- Tabel Products Ingredients -->
    <p>
        <h5>Bahan-Bahan Pembuatan</h5>
            <?php echo $pro_ingredients['qty'] ?>
            <?php foreach ($ingredients as $value) {
                echo $value->name;
            }
            ?>
    </p>
    <!-- Tabel MR Ingredients -->
    <p>
        <h5>Supplier</h5>
        <?php foreach ($ingredients as $value) {
        echo $value->id_supplier;
    }
    ?>
    </p>
    <p>
        <h5>Unit</h5>
        <?php foreach ($ingredients as $value) {
            echo $value->id_in_unit;
            }
        ?>
    </p>    
</div>