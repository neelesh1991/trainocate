<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model

{

  public function get_total_users($tenant_id)

  {

    $this->db->select('COUNT(*) as cnt');

    $this->db->from('users');

    if($tenant_id != '1' && ($this->session->userdata('admin_level') != '1'))
    {
      $this->db->where('tenant_id',$tenant_id);
    }
    
    return $this->db->get()->row_array();

  }

  public function get_total_exams($tenant_id)

  {

    $this->db->select('COUNT(*) as cnt');

    $this->db->from('exam_master');

    if($tenant_id != '1' && ($this->session->userdata('admin_level') != '1'))
    {
      $this->db->where('tenant_id',$tenant_id);
    }

    return $this->db->get()->result_array();

  }

  public function get_exams_detail($tenant_id)

  {

    $this->db->select('id,exam_name');

    $this->db->from('exam_master');

    // $this->db->where('tenant_id',$tenant_id);

    if($tenant_id != '1' && ($this->session->userdata('admin_level') != '1'))
    {
      $this->db->where('tenant_id',$tenant_id);
    }

    return $this->db->get()->result_array();

  }

  public function get_total_question($tenant_id)

  {

    $this->db->select('COUNT(*) as cnt');

    $this->db->from('question_bank');

    if($tenant_id != '1' && ($this->session->userdata('admin_level') != '1'))
    {
      $this->db->where('tenant_id',$tenant_id);
    }

    return $this->db->get()->row_array();

  }


    public function get_total_assements($tenant_id)

  {

    /*$this->db->select('COUNT(*) as cnt');

    $this->db->from('quiz_log');

    $this->db->where('tenant_id',$tenant_id);
    $this->db->where('finish',1);

    return $this->db->get()->row_array();*/

  }




    public function get_total_retry_assements($tenant_id)

  {
    $this->db->select('count(*)-1 as count');
    $this->db->from('quiz_retry_log');
    $this->db->where('tenant_id',$tenant_id);

    $this->db->group_by('user_id');
    $this->db->having('count(*)-1 > ',0);


    return $this->db->get()->result_array();

  }



        public function get_levels($tenant_id)
  {
    return $this->db->get('mst_level')->result_array();
  }

  public function get_levels_from_id($level_id)
  {
    $this->db->select('id,level_name');
    $this->db->from('mst_level');
    $this->db->where('level_id',$level_id);
    return $this->db->get()->result_array();
  }

  public function search_exam_summary($tenant_id,$exam_id,$min_marks=0,$max_marks=0,$level)

  {

    //$this->db->select('quiz_log');

    //echo $tenant_id;die;

    $this->db->select('quiz_log.*,users.name,exam_master.exam_name');

    $this->db->from('quiz_log');

    $this->db->join('users','users.id=quiz_log.user_id');

    $this->db->join('exam_master','exam_master.id=quiz_log.exam_id');

    $this->db->where('quiz_log.tenant_id',$tenant_id);

    $this->db->where('quiz_log.exam_id',$exam_id);

    if($max_marks!=0)

    {

      $this->db->where("(quiz_log.percentage >= $min_marks) AND (quiz_log.percentage <= $max_marks)");

    }

    return $this->db->get()->result_array();

  }

  public function above_marks($tenant_id,$exam_id,$min_marks=0,$max_marks=0)

  {

    $this->db->select('COUNT(*) as cnt');

    $this->db->from('quiz_log as qa');
    $this->db->join('users','users.id=qa.user_id');
    $this->db->where('qa.tenant_id',$tenant_id);
    $this->db->where('qa.exam_id',$exam_id);

    if($max_marks!=0)

    {

      $this->db->where("(percentage >= $min_marks) AND (percentage <= $max_marks)");

    }

    return $this->db->get()->row_array();

  }

  public function total_assigned_exams($exam_id)

  {
    $this->db->select('users.id');
    $this->db->from('users');
    $this->db->join('exam_group_relation','users.group_id=exam_group_relation.group_id','left');
    $this->db->join('exam_user_relation','users.id=exam_user_relation.user_id','left');
    $this->db->where("exam_user_relation.exam_id=$exam_id OR exam_group_relation.exam_id=$exam_id");
    $this->db->group_by('users.id');
    $res=$this->db->get()->result_array();
    return count($res);

  }

  public function user_attempt_exams($tenant_id,$exam_id)

  {

      $this->db->select('COUNT(*) as cnt');

    $this->db->from('quiz_log as qa');
    $this->db->join('users','users.id=qa.user_id');
    $this->db->where('qa.tenant_id',$tenant_id);
    $this->db->where('qa.exam_id',$exam_id);
    return $this->db->get()->row_array();

  }

  public function search_exam_summary_csv($tenant_id,$exam_id,$min_marks=0,$max_marks=0,$level)

  {

    //$this->db->select('quiz_log');

    //echo $tenant_id;die;

    $this->db->select('quiz_log.user_id,users.name,users.email_id,users.contact_no,users.organization,users.city, exam_master.exam_name,quiz_log.start_time,quiz_log.end_time,quiz_log.no_of_question,quiz_log.attempt_question,quiz_log.correct_answer,quiz_log.out_of_marks,quiz_log.total_marks');

    $this->db->from('quiz_log');

    $this->db->join('users','users.id=quiz_log.user_id');

    $this->db->join('exam_master','exam_master.id=quiz_log.exam_id');

    $this->db->where('quiz_log.tenant_id',$tenant_id);

    $this->db->where('quiz_log.exam_id',$exam_id);

    if($max_marks!=0)

    {

      $this->db->where("(quiz_log.percentage >= $min_marks) AND (quiz_log.percentage <= $max_marks)");

    }

    $this->db->get()->result_array();

    return $this->db->last_query();

  }


public function getQuizLogData($tenant_id,$exam_id="")

  {

    //$this->db->select('quiz_log');

    //echo $tenant_id;die;

    $this->db->select('quiz_log.user_id,
            users.name,
            users.name,users.email_id,
            users.contact_no,
            users.organization,
            users.city,
            quiz_log.exam_id,
            exam_master.exam_name,
            quiz_log.start_time as attempted_date,
            quiz_log.no_of_question,
            quiz_log.attempt_question,
            quiz_log.correct_answer,
            quiz_log.out_of_marks,
            quiz_log.total_marks,
            quiz_log.percentage');

    $this->db->from('quiz_log');

    $this->db->join('users','users.id=quiz_log.user_id');

    $this->db->join('exam_master','exam_master.id=quiz_log.exam_id');

    // $this->db->where('quiz_log.tenant_id',$tenant_id);
    if($tenant_id != '1' && ($this->session->userdata('admin_level') != '1'))
    {
      $this->db->where('quiz_log.tenant_id',$tenant_id);
    }

    if($exam_id && $exam_id != '')
    {
      $this->db->where('quiz_log.exam_id',$exam_id);
  	} else{
      $this->db->order_by('exam_master.exam_name', 'ASC');
  	}

   //echo $this->db->last_query();die;

    return $this->db->get()->result_array();
  }

  function retryLogData($tenant_id,$exam_id=""){

    $this->db->select('quiz_retry_log.user_id,
      users.name,
      users.name,users.email_id,
      users.contact_no,
      users.organization,
      users.city,
      quiz_retry_log.exam_id,
      exam_master.exam_name,
      quiz_retry_log.start_time as attempted_date,
      quiz_retry_log.no_of_question,
      quiz_retry_log.attempt_question,
      quiz_retry_log.correct_answer,
      quiz_retry_log.out_of_marks,
      quiz_retry_log.total_marks,
      quiz_retry_log.percentage');

    $this->db->from('quiz_retry_log');
    if($exam_id && $exam_id != '')
    {
      $this->db->where('quiz_retry_log.exam_id',$exam_id);
    }else{
      $this->db->order_by('exam_master.exam_name', 'ASC');
    }
    // $this->db->where('quiz_retry_log.tenant_id',$tenant_id);
    if($tenant_id != '1' && ($this->session->userdata('admin_level') != '1'))
    {
      $this->db->where('quiz_retry_log.tenant_id',$tenant_id);
    }
    
    $this->db->join('users','users.id=quiz_retry_log.user_id');

    $this->db->join('exam_master','exam_master.id=quiz_retry_log.exam_id');
    $res=$this->db->get()->result_array();

    return $res;
    }





  public function users_attempt_que_ans($user_id,$exam_id,$quiz_id,$tenant_id)

  {

    $this->db->select('A.*,B.question,B.marks,C.option as selected_answer_name,D.option as correct_answer');

    $this->db->from('quiz as A');

    $this->db->join('question_bank as B','B.id=A.question_id');

    $this->db->join('option_master as C','C.id=A.selected_answer');

    $this->db->join('option_master as D','D.id=A.correct_answer_opt_id');

    $this->db->where('A.tenant_id',$tenant_id);

    $this->db->where('A.exam_id',$exam_id);

    $this->db->where('A.user_id',$user_id);

    $this->db->where('A.quiz_id',$quiz_id);

    $this->db->where('A.mock ',0);

    return $this->db->get()->result_array();

  }

  /*public function selectOptions($question_id)

  {

    $this->db->select('B.correct_answer,C.*');

    $this->db->from('question_bank as A');

    $this->db->join('answer_bank as B','B.question_id=A.id');

    $this->db->join('option_master as C','C.id=B.option_id');

    $this->db->where('A.id',$question_id);

    return $this->db->get()->result_array();

  }*/
  function get_result($quiz_id,$exam_id,$user_id,$tenant_id)
    {

      $this->db->select('COUNT(*) as cnt');
      $this->db->from('quiz');
      $this->db->where('tenant_id',$tenant_id);
      $this->db->where('selected_answer=correct_answer_opt_id');
      $this->db->where('exam_id',$exam_id);
      $this->db->where('tenant_id',$tenant_id);
      $this->db->where('user_id',$user_id);
      return $this->db->get()->row_array();
    }

    public function get_user_detail($tenant_id)
    {
      $this->db->select('id,name');
      $this->db->from('users');
      if($tenant_id != '1' && ($this->session->userdata('admin_level') != '1'))
      {
        $this->db->where('tenant_id',$tenant_id);
      }
      return $this->db->get()->result_array();

    }





}
