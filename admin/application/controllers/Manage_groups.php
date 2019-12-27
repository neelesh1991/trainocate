<?php

if (!defined('BASEPATH'))

exit('No direct script access allowed');

class Manage_groups extends CI_Controller

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

		/*$res = array('id !='=>'1');

		$data['tenant']=$this->modelbasic->getAllWhere('tenant','*',$res);*/

		$data['users']=$this->modelbasic->getAllWhere('users','*');

		$data['page_name']='manage_groups/manage_groups_view';

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

		$_POST['columns']='id,tenant_id,group_name,status,created,signup_show';

		$requestData = $_REQUEST;

		$columns=explode(',',$_POST['columns']);

		$selectColumns = "id,tenant_id,group_name,status,created,signup_show";

		// $condition=array('tenant_id'=>$this->session->userdata('tenant_id'));
		$condition= "";
		if($this->session->userdata('tenant_id') != '1' && ($this->session->userdata('admin_level') != '1'))
	    {
	      $condition=array('tenant_id'=>$this->session->userdata('tenant_id'));
	    }

		$totalData=$this->modelbasic->count_all_only('manage_groups',$condition);

		$totalFiltered=$totalData;

		$result=$this->modelbasic->run_query('manage_groups',$requestData,$columns,$selectColumns,'','',$condition);



		//$result=$this->modelbasic->getAllWhere('manage_groups','*',$condition);

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

				$nestedData['info'] = '<div style="text-align:center;">'.$row["group_name"].'<br/></div>';

				$nestedData['status'] =$status;
				$nestedData['signup_show'] =($row["signup_show"])?'Yes':'No';

				$nestedData['tenant_id'] =$row["tenant_id"];
				$nestedData['group_name'] =$row["group_name"];

			   /* $createdDateVal = new DateTime($row["created"], new DateTimeZone('GMT') );

			    $createdDateVal->setTimeZone(new DateTimeZone($this->session->userdata('timezone')));*/

			    $start = new DateTime($row["created"], new DateTimeZone($tz_from));
			    $start->setTimeZone(new DateTimeZone($tz_to));
			    $created=$start->format($format);

			    $nestedData['created'] =$created;

			/*	$nestedData['created'] = $createdDateVal->format('M d,Y H:i:s');*/

				$nestedData['action'] = '<div class="menu-action">

							<a onclick="edit_group('.$row['id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-pencil"></i> </a>

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

		$res=$this->modelbasic->_delete('manage_groups',$id);

		if($res>0)

		{

			$this->session->set_flashdata('success', 'Group Deleted Successfully');

			redirect('manage_groups');

		}

		else

		{

			echo FALSE;

		}

	}

	public function change_status($id,$status)

		{

			$res=$this->test_model->_change_status($id,$status,'manage_groups');

			if($res>0)

		{

			$this->session->set_flashdata('success', 'Group Status Change Successfully');

			redirect('manage_groups');

		}

			else

			{

				echo FALSE;

			}

		}

		public function submit_group()
		{
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('group_name','group_name','trim|required');
			$this->form_validation->set_rules('signup_show','signup_show','trim|required');
				if ($this->form_validation->run())
				{
					$id=$this->input->post('id',TRUE);
					if($id !='')
					{

						$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'group_name'=>$this->input->post('group_name',TRUE),'created'=>date('Y-m-d H:i:s'),'signup_show'=>$this->input->post('signup_show',TRUE));

						$res=$this->modelbasic->_update('manage_groups',$id,$data);

						$data=array('status'=>'success','message'=>'Group updated successfully.');
						$data['ajax']=json_encode($data);
						$this->load->view('ajax_view',$data);
					}
					else
					{

						$data=array('tenant_id'=>$this->session->userdata('tenant_id'),'group_name'=>$this->input->post('group_name',TRUE),'created'=>date('Y-m-d H:i:s'),'signup_show'=>$this->input->post('signup_show',TRUE));

						$res=$this->modelbasic->_insert('manage_groups',$data);
						$data=array('status'=>'success','message'=>'Group created successfully.');
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

	public function edit_group($id)

	{

		$res = array('id'=>$id );

		$data=$this->modelbasic->getAllWhere('manage_groups','*',$res);

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

						$this->modelbasic->_update('manage_groups',$key,$status);

						$this->session->set_flashdata('success', 'Group activated successfully');

					}

					elseif($_POST['listaction'] == '2')

					{

							$status = array('status'=>'0');

							$this->modelbasic->_update('manage_groups',$key,$status);

							$this->session->set_flashdata('success', 'Group deactivated successfully');

					}

					elseif($_POST['listaction'] == '3'){

						$this->modelbasic->_delete('manage_groups',$key);

						$this->session->set_flashdata('success', 'Group deleted successfully');

					}

				}

				redirect('manage_groups');

			}

		}

	}