<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Manage_quiz_section extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('test_model');
	}
	public function index()
	{
		/*$res = array('id !='=>'1');
		$data['tenant']=$this->modelbasic->getAllWhere('tenant','*',$res);*/
		$res = array('tenant_id'=>$this->session->userdata('tenant_id'));
		$data['question_categories']=$this->modelbasic->getAllWhere('question_categories','*',$res);
		$data['quiz_section']=$this->modelbasic->getAllWhere('quiz_master','*',$res);
		$data['page_name']='manage_quiz_section/manage_quiz_section_view';
		//echo "<pre/>"; print_r($data); die;
		$this->load->view('index',$data);
	}
	public function getAjaxdataObjects()
	{
		$_POST['columns']='A.id,A.tenant_id,A.section_name,A.no_of_questions,D.quiz_name';
		$requestData = $_REQUEST;
		$columns=explode(',',$_POST['columns']);
		$selectColumns = "A.id,A.tenant_id,A.section_name,A.no_of_questions,D.quiz_name";
		// $condition=array('A.tenant_id'=>$this->session->userdata('tenant_id'));
		$condition= "";
		if($this->session->userdata('tenant_id') != '1' && ($this->session->userdata('admin_level') != '1'))
	    {
	      $condition=array('A.tenant_id'=>$this->session->userdata('tenant_id'));
	    }
		$totalData=$this->modelbasic->count_all_only('quiz_section as A',$condition);
		$totalFiltered=$totalData;
		$data_array=array(array('section_category_relations as B','B.section_id=A.id'),array('question_categories as C','B.category_id=C.id'),array('quiz_master as D','A.quiz_id=D.id'));

		$result=$this->modelbasic->run_query('quiz_section as A',$requestData,$columns,$selectColumns,'','',$condition,$data_array,'A.id');
		if( !empty($requestData['search']['value']) )
		{
			$totalFiltered=count($result);
		}
		$data = array();
		if(!empty($result))
		{
			$i=1;
			foreach ($result as $key => $row)
			{
				$nestedData=array();
				$nestedData['chk'] = '<div class="vd_checkbox checkbox-success"><input type="checkbox" class="case" id="check-'.$row["id"].'" name="checkall['.$row["id"].']" data-index="'.$row["id"].'"><label for="check-'.$row["id"].'"> </label></div>';
				$nestedData['id'] =$row["id"];
				$nestedData['info'] = '<div style="text-align:center;">'.$row["section_name"].'<br/></div>';
				$nestedData['no_of_questions'] =$row["no_of_questions"];
				$ress = array('section_id'=>$row["id"],'tenant_id'=>$row["tenant_id"]);
				$que_cat=$this->test_model->get_Category($ress);

				$cat = '';
				if(!empty($que_cat))
				{
					
					foreach ($que_cat as $key => $catname)
					{
						$cat.= '<div class="label label-success">'.$catname["category_name"].'</div>&nbsp;';
					}
				}
			   	$nestedData['category_name'] = $cat;
			   	$nestedData['quiz_name'] = $row['quiz_name'];
				$nestedData['action'] = '<div class="menu-action">
					<a onclick="edit_section('.$row['id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-pencil"></i> </a>
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
		$res=$this->modelbasic->_delete('quiz_section',$id);
		if($res>0)
		{
			$this->session->set_flashdata('success', 'Quiz section deleted successfully');
			redirect('manage_quiz_section');
		}
		else
		{
			echo FALSE;
		}
	}
	public function getcategories()
	{
		$search = $this->input->post('categorySearch_startsWith',TRUE);
		$data = $this->test_model->categorySearch($search);
		$data['ajax']=json_encode($data);
		$this->load->view('ajax_view',$data);
	}
	public function submit_section()
	{
		//print_r($_POST);die;
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('quiz_id','Quiz Id','trim|required');
		$this->form_validation->set_rules('section_name[]','Section Name','trim|required');
		$this->form_validation->set_rules('no_of_questions[]','No of Questions','trim|required');
		$this->form_validation->set_rules('category_id[]','Category','trim|required');
		if ($this->form_validation->run())
		{
			$id=$this->input->post('id',TRUE);
			if($id !='')
			{
				if(!empty($_POST['category_id']) || isset($_POST['category_id']))
				{
					for ($i=0; $i < count($_POST['section_name']); $i++)
					{
						if($_POST['section_name'][$i]!='' && $_POST['category_id'][$i]!='' && $_POST['no_of_questions'][$i]!='')
						{
						$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'quiz_id'=>$this->input->post('quiz_id',TRUE),'section_name'=>$_POST['section_name'][$i],'no_of_questions'=>$_POST['no_of_questions'][$i]);
					$updatedSectionId=$this->modelbasic->_update('quiz_section',$id,$data);
					$delete_cat=$this->test_model->deleteCatyegory($id);
					$catId = explode(',', $_POST['category_id'][$i]);
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
						$data_one=array('section_id'=>$id,'category_id'=>$CAT_ID);
						$res=$this->modelbasic->_insert('section_category_relations',$data_one);
							}
						}
					}
				}
				$data=array('status'=>'success','message'=>'Quiz section created successfully.');
				$data['ajax']=json_encode($data);
				$this->load->view('ajax_view',$data);
			}
			else
			{
				if(!empty($_POST['section_name']))
				{
					for ($i=0; $i < count($_POST['section_name']); $i++)
					{
						if($_POST['section_name'][$i]!='' && $_POST['category_id'][$i]!='' && $_POST['no_of_questions'][$i]!='')
						{
							$noOfSections=$this->modelbasic->getValue('quiz_master','number_of_sections',array('id'=>$this->input->post('quiz_id',TRUE)));
							$noOfExistingSections=$this->modelbasic->count_where('quiz_section','quiz_id', $this->input->post('quiz_id',TRUE));

							if($noOfSections > 0 && ($noOfExistingSections == '' || $noOfSections > $noOfExistingSections ) )
							{
								$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'quiz_id'=>$this->input->post('quiz_id',TRUE),'section_name'=>$_POST['section_name'][$i],'no_of_questions'=>$_POST['no_of_questions'][$i]);
								$InsertedSectionId=$this->modelbasic->_insert('quiz_section',$data);
								$catId = explode(',', $_POST['category_id'][$i]);
								foreach($catId as $categoryId)
								{
									$cat_name = array('category_name'=>$categoryId,'tenant_id'=>$this->session->userdata('tenant_id'));
									//print_r($cat_name);die();
									$catExist=$this->modelbasic->getSelectedData('question_categories','*',$cat_name,'','','','','','row_array');
									//print_r($catExist);die;
									if(empty($catExist))
									{
										$data=array('category_name'=>$categoryId,'tenant_id'=>$this->session->userdata('tenant_id'));
										$CAT_ID=$this->modelbasic->_insert('question_categories',$data);
									}
									else
									{
										$CAT_ID=$catExist['id'];
									}
									//print_r($CAT_ID);die;
									$data_one=array('section_id'=>$InsertedSectionId,'category_id'=>$CAT_ID);
									$res=$this->modelbasic->_insert('section_category_relations',$data_one);
								}
							}
							elseif($noOfSections == '')
							{
								$failData=array('status'=>'fail','message'=>'Quiz you have selected must have at least one section.');
/*								$data['ajax']=json_encode($data);
								$this->load->view('ajax_view',$data);*/
 								continue;
							}
							else
							{
								$failData=array('status'=>'fail','message'=>'You already have required number of sections for selected quiz.');
/*								$data['ajax']=json_encode($data);
								$this->load->view('ajax_view',$data);*/
								 continue;
							}
						}
					}
					if(isset($failData) && !empty($failData))
					{
						$failData['ajax']=json_encode($failData);
						$this->load->view('ajax_view',$failData);
					}
					else
					{
						$data=array('status'=>'success','message'=>'Quiz section inserted successfully.');
						$data['ajax']=json_encode($data);
						$this->load->view('ajax_view',$data);
					}

				}
				else
				{
					$data=array('status'=>'fail','message'=>'Select quiz name.');
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
	public function edit_section($id)
	{
		$data=$this->test_model->getAllSectionWhere($id);
		$ress = array('section_id'=>$data["id"],'tenant_id'=>$data["tenant_id"]);
		$que_cat=$this->test_model->get_Category($ress);
		if(!empty($que_cat))
		{
			$data['category_name'] = '';
			$i=1;
			foreach ($que_cat as $catname)
			{
				if($i == count($que_cat))
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
						$this->modelbasic->_delete('quiz_section',$key);
						$this->session->set_flashdata('success', 'Section deleted successfully');
					}
				}
				redirect('manage_quiz_section');
			}
		}
	public function set_quiz_id()
	{
		if($_POST['editQId']!='')
		{
			$noOfSection='1';
		}
		else
		{
			$res=array('id'=>$_POST['QuizId']);
			$section=$this->modelbasic->getAllWhere('quiz_master','number_of_sections',$res);
			$noOfSection=$section[0]['number_of_sections'];
		}
		echo $noOfSection;
	}
}