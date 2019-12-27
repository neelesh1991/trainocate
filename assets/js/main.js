jQuery( document ).ready(function( $ ) {
"use strict"

    // Preloader
    jQuery(window).load(function() {
        jQuery("#status").delay(2000).fadeOut();
        jQuery("#preloader").delay(2000).fadeOut("slow");
    })


    // Scroll Top Back
    var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.scrollup');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) {
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});


    // Range Slider
    if (jQuery("#slider-range").length != '') {
        jQuery("#slider-range").slider({
            range: true,
            min: 0,
            max: 500,
            values: [75, 300],
            slide: function(event, ui) {
                jQuery("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        jQuery("#amount").val("$" + jQuery("#slider-range").slider("values", 0) +
            " - $" + jQuery("#slider-range").slider("values", 1));
    }

    // Toggle Search Bar
    jQuery('.link.search').on( "click", function() {
    jQuery('#searching').addClass('active');
    jQuery('#searchThis input').focus();
    });
    jQuery('#closeSearch').on( "click", function() {
        jQuery('#searching').removeClass('active');
        jQuery('#searchThis input').blur();
        jQuery('#searchThis input').val('');
        jQuery('#searchResults').empty();
    });


    // Calunder
    jQuery( "#datepicker" ).datepicker();


    // Button Triple Effect
    jQuery('.btn, .triple-eff').mousedown(function(e) {
        var target = e.target;
        var rect = target.getBoundingClientRect();
        var ripple = target.querySelector('.ripple');
        jQuery(ripple).remove();
        ripple = document.createElement('span');
        ripple.className = 'ripple';
        ripple.style.height = ripple.style.width = Math.max(rect.width, rect.height) + 'px';
        target.appendChild(ripple);
        var top = e.pageY - rect.top - ripple.offsetHeight / 2 - document.body.scrollTop;
        var left = e.pageX - rect.left - ripple.offsetWidth / 2 - document.body.scrollLeft;
        ripple.style.top = top + 'px';
        ripple.style.left = left + 'px';
        return false;
    });

    // Responsive Slider menu
    jQuery('.menu-link').bigSlide();


    // Banner Slider
    jQuery('#animated-sldier').carousel({
        interval:5000,
        pause: "true"
    });

    // Video
    jQuery(".youtube").each(function() {
        // Based on the YouTube ID, we can easily find the thumbnail image
        jQuery(this).css('background-image', +this.id + '/sddefault.jpg)');
        // Overlay the Play icon to make it look like a video player
        jQuery(this).append(jQuery('<div/>', {
            'class': 'play'
        }));
        jQuery(document).delegate('#' + this.id, 'click', function() {
            // Create an iFrame with autoplay set to true
            var iframe_url = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
            if (jQuery(this).data('params')) iframe_url += '&' + jQuery(this).data('params');

            // The height and width of the iFrame should be the same as parent
            var iframe = jQuery('<iframe/>', {
                    'frameborder': '0',
                    'src': iframe_url,
                    'width': jQuery(this).width(),
                    'height': jQuery(this).height()
                })
                // Replace the YouTube thumbnail with YouTube HTML5 Player
            jQuery(this).replaceWith(iframe);
        });
    });

    // Testimonial Thumnail
    jQuery('#testimonil-slider').bxSlider({
        pagerCustom: '#testimonil-thumnails',
    });


    // Courses slider
    jQuery('#courses-slider').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        dots: true,
        smartSpeed:600,
        responsiveClass:true,
        responsive:{
            0:{ items:1},
            320:{ items:1},
            480:{ items:1},
            640:{ items:2},
            768:{ items:2},
            800:{ items:2},
            960:{ items:3},
            991:{ items:3},
            1024:{ items:3},
            1199:{ items:4},
            1200:{ items:4}
        }
    })


    // Courses slider 2
    jQuery('.courses-slider-2').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        dots: false,
        smartSpeed:600,
        responsiveClass:true,
        responsive:{
            0:{ items:1},
            320:{ items:1},
            480:{ items:1},
            640:{ items:2},
            768:{ items:2},
            800:{ items:2},
            960:{ items:3},
            991:{ items:3},
            1024:{ items:3},
            1199:{ items:4},
            1200:{ items:4}
        }
    })


    // Courses slider 3
    jQuery('.courses-slider-3').owlCarousel({
        loop:false,
        margin:30,
        nav:false,
        dots: false,
        smartSpeed:600,
        responsiveClass:true,
        responsive:{
            0:{ items:1},
            320:{ items:1},
            480:{ items:1},
            640:{ items:2},
            768:{ items:2},
            800:{ items:2},
            960:{ items:3},
            991:{ items:2},
            1024:{ items:3},
            1199:{ items:3},
            1200:{ items:3}
        }
    })


    // Blog slider
    jQuery('.blog-slider').owlCarousel({
        loop:true,
        margin:30,
        nav:false,
        dots: true,
        smartSpeed:600,
        responsiveClass:true,
        responsive:{
            0:{ items:1},
            320:{ items:1},
            480:{ items:1},
            640:{ items:1},
            768:{ items:2},
            800:{ items:2},
            960:{ items:2},
            991:{ items:2},
            1024:{ items:2},
            1199:{ items:2},
            1200:{ items:2}
        }
    })


    // Client Logo slider
    jQuery('.client-logo-slider').owlCarousel({
        loop:true,
        margin:30,
        nav:false,
        dots: false,
        smartSpeed:600,
        responsiveClass:true,
        responsive:{
            0:{ items:2},
            320:{ items:2},
            480:{ items:3},
            640:{ items:4},
            768:{ items:5},
            800:{ items:5},
            960:{ items:5},
            991:{ items:6},
            1024:{ items:6},
            1199:{ items:6},
            1200:{ items:6}
        }
    })


    // Team Slider
    jQuery('.team-slider').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        dots: false,
        smartSpeed:600,
        responsiveClass:true,
        responsive:{
            0:{ items:1},
            320:{ items:1},
            480:{ items:2},
            640:{ items:2},
            768:{ items:2},
            800:{ items:2},
            960:{ items:2},
            991:{ items:3},
            1024:{ items:4},
            1199:{ items:4},
            1200:{ items:4}
        }
    })


    // Team Slider 2
    jQuery('.team-slider-2').owlCarousel({
        loop:true,
        margin:30,
        nav:false,
        dots: true,
        smartSpeed:600,
        responsiveClass:true,
        responsive:{
            0:{ items:1},
            320:{ items:1},
            480:{ items:1},
            640:{ items:2},
            768:{ items:2},
            800:{ items:2},
            960:{ items:2},
            991:{ items:2},
            1024:{ items:3},
            1199:{ items:3},
            1200:{ items:4}
        }
    })


    // Testimonial Slider 2
    jQuery('.testimonial-slider-2').owlCarousel({
        loop:true,
        margin:30,
        nav:false,
        dots: true,
        smartSpeed:600,
        responsiveClass:true,
        responsive:{
            0:{ items:1},
            320:{ items:1},
            480:{ items:1},
            640:{ items:1},
            768:{ items:2},
            800:{ items:2},
            960:{ items:2},
            991:{ items:2},
            1024:{ items:3},
            1199:{ items:3},
            1200:{ items:3}
        }
    })


    // Event Slider
    jQuery('.event-slider').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        dots: false,
        smartSpeed:600,
        responsiveClass:true,
        responsive:{
            0:{ items:1},
            320:{ items:1},
            480:{ items:1},
            640:{ items:2},
            768:{ items:2},
            800:{ items:2},
            960:{ items:2},
            991:{ items:2},
            1024:{ items:3},
            1199:{ items:3},
            1200:{ items:3}
        }
    })


    // Event Slider
    jQuery('.product-slider').owlCarousel({
        loop:true,
        items : 1,
        nav:false,
        dots: true,
        smartSpeed:600
    })


    // Time Counter
    jQuery('#countdown-1').countdown({
        date: '10/16/2016 11:17:59',
        day: 'Day',
        days: 'Days'
        }, function() {
            //alert('Done!');
    });


    // Event Google Map
