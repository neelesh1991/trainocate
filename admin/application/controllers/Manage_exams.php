<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Manage_exams extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('test_model');
		$this->load->helper('string');

		$this->load->library('upload');
    	$this->load->library('image_lib');
    	$this->load->helper('imgupload');
	    	
	}

	public function index()
	{
		$res = array('tenant_id'=>$this->session->userdata('tenant_id'));
		$data['quiz']=$this->modelbasic->getAllWhere('quiz_master','*',$res);
		$data['users']=$this->modelbasic->getAllWhere('users','*',$res);
		$data['group']=$this->modelbasic->getAllWhere('manage_groups','*',$res);
		$data['user_levels']=$this->db->get('user_levels')->result_array();

		//levels
		$data['level']=$this->db->get('mst_level')->result_array();
		$data['page_name']='manage_exams/manage_exams_view';
		//print_r($data);exit;
		$this->load->view('index',$data);
	}

	public function getAjaxdataObjects()
	{
		$timezone='Asia/Kolkata';
		if($this->session->userdata('time_zone')!='')
		{
		    $timezone=$this->session->userdata('time_zone');
		}
		$tz_from = 'UTC';
		$tz_to = $timezone;
		$format = 'Y-m-d h:i a';


		$_POST['columns']='A.id,A.exam_name,A.tenant_id,A.quiz_id,A.start_date,A.end_date,A.duration,A.security,A.show_results,A.show_levels,A.completion_message,B.quiz_name,A.result_dependancy';
		$requestData = $_REQUEST;
		$columns=explode(',',$_POST['columns']);
		$selectColumns = "A.id,A.exam_name,A.tenant_id,A.quiz_id,A.start_date,A.end_date,A.duration,A.security,A.show_results,A.show_levels,A.completion_message,B.quiz_name,A.result_dependancy";
		// $condition=array('A.tenant_id'=>$this->session->userdata('tenant_id'));
		$condition= "";
		if($this->session->userdata('tenant_id') != '1' && ($this->session->userdata('admin_level') != '1'))
	    {
	      $condition=array('A.tenant_id'=>$this->session->userdata('tenant_id'));
	    }
		$totalData=$this->modelbasic->count_all_only('exam_master as A',$condition);
		$totalFiltered=$totalData;
		$join_array=array(array('quiz_master as B','B.id=A.quiz_id'));
		$result=$this->modelbasic->run_query('exam_master as A',$requestData,$columns,$selectColumns,'','',$condition,$join_array);
		//print_r($result);exit;
		//$result=$this->modelbasic->getAllWhere('exam_master','*',$condition);
		if( !empty($requestData['search']['value']) )
		{
			$totalFiltered=count($result);
		}
		$data = array();
		if(!empty($result))
		{
			$i=1;
			foreach ($result as $row)
			{
				$nestedData=array();
				$nestedData['chk'] = '<div class="vd_checkbox checkbox-success"><input type="checkbox" class="case" id="check-'.$row["id"].'" name="checkall['.$row["id"].']" data-index="'.$row["id"].'"><label for="check-'.$row["id"].'"> </label></div>';
				$nestedData['id'] =$row["id"];
				//$nestedData['quiz_id'] =$row["quiz_id"];
				$quiz_name_data=$row['quiz_name'];
				//$nestedData['quiz_name']=$quiz_name_data['quiz_name'];
				$nestedData['info'] = '<div style="text-align:left;"><b>Exam Name : </b>'.$row['exam_name'].'<br/><b>Quiz Name : </b>'.$quiz_name_data.'<br/><b>Duration : </b> '.$row["duration"].'</div>';
				//print_r($nestedData);die;
				$start = new DateTime($row["start_date"], new DateTimeZone($tz_from));
				$start->setTimeZone(new DateTimeZone($tz_to));
				$start_date=$start->format($format);

				$end = new DateTime($row["end_date"], new DateTimeZone($tz_from));
				$end->setTimeZone(new DateTimeZone($tz_to));
				$end_date=$end->format($format);

				$nestedData['start_date'] =$start_date;
				$nestedData['exam_name'] =$row["exam_name"];
				$nestedData['end_date'] =$end_date;
				//$nestedData['duration'] =$row["duration"];
				$nestedData['completion_message'] =$row["completion_message"];
				$export='';
				if($row["security"])
				{
					$export='<a class="btn menu-icon vd_bd-blue vd_blue" href="manage_exams/export_csv_users_key/'.$row['id'].'" data-placement="top" data-toggle="tooltip" data-original-title="Export Exam Codes"> <i class="glyphicon glyphicon-export"></i></a>';
				}
				$nestedData['security'] =($row["security"])?'Yes':'No';
				$nestedData['show_results'] =($row["show_results"])?'Yes':'No';

				//show levels
				$nestedData['show_levels'] =($row["show_levels"])?'Yes':'No';

				$nestedData['result_dependancy'] =($row["result_dependancy"])?'No of que.':'Marks';
				$nestedData['action'] = '<div class="menu-action">
							<a onclick="edit_exams('.$row['id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-pencil"></i> </a>
							<a onclick="delete_confirm('.$row['id'].');" class="btn menu-icon vd_bd-red vd_red" data-placement="top" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-times"></i></a>'.$export.'
							 </div>';
							$data[] = $nestedData;
							$i++;
						}
					}
					$json_data = array(
							"draw"            => intval( $requestData['draw'] ),
							"recordsTotal"    => intval( $totalData ),  // total number of records
							"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
							"data"            => $data   // total data array
							);
					//print_r($nestedData);die;
					$data['ajax']=json_encode($json_data);
					$this->load->view('ajax_view',$data);
	}

	public function delete_confirm($id)
	{
		$res=$this->modelbasic->_delete('exam_master',$id);
		$this->modelbasic-> _delete_with_condition('exam_group_relation','exam_id',$id);
		$this->modelbasic-> _delete_with_condition('exam_user_relation','exam_id',$id);
		if($res>0)
		{
			$this->session->set_flashdata('success', 'Exam Deleted Successfully');
			redirect('manage_exams');
		}
		else
		{
			echo FALSE;
		}
	}

	public function change_status($id,$status)
	{
		$res=$this->test_model->_change_status($id,$status,'exam_master');
		if($res>0)
		{
			$this->session->set_flashdata('success', 'Exam Status Change Successfully');
			redirect('manage_exams');
		}
		else
		{
			echo FALSE;
		}
	}

	public function submit_exams()
	{
		//print_r($_POST['selectUsers']);die;

		$starttime = $this->input->post('start_date',TRUE);
		$endtime = $this->input->post('end_date',TRUE);
		$tz_from = 'Asia/Kolkata';
		$tz_to = 'UTC';
		$format = 'Y-m-d H:i:s';

		$start_dt = new DateTime($starttime, new DateTimeZone($tz_from));
		$start_dt->setTimeZone(new DateTimeZone($tz_to));
		$startdate=$start_dt->format($format);
		$end_dt = new DateTime($endtime, new DateTimeZone($tz_from));
		$end_dt->setTimeZone(new DateTimeZone($tz_to));
		$enddate=$end_dt->format($format);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('exam_name','Exam Name','trim|required');
		$this->form_validation->set_rules('completion_message','Completion Message','trim|required');
		$this->form_validation->set_rules('start_date','Start Date','trim|required');
		$this->form_validation->set_rules('end_date','End Date','trim|required');
		$this->form_validation->set_rules('duration','Duration','trim|required');
		$this->form_validation->set_rules('security','Security','trim|required');
		$this->form_validation->set_rules('quiz_id','Quiz Name','trim|required');
		$this->form_validation->set_rules('show_results','Show Result','trim|required');
		//$this->form_validation->set_rules('show_levels','Show Level','trim|required');
		$this->form_validation->set_rules('result_dependancy','Result depandancy','trim|required');
		if ($this->form_validation->run())
		{
			$id=$this->input->post('id',TRUE);
			if($id !='')
			{

				$dLevel = 0;
				$data['show_levels']=$dLevel;
				if($data['show_levels']==1){
					$data=array('exam_name'=>$this->input->post('exam_name',TRUE),
								'tenant_id'=>$this->session->userdata('tenant_id'),
								'completion_message'=>$this->input->post('completion_message',TRUE),
								'start_date'=>$startdate,
								'end_date'=>$enddate,'duration'=>$this->input->post('duration',TRUE),
								'security'=>$this->input->post('security',TRUE),
								'show_results'=>$this->input->post('show_results',TRUE),
								'show_review_ans'=>$this->input->post('show_review_ans',TRUE),
								'show_levels'=>$dLevel,
								'quiz_id'=>$this->input->post('quiz_id',TRUE),
								'levelrange'=>$this->input->post('levelrange',TRUE),
								'user_level_id' => $this->input->post('select_user_level',TRUE),
								'retry_attempt_flag' => $this->input->post('retry',TRUE),
								'retry_attempt' => $this->input->post('select_retry_attempts',TRUE)

							);

							}else{
								$data=array('exam_name'=>$this->input->post('exam_name',TRUE),
									'tenant_id'=>$this->session->userdata('tenant_id'),
									'completion_message'=>$this->input->post('completion_message',TRUE),
									'start_date'=>$startdate,
									'end_date'=>$enddate,'duration'=>$this->input->post('duration',TRUE),
									'security'=>$this->input->post('security',TRUE),
									'show_results'=>$this->input->post('show_results',TRUE),
									'show_review_ans'=>$this->input->post('show_review_ans',TRUE),
									'show_levels'=>$dLevel,
									'quiz_id'=>$this->input->post('quiz_id',TRUE),
									'levelrange'=>0,
									'user_level_id' => $this->input->post('select_user_level',TRUE),
									'retry_attempt_flag' => $this->input->post('retry',TRUE),
									'retry_attempt' => $this->input->post('select_retry_attempts',TRUE)
								);
							}


				// echo "<pre/>"; print_r($data); die;
				$res=$this->modelbasic->_update('exam_master',$id,$data);

				$newExamAssignedUserList=$this->test_model->newExamAssignedUserList($id);
				$currentlyAssignedUsers=$this->test_model->currentlyAssignedUsers($id);
				$delete_res_user=$this->test_model->delete_exam_user_relation($id);

				if(!empty($_POST['selectUsers']))
				{
					foreach ($_POST['selectUsers'] as $user_id) {
						$data=array('user_id'=>$user_id,'exam_id'=>$id);
						$exam_users=$this->modelbasic->_insert('exam_user_relation',$data);
						$randomString = random_string('alnum', 10);
						$check_rand_string=$this->modelbasic->getSelectedData('users','id',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
						if($check_rand_string=='')
						{
							$res=$this->modelbasic->_update('users',$user_id,array('verification_key'=>$randomString));
							$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$user_id,$id,$randomString);
						}
						else
						{
							for($i=0;$i<100;$i++)
					       	{
					       		$randomString = random_string('alnum', 10);
										$check_rand_string=$this->modelbasic->getSelectedData('users','*',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
										if($check_rand_string=='')
   									{
   									$res=$this->modelbasic->_update('users',$user_id,array('verification_key'=>$randomString));
   									$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$user_id,$id,$randomString);
   									break;
   									}
					       	}
						}
					}
				}

				/************** Start: Code for bulk user assign the exam. Date: 28/11/2019**************/

				if(isset($_FILES['csvfile']) && $_FILES['csvfile']['size'] != 0)
				{
					$folderName = $this->session->userdata('tenant_id');
					$upload_path=file_upload_absolute_path().$folderName.'/';
					//echo $upload_path;die;
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					$upload_path.='csv/';
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					$config['upload_path'] = $upload_path;
					$config['allowed_types'] ='csv';
					$this->upload->initialize($config);
					if($this->upload->do_upload('csvfile'))
					{
						$xls_file=$this->upload->data();
						$file = '../uploads/'.$folderName.'/csv/'.$xls_file['file_name'];
						$this->load->library('csvimport');
						$handle = fopen($file, "r");
						$data = fgetcsv($handle, 1000, ",");
						$all_data=array();
						while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
						{
					    	$all_data[]=$data;
						}
				     	$productCount=0;
				     	$i=1;
				     	$error='';
				     	if(!empty($all_data))
				     	{
				     		foreach($all_data as $key => $val)
				     		{
				     			$email = array('email_id'=>$val[1],'tenant_id'=>$this->session->userdata('tenant_id'));
				     			$emailExist=$this->modelbasic->getAllWhere('users','*',$email);
				     			if(empty($emailExist))
				     			{
					     			if(!empty($val[0]) && !empty($val[1]))
					     			{
					     				if($val[7]=='')
					     				{
					     					$groupName='general';
					     				}
					     				else
					     				{
					     					$groupName=$val[7];
					     				}
					     				$check_group = array('group_name'=>$groupName,'tenant_id'=>$folderName);
					     				$groupExist=$this->modelbasic->getSelectedData('manage_groups','*',$check_group,'','','','','','row_array');

					     				if(!empty($groupExist))
					     				{
					     					$groupId=$groupExist['id'];
					     				}
					     				else
					     				{
					     					$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'group_name'=>$groupName,'created'=>date('Y-m-d H:i:s'));
					     					$groupId=$this->modelbasic->_insert('manage_groups',$data);
					     				}
					     				$timezone='Asia/Kolkata';
					     				if($this->session->userdata('time_zone')!='')
					     				{
					     				    $timezone=$this->session->userdata('time_zone');
					     				}
					     				// $password = random_string('alnum', 10);
					     				$password = "Test123";
					     				$user_info=array('tenant_id'=>$this->session->userdata('tenant_id'),'name'=>$val[0],'email_id'=>$val[1],'address'=>$val[2],'age'=>$val[3],'institute_name'=>$val[4],'created'=>date('Y-m-d H:i:s'),'status'=>1,'academic_year'=>$val[6],'principal_name'=>$val[5],'password'=>md5($password),'group_id'=>$groupId,'timezone'=>$timezone,'reset_password' =>'1','is_profile_completed' => '1');

					     			 	$res1=$this->modelbasic->_insert('users',$user_info);
					     			 	 if($val[3]!='' && $val[0]!='' && $val[2]!='' && $val[4]!='' && $val[6]!='' && $val[5]!='')
				     			 		 {
				     			 		 	$this->db->where('id', $res1);
				     			 		 	$this->db->update('users',array('is_profile_completed'=> 1 ));
				     			 		 }
					     			 	$tenantUrl=$this->modelbasic->getValue('tenant','url',array('id'=>$this->session->userdata('tenant_id')));

					     			 	$data=array('user_id'=>$res1,'exam_id'=>$id);
										$exam_users=$this->modelbasic->_insert('exam_user_relation',$data);
										$randomString = random_string('alnum', 10);
										$check_rand_string=$this->modelbasic->getSelectedData('users','id',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
										if($check_rand_string=='')
										{
											$res=$this->modelbasic->_update('users',$res1,array('verification_key'=>$randomString));
											$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$res1,$id,$randomString);
										}
										else
										{
											for($i=0;$i<100;$i++)
									       	{
									       		$randomString = random_string('alnum', 10);
														$check_rand_string=$this->modelbasic->getSelectedData('users','*',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
													if($check_rand_string=='')
				   									{
				   									$res=$this->modelbasic->_update('users',$res1,array('verification_key'=>$randomString));
				   									$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$res1,$id,$randomString);
				   									break;
				   									}
									       	}
										}
					     				if($res>0)
					     				{


					     					$tenantInfo=$this->modelbasic->getValues('tenant','*',array('id'=>$this->session->userdata('tenant_id')),'row_array');
					     					$emaildata=$this->test_model->getValEmailTemp('manage_email_template','*',array('id'=>3,'tenant_id'=>$tenantInfo['id']));
					     					//print_r($tenantInfo);die;
					     					$msg=$emaildata['email_contains'];
					     					$msg=str_replace('{logo_link}','<img src="'.front_base_url().'uploads/'.$tenantInfo['id'].'/logo/thumbs/'.$tenantInfo['logo'].'" alt="logo" />', $msg);

					     					$msg=str_replace('{user_name}',$val[0], $msg);
					     					$msg=str_replace('{regards}',$tenantInfo['name'], $msg);
					     					$msg=str_replace('{email}',$val[1], $msg);
					     					$msg=str_replace('{password}',$password, $msg);
					     					$msg=str_replace('{link}','<a href="'.front_base_url().'quiz/'.$tenantInfo['url'].'"> Log In </a>', $msg);

					     					$emailData=array('to'=>$val[1],'fromEmail'=>'nileshanandinfo@gmail.com','subject'=>$emaildata['subject'],'template'=>$msg);
					     					$data['result']=$this->test_model->get_all_settings();
					     					//$result=$this->modelbasic->sendMail($emailData);
					     					$this->session->set_flashdata('success', 'New Users added successfully.');
					     				}
					     		 		$productCount++;
					     			}
					     			else
					     			{
					     				if($val[0] =='')
					     				{
					     					$error .= "On line no. ".$i." Name is required.<br/>";
					     				}
					     				if($val[2] =='')
					     				{
					     					$error .= "On line no. ".$i." Email Id is required.<br/>";
					     				}
					     			}
								}
								else
								{
									$error .= "On line no. ".($i-1)." ".$val[1] ." is Present.<br/>";

									foreach ($emailExist as $emailExistkey => $emailExistvalue) 
									{
										$usr_id = $emailExistvalue['id'];
										$data=array('user_id'=>$usr_id,'exam_id'=>$id);
										$exam_users=$this->modelbasic->_insert('exam_user_relation',$data);
										$randomString = random_string('alnum', 10);
										$check_rand_string=$this->modelbasic->getSelectedData('users','id',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
										if($check_rand_string=='')
										{
											$res=$this->modelbasic->_update('users',$usr_id,array('verification_key'=>$randomString));
											$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$usr_id,$id,$randomString);
										}
										else
										{
											for($i=0;$i<100;$i++)
									       	{
									       		$randomString = random_string('alnum', 10);
														$check_rand_string=$this->modelbasic->getSelectedData('users','*',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
													if($check_rand_string=='')
				   									{
				   									$res=$this->modelbasic->_update('users',$usr_id,array('verification_key'=>$randomString));
				   									$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$usr_id,$id,$randomString);
				   									break;
				   									}
									       	}
										}
									}
								}
				     		   $i++;
				     		}
				     	}
					}
					else
					{
						 $upload_error=$this->upload->display_errors();
						 $this->session->set_flashdata('error',$upload_error);
						 redirect('users','refresh');
					}
				}

				/************** End: Code for bulk user assign the exam. Date: 28/11/2019**************/

				$delete_res_group=$this->test_model->delete_exam_group_relation($id);
				if(!empty($_POST['selectGroups']))
				{
					foreach ($_POST['selectGroups'] as $group_id) {
						$data=array('group_id'=>$group_id,'exam_id'=>$id);
						$exam_users=$this->modelbasic->_insert('exam_group_relation',$data);
						$select_group_users=$this->modelbasic->getAllWhere('users','id',array('group_id'=>$group_id));
						if(!empty($select_group_users))
						{
							foreach ($select_group_users as $value)
							{
								//print_r($value);die;
								$randomString = random_string('alnum', 10);
								$check_rand_string=$this->modelbasic->getSelectedData('users','id',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
								if($check_rand_string=='')
								{
								$res=$this->modelbasic->_update('users',$value['id'],array('verification_key'=>$randomString));
								$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$value['id'],$id,$randomString);
								}
								else
								{
									for($i=0;$i<100;$i++)
							       	{
							       		$randomString = random_string('alnum', 10);
   										$check_rand_string=$this->modelbasic->getSelectedData('users','*',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
   										if($check_rand_string=='')
       									{
       									$res=$this->modelbasic->_update('users',$value['id'],array('verification_key'=>$randomString));
       									$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$value['id'],$id,$randomString);
       									break;
       									}
							       	}
								}
							}
						}
					}
				}

				$assignedUsers=array();
				if(!empty($currentlyAssignedUsers))
				{
					foreach ($currentlyAssignedUsers as $current)
					{
						$assignedUsers[]=$current['id'];
					}
				}

				if(!empty($newExamAssignedUserList))
				{
					foreach ($newExamAssignedUserList as $userData)
					{
						if(!in_array($userData,$assignedUsers))
						{
							$Users_email=$this->test_model->send_mail_to_user_exam($id,$userData);
							$tenantInfo=$this->modelbasic->getValues('tenant','*',array('id'=>$this->session->userdata('tenant_id')),'row_array');
							$emaildata=$this->test_model->getValEmailTemp('manage_email_template','*',array('id'=>5,'tenant_id'=>$tenantInfo['id']));
							$msg=$emaildata['email_contains'];
							$msg=str_replace('{logo_link}','<img src="'.front_base_url().'uploads/'.$tenantInfo['id'].'/logo/thumbs/'.$tenantInfo['logo'].'" alt="logo" />', $msg);

							$msg=str_replace('{user_name}',$Users_email['name'], $msg);
							$msg=str_replace('{regards}',$tenantInfo['name'], $msg);

							$msg=str_replace('{link}','<a href="'.front_base_url().'quiz/'.$tenantInfo['url'].'"> Click Here </a>', $msg);
							$msg=str_replace('{exam_name}',$Users_email['exam_name'], $msg);
							$emailData=array('to'=>$Users_email['email_id'],'fromEmail'=>'trainocate@domain.co.in','subject'=>$emaildata['subject'],'template'=>$msg);
							$data['result']=$this->test_model->get_all_settings();
							//$result=$this->modelbasic->sendMail($emailData);
						}
					}
				}
				$data=array('status'=>'success','message'=>'Exam updated successfully.');
				$data['ajax']=json_encode($data);
				$this->load->view('ajax_view',$data);
			}
			else
			{
				$dLevel = 0;
				$data['show_levels']=$dLevel;
				if($data['show_levels']==1){

				$data=array('exam_name'=>$this->input->post('exam_name',TRUE),'tenant_id'=>$this->session->userdata('tenant_id'),'completion_message'=>$this->input->post('completion_message',TRUE),'start_date'=>$startdate,'end_date'=>$enddate,'duration'=>$this->input->post('duration',TRUE),'security'=>$this->input->post('security',TRUE),'show_results'=>$this->input->post('show_results',TRUE),'show_levels'=>$dLevel,'quiz_id'=>$this->input->post('quiz_id',TRUE),'result_dependancy'=>$this->input->post('result_dependancy',TRUE),'levelrange'=>$this->input->post('levelrange'), 'user_level_id' => $this->input->post('select_user_level',TRUE),'retry_attempt_flag' => $this->input->post('retry',TRUE),'retry_attempt' => $this->input->post('select_retry_attempts',TRUE));
				}
				else{
					$data=array('exam_name'=>$this->input->post('exam_name',TRUE),'tenant_id'=>$this->session->userdata('tenant_id'),'completion_message'=>$this->input->post('completion_message',TRUE),'start_date'=>$startdate,'end_date'=>$enddate,'duration'=>$this->input->post('duration',TRUE),'security'=>$this->input->post('security',TRUE),'show_results'=>$this->input->post('show_results',TRUE),'show_levels'=>$dLevel,'quiz_id'=>$this->input->post('quiz_id',TRUE),'result_dependancy'=>$this->input->post('result_dependancy',TRUE),'levelrange'=>0, 'user_level_id' => $this->input->post('select_user_level',TRUE),'retry_attempt_flag' => $this->input->post('retry',TRUE),'retry_attempt' => $this->input->post('select_retry_attempts',TRUE));


				}
				$exam_id=$this->modelbasic->_insert('exam_master',$data);

				if(!empty($_POST['selectUsers']))
				{
					foreach ($_POST['selectUsers'] as $user_id)
					{
						$data=array('user_id'=>$user_id,'exam_id'=>$exam_id);
						$exam_users=$this->modelbasic->_insert('exam_user_relation',$data);
						$randomString = random_string('alnum', 10);
						$check_rand_string=$this->modelbasic->getSelectedData('users','id',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
						if($check_rand_string=='')
						{
							$res=$this->modelbasic->_update('users',$user_id,array('verification_key'=>$randomString));
							$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$user_id,$exam_id,$randomString);
						}
						else
						{
							for($i=0;$i<100;$i++)
						       	{
						       		$randomString = random_string('alnum', 10);
								$check_rand_string=$this->modelbasic->getSelectedData('users','*',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
								if($check_rand_string=='')
								{
									$res=$this->modelbasic->_update('users',$user_id,array('verification_key'=>$randomString));
									$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$user_id,$exam_id,$randomString);
									break;
								}
						       	}
						}
					}
				}

				/************** Start: Code for bulk user assign the exam. Date: 28/11/2019**************/

				if(isset($_FILES['csvfile']) && $_FILES['csvfile']['size'] != 0)
				{
					$folderName = $this->session->userdata('tenant_id');
					$upload_path=file_upload_absolute_path().$folderName.'/';
					//echo $upload_path;die;
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					$upload_path.='csv/';
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					$config['upload_path'] = $upload_path;
					$config['allowed_types'] ='csv';
					$this->upload->initialize($config);
					if($this->upload->do_upload('csvfile'))
					{
						$xls_file=$this->upload->data();
						$file = '../uploads/'.$folderName.'/csv/'.$xls_file['file_name'];
						$this->load->library('csvimport');
						$handle = fopen($file, "r");
						$data = fgetcsv($handle, 1000, ",");
						$all_data=array();
						while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
						{
					    	$all_data[]=$data;
						}
				     	$productCount=0;
				     	$i=1;
				     	$error='';
				     	if(!empty($all_data))
				     	{	
				     		foreach($all_data as $key => $val)
				     		{
				     			$email = array('email_id'=>$val[1],'tenant_id'=>$this->session->userdata('tenant_id'));
				     			$emailExist=$this->modelbasic->getAllWhere('users','*',$email);
				     			if(empty($emailExist))
				     			{
					     			if(!empty($val[0]) && !empty($val[1]))
					     			{
					     				if($val[7]=='')
					     				{
					     					$groupName='general';
					     				}
					     				else
					     				{
					     					$groupName=$val[7];
					     				}
					     				$check_group = array('group_name'=>$groupName,'tenant_id'=>$folderName);
					     				$groupExist=$this->modelbasic->getSelectedData('manage_groups','*',$check_group,'','','','','','row_array');

					     				if(!empty($groupExist))
					     				{
					     					$groupId=$groupExist['id'];
					     				}
					     				else
					     				{
					     					$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'group_name'=>$groupName,'created'=>date('Y-m-d H:i:s'));
					     					$groupId=$this->modelbasic->_insert('manage_groups',$data);
					     				}
					     				$timezone='Asia/Kolkata';
					     				if($this->session->userdata('time_zone')!='')
					     				{
					     				    $timezone=$this->session->userdata('time_zone');
					     				}
					     				// $password = random_string('alnum', 10);
					     				$password = "Test123";
					     				$user_info=array('tenant_id'=>$this->session->userdata('tenant_id'),'name'=>$val[0],'email_id'=>$val[1],'address'=>$val[2],'age'=>$val[3],'institute_name'=>$val[4],'created'=>date('Y-m-d H:i:s'),'status'=>1,'academic_year'=>$val[6],'principal_name'=>$val[5],'password'=>md5($password),'group_id'=>$groupId,'timezone'=>$timezone,'reset_password' =>'1','is_profile_completed' => '1');

					     			 	$res1=$this->modelbasic->_insert('users',$user_info);
					     			 	 if($val[3]!='' && $val[0]!='' && $val[2]!='' && $val[4]!='' && $val[6]!='' && $val[5]!='')
				     			 		 {
				     			 		 	$this->db->where('id', $res1);
				     			 		 	$this->db->update('users',array('is_profile_completed'=> 1 ));
				     			 		 }
					     			 	$tenantUrl=$this->modelbasic->getValue('tenant','url',array('id'=>$this->session->userdata('tenant_id')));

					     			 	$data=array('user_id'=>$res1,'exam_id'=>$exam_id);
										$exam_users=$this->modelbasic->_insert('exam_user_relation',$data);
										$randomString = random_string('alnum', 10);
										$check_rand_string=$this->modelbasic->getSelectedData('users','id',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
										if($check_rand_string=='')
										{
											$res=$this->modelbasic->_update('users',$res1,array('verification_key'=>$randomString));
											$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$res1,$exam_id,$randomString);
										}
										else
										{
											for($i=0;$i<100;$i++)
									       	{
									       		$randomString = random_string('alnum', 10);
														$check_rand_string=$this->modelbasic->getSelectedData('users','*',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
													if($check_rand_string=='')
				   									{
				   									$res=$this->modelbasic->_update('users',$res1,array('verification_key'=>$randomString));
				   									$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$res1,$exam_id,$randomString);
				   									break;
				   									}
									       	}
										}
					     				if($res>0)
					     				{


					     					$tenantInfo=$this->modelbasic->getValues('tenant','*',array('id'=>$this->session->userdata('tenant_id')),'row_array');
					     					$emaildata=$this->test_model->getValEmailTemp('manage_email_template','*',array('id'=>3,'tenant_id'=>$tenantInfo['id']));
					     					//print_r($tenantInfo);die;
					     					$msg=$emaildata['email_contains'];
					     					$msg=str_replace('{logo_link}','<img src="'.front_base_url().'uploads/'.$tenantInfo['id'].'/logo/thumbs/'.$tenantInfo['logo'].'" alt="logo" />', $msg);

					     					$msg=str_replace('{user_name}',$val[0], $msg);
					     					$msg=str_replace('{regards}',$tenantInfo['name'], $msg);
					     					$msg=str_replace('{email}',$val[1], $msg);
					     					$msg=str_replace('{password}',$password, $msg);
					     					$msg=str_replace('{link}','<a href="'.front_base_url().'quiz/'.$tenantInfo['url'].'"> Log In </a>', $msg);

					     					$emailData=array('to'=>$val[1],'fromEmail'=>'nileshanandinfo@gmail.com','subject'=>$emaildata['subject'],'template'=>$msg);
					     					$data['result']=$this->test_model->get_all_settings();
					     					//$result=$this->modelbasic->sendMail($emailData);
					     					$this->session->set_flashdata('success', 'New Users added successfully.');
					     				}
					     		 		$productCount++;
					     			}
					     			else
					     			{
					     				if($val[0] =='')
					     				{
					     					$error .= "On line no. ".$i." Name is required.<br/>";
					     				}
					     				if($val[2] =='')
					     				{
					     					$error .= "On line no. ".$i." Email Id is required.<br/>";
					     				}
					     			}
								}
								else
								{
									$error .= "On line no. ".($i-1)." ".$val[1] ." is Present.<br/>";

									foreach ($emailExist as $emailExistkey => $emailExistvalue) 
									{
										$usr_id = $emailExistvalue['id'];
										$data=array('user_id'=>$usr_id,'exam_id'=>$exam_id);
										$exam_users=$this->modelbasic->_insert('exam_user_relation',$data);
										$randomString = random_string('alnum', 10);
										$check_rand_string=$this->modelbasic->getSelectedData('users','id',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
										if($check_rand_string=='')
										{
											$res=$this->modelbasic->_update('users',$usr_id,array('verification_key'=>$randomString));
											$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$usr_id,$exam_id,$randomString);
										}
										else
										{
											for($i=0;$i<100;$i++)
									       	{
									       		$randomString = random_string('alnum', 10);
														$check_rand_string=$this->modelbasic->getSelectedData('users','*',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
													if($check_rand_string=='')
				   									{
				   									$res=$this->modelbasic->_update('users',$usr_id,array('verification_key'=>$randomString));
				   									$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$usr_id,$exam_id,$randomString);
				   									break;
				   									}
									       	}
										}
									}
								}
				     		   $i++;
				     		}
				     	}
					}
					else
					{
						 $upload_error=$this->upload->display_errors();
						 $this->session->set_flashdata('error',$upload_error);
						 redirect('users','refresh');
					}
				}

				/************** End: Code for bulk user assign the exam. Date: 28/11/2019**************/

				if(!empty($_POST['selectGroups']))
				{
					$delete_res_group=$this->test_model->delete_exam_group_relation($id);
					foreach ($_POST['selectGroups'] as $group_id)
					{
						$data=array('group_id'=>$group_id,'exam_id'=>$exam_id);
						$exam_users=$this->modelbasic->_insert('exam_group_relation',$data);
						$select_group_users=$this->modelbasic->getAllWhere('users','id',array('group_id'=>$group_id));
						if(!empty($select_group_users))
						{
							foreach ($select_group_users as $value)
							{
								$randomString = random_string('alnum', 10);
								$check_rand_string=$this->modelbasic->getSelectedData('users','id',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
								if($check_rand_string=='')
								{
								$res=$this->modelbasic->_update('users',$value['id'],array('verification_key'=>$randomString));
								$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$value['id'],$exam_id,$randomString);
								}
								else
								{
									for($i=0;$i<100;$i++)
							       	{
							       		$randomString = random_string('alnum', 10);
	 										$check_rand_string=$this->modelbasic->getSelectedData('users','*',array('verification_key'=>$randomString,'tenant_id'=>$this->session->userdata('tenant_id')),'','','','','','row_array');
	 										if($check_rand_string=='')
	     									{
	     									$res=$this->modelbasic->_update('users',$value['id'],array('verification_key'=>$randomString));
	     									$this->test_model->update_verification_key($this->session->userdata('tenant_id'),$value['id'],$exam_id,$randomString);
	     									break;
	     									}
							       	}
								}
							}
						}
					}
				}

				$selectUsersForSendMail=$this->test_model->send_mail_to_user_examAdd($exam_id);
				//pr($selectUsersForSendMail);
				if(!empty($selectUsersForSendMail))
				{
					foreach ($selectUsersForSendMail as $Users_email) {
						/*$data['fromEmail']='trainocate@domain.co.in';
						$data['to']=$Users_email['email_id'];
						$data['subject']='New Exam Assigned';
						$data['template']='Hello '.$Users_email['name'].',<br/>New Exam Has Been Assigned To You- <br/> Exam Name- '.$Users_email['exam_name'].'<br/>Click following link to check exam detail.<br/><a href="'.front_base_url().'quiz/index/'.$this->input->post('quiz_id').'/'.$exam_id.'">'.front_base_url().'quiz/index/'.$this->input->post('quiz_id').'/'.$exam_id.'</a><br/></br></br>Thanks & Regards<br/> Quiz Admin';
						$result=$this->modelbasic->sendMail($data);*/

						$tenantInfo=$this->modelbasic->getValues('tenant','*',array('id'=>$this->session->userdata('tenant_id')),'row_array');
						$emaildata=$this->test_model->getValEmailTemp('manage_email_template','*',array('id'=>5,'tenant_id'=>$tenantInfo['id']));
						//print_r($tenantInfo);die;
						$msg=$emaildata['email_contains'];
						$msg=str_replace('{logo_link}','<img src="'.front_base_url().'uploads/'.$tenantInfo['id'].'/logo/thumbs/'.$tenantInfo['logo'].'" alt="logo" />', $msg);

						$msg=str_replace('{user_name}',$Users_email['name'], $msg);
						$msg=str_replace('{regards}',$tenantInfo['name'], $msg);
						//$msg=str_replace('{link}','<a href="'.front_base_url().'quiz/index/'.$this->input->post('quiz_id').'/'.$exam_id.'"> Log In </a>', $msg);
						$msg=str_replace('{link}','<a href="'.front_base_url().'quiz/'.$tenantInfo['url'].'"> Click Here </a>', $msg);

						$msg=str_replace('{exam_name}',$Users_email['exam_name'], $msg);

						//echo $msg;die;

						$emailData=array('to'=>$Users_email['email_id'],'fromEmail'=>'trainocate@domain.co.in','subject'=>$emaildata['subject'],'template'=>$msg);
						$data['result']=$this->test_model->get_all_settings();
						//$result=$this->modelbasic->sendMail($emailData);

					}
				}
				$data=array('status'=>'success','message'=>'Exam created successfully.');
				$data['ajax']=json_encode($data);
				$this->load->view('ajax_view',$data);
			}
		}
		else
		{
			if($this->input->is_ajax_request())
			{
				$data['ajax']=$this->form_validation->get_json();
				$this->load->view('ajax_view',$data);
			}
		}
	}

	public function edit_exams($id)
	{
		$timezone='Asia/Kolkata';
		if($this->session->userdata('time_zone')!='')
		{
		    $timezone=$this->session->userdata('time_zone');
		}
		$tz_from = 'UTC';
		$tz_to = $timezone;
		$format = 'm/d/Y h:i a';

		$res = array('id'=>$id );
		//$data=$this->modelbasic->getAllWhere('exam_master','*',$res);
		$data=$this->modelbasic->getSelectedData('exam_master','*',$res,'','','','','','row_array');		//print_r($data);die;


		$start = new DateTime($data['start_date'], new DateTimeZone($tz_from));
		$start->setTimeZone(new DateTimeZone($tz_to));
		$data['start_date']=$start->format($format);

		$end = new DateTime($data['end_date'], new DateTimeZone($tz_from));
		$end->setTimeZone(new DateTimeZone($tz_to));
		$data['end_date']=$end->format($format);
	/*	$data['start_date']=date('m/d/Y h:i a',strtotime($data['start_date']));
		$data['end_date']=date('m/d/Y h:i a',strtotime($data['end_date']));*/
		$group=$this->test_model->get_Group($data['id']);
		$user=$this->test_model->get_User($data['id']);
		//print_r($group);die;
		if(!empty($group))
		{
			$data['selectGroups']=array();
			foreach ($group as $group_name)
			{
				$data['selectGroups'][]= $group_name['group_id'];
			}
		}
		if(!empty($user))
		{
			$data['selectUsers']=array();
			foreach ($user as $user_name)
			{
				$data['selectUsers'][]= $user_name['user_id'];
			}
		}


		$data['ajax']=json_encode($data);
		$this->load->view('ajax_view',$data);
	}

	function multiselect_action()
		{
			if(isset($_POST['submit']))
			{
				$check = $_POST['checkall'];
				foreach($check as $key => $value)
				{
					if($_POST['listaction'] == '1')
					{
						$status = array('status'=>'1');
						$this->modelbasic->_update('exam_master',$key,$status);
						$this->session->set_flashdata('success', 'Exams activated successfully');
					}
					elseif($_POST['listaction'] == '2')
					{
							$status = array('status'=>'0');
							$this->modelbasic->_update('exam_master',$key,$status);
							$this->session->set_flashdata('success', 'Exams deactivated successfully');
					}
					elseif($_POST['listaction'] == '3'){
						$this->modelbasic->_delete('exam_master',$key);
						$this->modelbasic-> _delete_with_condition('exam_group_relation','exam_id',$key);
						$this->modelbasic-> _delete_with_condition('exam_user_relation','exam_id',$key);
						$this->session->set_flashdata('success', 'Exams deleted successfully');
					}
				}
				redirect('manage_exams');
			}
		}

	public function export_csv_users_key($exam_id)
	{
		//echo 'hiii csv';die;
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		$delimiter = ",";
		$newline = "\r\n";
		$filename = "users_verification_key_".date("d-M-Y_h_i_sa").".csv";
		$fullPath = "../downloads/csv/users/users_key".date("d-M-Y_h_i_sa").".csv";
		$query=$this->test_model->getExportQuery($exam_id);
		//print_r($query);die;
		$result = $this->db->query($query);
		$data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
		if ( ! write_file($fullPath, $data))
		{
		     echo 'Unable to write the file';
		}
		else
		{
		     force_download($filename, $data);
		     redirect('manage_exams');
		}
	}
	public function generatepdf()
						{
							$tz_from = 'UTC';
							$tz_to = 'Asia/Kolkata';
							$format = 'd M Y';

							$tenant_id=$this->session->userdata('tenant_id');
							//echo $tenant_id;die;
							$newDownloaPath=str_replace('\admin','',FCPATH);
						//	echo $newDownloaPath;die;

							$pdf_data=$this->test_model->get_userinfo_for_generate_pdf($tenant_id);
						//print_r($pdf_data);die;
							foreach ($pdf_data as $val)
							{
								$start = new DateTime($val['start_date'], new DateTimeZone($tz_from));
								$start->setTimeZone(new DateTimeZone($tz_to));
								$start_date=$start->format($format);

								$end= new DateTime($val['end_date'], new DateTimeZone($tz_from));
								$end->setTimeZone(new DateTimeZone($tz_to));
								$end_date=$end->format($format);
								$section_name=$this->test_model->get_section_name($val['quiz_id'],$tenant_id);
	//print_r($section_name);die;
							$this->load->library("Pdf");
							$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
							// set document information
				            // set margins
							$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
							$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
							$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

							// set auto page breaks
							$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

							// set image scale factor
							$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
							$pdf->SetFooterMargin(10);
							// remove default footer
							$pdf->setPrintFooter(false);
							// ---------------------------------------------------------
							// set font
							$pdf->AddPage();

							// -- set new background ---
							// get the current page break margin
							$bMargin = $pdf->getBreakMargin();
							// get current auto-page-break mode
							$auto_page_break = $pdf->getAutoPageBreak();
							// disable auto-page-break
							$pdf->SetAutoPageBreak(false, 0);
							// set bacground image
							$img_file = K_PATH_IMAGES.'certificate.png';
							$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);


							// restore auto-page-break status
							$pdf->SetAutoPageBreak($auto_page_break, $bMargin);


							// set the starting point for the page content
							$pdf->setPageMark();



				           //left logo..................//
							$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
							  $img_file =$newDownloaPath.'uploads/'.$tenant_id.'/logo/'.$val["logo"];
				            $pdf->Image($img_file, 18, 5, 15, 15, 'PNG');

				            // right logo..................//
				            $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
							  $img_file =$newDownloaPath.'uploads/'.$tenant_id.'/logo/'.$val["logo"];
				            $pdf->Image($img_file, 185, 4, 15, 15, 'PNG');

				            //front logo.................
							$img_file =$newDownloaPath.'uploads/'.$tenant_id.'/logo/'.$val["logo"];

				            $pdf->Image($img_file, 90, 30, 25, 25, 'PNG');

				    /*       //Signature....................//
				            $pdf->SetMargins(0, 10, 0, true); // put space of 10 on top
				            $img_file = K_PATH_IMAGES.'tcpdf_signature.png';
				            $pdf->Image($img_file, 170, 125, 12, 12, 'PNG');
*/
				             $img_file =$newDownloaPath.'uploads/'.$tenant_id.'/logo/'.$val["logo"];
				            $pdf->Image($img_file, 170, 150,12,12, 'PNG');

				            $pdf->SetTopMargin(70);
				            $pdf->SetLeftMargin(6);

							// Print a text
							$html = '<div style="width:800px;padding:500px; text-align:center;">

						       <span style="font-size:12px;font-family:verdana">This is to certify that</span>
						       <br><br>
						       <span style="font-size:40px;font-family:script"><i><b>'.$val['name'].'</b></i></span><br/><br/>
						       <span style="font-size:11px;font-family:verdana">
						       has successfully completed the '.$val['exam_name'].' Test<br/>
				               conducted by '.$val['tenant_name'].' from '.$start_date.' to '.$end_date.'<br />
				               covering ';
				               if(!empty($section_name))
				               {
				               	foreach($section_name as $val1)
				               	{
				               	$html .=$val1['section_name'].' ';
				               	}
				               }
				               $html .='Section<br />
				               He is now  a Certified '.$val['tenant_name'].'<span>
				              <br/>

						</div>';



							$pdf->writeHTML($html, true, false, true, false, '');


				         // sign of director..................//


				            $pdf->SetLeftMargin(145);
				            $pdf->SetTopMargin(50);
							$html = '<div style="text-align:center">
							<span style="font-size:10px;font-family:verdana"><br/><br/><br/>
							Anubhav Kapoor<br/>
				            Head, General Counsel<br/>
				            Corp. Sustainability<br />
				            Tata Technologies<br />
							<span>
							</div>';
				             $pdf->writeHTML($html, true, false, true, false, '');
				             //$requestURL=explode('/',$_SERVER['REQUEST_URI']);
				             //pr($requestURL);
							//Close and output PDF document
				             ob_clean();

				      $newPdfDownloaPath=str_replace('\admin','\downloads',FCPATH);
				      //echo $newDownloaPath;die;
							$pdf->Output($newPdfDownloaPath.str_replace(' ', '_', $val['name']).'_'.str_replace(' ', '_', $val['exam_name']).'.pdf', 'F');

						//	$data['fromEmail']='test.unichronic@gmail.com';
							$data['from']='Quiz Admin';
							$data['to']=$val['email_id'];
							$data['subject']='Exam certificate';
							$data['template']='Exam certificate  : <br/> Please download Exam certificate<br/></br></br>Thanks & Regards<br/> Quiz Admin';
							$data['attachment']=$newPdfDownloaPath.str_replace(' ', '_', $val['name']).'_'.str_replace(' ', '_', $val['exam_name']).'.pdf';
						//	print_r($data);die;
							$result=$this->modelbasic->sendMailWithAttachment($data);


						}
						$this->session->set_flashdata("pdf_msg","Certificates generated successfully.");
						redirect('dashboard');
					}
			}