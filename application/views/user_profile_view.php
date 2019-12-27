<?php $this->load->view('template/header');?>
<style>


.table11 ul {
  list-style-type: none;
  width: 100%;
  display: table;
  table-layout: fixed;
}

.firstUl li{
  font-weight: bold;
}

.table11 li {
  display: table-cell;
  width: 50%;
  border: 1px solid #ccc;
  padding: 6px;
}
</style>

<style type="text/css">
.section-title {
    padding-bottom: 30px !important;
    margin-bottom: 0px !important;
}

.align-center {
    text-align: center;
}
.container-center {
    width: 1008px;
    margin: 0 auto;
}
.col-row {
    margin-bottom: 0;
}

.col-row {
    margin-right: -24px;
}
.no-touch .animated, .no-touch .animated-start {
    opacity: 0;
}
.fadeInRight {
    -webkit-animation-name: fadeInRight;
    animation-name: fadeInRight;
}
.animated {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
}
.one-third {
    width: 200px; /*320px;*/
}
.one-half, .one-third, .two-third, .two-third-outer, .one-fourth, .three-fourth, .one-sixth, .five-sixth {
    float: left;
    margin-right: 10px; /*24px;*/
}
.cog-tl {
    background: url(../../img/box-images/cog-tl.png) no-repeat top left;
}
.content-box, .team-member-type-2 {
    border: 1px solid #e4e4e4;
    padding: 60px 20px 20px 20px;
    margin-top: 60px;
    position: relative;
    margin-bottom: 20px;
    text-align: center;
}
.boxshadow .portrait, .boxshadow .content-box-icon {
    border-radius: 50%;
    -moz-box-shadow: 0 0 0 5px #fff, 0 0 1px 5px #888, 0 0 0 12px #fff;
    -webkit-box-shadow: 0 0 0 5px #fff, 0 0 1px 5px #888, 0 0 0 12px #fff;
    box-shadow: 0 0 0 5px #fff, 0 0 1px 5px #888, 0 0 0 12px #fff;
}

.content-box-icon {
    line-height: 100px !important;
}
.content-box-icon, .team-member-type-2 .portrait {
    position: absolute;
    top: -60px;
    left: 50%;
    margin-left: -60px;
}
.content-box-icon {
    width: 110px;
    height: 110px;
    line-height: 110px;
    color: #373737;
    text-align: center;
    font-size: 48px;
    background: #f4f4f4;
    -webkit-transition: all .2s linear;
    -moz-transition: all .2s linear;
    -o-transition: all .2s linear;
    -ms-transition: all .2s linear;
    transition: all .2s linear;
}
.five-sixth img, .three-fourth img, .two-third img, .one-half img, .one-third img, .one-fourth img, .one-sixth img {
    max-width: 100%;
    vertical-align: middle;
}

.five-sixth img, .three-fourth img, .two-third img, .one-half img, .one-third img, .one-fourth img, .one-sixth img {
    max-width: 100%;
}
img {
    height: auto;
}
.content-box .box-title, .team-member-type-2 .member-details {
    float: none;
    text-align: center;
    margin-bottom: 10px;
}

.member-details, .box-title {
    float: left;
}
.box-title h3 {
    min-height: 60px;
}

.member-details h4, .box-title h3 {
    margin-top: 5px;/*15px;*/
}
.member-details h4, .testimony-author h4, .box-title h3 {
    margin-bottom: 0;
}
.box-title h3 {
    font-size: /*16px*/12px;
    text-transform: uppercase;
    font-weight: 700;
    color: #373737;
}
h3 {
    text-transform: none !important;
}
h3 {
    color: #373737;
    font-size: 16px;
    line-height: 22px;
    text-transform: uppercase;
    font-weight: normal;
}
h1, h2, h3, h4, h5, h6 {
    font-family: 'Open Sans', sans-serif;
    font-weight: 700;
    margin-bottom: 10px;
}
.box-title h4 {
    min-height: 50px;
}

h4 {
    font-size: 14px;
    font-weight: normal;
}
.medium-btn {
    margin-right: 2px;
}

