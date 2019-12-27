<?php $this->load->view('template/header');?>
<style>
table, td, th {
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 15px;
}
</style>
     <?php
     if($this->session->userdata('user_timezone')!='')
     {
         $timezone=$this->session->userdata('user_timezone');
     }else
     {
         $timezone=$this->session->userdata('tenant_timezone');
     }
     if($timezone=='')
     {
      $timezone="Asia/Kolkata";
     }
     $tz_from = 'UTC';
     $tz_to = $timezone;
     $format = 'Y-m-d h:i a';
     $starttime = $exam_detail['start_date'];
     $endtime = $exam_detail['end_date'];

     $start_dt = new DateTime($starttime, new DateTimeZone($tz_from));
     $start_dt->setTimeZone(new DateTimeZone($tz_to));
     $startdate=$start_dt->format($format);

     $end_dt = new DateTime($endtime, new DateTimeZone($tz_from));
     $end_dt->setTimeZone(new DateTimeZone($tz_to));
     $end_date=$end_dt->format($format);

     ?>       <!-- Inner Banner -->

            <input type="hidden" value="<?php echo $quiz_detail['id'];?>" id="quizId" name="quizId">
             <input type="hidden" value="<?php echo $exam_id['exam_id'];?>" id="exam_id" name="exam_id">
            <div class="inner-banner green-bg">
                <div class="container">
                    <div class="inner-page-heading style-2">
                        <div class="main-heading style-2 h-white p-white">
                            <h2> <?php if($exam_detail['exam_name']!=''){echo $exam_detail['exam_name'];}?></h2>
                            <span class="date"><i class="fa fa-calendar"></i><?php echo date('Y-m-d');?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Inner Banner -->

        </header>
        <!-- Header -->
        <!-- Main Content -->
        <main class="main-content">

            <!-- Event Detail -->
            <div class="event-detail-holder">
                <div class="container">
                    <div class="row">

                        <!-- Event Price Figuer -->
                        <div class="col-lg-3 col-md-3 col-sm-5">

                            <!-- Price Figure -->
                            <div class="price-figure z-depth-2">
                                <img src="<?php echo base_url();?>assets/images/event-detail/img-01.jpg" alt="">
                                <div class="Price-Figure-deatil style-2">

                                    <ul>
                                        <li>
                                            <span>START:</span>
                                            <span><?php if($exam_detail['start_date']!=''){echo $startdate;}?></span>
                                        </li>
                                        <li>
                                            <span>END:</span>
                                            <span><?php if($exam_detail['end_date']!=''){echo $end_date;}?></span>
                                        </li>

                                        <?php if($exam_detail['duration']!='')
                                        {
                                        $time=explode(':',$exam_detail['duration'] );
                                        ?>
                                        <li>
                                            <span>DURATION:</span>
                                            <span><?php if($time[0] != 00){ echo $time[0].' hour ';} if($time[1]!=00){echo $time[1].' min ';} if($time[2]!=00){echo $time[2].'sec'; }?></span>
                                        </li>
                                        <?php }?>
                                    </ul>
                                    <?php if(!empty($security_feature) &&$security_feature['security']!='' && $security_feature['security']==1){ ?>
                                        <a class="btn blue sm full-width" href="#" data-toggle="modal" data-target="#verification-modal" data-backdrop="static" data-keyboard="false" aria-label="Close">Take this Assessment</a>
                                        <?php }else{ ?>
                                            <a class="btn blue sm full-width"  href="#" data-toggle="modal" data-target="#exam-aggreeModel"  data-keyboard="false" data-backdrop="static" aria-label="Close">Take this Assessment</a>
                                        <?php }?>
                                    <br/><br/><?php
                                    if(!empty($mock_status) && $mock_status['mock']==1)
                                    {
                                    ?>
                                    <a class="btn orange sm full-width" href="<?php echo base_url();?>quiz/start/<?php echo $quiz_detail['id'];?>/<?php echo $exam_id['exam_id'];?>/1">Take Mock Test</a>
                                    <?php
                                    }?>
                                </div>
                            </div>
                            <!-- Price Figure -->

                            <!-- Time Acounter -->
                           <!--  <ul id="countdown-1" class="countdown style-2">
                                <li><span class="days">00</span>Days</li>
                                <li><span class="hours">00</span>Hours</li>
                                <li><span class="minutes">00</span>Mins</li>
                                <li><span class="seconds">00</span>Secs</li>
                            </ul> -->
                            <!-- Time Acounter -->

                        </div>
                        <!-- Event Price Figuer -->

                        <!-- Speakers Detail -->
                        <div class="col-lg-9 col-md-9 col-sm-7">
                            <div class="single-event-detail">
                                <!-- Speakers -->
                                <div class="speakers-list">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="time-address">
                                                <h4><i class="fa fa-calendar"></i>Date</h4>
                                                <p>Start: <?php if($exam_detail['start_date']!=''){echo $startdate;}?></p>
                                                <p>End: <?php if($exam_detail['end_date']!=''){echo $end_date;}?></p>
                                            </div>

                                              <div class="qDeti" style="margin-top: 12px;">


                                              <p>1. This assessment is a Multiple Choice questions format.<br> 2. Each Question may have more than one correct answer.
                                              <br>3. Click on Finish Exam once you are done answering all questions</p>

                                              </div>



                                        </div>
                                        <div class="col-sm-6">
                                                                                        <div class="time-address">
                                                <h4><i class="fa fa-clock-o"></i>Time</h4>
                                               <?php if($exam_detail['duration']!='')
                                               {
                                               $time=explode(':',$exam_detail['duration'] );
                                               ?>

                                                   <p>DURATION:
                                                   <?php if($time[0] != 00){ echo $time[0].' hour ';} if($time[1]!=00){echo $time[1].' min ';} if($time[2]!=00){echo $time[2].'sec'; }?></p>

                                               <?php }?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Speakers -->
