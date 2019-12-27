<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Logout extends CI_Controller
{
	function __construct()
	{
	    	parent::__construct();
	}
	public function index()
	{
		//echo "logout";die;
		$this->session->sess_destroy();
		redirect(base_url());
	}
}