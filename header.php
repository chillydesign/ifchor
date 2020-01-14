<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

				<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-touch-icon.png?v=m2lqpg">
				<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-32x32.png?v=m2lqpg">
				<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-16x16.png?v=m2lqpg">
				<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicon/manifest.json?v=m2lqpg">
				<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon/safari-pinned-tab.svg?v=m2lqpg" color="#251f4b">
				<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon.ico?v=m2lqpg">
				<meta name="apple-mobile-web-app-title" content="Ifchor">
				<meta name="application-name" content="Ifchor">
				<meta name="theme-color" content="#ffffff">
				<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i" rel="stylesheet">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
	
		<?php wp_head(); ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-150368746-1"></script>
		<script>
  		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
  		gtag('js', new Date());

  		gtag('config', 'UA-150368746-1');
		</script>
		

	</head>
	<body <?php body_class(); ?>>
<div class="allbutfooter">

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
												 	<form method="get" action="<?php echo home_url(); ?>">
														<input autofocus id="header_s" type="text" name="s" placeholder="Search this site" />
													</form>
												</div>
										</div>
									 </li>

								 </ul>
							</nav>

					<a href="#" id="menu_button" >Menu</a>
			</header>
