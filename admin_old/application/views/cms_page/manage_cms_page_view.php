<div class="content">

  <div class="container">

  <?php $this->load->view('common/left_nav');?>

          <div class="vd_title-section clearfix">

            <div class="vd_panel-header">

              <h1>Manage Cms Pages</h1>

             </div>

          </div>

          <div class="vd_content-section clearfix">

            <div class="row">

              <div class="col-md-12">

                <div class="panel widget">

                  <div class="panel-heading vd_bg-grey">

                    <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span><!--  Data Tables Example --> </h3>

                  </div>

                  <div class="panel-body table-responsive">

                    <button class="btn btn-primary " data-target="#myModal" data-toggle="modal"> Add New CMS Page</button>

                  <!-- Modal -->

                     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                       <div class="modal-dialog">

                        <div class="modal-content">

                          <div class="modal-header vd_bg-blue vd_white">

                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

                            <h4 class="modal-title" id="myModalLabel">Cms Page</h4>

                          </div>

                          <div class="modal-body">

                           <form action="<?php echo base_url();?>cms_page/add_edit" class="form-horizontal" id="cms_page" method="POST" role="form"  enctype="multipart/form-data">

                              <div class="form-group">

                                <label class="col-sm-3 control-label">Title :</label>

                                <div class="col-sm-8 controls">

                                  <input type="text" value="" id="title" placeholder="Please enter title.." name="title" class="input-border-btm">

                                 </div>

                              </div>

                              <div class="form-group">

                                <label class="col-sm-3 control-label">Heading :</label>

                                <div class="col-sm-8 controls">

                                  <input class="input-border-btm" type="text" id="heading" placeholder="Please enter heading.." value="" name="heading" >

                              </div>

                             </div>

                             <div class="form-group">

                                <label class="col-sm-3 control-label">URL :</label>

                                <div class="col-sm-8 controls">                               

                                  <div class="row">

                                    <div class="col-md-6">

                                      <input type="text" readonly="" value="<?php echo front_base_url(); ?>" class="input-border-btm">

                                      <span class="help-block">Base URL</span>                              

                                    </div>

                                    <div class="col-md-6">

                                      <input type="text" value="" name="url" id="url" placeholder="Please enter url.." class="input-border-btm">

                                      <span class="help-block text-center">Enter URL</span>                 

                                    </div>

                                  </div>                        

                                </div>

                             </div>

                             <div class="form-group">

                               <label class="col-sm-3 control-label">Meta Description :</label>

                               <div class="col-sm-8 controls">                             

                                 <input type="text" value="" id="meta_desc" placeholder="Please enter Meta Description.." name="meta_desc" class="input-border-btm">

                                </div>

                             </div>

                             <div class="form-group">

                               <label class="col-sm-3 control-label">Description :</label>

                               <div class="col-sm-8 controls">

                                  <textarea name="description" id="description" placeholder="Please enter description.." class="input-border-btm" value="">

                                  </textarea> 

                                  <input type="hidden" id="id" name="id">                                

                                </div>

                             </div>

                             <div class="form-group">

                               <label class="col-sm-3 control-label">Meta Keywords :</label>

                               <div class="col-sm-8 controls">

                                 <input type="text" value="" id="keywords" placeholder="Please enter keywords.." name="keywords" class="input-border-btm">

                                </div>

                             </div> 

                             <div class="modal-footer background-login">

                               <input type="submit" class="btn vd_btn vd_bg-green"  id="saveCms" value="save">

                             </div>                          

                            </form>

                          </div>

                           

                        </div>

                      </div>

                    </div>

                    <div class="modal fade" id="myAlbumModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                     <div class="modal-dialog" style="width: 72%">

                       <div class="modal-content">

                         <div class="modal-header vd_bg-blue vd_white">

                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

                           <h4 class="modal-title" id="myModalLabel"></h4>

                         </div>

                         <div class="modal-body">                               

                            <div class="row">

                              <div class="col-md-12">

                                <div class="panel widget light-widget panel-bd-top">

                                  <div class="panel-body" style="max-height: 400px;overflow-y: scroll;">

                                  </div>

                                </div>

                               </div>                      

                            </div> 

                          </div>

                        </div>

                     </div>

                    </div>

                    <form action="<?php echo base_url();?>cms_page/multiselect_action" method="post" name="myform" id="myform">

                        <table class="table table-striped" id="data-tables">

                          <thead>

                            <tr>

                              <th></th>

                              <th><div class="vd_checkbox checkbox-success" style="margin-left: 5px;"><input type="checkbox" class="case" id="check"><label for="check"> </label></div></th>

                              <th>Title</th>

                              <th>Url</th>

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

<!-- .content -->



