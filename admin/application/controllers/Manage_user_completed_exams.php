<?php

if (!defined('BASEPATH'))

exit('No direct script access allowed');

class Manage_user_completed_exams extends CI_Controller

{

  function __construct()

  {

    parent::__construct();

    $this->load->library('upload');

    $this->load->library('image_lib');

    $this->load->helper('imgupload');

    $this->load->library('form_validation');

    $this->load->model('test_model');

  }

  public function index()

  {

    /*$res = array('id !='=>'1');

    $data['tenant']=$this->modelbasic->getAllWhere('tenant','*',$res);*/

    $data['users']=$this->modelbasic->getAllWhere('users','*');

    $data['page_name']='manage_user_completed_exams_view';

    $this->load->view('index',$data);

  }

  public function getAjaxdataObjects()

  {
    $timezone='Asia/Kolkata';
    if($this->session->userdata('time_zone')!='')
    {
        $timezone=$this->session->userdata('time_zone');
    }
    $tz_from = 'UTC';
    $tz_to = $timezone;
    $format = 'Y-m-d h:i:s a';


    $_POST['columns']='quiz_log.id,quiz_log.quiz_id, quiz_log.exam_id, quiz_log.user_id, quiz_log.start_time, quiz_log.end_time,quiz_log.total_exam_completed_in, users.name, users.email_id, exam_master.exam_name,exam_master.end_date,exam_master.start_date, quiz_log.tenant_id,exam_master.duration';
    $requestData = $_REQUEST;
    $columns=explode(',',$_POST['columns']);
    $selectColumns = "quiz_log.id, quiz_log.quiz_id, quiz_log.exam_id, quiz_log.user_id,quiz_log.total_exam_completed_in, quiz_log.start_time, quiz_log.end_time, users.name, users.email_id, exam_master.exam_name,exam_master.end_date,exam_master.start_date, quiz_log.tenant_id, exam_master.duration";


    $condition=array('quiz_log.tenant_id'=>$this->session->userdata('tenant_id'));


    $join_array=array(
      array('exam_master as exam_master','exam_master.id=quiz_log.exam_id'),
      array('users as users','users.id=quiz_log.user_id'),
      array('quiz_master as quiz_master','quiz_master.id=quiz_log.quiz_id')

    );


    $totalData=$this->modelbasic->count_all_only('quiz_log as quiz_log',$condition);
    $totalFiltered=$totalData;


    $result=$this->modelbasic->run_query_with_join('quiz_log as quiz_log',$requestData,$columns,$selectColumns,'','',$condition,$join_array);

     /* $totalData=count($result);

    $totalFiltered=$totalData;*/


    //$result=$this->modelbasic->get_quiz_log_users($this->session->userdata('tenant_id'));
    //print_r($result);exit;
    //$result=$this->modelbasic->getAllWhere('exam_master','*',$condition);
    if( !empty($requestData['search']['value']) )
    {
            $totalFiltered=count($result);

    }
    $data = array();
    if(!empty($result))
    {
      $i=1;
      foreach ($result as $row)
      {

        $nestedData=array();
        $nestedData['chk'] = '<div class="vd_checkbox checkbox-success"><input type="checkbox" class="case" id="check-'.$row["id"].'" name="checkall['.$row["id"].']" data-index="'.$row["id"].'"><label for="check-'.$row["id"].'"> </label></div>';
        $nestedData['id'] =$row["id"];
        //$nestedData['quiz_id'] =$row["quiz_id"];
        $quiz_name_data=$row['name'];
        //$nestedData['quiz_name']=$quiz_name_data['quiz_name'];
        //
        $nestedData['info'] = '<div style="text-align:left;"><b>Exam Name : </b>'.$row['exam_name'].'<br/><b>Duration : </b> '.$row["duration"].'</div>';
        //print_r($nestedData);die;
        $start = new DateTime($row["start_time"], new DateTimeZone($tz_from));
        $start->setTimeZone(new DateTimeZone($tz_to));
        $start_date=$start->format($format);

        $end = new DateTime($row["end_time"], new DateTimeZone($tz_from));
        $end->setTimeZone(new DateTimeZone($tz_to));
        $end_date=$end->format($format);

        $nestedData['start_date'] =$start_date;
        $nestedData['exam_name'] =$row["exam_name"];
        $nestedData['end_date'] =$end_date;
        //$nestedData['duration'] =$row["duration"];
        $nestedData['completion_message'] =$start_date;
        $export='';

        $nestedData['user_info'] ='<div style="text-align:left;"><b>Name : </b>'.$row['name'].'<br/><b>Email : </b> '.$row["email_id"].'</div>';

        $date_a = new DateTime($end_date);
        $date_b = new DateTime($start_date);

        $interval = date_diff($date_a,$date_b);


        if(!empty($row['total_exam_completed_in'])){
          $nestedData['exam_completed_in'] = $row['total_exam_completed_in']; //$interval->format('%H:%I:%S');
        }
        else{
          $nestedData['exam_completed_in'] = $interval->format('%H:%I:%S');
        }

        //show levels
        $nestedData['show_levels'] =$row["email_id"];

        $nestedData['result_dependancy'] =$start_date;

        $qid = $row["quiz_id"];
        $eid = $row["exam_id"];
        $uid = $row["user_id"];

        $nestedData['action'] = '<div class="menu-action">

              <a onclick="delete_confirm('.$row['id'].');" class="btn menu-icon vd_bd-red vd_red" data-placement="top" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-times"></i></a>  <a href="'.base_url().'manage_user_completed_exams/user_exam_export_to_csv/'.$qid.'/'.$eid.'/'.$uid.'" class="btn menu-icon vd_bd-green vd_green" data-placement="top" data-toggle="tooltip" data-original-title="Export to CSV"> Export</a>'.$export.'
               </div>';
              $data[] = $nestedData;
              $i++;
            }
          }
          $json_data = array(
              "draw"            => intval( $requestData['draw'] ),
              "recordsTotal"    => intval( $totalData ),  // total number of records
              "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
              "data"            => $data   // total data array
              );
          //print_r($nestedData);die;
          $data['ajax']=json_encode($json_data);
          $this->load->view('ajax_view',$data);
  }

