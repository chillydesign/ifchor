import countto from './jquery.countto.js';
import slickcarousel from '../node_modules/slick-carousel/slick/slick.js';


(function ($, root, undefined) {

    $(function () {

        'use strict';


        var $window = $(window);
        var $body = $('body');
        var $windowHeight = $window.height();
        var $navigation_menu = $('#navigation_menu');
        var $menu_button = $('#menu_button');
        var $supermenu = $('.supermenu');
        var $top_level_links = $('.top_level_link');
        var $parallax = $('.parallax');




        // $('.service_container').each(function(){
        //     $(this)
        // });

        $(".slick_slider").slick({
            dots: false,
            infinite: true,
            centerMode: false,
              autoplay: false,
            slidesToScroll: 1,
            slidesToShow: 5,
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }

            }, {

                breakpoint: 768,
                settings: "unslick" // destroys slick

            }]
        });


        // ANIMATE STATISTICS
        var $statistic_amounts = $('.statistic_amount');
        var need_to_animate_statistics =  ($statistic_amounts.length > 0)  ;
        if (need_to_animate_statistics){
            // if its visible on page load, start animating
            if ( $windowHeight  > ($statistic_amounts.first().offset().top ) ) {
                animateStatisticAmounts($statistic_amounts);
                need_to_animate_statistics = false;
            }
        }





        $menu_button.on('click', function(){
            $navigation_menu.toggleClass('menu_visible');
            $('body').toggleClass('body_fixed');
        });







        $top_level_links.on('mouseover', function(){
            var $this = $(this);
            var the_supermenu  = $this.data('supermenu');

            $top_level_links.removeClass('hovered');
            $supermenu.removeClass('supermenu_visible');
            var $new_supermenu =   $('#' + the_supermenu).addClass('supermenu_visible');

            $this.addClass('hovered');
            $('input', $new_supermenu).focus();
            //    $supermenu.addClass('supermenu_visible');
        });
        $( $supermenu).on('mouseleave', function(){
            $supermenu.removeClass('supermenu_visible');
            $top_level_links.removeClass('hovered');
        });


        $('#navigation_menu > ul >  li > a').on('click', function(e){
                e.preventDefault();
                e.stopPropagation();
                var $this = $(this);
                var $parent = $this.parent();
                var $has_clicked_class =  ($parent.hasClass('clicked'));
                $('#navigation_menu > ul >  li').removeClass('clicked');
                if ($has_clicked_class == false) {
                    $parent.addClass('clicked');
                }

        });

        $('#navigation_menu > ul >  li > a').on('hover', function(e){
                console.log('boop');
                var $this = $(this);
                var $parent = $this.parent();
                var $has_clicked_class =  ($parent.hasClass('clicked'));
                $('#navigation_menu > ul >  li').removeClass('clicked');
                if ($has_clicked_class == false) {
                    $parent.addClass('clicked');
                }

        });

            $('#navigation_menu > ul >  li').on('click', function(e){
                e.stopPropagation();
            })



            // if clicking on customsub link, and its linking to an id
            // and that id is on the page
            $('.custom-sub a').on('click', function(e){

        		var $this = $(this);
        		var $href = $this.attr('href');
        		var $hash = $href.split('#')[1];

        		if (typeof $hash !== 'undefined') {
        			var $location = $('#' + $hash);
        			if($location.length  > 0) {
                        e.preventDefault();
        				$("html, body").animate({ scrollTop: $location.offset().top }, 1000);
        			}
        		}
        	});



            // if coming to a new page, and there is a hash in the url
            var $page_hash = window.location.hash;
            $page_hash =  $page_hash.split('#')[1];
            if (typeof $page_hash !== 'undefined') {
                var $page_location = $('#' + $page_hash);
                if($page_location.length  > 0) {
                    window.scrollTo(0,0);
                    $("html, body").animate({ scrollTop: $page_location.offset().top }, 1000);
                }
            }







        // if press escape key, hide menu
        $(document).on('keydown', function(e){
            if(e.keyCode == 27 ){
                $navigation_menu.removeClass('menu_visible');
                $('#navigation_menu > ul > li').removeClass('clicked');
            }
        }).on('click', function(e){
                $('#navigation_menu > ul > li').removeClass('clicked');
        })





        $window.scroll(function(){

            var windowScroll = $window.scrollTop();

            // DO parallax on images
            var translateY = windowScroll * 0.2;
            $parallax.css({'transform': 'translateY(' + translateY + 'px)'  });


            if (need_to_animate_statistics){
                // if it comes into view, start animating
                if ( windowScroll  > ($statistic_amounts.first().offset().top - $windowHeight) ) {
                    animateStatisticAmounts($statistic_amounts);
                    need_to_animate_statistics = false;
                }
            }

        });



        // aniamte entry of title on homepage
        var $h1_spans = $('h1 span');
        if ($h1_spans.length > 1) {

            $h1_spans.each(function(i, span){
                var $span = $(this);
                setTimeout( function(){
                        $span.addClass('fadeIn');
                }, (1400 * i)  );

            })
        }



        $('.location_box').hide();
        $('.flag_icon').on('click', function(){
            var $this = $(this);
            var $box = $this.attr('id');

            $('.location_box').hide();
            $('.location_box_' + $box).show();
        })
        $('.close_location_box').on('click', function(e){
            e.preventDefault();
                $('.location_box').hide();
        });




        $('nav#navigation_menu li.menu-item-has-children a').on('click', function(){
          var $this = $(this).parent('nav#navigation_menu li.menu-item-has-children');
          if(  $window.width() < 992){
              if($this.hasClass('active_li_in_nav')){
                  $this.find('.custom-sub').slideUp();
                  $this.removeClass('active_li_in_nav');
              } else{
                  $('.active_li_in_nav .custom-sub').slideUp();
                  $this.find('.custom-sub').slideDown();
                  $('.active_li_in_nav').removeClass('active_li_in_nav');
                  $this.addClass('active_li_in_nav');
              }
            }
          });


    });


})(jQuery, this);



function animateStatisticAmounts($statistic_amounts){
    var stats_animated  = $statistic_amounts.countTo({
        speed: 3000,
        refreshInterval: 40
    });
    console.log('start animating');
}
