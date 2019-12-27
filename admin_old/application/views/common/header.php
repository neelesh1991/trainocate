<header class="header-1" id="header">

  <div class="vd_top-menu-wrapper themeColor" >



    <div class="container ">



      <div class="vd_top-nav vd_nav-width  ">



        <div class="vd_panel-header">



          <div class="logo">



            <?php



            $ci= &get_instance();



            $ci->load->model('test_model');



            $result =$ci->test_model->get_all_settings();



            $id=$this->session->userdata('admin_id');



            $res = array('id'=>$id );



            $data=$ci->test_model->getAdminData($res);

           // $data=$ci->modelbasic->getAllWhere('tenant','*',$res);



            //pr($data);



            $id=$this->session->userdata('tenant_id');

            //$res = array('id!='=>'1');

            $datatenant=$ci->modelbasic->getAllWhere('tenant','*');

            $notificationData=array();

            $logo=$ci->modelbasic->getValue('tenant','logo',array('id'=>$id));

            if($result[4]['description']!='')



            {



            ?>



            <a href="<?php echo base_url();?>"><img alt="logo" src="<?php echo front_base_url();?>quiz/uploads/<?php echo $id;?>/logo/thumbs/<?php echo $logo;?>" height="40"></a>



            <?php



            }



            else



            {



            ?>



     <a href="<?php echo base_url();?>"><img alt="logo"src="<?php echo front_base_url();?>quiz/uploads/settings/default_logo.png"></a>



            <?php



            }



            ?>



          </div>



          <!-- logo -->



          <div class="vd_panel-menu  hidden-sm hidden-xs" data-intro="<strong>Minimize Left Navigation</strong><br/>Toggle navigation size to medium or small size. You can set both button or one button only. See full option at documentation." data-step=1>



            <span class="nav-medium-button menu themeColorhower" data-toggle="tooltip" data-placement="bottom" data-original-title="Medium Nav Toggle" data-action="nav-left-medium">



              <i class="fa fa-bars"></i>



            </span>



            <span class="nav-small-button menu themeColorhower" data-toggle="tooltip" data-placement="bottom" data-original-title="Small Nav Toggle" data-action="nav-left-small">



              <i class="fa fa-ellipsis-v"></i>



            </span>



          </div>



          <div class="vd_panel-menu left-pos visible-sm visible-xs">



            <span class="menu" data-action="toggle-navbar-left">



              <i class="fa fa-ellipsis-v"></i>



            </span>



          </div>



          <div class="vd_panel-menu visible-sm visible-xs">

            <span class="menu visible-xs" data-action="submenu">

              <i class="fa fa-bars"></i>

            </span>

          </div>



        </div>



      </div>



      <div class="vd_container">



        <div class="row">



          <div class="col-sm-4 col-xs-offset-3 col-xs-12">

          <?php if($this->session->userdata('admin_level')=='1')

          {

            ?>

          <div class="vd_mega-menu-wrapper">

           <div class="form-group">

             <!--<label class="col-sm-6 control-label">Select Tenant(Admin) :</label>-->

             <div class="col-sm-10 controls">

               <select name="tenant_id" id="Set_tenant_id" onchange="Set_tenantId(this)">

                 <option value="">Select Tenant(Admin)</option>

                 <?php

                 if(!empty($datatenant)){

                   foreach($datatenant as $value)

                 {

                 ?>

                 <option value="<?php echo $value['id'];?>"

                 <?php

                 if($this->session->userdata('tenant_id')==$value['id'])

                  { ?> selected <?php }?>><?php echo $value['name'];?></option>

                 <?php }

                 }?>

               </select>

             </div>



           </div>

           </div>



           <?php  }  ?>





          </div>



          <div class="col-sm-5 col-xs-12">



            <div class="vd_mega-menu-wrapper">



              <div class="vd_mega-menu pull-right">



                <ul class="mega-ul">







                <li id="top-menu-profile" class="profile mega-li">

                  <a href="javascript:void(0);" class="mega-link"  data-action="click-trigger">

                    <span  class="mega-image">

                    <?php

                    if($data['0']['picture']!='')

                    {

                      $filename="../uploads/".$data['0']['tenant_id']."/adminprofile/".$data['0']['picture'];

                      if (file_exists($filename)){

                        ?>

                      <img src="<?php echo front_base_url();?>uploads/<?php echo $data['0']['tenant_id']?>/adminprofile/thumbs/<?php echo $data['0']['picture'];?>" height="40">

                      <?php }  else  {  ?>

                       <img style="width:100px;" id="blah" src="<?php echo front_base_url();?>assets/img/notavilable.jpg" alt="Not available">

                        <?php  }  }  else  { ?>

                          <img style="width:100px;" id="blah" src="<?php echo front_base_url();?>admin/assets/img/u.png" alt="No image">

                        <?php  }   ?>

                    </span>

                    <span class="mega-name" style="color:#000;">

                      <?php echo $data['0']['name'];?><i class="fa fa-caret-down fa-fw"></i>

                    </span>

                  </a>

                  <div class="vd_mega-menu-content  width-xs-2  left-xs left-sm" data-action="click-target" style="top: 50px;">

                    <div class="child-menu">

                      <div class="content-list content-menu">

                        <ul class="list-wrapper pd-lr-10">

                          <li id="editProf"> <a href="javascript:void(0);" data-target="#editModal" data-toggle="modal"> <div class="menu-icon"><i class=" fa fa-user"></i></div> <div class="menu-text">Edit Profile</div> </a> </li>



                           <li id="changePass"> <a href="javascript:void(0);" data-target="#changePassword" data-toggle="modal"> <div class="menu-icon"><i class=" fa fa-user"></i></div><div class="menu-text">Change Password</div> </a> </li>

                          <li class="line"></li>

                          <!-- <li> <a href="<?php echo base_url();?>settings"> <div class="menu-icon"><i class=" fa fa-cogs"></i></div> <div class="menu-text">Settings</div> </a> </li> -->

                          <li> <a href="<?php echo base_url();?>logout"> <div class="menu-icon"><i class=" fa fa-sign-out"></i></div>  <div class="menu-text">Sign Out</div> </a> </li>



                        </ul>

                      </div>

                    </div>

                  </div>

                </li>

              </ul>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

