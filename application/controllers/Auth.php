<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
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

	public function login()
	{
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_email_check');

        if ($this->form_validation->run())
        {
            $tenant_id = $this->session->userdata('tenant_id');
            $tenantInfo=$this->modelbasic->getSelectedData('tenant','*',array('id'=>$this->input->post('tenant')),'','','','','','row');
            $domain = substr($this->input->post('email'), strpos($this->input->post('email'), '@') + 1);
            if($tenantInfo->bind_email =='1')
            {
              // if(!empty($id))
              if($domain == $tenantInfo->email_postfix)
              {
                $condition=array('email_id'=>$this->input->post('email'),'status'=>1,'password'=>md5($this->input->post('password')));
                $id=$this->modelbasic->getValue('users','id',$condition);
                  $reset_pass_link=$this->modelbasic->getValue('users','reset_password',array('id'=>$id));

                 // print_r($reset_pass_link);die;

                  if($reset_pass_link=='1')
                  {
                      if($id !='' && $id > 0)
                      {
                          $userInfo=$this->modelbasic->getSelectedData('users','*',array('id'=>$id),'','','','','','row');
                          $data=array('user_id'=>$userInfo->id,'tenant_id'=>$userInfo->tenant_id,'group_id'=>$userInfo->group_id);
                          $this->session->set_userdata($data);

                          $res=$this->registration_model->chck_is_password_reset($userInfo->id);
                          if((int)$res['reset_password']==0)
                          {
                              $json_data= array('id' =>$id,'as_set'=>1);
                              $data['ajax']=json_encode($json_data);
                              $this->load->view('ajax_view',$data);
                             // echo 1;die;
                          }
                          else
                          {
                              $json_data= array('id' =>$id,'as_set'=>0);
                              $data['ajax']=json_encode($json_data);
                              $this->load->view('ajax_view',$data);
                              //echo 0;die;
                          }
                      }
                      else
                      {
                          $json_data= array('id' =>$id,'as_set'=>2);
                          $data['ajax']=json_encode($json_data);
                          $this->load->view('ajax_view',$data);
                         //echo 2;die;
                      }

                  }
                  else if($reset_pass_link == 0)
                  {
                      if($id !='' && $id > 0)
                      {
                          $userInfo=$this->modelbasic->getSelectedData('users','*',array('id'=>$id),'','','','','','row');

                          $res=$this->registration_model->chck_is_password_reset($userInfo->id);
                          if((int)$res['reset_password']==0)
                          {
                              $json_data= array('id' =>$id,'as_set'=>1);
                              $data['ajax']=json_encode($json_data);
                              $this->load->view('ajax_view',$data);
                             // echo 1;die;
                          }
                          else
                          {
                              $json_data= array('id' =>$id,'as_set'=>0);
                              $data['ajax']=json_encode($json_data);
                              $this->load->view('ajax_view',$data);
                              //echo 0;die;
                          }
                      }
                      else
                      {
                          $json_data= array('id' =>$id,'as_set'=>2);
                          $data['ajax']=json_encode($json_data);
                          $this->load->view('ajax_view',$data);
                         //echo 2;die;
                      }

                  }
                  else
                  {
                     /* $json_data= array('id' =>$id,'as_set'=>2);
                      $data['ajax']=json_encode($json_data);
                      $this->load->view('ajax_view',$data);*/
                      $json_data= array("status"=>"error","errorfields"=>[["email"=>"Please Enter Correct Organization Url."]]);
                      $data['ajax']=json_encode($json_data);
                      $this->load->view('ajax_view',$data);
                  }
              }
              else
              {
                  $json_data= array("status"=>"error","errorfields"=>[["email"=>"Please Enter Correct Organization Url for Login User."]]);
                  $data['ajax']=json_encode($json_data);
                  $this->load->view('ajax_view',$data);
              }
            }
            else{

              $condition=array('email_id'=>$this->input->post('email'),'status'=>1,'password'=>md5($this->input->post('password')),'tenant_id'=>$tenant_id);
              $id=$this->modelbasic->getValue('users','id',$condition);
              
              $reset_pass_link=$this->modelbasic->getValue('users','reset_password',array('id'=>$id));

              if($reset_pass_link=='1')
              {
                  if($id !='' && $id > 0)
                  {
                      $userInfo=$this->modelbasic->getSelectedData('users','*',array('id'=>$id),'','','','','','row');
                      $data=array('user_id'=>$userInfo->id,'tenant_id'=>$userInfo->tenant_id,'group_id'=>$userInfo->group_id);
                      $this->session->set_userdata($data);

                      $res=$this->registration_model->chck_is_password_reset($userInfo->id);
                      if((int)$res['reset_password']==0)
                      {
                          $json_data= array('id' =>$id,'as_set'=>1);
                          $data['ajax']=json_encode($json_data);
                          $this->load->view('ajax_view',$data);
                         // echo 1;die;
                      }
                      else
                      {
                          $json_data= array('id' =>$id,'as_set'=>0);
                          $data['ajax']=json_encode($json_data);
                          $this->load->view('ajax_view',$data);
                          //echo 0;die;
                      }
                  }
                  else
                  {
                      $json_data= array('id' =>$id,'as_set'=>2);
                      $data['ajax']=json_encode($json_data);
                      $this->load->view('ajax_view',$data);
                     //echo 2;die;
                  }

              }
              else if($reset_pass_link == 0)
              {
                  if($id !='' && $id > 0)
                  {
                      $userInfo=$this->modelbasic->getSelectedData('users','*',array('id'=>$id),'','','','','','row');

                      $res=$this->registration_model->chck_is_password_reset($userInfo->id);
                      if((int)$res['reset_password']==0)
                      {
                          $json_data= array('id' =>$id,'as_set'=>1);
                          $data['ajax']=json_encode($json_data);
                          $this->load->view('ajax_view',$data);
                         // echo 1;die;
                      }
                      else
                      {
                          $json_data= array('id' =>$id,'as_set'=>0);
                          $data['ajax']=json_encode($json_data);
                          $this->load->view('ajax_view',$data);
                          //echo 0;die;
                      }
                  }
                  else
                  {
                      $json_data= array('id' =>$id,'as_set'=>2);
                      $data['ajax']=json_encode($json_data);
                      $this->load->view('ajax_view',$data);
                     //echo 2;die;
                  }

              }
              else
              {
                 /* $json_data= array('id' =>$id,'as_set'=>2);
                  $data['ajax']=json_encode($json_data);
                  $this->load->view('ajax_view',$data);*/
                  $json_data= array("status"=>"error","errorfields"=>[["email"=>"Please Enter Correct Organization Url."]]);
                  $data['ajax']=json_encode($json_data);
                  $this->load->view('ajax_view',$data);
              }

            }

           /* }
            else
            {
               $json_data= array("status"=>"error","errorfields"=>[["email"=>"Please Enter Correct Tenant Url."]]);
               $data['ajax']=json_encode($json_data);
               $this->load->view('ajax_view',$data);
            } */
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

    public function email_check($email)
	{
        $condition=array('email_id'=>$email);
        $ch=$this->modelbasic->getValue('users','id',$condition);
        if($ch == '')
        {
            $this->form_validation->set_message('email_check', "Email is incorrect");
            return FALSE;
        }
        else
        {
            return TRUE;
        }
	}

     public function forgot_password()
     {
         //$this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
         $emailchck=$this->registration_model->is_email_present($_POST['email_id']);

        // print_r($emailchck);die;

         $tenantInfo=$this->modelbasic->getSelectedData('tenant','*',array('id'=>$emailchck['tenant_id']),'','','','','','row_array');
        // print_r($tenantInfo);die;

         $password_link=md5($emailchck['id'].$_POST['email_id']);
         if(!empty($emailchck) && $emailchck['id']!='')
         {
             $res=$this->registration_model->save_forgot_password_link($emailchck['id'],$password_link);
             if($res==1)
             {

                $emaildata=$this->registration_model->getValEmailTemp('manage_email_template','*',array('id'=>2,'tenant_id'=>$tenantInfo['id']));
                $msg=$emaildata['email_contains'];
                $msg=str_replace('{logo_link}','<img src="'.front_base_url().'uploads/'.$tenantInfo['id'].'/logo/thumbs/'.$tenantInfo['logo'].'" alt="logo" />', $msg);
                $msg=str_replace('{user_name}',$emailchck['name'], $msg);
                $msg=str_replace('{regards}',$tenantInfo['name'], $msg);
                $msg=str_replace('{password_link}',base_url().'auth/verify_pwd_link/'.$password_link, $msg);

                  $data = array('fromEmail' =>'admin@trainocateassessments.com', 'to'=>$_POST['email_id'],'fromName'=>$tenantInfo['name'],'subject'=>$emaildata['subject'],'template'=>$msg);
                  $res=$this->modelbasic->sendMail($data);
                    echo 1;die;
             }
             echo 2;die;

         }else
         {
             echo 3;die;
         }
     }
    public function verify_pwd_link($uid)
     {

         $res=$this->registration_model->verifypwdlink($uid);

        $data['tenant_info']=$this->modelbasic->getSelectedData('tenant','*',array('id'=>$res['tenant_id']),'','','','','','row_array');
        $data['tenant_info']['user_id']=$res['id'];

		/* print_r($tenantInfo);
         print_r($res);
         print_r($uid);die;*/

         //print_r($_POST);die;

         if(!empty($res)&& $res['forgot_password_link']!='')
         {
            // $this->session->set_userdata('changepwd_id',$res['id']);
             if($this->session->userdata('user_id')=='')
             {
               //$this->session->set_userdata('user_id',$res['id']);
               //$this->session->set_userdata('group_id',$res['group_id']);
               $this->session->set_userdata('tenant_id',$res['tenant_id']);
             }

             //$res1=$this->registration_model->deletePwdLink($uid);

            // print_r($data);die;

             $this->load->view('reset_password_view',$data);
         }
         else
         {
             echo "problem in verification code";
         }
     }


    function sso_login_url()
    {
        if(!empty($_POST))
        {
            $email=$_POST['user']['email'];
            $firstname=$_POST['user']['firstname'];
            $lastname=$_POST['user']['lastname'];
             $userInfo=$this->modelbasic->getSelectedData('users','id,tenant_id',array('email_id'=>$email,'tenant_id'=>20),'','','','','','row');
            if(!empty($userInfo))
            {
                $token=$userInfo->tenant_id.'&'.$userInfo->id;
                $resp=array('loginurl'=>base_url().'auth/sso_login?token='.base64_encode($token));
                echo json_encode($resp);
            }
            else
            {
                $userData=array('name'=>$firstname.' '.$lastname,'email_id'=>$email,'tenant_id'=>20,'created'=>date('Y-m-d H:i:s'));
                $userID=$this->modelbasic->_insert('users',$userData);
                $userInfo=$this->modelbasic->getSelectedData('users','id,tenant_id',array('id'=>$userID,'tenant_id'=>20),'','','','','','row');
                if(!empty($userInfo))
                {
                    $token=$userInfo->tenant_id.'&'.$userInfo->id;
                    $resp=array('loginurl'=>base_url().'auth/sso_login?token='.base64_encode($token));
                    echo json_encode($resp);
                }
            }
        }
    }

    function sso_login()
    {
        if(!empty($_GET) && isset($_GET['token']) && $_GET['token'] != '')
        {
            $token=$_GET['token'];
            $tokenData=base64_decode($token);
            $tokenArray=explode('&',$tokenData);
            if(!empty($tokenArray))
            {
                if(isset($tokenArray[0]))
                {
                    $tenant_id=$tokenArray[0];
                }

                if(isset($tokenArray[1]))
                {
                    $user_id=$tokenArray[1];
                }

                $userInfo=$this->modelbasic->getSelectedData('users','*',array('id'=>$user_id,'tenant_id'=>20),'','','','','','row');
                if(!empty($userInfo))
                {
                    $data=array('user_id'=>$userInfo->id,'tenant_id'=>$userInfo->tenant_id,'group_id'=>$userInfo->group_id,'sso'=>1);
                    $this->session->set_userdata($data);
                    redirect('registration/user_profile_display');
                }
                else
                {
                    $resp=array('exception'=>'invalid_token_exception','errorcode'=>'invalidtoken','message'=>'Invalid token value detected');
                    echo json_encode($resp);
                }

            }
            else
            {
                $resp=array('exception'=>'invalid_token_exception','errorcode'=>'invalidtoken','message'=>'Invalid token value detected');
                echo json_encode($resp);
            }
        }
        else
        {
            $resp=array('exception'=>'invalid_parameter_exception','errorcode'=>'invalidparameter','message'=>'Invalid parameter value detected');
            echo json_encode($resp);
        }
    }
}
