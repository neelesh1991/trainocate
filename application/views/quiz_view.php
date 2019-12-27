<?php $this->load->view('template/header');?>
<style type="text/css">
html:-ms-fullscreen {
width: 100%; /* needed to center contents in IE */
}
</style>
<link href="<?php echo base_url();?>assets/lib/css/styles.css" rel="stylesheet">

</header>
<!-- Header -->
<!-- Main Content -->
<main class="main-content">
<!-- Blog Detail -->
<div class="blog-detail-holder" style="padding:10px 0px;min-height: 500px">
<div class="container">
    <div class="row">
        <!-- Standar Blog Posts -->
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="single-blog-detail" id="single-blog-detail">
                <!-- Post Widget -->
                <div class="row pagination-holder z-depth-1">
                    <div id="info-exam" class="col-md-10 col-xs-12">

                        <!--  <div><strong>Total Questions: </strong>50</div>
                        <div><strong>Marks:</strong>100</div>
                        <div><strong>All questions are compulsory</strong></div> -->
                        <div> <strong style="font-size: 25px">
                            <a style="float: left; height: 35px; width: 35px;" href="javascript:void(0);" class="circle-btn" onclick="launchFullscreen(document.getElementById('single-blog-detail'));"><i class="fa fa-arrows" style="padding: 0px ! important; position: absolute; top: 15px; left: 15px; font-size: 25px;"></i></a>&nbsp; Section Name: </strong> <span id="section_name" style="font-size: 25px">-</span>
                            <span class="extended_time_row pull-right">Your completing exam in</span>
                        </div>
                    </div>
                    <span id="extended_time"></span>
                    <ul id="countdown-2" class="col-md-2 col-xs-12 countdown-one style-2">
                        <li><span class="hours z-depth-2">00</span>Hours</li>
                        <li><span class="minutes z-depth-2">00</span>Mins</li>
                        <li><span class="seconds z-depth-2">00</span>Secs</li>
                    </ul>
                    <div id="timers" style="display: none;"></div>
                    <ul id="countdown-3" class="col-md-2 col-xs-12 countdown-one style-2">
                        <li><span  id= "ex-h" class="hours z-depth-2">00</span>Hours</li>
                        <li><span id= "ex-m" class="minutes z-depth-2">00</span>Mins</li>
                        <li><span id= "ex-s" class="seconds z-depth-2">00</span>Secs</li>
                    </ul>
                </div>
                <div class="blog-column tc-hover" id="container">
                </div>
                <!-- Post Widget -->
                <div class="pagination-holder z-depth-1">
                    <ul class="pagination">
                        <?php
                        if(!empty($pagination))
                        {
                            $CI=& get_instance();

                        ?>
                            <li><a href="javascript:void(0);" onclick="getPreviousQuestion();"><i class="fa fa-angle-left"></i></a></li>
                            <?php
                                $i=1;
                                foreach ($pagination as $key => $value)
                                {
                                    $multiple = $CI->modelbasic->getMultipleQuestions($value['question_id']);
                                    $isMultple = count($multiple) > 1 ? count($multiple) : 0;
                            ?>
                                    <li data-id="<?php echo $value['question_id'];?>" data-mul="<?php echo $isMultple;?>" <?php if($currentId == $value['question_id']){ if($value['selected_answer'] > 0){ echo 'class="done active"';}else{ echo 'class="active"';} }elseif($value['selected_answer'] > 0){ echo 'class="done"';}?>><a onclick="newQuestion('<?php echo $value['question_id'];?>',this);" href="javascript:void(0);"><?php echo $i;?></a></li>
                                <?php
                                    $i++;
                                }
                                ?>
                            <li><a href="javascript:void(0);" onclick="getNextQuestion();"><i class="fa fa-angle-right"></i></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Blog Detail -->
</main>
<!-- Main Content -->
<script src="<?php echo base_url();?>assets/lib/js/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url();?>assets/lib/js/jquery.transit.min.js"></script>
<script src="<?php echo base_url();?>assets/lib/js/essemble_core.min.js"></script>
<script src="<?php echo base_url();?>assets/lib/js/mcq.js"></script>
<script src="<?php echo base_url();?>assets/lib/js/quiz.js"></script>
<script>
var quiz;
function init(){
    //create the screen object which loads the xml and creates all screen elements
    quiz = new Screen({id:"myQuiz", xmlPath:base_url+"quiz/generateQuiz/"+'<?php echo $currentId;?>'});
    //choose a target div
    var targetDiv = get("container");
    //load it
    quiz.load(targetDiv,false);
}
//kick off
 $(document).ready(function() {

//     /**
//     * Extending Timer start
//     */

    jQuery('#countdown-3').hide();
    jQuery('.extended_time_row').hide();



    var timerVar = setInterval(countTimer, 1000);
    var totalSeconds = 0;
    function countTimer() {
     ++totalSeconds;
     var hour = Math.floor(totalSeconds /3600);
     var minute = Math.floor((totalSeconds - hour*3600)/60);
     var seconds = totalSeconds - (hour*3600 + minute*60);

     hour = (hour < 10 ? "0" : "") + hour;
     minute = (minute < 10 ? "0" : "") + minute;
     seconds = (seconds < 10 ? "0" : "") + seconds;

     document.getElementById("timers").innerHTML = hour + ":" + minute + ":" + seconds;
     jQuery('#ex-h').text(hour);
     jQuery('#ex-m').text(minute);
     jQuery('#ex-s').text(seconds);
 }

  <?php
    $tz_from = 'Asia/Kolkata';
    $tz_to = 'UTC';
    $format = 'Y-m-d H:i:s';

    $current = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone($tz_from));
    $current->setTimeZone(new DateTimeZone($tz_to));
    $current_date=$current->format($format);

    if($this->session->userdata('mock')!='')
    {
        $mock=1;
    }else
    {
        $mock=0;
    }
    $this->load->model('userprofile_model');
    $data1=array('user_id'=>$this->session->userdata('user_id'),'tenant_id'=>$this->session->userdata('tenant_id'),'quiz_id'=>$ids['quiz_id'],'exam_id'=>$ids['exam_id'],'finish'=>0);
    $res=$this->userprofile_model->check_exam_log($data1,$mock);
    if(empty($res))
    {
        $data2=array('user_id'=>$this->session->userdata('user_id'),'tenant_id'=>$this->session->userdata('tenant_id'),'quiz_id'=>$ids['quiz_id'],'exam_id'=>$ids['exam_id']);
        $res1=$this->userprofile_model->check_exam_log($data2,0);
        if(empty($res1))
        {
            if(!empty($exam_duration))
            {
                $now=new DateTime();
                $now->add(new DateInterval("P0000-00-00T".$exam_duration['duration']));

                if(strtotime($current_date)< strtotime($exam_duration['end_date']))
                {
                    $format1 = 'm/d/Y H:i:s';
                   //$quiz_end_time=$current->format($format1);
                  $quiz_end_time=$now->format('m/d/Y H:i:s');
                    $end_t = new DateTime($now->format('Y-m-d H:i:s'), new DateTimeZone($tz_from));
                    $end_t->setTimeZone(new DateTimeZone($tz_to));
                    $end_time=$end_t->format($format);

                }else
                {
                    $quiz_end_time=date('m/d/Y H:i:s' ,strtotime($exam_duration['end_date']+36000));
                    $end_t = new DateTime($exam_duration['end_date'], new DateTimeZone($tz_from));
                    $end_t->setTimeZone(new DateTimeZone($tz_to));
                    $end_time=$end_t->format($format);

                }
             }

            $data=array('user_id'=>$this->session->userdata('user_id'),'tenant_id'=>$this->session->userdata('tenant_id'),'quiz_id'=>$ids['quiz_id'],'exam_id'=>$ids['exam_id'],'start_time'=>$current_date,'end_time'=>$end_time,'status'=>1);
            $this->userprofile_model->save_log_info($data,$mock);
            $set_time_out=strtotime($quiz_end_time)*1000;
            ?>

            //alert("<?php echo $quiz_end_time;?>");

            init();
            jQuery('#countdown-2').countdown({
                date: '<?php echo $quiz_end_time;?>',/*offset:'+5:30'*/
            }, function() {
            /**
             * Extending Time
             */
                jQuery('#countdown-2').hide();
                alert("Your exam time is completed but still you can continue to complete exam.");
                jQuery('.extended_time_row').show();
                jQuery('#countdown-3').show();
                //extenedTimeStart();


            /*
            $.ajax({
            url: base_url+'quiz/end_exam',
            type: 'POST',
            success:function(data)
            {

                if(data==1)
                {
                     window.location= base_url+'quiz/finish_exam';
                }
                }
            })*/
            });


            <?php

        }

    }elseif(strtotime($current_date)>strtotime($res['end_time']) && $res['status']==1)
    {
        $this->userprofile_model->update_user_exam_status($res['id'],$mock,$this->session->userdata('user_id'),$this->session->userdata('tenant_id'),$ids['quiz_id'],$ids['exam_id']);
        ?>
        window.location='<?php echo base_url()?>quiz/finish_exam';
        <?php
    }elseif(strtotime($current_date)>strtotime($res['end_time']) && $res['status']==0)
    {
        ?>
        //window.location='<?php echo base_url()?>quiz/time_out';
        <?php
    }
    elseif(strtotime($current_date)<strtotime($res['end_time']) && $res['status']==1)
    {/*echo "hey";
        echo date('y-m-d H:i:s',strtotime($current_date));
        echo date('y-m-d H:i:s',strtotime($res['end_time']));die;*/
            $format1='m/d/y H:i:s';
        $end_time = new DateTime($res['end_time'], new DateTimeZone('UTC'));
        $end_time->setTimeZone(new DateTimeZone('Asia/Kolkata'));
        $quiz_end_time=$end_time->format($format1);

       /* $quiz_end_time=date('m/d/y H:i:s',strtotime($res['end_time']));
        $set_time_out=strtotime($quiz_end_time)*1000;*/
        ?>
        init();
        jQuery('#countdown-2').countdown({
        date: '<?php echo $quiz_end_time;?>',
        },
        function() {
            /**
             * Extending Time
             */
            jQuery('#countdown-2').hide();
                alert("Your exam time is completed but still you can continue to complete exam.");
                jQuery('.extended_time_row').show();
                jQuery('#countdown-3').show();


        });
        <?php
    }
    ?>
});
/*timeoutId1 = setInterval(function()
{
function chck_finish_time()
{
$.ajax({
url: '<?php echo base_url()?>quiz/chck_finish_time',
type: 'POST',
success:function(data)
{
}
})
}
chck_finish_time();
},<?php echo  $set_time_out;?>);
*/
document.onkeydown = function (e) {
    alert('Not allowed');
return false;
}
$(document).ready(function() {

    $(document)[0].oncontextmenu = function() { return false; }

    $(document).mousedown(function(e) {
        if( e.button == 2 ) {
            alert('Sorry, this functionality is disabled!');
            return false;
        } else {
            return true;
        }
    });
});