<?php if($this->session->userdata('tenant_id')==30){?>
<div class="exam-details">
                                <section class="main z-depth-2">
                                  <header class="title-top">
                                    Training Material
                                  </header>
                                  <section id="quiz-details">
                                      <button>
                                        Open
                                      </button>
                                    <header class="title-exam">
                                    Training Material Video
                                    </header>
                                    <div id="quiz-section">
                                      <article>
                                       <div>

<iframe width="560" height="315" src="https://www.youtube.com/embed/bsjoIaKzSRY" frameborder="0" allowfullscreen></iframe>
                                       </div>
                                      </article>
                                    </div>
                                  </section>
                                  <section id="quiz-details">
                                      <button>
                                        Open
                                      </button>
                                    <header class="title-exam">
                                    Download
                                    </header>
                                    <div id="quiz-section">
                                      <article>

                                         <table>
                                           <tr>
                                             <th>Sr. No.</th>
                                             <th>Name Of File</th>
                                             <th>Action</th>
                                           </tr>
                                           <tr>
                                             <td>1</td>
                                             <td>Training Material</td>

                                             <td><a class="btn blue sm " href="<?php echo base_url();?>uploads/30/study_material/auto8.pdf">Download</a></td>
                                           </tr>
                                         </table>

                                      </article>
                                    </div>
                                  </section>
                                </section>
                              </div>
<?php } ?>
                              <div class="exam-details">

                                <section class="main z-depth-2">
                                  <header class="title-top">
                                   <?php if($quiz_detail['quiz_name']!=''){echo $quiz_detail['quiz_name'];}?>
                                  </header>
                                  <?php $i=1;
                                  if(!empty($section_detail)){
                                    foreach($section_detail as $val){?>
                                  <section id="quiz-details">
                                      <button>
                                        Open
                                      </button>
                                    <header class="title-exam">
                                     Section<?php echo $i;?>
                                    </header>
                                    <div id="quiz-section">
                                      <article>
                                      <table>
                                        <tr>
                                          <th>Section Name</th>
                                          <th>Number of Questions</th>
                                        </tr>
                                        <tr>
                                          <td><?php if($val['section_name']!=''){echo $val['section_name'];}?></td>
                                          <td><?php if($val['no_of_questions']!=''){echo  $val['no_of_questions'];}?></td>
                                        </tr>
                                      </table>

                                      </article>
                                    </div>
                                  </section>
                                  <?php $i++;
                                }
                                  }?>


                                </section>

                                </div>





                                <!-- Join Event Option -->
                                <div class="join-event-option">
                                    <ul class="btn-list">
                                     <?php
                                     if(!empty($security_feature) &&$security_feature['security']!='' && $security_feature['security']==1){ ?>
                                      <li>  <a class="btn blue sm z-depth-2 full-width" href="#" data-toggle="modal" data-target="#verification-modal" data-backdrop="static" data-keyboard="false" aria-label="Close">Take this Assessment</a></li>
                                        <?php }else{ ?>
                                           <li> <a class="btn blue sm z-depth-2 full-width" href="#" data-toggle="modal" data-target="#exam-aggreeModel"  data-keyboard="false" data-backdrop="static" aria-label="Close">Take this Assessment</a></li>
                                        <?php }
                                        if(!empty($mock_status) && $mock_status['mock']==1)
                                        {
                                        ?>
                                        <li><a class="btn white sm z-depth-2 full-width" href="<?php echo base_url();?>quiz/start/<?php echo $quiz_detail['id'];?>/<?php echo $exam_id['exam_id'];?>/1">Take Mock Test</a></li>
                                        <?php
                                        }?>
                                    </ul>
                                </div>
                                <!-- Join Event Option -->
                            </div>
                        </div>
                        <!-- Speakers Detail -->


                    </div>
                </div>
            </div>
            <!-- Event Detail -->

        </main>
        <!-- Main Content -->
        <div class="login-form">
          <div class="modal fade verification-modal" id="verification-modal">
              <div class="modal-content position-center-center tc-hover">
              <img src="<?php echo base_url();?>assets/images/logo.png" alt="">
              <h4>::: verification Key :::</h4>
              <div><span id="success_msg" style="color:green"></span></div>
              <form class="verification-form" id="verification-form" method="POST">
                <div class="form-group">
                      <input type="text" name="key" id="key"/>
                      <label class="control-label">Enter your verification Key</label><i class="bar"></i>

                       <div><span id="error_msg" style="color:#A94442"></span></div>
                  </div>

                    <button type="submit" class="btn blue sm full-width">submit</button>



              </form>
              </div>
          </div>



          </div>


