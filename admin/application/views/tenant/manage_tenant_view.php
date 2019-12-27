<div class="content">

   <div class="container">

        <?php $this->load->view('common/left_nav');?>

        <div class="vd_content-section clearfix">

            <div class="row">

                <div class="col-md-12">

                    <div class="panel widget">

                        <div class="panel-heading vd_bg-grey">

                            <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-list"></i>  </span>Manage Tenant</h3>

                        </div>



                    <div class="panel-body table-responsive">

                        <?php if($this->session->userdata('admin_level')==1){?>

                        <button class="btn vd_bg-blue" data-target="#myModal" id="createNew" data-toggle="modal"><i class="fa  fa-plus"></i> Create New Tenant </button>

                        <?php } ?>



                     <!-- Modal -->

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">



                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header vd_bg-blue vd_white">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

                                    <h4 class="modal-title" id="myModalLabel">Create New Tenant</h4>

                                </div>



                                <div class="modal-body">

                                    <form action="<?php echo base_url();?>tenant/add" class="form-horizontal" id="manageTenant" method="POST" role="form"  enctype="multipart/form-data">



                                    <div class="form-group">

                                        <label class="col-sm-3 control-label">Tenant Name:</label>

                                        <div class="col-sm-9 controls">

                                            <input type="text" class="input-border-btm" id="name" name="name" placeholder="Enter Tenant Name">

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label class="col-sm-3 control-label">URL :</label>

                                        <div class="col-sm-9 controls">

                                            <div class="row">

                                                <div class="col-md-12">

                                                    <label> <?php echo front_base_url(); ?></label>

                                                    <input type="text" value="" name="url" id="url" placeholder="Please enter url.." class="input-border-btm" style="width: 182px;">

                                                </div>

                                            </div>

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label class="col-sm-3 control-label">Tenant Logo :</label>

                                        <div class="col-sm-4 controls">

                                            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>

                                            <input type="file" id="logo" name="logo" accept="image/*">

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label class="col-sm-3 control-label">Tenant Header Color:</label>

                                        <div class="col-sm-9 controls">

                                            <input type="text" class="jscolor" id="header_color" value="005D9B" name="header_color">

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label class="col-sm-3 control-label">Admin Name:</label>

                                        <div class="col-sm-9 controls">

                                           <input type="text" class="input-border-btm" id="admin_name" name="admin_name" placeholder="Enter Admin Name">

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label class="col-sm-3 control-label">Contact Number:</label>

                                        <div class="col-sm-9 controls">

                                            <input type="text" class="input-border-btm" id="contact" name="contact" placeholder="Enter Contact Number">

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label class="col-sm-3 control-label">Address</label>

                                        <div class="col-sm-9 controls">

                                            <input type="text" class="input-border-btm" id="address" name="address" placeholder="Enter address">

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label class="col-sm-3 control-label">Admin Email:</label>

                                        <div class="col-sm-9 controls">

                                            <input type="text" class="input-border-btm" id="email" name="email" placeholder="Enter Admin Email">

                                        </div>

                                    </div>



                                    <div class="form-group">

                                      <label class="col-sm-3 control-label">Manually Sign up</label>

                                      <div class="col-sm-9 controls">

                                        <input type="radio" name="signup_permission" value="1"> Yes &nbsp;&nbsp;&nbsp;

                                        <input checked="true" type="radio" name="signup_permission" value="0"> No<br>

                                      </div>

                                    </div>

                                    <div class="form-group">

                                      <label class="col-sm-3 control-label">Bind Domain</label>

                                      <div class="col-sm-9 controls">

                                        <input type="radio" name="bind_email" value="1"> Yes &nbsp;&nbsp;&nbsp;

                                        <input checked="true" type="radio" name="bind_email" value="0"> No<br>

                                      </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="col-sm-3 control-label">Domain Name:</label>

                                        <div class="col-sm-9 controls">

                                            <input type="text" class="input-border-btm" id="email_postfix" name="email_postfix" placeholder="Enter Domain Name (eg. trainocate.in)">

                                        </div>

                                    </div>

                                    <div class="form-group">

                                      <label class="col-sm-3 control-label">Bind Organization</label>

                                      <div class="col-sm-9 controls">

                                        <input type="radio" name="bind_organization" value="1"> Yes &nbsp;&nbsp;&nbsp;

                                        <input checked="true" type="radio" name="bind_organization" value="0"> No<br>

                                      </div>

                                    </div>



                                    <div class="form-group timezone">

                                        <label class="control-label col-sm-3">select Timezone</label>

                                        <div class="col-sm-9 controls">

                                             <select class="form-control timezone-options" id="time_zone" name="time_zone">

                                                <option value="">Select timezone</option>

                                                <?php

                                                // print_r($timezone1);die;

                                                if(!empty($timezone1)){

                                                foreach ($timezone1 as $val) {

                                                ?>

                                                <option value="<?php echo $val['timezone'];?>"><?php echo $val['name'];?></option>

                                                <?php

                                                }

                                                }

                                                ?>

                                             </select>

                                        </div>

                                    </div>





                                    <div class="modal-footer background-login">

                                        <button class="btn vd_btn vd_bg-grey" type="button" data-dismiss="modal">Close</button>

                                        <input type="submit" class="btn vd_btn vd_bg-green"  id="submitTenant" value="Submit">

                                    </div>

                                </form>

                                </div>

                            </div>

                            <!-- /.modal-content -->

                          </div>

                          <!-- /.modal-dialog -->

                        </div>



                      <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit" aria-hidden="true">



                        <div class="modal-dialog">



                          <div class="modal-content">



                            <div class="modal-header vd_bg-blue vd_white">



                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>



                              <h4 class="modal-title" id="myModalLabelEdit">Edit Tenant Info</h4>



                            </div>



                            <div class="modal-body">



                              <form action="<?php echo base_url();?>tenant/edit" class="form-horizontal" id="manageTenantEdit" method="POST" role="form"  enctype="multipart/form-data">



                                <div class="form-group">



                                  <label class="col-sm-3 control-label">Tenant Name:</label>



                                  <div class="col-sm-9 controls">



                                    <input type="text" class="input-border-btm" id="name" name="name" placeholder="Enter Tenant Name">



                                  </div>



                                </div>



                                <div class="form-group">



                                   <label class="col-sm-3 control-label">URL :</label>



                                   <div class="col-sm-9 controls">



                                     <div class="row">



                                       <div class="col-md-6">



                                       <label> <?php echo front_base_url(); ?></label>



                                         <span class="help-block">Base URL</span>



                                       </div>



                                       <div class="col-md-6">



                                         <input type="text" value="" name="url" id="url" placeholder="Please enter url.." class="input-border-btm">



                                         <span class="help-block text-center">Enter URL</span>



                                       </div>



                                     </div>



                                   </div>



                                </div>







                                <div class="form-group">







                                  <label class="col-sm-3 control-label">Tenant Logo :</label>







                                  <div class="col-sm-4 controls">







                                    <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>



                                    <input type="file" id="logoEdit" name="logo" accept="image/*">



                                    <input type="hidden" id="id" name="id">







                                  </div>







                                </div>



                                <div class="form-group">



                                  <label class="col-sm-3 control-label">Tenant Header Color:</label>



                                  <div class="col-sm-9 controls">



                                    <input type="text" class="jscolor" id="header_color" name="header_color">



                                  </div>



                                </div>



                                <div class="form-group">



                                  <label class="col-sm-3 control-label">Address</label>



                                  <div class="col-sm-9 controls">



                                    <input type="text" class="input-border-btm" id="address" name="address" placeholder="Enter address">



                                  </div>



                                </div>



                                <div class="form-group">

                                  <label class="col-sm-3 control-label">Manually Sign up</label>

                                  <div class="col-sm-9 controls">

                                    <input type="radio" name="signup_permission" value="1"> Yes &nbsp;&nbsp;&nbsp;

                                    <input checked="true" type="radio" name="signup_permission" value="0"> No<br>

                                  </div>

                                </div>

                                <div class="form-group">

                                  <label class="col-sm-3 control-label">Bind Domain</label>

                                  <div class="col-sm-9 controls">

                                    <input type="radio" name="bind_email" value="1"> Yes &nbsp;&nbsp;&nbsp;

                                    <input checked="true" type="radio" name="bind_email" value="0"> No<br>

                                  </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-3 control-label">Domain Name:</label>

                                    <div class="col-sm-9 controls">

                                        <input type="text" class="input-border-btm" id="email_postfix" name="email_postfix" placeholder="Enter Domain Name (eg. trainocate.in)">

                                    </div>

                                </div>

                                <div class="form-group">

                                  <label class="col-sm-3 control-label">Bind Organization</label>

                                  <div class="col-sm-9 controls">

                                    <input type="radio" name="bind_organization" value="1"> Yes &nbsp;&nbsp;&nbsp;

                                    <input checked="true" type="radio" name="bind_organization" value="0"> No<br>

                                  </div>

                                </div>



                                 <div class="form-group">



                                  <label class="col-sm-3 control-label">Homepage Box1</label>



                                  <div class="col-sm-9 controls">



                                    <b>Name:</b><input type="text" class="input-border-btm " id="home_box1_name" name="home_box1_name" placeholder="Enter Name of box"  value="">

                                    <b>URL:</b><input type="text" class="input-border-btm " id="home_box1_url" name="home_box1_url" placeholder="Enter URL link to box with http" value="">

                                    <b>Color:</b>

                                    <input type="text"  class="input-border-btm jscolor" id="home_box1_color" name="home_box1_color" placeholder="Background color code">



                                    <p style="font-style: italic;margin-top: 10px;"> If it's signup URL, Please mention <b>signup_profile-modal</b> in URL field. In case login URL, mention <b>login-modal</b> in URL field otherwise mention full URL with http</p>





                                  </div>



                                </div>



                                <div class="form-group">



                                  <label class="col-sm-3 control-label">Homepage Box2</label>



                                  <div class="col-sm-9 controls">



                                    <b>Name:</b><input type="text" class="input-border-btm " id="home_box2_name" name="home_box2_name" placeholder="Enter Name of box">

                                    <b>URL:</b><input type="text" class="input-border-btm " id="home_box2_url" name="home_box2_url" placeholder="Enter URL link to box with http">

                                   <b>Color:</b> <input type="text" class="input-border-btm jscolor" id="home_box2_color" name="home_box2_color" placeholder="Background color code">

                                    <p style="font-style: italic;margin-top: 10px;"> If it's signup URL, Please mention <b>signup_profile-modal</b> in URL field. In case login URL, mention <b>login-modal</b> in URL field otherwise mention full URL with http</p>





                                  </div>



                                </div>

                <div class="form-group">



                                  <label class="col-sm-3 control-label">Homepage Box3</label>



                                  <div class="col-sm-9 controls">



                                   <b>Name:</b> <input type="text" class="input-border-btm " id="home_box3_name" name="home_box3_name" placeholder="Enter Name of box">

                                   <b>URL:</b> <input type="text" class="input-border-btm " id="home_box3_url" name="home_box3_url" placeholder="Enter URL link to box with http">

                                   <b>Color:</b> <input type="text" class="input-border-btm jscolor" id="home_box3_color" name="home_box3_color" placeholder="Background color code">

