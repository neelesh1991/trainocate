<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'home';
$route['404_override'] = 'custom';
$route['translate_uri_dashes'] = FALSE;

  
  if(PAGE_NAME !='')
  {
	
      require_once( BASEPATH .'database/DB.php' );
      $db =& DB();

      $result = $db->select('id')->from('tenant')->where('url', PAGE_NAME )->get(  )->row_array();

      if($result > 0)
      {	
              if(NEW_URL == '')
              {
                        $route[PAGE_NAME]=$route['default_controller'];
              }
              else
              {
                      $route[PAGE_NAME.'/(:any)']=NEW_URL;
              }

      }
  }








