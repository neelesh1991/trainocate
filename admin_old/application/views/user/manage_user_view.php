<!-- Header Ends -->
<div class="content">
  <div class="container">
  <?php $this->load->view('common/left_nav');?>
              <div class="vd_content-section clearfix">
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel widget">
                      <div class="panel-heading vd_bg-grey">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-list"></i>  </span><!--  Data Tables Example --> Manage Users</h3>
                      </div>
                      <div class="panel-body table-responsive">
                      <button class="btn  vd_bg-blue" data-target="#addUser" data-toggle="modal" id="addU"><i class="fa  fa-plus"></i> Add Users </button>
                      <button class="btn  btn-success" data-target="#csvUser" data-toggle="modal"> <i class="fa  fa-file-text-o"></i> Add Users By CSV </button>
                      <a href="<?php echo base_url();?>users/user_export_to_csv"><button class="btn  btn-warning" > <i class="fa  fa-file-text-o"></i> Export Users </button></a>
                      <!-- Modal -->

                      <div class="modal fade" id="csvUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header vd_bg-blue vd_white">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                              <h4 class="modal-title" id="myModalLabel">Add Users By CSV</h4>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo base_url();?>users/add_csv" class="form-horizontal" method="POST" role="form" id="addUserCsv" enctype="multipart/form-data">

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Add CSV :</label>
                                  <div class="col-sm-8 controls">
                                    <input type="file" name="csvfile">
                                  </div>
                                </div>
                                <div class="form-group">
                                          <div class="col-sm-offset-4 col-sm-8">
                                          Download sample csv file<a href="<?php echo front_base_url();?>sampleFiles/users/users_sample.csv" > <i class="fa fa-download"></i></a>
                                          </div>
                                   </div>
                                <div class="modal-footer background-login">
                                  <button type="button" class="btn vd_btn vd_bg-grey" data-dismiss="modal">Close</button>
                                  <input type="submit" class="btn vd_btn vd_bg-green"  id="submitCsvUser" value="Submit">
                                </div>
                              </form>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>


                      <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header vd_bg-blue vd_white">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                              <h4 class="modal-title" id="myModalLabel">Add/Edit User</h4>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo base_url();?>users/add" class="form-horizontal" id="AddUser" method="POST" role="form"  enctype="multipart/form-data">

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Name(<span class="vd_red">*</span>
                ):</label>
                                  <div class="col-sm-7 controls">
                                    <input type="text" class="input-border-btm" id="name" name="name" placeholder="Enter Name">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Email Id(<span class="vd_red">*</span>):</label>
                                  <div class="col-sm-7 controls">
                                    <input type="text" class="input-border-btm" id="email_id" name="email_id" placeholder="Enter Name">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Address :</label>
                                  <div class="col-sm-7 controls">
                                  <textarea class="form-control" name ="address" placeholder="Address" id="address"></textarea>
                                  <input type="hidden" id="id" name="id">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Age :</label>
                                  <div class="col-sm-7 controls">
                                  <input type="text" class="input-border-btm" id="age" name="age" placeholder="Enter Age">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Profile Picture :</label>
                                  <div class="col-sm-7 controls">
                                    <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
                                    <input type="file" id="photo" name="photo" accept="image/*">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Institute Name :</label>
                                  <div class="col-sm-7 controls">
                                    <input type="text" class="input-border-btm" id="institute_name" name="institute_name" placeholder="Enter Institute Name">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Academic Year :</label>
                                  <div class="col-sm-7 controls">
                                    <input type="text" class="input-border-btm datepicker" id="academic_year" name="academic_year" placeholder="Enter Academic Year">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Principal Name :</label>
                                  <div class="col-sm-7 controls">
                                    <input type="text" class="input-border-btm datepicker" id="principal_name" name="principal_name" placeholder="Enter Principal Name">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Select Group Name :</label>
                                  <div class="col-sm-7 controls">
                                    <select name="group_id" id="group_id">
                                      <option value="">Select Group</option>
                                      <?php
                                      if(!empty($group)){
                                        foreach($group as $value)
                                      {
                                      ?>
                                      <option value="<?php echo $value['id'];?>"><?php echo $value['group_name'];?></option>
                                      <?php }
                                      }?>
                                    </select>
                                  </div>
                                </div>

                                <div class="modal-footer background-login">
                                  <button type="button" class="btn vd_btn vd_bg-grey" data-dismiss="modal">Close</button>
                                  <input type="submit" class="btn vd_btn vd_bg-green"  id="submitUser" value="Submit">
                                </div>
                              </form>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>

                       <div class="modal fade" id="myAlbumModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-dialog" style="width: 72%">
                           <div class="modal-content">
                             <div class="modal-header vd_bg-blue vd_white">
                               <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                               <h4 class="modal-title" id="myModalLabel"></h4>
                             </div>
                             <div class="modal-body">
                                <div class="row">
                        <div class="col-md-12">
                          <div class="panel widget light-widget panel-bd-top">
                            <div class="panel-body" style="max-height: 400px;overflow-y: scroll;">
                            </div>
                          </div>
                         </div>
                      </div>
                   </div>
                           </div>
                         </div>
                       </div>
                      <form action="<?php echo base_url();?>users/multiselect_action" method="post" name="myform" id="myform">
                        <table class="table table-striped" id="data-tables">
                          <thead>
                            <tr>
                              <th></th>
                              <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>
                              <th>User</th>
                              <th>Address</th>
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
                              <input type="submit" name="submit" value="Go" onclick="return validateForm();" class="btn vd_btn btn-xs vd_bg-blue" style="float: left;">
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
<!-- .content -->