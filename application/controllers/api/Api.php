<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Api extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('api_model');
        $this->load->model('modelbasic');
        $this->load->model('userprofile_model');
         $this->load->model('registration_model');
    }

public function checkLogin_post()
  {
//print_r($this->post());die;
      if($this->post('userName')=='')
      {
        $error = array( "statusCode" => 404, "errorMessage" => "User Name field is required", "statusMessage" => "Error");
        echo json_encode($error);die;
      }
      if($this->post('password')=='')
      {
        $error = array( "statusCode" => 404, "errorMessage" => "password field is required", "statusMessage" => "Error");
        echo json_encode($error);die;
      }

      $data=$this->post();
      $res=$this->api_model->checkLogin($data);

     if(!empty($res))
         {
 $dataFinal = array("userId"=>$res->id,"tenantId"=>$res->tenant_id);
           $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
           $status = array_merge($dataFinal,$status);
         }
         else
         {
           $status = array( "statusCode" => 404, "errorMessage" => "Data not found", "statusMessage" => "Error" );
         }
        // print_r($status);die;
      echo json_encode($status);
  }

public function registerUser_post()
    {


        $tenant_id = 20;
        if($this->post('name')=='')
        {
          $error = array( "statusCode" => 404, "errorMessage" => "User Name field is required", "statusMessage" => "Error");
          echo json_encode($error);die;
        }
        if($this->post('password')=='')
        {
          $error = array( "statusCode" => 404, "errorMessage" => "password  field is required", "statusMessage" => "Error");
          echo json_encode($error);die;
        }
        if($this->post('email')=='')
        {
          $error = array( "statusCode" => 404, "errorMessage" => "email Id field is required", "statusMessage" => "Error");
          echo json_encode($error);die;
        }
        if($this->post('mobileNumber')=='')
        {
          $mobileNumber = 0;
        }
       else
        {
         $mobileNumber = $this->post('mobileNumber');
        }

       if($this->post('academicyear')=='')
        {
          $academicyear = '';
        }
       else
        {
         $academicyear = $this->post('academicyear');
        }
       if($this->post('group')=='')
        {
          //$group = '';
 $groupName='general';
          $check_group = array('group_name'=>$groupName,'tenant_id'=>$tenant_id);
          $groupExist=$this->modelbasic->getSelectedData('manage_groups','id',$check_group,'','','','','','row_array');
          //print_r($groupExist);die;
          if(!empty($groupExist))
          {
            $groupId=$groupExist['id'];
          }
          else
          {
            $data=array('tenant_id'=>$this->session->userdata('tenant_id'),'group_name'=>$groupName,'created'=>date('Y-m-d H:i:s'));
            $groupId=$this->modelbasic->_insert('manage_groups',$data);
          }

        }
       else
        {
         $groupId= $this->post('group');
        }
     if($this->post('timeZone')=='')
        {
          $timezone = 'Asia/Kolkata';
        }
       else
        {
         $timezone = $this->post('timeZone');
        }



         $condition=array('email_id'=>$this->post('email'),'tenant_id'=>$tenant_id);
         $email_check =$this->modelbasic->getValue('users','id',$condition);
        // print_r($email_check);die;
         if($email_check!= '')
         {
            $error = array( "statusCode" => 404, "errorMessage" => "email Id is already Exist.", "statusMessage" => "Error");
            echo json_encode($error);die;
         }
         else
         {



        $data=array('name'=>$this->post('name'),'email_id'=>$this->post('email'),'contact_no'=>$mobileNumber,'password'=>md5($this->post('password')),'academic_year'=>$academicyear,'group_id'=>$groupId,'timezone'=>$timezone,'tenant_id'=>$tenant_id);

         /*if(isset($this->post('academicyear')))
         {
         $data[academic_year] = $this->post('academicyear');
         }


         $data=array('name'=>$this->post('name'),'email_id'=>$this->post('email'),'contact_no'=>$mobileNumber,'password'=>md5($this->post('password')),'group_id'=>$this->post('group'),'tenant_id'=>$tenant_id);
         if($this->post('academicyear')=='')
         {
         $data['academic_year'] = $this->post('academicyear');
         }
           if($this->post('timeZone')=='')
         {
         $data['timezone'] = $this->post('timeZone');
         }

        print_r($data);die;

        */

       // print_r($data);die;

        $res=$this->modelbasic->_insert('users',$data);

        $dataFinal = array("userId"=>$res);
        if(!empty($res))
            {
              $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
              $status = array_merge($dataFinal,$status);
            }
            else
            {
              $status = array( "statusCode" => 404, "errorMessage" => "Data not found", "statusMessage" => "Error" );
            }
           // print_r($status);die;
         echo json_encode($status);

         }
    }

