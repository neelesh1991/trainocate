<?php



if (!defined('BASEPATH'))



exit('No direct script access allowed');



class Contact_us extends CI_Controller



{



	function __construct()



	{



		parent::__construct();



		$this->load->model('test_model');



	}



	public function index()



	{



		$data['emailId']=$this->modelbasic->getAllWhere('contact_us','email');



		$data['page_name']='contact_us/manage_contact_us_view';



		$this->load->view('index',$data);



	}



	public function getAjaxdataObjects()

	{

		$_POST['columns']='id,name,email,subject,message,status,created';

		$requestData = $_REQUEST;

		$columns=explode(',',$_POST['columns']);

		$selectColumns = "id,name,email,subject,message,status,created";

		$condition=array('tenant_id'=>$this->session->userdata('tenant_id'));	

		$totalData=$this->modelbasic->count_all_only('contact_us',$condition);

		//$totalData=$this->modelbasic->count_all_only('contact_us');

		$totalFiltered=$totalData;

		//$result=$this->modelbasic->run_query('contact_us',$requestData,$columns,$selectColumns);

		$result=$this->modelbasic->getAllWhere('contact_us','*',$condition);

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



				$nestedData['info'] = '<div class="menu-icon"></div><div style="text-align:center;">'.$row["name"].' '.$row["name"].'<br/></div>';



				$nestedData['email'] = '<div>'.$row['email'].'</div>';



				$nestedData['status'] =$status;



/*($row["status"]==1)?'<span class="label label-success">Active</span>':($row["status"]==2)?'<span class="label label-default">Inactive</span>':'';*/



				$nestedData['action'] = '<div class="menu-action dropdown">



						



						<a class="btn menu-icon vd_bd-green vd_green" href="javascript:void(0);" onclick="replay('.$row["id"].')"  data-target="#myAlbumModal" data-toggle="modal">Replay</a>



		<a onclick="delete_confirm('.$row['id'].');" class="btn menu-icon vd_bd-red vd_red" data-placement="top" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-times"></i> </a>



	</div>



';



				



				$nestedData['message']=$row['message'];



				



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



		$res=$this->test_model->_change_status($id,$status,'contact_us');



		if($res>0)



	{



		$data['page_name']='contact_us/manage_contact_us_view';



		$this->load->view('index',$data);



	}



		else



		{



			echo FALSE;



		}



	}



	public function delete_confirm($id)



	{



		$res=$this->modelbasic->_delete('contact_us',$id);



		if($res>0)



		{

			$this->session->set_flashdata('success', 'Enquiry Deleated successfully');



			redirect('contact_us');



		}



		else



		{



			echo FALSE;



		}



	}



	public function replay($id)



	{



		$res = array('id'=>$id );



		$data=$this->modelbasic->getAllWhere('contact_us','email,subject',$res);



		$data['ajax']=json_encode($data);



		$this->load->view('ajax_view',$data);



	}







	public function send_multiple_mail()



	{



		$email=$_POST['email'];



		if(!empty($email))



		{



			foreach ($email as $emailId) {



				$data['to']=$emailId;



				$data['fromEmail']='quizadmin@emmersivedemos.in';



				$data['subject']=$_POST['subject'];



				$data['template']=$_POST['text'];



				$data['result']=$this->test_model->get_all_settings();



				$result=$this->modelbasic->sendMail($data);



			}



		}



		$this->session->set_flashdata('success', 'Replay to Enquiry successfully');



		redirect('contact_us');	



	}







	public function send_mail()



	{



		$data['to']=$_POST['email'];



		$data['fromEmail']='quizadmin@emmersivedemos.in';



		$data['subject']=$_POST['subject'];



		$data['template']=$_POST['text'];



		$data['result']=$this->test_model->get_all_settings();



		$result=$this->modelbasic->sendMail($data);



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



					$this->modelbasic->_update('contact_us',$key,$status);



					$this->session->set_flashdata('success', 'Enquiry activated successfully');



				}



				elseif($_POST['listaction'] == '2')



				{



					if($key != 1)



					{



						$status = array('status'=>'0');



						$this->modelbasic->_update('contact_us',$key,$status);



						$this->session->set_flashdata('success', 'Enquiry deactivated successfully');



					}



				}



				elseif($_POST['listaction'] == '3'){







					$query = $this->modelbasic->getValue('contact_us','id',$key);			



					$this->modelbasic->_delete('contact_us',$key);



					$this->session->set_flashdata('success', 'Enquiry deleted successfully');



				}



			}



			redirect('contact_us');



		}



	}







	



}