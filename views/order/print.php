<?php
use yii\helpers\Html;
?>

<table width="100%">
    <tr>
        <td width="100%" style="text-align: right">
            <h4>รหัสใบเบิก <?= $model->order_code ?></h4>            
        </td>
        
    </tr>
    <tr>
    <td width="100%" style="text-align: right">
            <h5><?= $model->create_at ?></h5>            
        </td>
        </tr>
</table>
<table width="100%">
    <tr>
        <td colspan="2" width="80%">
            <h3>ผู้เบิก : <?= $model->getProfileName() ?></h3>
        </td>
        <td colspan="2" width="80%">
            
        </td>
    </tr>
</table>
<br>
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
                <td><?=$model_list->quantity?> <?=$model_list->getProductUnitName()?></td>
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

<table cellspacing="0" cellpadding="2" border="0" width="100%" style= "margin-top: 50px">
    <tr>
        <td width="">ผู้เบิก...............................................................</td>
        <td width="50%">ผู้อนุมัติ...........................................................</td>        
    </tr>
</table>
    <table cellspacing="0" cellpadding="2" border="0" width="100%" style= "margin-top: 75px">
    <tr>
        <td width="50%">ผู้จ่าย............................................................</td>
        <td width="50%">ผู้รับของ..........................................................</td>        
    </tr>
</table>
