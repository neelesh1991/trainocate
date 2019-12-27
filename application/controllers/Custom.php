<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Custom extends CI_Controller
{
	public function index()
	{
	     $page = $this->uri->segment(1);
	     var_dump($page);die;
	     $this->load->model('custom_model');
		 $data['page'] = $this->custom_model->check_data($page);
		// print_r($data);die;
	   	 if(!empty($data['page']))
		 {		 	
		 	$this->load->view('cms_view',$data);
		 }	
		 else
		 {
		   	echo 'pageNotFound';die;
		 }	
	}
}

?>
