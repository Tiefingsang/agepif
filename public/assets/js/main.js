(function($) {

	"use strict";

    // preloader
    $(window).on('load', function(){
      $('#preloader').fadeOut('slow',function(){$(this).remove();});
    });


    // Navbar Animation
     jQuery('#main-nav').stellarNav({
        theme: 'light',
        breakpoint: 991,
        openingSpeed: 200,
        closingDelay: 50,
        position: 'right',
        sticky: false
    });

    // ScrollToFixed
    $('.fixed-header').scrollToFixed();


    // flexslider Start
    $('.flexslider').flexslider({
        animation: "fade",
        animationSpeed: 1000,
        slideshowSpeed: 7000,
        controlNav: "thumbnails",
        directionNav: false,
        playText: 'Play',
      });



    // Pogo Slider
    if($('#pogo-slider').length > 0){
            $('#pogo-slider').pogoSlider({
            autoplay: true,
            autoplayTimeout: 5000,
            displayProgess: true,
            targetWidth: 1920,
            // targetHeight: 500,
            responsive: true,
            pauseOnHover: false,
        }).data('plugin_pogoSlider');
    }



    // Tab Slider
    // $('#myCarousel').carousel({
    //     interval:   4000
    // });
    
    var clickEvent = false;
    $('#myCarousel').on('click', '.nav a', function() {
            clickEvent = true;
            $('.nav li').removeClass('active');
            $(this).parent().addClass('active');        
    }).on('slid.bs.carousel', function(e) {
        if(!clickEvent) {
            var count = $('.nav').children().length -1;
            var current = $('.nav li.active');
            current.removeClass('active').next().addClass('active');
            var id = parseInt(current.data('slide-to'));
            if(count == id) {
                $('.nav li').first().addClass('active');    
            }
        }
        clickEvent = false;
    });



    // Parallax background
    $('.jarallax').jarallax({
            speed: 0.5,
    })

    // Water ripples animation
    $('#water-animation').ripples({
        resolution: 512,
        dropRadius: 20,
        perturbance: 0.04
    });


	// Light box
	$('.gallery').featherlightGallery({
    gallery: {
        fadeIn: 300,
        fadeOut: 300
    },
    openSpeed: 300,
    closeSpeed: 300
	});
	$('.gallery2').featherlightGallery({
	    gallery: {
	        next: 'next »',
	        previous: '« previous'
	    },
	    variant: 'featherlight-gallery2'
	});



    // Add minus icon for collapse element which is open by default
    $(".collapse.show").each(function(){
        $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
    });
    
    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function(){
        $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
    }).on('hide.bs.collapse', function(){
        $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
    });


    // owl-carousel for main-slider 
    $('.main-slider').owlCarousel({
        loop:true,
        margin: 0,
        dots:false,
        nav:true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:false,
        autoplaySpeed:1200,
        navText: [
                '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
                '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>'
            ],
        responsive: {
            0: {
                items:1
            },
            600:{
                items:1
            },
            1000: {
                items:1
            }
        }
    });


    // slick-carousel for agent
    $(".agent-carousel").slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        speed: 800,
        autoplaySpeed: 3000,
        responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: false
          }
        },
        {
          breakpoint: 750,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        
      ]

      });

    // slick-carousel for brand
    $(".brand-carousel").slick({
            dots: false,
            arrows: false,
            infinite: true,
            autoplay: true,
            speed: 800,
            autoplaySpeed: 3000,
            responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 750,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            }
            
          ]

      });


    // Range slider
    $( ".slider-range" ).slider({
            range: true,
            min: 0,
            max: 5000,
            values: [ 500, 3000 ],
            slide: function( event, ui ) {
                $( ".amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
        });
    $( ".amount" ).val( "$" + $( ".slider-range" ).slider( "values", 0 ) +
            " - $" + $( ".slider-range" ).slider( "values", 1 ) );

    // Range slider two
    $( ".slider-range-two" ).slider({
            range: true,
            min: 0,
            max: 3000,
            values: [ 300, 1200 ],
            slide: function( event, ui ) {
                $( ".amount-two" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
        });
    $( ".amount-two" ).val( "$" + $( ".slider-range-two" ).slider( "values", 0 ) +
            " - $" + $( ".slider-range-two" ).slider( "values", 1 ) );



    // Select changer script
    $(document).on('change', '.div-toggle', function() {
      var target = $(this).data('target');
      var show = $("option:selected", this).data('show');
      $(target).children().addClass('hide');
      $(show).removeClass('hide');
    });
    $('.div-toggle').trigger('change');



    // Text rotating script
    $( "#text-animation" ).morphext({
        // The [in] animation type. Refer to Animate.css for a list of available animations.
        animation: "fadeInDown",
        // An array of phrases to rotate are created based on this separator. Change it if you wish to separate the phrases differently (e.g. So Simple | Very Doge | Much Wow | Such Cool).
        separator: ",",
        speed: 4000,
        complete: function () {
            // Called after the entrance animation is executed.
        }
    });


    // Bootstrap accordion
    function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
        }
        $('.panel-group').on('hidden.bs.collapse', toggleIcon);
        $('.panel-group').on('shown.bs.collapse', toggleIcon);


    //Scrollup 
    dyscrollup.init({
        showafter : 500,
        scrolldelay : 1000,
        position : 'right',
        shape : 'squre',
        width : "20",
        height : "20"
    });



})(window.jQuery);