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
		//var_dump($class);
/*		if($class <> "Maintenance" && $this->isUnderMaintenence())
		{
			if($this->isLoggedIn())
			{
				$admin_SESSION_ID =$this->CI->session->userdata('tenant_id');
				$this->forceLogout($admin_SESSION_ID);
			}
			redirect(base_url()."Maintenance/");
			return false;
		}*/

		$this->authenticateUser();

	}


	function isLoggedIn()
	{

		if($this->CI->session->has_userdata('tenant_id'))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	function forceLogout($loggedInUserId=0)
	{
		$this->CI->session->unset_userdata('admin_name');
		$this->CI->session->unset_userdata('tenant_id');
		$this->CI->session->unset_userdata('admin_email');
		$this->CI->session->unset_userdata('admin_level');
		$this->CI->session->unset_userdata('picture');
	}
	//===================================================================================
    function authenticateUser()
	{
		$class = $this->CI->router->class;
	  	$method = $this->CI->router->method;
		// before login controller array ex:- 'login'
	  	//(Note:- If you insert controller name here this rule will be apply to all methods inside it, if you want to add this rule for particular function within class then put controller/function name in beforeLoginControllerMethodArray array)
		$beforeLoginControllerArray = array (
		                                     'login'
		);

		// allways allow controller array ex:- 'home'
		//(Note:- If you insert controller name here this rule will be apply to all methods inside it, if you want to add this rule for particular function within class then put controller/function name in alwaysAllowControllerMethodArray array)
		$alwaysAllowControllerArray = array (
		                                          'four_zero_four','maintenance'
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
					redirect(base_url().'dashboard');
					return false;
				}
				else
				{
					if(!$this->isLoggedIn() && $class!='login')
					{
						redirect(base_url()."login");
						return false;
					}
				}
			}
			else
			{
				if(!$this->isLoggedIn() && $class!='login')
				{
					redirect(base_url()."login");
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
			return true;
		else
			return false;
	}
}
?>