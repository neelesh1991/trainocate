</div>

<!-- .vd_body END  -->

<a id="back-top" href="javascript:void(0);" data-action="backtop" class="vd_back-top visible themeColor"> <i class="fa  fa-angle-up"> </i> </a>

<!--

<a class="back-top" href="javascript:void(0);" id="back-top"> <i class="icon-chevron-up icon-white"> </i> </a> -->

<!-- Javascript =============================================== -->

<!-- Placed at the end of the document so the pages load faster -->

<?php

      $jsArray=array('jquery.js',

                        'bootstrap.min.js',

                        'theme.js','modernizr.js','mobile-detect.min.js','mobile-detect-modernizr.js');

  if($page_name == 'dashboard_view')

  {

        $jsArray[]='caroufredsel.js';

        $jsArray[]='plugins.js';

  }

      $this->minify->js($jsArray);

      echo $this->minify->deploy_js($rebuild);

  $this->load->view('common/additional_js');

 ?>

 <script type="text/javascript">

   $(document).ready(function() {

     function setHeight() {

      //console.log($(window).innerHeight());

       windowHeight = $(window).innerHeight()-106;

       $('.vd_content-wrapper, .vd_content-wrapper > .vd_container').css('min-height', windowHeight);

     };

     setHeight();



     $(window).resize(function() {

       setHeight();

     });

   });

 </script>

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/breakpoints/breakpoints.js"></script>

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/prettyPhoto-plugin/js/jquery.prettyPhoto.js"></script>

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/blockUI/jquery.blockUI.js"></script>

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/pnotify/js/jquery.pnotify.min.js"></script>

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.min.js"></script>

 <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.resize.min.js"></script> -->

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.pie.min.js"></script>

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.categories.min.js"></script>

 <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.time.min.js"></script> -->

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.animator.min.js"></script>

 <!-- Vector Map -->

 <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->

 <!-- Calendar -->

 <script type="text/javascript" src='<?php echo base_url();?>assets/plugins/moment/moment.min.js'></script>

  <script type="text/javascript" src='<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.custom.min.js'></script>

  <script type="text/javascript" src='<?php echo base_url();?>assets/plugins/fullcalendar/fullcalendar.min.js'></script>

 <!-- Intro JS (Tour) -->

 <script type="text/javascript" src='<?php echo base_url();?>assets/plugins/introjs/js/intro.min.js'></script>

 <!-- Sky Icons -->

