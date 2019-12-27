<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( !function_exists('uploadImg'))
{
	function uploadimg($file,$width,$height,$path,$tenant_id)
	{
		if(isset($file['profile']['name']) && $file['profile']['size'] != 0)
		{
			$CI =& get_instance();
			$config['upload_path'] = './uploads/'.$tenant_id.'/users_photo/'.$path.'/';
			$config['allowed_types'] ='gif|jpg|png|img|jpeg';
			$CI->upload->initialize($config);
			if (!$CI->upload->do_upload('profile'))
			{
				//echo "error";die;
				$CI->form_validation->set_message('fileUploadErrorMsg', $CI->upload->display_errors());
				$CI->session->set_flashdata('fileUploadErrorMsg', $CI->upload->display_errors());
				return FALSE;
			}
			else
			{
				//echo "In";die;
				$img =  $CI->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/'.$tenant_id.'/users_photo/'.$path.'/'.$img['file_name'];
				$config['new_image'] = './uploads/'.$tenant_id.'/users_photo/'.$path.'/thumbs/'.$img['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['width'] = $width;
				$config['height'] = $height;
				$CI->image_lib->initialize($config);
				$return = $CI->image_lib->resize();
				return $img['file_name'];
			}
		}
	}
}