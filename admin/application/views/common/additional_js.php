    <?php if($page_name == 'dashboard_view'){;

     ?>

  <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/raphael/raphael.min.js"></script>



   <?php } ?>

  <?php if($page_name == 'login_view'){;?>

   <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins.js"></script>

   <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

   <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

   <script type="text/javascript">

     $(document).ready(function() {

             "use strict";

             var form_register_2 = $('#login-form');

             var error_register_2 = $('.alert-danger', form_register_2);

             var success_register_2 = $('.alert-success', form_register_2);

             form_register_2.validate({

                 errorElement: 'div', //default input error message container

                 errorClass: 'vd_red', // default input error message class

                 focusInvalid: false, // do not focus the last invalid input

                 ignore: "",

                 rules: {

                     email: {

                         required: true,

                         email: true

                     },

                     password: {

                         required: true,

                         minlength: 2

                     },

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

                     success_register_2.hide();

                     error_register_2.show();

                 },

                 highlight: function (element) { // hightlight error inputs

                     $(element).addClass('vd_bd-red');

                     $(element).parent().siblings('.help-inline').removeClass('help-inline hidden');

                     if ($(element).parent().hasClass("vd_checkbox") || $(element).parent().hasClass("vd_radio")) {

                         $(element).siblings('.help-inline').removeClass('help-inline hidden');

                     }

                 },

                 unhighlight: function (element) { // revert the change dony by hightlight

                     $(element)

                         .closest('.control-group').removeClass('error'); // set error class to the control group

                 },

                 success: function (label, element) {

                                    label

                         .addClass('valid').addClass('help-inline hidden') // mark the current input as valid and display OK icon

                         .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group

                     $(element).removeClass('vd_bd-red');

                 },

                 submitHandler: function (form) {

                   $('.fa-spinner').remove();

                   $(form).find('#login-submit').prepend('<i class="fa fa-spinner fa-spin mgr-10"></i>');

                     submitForm();

                 }

             });

     });

   </script>

   <script>

     function submitForm(){

                      BASEURL='<?php echo base_url();?>';

                                 $('#login-submit').prop("disabled", true);

                                 var form_register_2 = $('#login-form');

                                 var error_register_2 = $('.alert-danger', form_register_2);

                                 var success_register_2 = $('.alert-success', form_register_2);

                                 var formData = $( "#login-form" ).serialize();

                                 $.ajax({

                                     url: BASEURL+"login",

                                     type: 'POST',

                                     data:  formData

                                 }).done(function(responce)

                                  {

                                           $('.fa-spinner').remove();

                                             var data = jQuery.parseJSON(responce);

                                             if(data.status=='error')

                                             {

                                                 $.each(data.errorfields, function()

                                                 {

                                                     $.each(this, function(name, value)

                                                     {

                                                         $('[name*="'+name+'"]').parent().after('<div class="vd_red">'+value+'</div>');

                                                     });

                                                 });

                                                 $('#login-submit').prop("disabled", false);

                                             }

                                             else

                                             {

                                                 if(data.status=='success')

                                                 {

                                                         $('.alert-success').show();

                                                         $('.alert-danger').hide();

                                                         $('.alert-success').html('<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="icon-cross"></i></button><span class="vd_alert-icon"><i class="fa fa-check-circle append-icon"></i></span><strong>Well done! </strong>'+data.message+'. ');

                                                         document.getElementById("login-form").reset();

                                                         window.location.href = BASEURL+'dashboard';

                                                 }

                                                 else

                                                 {

                                                     if(data.status == 'fail')

                                                     {

                                                         $('.alert-danger').html('<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="icon-cross"></i></button><span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oh snap! </strong>'+data.message+'. ');

                                                         $('.fa-spinner').remove();

                                                         success_register_2.hide();

                                                         error_register_2.show();

                                                         $('#login-submit').prop("disabled", false);

                                                     }

                                                     else

                                                     {

                                                         $('.fa-spinner').remove();

                                                         success_register_2.hide();

                                                         error_register_2.show();

                                                         $('#login-submit').prop("disabled", false);

                                                     }

                                                   }

                                             }

                                 }).fail(function( jqXHR, textStatus ) {

                                     alert( "Request failed: " + textStatus );

                                       $('#login-submit').prop("disabled", false);

                                 });

     }

   </script>

   <?php } ?>

   <?php if($page_name == 'tenant/manage_tenant_view'){;?>

       <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

       <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

       <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>

       <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

       <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

       <script type="text/javascript" src="<?php echo base_url();?>assets/js/jscolor.js"></script>

       <script>

         $('#createNew').click(function() {

          $('#manageTenant').find("input[type=text]").val("");

         });

       </script>

       <script>

         var btnCust = '';

         $("#logo").fileinput({

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

         <?php

         if(!empty($name_profile['logo']))

         {?>

             defaultPreviewContent: '<img src="file_upload_base_url()/'.<?php echo $name_profile['id'];?>.'/logo/thumbs/<?php echo $name_profile['logo']?>" id="blah" alt="profile" style="width:160px">',

         <?php

         }

         else

         {

         ?>

             defaultPreviewContent: '<img src="<?php echo base_url();?>assets/img/defult_logo.jpg" id="blah" style="width:160px">',

         <?php } ?>

       layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},

       allowedFileExtensions: ["jpg", "png", "gif","jpeg"]

       });

       </script>

       <script>

         var btnCust = '';

         $("#logoEdit").fileinput({

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

         <?php

         if(!empty($name_profile['logo']))

         {?>

             defaultPreviewContent: '<img src="file_upload_base_url()/'.<?php echo $name_profile['id'];?>.'/logo/thumbs/<?php echo $name_profile['logo']?>" id="blahEdit" alt="profile" style="width:160px">',

         <?php

         }

         else

         {

         ?>

             defaultPreviewContent: '<img src="<?php echo base_url();?>assets/img/defult_logo.jpg" id="blahEdit" style="width:160px">',

         <?php } ?>

       layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},

       allowedFileExtensions: ["jpg", "png", "gif","jpeg"]

       });

       </script>

       <script>

             $('#logo').change(function(){

               var input = $('#logo')[0];

               if (input.files && input.files[0]) {

                 var reader = new FileReader();

                 reader.onload = function (e) {

                   $('#blah').attr('src', e.target.result);

                 }

                 reader.readAsDataURL(input.files[0]);

               }

             });

             $('#logoEdit').change(function(){

               var input = $('#logoEdit')[0];

               if (input.files && input.files[0]) {

                 var reader = new FileReader();

                 reader.onload = function (e) {

                   $('#blahEdit').attr('src', e.target.result);

                 }

                 reader.readAsDataURL(input.files[0]);

               }

             });

         </script>

       <script>

         $('.datepicker').datepicker();

       </script>

       <script type="text/javascript">

         $(document).ready(function() {

               "use strict";

                   var form_register = $('#manageTenant');

                   var error_register = $('.alert-danger', form_register);

                   var success_register = $('.alert-success', form_register);

                   form_register.validate({

                       errorElement: 'div', //default input error message container

                       errorClass: 'vd_red', // default input error message class

                       focusInvalid: false, // do not focus the last invalid input

                       ignore: "",

                       rules: {

                           name: {

                               required: true

                           },
                           admin_name: {

                               required: true

                           },

                           email: {

                               required: true,

                               email:true

                           },

                           url: {

                               required: true



                           },
                           time_zone:{
                              // required: true

                           },
                           logo:{
                               required: true

                           },
                           address:{
                               required: true

                           },
                           contact:{
                               required: true,
                               digits:true,


                           },

                            home_box1_name:{
                               required: true

                           },
                            home_box1_url:{
                               required: true

                           },
                            home_box1_color:{
                               required: true

                           },

                            home_box2_name:{
                               required: true

                           },
                            home_box2_url:{
                               required: true

                           },
                            home_box2_color:{
                               required: true

                           },

                            home_box3_name:{
                               required: true

                           },
                            home_box3_url:{
                               required: true

                           },
                            home_box3_color:{
                               required: true

                           },

                       },

                       messages: {

                         name: "Please enter tenant Name",
                         admin_name: "Please enter admin name for this tenant",
                         email: "Please enter admin email for this tenant",

                         email: "Please enter valid email id",
                         address: "Please enter address",
                         //contact: "Please enter contact",
                       //  contact: "Only digits are allowed",
                         //contact: "contact number must be 10 digit",
                         logo: "Please select Logo",
                         home_box1_name: "Name is required",
                         home_box1_url: "URL is required",
                         home_box1_color: "Color is required",
                          home_box2_name: "Name is required",
                         home_box2_url: "URL is required",
                         home_box2_color: "Color is required",
                          home_box3_name: "Name is required",
                         home_box3_url: "URL is required",
                         home_box3_color: "Color is required",


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

                         $("#submitTenant").attr("disabled", "disabled");

                         manageTenantSubmit();

                       }

                   });

         });

         </script>

         <script type="text/javascript">

           $(document).ready(function() {

                 "use strict";

                     var form_register = $('#manageTenantEdit');

                     var error_register = $('.alert-danger', form_register);

                     var success_register = $('.alert-success', form_register);

                     form_register.validate({

                         errorElement: 'div', //default input error message container

                         errorClass: 'vd_red', // default input error message class

                         focusInvalid: false, // do not focus the last invalid input

                         ignore: "",

                         rules: {

                             name: {

                                 required: true

                             },

                             header_color: {

                                 required: true

                             },


                            home_box1_name:{
                               required: true

                           },
                            home_box1_url:{
                               required: true

                           },
                            home_box1_color:{
                               required: true

                           },

                            home_box2_name:{
                               required: true

                           },
                            home_box2_url:{
                               required: true

                           },
                            home_box2_color:{
                               required: true

                           },

                            home_box3_name:{
                               required: true

                           },
                            home_box3_url:{
                               required: true

                           },
                            home_box3_color:{
                               required: true

                           },

                         },

                         messages: {

                           name: "Please enter tenant Name",

                           header_color: "Please select header color for this tenant",
                            home_box1_name: "Name is required",
                         home_box1_url: "URL is required",
                         home_box1_color: "Color is required",

                         home_box2_name: "Name is required",
                         home_box2_url: "URL is required",
                         home_box2_color: "Color is required",

                          home_box3_name: "Name is required",
                         home_box3_url: "URL is required",
                         home_box3_color: "Color is required",

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

                           $("#submitTenant").attr("disabled", "disabled");

                           manageTenantSubmitEdit();

                         }

                     });

           });

           </script>

      <script>

       function manageTenantSubmit()

       {

         var formData = new FormData($('#manageTenant')[0]);

         //console.log(formData);

         var pageurl_new = ajax_base_url+'tenant/add';

           $.ajax({

                      url: pageurl_new,

                      type: 'POST',

                      data: formData,

                      processData: false,

                      contentType: false,

                  }).done(function(responce)

                   {

                        // window.location.href = ajax_base_url+'tenant';

                        var data = jQuery.parseJSON(responce);

                        if(data.status=='success')

                        {

                          $('#manageTenant').find("input[type=text]").val("");
                          notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                           var dTable = $('#data-tables').DataTable();
                            dTable.ajax.reload();
                            $('#myModal').modal('toggle');

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

                              $('#submitTenant').prop("disabled", false);

                        }

                   });

       }

       function manageTenantSubmitEdit()

       {

         var formData = new FormData($('#manageTenantEdit')[0]);

         //console.log(ajax_base_url);

         var pageurl_new = ajax_base_url+'tenant/edit';

           $.ajax({

                      url: pageurl_new,

                      type: 'POST',

                      data: formData,

                      processData: false,

                      contentType: false,

                  }).done(function(responce)

                   {

                         //window.location.href = ajax_base_url+'tenant';

                       var data = jQuery.parseJSON(responce);

                       if(data.status=='success')

                       {

                         $('#manageTenant').find("input[type=text]").val("");
                         notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                         var dTable = $('#data-tables').DataTable();
                          dTable.ajax.reload();
                          $('#myModalEdit').modal('toggle');

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

                             $('#submitTenant').prop("disabled", false);

                       }

                   });

       }

        function edit_tenant(tenantId)

        {

             var pageurl_new = ajax_base_url+'tenant/edit_tenant/'+tenantId;

             $.ajax({

                url: pageurl_new,

             }).done(function(responce)

             {

                  if (!$.isEmptyObject(responce))

                  {

                     $('#myModalEdit').modal('toggle');

                     var data = jQuery.parseJSON(responce);

                     $('[name*="id"]').val(data.id);

                     $('[name*="url"]').val(data.url);

                     $('[name*="name"]').val(data.name);
                     $('[name*="timezone"]').val(data.timezone);
                     $('[name*="header_color"]').val(data.header_color);
                     $('[name*="address"]').val(data.address);

                     $('[name*="home_box1_name"]').val(data.home_box1_name);
                     $('[name*="home_box1_url"]').val(data.home_box1_url);
                     $('[name*="home_box1_color"]').val(data.home_box1_color);

                      $('[name*="home_box2_name"]').val(data.home_box2_name);
                     $('[name*="home_box2_url"]').val(data.home_box2_url);
                     $('[name*="home_box2_color"]').val(data.home_box2_color);

                     $('[name*="home_box3_name"]').val(data.home_box3_name);
                     $('[name*="home_box3_url"]').val(data.home_box3_url);
                     $('[name*="home_box3_color"]').val(data.home_box3_color);

                     $('[name*="email_postfix"]').val(data.email_postfix);
                     
                     var $radios = $('input:radio[name=signup_permission]');
                     if($radios.is(':checked') === false)
                     {
                         $radios.filter('[value='+data.signup_permission+']').prop('checked', true);
                     }
                     else
                     {
                       $radios.filter('[value='+data.signup_permission+']').attr('checked', true);
                     }


                     var $radios1 = $('input:radio[name=bind_email]');
                     if($radios1.is(':checked') === false)
                     {
                         $radios1.filter('[value='+data.bind_email+']').prop('checked', true);
                     }
                     else
                     {
                       $radios1.filter('[value='+data.bind_email+']').attr('checked', true);
                     }

                     var $radios2 = $('input:radio[name=bind_organization]');
                     if($radios2.is(':checked') === false)
                     {
                         $radios2.filter('[value='+data.bind_organization+']').prop('checked', true);
                     }
                     else
                     {
                       $radios2.filter('[value='+data.bind_organization+']').attr('checked', true);
                     }

                     if(data.logo=='')

                     {

                       $("#manageTenantEdit #blahEdit").attr('src', '<?php echo base_url();?>assets/img/defult_logo.jpg');

                     }

                     else

                     {

                       $("#manageTenantEdit #blahEdit").attr('src', '<?php echo file_upload_base_url();?>'+data.id+'/logo/thumbs/'+data.logo);

                     }

                  }

             });

         }

       </script>

         <script type="text/javascript" language="javascript" >

           function format ( d )

           {

                  return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                   '<div class="panel-heading"> </div>'+

                   '<div class="panel-body">'+

                           '<span style="font-size:20px;font-weight:bold;">Tenant Details</span><br><br>'+

                           '<div class="row mgbt-xs-10">'+

                             '<div class="col-xs-5 text-right"> <strong>Tenant Info:</strong> </div>'+

                             '<div class="col-xs-7">'+d.info+'</div>'+

                           '</div>'+

                           '<div class="row mgbt-xs-10">'+
                             '<div class="col-xs-5 text-right"> <strong>Admin Name:</strong> </div>'+
                             '<div class="col-xs-7">'+d.admin_name+'</div>'+
                           '</div>'+
                           '<div class="row mgbt-xs-10">'+
                             '<div class="col-xs-5 text-right""> <strong>Admin Email:</strong> </div>'+
                             '<div class="col-xs-7">'+d.email+'</div>'+
                           '</div>'+
                           '<div class="row mgbt-xs-10">'+
                             '<div class="col-xs-5 text-right"> <strong>URL:</strong> </div>'+
                             '<div class="col-xs-7">'+d.url+'</div>'+

                           '</div>'+

                           '<div class="row mgbt-xs-10">'+

                             '<div class="col-xs-5 text-right" onclick="change_status()"> <strong>Status:</strong> </div>'+

                             '<div class="col-xs-7">'+d.status+'</div>'+

                           '</div>'+

                           '<div class="row mgbt-xs-10">'+

                             '<div class="col-xs-5 text-right"> <strong>Header Color:</strong> </div>'+

                             '<div class="col-xs-7"><span style="width:20px;height:15px;background:#'+d.header_color+'">'+d.header_color+'</span></div>'+

                           '</div>'+

                         '</div></div></div>';

           }

           $(document).ready(function() {

           var dt = $('#data-tables').DataTable( {

              oLanguage: {

                       sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

                },

                "iDisplayLength": 25,

                "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

               "processing": true,

               "serverSide": true,

               "ajax": ajax_base_url+"tenant/getAjaxdataObjects",

               "columns": [

                   {

                       "class":          "details-control",

                       "orderable":      false,

                       "data":           null,

                       "defaultContent": ""

                   },

                   { "data": "chk" },

                   { "data": "info" },

                   { "data": "url" },

                   { "data": "status" },

                   { "data": "created" },

                   { "data": "action" }

               ],

               "order": [],

                columnDefs: [

                  { orderable: true, targets: [3,4] },

                  { orderable: false, targets: [-1,0,1,2] },

                  { "width": "5%", "targets": [0,1] },

                  { "width": "10%", "targets": [4]},

                  { "width": "15%", "targets": [-1,3]},

                  { "width": "25%", "targets": [2,5]}

               ],

             "fnDrawCallback": function (oSettings) {

                  nbr=0;

                       $(".details-control").each(function()

                       {

                           if(nbr > 0)

                           {

                               $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                           }

                           nbr++;

                       });

                       $('tbody').css('border', '1px solid #eee');

            }

           } );

           // Array to track the ids of the details displayed rows

           var detailRows = [];

           $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

               var tr = $(this).closest('tr');

               var row = dt.row( tr );

               var idx = $.inArray( tr.attr('id'), detailRows );

               if ( row.child.isShown() ) {

                   $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                   tr.removeClass( 'details' );

                   row.child.hide();

                   // Remove from the 'open' array

                   detailRows.splice( idx, 1 );

               }

               else {

                   $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                   tr.addClass( 'details' );

                   row.child( format( row.data() ) ).show();

                   // Add to the 'open' array

                   if ( idx === -1 ) {

                       detailRows.push( tr.attr('id') );

                   }

               }

           } );

           // On each draw, loop over the `detailRows` array and show any child rows

           dt.on( 'draw', function () {

               $.each( detailRows, function ( i, id ) {

                   $('#'+id+' td.details-control').trigger( 'click' );

               } );

           } );

       } );

      function change_status(userId,status)

        {

              var done = confirm("Are you sure, you want to change the status?");

              if(done == true)

              {

                  var pageurl_new = ajax_base_url+'tenant/change_status/'+userId+'/'+status;

                  window.location.href = pageurl_new;

              }

              else

              {

                  return false;

              }

        }

       function delete_confirm(id)

       {

             var done = confirm("Are you sure to delete this record");

             if(done == true)

             {

                 var pageurl_new = ajax_base_url+'tenant/delete_confirm/'+id;

                 window.location.href = pageurl_new;

             }

             else

             {

                 return false;

             }

       }

      function validateForm()

         {

               total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

               if(total==0)

               {

                   alert("Please select checkbox.");

                   return false;

               }

               var listBoxSelection=document.getElementById("listaction").value;

               if(listBoxSelection==0)

               {

                   alert("Please select Action");

                   return false;

               }

               else

                     if(listBoxSelection == 3){

                     var done = confirm("Are you sure, you want to delete record's from database?");

                     if(done == true){

                       return true;

                     }

                     else

                     {

                       return false;

                     }

               }

         }

       $(document).ready(function()

       {

          $(".case").click(function(){

           var checked_status = this.checked;

           $("#myform input[type=checkbox]").each(function(){

             this.checked = checked_status;

           });

          });

       });

       </script>

      <?php } ?>

   <?php if($page_name == 'user/manage_user_view'){;?>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>



    <script>

    $(document).ready(function() {

      $('#addU').click(function() {

        document.getElementById('AddUser').reset();

        $('#AddUser').find('input').removeClass('vd_bd-red');

        var validator1 = $( "#AddUser" ).validate();

          validator1.resetForm();

         });

      });

    </script>



      <script>

        var btnCust = '';

        $("#photo").fileinput({

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

        <?php

        if(!empty($name_profile['photo']))

        {?>

            defaultPreviewContent: '<img src="file_upload_base_url();<?php echo $name_profile['photo']?>" id="blah" alt="profile" style="width:160px">',

        <?php

        }

        else

        {

        ?>

            defaultPreviewContent: '<img src="<?php echo front_base_url();?>assets/img/u.png" id="blah" style="width:160px">',

        <?php } ?>

      layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},

      allowedFileExtensions: ["jpg", "png", "gif","jpeg"]

      });

      </script>

      <script>

            $('#photo').change(function(){

              var input = $('#photo')[0];

              if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function (e) {

                  $('#blah').attr('src', e.target.result);

                }

                reader.readAsDataURL(input.files[0]);

              }

            });

        </script>



      <script type="text/javascript">

        $(document).ready(function() {

              "use strict";

                  var form_register = $('#AddUser');

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



                          email_id: {

                               email: true,

                               required: true

                          },

                      },

                      messages: {

                        name: "Please enter your Name",

                        email_id: "Please enter Valid Email Id",



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

                        $("#submitUser").attr("disabled", "disabled");

                        userSubmit();

                      }

                  });

        });

        </script>

     <script>

      function userSubmit(){

        var formData = new FormData($('#AddUser')[0]);

        var pageurl_new = ajax_base_url+'users/add';

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

                        $('#AddUser').find("input[type=text]").val("");
                        notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                        var dTable = $('#data-tables').DataTable();
                         dTable.ajax.reload();
                         $('#addUser').modal('toggle');

                      }

                      else

                      {

                            $.each(data.errorfields, function()

                            {

                                $.each(this, function(name, value)

                                {

                                    $('[name*="'+name+'"]').parent().after('<div class="vd_red">'+value+'</div>');

                                });

                            });

                            $('#submitUser').prop("disabled", false);

                      }

               });

          }



    function edit_user(userId)

    {

         var pageurl_new = ajax_base_url+'users/edit_user/'+userId;

         $.ajax({

            url: pageurl_new,

         }).done(function(responce)

         {

          if (!$.isEmptyObject(responce))

          {

             $('#addUser').modal('toggle');

             var data = jQuery.parseJSON(responce);

             console.log(data);

             $('[name*="id"]').val(data.id);

             $('[name*="group_id"]').val(data.group_id);

             $('[name*="address"]').val(data.address);

             $('[name*="age"]').val(data.age);

             $('[name*="name"]').val(data.name);

             $('[name*="email_id"]').val(data.email_id);

             $('[name*="institute_name"]').val(data.institute_name);

             $('[name*="academic_year"]').val(data.academic_year);

             $('[name*="principal_name"]').val(data.principal_name);

             if(data.photo=='')

             {

               $("#AddUser #blah").attr('src', '<?php echo front_base_url();?>assets/img/u.png');

             }

             else

             {

               $("#AddUser #blah").attr('src', '<?php echo file_upload_base_url();?>'+data.tenant_id+'/users_photo/'+data.id+'/thumbs/'+data.photo);

             }

          }

         });

     }

      </script>



      <script type="text/javascript">

        $(document).ready(function() {

              "use strict";

                  var form_register = $('#addUserCsv');

                  var error_register = $('.alert-danger', form_register);

                  var success_register = $('.alert-success', form_register);

                  form_register.validate({

                      errorElement: 'div', //default input error message container

                      errorClass: 'vd_red', // default input error message class

                      focusInvalid: false, // do not focus the last invalid input

                      ignore: "",

                      rules: {

                          csvfile: {

                              required: true

                          },

                          tenant_id: {

                               required: true

                          },

                      },

                      messages: {

                        tenant_id: "Please Select Tenant",

                        csvfile: "Please upload your CSV file",

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

                        $("#submitCsvUser").attr("disabled", "disabled");

                        return true;

                      }

                  });

        });

        </script>



      <script type="text/javascript" language="javascript" >

        function format ( d )

        {

               return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                '<div class="panel-heading"> </div>'+

                '<div class="panel-body">'+

                        '<span style="font-size:20px;font-weight:bold;">User Details</span><br><br>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>User Info:</strong> </div>'+

                          '<div class="col-xs-7">'+d.info+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Name:</strong> </div>'+

                          '<div class="col-xs-7">'+d.name+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Email:</strong> </div>'+

                          '<div class="col-xs-7">'+d.email+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Group Name:</strong> </div>'+

                          '<div class="col-xs-7">'+d.group_id+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Address:</strong> </div>'+

                          '<div class="col-xs-7">'+d.address+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Age:</strong> </div>'+

                          '<div class="col-xs-7">'+d.age+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Institute Name:</strong> </div>'+

                          '<div class="col-xs-7">'+d.institute_name+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Academic Year:</strong> </div>'+

                          '<div class="col-xs-7">'+d.academic_year+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Principal Name:</strong> </div>'+

                          '<div class="col-xs-7">'+d.principal_name+'</div>'+

                        '</div>'+

                      '</div></div></div>';

        }

        $(document).ready(function() {

        var dt = $('#data-tables').DataTable( {

           oLanguage: {

                    sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

             },

             "iDisplayLength": 25,

             "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

            "processing": true,

            "serverSide": true,

            "ajax": ajax_base_url+"users/getAjaxdataObjects",

            "columns": [

                {

                    "class":          "details-control",

                    "orderable":      false,

                    "data":           null,

                    "defaultContent": ""

                },

                { "data": "chk" },

                { "data": "info" },

                { "data": "address" },

                { "data": "status" },

                { "data": "created" },

                { "data": "action" }

            ],

            "order": [],

             columnDefs: [

               { orderable: true, targets: [3,4] },

               { orderable: false, targets: [-1,0,1,2] },

               { "width": "5%", "targets": [0,1] },

               { "width": "10%", "targets": [4]},

               { "width": "15%", "targets": [-1,3]},

               { "width": "25%", "targets": [2,5]}

            ],

          "fnDrawCallback": function (oSettings) {

               nbr=0;

                    $(".details-control").each(function()

                    {

                        if(nbr > 0)

                        {

                            $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                        }

                        nbr++;

                    });

                    $('tbody').css('border', '1px solid #eee');

            }

        } );

        // Array to track the ids of the details displayed rows

        var detailRows = [];

        $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

            var tr = $(this).closest('tr');

            var row = dt.row( tr );

            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                tr.removeClass( 'details' );

                row.child.hide();

                // Remove from the 'open' array

                detailRows.splice( idx, 1 );

            }

            else {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                // Add to the 'open' array

                if ( idx === -1 ) {

                    detailRows.push( tr.attr('id') );

                }

            }

        } );

        // On each draw, loop over the `detailRows` array and show any child rows

        dt.on( 'draw', function () {

            $.each( detailRows, function ( i, id ) {

                $('#'+id+' td.details-control').trigger( 'click' );

            } );

        } );

    } );



   function change_status(userId,status)

     {

           var done = confirm("Are you sure, you want to change the status?");

           if(done == true)

           {

               var pageurl_new = ajax_base_url+'users/change_status/'+userId+'/'+status;

               window.location.href = pageurl_new;

           }

           else

           {

               return false;

           }

     }





   function delete_confirm(id)

    {

          var done = confirm("Are you sure to delete this record");

          if(done == true)

          {

              var pageurl_new = ajax_base_url+'users/delete_confirm/'+id;

              window.location.href = pageurl_new;

          }

          else

          {

              return false;

          }

    }

    function validateForm()

     {

           total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

           if(total==0)

           {

               alert("Please select checkbox.");

               return false;

           }

           var listBoxSelection=document.getElementById("listaction").value;

           if(listBoxSelection==0)

           {

               alert("Please select Action");

               return false;

           }

           else

                 if(listBoxSelection == 3){

                 var done = confirm("Are you sure, you want to delete record's from database?");

                 if(done == true){

                   return true;

                 }

                 else

                 {

                   return false;

                 }

           }

     }

    $(document).ready(function()

    {

       $(".case").click(function(){

        var checked_status = this.checked;

        $("#myform input[type=checkbox]").each(function(){

          this.checked = checked_status;

        });

       });

    });

    </script>

   <?php } ?>



   <?php if($page_name == 'manage_banner/manage_banner_view'){;?>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>



   <script>

    $(document).ready(function() {

      $('#addbanner').click(function() {

        document.getElementById('manage_banner').reset();

        $('#manage_banner').find('manage_banner').removeClass('vd_bd-red');

        var validator1 = $( "#manage_banner" ).validate();

          validator1.resetForm();

         });

      });

    </script>



    <script>

      var btnCust = '';

      $("#banner_image").fileinput({

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

      <?php

      if(!empty($name_profile['banner_image']))

      {?>

          defaultPreviewContent: '<img src="file_upload_base_url()/'.<?php echo $name_profile['id'];?>.'/logo/thumbs/<?php echo $name_profile['banner_image']?>" id="blah" alt="profile" style="width:160px">',

      <?php

      }

      else

      {

      ?>

          defaultPreviewContent: '<img src="<?php echo front_base_url();?>assets/img/u.png" id="blah" style="width:160px">',

      <?php } ?>

    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},

    allowedFileExtensions: ["jpg", "png", "gif","jpeg"]

    });

    </script>

    <script>

          $('#banner_image').change(function(){

            var input = $('#banner_image')[0];

            if (input.files && input.files[0]) {

              var reader = new FileReader();

              reader.onload = function (e) {

                $('#blah').attr('src', e.target.result);

              }

              reader.readAsDataURL(input.files[0]);

            }

          });

      </script>



    <script type="text/javascript">

      $(document).ready(function() {

            "use strict";

                var form_register = $('#manage_banner');

                var error_register = $('.alert-danger', form_register);

                var success_register = $('.alert-success', form_register);

                form_register.validate({

                    errorElement: 'div', //default input error message container

                    errorClass: 'vd_red', // default input error message class

                    focusInvalid: false, // do not focus the last invalid input

                    ignore: "",

                    rules: {

                        name: {

                            required: true

                        },

                        email: {

                           email: true,

                            required: true

                        }

                    },

                    messages: {

                      name: "Please enter your Name",

                      email: "Please enter a valid email contact"

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

                      $("#submitBanner").attr("disabled", "disabled");

                      manageBannerSubmit();

                    }

                });

      });

      </script>

   <script>

    function manageBannerSubmit(){

      var formData = new FormData($('#manage_banner')[0]);

    //  console.log(ajax_base_url);

      var pageurl_new = ajax_base_url+'manage_banner/add_edit_banner';

        $.ajax({

                   url: pageurl_new,

                   type: 'POST',

                   data: formData,

                   processData: false,

                   contentType: false,

               }).done(function(responce)

                {
                  var data = jQuery.parseJSON(responce);
                  notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                  var dTable = $('#data-tables').DataTable();
                   dTable.ajax.reload();
                   $('#addBanner').modal('toggle');

             });

        }



     function edit_banner(userId)

     {

          var pageurl_new = ajax_base_url+'manage_banner/edit_banner/'+userId;

          $.ajax({

             url: pageurl_new,

          }).done(function(responce)

          {

               if (!$.isEmptyObject(responce))

               {

                  $('#addBanner').modal('toggle');

                  var data = jQuery.parseJSON(responce);



                  console.log(data.id);



                  $('[name*="id"]').val(data.id);

                  $('[name*="banner_title"]').val(data.banner_title);

                  $('[name*="banner_text"]').val(data.banner_text);



                  if(data.banner_image=='')

                  {

                    $("#addBanner #blah").attr('src', '<?php echo front_base_url();?>assets/img/u.png');

                  }

                  else

                  {

                    $("#addBanner #blah").attr('src', '<?php echo file_upload_base_url();?>'+data.tenant_id+'/banner/thumbs/'+data.banner_image);

                  }

               }

          });

      }

    </script>

      <script type="text/javascript" language="javascript" >

        function format ( d )

        {

               return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                '<div class="panel-heading"> </div>'+

                '<div class="panel-body">'+

                        '<span style="font-size:20px;font-weight:bold;">Banner Details</span><br><br>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Banner Info:</strong> </div>'+

                          '<div class="col-xs-7">'+d.info+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right" onclick="change_status()"> <strong>Status:</strong> </div>'+

                          '<div class="col-xs-7">'+d.status+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Banner Text:</strong> </div>'+

                          '<div class="col-xs-7">'+d.banner_text+'</div>'+

                        '</div>'+

                      '</div></div></div>';

        }

        $(document).ready(function() {

        var dt = $('#data-tables').DataTable( {

           oLanguage: {

                    sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

             },

             "iDisplayLength": 25,

             "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

            "processing": true,

            "serverSide": true,

            "ajax": ajax_base_url+"manage_banner/getAjaxdataObjects",

            "columns": [

                {

                    "class":          "details-control",

                    "orderable":      false,

                    "data":           null,

                    "defaultContent": ""

                },

                { "data": "chk" },

                { "data": "info" },



                { "data": "status" },

                { "data": "created" },

                { "data": "action" }

            ],

            "order": [],

             columnDefs: [

               { orderable: true, targets: [3,4] },

               { orderable: false, targets: [-1,0,1,2] },

               { "width": "5%", "targets": [0,1] },

               { "width": "10%", "targets": [4]},

               { "width": "15%", "targets": [-1,3]},

               { "width": "25%", "targets": [2,5]}

            ],

          "fnDrawCallback": function (oSettings) {

               nbr=0;

                    $(".details-control").each(function()

                    {

                        if(nbr > 0)

                        {

                            $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                        }

                        nbr++;

                    });

                    $('tbody').css('border', '1px solid #eee');

         }

        } );

        // Array to track the ids of the details displayed rows

        var detailRows = [];

        $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

            var tr = $(this).closest('tr');

            var row = dt.row( tr );

            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                tr.removeClass( 'details' );

                row.child.hide();

                // Remove from the 'open' array

                detailRows.splice( idx, 1 );

            }

            else {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                // Add to the 'open' array

                if ( idx === -1 ) {

                    detailRows.push( tr.attr('id') );

                }

            }

        } );

        // On each draw, loop over the `detailRows` array and show any child rows

        dt.on( 'draw', function () {

            $.each( detailRows, function ( i, id ) {

                $('#'+id+' td.details-control').trigger( 'click' );

            } );

        } );

    } );

   function change_status(userId,status)

     {

           var done = confirm("Are you sure, you want to change the status?");

           if(done == true)

           {

               var pageurl_new = ajax_base_url+'manage_banner/change_status/'+userId+'/'+status;

               window.location.href = pageurl_new;

           }

           else

           {

               return false;

           }

     }

    function delete_confirm(id)

    {

          var done = confirm("Are you sure to delete this record");

          if(done == true)

          {

              var pageurl_new = ajax_base_url+'manage_banner/delete_confirm/'+id;

              window.location.href = pageurl_new;

          }

          else

          {

              return false;

          }

    }

   function validateForm()

      {

            total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

            if(total==0)

            {

                alert("Please select checkbox.");

                return false;

            }

            var listBoxSelection=document.getElementById("listaction").value;

            if(listBoxSelection==0)

            {

                alert("Please select Action");

                return false;

            }

            else

                  if(listBoxSelection == 3){

                  var done = confirm("Are you sure, you want to delete record's from database?");

                  if(done == true){

                    return true;

                  }

                  else

                  {

                    return false;

                  }

            }

      }

    $(document).ready(function()

    {

       $(".case").click(function(){

        var checked_status = this.checked;

        $("#myform input[type=checkbox]").each(function(){

          this.checked = checked_status;

        });

       });

    });

    </script>

   <?php } ?>









   <?php if($page_name == 'manage_groups/manage_groups_view'){;?>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>



   <script>

     $(document).ready(function() {

       $('#addgroup').click(function() {

         document.getElementById('manage_group').reset();

         $('#manage_group').find('manage_group').removeClass('vd_bd-red');

         var validator1 = $( "#manage_group" ).validate();

           validator1.resetForm();

          });

       });

     </script>



    <script type="text/javascript">

      $(document).ready(function() {

            "use strict";

                var form_register = $('#manage_group');

                var error_register = $('.alert-danger', form_register);

                var success_register = $('.alert-success', form_register);

                form_register.validate({

                    errorElement: 'div', //default input error message container

                    errorClass: 'vd_red', // default input error message class

                    focusInvalid: false, // do not focus the last invalid input

                    ignore: "",

                    rules: {

                        group_name: {

                            required: true

                        },

                    },

                    messages: {

                      group_name: "Please enter your Group Name",

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

                      $("#submitGroup").attr("disabled", "disabled");

                      GroupSubmit();

                    }

                });

      });

      </script>

   <script>



    function GroupSubmit(){

      var formData = new FormData($('#manage_group')[0]);

      console.log(formData);

      var pageurl_new = ajax_base_url+'manage_groups/submit_group';

        $.ajax({

                   url: pageurl_new,

                   type: 'POST',

                   data: formData,

                   processData: false,

                   contentType: false,

               }).done(function(responce)

                {

                     // window.location.href = ajax_base_url+'manage_groups';

                     var data = jQuery.parseJSON(responce);

                     if(data.status=='success')

                     {

                       $('#manage_group').find("input[type=text]").val("");
                       notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                       var dTable = $('#data-tables').DataTable();
                       dTable.ajax.reload();
                       $('#myModal').modal('toggle');

                     }

                     else

                     {

                           $.each(data.errorfields, function()

                           {

                               $.each(this, function(name, value)

                               {

                                   $('[name*="'+name+'"]').parent().after('<div class="vd_red">'+value+'</div>');

                               });

                           });

                           $('#submitGroup').prop("disabled", false);

                     }

             });

        }

     function edit_group(userId)

     {

          var pageurl_new = ajax_base_url+'manage_groups/edit_group/'+userId;

          $.ajax({

             url: pageurl_new,

          }).done(function(responce)

          {

               if (!$.isEmptyObject(responce))

               {

                $('#myModal').modal('toggle');

                var data = jQuery.parseJSON(responce);

                  $.each(data, function()
                  {
                      $.each(this, function(name, value)
                      {
                          $('[name*="'+name+'"]').val(value);
                      });

                      var $radios = $('input:radio[name=signup_show]');
                      if($radios.is(':checked') === false)
                      {
                        //console.log('ffff');
                          $radios.filter('[value='+data.signup_show+']').prop('checked', true);
                      }
                      else
                      {
                       // console.log('gdfgfgf');
                         $radios.filter('[value='+data.signup_show+']').attr('checked', true);
                      }

                  });



               }

          });

      }

    </script>

      <script type="text/javascript" language="javascript" >

        function format ( d )

        {

               return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                '<div class="panel-heading"> </div>'+

                '<div class="panel-body">'+

                        '<span style="font-size:20px;font-weight:bold;">Group Details</span><br><br>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Group Name:</strong> </div>'+

                          '<div class="col-xs-7">'+d.group_name+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right" onclick="change_status()"> <strong>Status:</strong> </div>'+

                          '<div class="col-xs-7">'+d.status+'</div>'+

                        '</div>'+

                      '</div></div></div>';

        }

        $(document).ready(function() {

        var dt = $('#data-tables').DataTable( {

           oLanguage: {

                    sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

             },

             "iDisplayLength": 25,

             "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

            "processing": true,

            "serverSide": true,

            "ajax": ajax_base_url+"manage_groups/getAjaxdataObjects",

            "columns": [

                {

                    "class":          "details-control",

                    "orderable":      false,

                    "data":           null,

                    "defaultContent": ""

                },

                { "data": "chk" },

                { "data": "info" },

                { "data": "status" },

                { "data": "created" },

                { "data": "action" }

            ],

            "order": [],

             columnDefs: [

               { orderable: true, targets: [3,4] },

               { orderable: false, targets: [-1,0,1,2] },

               { "width": "5%", "targets": [0,1] },

               { "width": "10%", "targets": [4]},

               { "width": "15%", "targets": [-1,3]},

               { "width": "25%", "targets": [2]}

            ],

          "fnDrawCallback": function (oSettings) {

               nbr=0;

                    $(".details-control").each(function()

                    {

                        if(nbr > 0)

                        {

                            $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                        }

                        nbr++;

                    });

                    $('tbody').css('border', '1px solid #eee');

         }

        } );

        // Array to track the ids of the details displayed rows

        var detailRows = [];

        $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

            var tr = $(this).closest('tr');

            var row = dt.row( tr );

            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                tr.removeClass( 'details' );

                row.child.hide();

                // Remove from the 'open' array

                detailRows.splice( idx, 1 );

            }

            else {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                // Add to the 'open' array

                if ( idx === -1 ) {

                    detailRows.push( tr.attr('id') );

                }

            }

        } );

        // On each draw, loop over the `detailRows` array and show any child rows

        dt.on( 'draw', function () {

            $.each( detailRows, function ( i, id ) {

                $('#'+id+' td.details-control').trigger( 'click' );

            } );

        } );

    } );

   function change_status(userId,status)

     {

           var done = confirm("Are you sure, you want to change the status?");

           if(done == true)

           {

               var pageurl_new = ajax_base_url+'manage_groups/change_status/'+userId+'/'+status;

               window.location.href = pageurl_new;

           }

           else

           {

               return false;

           }

     }

    function delete_confirm(id)

    {

          var done = confirm("Are you sure to delete this record");

          if(done == true)

          {

              var pageurl_new = ajax_base_url+'manage_groups/delete_confirm/'+id;

              window.location.href = pageurl_new;

          }

          else

          {

              return false;

          }

    }

   function validateForm()

     {

           total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

           if(total==0)

           {

               alert("Please select checkbox.");

               return false;

           }

           var listBoxSelection=document.getElementById("listaction").value;

           if(listBoxSelection==0)

           {

               alert("Please select Action");

               return false;

           }

           else

                 if(listBoxSelection == 3){

                 var done = confirm("Are you sure, you want to delete record's from database?");

                 if(done == true){

                   return true;

                 }

                 else

                 {

                   return false;

                 }

           }

     }

    $(document).ready(function()

    {

       $(".case").click(function(){

        var checked_status = this.checked;

        $("#myform input[type=checkbox]").each(function(){

          this.checked = checked_status;

        });

       });

    });

    </script>

   <?php } ?>





    <?php if($page_name == 'manage_quiz/manage_quiz_master_view'){;?>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/tagsInput/jquery.tagsinput.min.js"></script>


     <script>

       $(document).ready(function() {

         $('#addquiz').click(function() {

           document.getElementById('manage_quiz').reset();

           $('#manage_quiz').find('manage_quiz').removeClass('vd_bd-red');

           var validator1 = $( "#manage_quiz" ).validate();

             validator1.resetForm();

            });

         });

       </script>
        <script>

        $(document).ready(function() {

          showTags('tags');

        });

       function showTags(className)

       {

           $('.'+className).tagsInput({

             width: 'auto',

               autosize: true,

             autocomplete_url:'<?php echo base_url();?>'+"manage_quiz_section/getcategories",

             autocomplete:{

             source: function(request, response) {

               $.ajax({
                url: '<?php echo base_url();?>'+"manage_quiz_section/getcategories",
                dataType: "json",
                type:'POST',
                global: false,
                data: {

                 categorySearch_startsWith: request.term

                },

                success: function(data) {

                 response( $.map( data, function( item ) {

                   console.log(item);

                         return {

                           label: item.category_name,

                           value: item.category_name

                         }

                     }));

                }

               })

             }}

           });

       }



        </script>







     <script type="text/javascript">

       $(document).ready(function() {

             "use strict";

                 var form_register = $('#manage_quiz');

                 var error_register = $('.alert-danger', form_register);

                 var success_register = $('.alert-success', form_register);

                 form_register.validate({

                     errorElement: 'div', //default input error message container

                     errorClass: 'vd_red', // default input error message class

                     focusInvalid: false, // do not focus the last invalid input

                     ignore: "",

                     rules: {

                         mock: {

                             required: true

                         },

                         quiz_name: {

                             required: true

                         },

                         // logo:{
                         //       required: true
                         //   },


                         assessment_information: { required: true },

                          number_of_sections: {

                             required: true,

                             digits: true

                         },



                     },

                     messages: {

                       mock: "Please select mock field",

                       quiz_name: "Please enter your Assesment Name",
                       //logo: "Please select Assesment Image",
                       assessment_information:"Please enter information about assesment.",
                       number_of_sections: {

                        required: "Please enter Number Of Sections",

                        digits: "Please enter Digits "

                       },

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

                       $("#submitQuiz").attr("disabled", "disabled");

                       QuizSubmit();

                     }

                 });

       });

       </script>

    <script>



     function QuizSubmit(){

       var formData = new FormData($('#manage_quiz')[0]);

       console.log(formData);

       var pageurl_new = ajax_base_url+'manage_quiz/submit_quiz';

         $.ajax({

                    url: pageurl_new,

                    type: 'POST',

                    data: formData,

                    processData: false,

                    contentType: false,

                }).done(function(responce)
                 {
                      // window.location.href = ajax_base_url+'manage_quiz';
                      var data = jQuery.parseJSON(responce);
                      if(data.status=='success')
                      {

                        $('#manage_quiz').find("input[type=text]").val("");
                        notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                        var dTable = $('#data-tables').DataTable();
                         dTable.ajax.reload();
                         $('#quizModal').modal('toggle');
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

                            $('#submitQuiz').prop("disabled", false);

                      }

              });

         }

      function edit_quiz(quizId)
      {
           var pageurl_new = ajax_base_url+'manage_quiz/edit_quiz/'+quizId;
           $.ajax({
              url: pageurl_new,
           }).done(function(responce)
           {
                if (!$.isEmptyObject(responce))
                {
                $('#quizModal').modal('toggle');
                 var data = jQuery.parseJSON(responce);
                 console.log(data);
                  $('[name*="id"]').val(data.id);
                  $('[name*="quiz_name"]').val(data.quiz_name);
                  $('[name*="assessment_information"]').val(data.assessment_information);
                  $('[name*="number_of_sections"]').val(data.number_of_sections);
                  var $radios1 = $('input:radio[name=bind_url]');
                  if($radios1.is(':checked') === false)
                  {
                      $radios1.filter('[value='+data.bind_url+']').prop('checked', true);
                  }
                  else
                  {
                      $radios1.filter('[value='+data.bind_url+']').attr('checked', true);
                  }
                  $('[name*="url"]').val(data.url);
                  var $radios = $('input:radio[name=mock]');
                  if($radios.is(':checked') === false)
                  {
                      $radios.filter('[value='+data.mock+']').prop('checked', true);
                  }
                  else
                  {
                      $radios.filter('[value='+data.mock+']').attr('checked', true);
                  }
                  $('#input-autocomplete').importTags(data.category_name);
                  if(data.assessment_image=='')
                 {

                   $("#quizModal #blah").attr('src', '<?php echo base_url();?>assets/img/defult_logo.jpg');

                 }

                 else

                 {

                   $("#quizModal #blah").attr('src', '<?php echo file_upload_base_url();?>assesment/'+data.assessment_image);

                 }
                //  $('#quiz_id').val(data.quiz_id);
                  //$('#quizModal').modal('toggle');

                }
           });
       }

     </script>

       <script type="text/javascript" language="javascript" >
        function format ( d )

        {

               return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                '<div class="panel-heading"> </div>'+

                '<div class="panel-body">'+

                        '<span style="font-size:20px;font-weight:bold;">Quiz Master Details</span><br><br>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Quiz Name:</strong> </div>'+

                          '<div class="col-xs-7 text-left">'+d.info+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>No if sections:</strong> </div>'+

                          '<div class="col-xs-7" style="text-align:center;">'+d.number_of_sections+'</div>'+

                        '</div>'+

                      '</div></div></div>';

        }
         $(document).ready(function() {

        if($('input#mockYes').is(':checked')) {
                $("#mockCategories").show();
        }

        if($('input#mockNo').is(':checked')) {
                $("#mockCategories").hide();
        }


        $("input#mockYes").click(function() {
                $("#mockCategories").show();
        });
        $("input#mockNo").click(function() {
                $("#mockCategories").hide();
        });

     $("#addquiz").on("click", function () {
                if($('input#mockYes').is(':checked')) {
                        $("#mockCategories").show();
                }

                if($('input#mockNo').is(':checked')) {
                        $("#mockCategories").hide();
                }
        });

         var dt = $('#data-tables').DataTable( {

            oLanguage: {

                     sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

              },

              "iDisplayLength": 25,

              "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

             "processing": true,

             "serverSide": true,

             "ajax": ajax_base_url+"manage_quiz/getAjaxdataObjects",

             "columns": [

                 {

                     "class":          "details-control",

                     "orderable":      false,

                     "data":           null,

                     "defaultContent": ""

                 },

                 { "data": "chk" },

                 { "data": "logo" },

                 { "data": "info" },

                 { "data": "number_of_sections" },

                 { "data": "action" }

             ],

             "order": [],

              columnDefs: [

                { orderable: true, targets: [3] },

                { orderable: false, targets: [-1,0,1,2] },

                { "width": "5%", "targets": [0,1] },

                { "width": "10%", "targets": [4]},

                { "width": "15%", "targets": [-1,3]},

                { "width": "25%", "targets": [2]}

             ],
 "fnDrawCallback": function (oSettings) {

               nbr=0;

                    $(".details-control").each(function()

                    {

                        if(nbr > 0)

                        {

                            $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                        }

                        nbr++;

                    });

                    $('tbody').css('border', '1px solid #eee');

         }

        } );

        // Array to track the ids of the details displayed rows

        var detailRows = [];

        $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

            var tr = $(this).closest('tr');

            var row = dt.row( tr );

            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                tr.removeClass( 'details' );

                row.child.hide();

                // Remove from the 'open' array

                detailRows.splice( idx, 1 );

            }

            else {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                // Add to the 'open' array

                if ( idx === -1 ) {

                    detailRows.push( tr.attr('id') );

                }

            }

        } );

        // On each draw, loop over the `detailRows` array and show any child rows

        dt.on( 'draw', function () {

            $.each( detailRows, function ( i, id ) {

                $('#'+id+' td.details-control').trigger( 'click' );

            } );

        } );

    } );



     function delete_confirm(id)

     {

           var done = confirm("Are you sure to delete this record");

           if(done == true)

           {

               var pageurl_new = ajax_base_url+'manage_quiz/delete_confirm/'+id;

               window.location.href = pageurl_new;

           }

           else

           {

               return false;

           }

     }

    function validateForm()

      {

            total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

            if(total==0)

            {

                alert("Please select checkbox.");

                return false;

            }

            var listBoxSelection=document.getElementById("listaction").value;

            if(listBoxSelection==0)

            {

                alert("Please select Action");

                return false;

            }

            else

                  if(listBoxSelection == 3){

                  var done = confirm("Are you sure, you want to delete record's from database?");

                  if(done == true){

                    return true;

                  }

                  else

                  {

                    return false;

                  }

            }

      }

     $(document).ready(function()

     {

        $(".case").click(function(){

         var checked_status = this.checked;

         $("#myform input[type=checkbox]").each(function(){

           this.checked = checked_status;

         });

        });

     });

     </script>


     <script>

         var btnCust = '';

         $("#logo").fileinput({

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

         <?php

         if(!empty($name_profile['assessment_image']))

         {?>

             defaultPreviewContent: '<img src="file_upload_base_url()/uploads/assesment/<?php echo $name_profile['assessment_image'];?>" id="blah" alt="profile" style="width:160px">',

         <?php

         }

         else

         {

         ?>

             defaultPreviewContent: '<img src="<?php echo base_url();?>assets/img/defult_logo.jpg" id="blah" style="width:160px">',

         <?php } ?>

       layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},

       allowedFileExtensions: ["jpg", "png", "gif","jpeg"]

       });

       </script>

       <script>

             $('#logo').change(function(){

               var input = $('#logo')[0];

               if (input.files && input.files[0]) {

                 var reader = new FileReader();

                 reader.onload = function (e) {

                   $('#blah').attr('src', e.target.result);

                 }

                 reader.readAsDataURL(input.files[0]);

               }

             });

         </script>



    <?php } ?>



    <?php if($page_name == 'manage_quiz_section/manage_quiz_section_view'){;?>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/tagsInput/jquery.tagsinput.min.js"></script>



       <script>

       $(document).ready(function() {

         $('#addquizsec').click(function() {

           document.getElementById('manage_quiz_section').reset();

           $('#manage_quiz_section').find('manage_quiz_section').removeClass('vd_bd-red');

           var validator1 = $( "#manage_quiz_section" ).validate();

             validator1.resetForm();

            });

         });

       </script>



     <script type="text/javascript">

       $(document).ready(function() {

             "use strict";

                 var form_register = $('#manage_quiz_section');

                 var error_register = $('.alert-danger', form_register);

                 var success_register = $('.alert-success', form_register);

                 form_register.validate({

                     errorElement: 'div', //default input error message container

                     errorClass: 'vd_red', // default input error message class

                     focusInvalid: false, // do not focus the last invalid input

                     ignore: [],

                     rules: {

                         'section_name[]': {

                             required: true

                         },

                          'no_of_questions[]': {

                             required: true,

                             digits: true

                         },

                         'category_id[]': {

                             required: true

                         },



                     },

                     messages: {

                       category_id: "Please enter your Category Name",

                       quiz_name: "Please enter your Quiz Name",

                       no_of_questions: {

                        required: "Please enter Number Of Sections",

                        digits: "Please enter Digits "

                       },

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

                       $("#submitSection").attr("disabled", "disabled");

                       QuizSectionSubmit();

                     }

                 });

       });

       </script>



  <script>

  $(document).ready(function() {

    showTags('tags');

  });

 function showTags(className)

 {

     $('.'+className).tagsInput({

       width: 'auto',

         autosize: true,

       autocomplete_url:'<?php echo base_url();?>'+"manage_quiz_section/getcategories",

       autocomplete:{

       source: function(request, response) {

         $.ajax({

          url: '<?php echo base_url();?>'+"manage_quiz_section/getcategories",

          dataType: "json",

          type:'POST',
          global: false,
          data: {

           categorySearch_startsWith: request.term

          },

          success: function(data) {

           response( $.map( data, function( item ) {

             console.log(item);

                   return {

                     label: item.category_name,

                     value: item.category_name

                   }

               }));

          }

         })

       }}

     });

 }



  </script>

    <script>



     function QuizSectionSubmit(){

       var formData = new FormData($('#manage_quiz_section')[0]);

       console.log(formData);

       var pageurl_new = ajax_base_url+'manage_quiz_section/submit_section';

         $.ajax({

                    url: pageurl_new,

                    type: 'POST',

                    data: formData,

                    processData: false,

                    contentType: false,

                }).done(function(responce)
                 {
                      var data = jQuery.parseJSON(responce);
                      if(data.status == 'success')
                      {
                            notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                            var dTable = $('#data-tables').DataTable();
                             dTable.ajax.reload();
                             $('#quiz_section_Modal').modal('toggle');
                      }
                      else
                      {
                              notification("topright","error","fa fa-exclamation-circle vd_red","Error",data.message);
                              var dTable = $('#data-tables').DataTable();
                             dTable.ajax.reload();
                             $('#quiz_section_Modal').modal('toggle');
                      }
              });

         }

      function edit_section(sectionId)

      {

           var pageurl_new = ajax_base_url+'manage_quiz_section/edit_section/'+sectionId;

           $.ajax({

              url: pageurl_new,

           }).done(function(responce)

           {

                if (!$.isEmptyObject(responce))

                {

                  var data = jQuery.parseJSON(responce);
                  // console.log("@@@@@@"+data);
                  // console.log($('#quiz_id'));

                   $('[name*="id"]').val(data.id);

                   $('[name*="section_name"]').val(data.section_name);

                   $('[name*="no_of_questions"]').val(data.no_of_questions);

                   $('#input-autocomplete').importTags(data.category_name);

                   $('#quiz_id').val(data.quiz_id);

                   $('#quiz_section_Modal').modal('toggle');

                }

           });



       }

     </script>

       <script type="text/javascript" language="javascript" >
      function format ( d )
             {

                    return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                     '<div class="panel-heading"> </div>'+

                     '<div class="panel-body">'+

                             '<span style="font-size:20px;font-weight:bold;">Quiz Sections Details</span><br><br>'+
                                '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>Section Name:</strong> </div>'+

                               '<div class="col-xs-7">'+d.info+'</div>'+

                             '</div>'+
                             '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>Quiz Name:</strong> </div>'+

                               '<div class="col-xs-7">'+d.quiz_name+'</div>'+

                             '</div>'+

                             '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>Message:</strong> </div>'+

                               '<div class="col-xs-7">'+d.category_name+'</div>'+

                             '</div>'+
                             '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>No of questions:</strong> </div>'+

                               '<div class="col-xs-7">'+d.no_of_questions+'</div>'+

                             '</div>'+


                           '</div></div></div>';

             }
         $(document).ready(function() {

         var dt = $('#data-tables').DataTable( {

            oLanguage: {

                     sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

              },

              "iDisplayLength": 25,

              "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

             "processing": true,

             "serverSide": true,

             "ajax": ajax_base_url+"manage_quiz_section/getAjaxdataObjects",

             "columns": [

                 {

                     "class":          "details-control",

                     "orderable":      false,

                     "data":           null,

                     "defaultContent": ""

                 },

                 { "data": "chk" },
                 { "data": "info" },
                 { "data": "quiz_name" },
                 { "data": "category_name" },

                 { "data": "no_of_questions" },

                 { "data": "action" }

             ],

             "order": [],

              columnDefs: [

                { orderable: true, targets: [2,3,4] },
                { orderable: false, targets: [-1,0,1,5] },
                { "width": "5%", "targets": [0,1] },
                { "width": "15%", "targets": [5,6]},
                { "width": "20%", "targets": [2,3,4]}

             ],
    "fnDrawCallback": function (oSettings) {

                nbr=0;

                     $(".details-control").each(function()

                     {

                         if(nbr > 0)

                         {

                             $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                         }

                         nbr++;

                     });

                     $('tbody').css('border', '1px solid #eee');

          }

         } );

         // Array to track the ids of the details displayed rows

         var detailRows = [];

         $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

             var tr = $(this).closest('tr');

             var row = dt.row( tr );

             var idx = $.inArray( tr.attr('id'), detailRows );

             if ( row.child.isShown() ) {

                 $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                 tr.removeClass( 'details' );

                 row.child.hide();

                 // Remove from the 'open' array

                 detailRows.splice( idx, 1 );

             }

             else {

                 $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                 tr.addClass( 'details' );

                 row.child( format( row.data() ) ).show();

                 // Add to the 'open' array

                 if ( idx === -1 ) {

                     detailRows.push( tr.attr('id') );

                 }

             }

         } );

         // On each draw, loop over the `detailRows` array and show any child rows

         dt.on( 'draw', function () {

             $.each( detailRows, function ( i, id ) {

                 $('#'+id+' td.details-control').trigger( 'click' );

             } );

         } );

     } );




     function delete_confirm(id)

     {

           var done = confirm("Are you sure to delete this record");

           if(done == true)

           {

               var pageurl_new = ajax_base_url+'manage_quiz_section/delete_confirm/'+id;

               window.location.href = pageurl_new;

           }

           else

           {

               return false;

           }

     }

    function validateForm()

      {

            total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

            if(total==0)

            {

                alert("Please select checkbox.");

                return false;

            }

            var listBoxSelection=document.getElementById("listaction").value;

            if(listBoxSelection==0)

            {

                alert("Please select Action");

                return false;

            }

            else

                  if(listBoxSelection == 3){

                  var done = confirm("Are you sure, you want to delete record's from database?");

                  if(done == true){

                    return true;

                  }

                  else

                  {

                    return false;

                  }

            }

      }

     $(document).ready(function()

     {

        $(".case").click(function(){

         var checked_status = this.checked;

         $("#myform input[type=checkbox]").each(function(){

           this.checked = checked_status;

         });

        });

     $("#quiz_section_Modal").on("hidden.bs.modal", function () {

        $('#input-autocomplete').importTags('');
          var cnt=0;
              $("[id=report_section]").each(function(){
                  if(cnt!=0)
                  {
                      $(this).remove();
                  }
                  cnt++;
              });
        });


     });

     </script>



     <script>

        function set_quiz_id(element)
        {
          // console.log("@@@@@"+element);
          var cnt=0;
          $("[id=report_section]").each(function(){
              if(cnt!=0)
              {
                  $(this).remove();
              }
              cnt++;
          });
         var QuizId=$(element).val();
         var editQId=$('#id').val();
        // console.log(editQId);
        if(QuizId != '' || editQId != '')
        {
                 $.ajax({
                       type: "POST",
                       data:{QuizId:QuizId,editQId:editQId},
                       url:ajax_base_url+"manage_quiz_section/set_quiz_id",
                       success:function(data)
                       {
                            for (var i = 1; i < data; i++)
                            {
                              $('#report_section_wrapper').append('<div class="wrapper" id="report_section"><hr/> <div class="form-group"> <label class="col-sm-4 control-label">Section Name :</label> <div class="col-sm-7 controls"> <input type="text" class="input-border-btm" id="section_name" name="section_name[]" placeholder="Enter Section Name"> <input type="hidden" id="id" name="id"> </div> </div> <div class="form-group"> <label class="col-sm-4 control-label">No Of Questions :</label> <div class="col-sm-7 controls"> <input type="text" class="input-border-btm" id="no_of_questions" name="no_of_questions[]" placeholder="Enter Name Section Name"> </div> </div> <div class="form-group"> <label class="col-sm-4 control-label">Select Category : <p style="color: rgb(145, 145, 145);font-weight:normal">(Note: To Enter Section Name Press Enter Key)</p> </label> <div class="col-sm-7 controls"> <input id="input-autocomplete" name="category_id[]" type="text" class="tags'+i+'" value="" /> </div> </div> </div>');
                              showTags('tags'+i);
                            }
                     }

                     });
        }
          $('input[name*="section_name[]"]').rules('add', 'required');
          $('input[name*="no_of_questions[]"]').rules('add', 'required');
          $('input[name*="category_id[]"]').rules('add', 'required');
        }

     </script>





    <?php } ?>







    <?php if($page_name == 'manage_exams/manage_exams_view'){;?>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/moment/moment.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-multiselect.js"></script>

     <script>



     $(document).ready(function() {

       $('#addexam').click(function() {

         document.getElementById('manage_exams').reset();

         $('#manage_exams').find('manage_exams').removeClass('vd_bd-red');

         var validator1 = $( "#manage_exams" ).validate();

           validator1.resetForm();

          });

       });

     </script>



     <script type="text/javascript">

     $(document).ready(function()

     {

      $('#selectUsers').multiselect

      ({

        includeSelectAllOption: true,

        enableFiltering: true

      });

      //$('#selectGroups').multiselect

      ({

        //includeSelectAllOption: true,

       // enableFiltering: true

      });




$('#selectGroups').on('change', function(){
  $('.snone').prop('selected', true);

        var grpValue = $(this).children("option:selected").val();
        if(grpValue == 58){

            $('.op').show();

        } else{
            $('.op').hide();
        }

        if(grpValue == 59){

            $('.aca').show();

        } else{
            $('.aca').hide();
        }

    });


/*$('.submitQuiz').on('click', function(){

    if($("#selectGroups").attr("selectedIndex") == 0) {

   } else{
    if($("#selectGroups").attr("selectedIndex") == 0) {
    alert("You haven't selected anything!");
  }
   }
})*/




     });



     </script>







     <script type="text/javascript">

       $(document).ready(function() {

             "use strict";

                 var form_register = $('#manage_exams');

                 var error_register = $('.alert-danger', form_register);

                 var success_register = $('.alert-success', form_register);

                 form_register.validate({

                     errorElement: 'div', //default input error message container

                     errorClass: 'vd_red', // default input error message class

                     focusInvalid: false, // do not focus the last invalid input

                     ignore: "",

                     rules: {

                         quiz_id: {

                             required: true

                         },

                          completion_message: {

                             required: true

                         },

                          start_date: {

                             required: true

                         },
                      exam_name: {

                             required: true

                         },
                          end_date: {

                             required: true

                         },

                          duration: {

                             required: true

                         },

                          security: {

                             required: true

                         },

                          show_result: {

                             required: true

                         },

                         /* show_review_ans: {

                             required: true

                         },*/

                        /* select_user_level: {

                             required: true

                         },*/



                     },

                     messages: {

                       quiz_id: "Please enter your Quiz Name",

                       completion_message: "Please enter your Completion Message",
                       exam_name: "Please enter exam name",

                       start_date: "Please enter your Start Date",

                       end_date: "Please enter your End Date",

                       duration: "Please enter your Duration",

                       security: "Please select Security",

                       show_result: "Please select Show Result",
                       //select_user_level: "Please select User level",

                       //show_review_ans: "Please select Review answer"

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

                       $("#submitExams").attr("disabled", "disabled");

                       ExamsSubmit();

                     }

                 });

       });

       </script>

       <script>

         $(document).ready(function() {
           $('#start_date').datetimepicker({sideBySide:'true'});
           $('#end_date').datetimepicker({sideBySide:'true'});

           $('#duration').timepicker({
                minuteStep: 1,
                template: 'modal',
                appendWidgetTo: 'body',
                showSeconds: true,
                showMeridian: false,
                defaultTime: false
            });
         });

       </script>

    <script>



     function ExamsSubmit(){

       var formData = new FormData($('#manage_exams')[0]);

       console.log(formData);

       var pageurl_new = ajax_base_url+'manage_exams/submit_exams';

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
                      notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                      var dTable = $('#data-tables').DataTable();
                      dTable.ajax.reload();
                      $('#ExamsModal').modal('toggle');
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
                          $('#submitExams').prop("disabled", false);
                    }
              });

         }

      function edit_exams(examId)

      {

           var pageurl_new = ajax_base_url+'manage_exams/edit_exams/'+examId;

           $.ajax({

              url: pageurl_new,

           }).done(function(responce)

           {

                if (!$.isEmptyObject(responce))

                {

                   $('#ExamsModal').modal('toggle');

                    var data = jQuery.parseJSON(responce);



                    $('[name*="id"]').val(data.id);

                    $('[name*="quiz_id"]').val(data.quiz_id);

                    $('[name*="completion_message"]').val(data.completion_message);

                    $('[name*="start_date"]').val(data.start_date);
                    $('[name*="end_date"]').val(data.end_date);
                    $('[name*="exam_name"]').val(data.exam_name);
                    $('[name*="duration"]').val(data.duration);
                    $('[name*="select_user_level"]').val(data.user_level_id);



                  var $radios = $('input:radio[name=show_results]');
                  if($radios.is(':checked') === false)
                  {
                      $radios.filter('[value='+data.show_results+']').prop('checked', true);
                  }
                  else
                  {
                    $radios.filter('[value='+data.show_results+']').attr('checked', true);
                  }

                  var $radios = $('input:radio[name=show_review_ans]');
                  if($radios.is(':checked') === false)
                  {
                      $radios.filter('[value='+data.show_review_ans+']').prop('checked', true);
                  }
                  else
                  {
                    $radios.filter('[value='+data.show_review_ans+']').attr('checked', true);
                  }


                  var $radios = $('input:radio[name=result_dependancy]');
                  if($radios.is(':checked') === false)
                  {
                      $radios.filter('[value='+data.result_dependancy+']').prop('checked', true);
                  }
                  else
                  {
                    $radios.filter('[value='+data.result_dependancy+']').attr('checked', true);
                  }


                  var $radios = $('input:radio[name=security]');
                  if($radios.is(':checked') === false)
                  {
                      $radios.filter('[value='+data.security+']').prop('checked', true);
                  }
                  else
                  {
                    $radios.filter('[value='+data.security+']').attr('checked', true);
                  }

                    $("#selectUsers").val(data.selectUsers);

                    $("#selectGroups").val(data.selectGroups);



                    $("#selectUsers").multiselect("refresh");

                    $("#selectGroups").multiselect("refresh");

                }

           });

       }

     </script>

       <script type="text/javascript" language="javascript" >

      function format ( d )

             {

                    return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                     '<div class="panel-heading"> </div>'+

                     '<div class="panel-body">'+

                             '<span style="font-size:20px;font-weight:bold;">Exams Details</span><br><br>'+

                             '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>Quiz info:</strong> </div>'+

                               '<div class="col-xs-7">'+d.info+'</div>'+

                             '</div>'+

                             '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>Message:</strong> </div>'+

                               '<div class="col-xs-7 text-left">'+d.completion_message+'</div>'+

                             '</div>'+
                             '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>Start Date:</strong> </div>'+

                               '<div class="col-xs-7 text-left">'+d.start_date+'</div>'+

                             '</div>'+

                             '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>End Date:</strong> </div>'+

                               '<div class="col-xs-7 text-left">'+d.end_date+'</div>'+

                             '</div>'+
                             '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>Security:</strong> </div>'+

                               '<div class="col-xs-7 text-left">'+d.security+'</div>'+

                             '</div>'+
                            '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>Show Results:</strong> </div>'+

                               '<div class="col-xs-7 text-left">'+d.show_results+'</div>'+

                             '</div>'+



                           '</div></div></div>';

             }

         $(document).ready(function() {

         var dt = $('#data-tables').DataTable( {

            oLanguage: {

                     sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

              },

              "iDisplayLength": 25,

              "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

             "processing": true,

             "serverSide": true,

             "ajax": ajax_base_url+"manage_exams/getAjaxdataObjects",

             "columns": [

                 {

                     "class":          "details-control",

                     "orderable":      false,

                     "data":           null,

                     "defaultContent": ""

                 },

                { "data": "chk" },

                { "data": "info" },

                { "data": "start_date" },

                { "data": "end_date" },

                { "data": "security" },
                { "data": "show_results" },

                { "data": "action" }



             ],

             "order": [],

              columnDefs: [

              { orderable: true, targets: [3,4] },

              { orderable: false, targets: [-1,0,1,2] },

              { "width": "5%", "targets": [0,1,5,6] },

 { "width": "10%", "targets": [-1]},
              { "width": "15%", "targets": [3,4]},

              { "width": "40%", "targets": [2]}

             ],

           "fnDrawCallback": function (oSettings) {

                nbr=0;

                     $(".details-control").each(function()

                     {

                         if(nbr > 0)

                         {

                             $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                         }

                         nbr++;

                     });

                     $('tbody').css('border', '1px solid #eee');

          }

         } );

         // Array to track the ids of the details displayed rows

         var detailRows = [];

         $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

             var tr = $(this).closest('tr');

             var row = dt.row( tr );

             var idx = $.inArray( tr.attr('id'), detailRows );

             if ( row.child.isShown() ) {

                 $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                 tr.removeClass( 'details' );

                 row.child.hide();

                 // Remove from the 'open' array

                 detailRows.splice( idx, 1 );

             }

             else {

                 $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                 tr.addClass( 'details' );

                 row.child( format( row.data() ) ).show();

                 // Add to the 'open' array

                 if ( idx === -1 ) {

                     detailRows.push( tr.attr('id') );

                 }

             }

         } );

         // On each draw, loop over the `detailRows` array and show any child rows

         dt.on( 'draw', function () {

             $.each( detailRows, function ( i, id ) {

                 $('#'+id+' td.details-control').trigger( 'click' );

             } );

         } );

     } );



     function delete_confirm(id)

     {

           var done = confirm("Are you sure to delete this record");

           if(done == true)

           {

               var pageurl_new = ajax_base_url+'manage_exams/delete_confirm/'+id;

               window.location.href = pageurl_new;

           }

           else

           {

               return false;

           }

     }

    function validateForm()

      {

            total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

            if(total==0)

            {

                alert("Please select checkbox.");

                return false;

            }

            var listBoxSelection=document.getElementById("listaction").value;

            if(listBoxSelection==0)

            {

                alert("Please select Action");

                return false;

            }

            else

                  if(listBoxSelection == 3){

                  var done = confirm("Are you sure, you want to delete record's from database?");

                  if(done == true){

                    return true;

                  }

                  else

                  {

                    return false;

                  }

            }

      }

     $(document).ready(function()

     {

        $(".case").click(function(){

         var checked_status = this.checked;

         $("#myform input[type=checkbox]").each(function(){

           this.checked = checked_status;

         });

        });

     });

     </script>

    <?php } ?>


