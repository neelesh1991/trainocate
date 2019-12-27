<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  <html><!--<![endif]-->

<!-- Specific Page Data -->
<!-- End of Data -->

<head>
    <meta charset="utf-8" />
    <title>UniDating | web installer</title>
    <meta name="keywords" content="HTML5 Template, CSS3, Mega Menu, Admin Template, Elegant HTML Theme, Vendroid" />
    <meta name="description" content="Form Wizards - Responsive Admin HTML Template">
    <meta name="author" content="Venmond">

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets/img/ico/apple-touch-icon-144-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>assets/img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>assets/img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>assets/img/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/ico/favicon.png">


    <!-- CSS -->

    <!-- Bootstrap & FontAwesome & Entypo CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if IE 7]><link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome-ie7.min.css"><![endif]-->
    <link href="<?php echo base_url();?>assets/css/font-entypo.css" rel="stylesheet" type="text/css">
    <!-- Fonts CSS -->
    <link href="<?php echo base_url();?>assets/css/fonts.css"  rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="<?php echo base_url();?>assets/css/theme.min.css" rel="stylesheet" type="text/css">
    <!--[if IE]> <link href="<?php echo base_url();?>assets/css/ie.css" rel="stylesheet" > <![endif]-->
    <link href="<?php echo base_url();?>assets/css/chrome.css" rel="stylesheet" type="text/chrome"> <!-- chrome only css -->

    <!-- Responsive CSS -->
            <link href="<?php echo base_url();?>assets/css/theme-responsive.min.css" rel="stylesheet" type="text/css">




    <!-- for specific page in style css -->

    <!-- for specific page responsive in style css -->


    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/custom/custom.css" rel="stylesheet" type="text/css">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="<?php echo base_url();?>assets/js/html5shiv.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>assets/js/respond.min.js"></script>
    <![endif]-->

</head>

