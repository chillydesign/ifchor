<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>


	</head>
	<body <?php body_class(); ?>>

<?php $supermenu = get_supermenu(); ?>

			<header class="header" id="header">
				<div class="container">
					<div class="row">
						<div class="col-sm-3 col-sm-push-0 col-xs-10 col-xs-push-1">
							<a href="<?php echo home_url(); ?>" class="branding">
								<span><?php bloginfo('name'); ?></span>
							</a>
						</div>
						<div class="col-sm-9">
							<nav id="navigation_menu" role="navigation">
								 <ul>
									 <?php // chilly_nav('primary-navigation'); ?>
									 	<?php echo $supermenu->top_level_links; ?>

									 <li id="search_li">
										 <a data-supermenu="supermenu_searchform" class="top_level_link" href="#" id="search_opener">&nbsp;</a>
										 	<form>
												<input type="text" name="s" placeholder="serach this site" />
											</form>
									 </li>
									 
								 </ul>
							</nav>
						</div>

					</div>
					<a href="#" id="menu_button" >Menu</a>
				</div>



				<div id="supermenus">
					 	<?php echo $supermenu->supermenus; ?>

						<div class="supermenu" id="supermenu_searchform" >
			        <div class="container">
								<h2>Search</h2>
								<form>
								 <input type="text" name="s" placeholder="search this site" />
							 </form>
							</div>
						</div>

					 <div class="supermenu_background"></div>
				</div>



			</header>