  public function delete_confirm($id)

  {

    $res=$this->modelbasic->_delete('quiz_log',$id);

    if($res>0)

    {

      $this->session->set_flashdata('success', 'User Exam Deleted Successfully');

      redirect('manage_user_completed_exams');

    }

    else

    {

      echo FALSE;

    }

  }






  function multiselect_action()

    {

      if(isset($_POST['submit']))

      {

        $check = $_POST['checkall'];

        foreach($check as $key => $value)

        {

          if($_POST['listaction'] == '1')

          {

            $status = array('status'=>'1');

            $this->modelbasic->_update('manage_groups',$key,$status);

            $this->session->set_flashdata('success', 'Group activated successfully');

          }

          elseif($_POST['listaction'] == '2')

          {

              $status = array('status'=>'0');

              $this->modelbasic->_update('manage_groups',$key,$status);

              $this->session->set_flashdata('success', 'Group deactivated successfully');

          }

          elseif($_POST['listaction'] == '3'){

            $this->modelbasic->_delete('manage_groups',$key);

            $this->session->set_flashdata('success', 'Group deleted successfully');

          }

        }

        redirect('manage_groups');

      }

    }



   /**
    * [user_exam_export_to_csv Specific to user]
    * @param  [type] $quiz_id [description]
    * @param  [type] $exam_id [description]
    * @return [type]          [description]
    */
    public function user_exam_export_to_csv($quiz_id,$exam_id, $user_id){


      $tenant_id=$this->session->userdata('tenant_id');

       $where_array=array('A.tenant_id'=>$tenant_id,'B.tenant_id'=>$tenant_id,'C.tenant_id'=>$tenant_id,'A.user_id'=>$user_id,'A.exam_id'=>$exam_id,'A.quiz_id'=>$quiz_id, 'quiz_log.exam_id'=>$exam_id,
        'quiz_log.user_id'=>$user_id );

        $groupby='';
        $join_array=array(
            array('answer_bank as B','A.question_id=B.question_id'),
            array('option_master as C','C.id=B.option_id'),
            array('question_bank as D','A.question_id=D.id'),
            array('exam_master as E','A.exam_id=E.id'),
            array('users as user','A.user_id=user.id'),
            array('quiz_log as quiz_log','A.quiz_id=quiz_log.quiz_id'),


          );


        $query=$this->modelbasic->accessDatabase('quiz as A','user.name as Name,user.email_id as Email address,user.contact_no as Mobile Number,user.organization as Organization,user.city as City, A.question_id,  E.exam_name, quiz_log.start_time, quiz_log.end_time, D.question ','join_order_limit',$groupby,$where_array, $join_array,'');
        $resultData=$query->result_array();



          $cd = date("d-m-Y_h_i_sa");
            $headers = ["Name", "Email", "Mobile Number", "Organization", "City", "Question ID", "Exam Name", "Start Time", "End Time", "Question", "User selected options", "Correct Options", "Correct"];
            header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=\"userExamCompletedDetails".".csv\"");
            header("Content-Disposition: attachment; filename=\"userExamCompletedDetails_".$cd.".csv\"");
            header("Pragma: no-cache");
            header("Expires: 0");

