<?php

if (!defined('BASEPATH'))

    exit('No direct script access allowed');

class Quiz extends CI_Controller

{

  function __construct()

  {

        parent::__construct();

        $this->load->model('test_model');

        $this->load->library('upload');

        $this->load->library('image_lib');

        $this->load->helper('imgupload');

        $this->load->library('form_validation');

        $this->load->helper('string');



  }

  public function index()

  {

    $res = array('id !='=>'1');

    $data['tenant']=$this->modelbasic->getAllWhere('tenant','*',$res);

    $data['group']=$this->modelbasic->getAllWhere('manage_groups','*');

    $data['page_name']='manage_quiz/manage_quiz_view';

    $this->load->view('index',$data);

  }

  public function getAjaxdataObjects()

  {

    $_POST['columns']='id,question,tenant_id,marks';

    $requestData = $_REQUEST;



    $columns=explode(',',$_POST['columns']);

    $selectColumns = "id,question,tenant_id,marks";

    $condition=array('tenant_id'=>$this->session->userdata('tenant_id'));

    $totalData=$this->modelbasic->count_all_only('question_bank',$condition);



    $totalFiltered=$totalData;

    $result=$this->modelbasic->run_query('question_bank',$requestData,$columns,$selectColumns,'','',$condition);

    //echo $this->db->last_query();die;

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



        $nestedData['chk'] = '<div class="vd_checkbox checkbox-success"><input type="checkbox" class="case" id="check-'.$row["id"].'" name="checkall['.$row["id"].']" data-index="'.$row["id"].'"><label for="check-'.$row["id"].'"> </label></div>';

        $nestedData['id'] =$row["id"];

        $nestedData['marks'] =$row["marks"];

        $nestedData['action'] = '<div class="menu-action dropdown">

                <a onclick="edit_question('.$row['id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="edit"> <i class="fa fa-pencil"></i> </a>

                 <a onclick="delete_confirm('.$row['id'].');" class="btn menu-icon vd_bd-red vd_red" data-placement="top" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-times"></i> </a>

                    </div>';

                $nestedData['tenant_id'] = $row['tenant_id'];

        $nestedData['question'] = $row['question'];

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

    $res=$this->test_model->_change_status_user($id,$status,'question_bank');

    if($res>0)

          {

            redirect('quiz');

          }

      else

      {

        echo FALSE;

      }

  }





  public function edit_question($id)

  {
                //echo "in";

    $tenant_id = $this->session->userdata('tenant_id');

    $qCondition = array('id'=>$id,'tenant_id'=>$tenant_id);

    //$data=$this->modelbasic->getAllWhere('question_bank','*',$res);

    $questionData=$this->modelbasic->getSelectedData('question_bank','*',$qCondition,'','','','','','row_array');





    $catCondition = array('A.question_id'=>$id,'B.tenant_id'=>$tenant_id);

    $join_array=array(array('question_categories as B','A.category_id=B.id'));

    $categoriesData=$this->modelbasic->accessDatabase('question_category_relations as A','B.category_name', 'join', '', $catCondition, $join_array)->result_array();



    $categories='';

    if(!empty($categoriesData))

    {

      $i=0;

      foreach ($categoriesData as $cat)

      {

        if($i != 0)

        {

          $categories.=','.$cat['category_name'];

        }

        else

        {

          $categories.=$cat['category_name'];

        }



        $i++;

      }

    }

    $questionData['category_name']=$categories;

    $where_array=array('A.tenant_id'=>$tenant_id,'B.tenant_id'=>$tenant_id,'A.question_id'=>$questionData['id']);

    $join_array=array(array('option_master as B','A.option_id=B.id'));

    $optionData=$this->modelbasic->accessDatabase('answer_bank as A','A.correct_answer,A.question_id,A.option_id,B.option', 'join', '', $where_array, $join_array)->result_array();



    if(!empty($optionData))

    {

      foreach ($optionData as $key => $opt)

      {

        $questionData['option'][]=$opt;

      }

    }



    $data['ajax']=json_encode($questionData);

    $this->load->view('ajax_view',$data);

  }



