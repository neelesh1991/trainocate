<?php $this->load->view('template/header');?>
	<!-- Inner Banner -->
		    <div class="inner-banner dark-bg">
		    	<div class="container">
			    	<div class="inner-page-heading style-2">
						<div class="main-heading style-2 h-white p-white">
						<?php if(!empty($userinfo)){?>
							<h2><?php if($userinfo['name']!=''){echo $userinfo['name'];}?></h2>
                              <div class="edit">
								<a class="btn blue sm z-depth-2"  href="javascript:void(0);" data-toggle="modal" data-target="#edit_profile-modal" data-backdrop="static" data-keyboard="false" aria-label="Close"><i class="fa fa-pencil"></i>   Edit profile</span>
								</a>
							  </div>
						</div>
			    	</div>
		    	</div>
		    </div>
			<!-- Inner Banner -->

		</header>
		<!-- Header -->
<?php
if($this->session->userdata('user_timezone')!='')
{
    $timezone=$this->session->userdata('user_timezone');
}else
{
    $timezone=$this->session->userdata('tenant_timezone');
}
if($timezone == '')
{
	$timezone="Asia/Kolkata";
}
$tz_from = 'UTC';
$tz_to = $timezone;
$format = 'Y-m-d h:i a';

$current = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone($timezone));
$current->setTimeZone(new DateTimeZone('UTC'));
$current_date=$current->format($format);
?>
		<!-- Main Content -->
		<main class="main-content">

			<!-- Teacher Detail Holder -->
			<div class="product-detail-holder">
				<div class="container">
					<div class="row">

						<!-- Teacher Detail -->
						<div class=" col-xs-12">

							<!-- Detail -->
							<div class="s-product-detail">
								<div class="row">

									<!-- Img -->
									<div class="col-sm-2 col-xs-2 r-full-width">
										<div class="s-teacher-column">
										<div id="kv-avatar-errors-1" class="center-block" style="width:800px;"></div>
										<form class="text-center" id="profile_change" action="/avatar_upload.php" method="post" enctype="multipart/form-data">
											<div class="kv-avatar center-block" style="width:200px">
												<input id="avatar-1" name="profile" type="file" class="file-loading" accept="image/*">
											</div>
										</form>
										</div><br>


									</div>
									<!-- Img -->
									<!-- Teacher Subject -->
									<div class="col-sm-7 col-xs-7 r-full-width">
										<div class="teacher-subject">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<div><b>Age:</b>  <?php if($userinfo['age']!=''){echo $userinfo['age'];}?></div>

													</div>
												</div>
												<div class="col-md-6">

													<div class="form-group">
														<div><b>Institute Name:</b>  <?php if($userinfo['institute_name']!=''){echo $userinfo['institute_name'];}?></div>

													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<div><b>Email:</b>  <?php if($userinfo['email_id']!=''){echo $userinfo['email_id'];}?></div>

													</div>
												</div>
												<div class="col-md-6">

													<div class="form-group">
														<div><b>Tenant Id:</b>  <?php if($userinfo['tenant_id']!=''){echo $userinfo['tenant_id'];}?></div>

													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<div><b>Academic year:</b>  <?php if($userinfo['academic_year']!=''){echo $userinfo['academic_year'];}?></div>

													</div>
												</div>
												<div class="col-md-6">

													<div class="form-group">
														<div><b>Principal Name:</b>  <?php if($userinfo['principal_name']!=''){echo $userinfo['principal_name'];}?></div>

													</div>
												</div>
											</div>





										</div>
									</div>
									<!-- Teacher Subject -->

								</div>
							</div>
							<?php }?>
							<!-- Detail -->

                                       <div class="row jumbotron  z-depth-2">

                                           <div class="col-md-12 ">

														<?php
														if(empty($inprogress_quiz) && empty($upcoming_quiz) && empty($past_quiz))
														{?>
																<h4 style="text-align:center;">No exam found</h4>
														<?php }
														if(!empty($inprogress_quiz))
														{
															$i=array();
															foreach ($inprogress_quiz as $val) {
																if(strtotime($current_date)<strtotime($val['end_time']))
																{
																	$i[]=$val['id'];
																}
																}
																if(!empty($i))
																{
														?>
															<div class="t-table-widget" style="text-align:center">
																<h3>Inprogress Quiz</h3>
																<div class="table-responsive table-bordered">
																	<table class="table">
																		<thead>
																			<tr>

																			  	<th>Exam Name</th>
																			  	<th>End Date</th>
																			  	<th>Action</th>
																			</tr>
																		</thead>

																		<?php
																	}
																		foreach ($inprogress_quiz as $val) {
																			$starttime = $val['start_time'];
																			$endtime = $val['end_time'];
																			$start_dt = new DateTime($starttime, new DateTimeZone($tz_from));
																			$start_dt->setTimeZone(new DateTimeZone($tz_to));
																			$startdatetime=$start_dt->format($format);

																			$end_dt = new DateTime($endtime, new DateTimeZone($tz_from));
																			$end_dt->setTimeZone(new DateTimeZone($tz_to));
																			$enddatetime=$end_dt->format($format);

																		if(strtotime($current_date)<strtotime($val['end_time']))
																		{
																		?>
																		<tbody>
																			<tr style="text-align: left">

																			  	<td><?php if($val['exam_name']!=''){echo $val['exam_name'];}?></td>
																			  	<td><?php if($val['end_time']!=''){echo $enddatetime;}?></td>
																			  	<td style="cursor:pointer"><a href="<?php echo base_url()?>quiz/start/<?php echo $val['quiz_id'];?>/<?php echo $val['exam_id'];?>">Resume</a></td>
																			</tr>
																			</tbody>
																			<?php
																			}
																			}?>


																	</table>
																</div>
															</div>

															<?php
															}?>

							<!-- Table Widget -->

							<?php if(!empty($upcoming_quiz )){?>

									<?php
									$i=array();
									foreach ($upcoming_quiz as $val) {
										if(strtotime($current_date)<strtotime($val['end_date']))
										{
											$i[]=$val['id'];
										}
										}
										if(!empty($i))
										{?>
									<div class="t-table-widget" style="text-align:center">
										<h3>Upcoming Quiz</h3>
										<div class="table-responsive table-bordered t-table-widget">
											<table class="table">
										<thead>
											<tr>
											  	<!-- <th>Exam ID</th>
											  	<th>Quiz ID</th> -->
											  	<th>Exam Name</th>
											  	<th>Start Date</th>
											  	<th>End Date</th>
											  	<th>Action</th>
											</tr>
										</thead>
										<?php
										}
										//print_r($upcoming_quiz);die;
										foreach ($upcoming_quiz as $val) {
											$starttime = $val['start_date'];
											$endtime = $val['end_date'];
											$start_dt = new DateTime($starttime, new DateTimeZone($tz_from));
											$start_dt->setTimeZone(new DateTimeZone($tz_to));
											$startdate=$start_dt->format($format);
											$end_dt = new DateTime($endtime, new DateTimeZone($tz_from));
											$end_dt->setTimeZone(new DateTimeZone($tz_to));
											$enddate=$end_dt->format($format);
											if(strtotime($current_date)<strtotime($val['end_date']))
											{
											?>
											<tbody>
											<tr style="text-align: left">


											  	<td><?php if($val['exam_name']!=''){echo $val['exam_name'];}?></td>
											  	<td><?php if($val['start_date']!=''){echo $startdate;}?></td>
											  	<td><?php if($val['end_date']!=''){echo $enddate;}?></td>

											  	<?php if($userinfo['is_profile_completed']==0){?>
											  	<td data-toggle="modal" data-target="#edit_profile-modal" style="cursor:pointer">view quiz Detail</td>
											  	<?php }else
											  	{
											  		if(strtotime($val['start_date'])<strtotime($current_date))
											  		{
											  		?>
											  		<td style="cursor:pointer"><a href="<?php echo base_url()?>quiz/index/<?php echo $val['quiz_id'];?>/<?php echo $val['id'];?>">view quiz Detail</a></td>
											  		<?php
											  	}else
											  	{?>
											  		<td style="cursor:pointer"><a href="javascript:void(0);" data-toggle="modal" data-target="#time_remaining-modal">view quiz Detail</a></td>

											  		<div class="modal time-modal fade" id="time_remaining-modal" style="background: transparent none repeat scroll 0% 0% ! important;">
											  			<div class="modal-content position-center-center tc-hover text-center">
											  				<button type="button" class="close" data-dismiss="modal"  style="position: relative; margin-top: -20px; margin-right: -23px;">&times;</button>
											  				<img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/big_thumbs/<?php echo $tenant_info['logo'];?>" alt="">

											  				<h5 class="quiz-start">This exam will start <?php if($val['start_date']!=''){echo $startdate;}?></h5>
											  			</div>
											  		</div>
											  		<?php
											  	}
											  	}

											  	/*}*/

											  	?>
											</tr>

										</tbody>
									<?php	}
									}?>
									</table>
								</div>

							<?php }?>
							<!-- Table Widget -->
							<!-- expired quiz -->
							<?php if(!empty($upcoming_quiz )){?>

									<?php
									$i=array();
									foreach ($upcoming_quiz as $val) {
										if(strtotime($current_date)>strtotime($val['end_date']))
										{
											$i[]=$val['id'];
										}
										}
										if(!empty($i))
										{?>
									<div class="t-table-widget" style="text-align:center">
										<h3>Expired Quiz</h3>
										<div class="table-responsive table-bordered">
											<table class="table">
										<thead>
											<tr>
											  	<!-- <th>Exam ID</th>
											  	<th>Quiz ID</th> -->
											  	<th>Exam Name</th>
											  	<th>Start Date</th>
											  	<th>End Date</th>
											</tr>
										</thead>
										<?php
										}
										foreach ($upcoming_quiz as $val) {
											$starttime = $val['start_date'];
											$endtime = $val['end_date'];
											$start_dt = new DateTime($starttime, new DateTimeZone($tz_from));
											$start_dt->setTimeZone(new DateTimeZone($tz_to));
											$startdate=$start_dt->format($format);
											$end_dt = new DateTime($endtime, new DateTimeZone($tz_from));
											$end_dt->setTimeZone(new DateTimeZone($tz_to));
											$enddate=$end_dt->format($format);
											if(strtotime($current_date)>strtotime($val['end_date']))
											{
											?>
											<tbody>
											<tr style="text-align: left">
											<!--  -->
											  	<td><?php if($val['exam_name']!=''){echo $val['exam_name'];}?></td>
											  	<td><?php if($val['start_date']!=''){echo $startdate;}?></td>
											  	<td><?php if($val['end_date']!=''){echo $enddate;}?></td>

											  		<?php
											  	}
											  	}
											  	?>
											</tr>

										</tbody>
												</table>
											</div>
										</div>
									<?php	}
									?>
							<!-- expired quiz -->


						<!-- past quiz -->
						<?php
						if(!empty($past_quiz))
						{?>
							<div class="t-table-widget" style="text-align:center">
								<h3>Past Quiz</h3>
								<div class="table-responsive table-bordered">
									<table class="table ">
										<thead>
											<tr>

											  	<th>Exam Name</th>
											  	<th>Test Date</th>

											  	<th>Download Certificate</th>
											</tr>
										</thead>

										<?php
										foreach ($past_quiz as $val) {
											$starttime = $val['start_time'];
										//	$endtime = $val['end_date'];

											$start_dt = new DateTime($starttime, new DateTimeZone($tz_from));
											$start_dt->setTimeZone(new DateTimeZone($tz_to));
											$startdate1=$start_dt->format($format);
											?>
										<tbody>
											<tr style="text-align: left">

											  	<td><?php if($val['exam_name']!=''){echo $val['exam_name'];}?></td>
											  	<td><?php if($val['start_time']!=''){echo $startdate1;}?></td>

											  	<?php if(file_exists("./downloads/".str_replace(' ', '_', $userinfo['name'])."_".str_replace(' ', '_', $val['exam_name']).".pdf")){?>
											  		<td style="cursor:pointer;"><a  href="<?php echo base_url();?>downloads/<?php echo str_replace(' ', '_', $userinfo['name']);?>_<?php echo str_replace(' ', '_', $val['exam_name']);?>.pdf"><i class="fa fa-download"></i></a></td>
											  		<?php }?>

											</tr>
											</tbody>
											<?php
											}?>


									</table>
								</div>
							</div>
							<?php
							}?>


						</div>
						<!-- Teacher Detail -->


					</div>
				</div>
			</div>
			<!-- Teacher Detail Holder -->
         </div>
         </div>

		</main>
		<!-- Main Content -->




		<div class="login-form1 text-center" >
		  <div class="modal fade" id="edit_profile-modal"  >


		      <div class="modal-content position-center-center tc-hover" style="padding: 20px 30px 30px;">
		      <button type="button" class="close" data-dismiss="modal"  style="position: relative; margin-top: -20px; margin-right: -23px;">&times;</button>
		      <img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/big_thumbs/<?php echo $tenant_info['logo'];?>" alt="">
		      <div><span id="successMsg"></span></div>
		      <h4>::: Edit Profile :::</h4>
		      <form class="edit-profile" id="edit-profile" role="form" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input name="name" id="name" type="text" value="<?php if($userinfo['name']!=''){echo $userinfo['name'];}?>"/>
								<label class="control-label">Name</label><i class="bar"></i>
							</div>
						</div>
						<div class="col-md-6">
								          <div class="form-group">
								              <input name="princy_name" id="princy_name" type="text" value="<?php if($userinfo['principal_name']!=''){echo $userinfo['principal_name'];}?>"/>
								              <label class="control-label">Principal Name</label><i class="bar"></i>
								          </div>
								          </div>
					</div>
					<div class="row">
						<div class="col-md-6">
		          <div class="form-group">
		              <input name="address" id="address" type="text" value="<?php if($userinfo['address']!=''){echo $userinfo['address'];}?>"/>
		              <label class="control-label">Address</label><i class="bar"></i>
		          </div>
		          </div>

		          	<div class="col-md-6">
		          <div class="form-group">
		              <input name="age" id="age" type="text" value="<?php if($userinfo['age']!=''){echo $userinfo['age'];}?>"/>
		              <label class="control-label">Age</label><i class="bar"></i>
		          </div>
		          </div>
		          </div>
		          <div class="row">
		          	<div class="col-md-6">
		          <div class="form-group">
		              <input name="inst_name" id="inst_name" type="text" value="<?php if($userinfo['institute_name']!=''){echo $userinfo['institute_name'];}?>"/>
		              <label class="control-label">Institute Name</label><i class="bar"></i>
		          </div>
		          </div>

		          	<div class="col-md-6">
		          <div class="form-group">
		              <input name="academic_year" id="academic_year" type="text" value="<?php if($userinfo['academic_year']!=''){echo $userinfo['academic_year'];}?>"/>
		              <label class="control-label">Academic year</label><i class="bar"></i>
		          </div>
		          </div>
		          </div>
		          <div class="row">
		          	<div class="col-md-12">
		          <div class="form-group timezone">


                       <select class="form-control timezone-options" id="time_zone" name="time_zone">
                         <option value=" ">Select timezone</option>
                         <?php
                         //print_r($timezone);die;
                         if(!empty($timezone1)){
                         foreach ($timezone1 as $val) {
                         ?>
                         <option <?php if(isset($userinfo['timezone']) && $val['timezone']==$userinfo['timezone']){;?>selected <?php };?> value="<?php echo $val['timezone'];?>" <?php echo set_select('timezone', $val['timezone']); ?>><?php echo $val['name'];?></option>

                         <!-- <option value="<?php echo $val['timezone'];?>"> -->
                         <?php
                         }
                         }
                         ?>
                       </select>
                       <label class="control-label">select Timezone</label>







		            <!--  <select class="selectpicker " id="sel1" name="time_zone">
		                             <option value="" selected>Select Height</option>

		                             <?php

		                             if(!empty($timezone)){
		                             foreach ($timezone as $val) {
		                             ?>
		                             <option value="<?php echo $val['timezone'];?>"><?php echo $val['name'];?></option>
		                             <?php
		                             }
		                             }
		                             ?>
		                           </select> -->

		          </div>
		          </div>
		          </div>

		          <div class="text-center btn-list">
		           <button type="submit" class="btn blue sm full-width">submit</button>
		          </div>

		      </form>
		      </div>
		  </div>
		</div>

	<div class="modal fade"  class="modal fade do_profile_complete_modal" id="do_profile_complete_modal" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">

		      <div class="text-center">
		     <img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/big_thumbs/<?php echo $tenant_info['logo'];?>" alt="">
		      <h4>::: Complete your profile :::</h4>
		      <div>Check your profile and complete</div>

		      </div>
		  </div>

	</div>
	</div>
	</div>

		<?php $this->load->view('template/footer');?>


	<script type="text/javascript">
	$('#edit-profile').on('init.field.fv', function(e, data) {
	            // data.fv      --> The FormValidation instance
	            // data.field   --> The field name
	            // data.element --> The field element

	            var $parent = data.element.parents('.form-group'),
	                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

	            // You can retrieve the icon element by
	            // $icon = data.element.data('fv.icon');

	            $icon.on('click.clearing', function() {
	                // Check if the field is valid or not via the icon class
	                if ($icon.hasClass('glyphicon-remove')) {
	                    // Clear the field
	                    data.fv.resetField(data.element);
	                }
	            });
	        }).
	formValidation({
	  message: 'This value is not valid',
	  icon: {
	    valid: 'fa fa-check',
	    invalid: 'fa fa-close',
	    validating: 'fa fa-refresh'
	  },
	  live: 'enabled',
	  trigger: null,
	  verbos:'false',
	    fields: {
	      age: {
	        // It still work even if you use the selector option
	        //selector: '#password',
	        validators: {
	            notEmpty: {
	            message: 'The age is required and cannot be empty'
	          }
	        }
	      },
	      name: {
	        validators: {
        	    notEmpty: {
        	    message: 'The name is required and cannot be empty'
        	  }
	        }
	      },
  	      username: {
  	        validators: {
          	    notEmpty: {
          	    message: 'The user name is required and cannot be empty'
          	  }
  	        }
  	      },
  	      inst_name: {
  	        validators: {
          	    notEmpty: {
          	    message: 'The Institute Name is required and cannot be empty'
          	  }
  	        }
  	      },
  	      address: {
  	        validators: {
          	    notEmpty: {
          	    message: 'The Address is required and cannot be empty'
          	  }
  	        }
  	      },
  	      academic_year: {
  	        validators: {
          	    notEmpty: {
          	    message: 'The Academic year is required and cannot be empty'
          	  }
  	        }
  	      },
  	      princy_name: {
  	        validators: {
          	    notEmpty: {
          	    message: 'The Principal Name is required and cannot be empty'
          	  }
  	        }
  	      },

	    }
	}).on('success.form.fv', function(e) {
	        // Prevent form submission
		/*$('#edit-profile').submit(function() {*/
			var data = new FormData($(this)[0]);

			console.log(data);
			$.ajax({
				url: '<?php echo base_url();?>registration/profile_detail_save',
				type: 'POST',
				data: data,
				async: false,
				processData: false, // important
				contentType: false,
				success:function(data)
				{
					console.log(data);
					if(data==1)
					{
						$("#successMsg").text('Profile information save successfully');
						var explode = function(){
						    $("#successMsg").text('');
					window.location='<?php echo base_url();?>registration/user_profile_display';
						};
						setTimeout(explode, 2000);


					}
				}
			})
			return false;




		});
	</script>
		<script>
				var btnCust = '';
				$("#avatar-1").fileinput({
				overwriteInitial: true,
				//maxFileSize: 1500,
				showClose: false,
				showCaption: false,
				browseLabel: '',
				/*removeLabel: '',*/
				browseIcon: '<i class="fa fa-edit" ></i>',
				/*removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
				removeTitle: 'Cancel or reset changes',*/
				elErrorContainer: '#kv-avatar-errors-1',
				msgErrorClass: 'alert alert-block alert-danger',
		<?php
		if(!empty($userinfo['photo']))
		{ ?>
		defaultPreviewContent: '<img src="<?php echo base_url();?>uploads/<?php echo $userinfo['tenant_id']?>/users_photo/<?php echo $userinfo['id']?>/thumbs/<?php echo $userinfo['photo']?>" id="blah" alt="avatar">',
		<?php
		}
		else
		{
		?>
		defaultPreviewContent: '<img src="<?php echo base_url();?>assets/images/no-image.jpg" id="blah" alt="avatar" >',
		<?php } ?>
		layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		allowedFileExtensions: ["jpg", "png", "gif"]
		});
		$('#avatar-1').change(function(){

		var input = $('#avatar-1')[0];
		if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
		$('#blah').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
		}
		});
		$('#avatar-1').change(function(){
			var data = new FormData($('#profile_change')[0]);
		$.ajax({
			url: '<?php echo base_url();?>registration/user_profile_upload',
			type: 'POST',
			data: data,
			processData: false, // important
			contentType: false, // important
			success:function(res)
			{
				if(res==1)
				{
					alert("Profile Picture Uploaded Successfully");
				}
				else if(res==2)
				{
					alert("Error Occured for uploading image");
				}
				else if(res==3)
				{
					alert("Error Occured for uploading image");
				}
			}
		});
		return false;
		});
		</script>
	</body>

<!-- Mirrored from techlinqs.com/html/lincoln/teacher-detail.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Oct 2016 06:05:32 GMT -->
</html>