<!-- Manage user completed exams -->

<?php if($page_name == 'manage_user_completed_exams_view'){;?>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>



     <script>



     $(document).ready(function() {

       $('#addexam').click(function() {

         document.getElementById('manage_exams').reset();

         $('#manage_exams').find('manage_exams').removeClass('vd_bd-red');

         var validator1 = $( "#manage_exams" ).validate();

           validator1.resetForm();

          });

       });

     </script>




       <script type="text/javascript" language="javascript" >

      function format ( d )

             {

                    return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                     '<div class="panel-heading"> </div>'+

                     '<div class="panel-body">'+

                             '<span style="font-size:20px;font-weight:bold;">Exams Details</span><br><br>'+

                             '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>Quiz info:</strong> </div>'+

                               '<div class="col-xs-7">'+d.info+'</div>'+

                             '</div>'+

                                                         '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>Start Date:</strong> </div>'+

                               '<div class="col-xs-7 text-left">'+d.start_date+'</div>'+

                             '</div>'+

                             '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>End Date:</strong> </div>'+

                               '<div class="col-xs-7 text-left">'+d.end_date+'</div>'+

                             '</div>'+
                             '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>User Info:</strong> </div>'+

                               '<div class="col-xs-7 text-left">'+d.user_info+'</div>'+

                             '</div>'+
                            '<div class="row mgbt-xs-10">'+

                               '<div class="col-xs-5 text-right"> <strong>Exam Completed in:</strong> </div>'+

                               '<div class="col-xs-7 text-left">'+d.exam_completed_in+'</div>'+

                             '</div>'+



                           '</div></div></div>';

             }

         $(document).ready(function() {

         var dt = $('#data-tables').DataTable( {

            oLanguage: {

                     sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

              },

              "iDisplayLength": 25,

              "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

             "processing": true,

             "serverSide": true,

             "ajax": ajax_base_url+"manage_user_completed_exams/getAjaxdataObjects",

             "columns": [

                 {

                     "class":          "details-control",

                     "orderable":      false,

                     "data":           null,

                     "defaultContent": ""

                 },

                { "data": "chk" },

                { "data": "info" },

                { "data": "start_date" },

                { "data": "end_date" },

                { "data": "user_info" },
                { "data": "exam_completed_in" },

                { "data": "action" }



             ],

             "order": [],

              columnDefs: [

              { orderable: true, targets: [3,4] },

              { orderable: false, targets: [-1,0,1,2] },

              { "width": "5%", "targets": [0,1,5,6] },

 { "width": "10%", "targets": [-1]},
              { "width": "15%", "targets": [3,4]},

              { "width": "40%", "targets": [2]}

             ],

           "fnDrawCallback": function (oSettings) {

                nbr=0;

                     $(".details-control").each(function()

                     {

                         if(nbr > 0)

                         {

                             $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                         }

                         nbr++;

                     });

                     $('tbody').css('border', '1px solid #eee');

          }

         } );

         // Array to track the ids of the details displayed rows

         var detailRows = [];

         $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

             var tr = $(this).closest('tr');

             var row = dt.row( tr );

             var idx = $.inArray( tr.attr('id'), detailRows );

             if ( row.child.isShown() ) {

                 $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                 tr.removeClass( 'details' );

                 row.child.hide();

                 // Remove from the 'open' array

                 detailRows.splice( idx, 1 );

             }

             else {

                 $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                 tr.addClass( 'details' );

                 row.child( format( row.data() ) ).show();

                 // Add to the 'open' array

                 if ( idx === -1 ) {

                     detailRows.push( tr.attr('id') );

                 }

             }

         } );

         // On each draw, loop over the `detailRows` array and show any child rows

         dt.on( 'draw', function () {

             $.each( detailRows, function ( i, id ) {

                 $('#'+id+' td.details-control').trigger( 'click' );

             } );

         } );

     } );



     function delete_confirm(id)

     {

           var done = confirm("Are you sure to delete this record");

           if(done == true)

           {

               var pageurl_new = ajax_base_url+'manage_user_completed_exams/delete_confirm/'+id;

               window.location.href = pageurl_new;

           }

           else

           {

               return false;

           }

     }

    function validateForm()

      {

            total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

            if(total==0)

            {

                alert("Please select checkbox.");

                return false;

            }

            var listBoxSelection=document.getElementById("listaction").value;

            if(listBoxSelection==0)

            {

                alert("Please select Action");

                return false;

            }

            else

                  if(listBoxSelection == 3){

                  var done = confirm("Are you sure, you want to delete record's from database?");

                  if(done == true){

                    return true;

                  }

                  else

                  {

                    return false;

                  }

            }

      }

     $(document).ready(function()

     {

        $(".case").click(function(){

         var checked_status = this.checked;

         $("#myform input[type=checkbox]").each(function(){

           this.checked = checked_status;

         });

        });

     });

     </script>

    <?php

 } ?>
