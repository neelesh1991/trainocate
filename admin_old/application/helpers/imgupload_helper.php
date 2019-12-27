<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('uploadImg'))
{
	function uploadImage($file,$photo,$width,$height,$upload_path,$thumb_name='',$thumb_width='',$thumb_height='',$height_constant='',$width_constant='')
	{
		if(isset($file[$photo]['name']) && $file[$photo]['size'] != 0)
		{
			$ci =& get_instance();
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] ='gif|jpg|png|img|jpeg';
			$ci->upload->initialize($config);
			if (!$ci->upload->do_upload($photo))
			{
				$ci->form_validation->set_message('fileUploadErrorMsg', $ci->upload->display_errors());
				$ci->session->set_flashdata('fileUploadErrorMsg', $ci->upload->display_errors());
				return FALSE;
			}
			else
			{
				$img =  $ci->upload->data();
				$resize_width=$width;
				if($height_constant != '')
				{					
					$size = @getimagesize($upload_path.'/'.$img['file_name']);
					$resize_width=($size[0]*$height)/$size[1];
				}

				$config['image_library'] = 'gd2';
				$config['source_image'] = $upload_path.'/'.$img['file_name'];
				$config['new_image'] = $upload_path.'/thumbs/'.$img['file_name'];
				$config['encrypt_name'] = TRUE;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $resize_width;
				$config['height'] = $height;
				$ci->image_lib->initialize($config);
				$return = $ci->image_lib->resize();
				if($thumb_name!='' &&  $thumb_width!='' && $thumb_height!='')
				{

					$resize_width=$width;
					if($height_constant != '')
					{
						$img =  $ci->upload->data();
						$size = @getimagesize($upload_path.'/'.$img['file_name']);
						$resize_width=($size[0]*$thumb_height)/$size[1];
					}

					$config['image_library'] = 'gd2';

					$config['source_image'] = $upload_path.'/'.$img['file_name'];

					$config['new_image'] = $upload_path.'/'.$thumb_name.'/'.$img['file_name'];

					$config['encrypt_name'] = TRUE;

					$config['create_thumb'] = FALSE;

					$config['maintain_ratio'] = TRUE;

					$config['width'] = $resize_width;

					$config['height'] = $thumb_height;

					$ci->image_lib->initialize($config);

					$return = $ci->image_lib->resize();



				}

				return $img['file_name'];

			}

		}

	}

	

	function unlinkImage($image_name_with_path,$imageName,$upload_path)

	{		

		if(file_exists($image_name_with_path))

		{

			if($imageName != '')

				{

					@unlink($upload_path.'/'.$imageName);

					@unlink($upload_path.'/thumbs/'.$imageName);			

				}

				else

				{

					echo 'image do not deleted ';

				}

		}

	}

}



