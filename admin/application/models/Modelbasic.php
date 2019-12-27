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

	//get single value from table with condition as array

	function getValue($table,$getColumn,$conditionArray)

	{

		$this->db->select($getColumn);

		$this->db->from($table);

		if(is_array($conditionArray) && !empty($conditionArray))

		{

			foreach ($conditionArray as $key => $value)

			{

				$this->db->where($key,$value);

			}

		}

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

	function getValues($table,$getColumn,$conditionArray,$resultMethod='')

	{

		$this->db->select($getColumn);

		$this->db->from($table);

		$this->db->where($conditionArray);

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

	function _insert($table,$data)

	{

		$this->db->insert($table, $data);
		//echo "<pre/>"; print_r($this->db->last_query()); die;
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

	function _update_custom($table,$field,$value, $data)

	{

		$this->db->where($field, $value);

		return $this->db->update($table, $data);

	}

	function _delete($table,$id)

	{

		//echo $table;die;

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

	function _custom_query($table,$mysql_query)

	{

		$query = $this->db->query($mysql_query);

		return $query;

	}

	function run_query_with_join($table,$requestData,$columns,$selectColumns,$concatColumns = '',$fieldName='',$condition = '',$join_array='',$group_by='')

	{

		//pr($requestData);

		$this->db->select($selectColumns,FALSE)->from($table);



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

				if($condition != '')

				{

					$this->db->having($condition);

				}

			}

			else

			{

				if($condition != '')

				{

					$this->db->where($condition);

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

					$orderByField='';

					$orderByDirection='';

				}

			}

			else

			{

				$orderByField='';

				$orderByDirection='';

			}

			if($orderByField != '')

			{

				$this->db->order_by($orderByField,$orderByDirection);

			}

			if($requestData["length"] != -1)

			{

				$this->db->limit($requestData["length"],$requestData["start"]);

			}

			if($group_by != '')
			{
				$this->db->group_by($group_by);
			}
			return $this->db->get()->result_array();

	}

	function run_query($table,$requestData,$columns,$selectColumns,$concatColumns = '',$fieldName='',$condition = '',$join_array='',$group_by='')

	{

		//pr($requestData);

		$this->db->select($selectColumns,FALSE)->from($table);



			if($join_array != '')

			{

				if(is_array($join_array) && !empty($join_array))

				{

					foreach ($join_array as $value)

					{

						$this->db->join($value[0],$value[1],'left');

					}

				}

			}



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

				if($condition != '')

				{

					$this->db->having($condition);

				}

			}

			else

			{

				if($condition != '')

				{

					$this->db->where($condition);

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

					$orderByField='';

					$orderByDirection='';

				}

			}

			else

			{

				$orderByField='';

				$orderByDirection='';

			}

			if($orderByField != '')

			{

				$this->db->order_by($orderByField,$orderByDirection);

			}

			if($requestData["length"] != -1)

			{

				$this->db->limit($requestData["length"],$requestData["start"]);

			}

			if($group_by != '')
			{
				$this->db->group_by($group_by);
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

	function getEmailData()

	{

		$this->db->select('*');

		$this->db->from('settings');

		return $this->db->get()->result_array();

	}

	public function sendMail($data)

	{

		$localhost = array(

							'127.0.0.1',

							'::1'

							);

		$this->load->library('email');

		$email_data=$this->getEmailData();

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

			$config['smtp_pass']='Uspl@12345';

			$config['mailtype']='html';

		}

		else

		{

			if(($email_data[32]['type']=='email_protocal')&&($email_data[32]['description']=='php_mail'))

			{

				$config = Array(

				'mailtype' => 'html',

				'charset'  => 'iso-8859-1',

				'validate'  => TRUE ,

				'newline'   => "\r\n",

				'wordwrap' => TRUE

				);

			}else{

				$config = Array(

				'protocol' => $email_data[32]['description'],

				'smtp_host' => $email_data[33]['description'],

				'smtp_port' => $email_data[36]['description'],

				'smtp_user' => $email_data[34]['description'], // change it to yours

				'smtp_pass' => $email_data[35]['description'], // change it to yours

				'mailtype' => 'html',

				'charset'  => 'iso-8859-1',

				'validate'  => TRUE ,

				'newline'   => "\r\n",

				'wordwrap' => TRUE

				);

				//print_r($config);die;

				}

		}

				$this->email->initialize($config);

				$fromName 	=	'Trainocate admin';

				$this->email->clear(TRUE);

				$this->email->to($data['to']);

				$this->email->from($data['fromEmail'],$fromName);

				$this->email->subject($data['subject']);

				$this->email->message($data['template']);

				//$this->email->send();

				//echo $this->email->print_debugger();

				if($this->email->send())

					return true;

				else

					return false;

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

					$config['smtp_pass']='Uspl@12345';

					$config['mailtype']='html';

				}

				//print_r($config);die;

				$this->email->initialize($config);

				$attachment=$data['attachment'];

						$fromName 	=	'Admin';

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

	function accessDatabase($tablename,$selectString, $mode, $data_array, $where_array, $join_array="",$limit="")

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

			$this->db->group_by($data_array);

		}

		elseif($mode=='join_order_limit' || $mode=='join_group_limit' || $mode=='join_group_order_limit' || $mode=='join')

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

			 $this->db->like($data_array);

		}

		return $this->db->get();

	}

	public function fileUpload(&$uploadFileData,$field,$file_name,$path)

	{

		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|bmp|doc|docx|pdf|xls|xlsx|txt';

		$config['upload_path'] 		= $path;

		$config['optional'] 		= true;

		$config['file_name']    	= $file_name;

		$this->upload->set_config($config);

		$r = $this->upload->do_upload($field,true);

		$uploadFileData[$field] = $this->upload->file_name;

		$uploadFileData[$field.'_err'] = $this->upload->display_errors();

		return $r;

	}

	public function thumbnail($file_name='',$folder_name='',$thumb_folder_name='',$twidth='',$theight='')

	{

		$tag        = '';

		$Twidth     = $twidth;

		$Theight    = $theight;

		$uploaddir  = file_upload_absolute_path().$folder_name.'/';

		$thumb_file_name  = $file_name;

		$dest       = $uploaddir.$thumb_folder_name.'/'.$thumb_file_name;

		$src        = $uploaddir.$file_name;

		$this->upload->create_thumbnail($dest,$src,$Twidth,$Theight,$tag);

	}


	/**
	 * [get_quiz_log_users description]
	 * @param  [type] $tenant_id [description]
	 * @return [type]            [description]
	 */
	public function get_quiz_log_users($tenant_id)
	{


		$this->db->select('quiz_log.*, users.*, exam_master.exam_name,exam_master.end_date,exam_master.start_date');
		$this->db->from('quiz_log');
		$this->db->join('exam_master','quiz_log.exam_id = exam_master.id');
		$this->db->join('users','quiz_log.user_id = users.id');
		$this->db->where('quiz_log.tenant_id',$tenant_id);
		$this->db->where("(quiz_log.finish=1)");
		$this->db->group_by('quiz_log.exam_id');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();die;
	//print_r($this->db->get()->result_array());die;
	}


	public function get_quiz_log_users_using_userid($user_id)
	{
		$this->db->select('quiz_log.*, exam_master.exam_name,exam_master.end_date,exam_master.start_date');
		$this->db->from('quiz_log');
		$this->db->join('exam_master','quiz_log.exam_id = exam_master.id');
		// $this->db->join('users','quiz_log.user_id = users.id');
		$this->db->where('quiz_log.user_id',$user_id);
		$this->db->where("(quiz_log.finish=1)");
		$this->db->group_by('quiz_log.exam_id');
		return $this->db->get()->result_array();

	}

	public function user_reset_exam($array_data)
	{

	}



