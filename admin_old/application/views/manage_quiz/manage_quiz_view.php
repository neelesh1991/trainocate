<div class="content">
  <div class="container">
    <?php $this->load->view('common/left_nav');?>
   
    <div class="vd_content-section clearfix">
      <div class="row">
        <div class="col-md-12">
          <div class="panel widget">
            <div class="panel-heading vd_bg-grey">
              <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-list"></i> </span>    Manage Question Bank<!--  Data Tables Example --> </h3>
            </div>
            <div class="panel-body table-responsive">
              <button class="btn vd_bg-blue" data-target="#addQuestion" data-toggle="modal"><i class="fa  fa-plus"></i> Add Question </button>
              <button class="btn btn-success " data-target="#csvQuestion" data-toggle="modal"><i class="fa  fa-file-text-o"></i> Add Question By CSV </button>
              <!-- Modal -->
              <div class="modal fade" id="csvQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header vd_bg-blue vd_white">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                      <h4 class="modal-title" id="myModalLabel">Add Question By CSV</h4>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo base_url();?>quiz/add_csv_questions" class="form-horizontal" method="POST" role="form" id="addQuestionCsv" enctype="multipart/form-data">

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Add CSV :</label>
                          <div class="col-sm-8 controls">
                            <input type="file" name="csvfile">
                          </div>
                        </div>
                                <div class="form-group">
                                          <div class="col-sm-offset-4 col-sm-8">
                                          Download sample csv file <a href="<?php echo front_base_url();?>sampleFiles/questions/questions_sample.csv" > <i class="fa fa-download"></i></a>
                                          </div>
                                   </div>
                        <div class="modal-footer background-login">
                          <button type="button" class="btn vd_btn vd_bg-grey" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn vd_btn vd_bg-green"  id="submitCsvQuestion" value="Submit">
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <div class="modal fade" id="addQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="row">
                  <div class="col-md-10 col-sm-offset-1">
                    <div class="panel widget">
                      <div class="panel-heading vd_bg-grey">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-magic"></i> </span> Add Question </h3>
                      </div>
                      <div class="panel-body">
                        <form class="form-horizontal form-wizard" id="questionForm" action="<?php echo base_url();?>quiz/saveQuestion" role="form">

                            <ul>
                              <li><a href="#tab21" data-toggle="tab">
                                <div class="menu-icon"> 1 </div>
                             Add Question </a></li>
                              <li><a href="#tab22" data-toggle="tab">
                                <div class="menu-icon"> 2 </div>
                              Add Options </a></li>
                              <li><a href="#tab23" data-toggle="tab">
                                <div class="menu-icon"> 3 </div>
                              Confirm </a></li>
                            </ul>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar-info" > </div>
                            </div>
                            <div class="tab-content">
                              <div class="tab-pane" id="tab21">
                                <div class="row">
                                  <div class="col-md-12">
                                    <label class="control-label">Question</label>
                                    <div class="controls form-group">
                                          <textarea  name="question" id="question" placeholder="Enter question ...." class="input-border-btm form-control editor" value=""></textarea>
                                    </div>
                                  </div>

                                </div>
                                <div class="row">
                                  <div class="col-md-6">

                                    <label class="control-label">Category</label>
                                    <div class="controls form-group">
                                      <input id="input-autocomplete" name="category" type="text" class="tags form-control"  value="" />
                                    </div>

                                  </div>
                                  <div class="col-md-6">
                                      <label class="control-label">Marks</label>
                                      <div class="controls form-group">
                                        <input placeholder="Add Marks" name="marks" type="number" class="form-control">
                                      </div>
                                  </div>
                                </div>

                              </div>
                              <div class="tab-pane" id="tab22">
                                <div class="row voca">
                                                <div class="col-md-8">
                                                        <label class="control-label">Option</label>
                                                        <div class="controls form-group">
                                                                  <textarea name="option[]" id="option" placeholder="Enter option...." class="input-border-btm form-control editor" value=""></textarea>
                                                        </div>
                                                </div>
                                                <div class="col-md-2" style="margin-top:150px;text-align: center">

                                                        <div class="vd_radio radio-success">
                                                        <input checked="checked" name="is_correct" value="0" id="is_correct_0" type="radio" class="">
                                                        <label for="is_correct_0"> Correct Option </label>

                                                      </div>

                                                </div>
                                              <div class="col-md-2" style="margin-top:150px;">
                                                <button type="button" class="btn btn-success btn-add" >
                                                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add more
                                                </button>
                                              </div>
                                        </div>
                              </div>
                              <div class="tab-pane" id="tab23">

                              </div>

                              <div class="form-actions-condensed wizard">
                                <div class="row mgbt-xs-0">
                                  <div class="col-sm-9 col-sm-offset-2"> <a class="btn vd_btn prev" href="javascript:void(0);"><span class="menu-icon"><i class="fa fa-fw fa-chevron-circle-left"></i></span> Previous</a> <a class="btn vd_btn next" href="javascript:void(0);">Next <span class="menu-icon"><i class="fa fa-fw fa-chevron-circle-right"></i></span></a> <a class="btn vd_btn vd_bg-green finish" href="javascript:void(0);"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Finish</a> </div>
                                </div>
                              </div>
                            </div>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <form action="<?php echo base_url();?>quiz/multiselect_action" method="post" name="myform" id="myform">
                <table class="table table-striped" id="data-tables">
                  <thead>
                    <tr>
                      <th></th>
                      <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>
                      <th>Question</th>
                      <th>Marks</th>
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
                 <!--        <option value="1">
                          Activate
                        </option>
                        <option value="2">
                          Deactivate
                        </option> -->
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