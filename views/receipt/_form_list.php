<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Product;
use app\models\ProductUnit;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="receiptlist-form">

    <?php $form = ActiveForm::begin([
		'id' => 'receiptlist-form',
		
        'enableAjaxValidation' => false,
	]); ?>


    <?php 
        echo $form->field($model, 'product_code', ['options' => ['class' => '']])->widget(Select2::classname(), ['data' => $model->getProductList(), 'options' => ['placeholder' => 'select ...'], 'pluginOptions' => ['allowClear' => true]]);
    ?>
        <a href= "index.php?r=product/create" class="btn btn-warning btn-xs act-update"><i class="fa fa-pencil-square-o"></i> เพิ่มชื่อสินค้าใหม่(กรณีค้นหาไม่พบ)</a>
    
    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'create_at')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