  public function delete_confirm($id)

  {

    $tenant_id = $this->session->userdata('tenant_id');

    $this->db->trans_start();

    $this->modelbasic->_delete_with_conditions('question_bank',array('id'=>$id,'tenant_id'=>$tenant_id));

    $this->modelbasic->_delete_with_conditions('quiz',array('question_id'=>$id,'tenant_id'=>$tenant_id));

    $cond = array('question_id'=>$id,'tenant_id'=>$tenant_id);

    $options=$this->modelbasic->getSelectedData('answer_bank','option_id',$cond);



    if(!empty($options))

    {

      foreach ($options as $key => $opt)

      {

        $this->modelbasic->_delete_with_conditions('option_master',array('id'=>$opt['option_id'],'tenant_id'=>$tenant_id));

      }

    }



    $this->modelbasic->_delete_with_conditions('answer_bank',array('question_id'=>$id,'tenant_id'=>$tenant_id));

    $this->modelbasic->_delete_with_conditions('question_category_relations',array('question_id'=>$id));

    $this->db->trans_complete();



    if ($this->db->trans_status() === FALSE)

    {

      $response=array('status'=>'fail','message'=>'Something went wrong please try again');

      $response['ajax']=json_encode($response);

    }

    else

    {

      $response=array('status'=>'success','message'=>'Question deleted successfully');

      $response['ajax']=json_encode($response);

    }



/*    if($this->input->is_ajax_request())

    {

      return true;

      exit();

    }

*/

    $this->load->view('ajax_view',$response);

  }



  function multiselect_action()

  {

    //print_r($_POST['checkall']);die;

    if(isset($_POST['submit']))

    {

      $check = $_POST['checkall'];

      //echo " < pre > ";

      //pr($check);

      foreach($check as $key => $value)

      {

        if($_POST['listaction'] == '3'){



          $this->delete_confirm($key);

        }

      }

      redirect('quiz');

    }

  }



  public function add_csv_questions()

