<?php $this->load->view('template/header');


?>

<main class="main-content">
<section class="review-finish">
<div class="container" >
<div class="row">
   <div class="col-xs-12">

    <?php  $i = 1;
    if(isset($review_q_data) && !empty($review_q_data)) {
      foreach ($review_q_data as $key => $reviewData) {

        $correct_answer_opts = $reviewData['correct_answer_opts'];
        $user_seleted_opts = $reviewData['user_seleted_opts'];
     ?>

        <div class="reivew_Data reivew_answers">
        <div class="row ">
          <div class="col-sm-12">
            <div class="panel widget dark-widget panel-bd-left_grey">
              <div class="panel-body">
                <p><span>Q<?php echo $i;?>:</span> <?php echo $reviewData['question'];?></p>
                <div class="crr_or_wrng">
                    <?php
                      if($user_seleted_opts == $correct_answer_opts){
                        echo "<b class='crt'>Correct </b>";
                      } else{
                           echo "<b class='wrng'>Wrong ";
                          if( count($user_seleted_opts) != count($correct_answer_opts)){
                            //echo ": You have seleted  ".count($user_seleted_opts) ." options";
                          }
                          echo "</b>";


                      }

                    ?>

                </div>
              </div>
            </div>
          </div>
        </div>

        <?php foreach ($reviewData['option'] as $key => $value) {

            if(in_array($key, $correct_answer_opts)){
              $clsName = "correct_ans opt_green";
            } elseif (in_array($key, $user_seleted_opts)) {
              $clsName = "wrong_ans opt_red";
            } else{
                $clsName = '';
            }
          ?>

        <div class="row">
          <div class="col-sm-12">
            <div class="panel widget dark-widget panel-bd-left_blue">
              <div class="panel-body  vd_bg-grey <?php echo $clsName;?>">
                <p><?php echo $value;?></p>
              </div>
            </div>
          </div>
        </div>

        <?php  } ?>



      </div>
<?php  $i++;
    }
  }
  else{
?>
        <div class="row">
          <div class="col-sm-12">
            <div class="panel widget dark-widget panel-bd-left_blue">
              <div class="panel-body  vd_bg-grey" style="text-align: center; color: red;">
                <b>No Any Question Attempted!!! </b>
              </div>
            </div>
          </div>
        </div>
<?php
  } ?>

</div>

 </div>

      </div>

  </section>

</main>

<?php $this->load->view('template/footer');?>



