
<div class="container">
			<br />
			<br />
			<h2 align="center">Ajax Crud on Dynamically Add Remove Input Fields in PHP</h2><br />
			<div align="right">
				<button type="button" name="add" id="add" class="btn btn-info">Add</button>
			</div>
			<br />
			<div id="result"></div>
		</div>
		<div id="dynamic_field_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="add_name">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Details</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
		      			<input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" />
		      		</div>
		      		<div class="table-responsive">
		      			<table class="table" id="dynamic_field">

		      			</table>
		      		</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input type="hidden" name="action" id="action" value="insert" />
					<input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
				</div>
			</form>
		</div>
	</div>

</div>

        <?php
$script = <<< JS
    
$(document).ready(function() {	

    load_data();

var count = 1;

function load_data()
{
    $.ajax({
        url:"index.php?r=co/create",
        method:"POST",
        success:function(data)
        {
            $('#result').html(data);
        }
    })
}

    $('#add').click(function(){
		$('#dynamic_field').html('');
		// add_dynamic_input_field(1);
		$('.modal-title').text('Add Details');
		$('#action').val("insert");
		$('#submit').val('Submit');
		$('#add_name')[0].reset();
		$('#dynamic_field_modal').modal('show');
	});


});
JS;
$this->registerJs($script);
?>