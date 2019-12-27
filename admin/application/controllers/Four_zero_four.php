<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Four_zero_four extends CI_Controller
{
	function __construct()
	{
	    	parent::__construct();
	}

	public function index()
	{
		$this->load->view('four_zero_four_view');
	}

}