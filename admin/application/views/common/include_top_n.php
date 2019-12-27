<!DOCTYPE html>

<!--[if IE 8]>      <html class="ie ie8"> <![endif]-->

<!--[if IE 9]>      <html class="ie ie9"> <![endif]-->

<!--[if gt IE 9]><!-->  <html><!--<![endif]-->

<head>

    <?php

      $ci= &get_instance();

      $ci->load->model('test_model');

      $result =$ci->test_model->get_all_settings();

    ?>

    <title><?php echo $result[1]['description'];?></title>

    <meta name="keywords" content="HTML5 Template, CSS3, All Purpose Admin Template, " />

    <meta name="description" content="Responsive Admin Template for multipurpose use">

    <meta name="author" content="Venmond">

    <!-- Set the viewport width to device width for mobile -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets/img/ico/apple-touch-icon-144-precomposed.html">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>assets/img/ico/apple-touch-icon-114-precomposed.png">

    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>assets/img/ico/apple-touch-icon-72-precomposed.png">

    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>assets/img/ico/apple-touch-icon-57-precomposed.png">

    <link rel="shortcut icon" href="<?php echo front_base_url();?>uploads/settings/favicon/thumbs/<?php echo $result[5]['description'];?>">

<!--     <link href="<?php echo base_url();?>assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" /> -->

    <!-- $cssArray minify array -->

<!--     <link href="<?php echo base_url();?>assets/css/theme.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url();?>assets/css/theme-responsive.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url();?>assets/css/chrome.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url();?>assets/css/fonts.css" rel="stylesheet" type="text/css"> -->

      <?php

          $cssArray=array('fileinput.css','bootstrap.min.css','theme.css','theme-responsive.min.css','chrome.css','fonts.css', 'font-awesome.min.css','jquery-ui.custom.min.css' );

          if($page_name == 'dashboard_view')

          {

          $cssArray[]='font-entypo.css';

          }

          $this->minify->css($cssArray);

          echo $this->minify->deploy_css($rebuild);

      ?>

    <!-- Head SCRIPTS -->
    <link href="<?php echo base_url();?>assets/plugins/pnotify/css/jquery.pnotify.css" media="screen" rel="stylesheet" type="text/css">
    <base href="<?php echo base_url();?>">

  <script>

    var ajax_base_url= "<?php echo base_url();?>";

  </script>

    <?php $this->load->view('common/additional_css');?>
    <?php

        $ci= &get_instance();

        $result =$ci->modelbasic->getValue('settings','description',array('type'=>'header_color'));

        $resultfooter =$ci->modelbasic->getValue('settings','description',array('type'=>'footer_color'));

        $resultleftnav =$ci->modelbasic->getValue('settings','description',array('type'=>'leftNavColor'));

        $resultprofcolor =$ci->modelbasic->getValue('settings','description',array('type'=>'profileColor'));

        //echo $resultfooter;die;

    ?>

    <style type="text/css">

        .themeColor{

        background: #<?php echo $result;?> !important;

        }



        .themeColorhower:hover{

        color: #<?php echo $result;?> !important;

        }

        .themeColorfooter{

        background: #<?php echo $resultfooter;?> !important;

        }

        .leftNavColor{

        background: #<?php echo $resultleftnav;?> !important;

        }

        .profileColor{

        background: #<?php echo $resultprofcolor;?> !important;

        }
.processing{
  border: 1px solid #eee;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
}
    </style>

  </head>
      <body id="dashboard" class="<?php if($page_name == 'login_view'){ echo 'full-layout no-nav-left no-nav-right window-bg  nav-top-fixed background-login     responsive login-layout   clearfix breakpoint-975';}else{ echo 'full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed      responsive    clearfix content';}?>" data-active="dashboard "  data-smooth-scrolling="1">

    <div class="vd_body">