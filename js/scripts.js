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



        $('.service_container').each(function(){
            $(this)
        });

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



        // if press escape key, hide menu
        $(document).on('keydown', function(e){
            if(e.keyCode == 27 ){
                $navigation_menu.removeClass('menu_visible');
            }
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






    });

})(jQuery, this);



function animateStatisticAmounts($statistic_amounts){
    var stats_animated  = $statistic_amounts.countTo({
        speed: 3000,
        refreshInterval: 40
    });
    console.log('start animating');
}
