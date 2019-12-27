<!-- Header Ends -->
<div class="content">
  <div class="container">
    <?php $this->load->view('common/left_nav');?>

          <!--   <?php print_r($this->session->userdata());?> -->
            <div class="vd_content-section clearfix">
              <div class="row">
                <div class="col-md-12">
                  <div class="panel widget">
                    <div class="panel-heading vd_bg-grey">
                      <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-list"></i> </span>    Manage Exams</h3>
                    </div>
                    <div class="panel-body table-responsive">
                      <button class="btn vd_bg-blue" data-target="#ExamsModal" id="addexam" data-toggle="modal"><i class="fa  fa-plus"></i> Add New Exam </button>
                      <!-- Modal -->
                      <div class="modal fade" id="ExamsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header vd_bg-blue vd_white">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                              <h4 class="modal-title" id="myModalLabel">Add/Edit Exam</h4>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo base_url();?>manage_exams/submit_exams" class="form-horizontal" id="manage_exams" method="POST" role="form"  enctype="multipart/form-data">

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Exam Name :</label>
                                  <div class="col-sm-7 controls">
                                    <input type="text" class="input-border-btm" id="exam_name" name="exam_name" placeholder="Enter Exam Name">
                                  </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-sm-4 control-label">Select Quiz Name :</label>
                                   <div class="col-sm-7 controls">
                                     <select name="quiz_id" id="quiz_id">
                                       <option value="">Select Quiz</option>
                                       <?php
                                       if(!empty($quiz)){
                                         foreach($quiz as $quizvalue)
                                       {
                                       ?>
                                       <option value="<?php echo $quizvalue['id'];?>"><?php echo $quizvalue['quiz_name'];?></option>
                                       <?php }
                                       }?>
                                     </select>
                                   </div>
                                 </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Success Message :</label>
                                  <div class="col-sm-7 controls">
                                  <textarea name="completion_message" id="completion_message" placeholder="Enter Success Message"></textarea>
                                   <!--  <input type="text" class="input-border-btm" id="completion_message" name="completion_message" placeholder="Enter Name"> -->
                                    <input type="hidden" id="id" name="id">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Start Date :</label>
                                  <div class="col-sm-7 controls">
                                    <input type="text" class="input-border-btm datepicker" id="start_date" name="start_date" placeholder="Select Your Start Date">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">End Date :</label>
                                  <div class="col-sm-7 controls">

                                    <input type="text" class="input-border-btm datepicker" id="end_date" name="end_date" placeholder="Select Your End Date">
                                  </div>
                                </div>

                                 <div class="form-group">
                                  <label class="col-sm-4 control-label"> Duration :</label>
                                  <div class="col-sm-7 controls">
                                    <input type="text" class="input-border-btm" id="duration" name="duration" placeholder="Enter Duration eg. 00:00:00">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Security</label>
                                  <div class="col-sm-7 controls">
                                  <input type="radio" name="security" value="1"> Yes &nbsp;&nbsp;&nbsp;
                                  <input checked="true" type="radio" name="security" value="0"> No<br>
                                </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Show Result</label>
                                  <div class="col-sm-7 controls">
                                  <input type="radio" name="show_results" value="1"> Yes &nbsp;&nbsp;&nbsp;
                                  <input checked="true" type="radio" name="show_results" value="0"> No<br>
                                </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Result Depends on</label>
                                  <div class="col-sm-7 controls">
                                  <input type="radio" checked="true" name="result_dependancy" value="0">No of que. &nbsp;&nbsp;&nbsp;
                                  <input type="radio" name="result_dependancy" value="1">Marks<br>
                                </div>
                                </div>

                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">Select users</label>
                                      <div class="col-sm-7 controls">
                                       <select id="selectUsers" name="selectUsers[]" multiple="multiple" class="form-control">
                                          <?php
                                          if(!empty($users)){
                                            foreach($users as $value)
                                          {
                                          ?>
                                          <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                                          <?php }
                                          }?>
                                        </select>
                                      </div>
                                    </div>

                                     <div class="form-group">
                                      <label class="col-sm-4 control-label">Select Groups</label>
                                      <div class="col-sm-7 controls">
                                       <select id="selectGroups" name="selectGroups[]" multiple="multiple" class="form-control">
                                          <?php
                                          if(!empty($group)){
                                            foreach($group as $groupval)
                                          {
                                          ?>
                                          <option value="<?php echo $groupval['id'];?>"><?php echo $groupval['group_name'];?></option>
                                          <?php }
                                          }?>
                                        </select>
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
                      <form action="<?php echo base_url();?>manage_exams/multiselect_action" method="post" name="myform" id="myform">
                        <table class="table table-striped" id="data-tables">
                          <thead>
                            <tr>
                              <th></th>
                              <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>
                              <th>Quiz Info</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Security</th>
                              <th>Show_results</th>
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