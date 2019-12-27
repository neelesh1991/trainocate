<!DOCTYPE html>

<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->

<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->

<!--[if gt IE 9]><!-->  <html><!--<![endif]-->

<!-- Specific Page Data -->

<!-- End of Data -->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

  <meta charset="utf-8" />

  <title>Set new password to your account</title>

  <!-- Set the viewport width to device width for mobile -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Fav and touch icons -->

  <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon111.png">

  <!-- CSS -->

  <!-- Bootstrap & FontAwesome & Entypo CSS -->

  <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!--[if IE 7]><link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome-ie7.min.css"><![endif]-->

  <link href="<?php echo base_url();?>assets/css/font-entypo.css" rel="stylesheet" type="text/css">

  <!-- Fonts CSS -->

  <link href="<?php echo base_url();?>assets/css/fonts.css"  rel="stylesheet" type="text/css">

  <!-- Plugin CSS -->

  <link href="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.custom.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url();?>assets/plugins/prettyPhoto-plugin/css/prettyPhoto.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url();?>assets/plugins/isotope/css/isotope.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url();?>assets/plugins/pnotify/css/jquery.pnotify.css" media="screen" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url();?>assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url();?>assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url();?>assets/plugins/tagsInput/jquery.tagsinput.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url();?>assets/plugins/bootstrap-switch/bootstrap-switch.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url();?>assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url();?>assets/plugins/colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css">

  <!-- Specific CSS -->

  <!-- Theme CSS -->

  <link href="<?php echo base_url();?>assets/css/theme.css" rel="stylesheet" type="text/css">

  <!--[if IE]> <link href="<?php echo base_url();?>assets/css/ie.css" rel="stylesheet" > <![endif]-->

  <link href="<?php echo base_url();?>assets/css/chrome.css" rel="stylesheet" type="text/chrome"> <!-- chrome only css -->

  <!-- Responsive CSS -->

  <link href="<?php echo base_url();?>assets/css/theme-responsive.min.css" rel="stylesheet" type="text/css">

  <!-- for specific page in style css -->

  <!-- for specific page responsive in style css -->

  <!-- Custom CSS -->

  <link href="<?php echo base_url();?>assets/custom/custom.css" rel="stylesheet" type="text/css">

  <!-- Head SCRIPTS -->

  <script type="text/javascript" src="<?php echo base_url();?>assets/js/modernizr.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/js/mobile-detect.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/js/mobile-detect-modernizr.js"></script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!--[if lt IE 9]>

  <script type="text/javascript" src="<?php echo base_url();?>assets/js/html5shiv.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/js/respond.min.js"></script>

  <![endif]-->

  <style>

  .login-layout .panel-body

  {


  padding: 20px 30px;

  }

  .login-layout .panel

  {

  background:#fff;

  }

  .error-span

  {

  color: red;

  }

  </style>

</head>

