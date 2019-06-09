<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->id.' # '.$model->receipt_code;
$this->params['breadcrumbs'][] = ['label' => 'Receipt', 'url' => ['index']];
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
				        <?php foreach ($model_lists as $model_list): ?>
                    <tr>
                        <td><?=$model_list->id?></td>
                        <td><?=$model_list->code?></td>
                        <td><?=$model_list->product_code?></td>
                        <td><?=$model_list->getProductName()?></td>
                        <td><?=$model_list->unit_price?></td>
                        <td><?=$model_list->quantity?></td>                        
                  	    <td>
                            
                          <?php
                              $Total = $model_list->quantity * $model_list->unit_price;
                              echo $Total;
                              $sumTotal = $sumTotal + $Total;
                          // echo Html::a('<i class="fa fa-remove"></i> ลบ',['receipt/delete','id' => $model->id],
							            //   [ 'class' => 'btn btn-danger act-update',
								          //     'data-confirm' => 'Are you sure to delete this item?',
                        	// 	  'data-method' => 'post',
                          //   ]);
                            ?>
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

