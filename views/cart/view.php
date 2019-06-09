<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Contact', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <a herf= "#" class="btn btn-warning act-update" data-id="<?=$model->id?>"<i class="fa fa-pencil-square-o"></i> แก้ไข</a>
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
            'name',
            'tel'
        ],
    ]) ?>

</div>

<?php
$script = <<< JS
   
$(document).ready(function() {	
    var url_update = "index.php?r=co/update";
    	$(".act-update").click(function(e) {  
            // $("#myModal").modal("toggle"); 
            // $("#myModal").modal("hide");         
			var fID = $(this).data("id");
			// alert(fID);
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
