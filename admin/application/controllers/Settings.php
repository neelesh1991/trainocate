<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Settings extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('form_validation');
		$this->load->helper('imgupload');
		$this->load->model('test_model');
	}

	public function index()
	{
		//print_r($this->session->userdata());die;
		$data['result']=$this->test_model->get_all_settings();
		$data['currency']=$this->modelbasic->getAllWhere('currency','name,code');
		$data['timeZone']=$this->modelbasic->getAllWhere('timezone','name,timezone');
		$data['page_name']='settings/manage_settings_view';
		$this->load->view('index',$data);
	}

	public function system_setting()
	{
		$data=array('system_name'=>$this->input->post('system_name',TRUE),'system_title'=>$this->input->post('system_title',TRUE),'time_zone'=>$this->input->post('time_zone',TRUE),'currencies'=>$this->input->post('currencies',TRUE));

		$timezone=$this->input->post('time_zone',TRUE);
		$currency=$this->input->post('currencies',TRUE);
		$setTime_Cur=array('timezone'=>$timezone,'currency'=>$currency);
		$this->session->unset_userdata('timezone');
		$this->session->unset_userdata('currency');
		$this->session->set_userdata($setTime_Cur);

		$Mydata=$this->update_settings($data);
		$this->session->set_flashdata('success', 'System Settings Updated successfully');
		redirect('settings');
	}
	public function theam_setting()
	{
		$upload_path_base=file_upload_absolute_path().'settings';
		if(!is_dir($upload_path_base))
		{
			@mkdir($upload_path_base, 0777, TRUE);
		}

		$upload_path_logo=file_upload_absolute_path().'settings/logo';
		if(!is_dir($upload_path_logo))
		{
			@mkdir($upload_path_logo, 0777, TRUE);
		}

		$upload_path_logoThumbs=file_upload_absolute_path().'settings/logo/thumbs';
		if(!is_dir($upload_path_logoThumbs))
		{
			@mkdir($upload_path_logoThumbs, 0777, TRUE);
		}

		$upload_path_favicon=file_upload_absolute_path().'settings/favicon';
		if(!is_dir($upload_path_favicon))
		{
			@mkdir($upload_path_favicon, 0777, TRUE);
		}

		$upload_path_faviconThumbs=file_upload_absolute_path().'settings/favicon/thumbs';
		if(!is_dir($upload_path_faviconThumbs))
		{
			@mkdir($upload_path_faviconThumbs, 0777, TRUE);
		}

		$uploadhomePageImage=file_upload_absolute_path().'settings/homePageImage';
		if(!is_dir($uploadhomePageImage))
		{
			@mkdir($uploadhomePageImage, 0777, TRUE);
		}

		$uploadhomePageImageThumbs=file_upload_absolute_path().'settings/homePageImage/thumbs';
		if(!is_dir($uploadhomePageImageThumbs))
		{
			@mkdir($uploadhomePageImageThumbs, 0777, TRUE);
		}

		$data=array('header_color'=>$this->input->post('header_color',TRUE),'footer_color'=>$this->input->post('footer_color',TRUE),'profileColor'=>$this->input->post('profileColor',TRUE),'leftNavColor'=>$this->input->post('leftNavColor',TRUE));

		$imagedata=$this->test_model->get_all_settings();		
		$hedLogo = $imagedata['4']['description'];
		$favicon = $imagedata['5']['description'];
		$home_page_image = $imagedata['14']['description'];
		$imageNameWithPathHeaderLogo = $upload_path_logo.'/'.$hedLogo;
		$imageNameWithPathHeaderLogothumb = $upload_path_logoThumbs.'/'.$hedLogo;
		$imageNameWithPathFavicon = $upload_path_favicon.'/'.$favicon;
		$imageNameWithPathFaviconthumb = $upload_path_faviconThumbs.'/'.$favicon;
		$home_page_image_with_path = $uploadhomePageImage.'/'.$home_page_image;
		$home_page_image_with_path_thumbs = $uploadhomePageImageThumbs.'/'.$home_page_image;
		
		if(!empty($_FILES['header_logo']['name']) && isset($_FILES['header_logo']['name']))
		{

			$unlink_header_logo = unlinkImage($imageNameWithPathHeaderLogo,$hedLogo,$upload_path_logo);
			$unlink_header_logo_thumb = unlinkImage($imageNameWithPathHeaderLogothumb,$hedLogo,$upload_path_logoThumbs);
			$result = uploadImage($_FILES,'header_logo',194,40,$upload_path_logo);
			$data['header_logo']=$_FILES['header_logo']['name'];
		}


		if(!empty($_FILES['favicon']['name']) && isset($_FILES['favicon']['name']))
		{
			$unlink_header_logo = unlinkImage($imageNameWithPathFavicon,$favicon,$upload_path_favicon);
			$unlink_header_logo_thumb = unlinkImage($imageNameWithPathFaviconthumb,$favicon,$upload_path_faviconThumbs);
			$result = uploadImage($_FILES,'favicon',32,32,$upload_path_favicon);
			$data['favicon']=$_FILES['favicon']['name'];
		}


		if(!empty($_FILES['home_page_image']['name']) && isset($_FILES['home_page_image']['name']))
		{
			$url=front_base_url();
			$filename="$url/upload/settings/homePageImage/".$result[4]['description'];
			if (file_exists($filename))
			{ 
			$unlink_home_page_image = unlinkImage($home_page_image_with_path,$home_page_image,$uploadhomePageImage);
			$unlink_home_page_image_thumb = unlinkImage($home_page_image_with_path_thumbs,$home_page_image,$uploadhomePageImageThumbs);
			}
			$result = uploadImage($_FILES,'home_page_image',1600,530,$uploadhomePageImage);
			$data['home_page_image']=$_FILES['home_page_image']['name'];
		}
		$Mydata=$this->update_settings($data);
		$this->session->set_flashdata('success', 'Theme Settings Updated successfully');

		redirect('settings');
	}

	public function contact_setting()
	{

		$data=array('company_name'=>$this->input->post('company_name',TRUE),'address'=>$this->input->post('address',TRUE),'telephone'=>$this->input->post('telephone',TRUE),'fax'=>$this->input->post('fax',TRUE),'website'=>$this->input->post('website',TRUE));
		$Mydata=$this->update_settings($data);
		$this->session->set_flashdata('success', 'Contact Settings Updated successfully');

		redirect('settings');
	}
	public function map_setting()
	{
		$data=array('latitude'=>$this->input->post('latitude',TRUE),'longitude'=>$this->input->post('longitude',TRUE),'zoom_level'=>$this->input->post('zoom_level',TRUE));
		$Mydata=$this->update_settings($data);
		$this->session->set_flashdata('success', 'Map Settings Updated successfully');

		redirect('settings');
	}
	public function maintance_setting()
	{
		$data=array('SITE_OFFLINE'=>$this->input->post('SITE_OFFLINE',TRUE));
		$Mydata=$this->update_settings($data);
		$this->session->set_flashdata('success', 'Maintainance Settings Updated successfully');

		redirect('settings');

	}

	public function email_setting()
	{
		$data=array('from_email'=>$this->input->post('from_email',TRUE),'from_text'=>$this->input->post('from_text',TRUE),'email_protocal'=>$this->input->post('email_protocal',TRUE),'smtp_host'=>$this->input->post('smtp_host',TRUE),'smtp_user'=>$this->input->post('smtp_user',TRUE),'smtp_password'=>$this->input->post('smtp_password',TRUE),'smtp_port'=>$this->input->post('smtp_port',TRUE));
		$Mydata=$this->update_settings($data);
		$this->session->set_flashdata('success', 'Email Settings Updated successfully');

		redirect('settings');
	}
	
	public function update_settings($data)
	{
		if(!empty($data))
		{
			foreach($data as $key=>$val)
			{
			$data=array('type'=>$key,'description'=>$val);
			$res=$this->test_model->updateSettings($key,$data);
			}		
		}

	}
		
}