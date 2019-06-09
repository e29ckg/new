<?php
use yii\helpers\Html;
?>

<table class="table_bordered" width="100%" cellpadding="2" cellspacing="1">
    <tr>
        <td width="100%" style="text-align: center" >
            <h4>รหัสใบนำเข้า <?= $model->receipt_code ?></h4>            
        </td>
        
    </tr>
    
</table>
<table class="table_bordered" width="100%" border="0" cellpadding="2" cellspacing="0">
    <thead>
		<tr class="cart_menu">
	    	<th class="image">ลำดับ<br>no.</th>
			<th class="description">รายการ</th>
			<th class="price">ราคาต่อหน่วย</th>
			<th class="quantity">จำนวน</th>
			<th class="total">ราคารวม<br>Total</th>
		</tr>
	</thead>
    <tbody>
        <?php $i = 1;
                $total = 0;
                $totalSum = 0;
                ?>
        <?php foreach ($model_lists as $model_list): ?>
            <tr>
                <td><?=$i?><?='-'.$model_list->product_code?></td>
                <td>
                    <?=$model_list->getProductName()?>
                </td>
                <td><?=$model_list->unit_price?></td>
                <td><?=$model_list->quantity?></td>
                <td>
                <?=$total = $model_list->unit_price * $model_list->quantity?>
                </td>
            </tr>
            <?php $totalSum = $totalSum + $total;
            $i++;
            ?>
        <?php  endforeach; ?>    
    </tbody>
    <tbody>
        <?php for($i;$i<=10;$i++){ ?>         
            <tr>
                <td><?=$i?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php  } ?>    
    </tbody>
</table>
<table cellspacing="0" cellpadding="2" border="0" width="100%">
    <tr>
        <td width="50%"></td>
        <td width="50%">
            <table cellspacing="0" cellpadding="0" class="table_bordered" width="100%">
                <tr>
                    <td colspan="2" width="50%">
                        <u>ราคารวม :</u><br />
                        Total
                    </td>
                    <td colspan="2" width="50%">
                        <h3><?=$totalSum?></h3>
                    </td>
                </tr>                
            </table>
        </td>        
    </tr>
</table>

<table width="100%">
    <tr>
        <td colspan="2" width="80%">
            <h3>ผู้นำเข้า : <?= $model->getProfileName() ?></h3>
        </td>
        
    </tr>
    <tr>       
        <td colspan="2" width="80%">
        วันที่นำเข้า : <?= $model->create_at ?>
        </td>
    </tr>
</table>
