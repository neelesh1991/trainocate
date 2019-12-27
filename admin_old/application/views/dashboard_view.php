<style>

	.table > thead > tr > th{

		vertical-align: top !important;

	}

</style>

<div class="content">

  <div class="container">

    <?php $this->load->view('common/left_nav');?>

    <div class="vd_title-section clearfix">

      <div class="vd_panel-header">

        <h1>Dashboard</h1>

       <!-- vd_panel-menu -->

      </div>

      <!-- vd_panel-header -->

    </div>

    <!-- vd_title-section -->

    <div class="vd_content-section clearfix">

      <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">

          <div class="vd_status-widget vd_bg-green widget">



            <!-- vd_panel-menu -->



            <a class="panel-body" href="<?php echo base_url();?>users">

              <div class="clearfix">

                <span class="menu-icon">

                 <i class="fa fa-users" aria-hidden="true"></i>



               </span>

               <span class="menu-value">

                 <?php if($total_users['cnt']!=''){echo $total_users['cnt'];}?>

                </span>

              </div>

              <div class="menu-text clearfix">

                Total Number of Users

              </div>

            </a>

          </div>

        </div>



   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">



          <div class="modal-dialog" style="width: 95%;">



            <div class="modal-content">



              <div class="modal-header vd_bg-blue vd_white">



                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

                <h4 class="modal-title" id="myModalLabel">Student Report</h4>

              </div>

              <div class="modal-body">









              </div>

            </div>

          </div>

        </div>





        <div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">

          <div class="vd_status-widget vd_bg-red  widget">



            <!-- vd_panel-menu -->



            <a class="panel-body" href="<?php echo base_url();?>manage_exams">

              <div class="clearfix">

                <span class="menu-icon">

                  <i class="fa fa-file-text"></i>

                </span>

                <span class="menu-value">

                 <?php if($total_exams[0]['cnt']!=''){echo $total_exams[0]['cnt'];}?>

                </span>

              </div>

              <div class="menu-text clearfix">

                Number of exam

              </div>

            </a>

          </div>                </div>

          <div class="col-lg-4 col-md-6 col-sm-6 mgbt-xs-15">

            <div class="vd_status-widget vd_bg-blue widget">

              <div class="vd_panel-menu">

                <div data-action="refresh" data-original-title="Refresh" data-rel="tooltip" class=" menu entypo-icon smaller-font"> <i class="icon-cycle"></i> </div>

              </div>

              <!-- vd_panel-menu -->



              <a class="panel-body"  href="<?php echo base_url();?>quiz">

                <div class="clearfix">

                  <span class="menu-icon">

                    <i class="fa fa-question-circle"></i>

                  </span>

                  <span class="menu-value">

                   <?php if($total_question['cnt']!=''){echo $total_question['cnt'];}?>

                  </span>

                </div>

                <div class="menu-text clearfix">

                  Number of Questions

                </div>

              </a>

            </div>

          </div>

