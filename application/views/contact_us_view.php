  <?php $this->load->view('template/header');?>

  <div class="inner-banner dark-bg">
		    	<div class="container">
			    	<div class="inner-page-heading">
						<div class="main-heading style-2 h-white p-white position-center-x">
							<h2>Contact Us</h2>
						</div>
			    	</div>
		    	</div>
		    </div>
			<!-- Inner Banner -->

		</header>
		<!-- Header -->

		<!-- Main Content -->
		<main class="main-content">

			<!-- Adress Nd Map -->
			<div class="tc-padding-bottom">
				<div class="container">
					<div class="contact-inner">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-5">
								<div class="contact-address z-depth-1">
									<h3>Contact Info</h3>
									<p>Tata Technologies Ltd. 25, Rajiv Gandhi Infotech Park Hinjawadi, Pune 411057 India</p>
									<ul class="address-list">
										 <li><i class="fa fa-phone"></i>+91 20 6652 9090</li>
                    <li><i class="fa fa-fax"></i>+91 20 6652 9035</li>
                    <li><i class="fa fa-envelope"></i>contact@tatatechnologies.com</li>
									</ul>
									<div class="social-icons-2">
										<ul>
											<li><a class="fa fa-twitter" href="#"></a></li>
                    <li><a class="fa fa-facebook" href="#"></a></li>
                    <li><a class="fa fa-instagram" href="#"></a></li>
                    <li><a class="fa fa-google-plus" href="#"></a></li>
                    <li><a class="fa fa-dribbble" href="#"></a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-7">
								<div id="contact-map" class="contact-map-holder z-depth-1"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Adress Nd Map -->

			<!-- Contact Form -->
			<section class="tc-padding white-bg">
				<div class="container">

					<!-- Main Heading -->
					<div class="main-heading style-2 add-p">
						<h2>Leave a Message</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing aelit, sed do eiusmod tempor incididunt.</p>
					</div>
					<!-- Main Heading -->

					<!-- Form -->
					<form id="contact-form" class="row">
						<div class="col-sm-4 col-xs-4 r-full-width">
							<div class="form-group">
						      	<input type="text" id="name" name="name"/>
						      	<label class="control-label">Name</label><i class="bar"></i>
						    </div>
					    </div>
					    <div class="col-sm-4 col-xs-4 r-full-width">
							<div class="form-group">
						      	<input type="text" id="email" name="email"/>
						      	<label class="control-label">Email *</label><i class="bar"></i>
						    </div>
					    </div>
					    <div class="col-sm-4 col-xs-4 r-full-width">
							<div class="form-group">
						      	<input type="text" id="subject" name="subject"/>
						      	<label class="control-label">Subject</label><i class="bar"></i>
						    </div>
					    </div>
					    <div class="col-sm-12 col-xs-12">
						    <div class="form-group m-0">
						      	<textarea id="message" name="message"></textarea>
						      	<label class="control-label">Message *</label><i class="bar"></i>
						    </div>
					    </div>
					    <div class="col-sm-12 col-xs-12">
					    	<button class="btn blue z-depth-1" type="submit">Send Message<i class="fa fa-send"></i></button>
						</div>
					</form>
					<!-- Form -->

				</div>
			</section>
			<!-- Contact Form -->

		</main>
		<!-- Main Content -->

		<?php $this->load->view('template/footer');?>



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
      subject: {
        // It still work even if you use the selector option
        //selector: '#password',
        validators: {
            notEmpty: {
            message: 'The Subject is required and cannot be empty'
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
        // Prevent form submission
/*$('#contact-form').submit(function() {*/
	var data =$('#contact-form').serialize();
console.log(data);
$.ajax({
	url: '<?php echo base_url();?>home/save_contact_msg',
	type: 'POST',
	data: data,
	success:function(data)
	{

	}
})

return false;
});
</script>
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="<?php echo base_url();?>assets/js/gmap3.min.js"></script>