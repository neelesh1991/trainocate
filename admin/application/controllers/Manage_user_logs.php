<?php

if (!defined('BASEPATH'))

exit('No direct script access allowed');

class Manage_user_logs extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		$this->load->library('upload');

		$this->load->library('image_lib');

		$this->load->helper('imgupload');

		$this->load->library('form_validation');

		$this->load->model('test_model');

		$this->load->model('dashboard_model');

	    $this->load->helper('string');

	}

	public function index()

	{	
		$tenant_id=$this->session->userdata('tenant_id');

	    // $getQuizLogdata = $this->dashboard_model->getQuizLogData($tenant_id,'');
	    // $getRetryLog = $this->dashboard_model->retryLogData($tenant_id,'');
	    // $allQuizLogData = array_merge($getQuizLogdata,$getRetryLog);
	    // $logResults = array_unique($allQuizLogData, SORT_REGULAR);
	    // $data['logResults']= $logResults;
	    // $data['total_assements']= count($logResults);
	    // $data['exam_detail']=$this->dashboard_model->get_exams_detail($tenant_id);
		$data['page_name']='manage_user_logs/manage_user_logs_view';

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
		$selectColumns = "id,name,email_id,tenant_id,group_id,address,age,institute_name,academic_year,created,principal_name,password,photo,status,reset_logs,retry_assessment";

		// $condition=array('tenant_id'=>$this->session->userdata('tenant_id'));
		$condition= "";
		if($this->session->userdata('tenant_id') != '1' && ($this->session->userdata('admin_level') != '1'))
	    {
	      $condition=array('tenant_id'=>$this->session->userdata('tenant_id'));
	    }

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
			  	// <a href='.base_url().'users><div class="menu-icon">'.$img.'</div></a>'<div style="text-align:center;"><b>Name:</b> '.ucwords($row["name"]).'</div>';
				$nestedData['info'] = ucwords($row["name"]);
                $nestedData['tenant_id'] = $row['tenant_id'];
				$nestedData['name'] = $row['name'];
				$nestedData['email'] = $row['email_id'];
				$nestedData['group_id'] =  $this->modelbasic->getValue('manage_groups','group_name','id',$row['group_id']);
				$nestedData['reset_exam_logs'] = '<div style="text-align:center;"><input type="checkbox" name="reset_exam_logs" id="name="reset_exam_logs"" value="" onclick="enableDisable(this.checked,"/reset_assessment_logs"/)"></div>';
				
				// $nestedData['reset_exam_logs'] = '<div style="text-align:center;"><input type="number" id="reset_exam_logs" name="reset_exam_logs" maxlength="1" min="0" max="5" style="width:50px" value="'.$row['reset_logs'].'"onkeyup="change_retryexam('.$row["id"].',this.value)"></div>';
				$nestedData['reset_assessment_logs'] = '<div style="text-align:center;"><input type="number" id="reset_assessment_logs" name="reset_assessment_logs" maxlength="1" min="0" max="5" style="width:50px" disabled="disabled" value="'.$row['retry_assessment'].'" onkeyup="change_assessmentlogs('.$row["id"].',this.value)"></div>';
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

	public function change_retryexam($id,$status)
	{
		$res=$this->test_model->_change_status_user($id,$status,'users');
		if($res>0)
       	{
       		redirect('manage_user_logs');
      	}
	   	else
	   	{
	   		echo FALSE;
	   	}
	}

	public function change_assessmentlogs($id,$status)
	{
		$res=$this->test_model->_change_status_user($id,$status,'users');
		if($res>0)
       	{
       		redirect('manage_user_logs');
      	}
	   	else
	   	{
	   		echo FALSE;
	   	}
	}

	// public function delete_confirm($id)

	// {

	// 	$res=$this->modelbasic->_delete('quiz_master',$id);

	// 	if($res>0)

	// 	{

	// 		$this->session->set_flashdata('success', 'Quiz Deleted Successfullyy');

	// 		redirect('manage_quiz');

	// 	}

	// 	else

	// 	{

	// 		echo FALSE;

	// 	}

	// }

	// public function submit_quiz()

	// {



	// 	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

	// 	$this->form_validation->set_rules('mock','Mock','trim|required');

	// 	$this->form_validation->set_rules('quiz_name','Quiz Name','trim|required');

	// 	$this->form_validation->set_rules('assessment_information','Information About Assessment','trim|required');

	// 	$this->form_validation->set_rules('number_of_sections','Number Of Sections','trim|required');

	// 	if($_POST['mock']==1)

	// 	{

	// 		$this->form_validation->set_rules('category_id','Category','trim|required');

	// 	}

	// 		if ($this->form_validation->run())

	// 		{

	// 			$id=$this->input->post('id',TRUE);

	// 			//print_r($id);die;

	// 			if($id !='')

	// 			{

	// 				//echo "hi";die;

	// 				$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'quiz_name'=>$this->input->post('quiz_name',TRUE),'number_of_sections'=>$this->input->post('number_of_sections',TRUE),'mock'=>$this->input->post('mock',TRUE),'assessment_information'=>$this->input->post('assessment_information',TRUE),'bind_url'=>$this->input->post('bind_url',TRUE),'url'=>$this->input->post('url',TRUE));

	// 				$res=$this->modelbasic->_update('quiz_master',$id,$data);
	// 				if($_FILES['logo']['name']!='')
	// 				{
	// 					$upload_path=file_upload_absolute_path();
	// 					if(!is_dir($upload_path))
	// 					{
	// 						@mkdir($upload_path, 0777, TRUE);
	// 					}
	// 					$upload_path.='assesment/';
	// 					if(!is_dir($upload_path))
	// 					{
	// 						@mkdir($upload_path, 0777, TRUE);
	// 					}
	// 					$uploadImg = uploadImage($_FILES,'logo',90,90,$upload_path);
	// 					$updateData=array('assessment_image'=>$_FILES['logo']['name']);
	// 					$res=$this->modelbasic->_update('quiz_master',$id,$updateData);

	// 				}

	// 				//print_r($res);die;



	// 				if(!empty($_POST['category_id']) || isset($_POST['category_id']))

	// 				{

	// 					$delete_cat=$this->modelbasic->_delete_with_condition('mock_quiz_category_relation','quiz_id',$id);



	// 					$catId = explode(',', $_POST['category_id']);

	// 					foreach($catId as $categoryId)

	// 					{

	// 						$cat_name = array('category_name'=>$categoryId,'tenant_id'=>$this->session->userdata('tenant_id'));

	// 						$catExist=$this->modelbasic->getSelectedData('question_categories','*',$cat_name,'','','','','','row_array');

	// 						if(empty($catExist))

	// 						{

	// 							$data=array('category_name'=>$categoryId,'tenant_id'=>$this->session->userdata('tenant_id'));

	// 							$CAT_ID=$this->modelbasic->_insert('question_categories',$data);

	// 						}

	// 						else

	// 						{

	// 							$CAT_ID=$catExist['id'];

	// 						}

	// 						$data_one=array('quiz_id'=>$id,'category_id'=>$CAT_ID);

	// 						$ress=$this->modelbasic->_insert('mock_quiz_category_relation',$data_one);

	// 					}



	// 				}

	// 				if($res>0)

	// 				{

	// 					$successdata=array('status'=>'success','message'=>'Quiz updated successfully');

	// 					$successdata['ajax']=json_encode($successdata);

	// 					$this->load->view('ajax_view',$successdata);

	// 				}



	// 			}

	// 			else

	// 			{

	// 				//echo "by";die;

	// 				$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'quiz_name'=>$this->input->post('quiz_name',TRUE),'number_of_sections'=>$this->input->post('number_of_sections',TRUE),'mock'=>$this->input->post('mock',TRUE),'assessment_information'=>$this->input->post('assessment_information',TRUE),'bind_url'=>$this->input->post('bind_url',TRUE),'url'=>$this->input->post('url',TRUE));

	// 				$res=$this->modelbasic->_insert('quiz_master',$data);

	// 				$upload_path=file_upload_absolute_path();
	// 				if(!is_dir($upload_path))
	// 				{
	// 					@mkdir($upload_path, 0777, TRUE);
	// 				}
	// 				$upload_path.='assesment/';
	// 				if(!is_dir($upload_path))
	// 				{
	// 					@mkdir($upload_path, 0777, TRUE);
	// 				}
	// 				$uploadImg = uploadImage($_FILES,'logo',90,90,$upload_path);
	// 				$updateData=array('assessment_image'=>$_FILES['logo']['name']);
	// 				$res=$this->modelbasic->_update('quiz_master',$res,$updateData);

	// 				if(!empty($_POST['category_id']) || isset($_POST['category_id']))

	// 				{

	// 					$catId = explode(',', $_POST['category_id']);

	// 					foreach($catId as $categoryId)

	// 					{

	// 						$cat_name = array('category_name'=>$categoryId,'tenant_id'=>$this->session->userdata('tenant_id'));

	// 						$catExist=$this->modelbasic->getSelectedData('question_categories','*',$cat_name,'','','','','','row_array');

	// 						if(empty($catExist))

	// 						{

	// 							$data=array('category_name'=>$categoryId,'tenant_id'=>$this->session->userdata('tenant_id'));

	// 							$CAT_ID=$this->modelbasic->_insert('question_categories',$data);

	// 						}

	// 						else

	// 						{

	// 							$CAT_ID=$catExist['id'];

	// 						}

	// 						$data_one=array('quiz_id'=>$res,'category_id'=>$CAT_ID);

	// 						$ress=$this->modelbasic->_insert('mock_quiz_category_relation',$data_one);

	// 						}



	// 				}



	// 				if($res>0)

	// 				{

	// 					$successdata=array('status'=>'success','message'=>'Quiz inserted successfully');

	// 					$successdata['ajax']=json_encode($successdata);

	// 					$this->load->view('ajax_view',$successdata);

	// 				}

	// 			}



	// 		}

	// 		else

	// 		{

	// 			if($this->input->is_ajax_request())

	// 				{

	// 					$data['ajax']=$this->form_validation->get_json();

	// 					$this->load->view('ajax_view',$data);

	// 				}

	// 		}

	// }

	// public function edit_quiz($id)

	// {

	// 	$res = array('id'=>$id );

	// 	$data=$this->modelbasic->getSelectedData('quiz_master','*',$res,'','','','','','row_array');

	//   	$quiz_cat=$this->test_model->get_Quiz_Category($id);

	//   	$data['category_name'] = '';

	//   	if(!empty($quiz_cat))

	//   	{

	//   		$i=1;

	//   		foreach ($quiz_cat as $catname)

	//   		{

	//   			if($i == count($quiz_cat))

	//   			{

	//   				$data['category_name'].= $catname["category_name"];

	//   			}

	//   			else

	//   			{

	//   				$data['category_name'].= $catname["category_name"].',';

	//   			}

	//   			$i++;

	//   		}

	//   	}

	// 	$data['ajax']=json_encode($data);

	// 	$this->load->view('ajax_view',$data);

	// }



	// function multiselect_action()

	// 	{

	// 		if(isset($_POST['submit']))

	// 		{

	// 			$check = $_POST['checkall'];

	// 			foreach($check as $key => $value)

	// 			{

	// 				if($_POST['listaction'] == '3'){

	// 					$this->modelbasic->_delete('quiz_master',$key);

	// 					$this->session->set_flashdata('success', 'Quiz Deleted Successfully');

	// 				}

	// 			}

	// 			redirect('manage_quiz');

	// 		}

	// 	}

	}