function newQuestion(qId,element)
{
    if($(element).parent('li.active').length == 0)
    {
            quiz = new Screen({id:"myQuiz", xmlPath:base_url+"quiz/generateQuiz/"+qId});
            //choose a target div
            var targetDiv = get("container");
            //load it
            quiz.load(targetDiv,false);
            $('.pagination').children('li').removeClass('active');
            $(element).parent('li').addClass('active');
    }
}

function getPreviousQuestion()
{
    var element=$('.pagination li.active').prev().children('a');
    var qId=$('.pagination li.active').prev().data('id');
    if(!isNaN(qId))
    {
        newQuestion(qId,element);
    }

}

function getNextQuestion()
{
    var element=$('.pagination li.active').next().children('a');
    var qId=$('.pagination li.active').next().data('id');
    if(!isNaN(qId))
    {
        newQuestion(qId,element);
    }
}

/*$(document).keydown(function(e) {

if (e.keyCode == 27) return false;
});*/
</script>

<script>
// Find the right method, call on correct element
function launchFullscreen(element) {
  if(element.requestFullscreen) {
    element.requestFullscreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullscreen) {
    element.webkitRequestFullscreen();
  } else if(element.msRequestFullscreen) {
    element.msRequestFullscreen();
  }
}

function exitFullscreen() {
  if(document.exitFullscreen) {
    document.exitFullscreen();
  } else if(document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if(document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  }
}

function dumpFullscreen() {
  console.log("document.fullscreenElement is: ", document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement);
  console.log("document.fullscreenEnabled is: ", document.fullscreenEnabled || document.mozFullScreenEnabled || document.webkitFullscreenEnabled || document.msFullscreenEnabled);
}

// Events
document.addEventListener("fullscreenchange", function(e) {
  console.log("fullscreenchange event! ", e);
});
document.addEventListener("mozfullscreenchange", function(e) {
  console.log("mozfullscreenchange event! ", e);
});
document.addEventListener("webkitfullscreenchange", function(e) {
  console.log("webkitfullscreenchange event! ", e);
});
document.addEventListener("msfullscreenchange", function(e) {
  console.log("msfullscreenchange event! ", e);
});

// Add different events for fullscreen
</script>
<?php $this->load->view('template/footer');?>