<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Userprofile_model extends CI_Model
{
	public function signup_detail_save($data)
	{
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	public function profile_detail_save($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$userinfo=$this->db->get()->row_array();
		if($userinfo['name']!='' && $userinfo['email_id']!='' && $userinfo['contact_no']!='')
		{
			$this->db->where('id', $id);
			return $this->db->update('users',array('is_profile_completed'=> 1 ));
		}
	}
	public function get_group_info($tenant_id)
	{
		$this->db->select('id,group_name');
		$this->db->from('manage_groups');
		$this->db->where('tenant_id', $tenant_id);
		$this->db->where('signup_show',1);
		return $this->db->get()->result_array();
	}
	public function get_user_profile_info($id,$tenant_id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$this->db->where('tenant_id',$tenant_id);
		return $this->db->get()->row_array();
	}
	public function profile_complete_status($id)
	{
		$this->db->select('is_profile_completed');
		$this->db->from('users');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}
	public function get_security_info($tenant_id,$exam_id)
		{
			$this->db->select('security');
			$this->db->from('exam_master');
			$this->db->where('tenant_id',$tenant_id);
			$this->db->where('id',$exam_id);
			return $this->db->get()->row_array();
		}
	public function verify_key($user_id,$tenant_id,$exam_id,$key)
	{
	$this->db->select('id');
	$this->db->from('verification_key');
	$this->db->where('verification_key',$key);
	$this->db->where('user_id',$user_id);
	$this->db->where('tenant_id',$tenant_id);
	$this->db->where('exam_id',$exam_id);
	return $this->db->get()->row_array();
	}
	public function remove_key($user_id,$tenant_id,$exam_id,$mock)
	{
		if($mock==0)
		{
			$this->db->where('user_id',$user_id);
			$this->db->where('tenant_id',$tenant_id);
			$this->db->where('exam_id',$exam_id);
			return $this->db->update('verification_key',array('verification_key'=>''));
		}
	}
	public function get_slider_info($tenant_id)
	{
		$this->db->select('*');
		$this->db->from('manage_banner');
		$this->db->where('tenant_id', $tenant_id);
		$this->db->where('status', 1);
		return $this->db->get()->result_array();
	}
	public function get_widget_info($tenant_id)
	{
		$this->db->select('*');
		$this->db->from('widgets');
		$this->db->where('tenant_id', $tenant_id);
		$this->db->where('status', 1);
		return $this->db->get()->result_array();
	}

	public function get_tenant_info($tenant_id)
	{
		$this->db->select('*');
		$this->db->from('tenant');
		$this->db->where('id', $tenant_id);
		$this->db->where('status', 1);
		return $this->db->get()->row_array();
	}
	public function get_admin_info($tenant_id)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('tenant_id', $tenant_id);
		$this->db->where('status', 1);
		return $this->db->get()->row_array();
	}
	public function get_exam_time_info($exam_id,$quiz_id)
	{
		$this->db->select('duration,end_date,start_date');
		$this->db->from('exam_master');
		$this->db->where('id', $exam_id);
		$this->db->where('quiz_id', $quiz_id);
		return $this->db->get()->row_array();
	}
	public function save_log_info($data,$mock)
	{
		if($mock==1)
		{
			$this->db->insert('mock_log',$data);
			return $this->db->insert_id();
		}else
		{
			$this->db->insert('quiz_log',$data);
			return $this->db->insert_id();
		}
	}
	public function check_exam_log($data,$mock)
	{
		if($mock==1)
		{
			$this->db->select('id,start_time,end_time,status');
			$this->db->from('mock_log');
			$this->db->where($data);
			return $this->db->get()->row_array();
		}
		else
		{
			$this->db->select('id,start_time,end_time,status');
			$this->db->from('quiz_log');
			$this->db->where($data);
			return $this->db->get()->row_array();
		}
	}
	public function update_user_exam_status($id,$mock,$uid,$t_id,$q_id,$e_id)
	{
		if($mock==1)
		{
			$this->db->where('user_id',$uid);
			$this->db->where('tenant_id',$t_id);
			$this->db->where('quiz_id',$q_id);
			$this->db->where('exam_id',$e_id);
			$this->db->where('mock',1);
			$res=$this->db->update('quiz',array('selected_answer'=> 0 ));
			$this->db->where('id',$id);
			return $this->db->update('mock_log',array('status'=> 0 ));
		}
		else
		{
			$this->db->where('id',$id);
			return $this->db->update('quiz_log',array('status'=> 0 ));
		}
	}
	public function manually_end_quiz($uid,$tenant_id,$quiz_id,$exam_id,$mock,$current_date, $completed_in)
	{
		if($mock==1)
		{
			$this->db->where('user_id',$uid);
			$this->db->where('tenant_id',$tenant_id);
			$this->db->where('quiz_id',$quiz_id);
			$this->db->where('exam_id',$exam_id);
			$this->db->where('mock',1);
			$res=$this->db->update('quiz',array('selected_answer'=> 0));

			$this->db->where('user_id',$uid);
			$this->db->where('tenant_id',$tenant_id);
			$this->db->where('quiz_id',$exam_id);
			$this->db->where('exam_id',$exam_id);
			return $this->db->update('mock_log',array('status'=> 0 ,'finish'=>1 , 'end_time'=>$current_date));
		}else
		{
			$this->db->where('user_id',$uid);
			$this->db->where('quiz_id',$quiz_id);
			$this->db->where('exam_id',$exam_id);
			$this->db->where('tenant_id',$tenant_id);
			return $this->db->update('quiz_log',array('status'=>0,'finish'=>1,'end_time'=>$current_date, 'total_exam_completed_in' => $completed_in));
		}
	}
	public function no_of_question($data)
	{
		$this->db->select('COUNT(*) as cnt');
		$this->db->from('quiz');
		$this->db->where($data);
	return $this->db->get()->row_array();
	}
	public function attempt_que($data)
	{
		$this->db->select('COUNT(*) as cnt');
		$this->db->from('quiz');
		$this->db->where($data);
		$this->db->where('selected_answer !=',0);
		return $this->db->get()->row_array();
	}
	public function correct_ans($data)
	{
		$this->db->select('COUNT(*) as cnt');
		$this->db->from('quiz');
		$this->db->where($data);
		//$this->db->where('selected_answer = correct_answer_opt_id');
			$this->db->where('is_correct',1);

		return $this->db->get()->row_array();
	}
	public function got_marks($data)
	{
		$this->db->select('SUM(marks) as cnt');
		$this->db->from('quiz');
		$this->db->where($data);
		//$this->db->where('selected_answer = correct_answer_opt_id');
		$this->db->where('is_correct',1);

		return $this->db->get()->row_array();
	}
	public function total_marks($data)
	{
		$this->db->select('SUM(marks) as cnt');
		$this->db->from('quiz');
		$this->db->where($data);
		return $this->db->get()->row_array();
	}
	public function update_exam_summary_in_quiz_log($condition,$data,$mock)
	{
		if($mock==0)
		{
			$this->db->where($condition);
			$this->db->update('quiz_log', $data);
		}
	}
	public function check_exam_master_info($id,$quiz_id,$tenant_id)
	{
		$this->db->select('*');
		$this->db->from('exam_master');
		$this->db->where('id',$id);
		$this->db->where('quiz_id',$quiz_id);
		$this->db->where('tenant_id',$tenant_id);
		return $this->db->get()->row_array();
	}
	public function check_upcoming_quiz_for_user($uid,$tenant_id,$group_id, $userLevelID = "")
		{

			$this->db->select('exam_master.*');
			$this->db->from('exam_master');
			$this->db->join('exam_user_relation','exam_master.id = exam_user_relation.exam_id','left');
			
			//Change from Mandar 28/11/2019
			
			// $this->db->join('exam_group_relation', ' exam_master.id = exam_group_relation.exam_id','left');

			/*if(!empty($userLevelID)){
				//$this->db->where('exam_master.user_level_id',$userLevelID);
				$dQuerys = "AND  exam_master.user_level_id=".$userLevelID;
				$this->db->where("(exam_group_relation.group_id='$group_id' ".$dQuerys.")");


			} else{
				$this->db->where("(exam_user_relation.user_id='$uid')");
			}*/

					//If not general group
			//Change from Mandar 28/11/2019
				// if( $group_id != 64) {
				// 		$this->db->where("(exam_group_relation.group_id='$group_id')");
				// 		$this->db->where("(exam_user_relation.user_id='$uid' OR exam_group_relation.group_id='$group_id')");
				// }




			$this->db->where('exam_master.tenant_id',$tenant_id);


			$this->db->group_by('exam_master.id');
			$res=$this->db->get()->result_array();
		//print_r($res);die;
			if(!empty($res))
			{
				$exam=array();
				foreach($res as $re)
				{
					$exam[]=$re['id'];
				}
				$res1=array();
				$this->db->select('*');
				$this->db->from('quiz_log');
				$this->db->where('user_id',$uid);
				$this->db->where('tenant_id',$tenant_id);
				$log_detail=$this->db->get()->result_array();
				if(!empty($log_detail))
				{
					$exam1=array();
					foreach($log_detail as $val)
					{
						$exam1[]=$val['exam_id'];
					}
					$this->db->select('quiz_master.id as quiz_id,quiz_master.quiz_name,quiz_master.number_of_sections,quiz_master.assessment_information,quiz_master.assessment_image,exam_master.* ');
					$this->db->from('quiz_master');
					$this->db->join('exam_master','exam_master.quiz_id=quiz_master.id','left');
					$this->db->join('quiz_log','exam_master.id != quiz_log.exam_id');
					$this->db->where('quiz_log.tenant_id',$tenant_id);
					$this->db->where('exam_master.tenant_id',$tenant_id);
					$this->db->where('quiz_master.tenant_id',$tenant_id);
					$this->db->where_in('exam_master.id',$exam);
					$this->db->where_not_in('exam_master.id',$exam1);
					$this->db->group_by('exam_master.id');
					return $this->db->get()->result_array();
				}else
				{
					$quiz=array();
					foreach($res as $val)
					{
						$quiz[]=$val['quiz_id'];
					}
					$this->db->select('quiz_master.id as quiz_id,quiz_master.quiz_name,quiz_master.number_of_sections,exam_master.* ');
					$this->db->from('quiz_master');
					$this->db->join('exam_master','exam_master.quiz_id=quiz_master.id');
					$this->db->where('exam_master.tenant_id',$tenant_id);
					$this->db->where('quiz_master.tenant_id',$tenant_id);
					$this->db->where_in('quiz_master.id',$quiz);
					$this->db->where_in('exam_master.id',$exam);
					//$this->db->group_by('quiz_master.id');
					$this->db->group_by('exam_master.id');
					return $this->db->get()->result_array();
				}
			}
		}
	public function check_users_past_quiz($uid,$tenant_id)
	{
		// $this->db->select('quiz_log.*,exam_master.exam_name');
		$this->db->select('quiz_log.*,exam_master.exam_name,exam_master.retry_attempt_flag,exam_master.retry_attempt,quiz_master.assessment_information,quiz_master.assessment_image');
		$this->db->from('quiz_log');
		$this->db->join('exam_master','quiz_log.exam_id = exam_master.id');
		$this->db->join('quiz_master','quiz_log.quiz_id = quiz_master.id',"left");
		$this->db->where('quiz_log.user_id',$uid);
		$this->db->where('quiz_log.tenant_id',$tenant_id);
		$this->db->where("(quiz_log.status=0 OR quiz_log.finish=1)");
		$this->db->group_by('exam_master.id');
		//echo $this->db->last_query();die;
		return $this->db->get()->result_array();
	//print_r($res);die;
	}
	public function check_users_inprogress_quiz($uid,$tenant_id)
	{
		$this->db->select('quiz_log.*,exam_master.exam_name,exam_master.end_date,exam_master.start_date,quiz_master.assessment_information,quiz_master.assessment_image');
		$this->db->from('quiz_log');
		$this->db->join('exam_master','quiz_log.exam_id = exam_master.id');
		$this->db->join('quiz_master','quiz_log.quiz_id = quiz_master.id',"left");
		$this->db->where('quiz_log.user_id',$uid);
		$this->db->where('quiz_log.tenant_id',$tenant_id);
		$this->db->where("(quiz_log.status=1 AND quiz_log.finish=0)");
		$this->db->group_by('quiz_log.exam_id');
		//echo $this->db->last_query();die;
		return $this->db->get()->result_array();
		//echo $this->db->last_query();die;
	//print_r($res);die;
	}
	public function check_no_of_section($quiz_id,$tenant_id)
	{
		$this->db->select('*');
		$this->db->from('quiz_master');
		$this->db->where('id',$quiz_id);
		$this->db->where('tenant_id',$tenant_id);
		return $this->db->get()->row_array();
	}
	public function get_exam_detail($quiz_id,$exam_id,$tenant_id)
	{
		$this->db->select('*');
		$this->db->from('exam_master');
		$this->db->where('quiz_id',$quiz_id);
		$this->db->where('id',$exam_id);
		$this->db->where('tenant_id',$tenant_id);
		return $this->db->get()->row_array();
	}
	public function get_quiz_detail($quiz_id,$tenant_id,$no_of_section)
	{
		$this->db->select('quiz_section.*,GROUP_CONCAT(section_category_relations.category_id SEPARATOR ",") as catg');
		$this->db->from('quiz_section');
		$this->db->join('section_category_relations','section_category_relations.section_id=quiz_section.id');
		$this->db->where('quiz_section.quiz_id',$quiz_id);
		$this->db->where('quiz_section.tenant_id',$tenant_id);
		$this->db->limit($no_of_section);
		$this->db->group_by('section_category_relations.section_id');
		return $this->db->get()->result_array();
	}
	public function get_user_info($uid)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $uid);
		return $this->db->get()->row_array();
	}
	public function get_question_position($user_id,$exam_id,$quiz_id,$qid,$mock)
	{
		$this->db->select('id');
		$this->db->from('quiz');
		$this->db->where('user_id',$user_id);
		$this->db->where('exam_id',$exam_id);
		$this->db->where('quiz_id',$quiz_id);
		$this->db->where('mock',$mock);
		$this->db->where('question_id',$qid);
	return $this->db->get()->row_array();
	}
	public function get_mock_categories($quiz_id)
	{
		$this->db->select('category_id');
		$this->db->from('mock_quiz_category_relation');
		$this->db->where('quiz_id',$quiz_id);
		return $this->db->get()->result_array();
	}
	public function get_mock_status($quiz_id,$tenant_id)
	{
		$this->db->select('mock');
		$this->db->from('quiz_master');
		$this->db->where('id',$quiz_id);
		$this->db->where('tenant_id',$tenant_id);
		return $this->db->get()->row_array();
	}
	public function isHavingAccess($quiz_id,$exam_id,$mock='')
	{
		$userID=$this->session->userdata('user_id');
		$groupID=$this->session->userdata('group_id');
		$tenant_id=$this->session->userdata('tenant_id');
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
	public function getSectionName($quiz_id,$question_id)
	{
		$tenant_id=$this->session->userdata('tenant_id');
		return $this->db->select('A.section_name')->from('quiz_section as A')->join('section_category_relations as B','A.id=B.section_id')->join('question_category_relations as C','C.category_id=B.category_id')->where('A.tenant_id',$tenant_id)->where('C.question_id',$question_id)->where('A.quiz_id',$quiz_id)->group_by('A.id')->get()->row_array();
	}
	public function chck_is_quizlog_time_expired($uid,$tenant_id)
		{
			if($this->session->userdata('user_timezone')!='')
			{
				//	echo $this->session->userdata('user_timezone');
			$timezone=$this->session->userdata('user_timezone');
			}else
			{
				//echo "hii";
			$timezone=$this->session->userdata('tenant_timezone');
			}
			if($timezone=='')
			{
				//echo "ggf";
				$timezone="Asia/Calcutta";
			}
			//echo $timezone;die;
			$format = 'Y-m-d h:i a';
			$current = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone($timezone));
			$current->setTimeZone(new DateTimeZone('UTC'));
			$current_date=$current->format($format);
			$this->db->select('*');
			$this->db->from('quiz_log');
			$this->db->where('user_id',$uid);
			$this->db->where('tenant_id',$tenant_id);
			$res=$this->db->get()->result_array();
			if(!empty($res))
			{
				foreach ($res as $val) {
					if(strtotime($current_date)>strtotime($val['end_time']))
					{
						$this->db->where('user_id',$uid);
						$this->db->where('tenant_id',$tenant_id);
						$this->db->where('quiz_id',$val['quiz_id']);
						$this->db->where('exam_id',$val['exam_id']);
						$this->db->update('quiz_log',array('status'=>0));
					}
				}
			}
		}
	public function chck_is_quiz_expired($user_id,$tenant_id,$exam_id,$quiz_id)
		{
			$this->db->select('exam_master.end_date,quiz_log.end_time');
			$this->db->from('exam_master');
			$this->db->join('quiz_log','quiz_log.exam_id=exam_master.id AND quiz_log.user_id='.$user_id.' AND quiz_log.exam_id='.$exam_id.' AND quiz_log.quiz_id='.$quiz_id.' AND quiz_log.tenant_id='.$tenant_id,'left');
			$this->db->where('exam_master.tenant_id',$tenant_id);
			$this->db->where('exam_master.quiz_id',$quiz_id);
			//$this->db->where('quiz_log.quiz_id',$quiz_id);
			//	$this->db->where('quiz_log.user_id',$user_id);
			//	$this->db->where('quiz_log.exam_id',$exam_id);
			$this->db->where('exam_master.id',$exam_id);
		// $this->db->where('quiz_log.tenant_id',$tenant_id);
			$this->db->where('exam_master.tenant_id',$tenant_id);
			return $this->db->get()->row_array();
			//echo $this->db->last_query();die;
			//print_r($res);die;
		}
		public function fetch_timezone_data()
		{
			$this->db->select('*');
			$this->db->from('timezone');
			return $this->db->get()->result_array();
		}
		public function get_tenant_time_zone($tenant_id)
		{
			$this->db->select('timezone');
			$this->db->from('tenant');
			$this->db->where('id',$tenant_id);
			return $this->db->get()->row_array();
		}
		public function get_user_time_zone($tenant_id,$uid)
		{
			$this->db->select('timezone');
			$this->db->from('users');
			$this->db->where('tenant_id',$tenant_id);
			$this->db->where('id',$uid);
			return $this->db->get()->row_array();
		}
		public function get_exam_time($quiz_id,$exam_id,$tenant_id)
		{
				$this->db->select('start_date');
				$this->db->from('exam_master');
				$this->db->where('tenant_id',$tenant_id);
				$this->db->where('id',$exam_id);
				$this->db->where('quiz_id',$quiz_id);
			return $this->db->get()->row_array();
		}

	public function fetch_user_level_data($id = "")
		{
			$this->db->select('*');
			$this->db->from('user_levels');
			if(!empty($id)){
				$this->db->where('id',$id);
			}
			return $this->db->get()->result_array();
		}

public function fetch_user_group_data($gid = "")
		{

			$this->db->select('*');
			$this->db->from('manage_groups');
			if(!empty($gid)){
				$this->db->where('id',$gid);
			}
			return $this->db->get()->result_array();
		}


		public function fetch_exam_group_data($gid)
		{


			$this->db->select('*');
			$this->db->from('exam_group_relation');
			$this->db->join('manage_groups','exam_group_relation.group_id = manage_groups.id');
			$this->db->where('exam_group_relation.exam_id',$gid);


			return $this->db->get()->result_array();
		}

		public function quiz_level_data($id = "")
		{
			$this->db->select('*');
			$this->db->from('exam_master');
			$this->db->join('user_levels','exam_master.user_level_id = user_levels.id');
			$this->db->where('exam_master.id',$id);
			return $this->db->get()->result_array();
		}

		public function userUpdate_User_level($uid){

			$this->db->where('id',$uid);
			$res = $this->db->update('userss',array('user_level_id'=> 2 ));
			return $res;

		}

		public function get_allquiz_info($tenant_id)
		{
			$this->db->select('*');
			$this->db->from('quiz_master');
			$this->db->where('tenant_id', $tenant_id);
			return $this->db->get()->result_array();
		}

}