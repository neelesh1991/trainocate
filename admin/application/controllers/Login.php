<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Login extends CI_Controller
{
	function __construct()
	{
	    	parent::__construct();
	    	$this->load->library('form_validation');
	    	$this->load->helper('string');
	    	$this->load->model('test_model');

	}

	public function index()

	{

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');

		if ($this->form_validation->run())

		{

		//	$time_zone=$timezone[15]['description'];

			//$currency=$timezone[16]['description'];

			//echo $time_zone;die;

			$condition=array('email'=>$this->input->post('email'),'status'=>1,'password'=>md5($this->input->post('password')));

			//$id=$this->modelbasic->getValue('admin','id',$condition);

			$selectedid=$this->test_model->loginAdmin($condition);

			$id = $selectedid['id'];

			if($id !='' && $id > 0)

			{

				if($this->input->post('remember')=="on")

				{

					$this->load->helper('cookie');

					$cookie = array(

									    'name'   => 'admin_id',

									    'value'  =>$id

									);

					$this->input->set_cookie($cookie);

				}

				$userInfo=$this->modelbasic->getSelectedData('admin','*',array('id'=>$id),'','','','','','row');

				$timezone=$this->test_model->get_tenant_timezone($userInfo->tenant_id);
				
				if($timezone['timezone'] == '')
				{
					$timezone="Asia/Kolkata";
				}
				$data1=array('admin_id'=>$userInfo->id,'tenant_id'=>$userInfo->tenant_id,'admin_email'=>$userInfo->email,'admin_name'=>$userInfo->name,'admin_level'=>$userInfo->level,'picture'=>$userInfo->picture,'time_zone'=>$timezone['timezone']);

				//$this->session->unset_userdata($data1);

				$this->session->set_userdata($data1);

				$data=array('status'=>'success','message'=>'Welcome to Dashboard');

				$data['ajax']=json_encode($data);

				//pr($data);

				$this->load->view('ajax_view',$data);

			}

			else

			{

				$data=array('status'=>'fail','message'=>'Invalid email address or password');

				$data['ajax']=json_encode($data);

				$this->load->view('ajax_view',$data);

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

				$data['settings']=$this->test_model->get_all_settings();

				$data['page_name']='login_view';

				$this->load->view('index',$data);

			}

		}

	}

	public function forgot_password()

	{

 		$this->form_validation->set_rules('emailId','Email','trim|required|valid_email|callback_email_check');

 		if($this->form_validation->run())

 		{

 			$email=$_POST['emailId'];

 			$condition=array('email'=>$email);

 			$adminId=$this->modelbasic->getValues('admin','id,tenant_id',$condition,'row_array');
 			//print_r($adminId);
 			$tenantInfo=$this->modelbasic->getValues('tenant','*',array('id'=>$adminId['tenant_id']),'row_array');
 		//	print_r($tenantInfo);die;
 			$rand=random_string('unique', 16);

 			$data=array('pass_key'=>$rand);

 			$res=$this->modelbasic->_update('admin',$adminId['id'],$data);

 		

 			if($res >0 )

 			{

 				$adminInfo=$this->modelbasic->getSelectedData('admin','name,email', array('id'=>$adminId['id']),'','','','','','row_array');

 				$emaildata=$this->test_model->getValEmailTemp('manage_email_template','*',array('id'=>2,'tenant_id'=>$tenantInfo['id']));
 				//print_r($emaildata);die;
 				$msg=$emaildata['email_contains'];
 				$msg=str_replace('{logo_link}','<img src="'.front_base_url().'uploads/'.$tenantInfo['id'].'/logo/thumbs/'.$tenantInfo['logo'].'" alt="logo" />', $msg);
 				$msg=str_replace('{user_name}',$adminInfo['name'], $msg);
 				$msg=str_replace('{regards}',$tenantInfo['name'], $msg);
 				$msg=str_replace('{password_link}',base_url().'login/set_password/'.$rand, $msg); 				
 				$emailData=array('to'=>$adminInfo['email'],'fromEmail'=>'quizadmin@emmersivedemos.in','subject'=>$emaildata['subject'],'template'=>$msg);
 				
 				$emailData['result']=$this->test_model->get_all_settings();

 				$this->modelbasic->sendMail($emailData);

 				$this->session->set_flashdata('success', 'Reset password link is sent to your email id, please check email.');

 				redirect('login');

 			}

 			else

 			{

 				$this->session->set_flashdata('error', 'Failed to reset password.');

 				redirect('login');

 			}

 		}

 		$data['settings']=$this->test_model->get_all_settings();

 		$this->load->view('forgot_password_view',$data);

	}

	public function email_check($email)

 	{

 		$condition=array('email'=>$email);

 		$ch=$this->modelbasic->getValue('admin','id',$condition);

 		if($ch == '')

 		{

 			$this->form_validation->set_message('email_check', 'Account with this email doesn’t exists, contact admin.');

			return FALSE;

		}

 		else

 		{

 			return TRUE;

 		}

 	}

	public function set_password($pass_key)

	{

		$this->form_validation->set_rules('password','Password','required|trim|min_length[6]');

		$this->form_validation->set_rules('conf_password','Confirm Password','trim|required|matches[password]');

		if($this->form_validation->run())

		{

			$data=array('password'=>md5($_POST['password']),'pass_key'=>'');

			$res=$this->modelbasic->_update_custom('admin','pass_key',$pass_key, $data);

			if($res >0)

			{

				$this->session->set_flashdata('success','Password updated successfully');

				redirect('login');

			}

			else

			{

				$this->session->set_flashdata('error','Password not set.');

				redirect('login');

			}

		 }

		else

		{

			$this->load->view('set_password_view');

		}

	}



	function ajax_login()

	{

		$response = array();

		$email 		= $_POST["email"];

		$password 	= $_POST["password"];

		$response['submitted_data'] = $_POST;

		//Validating login

		$login_status = $this->validate_login( $email ,  $password );

		$response['login_status'] = $login_status;

		if ($login_status == 'success')

		{
		
			$response['redirect_url'] = 'dashboard';

		}

		//Replying ajax request with validation response

		$data['ajax']=json_encode($response);

		$this->load->view('ajax_view',$data);

	}

    	//Validating login from ajax request

    	function validate_login($email	=	'' , $password	 =  '')

    	{

		 $credential	=	array(	'email' => $email , 'password' => $password );

		 $query = $this->db->get_where('admin' , $credential);

     		if ($query->num_rows() > 0)

		 {

         	$row = $query->row();

			$this->session->set_userdata('admin_login', '1');

			$this->session->set_userdata('admin_level', $row->level);

			$this->session->set_userdata('tenant_id', $row->tenant_id);

			$this->session->set_userdata('admin_id', $row->id);

			$this->session->set_userdata('name', $row->name);

			$this->session->set_userdata('login_type', 'admin');

			$this->session->set_userdata('timezone',$timezone[15]['description']);

			return 'success';

		}

		return 'invalid';

    }

	/***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/

	function reset_password()

	{

		$account_type = $this->input->post('account_type');

		if ($account_type == "")

		{

			redirect(base_url(), 'refresh');

		}

		$email  = $this->input->post('email');

		$result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL

		if ($result == true)

		{

			$this->session->set_flashdata('flash_message', get_phrase('password_sent'));

		}

		else if ($result == false)

		{

			$this->session->set_flashdata('flash_message', get_phrase('account_not_found'));

		}

		redirect(base_url(), 'refresh');

	}

    /*******LOGOUT FUNCTION *******/

}