<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ProductCatalog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-catalog-form">

    <?php 
    $form = ActiveForm::begin([
		'id' => 'product-form',
		'options' => [
            'class' => 'smart-form',
            'novalidate'=>'novalidate',
            'enctype' => 'multipart/form-data'
        ],
        //'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "{label}{input}{error}",
            'labelOptions' => ['class' => 'label'],
        ],
        'enableAjaxValidation' => true,
	]);  ?>

<fieldset> 
    
<div class="row">
<?= $form->field($model, 'name_catalog', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('name_catalog')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('name_catalog').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>
</div>

<div class="row">
    <?= $form->field($model, 'order', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('order')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('order').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>
</div>
    
</fieldset> 
    <footer>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </footer>

    <?php ActiveForm::end(); ?>

</div>
