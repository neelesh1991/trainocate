<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends CI_Model

{

	public function loginAdmin($condition)

	{

		$this->db->select('A.id',FALSE);

		$this->db->from('admin as A');

		$this->db->join('tenant as B','A.tenant_id=B.id');

		$this->db->where('B.status',$condition['status']);

		$this->db->where('A.email',$condition['email']);

		$this->db->where('A.status',$condition['status']);

		$this->db->where('A.password',$condition['password']);

     	return $this->db->get()->row_array();



	}

	public function get_all_tenant()

	{

		$this->db->select('A.*,B.name as admin_name,B.email',FALSE);

		$this->db->from('tenant as A');

		$this->db->where('A.id',$this->session->userdata('tenant_id'));

		$this->db->where('B.tenant_id',$this->session->userdata('tenant_id'));

		$this->db->join('admin as B','A.id=B.tenant_id');

     		return $this->db->get()->result_array();

	}

       /* public function get_tenant_notification_email($id)
	{
		$this->db->select('notification_email');
		$this->db->from('tenant');
		$this->db->where('id',$id);
		return $this->db->get()->row_array();
	}*/



	public function get_single_user($id)

	{

		$this->db->select('*');

		$this->db->from('users');

		$this->db->where('id',$id);

		return $this->db->get()->row_array();

	}

	public function updateSettings($key,$data)

	{

		$this->db->where('type',$key);

		return $this->db->update('settings',$data);

	}

	public function get_all_settings()

	{

		$this->db->select('*');

		$this->db->from('settings');

		return $this->db->get()->result_array();

	}

	public function get_all_widgets()

	{

		$this->db->select('*');

		$this->db->from('widgets');

		return $this->db->get()->result_array();

	}

	public function updateWidgets($key,$data)

	{

		$this->db->where('widgets_name',$key);

		return $this->db->update('widgets',$data);

	}

	public function countAllUsersNotifications()

	{

		$this->db->select('*');

		$this->db->from('users');

		$this->db->where('admin_status','0');

		return $this->db->count_all_results();

	}

	public function AllUsersNotifications()

	{

		$this->db->select('id,name,photo,created');

		$this->db->from('users');

		$this->db->where('admin_status','0');

		return $this->db->get()->result_array();

	}

	public function AllGroupNotifications()

	{

		$this->db->select('id,tenant_id,group_name,created');

		$this->db->from('manage_groups');

		$this->db->where('admin_status','0');

		return $this->db->get()->result_array();

	}

	public function countAllGroupNotifications()

	{

		$this->db->select('*');

		$this->db->from('manage_groups');

		$this->db->where('admin_status','0');

		return $this->db->count_all_results();

	}

	public function toodaysUsers()

	{

		$this->db->select('*');

		$this->db->from('users');

		$this->db->like('created', date('Y-m-d'));

		return $this->db->count_all_results();

	}

	public function toodaysSuccessStories()

	{

		$this->db->select('*');

		$this->db->from('manage_groups');

		$this->db->like('created', date('Y-m-d'));

		return $this->db->count_all_results();

	}

	public function _change_status_user($id,$status,$table)

		{

			//echo"hi";die;

			if($status == 1)

			{

				$data=array('status'=>0);

			}

			else

			{

				$data=array('status'=>1);

			}

			$this->db->where('id',$id);

			return $this->db->update($table,$data);

		}

		public function graphData()

		{

			$this->db->select('created, COUNT(*) as cnt');

			$this->db->from('users');

			$this->db->group_by('DATE(created)');

			$this->db->where("created <=", date('Y-m-d H:i:s'));

			$this->db->where("created >=", date('Y-m-d H:i:s',strtotime("-7 days")));

			return $this->db->get()->result_array();

		}



		public function categorySearch($search)

		{

			$this->db->select('*');

			$this->db->from('question_categories');

			$this->db->like('category_name',$search);

			$this->db->where('tenant_id',$this->session->userdata('tenant_id'));

			return $this->db->get()->result_array();

		}



		public function quiz_section()

		{

			$this->db->select('B.*,C.id as CatId,C.category_name as CatName',FALSE);

			$this->db->from('section_category_relations as A');

			$this->db->join('quiz_section as B','A.section_id=B.id','LEFT');

			$this->db->join('question_categories as C','A.category_id=C.id','LEFT');

			$this->db->where('B.tenant_id',$this->session->userdata('tenant_id'));

			$this->db->where('C.tenant_id',$this->session->userdata('tenant_id'));

			$this->db->group_by('B.section_name');

		        $query = $this->db->get();

		       return $query->result_array();

		}



		public function getAllSectionWhere($res)

		{

			$this->db->select('B.*,C.id as CatId',FALSE);

			$this->db->from('section_category_relations as A');

			$this->db->join('quiz_section as B','A.section_id=B.id');

			$this->db->join('question_categories as C','A.category_id=C.id');

			$this->db->where('B.id',$res);

			$this->db->where('B.tenant_id',$this->session->userdata('tenant_id'));

			$this->db->where('C.tenant_id',$this->session->userdata('tenant_id'));

	        $query = $this->db->get();

	       return $query->row_array();

		}



		public function getAdminData($res)

		{

			$this->db->select('A.*,B.name as tenant_name,B.logo as tenant_logo,B.header_color as header_color',FALSE);

			$this->db->from('admin as A');

			$this->db->join('tenant as B','A.tenant_id=B.id');

			$this->db->where('A.id',$res['id']);

	        $query = $this->db->get();

	       return $query->result_array();

		}





		public function get_Category($ress)

		{

			$this->db->select('C.category_name',FALSE);

			$this->db->from('section_category_relations as A');

			$this->db->join('question_categories as C','A.category_id=C.id');

			$this->db->where('A.section_id',$ress['section_id']);

			$this->db->where('C.tenant_id',$ress['tenant_id']);

	        $query = $this->db->get();

	       return $query->result_array();

		}



		public function get_Quiz_Category($ress)

		{

			$this->db->select('B.category_name',FALSE);

			$this->db->from('mock_quiz_category_relation as A');

			$this->db->join('question_categories as B','A.category_id=B.id');

			$this->db->where('A.quiz_id',$ress);

			$this->db->where('B.tenant_id',$this->session->userdata('tenant_id'));

		        $query = $this->db->get();

		       return $query->result_array();

		}



		public function get_Group($exam_id)

		{

			$this->db->select('group_id');

			$this->db->from('exam_group_relation');

			$this->db->where('exam_id',$exam_id);

	        $query = $this->db->get();

	       return $query->result_array();

		}



		public function get_User($exam_id)

		{

			$this->db->select('user_id');

			$this->db->from('exam_user_relation');

			$this->db->where('exam_id',$exam_id);

	        $query = $this->db->get();

	       return $query->result_array();

		}

		function deleteCatyegory($id)

		{

			$this->db->where('section_id', $id);

			return $this->db->delete('section_category_relations');

		}

		function delete_exam_user_relation($id)

		{

			$this->db->where('exam_id', $id);

			return $this->db->delete('exam_user_relation');

		}

		function delete_exam_group_relation($id)

		{

			$this->db->where('exam_id', $id);

			return $this->db->delete('exam_group_relation');

		}

		function getExportQuery($exam_id)

		{

			$this->db->select('D.id,D.name,D.email_id,E.verification_key',FALSE);

			$this->db->from('exam_master as A');

			$this->db->join('exam_user_relation as B','A.id=B.exam_id','left');

			$this->db->join('exam_group_relation as C','A.id=C.exam_id','left');

			$this->db->join('users as D','B.user_id=D.id OR C.group_id=D.group_id','left');

			$this->db->join('verification_key as E','E.user_id=D.id','left');

			$this->db->where('A.id', $exam_id);

			$this->db->where('E.exam_id', $exam_id);

			$this->db->where('A.tenant_id', $this->session->userdata('tenant_id'));

			$this->db->group_by('D.id')->get()->result_array();

			//$res=$this->db->group_by('D.id')->get()->result_array();

			//print_r($res);die;

			return $this->db->last_query();

		}


		function currentlyAssignedUsers($exam_id)

		{

			$where = "(`B.exam_id` = $exam_id OR `C.exam_id` = $exam_id)";

			return $this->db->select('A.id')->from('users as A')->join('exam_user_relation as B','A.id=B.user_id','left')->join('exam_group_relation as C','C.group_id=A.group_id','left')->where('A.tenant_id',$this->session->userdata('tenant_id'))->where($where)->group_by('A.id')->get()->result_array();

		}



		function send_mail_to_user_exam($exam_id,$user_id)

		{

			$where = "(`B.exam_id` = $exam_id OR `C.exam_id` = $exam_id)";

			return $this->db->select('A.id,A.name,A.email_id,D.exam_name')->from('users as A')->join('exam_user_relation as B','A.id=B.user_id','left')->join('exam_group_relation as C','C.group_id=A.group_id','left')->join('exam_master as D','D.id=B.exam_id OR D.id=C.exam_id','left')->where('A.tenant_id',$this->session->userdata('tenant_id'))->where('A.id',$user_id)->where($where)->group_by('A.id')->get()->row_array();

		}



		function send_mail_to_user_examAdd($exam_id)

		{

			$newExamAssignedUserList=$this->newExamAssignedUserList($exam_id);

			$where = "(`B.exam_id` = $exam_id OR `C.exam_id` = $exam_id)";

			$this->db->select('A.id,A.name,A.email_id,D.exam_name')->from('users as A')->join('exam_user_relation as B','A.id=B.user_id','left')->join('exam_group_relation as C','C.group_id=A.group_id','left')->join('exam_master as D','D.id=B.exam_id OR D.id=C.exam_id','left')->where('A.tenant_id',$this->session->userdata('tenant_id'));

			if(!empty($newExamAssignedUserList))

			{

				$this->db->where_in('A.id',$newExamAssignedUserList);

			}

			$this->db->where($where);

			return $this->db->group_by('A.id')->get()->result_array();

		}



		function newExamAssignedUserList($exam_id)

		{

			$selectUsers=$this->input->post('selectUsers',TRUE);

			if(!isset($selectUsers) || empty($selectUsers))

			{

				$selectUsers=array();

			}



			$selectGroups=$this->input->post('selectGroups',TRUE);



			if(!empty($selectGroups))

			{

				$groupUsers=$this->db->select('id')->from('users')->where_in('group_id',$selectGroups)->get()->result_array();

				if(!empty($groupUsers))

				{

					foreach ($groupUsers as $group)

					{

						if(!in_array($group['id'],$selectUsers))

						{

							$selectUsers[]=$group['id'];

						}

					}

				}

			}

			return $selectUsers;

		}



		public function countAll($table,$conditionArray)

		{

			$this->db->select('*');

			$this->db->from($table);

			if(is_array($conditionArray) && !empty($conditionArray))

			{

				foreach ($conditionArray as $key => $value)

				{

					$this->db->like($key,$value);

				}

			}

			return $this->db->count_all_results();

		}

	public function remove_Notification_Count($table)

		{

			return $this->db->update($table,array('admin_status'=>'1'));

		}

	public function _change_status($id,$status,$table)

		{

			//echo"hi";die;

			if($status == 1)

			{

				$data=array('status'=>0);

			}

			else

			{

				$data=array('status'=>1);

			}

			$this->db->where('id',$id);

			return $this->db->update($table,$data);

		}

	public function run_MY_Query($table,$requestData,$columns,$selectColumns,$concatColumns = '',$fieldName='')

		{

			//pr($requestData);

			$this->db->select($selectColumns,FALSE)->from($table);

				$i=0;

				if( !empty($requestData['search']['value']) )

				{

					foreach ($columns as $value)

					{

						if($i==0)

						{

							$this->db->like($value,$requestData['search']['value'],'both');

						}

						else

						{

							if($concatColumns <> '' && $value == $fieldName)

							{

								$concat=explode(',', $concatColumns);

								$this->db->or_like("CONCAT($concat[0],' ', $concat[1])", $requestData['search']['value'], 'both',FALSE);

							}

							else

							{

								$this->db->or_like($value,$requestData['search']['value'],'both');

							}

						}

						$i++;

					}

				}

			if($requestData["length"] != -1)

				{

					$this->db->limit($requestData["length"],$requestData["start"]);

				}

				return $this->db->get()->result_array();

		}



	function get_hits($from_date = FALSE, $to_date = FALSE, $unique = FALSE)

	{

		if($to_date === FALSE)

		{

			$to_date = date('Y-m-d', time());

		}

		if($from_date === FALSE)

		{

			$from_date = date('Y-m-d', time() - 2592000);

		}

		$from = explode('-', $from_date);

		$to = explode('-', $to_date);

		if(count($from) == 3 AND count($to) == 3)

		{

			if(checkdate($from[1], $from[2], $from[0]) AND checkdate($to[1], $to[2], $to[0]))

			{

				if($unique)

				{

					$distinct = 'DISTINCT ';

				}

				else

				{

					$distinct = '';

				}

				$this->db->select("COUNT($distinct visitor_id) AS visit_count", FALSE);

				$this->db->select("DATE_FORMAT(visit_visit_date, '%Y') AS visit_year", FALSE);

				$this->db->select("DATE_FORMAT(visit_visit_date, '%d') AS visit_day", FALSE);

				$this->db->select("DATE_FORMAT(visit_visit_date, '%m') AS visit_month", FALSE);

				$this->db->from('visitor');

				$this->db->join('visit', 'visit_visitor_id = visitor_id');

				$this->db->where('visit_visit_date >= ', $from_date.' 00:00:00');

				$this->db->where('visit_visit_date <= ', $to_date.' 23:59:59');

				//$this->db->group_by('visit_year, visit_day, visit_month');

				$result = $this->db->get();

				if($result->num_rows() > 0)

				{

					return $result->result_array();

				}

				else

				{

					echo "bla";

				}

			}

		}

	}
		public function update_verification_key($tenant_id,$uid,$exam_id,$key)
		{
			$this->db->select('id');
			$this->db->where('user_id',$uid);
			$this->db->where('tenant_id',$tenant_id);
			$this->db->where('exam_id',$exam_id);
			$this->db->from('verification_key');
		$res=$this->db->get()->row_array();
		if(empty($res))
		{
			$data=array('tenant_id'=>$tenant_id,'user_id'=>$uid,'exam_id'=>$exam_id,'verification_key'=>$key);

			$this->db->insert('verification_key',$data);
			return $this->db->insert_id();
		}else
		{
			$this->db->where('id',$res['id']);
			return $this->db->update('verification_key',array('verification_key'=>$key));
		}
	}
	public function get_userinfo_for_generate_pdf($tenant_id)
	{
			$this->db->select('users.name,users.email_id,exam_master.exam_name,exam_master.start_date,exam_master.end_date,tenant.name as tenant_name,quiz_log.quiz_id,tenant.logo');
			$this->db->from('users');
			$this->db->join('quiz_log','quiz_log.user_id=users.id');
			$this->db->join('tenant','tenant.id=users.tenant_id');
			$this->db->join('exam_master','exam_master.id=quiz_log.exam_id','left');
			$this->db->join('pdf','pdf.exam_id != quiz_log.exam_id AND pdf.user_id != quiz_log.user_id','left');
		/*	$this->db->join('quiz_section','quiz_section.quiz_id=quiz_log.quiz_id');*/
		$this->db->where('tenant.id',$tenant_id);
		$this->db->where('quiz_log.tenant_id',$tenant_id);
			$this->db->where('users.tenant_id',$tenant_id);
			$this->db->where('exam_master.tenant_id',$tenant_id);

			$this->db->where("(quiz_log.status=0 OR quiz_log.finish=1)");

			return $this->db->get()->result_array();
		//	return $this->db->last_query();
			//print_r($res);die;

	}
	public function get_section_name($quiz_id,$tenant_id)
	{
		$this->db->select('section_name');
		$this->db->from('quiz_section');
		$this->db->where('quiz_id',$quiz_id);
		$this->db->where('tenant_id',$tenant_id);
		return $this->db->get()->result_array();

	}
	public function get_timezone_data()
	{
		$this->db->select('*');
		$this->db->from('timezone');
		return $this->db->get()->result_array();
	}
	public function get_tenant_timezone($id)
	{
		$this->db->select('timezone');
		$this->db->from('tenant');
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

	function getAllGlobalEmailData()

	{

		$this->db->select('id,tenant_id,subject,email_contains,status');
		$this->db->from('manage_email_template');
		$this->db->where('tenant_id',1);
		return $this->db->get()->result_array();

	}

	function getAllGlobalwidgets()

	{

		$this->db->select('id,widget_name,info,page_name,tenant_id');
		$this->db->from('widgets');
		$this->db->where('tenant_id',1);
		return $this->db->get()->result_array();

	}
	public function countemailtemplate($tenant_id)

	{

		$this->db->select('*');

		$this->db->from('manage_email_template');

		$this->db->where('tenant_id',$tenant_id);

		return $this->db->count_all_results();

	}

	public function countwidgets($tenant_id)

	{

		$this->db->select('*');

		$this->db->from('widgets');

		$this->db->where('tenant_id',$tenant_id);

		return $this->db->count_all_results();

	}


}

?>