  import countto from './jquery.countto.js';

(function ($, root, undefined) {

	$(function () {

		'use strict';


				var $window = $(window);
				var $body = $('body');
				var $windowHeight = $window.height();
				var $navigation_menu = $('#navigation_menu');
				var $menu_button = $('#menu_button');
				var $parallax = $('.parallax');

        var $statistic_amounts = $('.statistic_amount');
				var need_to_animate_statistics =  ($statistic_amounts.length > 0)  ;
        if (need_to_animate_statistics) {
          var stats_animated  = $statistic_amounts.countTo({
            speed: 3000,
            refreshInterval: 40
          });
          stats_animated.countTo('stop');
        }



				$menu_button.on('click', function(){
					$navigation_menu.toggleClass('menu_visible');
				});

				// if press escape key, hide menu
				$(document).on('keydown', function(e){
					if(e.keyCode == 27 ){
						$navigation_menu.removeClass('menu_visible');
					}
				})


				$window.scroll(function(){

						var windowScroll = $window.scrollTop();

						var translateY = windowScroll * 0.2;
						$parallax.css({'transform': 'translateY(' + translateY + 'px)'  });


						if (need_to_animate_statistics){
							if ( windowScroll  > ($statistic_amounts.first().offset().top - $windowHeight) ) {
									stats_animated.countTo('start');
									need_to_animate_statistics = false;
							}
						}



					});




						function animateStatisticAmounts(){
							console.log('asdf');
						}







	});

})(jQuery, this);
