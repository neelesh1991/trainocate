<?php

if (!defined('BASEPATH'))

    exit('No direct script access allowed');

class Dashboard extends CI_Controller

{

  function __construct()

  {

        parent::__construct();

        $this->load->helper('text');

        $this->load->model('test_model');

        $this->load->model('dashboard_model');

   }

  public function index()

  {
    $data['page_name']='dashboard_view';

    $tenant_id=$this->session->userdata('tenant_id');

    $admin_level=$this->session->userdata('admin_level');

    // $data['total_users']=$this->dashboard_model->get_total_users($tenant_id);

    // $data['total_exams']=$this->dashboard_model->get_total_exams($tenant_id);

    // $data['total_question']=$this->dashboard_model->get_total_question($tenant_id);

    $data['total_users']=$this->dashboard_model->get_total_users($tenant_id,$admin_level);

    $data['total_exams']=$this->dashboard_model->get_total_exams($tenant_id,$admin_level);

    $data['total_question']=$this->dashboard_model->get_total_question($tenant_id,$admin_level);

    /**
     * Total Assetment with retry
     */


    $getQuizLogdata = $this->dashboard_model->getQuizLogData($tenant_id,'',$admin_level);
    $getRetryLog = $this->dashboard_model->retryLogData($tenant_id,'',$admin_level);
    $allQuizLogData = array_merge($getQuizLogdata,$getRetryLog);
    $logResults = array_unique($allQuizLogData, SORT_REGULAR);



    $data['total_assements']= count($logResults);

    /*$retryCount = $this->dashboard_model->get_total_retry_assements($tenant_id);
    $data['total_retry_assements']=array_sum(array_column($retryCount, 'count'));*/


    $data['exam_detail']=$this->dashboard_model->get_exams_detail($tenant_id);

    $data['levels']=$this->dashboard_model->get_levels($tenant_id);
    //print_r($data['total_retry_assements']);die;

    $this->load->view('index',$data);

  }

     public function search_exam_summary()

     {

      $tenant_id=$this->session->userdata('tenant_id');

      $res=$this->dashboard_model->search_exam_summary($tenant_id,$this->input->post('exam_id'),$this->input->post('min_marks'),$this->input->post('max_marks'),$this->input->post('level'));

     // $res=$this->dashboard_model->search_exam_summary($tenant_id,$this->input->post('exam_id'),$this->input->post('min_marks'),$this->input->post('max_marks'));

      //print_r($res);die;

      $above_marks=$this->dashboard_model->above_marks($tenant_id,$this->input->post('exam_id'),$this->input->post('min_marks'),$this->input->post('max_marks'));

        $assigned_exams=$this->dashboard_model->total_assigned_exams($this->input->post('exam_id'));

        $user_attempt_exams=$this->dashboard_model->user_attempt_exams($tenant_id,$this->input->post('exam_id'));

      $str='

          <div class="col-md-12">

            <div class="panel widget">

              <div class="panel-heading vd_bg-grey">

                <h3 class="panel-title"> <span class="menu-icon"></span> Student Report</h3>

              </div>

              <a href="'.base_url().'dashboard/export_to_csv/'.$this->input->post('exam_id').'"><button class="btn vd_btn vd_bg-twitter"  style="margin: 6px 0px 6px 3px;"> Export Csv</button></a>

              <div class="panel-body table-responsive">

                <table class="table table-hover">

                  <thead>

                    <tr>

                      <th>#</th>

                      <th>Name</th>

                      <th>Name of Exam</th>

                      <th>Number of question</th>

                      <th>Attempt questions</th>

                      <th>Correct Answers</th>

                      <th>Marks Summary</th>

                      <th>Level</th>

                      <th>Action</th>

                    </tr>

                  </thead>';

                  $i=1;

                  foreach ($res as $val) {
                   // print_r($res);die;
                    //$correct_ans_id=$this->dashboard_model->get_result($val['quiz_id'],$val['exam_id'],$val['user_id'],$val['tenant_id']);


                    $qid = $val['quiz_id'];
                    $eid = $val['exam_id'];
                    $uid = $val['user_id'];



                  $str .='<tbody>

                    <tr>

                      <td>'.$i.'</td>

                      <td>'.$val['name'].'</td>

                      <td class="center">'.$val['exam_name'].'</td>

                      <td class="center">'.$val['no_of_question'].'</td>

                      <td class="center">'.$val['attempt_question'].'</td>

                     <td class="center">'.$val['correct_answer'].'</td>


                      <td class="center">Obtained:'.$val['total_marks'].'<br>Out of:'.$val['out_of_marks'].'<br>Percentage:'.$val['percentage'].'</td>

                      <td class="center">'.$val['level'].'</td>

                      <td class="center"><a onclick="users_attempt_que_ans('.$val['user_id'].','.$val['quiz_id'].','.$val['exam_id'].','.$val['tenant_id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-eye"></i> </a><a href="'.base_url().'manage_user_completed_exams/user_exam_export_to_csv/'.$qid.'/'.$eid.'/'.$uid.'" class="btn menu-icon vd_bd-green vd_green" data-placement="top" data-toggle="tooltip" data-original-title="Export to CSV"> <i class=" fa fa-file-text" aria-hidden="true"></i></a></td>

                    </tr>



                  </tbody>';

                  $i++;

                  }

                $str.='</table>

              </div>

            </div>

          </div>

        </div>';

        $not_attempt=($assigned_exams-$user_attempt_exams['cnt']);

        $total_data=array('table'=>$str,'assigned_exams'=>$assigned_exams,'user_attempt_exams'=>$user_attempt_exams['cnt'],'not_attempt'=>$not_attempt,'marks_criteria'=>$above_marks['cnt']);

      $data=json_encode($total_data);

      echo $data;die;

    }



