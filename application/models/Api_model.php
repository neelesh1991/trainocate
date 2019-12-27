<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_model extends CI_Model 
{
	public function checkLogin($data)
	{
		//print_r($data);die;
		$this->db->select('id,tenant_id');
	    $this->db->from('users');
		$this->db->where('email_id',$data['userName']);
		$this->db->where('password',md5($data['password']));
		$this->db->where('status',1);
		return $this->db->get()->row();		
	}

	public function geUserExam($id)
	{
		$this->db->select('C.id,C.exam_name,C.start_date,C.end_date,C.show_results,D.section_name');
	    $this->db->from('users as A');
	    $this->db->join('exam_user_relation as B','B.user_id=A.id');
	    $this->db->join('exam_master as C','C.id=B.exam_id');
	    $this->db->join('quiz_section as D','D.quiz_id=C.quiz_id');
		$this->db->where('A.id',$id);	
		//$this->db->where('status',1);
$this->db->group_by('C.id');
		return $this->db->get()->result_array();		
	}

	public function isHavingAccess($userID,$groupID,$tenant_id,$quiz_id,$exam_id,$mock='')
	{
		if($userID > 0 && $groupID > 0)
		{
			$where = "(`B.exam_id` = $exam_id OR `C.exam_id` = $exam_id)";
			$res= $this->db->select('A.id,A.name,A.email_id,D.exam_name')->from('users as A')->join('exam_user_relation as B','A.id=B.user_id','left')->join('exam_group_relation as C','C.group_id=A.group_id','left')->join('exam_master as D','D.id=B.exam_id OR D.id=C.exam_id','left')->where('A.tenant_id',$tenant_id)->where('A.id',$userID)->where($where)->group_by('A.id')->get()->row_array();

			if(empty($res))
			{
				return false;
			}
			else
			{
				$this->db->select('mock');
				$this->db->from('quiz_master');
				$this->db->where('id',$quiz_id);
				$this->db->where('tenant_id',$tenant_id);
				$mockData=$this->db->get()->row_array();
				if(!empty($mockData))
				{
					if($mock != '' && $mockData['mock']  != $mock)
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			return true;
		}
		else
		{
			return false;
		}
	}


	
}