.button {
    background: #c52026;
}
.medium-btn {
    border: medium none;
    cursor: pointer;
    margin-bottom: 2px;/*15px;*/
    /* margin-right: 15px; */
    padding: 10px 15px;
    font-weight: 700;
}
.medium-btn {
    font-size: 11px;
    padding: 7px 11px;
    text-transform: uppercase;
}
.button {
    color: #f7f7f7;
    background: #e2492f;
    -webkit-transition: background-color .2s linear;
    -moz-transition: background-color .2s linear;
    -o-transition: background-color .2s linear;
    -ms-transition: background-color .2s linear;
    transition: background-color .2s linear;
    display: inline-block;
    margin-bottom: 2px;/*20px;*/
}
a {
    color: #c52026;
}
a {
    color: #e2492f;
    text-decoration: none;
    -webkit-transition: color .1s linear;
    -moz-transition: color .1s linear;
    -o-transition: color .1s linear;
    -ms-transition: color .1s linear;
    transition: color .1s linear;
}

</style>
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
$merged_data = array();
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

$CI=& get_instance();
$userLevelData = $CI->userprofile_model->fetch_user_level_data($userinfo['user_level_id']);
$groupData = $CI->userprofile_model->fetch_user_group_data($userinfo['group_id']);


?>
<input type="hidden" id="current_date" value="<?php echo $current_date?>">
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
                    <div class="col-md-6" style="display:none;">
                      <div class="form-group">
                        <div><b>Age:</b>  <?php if($userinfo['age']!=''){
                          //echo $userinfo['age'];
                        }?></div>

                      </div>
                    </div>
                    <div class="col-md-6" style="display:none;">

                      <div class="form-group">
                        <div><b>Institute Name:</b>  <?php if($userinfo['institute_name']!=''){
                          //echo $userinfo['institute_name'];
                        }?></div>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div><b>Email:</b>  <?php if($userinfo['email_id']!=''){echo $userinfo['email_id'];}?></div>

                      </div>
                    </div>
                    <div class="col-md-6" style="display: none;">

                      <div class="form-group">
                        <div><b>Tenant Id:</b>  <?php if($userinfo['tenant_id']!=''){echo $userinfo['tenant_id'];}?></div>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div><b>Organization :</b>  <?php if($tenant_info['bind_organization'] == '1'){ //if($userinfo['organization']!=''){
                          echo $tenant_info['name']; //$userinfo['organization'];
                        }?></div>

                      </div>
                    </div>
                    <div class="col-md-6">

                      <div class="form-group">
                        <div><b>City:</b>  <?php if($userinfo['city']!=''){
                          echo $userinfo['city'];
                        }?></div>

                      </div>
                    </div>
                  </div>

                  <div class="row" style="display:none;">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div><b>Your Level:</b>  <?php echo end($userLevelData)['user_level_name']; ?></div>

                      </div>
                    </div>
                    <div class="col-md-6">

                      <div class="form-group">
                        <div><b>Group:</b>  <?php echo end($groupData)['group_name']; ?></div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              <!-- Teacher Subject -->
            </div>

            <div class="row">
              <div class="t-table-widget" style="text-align:center">
                    <div id="" class="block block-views">
                      <div class="content">
                        <div class="separator-1">&nbsp;</div>  
                        <div class="section-title align-center">
                          <h2>All Available Assessments</h2>
                        </div>
                        <section class="content"> 
                          <div class="container-center">        
                            <div class="col-row">
                              <div class="view view--ct-products-tools-reference view-id-_ct_products_tools_reference view-display-id-block_product_additional view-dom-id-783f10c2880964bc4a4c3438e9738548">
                                <div class="col-row">
                                  <?php
                                    if(isset($all_quiz_info) && !empty($all_quiz_info)) {
                                      foreach ($all_quiz_info as $mergedkey => $mergedvalue) {
                                        if(!empty($mergedvalue)){
                                  ?>
                                          <div class="one-third animated fadeInRight" data-animation="fadeInRight" style="opacity: 1;">
                                            <div class="content-box cog-tl">
                                              <div class="content-box-icon" style="<?php if(in_array($mergedvalue['id'], $uniquePids)){ echo 'box-shadow: 0 0 0 5px #fff, 0 0 1px 5px #888, 0 0 0 12px #e2492f !important;'; }?>">
                                                <img typeof="foaf:Image" src="<?php echo base_url().'uploads/assesment/'.$mergedvalue['assessment_image']; ?>" width="234" height="204" alt="">
                                              </div>
                                              <div class="box-title">
                                                <h3 style="word-wrap: break-word;"><?php echo $mergedvalue['quiz_name']; ?></h3>
                                                <!-- <h4 style="word-wrap: break-word;"><?php //if(isset($mergedvalue['assessment_information']) && !empty($mergedvalue['assessment_information'])) echo $mergedvalue['assessment_information']; ?></h4> -->
                                              </div>
                                              <a class="button medium-btn" target="_blank" href="<?php if(isset($mergedvalue['url']) && !empty($mergedvalue['url'])) echo $mergedvalue['url']; ?>"> Learn More</a>
                                            </div>
                                          </div>
                                  <?php }} }?>
                                  <!-- end -->
                                </div>
                              </div>
                            </div>
                          </div>
                        </section>
                        <!-- end -->
                      </div>
                    </div>
                  </div>

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
                  <h3>Inprogress Assessments</h3>
                  <div class="table-responsive table-bordered">
                    <table class="table">
                      <thead>
                        <tr>

                          <th>Exam Name</th>
                          <th>End Date</th>
                          <th>Group</th>
                          <th>Level</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <?php
                    }
                    foreach ($inprogress_quiz as $key => $val) {
                    $merged_data[] = $val;
                    $starttime = $val['start_time'];
                    $endtime = $val['end_time'];
                    $start_dt = new DateTime($starttime, new DateTimeZone($tz_from));
                    $start_dt->setTimeZone(new DateTimeZone($tz_to));
                    $startdatetime=$start_dt->format($format);

                    $end_dt = new DateTime($endtime, new DateTimeZone($tz_from));
                    $end_dt->setTimeZone(new DateTimeZone($tz_to));
                    $enddatetime=$end_dt->format($format);
                    $groupData = $CI->userprofile_model->fetch_exam_group_data($val['exam_id']);
                    $examLevelData = $CI->userprofile_model->quiz_level_data($val['exam_id']);
                    $groupName = end($groupData)['group_name'];
                    $examLevel = end($examLevelData)['user_level_name'];

                    if(strtotime($current_date)<strtotime($val['end_time']))
                    {
                      ?>
                      <tbody>
                        <tr style="text-align: left">

                          <td><?php if($val['exam_name']!=''){echo $val['exam_name'];}?></td>
                          <td><?php if($val['end_time']!=''){echo $enddatetime;}?></td>
                          <td><?php echo $groupName;?></td>
                          <td><?php echo $examLevel;?></td>
                          <td style="cursor:pointer"><a href="<?php echo base_url()?>quiz/start/<?php echo $val['quiz_id'];?>/<?php echo $val['exam_id'];?>/?rert=1">Resume</a></td>
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
            <h3>Available Assessments</h3>
            <div class="table-responsive table-bordered t-table-widget">
              <table class="table">
                <thead>
                  <tr>
                          <!-- <th>Exam ID</th>
                            <th>Quiz ID</th> -->
                            <th>Exam Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Group</th>
                            <th>Level</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <?php
                      }
                      // echo "<pre/>"; print_r($upcoming_quiz);die;
                      foreach ($upcoming_quiz as $key => $val) {
                      $merged_data[] = $val;
                      $groupData = $CI->userprofile_model->fetch_exam_group_data($val['id']);
                      $examLevelData = $CI->userprofile_model->quiz_level_data($val['id']);

                      $starttime = $val['start_date'];
                      $endtime = $val['end_date'];
                      $start_dt = new DateTime($starttime, new DateTimeZone($tz_from));
                      $start_dt->setTimeZone(new DateTimeZone($tz_to));
                      $startdate=$start_dt->format($format);
                      $end_dt = new DateTime($endtime, new DateTimeZone($tz_from));
                      $end_dt->setTimeZone(new DateTimeZone($tz_to));
                      $enddate=$end_dt->format($format);
                      $groupName = end($groupData)['group_name'];
                      $examLevel = end($examLevelData)['user_level_name'];
                      if(strtotime($current_date)<strtotime($val['end_date']))
                      {
                        ?>
                        <tbody>
                          <tr style="text-align: left">


                            <td><?php if($val['exam_name']!=''){echo $val['exam_name'];}?></td>
                            <td><?php if($val['start_date']!=''){echo $startdate;}?></td>
                            <td><?php if($val['end_date']!=''){echo $enddate;}?></td>
                            <td><?php echo $groupName;?></td>
                            <td><?php echo $examLevel;?></td>


                            <?php if($userinfo['is_profile_completed']==0){?>
                            <td data-toggle="modal" data-target="#edit_profile-modal" style="cursor:pointer">view assessment Detail</td>
                            <?php }else
                            {

                              ?>
                              <td style="cursor:pointer"><a onclick="get_exam_time(<?php echo $val['quiz_id'];?>,<?php echo $val['id'];?>);">Take Assessment</a></td>
                              <?php }?>
                            </tr>
                            <div class="modal time-modal fade" id="time_remaining-modal" style="background: transparent none repeat scroll 0% 0% ! important;">
                              <div class="modal-content position-center-center tc-hover text-center">
                                <button type="button" class="close" data-dismiss="modal"  style="position: relative; margin-top: -20px; margin-right: -23px;">&times;</button>
                                <img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/big_thumbs/<?php echo $tenant_info['logo'];?>" alt="">

                                <h5 class="quiz-start">This exam will start <?php if($val['start_date']!=''){echo $startdate;}?></h5>
                              </div>
                            </div>




                          </tbody>
                          <?php }
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
                      <h3>Expired Assessment</h3>
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
                      foreach ($upcoming_quiz as $key => $val) {
                      $merged_data[] = $val;
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
              <?php }
              ?>
              <!-- expired quiz -->


              <!-- past quiz -->
              <?php
              if(!empty($past_quiz))
              {?>
                <div class="t-table-widget" style="text-align:center">
                  <h3>Attempted Assessments</h3>
                  <div class="table-responsive table-bordered">
                    <table class="table ">
                      <thead>
                        <tr>

                          <th>Exam Name</th>
                          <th>Test Date</th>
                          <th>Group</th>
                          <th>Level</th>
                          <th style="text-align:center">Action</th>
                          <th style="text-align:center">Review</th>

                          <!-- <th>Download Certificate</th> -->
                        </tr>
                      </thead>

                      <?php
                      $md = 1;
                      foreach ($past_quiz as $key => $val) {
                      $merged_data[] = $val;
                      $starttime = $val['start_time'];
                      //  $endtime = $val['end_date'];
                      $groupData = $CI->userprofile_model->fetch_exam_group_data($val['exam_id']);
                      $examLevelData = $CI->userprofile_model->quiz_level_data($val['exam_id']);

                      $start_dt = new DateTime($starttime, new DateTimeZone($tz_from));
                      $start_dt->setTimeZone(new DateTimeZone($tz_to));
                      $startdate1=$start_dt->format($format);
                      $groupName = end($groupData)['group_name'];
                      $examLevel = end($examLevelData)['user_level_name'];
                      ?>
                      <tbody>
                        <tr style="text-align: left">

                          <td><?php if($val['exam_name']!=''){echo $val['exam_name'];}?></td>
                          <td><?php if($val['start_time']!=''){echo $startdate1;}?></td>
                          <td><?php echo $groupName;?></td>
                          <td><?php echo $examLevel;?></td>
                          <?php /* if(file_exists("./admin/".str_replace(' ', '_', $userinfo['name'])."_".str_replace(' ', '_', $val['exam_name']).".pdf")){?>
                          <td style="cursor:pointer;"><a  href="<?php echo base_url();?>admin/<?php echo str_replace(' ', '_', $userinfo['name']);?>_<?php echo str_replace(' ', '_', $val['exam_name']);?>.pdf"><i class="fa fa-download"></i></a></td>
                          <?php } */?>


                          <td style="cursor:pointer">
                          <?php if($val['retry_attempt_flag'] == '1') { ?>
                            <!-- <a  style="background: #005D9B;color: #FFF; font-size: 15px;text-align: center;padding: 5px 0px;border-radius: 32px;" onclick="get_exam_time(<?php //echo $val['quiz_id'];?>,<?php // echo $val['exam_id'];?>, 'ret');"><b>Retry Assessment Now</b></a> -->
                            
                              <a  style="background: #005D9B;color: #FFF; font-size: 15px;text-align: center;padding: 5px 0px;border-radius: 32px;" href="#" data-toggle="modal" data-target="#previousExamsModel_<?php echo $md;?>"  data-keyboard="false" data-backdrop="static" data-examid="<?php  echo $val['exam_id'];?>" data-quizId="<?php echo $val['quiz_id'];?>"><b>Retry Assessment</b></a>
                          <?php } ?>

                          </td>
                          <td style="cursor:pointer">
                              <a target="_blank" style="background: #005D9B;color: #FFF; font-size: 15px;text-align: center;padding: 5px 0px;border-radius: 32px;" href="<?php echo base_url();?>quiz/review_options/<?php echo $val['quiz_id'].'/'.$val['exam_id'];?>"><b>Review Your Answers</b></a>
                          </td>
                        </tr>
                      </tbody>

                      <!-- Previous attempted exams -->
                      <div class="modal fade  no-bgs" id="previousExamsModel_<?php echo $md;?>">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Previous list of marks for this Assessment</h4>
                            </div>
                            <div class="modal-body">
                              <div class="table11">
                                <ul class="firstUl">
                                  <li class="titile">No of Attempted</li>
                                  <li class="odd">Number of questions</li>
                                  <li class="even">Attempted qestions</li>
                                  <li class="odd">Correct Answers</li>
                                  <li class="even">Total Marks</li>
                                  <li class="even">Percentage</li>
                                  <li class="even">Attempted Date</li>
                                </ul>


                                  <?php
                                  $qid = $val['quiz_id'];
                                  $eid = $val['exam_id'];
                                  $uid = $val['user_id'];
                                  $tid = $val['tenant_id'];


                                  $retryQuizLog=$this->modelbasic->get_allRetriedLogs('quiz_retry_log',$eid, $qid,$uid,$tid,0);

                                  $nos = 1;
                                  if(!empty($retryQuizLog)){
                                  foreach ($retryQuizLog as $retryQuizData) {


                                  ?>
                                                                  <ul>
                                  <li class="titile">Attempt-<?php echo $nos;?></li>
                                  <li class="odd"><?php echo $retryQuizData['no_of_question'];?></li>
                                  <li class="evev"><?php echo $retryQuizData['attempt_question'];?></li>
                                  <li class="odd"><?php echo $retryQuizData['correct_answer'];?></li>
                                  <li class="even"><?php echo $retryQuizData['total_marks'];?></li>
                                  <li class="odd"><?php echo number_format($retryQuizData['percentage'],2);?>%</li>
                                  <li class="odd"><?php echo $retryQuizData['end_time'];?></li>

                                  </ul>
                                  <?php $nos++;
                                } ?>


                            </div>
                            <?php } else {?>
                            <p style="color: green;margin-top: 12px;"> Nothing Attempted</p>

                            <?php  }?>


                            <div class="modal-footer" >

                              <?php //if(count($retryQuizLog) >= 3 ){?>
                              <?php if(count($retryQuizLog) >= $val['retry_attempt'] ){?>
                                <p style="color: red"><b> Only <?php echo $val['retry_attempt']; ?> times allowed to Retry Assessment.</b></p>
                              <?php  } else {?>
                                <a  class="btn btn-primary" onclick="get_exam_time(<?php echo $val['quiz_id'];?>,<?php echo $val['exam_id'];?>, 'ret');"><b>Retry Assessment </b></a>

                              <?php  } ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php
                      $md++;
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
              <input name="contact_no" id="contact_no" type="text" value="<?php if($userinfo['contact_no']!=''){echo $userinfo['contact_no'];}?>"/>
              <label class="control-label">Contact number</label><i class="bar"></i>
            </div>
          </div>

        </div>
        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
              <input name="organization" id="organization" type="text" value="<?php if($userinfo['organization']!=''){echo $userinfo['organization'];}?>"/>
              <label class="control-label">Organization</label><i class="bar"></i>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <input name="city" id="city" type="text" value="<?php if($userinfo['city']!=''){echo $userinfo['city'];}?>"/>
              <label class="control-label">City</label><i class="bar"></i>
            </div>
          </div>
            <!-- <div class="col-md-12">
              <div class="form-group">
                  <input name="address" id="address" type="text" value="<?php //if($userinfo['address']!=''){//echo $userinfo['address'];}?>"/>
                  <label class="control-label">Address</label><i class="bar"></i>
              </div>
            </div> -->

            <div class="col-md-6" style="display: none">
              <div class="form-group">
                <input name="age" id="age" type="text" value="<?php if($userinfo['age']!=''){echo $userinfo['age'];}?>"/>
                <label class="control-label">Age</label><i class="bar"></i>
              </div>
            </div>
          </div>
          <div class="row"  style="display: none">
            <div class="col-md-6" style="display: none">
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
          <div class="row" style="display: none;">
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
    }


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
<script>
function get_exam_time(quiz_id,exam_id, retryExam='')
{
  $.ajax({
    url: '<?php echo base_url();?>quiz/get_exam_time',
    type: 'POST',

    data: {quiz_id: quiz_id , exam_id:exam_id},
    success:function(data)
    {
      if(data==1)
      {
        if(retryExam){
          window.location="<?php echo base_url()?>quiz/index/"+quiz_id+"/"+exam_id+"/?qe=rt";
        } else{
          window.location="<?php echo base_url()?>quiz/index/"+quiz_id+"/"+exam_id;
        }

      }
      if(data==2)
      {
        $('#time_remaining-modal').modal('show');
      }

    }
  });
}
</script>
</body>

</html>

