<!-- Header Ends -->
<div class="content">
  <div class="container">
    <?php $this->load->view('common/left_nav');?>

            <div class="vd_content-section clearfix">
              <div class="row">
                <div class="col-md-12">
                  <div class="panel widget">
                    <div class="panel-heading vd_bg-grey">
                      <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-list"></i> </span>  Manage Groups</h3>
                    </div>
                    <div class="panel-body table-responsive">
                      <button class="btn vd_bg-blue " data-target="#myModal" id="addgroup" data-toggle="modal"><i class="fa  fa-plus"></i> Add New Groups</button>
                      <!-- Modal -->
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header vd_bg-blue vd_white">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                              <h4 class="modal-title" id="myModalLabel">Add/Edit Group</h4>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo base_url();?>manage_groups/submit_group" class="form-horizontal" id="manage_group" method="POST" role="form"  enctype="multipart/form-data">


                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Group Name :</label>
                                  <div class="col-sm-7 controls">
                                    <input type="text" class="input-border-btm" id="group_name" name="group_name" placeholder="Enter Name">
                                    <input type="hidden" id="id" name="id">
                                  </div>
                                </div>

                               <div class="form-group">
                               <label class="col-sm-4 control-label">Show in sign up form:</label>
                               <div class="col-sm-7 controls">
                               <input type="radio" id="signup_show" name="signup_show" value="1"> Yes &nbsp;&nbsp;&nbsp;
                               <input checked="true" type="radio" id="signup_show" name="signup_show" value="0"> No<br>
                             </div>
                             </div>

                                <div class="modal-footer background-login">
                                  <button type="button" class="btn vd_btn vd_bg-grey" data-dismiss="modal">Close</button>
                                  <input type="submit" class="btn vd_btn vd_bg-green"  id="submitGroup" value="Submit">
                                </div>
                              </form>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->
                      <form action="<?php echo base_url();?>manage_groups/multiselect_action" method="post" name="myform" id="myform">
                        <table class="table table-striped" id="data-tables">
                          <thead>
                            <tr>
                              <th></th>
                              <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>
                              <th>Group name</th>
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