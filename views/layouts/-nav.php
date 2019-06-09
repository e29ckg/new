<?php
use yii\helpers\Html;

?>
  
    
<nav>
<?=\yii\widgets\Menu::widget([
'options' => ['class' => ''],
'items' => [

    [
		'label' => 'Dashboard',
		'url' => ['/site/dashboard'],
		'template' => '<a href="{url}" title="{label}"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">{label}</span></a>',
		
	],
	[
		'label' => 'Cart',
		'url' => ['/cart/index'],
		'template' => '<a href="{url}" title="{label}"><i class="fa fa-lg fa-fw fa-shopping-cart"></i> <span class="menu-item-parent">{label}</span></a>',
		
	],
	[
		'label' => 'Order',
		'url' => ['/cart/index'],
		'template' => '<a href="#" title="{label}"><i class="fa fa-lg fa-fw fa-inbox"></i> <span class="menu-item-parent">{label}</span></a>',
		'items' => [
            [
				'label' => 'Order List',
				'url' => ['/order/index'],
				'template' => '<a href="{url}" title="{label}"><span class="menu-item-parent">{label}</span></a>',
				
			],
			[
				'label' => 'Order Status',
				'url' => ['/order/status'],
				'template' => '<a href="{url}" title="{label}"> <span class="menu-item-parent">{label}</span></a>',
				
			],
		],
	],
    [
		'label' => 'Catalog',  
		'url' => ['#'],
		'template' => '<a href="#" title="{label}"><i class="fa fa-lg fa-fw fa-tags"></i> <span class="menu-item-parent">{label}</span></a>',
		'items' => [
            [
				'label' => 'เพิ่มวัสดุเข้าสต็อก',
				'url' => ['/receipt/index_add'],
				'template' => '<a href="{url}" title="{label}"> <span class="menu-item-parent">{label}</span></a>',
				
			],
			[
				'label' => 'Product',
				'url' => ['/product/index'],
				'template' => '<a href="{url}" title="{label}"> <span class="menu-item-parent">{label}</span></a>',
				
			],
            [
				'label' => 'ประเภทวัสดุ',
				'url' => ['/product_catalog/index'],
				'template' => '<a href="{url}" title="{label}"> <span class="menu-item-parent">{label}</span></a>',
			],
			[
				'label' => 'หน่วยนับ',
				'url' => ['/product_unit/index'],
				'template' => '<a href="{url}" title="{label}"> <span class="menu-item-parent">{label}</span></a>',
			],
			[
				'label' => 'ปรับสต็อก',
				'url' => ['/product/updatestroke'],
				'template' => '<a href="{url}" title="{label}"> <span class="menu-item-parent">{label}</span></a>',
			],
		],
	],
	[
		'label' => 'User',  
		'url' => ['#'],
		'template' => '<a href="#" title="{label}"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">{label}</span></a>',
		'items' => [
            [
				'label' => 'User List',
				'url' => 'phpmyadmin',
				'template' => '<a href="#" title="{label}"> <span class="menu-item-parent">{label}</span></a>',
			],
			[
				'label' => 'Levels',
				'url' => 'html',
				'template' => '<a href="#" title="{label}"></i> <span class="menu-item-parent">{label}</span></a>',
			],
        ],
	],
	[
		'label' => 'Setting',  
		'url' => ['#'],
		'template' => '<a href="#" title="{label}"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">{label}</span></a>',
		'items' => [
            [
				'label' => 'Phpmyadmin',
				'url' => 'phpmyadmin',
				'template' => '<a target="_blank" href="http://'.$_SERVER["HTTP_HOST"].'/{url}" title="{label}"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">{label}</span></a>',
			],			
			[
				'label' => 'HTML',
				'url' => 'html',
				'template' => '<a target="_blank" href="http://'.$_SERVER["HTTP_HOST"].'/{url}" title="{label}"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">{label}</span></a>',
			],
        ],
    ],
],
'submenuTemplate' => "\n<ul>\n{items}\n</ul>\n",
'encodeLabels' => false, //allows you to use html in labels
'activateParents' => true,   
]);  ?>
</nav>