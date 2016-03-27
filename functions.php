<?php
function chipsScripts() {
	if (!is_admin()) {
		wp_register_script('libsJS',get_bloginfo('template_directory') . '/js/compressed/libs.js');
		wp_enqueue_script('libsJS');
		wp_register_script('paper',get_bloginfo('template_directory') . '/js/paper.js');
		wp_enqueue_script('paper');
		wp_register_script('secondary',get_bloginfo('template_directory') . '/js/secondary.js');
		wp_enqueue_script('secondary');
		wp_register_script('scriptsJS',get_bloginfo('template_directory') . '/js/project.js');
		wp_enqueue_script('scriptsJS');
	}
}
add_action('init', 'chipsScripts');

// URL endpoints let you check if a URL contains a string
//add_rewrite_endpoint( 'archive', EP_PERMALINK | EP_PAGES );
	// Use:
	// if ( isset( $wp_query->query_vars['archive'] )){ do stuff... }


/* Change the Stylesheet directory */
add_filter('stylesheet_uri','wpi_stylesheet_uri',10,2);
function wpi_stylesheet_uri($stylesheet_uri, $stylesheet_dir_uri){
	return $stylesheet_dir_uri.'/css/styles.css';
}

/* WORDPRESS WIDGETS */
function chips_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'chipsstarter' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'chipsstarter' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'chips_widgets_init' );


// ACF OPTIONS PAGES
// if(function_exists('acf_add_options_page')) {
// 	acf_add_options_page();
// 	acf_add_options_sub_page('Header');
// 	acf_add_options_sub_page('Footer');
// }

// Facebook Open Graph
add_action('wp_head', 'add_fb_open_graph_tags');
function add_fb_open_graph_tags() {
	if (is_single()) {
		global $post;
		if(get_the_post_thumbnail($post->ID, 'thumbnail')) {
			$thumbnail_id = get_post_thumbnail_id($post->ID);
			$thumbnail_object = get_post($thumbnail_id);
			$image = $thumbnail_object->guid;
		} else {
			$image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
		}
		//$description = get_bloginfo('description');
		$description = my_excerpt( $post->post_content, $post->post_excerpt );
		$description = strip_tags($description);
		$description = str_replace("\"", "'", $description);
?>
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:type" content="article" />
<?php if(strlen($image) > 3){ ?><meta property="og:image" content="<?php echo $image; ?>" /><?php } ?>
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="og:description" content="<?php echo $description ?>" />
<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />

<?php 	}
}

function my_excerpt($text, $excerpt){
	if ($excerpt) return $excerpt;
	$text = strip_shortcodes( $text );
	$text = apply_filters('the_content', $text);
	$text = str_replace(']]>', ']]&gt;', $text);
	$text = strip_tags($text);
	$excerpt_length = apply_filters('excerpt_length', 55);
	$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
	$words = preg_split("/[\n
	 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
	if ( count($words) > $excerpt_length ) {
		array_pop($words);
		$text = implode(' ', $words);
		$text = $text . $excerpt_more;
	} else {
		$text = implode(' ', $words);
	}
	return apply_filters('wp_trim_excerpt', $text, $excerpt);
}

// Remove canonical meta tag
remove_action('wp_head', 'rel_canonical');

// Add Featured Images to Wordpress
// add_theme_support( 'post-thumbnails' );

// Move the JS to the footer
remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);
// Clean up WP header
remove_action( 'wp_head', 'feed_links_extra'); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links'); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
add_editor_style( 'css/editor-style.css' );
// add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/admin-style.css', false, '1.0.0' );
}

function replace_howdy( $wp_admin_bar ) {
	$my_account=$wp_admin_bar->get_node('my-account');
	$newtitle = str_replace( 'Howdy,', '', $my_account->title );
	$wp_admin_bar->add_node( array(
		'id' => 'my-account',
		'title' => $newtitle,
	) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );

function remove_admin_menu_items() {
	$remove_menu_items = array('Links','Comments');
	global $menu;
	end ($menu);
	while (prev($menu)){
		$item = explode(' ',$menu[key($menu)][0]);
		if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
		unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_admin_menu_items');

function remove_recent_comment_style() {
	global $wp_widget_factory;
	remove_action(
		'wp_head',
		array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' )
	);
}
add_action( 'widgets_init', 'remove_recent_comment_style' );

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
}

function remove_menus () {
global $menu;
	$restricted = array(__('Posts'),  __('Pages'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');
