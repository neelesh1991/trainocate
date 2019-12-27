<!--Header Ends -->
<?php //echo "<pre/>"; print_r($exam_Logs); die; ?>
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
    <div class="vd_content-section clearfix">
      <div class="row">
        <div class="col-md-12">
          <div class="panel widget">
            <div class="panel-heading vd_bg-grey">
              <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-list"></i> </span>Reset Exams</h3>
            </div>
            <div class="panel-body table-responsive">
              <form action="<?php echo base_url();?>manage_exams/multiselect_action" method="post" name="myform" id="myform">
                <table class="table table-striped" id="data-tables">
                  <thead>
                    <tr>
                      <th></th>
                      <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>
                      <th>Assessment Info</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <!--<th>Show Levels</th> -->
                      <th>Action</th>

                    </tr>
                    <?php   
                      $timezone='Asia/Kolkata';
                      if($this->session->userdata('time_zone')!='')
                      {
                          $timezone=$this->session->userdata('time_zone');
                      }
                      $tz_from = 'UTC';
                      $tz_to = $timezone;
                      $format = 'Y-m-d h:i a';
                      $data = array();
                      if(!empty($exam_Logs))
                      {
                        $i=1;
                        foreach ($exam_Logs as $key => $row)
                        {

                          $start = new DateTime($row["start_date"], new DateTimeZone($tz_from));
                          $start->setTimeZone(new DateTimeZone($tz_to));
                          $start_date=$start->format($format);

                          $end = new DateTime($row["end_date"], new DateTimeZone($tz_from));
                          $end->setTimeZone(new DateTimeZone($tz_to));
                          $end_date=$end->format($format);
                    ?>
                    <tr>
                        <td></td>
                        <td><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></td>
                        <td><?php echo '<div style="text-align:left;"><b>Exam Name : </b>'.$row['exam_name'].'<br/></div>'; ?></td>
                        <td><?php echo $start_date; ?></td>
                        <td><?php echo $end_date; ?></td>
                        <td><?php echo '<div class="menu-action">
              <a onclick="user_reset_exams('.$row['user_id'].','.$row['exam_id'].');" class="btn menu-icon vd_bd-yellow vd_yellow" data-placement="top" data-toggle="tooltip" data-original-title="reset exam"> <i class="fa fa-refresh"></i> </a></div>'; ?></td>
                    </tr>
                  <?php } } else{ echo "<tr><td colspan='8'> No data available...</td></tr>"; } ?>
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
<!-- .content
