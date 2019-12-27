<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Tenant extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		$this->load->library('upload');

		$this->load->library('image_lib');

		$this->load->helper('imgupload');

		$this->load->library('form_validation');

		$this->load->model('test_model');

	    $this->load->helper('string');
	}

	public function index()

	{

		$data['page_name']='tenant/manage_tenant_view';
		$data['timezone1']=$this->test_model->get_timezone_data();

		$this->load->view('index',$data);

	}

	public function getAjaxdataObjects()
	{

		//requested data for search
		$timezone='Asia/Kolkata';
		if($this->session->userdata('time_zone')!='')
		{
		$timezone=$this->session->userdata('time_zone');
		}
		$tz_from = 'UTC';
		$tz_to = $timezone;
		$format = 'M d,Y H:i:s';
		$_POST['columns']='A.id,A.name,A.logo,A.header_color,A.status,A.created,A.url,B.email,B.name,A.timezone,A.signup_permission,B.contact,A.address';
		$requestData = $_REQUEST;

		$columns=explode(',',$_POST['columns']);

		//show columns list
		if($this->session->userdata('admin_level') == 2)
		{
			$condition=array('A.id'=>$this->session->userdata('tenant_id'));
		}
		else
		{
			$condition='';
		}
		$selectColumns = "A.id,A.name,A.logo,A.header_color,A.status,A.created,A.url,B.email,B.name as admin_name,A.timezone,A.signup_permission,B.contact,A.address";
		//get total number of data without any condition and search term

		$totalData=$this->modelbasic->count_all_only('tenant as A',$condition);

		$totalFiltered=$totalData;
		$data_array=array(array('admin as B','A.id=B.tenant_id'));
		//pass concatColumns only if you want search field to be fetch from concat
		$result=$this->modelbasic->run_query('tenant as A',$requestData,$columns,$selectColumns,'','',$condition,$data_array);
		//echo $this->db->last_query();die;
		//$result=$this->test_model->get_all_tenant();
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

				switch ($row["status"])

				{

					case 1 : $status='<span class="label label-success" onclick="change_status('.$row["id"].',1)" data-toggle="modal" style="cursor: pointer;">Active</span>'; break;

					case 0 : $status='<span class="label label-danger" onclick="change_status('.$row["id"].',0)" data-toggle="modal" style="cursor: pointer;">Deactive</span>'; break;

					default : $status=''; break;

				}

				$nestedData['chk'] = '<div class="vd_checkbox checkbox-success"><input type="checkbox" class="case" id="check-'.$row["id"].'" name="checkall['.$row["id"].']" data-index="'.$row["id"].'"><label for="check-'.$row["id"].'"> </label></div>';

				$nestedData['id'] =$row["id"];

				if($row["logo"]!='')

				{

					$filename='../uploads/'.$row["id"].'/logo/'.$row["logo"];
					if (file_exists($filename))
					{
						$img='<img class="width-30" src="'.front_base_url().'uploads/'.$row["id"].'/logo/thumbs/'.$row["logo"].'">';
					}
					else
					{
						$img='<img class="width-30" src="'.front_base_url().'assets/img/notavilable.jpg">';
					}
				}

				else

				{
					$img='<img class="width-30" src="'.front_base_url().'assets/img/u.png">';
				}

				$nestedData['info'] = '<a href='.base_url().'tenant><div class="menu-icon">'.$img.'</div></a><div style="text-align:center;"><b>Tenant Name:</b> '.ucwords($row["name"]).'<br/></div>';

				$nestedData['status'] =$status;

				$nestedData['header_color'] =$row["header_color"];
				$nestedData['email'] =$row["email"];
				$nestedData['admin_name'] =$row["admin_name"];
				$nestedData['url'] =$row["url"];
				$nestedData['timezone'] =$row["timezone"];
				$nestedData['contact'] =$row["contact"];
				$nestedData['address'] =$row["address"];
				$nestedData['signup_permission'] =($row["signup_permission"])?'Yes':'No';
				$start = new DateTime($row["created"], new DateTimeZone($tz_from));
				$start->setTimeZone(new DateTimeZone($tz_to));
				$created=$start->format($format);

				/*$createdDateVal = new DateTime($row["created"], new DateTimeZone('GMT') );

				$createdDateVal->setTimeZone(new DateTimeZone($this->session->userdata('timezone')));*/

				$nestedData['created'] =$created;

				$nestedData['action'] = '<div class="menu-action">
							<a onclick="edit_tenant('.$row['id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>
							<a onclick="delete_confirm('.$row['id'].');" class="btn menu-icon vd_bd-red vd_red" data-placement="top" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-times"></i> </a></div>';
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
			$data['ajax']=json_encode($json_data);
			$this->load->view('ajax_view',$data);
		}

		public function delete_confirm($id)
		{
			if($id != 1)
			{
				$sessionid=$this->session->userdata('tenant_id');
				if($sessionid != $id)
				{
					//
					$condition = array('tenant_id'=>$id);
					$res=$this->modelbasic->_delete_with_conditions('contact_us',$condition);
					$res=$this->modelbasic->_delete_with_conditions('exam_master',$condition);
					$res=$this->modelbasic->_delete_with_conditions('manage_banner',$condition);
					$res=$this->modelbasic->_delete_with_conditions('manage_groups',$condition);
					$res=$this->modelbasic->_delete_with_conditions('question_bank',$condition);
					$res=$this->modelbasic->_delete_with_conditions('question_categories',$condition);
					$res=$this->modelbasic->_delete_with_conditions('quiz_master',$condition);
					$res=$this->modelbasic->_delete_with_conditions('quiz_section',$condition);
					$res=$this->modelbasic->_delete_with_conditions('users',$condition);
					$res=$this->modelbasic->_delete_with_conditions('admin',$condition);
					$res=$this->modelbasic->_delete_with_conditions('quiz',$condition);
					$res=$this->modelbasic->_delete_with_conditions('quiz_log',$condition);
					$res=$this->modelbasic->_delete_with_conditions('mock_log',$condition);
					$res=$this->modelbasic->_delete_with_conditions('contact_us',$condition);
					$res=$this->modelbasic->_delete_with_conditions('manage_email_template',$condition);
					$res=$this->modelbasic->_delete_with_conditions('option_master',$condition);
					$res=$this->modelbasic->_delete_with_conditions('page_details',$condition);
					$res=$this->modelbasic->_delete_with_conditions('pdf',$condition);
					$res=$this->modelbasic->_delete_with_conditions('verification_key',$condition);
					//$res=$this->modelbasic->_delete_with_conditions('tenant',$condition);
					$res=$this->modelbasic->_delete('tenant',$id);
					if($res>0)
					{
										$this->session->set_flashdata('success', 'Tenant Deleated successfully');				redirect('tenant');
					}
					else
					{
						$this->session->set_flashdata('error', 'Do not try to delete tenant user.');
										redirect('tenant');
					}
				}
				else
				{
					$this->session->set_flashdata('error', 'Do not try to delete Active tenant user.');
					redirect('tenant');
				}
			}
			else
				{
					$this->session->set_flashdata('error', 'Do not try to delete tenant user.');
					redirect('tenant');
				}
		}

		public function change_status($id,$status)
		{

			$sessionid=$this->session->userdata('tenant_id');
			if($sessionid==$id && $status=='1')
			{
				$this->session->set_flashdata('error', 'Do not try to Deactive tenant user.');
				redirect('tenant');
			}
			elseif($sessionid==$id && $status=='0')
			{
				$res=$this->test_model->_change_status($id,$status,'tenant');
				if($res>0)

				{
					$this->session->set_flashdata('success', 'Tenant Active successfully');
					redirect('tenant');
				}

				else

				{
					$this->session->set_flashdata('error', 'Error to Active tenant.');
					redirect('tenant');
				}

			}

			else

			{
				$res=$this->test_model->_change_status($id,$status,'tenant');
				if($res>0)
				{
					$this->session->set_flashdata('success', 'tenant Deactive successfully');
					redirect('tenant');
				}
				else
				{
					$this->session->set_flashdata('error', 'Error to Deactive tenant.');
									redirect('tenant');
				}
			}

		}

		public function add()
		{
			//print_r($_POST);die;

			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('name','Tenant Name','trim|required');
			//$this->form_validation->set_rules('header_color','Tenant Header Color','trim|required');
			$this->form_validation->set_rules('admin_name','Admin Name','trim|required');
			$this->form_validation->set_rules('url','URL','trim|required');
			$this->form_validation->set_rules('contact','Contact number','trim|required');
			$this->form_validation->set_rules('address','Address','trim|required');
			$this->form_validation->set_rules('email','Admin Email','trim|required|valid_email|is_unique[admin.email]');
			$this->form_validation->set_rules('time_zone','time_zone','trim|required');
			if ($this->form_validation->run())
			{
				if($_POST['header_color']!='')
				{
					$header_color=$this->input->post('header_color',TRUE);
				}
				else
				{
					$header_color='005D9B';
				}

				if($_FILES['logo']['name']!='')
				{
					$adminPwd = random_string('alnum', 10);
					$insertDataTenant=array('name'=>$this->input->post('name',TRUE),'header_color'=>$header_color,'created'=>date('Y-m-d H:i:s'),'url'=>$this->input->post('url',TRUE),'timezone'=>$this->input->post('time_zone',TRUE),'signup_permission'=>$this->input->post('signup_permission',TRUE),'address'=>$this->input->post('address',TRUE));
					$res=$this->modelbasic->_insert('tenant',$insertDataTenant);
if($res >0)
					{
						$InsertGroupData=array('tenant_id'=>$res,'group_name'=>'general','created'=>date('Y-m-d H:i:s'),'signup_show'=>'1');
						$InsertGroup=$this->modelbasic->_insert('manage_groups',$InsertGroupData);
					}

					$insertDataAdmin=array('name'=>$this->input->post('admin_name',TRUE),'level'=>2,'password'=>md5($adminPwd),'email'=>$this->input->post('email',TRUE),'created'=>date('Y-m-d H:i:s'),'tenant_id'=>$res,'contact'=>$this->input->post('contact',TRUE));
					$res1=$this->modelbasic->_insert('admin',$insertDataAdmin);
					$upload_path=file_upload_absolute_path().$res.'/';
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					$upload_path.='logo/';
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					if(!is_dir($upload_path.'thumbs/'))
					{
						@mkdir($upload_path.'thumbs/', 0777, TRUE);
					}
					if(!is_dir($upload_path.'big_thumbs/'))
					{
						@mkdir($upload_path.'big_thumbs/', 0777, TRUE);
					}
					$result = uploadImage($_FILES,'logo',100,50,$upload_path,'big_thumbs',186,50,true);
					$updateData=array('logo'=>$_FILES['logo']['name']);
					$updateRes=$this->modelbasic->_update('tenant',$res, $updateData);
					if($res1 > 0)
					{
						$getEmailTemp=$this->test_model->getAllGlobalEmailData();
						if(!empty($getEmailTemp))
						{
							foreach ($getEmailTemp as $setEmailTemp) {
								$setEmailTempData=array('id'=>$setEmailTemp['id'],'tenant_id'=>$res,'subject'=>$setEmailTemp['subject'],'email_contains'=>$setEmailTemp['email_contains'],'created'=>date('Y-m-d H:i:s'));
								$ress_email=$this->modelbasic->_insert('manage_email_template',$setEmailTempData);
							}
						}

						$getwidgets=$this->test_model->getAllGlobalwidgets();
						if(!empty($getwidgets))
						{
							foreach ($getwidgets as $setwidgets) {
								$setWidgets=array('id'=>$setwidgets['id'],'tenant_id'=>$res,'widget_name'=>$setwidgets['widget_name'],'info'=>$setwidgets['info'],'page_name'=>$setwidgets['page_name'],'created'=>date('Y-m-d H:i:s'));
								$ress_widget=$this->modelbasic->_insert('widgets',$setWidgets);
							}
						}
						$tenantInfo=$this->modelbasic->getValues('tenant','*',array('id'=>$res),'row_array');
						$emaildata=$this->test_model->getValEmailTemp('manage_email_template','*',array('id'=>1,'tenant_id'=>$tenantInfo['id']));

						$msg=$emaildata['email_contains'];
						$msg=str_replace('{logo_link}','<img src="'.front_base_url().'uploads/'.$tenantInfo['id'].'/logo/thumbs/'.$tenantInfo['logo'].'" alt="logo" />', $msg);
						$msg=str_replace('{user_name}',$_POST['admin_name'], $msg);
						$msg=str_replace('{regards}',$tenantInfo['name'], $msg);
						$msg=str_replace('{email}',$_POST['email'], $msg);
						$msg=str_replace('{password}',$adminPwd, $msg);
						$msg=str_replace('{tenant_name}',$_POST['name'], $msg);
						$msg=str_replace('{front_end_link}','<a href="'.front_base_url().$tenantInfo['url'].'"> Click Here </a>', $msg);
						$msg=str_replace('{back_end_link}','<a href="'.base_url().'"> Click Here </a>', $msg);
						$emailData=array('to'=>$_POST['email'],'fromEmail'=>'nileshanandinfo@gmail.com','subject'=>$emaildata['subject'],'template'=>$msg);
						$data['result']=$this->test_model->get_all_settings();
						$result=$this->modelbasic->sendMail($emailData);
					}
					//$upload_path=file_upload_absolute_path().$res.'/logo/';
					if($updateRes < 1)
					{
						$data=array('status'=>'success','message'=>'Tenant created successfully but logo upload failed.');
						$data['ajax']=json_encode($data);
						$this->load->view('ajax_view',$data);
					}
					else
					{
						$data=array('status'=>'success','message'=>'Tenant created successfully.');
						$data['ajax']=json_encode($data);
						$this->load->view('ajax_view',$data);
					}
				}
				else
				{
					$data=array('logo'=>'logo Req.');
					$data['ajax']=json_encode($data);
					$this->load->view('ajax_view',$data);
				}
			}
			else
			{
				echo validation_errors();die;
				if($this->input->is_ajax_request())
				{
					$data['ajax']=$this->form_validation->get_json();
					$this->load->view('ajax_view',$data);
				}
			}
		}

		public function edit()
		{
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('name','Tenant Name','trim|required');
			$this->form_validation->set_rules('url','Tenant URL','trim|required');
			$this->form_validation->set_rules('header_color','Tenant Header Color','trim|required');
			//$this->form_validation->set_rules('time_zone','Timezone','trim|required');
			$this->form_validation->set_rules('address','Address','trim|required');

			if ($this->form_validation->run())
			{
				if($this->input->post('id',TRUE)!='')
				{
					$id=$this->input->post('id',TRUE);
					$upload_path=file_upload_absolute_path().$id.'/';
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					$upload_path.='logo/';
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					if(!is_dir($upload_path.'thumbs/'))
					{
						@mkdir($upload_path.'thumbs/', 0777, TRUE);
					}
					if(!is_dir($upload_path.'big_thumbs/'))
					{
						@mkdir($upload_path.'big_thumbs/', 0777, TRUE);
					}
					if($_FILES['logo']['name']!='')
					{
						//$img = uploadImage($_FILES,'logo',150,60,$upload_path);
						$img = uploadImage($_FILES,'logo',100,50,$upload_path,'big_thumbs',186,50,true);

						$data=array(
							'url'=>$this->input->post('url',TRUE),
							'name'=>$this->input->post('name',TRUE),
							'header_color'=>$this->input->post('header_color',TRUE),
							'logo'=>$img,'timezone'=>$this->input->post('time_zone',TRUE),
							'signup_permission'=>$this->input->post('signup_permission',TRUE),
							'address'=>$this->input->post('address',TRUE),

							'home_box1_name'=>$this->input->post('home_box1_name',TRUE),
							'home_box1_url'=>$this->input->post('home_box1_url',TRUE),
							'home_box1_color'=>$this->input->post('home_box1_color',TRUE),

							'home_box2_name'=>$this->input->post('home_box2_name',TRUE),
							'home_box2_url'=>$this->input->post('home_box2_url',TRUE),
							'home_box2_color'=>$this->input->post('home_box2_color',TRUE),

							'home_box3_name'=>$this->input->post('home_box3_name',TRUE),
							'home_box3_url'=>$this->input->post('home_box3_url',TRUE),
							'home_box3_color'=>$this->input->post('home_box3_color',TRUE),



					);


						$res=$this->modelbasic->_update('tenant',$id,$data);
						$data=array('status'=>'success','message'=>'Tenant updated successfully');
						$data['ajax']=json_encode($data);
						//pr($data);
						$this->load->view('ajax_view',$data);
					}
					else
					{
						$data=array(
							'url'=>$this->input->post('url',TRUE),
							'name'=>$this->input->post('name',TRUE),
							'header_color'=>$this->input->post('header_color',TRUE),
							'timezone'=>"Asia/Calcutta",
							'signup_permission'=>$this->input->post('signup_permission',TRUE),
							'address'=>$this->input->post('address',TRUE),
							'home_box1_name'=>$this->input->post('home_box1_name',TRUE),
							'home_box1_url'=>$this->input->post('home_box1_url',TRUE),
							'home_box1_color'=>$this->input->post('home_box1_color',TRUE),
							'home_box2_name'=>$this->input->post('home_box2_name',TRUE),
							'home_box2_url'=>$this->input->post('home_box2_url',TRUE),
							'home_box2_color'=>$this->input->post('home_box2_color',TRUE),
							'home_box3_name'=>$this->input->post('home_box3_name',TRUE),
							'home_box3_url'=>$this->input->post('home_box3_url',TRUE),
							'home_box3_color'=>$this->input->post('home_box3_color',TRUE),

						);


						$res=$this->modelbasic->_update('tenant',$id,$data);

						$data=array('status'=>'success','message'=>'Tenant updated successfully');
						$data['ajax']=json_encode($data);
						//pr($data);
						$this->load->view('ajax_view',$data);
					}
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

		public function editAdminProfile()
		{
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('name','Admin Name','trim|required');
			$this->form_validation->set_rules('email','Admin Email','trim|required|valid_email');
			$this->form_validation->set_rules('contact','Contact Number','trim|required');
			if ($this->form_validation->run())
			{
				if($this->input->post('id',TRUE)!='')
				{
					$id=$this->input->post('id',TRUE);
					$tenant_id=$this->input->post('tenant_id',TRUE);
					$upload_path=file_upload_absolute_path().$tenant_id.'/adminprofile/';
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					if(!is_dir($upload_path.'thumbs/'))
					{
						@mkdir($upload_path.'thumbs/', 0777, TRUE);
					}
					if($_FILES['picture']['name']!='')
					{
						$query = $this->modelbasic->getValue('admin','picture',array('id'=>$id));
						if($query!='')
						{
						$path1=$upload_path.$query;
						$unlink_prof = unlinkImage($path1,$query,$upload_path);
						$unlink_prof_thumbs = unlinkImage($path1.'/thumbs',$query,$upload_path.'/thumbs');
					}
						$result = uploadImage($_FILES,'picture',90,40,$upload_path,'','','',true);
						$data=array('name'=>$this->input->post('name',TRUE),'email'=>$this->input->post('email',TRUE),'contact'=>$this->input->post('contact',TRUE),'picture'=>$_FILES['picture']['name']);
						$res=$this->modelbasic->_update('admin',$id,$data);
						$data=array('status'=>'success','message'=>'Profile data updated successfully');
						$data['ajax']=json_encode($data);
						$this->load->view('ajax_view',$data);
					}
					else
					{
						$data=array('name'=>$this->input->post('name',TRUE),'contact'=>$this->input->post('contact',TRUE),'email'=>$this->input->post('email',TRUE));
						$res=$this->modelbasic->_update('admin',$id,$data);
						$data=array('status'=>'success','message'=>'Profile data updated successfully');
						$data['ajax']=json_encode($data);
						$this->load->view('ajax_view',$data);
					}
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
		public function changePasswordSubmit()
		{
			//print_r($_POST);die
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('Admin_old_password','Admin Old Password','trim|required');
			$this->form_validation->set_rules('Admin_new_password','Admin New Password','trim|required');
			if ($this->form_validation->run())
			{
				$id=$this->input->post('id',TRUE);
				$adminIdres = array('id'=>$id );
				$data=$this->modelbasic->getSelectedData('admin','*',$adminIdres,'','','','','','row_array');
				if(!empty($data) && $data['password']==md5($this->input->post('Admin_old_password',TRUE)))
					{
						$data=array('password'=>md5($this->input->post('Admin_new_password',TRUE)));
						$res=$this->modelbasic->_update('admin',$id,$data);
						if($res>0)
						{
							$successdata=array('status'=>'success','message'=>'New Password updated successfully');
							$successdata['ajax']=json_encode($successdata);
							$this->load->view('ajax_view',$successdata);
						}
					}
					else
					{
						$faildata=array('status'=>'fail','message'=>'Old password does not match.');
						$faildata['ajax']=json_encode($faildata);
						$this->load->view('ajax_view',$faildata);
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
		public function edit_tenant($id)
		{
			$res = array('id'=>$id );
			$data=$this->modelbasic->getSelectedData('tenant','*',$res,'','','','','','row_array');
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
						$this->modelbasic->_update('tenant',$key,$status);
						$this->session->set_flashdata('success', 'tenant activated successfully');
					}
					elseif($_POST['listaction'] == '2')
					{
						if($key != 1)
						{
							$sessionid=$this->session->userdata('tenant_id');
							if($sessionid!=$key)
							{
								$status = array('status'=>'0');
								$this->modelbasic->_update('tenant',$key,$status);
								$this->session->set_flashdata('success', 'tenant deactivated successfully');
							}
						}

					}
					elseif($_POST['listaction'] == '3'){
						if($key != 1)
						{
						$query = $this->modelbasic->getValue('tenant','logo','id',$key);
						//print_r($key);die;
							$url=front_base_url();
							$folder="$url/uploads/".$key;
							if (file_exists($folder))
							{
							$filename="$url/upload/".$key.'/logo/'.$query;
							if (file_exists($filename))
							{
							$path2 = '../uploads/'.$key.'/logo/'.$query;
								if(!empty($query))
								{
									unlink( $path2 . $query);
								}
							}
							$filenameone='../uploads/'.$key.'/logo/thumbs/'.$query;
							if (file_exists($filenameone))
							{
							$path3 = '../uploads/'.$key.'logo/thumbs/';
								if(!empty($query))
								{
									unlink( $path3 . $query);
								}
							}

						}
						/*$url=front_base_url();
						$filename="$url/upload/".$key.'/logo/'.$query;
						if (file_exists($filename)){
						$path2 = file_upload_base_url().'logo/';
							$path3 = file_upload_base_url().'logo/thumbs/';
							if(!empty($query))

							{
							unlink( $path2 . $query);
							unlink( $path3 . $query);
							}
						}*/
						$condition = array('tenant_id'=>$key);
						$res=$this->modelbasic->_delete_with_conditions('contact_us',$condition);
						$res=$this->modelbasic->_delete_with_conditions('exam_master',$condition);
						$res=$this->modelbasic->_delete_with_conditions('manage_banner',$condition);
						$res=$this->modelbasic->_delete_with_conditions('manage_groups',$condition);
						$res=$this->modelbasic->_delete_with_conditions('question_bank',$condition);
						$res=$this->modelbasic->_delete_with_conditions('question_categories',$condition);
						$res=$this->modelbasic->_delete_with_conditions('quiz_master',$condition);
						$res=$this->modelbasic->_delete_with_conditions('quiz_section',$condition);
						$res=$this->modelbasic->_delete_with_conditions('users',$condition);
						$res=$this->modelbasic->_delete_with_conditions('admin',$condition);
						$res=$this->modelbasic->_delete_with_conditions('quiz',$condition);
						$res=$this->modelbasic->_delete_with_conditions('quiz_log',$condition);
						$res=$this->modelbasic->_delete_with_conditions('mock_log',$condition);
						$res=$this->modelbasic->_delete_with_conditions('contact_us',$condition);
						$res=$this->modelbasic->_delete_with_conditions('manage_email_template',$condition);
						$res=$this->modelbasic->_delete_with_conditions('option_master',$condition);
						$res=$this->modelbasic->_delete_with_conditions('page_details',$condition);
						$res=$this->modelbasic->_delete_with_conditions('pdf',$condition);
						$res=$this->modelbasic->_delete_with_conditions('verification_key',$condition);
						$res=$this->modelbasic->_delete('tenant',$key);
						$this->session->set_flashdata('success', 'tenant deleted successfully');
					}
					else
					{
						$this->session->set_flashdata('error', 'Do not try to delete tenant user.');
					}
					}
				}
				redirect('tenant');
			}
		}
		public function remove_Notification_Count()
		{
			$table = "users";
			$res=$this->test_model->remove_Notification_Count($table);
			$tableOne = "manage_groups";
			$res=$this->test_model->remove_Notification_Count($tableOne);
		}
		public function Set_tenantId()
		{
			if($_POST['Id']!='')
			{
				$this->session->unset_userdata('tenant_id');
				$this->session->unset_userdata('time_zone');
				$this->session->set_userdata('tenant_id',$_POST['Id']);
				$tenant_timezone=$this->test_model->get_tenant_timezone($_POST['Id']);
				if(!empty($tenant_timezone))
				{
					$this->session->set_userdata('time_zone',$tenant_timezone['timezone']);
				}
				echo 1;
			}
			else
			{
				echo 0;
			}
		}
	}
