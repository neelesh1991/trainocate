<!-- Header Ends -->

<div class="content">

  <div class="container">

  <?php $this->load->view('common/left_nav');?>

             

              <div class="vd_content-section clearfix">

                <div class="row">

                  <div class="col-md-12">

                    <div class="panel widget">

                      <div class="panel-heading vd_bg-grey">

                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-list"></i> </span><!--  Data Tables Example --> Manage Email Templates</h3>

                      </div>

                      <div class="panel-body table-responsive">
                      <?php if($this->session->userdata('admin_level')==1){?>

                      <button class="btn btn-primary " data-target="#myModal" data-toggle="modal"> Add New Email Template</button>

                      <?php  }  ?>

                      <!-- Modal -->

                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                          <div class="modal-content">

                            <div class="modal-header vd_bg-blue vd_white">

                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

                              <h4 class="modal-title" id="myModalLabel">Modal title</h4>

                            </div>

                            <div class="modal-body">

                              <form action="<?php echo base_url();?>Email_template/add_edit_email" class="form-horizontal" id="emailTemplate" method="POST" role="form"  enctype="multipart/form-data">                             

                                <div class="form-group">

                                  <label class="col-sm-2 control-label">Subject</label>

                                  <div class="col-sm-9 controls">

                                  <input type="text" value="" id="subject" name="subject" class="input-border-btm">      

                                  </div>



                                </div>

                                <div class="form-group">

                                  <label class="col-sm-2 control-label">email Contains</label>

                                  <div class="col-sm-9 controls">

                                  <textarea name="email_contains" id="email_contains" class="input-border-btm"> 

                                    </textarea>

                                    <input type="hidden" id="id" name="id">

                                  </div>

                                </div>

                                <div class="modal-footer background-login">

                                                                 

                                  <input type="submit" value="Submit" id="email" class="btn vd_btn vd_bg-green">



                                </div>

                              </form>

                            </div>

                            

                          </div>

                          <!-- /.modal-content -->

                        </div>

                        <!-- /.modal-dialog -->

                      </div>

                      <form action="<?php echo base_url();?>email_template/multiselect_action" method="post" name="myform" id="myform">

                        <table class="table table-striped" id="data-tables">

                          <thead>

                            <tr>

                              <th></th>

                              <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>

                              <th>Id</th>

                              <th>Subject</th>

                           

                              <th>Status</th>                              

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

                              <input type="submit" name="submit" value="Go" onclick="return validateForm();" class="btn vd_btn btn-xs vd_bg-facebook" style="float: left;">

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



