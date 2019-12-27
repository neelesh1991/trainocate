<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	function __construct()

	{

        parent::__construct();

        $this->load->model('modelbasic');

        $this->load->model('registration_model');

        $this->load->model('userprofile_model');

        $this->load->library('form_validation');

        $this->load->library('upload');

        $this->load->library('image_lib');

        $this->load->helper('imgupload');

	 }

         public function reset_pwd_view($id='')
         {
          if($this->session->userdata('tenant_id')!='')
          {
            $tenant_id=$this->session->userdata('tenant_id');
          }
          else
          {
              $tenant_id=1;
          }
          $data['tenant_info']=$this->userprofile_model->get_tenant_info($tenant_id);
          if($id!='')
          {
            $data['tenant_info']['user_id']=$id;
          }
          else if($this->session->userdata('user_id')!='')
          {
            $data['tenant_info']['user_id']=$this->session->userdata('user_id');
          }
          if($data['tenant_info']['user_id']!='' && $data['tenant_info']['logo']!='' && $data['tenant_info']['id']!='')
          {
            $this->load->view('reset_password_view',$data);
          }
          else
          {
            redirect('home');
          }

         }

         public function changed_password_save()

         {

              // print_r($_POST);die;
              //echo "changed_password_save";die;

              if($this->session->userdata('user_id')=='')
                 {
                     $id=$this->session->userdata('changepwd_id');
                 }
                 else
                 {
                     $id=$this->session->userdata('user_id');
                 }
                 if(isset($_POST['user_id']) && $_POST['user_id']!='')
                 {

                    $id=$_POST['user_id'];
                 }

                 $res=$this->registration_model->changed_password_save(md5($this->input->post('password',true)),$id);

                 $userInfo=$this->modelbasic->getSelectedData('users','*',array('id'=>$id),'','','','','','row');
                  $session_data=array('user_id'=>$userInfo->id,'tenant_id'=>$userInfo->tenant_id,'group_id'=>$userInfo->group_id);
                 $this->session->set_userdata($session_data);


                 if($res!=0)

                 {
                    if($this->session->userdata('user_id')=='')
                    {
                         echo 1;die;
                     }
                     else
                     {
                         echo 2;die;
                     }
                 }
         }

         public function profile_detail_save()

         {

            $id=$this->session->userdata('user_id');
            $data=array(
                'contact_no'=>$this->input->post('contact_no',true),
                'name'=>$this->input->post('name',true),
                'address'=>$this->input->post('address',true),
                'age'=>$this->input->post('age',true),
                'principal_name'=>$this->input->post('princy_name',true),
                'institute_name'=>$this->input->post('inst_name',true),
                'organization'=>$this->input->post('organization',true),
                'city'=>$this->input->post('city',true),
                'academic_year'=>$this->input->post('academic_year',true),
                'timezone'=>'Asia/Calcutta'
              );
             //print_r($data);die;

            $res=$this->userprofile_model->profile_detail_save($id,$data);

                 echo 1;die;
 }

        public function user_profile_upload()

        {



            $id=$this->session->userdata('user_id');

            $tenant_id=$this->session->userdata('tenant_id');

            $userpath="uploads/".$tenant_id."/users_photo";

            $path ="uploads/".$tenant_id."/users_photo/".$id;



            $thumbspath="uploads/".$tenant_id."/users_photo/".$id."/thumbs";

              if(!(file_exists($path)))

              {

                mkdir($path,0777);

              }

              if(!(file_exists($userpath)))

              {

                  mkdir($userpath,0777);

              }

              if(!(file_exists($thumbspath)))

              {

                mkdir($thumbspath,0777);

              }



            $result = uploadimg($_FILES,170,188,$id,$tenant_id);

            if($result!='')

            {

               $data=array('photo'=>$result);

               $res=$this->userprofile_model->profile_detail_save($id,$data);

               if($res>0)

               {

                   echo 1;

               }

               else

               {

                   echo 2;

               }

            }

            else

            {

                echo 3;

            }



        }

         public function verify_key()
         {
              $id=$this->session->userdata('user_id');
              $tenant_id=$this->session->userdata('tenant_id');
              $key=$_POST['key'];

              $res=$this->userprofile_model->verify_key($id,$tenant_id,$_POST['exam_id'],$key);

              if(!empty($res))

              {

                echo 1;die;
              }else

              {

                echo 2;die;

              }

         }

         public function user_profile_display()
         {
          $this->session->unset_userdata('user_timezone');

            $id=$this->session->userdata('user_id');



           $quiz_id=$this->session->userdata('quiz_id');

            $exam_id=$this->session->userdata('exam_id');

            $group_id=$this->session->userdata('group_id');
            $tenant_id=$this->session->userdata('tenant_id');
            if($tenant_id=='')
            {
              $tenant_id=1;
            }
           $this->userprofile_model->chck_is_quizlog_time_expired($id,$tenant_id);

            $data['userinfo']=$this->userprofile_model->get_user_profile_info($id,$tenant_id);

            /**
             * [$userLevelID description]
             * @var [type]
             */
             $userLevelID = $data['userinfo']['user_level_id'];


            $data['tenant_info']=$this->userprofile_model->get_tenant_info($tenant_id);

            $data['all_quiz_info']=$this->userprofile_model->get_allquiz_info($tenant_id);

            $data['upcoming_quiz']=$this->userprofile_model->check_upcoming_quiz_for_user($id,$tenant_id,$group_id, $userLevelID);

            $data['past_quiz']=$this->userprofile_model->check_users_past_quiz($this->session->userdata('user_id'),$tenant_id);

            $data['inprogress_quiz']=$this->userprofile_model->check_users_inprogress_quiz($this->session->userdata('user_id'),$tenant_id);

            $data['timezone1']=$this->userprofile_model->fetch_timezone_data();

            $merged_data = array_merge($data['upcoming_quiz'],$data['past_quiz'],$data['inprogress_quiz']);
            $pids = array();
            foreach ($merged_data as $h) {
                $pids[] = $h['quiz_id'];
            }
            $data['image_logo_info'] = array();
            $data['uniquePids'] = array_unique($pids);

            if($data['userinfo']['timezone']!='')
            {
              $this->session->set_userdata('user_timezone',$data['userinfo']['timezone']);
            }
            // echo "<pre/>@@@"; print_r($data); die;
            $this->load->view('user_profile_view',$data);

         }

         public function email_check($email)
          {
            $tenant_id=$this->session->userdata('tenant_id');
            if($tenant_id == '')
            {
              $tenant_id=1;
            }
             $condition=array('email_id'=>$email,'tenant_id'=>$tenant_id);

             $ch=$this->modelbasic->getValue('users','id',$condition);
            // print_r($ch);die;
             if($ch != '')
             {
                 $this->form_validation->set_message('email_check', "Email ID already Registered");
                 return FALSE;
             }
             else
             {
                 return TRUE;
             }
          }

         public function signup_detail_save()
         {
         //print_r($_POST);die;

          $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
          $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
          $this->form_validation->set_rules('email', 'Email', 'required|callback_email_check');
          $this->form_validation->set_rules('name', 'Name', 'required');

          if ($this->form_validation->run())
          {
                /*  if($this->session->userdata('user_timezone')!='')
                  {
                      $timezone=$this->session->userdata('user_timezone');
                  }else
                  {
                      $timezone=$this->session->userdata('tenant_timezone');
                  } */
                 $tenant_id=$this->session->userdata('tenant_id');
                  if($tenant_id == '')
                  {
                    $tenant_id=1;
                  }
                  $tenantInfo=$this->modelbasic->getSelectedData('tenant','*',array('id'=>$tenant_id),'','','','','','row_array');

                  if(!isset($_POST['group']) || $_POST['group']=='')
                  {
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
                    //print_r($groupId);die;
                  }
                  else
                  {
                    $groupId=$this->input->post('group',TRUE);
                  }


                  if($this->input->post('time_zone',true)=='')
                  {
                   $timezone = $tenantInfo['timezone'];
                  }
                  else
                  {
                    $timezone = $this->input->post('time_zone',true);
                  }

                  $format = 'Y-m-d H:i:s';
                  $current = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone($timezone));
                  $current->setTimeZone(new DateTimeZone('UTC'));
                  $current_date=$current->format($format);

                  /**
                   * [$user_level_id description]
                   * @var [type]
                   */
                  $user_level_id = $this->input->post('user_level',TRUE);

                  if($tenantInfo['bind_email'] == '1')
                  {
	                  if($tenantInfo['email_postfix'] == substr($this->input->post('email',true), strrpos($this->input->post('email',true), '@' )+1))
	                  {

	                    $emailchck=$this->registration_model->is_email_present($this->input->post('email',true));
	                    if(empty($emailchck))
	                    {
	                      //$user_verification_key=md5($this->input->post('email',true));
	                      $data=array(
	                        'group_id'=>$groupId,
	                        'user_level_id'=>$user_level_id,
	                        'tenant_id'=>$tenant_id,
	                        'name'=>$this->input->post('name',true),
	                        'email_id'=>$this->input->post('email',true),
	                        'contact_no'=>$this->input->post('contact_no',true),
	                        'organization'=>$this->input->post('organization',true),
	                        'city'=>$this->input->post('city',true),
	                        'password'=>md5($this->input->post('password',true)),
	                        'academic_year'=>$this->input->post('academic_year',true),
	                        'timezone'=>'Asia/Calcutta',
	                        'is_profile_completed'=>1,
	                        'created'=>$current_date,
	                        'reset_password'=>1
	                      );

	                      $tenantInfo=$this->modelbasic->getSelectedData('tenant','*',array('id'=>$tenant_id),'','','','','','row_array');
	                      $res=$this->userprofile_model->signup_detail_save($data);
	                      //echo
	                      if($res>0)
	                      {

	                        $user_Info=$this->modelbasic->getSelectedData('users','*',array('id'=>$res),'','','','','','row_array');
	                        $data=array('user_id'=>$user_Info['id'],'tenant_id'=>$user_Info['tenant_id'],'group_id'=>$user_Info['group_id']);
	                        $this->session->set_userdata($data);

	                        $msg= "<p> New user registered on Assessment</p>
	                        <p> <b>Name</b>: ".$user_Info['name']."</p>
	                        <p> <b>Email </b>: ".$user_Info['email_id']."</p>
	                        <p> <b>Organization </b>: ".$user_Info['organization']."</p>
	                        <p> <b>City </b>: ".$user_Info['city']."</p>
	                        <p> <b>Contact Number </b>: ".$user_Info['contact_no']."</p>";

	                        $finish['fromEmail']='admin@trainocateassessments.com';
	                        $finish['fromName']='Trainocate Assessments';
	                        $finish['to']="vikas.m@trainocate.in, nilesh.anandrao@emmersivetech.com";
	                        //$finish['to']="nilesh.anandrao@emmersivetech.com";
	                        $finish['subject']="New user registered on Assessment";
	                        $finish['template'] = $msg;
	                        $result=$this->modelbasic->sendMail($finish);

	                        $json_data= array('id' =>$res,'as_set'=>1);
	                        $data['ajax']=json_encode($json_data);
	                        $this->load->view('ajax_view',$data);
	                      }
	                    }
	                    else
	                    {
	                      $json_data= array('as_set'=>2);
	                      $data['ajax']=json_encode($json_data);
	                      $this->load->view('ajax_view',$data);
	                    }
	                  }
	                  else
	                  {
	                    $json_data= array('as_set'=>3);
	                    $data['ajax']=json_encode($json_data);
	                    $this->load->view('ajax_view',$data);
	                  }
	              }
	              else{

	              	$emailchck=$this->registration_model->is_email_present($this->input->post('email',true));
                    if(empty($emailchck))
                    {
                      //$user_verification_key=md5($this->input->post('email',true));
                      $data=array(
                        'group_id'=>$groupId,
                        'user_level_id'=>$user_level_id,
                        'tenant_id'=>$tenant_id,
                        'name'=>$this->input->post('name',true),
                        'email_id'=>$this->input->post('email',true),
                        'contact_no'=>$this->input->post('contact_no',true),
                        'organization'=>$this->input->post('organization',true),
                        'city'=>$this->input->post('city',true),
                        'password'=>md5($this->input->post('password',true)),
                        'academic_year'=>$this->input->post('academic_year',true),
                        'timezone'=>'Asia/Calcutta',
                        'is_profile_completed'=>1,
                        'created'=>$current_date,
                        'reset_password'=>1
                      );

                      $tenantInfo=$this->modelbasic->getSelectedData('tenant','*',array('id'=>$tenant_id),'','','','','','row_array');
                      $res=$this->userprofile_model->signup_detail_save($data);
                      //echo
                      if($res>0)
                      {

                        $user_Info=$this->modelbasic->getSelectedData('users','*',array('id'=>$res),'','','','','','row_array');
                        $data=array('user_id'=>$user_Info['id'],'tenant_id'=>$user_Info['tenant_id'],'group_id'=>$user_Info['group_id']);
                        $this->session->set_userdata($data);

                        $msg= "<p> New user registered on Assessment</p>
                        <p> <b>Name</b>: ".$user_Info['name']."</p>
                        <p> <b>Email </b>: ".$user_Info['email_id']."</p>
                        <p> <b>Organization </b>: ".$user_Info['organization']."</p>
                        <p> <b>City </b>: ".$user_Info['city']."</p>
                        <p> <b>Contact Number </b>: ".$user_Info['contact_no']."</p>";

                        $finish['fromEmail']='admin@trainocateassessments.com';
                        $finish['fromName']='Trainocate Assessments';
                        $finish['to']="vikas.m@trainocate.in, nilesh.anandrao@emmersivetech.com";
                        //$finish['to']="nilesh.anandrao@emmersivetech.com";
                        $finish['subject']="New user registered on Assessment";
                        $finish['template'] = $msg;
                        $result=$this->modelbasic->sendMail($finish);

                        $json_data= array('id' =>$res,'as_set'=>1);
                        $data['ajax']=json_encode($json_data);
                        $this->load->view('ajax_view',$data);
                      }
                    }
                    else
                    {
                      $json_data= array('as_set'=>2);
                      $data['ajax']=json_encode($json_data);
                      $this->load->view('ajax_view',$data);
                    }

	              }
              }
             else
              {
                if($this->input->is_ajax_request())
                   {
                       $data['ajax']=$this->form_validation->get_json();
                       $this->load->view('ajax_view',$data);
                   }
                   else
                   {
                       $this->load->view('login_view');
                   }
              }


         }
         public function verify_user_link($link)
         {
          $res=$this->registration_model->verify_user_link($link);
             if(!empty($res)&& $res['user_verification_key']!='')
             {
                 $res1=$this->registration_model->delete_user_verification_Link($link,$res['id']);
                 redirect('home');
             }
             else
             {
                 echo "problem in verification code";
             }
         }


  public function leave_message_save()

         {

            $id=$this->session->userdata('user_id');
            $data=array(
                'contact_no'=>$this->input->post('contact_no',true),
                'name'=>$this->input->post('name',true),
                'address'=>$this->input->post('address',true),
                'age'=>$this->input->post('age',true),
                'principal_name'=>$this->input->post('princy_name',true),
                'institute_name'=>$this->input->post('inst_name',true),
                'organization'=>$this->input->post('organization',true),
                'city'=>$this->input->post('city',true),
                'academic_year'=>$this->input->post('academic_year',true),
                'timezone'=>'Asia/Calcutta'
              );
             //print_r($data);die;

            $res=$this->userprofile_model->profile_detail_save($id,$data);

                 echo 1;die;
 }



}







