<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CLetter */

$this->title = 'Create Cletter';
$this->params['breadcrumbs'][] = ['label' => 'Cletters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cletter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