public function getUserById_post()
  {
      if($this->post('userId')!='')
      {
        $id = $this->post('userId');
      }
      else
      {
        $error = array( "statusCode" => 404, "errorMessage" => "User id field is required", "statusMessage" => "Error");
        echo json_encode($error);die;
      }
      $res=$this->modelbasic->getSelectedData('users','id,name,email_id,password,contact_no,photo,academic_year,age,institute_name,tenant_id,principal_name,timezone',array('id'=>$id),$orderBy='',$dir='',$groupBy='',$limit='',$offset='',$resultMethod='row_array');

 if($res['timezone'] != '')
      {
        $userTimezonData = $this->modelbasic->getSelectedData('timezone','*',array('timezone'=>$res['timezone']),$orderBy='',$dir='',$groupBy='',$limit='',$offset='',$resultMethod='row_array');
      //  print_r($userTimezonData);die;
        $timezonArray = array('id'=>$userTimezonData['timezone'],'name'=>$userTimezonData['name']);

      }
      else
      {
      $timezonArray = array();
      }

      if($res['photo']!='')
      {
        $filename="./uploads/".$res['tenant_id']."/users_photo/".$id."/".$res['photo'];

        if (file_exists($filename)){

          $image_src = base_url()."uploads/".$res['tenant_id']."/users_photo/".$id."/".$res['photo'];

       }  else  {

        $image_src = base_url().'assets/img/u.jpg';

       }  }  else  {
        $image_src = base_url().'assets/img/u.jpg';

      }

/*
      $examData=$this->api_model->geUserExam($id);

      if(!empty($examData))
      {
      $examList = array(["examId"=>$examData['id'],"examName"=>$examData['exam_name'],"startDate"=>$examData['start_date'],"endDate"=>$examData['end_date'],"examType"=>$examData['section_name']]);
      }
      else
      {
      $examList = array(["examId"=>"","examName"=>"","startDate"=>"","endDate"=>"","examType"=>""]);
	}

*/
//echo $id;
 $examDataArray=$this->api_model->geUserExam($id);
//print_r($examDataArray);die;

      if(!empty($examDataArray))
      {
          foreach ($examDataArray as $examData)
          {

            $tz_from = 'UTC';
            $tz_to = $res['timezone'];
            $format = 'Y-m-d h:i a';

                $EST = $examData['start_date'];
                $EET = $examData['end_date'];
                $start_dt = new DateTime($EST, new DateTimeZone($tz_from));
                $start_dt->setTimeZone(new DateTimeZone($tz_to));
                $examStartTime=$start_dt->format($format);

                $end_dt = new DateTime($EET, new DateTimeZone($tz_from));
                $end_dt->setTimeZone(new DateTimeZone($tz_to));
                $examEndTime=$end_dt->format($format);



            $examList[] = array("examId"=> + $examData['id'],"examName"=>$examData['exam_name'],"startDate"=>$examStartTime,"endDate"=>$examEndTime,"examType"=>$examData['section_name'],"showResult"=>$examData['show_results']);

          }
      }
      else
      {
           $examList = array();
	    }

      $dataFinal = array(  "userId"=>$id,"name"=>$res['name'],"emailId"=>$res['email_id'],"password"=>$res['password'],"mobileNumber"=>$res['contact_no'],"profileImageUrl"=>$image_src,"academicyear"=>$res['academic_year'],"age"=>$res['age'],"instituteName"=>$res['institute_name'],"tenantId"=>$res['tenant_id'],"principalName"=>$res['principal_name'],"timeZone"=>$timezonArray,"examList"=>$examList);


      if(!empty($res))
          {
            $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
            $status = array_merge($dataFinal,$status);
          }
          else
          {
            $status = array( "statusCode" => 404, "errorMessage" => "Data not found", "statusMessage" => "Error" );
          }
         // print_r($status);die;
       echo json_encode($status);
  }

