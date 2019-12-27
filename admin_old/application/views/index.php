<?php

$data=array();

  // Turn TRUE when working in CSS and JS files

  // Trun TRUE once worked with CSS and JS.

  // Again turn FALSE to rebuiled minified faster loading CSS and JS

$data['rebuild']     =  FALSE;

$this->load->view('common/include_top_n',$data);

  if($page_name != "login_view")



  {



    $this->load->view('common/header');



  }



//echo($page_name);die;



  $this->load->view($page_name);



  //include 'chat.php';



  if($page_name != "login_view")



  {



    $this->load->view('common/footer');



    /*$this->load->view('common/chatmenu_view');*/



  }



$this->load->view('common/include_bottom_n',$data);



?>