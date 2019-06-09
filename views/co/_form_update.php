<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<?php    
    //print_r(count(explode(',',$model->tel)));
?>
<?php 
    $form = ActiveForm::begin([
		'id' => 'contact-form',
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
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">กรอกชื่อ</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>


</div>    

<div>
<?= $form->field($model, 'dep',[
    'template' => '<section><label class="select">{label}{input}</label><i class="icon-append fa fa-user"></i></label><em for="dep" class="invalid">{error}{hint}</em></section>'
    ])->dropDownList($model->getDep(),['prompt'=>'เลือกตำแหน่ง'])->label(false);?>
</div> 



<div class="">
<?= $form->field($model, 'email', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('email')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-envelope-o"></i>{input}<b class="tooltip tooltip-top-right">กรอก E-mail</b></label><em for="email" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>
</div>
<div class="">
<?php //for ($x = 0; $x <= count(explode(',',$model->tel))-1; $x++) { ?>
<?= $form->field($model, 'tel', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('tel')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-prepend fa fa-phone"></i>{input}<b class="tooltip tooltip-top-right">กรอกเบอร์โทรศัพท์</b></label><em for="tel" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
?>
<?php//  } ?>
</div>

<?= $form->field($model, 'address', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('address')
    ],
    'template' => '<section><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">กรอกที่อยู่</b></label><em for="email" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>
 

<?= $form->field($model, 'comment', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('conment'),
        'rows'=>'5',
    ],
    'template' => '<section><label class="textarea">{label}<i class="icon-append fa fa-comment"></i>{input}<b class="tooltip tooltip-top-right">หมายเหตุ</b></label><em for="email" class="invalid">{error}{hint}</em></section>'
    ])->textarea()->label(false);
    ?>

<div>
<?= $form->field($model, 'photo',[
   'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('photo'),
        'onchange'=>'this.parentNode.nextSibling.value = this.value'
    ],
    'template' => '<section><label class="label">{label}</label><div class="input input-file"><span class="button">{input}Browse</span><input type="text" placeholder="Include some files" readonly=""><div class="invalid">{error}{hint}</div></div></section>'
])->fileInput() ?>
</div>
<?php 
if (!empty($model->photo)){
    $filename = Url::to('@webroot/uploads/contact/').$model->photo;
    if (file_exists($filename)) {
        //echo Url::to('@web/uploads/contact/').$model->photo;
        echo Html::img('@web/uploads/contact/'.$model->photo, ['alt' => 'My pic','class'=>'img-thumbnail']);
        // unlink($filename);
    }
    
}
?>
<fieldset>


<fieldset class="text-right"> 
<?= Html::resetButton('Reset', ['class' => 'btn btn-warning btn-lg']) ?> <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-lg']) ?>
</fieldset> 
    <?php ActiveForm::end(); ?>

</fieldset>
<?php
$script = <<< JS
console.log(11);
$(document).ready(function() {	

});
JS;
$this->registerJs($script);
?>