  import countto from './jquery.countto.js';

(function ($, root, undefined) {

	$(function () {

		'use strict';


				var $window = $(window);
				var $body = $('body');
				var $windowHeight = $window.height();
				var $navigation_menu = $('#navigation_menu');
				var $menu_button = $('#menu_button');
				var $supermenu = $('#supermenu');
				var $parallax = $('.parallax');

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

        $('a', $navigation_menu).on('mouseover', function(){
              $supermenu.addClass('supermenu_visible');
        });
        $( $supermenu).on('mouseleave', function(){
            $supermenu.removeClass('supermenu_visible');
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








	});

})(jQuery, this);



          function animateStatisticAmounts($statistic_amounts){
            var stats_animated  = $statistic_amounts.countTo({
              speed: 3000,
              refreshInterval: 40
            });
            console.log('start animating');
          }
