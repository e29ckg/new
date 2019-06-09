<?php

use yii\widgets\LinkPager;
use yii\data\Pagination;

?>

<h2 class="title text-center">Features Items</h2>
						
						<?php foreach ($models as $model): ?>

						<div class="col-sm-3">
							<div class="product-image-wrapper">
							<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?= $model->img ? 'uploads/product/img/'.$model->img : 'img/no_image.png'?>"  height="250" width="200" sizes= "50" alt="<?=$model->product_name?>" />
										<h2>  <?=$model->instoke > 0 ? 'มี '.$model->instoke.' '.$model->getUnitName() : 'หมด' ?></h2>
										<p><?=$model->product_name?></p>
										<a href="index.php?r=cart/add_to_cart&code=<?=$model->code?>" data-id="<?=$model->code?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2><?=$model->instoke > 0 ? 'มี '.$model->instoke.' '.$model->getUnitName() : 'หมด' ?></h2>
											<p><?=$model->product_name?></p>
											<a href="index.php?r=cart/add_to_cart&code=<?=$model->code?>" data-id="<?=$model->code?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>

						<?php  endforeach; ?>
                        <div>
						<ul class="pagination">
							<!-- <li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li> -->
						</ul>
						
					    </div>

                        <div class="box-footer text-center">
                  			<?= LinkPager::widget(['pagination' => $pagination]); ?>
                		</div>


<script >
		$(document).ready(function() {
			// add-to-cart-s
			$( ".add-to-cart" ).click(function() {    
    			var url = "index.php?r=cart/add_to_cart";
				code= $(this).data("id");
				// alert(id);
        		$.get(url,{code:code},function (data){
						$("#content").html(data);
        			}
				);     
			}); 
		});
</script>