  {

    if(isset($_FILES['csvfile']) && $_FILES['csvfile']['size'] != 0)

      {

        $folderName = $this->session->userdata('tenant_id');

        //$folderName = '100';

        $upload_path=file_upload_absolute_path().$folderName.'/';

        //echo $upload_path;die;

        if(!is_dir($upload_path))

        {

          @mkdir($upload_path, 0777, TRUE);

        }

        $upload_path.='csv_questions/';



        if(!is_dir($upload_path))

        {

          @mkdir($upload_path, 0777, TRUE);

        }



        $config['upload_path'] = $upload_path;

        $config['allowed_types'] ='csv';

        $this->upload->initialize($config);

        if($this->upload->do_upload('csvfile'))

        {

          $xls_file=$this->upload->data();

          $file = '../uploads/'.$folderName.'/csv_questions/'.$xls_file['file_name'];



          //print_r($xls_file);die;
          ini_set('auto_detect_line_endings', true);
           //$this->load->library('csvimport');
          header('Content-Type: text/html; charset=UTF-8');
          $handle = fopen($file, "r");

          //$data = fgetcsv($handle, 1000, ",");
          //pr($data);
          $all_data=array();

          while (! feof($handle))

          {

              $all_data[]=fgetcsv($handle);

          }

          //pr($all_data);


          $productCount=0;

          $i=1;

          $error='';



          //print_r($all_data);die;



          if(!empty($all_data))

          {

            foreach($all_data as $val)

            {


            if( $i != 1 && !empty($val[0])){

                  $searchString = ',';
                  if( strpos($val[7], $searchString) !== false ) {

                      $error .= "On line no. ".$i.": Commas are not accepted, Only allowed &, Ex:1&2&3 .<br/>";

                  } else{



              $isQuestionExits  = $this->modelbasic->checkQuestionExits($val[0]);


              if(!empty($val) && empty($isQuestionExits))
              {

                if(!empty($val[0]) && !empty($val[7]) && !empty($val[8]) && !empty($val[9]))

                {

                  /** New Multiple code */

            if (strpos($val[7], '&') !== false || !empty($val[$val[7]])) {
                $correctAns = explode('&', $val[7]);
                //print_r($correctAns);

              /** ---------- ********/



                  /*if((empty($val[1]) &&  ($val[7])==1 ) || (empty($val[2]) &&  ($val[7])==2 ) || (empty($val[3]) &&  ($val[7])==3 ) || (empty($val[4]) &&  ($val[7])==4 ) || (empty($val[5]) &&  ($val[7])==5 ) || (empty($val[6]) &&  ($val[7])==6 ))

                  {*/


                  if( !empty($val[1]) || !empty($val[2])  || !empty($val[3]) || !empty($val[7]) || !empty($correct_answer[0]) )
                  {


                    $insertQuestion = array('question'=>$val[0],'marks'=>$val[9],'tenant_id'=>$folderName);

                    $questionId=$this->modelbasic->_insert('question_bank',$insertQuestion);

                    if(!empty($val[1]))

                    {

                      $opt1=$val[1];

                      $insertOptions1 = array('option'=>$opt1,'tenant_id'=>$folderName);

                      $optionId1=$this->modelbasic->_insert('option_master',$insertOptions1);

                      //if($val[7]==1)
                      if(in_array(1, $correctAns))

                      {

                        $correct_answer=1;

                      }

                      else

                      {

                        $correct_answer=0;

                      }

                      $insertAnswers1 = array('question_id'=>$questionId,'option_id'=>$optionId1,'correct_answer'=>$correct_answer,'tenant_id'=>$folderName);

                      $answerId1=$this->modelbasic->_insert('answer_bank',$insertAnswers1);

                    }

                    if(!empty($val[2]))

                    {

                      $opt2=$val[2];

                      $insertOptions2 = array('option'=>$opt2,'tenant_id'=>$folderName);

                      $optionId2=$this->modelbasic->_insert('option_master',$insertOptions2);

                      //if($val[7]==2)
                      if(in_array(2, $correctAns))
                      {

                        $correct_answer=1;

                      }

                      else

                      {

                        $correct_answer=0;

                      }

                      $insertAnswers2 = array('question_id'=>$questionId,'option_id'=>$optionId2,'correct_answer'=>$correct_answer,'tenant_id'=>$folderName);

                      $answerId2=$this->modelbasic->_insert('answer_bank',$insertAnswers2);

                    }

                    if(!empty($val[3]))

                    {

                      $opt3=$val[3];

                      $insertOptions3 = array('option'=>$opt3,'tenant_id'=>$folderName);

                      $optionId3=$this->modelbasic->_insert('option_master',$insertOptions3);

                      //if($val[7]==3)
                      if(in_array(3, $correctAns))
                      {

                        $correct_answer=1;

                      }

                      else

                      {

                        $correct_answer=0;

                      }

                      $insertAnswers3 = array('question_id'=>$questionId,'option_id'=>$optionId3,'correct_answer'=>$correct_answer,'tenant_id'=>$folderName);

                      $answerId3=$this->modelbasic->_insert('answer_bank',$insertAnswers3);

                    }

                    if(!empty($val[4]))

                    {

                      $opt4=$val[4];

                      $insertOptions4 = array('option'=>$opt4,'tenant_id'=>$folderName);

                      $optionId4=$this->modelbasic->_insert('option_master',$insertOptions4);

                      //if($val[7]==4)
                      if(in_array(4, $correctAns))
                      {

                        $correct_answer=1;

                      }

                      else

                      {

                        $correct_answer=0;

                      }

                      $insertAnswers4 = array('question_id'=>$questionId,'option_id'=>$optionId4,'correct_answer'=>$correct_answer,'tenant_id'=>$folderName);

                      $answerId4=$this->modelbasic->_insert('answer_bank',$insertAnswers4);

                    }

                    if(!empty($val[5]))

                    {

                      $opt5=$val[5];

                      $insertOptions5 = array('option'=>$opt5,'tenant_id'=>$folderName);

                      $optionId5=$this->modelbasic->_insert('option_master',$insertOptions5);

                      //if($val[7]==5)
                        if(in_array(5, $correctAns))
                      {

                        $correct_answer=1;

                      }

                      else

                      {

                        $correct_answer=0;

                      }

                      $insertAnswers5 = array('question_id'=>$questionId,'option_id'=>$optionId5,'correct_answer'=>$correct_answer,'tenant_id'=>$folderName);

                      $answerId5=$this->modelbasic->_insert('answer_bank',$insertAnswers5);

                    }

                    if(!empty($val[6]))

                    {

                      $opt6=$val[6];

                      $insertOptions6 = array('option'=>$opt6,'tenant_id'=>$folderName);

                      $optionId6=$this->modelbasic->_insert('option_master',$insertOptions6);

                      //if($val[7]==6)
                      if(in_array(6, $correctAns))
                      {

                        $correct_answer=1;

                      }

                      else

                      {

                        $correct_answer=0;

                      }

                      $insertAnswers6 = array('question_id'=>$questionId,'option_id'=>$optionId6,'correct_answer'=>$correct_answer,'tenant_id'=>$folderName);

                      $answerId6=$this->modelbasic->_insert('answer_bank',$insertAnswers6);

                    }

                  if(isset($val[8]))

                  {

                    $categories=explode(',',$val[8]);

                    foreach ($categories as $cat)

                    {

                      $categoryId=$this->modelbasic->getValue('question_categories','id',array('tenant_id'=>$folderName,'category_name'=>$cat));

                      if($categoryId == '')

                      {

                        $insertCategory = array('category_name'=>$cat,'tenant_id'=>$folderName);

                        $categoryId=$this->modelbasic->_insert('question_categories',$insertCategory);

                      }

                      $insertQuestionCatRelation = array('question_id'=>$questionId,'category_id'=>$categoryId);

                      $que_cat_rel=$this->modelbasic->_insert('question_category_relations',$insertQuestionCatRelation);

                    }

                  }

                }
                else
                {

                  if(($i!=1) && ($val[0] != '' || $val[1] != '' || $val[2] != '' || $val[3] != '' || $val[4] != '' || $val[5] != '' || $val[6] != '' || $val[7] != '' || $val[8] != '' || $val[9] != ''))
                  {
                    $error .= "On line no. ".$i." Question not inserted options and correct answer not match.<br/>";
                  }

                }

                } else{
                $error .= "On line no. ".$i." Question not inserted options and correct answer not match.<br/>";
              }





              }
              else
              {

                if($val[0] =='')
                {
                  $error .= "On line no. ".$i." Question is required.<br/>";
                }
                if($val[7] =='')
                {
                  $error .= "On line no. ".$i." Correct Answer is required.<br/>";
                }
                if($val[8] =='')
                {
                  $error .= "On line no. ".$i." Category Name is required.<br/>";
                }
                if($val[9] =='')
                {
                  $error .= "On line no. ".$i." Marks is required.<br/>";
                }

              }

            }




             }

           }


               $i++;


            }
            //exit;

          }


        }

        else

        {

           $upload_error=$this->upload->display_errors();

           $this->session->set_flashdata('error',$upload_error);

           redirect('quiz','refresh');

        }

      }

      if($error != '')
      {
        $this->session->set_flashdata('csverror',$error);
      }
      else
      {
        $this->session->set_flashdata('success','Questions inserted successfully.');
      }

      redirect('quiz','refresh');



  }



