<?php

use yii\helpers\Html;
//  use yii\grid\GridView;
use app\model\Product;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'setting';
$this->params['breadcrumbs'][] = $this->title;
// var_dump();
?>

<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$this->title?></h3>
			  <div class="box-tools">
                
					<a href= "#" id="act-create" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> เพิ่ม</a>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="product-index" class="table table-bordered table-hover">
                <thead>
                	<tr>
						<th data-class="expand">Id</th>
						<th>Image</th>
						<th data-hide="phone">inStoke</th>
						<th data-hide="phone">ReceiptList</th>
						<th data-hide="phone">ประเภท</th>
						<th data-hide="phone">ประเภท</th>
						<th data-hide="phone,tablet">InStock</th>
					    <th>เครื่องมือ</th>
                	</tr>
                </thead>
                <tbody>
				<?php foreach ($modelPs as $model): ?>
						            <tr>
						                <td><?=$model['id']?></td>
						                <td><?=$model['product_name']?></td>
										<td><?=$model['instoke']?></td>
								        <td>
										<?php 
										$total = 0;
										$sumTotal = 0;
											foreach ($modelRLs as $modelRL):
											if($modelRL->product_code == $model->code){
												$total = $modelRL->quantity;
												$sumTotal = $sumTotal + $total; 
											}
											endforeach; 
											echo $sumTotal;
											?>
										</td>
								        <td>
										<?php 
										$total2 = 0;
										$sumTotal2 = 0;
											foreach ($modelLogs as $modelLog):
											if($modelLog->product_code == $model->code){
												$total2 = $modelLog->quantity;
												$sumTotal2 = $sumTotal2 + $total2; 
											}
											endforeach; 
											echo $sumTotal2;
											?>
										</td>
										<td></td>
								        <td></td>
								        <td>
											
										</td>
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