<!-- End Manage user exam -->



   <?php if($page_name == 'contact_us/manage_contact_us_view'){;?>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>



    <script>

    $(document).ready(function() {

      $('#Enquiry').click(function() {

        document.getElementById('enquiry').reset();

        $('#enquiry').find('enquiry').removeClass('vd_bd-red');

        var validator1 = $( "#enquiry" ).validate();

          validator1.resetForm();

         });

      });

    </script>



    <script type="text/javascript">

    $(document).ready(function() {

          "use strict";

              var form_register = $('#enquiry');

              var error_register = $('.alert-danger', form_register);

              var success_register = $('.alert-success', form_register);

              form_register.validate({

                  errorElement: 'div', //default input error message container

                  errorClass: 'vd_red', // default input error message class

                  focusInvalid: false, // do not focus the last invalid input

                  ignore: "",

                  rules: {

                      email: {

                              required: true,

                              email: true

                            },

                       subject: {

                           required: true

                      },

                      text: {

                           required: true

                      },

                  },

                  messages: {

                    email: "Please enter email",

                    subject: "Please enter subject",

                    text: "Please enter Message"

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

                      $("#send").attr("disabled", "disabled");

                       sendSubmit();

                  }

              });

    });

    </script>

    <script>

     function sendSubmit(){

       var formData = new FormData($('#enquiry')[0]);

       console.log(formData);

       var pageurl_new = ajax_base_url+'contact_us/send_mail';

         $.ajax({

                    url: pageurl_new,

                    type: 'POST',

                    data: formData,

                    processData: false,

                    contentType: false,

                }).done(function(responce)

                 {

                       window.location.href = ajax_base_url+'contact_us';

              });

         }

  </script>

      <script type="text/javascript" language="javascript" >

        function format ( d )

        {

               return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                '<div class="panel-heading"> </div>'+

                '<div class="panel-body">'+

                        '<span style="font-size:20px;font-weight:bold;">User Details</span><br><br>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>User Name:</strong> </div>'+

                          '<div class="col-xs-7">'+d.info+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Email:</strong> </div>'+

                          '<div class="col-xs-7">'+d.email+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Message:</strong> </div>'+

                          '<div class="col-xs-7">'+d.message+'</div>'+

                        '</div>'+

                      '</div></div></div>';

        }

        $(document).ready(function() {

        var dt = $('#data-tables').DataTable( {

           oLanguage: {

                    sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

             },

             "iDisplayLength": 25,

             "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

            "processing": true,

            "serverSide": true,

            "ajax": ajax_base_url+"contact_us/getAjaxdataObjects",

            "columns": [

                {

                    "class":          "details-control",

                    "orderable":      false,

                    "data":           null,

                    "defaultContent": ""

                },

                { "data": "chk" },

                { "data": "info" },

                { "data": "email" },

                { "data": "status" },

                { "data": "action" },

                //{ "data": "action" }

            ],

            "order": [],

             columnDefs: [

               { orderable: true, targets: [3,4] },

               { orderable: false, targets: [-1,0,1,2] },

               { "width": "5%", "targets": [0,1] },

               { "width": "10%", "targets": [4]},

               { "width": "15%", "targets": [-1,3]},

               { "width": "25%", "targets": [2]}

            ],

          "fnDrawCallback": function (oSettings) {

               nbr=0;

                    $(".details-control").each(function()

                    {

                        if(nbr > 0)

                        {

                            $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                        }

                        nbr++;

                    });

                    $('tbody').css('border', '1px solid #eee');

         }

        } );

        // Array to track the ids of the details displayed rows

        var detailRows = [];

        $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

            var tr = $(this).closest('tr');

            var row = dt.row( tr );

            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                tr.removeClass( 'details' );

                row.child.hide();

                // Remove from the 'open' array

                detailRows.splice( idx, 1 );

            }

            else {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                // Add to the 'open' array

                if ( idx === -1 ) {

                    detailRows.push( tr.attr('id') );

                }

            }

        } );

        // On each draw, loop over the `detailRows` array and show any child rows

        dt.on( 'draw', function () {

            $.each( detailRows, function ( i, id ) {

                $('#'+id+' td.details-control').trigger( 'click' );

            } );

        } );

    } );

    function change_status(userId,status)

    {

      //alert(status);die;

          var done = confirm("Are you sure, you want to change the status?");

          if(done == true)

          {

              var pageurl_new = ajax_base_url+'contact_us/change_status/'+userId+'/'+status;

              window.location.href = pageurl_new;

          }

          else

          {

              return false;

          }

    }

    function replay(userId)

    {

      var pageurl_new = ajax_base_url+'contact_us/replay/'+userId;

      // window.location.href = pageurl_new;

      $.ajax({

         url: pageurl_new,

      }).done(function(responce)

      {

        //console.log(responce);

         if (!$.isEmptyObject(responce))

         {

          $('#myModal').modal('toggle');

          var data = jQuery.parseJSON(responce);

            $.each(data, function()

            {

                $.each(this, function(name, value)

                {

                  if(name!='photo'){

                    $('[name*="'+name+'"]').val(value);

                  }else{

                    $("#blah").attr('src', '<?php echo front_base_url();?>uploads/'+value);

                  }

                });

            });

          }

      });

    }

    function delete_confirm(id)

    {

          var done = confirm("Are you sure to delete this record");

          if(done == true)

          {

              var pageurl_new = ajax_base_url+'contact_us/delete_confirm/'+id;

              window.location.href = pageurl_new;

          }

          else

          {

              return false;

          }

    }

   function validateForm()

     {

           total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

           if(total==0)

           {

               alert("Please select checkbox.");

               return false;

           }

           var listBoxSelection=document.getElementById("listaction").value;

           if(listBoxSelection==0)

           {

               alert("Please select Action");

               return false;

           }

           else

                 if(listBoxSelection == 3){

                 var done = confirm("Are you sure, you want to delete record's from database?");

                 if(done == true){

                   return true;

                 }

                 else

                 {

                   return false;

                 }

           }

     }

    $(document).ready(function()

    {

       $(".case").click(function(){

        var checked_status = this.checked;

        $("#myform input[type=checkbox]").each(function(){

          this.checked = checked_status;

        });

       });

    });

    </script>

   <?php } ?>

   <?php if($page_name == 'email_template/manage_email_template_view'){;?>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>jscripts/tiny_mce/tiny_mce.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

      <script type="text/javascript">

      $(document).ready(function() {

            "use strict";

                var form_register = $('#emailTemplate');

                var error_register = $('.alert-danger', form_register);

                var success_register = $('.alert-success', form_register);

                form_register.validate({

                    errorElement: 'div', //default input error message container

                    errorClass: 'vd_red', // default input error message class

                    focusInvalid: false, // do not focus the last invalid input

                    ignore: "",

                    rules: {

                        email_contains: {

                                required: true,

                              },

                         subject: {

                             required: true

                        },

                    },

                    messages: {

                      email_contains: "Please enter email Contains",

                      subject: "Please enter subject"

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

                        $("#email").attr("disabled", "disabled");

                        emailTemplateSubmit();

                    }

                });

      });

      </script>

      <script>

       function emailTemplateSubmit(){

         tinyMCE.triggerSave();

        var formData = $('#email_contains').val();

         var formData = new FormData($('#emailTemplate')[0]);

         console.log(formData);

         var pageurl_new = ajax_base_url+'email_template/add_edit_email';

           $.ajax({

                      url: pageurl_new,

                      type: 'POST',

                      data: formData,

                      processData: false,

                      contentType: false,

                  }).done(function(responce)

                   {

                         var data = jQuery.parseJSON(responce);
                         notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                         var dTable = $('#data-tables').DataTable();
                          dTable.ajax.reload();
                          $('#myModal').modal('toggle');

                });

           }

           function edit_email_template(templateId)

           {

                var pageurl_new = ajax_base_url+'email_template/edit_email_template/'+templateId;

                $.ajax({

                   url: pageurl_new,

                }).done(function(responce)

                {

                     if (!$.isEmptyObject(responce))

                     {

                      $('#myModal').modal('toggle');

                      var data = jQuery.parseJSON(responce);

                    console.log(data);

                        $.each(data, function()

                        {

                            $.each(this, function(name, value)

                            {

                              if(name!='email_contains'){

                                $('[name*="'+name+'"]').val(value);

                              }else{

                               tinyMCE.get('email_contains').setContent(value);

                              }

                            });

                        });

                     }

                });

            }

    </script>

    <script type="text/javascript">

      tinyMCE.init({

        // General options

        mode : "textareas",

        theme : "advanced",

        height:200,

        plugins : "openmanager,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

        // Theme options

        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,blockquote,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect",

        theme_advanced_buttons2 : "bullist,numlist,undo,redo,link,unlink,forecolor,backcolor,media,image,openmanager,preview,code,,fullscreen",

        theme_advanced_toolbar_location : "top",

        theme_advanced_toolbar_align : "left",

        theme_advanced_statusbar_location : "bottom",

        theme_advanced_resizing : true,

        //Open Manager Options

        file_browser_callback: "openmanager",

        open_manager_upload_path: '../../../../uploads/',

        // Example content CSS (should be your site CSS)

        content_css : "content.css",

        // Drop lists for link/image/media/template dialogs

        template_external_list_url : "lists/template_list.js",

        external_link_list_url : "lists/link_list.js",

        external_image_list_url : "lists/image_list.js",

        media_external_list_url : "lists/media_list.js",

        // Style formats

        style_formats: [

        {title: "Headers", items: [

            {title: "Header 1", format: "h1"},

            {title: "Header 2", format: "h2"},

            {title: "Header 3", format: "h3"},

            {title: "Header 4", format: "h4"},

            {title: "Header 5", format: "h5"},

            {title: "Header 6", format: "h6"}

        ]},

        {title: "Inline", items: [

            {title: "Bold", icon: "bold", format: "bold"},

            {title: "Italic", icon: "italic", format: "italic"},

            {title: "Underline", icon: "underline", format: "underline"},

            {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},

            {title: "Superscript", icon: "superscript", format: "superscript"},

            {title: "Subscript", icon: "subscript", format: "subscript"},

            {title: "Code", icon: "code", format: "code"}

        ]},

        {title: "Blocks", items: [

            {title: "Paragraph", format: "p"},

            {title: "Blockquote", format: "blockquote"},

            {title: "Div", format: "div"},

            {title: "Pre", format: "pre"}

        ]},

        {title: "Alignment", items: [

            {title: "Left", icon: "alignleft", format: "alignleft"},

            {title: "Center", icon: "aligncenter", format: "aligncenter"},

            {title: "Right", icon: "alignright", format: "alignright"},

            {title: "Justify", icon: "alignjustify", format: "alignjustify"}

        ]}

    ],

        // Replace values for the template plugin

        template_replace_values : {

          username : "Some User",

          staffid : "991234"

        }

      });

    </script>

      <script type="text/javascript" language="javascript" >

        function format ( d )

        {

               return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                '<div class="panel-heading"> </div>'+

                '<div class="panel-body">'+

                        '<span style="font-size:20px;font-weight:bold;">Email Template</span><br><br>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Template Id:</strong> </div>'+

                          '<div class="col-xs-7">'+d.id+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Subject:</strong> </div>'+

                          '<div class="col-xs-7">'+d.subject+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Status:</strong> </div>'+

                          '<div class="col-xs-7">'+d.status+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Email Contains:</strong> </div>'+

                          '<div class="col-xs-7">'+d.email_contains+'</div>'+

                        '</div>'+

                      '</div></div></div>';

        }

        $(document).ready(function() {

        var dt = $('#data-tables').DataTable( {

           oLanguage: {

                    sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

             },

             "iDisplayLength": 25,

             "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

            "processing": true,

            "serverSide": true,

            "ajax": ajax_base_url+"email_template/getAjaxdataObjects",

            "columns": [

                {

                    "class":          "details-control",

                    "orderable":      false,

                    "data":           null,

                    "defaultContent": ""

                },

                { "data": "chk" },

                { "data": "id" },

                { "data": "subject" },

                { "data": "status" },

                { "data": "action" }

            ],

            "order": [],

             columnDefs: [

               { orderable: true, targets: [3,4] },

               { orderable: false, targets: [-1,0,1,2] },

               { "width": "1%", "targets": [0,1] },

               { "width": "10%", "targets": [4]},

               { "width": "5%", "targets": [-1,3]},

               { "width": "5%", "targets": [2,5]}

            ],

          "fnDrawCallback": function (oSettings) {

               nbr=0;

                    $(".details-control").each(function()

                    {

                        if(nbr > 0)

                        {

                            $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                        }

                        nbr++;

                    });

                    $('tbody').css('border', '1px solid #eee');

              }

        } );

        // Array to track the ids of the details displayed rows

        var detailRows = [];

        $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

            var tr = $(this).closest('tr');

            var row = dt.row( tr );

            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                tr.removeClass( 'details' );

                row.child.hide();

                // Remove from the 'open' array

                detailRows.splice( idx, 1 );

            }

            else {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                // Add to the 'open' array

                if ( idx === -1 ) {

                    detailRows.push( tr.attr('id') );

                }

            }

        } );

        // On each draw, loop over the `detailRows` array and show any child rows

        dt.on( 'draw', function () {

            $.each( detailRows, function ( i, id ) {

                $('#'+id+' td.details-control').trigger( 'click' );

            } );

        } );

    } );

   function change_status(emailId,status)

     {

           var done = confirm("Are you sure, you want to change the status?");

           if(done == true)

           {

               var pageurl_new = ajax_base_url+'email_template/change_status/'+emailId+'/'+status;

               window.location.href = pageurl_new;

           }

           else

           {

               return false;

           }

     }

   function delete_confirm(id)

    {

          var done = confirm("Are you sure to delete this record");

          if(done == true)

          {

              var pageurl_new = ajax_base_url+'email_template/delete_confirm/'+id;

              window.location.href = pageurl_new;

          }

          else

          {

              return false;

          }

    }

    function validateForm()

      {

            total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

            if(total==0)

            {

                alert("Please select checkbox.");

                return false;

            }

            var listBoxSelection=document.getElementById("listaction").value;

            if(listBoxSelection==0)

            {

                alert("Please select Action");

                return false;

            }

            else

                  if(listBoxSelection == 3){

                  var done = confirm("Are you sure, you want to delete record's from database?");

                  if(done == true){

                    return true;

                  }

                  else

                  {

                    return false;

                  }

            }

      }

    $(document).ready(function()

    {

       $(".case").click(function(){

        var checked_status = this.checked;

        $("#myform input[type=checkbox]").each(function(){

          this.checked = checked_status;

        });

       });

    });

    </script>

   <?php } ?>



   <?php if($page_name == 'widgets/manage_widgets_view'){;?>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>jscripts/tiny_mce/tiny_mce.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

      <script type="text/javascript">

      $(document).ready(function() {

            "use strict";

                var form_register = $('#widgets');

                var error_register = $('.alert-danger', form_register);

                var success_register = $('.alert-success', form_register);

                form_register.validate({

                    errorElement: 'div', //default input error message container

                    errorClass: 'vd_red', // default input error message class

                    focusInvalid: false, // do not focus the last invalid input

                    ignore: "",

                    rules: {

                        info: {

                                required: true,

                              },

                         widget_name: {

                             required: true

                        },

                       page_name: {

                             required: true

                        },

                    },

                    messages: {

                      info: "Please enter Contains",

                      widget_name: "Please enter Subject",

                      page_name: "Please enter Page Name"

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

                        $("#widgets").attr("disabled", "disabled");

                        widgetsSubmit();

                    }

                });

      });

      </script>

      <script>

       function widgetsSubmit(){

         tinyMCE.triggerSave();

        var formData = $('#info').val();

         var formData = new FormData($('#widgets')[0]);

         var pageurl_new = ajax_base_url+'widgets/add_edit_widgets';

           $.ajax({

                      url: pageurl_new,

                      type: 'POST',

                      data: formData,

                      processData: false,

                      contentType: false,

                  }).done(function(responce)

                   {
                      var data = jQuery.parseJSON(responce);
                      notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                      var dTable = $('#data-tables').DataTable();
                       dTable.ajax.reload();
                       $('#myModal').modal('toggle');

                   });

           }

           function edit_widgets(widgetsId)

           {

                var pageurl_new = ajax_base_url+'widgets/edit_widgets/'+widgetsId;

                $.ajax({

                   url: pageurl_new,

                }).done(function(responce)

                {

                     if (!$.isEmptyObject(responce))

                     {

                      $('#myModal').modal('toggle');

                      var data = jQuery.parseJSON(responce);

                        $.each(data, function()

                        {

                            $.each(this, function(name, value)

                            {

                               if(name!='info')

                                 {

                                  $('[name*="'+name+'"]').val(value);

                                 }

                                 else

                                 {

                                    tinyMCE.get('info').setContent(value);

                                 }

                            });

                        });

                     }

                });

            }

    </script>

    <script type="text/javascript">

      tinyMCE.init({

        // General options

        mode : "textareas",

        theme : "advanced",

        height:200,

        plugins : "openmanager,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

        // Theme options

        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,blockquote,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect",

        theme_advanced_buttons2 : "bullist,numlist,undo,redo,link,unlink,forecolor,backcolor,media,image,openmanager,preview,code,,fullscreen",

        theme_advanced_toolbar_location : "top",

        theme_advanced_toolbar_align : "left",

        theme_advanced_statusbar_location : "bottom",

        theme_advanced_resizing : true,

        //Open Manager Options

        file_browser_callback: "openmanager",

        open_manager_upload_path: '../../../../uploads/',

        // Example content CSS (should be your site CSS)

        content_css : "content.css",

        // Drop lists for link/image/media/template dialogs

        template_external_list_url : "lists/template_list.js",

        external_link_list_url : "lists/link_list.js",

        external_image_list_url : "lists/image_list.js",

        media_external_list_url : "lists/media_list.js",

        // Style formats

        style_formats: [

        {title: "Headers", items: [

            {title: "Header 1", format: "h1"},

            {title: "Header 2", format: "h2"},

            {title: "Header 3", format: "h3"},

            {title: "Header 4", format: "h4"},

            {title: "Header 5", format: "h5"},

            {title: "Header 6", format: "h6"}

        ]},

        {title: "Inline", items: [

            {title: "Bold", icon: "bold", format: "bold"},

            {title: "Italic", icon: "italic", format: "italic"},

            {title: "Underline", icon: "underline", format: "underline"},

            {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},

            {title: "Superscript", icon: "superscript", format: "superscript"},

            {title: "Subscript", icon: "subscript", format: "subscript"},

            {title: "Code", icon: "code", format: "code"}

        ]},

        {title: "Blocks", items: [

            {title: "Paragraph", format: "p"},

            {title: "Blockquote", format: "blockquote"},

            {title: "Div", format: "div"},

            {title: "Pre", format: "pre"}

        ]},

        {title: "Alignment", items: [

            {title: "Left", icon: "alignleft", format: "alignleft"},

            {title: "Center", icon: "aligncenter", format: "aligncenter"},

            {title: "Right", icon: "alignright", format: "alignright"},

            {title: "Justify", icon: "alignjustify", format: "alignjustify"}

        ]}

    ],

        // Replace values for the template plugin

        template_replace_values : {

          username : "Some User",

          staffid : "991234"

        }

      });

    </script>

      <script type="text/javascript" language="javascript" >

        function format ( d )

        {

               return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                '<div class="panel-heading"> </div>'+

                '<div class="panel-body">'+

                        '<span style="font-size:20px;font-weight:bold;">Information</span><br><br>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div>'+d.fullcontains+'</div>'+

                        '</div>'+

                      '</div></div></div>';

        }

        $(document).ready(function() {

        var dt = $('#data-tables').DataTable( {

           oLanguage: {

                    sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

             },

             "iDisplayLength": 25,

             "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

            "processing": true,

            "serverSide": true,

            "ajax": ajax_base_url+"widgets/getAjaxdataObjects",

            "columns": [

                {

                    "class":          "details-control",

                    "orderable":      false,

                    "data":           null,

                    "defaultContent": ""

                },

                { "data": "page_name" },

                { "data": "widget_name" },

                { "data": "contains" },

                { "data": "action" }

            ],

            "order": [],

             columnDefs: [

               { orderable: true, targets: [2,3] },

               { orderable: false, targets: [-1,0] },

               { "width": "5%", "targets": [0,1] },

               { "width": "50%", "targets": [3]},

               { "width": "20%", "targets": [2]},

               { "width": "5%", "targets": [2,1,-1]}

            ],

          "fnDrawCallback": function (oSettings) {

               nbr=0;

                    $(".details-control").each(function()

                    {

                        if(nbr > 0)

                        {

                            $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                        }

                        nbr++;

                    });

                    $('tbody').css('border', '1px solid #eee');

              }

        } );

        // Array to track the ids of the details displayed rows

        var detailRows = [];

        $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

            var tr = $(this).closest('tr');

            var row = dt.row( tr );

            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                tr.removeClass( 'details' );

                row.child.hide();

                // Remove from the 'open' array

                detailRows.splice( idx, 1 );

            }

            else {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                // Add to the 'open' array

                if ( idx === -1 ) {

                    detailRows.push( tr.attr('id') );

                }

            }

        } );

        // On each draw, loop over the `detailRows` array and show any child rows

        dt.on( 'draw', function () {

            $.each( detailRows, function ( i, id ) {

                $('#'+id+' td.details-control').trigger( 'click' );

            } );

        } );

    } );

    function validateForm()

      {

            total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

            if(total==0)

            {

                alert("Please select checkbox.");

                return false;

            }

            var listBoxSelection=document.getElementById("listaction").value;

            if(listBoxSelection==0)

            {

                alert("Please select Action");

                return false;

            }

            else

                  if(listBoxSelection == 3){

                  var done = confirm("Are you sure, you want to delete record's from database?");

                  if(done == true){

                    return true;

                  }

                  else

                  {

                    return false;

                  }

            }

      }

    $(document).ready(function()

    {

       $(".case").click(function(){

        var checked_status = this.checked;

        $("#myform input[type=checkbox]").each(function(){

          this.checked = checked_status;

        });

       });

    });

    </script>

   <?php } ?>

   <?php if($page_name == 'settings/manage_settings_view'){;?>

      <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>assets/js/jscolor.js"></script>

      <script src="jscolor.js"></script>

      <script>

        function readURL(input)

        {

          if (input.files && input.files[0])

          {

            var reader = new FileReader();

            reader.onload = function (e)

            {

              $('#blah').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);

          }

        }

        function readURL1(input)

        {

          if (input.files && input.files[0])

          {

            var reader = new FileReader();

            reader.onload = function (e)

            {

              $('#blahFavicon').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);

          }

        }

        function home_page_images(input)

        {

          if (input.files && input.files[0])

          {

            var reader = new FileReader();

            reader.onload = function (e)

            {

              $('#blahHome').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);

          }

        }

    </script>

    <script type="text/javascript" language="javascript" >

    function validateForm()

    {

      var total="";

      for(var i=0; i < document.myform.check.length; i++)

      {

          if(document.myform.check[i].checked)

          total +=document.myform.check[i].value + "\n";

      }

      if(total=="")

      {

          alert("Please select checkbox.");

          return false;

      }

      var listBoxSelection=document.getElementById("listaction").value;

      if(listBoxSelection==0)

      {

          alert("Please select Action");

          return false;

      }

      else

          if(listBoxSelection == 3)

          {

          var done = confirm("Are you sure, you want to delete record's from database?");

          if(done == true){

            return true;

          }

          else

          {

            return false;

          }

      }

    }

    </script>

    <script>

    function emailProtocol(element)

    {

      var protocol=$(element).val();

      if(protocol=='php_mail')

      {

        $("#smtp_host").hide();

        $("#smtp_user").hide();

        $("#smtp_password").hide();

        $("#smtp_port").hide();

      }

      else  if(protocol=='smtp')

      {

        $("#smtp_host").show();

        $("#smtp_user").show();

        $("#smtp_password").show();

        $("#smtp_port").show();

      }

    }

    $(document).ready(function(){

      "use strict";

          var form_register = $('#email_setting');

          var error_register = $('.alert-danger', form_register);

          var success_register = $('.alert-success', form_register);

          form_register.validate({

              errorElement: 'div', //default input error message container

              errorClass: 'vd_red', // default input error message class

              focusInvalid: false, // do not focus the last invalid input

              ignore: ":hidden",

              rules: {

                  smtp_host: {

                          required: true,

                        },

                   smtp_user: {

                       required: true

                  },

                 smtp_password: {

                       required: true

                  },

                  smtp_port: {

                        required: true

                   },

              },

              messages: {

                smtp_host: "Please enter Smtp Host",

                smtp_user: "Please enter Smtp User",

                smtp_password: "Please enter Smtp Password",

                smtp_port: "Please enter Smtp Port"

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

                  return true;

              }

          });

  });

    </script>

   <?php } ?>

   <?php if($page_name == 'social_settings/social_settings_view'){;?>

      <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

    <script type="text/javascript" language="javascript" >

    function validateForm()

    {

      var total="";

      for(var i=0; i < document.myform.check.length; i++)

      {

          if(document.myform.check[i].checked)

          total +=document.myform.check[i].value + "\n";

      }

      if(total=="")

      {

          alert("Please select checkbox.");

          return false;

      }

      var listBoxSelection=document.getElementById("listaction").value;

      if(listBoxSelection==0)

      {

          alert("Please select Action");

          return false;

      }

      else

          if(listBoxSelection == 3)

          {

          var done = confirm("Are you sure, you want to delete record's from database?");

          if(done == true){

            return true;

          }

          else

          {

            return false;

          }

      }

    }

     </script>

   <?php } ?>

    <?php if($page_name == 'cms_page/manage_cms_page_view'){;?>

      <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>jscripts/tiny_mce/tiny_mce.js"></script>

      <script type="text/javascript">

      tinyMCE.init({

                // General options

                mode : "textareas",

                theme : "advanced",

                height:200,

                plugins : "openmanager,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

                // Theme options

                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,blockquote,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect",

                theme_advanced_buttons2 : "bullist,numlist,undo,redo,link,unlink,forecolor,backcolor,media,image,openmanager,preview,code,,fullscreen",

                theme_advanced_toolbar_location : "top",

                theme_advanced_toolbar_align : "left",

                theme_advanced_statusbar_location : "bottom",

                theme_advanced_resizing : true,

                //Open Manager Options

                file_browser_callback: "openmanager",

                open_manager_upload_path: '../../../../uploads/',

                // Example content CSS (should be your site CSS)

                content_css : "content.css",

                // Drop lists for link/image/media/template dialogs

                template_external_list_url : "lists/template_list.js",

                external_link_list_url : "lists/link_list.js",

                external_image_list_url : "lists/image_list.js",

                media_external_list_url : "lists/media_list.js",

                // Style formats

                style_formats: [

                                {title: "Headers", items: [

                                {title: "Header 1", format: "h1"},

                                {title: "Header 2", format: "h2"},

                                {title: "Header 3", format: "h3"},

                                {title: "Header 4", format: "h4"},

                                {title: "Header 5", format: "h5"},

                                {title: "Header 6", format: "h6"}

                                ]},

                                {title: "Inline", items: [

                                {title: "Bold", icon: "bold", format: "bold"},

                                {title: "Italic", icon: "italic", format: "italic"},

                                {title: "Underline", icon: "underline", format: "underline"},

                                {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},

                                {title: "Superscript", icon: "superscript", format: "superscript"},

                                {title: "Subscript", icon: "subscript", format: "subscript"},

                                {title: "Code", icon: "code", format: "code"}

                                ]},

                                {title: "Blocks", items: [

                                {title: "Paragraph", format: "p"},

                                {title: "Blockquote", format: "blockquote"},

                                {title: "Div", format: "div"},

                                {title: "Pre", format: "pre"}

                                ]},

                                {title: "Alignment", items: [

                                {title: "Left", icon: "alignleft", format: "alignleft"},

                                {title: "Center", icon: "aligncenter", format: "aligncenter"},

                                {title: "Right", icon: "alignright", format: "alignright"},

                                {title: "Justify", icon: "alignjustify", format: "alignjustify"}

                                ]}

                                ],

                // Replace values for the template plugin

                template_replace_values : {

                  username : "Some User",

                  staffid : "991234"

                }

          });

      </script>

      <script type="text/javascript">

      $(document).ready(function() {

            "use strict";

                var form_register = $('#cms_page');

                var error_register = $('.alert-danger', form_register);

                var success_register = $('.alert-success', form_register);

                form_register.validate({

                    errorElement: 'div', //default input error message container

                    errorClass: 'vd_red', // default input error message class

                    focusInvalid: false, // do not focus the last invalid input

                    ignore: "",

                    rules: {

                        title: {

                                required: true,

                               },

                         heading: {

                                   required: true

                                  },

                        url: {

                             required: true

                             },

                       meta_desc: {

                                  required: true

                                 },

                       description: {

                            required: true

                            },

                      keywords: {

                              required: true,

                             },

                    },

                    messages: {

                      title: "Please enter Title",

                      heading: "Please enter Heading",

                      url: "Please enter url",

                      meta_desc: "Please enter Meta Description",

                      description: "Please enter Description",

                      keywords: "Please enter Keywords"

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

                      $("#saveCms").attr("disabled", "disabled");

                      cms_pageSubmit();

                    }

                });

      });

      </script>

        <script>

         function cms_pageSubmit(){

           tinyMCE.triggerSave();

          var formData = $('#description').val();

           var formData = new FormData($('#cms_page')[0]);

           console.log(formData);

           var pageurl_new = ajax_base_url+'cms_page/add_edit';

             $.ajax({

                        url: pageurl_new,

                        type: 'POST',

                        data: formData,

                        processData: false,

                        contentType: false,

                    }).done(function(responce)

                     {
                          var data = jQuery.parseJSON(responce);
                          notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                          var dTable = $('#data-tables').DataTable();
                           dTable.ajax.reload();
                           $('#myModal').modal('toggle');

                  });

             }

             function edit_cms_page(userId)

             {

                  var pageurl_new = ajax_base_url+'cms_page/edit_cms/'+userId;

                  $.ajax({

                     url: pageurl_new,

                  }).done(function(responce)

                  {

                       if (!$.isEmptyObject(responce))

                       {

                        $('#myModal').modal('toggle');

                        var data = jQuery.parseJSON(responce);

                          $.each(data, function()

                          {

                              $.each(this, function(name, value)

                              {

                                if(name!='description'){

                                  $('[name*="'+name+'"]').val(value);

                                 }else{

                                 tinyMCE.activeEditor.setContent(value);

                                }

                              });

                          });

                       }

                  });

              }

      </script>

      <script type="text/javascript" language="javascript" >

        function format ( d )

        {

         return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

          '<div class="panel-heading"> </div>'+

          '<div class="panel-body">'+

                  '<span style="font-size:20px;font-weight:bold;">User Details</span><br><br>'+

                  '<div class="row mgbt-xs-10">'+

                    '<div class="col-xs-5 text-right"> <strong>Title:</strong> </div>'+

                    '<div class="col-xs-7">'+d.title+'</div>'+

                  '</div>'+

                  '<div class="row mgbt-xs-10">'+

                    '<div class="col-xs-5 text-right"> <strong>Url:</strong> </div>'+

                    '<div class="col-xs-7">'+d.url+'</div>'+

                  '</div>'+

                  '<div class="row mgbt-xs-10">'+

                    '<div class="col-xs-5 text-right"> <strong>Status:</strong> </div>'+

                    '<div class="col-xs-7">'+d.status+'</div>'+

                  '</div>'+

                  '<div class="row mgbt-xs-10">'+

                    '<div class="col-xs-5 text-right"> <strong>Heading:</strong> </div>'+

                    '<div class="col-xs-7">'+d.heading+'</div>'+

                  '</div>'+

                  '<div class="row mgbt-xs-10">'+

                    '<div class="col-xs-5 text-right"> <strong>Keywords:</strong> </div>'+

                    '<div class="col-xs-7">'+d.keywords+'</div>'+

                  '</div>'+

                  '<div class="row mgbt-xs-10">'+

                    '<div class="col-xs-5 text-right"> <strong>Meta Description:</strong> </div>'+

                    '<div class="col-xs-7">'+d.meta_desc+'</div>'+

                  '</div>'+

                  '<div class="row mgbt-xs-10">'+

                    '<div class="col-xs-5 text-right"> <strong>Description:</strong> </div>'+

                    '<div class="col-xs-7">'+d.description+'</div>'+

                  '</div>'+

         '</div></div></div>';

        }

        $(document).ready(function()

        {

          var dt = $('#data-tables').DataTable(

          {

            oLanguage: {

                    sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

                      },

            "iDisplayLength": 25,

            "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

            "processing": true,

            "serverSide": true,

            "ajax": ajax_base_url+"cms_page/getAjaxdataObjects",

            "columns": [

                {

                    "class":          "details-control",

                    "orderable":      false,

                    "data":           null,

                    "defaultContent": ""

                },

                { "data": "chk" },

                { "data": "title" },

                { "data": "url" },

                { "data": "status" },

                { "data": "action" }

            ],

            "order": [],

             columnDefs: [

               { orderable: true, targets: [3,4] },

               { orderable: false, targets: [-1,0,1,2] },

               { "width": "5%", "targets": [0,1] },

               { "width": "10%", "targets": [4]},

               { "width": "15%", "targets": [-1,3]},

               { "width": "25%", "targets": [2,3]}

            ],

          "fnDrawCallback": function (oSettings)

          {

           nbr=0;

                $(".details-control").each(function()

                {

                  if(nbr > 0)

                    {

                        $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                    }

                    nbr++;

                });

            $('tbody').css('border', '1px solid #eee');

         }

      } );

        // Array to track the ids of the details displayed rows

        var detailRows = [];

        $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

            var tr = $(this).closest('tr');

            var row = dt.row( tr );

            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                tr.removeClass( 'details' );

                row.child.hide();

                // Remove from the 'open' array

                detailRows.splice( idx, 1 );

            }

            else {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                // Add to the 'open' array

                if ( idx === -1 ) {

                    detailRows.push( tr.attr('id') );

                }

            }

        } );

        // On each draw, loop over the `detailRows` array and show any child rows

        dt.on( 'draw', function () {

            $.each( detailRows, function ( i, id ) {

                $('#'+id+' td.details-control').trigger( 'click' );

            } );

        } );

    } );

   function change_status(Id,status)

     {

       //alert(status);die;

           var done = confirm("Are you sure, you want to change the status?");

           if(done == true)

           {

               var pageurl_new = ajax_base_url+'cms_page/change_status/'+Id+'/'+status;

               window.location.href = pageurl_new;

           }

           else

           {

               return false;

           }

     }

   function delete_confirm(id)

    {

        var done = confirm("Are you sure to delete this record");

        if(done == true)

        {

            var pageurl_new = ajax_base_url+'cms_page/delete_confirm/'+id;

            window.location.href = pageurl_new;

        }

        else

        {

            return false;

        }

    }

   function validateForm()

     {

           total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

           if(total==0)

           {

               alert("Please select checkbox.");

               return false;

           }

           var listBoxSelection=document.getElementById("listaction").value;

           if(listBoxSelection==0)

           {

               alert("Please select Action");

               return false;

           }

           else

                 if(listBoxSelection == 3){

                 var done = confirm("Are you sure, you want to delete record's from database?");

                 if(done == true){

                   return true;

                 }

                 else

                 {

                   return false;

                 }

           }

     }

    $(document).ready(function()

    {

       $(".case").click(function(){

        var checked_status = this.checked;

        $("#myform input[type=checkbox]").each(function(){

          this.checked = checked_status;

        });

       });

    });

    </script>

   <?php } ?>





      <?php if($page_name == 'manage_quiz/manage_quiz_view'){;?>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/tagsInput/jquery.tagsinput.min.js"></script>



    <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/formValidation.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/framework/bootstrap.js"></script>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>



  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/froala_editor.min.js" ></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/align.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/char_counter.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/code_beautifier.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/code_view.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/colors.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/draggable.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/emoticons.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/entities.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/file.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/font_size.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/font_family.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/fullscreen.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/image.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/image_manager.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/line_breaker.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/inline_style.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/link.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/lists.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/paragraph_format.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/paragraph_style.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/quick_insert.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/quote.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/table.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/save.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/url.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/editor/js/plugins/video.min.js"></script>

  <script>

    $(function(){

      $('.editor').froalaEditor({

      // Set the image upload URL.

      imageUploadURL: '<?php echo base_url();?>quiz/editor_upload_file'

    });



    });

  </script>



<script type="text/javascript">

    $(document).ready(function() {

      $('#questionForm [name="question"]').on('froalaEditor.contentChanged', function () {

                $('#questionForm').formValidation('revalidateField', 'question');

                  hideCPR();

            });



        $('#questionForm [name="option[]"]').on('froalaEditor.contentChanged', function () {

                $('#questionForm').formValidation('revalidateField', 'option[]');

        hideCPR();

            });



        $('#questionForm')

            .formValidation({

                framework: 'bootstrap',

                icon: {

                    valid: 'glyphicon glyphicon-ok',

                    invalid: 'glyphicon glyphicon-remove',

                    validating: 'glyphicon glyphicon-refresh'

                },

                excluded: false,

                fields: {

                    question: {

                         validators: {

                            notEmpty: {

                                message: 'Question  is required'

                            }

                        }

                    },

                    marks: {

                        validators: {

                            notEmpty: {

                                message: 'Marks is required'

                            }

                        }

                    },

                    category: {

                        validators: {

                            notEmpty: {

                                message: 'Category is required'

                            }

                        }

                    },

                    'option[]': {

                        validators: {

                            notEmpty: {

                                message: 'Option is required'

                            }

                        }

                    }

                }

            })

            .bootstrapWizard({

        'tabClass': 'nav nav-pills nav-justified',

        'nextSelector': '.wizard .next',

        'previousSelector': '.wizard .prev',

        'onTabShow' :  function(tab, navigation, index){



          $('#questionForm .finish').hide();

          $('#questionForm .next').show();

          if ($('#questionForm .nav li:last-child').hasClass('active')){



            if($('input[type="radio"]:checked').length != 1)

            {

                  $('.form-wizard').bootstrapWizard('show',1);

                  notification("topright","error","fa fa-exclamation-circle vd_red","Error",'Select correct option.');

                  return false;

            }



            $('#questionForm .next').hide();

            var formElem = $("#questionForm");

            var formdata = new FormData(formElem[0]);



            $.ajax({

              url: '<?php echo base_url();?>quiz/generatePreview',

              type: 'POST',

              data: formdata,

              processData: false,

              contentType: false

            })

            .done(function(resp) {

              $('#tab23').html(resp);

              $('#questionForm .finish').show();

            });



          }

          var $total = navigation.find('li').length;

          var $current = index+1;

          var $percent = ($current/$total) * 100;

          $('#questionForm').find('.progress-bar').css({width:$percent+'%'});



          var numTabs = $('#questionForm').find('.tab-pane').length;

                          $('#questionForm')

                              .find('.next')

                                  .removeClass('disabled')    // Enable the Next button

                                  .find('a')

                                  .html(index === numTabs - 1 ? 'Install' : 'Next');

        },

        'onTabClick': function(tab, navigation, index) {

          return validateTab(index);

        },

        'onNext': function(tab, navigation, index){

          scrollTo('#questionForm',-100);

          var numTabs    = $('#questionForm').find('.tab-pane').length,

                              isValidTab = validateTab(index - 1);

                          if (!isValidTab) {

                              return false;

                          }

                          return true;

        },

        'onPrevious': function(tab, navigation, index){

          scrollTo('#questionForm',-100);

          return validateTab(index + 1);

        }

      });



    });



    function validateTab(index) {

        var fv   = $('#questionForm').data('formValidation'), // FormValidation instance

            $tab = $('#questionForm').find('.tab-pane').eq(index);

        fv.validateContainer($tab);



        var isValidStep = fv.isValidContainer($tab);

        if (isValidStep === false || isValidStep === null) {

            return false;

        }



        return true;

    }



      function questionSubmit(){

        var formData = new FormData($('#AddQuestion')[0]);

        var pageurl_new = ajax_base_url+'quiz/add';

          $.ajax({

                     url: pageurl_new,

                     type: 'POST',

                     data: formData,

                     processData: false,

                     contentType: false,

                 }).done(function(responce)

                  {

                        window.location.href = ajax_base_url+'quiz';

               });

          }



    function edit_question(quizId)

    {

         var pageurl_new = ajax_base_url+'quiz/edit_question/'+quizId;

         $.ajax({

            url: pageurl_new,

         }).done(function(responce)

         {

         // console.log(responce);



          if (!$.isEmptyObject(responce))

          {



             var data = jQuery.parseJSON(responce);

             var i=0;

             $.each(data.option, function(index, val)

             {

                        checked='';

                        if(val.correct_answer == 1)

                        {

                              checked='checked="checked"';

                        }

                       if(i==0)

                       {

                              $('#tab22').html(' <div class="row voca"><div class="col-md-8"><label class="control-label">Option</label><div class="controls form-group"><textarea name="option[]" id="option" placeholder="Enter option...." class="input-border-btm form-control editor">'+val.option+'</textarea></div></div><div class="col-md-2" style="margin-top:150px;text-align: center"><div class="vd_radio radio-success"><input name="is_correct" '+checked+' value="'+i+'" id="is_correct_'+i+'" type="radio" class=""><label for="is_correct_'+i+'"> Correct Option </label></div></div><div class="col-md-2" style="margin-top:150px;"><button type="button" class="btn btn-success btn-add" ><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add Option</button></div><input type="hidden" name="option_id[]" value="'+val.option_id+'"></div>');

                       }

                       else

                       {

                              $('#tab22').append(' <div class="row voca"><div class="col-md-8"><label class="control-label">Option</label><div class="controls form-group"><textarea name="option[]" id="option" placeholder="Enter option...." class="input-border-btm form-control editor">'+val.option+'</textarea></div></div><div class="col-md-2" style="margin-top:150px;text-align: center"><div class="vd_radio radio-success"><input name="is_correct" '+checked+' value="'+i+'" id="is_correct_'+i+'" type="radio" class=""><label for="is_correct_'+i+'"> Correct Option </label></div></div><div class="col-md-2" style="margin-top:150px;"><button type="button" class="btn btn-danger btn-remove" ><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Remove Option</button></div><input type="hidden" name="option_id[]" value="'+val.option_id+'"></div>');

                       }



                $('[name*="option[]"]').froalaEditor({

                      // Set the image upload URL.

                      imageUploadURL: '<?php echo base_url();?>quiz/editor_upload_file'

                    });

                    i++;

             });

            $('#questionForm').formValidation('addField', 'option[]');

          $('#questionForm [name="option[]"]').on('froalaEditor.contentChanged', function () {

                    hideCPR();

                $('#questionForm').formValidation('revalidateField', 'option[]');

            });

          $('[name*="question"]').froalaEditor('destroy');

             $('[name*="question"]').val(data.question);

$('[name*="question"]').froalaEditor({

                      // Set the image upload URL.

                      imageUploadURL: '<?php echo base_url();?>quiz/editor_upload_file'

                    });

$('[name*="question"]').on('froalaEditor.contentChanged', function () {

          hideCPR();

                $('#questionForm').formValidation('revalidateField', 'question');

            });

             $('[name*="category"]').importTags(data.category_name);

             $('[name*="marks"]').val(data.marks);



             $('#questionForm').attr('action','<?php echo base_url();?>quiz/saveQuestion/'+quizId);

             $('#addQuestion').modal('toggle');

          }

         });

     }



      </script>



      <script type="text/javascript" language="javascript" >

        function format ( d )

        {

               return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                '<div class="panel-heading"> </div>'+

                '<div class="panel-body">'+

                        '<span style="font-size:20px;font-weight:bold;">Question Details</span><br><br>'+



                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Question name:</strong> </div>'+

                          '<div class="col-xs-7">'+d.question+'</div>'+

                        '</div>'+

                         '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Marks:</strong> </div>'+

                          '<div class="col-xs-7">'+d.marks+'</div>'+

                        '</div>'+

                      '</div></div></div>';

        }

        $(document).ready(function() {

        var dt = $('#data-tables').DataTable( {

           oLanguage: {

                    sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

             },

             "iDisplayLength": 25,

             "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

            "processing": true,

            "serverSide": true,

            "ajax": ajax_base_url+"quiz/getAjaxdataObjects",

            "columns": [

                {

                    "class":"details-control",

                    "orderable":false,

                    "data":null,

                    "defaultContent": ""

                },

                { "data": "chk" },

                { "data": "question" },

                { "data": "marks" },

                { "data": "action" }

            ],

            "order": [],
                columnDefs: [

                  { orderable: true, targets: [2,3] },

                  { orderable: false, targets: [-1,0,1] },

                  { "width": "5%", "targets": [0,1,3] },

                  { "width": "10%", "targets": [4]},

                  { "width": "75%", "targets": [2]},

               ],
          "fnDrawCallback": function (oSettings) {

               nbr=0;

                    $(".details-control").each(function()

                    {

                        if(nbr > 0)

                        {

                            $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                        }

                        nbr++;

                    });

                    $('tbody').css('border', '1px solid #eee');

            }

        } );

        // Array to track the ids of the details displayed rows

        var detailRows = [];

        $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

            var tr = $(this).closest('tr');

            var row = dt.row( tr );

            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                tr.removeClass( 'details' );

                row.child.hide();

                // Remove from the 'open' array

                detailRows.splice( idx, 1 );

            }

            else {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                // Add to the 'open' array

                if ( idx === -1 ) {

                    detailRows.push( tr.attr('id') );

                }

            }

        } );

        // On each draw, loop over the `detailRows` array and show any child rows

        dt.on( 'draw', function () {

            $.each( detailRows, function ( i, id ) {

                $('#'+id+' td.details-control').trigger( 'click' );

            } );

        } );



       $('#questionForm .finish').click(function(event) {

         var formElem = $("#questionForm");

         var formdata = new FormData(formElem[0]);



         $.ajax({

           url: $('#questionForm').attr('action'),

           type: 'POST',

           data: formdata,

           processData: false,

           contentType: false

         })

         .done(function(resp) {
           var response = jQuery.parseJSON(resp);
             if(response.status == 'success')
             {
               $('#addQuestion').modal('hide');
               setTimeout(function() { notification("topright","success","fa fa-check-circle vd_green","Success",response.message); },500);
               dt.ajax.reload();

             }
             else if(response.status == 'fail')
             {
                 setTimeout(function() { notification("topright","error","fa fa-exclamation-circle vd_red","Error",response.message); },500);
             }
         });
       });



       $('#addQuestion').on('hidden.bs.modal', function() {



                  $('.form-wizard').bootstrapWizard('show',0);

                  document.getElementById("questionForm").reset();

                   $('#questionForm [name="question"]').froalaEditor('destroy');

                  $('#questionForm').attr('action', '<?php echo base_url();?>quiz/saveQuestion');

                  $('#input-autocomplete').importTags('');

                   $('#questionForm [name="option[]"]').froalaEditor('destroy');

                   $('#tab22').html('<div class="row voca"><div class="col-md-8"><label class="control-label">Option</label><div class="controls form-group"><textarea name="option[]" id="option" placeholder="Enter option...." class="input-border-btm form-control editor"></textarea></div></div><div class="col-md-2" style="margin-top:150px;text-align: center"><div class="vd_radio radio-success"><input checked="checked" name="is_correct" value="0" id="is_correct_0" type="radio" class=""><label for="is_correct_"> Correct Option </label></div></div><div class="col-md-2" style="margin-top:150px;"><button type="button" class="btn btn-success btn-add" ><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add Option</button></div></div>');

$('#questionForm [name="question"]').val('');

 $('#questionForm [name="question"]').froalaEditor({

                        // Set the image upload URL.

                        imageUploadURL: '<?php echo base_url();?>quiz/editor_upload_file'

                });

              $('#questionForm').formValidation('addField', 'question');

                        $('#questionForm [name="question"]').on('froalaEditor.contentChanged', function () {

                                  hideCPR();

                        $('#questionForm').formValidation('revalidateField', 'question');

              });



                $('#questionForm [name="option[]"]').froalaEditor({

                        // Set the image upload URL.

                        imageUploadURL: '<?php echo base_url();?>quiz/editor_upload_file'

                });

              $('#questionForm').formValidation('addField', 'option[]');

                        $('#questionForm [name="option[]"]').on('froalaEditor.contentChanged', function () {

                                  hideCPR();

                        $('#questionForm').formValidation('revalidateField', 'option[]');

              });



        hideCPR();

                  $('#questionForm').formValidation('resetForm', true);

         });



       $('#input-autocomplete').tagsInput({

    width: 'auto',

      autosize: true,

    autocomplete_url:'<?php echo base_url();?>'+"quiz/getcategories",

    removeWithBackspace:false,

    onChange:function() {

      $('#questionForm').formValidation('revalidateField', 'category');

              },

    autocomplete:{

    source: function(request, response) {

      $.ajax({

       url: '<?php echo base_url();?>'+"quiz/getcategories",

       dataType: "json",

       type:'POST',
       global: false,

       data: {

        category: request.term

       },

       success: function(data) {

        response( $.map( data, function( item ) {

                return {

                  label: item.category_name,

                  value: item.category_name

                }

              }));

       }

      })

    }}

  });

    $(document).on('click', '.btn-add', function(e)

    {

              e.preventDefault();

              var noOfOptions=$('input[type="radio"]').length;

              $('#tab22').append('<div class="row voca"><div class="col-md-8"><label class="control-label">Option</label><div class="controls form-group"><textarea name="option[]" id="option" placeholder="Enter option...." class="input-border-btm form-control editor" value=""></textarea></div></div><div class="col-md-2" style="margin-top:150px;text-align: center"><div class="vd_radio radio-success"><input name="is_correct" value="'+noOfOptions+'" id="is_correct_'+noOfOptions+'" type="radio" class=""><label for="is_correct_'+noOfOptions+'"> Correct Option </label></div></div><div class="col-md-2" style="margin-top:150px;"><button type="button" class="btn btn-danger btn-remove" ><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Remove Option</button></div></div>');

                $('#questionForm [name="option[]"]').froalaEditor({

                        // Set the image upload URL.

                        imageUploadURL: '<?php echo base_url();?>quiz/editor_upload_file'

                });

              $('#questionForm').formValidation('addField', 'option[]');

                        $('#questionForm [name="option[]"]').on('froalaEditor.contentChanged', function () {

                                  hideCPR();

                        $('#questionForm').formValidation('revalidateField', 'option[]');

              });



        hideCPR();

    }).on('click', '.btn-remove', function(e){

                e.preventDefault();

                $(this).parents('.voca:first').remove();

                $('#questionForm').formValidation('removeField', 'option[]');

                return false;

           });

    } );







    function delete_confirm(id)

    {

      var done = confirm("Are you sure to delete this record");

      if(done == true)

      {

          $.ajax({

            url: '<?php echo base_url();?>'+'quiz/delete_confirm/'+id

          })

          .done(function(response) {

            response=jQuery.parseJSON(response);

            var dTable = $('#data-tables').DataTable();

            notification("topright","success","fa fa-check-circle vd_green","Success",response.message);

            dTable.ajax.reload();

          })

          .fail(function() {

            notification("topright","error","fa fa-exclamation-circle vd_red","Error",'Something went wrong please try again.');

          })

      }

      else

      {

          return false;

      }

    }



    function validateForm()

    {

           total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

           if(total == 0)

           {

               alert("Please select checkbox.");

               return false;

           }

           var listBoxSelection=document.getElementById("listaction").value;

           if(listBoxSelection==0)

           {

               alert("Please select Action");

               return false;

           }

           else

                 if(listBoxSelection == 3){

                 var done = confirm("Are you sure, you want to delete record's from database?");

                 if(done == true){

                   return true;

                 }

                 else

                 {

                   return false;

                 }

           }

     }



    $(document).ready(function()

    {

       $(".case").click(function(){

        var checked_status = this.checked;

        $("#myform input[type=checkbox]").each(function(){

          this.checked = checked_status;

        });

       });

        hideCPR();

    });