<!--  <script type="text/javascript" src='<?php echo base_url();?>assets/plugins/skycons/skycons.js'></script> -->

 <script>

       $('#photo1').change(function(){

         var input = $('#photo1')[0];

         if (input.files && input.files[0]) {

           var reader = new FileReader();

           reader.onload = function (e) {

             $('#blahOne').attr('src', e.target.result);

           }

           reader.readAsDataURL(input.files[0]);

         }

       });

   </script>

   <script>

         var btnCust = '';

         var dimg = $('#getImg').val();

         $("#photo1").fileinput({

         overwriteInitial: true,

         maxFileSize: 1500,

         showClose: false,

         showCaption: false,

         browseLabel: '',

         removeLabel: '',

         browseIcon: '<i class="glyphicon glyphicon-plus" ></i>',

         removeIcon: '<i class="glyphicon glyphicon-remove"></i>',

         removeTitle: 'Cancel or reset changes',

         elErrorContainer: '#kv-avatar-errors-1',

         msgErrorClass: 'alert alert-block alert-danger',

         defaultPreviewContent: '<img src="'+dimg+'" id="blahOne" alt="profile" style="width:160px">',

            layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},

            allowedFileExtensions: ["jpg", "png", "gif","jpeg"]

            });

       </script>

       <script type="text/javascript">

         $(document).ready(function() {

               "use strict";

                   var form_register = $('#editAdminModel');

                   var error_register = $('.alert-danger', form_register);

                   var success_register = $('.alert-success', form_register);

                   form_register.validate({

                       errorElement: 'div', //default input error message container

                       errorClass: 'vd_red', // default input error message class

                       focusInvalid: false, // do not focus the last invalid input

                       ignore: "",

                       rules: {
                           name: {
                               minlength: 3,
                               required: true
                           },

                           email: {
                              email: true,
                               required: true
                           },

                           photo1: {
                                required: true
                           },
                           contact: {
                                required: true,
                                number:true,
                                maxlength:10


                           },



                       },

                       messages: {

                         name: "Please enter your Name",
                         email: "Please enter a valid email Id",
                         contact: "Please enter a valid contact number",
                         photo1: "Please upload your profile pictur",



                       },

                       errorPlacement: function(error, element) {

                         if (element.parent().hasClass("vd_checkbox") || element.parent().hasClass("vd_radio")){

                           element.parent().append(error);

                         } else if (element.parent().hasClass("vd_input-wrapper")){

                           error.insertAfter(element.parent());

                         }else {

                           error.insertAfter(element);

                         }

                       },

                       invalidHandler: function (event, validator) { //display error alert on form submit

                     success_register.fadeOut(500);

                     error_register.fadeIn(500);

                     scrollTo(form_register,-100);

                       },

                       highlight: function (element) { // hightlight error inputs

                       $(element).addClass('vd_bd-red');

                       $(element).siblings('.help-inline').removeClass('help-inline fa fa-check vd_green mgl-10');

                       },

                       unhighlight: function (element) { // revert the change dony by hightlight

                           $(element)

                               .closest('.control-group').removeClass('error'); // set error class to the control group

                       },

                       success: function (label, element) {

                           label

                               .addClass('valid').addClass('help-inline fa fa-check vd_green mgl-10') // mark the current input as valid and display OK icon

                             .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group

                          $(element).removeClass('vd_bd-red');

                       },

                       submitHandler: function (form) {

                         success_register.fadeIn(500);

                         error_register.fadeOut(500);

                         scrollTo(form_register,-100);

                         $("#submitAdmin").attr("disabled", "disabled");

                         editAdminModelSubmit();

                       }

                   });

         });

         </script>

        <script type="text/javascript">

          $(document).ready(function() {

                "use strict";

                    var form_register = $('#changeAdminPassword');

                    var error_register = $('.alert-danger', form_register);

                    var success_register = $('.alert-success', form_register);

                    form_register.validate({

                        errorElement: 'div', //default input error message container

                        errorClass: 'vd_red', // default input error message class

                        focusInvalid: false, // do not focus the last invalid input

                        ignore: "",

                        rules: {

                            Admin_old_password: {

                                 required: true

                            },

                            Admin_new_password: {

                                 required: true

                            },

                        },

                        messages: {

                          Admin_old_password: "Please Enter Old Password",

                          Admin_new_password: "Please Enter New Password",

                        },

                        errorPlacement: function(error, element) {

                          if (element.parent().hasClass("vd_checkbox") || element.parent().hasClass("vd_radio")){

                            element.parent().append(error);

                          } else if (element.parent().hasClass("vd_input-wrapper")){

                            error.insertAfter(element.parent());

                          }else {

                            error.insertAfter(element);

                          }

                        },

                        invalidHandler: function (event, validator) { //display error alert on form submit

                      success_register.fadeOut(500);

                      error_register.fadeIn(500);

                      scrollTo(form_register,-100);

                        },

                        highlight: function (element) { // hightlight error inputs

                        $(element).addClass('vd_bd-red');

                        $(element).siblings('.help-inline').removeClass('help-inline fa fa-check vd_green mgl-10');

                        },

                        unhighlight: function (element) { // revert the change dony by hightlight

                            $(element)

                                .closest('.control-group').removeClass('error'); // set error class to the control group

                        },

                        success: function (label, element) {

                            label

                                .addClass('valid').addClass('help-inline fa fa-check vd_green mgl-10') // mark the current input as valid and display OK icon

                              .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group

                           $(element).removeClass('vd_bd-red');

                        },

                        submitHandler: function (form) {

                          success_register.fadeIn(500);

                          error_register.fadeOut(500);

                          scrollTo(form_register,-100);

                          $("#submitAdmin").attr("disabled", "disabled");

                          changePasswordSubmit();

                        }

                    });

          });

          </script>

       <script>

        function editAdminModelSubmit(){

          var formData = new FormData($('#editAdminModel')[0]);

          console.log(formData);

          var pageurl_new = '<?php echo base_url();?>'+'tenant/editAdminProfile';

            $.ajax({

                       url: pageurl_new,

                       type: 'POST',

                       data: formData,

                       processData: false,

                       contentType: false,

                   }).done(function(responce)

                    {
                      var data = jQuery.parseJSON(responce);
                      if(data.status=='success')
                      {
                        $('#editAdminModel').find("input[type=text]").val("");
                         notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                        window.location.href = '<?php echo base_url(uri_string());?>';
                      }
                      else
                      {
                          if(data.status == 'fail')
                           {
                              notification("topright","error","fa fa-exclamation-circle vd_red","Error",data.message);
                               $('#submitAdmin').prop("disabled", false);
                           }
                          else
                          {
                                  $.each(data.errorfields, function()
                                  {
                                      $.each(this, function(name, value)
                                      {

                                          $('[name*="'+name+'"]').parent().after('<div class="vd_red error-msg">'+value+'</div>');

                                      });

                                  });
                                  $('#submitAdmin').prop("disabled", false);
                          }

                      }

                     // window.location.href = '<?php echo base_url(uri_string());?>';

                 });

            }

          </script>



       <script>

        function changePasswordSubmit(){

          var formData = new FormData($('#changeAdminPassword')[0]);

          console.log(formData);

          var pageurl_new = '<?php echo base_url();?>'+'tenant/changePasswordSubmit';

            $.ajax({

                       url: pageurl_new,

                       type: 'POST',

                       data: formData,

                       processData: false,

                       contentType: false,

                   }).done(function(responce)
                    {
                     var data = jQuery.parseJSON(responce);
                     if(data.status=='success')
                     {
                             $('#changeAdminPassword').find("input[type=text]").val("");
                            notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                             window.location.href = '<?php echo base_url(uri_string());?>';
                     }
                          if(data.status == 'fail')
                           {
                              notification("topright","error","fa fa-exclamation-circle vd_red","Error",data.message);
                               $('#submitAdminpass').prop("disabled", false);
                           }
                          else
                          {
                                  $.each(data.errorfields, function()
                                  {
                                      $.each(this, function(name, value)
                                      {

                                          $('[name*="'+name+'"]').parent().after('<div class="vd_red error-msg">'+value+'</div>');

                                      });

                                  });
                                  $('#submitAdminpass').prop("disabled", false);
                          }

                 });

            }

          </script>





     <script type="text/javascript">

       $(document).ready(function() {

                 var form_register = $('#changeAdminPassword');

                 var error_register = $('.alert-danger', form_register);

                 var success_register = $('.alert-success', form_register);

                 var validate =form_register.validate({

                     errorElement: 'div', //default input error message container

                     errorClass: 'vd_red', // default input error message class

                     focusInvalid: false, // do not focus the last invalid input

                     ignore: "",

                     rules: {



                         Admin_old_password: {

                              required: true

                         },

                         Admin_new_password: {

                              required: true

                         },

                     },

                     messages: {



                       Admin_old_password: "Please Enter Old Password",

                       Admin_new_password: "Please Enter New Password",

                     },

                     errorPlacement: function(error, element) {

                       if (element.parent().hasClass("vd_checkbox") || element.parent().hasClass("vd_radio")){

                         element.parent().append(error);

                       } else if (element.parent().hasClass("vd_input-wrapper")){

                         error.insertAfter(element.parent());

                       }else {

                         error.insertAfter(element);

                       }

                     },

                     invalidHandler: function (event, validator) { //display error alert on form submit

                   success_register.fadeOut(500);

                   error_register.fadeIn(500);

                   scrollTo(form_register,-100);

                     },

                     highlight: function (element) { // hightlight error inputs

                     $(element).addClass('vd_bd-red');

                     $(element).siblings('.help-inline').removeClass('help-inline fa fa-check vd_green mgl-10');

                     },

                     unhighlight: function (element) { // revert the change dony by hightlight

                         $(element)

                             .closest('.control-group').removeClass('error'); // set error class to the control group

                     },

                     success: function (label, element) {

                         label

                             .addClass('valid').addClass('help-inline fa fa-check vd_green mgl-10') // mark the current input as valid and display OK icon

                           .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group

                        $(element).removeClass('vd_bd-red');

                     },

                     submitHandler: function (form) {

                       success_register.fadeIn(500);

                       error_register.fadeOut(500);

                       scrollTo(form_register,-100);

                       changePasswordSubmit();

                     }

                 });





               /*  $('#editProf').click(function() {



                  document.getElementById('editAdminModel').reset();

                  $('#editAdminModel').find('input').removeClass('vd_bd-red');

                  validate.resetForm();

                 });*/



                 $('#changePass').click(function() {

                   document.getElementById('changeAdminPassword').reset();

                   $('#changeAdminPassword').find('input').removeClass('vd_bd-red');

                      validate.resetForm();

                 });

                 $(".modal").on("hidden.bs.modal", function () {
                     $('input[value="Submit"]').removeAttr('disabled');
                     $('#id').val('');
                     if (typeof importTags !== 'undefined' && $.isFunction(importTags)) {
                        $('#input-autocomplete').importTags('');
                     }

                 });

                <?php if($page_name != 'login_view'){ ?>
                                 $('.modal').on('shown.bs.modal', function (e) {
                                $( document ).ajaxStart(function() {
                                                  $('.modal').block({ message: '<div class="processing"><img src="<?php echo base_url();?>assets/img/giphy.gif"></div>' });
                                                  $('.blockMsg').css('border','none');
                                          });
                                        $(document).ajaxStop(function() {$('.modal').unblock();});
                          })
                <?php } ?>

       });

       </script>



          <script type="text/javascript">

          function remove_Notification_Count()

            {

              $('#notification_count_remove').hide();

           $.ajax({

              url: '<?php echo base_url();?>admin/remove_Notification_Count',

              type: 'POST',

              success:function(data)

              {

              }

            })

            }

          </script>

  <script>

     function Set_tenantId(element)

     {

      var Id=$(element).val();

     // console.log(Id);

      $.ajax({

            type: "POST",

            data:{Id:Id},

            url:ajax_base_url+"tenant/Set_tenantId",

            success:function(data)

            {

              if(data==1)

              {

               window.location.href = '<?php echo base_url(uri_string());?>';

              }

          }

          });

     }

  </script>



 </body>

</html>