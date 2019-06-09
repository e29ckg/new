<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รับเข้าสต็อก';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
          	<div class="box">
            	<div class="box-header">
              		<h3 class="box-title">ใบรับของ</h3>
			  		<div class="box-tools">                
						<!-- <a href= "index.php?r=receipt/add_list" class="btn btn-warning act-update"><i class="fa fa-pencil-square-o"></i> เพิ่ม</a> -->
						<a href= "#" id="act-create" class="btn btn-warning act-update"><i class="fa fa-pencil-square-o"></i> เพิ่ม</a>
					</div>
           	 	</div>
            	<!-- /.box-header -->
            	<div class="box-body">
              	<table id="receipt-index" class="table table-bordered table-hover">
                	<thead>
                		<tr>
                  			<th>ID</th>
				  			<th>CodeProduct</th>
							<th>Product</th>
				  			<th>ราคาต่อหน่วย</th>
                  			<th>จำนวน</th>
							  <th>ราคา</th>
                  			<th>เครื่องมือ</th>
                		</tr>
                	</thead>
                	<tbody>
                	<?php
						$Total = 0;		
						$sumTotal = 0;
						if(isset($_SESSION['inLineR'])){
						
						for($i=0;$i<=(int)$_SESSION['inLineR'];$i++){
							if($_SESSION['strProductCodeR'][$i] != ""){
								$productCode = $_SESSION['strProductCodeR'][$i];
								$model = Product::find()->where(['code'=> $productCode])->one();
								// $ss['strProductId'][$i] =  $_SESSION['inLine'][$i];
								$Total = $_SESSION['strQtyR'][$i] * $_SESSION['strProductUnitPriceR'][$i];
								$sumTotal = $sumTotal + $Total;
					?>
						<tr>
							<td class=""><?=$i?></td>				
							<td class=""><?=$_SESSION['strProductCodeR'][$i]?></td>
							<th><?=$model->product_name;?></th>
							<td class=""><?=$_SESSION['strProductUnitPriceR'][$i]?></td>
							<td class=""><?=$_SESSION['strQtyR'][$i]?></td>	
							<td class=""><?=$Total?></td>				
							<td class="cart_delete">
								<a class="btn btn-warning"  data-id="<?=$i?>" href="index.php?r=receipt/delete_list&id=<?=$i?>"><i class="fa fa-times"></i> ลบ</a>
							</td>
						</tr>						

					<?php }	} } ?>	

					</tbody> 
					<tfoot> 
							<th></th>
				  			<th></th>
							<th></th>
				  			<th></th>
                  			<th>ราคารวม</th>
							  <th><?=$sumTotal?></th>
                  			<th></th>
					</tfoot>
              	</table>
            	</div>
           	 	<!-- /.box-body -->
        	</div>
        	<!-- /.box -->
			<div>
				<?php if($sumTotal <> 0){?>
					<a data-id="" href="index.php?r=receipt/add_conform" class="btn btn-success"><i class="fa fa-times"></i>ยืนยัน</a>
				<?php } ?>				
			</div>

    	</div>
    	<!-- /.col -->
			
	</div>
    <!-- /.row -->
</section>
<!-- /.content -->


<?php
$script = <<< JS
$(document).ready(function() {	

$( "#act-create" ).click(function() {    
	// alert(123);
    var url_create = "index.php?r=receipt/add_list";
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
