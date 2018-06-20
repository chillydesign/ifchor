<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: webfactor.com | @webfactor
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 1600, '', true); // Large Thumbnail
    add_image_size('medium', 800, '', true); // Medium Thumbnail
    add_image_size('small', 400, '', true); // Small Thumbnail
    add_image_size('square', 200, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('webfactor', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigationh
function webfactor_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

function wf_version(){
  return '0.0.7.9 ';
}

// Load HTML5 Blank scripts (header.php)
function webfactor_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_deregister_script('jquery');

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

    }
}

// Load HTML5 Blank conditional scripts
function webfactor_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function webfactor_styles()
{

    wp_register_style('wf_style', get_template_directory_uri() . '/css/global.css', array(), wf_version(),  'all');
    wp_enqueue_style('wf_style'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'primary-navigation' => __('Primary Menu', 'webfactor'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'webfactor'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'webfactor') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'webfactor'),
        'description' => __('Description for this widget-area...', 'webfactor'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'webfactor'),
        'description' => __('Description for this widget-area...', 'webfactor'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('Read more', 'webfactor') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function webfactorgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function webfactorcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'webfactor_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'webfactor_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'webfactor_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu

add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'webfactorgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// // Create 1 Custom Post type for a Demo, called HTML5-Blank
// add_action('init', 'create_post_type_supermenu'); // Add our Supermenu Type
// function create_post_type_supermenu()
// {
//
//     register_post_type('supermenu', // Register Custom Post Type
//         array(
//         'labels' => array(
//             'name' => __('Supermenu', 'webfactor'), // Rename these to suit
//             'singular_name' => __('Supermenu', 'webfactor'),
//             'add_new' => __('Add new', 'webfactor'),
//             'add_new_item' => __('Add new supermenu', 'webfactor'),
//             'edit' => __('Edit', 'webfactor'),
//             'edit_item' => __('Edit supermenu', 'webfactor'),
//             'new_item' => __('New supermenu', 'webfactor'),
//             'view' => __('View supermenu', 'webfactor'),
//             'view_item' => __('View supermenu', 'webfactor'),
//             'search_items' => __('Search supermenu', 'webfactor'),
//             'not_found' => __('No supermenus found', 'webfactor'),
//             'not_found_in_trash' => __('No supermenus found in Trash', 'webfactor')
//         ),
//         'public' => true,
//         'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
//         'has_archive' => true,
//         'exclude_from_search' => true,
//         'supports' => array(
//             'title'
//         ), // Go to Dashboard Custom HTML5 Blank post for supports
//         'can_export' => true, // Allows export in Tools > Export
//         'taxonomies' => array(
//
//         ) // Add Category and Post Tags support
//     ));
// }


// Create 1 Custom Post type for a Demo, called HTML5-Blank
add_action('init', 'create_post_type_office'); // Add our office Type
function create_post_type_office()
{

    register_post_type('office', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Office', 'webfactor'), // Rename these to suit
            'singular_name' => __('Office', 'webfactor'),
            'add_new' => __('Add new', 'webfactor'),
            'add_new_item' => __('Add new office', 'webfactor'),
            'edit' => __('Edit', 'webfactor'),
            'edit_item' => __('Edit office', 'webfactor'),
            'new_item' => __('New office', 'webfactor'),
            'view' => __('View office', 'webfactor'),
            'view_item' => __('View office', 'webfactor'),
            'search_items' => __('Search office', 'webfactor'),
            'not_found' => __('No offices found', 'webfactor'),
            'not_found_in_trash' => __('No offices found in Trash', 'webfactor')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'exclude_from_search' => true,
        'supports' => array(
            'title'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(

        ) // Add Category and Post Tags support
    ));
}


add_action('init', 'create_post_type_person'); // Add our person Type
function create_post_type_person()
{

    register_post_type('person', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('People', 'webfactor'), // Rename these to suit
            'singular_name' => __('Person', 'webfactor'),
            'add_new' => __('Add New', 'webfactor'),
            'add_new_item' => __('Add new person', 'webfactor'),
            'edit' => __('Edit', 'webfactor'),
            'edit_item' => __('Edit person', 'webfactor'),
            'new_item' => __('New person', 'webfactor'),
            'view' => __('View person', 'webfactor'),
            'view_item' => __('View person', 'webfactor'),
            'search_items' => __('Search people', 'webfactor'),
            'not_found' => __('No people found', 'webfactor'),
            'not_found_in_trash' => __('No people found in Trash', 'webfactor')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'exclude_from_search' => false,
        'supports' => array(
            'title',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(

        ) // Add Category and Post Tags support
    ));
}



add_action('init', 'create_post_type_vacancy'); // Add our Vacancy Type
function create_post_type_vacancy() {


    $labels_vacancy_category = array(
        'name'                       => 'Categories',
        'singular_name'              => 'Category',
        'menu_name'                  => 'Category',
        'all_items'                  => 'All categories',
        'add_new_item'               => 'Add new category',
        'edit_item'                  => 'Edit category',
    );
    $args_vacancy_category = array(
        'labels'                     => $labels_vacancy_category,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
    );
    register_taxonomy( 'vacancy_category', array( 'vacancy' ), $args_vacancy_category );

    $labels_vacancy_location = array(
        'name'                       => 'Locations',
        'singular_name'              => 'Location',
        'menu_name'                  => 'Location',
        'all_items'                  => 'All locations',
        'add_new_item'               => 'Add new location',
        'edit_item'                  => 'Edit location',
    );
    $args_vacancy_location = array(
        'labels'                     => $labels_vacancy_location,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
    );
    register_taxonomy( 'vacancy_location', array( 'vacancy' ), $args_vacancy_location );


    register_post_type('vacancy', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Vacancies', 'webfactor'), // Rename these to suit
            'singular_name' => __('Vacancy', 'webfactor'),
            'add_new' => __('Add New', 'webfactor'),
            'add_new_item' => __('Add New Vacancy', 'webfactor'),
            'edit' => __('Edit', 'webfactor'),
            'edit_item' => __('Edit Vacancy', 'webfactor'),
            'new_item' => __('New Vacancy', 'webfactor'),
            'view' => __('View Vacancy', 'webfactor'),
            'view_item' => __('View Vacancy', 'webfactor'),
            'search_items' => __('Search Vacancies', 'webfactor'),
            'not_found' => __('No Vacancies found', 'webfactor'),
            'not_found_in_trash' => __('No Vacancies found in Trash', 'webfactor')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'exclude_from_search' => false,
        'supports' => array(
            'title',
            'thumbnail',
            'editor',
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(

        ) // Add Category and Post Tags support
    ));
}







/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}




function chilly_nav($menu){

    wp_nav_menu(
    array(
        'theme_location'  => $menu,
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '%3$s',
        'depth'           => 0,
        'walker'          => new Child_Wrap()
        )
    );

}

function chilly_map( $atts, $content = null ) {

    $attributes = shortcode_atts( array(
        'title' => "Rue du Midi 15 Case postale 411 1020 Renens"
    ), $atts );



    $title = $attributes['title'];
    $chilly_map = '<div id="map_container_1"></div>';
    $chilly_map .= "<script> var latt = 46.5380683; var lonn=6.5812023; var map_title = '" . $title . "'  </script>";
    return $chilly_map;

}
add_shortcode( 'chilly_map', 'chilly_map' );


function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  // add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );


function remove_json_api () {

    // Remove the REST API lines from the HTML Header
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    // Turn off oEmbed auto discovery.
    add_filter( 'embed_oembed_discover', '__return_false' );
    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
   // Remove all embeds rewrite rules.
  // add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

}
add_action( 'after_setup_theme', 'remove_json_api' );




function count_to_bootstrap_class($count){

    if ($count == 1) {
        // $class = 'col-sm-10 col-sm-push-1 col-md-8 col-md-push-2';
        $class = 'col-sm-12';
    } elseif ($count == 2) {
        $class = 'col-sm-6';
    } elseif ($count == 3) {
        $class = 'col-sm-4';
    } elseif ($count == 4) {
        $class = 'col-sm-3 col-xs-6';
    } elseif ($count <= 6 ) {
        $class = 'col-sm-2';
    } else {
        $class = 'col-sm-1';
    }
    return $class;
};

function thumbnail_of_post_url( $post_id,  $size='large'  ) {

     $image_id = get_post_thumbnail_id(  $post_id );
     $image_url = wp_get_attachment_image_src($image_id, $size  );
     $image = $image_url[0];
     return $image;

}


function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');




function get_supermenu(){

  $supermenus = get_posts(  array('post_type' => 'supermenu', 'posts_per_page' => 1  ) );

  $top_level_links_array = [];
  $supermenus_array = [];

  if (sizeof( $supermenus ) > 0 )  :
    $supermenu = $supermenus[0];
    $supermenu_id = $supermenu->ID;
    $top_levels = get_field('top_level_link',  $supermenu_id );



    while ( have_rows('top_level_link', $supermenu_id) ) : the_row();
      $image = get_sub_field('image'  );
      // $link = get_sub_field('link'  );
      $link_text = get_sub_field('link_text'  );
      $link_id = 'supermenu_' . sanitize_title($link_text);
      $top_level_link = '<li class=" menu-item"><a class="top_level_link"  data-supermenu="'. $link_id .'"   href="#">' . $link_text . '</a></li>';
      array_push($top_level_links_array, $top_level_link);

      $supermenu = '<div class="supermenu" id="'. $link_id  .'" >
        <div class="container">
          <div class="row">';

            while ( have_rows('supermenu_body') ) : the_row();


              $supermenu .= '<div class="col-sm-20">';
              $supermenu .=  get_sub_field('content');
              $supermenu .=  '</div>';

            endwhile;

            $supermenu .= '</div></div></div>';

    array_push($supermenus_array, $supermenu);



    endwhile;

  endif;

  $return = new stdClass();
  $return->top_level_links = implode($top_level_links_array, '');
  $return->supermenus = implode($supermenus_array, '');
  return $return;


}



class Child_Wrap extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"custom-sub\"><div class=\"container2\"><ul class=\"sub-menu\">\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div></div>\n";
    }
}