function hideCPR()

{

        $(".fr-counter").each(function()

       {

             $(this).siblings().last().children('a[href="https://froala.com/wysiwyg-editor"]').hide();

       });

}



    </script>

   <?php } ?>

   <?php if($page_name == 'manage_user_logs/manage_user_logs_view'){;?>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>



    <script>

    $(document).ready(function() {

      $('#addU').click(function() {

        document.getElementById('AddUser').reset();

        $('#AddUser').find('input').removeClass('vd_bd-red');

        var validator1 = $( "#AddUser" ).validate();

          validator1.resetForm();

         });

      });

    </script>



      <script>

        var btnCust = '';

        $("#photo").fileinput({

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

        <?php

        if(!empty($name_profile['photo']))

        {?>

            defaultPreviewContent: '<img src="file_upload_base_url();<?php echo $name_profile['photo']?>" id="blah" alt="profile" style="width:160px">',

        <?php

        }

        else

        {

        ?>

            defaultPreviewContent: '<img src="<?php echo front_base_url();?>assets/img/u.png" id="blah" style="width:160px">',

        <?php } ?>

      layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},

      allowedFileExtensions: ["jpg", "png", "gif","jpeg"]

      });

      </script>

      <script>

            $('#photo').change(function(){

              var input = $('#photo')[0];

              if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function (e) {

                  $('#blah').attr('src', e.target.result);

                }

                reader.readAsDataURL(input.files[0]);

              }

            });

        </script>



      <script type="text/javascript">

        $(document).ready(function() {

              "use strict";

                  var form_register = $('#AddUser');

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



                          email_id: {

                               email: true,

                               required: true

                          },

                      },

                      messages: {

                        name: "Please enter your Name",

                        email_id: "Please enter Valid Email Id",



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

                        $("#submitUser").attr("disabled", "disabled");

                        userSubmit();

                      }

                  });

        });

        </script>

     <script>

      function userSubmit(){

        var formData = new FormData($('#AddUser')[0]);

        var pageurl_new = ajax_base_url+'users/add';

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

                        $('#AddUser').find("input[type=text]").val("");
                        notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                        var dTable = $('#data-tables').DataTable();
                         dTable.ajax.reload();
                         $('#addUser').modal('toggle');

                      }

                      else

                      {

                            $.each(data.errorfields, function()

                            {

                                $.each(this, function(name, value)

                                {

                                    $('[name*="'+name+'"]').parent().after('<div class="vd_red">'+value+'</div>');

                                });

                            });

                            $('#submitUser').prop("disabled", false);

                      }

               });

          }



    function edit_user(userId)

    {

         var pageurl_new = ajax_base_url+'users/edit_user/'+userId;

         $.ajax({

            url: pageurl_new,

         }).done(function(responce)

         {

          if (!$.isEmptyObject(responce))

          {

             $('#addUser').modal('toggle');

             var data = jQuery.parseJSON(responce);

             console.log(data);

             $('[name*="id"]').val(data.id);

             $('[name*="group_id"]').val(data.group_id);

             $('[name*="address"]').val(data.address);

             $('[name*="age"]').val(data.age);

             $('[name*="name"]').val(data.name);

             $('[name*="email_id"]').val(data.email_id);

             $('[name*="institute_name"]').val(data.institute_name);

             $('[name*="academic_year"]').val(data.academic_year);

             $('[name*="principal_name"]').val(data.principal_name);

             if(data.photo=='')

             {

               $("#AddUser #blah").attr('src', '<?php echo front_base_url();?>assets/img/u.png');

             }

             else

             {

               $("#AddUser #blah").attr('src', '<?php echo file_upload_base_url();?>'+data.tenant_id+'/users_photo/'+data.id+'/thumbs/'+data.photo);

             }

          }

         });

     }



      </script>



      <script type="text/javascript">

        $(document).ready(function() {

              "use strict";

                  var form_register = $('#addUserCsv');

                  var error_register = $('.alert-danger', form_register);

                  var success_register = $('.alert-success', form_register);

                  form_register.validate({

                      errorElement: 'div', //default input error message container

                      errorClass: 'vd_red', // default input error message class

                      focusInvalid: false, // do not focus the last invalid input

                      ignore: "",

                      rules: {

                          csvfile: {

                              required: true

                          },

                          tenant_id: {

                               required: true

                          },

                      },

                      messages: {

                        tenant_id: "Please Select Tenant",

                        csvfile: "Please upload your CSV file",

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

                        $("#submitCsvUser").attr("disabled", "disabled");

                        return true;

                      }

                  });

        });

        </script>



      <script type="text/javascript" language="javascript" >

        function format ( d )

        {

               return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                '<div class="panel-heading"> </div>'+

                '<div class="panel-body">'+

                        '<span style="font-size:20px;font-weight:bold;">User Details</span><br><br>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>User Info:</strong> </div>'+

                          '<div class="col-xs-7">'+d.info+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Name:</strong> </div>'+

                          '<div class="col-xs-7">'+d.name+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Email:</strong> </div>'+

                          '<div class="col-xs-7">'+d.email+'</div>'+

                        '</div>'+

                        '<div class="row mgbt-xs-10">'+

                          '<div class="col-xs-5 text-right"> <strong>Group Name:</strong> </div>'+

                          '<div class="col-xs-7">'+d.group_id+'</div>'+

                        '</div>'+

                      '</div></div></div>';

        }

        $(document).ready(function() {

        var dt = $('#data-tables').DataTable( {

           oLanguage: {

                    sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

             },

             "iDisplayLength": 25,

             "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

            "processing": true,

            "serverSide": true,

            "ajax": ajax_base_url+"manage_user_logs/getAjaxdataObjects",

            "columns": [

                {

                    "class":          "details-control",

                    "orderable":      false,

                    "data":           null,

                    "defaultContent": ""

                },

                { "data": "chk" },

                { "data": "info" },

                { "data": "reset_exam_logs" },

                { "data": "reset_assessment_logs" },

            ],

            "order": [],

             columnDefs: [

               { orderable: true, targets: [3,4] },

               { orderable: false, targets: [-1,0,1,2] },

               { orderable: false, targets: [-1,0,1,2] },

               { orderable: false, targets: [-1,0,1,2] }

            ],

          "fnDrawCallback": function (oSettings) {

               nbr=0;

                    $(".details-control").each(function()

                    {

                        if(nbr > 0)

                        {

                            $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                        }

                        nbr++;

                    });

                    $('tbody').css('border', '1px solid #eee');

            }

        } );

        // Array to track the ids of the details displayed rows

        var detailRows = [];

        $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

            var tr = $(this).closest('tr');

            var row = dt.row( tr );

            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                tr.removeClass( 'details' );

                row.child.hide();

                // Remove from the 'open' array

                detailRows.splice( idx, 1 );

            }

            else {

                $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                // Add to the 'open' array

                if ( idx === -1 ) {

                    detailRows.push( tr.attr('id') );

                }

            }

        } );

        // On each draw, loop over the `detailRows` array and show any child rows

        dt.on( 'draw', function () {

            $.each( detailRows, function ( i, id ) {

                $('#'+id+' td.details-control').trigger( 'click' );

            } );

        } );

    } );



   function change_status(userId,status)

     {

           var done = confirm("Are you sure, you want to change the status?");

           if(done == true)

           {

               var pageurl_new = ajax_base_url+'users/change_status/'+userId+'/'+status;

               window.location.href = pageurl_new;

           }

           else

           {

               return false;

           }

     }



     function change_retryexam(userId,status)

     {
        alert("user_id"+userId+"value"+status);
           // var done = confirm("Are you sure, you want to change the status?");

           // if(done == true)

           // {

               var pageurl_new = ajax_base_url+'manage_user_logs/change_retryexam/'+userId+'/'+status;

               window.location.href = pageurl_new;

           // }

           // else

           // {

           //     return false;

           // }

     }

     function change_assessmentlogs(userId,status)

     {
        alert("user_id"+userId+"value"+status);
           // var done = confirm("Are you sure, you want to  the status?");

           // if(done == true)

           // {

               var pageurl_new = ajax_base_url+'manage_user_logs/change_assessmentlogs/'+userId+'/'+status;

               window.location.href = pageurl_new;

           // }

           // else

           // {

           //     return false;

           // }

     }

     function enableDisable(bEnable, textBoxID)
    {
         document.getElementById(textBoxID).disabled = !bEnable
    }

     






   function delete_confirm(id)

    {

          var done = confirm("Are you sure to delete this record");

          if(done == true)

          {

              var pageurl_new = ajax_base_url+'users/delete_confirm/'+id;

              window.location.href = pageurl_new;

          }

          else

          {

              return false;

          }

    }

    function validateForm()

     {

           total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

           if(total==0)

           {

               alert("Please select checkbox.");

               return false;

           }

           var listBoxSelection=document.getElementById("listaction").value;

           if(listBoxSelection==0)

           {

               alert("Please select Action");

               return false;

           }

           else

                 if(listBoxSelection == 3){

                 var done = confirm("Are you sure, you want to delete record's from database?");

                 if(done == true){

                   return true;

                 }

                 else

                 {

                   return false;

                 }

           }

     }

    $(document).ready(function()

    {

       $(".case").click(function(){

        var checked_status = this.checked;

        $("#myform input[type=checkbox]").each(function(){

          this.checked = checked_status;

        });

       });

    });

    </script>


