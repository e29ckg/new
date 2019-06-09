<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
						
<?php 
$fieldOptions1 = [
    'options' => ['class' => ''],
    'inputTemplate' => "<label class=\"input\"><i class=\"icon-append fa fa-user\"></i>{input}\n<b class=\"tooltip tooltip-top-right\"><i class=\"fa fa-user txt-color-teal\"></i> Please enter email address/username</b><label>"
];

$fieldOptions2 = [
    //'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "<label class=\"input\"><i class=\"icon-append fa fa-lock\"></i>{input}\n<b class=\"tooltip tooltip-top-right\"><i class=\"fa fa-lock txt-color-teal\"></i> Please enter password</b><label>"
];

 
?>
<?php 
    $form = ActiveForm::begin([
		'id' => 'login-form',
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
<header>Sign In</header>
	<fieldset>
		<section>
            <?= $form->field($model, 'username', $fieldOptions1)->textInput(['autofocus' => true,])?>
		</section>
		<section>
            <?= $form->field($model, 'password', $fieldOptions2)->passwordInput() ?>			
		    <div class="note"><a href="forgotpassword.html">Forgot password?</a></div>
		</section>
		<div>
    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
</div>
        <?= $form->field($model, 'rememberMe')->checkbox([
			'template' => "<section><label class=\"checkbox\">{input}<i></i>Remember Me</label></section>",	
		]) 
		?>
	</fieldset>
        <footer>
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>            
        </footer>

<?php ActiveForm::end(); ?>

