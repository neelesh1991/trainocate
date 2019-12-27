<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Users extends CI_Controller
{
	function __construct()
	{
	    	parent::__construct();
	    	$this->load->model('test_model');
	    	$this->load->library('upload');
	    	$this->load->library('image_lib');
	    	$this->load->helper('imgupload');
	    	$this->load->library('form_validation');
	    	$this->load->helper('string');
	}

	public function index()
	{
//$password = random_string('alnum', 10);
		/*$res = array('id !='=>'1');
		$data['tenant']=$this->modelbasic->getAllWhere('tenant','*',$res);*/
		$res = array('tenant_id'=>$this->session->userdata('tenant_id'),'status'=>'1');
		
		// $admin_level=$this->session->userdata('admin_level');
		
		// if($admin_level != '1')
		// {
		// 	$res = array('tenant_id'=>$this->session->userdata('tenant_id'),'status'=>'1');
		// }
		// else{
		// 	$res = array('status'=>'1');
		// }
		
		$data['group']=$this->modelbasic->getAllWhere('manage_groups','*',$res);
		$data['page_name']='user/manage_user_view';
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
		$format = 'M d,Y H:i:s';

		$_POST['columns']='id,name,email_id,tenant_id,group_id,address,age,institute_name,academic_year,created,principal_name,password,photo,status';
		$requestData = $_REQUEST;
		$columns=explode(',',$_POST['columns']);
		$selectColumns = "id,name,email_id,tenant_id,group_id,address,age,institute_name,academic_year,created,principal_name,password,photo,status";
		$condition=array('tenant_id'=>$this->session->userdata('tenant_id'));
		$totalData=$this->modelbasic->count_all_only('users',$condition);
		$totalFiltered=$totalData;
		$result=$this->modelbasic->run_query('users',$requestData,$columns,$selectColumns,'','',$condition);
		//$result=$this->modelbasic->getAllWhere('users','*',$condition);
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
				switch ($row["status"]) {
				   case 1 : $status='<span class="label label-success" onclick="change_status('.$row["id"].',1)" data-toggle="modal" style="cursor: pointer;">Active</span>'; break;
				    case 0 : $status='<span class="label label-danger" onclick="change_status('.$row["id"].',0)" data-toggle="modal" style="cursor: pointer;">Deactive</span>'; break;
				    default : $status=''; break;
				}
				$nestedData['chk'] = '<div class="vd_checkbox checkbox-success"><input type="checkbox" class="case" id="check-'.$row["id"].'" name="checkall['.$row["id"].']" data-index="'.$row["id"].'"><label for="check-'.$row["id"].'"> </label></div>';
				$nestedData['id'] =$row["id"];
				if($row["photo"]!='')
				{
					$filename='../uploads/'. $row['tenant_id'].'/users_photo/'.$row["id"].'/thumbs/'.$row["photo"];
				  if (file_exists($filename))
				  	{
				  		$img='<img class="width-30" src="'.front_base_url().'uploads/'. $row['tenant_id'].'/users_photo/'.$row["id"].'/thumbs/'.$row["photo"].'">';
				 	 }
				  	else
				  	{
				  		$img='<img class="width-30" src="'.front_base_url().'assets/img/notavilable.jpg">';
				  	}
			  	}
			  	else
			  	{
			  		$img='<img class="width-30" src="'.front_base_url().'admin/assets/img/u.png">';
			  	}
				$nestedData['info'] = '<a href='.base_url().'users><div class="menu-icon">'.$img.'</div></a><div style="text-align:center;"><b>Name:</b> '.ucwords($row["name"]).'</div>';
			/*	$createdDateVal = new DateTime($row["created"], new DateTimeZone('GMT') );
				$createdDateVal->setTimeZone(new DateTimeZone($this->session->userdata('timezone')));*/

				$start = new DateTime($row["created"], new DateTimeZone($tz_from));
				$start->setTimeZone(new DateTimeZone($tz_to));
				$created=$start->format($format);

				$nestedData['created'] =$created;
				$nestedData['action'] = '<div class="menu-action dropdown">
                <a onclick="edit_user('.$row['id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-pencil"></i> </a>
                 <a onclick="delete_confirm('.$row['id'].');" class="btn menu-icon vd_bd-red vd_red" data-placement="top" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-times"></i> </a>
                  	</div>';
                $nestedData['tenant_id'] = $row['tenant_id'];
				$nestedData['name'] = $row['name'];
				$nestedData['group_id'] =  $this->modelbasic->getValue('manage_groups','group_name','id',$row['group_id']);
				$nestedData['status'] = $status;
				$nestedData['address'] = $row['address'];
				$nestedData['email'] = $row['email_id'];
				$nestedData['age'] = $row['age'];
				$nestedData['institute_name'] = $row['institute_name'];
				$nestedData['academic_year'] = $row['academic_year'];
				$nestedData['principal_name'] = $row['principal_name'];
				$data[] = $nestedData;
				$i++;
				//echo front_base_url();die;
			}
		}
		$json_data = array(
				"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
				);
		$data['ajax']=json_encode($json_data);
		$this->load->view('ajax_view',$data);
	}

	public function change_status($id,$status)
	{
		$res=$this->test_model->_change_status_user($id,$status,'users');
		if($res>0)
       	{
       		redirect('users');
      	}
	   	else
	   	{
	   		echo FALSE;
	   	}
	}
	public function email_check($str)
       {
       	$id=$this->input->post('id',TRUE);
       	if($id=='')
       	{
       		$res=array('email_id'=>$str,'tenant_id'=>$this->session->userdata('tenant_id'));
       		$check_email=$this->modelbasic->getSelectedData('users','email_id',$res,'','','','','','row_array');
			if ($check_email['email_id'] != '')
		        {
		               $this->form_validation->set_message('email_check', 'The Email field exist');
		                return FALSE;
		        }
		        else
		        {
		                return TRUE;
		        }
       	}
       	else
       	{
       		$res=array('email_id'=>$str,'tenant_id'=>$this->session->userdata('tenant_id'),'id!='=>$id);
       		$check_email=$this->modelbasic->getSelectedData('users','email_id',$res,'','','','','','row_array');
       		if ($check_email['email_id'] != '')
               {
                       $this->form_validation->set_message('email_check', 'The Email field exist');
                       return FALSE;
               }
               else
               {
                       return TRUE;
               }
      	}
       }

	public function add()
	{
		$timezone='Asia/Kolkata';
		if($this->session->userdata('time_zone')!='')
		{
		    $timezone=$this->session->userdata('time_zone');
		}

		$id=$this->input->post('id',TRUE);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('name','name','trim|required');
		$this->form_validation->set_rules('email_id','Email Id','trim|required|valid_email|callback_email_check');
			if ($this->form_validation->run())
			{
				$folderName = $this->session->userdata('tenant_id');
				if(!isset($_POST['group_id']) || $_POST['group_id']=='')
				{
					$groupName='general';
					$check_group = array('group_name'=>$groupName,'tenant_id'=>$folderName);
					$groupExist=$this->modelbasic->getSelectedData('manage_groups','id',$check_group,'','','','','','row_array');
					//print_r($groupExist);die;
					if(!empty($groupExist))
					{
						$groupId=$groupExist['id'];
					}
					else
					{
						$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'group_name'=>$groupName,'created'=>date('Y-m-d H:i:s'));
						$groupId=$this->modelbasic->_insert('manage_groups',$data);
					}
					//print_r($groupId);die;
				}
				else
				{
					$groupId=$this->input->post('group_id',TRUE);
				}

				//print_r($groupId);die;


				/*else
				{
					$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'group_name'=>$groupName,'created'=>date('Y-m-d H:i:s'));
					$groupId=$this->modelbasic->_insert('manage_groups',$data);
				}*/

				if($id !='')
				{
					if($_FILES['photo']['name']!='')
					{
						$upload_path=file_upload_absolute_path().$folderName.'/';
						if(!is_dir($upload_path))
						{
							@mkdir($upload_path, 0777, TRUE);
						}
						$upload_path.='users_photo/';
						if(!is_dir($upload_path))
						{
							@mkdir($upload_path, 0777, TRUE);
						}
						$upload_path.=$id.'/';
						if(!is_dir($upload_path))
						{
							@mkdir($upload_path, 0777, TRUE);
						}
						if(!is_dir($upload_path.'thumbs/'))
						{
							@mkdir($upload_path.'thumbs/', 0777, TRUE);
						}
					$result = uploadImage($_FILES,'photo',90,90,$upload_path);
					$data=array('name'=> $this->input->post('name',TRUE),'tenant_id'=>$this->session->userdata('tenant_id'),'address'=>$this->input->post('address',TRUE),'photo'=>$_FILES['photo']['name'],'age'=>$this->input->post('age',TRUE),'institute_name'=>$this->input->post('institute_name',TRUE),'academic_year'=>$this->input->post('academic_year',TRUE),'principal_name'=>$this->input->post('principal_name',TRUE),'group_id'=>$groupId,'email_id'=>$this->input->post('email_id',TRUE),'created'=>date('Y-m-d H:i:s'));
					$res=$this->modelbasic->_update('users',$id,$data);
					}
					else
					{
						$data=array('name'=>$this->input->post('name',TRUE),'tenant_id'=>$this->session->userdata('tenant_id'),'address'=>$this->input->post('address',TRUE),'age'=>$this->input->post('age',TRUE),'institute_name'=>$this->input->post('institute_name',TRUE),'academic_year'=>$this->input->post('academic_year',TRUE),'principal_name'=>$this->input->post('principal_name',TRUE),'email_id'=>$this->input->post('email_id',TRUE),'group_id'=>$groupId,'created'=>date('Y-m-d H:i:s'));
						$res=$this->modelbasic->_update('users',$id,$data);
					}
					 if(($this->input->post('age',TRUE)!='') && ($this->input->post('name',TRUE)!='') && ($this->input->post('address',TRUE)!='') && ($this->input->post('institute_name',TRUE)!='') && ($this->input->post('academic_year',TRUE)!='') && ($this->input->post('principal_name',TRUE)!=''))
						 {
						 	//echo "hi";die;
						 	$this->db->where('id', $id);
						 	$this->db->update('users',array('is_profile_completed'=> 1 ));
						 }
					$successdata=array('status'=>'success','message'=>'User data updated successfully');
					$successdata['ajax']=json_encode($successdata);
					//pr($successdata);
					$this->load->view('ajax_view',$successdata);
				}
				else
				{
					$userpassword = random_string('alnum', 10);
					$data=array('name'=>$this->input->post('name',TRUE),'tenant_id'=>$this->session->userdata('tenant_id'),'address'=>$this->input->post('address',TRUE),'photo'=>$_FILES['photo']['name'],'age'=>$this->input->post('age',TRUE),'institute_name'=>$this->input->post('institute_name',TRUE),'academic_year'=>$this->input->post('academic_year',TRUE),'principal_name'=>$this->input->post('principal_name',TRUE),'email_id'=>$this->input->post('email_id',TRUE),'group_id'=>$groupId,'password'=>md5($userpassword),'created'=>date('Y-m-d H:i:s'),'timezone'=>$timezone);
					$res=$this->modelbasic->_insert('users',$data);
					$upload_path=file_upload_absolute_path().$folderName.'/';
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					$upload_path.='users_photo/';
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					$upload_path.=$res.'/';
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					if(!is_dir($upload_path.'thumbs/'))
					{
						@mkdir($upload_path.'thumbs/', 0777, TRUE);
					}
					$tenantUrl=$this->modelbasic->getValue('tenant','url',array('id'=>$this->session->userdata('tenant_id')));
					$uploadImg = uploadImage($_FILES,'photo',90,90,$upload_path);
					 if(($this->input->post('age',TRUE)!='') && ($this->input->post('name',TRUE)!='') && ($this->input->post('address',TRUE)!='') && ($this->input->post('institute_name',TRUE)!='') && ($this->input->post('academic_year',TRUE)!='') && ($this->input->post('principal_name',TRUE)!=''))
						 {
						 	$this->db->where('id', $res);
						 	 $this->db->update('users',array('is_profile_completed'=> 1 ));
						 }


						$tenantInfo=$this->modelbasic->getValues('tenant','*',array('id'=>$this->session->userdata('tenant_id')),'row_array');
						$emaildata=$this->test_model->getValEmailTemp('manage_email_template','*',array('id'=>3,'tenant_id'=>$tenantInfo['id']));
						//print_r($tenantInfo);die;
						$msg=$emaildata['email_contains'];
						$msg=str_replace('{logo_link}','<img src="'.front_base_url().'uploads/'.$tenantInfo['id'].'/logo/thumbs/'.$tenantInfo['logo'].'" alt="logo" />', $msg);

						$msg=str_replace('{user_name}',$_POST['name'], $msg);
						$msg=str_replace('{regards}',$tenantInfo['name'], $msg);
						$msg=str_replace('{email}',$_POST['email_id'], $msg);
						$msg=str_replace('{password}',$userpassword, $msg);
						$msg=str_replace('{link}','<a href="'.front_base_url().'quiz/'.$tenantInfo['url'].'"> Click Here </a>', $msg);

						$emailData=array('to'=>$_POST['email_id'],'fromEmail'=>'nileshanandinfo@gmail.com','subject'=>$emaildata['subject'],'template'=>$msg);
						$data['result']=$this->test_model->get_all_settings();
						$result=$this->modelbasic->sendMail($emailData);


/*
					$data['fromEmail']='quizadmin@emmersivedemos.in';
					$data['to']=$this->input->post('email_id',TRUE);
					$data['subject']='User Appointment';
					$data['template']='Hello '.$_POST['name'].',<br/>You has been appointed as User in Quiz.<br/> Following are the your login detail,<br/>Email Id is - '.$_POST['email_id'].'<br/> Password - '.$userpassword.'<br/>Click following link to login.<br/>'.front_base_url().$tenantUrl.'<br/></br></br>Thanks & Regards<br/> Quiz Admin';
					$data['result']=$this->test_model->get_all_settings();
					//pr($data);
					$result=$this->modelbasic->sendMail($data);*/


					$successdata=array('status'=>'success','message'=>'User inserted successfully');
					$successdata['ajax']=json_encode($successdata);
					//pr($successdata);
					$this->load->view('ajax_view',$successdata);
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
	public function edit_user($id)
	{
		$res = array('id'=>$id );
		$data=$this->modelbasic->getSelectedData('users','*',$res,'','','','','','row_array');
		$data['ajax']=json_encode($data);
		$this->load->view('ajax_view',$data);
	}
	public function delete_confirm($id)
	{
		$res=$this->modelbasic->_delete_with_conditions('users',array('id'=>$id));
		if($res>0)
		{
			redirect('users');
		}
		else
		{
			echo FALSE;
		}
	}
	function multiselect_action()
	{
		//print_r($_POST['checkall']);die;
		if(isset($_POST['submit']))
		{
			$check = $_POST['checkall'];
			//echo " < pre > ";print_r($_POST);die;
			foreach($check as $key => $value)
			{
				if($_POST['listaction'] == '1')
				{
					$status = array('status'=>'1');
					$this->modelbasic->_update('users',$key,$status);
					$this->session->set_flashdata('success', 'Users activated successfully');
				}
				elseif($_POST['listaction'] == '2')
				{
						$status = array('status'=>'0');
						$this->modelbasic->_update('users',$key,$status);
						$this->session->set_flashdata('success', 'Users deactivated successfully');
				}
				elseif($_POST['listaction'] == '3'){
					$query = $this->modelbasic->getValue('users','photo','id',$key);
					//print_r($query);die;
					$url=front_base_url();
					$folder="$url/uploads/".$key;
					if (file_exists($folder))
					{
					$filename="$url/uploads/users_photo/".$query;
					if (file_exists($filename))
					{
					$path2 = '../uploads/users_photo';
						if(!empty($query))
						{
							unlink( $path2 . $query);
						}
					}
					$filenameone="$url/uploads/users_photo/thumbs/".$query;
					if (file_exists($filenameone))
					{
					$path3 = '../uploads/users_photo/thumbs/';
						if(!empty($query))
						{
							unlink( $path3 . $query);
						}
					}
				}
					$this->modelbasic->_delete('users',$key);
					$this->session->set_flashdata('success', 'Users deleted successfully');
				}
			}
			redirect('users');
		}
	}
	public function add_csv()
	{
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
			     	// echo "<pre/>"; print_r($all_data);die;
			     	if(!empty($all_data))
			     	{
			     		// foreach($all_data as $val)
			     		foreach($all_data as $key => $val)
			     		{
			     			$email = array('email_id'=>trim($val[1]),'tenant_id'=>$this->session->userdata('tenant_id'));
			     			//$emailExist=$this->modelbasic->getSelectedData('users','*',$email,'','','','','','row_array');
			     			$emailExist=$this->modelbasic->getAllWhere('users','*',$email);
			     			// echo "<pre/>"; print_r($emailExist);die;
			     			if(empty($emailExist))
			     			{
			     				//echo "hi";die;
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
				     				// echo "<pre/>"; print_r($check_group); 
				     				$groupExist=$this->modelbasic->getSelectedData('manage_groups','*',$check_group,'','','','','','row_array');

				     				if(!empty($groupExist))
				     				{
				     					$groupId=$groupExist['id'];
				     				}
				     				else
				     				{
				     					$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'group_name'=>$groupName,'created'=>date('Y-m-d H:i:s')); 
				     					// echo "<pre/>";print_r($data); die;
				     					$groupId=$this->modelbasic->_insert('manage_groups',$data);
				     				}
				     				$timezone='Asia/Kolkata';
				     				if($this->session->userdata('time_zone')!='')
				     				{
				     				    $timezone=$this->session->userdata('time_zone');
				     				}
				     				$password = random_string('alnum', 10);
				     				$user_info=array('tenant_id'=>$this->session->userdata('tenant_id'),'name'=>$val[0],'email_id'=>trim($val[1]),'address'=>$val[2],'age'=>$val[3],'institute_name'=>$val[4],'created'=>date('Y-m-d H:i:s'),'status'=>1,'academic_year'=>$val[6],'principal_name'=>$val[5],'password'=>md5($password),'group_id'=>$groupId,'timezone'=>$timezone);

				     			 	$res=$this->modelbasic->_insert('users',$user_info);
				     			 	 if($val[3]!='' && $val[0]!='' && $val[2]!='' && $val[4]!='' && $val[6]!='' && $val[5]!='')
				     			 		 {
				     			 		 	$this->db->where('id', $res);
				     			 		 	$this->db->update('users',array('is_profile_completed'=> 1 ));
				     			 		 }
				     			 	$tenantUrl=$this->modelbasic->getValue('tenant','url',array('id'=>$this->session->userdata('tenant_id')));
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
				     					// echo "<pre/>"; print_r($emailData); die;
				     					// $result=$this->modelbasic->sendMail($emailData);

				     					/*$data['to']=$val[1];
				     					$data['fromEmail']='quizadmin@emmersivedemos.in';
				     					$data['subject']='User Appointment';
				     					$data['template']='Hello '.$val[0].',<br/>You has been appointed as User in Quiz.<br/> Following are the your login detail,<br/>Email Id is - '.$val[1].'<br/> Password - '.$password.'<br/>Click following link to login.<br/>'.front_base_url().$tenantUrl.'<br/></br></br>Thanks & Regards<br/> Quiz Admin';
				     					$data['result']=$this->test_model->get_all_settings();
				     					$result=$this->modelbasic->sendMail($data);*/
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
			$this->session->set_flashdata('csverror',$error);
			redirect('users','refresh');
	}

public function user_export_to_csv()

    {


      $this->load->dbutil();

      $this->load->helper('file');

      $this->load->helper('download');

      $delimiter = ",";

      $newline = "\r\n";

      $upload_path='../downloads/csv/';

        if(!is_dir($upload_path))

        {

          @mkdir($upload_path, 0777, TRUE);

        }

        if(!is_dir($upload_path.'users/'))

        {

          @mkdir($upload_path.'users/', 0777, TRUE);

        }

      $filename = "all_users_".date("d-m-Y_h_i_sa").".csv";

      $fullPath = "../downloads/csv/users/all_users_".date("d-m-Y_h_i_sa").".csv";



      $tenant_id=$this->session->userdata('tenant_id');


      $query=$this->modelbasic->get_users_to_csv($tenant_id);



      $result = $this->db->query($query);


      $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);

      if ( ! write_file($fullPath, $data))

      {

           echo 'Unable to write the file';


           //redirect('dashboard');

      }

      else

      {


          //echo $filename;die;
           force_download($filename, $data);

           redirect('users');

      }

    }





}