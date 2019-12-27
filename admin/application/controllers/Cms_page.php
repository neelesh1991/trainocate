<?php

if (!defined('BASEPATH'))

exit('No direct script access allowed');

class Cms_page extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		$this->load->model('test_model');

		$this->load->library('form_validation');

	}

	public function index()

	{

		$data['page_name']='cms_page/manage_cms_page_view';

		$this->load->view('index',$data);

	}

	public function getAjaxdataObjects()

	{

		//requested data for search

		$_POST['columns']='id,title,heading,url,keywords,meta_desc,description,status,created';

		$requestData = $_REQUEST;

		//print_r($requestData);die;

		$columns=explode(',',$_POST['columns']);

		//show columns list

		$selectColumns = "id,title,heading,url,keywords,meta_desc,description,status,created";

		//print_r($columns);die;

		//get total number of data without any condition and search term

		$totalData=$this->modelbasic->count_all_only('page_details');

		$totalFiltered=$totalData;

		//pass concatColumns only if you want search field to be fetch from concat

		$result=$this->modelbasic->run_query('page_details',$requestData,$columns,$selectColumns);

		//pr($result);die;

		if( !empty($requestData['search']['value']) )

		{

			$totalFiltered=count($result);

			//var_dump($totalData);die;

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

				

				$nestedData['title'] = '<div>'.$row["title"].'</div>';

				$nestedData['url'] = '<div><a href="'.front_base_url().$row['url'].'" target="_blank" >'.front_base_url().$row['url'].'</a></div>';

				$nestedData['status'] =$status;

				$nestedData['action'] = '<div class="menu-action dropdown">					

					<a onclick="edit_cms_page('.$row['id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-pencil"></i> </a>

					<a onclick="delete_confirm('.$row['id'].');" class="btn menu-icon vd_bd-red vd_red" data-placement="top" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-times"></i> </a>

					</div>';

				$nestedData['heading'] = $row['heading'];

				$nestedData['keywords'] = $row['keywords'];

				$nestedData['meta_desc'] = $row['meta_desc'];

				$nestedData['description'] = $row['description'];

				$data[] = $nestedData;

				$i++;

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

			$res=$this->test_model->_change_status($id,$status,'page_details');

			if($res>0)

		{
			$this->session->set_flashdata('success', 'Page Status Change Successfully');
			redirect('cms_page');

		}

		else

		{

			echo FALSE;

		}

	}

	public function delete_confirm($id)

	{

		$res=$this->modelbasic->_delete('page_details',$id);

		if($res>0)

		{
			$this->session->set_flashdata('success', 'Page Deleated Successfully');
			redirect('cms_page');

		}

		else

		{

			echo FALSE;

		}

	}

	public function add_edit()

	{

		//print_r($_POST);die;

		//echo "hi";die;

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('title','title','trim|required');

		$this->form_validation->set_rules('heading','heading','trim|required');

		$this->form_validation->set_rules('url','url','trim|required');

		$this->form_validation->set_rules('meta_desc','meta description','trim|required');

		$this->form_validation->set_rules('description','description','trim|required');

		$this->form_validation->set_rules('keywords','keywords','trim|required');

		if ($this->form_validation->run())

		{

			if($_POST['id']!='')

			{

				$id=$_POST['id'];				

				$data=array('title'=>$_POST['title'],'heading'=>$_POST['heading'],'url'=>$_POST['url'],'meta_desc'=>$_POST['meta_desc'],'description'=>$_POST['description'],'keywords'=>$_POST['keywords'],'created'=>date('Y-m-d H:i:s'));

				$res=$this->modelbasic->_update('page_details',$id,$data);

				$data=array('status'=>'success','message'=>'CMS page updated successfully.');				
				$data['ajax']=json_encode($data);				
				$this->load->view('ajax_view',$data);

			}

			else

			{

				$data=array('title'=>$_POST['title'],'heading'=>$_POST['heading'],'url'=>$_POST['url'],'meta_desc'=>$_POST['meta_desc'],'description'=>$_POST['description'],'keywords'=>$_POST['keywords'],'created'=>date('Y-m-d H:i:s'));

				$res=$this->modelbasic->_insert('page_details',$data);

				$data=array('status'=>'success','message'=>'CMS page inserted successfully.');				
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



	public function edit_cms($id)

	{

		//echo $id;die;

		$res = array('id'=>$id );

		$data=$this->modelbasic->getAllWhere('page_details','*',$res);

		//print_r($data);die;

		$data['ajax']=json_encode($data);

		

		$this->load->view('ajax_view',$data);

	}



	public function custum()

	{

	     $page = $this->uri->segment(1);

	     $this->load->model('admin/cms_model');

		 $data['page'] = $this->test_model->check_data($page);

	   	 if(!empty($data['page']))

		 {

		 	$this->load->view('admin/cms_view',$data);

		 }	

		 else

		 {

		   	echo '404 Page Not Found.';die;

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

					$this->modelbasic->_update('page_details',$key,$status);

					$this->session->set_flashdata('success', 'Cms Page activated successfully');

				}

				elseif($_POST['listaction'] == '2')

				{

					if($key != 1)

					{

						$status = array('status'=>'0');

						$this->modelbasic->_update('page_details',$key,$status);

						$this->session->set_flashdata('success', 'Cms Page deactivated successfully');

					}

				}

				elseif($_POST['listaction'] == '3'){



					$query = $this->modelbasic->getValue('page_details','id',$key);			

					$this->modelbasic->_delete('page_details',$key);

					$this->session->set_flashdata('success', 'Cms Page deleted successfully');

				}

			}

			redirect('cms_page');

		}

	}

}