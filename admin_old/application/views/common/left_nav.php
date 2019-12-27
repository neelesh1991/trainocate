<div class="vd_navbar vd_nav-width vd_navbar-tabs-menu vd_navbar-left leftNavColor">

  <div class="navbar-menu clearfix">

<!--     <h3 class="menu-title hide-nav-medium hide-nav-small"></h3> -->

    <div class="vd_menu themeColorhower">

      <ul>

        <li  <?php if($this->uri->segment(1)=='dashboard')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>dashboard">

            <span class="menu-icon"><i class="fa fa-dashboard"></i></span>

            <span class="menu-text">Dashboard</span>

          </a>

        </li>

        <li  <?php if($this->uri->segment(1)=='tenant')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>tenant">

            <span class="menu-icon"><i class="fa fa-home"></i></span>

            <span class="menu-text">Manage Tenant</span>

          </a>

        </li>

        <li  <?php if($this->uri->segment(1)=='users')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>users">

            <span class="menu-icon"><i class="glyphicon glyphicon-user"></i></span>

            <span class="menu-text">Manage Users</span>

          </a>

        </li>

        <li  <?php if($this->uri->segment(1)=='manage_groups')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>manage_groups">

            <span class="menu-icon"><i class="fa fa-group"> </i></span>

            <span class="menu-text">Manage Groups</span>

          </a>

        </li>

        <li  <?php if($this->uri->segment(1)=='quiz')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>quiz">

            <span class="menu-icon"><i class="fa fa-question"> </i></span>

            <span class="menu-text">Manage Question Bank</span>

          </a>

        </li>

        <li  <?php if($this->uri->segment(1)=='manage_quiz')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>manage_quiz">

            <span class="menu-icon"><span class="glyphicon glyphicon-question-sign"></span></span>

            <span class="menu-text">Manage Quiz Master</span>

          </a>

        </li>

        <li  <?php if($this->uri->segment(1)=='manage_quiz_section')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>manage_quiz_section">

            <span class="menu-icon"><i class="fa  fa-list-alt"> </i></span>

            <span class="menu-text">Manage Quiz Section</span>

          </a>

        </li>

        <li  <?php if($this->uri->segment(1)=='manage_exams')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>manage_exams">

            <span class="menu-icon"><span class="fa  fa-desktop"></span></span>

            <span class="menu-text">Manage Exams</span>

          </a>

        </li>

        <li  <?php if($this->uri->segment(1)=='manage_banner')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>manage_banner">

            <span class="menu-icon"><i class="fa fa-picture-o"> </i></span>

            <span class="menu-text">Manage Banner</span>

          </a>

        </li>



       <!--  <li  <?php if($this->uri->segment(1)=='contact_us')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>contact_us">

            <span class="menu-icon entypo-icon"><i class="fa fa-envelope-o"> </i></span>

            <span class="menu-text">Enquiry</span>

          </a>

        </li> -->

        <li  <?php if($this->uri->segment(1)=='email_template')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>email_template">

            <span class="menu-icon"><i class="fa fa-envelope"></i></span>

            <span class="menu-text">Manage Email Template</span>

          </a>

        </li>

      <!--   <li  <?php if($this->uri->segment(1)=='settings')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>settings">

            <span class="menu-icon"><i class=" fa fa-cogs"></i></span>

            <span class="menu-text">Settings</span>

          </a>

        </li> -->

        <li  <?php if($this->uri->segment(1)=='widgets')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>widgets">

            <span class="menu-icon"><i class=" fa fa-edit"></i></span>

            <span class="menu-text">Manage Widgets</span>

          </a>

        </li>

        <li  <?php if($this->uri->segment(1)=='cms_page')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>cms_page">

            <span class="menu-icon"><i class="fa fa-file-code-o"></i></span>

            <span class="menu-text">Manage Cms Pages</span>

          </a>

        </li>

         <li  <?php if($this->uri->segment(1)=='manage_user_completed_exams')

          {?> class="active" <?php } ?>>

          <a class="themeColorhower" href="<?php echo base_url();?>manage_user_completed_exams">

            <span class="menu-icon"><i class="fa fa-desktop"></i></span>

            <span class="menu-text">User Completed Exams</span>

          </a>

        </li>



      <!-- Head menu search form ends -->

      </ul>

     </div>

    </div>

    <div class="navbar-spacing clearfix"> </div>

    <div class="vd_menu vd_navbar-bottom-widget">

        <ul>

            <li>

                <a class="themeColorhower" href="<?php echo base_url();?>Logout">

            <span class="menu-icon"><i class="fa fa-sign-out"></i></span>

            <span class="menu-text">Logout</span>

          </a>



            </li>

        </ul>

    </div>

  </div>

  <div class="vd_content-wrapper" style="min-height: 750px;">

   <div class="vd_container" style="min-height: 750px;">

     <div class="vd_content clearfix">

       <div class="vd_head-section clearfix">

         <div class="vd_panel-header">

           <ul class="breadcrumb">

             <li><a href="<?php echo base_url();?>dashboard">Home</a> </li>

           <?php if($this->uri->segment(1)=='tenant')    {?>

             <li class="active">Tenant </li>

            <?php } if($this->uri->segment(1)=='users')  {  ?>

            <li class="active">Users </li>

            <?php } if($this->uri->segment(1)=='manage_groups')  {  ?>

            <li class="active">Manage Groups </li>

            <?php } if($this->uri->segment(1)=='membership')  {  ?>

            <li class="active">Manage Plan </li>

            <?php } if($this->uri->segment(1)=='payment_settings')  {  ?>

            <li class="active">Payment Settings </li>

            <?php } if($this->uri->segment(1)=='social_settings')  {  ?>

            <li class="active">Social Settings </li>

            <?php } if($this->uri->segment(1)=='purchase_plan')  {  ?>

            <li class="active">Membership </li>

            <?php } if($this->uri->segment(1)=='contact_us')  {  ?>

            <li class="active">Enquiry </li>

            <?php } if($this->uri->segment(1)=='email_template')  {  ?>

            <li class="active">Manage Email Template </li>

            <?php } if($this->uri->segment(1)=='settings')  {  ?>

            <li class="active">Settings </li>

            <?php } if($this->uri->segment(1)=='widgets')  {  ?>

            <li class="active">Manage Widgets </li>

            <?php } if($this->uri->segment(1)=='cms_page')  {  ?>

            <li class="active">Manage Cms Pages </li>

            <?php } if($this->uri->segment(1)=='manage_banner')  {  ?>

            <li class="active">Manage Banner </li>

            <?php } if($this->uri->segment(1)=='manage_groups')  {  ?>

            <li class="active">Manage Groups </li>

            <?php } if($this->uri->segment(1)=='quiz')  {  ?>

            <li class="active">Manage Question Bank </li>

            <?php } if($this->uri->segment(1)=='manage_quiz')  {  ?>

            <li class="active">Manage Quiz </li>

            <?php } if($this->uri->segment(1)=='manage_quiz_section')  {  ?>

            <li class="active">Manage Quiz Section </li>

            <?php } if($this->uri->segment(1)=='manage_exams')  {  ?>

            <li class="active">Manage Exams </li>

            <?php } ?>

            <?php  if($this->uri->segment(1)=='manage_user_completed_exams')  {  ?>

            <li class="active">Manage user completed exams </li>

            <?php } ?>

           </ul>

           <div class="vd_panel-menu hidden-sm hidden-xs" data-intro="<strong>Expand Control</strong><br/>To expand content page horizontally, vertically, or Both. If you just need one button just simply remove the other button code." data-step=5  data-position="left">

             <div data-action="remove-navbar" data-original-title="Remove Navigation Bar Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-navbar-button menu"><i class="fa fa-arrows-h"></i> </div>

             <div data-action="remove-header" data-original-title="Remove Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-header-button menu"> <i class="fa fa-arrows-v"></i> </div>

             <div data-action="fullscreen" data-original-title="Remove Navigation Bar and Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="fullscreen-button menu"> <i class="glyphicon glyphicon-fullscreen"></i> </div>

           </div>

         </div>

       </div>

       <?php if($this->session->flashdata('success'))

         {

         ?>

       <div class="vd_panel-header">

         <div class="alert alert-success alert-dismissable">

           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>



           <i class="fa fa-exclamation-circle append-icon"></i><strong>Well done!</strong> <a class="alert-link" href="javascript:void(0);"><?php echo $this->session->flashdata('success');?> </a>

         </div>

       </div>

       <?php

         }

         elseif($this->session->flashdata('error'))

         {

         ?>

       <div class="vd_panel-header">

         <div class="alert alert-danger alert-dismissable">

           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

           <i class="fa fa-exclamation-circle append-icon"></i><a class="alert-link" href="javascript:void(0);"><?php echo $this->session->flashdata('error');?></a>

         </div>

       </div>

       <?php } ?>

       <?php if($this->session->flashdata('csverror'))

         {

         ?>

       <div class="vd_panel-header">

         <div class="alert alert-danger alert-dismissable"  style="background-color: #fffbd0 ! important;">

           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

           <i class="fa fa-exclamation-circle append-icon"></i><a class="alert-link" href="javascript:void(0);"><?php echo $this->session->flashdata('csverror');?></a>

         </div>

       </div>

       <?php } ?>