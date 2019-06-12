<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\CLetter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cletter-form">

    <?php 
    $form = ActiveForm::begin([
		'id' => 'cletter-form',
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
<div>
<?= $form->field($model, 'name', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('name')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('name').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>


</div>    

<div>

    
</div> 

<?php 
echo $form->field($model, 'caid')->widget(Select2::classname(), [
    'data' => $model->getCaidList(),
    'language' => 'th',
    'options' => ['placeholder' => ' เลือกประเภทหนังสือ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label(false);

?>

<div class="row">

</div>


<div>
<?php
echo $form->field($model, 'file')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
]);
?>
<?php
// echo $form->field($model, 'file',[
//    'inputOptions' => [
//         'placeholder' => $model->getAttributeLabel('file'),
//         'onchange'=>'this.parentNode.nextSibling.value = this.value'
//     ],
//     'template' => '<section><label class="label">{label}</label><div class="input input-file"><span class="button">{input}Browse</span><input type="text" placeholder="Include some files" readonly=""><div class="invalid">{error}{hint}</div></div></section>'
// ])->fileInput()->label(false) 
?>
</div>
<?php 
if (!empty($model->file)){
    $filename = Url::to('@webroot/uploads/cletter/').$model->file;
    if (file_exists($filename)) {
        echo Url::to('@web/uploads/cletter/').$model->file;
        // echo Html::img('@web/uploads/cletter/'.$model->file, ['alt' => 'My pic','class'=>'img-thumbnail']);
        // unlink($filename);
    }
    
}
?>


<fieldset class="text-right"> 
<?= Html::resetButton('Reset', ['class' => 'btn btn-warning btn-lg']) ?> <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-lg']) ?>

    <?php ActiveForm::end(); ?>
</fieldset>
</div>
