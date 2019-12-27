<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Registration_model extends CI_Model

{

	public function is_email_present($email)

	{

		$this->db->select('id,tenant_id,name');

		$this->db->from('users');

		$this->db->where('email_id',$email);

		return $this->db->get()->row_array();

	}

	public function save_forgot_password_link($id,$link)

	{

		$this->db->where('id', $id);

		return $this->db->update('users',array('forgot_password_link'=>$link ));

	}

	public function verifypwdlink($link)

	{

		$this->db->select('id,forgot_password_link,group_id,tenant_id');

		$this->db->from('users');

		$this->db->where('forgot_password_link',$link);

		return $this->db->get()->row_array();

	}

	public function verify_user_link($link)

	{

		$this->db->select('id,user_verification_key,group_id');

		$this->db->from('users');

		$this->db->where('user_verification_key',$link);

		return $this->db->get()->row_array();

	}

	public function deletePwdLink($id)

	{

		$this->db->where('forgot_password_link', $id);

		return $this->db->update('users',array('forgot_password_link'=> '' ));

	}

		public function delete_user_verification_Link($link,$id)

	{

		$this->db->where('id',$id);

		$this->db->where('user_verification_key',$link);

		return $this->db->update('users',array('user_verification_key'=> '' ));

	}

	public function changed_password_save($pwd,$id)
	{		
		$this->db->where('id', $id);

		return $this->db->update('users',array('password'=> $pwd , 'reset_password'=> 1  , 'forgot_password_link'=>''));

	}

	public function chck_is_password_reset($id)

	{

		$this->db->select('reset_password');

		$this->db->from('users');

		$this->db->where('id',$id);

		return $this->db->get()->row_array();

	}



	function getValEmailTemp($table,$getColumn,$conditionArray)



	{



		$this->db->select($getColumn);



		$this->db->from($table);



		if(is_array($conditionArray) && !empty($conditionArray))



		{



			foreach ($conditionArray as $key => $value)



			{



				$this->db->where($key,$value);



			}



		}



		return $this->db->get()->row_array();

	}



}