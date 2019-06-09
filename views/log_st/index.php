<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log';
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
              <table id="log-index" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>วัน-เวลา</th>
				            <th>Code</th>
				            <th>ProductCode</th>
                    <th>RL_Code</th>
                    <th>Product</th>
				            <th>ราคาต่อหน่วย</th>
                    <th>จำนวน</th>
                    
                  <!-- <th>เครื่องมือ</th> -->
                </tr>
                </thead>
                <tbody>
                                  
				<?php foreach ($models as $model): ?>
				<tr>
          <td><?=$model->create_at?></td>
					<td><?=$model->code?></a></td>
          <td><?=$model->product_code?></td>
          <td><?=$model->receipt_list_id?></td>          
          <td><?=$model->getProductName()?></td>
          <td><?=$model->unit_price?></td>
					<td><?=$model->quantity?></td>  
				</tr>
				<?php  endforeach; ?>
				</tbody>
                
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
	$('#log-index').DataTable({
    "order": [[ 0, 'desc' ], [ 3, 'desc' ],[ 4, 'asc' ]]
});

	$('#activity-modal').on('hidden.bs.modal', function () {
 		location.reload();
	})
	
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
       