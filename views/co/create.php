<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = 'Create Contact';
$this->params['breadcrumbs'][] = ['label' => 'Contact', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-body no-padding">
    <header>
        <H1><?= Html::encode($this->title) ?></H1>
	</header>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
