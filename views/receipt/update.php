<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Update Order: ' . $models['id'];
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $models->id, 'url' => ['view', 'id' => $models->id]];
$this->params['breadcrumbs'][] = 'Update';
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
				          <th>ProductCode</th>
                  <th>Product</th>
                  <th>ราคาต่อหน่วย</th>
                  <th>จำนวน</th>
                  <th>เครื่องมือ</th>
                </tr>
                </thead>
                <tbody>   
                <?php 
                    $Total = 0 ;
                    $sumTotal = 0;
                ?>               
				        <?php foreach ($modelRLs as $modelRL): ?>
                    <tr>
                        <td><?=$modelRL->id?></td>
                        <td><?=$modelRL->receipt_code?></td>
                        <td><?=$modelRL->product_code?></td>
                        <td><?=$modelRL->getProductName()?></td>
                        <td><?=$modelRL->unit_price?></td>
                        <td><?=$modelRL->quantity?></td>                        
                  	    <td>                           
                        <?php
                              $Total = $modelRL->quantity * $modelRL->unit_price;
                              echo $Total;
                              $sumTotal = $sumTotal + $Total;
                          // echo Html::a('<i class="fa fa-remove"></i> ลบ',['receipt/delete','id' => $model->id],
							            //   [ 'class' => 'btn btn-danger act-update',
								          //     'data-confirm' => 'Are you sure to delete this item?',
                        	// 	  'data-method' => 'post',
                          //   ]);
                        ?>
					              </td>
                        <td>
                        <a href= "index.php?r=receipt/update_list_cancel&id=<?=$modelRL->id?>" class="btn btn-warning " data-confirm="Are you sure to ยกเลิก this item?"><i class="fa fa-pencil-square-o"></i> ยกเลิก</a>
                        </td>
				            </tr>
				        <?php  endforeach; ?>
				          </tbody>
                  <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>รวม </th>   
                  <th><?= $sumTotal?></th>                                 
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


