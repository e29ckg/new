<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ReceiptList;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $modelsP['product_name'];
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$this->title?></h3>
			  <div class="box-tools">
                
					<!-- <a href= "#" id="act-create" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> เพิ่ม</a> -->

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="product-index" class="table table-bordered table-hover">
                <thead>
                	<tr>
						<th data-class="expand">Id</th>
						<th data-hide="phone">DateTime</th>
						<th data-hide="phone">code</th>
						<th data-hide="phone">product</th>
						<th data-hide="phone">RL_id</th>
						<th data-hide="phone,tablet">ราคาต่อหน่วย</th>
					    <th>คงเหลือ</th>
                	</tr>
                </thead>
                <tbody>
                <?php 
                    $total = 0;
                    $sumtotal = 0;
                ?>
				<?php foreach ($modelsLST as $model): 
            //   $modelsRL = ReceiptList::findOne($model->receipt_list_id);
            // if($modelsRL['quantity'] <> 0){

            
            ?>
						<tr>
						    <td><?=$model['id']?></td>
                <td><?=$model->create_at?></td>
							<td><?=$model->code?> </td>
							<td><?=$model->product_code?></td>
							<td><?=$model->receipt_list_id?></td>
							<td><?=$model->unit_price?></td>
							<td><?=$model->quantity?></td>							
						</tr>
                        <?php 
                            $total = $model->quantity;
                            $sumtotal =$sumtotal + $total;
                            
            // }
            endforeach; ?>
				
				</tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th><?=$modelsP['instoke']?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th><?=$sumtotal?></th>
                </tr>
                </tfoot>
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
