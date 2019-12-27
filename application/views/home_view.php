<?php
//if($tenant_info['id'] == 1){
  if($tenant_info['id'] == ''){
?>
  <h1>Access denied</h1>
<?php } else{

 $this->load->view('template/header');?>
          <?php  if(!empty($slider_info))
          {
            ?>
            <div id="main-slider" class="carousel slide carousel-fade">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <!-- Item 1 -->
                    <?php
                    $flag=1;
                    foreach($slider_info as $val){ ?>
                    <div class="item <?php if($flag==1){ echo "active"; }?>">
                        <img src="<?php echo base_url();?>uploads/<?php echo $val['tenant_id'];?>/banner/<?php echo $val['banner_image'];?>" alt="">
                        <div class="container">
                            <div class="caption position-center-center text-center h-white p-white">
                                <h1 class="font-playfair animated fadeInUp delay-1"><?php echo $val['banner_title'];?></h1>
                                <p class="animated fadeInUp delay-2"><?php echo $val['banner_text']?></p>
                                <ul class="btn-list">

                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                    $flag++;
                    } ?>
                    </div>

                        <!-- Wrapper for slides -->
                        <!-- Nan Control -->
                        <!--<a class="slider-nav next themeColor" href="#main-slider" data-slide="prev"><i class="fa fa-long-arrow-right"></i></a>
                        <a class="slider-nav prev themeColor" href="#main-slider" data-slide="next"><i class="fa fa-long-arrow-left"></i></a>-->
                        <!-- Nan Control -->
                        <!-- Indicators -->
                        <!--<ul class="carousel-indicators">
                            <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                            <li data-target="#main-slider" data-slide-to="1"></li>
                            <li data-target="#main-slider" data-slide-to="2"></li>
                        </ul>-->
                        <!-- Indicators -->
                    </div>
                    <!-- Main Slider -->


            <?php }?>
    </header>
            <!-- Header -->
        <main class="main-content">

            <!-- Why Chose Us -->
            <section class="why-chose-us tc-padding">
                <div class="container">

                    <!-- Main Heading -->
                    <div class="main-heading-holder">
                        <div class="main-heading h-white p-white">
                            <!-- <h2>Welcome to <?php //echo $tenant_info['name']?> Platform</h2> -->
                            <?php
                              $set_url = base_url();
                              $variable = substr($set_url, 0, strpos($set_url, ".")); 
                              echo "<h2>Welcome to ".ucfirst(preg_replace("/[^a-zA-Z]/", "", ltrim($variable, 'http')))." Assessment Platform</h2>"; 
                            ?>
                            <!-- <h2>Welcome to Trainocate Assessment Platform</h2> -->
                        </div>
                    </div>
                    <!-- Main Heading -->

                    <!-- Facts Row -->
                    <ul class="row homepageboxes">


                        <li class="col-lg-4 col-sm-4 col-xs-6 r-full-width">
                            <div class="facts-column" style="background: #<?php echo $tenant_info['home_box1_color'];?>">

                              <?php

                               if($tenant_info['home_box1_url'] == "signup_profile-modal"){?>


                           <h4> <a class="bt" style="text-transform: none !important" data-toggle="modal" data-target="#signup_profile-modal" href="javascript:void(0);"><?php echo $tenant_info['home_box1_name'];?></span></a></h4>

                           <?php } else if($tenant_info['home_box1_url'] == "login-modal"){?>

                           <h4> <a class="bt" style="text-transform: none !important" data-toggle="modal" data-target=".login-modal" href="javascript:void(0);"><?php echo $tenant_info['home_box1_name'];?></span></a></h4>

                           <?php  } else {?>

                            <h4> <a class="bt"target="_blank" style="text-transform: none !important"  href="<?php echo $tenant_info['home_box1_url'];?>"><?php echo $tenant_info['home_box1_name'];?></a></h4>

                           <?php }?>

                                <i class="fa"><img style="padding-left: 12px;: block;" src="<?php echo base_url();?>assets/images/create-exam.jpg"></i>
                            </div>
                        </li>

<!--box2--><!--box2-->
                        <li class="col-lg-4 col-sm-4 col-xs-6 r-full-width">
                            <div class="facts-column" style="background: #<?php echo $tenant_info['home_box2_color'];?>">

                              <?php

                               if($tenant_info['home_box2_url'] == "signup_profile-modal"){?>


                           <h4> <a class="bt" style="text-transform: none !important" data-toggle="modal" data-target="#signup_profile-modal" href="javascript:void(0);"><?php echo $tenant_info['home_box2_name'];?></span></a></h4>

                           <?php } else if($tenant_info['home_box2_url'] == "login-modal"){?>

                           <h4> <a class="bt" style="text-transform: none !important" data-toggle="modal" data-target=".login-modal" href="javascript:void(0);"><?php echo $tenant_info['home_box2_name'];?></span></a></h4>

                           <?php  } else {?>

                            <h4> <a class="bt" style="text-transform: none !important" target="_blank"> href="<?php echo $tenant_info['home_box2_url'];?>"><?php echo $tenant_info['home_box2_name'];?></a></h4>

                           <?php }?>

                                <i class="fa"><img style="padding-left: 12px;: block;" src="<?php echo base_url();?>assets/images/invite-candidate.jpg"></i>
                            </div>
                        </li>


<!-- Box3-->
                        <li class="col-lg-4 col-sm-4 col-xs-6 r-full-width">
                            <div class="facts-column" style="background: #<?php echo $tenant_info['home_box3_color'];?>">

                              <?php

                               if($tenant_info['home_box3_url'] == "signup_profile-modal"){?>


                           <h4> <a class="bt" style="text-transform: none !important" data-toggle="modal" data-target="#signup_profile-modal" href="javascript:void(0);"><?php echo $tenant_info['home_box3_name'];?></span></a></h4>

                           <?php } else if($tenant_info['home_box3_url'] == "login-modal"){?>

                           <h4> <a class="bt" style="text-transform: none !important" data-toggle="modal" data-target=".login-modal" href="javascript:void(0);"><?php echo $tenant_info['home_box3_name'];?></span></a></h4>

                           <?php  } else {?>

                            <h4> <a class="bt" style="text-transform: none !important" target="_blank" href="<?php echo $tenant_info['home_box3_url'];?>"><?php echo $tenant_info['home_box3_name'];?></a></h4>

                           <?php }?>

                                <i class="fa"><img style="padding-left: 12px;: block;" src="<?php echo base_url();?>assets/images/analyse-results.jpg"></i>
                            </div>
                        </li>


 <?php /*

                        <li class="col-lg-4 col-sm-4 col-xs-6 r-full-width">
                            <div class="facts-column">
                                <!-- <h4>Invite Candidates</h4> -->
                                <h4 ><a class="lg-btn bt" data-toggle="modal" data-target=".login-modal" href="javascript:void(0);">Login: <span style="text-transform: capitalize;">Take your assessment Now</span></a></h4>
                                <i class="fa"><img style="padding-left: 12px;: block;" src="<?php echo base_url();?>assets/images/invite-candidate.jpg"></i>
                            </div>
                        </li>
                        <li class="col-lg-4 col-sm-4 col-xs-6 r-full-width">
                            <div class="facts-column">
                                <!-- <h4>Analyze Results</h4> -->
                                <h4 ><a style="color: #FFF;" href="https://trainocate.com/courses/aws" target="_blank"> AWS Trainings</a></h4>
                                <i class="fa"><img src="<?php echo base_url();?>assets/images/analyse-results.jpg"></i>
                            </div>
                        </li>

                        <li class="col-lg-3 col-sm-3 col-xs-6 r-full-width">
                            <div class="facts-column">
                                <!-- <h4>GET CERTIFIED</h4> -->
                                <h4>Get Skilled</h4>
                                <i class="fa"><img src="<?php echo base_url();?>assets/images/interview-offer.jpg"></i>
                            </div>
                        </li>*/?>
                    </ul>
                    <!-- Facts Row -->

                </div>
            </section>
            <!-- Why Chose Us -->

<?php if($this->session->userdata('user_id')!=''){
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

  $current = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('Asia/Kolkata'));
  $current->setTimeZone(new DateTimeZone('UTC'));
  $current_date=$current->format($format);



              $i=array();
              if(!empty($inprogress_quiz))
              {
                $starttime = $val['start_time'];
                $endtime = $val['end_time'];
                $start_dt = new DateTime($starttime, new DateTimeZone($tz_from));
                $start_dt->setTimeZone(new DateTimeZone($tz_to));
                $startdatetime=$start_dt->format($format);

                $end_dt = new DateTime($endtime, new DateTimeZone($tz_from));
                $end_dt->setTimeZone(new DateTimeZone($tz_to));
                $enddatetime=$end_dt->format($format);

              foreach ($inprogress_quiz as $val) {
               if(strtotime($current_date)<strtotime($val['end_time']))
                {
                  $i[]=$val['id'];
                }
                }
                if(!empty($i))
                {?>
              <section class="comming-events tc-padding gray-bg">
                  <div class="container">

                      <!-- Main Heading -->
                      <div class="main-heading-holder">
                          <div class="main-heading">
                              <h2>Inprogress Quiz</h2>

                          </div>
                      </div>
                      <!-- Main Heading -->

                      <!-- Eventes Row -->
                      <?php
                    }
                      if(!empty($inprogress_quiz )){?>
                      <div class="row">

                          <!-- Event Column -->
                          <?php
                          foreach ($inprogress_quiz as $val) {
                           if(strtotime($current_date)<strtotime($val['end_time']))
                           {
                              ?>
                          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 r-full-width">
                              <div class="event-column z-depth-2">
                                  <img src="<?php echo base_url();?>assets/images/exam.jpg" alt="">
                                  <div class="event-detail overlay">
                                      <h4><a href="<?php echo base_url()?>quiz/start/<?php echo $val['quiz_id'];?>/<?php echo $val['exam_id'];?>"><?php if($val['exam_name']!=''){echo $val['exam_name'];}?></a></h4>
                                      <ul>
                                          <li><i class="fa fa-calendar"></i>Start Time:<?php if($val['start_time']!=''){echo $startdatetime;}?></li>
                                          <li><i class="fa fa-calendar"></i>End Time:<?php if($val['end_time']!=''){echo $enddatetime;}?></li>

                                      </ul>
                                      <a href="<?php echo base_url()?>quiz/start/<?php echo $val['quiz_id'];?>/<?php echo $val['exam_id'];?>" class="circle-btn themeColor">+</a>

                                  </div>
                              </div>
                          </div>
                          <?php
  }
                          }?>
                          <!-- Event Column -->


                      </div>
                      <?php }?>
                      <!-- Eventes Row -->

                  </div>


              </section>
<?php }?>

              <!--........................Upcoming quiz....................................-->
            <?php $i=array();
            if(!empty($upcoming_quiz))
            {
            foreach ($upcoming_quiz as $val) {
              if(strtotime($current_date)<strtotime($val['end_date']))
              {
                $i[]=$val['id'];
              }
              }
              if(!empty($i))
              {?>
            <section class="comming-events tc-padding gray-bg">
                <div class="container">

                    <!-- Main Heading -->
                    <div class="main-heading-holder">
                        <div class="main-heading">
                            <h2>Upcoming Quiz</h2>

                        </div>
                    </div>
                    <!-- Main Heading -->

                    <!-- Eventes Row -->
                    <?php
                  }
                    if(!empty($upcoming_quiz )){?>
                    <div class="row">

                        <!-- Event Column -->
                        <?php
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
                           <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 r-full-width">
                            <div class="event-column z-depth-2">

                              <?php if($userinfo['is_profile_completed']==0){?>
                               <a href="javascript:void(0);" data-toggle="modal" data-target="#edit_profile-modal">
                                 <img src="<?php echo base_url();?>assets/images/exam.jpg" alt="">
                                 <div class="event-detail overlay">
                                   <h4><?php if($val['exam_name']!=''){echo $val['exam_name'];}?></h4></a>

                            <?php }else{?>
                            <a href="javascript:void(0);" onclick="get_exam_time(<?php echo $val['quiz_id'];?>,<?php echo $val['id'];?>);">
                              <img src="<?php echo base_url();?>assets/images/exam.jpg" alt="">
                              <div class="event-detail overlay">
                                <h4><?php if($val['exam_name']!=''){echo $val['exam_name'];}?></h4></a>
                            <?php

                            }

                                  ?>


                                    <ul>
                                        <li><i class="fa fa-calendar"></i>Strat Date:<?php if($val['start_date']!=''){echo $startdate;}?></li>
                                        <li><i class="fa fa-calendar"></i>End Date:<?php if($val['end_date']!=''){echo $enddate;}?></li>

                                    </ul>

                                     <a class="circle-btn themeColor"href="javascript:void(0);">+</a>

                                </div>
                            </div>
                        </div>
                        <div class="modal time-modal fade" id="time_remaining-modal" style="background: transparent none repeat scroll 0% 0% ! important;">
                          <div class="modal-content position-center-center tc-hover text-center">
                            <button type="button" class="close" data-dismiss="modal"  style="position: relative; margin-top: -20px; margin-right: -23px;">&times;</button>
                            <img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/big_thumbs/<?php echo $tenant_info['logo'];?>" alt="">

                            <h5 class="quiz-start">This exam will start <?php if($val['start_date']!=''){echo $startdate;}?></h5>
                          </div>
                        </div>
                        <?php
}
                        }?>
                        <!-- Event Column -->


                    </div>
                    <?php }?>
                    <!-- Eventes Row -->

                </div>


            </section>
            <?php }
            }?>
            <!-- Up Comming Eventes -->


            <section class="timeline tc-padding">
            <div class="container">

              <div class="timeline-content">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="timeline-text">
                  <?php
                    if(!empty($widget_info))
                    {
                    foreach ($widget_info as $widget_info ) {
                    if($widget_info['id']==1){
                    ?>

                    <h4><i class="fa fa-flag"></i><?php echo $widget_info['widget_name'];?></h4>
                    <p><?php if($widget_info['id']==1){echo $widget_info['info'];} ?>.</p>
                  <?php
                    }
                    }
                  }?>


                  </div>
                </div>
  <!--               <div class="col-lg-4 col-md-4 col-sm-6">
                                  <div class="z-depth-2">
                                    <img src="<?php echo base_url();?>assets/images/about-02.jpg" alt="">
                                  </div>
                                </div> -->
              </div>
            </div>

            </section>


        </main>
        <!-- Main Content -->

        <div class="modal fade"  class="modal fade do_profile_complete_modal" id="do_profile_complete_modal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                  <div class="text-center">
                 <img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/thumbs/<?php echo $tenant_info['logo'];?>" alt="">
                  <h4>:::please Complete your profile :::</h4>
                    <a class="btn blue sm z-depth-2" href="javascript:void(0);" ><i class="fa fa-pencil"></i>   Edit profile
                                                    </a>

                  </div>
              </div>

        </div>
        </div>
        </div>
        <?php if(!empty($userinfo)){?>

        <div class="login-form1 text-center" >
          <div class="modal fade" id="edit_profile-modal"  >


              <div class="modal-content position-center-center tc-hover" style="padding: 20px 30px 30px;">
              <button type="button" class="close" data-dismiss="modal"  style="position: relative; margin-top: -20px; margin-right: -23px;">&times;</button>
              <img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/thumbs/<?php echo $tenant_info['logo'];?>" alt="">
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
                            <input name="contact_no" id="contact_no" type="text" value="<?php if($userinfo['contact_no']!=''){echo $userinfo['contact_no'];}?>"/>
                            <label class="control-label">Contact number</label><i class="bar"></i>
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
                    <div class="col-md-6">
                    <div class="form-group">
                        <input name="princy_name" id="princy_name" type="text" value="<?php if($userinfo['principal_name']!=''){echo $userinfo['principal_name'];}?>"/>
                        <label class="control-label">Principal Name</label><i class="bar"></i>
                    </div>
                    </div>

                   <div class="col-md-6">
                    <div class="form-group timezone">
                    <select class="form-control timezone-options" id="time_zone" name="time_zone">
                      <option value="">Select timezone</option>
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


<?php }?>
<?php $this->load->view('template/footer');

}
?>
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

          name: {
            validators: {
                notEmpty: {
                message: 'The name is required and cannot be empty'
              }
            }
          },

        contact_no: {
          message: 'The phone number is not valid',
          validators: {
              notEmpty: {
                  message: 'The phone number is required'
              },
              stringLength: {

                  min: 10,

                  max: 10,

                  message: 'The phone Number must be 10 digit long'

              },
              digits: {
                  message: 'The value can contain only digits'
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
                    if(data==1)
                    {
                        $("#successMsg").text('Profile information save successfully');
                        var explode = function(){
                            $("#successMsg").text('');
                        window.location='<?php echo base_url();?>';
                        };
                        setTimeout(explode, 5000);

                    }
                }
            })
            return false;




        });</script>
            <script>
            function get_exam_time(quiz_id,exam_id)
            {
              $.ajax({
                url: '<?php echo base_url();?>quiz/get_exam_time',
                type: 'POST',

                data: {quiz_id: quiz_id , exam_id:exam_id},
                success:function(data)
                {
                if(data==1)
                {
                  window.location="<?php echo base_url()?>quiz/index/"+quiz_id+"/"+exam_id;
                }
                if(data==2)
                {
                  $('#time_remaining-modal').modal('show');
                }

                }
              });
        }
            </script>




