<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8">
  <![endif]-->
  <!--[if IE 9]>
  <html class="ie ie9">
    <![endif]-->
    <!--[if gt IE 9]><!-->
    <html>
      <!--<![endif]-->
      <!-- Specific Page Data -->
      <!-- End of Data -->
      <head>
        <title>404 Error Page</title>
        <!-- Set the viewport width to device width for mobile -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon111.png">
        <!-- CSS -->
        <!-- Bootstrap & FontAwesome & Entypo CSS -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>assets/css/fonts.css"  rel="stylesheet" type="text/css">
        <!-- Plugin CSS -->
        <!-- Theme CSS -->
        <link href="<?php echo base_url();?>assets/css/theme.css" rel="stylesheet" type="text/css">
        <!--[if IE]>
        <link href="<?php echo base_url();?>assets/css/ie.css" rel="stylesheet" >
        <![endif]-->
        <link href="<?php echo base_url();?>assets/css/chrome.css" rel="stylesheet" type="text/chrome">
        <!-- chrome only css -->
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
                    <div class="vd_content-section clearfix">
                      <div class="vd_register-page">
                        <div class="heading clearfix">
                          <div class="logo">
                            <h2 ><img src="<?php echo base_url();?>uploads/settings/logo/thumbs/logo.png" alt="logo"></h2>
                          </div>
                        </div>
                        <div class="panel widget">
                          <div class="panel-body">
                            <div class="login-icon"> <i class="fa fa-cog"></i> </div>
                            <h1 class="font-semibold text-center" style="font-size:52px">404 ERROR</h1>
                            <form class="form-horizontal" action="#" role="form">
                              <div class="form-group">
                                <div class="col-md-12">
                                  <h4 class="text-center mgbt-xs-20">Your requested page could not be found or it is currently unavailable.</h4>
                                  <p class="text-center"> Please <a href="index.html">click here</a> to go back to our home page or use the search form below</p>
                                  <div class="vd_input-wrapper" id="email-input-wrapper"> <span class="menu-icon"> <i class="fa fa-search"></i> </span>
                                    <input type="text" placeholder="Search Here" class="width-80">
                                  </div>
                                </div>
                              </div>
                              <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                            </form>
                          </div>
                        </div>
                        <!-- Panel Widget -->
                        <div class="register-panel text-center font-semibold"> <a href="javascript:void(0);">Home</a> <span class="mgl-10 mgr-10 vd_soft-grey">|</span> <a href="javascript:void(0);">About</a> <span class="mgl-10 mgr-10 vd_soft-grey">|</span> <a href="javascript:void(0);">FAQ</a> <span class="mgl-10 mgr-10 vd_soft-grey">|</span> <a href="javascript:void(0);">Contact</a> </div>
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
          <!-- .content -->        <!-- .vd_body END  -->

        <!--
          <a class="back-top" href="javascript:void(0);" id="back-top"> <i class="icon-chevron-up icon-white"> </i> </a> -->
        <!-- Javascript =============================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/excanvas.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins.js"></script>
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
                          email: {
                              required: true,
                              email: true
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
                        $('.fa-spinner').remove();
                        $(form).find('#login-submit').prepend('<i class="fa fa-spinner fa-spin mgr-10"></i>');
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
                                                              $('.alert-success').show();
                                                              $('.alert-danger').hide();
                                                              $('.alert-success').html('<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="icon-cross"></i></button><span class="vd_alert-icon"><i class="fa fa-check-circle append-icon"></i></span><strong>Well done! </strong>'+data.message+'. ');
                                                              document.getElementById("login-form").reset();
                                                              window.location.href = BASEURL+'dashboard';
                                                      }
                                                      else
                                                      {
                                                          if(data.status == 'fail')
                                                          {

                                                              $('.alert-danger').html('<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="icon-cross"></i></button><span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oh snap! </strong>'+data.message+'. ');
                                                              $('.fa-spinner').remove();
                                                              success_register_2.hide();
                                                              error_register_2.show();
                                                              $('#login-submit').prop("disabled", false);
                                                          }
                                                          else
                                                          {
                                                              $('.fa-spinner').remove();
                                                              success_register_2.hide();
                                                              error_register_2.show();
                                                              $('#login-submit').prop("disabled", false);
                                                          }
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