<?php $CI=& get_instance();
       if($this->session->userdata('tenant_id')!='')
       {
           $tenant_id=$this->session->userdata('tenant_id');
       }else{
           $tenant_id=$this->modelbasic->getValue('tenant','id',array('url'=>$this->uri->segment(1)));
                       //echo $tenant_id;die;
                       if($tenant_id == '')
                       {
                           $tenant_id=1;
                       }
       }
       $tenant_info=$CI->userprofile_model->get_tenant_info($tenant_id);
       $admin_info=$CI->userprofile_model->get_admin_info($tenant_id);?>
<!-- Footer -->
    <footer class="footer">
      <!-- Footer Columns -->
      <div class="footer-column">
        <div class="container">
          <div class="row">

            <!-- Colunm Widget -->
            <div class="col-lg-3 col-md-3 col-sm-6">
              <div class="f-column-widget">
                <h4>Contact Information</h4>
                <div class="address-widget">
                  <p><?php echo $tenant_info['address'];?></p>

                </div>
              </div>
            </div>

             <div class="col-lg-3 col-md-3 col-sm-6">
              <div class="f-column-widget">

                <div class="address-widget">
                  <ul class="address-list">
                    <!--<li><i class="fa fa-phone"></i><?php //echo $admin_info['contact'];?></li>-->
                    <!-- <li><i class="fa fa-fax"></i>+91 20 6652 9035</li> -->
                    <li><i class="fa fa-envelope"></i><?php echo $admin_info['email'];?>

                </div>
              </div>
            </div>
            <!-- Colunm Widget -->

            <!-- Colunm Widget -->
           <div class="col-lg-6 col-md-3 col-sm-6">
                         <div class="f-column-widget newslatter">
                         <div><span id="successMsg" style="color:rgb(60,118,61);"></span></div>
                           <h4>Need Information about our Trainings?</h4>
                           <form id="contact-form" class="row">
                             <div class="col-md-6 col-xs-12">
                             <div class="form-group"><input type="text" class="form-control"  id="name" name="name" placeholder="Your Name..."></div>
                             </div>
                              <div class="col-md-6 col-xs-12">
                              <div class="form-group"><input type="text" class="form-control" id="email" name="email" placeholder="Your Email..."></div>
                              </div>
                               <div class="col-md-12 col-xs-12">
                               <div class="form-group"> <textarea id="message" name="message" placeholder="Your Message..."></textarea></div>
                                 <button class="btn blue sm onHide">Submit</button>
                                 <p class="onshows" style="display: none;">Sending...</p>
                               </div>
                           </form>
                           </div>
                         </div>


          </div>
        </div>
      </div>
      <!-- Footer Columns -->

      <!-- Sub Footer -->
      <div class="sub-footer themeColor">
        <div class="container ">
          <p>© Copyright <?php echo date("Y"); ?>. Powered by Emmersive.</p>
         <!--  <ul class="sub-footer-nav">
            <li><a href="#">Terms of Use</a></li>
            <li><a href="#">Privacy and Security</a></li>
            <li><a href="#">Policy</a></li>
            <li><a href="#">Sitemap</a></li>
          </ul> -->
        </div>
      </div>
      <!-- Sub Footer -->

    </footer>
    <!-- Footer -->

  </div>
  <!-- Wrapper -->

  <!-- Slide Menu -->

  <!-- <nav id="menu" class="responive-nav">
   <a href="#"><img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/big_thumbs/<?php echo $tenant_info['logo'];?>" alt=""></a>
      <ul class="respoinve-nav-list">
      <li>
        <a href="<?php echo base_url();?>">Home</a>
      </li>
      <li>
        <a href="<?php echo base_url();?>home/about">About Us</a>
      </li>
           <li>
        <a href="<?php echo base_url();?>">Quiz</a>
      </li> -->
     <!--  <li><a href="<?php echo base_url();?>home/contact">Contact</a></li>
    </ul>
  </nav> -->
  <!-- Slide Menu -->

  <!-- back To Button -->
  <span id="scrollup" class="scrollup circle-btn themeColor"><i class="fa fa-angle-up"></i></span>
  <!-- back To Button -->
  <!-- Login Form -->
  <div class="login-form">
    <div class="modal fade login-modal">
        <div class="modal-content position-center-center tc-hover">
       <img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/big_thumbs/<?php echo $tenant_info['logo'];?>" alt="">
        <h4>::: Login to your account :::</h4>
        <div><span id="successSignupMsg" style="color:rgb(0,169,0);"></span></div>
        <form class="login-form" id="login-form" action="<?php echo base_url();?>auth/login" role="form" method="POST">
        <div><span id="error_msg" style="color:#A94442"></span></div>
          <input type="hidden" name="tenant" value="<?php echo $this->session->userdata('tenant_id'); ?>"/>
          <div class="form-group">
                <input type="text" name="email"/>
                <label class="control-label">Email</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <input name="password" type="password"/>
                <label class="control-label">Password</label><i class="bar"></i>
            </div>
            <ul class="btn-list">
              <li><button type="submit" class="btn blue sm full-width">Login</button></li>
            </ul>
            <div class="remeber-nd-forget">
              <a href="javascript:void(0);" class="forget" data-toggle="modal" data-target=".forgot-password-modal">Forgot Password ?</a>
            </div>

        </form>
        </div>
    </div>
  </div>
  <!-- Login Form -->
  <div class="login-form">
    <div class="modal fade forgot-password-modal">
        <div class="modal-content position-center-center tc-hover">
      <img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id']?>/logo/big_thumbs/<?php echo $tenant_info['logo'];?>" alt="">
        <h4>::: Forgot Password :::</h4>
        <div><span id="success_msg" style="color:green"></span></div><br/><br/>
        <form class="forgot_password-form" id="forgot_password-form" method="POST">
          <div class="form-group">
                <input type="text" name="email_id" id="email_id"/>
                <label class="control-label">Enter Your Email</label><i class="bar"></i>

                 <div><span id="error_msg" style="color:#A94442"></span></div>
            </div>
            <ul class="btn-list">
              <li><button type="submit" class="btn blue sm full-width">submit</button></li>
            </ul>


        </form>
        </div>
    </div>
  </div>
  <!-- Forgot password Model -->

  <!-- End Forgot password Model-->

  <!-- Java Script -->
  <script src="<?php echo base_url();?>assets/js/vendor/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
  <script src="<?php echo base_url();?>assets/js/datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/js/contact-form.js"></script>
  <script src="<?php echo base_url();?>assets/js/bigslide.js"></script>
  <script src="<?php echo base_url();?>assets/js/parallax.js"></script>
  <script src="<?php echo base_url();?>assets/js/countdown.js"></script>
  <script src="<?php echo base_url();?>assets/js/countTo.js"></script>
  <script src="<?php echo base_url();?>assets/js/owl-carousel.js"></script>
  <script src="<?php echo base_url();?>assets/js/bxslider.js"></script>
  <script src="<?php echo base_url();?>assets/js/appear.js"></script>
  <script src="<?php echo base_url();?>assets/js/prettyPhoto.js"></script>
  <script src="<?php echo base_url();?>assets/js/isotope.pkgd.js"></script>
  <script src="<?php echo base_url();?>assets/js/main.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/formValidation.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/framework/bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/fileinput.js" type="text/javascript"></script>
  <script type="text/javascript">
  $('#forgot_password-form').on('init.field.fv', function(e, data) {
              // data.fv      --> The FormValidation instance
              // data.field   --> The field name
              // data.element --> The field element

              var $parent = data.element.parents('.form-group'),
                  $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

              // You can retrieve the icon element by
              // $icon = data.element.data('fv.icon');

              $icon.on('click.clearing', function() {
                  // Check if the field is valid or not via the icon class
                  if ($icon.hasClass('glyphicon-remove')) {
                      // Clear the field
                      data.fv.resetField(data.element);
                  }
              });
          }).
  formValidation({
    message: 'This value is not valid',
    icon: {
      valid: 'fa fa-check',
      invalid: 'fa fa-close',
      validating: 'fa fa-refresh'
    },
    live: 'enabled',
    trigger: null,
    verbos:'false',
      fields: {
        email_id: {
          validators: {
              verbos:'false',

            notEmpty: {
              message: 'The email id is required and cannot be empty'
            },
            emailAddress: {
              regexp:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
              message: 'The input is not a valid email address'
            }
          }
        }
      }
  }).on('success.form.fv', function(e) {
/*$('#forgot_password-form').submit(function(){*/
  var email_id=$('#email_id').val();
  $.ajax({
    url: '<?php echo base_url();?>auth/forgot_password',
    type: 'POST',
    data: {email_id:email_id},
    success:function(data)
    {
      if(data==1)
      {
        $('#success_msg').text('Please check your email to verify account');
        var explode = function(){
          window.location=base_url;
          };
          setTimeout(explode, 2000);
      }
      if(data==2)
      {
        $('#error_msg').text('Please enter valid crediantials');

      }
      if(data==3)
      {
        $('#error_msg').text('This email id is not valid');
      }
      var explode = function(){
      $("#success_msg").text('');
      $("#error_msg").text('');

      };
      setTimeout(explode, 3000);
    }
  })
  return false;
});
    $(document).ready(function() {
    $('#login-form').on('init.field.fv', function(e, data) {
                // data.fv      --> The FormValidation instance
                // data.field   --> The field name
                // data.element --> The field element

                var $parent = data.element.parents('.form-group'),
                    $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

                // You can retrieve the icon element by
                // $icon = data.element.data('fv.icon');

                $icon.on('click.clearing', function() {
                    // Check if the field is valid or not via the icon class
                    if ($icon.hasClass('glyphicon-remove')) {
                        // Clear the field
                        data.fv.resetField(data.element);
                    }
                });
            }).
    formValidation({
      message: 'This value is not valid',
      icon: {
        valid: 'fa fa-check',
        invalid: 'fa fa-close',
        validating: 'fa fa-refresh'
      },
      live: 'enabled',
      trigger: null,
      verbos:'false',
        fields: {
          password: {
            // It still work even if you use the selector option
            //selector: '#password',
            validators: {
                notEmpty: {
                message: 'The password is required and cannot be empty'
              },
              stringLength: {
                min: 4,
                message: 'The password must be equal to or more than 4 characters long'
              },
              different: {
                field: 'name',
                message: 'The password cannot be the same as username'
              }
            }
          },
          email: {
            validators: {
                verbos:'false',

              notEmpty: {
                message: 'The email id is required and cannot be empty'
              },
              emailAddress: {
                regexp:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                message: 'The input is not a valid email address'
              }
            }
          }
        }
    }).on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();
            var $form = $(e.target),
                fv    = $form.data('formValidation');
            // Use Ajax to submit form data
            var formData = new FormData($('#login-form')[0]);
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {

                   var data = jQuery.parseJSON(result);

                   console.log(data.errorfields);

                   if(data.status=='error')
                   {
                       $.each(data.errorfields, function()
                       {
                           $.each(this, function(name, value)
                           {
                            console.log(value);
                               $('[name*="'+name+'"]').parent().after('<small  class="text-danger">'+value+'</small>');

                           });
                       });
                   }
                   else
                   {
                       /*if(data.status=='success')
                       {*/
                       // console.log(result['as_set']);

                          if(data.as_set=='1')
                          {
                            window.location=base_url+'registration/reset_pwd_view/'+data.id;
                          }else if(data.as_set=='2')
                          {
                            $('#error_msg').text("Please Enter valid credential");
                          }
                          else
                          {
                            window.location=base_url+'registration/user_profile_display/'+data.id;
                          }
                          document.getElementById("login-form").reset();
                          PNotify.removeAll();
                          new PNotify({
                              text: data.message,
                              type:'success',
                              delay:2000,
                              buttons: {
                                  closer_hover: false
                              }
                          }
                          );

                       /*}
                       else
                       {
                        PNotify.prototype.options.styling = "fontawesome";
                           if(data.status == 'fail')
                           {
                              new PNotify({
                                  text: data.message,
                                  type:'error',
                                  buttons: {
                                      closer_hover: false
                                  }
                              });
                           }
                         }*/
                   }
                }
            });
        });
    });
  </script>
  <script type="text/javascript">
     $(function(){
    $(".dropdown").hover(
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            });
    });

  </script>
    <script type="text/javascript">
    $('#signup_profile').on('init.field.fv', function(e, data) {
                var $parent = data.element.parents('.form-group'),
                    $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');
                $icon.on('click.clearing', function() {
                    if ($icon.hasClass('glyphicon-remove')) {
                        data.fv.resetField(data.element);
                    }
                });
            }).
    formValidation({
      message: 'This value is not valid',
      icon: {
        valid: 'fa fa-check',
        invalid: 'fa fa-close',
        validating: 'fa fa-refresh'
      },
      live: 'enabled',
      trigger: null,
      verbos:'false',
        fields: {

          name: {
            validators: {
                notEmpty: {
                message: 'The name is required and cannot be empty'
              },

            }
          },
          academic_year: {
            validators: {
               digits: {
                  message: 'The value can contain only digits'
              }
            }
          },
          contact_no: {
            message: 'The phone number is not valid',
            validators: {
                notEmpty: {
                    message: 'The phone number is required'
                },
                stringLength: {

                    min: 10,

                    max: 10,

                    message: 'The phone Number must be 10 digit long'

                },
                digits: {
                    message: 'The value can contain only digits'
                }
            }
          },
            password: {
              validators: {
                  notEmpty: {
                  message: 'The Password is required and cannot be empty'
                }
              }
            },
            conf_password: {
              validators: {
                  notEmpty: {
                  message: 'The Password is required and cannot be empty'
                },
                identical: {
                  field: 'password',
                  message: 'The password and its confirm are not the same'
              }
           }
            },
            email: {
              validators: {
                 notEmpty: {

                 message: 'The email id is required and cannot be empty'

                 },

                 emailAddress: {

                 regexp:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,

                 message: 'The input is not a valid email address'

                 }

              }
            },


        /*    user_level: {
            validators: {
                notEmpty: {
                message: 'The Level is required and cannot be empty'
              },



            }
          },

                 group: {
            validators: {
                notEmpty: {
                message: 'The Group is required and cannot be empty'
              },



            }
          },*/


                 city: {
            validators: {
                notEmpty: {
                message: 'The City is required and cannot be empty'
              },



            }
          }




        }
    }).on('success.form.fv', function(e) {
            // Prevent form submission
      /*$('#edit-profile').submit(function() {*/
        var data = new FormData($(this)[0]);
        console.log(data);
        $.ajax({
          url: '<?php echo base_url();?>registration/signup_detail_save',
          type: 'POST',
          data: data,
          async: false,
          processData: false, // important
          contentType: false,
          success:function(responce)
          {
            console.log(responce);
            var data = jQuery.parseJSON(responce);
            console.log(data);

            if(data.status=='error')

            {

                $.each(data.errorfields, function()

                {

                    $.each(this, function(name, value)

                    {

                        $('[name*="'+name+'"]').parent().after('<div style="color: red; margin-top: -25px; padding-bottom: 16px" >'+value+'</div>');

                    });

                });

                $('#signup_profile_submit').prop("disabled", false);

            }
            else

            {
              if(data['as_set']==1)
              {

                window.location.href = '<?php echo base_url();?>'+'registration/user_profile_display';

              }
              if(data['as_set']==2)
              {
                $('#errormsg').text("your Account is already exist.Use different email id");
                var explode = function(){
                    $("#errormsg").text('');

                };
                setTimeout(explode, 3000);
              }
              if(data['as_set']==3)
              {
                $('#errormsg').text("User sign up on wrong organization. Please sign up on correct organization.");
                var explode = function(){
                    $("#errormsg").text('');

                };
                setTimeout(explode, 3000);
              }

            }


          }
        })
        return false;

      });

    </script>
    <script type="text/javascript">
    $('#contact-form').on('init.field.fv', function(e, data) {
      var $parent = data.element.parents('.form-group'),
          $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');
      $icon.on('click.clearing', function() {
          if ($icon.hasClass('glyphicon-remove')) {
              data.fv.resetField(data.element);
          }
      });
    }).
    formValidation({
      message: 'This value is not valid',
      icon: {
        valid: 'fa fa-check',
        invalid: 'fa fa-close',
        validating: 'fa fa-refresh'
      },
      live: 'enabled',
      trigger: null,
      verbos:'false',
        fields: {
          name: {
            // It still work even if you use the selector option
            //selector: '#password',
            validators: {
                notEmpty: {
                message: 'The Name is required and cannot be empty'
              }
            }
          },

          message: {
            // It still work even if you use the selector option
            //selector: '#password',
            validators: {
                notEmpty: {
                message: 'The Message is required and cannot be empty'
              }
            }
          },
          email: {
            validators: {
                verbos:'false',

              notEmpty: {
                message: 'The email id is required and cannot be empty'
              },
              emailAddress: {
                regexp:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                message: 'The input is not a valid email address'
              }
            }
          }
        }
    }).on('success.form.fv', function(e) {
    var data =$('#contact-form').serialize();
    console.log(data);

     $('.onHide').hide();
     $('.onshows').show();
    $.ajax({
      url: '<?php echo base_url();?>home/save_contact_msg',
      type: 'POST',
      data: data,
      success:function(data)
      {

        console.log(data);
        if(data)
        {
           $('.onHide').show();
     $('.onshows').hide();


          $('#successMsg').text("Your message sent successfully.");
          $("#contact-form")[0].reset();
            var explode = function(){
                $("#successMsg").text('');
            };
            setTimeout(explode, 7000);
        }
      }
    })

    return false;
    });
    </script>
  </body>
</html>