<body id="forms" class="full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed      responsive    clearfix" data-active="forms "  data-smooth-scrolling="1">
    <div class="content">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="panel widget">
                <div class="panel-heading vd_bg-black">
                  <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-magic"></i> </span> UniDating Installation.</h3>
                </div>
                  <div class="panel-body">
                  <div class="alert alert-info"> <span class="vd_alert-icon"><i class="fa fa-info-circle vd_blue"></i></span><strong>Install the script in few clicks!</strong> Provide required information,database and admin settings and run the installer. .<strong>It's easy !</strong> </div>

                    <ol style="clear:both; text-align:left;">
                        <li><span style="color:#900;font-weight:bold;">Required</span> -
                            application/config/database.php to be <span style="color:#063;font-weight:bold;">writtable</span>

                            <?php
                                // Checking whether db config file is writtable
                                if (is_writable('./application/config/database.php')):?>
                                    <img src="<?php echo base_url();?>assets/install/images/tick.png" title="writtable" style="vertical-align:middle;width: 25px;margin-bottom: 5px"/>
                            <?php
                                else:?>
                                    <img src="<?php echo base_url();?>assets/images/cross.png" title="not writtable" style="vertical-align:middle;width: 25px;margin-bottom: 5px"/>
                            <?php endif;?>
                        </li>

                        <li><span style="color:#900;font-weight:bold;">Required</span> -
                            application/config/routes.php to be <span style="color:#063;font-weight:bold;">writtable</span>


                            <?php
                                // Checking whether routing config file is writtable
                                if (is_writable('./application/config/routes.php')):?>
                                    <img src="<?php echo base_url();?>assets/install/images/tick.png" title="writtable" style="vertical-align:middle;width: 25px;margin-bottom: 5px"/>
                            <?php
                                else:?>
                                    <img src="<?php echo base_url();?>assets/images/cross.png" title="not writtable" style="vertical-align:middle;width: 25px;margin-bottom: 5px"/>
                            <?php endif;?>
                        </li>

                        <li><span style="color:#900;font-weight:bold;">Required</span> -
                            php CURL function <span style="color:#063;font-weight:bold;">enabled </span>

                            <?php
                                // Checking whether CURL installed or not
                                if (in_array  ('curl', get_loaded_extensions())):?>
                                    <img src="<?php echo base_url();?>assets/install/images/tick.png" title="curl found" style="vertical-align:middle;width: 25px;margin-bottom: 5px"/>
                            <?php
                                else:?>
                                    <img src="<?php echo base_url();?>assets/images/cross.png" title="curl not found" style="vertical-align:middle;width: 25px;margin-bottom: 5px"/>
                            <?php endif;?>
                        </li>
                    </ol>
                        <?php if( $this->session->flashdata('installation_result') == 'failed'):?>
                            <div class="alert alert-danger alert-dismissable alert-condensed">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                                                    <i class="fa fa-exclamation-circle append-icon"></i><strong>Oh snap!</strong> Installation failed due to invalid settings. </div>
                        <?php endif;?>

                        <?php if( ($this->session->flashdata('flash_message'))  != "" ):?>

                            <div class="alert alert-danger alert-dismissable alert-condensed">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                                                    <i class="fa fa-exclamation-circle append-icon"></i><strong>Oh snap! </strong><?php echo $this->session->flashdata('flash_message');?> </div>
                        <?php endif;?>
                    <form class="form-horizontal" id="installationForm" method="post" action="<?php echo base_url();?>install/do_install" role="form">
                      <div id="wizard-2" class="form-wizard">
                        <ul>
                          <li><a href="#tab21" data-toggle="tab">
                            <div class="menu-icon"> 1 </div>
                            Database Settings </a></li>
                          <li><a href="#tab22" data-toggle="tab">
                            <div class="menu-icon"> 2 </div>
                            Site Settings </a></li>
                          <li><a href="#tab23" data-toggle="tab">
                            <div class="menu-icon"> 3 </div>
                            Email Settings </a></li>

                        </ul>
                        <div class="progress progress-striped active">
                          <div class="progress-bar progress-bar-info" > </div>
                        </div>
                        <div class="tab-content no-bd pd-25">
                          <div class="tab-pane" id="tab21">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Database Name</label>
                              <div class="col-sm-3 controls">
                                <input type="text" name="db_name" class="input-border-btm">
                              </div>
                              <label class="col-sm-2 control-label">User name</label>
                              <div class="col-sm-3 controls">
                                <input type="text" name="db_uname" class="input-border-btm">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Password</label>
                              <div class="col-sm-3 controls">
                                <input type="password" name="db_password" class="input-border-btm">
                              </div>
                              <label class="col-sm-2 control-label">Host Name</label>
                              <div class="col-sm-3 controls">
                                <input type="text" name="db_hname" class="input-border-btm">
                              </div>
                            </div>

                          </div>
                          <div class="tab-pane" id="tab22">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Site name</label>
                              <div class="col-sm-7 controls">
                                <input type="text" name="system_name" class="input-border-btm">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Admin email</label>
                              <div class="col-sm-7 controls">
                                <input type="text" name="email" class="input-border-btm">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Login Password</label>
                              <div class="col-sm-7 controls">
                                <input type="password" name="password" class="input-border-btm">
                              </div>
                            </div>

                          </div>
                          <div class="tab-pane" id="tab23">
                            <div class="form-group">
                                <div class="col-sm-4 controls"></div>
                              <div class="col-sm-8 controls">
                              This settings will be used while sending emails.<br/>
                              ex:- <strong>Email From Text</strong>- Unichronic Systems<br/>
                              <strong>Senders Email Id</strong>- contact@unichronic.com<br/>
                              </div>
                            </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Email From Text</label>
                            <div class="col-sm-7 controls">
                              <input type="text" name="from_text" class="input-border-btm">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 control-label">Senders Email Id</label>
                            <div class="col-sm-7 controls">
                              <input type="text" name="from_email" class="input-border-btm">
                            </div>
                          </div>
                          </div>

                          <div class="form-actions-condensed wizard">
                            <div class="row mgbt-xs-0">
                              <div class="col-sm-9 col-sm-offset-2"> <a class="btn vd_btn prev" href="javascript:void(0);"><span class="menu-icon"><i class="fa fa-fw fa-chevron-circle-left"></i></span> Previous</a> <a class="btn vd_btn next" href="javascript:void(0);">Next <span class="menu-icon"><i class="fa fa-fw fa-chevron-circle-right"></i></span></a> <button type="submit" class="btn vd_btn vd_bg-green finish"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Finish</button> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- Panel Widget -->
              </div>
              <!-- col-md-12 -->
            </div>
            </div>
            </div>
            <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
            <!--[if lt IE 9]>
              <script type="text/javascript" src="<?php echo base_url();?>assets/js/excanvas.js"></script>
            <![endif]-->
            <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

            <!-- Specific Page Scripts Put Here -->
            <script type="text/javascript" src='<?php echo base_url();?>assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js'></script>
            <script type="text/javascript" src='<?php echo base_url();?>assets/js/formValidation.min.js'></script>
            <script src="<?php echo base_url();?>assets/js/framework/bootstrap.min.js"></script>

            <script type="text/javascript">
           $(document).ready(function() {
               // You don't need to care about this function
               // It is for the specific demo
               function adjustIframeHeight() {
                   var $body   = $('body'),
                           $iframe = $body.data('iframe.fv');
                   if ($iframe) {
                       // Adjust the height of iframe
                       $iframe.height($body.height());
                   }
               }

               $('#installationForm')
                   .formValidation({
                       framework: 'bootstrap',
                       icon: {
                           valid: 'glyphicon glyphicon-ok',
                           invalid: 'glyphicon glyphicon-remove',
                           validating: 'glyphicon glyphicon-refresh'
                       },
                       // This option will not ignore invisible fields which belong to inactive panels
                       excluded: ':disabled',
                       fields: {
                           db_name: {
                               validators: {
                                   notEmpty: {
                                       message: 'The database name is required'
                                   }
                               }
                           },
                           db_uname: {
                               validators: {
                                   notEmpty: {
                                       message: 'The database user name is required'
                                   }
                               }
                           },
                           db_hname: {
                               validators: {
                                   notEmpty: {
                                       message: 'The host name is required'
                                   }
                               }
                           },
                           system_name: {
                               validators: {
                                   notEmpty: {
                                       message: 'The system name is required'
                                   }
                               }
                           },
                           email: {
                               validators: {
                                   notEmpty: {
                                       message: 'The admin email is required'
                                   },
                                   emailAddress: {
                                       message: 'The admin email is not valid'
                                   }
                               }
                           },
                            password: {
                                  validators: {
                                      notEmpty: {
                                          message: 'Login password is required'
                                      }
                                  }
                              },
                           from_text: {
                               validators: {
                                   notEmpty: {
                                       message: 'The Email from text name is required'
                                   }
                               }
                           },
                           from_email: {
                               validators: {
                                   notEmpty: {
                                       message: 'The from email is required'
                                   },
                                   emailAddress: {
                                       message: 'The from email is not valid email address'
                                   }
                               }
                           }
                       }
                   })
                   .bootstrapWizard({
                       tabClass: 'nav nav-pills nav-justified',
                       nextSelector: '.wizard .next',
                       previousSelector: '.wizard .prev',
                       onTabClick: function(tab, navigation, index) {
                        console.log('strong');
                           return validateTab(index);
                       },
                       onNext: function(tab, navigation, index) {
                        console.log('finish');
                        scrollTo('#wizard-2',-100);
                           var numTabs    = $('#installationForm').find('.tab-pane').length,
                               isValidTab = validateTab(index - 1);
                           if (!isValidTab) {
                               return false;
                           }
                           if(index === numTabs)
                           {
                                $('#installationForm').formValidation('defaultSubmit');
                           }
                           return true;


                       },
                       onPrevious: function(tab, navigation, index) {
                            scrollTo('#wizard-2',-100);
                           return validateTab(index + 1);
                       },
                       onTabShow: function(tab, navigation, index) {
                        console.log('strong finish');
                           $('#wizard-2 .finish').hide();
                           $('#wizard-2 .next').show();
                           if ($('#wizard-2 .nav li:last-child').hasClass('active')){
                               $('#wizard-2 .next').hide();
                               $('#wizard-2 .finish').show();

                           }
                           var $total = navigation.find('li').length;
                           var $current = index+1;
                           var $percent = ($current/$total) * 100;
                           $('#wizard-2').find('.progress-bar').css({width:$percent+'%'});

                       }

                   });

               function validateTab(index) {
                   var fv   = $('#installationForm').data('formValidation'), // FormValidation instance
                       // The current tab
                       $tab = $('#installationForm').find('.tab-pane').eq(index);

                   // Validate the container
                   fv.validateContainer($tab);

                   var isValidStep = fv.isValidContainer($tab);
                   if (isValidStep === false || isValidStep === null) {
                       // Do not jump to the target tab
                       return false;
                   }

                   return true;
               }

           });
           </script>
            </script>
            <!-- Specific Page Scripts END -->

            </body>

            </html>