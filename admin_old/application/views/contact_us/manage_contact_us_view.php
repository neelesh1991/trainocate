<!--Header Ends -->

<div class="content">

  <div class="container">

    <?php $this->load->view('common/left_nav');?>

          <div class="vd_title-section clearfix">

            <div class="vd_panel-header">

              <h1>Enquiry</h1>

              <!-- <small class="subtitle">Look <a href="http://www.datatables.net/">datatables.net</a> for more information</small> --> </div>

            </div>

            <div class="vd_content-section clearfix">

              <div class="row">

                <div class="col-md-12">

                  <div class="panel widget">

                    <div class="panel-heading vd_bg-grey">

                      <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span></h3>

                    </div>

                    <div class="panel-body table-responsive">

                      <button class="btn btn-primary " data-target="#multipleReplayModal" data-toggle="modal">Multiple Replay </button>

                      <!-- Modal -->

                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                          <div class="modal-content">

                            <div class="modal-header vd_bg-blue vd_white">

                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

                              <h4 class="modal-title" id="myModalLabel">Replay</h4>

                            </div>

                            <div class="modal-body">

                              <form action="<?php echo base_url();?>contact_us/send_mail" class="form-horizontal" id="enquiry" method="POST" role="form"  enctype="multipart/form-data">

                                

                                <div class="form-group">

                                  <label class="col-sm-4 control-label">Email Id :</label>

                                  <div class="col-sm-7 controls">

                                    <input type="text" class="input-border-btm" id="email" name="email" placeholder="Enter email address..">

                                  </div>

                                </div>

                                <div class="form-group">

                                  <label class="col-sm-4 control-label">Subject :</label>

                                  <div class="col-sm-7 controls">

                                    <input type="text" class="input-border-btm" id="subject" name="subject" placeholder="Enter subject..">

                                  </div>

                                </div>

                                <div class="form-group">

                                  <label class="col-sm-4 control-label">Text :</label>

                                  <div class="col-sm-7 controls">

                                    <textarea class="input-border-btm" id="text" name="text" placeholder="Enter text.."></textarea>

                                  </div>

                                </div>

                                <div class="modal-footer background-login">

                                  <input type="submit" class="btn vd_btn vd_bg-green"  id="send" value="send">

                                </div>

                              </form>

                            </div>

                            

                          </div>

                          <!-- /.modal-content -->

                        </div>

                        <!-- /.modal-dialog -->

                      </div>

                      <!-- /.modal -->

                      <div class="modal fade" id="multipleReplayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                          <div class="modal-content">

                            <div class="modal-header vd_bg-blue vd_white">

                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

                              <h4 class="modal-title" id="myModalLabel">Multiple Replay</h4>

                            </div>

                            <div class="modal-body">



                            <form action="<?php echo base_url();?>contact_us/send_multiple_mail" class="form-horizontal" id="enquiry" method="POST" role="form"  enctype="multipart/form-data">                                

                                    <div class="form-group">

                                      <label class="col-sm-4 control-label">Select Email</label>

                                      <div class="col-sm-7 controls">

                                       <select id="email" name="email[]" multiple="multiple" class="form-control"> 

                                       <?php if(!empty($emailId))

                                       {

                                          foreach ($emailId as $email_id) {  ?>

                                            <option value="<?php echo $email_id['email'];?>"><?php echo $email_id['email']; ?></option>                    

                                          <?php 

                                          }

                                       }  ?>                                     

                                         

                                        </select> 

                                      </div>

                                    </div>

                                    <div class="form-group">

                                      <label class="col-sm-4 control-label">Subject :</label>

                                      <div class="col-sm-7 controls">

                                        <input type="text" class="input-border-btm" id="subject" name="subject" placeholder="Enter subject..">

                                      </div>

                                    </div>

                                    <div class="form-group">

                                      <label class="col-sm-4 control-label">Text :</label>

                                      <div class="col-sm-7 controls">

                                        <textarea class="input-border-btm" id="text" name="text" placeholder="Enter text.."></textarea>

                                      </div>

                                    </div>

                                    <div class="modal-footer background-login">

                                      <input type="submit" class="btn vd_btn vd_bg-green"  id="send" value="send">

                                  </div>                               

                              </form>

                            </div>

                          </div>                        

                        </div>

                      

                      </div>

                      <form action="<?php echo base_url();?>contact_us/multiselect_action" method="post" name="myform" id="myform">

                        <table class="table table-striped" id="data-tables">

                          <thead>

                            <tr>

                              <th></th>

                              <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>

                              <th>User Name</th>

                              <th>Email</th>

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

  <!-- .content