public function getGroupList_post()
  {
    $tenant_id = 20;
    $res=$this->modelbasic->getSelectedData('manage_groups','*',array('tenant_id'=>$tenant_id,'signup_show'=>'1','status'=>'1'),$orderBy='',$dir='',$groupBy='',$limit='',$offset='',$resultMethod='');

    if(!empty($res))
    {
      $i=0;
      $dataFinal['groupList']='';
      foreach ($res as $value) {
        $dataFinal['groupList'][$i] = array("id"=>$value['id'],"name"=>$value['group_name']);
        $i++;
      }

      $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
      $status = array_merge($dataFinal,$status);
    }
    else
    {
      $dataFinal['groupList'] = array("id"=>'',"name"=>'');
      $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
      $status = array_merge($dataFinal,$status);

    }
   echo json_encode($status);
  }

  public function getTimeZoneList_post()
  {
    $res=$this->modelbasic->getSelectedData('timezone','*');

    if(!empty($res))
    {
      $i=0;
      $dataFinal['timeZoneList']='';
      foreach ($res as $value) {
        $dataFinal['timeZoneList'][$i] = array("id"=>$value['timezone'],"name"=>$value['name']);
        $i++;
      }

      $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
      $status = array_merge($dataFinal,$status);
    }
    else
    {
      $dataFinal['timeZoneList'] = array("id"=>'',"name"=>'');
      $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
      $status = array_merge($dataFinal,$status);

    }
   echo json_encode($status);
  }

  /************************* 1-11-2017 *****************************************/

public function updateUserInfo_post()
{
  if($this->post('userId')=='')
  {
    $error = array( "statusCode" => 404, "errorMessage" => "User Id field is required", "statusMessage" => "Error");
    echo json_encode($error);die;
  }

  $gcmToken=array('user_id'=>$this->post('userId'),'device_id'=>$this->post('deviceId'),'gcm_token'=>$this->post('gcmToken'));

  $data=array('name'=>$this->post('name'),'contact_no'=>$this->post('contactNumber'),'address'=>$this->post('address'),'age'=>$this->post('age'),'institute_name'=>$this->post('instituteName'),'academic_year'=>$this->post('academicYear'),'principal_name'=>$this->post('principalName'),'timezone'=>$this->post('timeZone'),'tenant_id'=>$this->post('tenantId'));

//print_r($data);die;

  $res=$this->modelbasic->_update('users',$this->post('userId'),$data);

  if($res == '1')
      {
        $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
      }
      else
      {
        $status = array( "statusCode" => 404, "errorMessage" => "Fail to update user information", "statusMessage" => "Error" );
      }
     // print_r($status);die;
   echo json_encode($status);
}

/**************************** 1-12-2017 *****************************************/