/**
 * [checkQuestionExits description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
	function checkQuestionExits($name){

		$this->db->select('*');

		$this->db->from('question_bank');
		$this->db->where('question',$name);

		$query = $this->db->get();

		$data = array();
		if($query !== FALSE && $query->num_rows() > 0){
		    foreach ($query->result_array() as $row) {
		        $data[] = $row;
		    }
		}

		// return $this->db->get()->result_array();
		return $data;

	}



	/**
	 * [get_users_to_csv description]
	 * @param  [type] $tenant_id [description]
	 * @return [type]            [description]
	 */
	public function get_users_to_csv($tenant_id)

	{


		$this->db->select('users.name as Name,users.email_id as Email address,users.contact_no as Mobile Number,users.organization as Organization,users.city as City');
				$this->db->from('users');


		$this->db->where('users.tenant_id',$tenant_id);

		$this->db->get()->result_array();

		return $this->db->last_query();

	}


		/**
	 * [getMultipleOptionIdsQuestions description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function getCSVMultipleOptionIdsQuestions($id){

		$this->db->select('answer_bank.option_id, answer_bank.question_id, option_master.option');

		$this->db->from('answer_bank');

		$this->db->join('option_master','option_master.id = answer_bank.option_id');

		$this->db->where('answer_bank.question_id',$id);

		$this->db->where('answer_bank.correct_answer',1);


		return $this->db->get()->result_array();

	}


	/**
	 * [getCSVCorrcetMultipleOptionIdsQuestions description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function getCSVCorrcetMultipleOptionIdsQuestions($id){

		$this->db->select('option_id');

		$this->db->from('answer_bank');
		$this->db->where('question_id',$id);
		$this->db->where('correct_answer',1);

		return $this->db->get()->result_array();

	}

	/**
	 * [getCSVOptionValue description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function getCSVOptionValue($id){

		$this->db->select('option_master.id, option_master.option');

		$this->db->from('option_master');

		$this->db->where('option_master.id',$id);


		return $this->db->get()->result_array();

	}

	/**
	 * [getUserMulValues description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function getUserMulValues($id){

		$this->db->select('multiple_selected_answers');

		$this->db->from('quiz');

		$this->db->where('question_id',$id);


		return $this->db->get()->result_array();

	}



	/**
	 * [getTotalQuizLog description]
	 * @param  [type] $qid [description]
	 * @param  [type] $eid [description]
	 * @param  [type] $uid [description]
	 * @return [type]      [description]
	 */
	function getTotalQuizLog($qid, $eid, $uid){

		$this->db->select('*');

		$this->db->from('quiz_log');
		$this->db->where('quiz_id',$qid);
		$this->db->where('exam_id',$eid);
		$this->db->where('user_id',$uid);
		return $this->db->get()->result_array();

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
		function get_previousQuizLog($table,$examID, $userID){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('exam_id',$examID);
		$this->db->where('user_id',$userID);
		//$this->db->where('finish',1);
		$res = $this->db->get()->result_array();
		return $res;
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
		function get_RetryQuizLog($table,$examID, $userID){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('exam_id',$examID);
		// $this->db->where('quiz_id',$quizId);
		$this->db->where('user_id',$userID);
		// $this->db->where('tenant_id',$tenant_id);
		// $this->db->where('finish',1);
		$this->db->order_by('percentage', 'DESC');
		$this->db->limit(1);
		$res = $this->db->get()->result_array();
		return $res;
		}

		public function update_exam_summary_in_quiz_log($condition,$data,$mock)
		{
			if($mock==0)
			{
				$this->db->where($condition);
				$this->db->update('quiz_log', $data);
			}
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






}