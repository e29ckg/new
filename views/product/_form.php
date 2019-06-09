<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */

//var_dump($catalogList);
?>

<div class="product-form">

    <?php 
    $form = ActiveForm::begin([
		'id' => 'product-form',
		'options' => [
            // 'class' => 'smart-form',
            'novalidate'=>'novalidate',
            'enctype' => 'multipart/form-data'
        ],
        //'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}{input}{error}",
            // 'labelOptions' => ['class' => 'label'],
        ],
        // 'enableAjaxValidation' => true,
	]);  ?>

<fieldset>     

<?= $form->field($model, 'product_name')->textInput()->hint('ass')->label();?>
 
<?php 
        echo $form->field($model, 'category', ['options' => ['class' => '']])->widget(Select2::classname(), ['data' => $model->getCatalogList(), 'options' => ['placeholder' => 'select ...'], 'pluginOptions' => ['allowClear' => true]]);
    ?>
<a href= "index.php?r=product_catalog/create" class=" act-update"><i class="fa fa-pencil-square-o"></i> เพิ่มประเภทสินค้า(กรณีค้นหาไม่พบ)</a>

 <?php 
        echo $form->field($model, 'unit', ['options' => ['class' => '']])->widget(Select2::classname(), ['data' => $model->getUnitList(), 'options' => ['placeholder' => 'select ...'], 'pluginOptions' => ['allowClear' => true]]);
    ?>
<a href= "index.php?r=product_unit/create" class="act-update"><i class="fa fa-pencil-square-o"></i> เพิ่มหน่วยนับ(กรณีค้นหาไม่พบ)</a>
    
<?= $form->field($model, 'Description')->label();?>

<?= $form->field($model, 'location')->label();?>

<?= $form->field($model, 'status')->dropDownList(['1' => '1'],['prompt'=> $model->getAttributeLabel('status')])->label();?>

<?= $form->field($model, 'lower')->label();?>
    
<?= $form->field($model, 'create_at')->hiddenInput()->label(false); ?>
    
<div>
<?= $form->field($model, 'img')->fileInput() ?>
</div>
<?php 
if (!empty($model->img)){
    $filename = Url::to('@webroot/uploads/product/img/').$model->img;
    if (file_exists($filename)) {
        //echo Url::to('@web/uploads/contact/').$model->img;
        echo Html::img('@web/uploads/product/img/'.$model->img, ['alt' => 'My pic','class'=>'img-thumbnail']);
        // unlink($filename);
    }
    
}
?>
</fieldset> 
    <footer>
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </footer>

    <?php ActiveForm::end(); ?>

</div>
