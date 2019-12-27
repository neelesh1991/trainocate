<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modelbasic extends CI_Model

{

	function __construct()

	{

		parent::__construct();

		$this->load->database();

	}



	//get all data from table (optional order by)

	function get($table,$order_by='',$dir='')

	{

		if($order_by != '')

		{

			$this->db->order_by($order_by,$dir);

		}

		$query=$this->db->get($table);

		return $query;

	}



	//get selected data from table (optional condition array, order by, group by, limit, offset, result methos)

	public function getSelectedData($table,$selectString,$conditionArray='',$orderBy='',$dir='',$groupBy='',$limit='',$offset='',$resultMethod='')

	{

		$this->db->select($selectString);

		$this->db->from($table);

		if(is_array($conditionArray) && !empty($conditionArray))

		{

			foreach ($conditionArray as $key => $value)

			{

				$this->db->where($key,$value);

			}

		}



		if($limit != '')

		{

			$this->db->limit($limit);

		}



		if($offset != '')

		{

			$this->db->offset($offset);

		}



		if($orderBy != '')

		{

			$this->db->order_by($orderBy,$dir);

		}



		if($groupBy != '')

		{

			$this->db->group_by($groupBy);

		}



		if($resultMethod != '')

		{

			if($resultMethod == 'row')

			{

				return $this->db->get()->row();

			}

			elseif ($resultMethod == 'row_array')

			{

				return $this->db->get()->row_array();

			}



		}

		else

		{

			return $this->db->get()->result_array();

		}



	}



	public function getJoinData($table,$selectString,$conditionArray='',$orderBy='',$dir='',$groupBy='',$limit='',$offset='',$resultMethod='')

	{

		$this->db->select($selectString);

		$this->db->from($table);

		if(is_array($conditionArray) && !empty($conditionArray))

		{

			foreach ($conditionArray as $key => $value)

			{

				$this->db->where($key,$value);

			}

		}



		if($limit != '')

		{

			$this->db->limit($limit);

		}



		if($offset != '')

		{

			$this->db->offset($offset);

		}



		if($orderBy != '')

		{

			$this->db->order_by($orderBy,$dir);

		}



		if($groupBy != '')

		{

			$this->db->group_by($groupBy);

		}



		if($resultMethod != '')

		{

			if($resultMethod == 'row')

			{

				return $this->db->get()->row();

			}

			elseif ($resultMethod == 'row_array')

			{

				return $this->db->get()->row_array();

			}



		}

		else

		{

			return $this->db->get()->result_array();

		}



	}

	//get single value from table with condition as array

	function getValue($table,$getColumn,$conditionArray='',$order_by='',$limit='')
	{
		$this->db->select($getColumn,false);
		$this->db->from($table);
		if($conditionArray!='')
		{
			$this->db->where($conditionArray);
		}
		if($order_by != '')
		{
			$this->db->order_by($order_by[0],$order_by[1]);
		}

		if($limit != '')
		{
			$this->db->limit($limit);
		}
		// echo "<pre/>####"; print_r($this->db->last_query()); 
		$result=$this->db->get()->row();
		if(!empty($result))
		{
			return $result->$getColumn;
		}
		else
		{
			return '';
		}
	}

	function _insert($table,$data)

	{

		$this->db->insert($table, $data);

		return $this->db->insert_id();

	}



	function _error($act)

	{

		 return json_encode(array("success" => "0","action" => $act));

	}



	function _update($table,$id, $data)

	{

		$this->db->where('id', $id);

		return $this->db->update($table, $data);

	}

	function _update_custom($table,$condition, $data)

	{

		$this->db->where($condition);

		return $this->db->update($table, $data);

	}



	function _delete($table,$id)

	{

		$this->db->where('id', $id);

		return $this->db->delete($table);

	}



	function _deleteAll($table)

	{

		return $this->db->empty_table($table);;

	}



	function _delete_with_condition($table,$condi,$id)

	{

		$this->db->where($condi, $id);

		$this->db->delete($table);

	}



	function _delete_with_conditions($table,$condition)

	{

		foreach ($condition as $key => $value)

		{

			$this->db->where($key,$value);

		}

		return $this->db->delete($table);

	}



	function count_where($table,$column, $value)

	{

		$this->db->where($column, $value);

		$query=$this->db->get($table);

		$num_rows = $query->num_rows();

		return $num_rows;

	}



	function count_all($table)

	{

		$query=$this->db->get($table);

		$num_rows = $query->num_rows();

		return $num_rows;

	}



	function count_all_only($table,$condition='',$separator="AND")

	{

		if($condition<>'')

		{

			$i=0;

			foreach ($condition as $key => $value)

			{

				if($separator=='AND')

				{

					$this->db->where($key,$value);

				}

				else

				{

					if($i==0)

					{

						$this->db->where($key,$value);

					}

					else

					{

						$this->db->or_where($key,$value);

					}

				}

				$i++;

			}

		}
		$num_rows = $this->db->count_all_results($table);
		return $num_rows;

	}



	function get_max($table)

	{

		$this->db->select_max('id');

		$query = $this->db->get($table);

		$row=$query->row();

		$id=$row->id;

		return $id;

	}

	function _custom_query($mysql_query)

	{

		$query = $this->db->query($mysql_query);

		return $query;

	}



	function run_query($table,$requestData,$columns,$selectColumns,$concatColumns = '',$fieldName='')

	{

		$this->db->select($selectColumns,FALSE)->from($table);

			$i=0;

			if( !empty($requestData['search']['value']) )

			{

				foreach ($columns as $value)

				{

					if($i==0)

					{

						$this->db->like($value,$requestData['search']['value'],'both');

					}

					else

					{

						if($concatColumns <> '' && $value == $fieldName)

						{

							$concat=explode(',', $concatColumns);

							$this->db->or_like("CONCAT($concat[0],' ', $concat[1])", $requestData['search']['value'], 'both',FALSE);

						}

						else

						{

							$this->db->or_like($value,$requestData['search']['value'],'both');

						}

					}

					$i++;

				}

			}

			if(!empty($requestData["order"]))

			{

				if($requestData["order"][0]["column"] > 2)

				{

					$orderby=$requestData["order"][0]["column"]-2;

				}

				else

				{

					$orderby=3;

				}

				if($columns[$orderby] != '')

				{

					$orderByField=$columns[$orderby];

					//echo $orderByField;die;

					$orderByDirection=$requestData["order"][0]["dir"];

				}

				else

				{

					$orderByField='timestamp';

					$orderByDirection='desc';

				}

			}

			else

			{

				$orderByField='timestamp';

				$orderByDirection='desc';

			}



			$this->db->order_by($orderByField,$orderByDirection);



			if($requestData["length"] != -1)

			{

				$this->db->limit($requestData["length"],$requestData["start"]);

			}



			return $this->db->get()->result_array();

	}



	function getAllWhere($table,$fields,$condition="",$orderby='',$dir='')

	{

		$this->db->select($fields);

		$this->db->from($table);

		if($condition !='')

		{

			foreach ($condition as $key => $value)

			{

				$this->db->where($key,$value);

			}

		}

		if($orderby!='')

		{

			$this->db->order_by($orderby,$dir);

		}

		return $this->db->get()->result_array();

	}





	public function sendMail($data)

	{

		$localhost = array(

							    '127.0.0.1',

							    '::1'

							);

		$this->load->library('email');

		$config = Array(

			              'mailtype' => 'html',

			              'priority' => '3',

			              'charset'  => 'iso-8859-1',

			              'validate'  => TRUE ,

			              'newline'   => "\r\n",

			              'wordwrap' => TRUE

		              );

			if(in_array($_SERVER['REMOTE_ADDR'], $localhost))

			{

			    	$config['protocol']='smtp';

			    	$config['smtp_host']='ssl://smtp.googlemail.com';

			    	$config['smtp_port']='465';

			    	$config['smtp_user']='';

			    	$config['smtp_pass']='';

				    $config['mailtype']='html';

			}

			$this->email->initialize($config);

			/*if(isset($data['fromEmail']) && $data['fromEmail']!='')

			{

				$fromEmail 	=	$this->getValue($this->db->dbprefix('admin_users'),"email"," `id` = '1' ");

			}*/

			if($data['fromName'] != '')

			{

				$fromName 	=	$data['fromName'];

			}

			else

			{

				$fromName=$this->modelbasic->getValue('settings','description'," `type` = 'from_ name'");

			}

			$this->email->clear(TRUE);

			$this->email->to($data['to']);

			$this->email->from($data['fromEmail'],$fromName);

			$this->email->subject($data['subject']);

			$this->email->message($data['template']);

			/*$this->email->send();

			echo $this->email->print_debugger();*/

			 if($this->email->send())
			{
					return true;
			}
			else
			{
				/*echo $this->email->print_debugger();die;*/
				return false;
			}


	}



	public function sendMailWithAttachment($data)

	{

		$localhost = array(

				    '127.0.0.1',

				    '::1'

				);

		$this->load->library('email');

		$config = Array(

			              'mailtype' => 'html',

			              'priority' => '3',

			              'charset'  => 'iso-8859-1',

			              'validate'  => TRUE ,

			              'newline'   => "\r\n",

			              'wordwrap' => TRUE

				              );

			if(in_array($_SERVER['REMOTE_ADDR'], $localhost))

			{

			    	$config['protocol']='smtp';

			    	$config['smtp_host']='ssl://smtp.googlemail.com';

			    	$config['smtp_port']='465';

			    	$config['smtp_user']='test.unichronic@gmail.com';

			    	$config['smtp_pass']='unichronic123';

			    	$config['mailtype']='html';

			}

			//print_r($config);die;

			$this->email->initialize($config);

			$attachment='./uploads/winner_certificate/'.$data['attachment'];

			if($data['fromName'] != '')

			{

				$fromName 	=	$data['fromName'];

			}

			else

			{

				$fromName=$this->modelbasic->getValue('settings','description'," `type` = 'from_ name'");

			}



			$this->email->clear(TRUE);

			$this->email->to($data['to']);

			$this->email->from($data['from'],$fromName);

			$this->email->subject($data['subject']);

			$this->email->message($data['template']);

			$this->email->attach($attachment);

			if($this->email->send())

			{

			 	return true;

			}

			else

			{

				return false;

			}

	}



	function uniResize($source_image_path, $destination_image_path, $tn_w, $tn_h, $quality = 100, $wmsource = false)

	{

	    $image_size_info = getimagesize($source_image_path);



	    $imgtype = image_type_to_mime_type($image_size_info[2]);

	    //get mime type of image

	    #assuming the mime type is correct

	    switch ($imgtype) {

	        case 'image/jpeg':

	            $source = imagecreatefromjpeg($source_image_path);

	            break;

	        case 'image/gif':

	            $source = imagecreatefromgif($source_image_path);

	            break;

	        case 'image/png':

	            $source = imagecreatefrompng($source_image_path);

	            break;

	        default:

	            die('Invalid image type.');

	    }

	    #Figure out the dimensions of the image and the dimensions of the desired thumbnail

	    $src_w = imagesx($source);

	    $src_h = imagesy($source);

	    #Do some math to figure out which way we'll need to crop the image

	    #to get it proportional to the new size, then crop or adjust as needed

	    $x_ratio = $tn_w / $src_w;

	    $y_ratio = $tn_h / $src_h;

	    if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {

	        $new_w = $src_w;

	        $new_h = $src_h;

	    } elseif (($x_ratio * $src_h) < $tn_h) {

	        $new_h = ceil($x_ratio * $src_h);

	        $new_w = $tn_w;

	    } else {

	        $new_w = ceil($y_ratio * $src_w);

	        $new_h = $tn_h;

	    }

	    $newpic = imagecreatetruecolor(round($new_w), round($new_h));

	    imagealphablending( $newpic, false );

	    imagesavealpha( $newpic, true );

	    imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);

	    $final = imagecreatetruecolor($tn_w, $tn_h);

	    $black = imagecolorallocate($final, 0, 0, 0);

	    $backgroundColor = imagecolortransparent($final, $black);

	    //imagefill($final, 0, 0, $backgroundColor);

	    //imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);

	    imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);

	    #if we need to add a watermark

	    if ($wmsource) {

	        #find out what type of image the watermark is

	        $image_size_info    = getimagesize($wmsource);

	        $imgtype = image_type_to_mime_type($image_size_info[2]);

	        #assuming the mime type is correct

/*	        switch ($imgtype) {

	            case 'image/jpeg':

	                $watermark = imagecreatefromjpeg($wmsource);

	                break;

	            case 'image/gif':

	                $watermark = imagecreatefromgif($wmsource);

	                break;

	            case 'image/png':

	                $watermark = imagecreatefrompng($wmsource);

	                break;

	            default:

	                die('Invalid watermark type.');

	        }*/

	        $watermark = imagecreatefrompng($wmsource);

	        #if we're adding a watermark, figure out the size of the watermark

	        #and then place the watermark image on the bottom right of the image

	        $wm_w = imagesx($watermark);

	        $wm_h = imagesy($watermark);

	        imagecopy($final, $watermark, $tn_w - $wm_w, $tn_h - $wm_h, 0, 0, $tn_w, $tn_h);

	    }

	    if (imagepng($final, $destination_image_path, 9)) {

	        return true;

	    }

	    return false;

	}



  	public function ImageCropMaster($max_width, $max_height, $source_file, $dst_dir, $quality = 80)

	{

		include_once APPPATH . "libraries/Zebra_Image.php";

		// create a new instance of the class

		$image = new Zebra_Image();



		// indicate a source image (a GIF, PNG or JPEG file)

		$image->source_path = $source_file;



		// indicate a target image

		// note that there's no extra property to set in order to specify the target

		// image's type -simply by writing '.jpg' as extension will instruct the script

		// to create a 'jpg' file

		$image->target_path = $dst_dir;



		// since in this example we're going to have a jpeg file, let's set the output

		// image's quality

		$image->jpeg_quality = 100;



		// some additional properties that can be set

		// read about them in the documentation

		$image->preserve_aspect_ratio = true;

		$image->enlarge_smaller_images = true;

		$image->preserve_time = true;



		// resize the image to exactly 100x100 pixels by using the "crop from center" method

		// (read more in the overview section or in the documentation)

		//  and if there is an error, check what the error is about



		$size = getImageSize($source_file);

		$w = $size[0];

		$h = $size[1];



		if($w > $max_width || $h > $max_height)

		{

			if (!$image->resize($max_width, $max_height, ZEBRA_IMAGE_CROP_CENTER)) {



			    // if there was an error, let's see what the error is about

			    switch ($image->error) {



			        case 1:

			            echo 'Source file could not be found!';

			            break;

			        case 2:

			            echo 'Source file is not readable!';

			            break;

			        case 3:

			            echo 'Could not write target file!';

			            break;

			        case 4:

			            echo 'Unsupported source file format!';

			            break;

			        case 5:

			            echo 'Unsupported target file format!';

			            break;

			        case 6:

			            echo 'GD library version does not support target file format!';

			            break;

			        case 7:

			            echo 'GD library is not installed!';

			            break;



			    }



			// if no errors

			} else {



			   return true;



			}

		}

		else

		{

			if (!$image->resize($max_width, $max_height, ZEBRA_IMAGE_BOXED, '#ffffff')) {



			    // if there was an error, let's see what the error is about

			    switch ($image->error) {



			        case 1:

			            echo 'Source file could not be found!';

			            break;

			        case 2:

			            echo 'Source file is not readable!';

			            break;

			        case 3:

			            echo 'Could not write target file!';

			            break;

			        case 4:

			            echo 'Unsupported source file format!';

			            break;

			        case 5:

			            echo 'Unsupported target file format!';

			            break;

			        case 6:

			            echo 'GD library version does not support target file format!';

			            break;

			        case 7:

			            echo 'GD library is not installed!';

			            break;



			    }



			// if no errors

			} else {



			   return true;



			}

		}

	}



	function accessDatabase($tablename,$selectString, $mode, $data_array, $where_array, $join_array="",$limit="", $where_in="")

	{

		if($mode == 'select')

		{

			$this->db->select($selectString);

			$this->db->from($tablename);

			if(is_array($where_array) && !empty($where_array))

			{

				foreach ($where_array as $key => $value)

				{

					$this->db->where($key,$value);

				}

			}

			if(is_array($where_in) && !empty($where_in )||($where_in !=""))

			{

				foreach ($where_in as $key => $value)

				{

					$this->db->where_in($key,$value);

				}

			}



			if($limit != "")

			{

				if(count($limit)>1)

				{

					$this->db->limit($limit[0] , $limit[1]);

				}

				else

				{

					$this->db->limit($limit);

				}

			}

		}

		elseif($mode=='insert')

		{

			$this->db->insert($tablename,$data_array);

			return $this->db->insert_id();

		}

		elseif($mode=='update')

		{

			$this->db->where($where_array);

			return $this->db->update($tablename,$data_array);

		}

		elseif($mode=='delete')

		{

			return $this->db->delete($tablename,$where_array);

		}

		elseif($mode == 'like')

		{

			$this->db->select($selectString);

			$this->db->from($tablename);

			$this->db->like($where_array);

			if($join_array != '')

			{

				if(is_array($join_array) && !empty($join_array))

				{

					foreach ($join_array as $key => $value)

					{

						$this->db->or_like($key,$value);

					}

				}

			}

			if($data_array != '')

			{

				$this->db->having($data_array);

			}



		}

		elseif($mode=='orderby')

		{

			$this->db->select($selectString);

			$this->db->from($tablename);

			if(is_array($where_array) && !empty($where_array))

			{

				foreach ($where_array as $key => $value)

				{

					$this->db->where($key,$value);

				}

			}

			if(is_array($where_in) && !empty($where_in )||($where_in !=""))

			{

				foreach ($where_in as $key => $value)

				{

					$this->db->where_in($key,$value);

				}

			}

			$this->db->order_by($data_array[0], $data_array[1]);



		}

		elseif($mode=='groupby')

		{

			$this->db->select($selectString);

			$this->db->from($tablename);

			if(is_array($where_array) && !empty($where_array))

			{

				foreach ($where_array as $key => $value)

				{

					$this->db->where($key,$value);

				}

			}

			if(is_array($where_in) && !empty($where_in )||($where_in !=""))

			{

				foreach ($where_in as $key => $value)

				{

					$this->db->where_in($key,$value);

				}

			}

			$this->db->group_by($data_array);



		}

		elseif($mode=='join_order_limit' || $mode=='join_group_limit' || $mode=='join_group_order_limit')

		{

			$this->db->select($selectString);

			$this->db->from($tablename);

			if(is_array($join_array) && !empty($join_array))

			{

				foreach ($join_array as $value)

				{

					$this->db->join($value[0],$value[1],'left');

				}

			}

			if(is_array($where_array) && !empty($where_array))

			{

				$this->db->where($where_array);

			}

			if(is_array($where_in) && !empty($where_in )||($where_in !=""))

			{

				foreach ($where_in as $key => $value)

				{

					$this->db->where_in($key,$value);

				}

			}

			if($mode=='join_order_limit' && $data_array != '')

			{

				$this->db->order_by($data_array[0], $data_array[1]);

			}



			if($mode=='join_group_limit' && $data_array != '')

			{

				$this->db->group_by($data_array);

			}



			if($mode=='join_group_order_limit' && $data_array != '')

			{

				$this->db->order_by($data_array[0], $data_array[1]);

				$this->db->group_by($data_array[2]);

			}



			if($limit != "")

			{

				if(count($limit)>1)

				{

					$this->db->limit($limit[0] , $limit[1]);

				}

				else

				{

					$this->db->limit($limit);

				}

			}

			// echo "#####<pre/>"; print_r($this->db->last_query());

		}

		elseif($mode == 'select_like')

		{

			$this->db->select($selectString);

			$this->db->from($tablename);

			if(is_array($where_array) && !empty($where_array))

			{

				foreach ($where_array as $key => $value)

				{

					$this->db->where($key,$value);

				}

			}

			if(is_array($where_in) && !empty($where_in )||($where_in !=""))

			{

				foreach ($where_in as $key => $value)

				{

					$this->db->where_in($key,$value);

				}

			}

			 $this->db->like($data_array);

		}
		return $this->db->get();

	}



	function selectData($table, $selectString , $where = '' , $join_array = '',$limit = '',$result_type='')

	{

		$this->db->select($selectString);

		$this->db->from($table);

		if(is_array($where) && !empty($where))

		{

			$this->db->where($where);

		}



		if($join_array != '')

		{

			if(is_array($join_array) && !empty($join_array))

			{

				foreach ($join_array as $value)

				{

					$this->db->join($value[0],$value[1]);

				}

			}

		}



		if($limit != "")

		{

			if(count($limit)>1)

			{

				$this->db->limit($limit[0] , $limit[1]);

			}

			else

			{

				$this->db->limit($limit);

			}

		}

		if($result_type != '')

		{

			if($result_type == 'row')

			{

				return $this->db->get()->row();

			}

			elseif ($result_type == 'row_array')

			{

				return $this->db->get()->row_array();

			}

			elseif ($result_type == 'result_array') {

				return $this->db->get()->result_array();

			}

		}

		else

		{

			return $this->db->get()->result_array();

		}

	}



	function get_all_session_data()

	{

	    $query=$this->db->select('data')->get('ci_sessions');

	     return $query;

	}




	function userUpdate_User_level($uid){

			$this->db->where('id',$uid);
			$res = $this->db->update('users',array('user_level_id'=> 2 ));
			return $res;

		}




