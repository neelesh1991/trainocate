<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Custom_model extends CI_Model 
{
	public function check_data($page)
	{
		$this->db->select('*');
	    $this->db->from('page_details');
		$this->db->where('url',$page);
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}

	
}