            $handle = fopen('php://output', 'w');

            //Add the headers
            fputcsv($handle, $headers);


        $questionData=array();
        $questionOptionIDs = array();

        $tempss = array();
        if(!empty($resultData))
        {
          foreach ($resultData as $key => $value)
          {



             if(!in_array($value['question_id'], $tempss)){


              $getMultpleSeltedOpts = $this->modelbasic->getUserMulValues($value['question_id']);

              $usrStOPtionsList = unserialize(end($getMultpleSeltedOpts)['multiple_selected_answers']);


              if(!empty($usrStOPtionsList)){

                /**
                 * [$userSeletedOpt description]
                 * @var string
                 */
                 $userSeletedOpt = '';

                foreach ($usrStOPtionsList as $seltedkey => $seletedValue) {

                $seletedValues = $this->modelbasic->getCSVOptionValue($seletedValue);
                $userSeletedOpt .= '- '. end($seletedValues)['option']."\n\n";
              }

              $value['userSeletedOpt'] = $userSeletedOpt;





              /**
               * [$correctOPtions description]
               * @var [type]
               */
              $correctOPtions = $this->modelbasic->getCSVMultipleOptionIdsQuestions($value['question_id']);

              $crtOPtionValue = '';
              foreach ($correctOPtions as $ckey => $crctOPt) {
               $crtOPtionValue .= '- '. $crctOPt['option']."\n\n";
             }
             $value['crtopts'] = $crtOPtionValue;


              //sort
                $correctOPtionsForCheck = array_column($correctOPtions, 'option_id');
                sort($usrStOPtionsList);
                sort($correctOPtionsForCheck);

              if($usrStOPtionsList == $correctOPtionsForCheck){
                $value['Correct'] = 1;
                //$value['Wrong'] = 0;

              } else{
                $value['Correct'] = 0;
                //$value['Wrong'] = 0;
              }



              fputcsv($handle, $value);

             $tempss[] = $value['question_id'];

             //print_r($value);



           }

      }




       }

        $footerEmpty = ["", "", "", "", "", "", "", "", "", "", "", "", ""];
        $footerEmpty1 = ["", "", "", "", "", "", "", "", "", "", "", "", ""];
        $footerEmpty2 = ["", "", "", "", "", "Score Details", "", "", "", "", "", "", ""];
        $footerEmpty3 = ["", "", "", "", "", "", "", "", "", "", "", "", ""];
        fputcsv($handle, $footerEmpty);
        fputcsv($handle, $footerEmpty1);
        fputcsv($handle, $footerEmpty2);
        fputcsv($handle, $footerEmpty3);

        $getTotal = $this->modelbasic->getTotalQuizLog($quiz_id, $exam_id, $user_id);
        $getTotal = end($getTotal);



        $totals = ["", "" , "",  "No of Questions", "Attempted Questions", "Correct Answers", "Total Marks"];
        $totalsPrint = ["", "" , "", $getTotal['no_of_question'] , $getTotal['attempt_question'],  $getTotal['correct_answer'], $getTotal['total_marks'] ];

        fputcsv($handle, $totals);
        fputcsv($handle, $totalsPrint);


     fclose($handle);
            exit;



    }




    }



  }