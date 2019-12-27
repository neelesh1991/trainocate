<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quiz extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('modelbasic');
        $this->load->model('registration_model');
        $this->load->model('userprofile_model');




    }
    public function index($quiz_id,$exam_id)
    {
     $id=$this->session->userdata('user_id');
     $tenant_id=$this->session->userdata('tenant_id');
     $res=$this->userprofile_model->profile_complete_status($id);
     $data['quiz_detail']=$this->userprofile_model->check_no_of_section($quiz_id,$tenant_id);
     $data['exam_detail']=$this->userprofile_model->get_exam_detail($quiz_id,$exam_id,$tenant_id);
     $data['section_detail']=$this->userprofile_model->get_quiz_detail($quiz_id,$tenant_id,$data['quiz_detail']['number_of_sections']);
     $data['security_feature']=$this->userprofile_model->get_security_info($tenant_id,$exam_id);
     $data['exam_id']=array('exam_id'=>$exam_id);
     $data['mock_status']=$this->userprofile_model->get_mock_status($quiz_id,$tenant_id);
       // print_r($data);die;
     if($res['is_profile_completed']==1)
     {
      $this->load->view('quiz_details_view',$data);
     }
}

public function start($quiz_id,$exam_id,$mock=0)
{

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

   $format = 'Y-m-d h:i a';

                     $current = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone("Asia/Kolkata"));

                  $current->setTimeZone(new DateTimeZone("Asia/Kolkata"));

   $current_date=$current->format($format);

   $tenant_id=$this->session->userdata('tenant_id');
   $user_id=$this->session->userdata('user_id');

   $this->session->unset_userdata('mock');
   $this->session->set_userdata('quiz_id',$quiz_id);
   $this->session->set_userdata('exam_id',$exam_id);

        /**
         * Retry exam new code
         */

        if(!empty($_GET['rert']) && $_GET['rert'] == "ert"  && $_GET['rert'] != 1){

            $preivouwQuizLog=$this->modelbasic->get_previousQuizLog('quiz_log',$exam_id, $quiz_id,$user_id,$tenant_id,0);

            // Del quiz data
                  $this->modelbasic->previous_user_quiz_del('quiz',array('exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'user_id'=>$user_id,'tenant_id'=>$tenant_id, 'mock' => 0 ));

            if(!empty($preivouwQuizLog)){
                // Del quiz_log data

                $this->modelbasic->previous_user_quiz_del('quiz_log',array('exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'user_id'=>$user_id,'tenant_id'=>$tenant_id ));



                /*
                $attemptedCount=$this->modelbasic->count_all_only('quiz_retry_log',array('exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'user_id'=>$user_id,'tenant_id'=>$tenant_id));

                $previewQuizDetails = $this->modelbasic->get_previousQuiz('quiz',$exam_id, $quiz_id,$user_id,$tenant_id,0);

                if(!empty($previewQuizDetails)){
                   $previewQuizDetails['exam_attempted'] = $attemptedCount;

                  $this->modelbasic->_insert('quiz_retry_exams',$previewQuizDetails);

                  // Del quiz data
                  $this->modelbasic->previous_user_quiz_del('quiz',array('exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'user_id'=>$user_id,'tenant_id'=>$tenant_id, 'mock' => 0 ));

               }*/

           }

       } else{

            }

            /**
             * Retry exam code end
             */

       // echo $mock;die;
            if($mock==0)
            {
                $finishExam=$this->modelbasic->getValue('quiz_log','finish',array('exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'tenant_id'=>$tenant_id,'user_id'=>$user_id));

                $is_quiz_expired=$this->userprofile_model->chck_is_quiz_expired($user_id,$this->session->userdata('tenant_id'),$exam_id,$quiz_id);

                if(($is_quiz_expired['end_date']!='' && strtotime($current_date)>strtotime($is_quiz_expired['end_date'])) || ($is_quiz_expired['end_time']!='' && strtotime($current_date)>strtotime($is_quiz_expired['end_time'])))
                {
                //redirect('quiz/time_out');
                }
            /*if($finishExam == 1)
            {
                redirect('quiz/finish_exam');
                exit();
            }*/
        }

        if($mock==1)
        {
            $mock=1;
            $this->session->set_userdata('mock',$mock);
        }

         /*   if((isset($quiz_id) && $quiz_id > 0) || (isset($exam_id) && $exam_id > 0))
            {
                                     //$isHavingAccess=$this->userprofile_model->isHavingAccess($quiz_id,$exam_id,$mock);
                    //if(!$isHavingAccess)
                    //{
                        redirect('registration/user_profile_display');
                   // }

            }
            else
            {
                print "ss";
                exit;
                  redirect('registration/user_profile_display');
              }*/

              $total_que=0;

              $data['quiz_detail']=$this->userprofile_model->check_no_of_section($quiz_id,$tenant_id);
              $data['section_detail']=$this->userprofile_model->get_quiz_detail($quiz_id,$tenant_id,$data['quiz_detail']['number_of_sections']);

// echo "<pre/>@@@@@"; print_r($data);
              $questionCount=$this->modelbasic->count_all_only('quiz',array('exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'user_id'=>$user_id,'tenant_id'=>$tenant_id,'mock'=>$mock));

              // echo "<pre/>@@@@@"; print_r($questionCount); die;
              if(!empty($data['section_detail']))
              {
                // foreach ($data['section_detail'] as $val)
                foreach ($data['section_detail'] as $key=>$val)
                {
                  $total_que=$total_que+$val['no_of_questions'];//no of que = 10
                  $data['section_info']=array('section_name'=>$val['section_name'],'no_of_questions'=>$val['no_of_questions']);
                  $catg=explode(',',$val['catg']);
                }
                // echo $total_que; die;
            }

        if($questionCount != $total_que)
        {
            // pr($data); die;
            if(!empty($data['section_detail']))
            {
             $qIdArray=array();
             if($questionCount != 0)
             {
                 $conditionArray=array('tenant_id'=>$tenant_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id,'user_id'=>$user_id,'mock'=>$mock);
                 $resultQuery=$this->modelbasic->accessDatabase('quiz','question_id,selected_answer','select','',$conditionArray,'','','','','');
                 $qIdArray=$resultQuery->result_array();
             }



             // foreach ($data['section_detail'] as $val)
             foreach ($data['section_detail'] as $key=>$val)
             {

              if($mock==1)
              {
                  $res=$this->userprofile_model->get_mock_categories($quiz_id);
                  $catg=array();
                  if(!empty($res))
                  {
                      foreach ($res as $val1)
                      {
                        $catg[]=$val1['category_id'];
                      }
                  }
              }
              else
              {
                  $catg=explode(',',$val['catg']);
              }
              $category_count = count($catg);

              if(!empty($catg))
              {
                  $i=0;
                  $cnt=0;

                  foreach ($catg as $select_catg)
                  {
                      $where_array=array('A.tenant_id'=>$tenant_id,'B.tenant_id'=>$tenant_id,'C.tenant_id'=>$tenant_id,'D.category_id'=>$select_catg);
                      $groupby=array('question_id','RANDOM','question_id');
                      $join_array=array(array('answer_bank as B','A.id=B.question_id'),array('option_master as C','C.id=B.option_id'),array('question_category_relations as D','D.question_id=A.id'));
                      $query=$this->modelbasic->accessDatabase('question_bank as A','A.id as question_id,A.question,A.marks,C.id as correct_answer_opt_id,D.category_id','join_group_order_limit',$groupby,$where_array,$join_array,'','');
                      // pr($query); die;
                      $catQuestions[$i]=$query->result_array();
                      $cnt+=count($catQuestions[$i]);
                      $i++;
                  }
              }
              $resultData=array();
              if(!empty($catQuestions))
              {
               for ($i=0; $i < $cnt; $i++)
               {
                  for ($j=0; $j < $category_count; $j++)
                  {
                      if(!empty($catQuestions[$j][$i]))
                      {
                          $resultData[]=$catQuestions[$j][$i];
                      }

                  }
                }
              }
              $no=$questionCount;
              if(!empty($resultData))
              {
                  foreach ($resultData as $key => $value)
                  {
                      $correct_answer="";

                      $qId=$this->modelbasic->getValue('quiz','question_id',array('exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'tenant_id'=>$tenant_id,'question_id'=>$value['question_id'],'mock'=>$mock));

                      $correct_answer=$this->modelbasic->getValue('answer_bank','option_id',array('question_id'=>$value['question_id'],'correct_answer'=>1,'tenant_id'=>$tenant_id));


                      if($qId == '')
                      {
                          if($no != $val['no_of_questions'])
                          {
                              $insertData=array('user_id'=>$user_id,'exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'question_id'=>$value['question_id'],'correct_answer_opt_id'=>$correct_answer,'tenant_id'=>$tenant_id,'marks'=>$value['marks'],'mock'=>$mock);
                              $this->modelbasic->_insert('quiz',$insertData);
                              $qIdArray[]=array('question_id'=>$value['question_id'],'selected_answer'=>'');
                              $no++;
                          }
                          else
                          {
                            break;
                        }
                    }
                  }

                  if($no != $val['no_of_questions'])
                  {
                    foreach ($resultData as $key => $value)
                    {
                        if($no != $val['no_of_questions'])
                        {
                            $correct_answer="";
                            $qId=$this->modelbasic->getValue('quiz','question_id',array('exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'tenant_id'=>$tenant_id,'question_id'=>$value['question_id'],'user_id'=>$user_id,'mock'=>$mock));

                            $correct_answer=$this->modelbasic->getValue('answer_bank','option_id',array('question_id'=>$value['question_id'],'correct_answer'=>1,'tenant_id'=>$tenant_id));

                            if($qId == '')
                            {
                               $insertData=array('user_id'=>$user_id,'exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'question_id'=>$value['question_id'],'correct_answer_opt_id'=>$correct_answer,'tenant_id'=>$tenant_id,'marks'=>$value['marks'],'mock'=>$mock);

                               $this->modelbasic->_insert('quiz',$insertData);

                               $qIdArray[]=array('question_id'=>$value['question_id'],'selected_answer'=>'');
                               $no++;
                            }
                        }
                        else
                        {
                            break;
                        }
                    }
                  }
              }
          }
      }
  }
  else
  {

      $conditionArray=array('tenant_id'=>$tenant_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id,'user_id'=>$user_id,'mock'=>$mock);
      $resultQuery=$this->modelbasic->accessDatabase('quiz','question_id,selected_answer','select','',$conditionArray,'','','','','');
      $qIdArray=$resultQuery->result_array();
  }
  $currentId=$this->modelbasic->getValue('quiz','question_id',array('exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'user_id'=>$user_id,'tenant_id'=>$tenant_id,'selected_answer'=>0,'mock'=>$mock));
  if($currentId == '')
  {
      $qid=0;
      $firstQuestioncondition="tenant_id=$tenant_id AND user_id=$user_id AND exam_id=$exam_id AND quiz_id=$quiz_id AND question_id AND mock=$mock";
      $currentId=$this->modelbasic->getValue('quiz','question_id',$firstQuestioncondition);
  }

  $data['pagination']=$qIdArray;
  $data['currentId']=$currentId;

  $data['exam_duration']=$this->userprofile_model->get_exam_time_info($exam_id,$quiz_id);
  $data['ids']= array('quiz_id'=>$quiz_id,'exam_id'=> $exam_id);
          // pr($data);die;
  $this->load->view('quiz_view',$data);
}

public function save_answer()
{
    $quiz_id=$this->session->userdata('quiz_id');
    $exam_id=$this->session->userdata('exam_id');
    $user_id=$this->session->userdata('user_id');
    if($this->session->userdata('mock')!='')
    {
        $mock=1;
    }else
    {
        $mock=0;
    }
    $tenant_id=$this->session->userdata('tenant_id');
    if(isset($_POST) && !empty($_POST) && isset($_POST['ans']))
    {

            /**
             * Multple Code
             */

            if(!empty($_POST['selectedOptionsList'])){
                $selectedOptIds = array();

                $opEx = explode('option',$_POST['selectedOptionsList'][0]);
                $quID  = explode('_',$opEx[1]);

                foreach ($_POST['selectedOptionsList'] as $key => $optionID) {

                    $optionIDs = explode('_', $optionID);
                    $selectedOptIds[] = $optionIDs[1];
                }


                $correctOPtions = $this->modelbasic->getMultipleOptionIdsQuestions($quID[0]);
                $fromDbMul = array_column($correctOPtions, 'option_id');

                //Correct ans
                sort($selectedOptIds);
                sort($fromDbMul);
                if ($selectedOptIds==$fromDbMul) {
                    $correct = 1;
                } else{
                 $correct = 0;
             }
                //print json_encode( ['correct' => $correct]);
         } else{
            $correct = 0;
        }

        /**** ****/

        $selectedAnswer=$this->input->post('ans',TRUE);

        if(strrpos($selectedAnswer,'option') !== FALSE )
        {
            $submittedData=explode('_', $selectedAnswer);
            if(count($submittedData) == 2)
            {
                $questionData=explode('option', $submittedData[0]);
                   //pr($questionData);
                if(count($questionData) == 2)
                {
                    $questionId=(int)$questionData[1];
                    $answerId=(int)$submittedData[1];
                    if($questionId > 0 && $answerId > 0)
                    {
                        $condition=array('tenant_id'=>$tenant_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id,'user_id'=>$user_id,'question_id'=>$questionId,'mock'=>$mock);

                        $data=array('selected_answer'=>$answerId,'end_time'=>date('Y-m-d H:i:s'),'is_correct'=>$correct, 'multiple_selected_answers' => serialize($selectedOptIds));

                        $this->modelbasic->_update_custom('quiz',$condition, $data);
                        echo $questionId;
                    }
                }
            }

        }






    }

}

public function generateQuiz($qid=0)
{
   $mock=0;
   if($this->session->userdata('mock') !='')
   {
    $mock=1;
}

$user_id=$this->session->userdata('user_id');
$tenant_id=$this->session->userdata('tenant_id');
$quiz_id=$this->session->userdata('quiz_id');
$exam_id=$this->session->userdata('exam_id');

if($qid == 0)
{
    $firstQuestioncondition="tenant_id=$tenant_id AND user_id=$user_id AND exam_id=$exam_id AND quiz_id=$quiz_id AND question_id AND mock=$mock";
    $qid=$this->modelbasic->getValue('quiz','question_id',$firstQuestioncondition);
}

$sectionNameData=$this->userprofile_model->getSectionName($quiz_id,$qid);
$where_array=array('A.tenant_id'=>$tenant_id,'B.tenant_id'=>$tenant_id,'C.tenant_id'=>$tenant_id,'A.user_id'=>$user_id,'A.exam_id'=>$exam_id,'A.quiz_id'=>$quiz_id,'A.question_id'=>$qid);
$groupby='';
$join_array=array(array('answer_bank as B','A.question_id=B.question_id'),array('option_master as C','C.id=B.option_id'),array('question_bank as D','A.question_id=D.id'));
$query=$this->modelbasic->accessDatabase('quiz as A','A.question_id,A.selected_answer,A.correct_answer_opt_id,C.option,C.id as option_id,D.question','join_order_limit',$groupby,$where_array, $join_array,'');
$resultData=$query->result_array();
      //echo $this->db->last_query();die;
$conditionArray=array('tenant_id'=>$tenant_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id,'user_id'=>$user_id,'question_id'=>$qid);
$resultQuery=$this->userprofile_model->get_question_position($user_id,$exam_id,$quiz_id,$qid,$mock);
      // print_r($resultQuery);die;
        //$nextId=$this->modelbasic->_custom_query('select * from quiz where id = (select min(id) from quiz where id > '.$qid.')');
$nextQuestioncondition="tenant_id=$tenant_id AND user_id=$user_id AND exam_id=$exam_id AND quiz_id=$quiz_id AND question_id = (select question_id from quiz where id >".$resultQuery['id']." LIMIT 1 ) AND mock=$mock";
$prevQuestioncondition=array('tenant_id'=>$tenant_id,'user_id'=>$user_id,'exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'mock'=>$mock,'id <'=>$resultQuery['id']);

$nextQuestionId=$this->modelbasic->getValue('quiz','question_id',$nextQuestioncondition);
$prevQuestionId=$this->modelbasic->getValue('quiz','question_id',$prevQuestioncondition,array('id','desc'),1);

if($prevQuestionId == '')
{
    $prevQuestionId=0;
}

$animation='show';
if($prevQuestionId == 0)
{
    $animation='disabled';
}

$nextdisable="show";
$lastQuestionPopUp=0;
if($nextQuestionId == '')
{
            //$nextdisable="disabled";
    $Questioncondition=array('tenant_id'=>$tenant_id,'user_id'=>$user_id,'exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'mock'=>$mock,'selected_answer'=>0);
    $nextQuestionId=$this->modelbasic->getValue('quiz','question_id',$Questioncondition);
    if($nextQuestionId=='')
    {
        $lastQuestionPopUp=1;
        $nextQuestionId=0;
    }
}

$questionData=array();
if(!empty($resultData))
{
    foreach ($resultData as $key => $value)
    {
        if(!isset($questionData['option']))
        {
            $questionData=array('question_id'=>$value['question_id'],'question'=>$value['question'],'correct_answer_opt_id'=>$value['correct_answer_opt_id'],'option'=>array($value['option_id']=>$value['option']),'selected_answer'=>$value['selected_answer']);
        }
        else
        {
            $questionData['option'][$value['option_id']]=$value['option'];
        }
    }
    $questionDataData['nextQuestionId']=$nextQuestionId;
    $questionData['prevQuestionId']=$prevQuestionId;
}

if(!empty($questionData))
{
    $data='<?xml version="1.0" encoding="utf-8" ?> <data> <events> <event id="btnover"> <rollover> <css name="btnOverCss">this</css> </rollover> <rollout> <css name="btnOutCss">this</css> </rollout> </event> <event id="optionover"> <rollover> <css name="optionOverCss">this</css> </rollover> <rollout> <css name="optionOutCss">this</css> </rollout> </event> <event id="selectandsubmit"> <click> <css name="optionOverCss">this</css> <function name="select">this</function> <function name="submit">this</function> </click> </event> <event id="select"> <click> <css name="optionOverCss">this</css> <function name="select">this</function> </click> </event> <event id="submit"> <click> <function name="submit">this</function> </click> </event> <event id="reset"> <click> <function name="reset">this</function> </click> </event> <event id="begin"> <click> <anim type="remove" animtime="0" oncomplete="0">openingText</anim> <function name="begin">this</function> </click> </event> <event id="loadNextQuestion"> <click> <function name="loadNextQuestion">this</function> </click> </event> <event id="loadPreviousQuestion"> <click> <function name="loadPreviousQuestion">this</function> </click> </event> <event id="timeout"> <click> <function name="timeout">this</function> </click> </event> <event id="restart"> <click> <function name="restart">this</function> </click> </event> <event id="showq1bg"> <click> <anim type="show" animtime="2" oncomplete="0">q1bg</anim> </click> </event> <event id="hidepassbg"> <click> <anim type="hide" animtime="2" oncomplete="0">passbg</anim> </click> </event> <event id="showpassbg"> <click> <anim type="show" animtime="5" oncomplete="0">passbg</anim> </click> </event> <event id="hidefailbg"> <click> <anim type="hide" animtime="2" oncomplete="0">failbg</anim> </click> </event> <event id="showfailbg"> <click> <anim type="show" animtime="2" oncomplete="0">failbg</anim> </click> </event> </events> <box id="failbg" position="absolute" x="0" y="0" width="100%" height="100%" anim="hide" class="failbg"/> <box id="orangebg" position="absolute" x="0" y="0" width="100%" height="100%" anim="hide" class="orangebg"/> <box id="timerRow" position="absolute" x="0" y="0" anim="none" animtime="0.5" animdelay="1" class="col-md-12"> <box id="timerCol1" position="relative" class="col-md-10 col-sm-12"/> <box id="timerContainer" position="relative" class="col-md-2 col-sm-12"/> </box> <custom type="quiz" id="quiz" position="relative" x="0" y="0" class="col-md-12"> <settings timer="false" timerx="0" timery="0"/> <box id="openingText" position="relative" anim="left" animtime="0.5" animdelay="1" class="col-md-12 vertical-align" z-index="3"> <text id="title" position="relative" margin-top="20" anim="none"><![CDATA[<h1 class="black">Multiple Choice Quiz Engine</h1><p class="p_16_black">Welcome to this short quiz.</p><p class="p_16_black">For each question, select the answer before your time runs out!</p>]]></text> <button id="goBtn" position="relative" height="40" width="100" margin-top="40" margin-bottom="20" anim="none" event="btnover,begin" target="title"><![CDATA[Let\'s go!]]></button> </box>';
    $data.='<!-- question 1 -->

    <question id="q'.$questionData['question_id'].'" time="130" event="">
    <box id="col1" position="relative" class="col-md-12 col-sm-12" />
    <box id="col2" position="relative" class="col-md-12 col-sm-12" /><text id="question'.$questionData['question_id'].'" position="relative" target="col1" x="0" margin-top="10" margin-bottom="40" anim="left" animtime="0.5"><![CDATA[<p class="p_24" data-questionPopUpId="'.$lastQuestionPopUp.'" data-nextQuestionId="'.$nextQuestionId.'" data-prevQuestionId="'.$prevQuestionId.'" data-sectionName="'.$sectionNameData["section_name"].'">'.$questionData['question'].'</p>]]></text>';

    if(!empty($questionData['option'])){
        $shuffleKeys = array_keys($questionData['option']);
        shuffle($shuffleKeys);
        $newArray = array();
        foreach($shuffleKeys as $key) {
            $newArray[$key] = $questionData['option'][$key];
        }
        $opt=1; $correctcnt=1; foreach ($newArray as $optId=>$option) {
                     // $correct='true';
            ($correctcnt==1)? $correct='true': $correct='false';
            ($questionData['selected_answer'] != 0 && $questionData['selected_answer'] > 0 && $questionData['selected_answer'] == $optId)? $selected='true': $selected='false';
            $animdelay=$opt+4;

            $data.='<option correct="'.$correct.'" class="z-depth-1">
            <text id="option'.$questionData['question_id'].'_'.$optId.'" position="relative" target="col1" x="match" width="100%" margin-bottom="10" anim="show" animtime="0.5" animdelay="0.'.$animdelay.'" event="optionover,select" class="optionBox z-depth-1" ><![CDATA[<p class="p_16" data-selected="'.$selected.'">'.$option.'</p>]]></text>
            </option>';

            $correctcnt++; } $opt++;}
            $data.='<button id="prvQBtn" position="relative" target="col1" float="left" margin-right="10"   margin-bottom="40" width="125" anim="'.$animation.'" animtime="0.3" animdelay="0.7" event="btnover,loadPreviousQuestion"><![CDATA[Previous]]></button>

            <button id="submitBtn" position="relative" target="col1" x="match" float="left" width="125" anim="disabled" animtime="0.3" animdelay="0.7" event="btnover,submit"><![CDATA[<p class="genericBtn">Submit</p>]]></button>

            <button id="nextQBtn" position="relative" target="col1" float="left" margin-left="10" margin-bottom="40" width="125" anim="'.$nextdisable.'" animtime="0.3" animdelay="0.7" event="btnover,loadNextQuestion"><![CDATA[Next]]></button>

            <button id="finishQBtn" position="relative" target="col1" float="left" margin-left="10" margin-bottom="40" width="125" anim="show" animtime="0.3" animdelay="0.7" event="btnover,timeout"><![CDATA[Finish Exam]]></button>

            </question>';

            $data.='</custom>
            </data>';
            echo $data;
        }
    }
    public function end_exam()
    {

        //have to pass exam id as well as quiz id
        if($this->session->userdata('mock')!='')
        {
            $mock=1;
        }else
        {
            $mock=0;
        }
        if($this->session->userdata('user_timezone')!='')
        {
            $timezone=$this->session->userdata('user_timezone');
        }else
        {
            $timezone=$this->session->userdata('tenant_timezone');
        }
        if($timezone=='')
        {
            $timezone="Asia/Calcutta";
        }
        $format = 'Y-m-d H:i:s';
                        $current = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone("Asia/Kolkata"));

                  $current->setTimeZone(new DateTimeZone("Asia/Kolkata"));

        $current_date=$current->format($format);

        $res=$this->userprofile_model->manually_end_quiz($this->session->userdata('user_id'),$this->session->userdata('tenant_id'),$this->session->userdata('quiz_id'),$this->session->userdata('exam_id'),$mock,$current_date, $_POST['completed_in']);


        $this->userprofile_model->remove_key($this->session->userdata('user_id'),$this->session->userdata('tenant_id'),$this->session->userdata('exam_id'),$mock);

        if($res>0)
        {
            echo 1;die;
        }
    }
    public function finish_exam()
    {
        if($this->session->userdata('mock')!='')
        {
            $mock=1;
        }else
        {
            $mock=0;
        }
        $res['mock']=$mock;
        $quiz_id=$this->session->userdata('quiz_id');
        $exam_id=$this->session->userdata('exam_id');
        $mk=$this->session->userdata('mock');
        if($quiz_id!='' && $exam_id!='')
        {
           $this->userprofile_model->remove_key($this->session->userdata('user_id'),$this->session->userdata('tenant_id'),$exam_id,$mock);
           $res['exam_master_info']=$this->userprofile_model->check_exam_master_info($exam_id,$quiz_id,$this->session->userdata('tenant_id'));
           $data=array('user_id'=>$this->session->userdata('user_id'),'tenant_id'=>$this->session->userdata('tenant_id'),'exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'mock'=>$mock);
           $res['no_of_que']=$this->userprofile_model->no_of_question($data);
           $res['attempt_que']=$this->userprofile_model->attempt_que($data);
           $res['correct_ans']=$this->userprofile_model->correct_ans($data);
           $res['total_marks']=$this->userprofile_model->total_marks($data);
           $got_marks=$this->userprofile_model->got_marks($data);

           $percentage=0;
           if($res['exam_master_info']['result_dependancy']==1)
           {

             if($got_marks['cnt']!=0)
             {
                $percentage=($got_marks['cnt']/$res['total_marks']['cnt'])*100;
            }
            $res['got_marks']=$got_marks;
        }
        else
        {
         if($res['no_of_que']['cnt']!=0)
         {
            $percentage=($res['correct_ans']['cnt']/$res['no_of_que']['cnt'])*100;
        }

        $res['got_marks']=$res['correct_ans'];
    }





    $condition_array=array('user_id'=>$this->session->userdata('user_id'),'tenant_id'=>$this->session->userdata('tenant_id'),'exam_id'=>$exam_id,'quiz_id'=>$quiz_id);

    $insert_array=array('no_of_question'=> $res['no_of_que']['cnt'],'attempt_question'=> $res['attempt_que']['cnt'],'correct_answer'=>$res['correct_ans']['cnt'],'total_marks'=>$res['got_marks']['cnt'],'percentage'=>$percentage,'out_of_marks'=>$res['total_marks']['cnt']);

    $this->userprofile_model->update_exam_summary_in_quiz_log($condition_array,$insert_array,$mock);



    $isFinishedAlready=$this->modelbasic->getValue('quiz_log','finish',array('tenant_id'=>$this->session->userdata('tenant_id'),'user_id'=>$this->session->userdata('user_id'),'quiz_id'=>$this->session->userdata('quiz_id'),'exam_id'=>$this->session->userdata('exam_id')));


    if($isFinishedAlready != 1)
    {
                //echo $isFinishedAlready;die;
        $setFinish=$this->modelbasic->_update_custom('quiz_log',array('tenant_id'=>$this->session->userdata('tenant_id'),'user_id'=>$this->session->userdata('user_id'),'quiz_id'=>$this->session->userdata('quiz_id'),'exam_id'=>$this->session->userdata('exam_id')), array('finish'=>1));


        $userEmail=$this->modelbasic->getSelectedData('users','name,email_id',array('id'=>$this->session->userdata('user_id'),'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');


        $examName=$this->modelbasic->getValue('exam_master','exam_name',array('id'=>$exam_id,'tenant_id'=>$this->session->userdata('tenant_id')));



        $tenantInfo=$this->modelbasic->getSelectedData('tenant','*',array('id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');

        $emaildata=$this->registration_model->getValEmailTemp('manage_email_template','*',array('id'=>4,'tenant_id'=>$tenantInfo['id']));

        $msg=$emaildata['email_contains'];
        $msg=str_replace('{logo_link}','<img src="'.base_url().'uploads/'.$tenantInfo['id'].'/logo/thumbs/'.$tenantInfo['logo'].'" alt="logo" />', $msg);
        $msg=str_replace('{user_name}',$userEmail['name'], $msg);
        $msg=str_replace('{regards}',$tenantInfo['name'], $msg);
        $msg=str_replace('{exam_name}',$examName, $msg);

        $finish['fromEmail']='admin@trainocateassessments.com';
        $finish['fromName']='Quiz Admin';
        $finish['to']=$userEmail['email_id'];
        $finish['subject']=$emaildata['subject'];
        $finish['template'] = $msg;


        $result=$this->modelbasic->sendMail($finish);
    }
    else
    {
        $userEmail=$this->modelbasic->getSelectedData('users','name,email_id',array('id'=>$this->session->userdata('user_id'),'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');


        $examName=$this->modelbasic->getValue('exam_master','exam_name',array('id'=>$exam_id,'tenant_id'=>$this->session->userdata('tenant_id')));



        $tenantInfo=$this->modelbasic->getSelectedData('tenant','*',array('id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');

        $emaildata=$this->registration_model->getValEmailTemp('manage_email_template','*',array('id'=>4,'tenant_id'=>$tenantInfo['id']));

        $msg=$emaildata['email_contains'];
        $msg=str_replace('{logo_link}','<img src="'.base_url().'uploads/'.$tenantInfo['id'].'/logo/thumbs/'.$tenantInfo['logo'].'" alt="logo" />', $msg);
        $msg=str_replace('{user_name}',$userEmail['name'], $msg);
        $msg=str_replace('{regards}',$tenantInfo['name'], $msg);
        $msg=str_replace('{exam_name}',$examName, $msg);

        $finish['fromEmail']='admin@trainocateassessments.com';
        $finish['fromName']='Quiz Admin';
        $finish['to']=$userEmail['email_id'];
        $finish['subject']=$emaildata['subject'];
        $finish['template'] = $msg;
        $result=$this->modelbasic->sendMail($finish);
        $res['isFinishedAlready']='Your Exam is already submitted for Review.';
    }

    $res['coupon_code'] = '';
    $res['percentage'] = $percentage;
    $res['userInfor'] = $this->userprofile_model->get_user_profile_info($this->session->userdata('user_id'),$this->session->userdata('tenant_id'));

    if($exam_id){
        $grpInfo = $this->modelbasic->getGroupInfo($exam_id);

        $examGroupData = array();
        foreach ($grpInfo as $key => $value) {
            $examGroupData[] = $value['group_id'];
        }


    }
    $res['examID'] = $exam_id;
    $res['quiz_id'] = $quiz_id;
    $res['grpInfo'] = $examGroupData;



    $c_code = $this->modelbasic->getSelectedData('coupon_code','*',array('tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
    if(!empty($c_code))
    {
        $res['coupon_code']= $c_code['coupon_code'];
    }

    $userLevelID = $res['userInfor']['user_level_id'];
    if($percentage > 95 && $userLevelID == 1){
                   //$updated =  $this->modelbasic->userUpdate_User_level($this->session->userdata('user_id'));


    }

    /**
     * Retry insert array
     */
    $user_id = $this->session->userdata('user_id');
    $tenant_id=$this->session->userdata('tenant_id');

    $preivouwQuizLog=$this->modelbasic->get_previousQuizLog('quiz_log',$exam_id, $quiz_id,$user_id,$tenant_id,0);


    if(!empty($preivouwQuizLog)){

     $this->modelbasic->_insert('quiz_retry_log',end($preivouwQuizLog));

      $retryQuizLog=$this->modelbasic->get_RetryQuizLog('quiz_retry_log',$exam_id, $quiz_id,$user_id,$tenant_id,0);
      if(!empty($retryQuizLog)){

        $retryLoadData = end($retryQuizLog);
        $updateHighest=array(
            'no_of_question'=> $retryLoadData['no_of_question'],
            'attempt_question'=> $retryLoadData['attempt_question'],
            'correct_answer'=>$retryLoadData['correct_answer'],
            'total_marks'=>$retryLoadData['total_marks'],
            'percentage'=>$retryLoadData['percentage'],
            'out_of_marks'=>$retryLoadData['out_of_marks'],
            'start_time'=>$retryLoadData['start_time'],
            'end_time'=>$retryLoadData['end_time'],

        );

     $this->userprofile_model->update_exam_summary_in_quiz_log($condition_array,$updateHighest,$mock);

      }

 }

    $this->load->view('finish_quiz_view',$res);
    $this->session->unset_userdata('quiz_id');
    $this->session->unset_userdata('exam_id');
    $this->session->unset_userdata('mock');
}
else
{

    redirect('registration/user_profile_display');
}
}
public function time_out()
{

    if($this->session->userdata('mock')!='')
    {
        $mock=1;
    }else
    {
        $mock=0;
    }
    $quiz_id=$this->session->userdata('quiz_id');
    $exam_id=$this->session->userdata('exam_id');
    $res['exam_master_info']=$this->userprofile_model->check_exam_master_info($exam_id,$quiz_id,$this->session->userdata('tenant_id'));

    $data=array('user_id'=>$this->session->userdata('user_id'),'tenant_id'=>$this->session->userdata('tenant_id'),'exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'mock'=>$mock);
    $res['no_of_que']=$this->userprofile_model->no_of_question($data);
    $res['attempt_que']=$this->userprofile_model->attempt_que($data);
    $res['correct_ans']=$this->userprofile_model->correct_ans($data);
    $res['total_marks']=$this->userprofile_model->total_marks($data);
    $got_marks=$this->userprofile_model->got_marks($data);
    $percentage=0;
    if($res['exam_master_info']['result_dependancy']==1)
    {

        if($got_marks['cnt']!=0)
        {
           $percentage=($got_marks['cnt']/$res['total_marks']['cnt'])*100;
       }
       $res['got_marks']=$got_marks;
   }
   else
   {
    if($res['no_of_que']['cnt']!=0)
    {
       $percentage=($res['correct_ans']['cnt']/$res['no_of_que']['cnt'])*100;
   }
   $res['got_marks']=$res['correct_ans'];
}


$condition_array=array('user_id'=>$this->session->userdata('user_id'),'tenant_id'=>$this->session->userdata('tenant_id'),'exam_id'=>$exam_id,'quiz_id'=>$quiz_id);

$insert_array=array('no_of_question'=> $res['no_of_que']['cnt'],'attempt_question'=> $res['attempt_que']['cnt'],'correct_answer'=>$res['correct_ans']['cnt'],'total_marks'=>$res['got_marks']['cnt'],'percentage'=>$percentage,'out_of_marks'=>$res['total_marks']['cnt']);

$this->userprofile_model->update_exam_summary_in_quiz_log($condition_array,$insert_array,$mock);

$this->session->unset_userdata('quiz_id');
$this->session->unset_userdata('exam_id');
$this->session->unset_userdata('mock');
$this->userprofile_model->remove_key($this->session->userdata('user_id'),$this->session->userdata('tenant_id'),$exam_id,$mock);
$this->load->view('time_out_view');
if($quiz_id=='' && $exam_id=='')
{
   redirect('registration/user_profile_display');
}

}
public function get_exam_time()
{

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

   $format = 'Y-m-d h:i a';

    $current = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone("Asia/Kolkata"));

    $current->setTimeZone(new DateTimeZone("Asia/Kolkata"));

   $current_date=$current->format($format);

   $id=$this->session->userdata('user_id');
   $tenant_id=$this->session->userdata('tenant_id');
   $res=$this->userprofile_model->get_exam_time($_POST['quiz_id'],$_POST['exam_id'],$tenant_id);
       // print_r($res);die;
   if(strtotime($res['start_date'])<=strtotime($current_date))
   {
      echo 1;die;
   }else
   {
      echo 2;die;
   }

}



public function review_options($quiz_id,$exam_id)
{
 $user_id=$this->session->userdata('user_id');
 $tenant_id=$this->session->userdata('tenant_id');

 $where_array=array('A.tenant_id'=>$tenant_id,'B.tenant_id'=>$tenant_id,'C.tenant_id'=>$tenant_id,'A.user_id'=>$user_id,'A.exam_id'=>$exam_id,'A.quiz_id'=>$quiz_id);
 $groupby='';
 $join_array=array(array('answer_bank as B','A.question_id=B.question_id'),array('option_master as C','C.id=B.option_id'),array('question_bank as D','A.question_id=D.id'));
 $query=$this->modelbasic->accessDatabase('quiz as A','A.question_id,A.selected_answer, A.multiple_selected_answers, A.correct_answer_opt_id,C.option,C.id as option_id,D.question, B.option_id as a_option_id, B.correct_answer as a_correct_answer','join_order_limit',$groupby,$where_array, $join_array,'');

 $resultData=$query->result_array();

 $questionData=array();
 $questionOptionIDs = array();

 if(!empty($resultData))
 {
    foreach ($resultData as $key => $value)
    {
        if(!empty($value['multiple_selected_answers'])){
            if(!isset($questionData[$value['question_id']]['option']))
            {
                $correctOPtions = $this->modelbasic->getMultipleOptionIdsQuestions($value['question_id']);

                $questionData[$value['question_id']]= array(
                    'question_id'=>$value['question_id'],
                    'question'=>$value['question'],
                    'correct_answer_opts'=>array_column($correctOPtions, 'option_id'),
                    'user_seleted_opts' => unserialize($value['multiple_selected_answers']),
                    'option'=>array(
                        $value['option_id']=>$value['option']
                    ),
                    'selected_answer'=>$value['selected_answer'],
                    'option_ids'=>array(
                        $value['option_id']=>$value['option_id']
                    ),
                );
            }
            else
            {
                $questionData[$value['question_id']]['option'][$value['option_id']]=$value['option'];
                $questionData[$value['question_id']]['option_ids'][$value['option_id']]=$value['option_id'];
            }
        }

    }

    $data['review_q_data'] = $questionData;
    $this->load->view('review_answers_view',$data);

  }
  else{
    $this->load->view('review_answers_view');
  }

}



}