<!-- Exam Agree Model -->

<div class="modal fade  no-bgs" id="exam-aggreeModel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">USER CONDUCT</h4>
      </div>
      <div class="modal-body">
        <p>You agree not to CHEAT by any means which includes asking anyone OR going on the internet and searching for answers. You agree not to add to, subtract from, or otherwise modify the Site Content, or to attempt to access any Site Content that is not intended for you. You agree not to use the Site Content in any manner that might interfere with the rights of third parties.</p>


        <!-- <div class="chkdiv">
        <input type="checkbox" id="termsChkbxs1" class="termCHk"`>

            <label for="termsChkbxs" >Agree above all terms & conditions</label>
          </div> -->

      </div>




<div class="modal-footer1" style="    display: block !important;
    text-align: right;
    margin-right: 12px;
    margin-bottom: 12px;
    border-top: 1px solid #d1d1d1;
    padding-top: 12px;" >
  <?php
    $rt=1;
    if(isset($_GET['qe']) && $_GET['qe'] == "rt"){
      $rt = "ert";
    }

  ?>
      <a class="disabled-hide btn blue sm z-depth-2" href="<?php echo base_url();?>quiz/start/<?php echo $quiz_detail['id'];?>/<?php echo $exam_id['exam_id'];?>/?rert=<?php echo $rt;?>" >Take Assessment now</a>
    </div>
    </div>
  </div>
</div>
</div>


          <!-- Exam Agree Model End -->


<?php $this->load->view('template/footer');?>
<script type="text/javascript">
  $('#verification-form').submit(function()
  {
    var quizId=$('#quizId').val();

    var exam_id=$('#exam_id').val();
    var key=$('#key').val();
   $.ajax({
        url: '<?php echo base_url();?>registration/verify_key',
        type: 'POST',
        data: {key : key,exam_id:exam_id,},
        success:function(data)
        {
            if(data==1)
            {
               window.location="<?php echo base_url();?>quiz/start/"+quizId+"/"+exam_id;
            }else
            {
                $('#error_msg').text("please enter valid verification key");
            }
        }
    })
   return false;

  });
</script>
<script type="text/javascript">
    $(document).ready(function(){

  $('header').not('.title').on('click', function(){

    var that = $(this),
        parent = that.parent(),
        closeDiv = that.siblings('#quiz-section'),
        contentHeight = closeDiv.children('article').outerHeight();

    that.parents('#quiz-details').first().toggleClass('open');
    (closeDiv.height() === 0) ? closeDiv.height(contentHeight) : closeDiv.height(contentHeight).height(0);

    closeDiv.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
      function(e) {
        var that = $(this);
        (that.css('height') !== '0px') ? that.css('height','auto') : that.css('height', '0px' );
      });
  });

});
</script>