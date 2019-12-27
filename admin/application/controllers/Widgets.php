<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Widgets extends CI_Controller
{
	function __construct()
	{
	    	parent::__construct();
	    	$this->load->model('test_model');
	    	$this->load->library('form_validation');
	}
	public function index()
	{
		$data['page_name']='widgets/manage_widgets_view';
		$this->load->view('index',$data);
	}
	public function getAjaxdataObjects()
	{
		//requested data for search
		$_POST['columns']='id,widget_name,info,page_name';
		$requestData = $_REQUEST;
		//print_r($requestData);die;
		$columns=explode(',',$_POST['columns']);
		//show columns list
		$selectColumns = "id,widget_name,info,page_name";
		$condition=array('tenant_id'=>$this->session->userdata('tenant_id'));
		//print_r($columns);die;
		//get total number of data without any condition and search term
		$totalData=$this->modelbasic->count_all_only('widgets',$condition);
		$totalFiltered=$totalData;
		//pass concatColumns only if you want search field to be fetch from concat
		//$result=$this->test_model->run_MY_Query('widgets',$requestData,$columns,$selectColumns,'','',$condition);
		//pr($result);die;
		$result=$this->modelbasic->run_query('widgets',$requestData,$columns,$selectColumns,'','',$condition);
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
				 if(($row['info']!='')&&($row['widget_name']!=''))
				{
					$pos=100;
					$msg = substr(strip_tags($row['info']), 0, $pos);
					$msg = $msg.'...';
				}else{
					$msg = $row['info'];
				}

				$nestedData['chk'] = '<div class="vd_checkbox checkbox-success"><input type="checkbox" class="case" id="check-'.$row["id"].'" name="checkall['.$row["id"].']" data-index="'.$row["id"].'"><label for="check-'.$row["id"].'"> </label></div>';
				$nestedData['id'] =$row["id"];
				$nestedData['page_name'] =$row["page_name"];
				$nestedData['widget_name'] = $row['widget_name'];
				$nestedData['contains'] = $msg;
				$nestedData['fullcontains'] = $row['info'];
				$nestedData['action'] = '<div class="menu-action dropdown">
				  <a onclick="edit_widgets('.$row['id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil"></i> </a>

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

	public function add_edit_widgets()
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('widget_name','subject','trim|required');
		$this->form_validation->set_rules('info','Contains','trim|required');
		$this->form_validation->set_rules('page_name','Page Name','trim|required');
		if ($this->form_validation->run())
		{
			$id=$this->input->post('id',TRUE);
			if($id !='')
			{
			$data=array('widget_name'=>$_POST['widget_name'],'info'=>$_POST['info'],'page_name'=>$_POST['page_name']);

			$where_array=array('id'=>$id,'tenant_id'=>$this->session->userdata('tenant_id'));

			$res=$this->modelbasic->accessDatabase('widgets','*', 'update', $data, $where_array, $join_array="",$limit="");
			$data=array('status'=>'success','message'=>'Widget updated successfully.');
			$data['ajax']=json_encode($data);
			$this->load->view('ajax_view',$data);
			}
			else
			{



				$total_widgets=$this->test_model->countwidgets($this->session->userdata('tenant_id'));
					$id = ($total_widgets+1);

				$data=array('id'=>$id,'widget_name'=>$_POST['widget_name'],'info'=>$_POST['info'],'page_name'=>$_POST['page_name'],'tenant_id'=>$this->session->userdata('tenant_id'),'created'=>date('Y-m-d H:i:s'));

				$res=$this->modelbasic->_insert('widgets',$data);

				$data=array('status'=>'success','message'=>'Widget updated successfully.');
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
	public function edit_widgets($widgetsId)
	{
		//echo $id;die;
		$widgetsId = array('id'=>$widgetsId );
		$data=$this->modelbasic->getAllWhere('widgets','*',$widgetsId);
	//	print_r($data);die;
		$data['ajax']=json_encode($data);
		$this->load->view('ajax_view',$data);
	}
}