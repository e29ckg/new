<?php
use yii\helpers\Html;
use app\models\Profile;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=Profile::getImg();?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Profile::getFullName();?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'ใบเบิก', 'icon' => 'file-code-o', 'url' => ['/order']],
                    [
                        'label' => 'รับเข้าสต๊อก', 
                        'icon' => 'file-code-o', 
                        'url' => '#',
                        'items' => [
                            ['label' => 'ใบรับสินค้าทั้งหมด', 'icon' => 'file-code-o', 'url' => ['/receipt'],],
                            ['label' => 'เพิ่มสินค้าเข้าสต๊อก', 'icon' => 'file-code-o', 'url' => ['/receipt/add'],],
                        ]
                    ],
                    [
                        'label' => 'product', 
                        'icon' => 'file-code-o', 
                        'url' => '#',
                        'items' => [
                            ['label' => 'Product-All', 'icon' => 'file-code-o', 'url' => ['/product'],],
                            ['label' => 'Product-Stock-Down', 'icon' => 'file-code-o', 'url' => ['/product/stock_down'],],
                        ]
                    ],
                    
                    
                     

                    // ['label' => 'Product', 'icon' => 'file-code-o', 'url' => ['/product']],
                    // ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    // ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    // [
                    //     'label' => 'Some tools',
                    //     'icon' => 'share',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    //         ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    //         [
                    //             'label' => 'Level One',
                    //             'icon' => 'circle-o',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    //                 [
                    //                     'label' => 'Level Two',
                    //                     'icon' => 'circle-o',
                    //                     'url' => '#',
                    //                     'items' => [
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                     ],
                    //                 ],
                    //             ],
                    //         ],
                    //     ],
                    // ],
                    [
                        'label' => 'Log-In-Out',
                        'icon' => 'envelope-o',
                        'url' => ['/log_st'],
                        'template'=>'<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-yellow">123</small></span></a>'
                    ],
                    [
                        'label' => 'รายงาน', 
                        'icon' => 'file-code-o', 
                        'url' => '#',
                        'items' => [
                            ['label' => 'Report', 'icon' => 'file-code-o', 'url' => ['/report/index'],],
                            ['label' => 'Report/view', 'icon' => 'file-code-o', 'url' => ['/report/view'],],
                        ]
                    ],
                    [
                        'label' => 'Setting', 
                        'icon' => 'file-code-o', 
                        'url' => '#',
                        'items' => [
                            ['label' => 'index', 'icon' => 'file-code-o', 'url' => ['/setting/index'],],
                            ['label' => 'ปรับ Logst->receipt_list_id', 'icon' => 'file-code-o', 'url' => ['/log_st/up_receipt_list_id'],],
                            ['label' => 'ปรับ instoke', 'icon' => 'file-code-o', 'url' => ['/product/upstoke'],],
                            ['label' => 'ปรับ ReceiptList->LogSt', 'icon' => 'file-code-o', 'url' => ['/setting/up_receipt_to_logst'],],
                            
                        ]
                    ],
                    
                ],
            ]
        ) ?>

    </section>

</aside>