function getGroupInfo($examID)

	{

		$this->db->select('*');

		$this->db->from('exam_group_relation');
		$this->db->where('exam_id',$examID);

		return $this->db->get()->result_array();

	}



	/**
	 * [getMultipleQuestions description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function getMultipleQuestions($id){

		$this->db->select('*');

		$this->db->from('answer_bank');
		$this->db->where('question_id',$id);
		$this->db->where('correct_answer',1);

		return $this->db->get()->result_array();

	}
	/**
	 * [getMultipleOptionIdsQuestions description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function getMultipleOptionIdsQuestions($id){

		$this->db->select('option_id');

		$this->db->from('answer_bank');
		$this->db->where('question_id',$id);
		$this->db->where('correct_answer',1);

		return $this->db->get()->result_array();

	}

	/**
	 * [getLeaveMessageDetails description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function getLeaveMessageDetails($id){

		$this->db->select('*');

		$this->db->from('contact_us');
		$this->db->where('id',$id);

		return $this->db->get()->result_array();

	}

/**
 * [get_previousQuiz description]
 * @param  [type] $table     [description]
 * @param  [type] $examID    [description]
 * @param  [type] $quizId    [description]
 * @param  [type] $userID    [description]
 * @param  [type] $tenant_id [description]
 * @param  [type] $mock      [description]
 * @return [type]            [description]
 */
	function get_previousQuiz($table,$examID, $quizId, $userID,$tenant_id,$mock)

	{

		$this->db->select('user_id,exam_id,quiz_id,question_id', 'multiple_selected_answers', 'end_time', 'tenant_id','marks');
		$this->db->from($table);
		$this->db->where('exam_id',$examID);
		$this->db->where('quiz_id',$quizId);
		$this->db->where('user_id',$userID);
		$this->db->where('tenant_id',$tenant_id);
		$this->db->where('mock',$mock);
		$this->db->where('multiple_selected_answers !=', '');
		$res = $this->db->get()->result_array();

		return $res;

	}


	/**
	 * [get_previousQuizLog description]
	 * @param  [type] $table     [description]
	 * @param  [type] $examID    [description]
	 * @param  [type] $quizId    [description]
	 * @param  [type] $userID    [description]
	 * @param  [type] $tenant_id [description]
	 * @param  [type] $mock      [description]
	 * @return [type]            [description]
	 */
		function get_previousQuizLog($table,$examID, $quizId, $userID,$tenant_id,$mock){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('exam_id',$examID);
		$this->db->where('quiz_id',$quizId);
		$this->db->where('user_id',$userID);
		$this->db->where('tenant_id',$tenant_id);
		//$this->db->where('finish',1);
		$res = $this->db->get()->result_array();
		return $res;
		}


		/**
		 * [previous_user_quiz_del description]
		 * @param  [type] $tablename   [description]
		 * @param  [type] $where_array [description]
		 * @return [type]              [description]
		 */
		function previous_user_quiz_del($tablename, $where_array){

				return $this->db->delete($tablename,$where_array);
		}


		/**
		 * [get_RetryQuizLog description]
		 * @param  [type] $table     [description]
		 * @param  [type] $examID    [description]
		 * @param  [type] $quizId    [description]
		 * @param  [type] $userID    [description]
		 * @param  [type] $tenant_id [description]
		 * @param  [type] $mock      [description]
		 * @return [type]            [description]
		 */
		function get_RetryQuizLog($table,$examID, $quizId, $userID,$tenant_id,$mock){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('exam_id',$examID);
		$this->db->where('quiz_id',$quizId);
		$this->db->where('user_id',$userID);
		$this->db->where('tenant_id',$tenant_id);
		$this->db->where('finish',1);
		$this->db->order_by('percentage', 'DESC');
		$this->db->limit(1);
		$res = $this->db->get()->result_array();
		return $res;
		}



		/**
		 * [get_allRetriedLogs description]
		 * @param  [type] $table     [description]
		 * @param  [type] $examID    [description]
		 * @param  [type] $quizId    [description]
		 * @param  [type] $userID    [description]
		 * @param  [type] $tenant_id [description]
		 * @param  [type] $mock      [description]
		 * @return [type]            [description]
		 */
		function get_allRetriedLogs($table,$examID, $quizId, $userID,$tenant_id,$mock){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('exam_id',$examID);
		$this->db->where('quiz_id',$quizId);
		$this->db->where('user_id',$userID);
		$this->db->where('tenant_id',$tenant_id);
		$this->db->where('finish',1);

		$res = $this->db->get()->result_array();
		return $res;
		}




}