  public function getcategories()

  {

    $categoryName=$this->input->post('category',TRUE);

    if(isset($categoryName) && $categoryName != '')

    {

      $tenant_id = $this->session->userdata('tenant_id');

      $data_array=array("tenant_id = $tenant_id");

      $where_array=array('category_name' => $categoryName,'tenant_id' => $tenant_id);

      $json_data=$this->modelbasic->accessDatabase('question_categories','id,category_name', 'like', $data_array, $where_array, $join_array="",$limit="")->result_array();

    }

    else

    {

      $json_data=array();

    }



    $data['ajax']=json_encode($json_data);

    $this->load->view('ajax_view',$data);

  }



  public function generatePreview()

  {

    $question=$this->input->post('question',TRUE);

    $options=$this->input->post('option[]',TRUE);

    $correct_option=$this->input->post('is_correct',TRUE);

    $question=htmlspecialchars_decode($question, ENT_NOQUOTES);

    $html='<div class="row"><div class="col-sm-12"><div class="panel widget dark-widget panel-bd-left_grey"><div class="panel-body">'.$question.'</div></div></div></div><hr style="background: #999 none repeat scroll 0 0; height: 1px; margin-bottom: 40px;">';

    if(isset($correct_option))

    {

      $i=0;

               foreach ($options as $key => $opt)

               {

                  $class='vd_bg-white';

                  if($correct_option == $i)

                  {

                    $class='vd_bg-grey';

                  }

                  $opt=htmlspecialchars_decode($opt, ENT_NOQUOTES);

                  $html.='<div class="row"><div class="col-sm-12"><div class="panel widget dark-widget panel-bd-left_blue"><div class="panel-body  '.$class.'">'.$opt.'</div></div></div></div>';

                  $i++;

               }

    }

    else

    {



      $html.='<div class="row"><div class="col-sm-12"><div class="panel widget dark-widget panel-bd-left_blue"><p class="text-danger">No option selected.</p></div></div>';

    }



    $data['ajax']=$html;

    $this->load->view('ajax_view',$data);



  }