public function forgotPassword_post()
  {
	  if($this->post('email')=='')
	  {
	    $error = array( "statusCode" => 404, "errorMessage" => "Email Id field is required", "statusMessage" => "Error");
	    echo json_encode($error);die;
	  }

     $emailchck=$this->modelbasic->getSelectedData('users','status,id,email_id,tenant_id,name',array('email_id'=>$this->post('email')),$orderBy='',$dir='',$groupBy='',$limit='',$offset='',$resultMethod='row_array');

  // print_r($emailchck);

     if(!empty($emailchck))
         {
          $password_link=md5($emailchck['id'].$this->post('email'));
          $tenantInfo=$this->modelbasic->getSelectedData('tenant','*',array('id'=>$emailchck['tenant_id']),'','','','','','row_array');
          $res=$this->modelbasic->_update('users',$emailchck['id'],array('forgot_password_link'=>$password_link));
        // print_r($res);die;

          if($res==1)
             {

                $emaildata=$this->registration_model->getValEmailTemp('manage_email_template','*',array('id'=>2,'tenant_id'=>$tenantInfo['id']));
                $msg=$emaildata['email_contains'];
                $msg=str_replace('{logo_link}','<img src="'.front_base_url().'uploads/'.$tenantInfo['id'].'/logo/thumbs/'.$tenantInfo['logo'].'" alt="logo" />', $msg);
                $msg=str_replace('{user_name}',$emailchck['name'], $msg);
                $msg=str_replace('{regards}',$tenantInfo['name'], $msg);
                $msg=str_replace('{password_link}',base_url().'auth/verify_pwd_link/'.$password_link, $msg);

                  $data = array('fromEmail' =>'admin@trainocateassessments.com', 'to'=>$this->post('email'),'fromName'=>$tenantInfo['name'],'subject'=>$emaildata['subject'],'template'=>$msg);
                  $sendRes=$this->modelbasic->sendMail($data);
                  if($sendRes)
	          {
	           $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
	          }
	          else
	          {
	            $status = array( "statusCode" => 404, "errorMessage" => "Your account is detective please contact admin ", "statusMessage" => "Error" );
	          }

             }
             else
             {
             $status = array( "statusCode" => 404, "errorMessage" => "Fail To Send Email Please try again", "statusMessage" => "Error" );
             }

         }
         else
         {
           $status = array( "statusCode" => 404, "errorMessage" => "Invalid email id please enter valid email id.", "statusMessage" => "Error" );
         }
      echo json_encode($status);
  }

  public function uploadProfilePic_post()
    {
        if($this->post('userId')=='')
        {
          $error = array( "statusCode" => 404, "errorMessage" => "User Id field is required", "statusMessage" => "Error");
          echo json_encode($error);die;
        }
        if($this->post('bitmapString')=='')
        {
          $error = array( "statusCode" => 404, "errorMessage" => "Image is required", "statusMessage" => "Error");
          echo json_encode($error);die;
        }

        $ImageBitmapString=str_replace('\n','',$this->post('bitmapString'));
        $ImageBitmapString=str_replace('\u','',$this->post('bitmapString'));

        $id=$this->post('userId');
        $tenant_id=$this->post('tenantId');

        $userpath="uploads/".$tenant_id."/users_photo";
        $path ="uploads/".$tenant_id."/users_photo/".$id;
        $thumbspath="uploads/".$tenant_id."/users_photo/".$id."/thumbs";
        if(!(file_exists($path)))
        {
          mkdir($path,0777,TRUE);
        }
        if(!(file_exists($userpath)))
        {
            mkdir($userpath,0777,TRUE);
        }
        if(!(file_exists($thumbspath)))
        {
          mkdir($thumbspath,0777,TRUE);
        }

         $name=date('YmdHis').$id.'.jpeg';
         $destination= $path.'/'.$name;
         $img=file_put_contents($destination,base64_decode($ImageBitmapString));

         $this->load->library('image_lib');
         $config['image_library'] = 'gd2';
         $config['source_image'] = "./uploads/".$tenant_id."/users_photo/".$id.'/'.$name;
         $config['new_image'] = "./uploads/".$tenant_id."/users_photo/".$id.'/thumbs/'.$name;
         $config['create_thumb'] = FALSE;
         $config['maintain_ratio'] = TRUE;
         $config['width'] = 90;
         $config['height'] = 90;
         $this->image_lib->initialize($config);
         $return = $this->image_lib->resize();

         if($return==1)
         {
          $profile_photo = $this->modelbasic->getSelectedData('users','photo',array('id'=>$id),'','','','','',$resultMethod='row_array');
            if(isset($profile_photo['photo']) && ($profile_photo['photo'])!='')
              {
                if (file_exists($path))
                  {
                    $filename=$path.'/'.$profile_photo['photo'];
                    if (file_exists($filename))
                      {
                          $path1 = "./uploads/".$tenant_id."/users_photo/".$id.'/'.$profile_photo['photo'];
                          $path2 = "./uploads/".$tenant_id."/users_photo/".$id.'/thumbs/'.$profile_photo['photo'];
                          unlink( $path1);
                          unlink( $path2);
                      }
                  }
              }
          $update_profile = array('photo' => $name);
          $update_profile_res=$this->modelbasic->_update('users',$id,$update_profile);
          if($update_profile_res==1)
          {
            $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
          }
          else
          {
            $status = array( "statusCode" => 404, "errorMessage" => "Failed to Update Profile Picture", "statusMessage" => "Error" );
          }
       }
     else
     {
      $status = array( "statusCode" => 404, "errorMessage" => "Failed to Update Profile Picture", "statusMessage" => "Error" );
     }
     echo json_encode($status);
  }

  public function examDetail_post()
  {
    if($this->post('examId')=='')
    {
      $error = array( "statusCode" => 404, "errorMessage" => "Exam Id field is required", "statusMessage" => "Error");
      echo json_encode($error);die;
    }
    if($this->post('userId')=='')
    {
      $error = array( "statusCode" => 404, "errorMessage" => "User Id field is required", "statusMessage" => "Error");
      echo json_encode($error);die;
    }
    if($this->post('tenantId')=='')
    {
      $error = array( "statusCode" => 404, "errorMessage" => "Tenant Id field is required", "statusMessage" => "Error");
      echo json_encode($error);die;
    }

    if($this->post('mock')=='')
    {
      $mock = 0; //$mock = 0
    }
    else
    {
      $mock = 1; //$mock = 1
    }
    //print_r($mock);die;
    $exam_id=$this->post('examId');
    $tenant_id=$this->post('tenantId');
    $user_id=$this->post('userId');
    $get_quiz_id = $this->modelbasic->getSelectedData('exam_master','exam_name,quiz_id,show_results',array('id'=>$exam_id),'','','','','',$resultMethod='row_array');
    $quiz_id = $get_quiz_id['quiz_id'];

    $get_group_id = $this->modelbasic->getSelectedData('users','group_id',array('id'=>$user_id),'','','','','',$resultMethod='row_array');
    $group_id = $get_group_id['group_id'];

    $get_user_time_zone = $this->modelbasic->getSelectedData('users','timezone',array('id'=>$user_id),'','','','','',$resultMethod='row_array');
    $get_tenant_time_zone = $this->modelbasic->getSelectedData('tenant','timezone',array('id'=>$tenant_id),'','','','','',$resultMethod='row_array');

    if(isset($get_user_time_zone) && $get_user_time_zone['timezone']!='')
    {
        $timezone=$get_user_time_zone['timezone'];
    }
    if(isset($get_tenant_time_zone) && $get_tenant_time_zone['timezone']!='')
    {
        $timezone=$get_tenant_time_zone['timezone'];
    }
    if($timezone=='')
    {
     $timezone="Asia/Kolkata";
    }

    $format = 'Y-m-d h:i a';

    $current = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone($timezone));
    $current->setTimeZone(new DateTimeZone('UTC'));
    $current_date=$current->format($format);

    if($mock==0)
    {
        // echo " mock = 0 ";die;
        $finishExam=$this->modelbasic->getValue('quiz_log','finish',array('exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'tenant_id'=>$tenant_id,'user_id'=>$user_id));

        $is_quiz_expired=$this->userprofile_model->chck_is_quiz_expired($user_id,$tenant_id,$exam_id,$quiz_id);

        if(($is_quiz_expired['end_date']!='' && strtotime($current_date)>strtotime($is_quiz_expired['end_date'])) || ($is_quiz_expired['end_time']!='' && strtotime($current_date)>strtotime($is_quiz_expired['end_time'])))
        {
          //redirect('quiz/time_out');
          $dataFinal['examStatus'] = "TimeOut";//redirect quiz->timeout
          $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
          $status = array_merge($dataFinal,$status);
          echo json_encode($status);die;

        }
        if($finishExam == 1)
        {
           $dataFinal['examStatus'] = "Finish_exam";//redirect quiz->timeout
           $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
           $status = array_merge($dataFinal,$status);
           echo json_encode($status);die;
        }
    }



    if((isset($quiz_id) && $quiz_id > 0) || (isset($exam_id) && $exam_id > 0))
    {


            $isHavingAccess=$this->api_model->isHavingAccess($user_id,$group_id,$tenant_id,$quiz_id,$exam_id,$mock);
            if(!$isHavingAccess)
            {
              $dataFinal['examStatus'] = "HavingNoAccess";//registration->user_profile_display
              $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
              $status = array_merge($dataFinal,$status);
              echo json_encode($status);die;
            }
    }
    else
    {
         $dataFinal['examStatus'] = "HavingNoAccess";//registration->user_profile_display
         $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
         $status = array_merge($dataFinal,$status);
         echo json_encode($status);die;
    }

    $total_que=0;

    $data['quiz_detail']=$this->userprofile_model->check_no_of_section($quiz_id,$tenant_id);
    $data['section_detail']=$this->userprofile_model->get_quiz_detail($quiz_id,$tenant_id,$data['quiz_detail']['number_of_sections']);

//print_r($data);die;

    $questionCount=$this->modelbasic->count_all_only('quiz',array('exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'user_id'=>$user_id,'tenant_id'=>$tenant_id,'mock'=>$mock));

    if(!empty($data['section_detail']))
    {
       $section_info = array();
        foreach ($data['section_detail'] as $val)
        {

            $total_que=$total_que+$val['no_of_questions'];//no of que = 10
            $data['section_info']=array('section_name'=>$val['section_name'],'no_of_questions'=>$val['no_of_questions']);
             $catg=explode(',',$val['catg']);
        $section_info[]=array('section_name'=>$val['section_name'],'no_of_questions'=>$val['no_of_questions']);
        }
    }
//print_r($section_info);die;
    if($questionCount != $total_que)
    {
        if(!empty($data['section_detail']))
        {
           $qIdArray=array();
            if($questionCount != 0)
            {
               $conditionArray=array('tenant_id'=>$tenant_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id,'user_id'=>$user_id,'mock'=>$mock);
              $resultQuery=$this->modelbasic->accessDatabase('quiz','question_id,selected_answer','select','',$conditionArray,'','','','','');
              $qIdArray=$resultQuery->result_array();
           }
            foreach ($data['section_detail'] as $val)
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
                           // print_r($select_catg);die;
                            $where_array=array('A.tenant_id'=>$tenant_id,'B.tenant_id'=>$tenant_id,'C.tenant_id'=>$tenant_id,'D.category_id'=>$select_catg);
                            $groupby=array('question_id','RANDOM','question_id');
                            $join_array=array(array('answer_bank as B','A.id=B.question_id'),array('option_master as C','C.id=B.option_id'),array('question_category_relations as D','D.question_id=A.id'));
                                $query=$this->modelbasic->accessDatabase('question_bank as A','A.id as question_id,A.question,A.marks,C.id as correct_answer_opt_id,D.category_id','join_group_order_limit',$groupby,$where_array,$join_array,'','');
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
            $resultQuery=$this->modelbasic->accessDatabase('quiz','question_id,selected_answer,correct_answer_opt_id','select','',$conditionArray,'','','','','');
            $qIdArray=$resultQuery->result_array();
    }
    if(!empty($qIdArray))
    {
      $i=0;
      foreach ($qIdArray as $get_Que_Ans) {

        $question_id=$get_Que_Ans['question_id'];

        $sectionNameData=$this->userprofile_model->getSectionName($quiz_id,$question_id);
        $where_array=array('A.tenant_id'=>$tenant_id,'B.tenant_id'=>$tenant_id,'C.tenant_id'=>$tenant_id,'A.user_id'=>$user_id,'A.exam_id'=>$exam_id,'A.quiz_id'=>$quiz_id,'A.question_id'=>$question_id);
        $groupby='';
        $join_array=array(array('answer_bank as B','A.question_id=B.question_id'),array('option_master as C','C.id=B.option_id'),array('question_bank as D','A.question_id=D.id'));
        $query=$this->modelbasic->accessDatabase('quiz as A','A.question_id,A.selected_answer,A.correct_answer_opt_id,C.option,C.id as option_id,D.question','join_order_limit',$groupby,$where_array, $join_array,'');
        $resultQuestionData=$query->result_array();
        $g=1;
        $QuestionAnswerIdArray=array();
        foreach ($resultQuestionData as $QueAnsId)
        {
          $QuestionAnswerIdArray['questionId']=$QueAnsId['question_id'];
          $QuestionAnswerIdArray['question']=$QueAnsId['question'];
          $QuestionAnswerIdArray['selectedAnswer']=$QueAnsId['selected_answer'];
          $QuestionAnswerIdArray['correctAnswer']=$QueAnsId['correct_answer_opt_id'];
          $QuestionAnswerIdArray['option'.$g]=$QueAnsId['option'];
          $QuestionAnswerIdArray['optionId'.$g]=$QueAnsId['option_id'];
          $g++;
        }
        $newDataArray[$i]=$QuestionAnswerIdArray;
        $i++;
      }
    }

    $exam_duration=$this->userprofile_model->get_exam_time_info($exam_id,$quiz_id);

    /*=================================31-1-2017=============================*/
       //$tz_from = 'Asia/Kolkata';
       $tz_from = $timezone;
       $tz_to = 'UTC';
       $format = 'Y-m-d H:i:s';

       $current = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone($tz_from));
       $current->setTimeZone(new DateTimeZone($tz_to));
       $current_date=$current->format($format);

      // echo $current_date;die;

       $data1=array('user_id'=>$user_id,'tenant_id'=>$tenant_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id,'finish'=>0);

       $res=$this->userprofile_model->check_exam_log($data1,$mock);

       if(empty($res))
       {
           $data2=array('user_id'=>$user_id,'tenant_id'=>$tenant_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id);
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
                       $quiz_end_time=$now->format('m/d/Y H:i:s');
                       $end_t = new DateTime($now->format('Y-m-d H:i:s'), new DateTimeZone($tz_from));
                       $end_t->setTimeZone(new DateTimeZone($tz_to));
                       $end_time=$end_t->format($format);

                   }else
                   {
                       $quiz_end_time=date('m/d/Y H:i:s' ,strtotime($exam_duration['end_date']));
                       $end_t = new DateTime($exam_duration['end_date'], new DateTimeZone($tz_from));
                       $end_t->setTimeZone(new DateTimeZone($tz_to));
                       $end_time=$end_t->format($format);
                   }
                }

               $data=array('user_id'=>$user_id,'tenant_id'=>$tenant_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id,'start_time'=>$current_date,'end_time'=>$end_time,'status'=>1);
               $insert_quiz_log = $this->userprofile_model->save_log_info($data,$mock);
               $set_time_out=strtotime($quiz_end_time)*1000;
           }

       }
       elseif(strtotime($current_date)>strtotime($res['end_time']) && $res['status']==1)
           {
               echo date('y-m-d H:i:s',strtotime($current_date));
               echo date('y-m-d H:i:s',strtotime($res['end_time']));die;
               $this->userprofile_model->update_user_exam_status($res['id'],$mock,$user_id,$tenant_id,$quiz_id,$exam_id);
               $dataFinal['examStatus'] = "Exam Time has Finish";  //redirect quiz->finish_exam
               $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
               $status = array_merge($dataFinal,$status);
               echo json_encode($status);die;
           }

    $get_quiz_log_data = $this->modelbasic->getSelectedData('quiz_log','start_time,end_time',array('user_id'=>$user_id,'tenant_id'=>$tenant_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id,'status'=>1),'','','','','',$resultMethod='row_array');

$tz_from = 'UTC';
$tz_to = $timezone;
$format = 'Y-m-d h:i a';

 $EST = $get_quiz_log_data['start_time'];
    $EET = $get_quiz_log_data['end_time'];
    $start_dt = new DateTime($EST, new DateTimeZone($tz_from));
    $start_dt->setTimeZone(new DateTimeZone($tz_to));
    $examStartTime=$start_dt->format($format);

    $end_dt = new DateTime($EET, new DateTimeZone($tz_from));
    $end_dt->setTimeZone(new DateTimeZone($tz_to));
    $examEndTime=$end_dt->format($format);


$startDT = new DateTime($exam_duration['start_date'], new DateTimeZone($tz_from));
       $startDT->setTimeZone(new DateTimeZone($tz_to));
       $StartTime=$startDT->format($format);

       $endDT = new DateTime($exam_duration['end_date'], new DateTimeZone($tz_from));
       $endDT->setTimeZone(new DateTimeZone($tz_to));
       $EndTime=$endDT->format($format);


    /*================================31-1-2017==========================================*/

    $dataFinal = array("examId"=>$exam_id,"userId"=>$user_id,"examName"=>$get_quiz_id['exam_name'],"startDate"=>$StartTime,"endDate"=>$EndTime,"numberOfQuestions"=>$total_que,"duration"=>$exam_duration['duration'],"quizId"=>$quiz_id,"mock"=>$mock,"examStartTime"=>$examStartTime,"examEndTime"=>$examEndTime,"questionList"=>$newDataArray,"sectionInfo"=>$section_info,"showResult"=>$get_quiz_id['show_results']);
    if(!empty($newDataArray))
        {
          $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
          $status = array_merge($dataFinal,$status);
        }
        else
        {
          $status = array( "statusCode" => 404, "errorMessage" => "Data not found", "statusMessage" => "Error" );
        }
        echo json_encode($status, JSON_HEX_QUOT | JSON_HEX_TAG);
    // echo json_encode($status);
  }

  public function submitExam_post()
   {

     if($this->post('examId')=='')
     {
       $error = array( "statusCode" => 404, "errorMessage" => "Exam Id field is required", "statusMessage" => "Error");
       echo json_encode($error);die;
     }
     if($this->post('userId')=='')
     {
       $error = array( "statusCode" => 404, "errorMessage" => "User Id field is required", "statusMessage" => "Error");
       echo json_encode($error);die;
     }
     if($this->post('tenantId')=='')
     {
       $error = array( "statusCode" => 404, "errorMessage" => "Tenant Id field is required", "statusMessage" => "Error");
       echo json_encode($error);die;
     }

 $exam_id=$this->post('examId');
     $tenant_id=$this->post('tenantId');
     $user_id=$this->post('userId');
     $questionList = $this->post('questionList');

      $get_quiz_id = $this->modelbasic->getSelectedData('exam_master','exam_name,quiz_id',array('id'=>$exam_id),'','','','','',$resultMethod='row_array');
     $quiz_id = $get_quiz_id['quiz_id'];



     if($this->post('mock')=='')
     {
       $mock = 0; //$mock = 0
     }
     else
     {
       $mock = $this->post('mock'); //$mock = 1
     }

//print_r($questionList);die;
     if(isset($questionList) && !empty($questionList))
     {
        foreach ($questionList as $Quelist)
        {

            $questionId = $Quelist['questionId'];
            $answerId = $Quelist['selectedAnswerId'];
            $condition=array('tenant_id'=>$tenant_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id,'user_id'=>$user_id,'question_id'=>$questionId,'mock'=>$mock);


            $data=array('selected_answer'=>$answerId,'end_time'=>date('Y-m-d H:i:s'));
            $this->modelbasic->_update_custom('quiz',$condition, $data);
        }
     }

     if($quiz_id!='' && $exam_id!='')
     {
        $res['exam_master_info']=$this->userprofile_model->check_exam_master_info($exam_id,$quiz_id,$tenant_id);
        $data=array('user_id'=>$user_id,'tenant_id'=>$tenant_id,'exam_id'=>$exam_id,'quiz_id'=>$quiz_id,'mock'=>$mock);

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

         $condition_array=array('user_id'=>$user_id,'tenant_id'=>$tenant_id,'exam_id'=>$exam_id,'quiz_id'=>$quiz_id);

         $insert_array=array('no_of_question'=> $res['no_of_que']['cnt'],'attempt_question'=> $res['attempt_que']['cnt'],'correct_answer'=>$res['correct_ans']['cnt'],'total_marks'=>$res['got_marks']['cnt'],'percentage'=>$percentage,'out_of_marks'=>$res['total_marks']['cnt']);

         $this->userprofile_model->update_exam_summary_in_quiz_log($condition_array,$insert_array,$mock);

         $isFinishedAlready=$this->modelbasic->getValue('quiz_log','finish',array('tenant_id'=>$tenant_id,'user_id'=>$user_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id));

           if($isFinishedAlready != 1)
             {
                $setFinish=$this->modelbasic->_update_custom('quiz_log',array('tenant_id'=>$tenant_id,'user_id'=>$user_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id), array('finish'=>1,'status'=>0));
                if($setFinish>0)
                {
                 $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
                  echo json_encode($status); die;
                }
             }
          else
            {
                $dataFinal['examStatus'] = "Your Exam is already submitted for Review.";//redirect registration->user_profile_display
                $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
                $status = array_merge($dataFinal,$status);
                echo json_encode($status);die;
            }

      }

   }

  public function showResult_post()
   {
      if($this->post('examId')=='')
      {
        $error = array( "statusCode" => 404, "errorMessage" => "Exam Id field is required", "statusMessage" => "Error");
        echo json_encode($error);die;
      }
      if($this->post('userId')=='')
      {
        $error = array( "statusCode" => 404, "errorMessage" => "User Id field is required", "statusMessage" => "Error");
        echo json_encode($error);die;
      }
      if($this->post('tenantId')=='')
      {
        $error = array( "statusCode" => 404, "errorMessage" => "Tenant Id field is required", "statusMessage" => "Error");
        echo json_encode($error);die;
      }

      $exam_id=$this->post('examId');
      $tenant_id=$this->post('tenantId');
      $user_id=$this->post('userId');
      $get_quiz_id = $this->modelbasic->getSelectedData('exam_master','exam_name,quiz_id',array('id'=>$exam_id),'','','','','',$resultMethod='row_array');
      $quiz_id = $get_quiz_id['quiz_id'];
      $get_quiz_result_data = $this->modelbasic->getSelectedData('quiz_log','*',array('user_id'=>$user_id,'tenant_id'=>$tenant_id,'quiz_id'=>$quiz_id,'exam_id'=>$exam_id),'','','','','',$resultMethod='row_array');
      if(!empty($get_quiz_result_data))
       {

         $wrongQuestion = ($get_quiz_result_data['attempt_question']-$get_quiz_result_data['correct_answer']);

        $dataFinal = array("examId"=>$get_quiz_result_data['exam_id'],"userId"=>$get_quiz_result_data['user_id'],"quizId"=>$get_quiz_result_data['quiz_id'],"numberOfQuestions"=>$get_quiz_result_data['no_of_question'],"totalAttemptedQuestions"=>$get_quiz_result_data['attempt_question'],"totalCorrectAnswer"=>$get_quiz_result_data['correct_answer'],"outOfMarks"=>$get_quiz_result_data['out_of_marks'],"totalMarks"=>$get_quiz_result_data['total_marks'],"percentage"=>$get_quiz_result_data['percentage'],"totalWrongAnswer"=>$wrongQuestion);

         $status = array("statusCode" => 200, "errorMessage" => "", "statusMessage" => "Done" );
         $status = array_merge($dataFinal,$status);
       }
       else
       {
         $status = array( "statusCode" => 404, "errorMessage" => "Data not found", "statusMessage" => "Error" );
       }
     echo json_encode($status);
   }

}
