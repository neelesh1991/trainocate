<!-- Header Ends -->

<style>

.panelParegraph

{

background: #d9d9d9 none repeat scroll 0 0;

border: 1px solid #ccc;

padding: 3px 8px;

}

</style>

<div class="content">

  <div class="container">

    <?php $this->load->view('common/left_nav');?>

          <div class="vd_title-section clearfix">

            <div class="vd_panel-header">

              <h1>Manage Settings Options</h1>

            </div>

          </div>

    <div class="vd_content-section clearfix">

      <div class="row">

        <div class="col-md-12">

          <div class="panel widget">

            <div class="panel-heading vd_bg-grey">

              <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span></h3>

            </div>

            <div class="panel-body">

             

                <?php if(!empty($result)){

                ?>

                <div class="panel-group" id="accordion">



             

                  <div class="panel panel-default">

                    <div class="panel-heading profileColor">

                      <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> System Setting </a> </h4>

                    </div>

                    <div id="collapseOne" class="panel-collapse collapse in">

                      <div class="panel-body">                      



                       <form action="<?php echo base_url();?>settings/system_setting" method="post" name="system_setting" id="system_setting" enctype="multipart/form-data" class="form-horizontal">



                        <div class="form-group">

                          <label class="col-sm-4 control-label">Frontend System Name</label>

                          <div class="col-sm-7 controls">

                         <input type="text" value="<?php echo $result[0]['description'] ?>" name="system_name" class="form-control"><br>

                         </div>

                        </div>

                        <div class="form-group">

                          <label class="col-sm-4 control-label">Backend System Title</label>

                          <div class="col-sm-7 controls">

                            <input type="text" value="<?php echo $result[1]['description'] ?>" name="system_title" class="form-control">

                          </div>

                        </div>

                        <div class="form-group">

                          <label class="col-sm-4 control-label">time zone</label>

                          <div class="col-sm-7 controls">

                        <select id="time_zone" class="form-control" name="time_zone">

                        <?php if(!empty($timeZone)){

                            foreach ($timeZone as $timez) {  ?>

                              <option <?php if($result[15]['description']==$timez['timezone']){ echo 'selected="selected"';}?> value="<?php echo $timez['timezone'];?>"><?php echo $timez['name'];?>                        

                              </option>                                   

                          <?php   }  }  ?> 

                        </select>           

                         </div>

                        </div>

                        <div class="form-group">

                          <label class="col-sm-4 control-label">Currency</label>

                          <div class="col-sm-7 controls">

                            <select id="currencies" class="form-control" name="currencies">

                              <?php if(!empty($currency)){

                                  foreach ($currency as $curr) {  ?>

                                    <option <?php if($result[16]['description']==$curr['code']){ echo 'selected="selected"';}?> value="<?php echo $curr['code'];?>"><?php echo $curr['name'];?>                        

                                    </option>                                   

                                <?php   }  }  ?>                             

                              </select>

                          </div>

                        </div>

                        <input type="submit" value="Update" id="system" class="btn vd_btn vd_bg-green">

                        </form>

                      </div>                     

                    </div>

                  </div> 

               

                  <div class="panel panel-default">

                    <div class="panel-heading profileColor">

                      <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> Theme Setting </a> </h4>

                    </div>

                    <div id="collapseTwo" class="panel-collapse collapse">

                      <div class="panel-body">

                     

                       <form action="<?php echo base_url();?>settings/theam_setting" method="post" name="theam_setting" id="theam_setting" enctype="multipart/form-data" class="form-horizontal">



                        <div class="form-group">

                          <label class="col-sm-4 control-label">Header Logo</label>

                          <div class="col-sm-7 controls">                          

                          <input type="file" id="headimage" onchange="readURL(this);" name="header_logo">

                             <?php

                             if($result[4]['description']!='')

                             {                             

                             $filename="../uploads/settings/logo/".$result[4]['description'];

                             if (file_exists($filename)){

                             ?>

                             <img style="width:100px;" id="blah" src="<?php echo front_base_url();?>uploads/settings/logo/<?php echo $result[4]['description'];?>">

                             <?php } else  { ?>

                             <img style="width:100px;" id="blah" src="<?php echo front_base_url();?>assets/img/notavilable.jpg" alt="Not available in folder Logo">

                             <?php

                             }

                             }

                             else

                             {

                             ?>

                             <img style="width:100px;" id="blah" src="<?php echo front_base_url();?>assets/img/defult_logo.jpg" alt="Please upload Logo">

                             <?php

                             }

                             ?>

                             </div>

                        </div>

                        <div class="form-group">

                          <label class="col-sm-4 control-label">Favicon</label>

                          <div class="col-sm-7 controls">

                           <input type="file" onchange="readURL1(this);" id="favicon" name="favicon">

                              <?php

                              if($result[5]['description']!='')

                              {

                              

                              $filename="../uploads/settings/favicon/".$result[5]['description'];

                              if(file_exists($filename)){

                              ?>

                              <img style="width:100px;" id="blahFavicon" src="<?php echo front_base_url();?>uploads/settings/favicon/<?php echo $result[5]['description'];?>">

                              <?php }  else  {   ?>

                              <img style="width:100px;" id="blahFavicon" src="<?php echo front_base_url();?>assets/img/notavilable.jpg" alt="Please upload Logo">

                              <?php

                              }

                              }

                              else

                              {

                              ?>

                              <img style="width:100px;" id="blahFavicon" src="<?php echo front_base_url();?>assets/img/defult_logo.jpg" alt="Please upload Logo">

                              <?php

                              }

                              ?>

                          </div>

                        </div>

                        <div class="form-group">

                          <label class="col-sm-4 control-label">Header Color</label>

                          <div class="col-sm-7 controls">

                            <input type="text" class="jscolor" value="<?php echo $result[12]['description'] ?>" name="header_color">

                          </div>

                        </div>



                        <div class="form-group">

                          <label class="col-sm-4 control-label">Footer Color</label>

                          <div class="col-sm-7 controls">

                           <input type="text" class="jscolor" value="<?php echo $result[13]['description'] ?>" name="footer_color">

                          </div>

                        </div>



                        <div class="form-group">

                          <label class="col-sm-4 control-label" style="vertical-align:top">Home Page Image

                          <br />

                          <p style="color: rgb(145, 145, 145);">(Note: For Best Result Please Upload <br>1600x530 Resolution<br> size image)</p></label>

                          <div class="col-sm-7 controls">

                           <input type="file" id="home_page_image" name="home_page_image"  onchange="home_page_images(this);">

                              <?php

                              if($result[14]['description']!='')

                              {

                              

                              $filename="../uploads/settings/homePageImage/".$result[14]['description'];

                              if (file_exists($filename)){

                              ?>

                              <img style="width:100px;" id="blahHome" src="<?php echo front_base_url();?>uploads/settings/homePageImage/<?php echo $result[14]['description'];?>">

                              <?php }  else  {  ?>

                              <img style="width:100px;" id="blahHome" src="<?php echo front_base_url();?>assets/img/notavilable.jpg" alt="Please upload Logo">

                              <?php

                              }

                              }

                              else

                              {

                              ?>

                              <img style="width:100px;" id="blahHome" src="<?php echo front_base_url();?>assets/img/defult.png" alt="Please upload Logo">

                              <?php

                              }

                              ?>

                          </div>

                        </div>



                        <div class="form-group">

                          <label class="col-sm-4 control-label">Profile Color</label>

                          <div class="col-sm-7 controls">

                           <input type="text" class="jscolor" value="<?php echo $result[27]['description'] ?>" name="profileColor">

                          </div>

                        </div>



                        <div class="form-group">

                          <label class="col-sm-4 control-label">Left Nav Color</label>

                          <div class="col-sm-7 controls">

                           <input type="text" class="jscolor" value="<?php echo $result[28]['description'] ?>" name="leftNavColor">

                          </div>

                        </div>



                        <input type="submit" value="Update" id="theam" class="btn vd_btn vd_bg-green">



                        </form>



                      </div>

                    

                    </div>                    

                  </div>

                          

                  <div class="panel panel-default">

                    <div class="panel-heading profileColor">

                      <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"> Contact Settings </a> </h4>

                    </div>

                    <div id="collapseThree" class="panel-collapse collapse">

                      <div class="panel-body">

                      <form action="<?php echo base_url();?>settings/contact_setting" method="post" name="theam_setting" id="theam_setting" enctype="multipart/form-data" class="form-horizontal">

                      

                        <div class="form-group">

                          <label class="col-sm-4 control-label">Company Name</label>

                          <div class="col-sm-7 controls">

                           <input type="text" value="<?php echo $result[7]['description'] ?>" name="company_name" class="form-control">

                          </div>

                        </div>

                        <div class="form-group">

                          <label class="col-sm-4 control-label">Company Address</label>

                          <div class="col-sm-7 controls">

                           <input type="text" value="<?php echo $result[8]['description'] ?>" name="address" class="form-control">

                          </div>

                        </div>



                        <div class="form-group">

                          <label class="col-sm-4 control-label">Company Telephone</label>

                          <div class="col-sm-7 controls">

                           <input type="text" value="<?php echo $result[9]['description'] ?>" name="telephone" class="form-control">

                          </div>

                        </div>

                        <div class="form-group">

                          <label class="col-sm-4 control-label">Company Fax No</label>

                          <div class="col-sm-7 controls">

                          <input type="text" value="<?php echo $result[10]['description'] ?>" name="fax" class="form-control">

                          </div>

                        </div>

                        <div class="form-group">

                          <label class="col-sm-4 control-label">Website</label>

                          <div class="col-sm-7 controls">

                           <input type="text" value="<?php echo $result[11]['description'] ?>" name="website" class="form-control">

                          </div>

                        </div>

                        <input type="submit" value="Update" id="contact" class="btn vd_btn vd_bg-green">

                        </form>

                      </div>                    

                    </div>                    

                  </div> 

                  <div class="panel panel-default">

                    <div class="panel-heading profileColor">

                      <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"> Map Setting </a> </h4>

                    </div>

                    <div id="collapseFour" class="panel-collapse collapse">

                      <div class="panel-body">                       

                       <form action="<?php echo base_url();?>settings/map_setting" method="post" name="map_setting" id="map_setting" enctype="multipart/form-data" class="form-horizontal">



                       <div class="form-group">

                         <label class="col-sm-4 control-label">Latitude</label>

                         <div class="col-sm-7 controls">

                           <input type="text" value="<?php echo $result[29]['description'] ?>" name="latitude" class="form-control">

                         </div>

                       </div>



                       <div class="form-group">

                         <label class="col-sm-4 control-label">Longitude</label>

                         <div class="col-sm-7 controls">

                           <input type="text" value="<?php echo $result[30]['description'] ?>" name="longitude" class="form-control">

                         </div>

                       </div>

                        

                        <div class="form-group">

                          <label class="col-sm-4 control-label">Zoom Level</label>

                          <div class="col-sm-7 controls">

                            <input type="text" value="<?php echo $result[31]['description'] ?>" name="zoom_level" class="form-control">

                          </div>

                        </div>

                        <input type="submit" value="Update" id="mapset" class="btn vd_btn vd_bg-green">

                        </form>                        

                      </div>                      

                    </div>

                  </div>



                  <div class="panel panel-default">

                    <div class="panel-heading profileColor">

                      <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Maintenance Mode </a> </h4>

                    </div>

                    <div id="collapseFive" class="panel-collapse collapse">

                      <div class="panel-body">                      

                       <form action="<?php echo base_url();?>settings/maintance_setting" method="post" name="map_setting" id="map_setting" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form-group">

                          <label class="col-sm-4 control-label">Maintenance Mode</label>

                          <input type="radio" name="SITE_OFFLINE" value="YES" <?php

                              if($result[3]['description']=='YES'){?> checked="TRUE" <?php } ?> > Yes<br>

                              <input type="radio" name="SITE_OFFLINE" value="NO"  <?php  if($result[3]['description']=='NO'){ ?> checked="TRUE"  <?php }

                              ?> > No<br>

                        </div>                      

                     

                        <input type="submit" value="Update" id="payumony" class="btn vd_btn vd_bg-green">

                        </form>

                      </div>

                    

                    </div>                    

                  </div>                



                  <div class="panel panel-default">

                    <div class="panel-heading profileColor">

                      <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix"> Email Settings </a> </h4>

                    </div>

                    <div id="collapseSix" class="panel-collapse collapse">

                      <div class="panel-body">                       

                       <form action="<?php echo base_url();?>settings/email_setting" method="post" name="email_setting" enctype="multipart/form-data" class="form-horizontal" id="email_setting">

                        <div class="form-group">

                          <label class="col-sm-4 control-label">Company Email</label>

                          <div class="col-sm-7 controls">

                            <input type="text" value="<?php echo $result[2]['description'] ?>" name="from_email" class="form-control">

                          </div>

                        </div>

                        <div class="form-group">

                          <label class="col-sm-4 control-label">From Text</label>

                          <div class="col-sm-7 controls">

                           <input type="text" value="<?php echo $result[6]['description'] ?>" name="from_text" class="form-control">

                          </div>

                        </div>



                        <div class="form-group">

                          <label class="col-sm-4 control-label">Email Protocal</label>

                          <div class="col-sm-7 controls">



                          <select id="email_protocal" class="form-control"  onchange="emailProtocol(this)" name="email_protocal">

                                <option <?php if($result[32]['description']=='smtp'){ echo 'selected="selected"';}?> value="smtp">SMTP </option>

                                <option <?php if($result[32]['description']=='php_mail'){ echo 'selected="selected"';}?> value="php_mail">PHP MAIL </option>                                   

                          </select>                            

                          </div>

                        </div>                        

                         

                        <div class="form-group" id="smtp_host" <?php if($result[32]['description']=='php_mail'){ ?>style="display: none" <?php } ?>>

                          <label class="col-sm-4 control-label">SMTP HOST</label>

                          <div class="col-sm-7 controls">

                            <input type="text" value="<?php echo $result[33]['description'] ?>" name="smtp_host" class="form-control" >

                            <!--disabled-->

                          </div>

                        </div>



                        <div class="form-group" id="smtp_user" <?php if($result[32]['description']=='php_mail'){ ?>style="display: none" <?php } ?>>

                          <label class="col-sm-4 control-label">SMTP USER</label>

                          <div class="col-sm-7 controls">

                            <input type="text" value="<?php echo $result[34]['description'] ?>" name="smtp_user" class="form-control">

                          </div>

                        </div>



                        <div class="form-group" id="smtp_password" <?php if($result[32]['description']=='php_mail'){ ?>style="display: none" <?php } ?>>

                          <label class="col-sm-4 control-label">SMTP PASSWORD</label>

                          <div class="col-sm-7 controls">

                            <input type="text" value="<?php echo $result[35]['description'] ?>" name="smtp_password" class="form-control">

                          </div>

                        </div>



                        <div class="form-group" id="smtp_port" <?php if($result[32]['description']=='php_mail'){ ?>style="display: none" <?php } ?>>

                          <label class="col-sm-4 control-label">SMTP PORT</label>

                          <div class="col-sm-7 controls">

                            <input type="text" value="<?php echo $result[36]['description'] ?>" name="smtp_port" class="form-control">

                          </div>

                        </div>

                        

                        <input type="submit" value="Update" id="emailsett" class="btn vd_btn vd_bg-green">

                        </form>

                      </div>

                    </div>                    

                  </div>

                </div>

                <?php  }   ?>

            </div>

          </div>

        </div>

        <!-- .vd_content -->

      </div>

      <!-- .vd_container -->

    </div>

    </div>

    </div>

    </div>

    <!-- .vd_content-wrapper -->

    <!-- Middle Content End -->

  </div>

  <!-- .container -->

</div>



<!-- .content -->