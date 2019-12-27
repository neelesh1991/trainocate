<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Email_template extends CI_Controller
{
	function __construct()
	{
	    	parent::__construct();
	    	$this->load->model('test_model');
	    	$this->load->library('form_validation');
	}
	public function index()
	{
		$data['page_name']='email_template/manage_email_template_view';
		$this->load->view('index',$data);
	}
	public function getAjaxdataObjects()
	{
		//requested data for search
		$_POST['columns']='id,subject,email_contains,status,created';
		$requestData = $_REQUEST;
		//print_r($requestData);die;
		$columns=explode(',',$_POST['columns']);
		//show columns list
		$selectColumns = "id,subject,email_contains,status,created";
		//print_r($columns);die;
		//get total number of data without any condition and search term

		$condition=array('tenant_id'=>$this->session->userdata('tenant_id'));


		$totalData=$this->modelbasic->count_all_only('manage_email_template',$condition);
		$totalFiltered=$totalData;
		//pass concatColumns only if you want search field to be fetch from concat
		$result=$this->modelbasic->run_query('manage_email_template',$requestData,$columns,$selectColumns,'','',$condition);
		//$result=$this->modelbasic->run_query('manage_email_template',$requestData,$columns,$selectColumns);
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
				$nestedData['subject'] = $row['subject'];
				$nestedData['email_contains'] = $row['email_contains'];

				//$nestedData['email'] = '<div style="text-align:left;">'.$row['email'].'</div>';
				$nestedData['status'] =$status;
/*($row["status"]==1)?'<span class="label label-success">Active</span>':($row["status"]==2)?'<span class="label label-default">Inactive</span>':'';*/
				//$createdDateVal = new DateTime($row["created"], new DateTimeZone('GMT') );
				//  $createdDateVal->setTimeZone(new DateTimeZone($this->session->userdata('timezone')));

				//$nestedData['created'] = $createdDateVal->format('M d,Y H:i:s');
				$nestedData['created'] = $row["created"];

				$nestedData['action'] = '<div class="menu-action dropdown">
				  <a onclick="edit_email_template('.$row['id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-pencil"></i> </a>
			      <a onclick="delete_confirm('.$row['id'].');" class="btn menu-icon vd_bd-red vd_red" data-placement="top" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-times"></i> </a>
                              	</div>
                              ';



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
		if($status == 1)
		{
			$data=array('status'=>0);
		}
		else
		{
			$data=array('status'=>1);
		}
		//$status = array('status'=>$status);
		$where_array=array('id'=>$id,'tenant_id'=>$this->session->userdata('tenant_id'));
		$res=$this->modelbasic->accessDatabase('manage_email_template','*', 'update', $data, $where_array, $join_array="",$limit="");



		//$res=$this->test_model->_change_status($id,$status,'manage_email_template');
		if($res>0)
       	{
       		$this->session->set_flashdata('success', 'Status Change successfully');
       		redirect('email_template');
      	}
	   	else
	   	{
	   		echo FALSE;
	   	}
	}
	public function delete_confirm($id)
	{
		$res=$this->modelbasic->_delete_with_conditions('manage_email_template',array('id'=>$id,'tenant_id'=>$this->session->userdata('tenant_id')));
		if($res>0)
		{
			$this->session->set_flashdata('success', 'Email Template Deleated successfully');
			redirect('email_template');
		}
		else
		{
			echo FALSE;
		}
	}
	public function add_edit_email()
	{
		//print_r($_POST);die;
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('subject','subject','trim|required');
		$this->form_validation->set_rules('email_contains','email_contains','trim|required');
		if ($this->form_validation->run())
		{
			if($_POST['id']!='')
			{
				$id=$_POST['id'];
				$data=array('subject'=>$_POST['subject'],'email_contains'=>$_POST['email_contains']);

				$where_array=array('id'=>$id,'tenant_id'=>$this->session->userdata('tenant_id'));


				//$res=$this->modelbasic->_update('manage_email_template',$id,$data);

				$res=$this->modelbasic->accessDatabase('manage_email_template','*', 'update', $data, $where_array, $join_array="",$limit="");

				$data=array('status'=>'success','message'=>'Email template updated successfully.');
				$data['ajax']=json_encode($data);
				$this->load->view('ajax_view',$data);
			}
			else
			{
				$total_email=$this->test_model->countemailtemplate($this->session->userdata('tenant_id'));
					$id = ($total_email+1);
				$data=array('id'=>$id,'subject'=>$_POST['subject'],'email_contains'=>$_POST['email_contains'],'created'=>date('Y-m-d H:i:s'),'tenant_id'=>$this->session->userdata('tenant_id'));
				$res=$this->modelbasic->_insert('manage_email_template',$data);
				$data=array('status'=>'success','message'=>'Email template created successfully.');
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
	public function edit_email_template($id)
	{
		$res = array('id'=>$id,'tenant_id'=>$this->session->userdata('tenant_id'));
		$data=$this->modelbasic->getAllWhere('manage_email_template','*',$res);
		$data['ajax']=json_encode($data);
		$this->load->view('ajax_view',$data);
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
					//$this->modelbasic->_update('manage_email_template',$key,$status);
					$where_array=array('id'=>$key,'tenant_id'=>$this->session->userdata('tenant_id'));
					$res=$this->modelbasic->accessDatabase('manage_email_template','*', 'update', $status, $where_array, $join_array="",$limit="");

					$this->session->set_flashdata('success', 'Email template activated successfully');
				}
				elseif($_POST['listaction'] == '2')
				{
					
						$status = array('status'=>'0');

						//$this->modelbasic->_update('manage_email_template',$key,$status);

						$where_array=array('id'=>$key,'tenant_id'=>$this->session->userdata('tenant_id'));
						$res=$this->modelbasic->accessDatabase('manage_email_template','*', 'update', $status, $where_array, $join_array="",$limit="");


						$this->session->set_flashdata('success', 'Email template deactivated successfully');
					
				}
				elseif($_POST['listaction'] == '3'){
					//$query = $this->modelbasic->getValue('manage_email_template','id',$key);
					//$this->modelbasic->_delete('manage_email_template',$key);
					$res=$this->modelbasic->_delete_with_conditions('manage_email_template',array('id'=>$key,'tenant_id'=>$this->session->userdata('tenant_id')));
					$this->session->set_flashdata('success', 'Email template deleted successfully');
				}
			}
			redirect('email_template');
		}
	}


}