  public function saveQuestion($id='')

  {

    $question=$this->input->post('question',TRUE);

    $options=$this->input->post('option[]',TRUE);

    $correct_option=$this->input->post('is_correct',TRUE);

    $category=$this->input->post('category',TRUE);

    $marks=$this->input->post('marks',TRUE);

    $tenant_id = $this->session->userdata('tenant_id');



    $this->db->trans_start();

    $insertQuestion = array('question'=>htmlspecialchars_decode($question, ENT_NOQUOTES),'marks'=>$marks,'tenant_id'=>$tenant_id);

    if($id == '')

    {

      $questionId=$this->modelbasic->_insert('question_bank',$insertQuestion);

    }

    else

    {

      $this->modelbasic->_update('question_bank',$id,$insertQuestion);

      $questionId=$id;

    }



    if($id != '')

    {

      $this->modelbasic->_delete_with_conditions('answer_bank',array('tenant_id'=>$tenant_id,'question_id'=>$questionId));

      $this->modelbasic->_delete_with_conditions('question_category_relations',array('question_id'=>$questionId));

    }



    if(!empty($options))

    {

      $i=0;



      foreach ($options as $key => $opt)

      {

        $insertOptions = array('option'=>htmlspecialchars_decode($opt, ENT_NOQUOTES),'tenant_id'=>$tenant_id);

        if($id == '')

        {

          $optionId=$this->modelbasic->_insert('option_master',$insertOptions);

        }

        else

        {

          $options_id=$this->input->post('option_id[]',TRUE);

          //print_r($options_id);die;

          if(isset($options_id) && !empty($options_id))

          {

            $j=0;

            foreach ($options_id as $opt_id_key => $opt_id)

            {

              if($i==$j)

              {

                $this->modelbasic->_update('option_master',$opt_id,$insertOptions);

                $optionId=$opt_id;

              }

              else

              {

                $optionId=$this->modelbasic->_insert('option_master',$insertOptions);

              }



              $j++;

            }



          }

          else

          {

            $optionId=$this->modelbasic->_insert('option_master',$insertOptions);

          }

        }



        $correct_answer=0;

        if($i==$correct_option)

        {

          $correct_answer=1;

        }



        $insertAnswers = array('question_id'=>$questionId,'option_id'=>$optionId,'correct_answer'=>$correct_answer,'tenant_id'=>$tenant_id);

        $optionId=$this->modelbasic->_insert('answer_bank',$insertAnswers);

        $i++;

      }

    }



    if(isset($category) && $category != '')

    {



      $categories=explode(',',$category);

      foreach ($categories as $cat)

      {

        $categoryId=$this->modelbasic->getValue('question_categories','id',array('tenant_id'=>$tenant_id,'category_name'=>$cat));

        if($categoryId == '')

        {

          $insertCategory = array('category_name'=>$cat,'tenant_id'=>$tenant_id);

          $categoryId=$this->modelbasic->_insert('question_categories',$insertCategory);

        }



        $insertQuestionCatRelation = array('question_id'=>$questionId,'category_id'=>$categoryId);

        $this->modelbasic->_insert('question_category_relations',$insertQuestionCatRelation);

      }

    }



    $this->db->trans_complete();



    if ($this->db->trans_status() === FALSE)

    {

      $response=array('status'=>'fail','message'=>'Something went wrong please try again');

      $response['ajax']=json_encode($response);

    }

    else

    {

      if($id=='')

      {

        $response=array('status'=>'success','message'=>'Question inserted successfully');

      }

      else

      {

        $response=array('status'=>'success','message'=>'Question updated successfully');

      }



      $response['ajax']=json_encode($response);

    }



    $this->load->view('ajax_view',$response);



  }