/*    jQuery("#contact-map, #find-us-map").gmap3({
        marker: {
            address: "Haltern am See, Weseler Str. 151"
        },
        map: {
            options: {
                zoom: 10,
                scrollwheel: false,
            }
        },
    });*/


    // Event Slider
    jQuery('.related-projects-slider').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        dots: false,
        smartSpeed:600,
        responsiveClass:true,
        responsive:{
            0:{ items:1},
            320:{ items:1},
            480:{ items:1},
            640:{ items:2},
            768:{ items:2},
            800:{ items:2},
            960:{ items:2},
            991:{ items:2},
            1024:{ items:4},
            1199:{ items:4},
            1200:{ items:4}
        }
    })


    // Date Picker
    jQuery('#calendar').datepicker({
        inline: true
    });


    // Mesonary
    var $container = jQuery('.gallery-masonry, .project-category');
    var $optionSets = jQuery('.option-set');
    var $optionLinks = $optionSets.find('a');
    function doIsotopeFilter() {
        if (jQuery().isotope) {
            var isotopeFilter = '';
            $optionLinks.each(function() {
                var selector = jQuery(this).attr('data-filter');
                var link = window.location.href;
                var firstIndex = link.indexOf('filter=');
                if (firstIndex > 0) {
                    var id = link.substring(firstIndex + 7, link.length);
                    if ('.' + id == selector) {
                        isotopeFilter = '.' + id;
                    }
                }
            });
            $container.isotope({
                itemSelector: '.masonry-grid',
                filter: isotopeFilter
            });
            $optionLinks.each(function() {
                var $this = jQuery(this);
                var selector = $this.attr('data-filter');
                if (selector == isotopeFilter) {
                    if (!$this.hasClass('selected')) {
                        var $optionSet = $this.parents('.option-set');
                        $optionSet.find('.selected').removeClass('selected');
                        $this.addClass('selected');
                    }
                }
            });
            $optionLinks.on( "click", function() {
                var $this = jQuery(this);
                var selector = $this.attr('data-filter');
                $container.isotope({
                    itemSelector: '.masonry-grid',
                    filter: selector
                });
                if (!$this.hasClass('selected')) {
                    var $optionSet = $this.parents('.option-set');
                    $optionSet.find('.selected').removeClass('selected');
                    $this.addClass('selected');
                }
                return false;
            });
        }
    }
    var isotopeTimer = window.setTimeout(function() {
        window.clearTimeout(isotopeTimer);
        doIsotopeFilter();
    }, 1000);
    jQuery('.simple-masonry').isotope({
      itemSelector: '.simple-masonry-grid'
    });



    // Counter
    try {
        jQuery('#tc-counters').appear(function () {
            jQuery('.tc-timer').countTo()
        });
    } catch (err) {}


    // practice slider
    jQuery('#slider-post').owlCarousel({
        loop:true,
        nav:true,
        items: 1,
        dots: false,
        smartSpeed:500
    })

    // Auto height function
    var setElementHeight = function () {
        var width = jQuery(window).width();
        /*if (jQuery('.tc-hero-slider li img') >= height) {*/
        var height = jQuery(window).height();
        jQuery('.fullscreen').css('height', (height));
        }
    //       else {
    //            jQuery('.autoheight').css('min-height', (800));
    //        }
    //};
    jQuery(window).on("resize", function () {
        setElementHeight();
    }).resize();


    // Prety Photo
    jQuery("a[data-rel]").each(function () {
		jQuery(this).attr("rel", jQuery(this).data("rel"));
	});
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'normal',
		theme: 'dark_square',
		slideshow: 3000,
		autoplay_slideshow: false,
		social_tools: false
	});


	// Prety Photo
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();


    /**
     * [description]
     *
     * Level drop js
     */

     jQuery('.op, .aca').hide();

    jQuery('#group').on('change', function(){

        var grpValue = jQuery(this).children("option:selected").val();
        if(grpValue == 58){
            jQuery('.op').show();

        } else{
            jQuery('.op').hide();
        }

        if(grpValue == 59){
            jQuery('.aca').show();

        } else{
            jQuery('.aca').hide();
        }

    });


    $('#user_level').on('click', function(){

    if($("#group").val() == '' && $(this).val() == ''){
        alert("You haven't selected any group!");
   }
});

    /**
     *
     */

/*    $('#exam-aggreeModel .modal-footer').hide();
    $('.termCHk').click(function() {

if ($('.termCHk').prop('checked')) {

           $('#exam-aggreeModel .modal-footer').show();
        } else {
            $('#exam-aggreeModel .modal-footer').hide();
        }
    });*/

});