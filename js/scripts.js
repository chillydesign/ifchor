(function ($, root, undefined) {

	$(function () {

		'use strict';


				var $window = $(window);
				var $body = $('body');
				var $windowHeight = $window.height();
				var $navigation_menu = $('#navigation_menu');
				var $menu_button = $('#menu_button');
				var $parallax = $('.parallax');


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
						console.log(translateY);
						$parallax.css({'transform': 'translateY(' + translateY + 'px)'  })



					});












	});

})(jQuery, this);
