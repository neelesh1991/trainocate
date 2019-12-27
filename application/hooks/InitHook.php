<?php
class InitHook
{
	var $CI,$isLoggedIn;
	function __construct(){
	  $this->CI = NULL;
	}
	function loadCustomCommonFunctions()
	{
		require_once(APPPATH.'third_party/functions.php');
	}

	function initPostController($code="")
	{
		$this->CI =& get_instance();
		$class = $this->CI->router->class;
		$this->CI->load->model('tracker_model');
		$this->CI->tracker_model->add_visit();
		//var_dump($class);
		if($class <> "Maintenance" && $this->isUnderMaintenence())
		{
			if($this->isLoggedIn())
			{
				$USER_SESSION_ID =$this->CI->session->userdata('user_id');
				$this->forceLogout($USER_SESSION_ID);
			}
			redirect(base_url()."Maintenance/");
			return 0;
		}
		else
		{
			if($this->CI->session->has_userdata('last_activity') && $this->CI->session->userdata('last_activity') + 60 < time())
			{
				$this->CI->load->model('modelbasic');
				$timestamp=time();
				$this->CI->modelbasic->_update('user',$this->CI->session->userdata('user_id'),array('last_activity'=>$timestamp));
				$this->CI->session->set_userdata('last_activity',$timestamp);
			}
			$this->authenticateUser();
		}
	}
	function isLoggedIn()
	{
		if($this->CI->session->has_userdata('user_id'))
		{
			//echo $this->CI->session->userdata('last_activity') + 60;die;
			return 1;
		}
		else
		{
			return 0;
		}
	}

	function forceLogout($loggedInUserId=0)
	{
		$this->CI->session->unset_userdata('user_id');
		$this->CI->session->unset_userdata('user_type');
	}
	//===================================================================================
    	function authenticateUser()
	{
		$class = $this->CI->router->class;
	  	$method = $this->CI->router->method;
		// before login controller array ex:- 'login'
	  	//(Note:- If you insert controller name here this rule will be apply to all methods inside it, if you want to add this rule for particular function within class then put controller/function name in beforeLoginControllerMethodArray array)
		$beforeLoginControllerArray = array (
		);

		// allways allow controller array ex:- 'home'
		//(Note:- If you insert controller name here this rule will be apply to all methods inside it, if you want to add this rule for particular function within class then put controller/function name in alwaysAllowControllerMethodArray array)
		$alwaysAllowControllerArray = array (
		                                          'Maintenance','Home','Registration','Auth','Api','Rest_client'
		);
		// check always allow controller
		$returnMatch	=	$this->matchControllerMethod($alwaysAllowControllerArray,$class);
		if(!$returnMatch)
		{
			$returnMatch	=	$this->matchControllerMethod($beforeLoginControllerArray,$class);
			if($returnMatch)
			{
				if($this->isLoggedIn())
				{
					$redirect_url='home';
					redirect(base_url().$redirect_url);
					return 0;
				}
				else
				{
					if(!$this->isLoggedIn() && $class !='auth')
					{
						redirect(base_url()."home");
						return 0;
					}
				}
			}
			else
			{
				if(!$this->isLoggedIn() && $class!='auth')
				{
					redirect(base_url()."home");
					exit;
				}
			}

		}

	}

	function matchControllerMethod($allowControllerMethodArr,$class)
	{
		$returnMatch	=	0;
		foreach($allowControllerMethodArr as $key)
		{
			if(strcasecmp($key, $class) == 0)
			{

				$returnMatch	=	1;
			}
		}

		return $returnMatch;
	}

	function isUnderMaintenence()
	{
		$this->CI->load->model('modelbasic');
		$SITE_OFFLINE = $this->CI->modelbasic->getValue('settings','description',array('type'=>'SITE_OFFLINE'));
		if($SITE_OFFLINE == "YES")
			return 1;
		else
			return 0;
	}
}
?>