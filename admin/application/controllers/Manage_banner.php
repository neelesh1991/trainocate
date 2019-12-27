<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Manage_banner extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->helper('imgupload');
		$this->load->library('form_validation');
		$this->load->model('test_model');
	}
	public function index()
	{
		//$res = array('id !='=>'1');
		//$data['tenant']=$this->modelbasic->getAllWhere('tenant','*',$res);
		$data['manage_banner']=$this->modelbasic->getAllWhere('manage_banner','*');
		$data['page_name']='manage_banner/manage_banner_view';
		$this->load->view('index',$data);
	}
	public function getAjaxdataObjects()
	{
		$_POST['columns']='id,tenant_id,banner_title,banner_text,banner_image,status,created';
		$requestData = $_REQUEST;
		$columns=explode(',',$_POST['columns']);
		$selectColumns = "id,tenant_id,banner_title,banner_text,banner_image,status,created";
		$condition=array('tenant_id'=>$this->session->userdata('tenant_id'));
		$totalData=$this->modelbasic->count_all_only('manage_banner',$condition);
		$totalFiltered=$totalData;
		$result=$this->modelbasic->run_query('manage_banner',$requestData,$columns,$selectColumns,'','',$condition);

		//$result=$this->modelbasic->getAllWhere('manage_banner','*',$condition);
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
					if($row["banner_image"]!='')
					{
						$filename='../uploads/'. $row['tenant_id'].'/banner/'.$row["banner_image"];
					  if (file_exists($filename))
					  	{
					  		$img='<img class="width-30" src="'.front_base_url().'uploads/'. $row['tenant_id'].'/banner/thumbs/'.$row["banner_image"].'">';
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
				$nestedData['info'] = '<a href='.base_url().'manage_banner><div>'.$img.'</div></a><div style="text-align:center;">'.$row["banner_title"].'</div>';

				$nestedData['status'] =$status;
				$nestedData['banner_text'] =$row["banner_text"];
				$nestedData['tenant_id'] =$row["tenant_id"];
			    $createdDateVal = new DateTime($row["created"], new DateTimeZone('GMT') );
			    if($this->session->userdata('timezone')!='')
			    {
			    	$createdDateVal->setTimeZone(new DateTimeZone($this->session->userdata('timezone')));
			    }
			    else
			    {
			    	$createdDateVal->setTimeZone(new DateTimeZone("Asia/Kolkata"));
			    }
				$nestedData['created'] = $createdDateVal->format('M d,Y H:i:s');
				$nestedData['action'] = '<div class="menu-action">
							<a onclick="edit_banner('.$row['id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-pencil"></i> </a>
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
		$res=$this->modelbasic->_delete('manage_banner',$id);
		if($res>0)
		{
			$this->session->set_flashdata('success', 'Banner Deleted Successfully');
			redirect('manage_banner');
		}
		else
		{
			echo FALSE;
		}
	}
	public function change_status($id,$status)
		{
			$res=$this->test_model->_change_status($id,$status,'manage_banner');
			if($res>0)
		{
			$this->session->set_flashdata('success', 'Banner Status Change Successfully');
			redirect('manage_banner');
		}
			else
			{
				echo FALSE;
			}
		}
	public function add_edit_banner()
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('banner_title','Banner Title','trim|required');
		//$this->form_validation->set_rules('tenant_id','Admin Name','trim|required');
		$this->form_validation->set_rules('banner_text','Banner Text','trim|required');
		if ($this->form_validation->run())
		{
			$folderName = $this->session->userdata('tenant_id');
			$upload_path=file_upload_absolute_path().$folderName.'/';
			if(!is_dir($upload_path))
			{
				@mkdir($upload_path, 0777, TRUE);
			}
			$upload_path.='banner/';
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
			$id=$this->input->post('id',TRUE);
			if($id !='')
			{
				if($_FILES['banner_image']['name']!='')
				{
					$result = uploadImage($_FILES,'banner_image',90,90,$upload_path,'big_thumbs',1920,700);
					$data=array('banner_title'=> $this->input->post('banner_title',TRUE),'tenant_id'=>$this->session->userdata('tenant_id'),'banner_text'=>$this->input->post('banner_text',TRUE),'banner_image'=>$_FILES['banner_image']['name'],'created'=>date('Y-m-d H:i:s'));
					$res=$this->modelbasic->_update('manage_banner',$id,$data);
					$data=array('status'=>'success','message'=>'Banner updated successfully.');
					$data['ajax']=json_encode($data);
					$this->load->view('ajax_view',$data);
				}
				else
				{
					$data=array('banner_title'=>$this->input->post('banner_title',TRUE),'tenant_id'=>$this->session->userdata('tenant_id'),'banner_text'=>$this->input->post('banner_text',TRUE),'created'=>date('Y-m-d H:i:s'));
					$res=$this->modelbasic->_update('manage_banner',$id,$data);
					$data=array('status'=>'success','message'=>'Banner updated successfully.');
					$data['ajax']=json_encode($data);
					$this->load->view('ajax_view',$data);
				}
			}
			else
			{
				$result = uploadImage($_FILES,'banner_image',90,90,$upload_path,'big_thumbs',1920,700);
				$data=array('banner_title'=>$this->input->post('banner_title',TRUE),'tenant_id'=>$this->session->userdata('tenant_id'),'banner_text'=>$this->input->post('banner_text',TRUE),'banner_image'=>$_FILES['banner_image']['name'],'created'=>date('Y-m-d H:i:s'));
				$res=$this->modelbasic->_insert('manage_banner',$data);
				$data=array('status'=>'success','message'=>'Banner added successfully.');
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

	public function edit_banner($id)
	{
		$res = array('id'=>$id );
		//$data=$this->modelbasic->getAllWhere('manage_banner','*',$res);
		$data=$this->modelbasic->getSelectedData('manage_banner','*',$res,'','','','','','row_array');
		$data['ajax']=json_encode($data);
		$this->load->view('ajax_view',$data);
	}

	public function multiselect_action()
	{
		if(isset($_POST['submit']))
		{
			$check = $_POST['checkall'];
			foreach($check as $key => $value)
			{
				if($_POST['listaction'] == '1')
				{
					$status = array('status'=>'1');
					$this->modelbasic->_update('manage_banner',$key,$status);
					$this->session->set_flashdata('success', 'Banner activated successfully');
				}
				elseif($_POST['listaction'] == '2')
				{
						$status = array('status'=>'0');
						$this->modelbasic->_update('manage_banner',$key,$status);
						$this->session->set_flashdata('success', 'Banner deactivated successfully');
				}
				elseif($_POST['listaction'] == '3'){
					$this->modelbasic->_delete('manage_banner',$key);
					$this->session->set_flashdata('success', 'Banner deleted successfully');
				}
			}
			redirect('manage_banner');
		}
	}
}