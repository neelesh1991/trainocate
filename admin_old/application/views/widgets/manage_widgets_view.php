<!-- Header Ends -->

<div class="content">

  <div class="container">

  <?php $this->load->view('common/left_nav');?>




              <div class="vd_content-section clearfix">

                <div class="row">

                  <div class="col-md-12">

                    <div class="panel widget">

                      <div class="panel-heading vd_bg-grey">

                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-list"></i> </span>

                        Manage Widgets</h3>

                      </div>

                      <div class="panel-body table-responsive">

                      <?php if($this->session->userdata('admin_level')==1){?>

                      <button class="btn btn-primary " data-target="#myModal" data-toggle="modal"> Add New Widgets</button>

                      <?php  }  ?>


                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                          <div class="modal-content">

                            <div class="modal-header vd_bg-blue vd_white">

                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

                              <h4 class="modal-title" id="myModalLabel">Widgets</h4>

                            </div>

                            <div class="modal-body">

                              <form class="form-horizontal" id="widgets" method="POST" role="form"  enctype="multipart/form-data">



                              <div class="form-group">

                                <label class="col-sm-2 control-label">Page Name</label>

                                <div class="col-sm-9 controls">

                                <input type="text" value="" id="page_name" name="page_name" class="input-border-btm">

                                </div>

                              </div>



                                <div class="form-group">

                                  <label class="col-sm-2 control-label">Title</label>

                                  <div class="col-sm-9 controls">

                                  <input type="text" value="" id="widget_name" name="widget_name" class="input-border-btm">

                                  </div>

                                </div>

                                <div class="form-group">

                                  <label class="col-sm-2 control-label">Contains</label>

                                  <div class="col-sm-9 controls">

                                  <textarea name="info" id="info" class="input-border-btm">

                                    </textarea>

                                    <input type="hidden" id="id" name="id">

                                  </div>

                                </div>

                                <div class="modal-footer background-login">



                                  <input type="submit" value="Submit" id="widgets" class="btn vd_btn vd_bg-green">



                                </div>

                              </form>

                            </div>



                          </div>

                          <!-- /.modal-content -->

                        </div>

                        <!-- /.modal-dialog -->

                      </div>

                      <form method="post" name="myform" id="myform">

                        <table class="table table-striped" id="data-tables">

                          <thead>

                            <tr>

                              <th></th>

                              <th>Page Name</th>

                              <th>Subject</th>

                              <th>Content</th>

                              <th>Action</th>

                            </tr>

                          </thead>

                        </table>

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

