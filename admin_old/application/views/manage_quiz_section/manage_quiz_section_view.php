<!-- Header Ends -->

<div class="content">

  <div class="container">

    <?php $this->load->view('common/left_nav');?>



            <div class="vd_content-section clearfix">

              <div class="row">

                <div class="col-md-12">

                  <div class="panel widget">

                    <div class="panel-heading vd_bg-grey">

                      <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-list"></i> </span>  Manage Quiz Sections</h3>

                    </div>

                    <div class="panel-body table-responsive">

                      <button class="btn vd_bg-blue" data-target="#quiz_section_Modal" id="addquizsec" data-toggle="modal"><i class="fa  fa-plus"></i> Add New Sections </button>

                      <!-- Modal -->

                      <div class="modal fade" id="quiz_section_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                          <div class="modal-content">

                            <div class="modal-header vd_bg-blue vd_white">

                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

                              <h4 class="modal-title" id="myModalLabel">Add/Edit section</h4>

                            </div>

                            <div class="modal-body">

                              <form action="<?php echo base_url();?>manage_quiz_section/submit_section" class="form-horizontal" id="manage_quiz_section" method="POST" role="form"  enctype="multipart/form-data">



                              <div class="form-group">

                                <label class="col-sm-4 control-label">Section Quiz :</label>

                                <div class="col-sm-7 controls">

                                  <select name="quiz_id" id="quiz_id" onchange="set_quiz_id(this);">

                                        <option value="">Select Quiz</option>

                                        <?php

                                        if(!empty($quiz_section)){

                                          foreach($quiz_section as $value)

                                        {

                                        ?>

                                        <option value="<?php echo $value['id'];?>"><?php echo $value['quiz_name'];?></option>

                                       <?php  }

                                        }  ?>

                                  </select>

                                </div>

                              </div>

                              <div class="wrapper" id="report_section_wrapper">

                                  <div class="wrapper"  id="report_section">



                                <div class="form-group">

                                  <label class="col-sm-4 control-label">Section Name :</label>

                                  <div class="col-sm-7 controls">

                                    <input type="text" class="input-border-btm" id="section_name" name="section_name[]" placeholder="Enter Section Name">



                                    <input type="hidden" id="id" name="id">



                                  </div>

                                </div>





                               <div class="form-group">

                                 <label class="col-sm-4 control-label">No Of Questions :</label>

                                 <div class="col-sm-7 controls">

                                   <input type="text" class="input-border-btm" id="no_of_questions" name="no_of_questions[]" placeholder="Enter Name Section Name">

                                 </div>

                               </div>



                               <div class="form-group">

                                  <label class="col-sm-4 control-label">Select Category :

                                         <p style="color: rgb(145, 145, 145);font-weight:normal">(Note: To Enter Section Name Press Enter Key)</p>

                                  </label>

                                  <div class="col-sm-7 controls">

                                    <input id="input-autocomplete" name="category_id[]" type="text" class="tags" value="" />

                                  </div>

                                </div>



                              </div>

                              </div>

                              <div class="modal-footer background-login">

                                <button type="button" class="btn vd_btn vd_bg-grey" data-dismiss="modal">Close</button>

                                <input type="submit" class="btn vd_btn vd_bg-green"  id="submitSection" value="Submit">

                              </div>

                              </form>

                            </div>

                          </div>

                          <!-- /.modal-content -->

                        </div>

                        <!-- /.modal-dialog -->

                      </div>

                      <!-- /.modal -->

                      <form action="<?php echo base_url();?>manage_quiz_section/multiselect_action" method="post" name="myform" id="myform">

                        <table class="table table-striped" id="data-tables">

                          <thead>

                            <tr>

                              <th></th>

                              <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>

                              <th>Section name</th>

                              <th>Quiz name</th>

                              <th>Category name</th>

                              <th>NO of questions</th>

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