<p style="font-style: italic;margin-top: 10px;"> If it's signup URL, Please mention <b>signup_profile-modal</b> in URL field. In case login URL, mention <b>login-modal</b> in URL field otherwise mention full URL with http</p>



                                  </div>



                                </div>









                                <div class="form-group" style="display: none;">



                                  <label class="col-sm-3 control-label">select Timezone:</label>



                                     <div class="col-sm-9 controls">

                               <select class="form-control" id="time_zone" name="time_zone">

                                 <option value="">Select timezone</option>

                                 <?php

                                 //print_r($timezone);die;

                                  /*if(!empty($timezone1)){

                                foreach ($timezone1 as $val) {

                                 ?>

                                 <option value="<?php echo $val['timezone'];?>"><?php echo $val['name'];?></option>



                                 <?php

                                 }

                                 }*/

                                 ?>

                               </select>

                              </div>

                              </div>







                                <div class="modal-footer background-login">



                                  <input type="submit" class="btn vd_btn vd_bg-green"  id="submitTenantEdit" value="Submit">



                                </div>







                              </form>







                            </div>



                          </div>







                          <!-- /.modal-content -->







                        </div>







                        <!-- /.modal-dialog -->







                      </div>



                      <!-- /.modal -->



                      <form action="<?php echo base_url();?>tenant/multiselect_action" method="post" name="myform" id="myform">



                        <table class="table table-striped" id="data-tables">



                          <thead>



                            <tr>



                              <th></th>



                              <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>







                              <th>Tenant</th>



                              <th>URL</th>



                              <th>Status</th>



                              <th>Created</th>



                              <th>Action</th>







                            </tr>







                          </thead>







                        </table>







                        <div class="row">







                          <div class="col-md-12">







                            <div class="col-md-3" style="float: left;padding-left: 0px">







                              <select name="listaction" id="listaction" class="allselect form-control input-sm" style="float: left;" >







                                <option value="">







                                  Select Action







                                </option>







                                <option value="1">







                                  Activate







                                </option>







                                <option value="2">







                                  Deactivate







                                </option>







                                <option value="3">







                                  Delete







                                </option>







                              </select>







                            </div>







                            <div class="col-md-2" style="float: left;padding-left: 0px">







                              <input type="submit" name="submit" value="Go" onclick="return validateForm();" class="btn btn-xs vd_bg-blue" style="float: left;">







                            </div>







                            <div class="col-md-6">







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







              <!-- row -->







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







  <!-- .content