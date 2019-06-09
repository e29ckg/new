<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductCatalog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-catalog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!-- <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary',]) ?> -->
        <?= Html::a('แก้ไข', '#', ['class' => 'btn btn-warning act-update','data-id'=> $model->id]) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_catalog',
            'order',
            'detail_catalog',
        ],
    ]) ?>

</div>
<?php
$script = <<< JS
 
$(document).ready(function() {	
    var url_update = "index.php?r=product_catalog/update";
    	$(".act-update").click(function(e) {        
			var fID = $(this).data("id");
        	$.get(url_update,{id: fID},function (data){
            	$("#activity-modal").find(".modal-body").html(data);
            	$(".modal-body").html(data);
            	$(".modal-title").html("แก้ไขข้อมูลสมาชิก");
            	$("#activity-modal").modal("show");
        	});
    	}); 
        		
});
JS;
$this->registerJs($script);
?>