  public function editor_upload_file()

  {

    $this->load->library('image_lib');

        $this->load->library('upload');

        $file_name='file';

    $imgArray =  array('gif','png' ,'jpg','jpeg');

    $filename = $_FILES[$file_name]['name'];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    $tenant_id = $this->session->userdata('tenant_id');

    if($_FILES[$file_name]['size'] != 0)

    {

      //$folderName=$this->session->userdata('tenant_id');

      $folderName=$tenant_id.'/quiz/';

      $upload_dir = file_upload_absolute_path().$folderName;



      if(!is_dir($upload_dir))

      {

        @mkdir($upload_dir, 0777, TRUE);

      }

      $upload_dir_thumbs= file_upload_absolute_path().$folderName.'/thumbs';



      if(!is_dir($upload_dir_thumbs))

      {

        @mkdir($upload_dir_thumbs, 0777, TRUE);

      }



      $path_parts = pathinfo($_FILES[$file_name]["name"]);

      $config['upload_path'] = $upload_dir;

      $config['allowed_types'] ='gif|jpg|png|jpeg|mp4|mp3';

      $config['file_name']=time().'.'.$path_parts['extension'];

      $this->upload->initialize($config);

      if (!$this->upload->do_upload($file_name))

      {

        $msg=$this->upload->display_errors();

        $dataArray=array('status'=>'error','message'=>strip_tags($msg));

        $responseData['ajax']=json_encode($dataArray);

        $this->load->view('ajax_view',$responseData);

      }

      else

      {

        $uploaded_file_name =  $this->upload->data();

        if(in_array($ext,$imgArray))

        {

              $config['image_library'] = 'gd2';

          $config['source_image'] = $upload_dir.'/'.$uploaded_file_name['file_name'];

          $config['new_image'] = $upload_dir.'/thumbs/'.$uploaded_file_name['file_name'];

          $config['create_thumb'] = FALSE;

          $config['maintain_ratio'] = TRUE;

          $config['width'] = 200;

          $config['height'] = 200;

          $this->image_lib->initialize($config);

          if ( ! $this->image_lib->resize())

          {

              $msg=$this->image_lib->display_errors();

              $dataArray=array('status'=>'error','message'=>$msg);

              $responseData['ajax']=json_encode($dataArray);

              $this->load->view('ajax_view',$responseData);

              //die();

          }

        }





        $dataArray=array('link'=>front_base_url().'uploads/'.$folderName.$uploaded_file_name['file_name']);

        $responseData['ajax']=json_encode($dataArray);

        $this->load->view('ajax_view',$responseData);



      }

    }

    else

    {

      $dataArray=array('status'=>'error','message'=>'Please select file');

      $responseData['ajax']=json_encode($dataArray);

      $this->load->view('ajax_view',$responseData);

    }



  }

}