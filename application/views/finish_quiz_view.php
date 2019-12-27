<?php $this->load->view('template/header');


  function recomendationsLink($link, $name){
    $link = '<div class="alert alert-warning recommand" style="margin-top:12px;">
    <strong>Based on your score, we recommend the following course to you in your learning Journey:</strong> <a href="'.$link.'" target="_blank"> '.$name.'</a>
    </div>';

    return $link;

  }

?>

<main class="main-content">
<section class="exam-finish">
<div class="container" >
<div class="row">
   <div class="col-xs-12">
     <div class="t-table-widget" id="exam-finish-holder" style="text-align:center">
		<h3>Thank You For Completing the Assessment</h3><br>

		<?php if(isset($isFinishedAlready)){ ?>
  		<h4><?php echo $isFinishedAlready;?></h4>
		<?php }?>
		<h3>  <?php if($exam_master_info['completion_message']!=''){echo $exam_master_info['completion_message'];}?></h3>

  		<?php if($exam_master_info['show_results']==1 && $mock==0){?>

		<div class="table-responsive">
    	<table class="table">
    	<tbody>
      	<tr>

          <th>Number Of Questions</th>

            <td><?php if(!empty($no_of_que) && $no_of_que['cnt']!=0){ echo $no_of_que['cnt'];}?></td>

        </tr>

        <tr>

          <th>Number Of Solved Questions</th>

            <td><?php if(!empty($attempt_que)){ echo $attempt_que['cnt'];}?></td>

        </tr>

        <tr>

          <th>Total Number Of Correct Questions</th>

            <td><?php if(!empty($correct_ans)){ echo $correct_ans['cnt'];}?></td>

        </tr>

      <tr>

          <th>Total Number Of Wrong Questions</th>

          	<td><?php if($correct_ans['cnt']!=0){$ans=$attempt_que['cnt']-$correct_ans['cnt']; echo $ans;}else{echo $attempt_que['cnt'];}?></td>

        </tr>
        <tr>

            <th>Total Marks</th>

              <td><?php if($got_marks['cnt']!=0){ echo $got_marks['cnt'];}?></td>

          </tr>

        <!-- <tr class="total-marks">

          <th>Total Marks</th>

            <td>40</td>

        </tr> -->

    </tbody>

</table>

      </div>
<?php if($attempt_que['cnt'] > 0){ ?>
      <div class="reviewbtn" style="margin-top: 12px;">
    <a target="_blank" href="<?php echo base_url();?>quiz/review_options/<?php echo $quiz_id.'/'.$examID;?>"><button type="button" class="btn btn-success">Review Your Answers</button></a>
  </div>
  <?php  } ?>

  <?php }?>






  <?php //if(isset($coupon_code) && $coupon_code!='' && $percentage >= 40){?>
  <!--<div class="row">
          <div class="col-md-6 col-md-offset-3">
              <div class="panel panel-default coupon">
                <div class="panel-footer">
                  <div class="coupon-code">  Coupon Code: <b><?php //echo $coupon_code;?></b></div>
                </div>
              </div>
        </div>
      </div>-->
  <?php //}?>

     <?php

    //Foundational - AWS Cloud Practitioner

    if(in_array(58, $grpInfo) && $exam_master_info['user_level_id'] == 1){

     /*echo '<div class="alert alert-warning recommand">
    <strong>Based on your score, we recommend the following course to you in your learning Journey:</strong> <a href="https://trainocate.com/courses/AWS/AWS-ARC" target="_blank"> Cloud Architect Associate</a>
    </div>';*/
    echo recomendationsLink('https://trainocate.com/courses/AWS/AWS-ARC', 'Architecting on AWS');

     } elseif(in_array(59, $grpInfo)){

    if( $exam_master_info['user_level_id'] == 2)
    { //AWS Cloud Architect - Assoicate
      if($percentage > 90){
       /* echo '<div class="alert alert-warning recommand">
              <strong>Based on your score, we recommend the following course to you in your learning Journey:</strong> <a href="https://trainocate.com/courses/AWS/AWS-ADVARC" target="_blank"> Cloud Architect Professional</a>
              </div>';*/

              echo recomendationsLink('https://trainocate.com/courses/AWS/AWS-ADVARC', 'Cloud Architect Professional Advanced Architecting on AWS');

            } else {

        /*  echo '<div class="alert alert-warning recommand">
          <strong>Based on your score, we recommend the following course to you in your learning Journey:</strong> <a href="https://trainocate.com/courses/AWS/AWS-ARC" target="_blank"> Cloud Architect Associate</a>
          </div>';*/
          echo recomendationsLink('https://trainocate.com/courses/AWS/AWS-ARC', 'Architecting on AWS');
            }
        } elseif ($exam_master_info['user_level_id'] == 3) { //AWS Cloud Architect - Professional

        if($percentage < 30){

      /*    echo '<div class="alert alert-warning recommand">
          <strong>Based on your score, we recommend the following course to you in your learning Journey:</strong> <a href="https://trainocate.com/courses/AWS/AWS-ARC" target="_blank"> Cloud Architect Associate</a>
          </div>';*/
          echo recomendationsLink('https://trainocate.com/courses/AWS/AWS-ARC', 'Architecting on AWS');

        }  else if($percentage > 30  && $percentage <= 90){

          /*echo '<div class="alert alert-warning recommand">
          <strong>Based on your score, we recommend the following course to you in your learning Journey:</strong> <a href="https://trainocate.com/courses/AWS/AWS-ADVARC" target="_blank"> Cloud Architect Professional</a>
          </div>';*/
          echo recomendationsLink('https://trainocate.com/courses/AWS/AWS-ADVARC', 'Cloud Architect Professional Advanced Architecting on AWS');

            } else if($percentage > 90){

        /*  echo '<div class="alert alert-warning recommand">
          <strong>Based on your score, we recommend the following course to you in your learning Journey:</strong> <a href="https://trainocate.com/courses/AWS" target="_blank"> Cloud Practitioner Foundational</a>
          </div>';*/
          //foundational
          echo recomendationsLink('https://trainocate.com/courses/AWS/AWS-ARC', ' Architecting on AWS');
            }
        }

    } ?>

<a href="<?php echo base_url();?>registration/user_profile_display" class="text-center textS" style="padding-top: 18px;
font-size: 18px;
color: #4242e8;
text-decoration: underline;">Back</a>

</div>


</div>

 </div>

      </div>

  </section>

</main>

<?php $this->load->view('template/footer');?>