    public function export_to_csv($exam_id = '')

    {


$tenant_id=$this->session->userdata('tenant_id');


if($exam_id && $exam_id != ''){

 $getQuizLogdata = $this->dashboard_model->getQuizLogData($tenant_id,$exam_id);
 $getRetryLog = $this->dashboard_model->retryLogData($tenant_id,$exam_id);

} else{
  $getQuizLogdata = $this->dashboard_model->getQuizLogData($tenant_id);
  $getRetryLog = $this->dashboard_model->retryLogData($tenant_id);

}





$allQuizLogData = array_merge($getQuizLogdata,$getRetryLog);


$logResults = array_unique($allQuizLogData, SORT_REGULAR);

  if($exam_id && $exam_id != ''){
     $ldatas = array();
            foreach ($logResults as $key => $row)
            {
              $ldatas[$key] = $row['user_id'];
            }
            array_multisort($ldatas, SORT_ASC, $logResults);
      }






$cd = date("d-m-Y_h_i_sa");
            $headers = ["user_id", "name", "email_id", "contact_no", "organization", "city", "exam_id", "exam_name", "attempted_date", "no_of_question", "attempt_question", "correct_answer","out_of_marks","total_marks", "percentage"];
            header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=\"manage_users_".".csv\"");
            header("Content-Disposition: attachment; filename=\"manage_users_".$cd.".csv\"");
            header("Pragma: no-cache");
            header("Expires: 0");

            $handle = fopen('php://output', 'w');

            //Add the headers
            fputcsv($handle, $headers);

            foreach ($logResults as $key => $value) {

               fputcsv($handle, $value);


            }


     fclose($handle);
            exit;


/*















      $this->load->dbutil();

      $this->load->helper('file');

      $this->load->helper('download');

      $delimiter = ",";

      $newline = "\r\n";

      $upload_path='../downloads/csv/';

        if(!is_dir($upload_path))

        {

          @mkdir($upload_path, 0777, TRUE);

        }

        if(!is_dir($upload_path.'users/'))

        {

          @mkdir($upload_path.'users/', 0777, TRUE);

        }

      $filename = "manage_users_".date("d-m-Y_h_i_sa").".csv";

      $fullPath = "../downloads/csv/users/manage_users_".date("d-m-Y_h_i_sa").".csv";



      $tenant_id=$this->session->userdata('tenant_id');

      $query=$this->dashboard_model->search_exam_summary_csv($tenant_id,$this->input->post('exam_id'),$this->input->post('min_marks'),$this->input->post('max_marks'),$this->input->post('level'));



      $result = $this->db->query($query);



      $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);


      if ( ! write_file($fullPath, $data))

      {

           echo 'Unable to write the file';


           //redirect('dashboard');

      }

      else

      {


          echo $filename;die;


      }*/

    }



    public function users_attempt_que_ans()

    {

     // print_r($_POST);die;

      $exam_id = $this->input->post('exam_id');

      $user_id = $this->input->post('user_id');

      $quiz_id = $this->input->post('quiz_id');

      $tenant_id = $this->input->post('tenant_id');

      $query=$this->dashboard_model->users_attempt_que_ans($user_id,$exam_id,$quiz_id,$tenant_id);

     // print_r($query);die;

     /* if(!empty($query))

      {

       $j=0;



        foreach ($query as $value)

         {

          $i=0;

          $query[$j]['options'][$i]='';

          $query[$j]['correct_answer']='';

          $query[$j]['selected_answer_name']='';



            $options=$this->dashboard_model->selectOptions($value['question_id']);



           // print_r($options);die;



            foreach ($options as $keys)

            {

              if($value['selected_answer']==$keys['id'])

              {

                $query[$j]['selected_answer_name']=$keys['option'];

              }



              if($keys['correct_answer']==1)

              {

                $query[$j]['correct_answer']=$keys['option'];

              }

             // $query[$j]['options'][$i]=$keys['option'];

              $i++;

           }

           $j++;



        }

      }*/

      //print_r($query);die;



      $data['ajax']=json_encode($query);



      $this->load->view('ajax_view',$data);

    }









}