<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii2mod\alert\Alert;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สมาชิก';
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- MAIN CONTENT -->
<?php
	// print_r($models);
	// echo Yii::$app->security->generatePasswordHash('admin').'<br>';
	// echo md5('admin').'<br>';
?>

<div class="row">				
				<!-- col -->
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
		<!-- PAGE HEADER -->
			<i class="fa-fw fa fa-puzzle-piece"></i> App Views 
			<span>  </span>
		</h1>
		</div>
				<!-- end col -->
				
		<!-- right side of the page with the sparkline graphs -->
		<!-- col -->
		<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
			<!-- sparks -->
			<ul id="sparks">
				<li class="sparks-info">
					<h5> My Income <span class="txt-color-blue">$47,171</span></h5>
					<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
									
					</div>
				</li>
				<li class="sparks-info">
					<h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
					<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
									
					</div>
					</li>
					<li class="sparks-info">
					<h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
					<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
									
					</div>
				</li>
			</ul><!-- end sparks -->
		</div><!-- end col -->
				
	</div>
	
	<!-- end row -->
	<section id="widget-grid" class="">
	    <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              	<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2><?= $this->title;?> </h2>
						</header>
						<!-- widget div-->
						<div>
							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->
				
							</div>
							<!-- end widget edit box -->
				
							<!-- widget content -->
							<div class="widget-body no-padding">
				
								<table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                                        
                                    <thead>			                
                                        <tr>
                                            <th data-hide="phone">ID</th>
                                            <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                                            <th data-hide="phone"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Phone</th>
                                            <th>Company</th>
                                            <th data-hide="phone,tablet"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> Zip</th>
                                            <th data-hide="phone,tablet">City</th>
										</tr>
                                    </thead>                                        
                                    <tbody>
                                    	<?php foreach ($models as $profile): ?>
										<tr>
                       						<td class="text-center" ><?= '' ?></td>
                       						<td  ><?= $profile['name'] ?>  </td>
                       						<td class="text-center" ><?= $profile['sname'] ?> </td>
                       						<td></td>
											<td>Fogo</td>
                                            <td>03/04/14</td>
                                        </tr>
                                    	<?php  endforeach; ?>
                                    </tbody>
                            	</table>
                        	</div>
                    	</div>
					</div>
            </article>
        </div>
    </section>

</div>
<!-- END MAIN CONTENT -->

<?php
$script = <<< JS

$('#eg8').click(function() {
		
        $.smallBox({
            title : "James Simmons liked your comment",
            content : "<i class='fa fa-clock-o'></i> <i>2 seconds ago...</i>",
            color : "#296191",
            iconSmall : "fa fa-thumbs-up bounce animated",
            timeout : 4000
        });

    });



     
$(document).ready(function() {

    

    
    /* BASIC ;*/
    var responsiveHelper_dt_basic = undefined;
				var responsiveHelper_datatable_fixed_column = undefined;
				var responsiveHelper_datatable_col_reorder = undefined;
				var responsiveHelper_datatable_tabletools = undefined;
				
				var breakpointDefinition = {
					tablet : 1024,
					phone : 480
				};
	
				
			/* COLUMN FILTER  */
		    var otable = $('#datatable_fixed_column').DataTable({
		    	//"bFilter": false,
		    	//"bInfo": false,
		    	//"bLengthChange": false
		    	//"bAutoWidth": false,
		    	//"bPaginate": false,
		    	//"bStateSave": true // saves sort state using localStorage
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_datatable_fixed_column) {
						responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_datatable_fixed_column.respond();
				}		
			
		    });
		    
		    // custom toolbar
		    $("div.toolbar").html('<div class="text-right"><button id="act-create" class="btn btn-success btn-md" alt="act-create"><i class="fa fa-plus "></i> act-create</button></div>');
		    	   
		    // Apply the filter
		    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
		    	
		        otable
		            .column( $(this).parent().index()+':visible' )
		            .search( this.value )
		            .draw();
		            
		    } );
		    /* END COLUMN FILTER */  
        
    
    var url_create = "index.php?r=user/index";
    $( "#act-create" ).click(function() {
        $.get(url_create,function (data){
                        $("#myModal").find(".modal-body").html(data);
                        $(".modal-body").html(data);
                        $(".modal-title").html("เพิ่มข้อมูล");
                        $("#myModal").modal("show");
                     //   $("#myModal").modal('toggle');
        });     
    }); 

    var url_create1 = "index.php?r=co/create1";
    $("#act-create1" ).click(function() {
        $.get(url_create1,function (data){
                        $("#myModal").find(".modal-body").html(data);
                        $(".modal-body").html(data);
                        $(".modal-title").html("เพิ่มข้อมูล1");
                        $("#myModal").modal("show");
                    //    $("#myModal").modal('toggle');
        });     
    });

    var url_view = "index.php?r=co/view";
    $(".act-view").click(function(e) {
                var fID = $(this).data("id");
                $.get(url_view,{id: fID},function (data){
                        $("#activity-modal").find(".modal-body").html(data);
                        $(".modal-body").html(data);
                        $(".modal-title").html("เปิดดูข้อมูลVbook");
                        $("#activity-modal").modal("show");
                    }
                );
            });
    
    var url_update = "index.php?r=co/update";
        $(".act-update").click(function(e) {            
                var fID = $(this).data("id");
                $.get(url_update,{id: fID},function (data){
                        $("#activity-modal").find(".modal-body").html(data);
                        $(".modal-body").html(data);
                        $(".modal-title").html("แก้ไขข้อมูลสมาชิก");
                        $("#activity-modal").modal("show");
                    }
                );
            });
});
JS;
$this->registerJs($script);
?>