<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\profile */

$this->title = 'Update Profile: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->fname.$model->name.' '.$model->sname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
