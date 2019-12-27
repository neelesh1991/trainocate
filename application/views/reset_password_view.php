<?php $this->load->view('template/header');?>

<section id="wrapper" class="reset-password" style="background: #005D9B">

<div class="container">

<div class="col-md-4 col-md-offset-4">

<div class="login-form-password text-center">

      <img src="<?php echo base_url();?>uploads/<?php echo $tenant_info['id'];?>/logo/<?php echo $tenant_info['logo'];?>" alt="">

      <h4>::: Reset Password :::</h4>

      <div><span id="success_msg" style="color:green"></span></div>

      <form class="reset_password_form " id="reset_password_form" method="POST">

        <div class="form-group ">

              <input type="password" name="password" id="password"/>

              <input type="hidden" name="user_id" id="user_id" value="<?php echo $tenant_info['user_id'];?>">

              <label class="control-label"> Please enter new password</label><i class="bar"></i>

          </div>

          <div class="form-group ">

                <input type="password" name="re_password" id="re_password"/>

                <label class="control-label">Retype Password</label><i class="bar"></i>

            </div>

          <div class="btn-list text-center">

            <button type="submit" class="btn blue sm ">submit</button>

          </div>





      </form>



</div>

</div>

</div>

</section>

<?php $this->load->view('template/footer');?>

<script>



$(document).ready(function() {

$('#reset_password_form').on('init.field.fv', function(e, data) {
          
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

      password: {

        validators: {

            notEmpty: {

            message: 'The password is required and cannot be empty'

          },

          stringLength: {

            min: 4,

            message: 'The password must be equal to or more than 4 characters long'

          },

        }

      },

      re_password: {

        validators: {

            notEmpty: {

            message: 'The Repassword is required and cannot be empty'

          },

          stringLength: {

            min: 4,

            message: 'The Repassword must be equal to or more than 4 characters long'

          },

          identical: {

            field: 'password',

            message: 'The Repassword must be same as password'

          }

        }

      },



    }

}).on('success.form.fv', function(e) {

/*$('#reset_password_form').submit(function() {*/

var password=$('#reset_password_form #password').val();
var user_id=$('#reset_password_form #user_id').val();

console.log(password);



 $.ajax({

   url: '<?php echo base_url();?>registration/changed_password_save',

   type: 'POST',

   data: {password:password,user_id:user_id},

   success:function(data)

   {
 
    if(data==1)

    {

     $('#success_msg').text('successfully Update Password');

     window.location='<?php echo base_url();?>home';

    }

    if(data==2)

    {

     window.location='<?php echo base_url();?>registration/user_profile_display';

    }

   }

 })

 return false;



 })

});

</script>