<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelbasic');
		$this->load->model('registration_model');
		$this->load->library('form_validation');
		$this->load->model('userprofile_model');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->helper('imgupload');
	}
	public function index()
	{
      	
		if($this->session->userdata('tenant_id')!='')
		{
			$tenant_id=$this->session->userdata('tenant_id');
		}
		else
		{
			$tenant_id=1;
			$this->session->set_userdata('tenant_id',$tenant_id);
		}
		if($this->uri->segment(1)!='')
		{
			$tenant_id=$this->modelbasic->getValue('tenant','id',array('url'=>$this->uri->segment(1)));
			$this->session->set_userdata('tenant_id',$tenant_id);
		}

		$tenant_time_zone=$this->userprofile_model->get_tenant_time_zone($tenant_id);
		if(!empty($tenant_time_zone))
		{
			$this->session->set_userdata('tenant_timezone',$tenant_time_zone['timezone']);
		}

		$data['tenant_info']=$this->userprofile_model->get_tenant_info($tenant_id);
		$data['widget_info']=$this->userprofile_model->get_widget_info($tenant_id);
		$data['slider_info']=$this->userprofile_model->get_slider_info($tenant_id);
		if($this->session->userdata('tenant_id')!='' && $this->session->userdata('user_id')!='')
		{
			$user_time_zone=$this->userprofile_model->get_user_time_zone($tenant_id,$this->session->userdata('user_id'));
			if(!empty($user_time_zone))
			{
				$this->session->set_userdata('user_timezone',$user_time_zone['timezone']);
			}
			$data['userinfo']=$this->userprofile_model->get_user_profile_info($this->session->userdata('user_id'),$tenant_id);
			if(empty($data['userinfo']))
			{
				$this->session->unset_userdata('user_id');
			}
			$data['upcoming_quiz']=$this->userprofile_model->check_upcoming_quiz_for_user($this->session->userdata('user_id'),$this->session->userdata('tenant_id'),$data['userinfo']['group_id']);

			$data['inprogress_quiz']=$this->userprofile_model->check_users_inprogress_quiz($this->session->userdata('user_id'),$tenant_id);

		}
			//	print_r($data['upcoming_quiz']);die;
		$data['timezone1']=$this->userprofile_model->fetch_timezone_data();
		$this->load->view('home_view',$data);
	}
	public function about()
	{
		$this->load->view('about_us_view');
	}
	public function contact()
	{
		$this->load->view('contact_us_view');
	}
	public function save_contact_msg()
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

	$format = 'Y-m-d H:i:s';

	$current = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone($timezone));
	$current->setTimeZone(new DateTimeZone('UTC'));
	$current_date=$current->format($format);

	$tenant_id=1;
	if($this->session->userdata('tenant_id')!='')
	{
		$tenant_id=$this->session->userdata('tenant_id');
	}
	$data=array('tenant_id'=>$tenant_id,'name'=>$this->input->post('name',true),'email'=>$this->input->post('email',true),'message'=>$this->input->post('message',true),'status'=>0,'created'=>$current_date);
	$res=$this->modelbasic->_insert('contact_us',$data);
	if($res>0)
	{

$getDetails=$this->modelbasic->getLeaveMessageDetails($res);
      
      
     

		// Sending email to admin
								$msg= "<p> Hi,</p>
                      <p> <b>Name</b>: ".$getDetails[0]['name']."</p>
                      <p> <b>Email </b>: ".$getDetails[0]['email']."</p>
                      <p> <b>Message </b>: ".$getDetails[0]['message']."</p>" ;

 
                 $finish['fromEmail']='admin@trainocateassessments.com';
                 $finish['fromName']='Trainocate Assessments';
                 $finish['to']="india@trainocate.com,vivek.bhide@emmersivetech.com";
                 $finish['subject']="Need Information about our Trainings? from ".$getDetails[0]['name'];
                 $finish['template'] = $msg;
                 $result=$this->modelbasic->sendMail($finish);
		echo 1;die;
	}
}
	public function logout()
	{
		$this->session->unset_userdata('user_id');;
		$url=$this->modelbasic->getValue('tenant','url',array('id'=>$this->session->userdata('tenant_id')));
		$this->session->unset_userdata('tenant_id');
		if($this->session->userdata('sso') == 1)
		{
			redirect('http://www.galilia.com/hauth/logout');
		}
		else
		{
			redirect($url);
		}
	}
}