<!-- Total Assements -->
           <div class="col-lg-4 col-md-6 col-sm-6 mgbt-xs-15">

            <div class="vd_status-widget vd_bg-blue widget" style="background: #90009B !important;">

              <div class="vd_panel-menu">

                <div data-action="refresh" data-original-title="Refresh" data-rel="tooltip" class=" menu entypo-icon smaller-font"> <i class="icon-cycle"></i> </div>

              </div>

              <!-- vd_panel-menu -->



              <a class="panel-body"  href="#" style="cursor: auto;">

                <div class="clearfix">

                  <span class="menu-icon">

                    <i class="fa fa-pencil-square-o"></i>

                  </span>

                  <span class="menu-value">

                   <?php if($total_assements!=''){
                    echo $total_assements;
                  }?>

                  </span>

                </div>

                <div class="menu-text clearfix">

                  Total number of Assessments  <br>completed by users

                </div>

              </a>

            </div>

          </div>



          <div class="col-lg-4 col-md-6 col-sm-6 mgbt-xs-15">

            <div class="vd_status-widget vd_bg-yellow widget">

              <div class="vd_panel-menu">

                <div data-action="refresh" data-original-title="Refresh" data-rel="tooltip" class=" menu entypo-icon smaller-font"> <i class="icon-cycle"></i> </div>

              </div>

              <!-- vd_panel-menu -->

            </div>

          </div>

        </div>

      </div>


      <div class="vd_content-section clearfix">


        <div class="row">

          <div class="col-md-12">

            <div class="panel widget">

              <div class="panel-heading vd_bg-grey">

                <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-flag"></i>  </span><!--  Data Tables Example -->Reports</h3>

              </div>


              <div class="panel-body table-responsive">
              <div><span id="pdfMessage" style="color:green;"><?php echo $this->session->flashdata('pdf_msg');?></span></div>
                     <!--  <a href="<?php// echo base_url();?>manage_exams/generatepdf"><button class="btn vd_btn vd_bg-twitter">Generate Certificates</button></a> -->
                     <a href="<?php echo  base_url();?>dashboard/export_to_csv/"><button class="vd_bg-blue btn  text-right" style="margin-bottom: 12px;
                     font-size: 15px;
                     font-weight: 600;
                     padding-top: 9px;
                     padding-bottom: 9px; box-shadow: 3px 6px #ccc;">Export all Assessments Report</button></a>
                     <hr>
                     <h4 style="margin-bottom: 12px;">Single Assessment Report</h4>

              <form id="search_exam_summary" method="POST">


                <div class="row">


                  <div class="col-md-5">



                     <div class="form-group">

                      <label>Select Exam:</label>

                      <select class="form-control" id="exam_id">

                      <?php if(!empty($exam_detail))

                      {

                        //print_r($total_exams);die;

                        foreach($exam_detail as $val)

                        {



                          ?>

                          <option value="<?php echo $val['id'];?>"><?php echo $val['exam_name']?></option>

                          <?php

                        }

                      }?>



                      </select>

                    </div>

                  </div>



                  <div class="col-md-5">



                    <div class="row">



                    <div class="form-group  col-md-6 col-xs-3">

                       <label>Select Marks</label>

                      <select class="form-control" id="min_marks">

                    <?php for($i=0;$i<=100;$i++){?>

                        <option value="<?php echo $i;?>"><?php echo $i;?></option>

                        <?php } ?>

                      </select>

                    </div>





                      <div class="form-group  col-md-6 col-xs-3">

                        <span  style="position: relative; top: 30px; margin-left: -21px;">To</span>



                      <select class="form-control" style="margin-top: 4px;" id="max_marks">

                       <?php for($i=0;$i<=100;$i++){?>

                       <option value="<?php echo $i;?>" ><?php echo $i;?></option>

                       <?php } ?>

                      </select>

                      </div>



                    </div>



                  </div>

                  <div class="col-md-5" style="display: none;">
                        <div class="form-group">
                           <label>Select Level:</label>
                           <select class="form-control" id="level">
                            <?php foreach ($levels as $k) {?>
                              <option value="" selected disabled hidden>Choose here</option>
                              <option value="<?= $k['level_id']?>"><?=$k['level_name']?></option>
                            <?php } ?>
                           </select>
                        </div>
                     </div>

                    <div class="col-md-2">

                        <button class="btn vd_btn vd_bg-twitter" type="submit"  style="margin-top: 26px; width:100%">Search</button>

                      </div>



                </div>

                </form>

                <div class="row"  style="padding-top: 20px; padding-bottom: 3px; margin: 0px; background: #F0F0F0">

                  <div class="col-md-3 col-sm-6">

                    <div class="panel widget">

                      <div class="panel-heading vd_bg-red">

                        <h3 class="panel-title"><span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Assigned Users</h3>

                      </div>

                      <div class="panel-body">

                        <div class="row mgbt-xs-0">

                          <div class="col-xs-8">

                            <h2 class="vd_red mgbt-xs-0" id="assigned_exams"></h2>

                            <div class="vd_grey"></div>

                          </div>

                          <div class="col-xs-4">

                            <div id="total-sparkline" class="mgtp-15 mgr-10 text-right"></div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                  <div class="col-md-3 col-sm-6">

                    <div class="panel widget">

                      <div class="panel-heading vd_bg-blue">

                        <h3 class="panel-title"><span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Attempted Users</h3>

                      </div>

                      <div class="panel-body">

                        <div class="row mgbt-xs-0">

                          <div class="col-xs-8">

                            <h2 class="vd_red mgbt-xs-0" id="attempt_user"></h2>

                            <div class="vd_grey"></div>

                          </div>

                          <div class="col-xs-4">

                            <div id="total-sparkline" class="mgtp-15 mgr-10 text-right"></div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                  <div class="col-md-3 col-sm-6">

                    <div class="panel widget">

                      <div class="panel-heading vd_bg-green">

                        <h3 class="panel-title"><span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span>Not Attempted</h3>

                      </div>

                      <div class="panel-body">

                        <div class="row mgbt-xs-0">

                          <div class="col-xs-8">

                            <h2 class="vd_red mgbt-xs-0" id="not_attempt_user"></h2>

                            <div class="vd_grey"></div>

                          </div>

                          <div class="col-xs-4">

                            <div id="total-sparkline" class="mgtp-15 mgr-10 text-right"></div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                  <div class="col-md-3 col-sm-6">

                    <div class="panel widget">

                      <div class="panel-heading vd_bg-yellow">

                        <h3 class="panel-title"><span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span>Marks Ratio</h3>

                      </div>

                      <div class="panel-body">

                        <div class="row mgbt-xs-0">

                          <div class="col-xs-8">

                            <h2 class="vd_red mgbt-xs-0" id="marks_criteria"></h2>

                            <div class="vd_grey"></div>

                          </div>

                          <div class="col-xs-4">

                            <div id="total-sparkline" class="mgtp-15 mgr-10 text-right"></div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

