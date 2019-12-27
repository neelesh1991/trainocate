

       <div class="content">

            <div class="container">

              <!-- Middle Content Start -->

              <div class="vd_content-wrapper">

                <div class="vd_container">

                  <div class="vd_content clearfix">

                    <?php if($this->session->flashdata('success'))

                      {

                      ?>

                    <div class="vd_panel-header">

                      <div class="alert alert-success alert-dismissable">

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>

                        <i class="fa fa-exclamation-circle append-icon"></i><strong>Well done!</strong> <a class="alert-link" href="javascript:void(0);"><?php echo $this->session->flashdata('success');?> </a>

                      </div>

                    </div>

                    <?php

                      }

                      elseif($this->session->flashdata('error'))

                      {

                      ?>

                    <div class="vd_panel-header">

                      <div class="alert alert-danger alert-dismissable">

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>

                        <i class="fa fa-exclamation-circle append-icon"></i><strong>Oh snap!</strong> <a class="alert-link" href="javascript:void(0);"><?php echo $this->session->flashdata('error');?></a>

                      </div>

                    </div>

                    <?php } ?>

                    <div class="vd_content-section clearfix">

                      <div class="vd_login-page">

                        <div class="heading clearfix">

                          <h4 class="text-center font-semibold vd_white">LOGIN TO YOUR ACCOUNT</h4>

                        </div>

                        <div class="panel widget">

                          <div class="panel-body">

                            <div class="login-icon entypo-icon" style="padding: 8px">
                            <img src="<?php echo base_url();?>uploads/logo/logo.png" alt="">
                           <!-- <img height="30" src="<?php echo front_base_url();?>admin/assets/logo/thumbs/<?php echo $settings[4]['description']; ?>" style="margin-bottom: 20px;padding:0px 10px;" alt="">-->
                           </div>

                            <form class="form-horizontal" id="login-form" action="<?php echo base_url();?>login" role="form" method="post">

                              <div class="alert alert-danger vd_hidden">

                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>

                                <span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oh snap!</strong> Please correct following errors and try submiting it again.

                              </div>

                              <div class="alert alert-success vd_hidden">

                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>

                                <span class="vd_alert-icon"><i class="fa fa-check-circle vd_green"></i></span><strong>Well done!</strong>.

                              </div>

                              <div class="form-group  mgbt-xs-20">

                                <div class="col-md-12">

                                  <div class="label-wrapper sr-only">

                                    <label class="control-label" for="email">Email</label>

                                  </div>

                                  <div class="vd_input-wrapper light-theme" id="email-input-wrapper"> <span class="menu-icon"> <i class="fa fa-envelope"></i> </span>

                                    <input type="email" placeholder="Email" id="email" name="email" class="required">

                                  </div>

                                  <br/>

                                  <div class="label-wrapper">

                                    <label class="control-label sr-only" for="password">Password</label>

                                  </div>

                                  <div class="vd_input-wrapper light-theme" id="password-input-wrapper" > <span class="menu-icon"> <i class="fa fa-lock"></i> </span>

                                    <input type="password" placeholder="Password" id="password" name="password" class="required">

                                  </div>

                                </div>

                              </div>

                              <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>

                              <div class="form-group">

                                <div class="col-md-12 text-center mgbt-xs-5">

                                  <button class="btn vd_btn vd_btn-bevel vd_bg-blue font-semibold width-100" type="submit" id="login-submit">Login</button>

                                </div>

                                <div class="col-md-12">

                                  <div class="row">

                                    <div class="col-xs-12 text-right">

                                    <a href="<?php echo base_url();?>login/forgot_password">Forgot Password ?</a>

                                    </div>



                                  </div>

                                </div>

                              </div>

                            </form>

                          </div>

                        </div>



                      </div>

                      <!-- vd_login-page -->

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

