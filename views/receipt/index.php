<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบรับของเข้าสต๊อก';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$this->title?></h3>			  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="receipt-index" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
				          <th>Code</th>
				          <th>ผู้นำเข้าระบบ</th>
				          <th>ราคารวม</th>
                  <th>สถานะ(s)</th>
                  <th>วัน-เวลา</th>
                  <th>เครื่องมือ</th>
                </tr>
                </thead>
                <tbody>
                                  
				<?php foreach ($models as $model): ?>
				<tr>
				<td><?=$model->id?></td>
					<td><a href= "#" class="act-view" data-id='<?=$model->id?>'><?=$model->receipt_code?></a></td>
                  	<td><?=$model->getProfileName()?></td>
                  	<td><?=$model->sumtotal?></td>
					          <td><?=$model->status?></td>
                  	<td><?=$model->create_at?></td>
                    <td><a href="index.php?r=receipt/print&id=<?=$model->id?>" target="_blank">พิมพ์ใบนำเข้า</a>
                    <a href= "index.php?r=receipt/update&id=<?=$model->id?>" class="btn btn-warning "><i class="fa fa-pencil-square-o"></i> แก้ไข</a>
                    <a href= "index.php?r=receipt/update_list_cancel&id=<?=$model->id?>" class="btn btn-warning " onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-pencil-square-o"></i> ยกเลิก</a>
											</td>
                  	<!-- <td><a herf= "#" class="btn btn-warning act-update" data-id=<?=$model->id?>><i class="fa fa-pencil-square-o"></i> แก้ไข</a>
						<?php 
							// echo Html::a('<i class="fa fa-remove"></i> ลบ',['product/delete','id' => $model->id],
							// [
							// 	'class' => 'btn btn-danger act-update',
							// 	'data-confirm' => 'Are you sure to delete this item?',
                        	// 	'data-method' => 'post',
							// ]);
						?>
					</td> -->
				</tr>
				<?php  endforeach; ?>
				</tbody>
                <!-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
 


<?php
$script = <<< JS

	var url_update = "index.php?r=order/update";
    	$(".act-update").click(function(e) {            
			var fID = $(this).data("id");
			// alert(fID);
        	$.get(url_update,{id: fID},function (data){
            	$("#activity-modal").find(".modal-body").html(data);
            	$(".modal-body").html(data);
            	$(".modal-title").html("แก้ไขข้อมูลสมาชิก");
            	$("#activity-modal").modal("show");
        	});
    	});

	var url_view = "index.php?r=receipt/view";		
    	$(".act-view").click(function(e) {			
                var fID = $(this).data("id");
                $.get(url_view,{id: fID},function (data){
                        $("#activity-modal").find(".modal-body").html(data);
                        $(".modal-body").html(data);
                        $(".modal-title").html("ข้อมูล");
                        $("#activity-modal").modal("show");
                    }
                );
            });   
         
$(document).ready(function() {	
/* BASIC ;*/	
	$('#receipt-index').DataTable({
    "order": [[ 0, 'desc' ], [ 4, 'asc' ]]
});

	// $('#activity-modal').on('hidden.bs.modal', function () {
 	// 	location.reload();
	// })
	
$( "#act-create" ).click(function() {    
    var url_create = "index.php?r=order/create";
        $.get(url_create,function (data){
            $("#activity-modal").find(".modal-body").html(data);
            $(".modal-body").html(data);
            $(".modal-title").html("เพิ่มข้อมูล");
            // $(".modal-footer").html(footer);
            $("#activity-modal").modal("show");
            //   $("#myModal").modal('toggle');
        });     
	}); 
		
});
JS;
$this->registerJs($script);
?>
       