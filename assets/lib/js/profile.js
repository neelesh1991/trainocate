
	$('#edit-profile').on('init.field.fv', function(e, data) {
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
	      age: {
	        // It still work even if you use the selector option
	        //selector: '#password',
	        validators: {
	            notEmpty: {
	            message: 'The age is required and cannot be empty'
	          }
	        }
	      },
	      name: {
	        validators: {
        	    notEmpty: {
        	    message: 'The name is required and cannot be empty'
        	  }
	        }
	      },
  	      username: {
  	        validators: {
          	    notEmpty: {
          	    message: 'The user name is required and cannot be empty'
          	  }
  	        }
  	      },
  	      inst_name: {
  	        validators: {
          	    notEmpty: {
          	    message: 'The Institute Name is required and cannot be empty'
          	  }
  	        }
  	      },
  	      address: {
  	        validators: {
          	    notEmpty: {
          	    message: 'The Address is required and cannot be empty'
          	  }
  	        }
  	      },
  	      academic_year: {
  	        validators: {
          	    notEmpty: {
          	    message: 'The Academic year is required and cannot be empty'
          	  }
  	        }
  	      },
  	      princy_name: {
  	        validators: {
          	    notEmpty: {
          	    message: 'The Principal Name is required and cannot be empty'
          	  }
  	        }
  	      },

	    }
	}).on('success.form.fv', function(e) {
	        // Prevent form submission
		/*$('#edit-profile').submit(function() {*/
			var data = new FormData($(this)[0]);

			console.log(data);
			$.ajax({
				url: '<?php echo base_url();?>registration/profile_detail_save',
				type: 'POST',
				data: data,
				async: false,
				processData: false, // important
				contentType: false,
				success:function(data)
				{
					if(data==1)
					{
						window.location='<?php echo base_url();?>registration/user_profile_display';
					}
				}
			})
			return false;




		});