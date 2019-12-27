<!--Header Ends -->
<script type="text/javascript">
  function displayForm(c){

    if (c.value == 1)
      //document.getElementById('leveldiv').style.visibility='visible';
    //alert('yes');
    $('#leveldiv').show(1000);
    else {
       //document.getElementById('leveldiv').style.visibility='hidden';
       $('#leveldiv').hide(1000);
    //alert('no');
    }


  }
</script>

<div class="content">
  <div class="container">
    <?php $this->load->view('common/left_nav');?>

    <!--   <?php print_r($this->session->userdata());?> -->
    <div class="vd_content-section clearfix">
      <div class="row">
        <div class="col-md-12">
          <div class="panel widget">
            <div class="panel-heading vd_bg-grey">
              <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-list"></i> </span>Manage User Completed Exams</h3>
            </div>
            <div class="panel-body table-responsive">

              <form action="<?php echo base_url();?>manage_exams/multiselect_action" method="post" name="myform" id="myform">
                <table class="table table-striped" id="data-tables">
                  <thead>
                    <tr>
                      <th></th>
                      <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>
                      <th>Exam Info</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>User Info</th>
                      <th>Exam Completed in</th>
                      <!--<th>Show Levels</th> -->
                      <th>Action</th>

                    </tr>
                  </thead>
                </table>

                <div class="row">
                 <!--  <div class="col-md-12">
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

                  </div> -->
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