<!-- -->

<div class="row" id="student_report" style="margin:0">

</div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

        </div>

    </div>

  </div>

  </div>

  <!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>-->

  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

  <script>

$('#search_exam_summary').submit(function()

{

var exam_id=$('#exam_id').val();

var min_marks=$('#min_marks').val();

var max_marks=$('#max_marks').val();

var level=$('#level').val();

console.log(exam_id);console.log(min_marks);console.log(max_marks);console.log(level);

$.ajax({

  url: '<?php echo base_url();?>dashboard/search_exam_summary',

  type: 'POST',

  data: {exam_id: exam_id , min_marks:min_marks , max_marks:max_marks, level:level},

  success:function(data)

  {

    var res=jQuery.parseJSON(data);

    console.log(res);

    $('#student_report').html(res['table']);

    $('#attempt_user').html(res['user_attempt_exams']);

    $('#not_attempt_user').html(res['not_attempt']);

    $('#assigned_exams').html(res['assigned_exams']);

   $('#marks_criteria').html(res['marks_criteria']);



  }

})

return false;

});



function get_min_max_value() {

	var exam_id=$('#exam_id').val();

	var min_marks=$('#min_marks').val();

	var max_marks=$('#max_marks').val();

        var level=$('#level').val();

//	console.log(exam_id);console.log(min_marks);console.log(max_marks);

	$.ajax({

	  url: '<?php echo base_url();?>dashboard/export_to_csv',

	  type: 'POST',

	  data: {exam_id: exam_id , min_marks:min_marks , max_marks:max_marks, level:level},

	  success:function(responce)
      {
         /*var s ='<?php echo front_base_url();?>quiz/downloads/csv/users/'+responce;
         //ert(s);
       window.location.href = s*/
      }

	})

	return false;

}



function users_attempt_que_ans(user_id,quiz_id,exam_id,tenant_id) {

	$.ajax({

	  url: '<?php echo base_url();?>dashboard/users_attempt_que_ans',

	  type: 'POST',

	  data: {exam_id: exam_id , user_id:user_id , quiz_id:quiz_id , tenant_id:tenant_id},

	  success:function(responce)

	  {

	  	if (!$.isEmptyObject(responce))

	  	{



	  	 $('#myModal').modal('toggle');

	  	 var data = jQuery.parseJSON(responce);

	  	 //console.log(data);



	  	 var str = '<div class="panel widget"><div class="panel-body table-responsive"><table class="table table-hover"><thead><tr><th>#</th><th>Questions</th><th>Selected Options</th><th>Correct Answers</th></tr></thead>';



       var j = 1;



	  	 $.each( data, function ( i,  val ) {



	  	   str += '<tr><td>'+j+'</td><td class="center">'+val.question+'</td><td>'+val.selected_answer_name+'</td><td>'+val.correct_answer+'</td></tr>';

         j++;



	  	  } );







	  	 str += '</table></div></div></div>';



	  	$('#myModal .modal-body').html(str);





	  	}

	  }

	})

}



  </script>

