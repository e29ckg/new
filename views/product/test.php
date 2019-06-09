
<div role="content">
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form id="contact-form" herf="/bsc-yii/web/index.php?r=co/create" class="smart-form" novalidate="novalidate">
							
						<header>
								Order services
							</header>

							<fieldset>
								
								<div class="row">
									<section class="col col-4">
										<label class="select">
											<select name="fname">
												<option value="1">นาย</option>
												<option value="2">นาง</option>
												<option value="3">นางสาว</option>
											</select> <i></i> </label>
									</section>
									<section class="col col-4">
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="name" placeholder="ชื่อ">
										</label>
									</section>
									<section class="col col-4">
										<label class="input"> <i class="icon-append fa fa-briefcase"></i>
											<input type="text" name="lname" placeholder="นามสกุล">
										</label>
									</section>
								</div>

									<section>
										<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
											<input type="text" name="dep" placeholder="ตำแหน่ง">
										</label>
									</section>
								
								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
											<input type="email" name="email" placeholder="E-mail">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-append fa fa-phone"></i>
											<input type="tel" name="phone" placeholder="Phone" data-mask="(999) 999-9999">
										</label>
									</section>
								</div>
								
									<section>
										<div class="input input-file">
										<span class="button"><input id="file2" type="file" name="file2" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="รูปถ่าย" readonly="">
										</div>
									</section>
								
								
								<section>
									<label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
										<textarea rows="5" name="comment" placeholder="หมายเหตุ"></textarea> 
									</label>
								</section>
								
							</fieldset>
							<footer>
								<button type="submit" class="btn btn-primary">
									Validate Form
								</button>
							</footer>
						</form>

					</div>
					<!-- end widget content -->
					
				</div>

				
<script>
$('#eg7').click(function() {
		
        $.smallBox({
            title : "James Simmons liked your comment",
            content : "<i class='fa fa-clock-o'></i> <i>2 seconds ago...</i>",
            color : "#296191",
            iconSmall : "fa fa-thumbs-up bounce animated",
            timeout : 4000
        });

    });

$(document).ready(function() {
			
			pageSetUp();
	
	var login_exec = "index.php?r=co/create";

	$('#contact-form').validate({
			// Rules for form validation
				rules : {
					fname : {
						required : true
					},
					name : {
						required : true
					},
					lname : {
						required : true
					},
					dep : {
						required : true
					},
					// email : {
					// 	required : true,
					// 	email : true
					// },
					// phone : {
					// 	required : true
					// },					
					address : {
						required : true
					}
				},
		
				// Messages for form validation
				messages : {
					fname : {
						required : 'Please enter your first name'
					},
					name : {
						required : 'Please enter your name'
					},
					lname : {
						required : 'Please enter your last name'
					},
					dep : {
						required : 'Please enter your last name'
					},
					// email : {
					// 	required : 'Please enter your email address',
					// 	email : 'Please enter a VALID email address'
					// },
					// phone : {
					// 	required : 'Please enter your phone number'
					// },
					address : {
						required : 'Please enter your full address'
					},
					
				},

				submitHandler: function(form) {
						var data = $(form).serialize();
						
				         $.post("index.php?r=co/create" ,function(data) {
							
				         	// var data = $.parseJSON(data);

	        				alert('1234');
				            	
				        });
				},

		
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}

			});
});			
			
</script>			
					