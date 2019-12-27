<?php

if (!defined('BASEPATH'))

exit('No direct script access allowed');

class Manage_quiz extends CI_Controller

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

		$data['page_name']='manage_quiz/manage_quiz_master_view';

		$this->load->view('index',$data);

	}

	public function getAjaxdataObjects()

	{



		$_POST['columns']='id,tenant_id,quiz_name,number_of_sections,assessment_information';

		$requestData = $_REQUEST;

		$columns=explode(',',$_POST['columns']);

		$selectColumns = "id,tenant_id,quiz_name,number_of_sections,assessment_information,assessment_image,bind_url,url";

		// $condition=array('tenant_id'=>$this->session->userdata('tenant_id'));
		$condition= "";
		if($this->session->userdata('tenant_id') != '1' && ($this->session->userdata('admin_level') != '1'))
	    {
	      $condition=array('tenant_id'=>$this->session->userdata('tenant_id'));
	    }

		$totalData=$this->modelbasic->count_all_only('quiz_master',$condition);

		$totalFiltered=$totalData;

		$result=$this->modelbasic->run_query('quiz_master',$requestData,$columns,$selectColumns,'','',$condition);

		//$result=$this->modelbasic->getAllWhere('quiz_master','*',$condition);

		if( !empty($requestData['search']['value']) )

		{

			$totalFiltered=count($result);

		}

		$data = array();

		//print_r($result);die;

		if(!empty($result))

		{

			$i=1;

			foreach ($result as $row)

			{

				$nestedData=array();

				$nestedData['chk'] = '<div class="vd_checkbox checkbox-success"><input type="checkbox" class="case" id="check-'.$row["id"].'" name="checkall['.$row["id"].']" data-index="'.$row["id"].'"><label for="check-'.$row["id"].'"> </label></div>';

				if($row["assessment_image"]!='')
				{
					$img='<img class="width-30" src="'.front_base_url().'uploads/assesment/'.$row["assessment_image"].'">';
				}

				else
				{
					$img='<img class="width-30" src="'.front_base_url().'assets/img/u.png">';
				}

				$nestedData['logo'] = '<div class="menu-icon" style="text-align:center;">'.$img.'<br/></div>';

				$nestedData['info'] = '<div style="text-align:center;">'.$row["quiz_name"].'<br/></div>';



				$nestedData['tenant_id'] =$row["tenant_id"];

				$nestedData['number_of_sections'] =$row["number_of_sections"];



				$nestedData['action'] = '<div class="menu-action">

							<a onclick="edit_quiz('.$row['id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-pencil"></i> </a>

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

		$res=$this->modelbasic->_delete('quiz_master',$id);

		if($res>0)

		{

			$this->session->set_flashdata('success', 'Quiz Deleted Successfullyy');

			redirect('manage_quiz');

		}

		else

		{

			echo FALSE;

		}

	}

	public function submit_quiz()

	{



		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('mock','Mock','trim|required');

		$this->form_validation->set_rules('quiz_name','Quiz Name','trim|required');

		$this->form_validation->set_rules('assessment_information','Information About Assessment','trim|required');

		$this->form_validation->set_rules('number_of_sections','Number Of Sections','trim|required');

		if($_POST['mock']==1)

		{

			$this->form_validation->set_rules('category_id','Category','trim|required');

		}

			if ($this->form_validation->run())

			{

				$id=$this->input->post('id',TRUE);

				//print_r($id);die;

				if($id !='')

				{

					//echo "hi";die;

					$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'quiz_name'=>$this->input->post('quiz_name',TRUE),'number_of_sections'=>$this->input->post('number_of_sections',TRUE),'mock'=>$this->input->post('mock',TRUE),'assessment_information'=>$this->input->post('assessment_information',TRUE),'bind_url'=>$this->input->post('bind_url',TRUE),'url'=>$this->input->post('url',TRUE));

					$res=$this->modelbasic->_update('quiz_master',$id,$data);
					if($_FILES['logo']['name']!='')
					{
						$upload_path=file_upload_absolute_path();
						if(!is_dir($upload_path))
						{
							@mkdir($upload_path, 0777, TRUE);
						}
						$upload_path.='assesment/';
						if(!is_dir($upload_path))
						{
							@mkdir($upload_path, 0777, TRUE);
						}
						$uploadImg = uploadImage($_FILES,'logo',90,90,$upload_path);
						$updateData=array('assessment_image'=>$_FILES['logo']['name']);
						$res=$this->modelbasic->_update('quiz_master',$id,$updateData);

					}

					//print_r($res);die;



					if(!empty($_POST['category_id']) || isset($_POST['category_id']))

					{

						$delete_cat=$this->modelbasic->_delete_with_condition('mock_quiz_category_relation','quiz_id',$id);



						$catId = explode(',', $_POST['category_id']);

						foreach($catId as $categoryId)

						{

							$cat_name = array('category_name'=>$categoryId,'tenant_id'=>$this->session->userdata('tenant_id'));

							$catExist=$this->modelbasic->getSelectedData('question_categories','*',$cat_name,'','','','','','row_array');

							if(empty($catExist))

							{

								$data=array('category_name'=>$categoryId,'tenant_id'=>$this->session->userdata('tenant_id'));

								$CAT_ID=$this->modelbasic->_insert('question_categories',$data);

							}

							else

							{

								$CAT_ID=$catExist['id'];

							}

							$data_one=array('quiz_id'=>$id,'category_id'=>$CAT_ID);

							$ress=$this->modelbasic->_insert('mock_quiz_category_relation',$data_one);

						}



					}

					if($res>0)

					{

						$successdata=array('status'=>'success','message'=>'Quiz updated successfully');

						$successdata['ajax']=json_encode($successdata);

						$this->load->view('ajax_view',$successdata);

					}



				}

				else

				{

					//echo "by";die;

					$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'quiz_name'=>$this->input->post('quiz_name',TRUE),'number_of_sections'=>$this->input->post('number_of_sections',TRUE),'mock'=>$this->input->post('mock',TRUE),'assessment_information'=>$this->input->post('assessment_information',TRUE),'bind_url'=>$this->input->post('bind_url',TRUE),'url'=>$this->input->post('url',TRUE));

					$res=$this->modelbasic->_insert('quiz_master',$data);

					$upload_path=file_upload_absolute_path();
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					$upload_path.='assesment/';
					if(!is_dir($upload_path))
					{
						@mkdir($upload_path, 0777, TRUE);
					}
					$uploadImg = uploadImage($_FILES,'logo',90,90,$upload_path);
					$updateData=array('assessment_image'=>$_FILES['logo']['name']);
					$res=$this->modelbasic->_update('quiz_master',$res,$updateData);

					if(!empty($_POST['category_id']) || isset($_POST['category_id']))

					{

						$catId = explode(',', $_POST['category_id']);

						foreach($catId as $categoryId)

						{

							$cat_name = array('category_name'=>$categoryId,'tenant_id'=>$this->session->userdata('tenant_id'));

							$catExist=$this->modelbasic->getSelectedData('question_categories','*',$cat_name,'','','','','','row_array');

							if(empty($catExist))

							{

								$data=array('category_name'=>$categoryId,'tenant_id'=>$this->session->userdata('tenant_id'));

								$CAT_ID=$this->modelbasic->_insert('question_categories',$data);

							}

							else

							{

								$CAT_ID=$catExist['id'];

							}

							$data_one=array('quiz_id'=>$res,'category_id'=>$CAT_ID);

							$ress=$this->modelbasic->_insert('mock_quiz_category_relation',$data_one);

							}



					}



					if($res>0)

					{

						$successdata=array('status'=>'success','message'=>'Quiz inserted successfully');

						$successdata['ajax']=json_encode($successdata);

						$this->load->view('ajax_view',$successdata);

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

	public function edit_quiz($id)

	{

		$res = array('id'=>$id );

		$data=$this->modelbasic->getSelectedData('quiz_master','*',$res,'','','','','','row_array');

	  	$quiz_cat=$this->test_model->get_Quiz_Category($id);

	  	$data['category_name'] = '';

	  	if(!empty($quiz_cat))

	  	{

	  		$i=1;

	  		foreach ($quiz_cat as $catname)

	  		{

	  			if($i == count($quiz_cat))

	  			{

	  				$data['category_name'].= $catname["category_name"];

	  			}

	  			else

	  			{

	  				$data['category_name'].= $catname["category_name"].',';

	  			}

	  			$i++;

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

					if($_POST['listaction'] == '3'){

						$this->modelbasic->_delete('quiz_master',$key);

						$this->session->set_flashdata('success', 'Quiz Deleted Successfully');

					}

				}

				redirect('manage_quiz');

			}

		}

	}