</header>

<!-- Modal -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-dialog">

  <div class="modal-content">

    <div class="modal-header vd_bg-blue vd_white">

      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

      <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>

    </div>

    <div class="modal-body">

      <form action="<?php echo base_url();?>tenant/editAdminProfile" class="form-horizontal" id="editAdminModel" method="POST" role="form"  enctype="multipart/form-data">





          <div class="form-group">

            <label class="col-sm-4 control-label">Admin Name:</label>

            <div class="col-sm-7 controls">

              <input type="text" class="input-border-btm" id="name" name="name" placeholder="Enter Admin Name" value="<?php echo $data['0']['name'];?>">

            </div>

          </div>
           <div class="form-group">

            <label class="col-sm-4 control-label">Admin Contact number:</label>

            <div class="col-sm-7 controls">

              <input type="text" class="input-border-btm" id="contact" name="contact" placeholder="Enter Admin contact" value="<?php echo $data['0']['contact'];?>">

            </div>

          </div>

        <div class="form-group">

          <label class="col-sm-4 control-label">Admin Email:</label>

          <div class="col-sm-7 controls">

            <input type="text" class="input-border-btm" id="email" name="email" placeholder="Enter Name" value="<?php echo $data['0']['email'];?>">

            <input type="hidden" id="idOne" name="id" value="<?php echo $data['0']['id'];?>">

            <input type="hidden" id="idOnetenant" name="tenant_id" value="<?php echo $data['0']['tenant_id'];?>">

          </div>

        </div>

      <div class="form-group">

          <label class="col-sm-4 control-label">Attach Photo :</label>

          <div class="col-sm-7 controls">

            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none">

            </div>

            <input type="file" id="photo1" name="picture" accept="image/*">

            <?php

            if(!empty($data['0']['picture']))

            {

            ?>

            <input type="hidden" value="<?php echo file_upload_absolute_path();?><?php echo $data['0']['tenant_id'];?>/adminprofile/<?php echo $data['0']['picture'];?>" id="getImg">

            <?php

            }

            else

            {

            ?>

            <input type="hidden" value="<?php echo front_base_url();?>uploads/default_logo.png" id="getImg">

            <?php

            }

            ?>

          </div>

        </div>

        <div class="modal-footer background-login">

          <input type="submit" class="btn vd_btn vd_bg-green"  id="submitAdmin" value="Submit">

        </div>

      </form>

    </div>

  </div>

</div>

</div>



<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-dialog">

  <div class="modal-content">

    <div class="modal-header vd_bg-blue vd_white">

      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

      <h4 class="modal-title" id="myModalLabel">Change Password</h4>

    </div>

    <div class="modal-body">

      <form action="<?php echo base_url();?>tenant/changeAdminPassword" class="form-horizontal" id="changeAdminPassword" method="POST" role="form"  enctype="multipart/form-data">



          <div class="form-group">

            <label class="col-sm-4 control-label">Old Password:</label>

            <div class="col-sm-7 controls">

              <input type="password" class="input-border-btm" id="Admin_old_password" name="Admin_old_password" placeholder="Enter Admin Old Password" value="">

              <input type="hidden" id="idOne" name="id" value="<?php echo $data['0']['id'];?>">

              <input type="hidden" id="idOnetenant" name="tenant_id" value="<?php echo $data['0']['tenant_id'];?>">

            </div>

          </div>



          <div class="form-group">

            <label class="col-sm-4 control-label">New Password:</label>

            <div class="col-sm-7 controls">

              <input type="password" class="input-border-btm" id="Admin_new_password" name="Admin_new_password" placeholder="Enter Admin New Password" value="">

            </div>

          </div>





        <div class="modal-footer background-login">

          <input type="submit" class="btn vd_btn vd_bg-green"  id="submitAdminpass" value="Submit">

        </div>

      </form>

    </div>

  </div>

</div>

</div>


