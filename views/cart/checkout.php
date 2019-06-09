<?php
use app\models\Product;
// echo var_dump($_SESSION['inLine']);
?>

	<section id="cart_items">
		<div class="container">

			<div class="shopper-informations">
			</div>			

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">วัสดุ</td>
							<td class="price">จำนวนที่มี</td>
							<td class="quantity">จำนวนที่เบิก</td>
							<td class="total"></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
							$Total = 0 ;
            				$sumTotal = 0;
							//  $model = Product::find()->all();
							if(isset($_SESSION['inLine'])){
								for($i=0;$i<=(int)$_SESSION['inLine'];$i++){
									if($_SESSION['strProductCode'][$i] != ""){
										$codeProduct = $_SESSION['strProductCode'][$i];
                    					$model = Product::find()->where(['code'=> $codeProduct])->one();
                    					// $ss['strProductCode'][$i] =  $_SESSION['inLine'][$i];
										$Total = $_SESSION['strQty'][$i];
										$sumTotal = $sumTotal + $Total;
										
						?>
						<tr>
								<td class="cart_product"><a href=""><img src="<?= $model->img ? 'uploads/product/img/'.$model->img : 'img/no_image.png'?>" height="110" alt=""></a></td>
								<td class="cart_description">
									<h4><a href=""><?=$model->product_name?></a></h4>
									<p>Web ID:<?=$model->id?> </p>
								</td>
								<td class="cart_price">
									<p> <?= $model->instoke?></p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<!-- <a data-id="<?=$i?>" class="cart_quantity_up qty_up" href="#"> + </a> -->
										<input readonly class="cart_quantity_input quantity-input" type="text" value="<?=$_SESSION['strQty'][$i]?>"  size="2">
										<!-- <a data-id="<?=$i?>" class="cart_quantity_down qty_down" href="#"> - </a> -->
									</div>
								</td>
								<td class="cart_total">
									<!-- <p class="cart_total_price"></p> -->
								</td>
								<td class="cart_delete">
									<!-- <a class="cart_quantity_delete " data-id="<?=$i?>" href="index.php?r=cart/delete&id=<?=$i?>"><i class="fa fa-times"></i></a> -->
								</td>
							</tr>						

						<?php
                					}
								}
							}
			
						?>

						
					</tbody>
				</table>
			</div>
			<div class="header-bottom text-center">
				<a class="btn btn-default check_out" href="index.php?r=cart/save_order">ยืนยันการเบิกวัสดุ</a>
			</div>
					
		</div>
	</section> <!--/#cart_items-->

	
