<!DOCTYPE html>
<html lang="en">
    <head>
    <?php $CI=& get_instance();
    if($this->session->userdata('tenant_id')!='')
    {
        $tenant_id=$this->session->userdata('tenant_id');
    }else{
        $tenant_id=$this->modelbasic->getValue('tenant','id',array('url'=>$this->uri->segment(1)));
        //echo $tenant_id;die;
        if($tenant_id == '')
        {
            $tenant_id=1;
        }
    }
    $timezone1=$CI->userprofile_model->fetch_timezone_data();
    $tenant_info=$CI->userprofile_model->get_tenant_info($tenant_id);
    $admin_info=$CI->userprofile_model->get_admin_info($tenant_id);
    $group_info=$CI->userprofile_model->get_group_info($tenant_id);
    $user_level=$CI->userprofile_model->fetch_user_level_data();

    // echo "<pre/>"; print_r($tenant_info); die;
    ?>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $tenant_info['name'];?></title>
              <!-- Favicon -->
              <link rel="shortcut icon" href="<?php echo base_url();?>uploads/<?php echo $tenant_info['id'];?>/logo/<?php echo $tenant_info['logo'];?>" type="image/x-icon">
            <link rel="icon" href="<?php echo base_url();?>uploads/<?php echo $tenant_info['id'];?>/logo/<?php echo $tenant_info['logo'];?>" type="image/x-icon">
        <!-- StyleSheets -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/color.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/transition.css">
        <!-- FontsOnline -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
        <!-- JavaScripts -->
          <script src="<?php echo base_url();?>assets/js/vendor/jquery.js"></script>
        <script src="<?php echo base_url();?>assets/js/vendor/modernizr.js"></script>
        <link href="<?php echo base_url();?>assets/css/formValidation.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            var base_url='<?php echo base_url();?>';
        </script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>
          .themeColor{
            background: #<?php echo $tenant_info['header_color'];?> !important;
            }
            .nav-list > ul > li > a::before, .nav-list > ul > li.active > a::before, .btn.blank:hover, .our-courses, .social-icons li a:hover, .filter-tags-holder ul li a.selected, .owl-nav .owl-prev:hover, .owl-nav .owl-next:hover, .categories-list > li h5, .pagination-holder .pagination li a:hover, .pricing-slider .ui-slider-handle, .nav-list ul li > ul, .aside-tags-list li a:hover, .p-detail blockquote,.fadeInRight{
            border-color: #<?php echo $tenant_info['header_color'];?> !important;
             }

             .nav-list > ul > li > a:hover,.nav-list > ul > li > a:active{
                color:#<?php echo $tenant_info['header_color'];?> !important;
             }

        </style>
    </head>
    <body>
        <!-- Wrapper -->
        <div class="wrapper push-wrapper">
            <!-- Header -->
            <header>
                <!-- Top Bar -->
                <div class="top-bar themeColor">
                    <div class="container ">
                        <!-- Address List -->
                        <div class="address-list-top">
                            <ul>
                               <!--<li><i class="fa fa-phone"></i><?php //echo $admin_info['contact'];?></li>-->
                                <li><i class="fa fa-envelope"></i><?php echo $admin_info['email'];?></li>
                               <!--<li><i class="fa fa-phone">  9223361686</i></li>
                                <li><i class="fa fa-envelope">  india@trainocate.com</i></li>-->
                            </ul>
                        </div>
                        <!-- Address List -->
                        <!-- Login -->



                            <?php if($this->session->userdata('user_id')==''){
                                if($tenant_info['signup_permission']==1){ ?>
                                 <a class="ls-btn bt" data-toggle="modal" data-target="#signup_profile-modal" href="javascript:void(0);" style="float: right;color:rgba(255, 255, 255, 0.6)">Sign up</a><?php } ?> <a class="lg-btn bt" data-toggle="modal" data-target=".login-modal" href="javascript:void(0);" style="float: right;color:rgba(255, 255, 255, 0.6)">Login</a>

                                <?php }
                                else{
                                    $userinfo=$CI->userprofile_model->get_user_info($this->session->userdata('user_id'));?>
                                <li class="login-option dropdown" style="list-style: none">

                                   <a href="<?php echo base_url();?>registration/user_profile_display" class="dropdown-toggle" data-toggle="dropdown">
                                   <div class="user-img">
                                   <?php if($userinfo['photo']!=''){?>
                                    <img class="img-circle" src="<?php echo base_url();?>uploads/<?php echo $userinfo['tenant_id']?>/users_photo/<?php echo $userinfo['id']?>/thumbs/<?php echo $userinfo['photo']?>" alt="">
                                    <?php }else{?>
                                        <img class="img-circle" src="<?php echo base_url();?>assets/images/no-image.jpg" alt="">
                                      <?php  }?>
                                    <span><?php if($userinfo['name']!=''){echo $userinfo['name']; }?></span><b class="caret"></b>
                                  </div>

                                   </a>
                                <ul class="dropdown-menu">


                                <li>
                                <a href="<?php echo base_url();?>registration/user_profile_display">Profile</a>
                                </li>
                                <li>
                              <a href="<?php echo base_url();?>registration/reset_pwd_view/<?php echo $this->session->userdata('user_id');?>">Change Password</a>
                              </li>
                              <li>
                               <a href="<?php echo base_url();?>home/logout">Logout<i class="fa fa-sign-out"></i></a>
                              </li>


                            </ul>

                        </li>

                        <?php }?>

                    </div>
                </div>
                <!-- Top Bar -->
                <!-- Nav -->

                <div class="nav-holder z-depth-1">
                    <div class="container">
                        <!-- Logo -->

                        <div class="logo" style="text-align: center; vertical-align: middle; max-height: 100px;">
                            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/big_thumbs/<?php echo $tenant_info['logo'];?>" alt=""></a>
                        </div>
                        <!-- Logo -->
                        <!-- Search Nd Cart -->
                        <div class="search-nd-cart">
                            <ul>
                             <!--    <li class="cart"><a class="fa fa-shopping-cart" href="#"><i class="add-cart-no">3</i></a></li> -->
                                <!-- <li class="link search"><a class="fa fa-search" href="#"></a></li> -->
                            </ul>
                        </div>
                        <!-- Search Nd Cart -->
                        <!-- Search Popup -->
                        <div id="searching">
                            <div id="searchThis">
                                <input type="text" placeholder="Search"/>
                                <div id="closeSearch">X</div>
                            </div>
                            <div id="searchResults"></div>
                        </div>
                        <!-- Search Popup -->
                        <!-- Navigation -->
                        <!-- <div class="nav-list">
                            <ul>
                                <li class="active">
                                    <a href="<?php echo base_url();?>">Home</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>home/about">About Us</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>">Quiz</a>
                                </li>
                                <li><a href="<?php echo base_url();?>home/contact">Contact</a></li>
                                <?php if($this->session->userdata('user_id')!=''){?>
                                <li></li>
                                <?php }?>

                            </ul>
                        </div> -->
                        <!-- Navigation -->
                        <!-- Responsive Button -->
                        <!-- <div class="responsive-btn">
                            <a href="#menu" class="menu-link circle-btn themeColor"><i class="fa fa-bars"></i></a>
                        </div> -->
                        <!-- Responsive Button -->
                    </div>
                </div>
                <!-- Nav -->

                        <div class="login-form2 text-center" >
                          <div class="modal fade" id="signup_profile-modal"  >


                              <div class="modal-content position-center-center tc-hover" style="padding: 20px 30px 30px; width: 48%;">
                              <button type="button" id='signup_profile_close' class="close" data-dismiss="modal"  style="position: relative; margin-top: -20px; margin-right: -23px;">&times;</button>
                              <img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/big_thumbs/<?php echo $tenant_info['logo'];?>" alt="">

                              <h4>:::Sign Up:::</h4>

                              <div><span id="errormsg" style="color:rgb(169,68,66);"></span></div><br>
                              <form class="signup_profile" id="signup_profile" role="form" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="name" id="name" type="text"/>
                                                <label class="control-label">Name</label><i class="bar"></i>
                                            </div>
                                        </div>
                                          <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="email" id="email" type="text" />
                                            <label class="control-label">Email id</label><i class="bar"></i>
                                        </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                       <div class="col-md-6">
                                        <div class="form-group">
                                        <input name="password" id="password" type="password"/>
                                        <label class="control-label">Password</label><i class="bar"></i>
                                    </div>
                                    </div>
                                        <div class="col-md-6">
                                      <div class="form-group">
                                      <input name="conf_password" id="conf_password" type="password"/>
                                      <label class="control-label">Confirm Password</label><i class="bar"></i>
                                  </div>
                                  </div>

                                  </div>
                                  
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <?php if($tenant_info['bind_organization'] == '1'){ ?>
                                            <input name="organization" id="organization" type="text" value="<?php echo $tenant_info['name'];?>" readonly />
                                          <?php }else{?>
                                            <input name="organization" id="organization" type="text" value="" />
                                          <?php } ?>
                                            <label class="control-label">Organization</label><i class="bar"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <input name="city" id="city" type="text"/>
                                          <label class="control-label">City</label><i class="bar"></i>
                                      </div>
                                    </div>

                                   <!--  <div class="col-md-6">
                                  <div class="form-group">
                                      <input name="academic_year" id="academic_year" type="text"/>
                                      <label class="control-label">Academic year</label><i class="bar"></i>
                                  </div>
                                  </div> -->
                                  </div>

                                  <div class="row">
                                    <div class="col-md-12">
                                  <div class="form-group">
                                      <input name="contact_no" id="contact_no" type="text"/>
                                      <label class="control-label">Contact number</label><i class="bar"></i>
                                  </div>
                                  </div>

                                    <div class="col-md-6"  style="display: none;">
                                  <div class="form-group">
                                      <input name="academic_year" id="academic_year" type="text"/>
                                      <label class="control-label">Academic year</label><i class="bar"></i>
                                  </div>
                                  </div>
                                  </div>
                                  <div class="row" style="display: none;">
                                    <div class="col-md-6">
                                  <div class="form-group timezone">


                                       <select class="form-control timezone-options" id="group" name="group">
                                         <option value="">Select Group</option>
                                         <?php
                                         //print_r($timezone);die;
                                         if(!empty($group_info)){
                                         foreach ($group_info as $val) {

                                         ?>
                                         <option value="<?php echo $val['id'];?>"><?php echo $val['group_name'];?></option>


                                         <?php
                                         }
                                         }
                                         ?>
                                       </select>
                                       <label class="control-label">Select Group</label>

                                  </div>
                                  </div>

                                    <div class="col-md-6">
                                  <div class="form-group timezone">


                                       <select class="form-control timezone-options" id="user_level" name="user_level">
                                         <option value="">Select Level</option>
                                         <?php /*
                                         //print_r($timezone);die;
                                         if(!empty($user_level)){
                                         foreach ($user_level as $val) {
                                         ?>
                                         <option value="<?php echo $val['id'];?>"><?php echo $val['user_level_name'];?></option>

                                         <?php
                                         }
                                         } */

                                         ?>
                                        <option class="aws_cloud_pract op init" value="1">Foundational</option>
                                        <option class="aws_cloud_arch aca init" value="2">Associate</option>
                                        <option class="aws_cloud_arch aca init" value="3">Professional</option>

                                       </select>
                                       <label class="control-label">Select Level</label>

                                  </div>
                                  </div>
                                  </div>



                                  <div class="row" style="display: none;">

                                    <div class="col-md-6">
                                  <div class="form-group timezone">


                                       <select class="form-control timezone-options" id="time_zone" name="time_zone">
                                         <option value="">Select timezone</option>
                                         <?php
                                         //print_r($timezone);die;
                                         if(!empty($timezone1)){
                                         foreach ($timezone1 as $val) {
                                         ?>
                                         <option value="<?php echo $val['timezone'];?>"><?php echo $val['name'];?></option>

                                         <!-- <option value="<?php echo $val['timezone'];?>"> -->
                                         <?php
                                         }
                                         }
                                         ?>
                                       </select>
                                       <label class="control-label">Select Timezone</label>

                                  </div>
                                  </div>
                                  </div>



                                  <div class="text-center btn-list">
                                   <button type="submit" class="btn blue sm full-width" id="signup_profile_submit">Submit</button>
                                  </div>

                              </form>
                              </div>
                          </div>
                        </div>