<body id="pages" class="full-layout no-nav-left no-nav-right  nav-top-fixed background-login     responsive remove-navbar login-layout   clearfix" data-active="pages "  data-smooth-scrolling="1">

  <div class="vd_body">

    <!-- Header Start -->

    <!-- Header Ends -->

    <div class="content">

      <div class="container">

        <!-- Middle Content Start -->

        <div class="vd_content-wrapper">

          <div class="vd_container">

            <div class="vd_content clearfix">

              <div class="vd_content-section window-bg clearfix">

                <?php if($this->session->flashdata('error')){?>

                <div class="alert alert-danger vd_hidden">

                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>

                  <span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><?php echo $this->session->flashdata('error');?></div>

                  <?php } ?>

                  <?php if($this->session->flashdata('error')){?>

                  <div class="alert alert-success vd_hidden">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>

                    <span class="vd_alert-icon"><i class="fa fa-check-circle vd_green"></i></span><?php echo $this->session->flashdata('success');?></div>

                    <?php } ?>

                    <div class="vd_login-page">

                      <div class="heading clearfix">

                        <h4 class="text-center font-semibold vd_white">To reset password enter your registered email id.</h4>

                      </div>

                      <div class="panel widget">

                        <div class="panel-body">

                          <div class="login-icon entypo-icon">
                          <img src="<?php echo base_url();?>assets/img/logo.png" alt=""></div>

                          <form class="form-horizontal" action="<?php echo base_url();?>login/forgot_password" method="post">

                            <div class="form-group  mgbt-xs-20">

                              <div class="col-md-12">

                                <div class="label-wrapper sr-only">

                                  <label class="control-label" for="password">Email Id</label>

                                </div>

                                <div class="vd_input-wrapper light-theme" id="email-input-wrapper"> <span class="menu-icon"> <i class="fa fa-envelope"></i> </span>

                                <input type="text" placeholder="Your Email Id" id="email" name="emailId" class="required" value="<?php echo set_value('emailId');?>">

                              </div>

                              <span class="error-span"><?php echo form_error('emailId');?></span>

                            </div>

                          </div>

                          <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>

                          <div class="form-group">

                            <div class="col-md-12 text-center mgbt-xs-5">

                              <button class="btn vd_btn vd_btn-bevel vd_bg-blue font-semibold " type="submit">Submit</button>

                              <a href="<?php echo base_url();?>login" class="btn vd_btn vd_btn-bevel vd_bg-blue font-semibold " type="reset">Cancel</a>

                            </div>

                          </div>

                        </form>

                      </div>

                    </div>

                  </div>

                  <!-- vd_login-page -->

                </div>

                <!-- .vd_content-section -->

              </div>

              <!-- .vd_content -->

            </div>

            <!-- .vd_container -->

          </div>

          <!-- .vd_content-wrapper -->

          <!-- Middle Content End -->

        </div>

        <!-- .container -->

      </div>

      <!-- .content -->

      <!-- Footer Start -->

      <footer class="footer-2"  id="footer">

        <div class="vd_bottom ">

          <div class="container">

            <div class="row">

              <div class=" col-xs-12">

                <div class="copyright text-center">

                  Copyright &copy;2016 QUIZ-Admin All Rights Reserved

                </div>

              </div>

              </div><!-- row -->

              </div><!-- container -->

            </div>

          </footer>

          <!-- Footer END -->

        </div>

        <!-- .vd_body END  -->

        <a id="back-top" href="javascript:void(0);" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>

        <!--

        <a class="back-top" href="javascript:void(0);" id="back-top"> <i class="icon-chevron-up icon-white"> </i> </a> -->

        <!-- Javascript =============================================== -->

        <!-- Placed at the end of the document so the pages load faster -->

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>

        <!--[if lt IE 9]>

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/excanvas.js"></script>

        <![endif]-->

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

        <script type="text/javascript" src='<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.custom.min.js'></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/caroufredsel.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/breakpoints/breakpoints.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/prettyPhoto-plugin/js/jquery.prettyPhoto.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/tagsInput/jquery.tagsinput.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/blockUI/jquery.blockUI.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/pnotify/js/jquery.pnotify.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/theme.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>assets/custom/custom.js"></script>

        <!-- Specific Page Scripts Put Here -->

        <script type="text/javascript">

        $(document).ready(function() {

        "use strict";

        var form_register_2 = $('#login-form');

        var error_register_2 = $('.alert-danger', form_register_2);

        var success_register_2 = $('.alert-success', form_register_2);

        form_register_2.validate({

        errorElement: 'div', //default input error message container

        errorClass: 'vd_red', // default input error message class

        focusInvalid: false, // do not focus the last invalid input

        ignore: "",

        rules: {

        conf_password: {

        required: true,

        minlength: 6

        },

        password: {

        required: true,

        minlength: 6

        },

        },

        errorPlacement: function(error, element) {

        if (element.parent().hasClass("vd_checkbox") || element.parent().hasClass("vd_radio")){

        element.parent().append(error);

        } else if (element.parent().hasClass("vd_input-wrapper")){

        error.insertAfter(element.parent());

        }else {

        error.insertAfter(element);

        }

        },

        invalidHandler: function (event, validator) { //display error alert on form submit

        success_register_2.hide();

        error_register_2.show();

        },

        highlight: function (element) { // hightlight error inputs

        $(element).addClass('vd_bd-red');

        $(element).parent().siblings('.help-inline').removeClass('help-inline hidden');

        if ($(element).parent().hasClass("vd_checkbox") || $(element).parent().hasClass("vd_radio")) {

        $(element).siblings('.help-inline').removeClass('help-inline hidden');

        }

        },

        unhighlight: function (element) { // revert the change dony by hightlight

        $(element)

        .closest('.control-group').removeClass('error'); // set error class to the control group

        },

        success: function (label, element) {

        label

        .addClass('valid').addClass('help-inline hidden') // mark the current input as valid and display OK icon

        .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group

        $(element).removeClass('vd_bd-red');

        },

        submitHandler: function (form) {

        $(form).find('#login-submit').prepend('<i class="fa fa-spinner fa-spin mgr-10"></i>')/*.addClass('disabled').attr('disabled')*/;

        //success_register_2.show();

        //error_register_2.hide();

        submitForm();

        }

        });

        });

        </script>

        <script>

        function submitForm(){

        BASEURL='<?php echo base_url();?>';

        $('#login-submit').prop("disabled", true);

        var form_register_2 = $('#login-form');

        var error_register_2 = $('.alert-danger', form_register_2);

        var success_register_2 = $('.alert-success', form_register_2);

        var formData = $( "#login-form" ).serialize();

        $.ajax({

        url: BASEURL+"login",

        type: 'POST',

        data:  formData

        }).done(function(responce)

        {

        $('.fa-spinner').remove();

        var data = jQuery.parseJSON(responce);

        if(data.status=='error')

        {

        $.each(data.errorfields, function()

        {

        $.each(this, function(name, value)

        {

        $('[name*="'+name+'"]').parent().after('<div class="vd_red">'+value+'</div>');

        });

        });

        $('#login-submit').prop("disabled", false);

        }

        else

        {

        if(data.status=='success')

        {

        document.getElementById("login-form").reset();

        window.location.href = BASEURL+'home';

        }

        else

        {

        $('.fa-spinner').remove();

        success_register_2.hide();

        error_register_2.show();

        $('#login-submit').prop("disabled", false);

        }

        }

        }).fail(function( jqXHR, textStatus ) {

        alert( "Request failed: " + textStatus );

        $('#login-submit').prop("disabled", false);

        });

        }

        </script>

        <!-- Specific Page Scripts END -->

      </body>

    </html>