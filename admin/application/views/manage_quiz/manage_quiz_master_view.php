<!-- Header Ends -->

<div class="content">

  <div class="container">

    <?php $this->load->view('common/left_nav');?>



            <div class="vd_content-section clearfix">

              <div class="row">

                <div class="col-md-12">

                  <div class="panel widget">

                    <div class="panel-heading vd_bg-grey">

                      <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-list"></i> </span>   Manage Assessment Master</h3>

                    </div>

                    <div class="panel-body table-responsive">

                      <button class="btn vd_bg-blue " data-target="#quizModal" id="addquiz" data-toggle="modal"><i class="fa  fa-plus"></i> Add New Assessment </button>

                      <!-- Modal -->

                      <div class="modal fade" id="quizModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                          <div class="modal-content">

                            <div class="modal-header vd_bg-blue vd_white">

                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

                              <h4 class="modal-title" id="myModalLabel">Add/Edit Assessment</h4>

                            </div>

                            <div class="modal-body">

                              <form action="<?php echo base_url();?>manage_quiz/submit_quiz" class="form-horizontal" id="manage_quiz" method="POST" role="form"  enctype="multipart/form-data">



                                <div class="form-group">

                                  <label class="col-sm-4 control-label">Assessment Name :</label>

                                  <div class="col-sm-7 controls">

                                    <input type="text" class="input-border-btm" id="quiz_name" name="quiz_name" placeholder="Enter Name">

                                    <input type="hidden" id="id" name="id">

                                  </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Assesment Image :</label>
                                    <div class="col-sm-7 controls">
                                        <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
                                        <input type="file" id="logo" name="logo" accept="image/*">
                                    </div>
                                </div>

                                <!--Start: Code added for mandar 29/11/2019 -->
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Information About Assessment :</label>
                                  <div class="col-sm-7 controls">
                                    <textarea class="form-control" name ="assessment_information" placeholder="Information About Assessment" id="assessment_information"></textarea>
                                  </div>
                                </div>
                                <!--Start: Code added for mandar 29/11/2019 -->

                                 <div class="form-group">

                                  <label class="col-sm-4 control-label"> Number Of Sections :</label>

                                  <div class="col-sm-7 controls">

                                    <input type="text" class="input-border-btm" id="number_of_sections" name="number_of_sections" placeholder="Enter Number Of Sections">

                                  </div>

                                </div>

                                <div class="form-group">

                                      <label class="col-sm-4 control-label">Bind Url</label>

                                      <div class="col-sm-7 controls">

                                        <input type="radio" name="bind_url" value="1"> Yes &nbsp;&nbsp;&nbsp;

                                        <input checked="true" type="radio" name="bind_url" value="0"> No<br>

                                      </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="col-sm-4 control-label">Url:</label>

                                        <div class="col-sm-7 controls">

                                            <input type="text" class="input-border-btm" id="url" name="url" placeholder="Enter Url">

                                        </div>

                                    </div>



                                <div class="form-group">

                                  <label class="col-sm-4 control-label">Mock Test</label>

                                  <div class="col-sm-7 controls">

                                  <input checked="true" type="radio" id="mockYes" name="mock" value="1"> Yes &nbsp;&nbsp;&nbsp;

                                  <input type="radio" name="mock"  id="mockNo" value="0"> No<br>

                                </div>

                                </div>



                                <div class="form-group" id="mockCategories">

                                   <label class="col-sm-4 control-label">Select Mock Category :

                                          <p style="color: rgb(145, 145, 145);font-weight:normal">(Note: To Enter Category Name Press Enter Key)</p>

                                   </label>

                                   <div class="col-sm-7 controls">

                                     <input id="input-autocomplete" name="category_id" type="text" class="tags" value="" />

                                   </div>

                                 </div>

                                <div class="modal-footer background-login">

                                  <button type="button" class="btn vd_btn vd_bg-grey" data-dismiss="modal">Close</button>

                                  <input type="submit" class="btn vd_btn vd_bg-green"  id="submitQuiz" value="Submit">

                                </div>

                              </form>

                            </div>

                          </div>

                          <!-- /.modal-content -->

                        </div>

                        <!-- /.modal-dialog -->

                      </div>

                      <!-- /.modal -->

                      <form action="<?php echo base_url();?>manage_quiz/multiselect_action" method="post" name="myform" id="myform">

                        <table class="table table-striped" id="data-tables">

                          <thead>

                            <tr>

                              <th></th>

                              <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>

                              <th>Assessment Logo</th>

                              <th>Assessment name</th>

                              <th>Number Of Sections</th>

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