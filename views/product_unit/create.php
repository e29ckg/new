<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductUnit */

$this->title = 'Create Product Unit';
$this->params['breadcrumbs'][] = ['label' => 'Product Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
