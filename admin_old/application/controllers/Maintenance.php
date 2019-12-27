<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Maintenance extends CI_Controller
{
	public function index()
	{
		$SITE_OFFLINE = $this->modelbasic->getValue('settings','description','type', 'SITE_OFFLINE');
		if($SITE_OFFLINE == "NO")
		{
			redirect('Home','refresh');
			exit();
		}

		$this->load->view('maintenance_view');
	}
}