add_action('pre_get_posts','alter_search_query');

function alter_search_query($query) {
	//gets the global query var object
	global $wp_query, $wpdb;


    if (is_search()){

        // get all the post ids that have any postmeta that match the search term
        global $wpdb;
        $sql = "SELECT DISTINCT ID FROM wp_postmeta
                LEFT JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID
                WHERE post_status = 'publish'
                AND  (
                    `meta_value` LIKE %s
                    OR  post_title LIKE %s
                    OR  post_content LIKE %s
                )";

        $search =  get_query_var( 's', '' );
        $str = '%'. $search  .'%';
        $results = $wpdb->get_results($wpdb->prepare( $sql, $str, $str, $str ));
        $ids = array();
        foreach ($results as $result) {
            array_push($ids,   intval($result->ID)  );
        }

        // replace the current wp query with the IDs that i found
        $query->query_vars['post__in'] = $ids;
        $query->query_vars['s'] = null;
    }
}



function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats( $init_array ) {

// Define the style_formats array

    $style_formats = array(
/*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements
*/
        array(
            'title' => 'Grey box',
            'block' => 'div',
            'classes' => 'encadre',
            'wrapper' => true,

        ),
        array(
            'title' => 'Accordion',
            'block' => 'div',
            'classes' => 'accordeon',
            'wrapper' => true,

        )
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-styles.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );









//Sendgrid

add_shortcode( 'registration_form',  'registration_form_shortcode' );
//  ADD REQUEST FORM AS A SHORTCODE
function registration_form_shortcode($atts , $content = null) {
  $rq_frm = '
  <h6><a class="trigger_open" href="#">Sign up to request Ifchor reports</a></h6>
  <div class="popup_form">
  <div class="container">
  <form id="course_form" action="' .  esc_url( admin_url('admin-post.php') ) . '" method="post">
  <h3>Sign up to request Ifchor reports</h3>

  <label for="first_name">First name</label>
  <input type="text" name="first_name">

  <label for="last_name">Last name</label>
  <input type="text" name="last_name">

  <label for="company">Company</label>
  <input type="text" name="company">

  <label for="position">Position</label>
  <input type="text" name="position">

  <label for="location">City - Country</label>
  <input type="text" name="location">

  <label for="email">Email</label>
  <input type="email" name="email">

  <label for="phone">Phone Number</label>
  <input type="text" name="phone">

  <p style="margin-bottom:-20px"><strong>Type of report requested</strong></p>
    <label class="checkbox_label"><input type="checkbox" name="reports[]" value="Dry Bulk: Quarterly Report">Dry Bulk: Quarterly Report</label>
    <label class="checkbox_label"><input type="checkbox" name="reports[]" value="Dry Bulk: Monthly Fleet Net Change">Dry Bulk: Monthly Fleet Net Change</label>
    <label class="checkbox_label"><input type="checkbox" name="reports[]" value="Dry Bulk: Panamax Assessment">Dry Bulk: Panamax Assessment</label>
    <label class="checkbox_label"><input type="checkbox" name="reports[]" value="Dry Bulk: Ifchor Daily Bulletin">Dry Bulk: Ifchor Daily Bulletin</label>
    <label class="checkbox_label"><input type="checkbox" name="reports[]" value="Wet: Monthly Fleet Net Change">Wet: Monthly Fleet Net Change</label>
    <label class="checkbox_label"><input type="checkbox" name="reports[]" value="Wet: Ifchor Tankers Market Daily Snapshot">Wet: Ifchor Tankers Market Daily Snapshot</label>

  <label for="message" style="margin-top:40px">Message</label>
  <textarea name="message"></textarea>

  <input type="hidden" name="action" value="registration_form">
    <div class="submit_group_button">
    <input type="submit" id="submit_course_form" value="Submit">
  </form>
  <div class="close">x</div>
  </div>
  </div>
  ';
  return  $rq_frm;
}


// GET POSTED DATA FROM FORM
// TO DO REMAME FUNCTION
add_action( 'admin_post_nopriv_registration_form',    'process_registration_form'   );
add_action( 'admin_post_registration_form',  'process_registration_form' );



function process_registration_form() {

    $referer = $_SERVER['HTTP_REFERER'];
    $referer =  explode('?',   $referer)[0];

    // IF DATA HAS BEEN POSTED
    if ( isset($_POST['action'])  && $_POST['action'] == 'registration_form'   ) :


      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $company = $_POST['company'];
      $position = $_POST['position'];
      $location = $_POST['location'];
      $email = $_POST['email'];
      $reports = $_POST['reports'];
      $phone = $_POST['phone'];
      $message = $_POST['message'];


      $email_body = '';
      $email_body .= '<p><strong>From</strong> : ' . $first_name . ' ' . $last_name . "</p>";
      $email_body .= '<p><strong>Company</strong> : ' . $company . "</p>";
      $email_body .= '<p><strong>Position</strong> : ' . $position . "</p>";
      $email_body .= '<p><strong>City, Country</strong>: ' . $location . "</p>";
      $email_body .= '<p><strong>Email</strong> : ' . $email . "</p>";
      $email_body .= '<p><strong>Phone</strong> : ' . $phone . "</p>";
      $email_body .= '<p><strong>Report requested</strong> : ' .  implode(', ', $reports) . "</p>";
      $email_body .= '<p><strong>Message</strong> : ' . $message . "</p>";

      $email_header = file_get_contents(dirname(__FILE__) . '/emails/email_header.php');
      $email_footer = file_get_contents(dirname(__FILE__) . '/emails/email_footer.php');
      $email_content =  $email_header . $email_body . $email_footer;




      $subject = 'Subscription to Ifchor report';
      $to = array('reports@ifchor.com');

      $headers = array();
      $headers[] = 'From: Ifchor <report-subscriptions@ifchor.com>';
      $headers[] = 'unique-args:customer=mycustomer;location=mylocation';
      $headers[] = 'categories:' . implode(', ', $reports);
      // $headers[] = 'template: templateID';
      // $headers[] = 'x-smtpapi-to: address1@sendgrid.com,address2@sendgrid.com';


      add_filter('wp_mail_content_type', 'set_html_content_type');
      $mail = wp_mail($to, $subject, $email_content, $headers, $attachments);

      remove_filter('wp_mail_content_type', 'set_html_content_type');


      wp_redirect( $referer . '?success' );
    endif;
}


?>