<!--        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

       <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

       <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>

       <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

       <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

       <script type="text/javascript" src="<?php echo base_url();?>assets/js/jscolor.js"></script>

       <script>

         $('#createNew').click(function() {

          $('#manageTenant').find("input[type=text]").val("");

         });

       </script>

       <script>

         var btnCust = '';

         $("#logo").fileinput({

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

         <?php

         if(!empty($name_profile['logo']))

         {?>

             defaultPreviewContent: '<img src="file_upload_base_url()/'.<?php echo $name_profile['id'];?>.'/logo/thumbs/<?php echo $name_profile['logo']?>" id="blah" alt="profile" style="width:160px">',

         <?php

         }

         else

         {

         ?>

             defaultPreviewContent: '<img src="<?php echo base_url();?>assets/img/defult_logo.jpg" id="blah" style="width:160px">',

         <?php } ?>

       layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},

       allowedFileExtensions: ["jpg", "png", "gif","jpeg"]

       });

       </script>

       <script>

         var btnCust = '';

         $("#logoEdit").fileinput({

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

         <?php

         if(!empty($name_profile['logo']))

         {?>

             defaultPreviewContent: '<img src="file_upload_base_url()/'.<?php echo $name_profile['id'];?>.'/logo/thumbs/<?php echo $name_profile['logo']?>" id="blahEdit" alt="profile" style="width:160px">',

         <?php

         }

         else

         {

         ?>

             defaultPreviewContent: '<img src="<?php echo base_url();?>assets/img/defult_logo.jpg" id="blahEdit" style="width:160px">',

         <?php } ?>

       layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},

       allowedFileExtensions: ["jpg", "png", "gif","jpeg"]

       });

       </script>

       <script>

             $('#logo').change(function(){

               var input = $('#logo')[0];

               if (input.files && input.files[0]) {

                 var reader = new FileReader();

                 reader.onload = function (e) {

                   $('#blah').attr('src', e.target.result);

                 }

                 reader.readAsDataURL(input.files[0]);

               }

             });

             $('#logoEdit').change(function(){

               var input = $('#logoEdit')[0];

               if (input.files && input.files[0]) {

                 var reader = new FileReader();

                 reader.onload = function (e) {

                   $('#blahEdit').attr('src', e.target.result);

                 }

                 reader.readAsDataURL(input.files[0]);

               }

             });

         </script>

       <script>

         $('.datepicker').datepicker();

       </script>

       <script type="text/javascript">

         $(document).ready(function() {

               "use strict";

                   var form_register = $('#manageTenant');

                   var error_register = $('.alert-danger', form_register);

                   var success_register = $('.alert-success', form_register);

                   form_register.validate({

                       errorElement: 'div', //default input error message container

                       errorClass: 'vd_red', // default input error message class

                       focusInvalid: false, // do not focus the last invalid input

                       ignore: "",

                       rules: {

                           name: {

                               required: true

                           },
                           admin_name: {

                               required: true

                           },

                           email: {

                               required: true,

                               email:true

                           },

                           url: {

                               required: true



                           },
                           time_zone:{
                              // required: true

                           },
                           logo:{
                               required: true

                           },
                           address:{
                               required: true

                           },
                           contact:{
                               required: true,
                               digits:true,


                           },

                            home_box1_name:{
                               required: true

                           },
                            home_box1_url:{
                               required: true

                           },
                            home_box1_color:{
                               required: true

                           },

                            home_box2_name:{
                               required: true

                           },
                            home_box2_url:{
                               required: true

                           },
                            home_box2_color:{
                               required: true

                           },

                            home_box3_name:{
                               required: true

                           },
                            home_box3_url:{
                               required: true

                           },
                            home_box3_color:{
                               required: true

                           },

                       },

                       messages: {

                         name: "Please enter tenant Name",
                         admin_name: "Please enter admin name for this tenant",
                         email: "Please enter admin email for this tenant",

                         email: "Please enter valid email id",
                         address: "Please enter address",
                         //contact: "Please enter contact",
                       //  contact: "Only digits are allowed",
                         //contact: "contact number must be 10 digit",
                         logo: "Please select Logo",
                         home_box1_name: "Name is required",
                         home_box1_url: "URL is required",
                         home_box1_color: "Color is required",
                          home_box2_name: "Name is required",
                         home_box2_url: "URL is required",
                         home_box2_color: "Color is required",
                          home_box3_name: "Name is required",
                         home_box3_url: "URL is required",
                         home_box3_color: "Color is required",


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

                         $("#submitTenant").attr("disabled", "disabled");

                         manageTenantSubmit();

                       }

                   });

         });

         </script>

         <script type="text/javascript">

           $(document).ready(function() {

                 "use strict";

                     var form_register = $('#manageTenantEdit');

                     var error_register = $('.alert-danger', form_register);

                     var success_register = $('.alert-success', form_register);

                     form_register.validate({

                         errorElement: 'div', //default input error message container

                         errorClass: 'vd_red', // default input error message class

                         focusInvalid: false, // do not focus the last invalid input

                         ignore: "",

                         rules: {

                             name: {

                                 required: true

                             },

                             header_color: {

                                 required: true

                             },


                            home_box1_name:{
                               required: true

                           },
                            home_box1_url:{
                               required: true

                           },
                            home_box1_color:{
                               required: true

                           },

                            home_box2_name:{
                               required: true

                           },
                            home_box2_url:{
                               required: true

                           },
                            home_box2_color:{
                               required: true

                           },

                            home_box3_name:{
                               required: true

                           },
                            home_box3_url:{
                               required: true

                           },
                            home_box3_color:{
                               required: true

                           },

                         },

                         messages: {

                           name: "Please enter tenant Name",

                           header_color: "Please select header color for this tenant",
                            home_box1_name: "Name is required",
                         home_box1_url: "URL is required",
                         home_box1_color: "Color is required",

                         home_box2_name: "Name is required",
                         home_box2_url: "URL is required",
                         home_box2_color: "Color is required",

                          home_box3_name: "Name is required",
                         home_box3_url: "URL is required",
                         home_box3_color: "Color is required",

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

                           $("#submitTenant").attr("disabled", "disabled");

                           manageTenantSubmitEdit();

                         }

                     });

           });

           </script>

      <script>

       function manageTenantSubmit()

       {

         var formData = new FormData($('#manageTenant')[0]);

         //console.log(formData);

         var pageurl_new = ajax_base_url+'tenant/add';

           $.ajax({

                      url: pageurl_new,

                      type: 'POST',

                      data: formData,

                      processData: false,

                      contentType: false,

                  }).done(function(responce)

                   {

                        // window.location.href = ajax_base_url+'tenant';

                        var data = jQuery.parseJSON(responce);

                        if(data.status=='success')

                        {

                          $('#manageTenant').find("input[type=text]").val("");
                          notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                           var dTable = $('#data-tables').DataTable();
                            dTable.ajax.reload();
                            $('#myModal').modal('toggle');

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

                              $('#submitTenant').prop("disabled", false);

                        }

                   });

       }

       function manageTenantSubmitEdit()

       {

         var formData = new FormData($('#manageTenantEdit')[0]);

         //console.log(ajax_base_url);

         var pageurl_new = ajax_base_url+'tenant/edit';

           $.ajax({

                      url: pageurl_new,

                      type: 'POST',

                      data: formData,

                      processData: false,

                      contentType: false,

                  }).done(function(responce)

                   {

                         //window.location.href = ajax_base_url+'tenant';

                       var data = jQuery.parseJSON(responce);

                       if(data.status=='success')

                       {

                         $('#manageTenant').find("input[type=text]").val("");
                         notification("topright","success","fa fa-check-circle vd_green","Success",data.message);
                         var dTable = $('#data-tables').DataTable();
                          dTable.ajax.reload();
                          $('#myModalEdit').modal('toggle');

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

                             $('#submitTenant').prop("disabled", false);

                       }

                   });

       }

        function edit_tenant(tenantId)

        {

             var pageurl_new = ajax_base_url+'tenant/edit_tenant/'+tenantId;

             $.ajax({

                url: pageurl_new,

             }).done(function(responce)

             {

                  if (!$.isEmptyObject(responce))

                  {

                     $('#myModalEdit').modal('toggle');

                     var data = jQuery.parseJSON(responce);

                     $('[name*="id"]').val(data.id);

                     $('[name*="url"]').val(data.url);

                     $('[name*="name"]').val(data.name);
                     $('[name*="timezone"]').val(data.timezone);
                     $('[name*="header_color"]').val(data.header_color);
                     $('[name*="address"]').val(data.address);

                     $('[name*="home_box1_name"]').val(data.home_box1_name);
                     $('[name*="home_box1_url"]').val(data.home_box1_url);
                     $('[name*="home_box1_color"]').val(data.home_box1_color);

                      $('[name*="home_box2_name"]').val(data.home_box2_name);
                     $('[name*="home_box2_url"]').val(data.home_box2_url);
                     $('[name*="home_box2_color"]').val(data.home_box2_color);

                     $('[name*="home_box3_name"]').val(data.home_box3_name);
                     $('[name*="home_box3_url"]').val(data.home_box3_url);
                     $('[name*="home_box3_color"]').val(data.home_box3_color);

                     $('[name*="email_postfix"]').val(data.email_postfix);
                     
                     var $radios = $('input:radio[name=signup_permission]');
                     if($radios.is(':checked') === false)
                     {
                         $radios.filter('[value='+data.signup_permission+']').prop('checked', true);
                     }
                     else
                     {
                       $radios.filter('[value='+data.signup_permission+']').attr('checked', true);
                     }


                     var $radios1 = $('input:radio[name=bind_email]');
                     if($radios1.is(':checked') === false)
                     {
                         $radios1.filter('[value='+data.bind_email+']').prop('checked', true);
                     }
                     else
                     {
                       $radios1.filter('[value='+data.bind_email+']').attr('checked', true);
                     }

                     var $radios2 = $('input:radio[name=bind_organization]');
                     if($radios2.is(':checked') === false)
                     {
                         $radios2.filter('[value='+data.bind_organization+']').prop('checked', true);
                     }
                     else
                     {
                       $radios2.filter('[value='+data.bind_organization+']').attr('checked', true);
                     }

                     if(data.logo=='')

                     {

                       $("#manageTenantEdit #blahEdit").attr('src', '<?php echo base_url();?>assets/img/defult_logo.jpg');

                     }

                     else

                     {

                       $("#manageTenantEdit #blahEdit").attr('src', '<?php echo file_upload_base_url();?>'+data.id+'/logo/thumbs/'+data.logo);

                     }

                  }

             });

         }

       </script>

         <script type="text/javascript" language="javascript" >

           function format ( d )

           {

                  return '<div class="panel widget light-widget" style="box-shadow:-2px 5px 17px #ccc !important;">'+

                   '<div class="panel-heading"> </div>'+

                   '<div class="panel-body">'+

                           '<span style="font-size:20px;font-weight:bold;">Tenant Details</span><br><br>'+

                           '<div class="row mgbt-xs-10">'+

                             '<div class="col-xs-5 text-right"> <strong>Tenant Info:</strong> </div>'+

                             '<div class="col-xs-7">'+d.info+'</div>'+

                           '</div>'+

                           '<div class="row mgbt-xs-10">'+
                             '<div class="col-xs-5 text-right"> <strong>Admin Name:</strong> </div>'+
                             '<div class="col-xs-7">'+d.admin_name+'</div>'+
                           '</div>'+
                           '<div class="row mgbt-xs-10">'+
                             '<div class="col-xs-5 text-right""> <strong>Admin Email:</strong> </div>'+
                             '<div class="col-xs-7">'+d.email+'</div>'+
                           '</div>'+
                           '<div class="row mgbt-xs-10">'+
                             '<div class="col-xs-5 text-right"> <strong>URL:</strong> </div>'+
                             '<div class="col-xs-7">'+d.url+'</div>'+

                           '</div>'+

                           '<div class="row mgbt-xs-10">'+

                             '<div class="col-xs-5 text-right" onclick="change_status()"> <strong>Status:</strong> </div>'+

                             '<div class="col-xs-7">'+d.status+'</div>'+

                           '</div>'+

                           '<div class="row mgbt-xs-10">'+

                             '<div class="col-xs-5 text-right"> <strong>Header Color:</strong> </div>'+

                             '<div class="col-xs-7"><span style="width:20px;height:15px;background:#'+d.header_color+'">'+d.header_color+'</span></div>'+

                           '</div>'+

                         '</div></div></div>';

           }

           $(document).ready(function() {

         var dt = $('#data-tables').DataTable( {

            oLanguage: {

                     sProcessing: "<img src='<?php echo base_url();?>assets/img/loading.gif'>"

              },

              "iDisplayLength": 25,

              "aLengthMenu": [[5, 10, 25, 50,100,500,1000,-1], [5, 10, 25, 50,100,500,1000,"All"]],

             "processing": true,

             "serverSide": true,

             "ajax": ajax_base_url+"manage_user_logs/getAjaxdataObjects",

             "columns": [

                 {

                     "class":          "details-control",

                     "orderable":      false,

                     "data":           null,

                     "defaultContent": ""

                 },

                { "data": "chk" },

                { "data": "info" },

                { "data": "start_date" },

                { "data": "end_date" },

                { "data": "user_info" },

                { "data": "exam_completed_in" },

                { "data": "action" }



             ],

             "order": [],

              columnDefs: [

              { orderable: true, targets: [3,4] },

              { orderable: false, targets: [-1,0,1,2] },

              { "width": "5%", "targets": [0,1,5,6] },

              { "width": "10%", "targets": [-1]},
              { "width": "15%", "targets": [3,4]},

              { "width": "40%", "targets": [2]}

             ],

           "fnDrawCallback": function (oSettings) {

                nbr=0;

                     $(".details-control").each(function()

                     {

                         if(nbr > 0)

                         {

                             $(this).html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                         }

                         nbr++;

                     });

                     $('tbody').css('border', '1px solid #eee');

          }

         } );

         // Array to track the ids of the details displayed rows

         var detailRows = [];

         $('#data-tables tbody').on( 'click', 'tr td.details-control', function () {

             var tr = $(this).closest('tr');

             var row = dt.row( tr );

             var idx = $.inArray( tr.attr('id'), detailRows );

             if ( row.child.isShown() ) {

                 $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_open.png">');

                 tr.removeClass( 'details' );

                 row.child.hide();

                 // Remove from the 'open' array

                 detailRows.splice( idx, 1 );

             }

             else {

                 $(this).closest('.details-control').html('<img src="<?php echo base_url();?>assets/img/details_close.png">');

                 tr.addClass( 'details' );

                 row.child( format( row.data() ) ).show();

                 // Add to the 'open' array

                 if ( idx === -1 ) {

                     detailRows.push( tr.attr('id') );

                 }

             }

         } );

         // On each draw, loop over the `detailRows` array and show any child rows

         dt.on( 'draw', function () {

             $.each( detailRows, function ( i, id ) {

                 $('#'+id+' td.details-control').trigger( 'click' );

             } );

         } );

     } );


      function change_status(userId,status)

        {

              var done = confirm("Are you sure, you want to change the status?");

              if(done == true)

              {

                  var pageurl_new = ajax_base_url+'tenant/change_status/'+userId+'/'+status;

                  window.location.href = pageurl_new;

              }

              else

              {

                  return false;

              }

        }

       function delete_confirm(id)

       {

             var done = confirm("Are you sure to delete this record");

             if(done == true)

             {

                 var pageurl_new = ajax_base_url+'tenant/delete_confirm/'+id;

                 window.location.href = pageurl_new;

             }

             else

             {

                 return false;

             }

       }

      function validateForm()

         {

               total=$('.vd_checkbox.checkbox-success input[type="checkbox"]:checked').length;

               if(total==0)

               {

                   alert("Please select checkbox.");

                   return false;

               }

               var listBoxSelection=document.getElementById("listaction").value;

               if(listBoxSelection==0)

               {

                   alert("Please select Action");

                   return false;

               }

               else

                     if(listBoxSelection == 3){

                     var done = confirm("Are you sure, you want to delete record's from database?");

                     if(done == true){

                       return true;

                     }

                     else

                     {

                       return false;

                     }

               }

         }

       $(document).ready(function()

       {

          $(".case").click(function(){

           var checked_status = this.checked;

           $("#myform input[type=checkbox]").each(function(){

             this.checked = checked_status;

           });

          });

       });

       </script> -->

      <?php } ?>

      <?php if($page_name == 'user/user_exam_view'){;?>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/jquery.dataTables.min.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/moment/moment.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/fileinput.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>

     <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-multiselect.js"></script>

     <script>

    function user_reset_exams(userId,examId)

    {

      var done = confirm("Are you sure to reset this exam");
          
       if(done == true)
        {

         var pageurl_new = ajax_base_url+'users/user_reset_exam/'+userId+'/'+examId;

         $.ajax({

            url: pageurl_new,

         }).done(function(responce)

         {
             console.log(responce);

             var pageurl_new = ajax_base_url+'users';

             window.location.href = pageurl_new;

         });

        }
         else

         {

             return false;

         }

     }


     </script>

    <?php } ?>





 