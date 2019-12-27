<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
*	@author : Santosh Badal
*	date	: 05 August, 2014
*	http://unichronic.com
*	Unichronic - Master Admin
*/

class Install extends CI_Controller {
	function __construct()
   	{
        	parent::__construct();
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('form');
	}

	function index()
	{
		//$this->load->view('install/index');
		$this->load->view('install/install_view');
	}

	// -----------------------------------------------------------------------------------
	/*
	 * Install the script here
	 */
	function do_install()
	{
		$db_verify	=	$this->check_db_connection();
		if($db_verify == true)
		{
			// Replace the database settings
			$data = read_file('./application/config/database.php');
			$data = str_replace('db_name',		$this->input->post('db_name'),	$data);
			$data = str_replace('db_uname',		$this->input->post('db_uname'),$data);
			$data = str_replace('db_password',	$this->input->post('db_password'),	$data);
			$data = str_replace('db_hname',		$this->input->post('db_hname'),$data);
			write_file('./application/config/database.php', $data);
			// Replace new default routing controller
			$data2 = read_file('./application/config/routes.php');
			$data2 = str_replace('install','login',$data2);
			write_file('./application/config/routes.php', $data2);

			$data3 = read_file('./application/config/config.php');
			$data3 = str_replace('$config["enable_hooks"] = FALSE','$config["enable_hooks"] = TRUE',$data3);
			write_file('./application/config/config.php', $data3);
			// Run the installer sql schema
			$this->load->database();
			$schema = read_file('./assets/install/db/install.sql');
			$query = rtrim( trim($schema), "\n;");
			$query_list = explode(";", $query);
			foreach($query_list as $query)
				 $this->db->query($query);

			// Replace the admin login credentials
			$this->db->where('id' , 1);
			$this->db->update('admin' , array('email'	=>	$this->input->post('email'),
												'password'	=>	md5($this->input->post('password'))));
			// Replace the system name
			$this->db->where('type', 'system_name');
			$this->db->update('settings', array(
				'description' => $this->input->post('system_name')
			));
			// Replace the system title
			$this->db->where('type', 'system_title');
			$this->db->update('settings', array(
				'description' => $this->input->post('system_name')
			));
			$this->db->where('type', 'from_email');
			$this->db->update('settings', array(
				'description' => $this->input->post('from_email')
			));

			$this->db->where('type', 'from_name');
			$this->db->update('settings', array(
				'description' => $this->input->post('from_text')
			));

			// Redirect to login page after completing installation
			$this->session->set_flashdata('installation_result' , 'success');
			redirect(base_url() , 'refresh');
		}
		else
		{
			$this->session->set_flashdata('installation_result' , 'failed');
			redirect(base_url().'Install' , 'refresh');
		}
	}

	// -------------------------------------------------------------------------------------------------

	/*
	 * Database validation check from user input settings
	 */
	function check_db_connection()
	{
		$link	=	@mysql_connect($this->input->post('db_hname'),
						$this->input->post('db_uname'),
							$this->input->post('db_password'));
		if(!$link)
		{
			@mysql_close($link);
		 	return false;
		}

		$db_selected	=	mysql_select_db($this->input->post('db_name'), $link);
		if (!$db_selected)
		{
			@mysql_close($link);
		 	return false;
		}

		@mysql_close($link);
		return true;
	}

}

/* End of file install.php */
/* Location: ./system/application/controllers/install.php */