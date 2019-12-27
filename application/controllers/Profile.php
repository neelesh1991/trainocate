<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
	public function index()
	{
		$this->load->view('profile_view');
	}
	public function edit()
	{
		$this->load->view('edit_profile_view');
	}
}
