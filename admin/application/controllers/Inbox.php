<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Inbox extends CI_Controller
{
	function __construct()
	{
	    	parent::__construct();
	}

	public function index()
	{
		$data['page_name']='inbox_view';
		$this->load->view('index',$data);
	}

	public function getEmails()
	{
		//Google Email Settings
	        $data=array();
	        //$data['type'] = 'pop3 or imap';
	        $data['type'] = 'imap';
	        //$data['protocol_type'] = 'ssl or tls or none';
	        $data['protocol_type'] = 'ssl';
	        //$data['port'] = '993 or 995';
	        $data['host'] = 'imap.gmail.com';
	        $data['port'] = '993';
	        $data['login_name'] = 'test.unichronic@gmail.com';
	        $data['password'] = 'Uspl@12345';

	      //Yahoo Email Settings
	/*         $data=array();
	         $data['type'] = 'imap';
	         $data['protocol_type'] = 'ssl';
	         $data['host'] = 'imap.mail.yahoo.com';
	         $data['port'] = '993';
	         $data['login_name'] = 'santosh.badal@yahoo.com';
	         $data['password'] = 'M1cr0s0ft';*/

         	//Hotmail Email Settings
                /* $data=array();
                 $data['type'] = 'pop3';
                 $data['protocol_type'] = 'ssl';    //Secure Password Authentication – SPA,SSL
                 $data['host'] = 'pop3.live.com';
                 $data['port'] = '995';*/

           //Webmail Email Settings
              /*$data=array();
              $data['type'] = 'imap';
              $data['protocol_type'] = 'ssl';
              $data['host'] = 'p3plcpnl0048.prod.phx3.secureserver.net';
              $data['port'] = '993';
              $data['login_name'] = 'santosh.badal@unichronic.com';
              $data['password'] = 'M1cr0s0ft';*/

	        if($data['type'] == 'pop3' && $data['protocol_type'] == 'none')
	        {
	               $hostname = '{'.$data['host'].':'.$data['port'].'/pop3}INBOX';
	             $username = $data['login_name'];
	              $password = $data['password'];
	            $imap = imap_open($hostname,$username,$password)or die(imap_last_error());

	            if (!imap_ping($imap)) {
	                echo "Test Failed.";
	                }else{
	                      echo "Test Successfull6.";
	                }
	        }elseif($data['type'] == 'imap' && $data['protocol_type'] == 'none') {
	             $hostname = '{'.$data['host'].':'.$data['port'].'}INBOX';
	             $username = $data['login_name'];
	              $password = $data['password'];
	            $imap = imap_open($hostname,$username,$password);
	            if (!imap_ping($imap)) {
	                echo "Test Failed.";
	                }else{
	                      echo "Test Successfull5.";
	                }
	        }
	      if($data['type'] == 'pop3' && $data['protocol_type'] == 'ssl')
	      {
	             $hostname = '{'.$data['host'].':'.$data['port'].'/pop3/ss}INBOX';
	             $username = $data['login_name'];
	             $password = $data['password'];
	            $imap = imap_open($hostname,$username,$password);
	      //
	            if (!imap_ping($imap)) {
	                echo "Test Failed.";
	                }else{
	                      echo "Test Successfull4.";
	                }
	      }
	      if($data['type'] == 'imap' && $data['protocol_type'] == 'ssl')
	      {
	        $hostname = '{'.$data['host'].':'.$data['port'].'/imap/ssl/novalidate-cert}INBOX';
	        $username = $data['login_name'];
	        $password = $data['password'];

	/* try to connect */
	        $inbox = imap_open($hostname,$username,$password);

	            if (!imap_ping($inbox)) {
	                echo "Test Failed.";
	                }else{
	                      $emails = imap_search($inbox,'ALL');
	                      if($emails) {

	                          /* begin output var */
	                          $output = '';

	                          /* put the newest emails on top */
	                          rsort($emails);

	                          /* for every email... */
	                          $i=0;
	                          foreach($emails as $email_number)
	                          {
	                              if($i < 2)
	                              {
                                      $overview = imap_fetch_overview($inbox,$email_number,0);

                                      $message = imap_fetchbody($inbox,$email_number,2);
                                      /* output the email header information */
                                      $output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
                                      $output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
                                      $output.= '<span class="from">'.$overview[0]->from.'</span>';
                                      $output.= '<span class="date">on '.$overview[0]->date.'</span>';
                                      $output.= '</div>';

                                      /* output the email body */
                                      $output.= '<div class="body">'.$message.'</div>';
	                              }
	                              /* get information specific to this email */
	                              $i++;
	                          }

	                          echo $output;
	                      }
	                }
	      }

	       if($data['type'] == 'pop3' && $data['protocol_type'] == 'tls')
	      {
	             $hostname = '{'.$data['host'].':'.$data['port'].'/pop3/tls}INBOX';
	             $username = $data['login_name'];
	             $password = $data['password'];
	             $imap = imap_open($hostname,$username,$password)or die(imap_last_error());
	            if (!imap_ping($imap)) {
	                echo "Test Failed.";
	                }else{
	                      echo "Test Successfull2.";
	                }
	      }
	      if($data['type'] == 'imap' && $data['protocol_type'] == 'tls')
	      {
	        $hostname = '{'.$data['host'].':'.$data['port'].'/imap/tls}INBOX';
	             $username = $data['login_name'];
	             $password = $data['password'];
	             $imap = imap_open($hostname,$username,$password);

	            if (!imap_ping($imap)) {
	                echo "Test Failed.";
	                }else{
	                      echo "Test Successfull1.";
	                }
	      }
	}

}