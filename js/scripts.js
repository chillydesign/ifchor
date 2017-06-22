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


				var has_stats_animated = false;
				var stats_animated  = $('.statistic_amount').countTo({
					speed: 3000,
					refreshInterval: 40
				});
				stats_animated.countTo('stop');


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


						if (!has_stats_animated){
							if ( windowScroll  > ($statistic_amounts.first().offset().top - $windowHeight) ) {
									stats_animated.countTo('start');
									has_stats_animated = true;
									console.log('start animating');
							}
						}



					});




						function animateStatisticAmounts(){
							console.log('asdf');
						}







	});

})(jQuery, this);
