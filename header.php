<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
				<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i" rel="stylesheet">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>


	</head>
	<body <?php body_class(); ?>>


			<header class="header" id="header">
				<div class="container">
							<a href="<?php echo home_url(); ?>" class="branding">
								<span><?php bloginfo('name'); ?></span>
							</a>
				</div>
							<nav id="navigation_menu" role="navigation">
								 <ul>
									 <?php  chilly_nav('primary-navigation'); ?>

									 <li id="search_li">
										 <a data-supermenu="supermenu_searchform" class="top_level_link" href="#" id="search_opener">&nbsp;</a>
										 <div class="custom-sub">
											 <div class="container">
												 	<form>
														<input type="text" name="s" placeholder="Search this site" />
													</form>
												</div>
										</div>
									 </li>

								 </ul>
							</nav>

					<a href="#" id="menu_button" >Menu</a>
			</header>
