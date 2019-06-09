<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php 
$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "<div class=\"form-group has-feedback\">{input}<span class=\"glyphicon glyphicon-envelope form-control-feedback\"></span></div>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "<label class=\"input\"><i class=\"icon-append fa fa-lock\"></i>{input}\n<b class=\"tooltip tooltip-top-right\"><i class=\"fa fa-lock txt-color-teal\"></i> Please enter password</b><label>"
];

 
?>


    <?php 
    $form = ActiveForm::begin([
		'id' => 'login-form',
		'options' => [
            'class' => '',
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




    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>


