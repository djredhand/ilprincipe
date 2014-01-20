<?php

	/*-----------------------------------------------------------------------------------*/
	/* Set Proper Parent/Child theme paths for inclusion
	/*-----------------------------------------------------------------------------------*/

	@define( 'PARENT_DIR', get_template_directory() );
	@define( 'CHILD_DIR', get_stylesheet_directory() );

	@define( 'PARENT_URL', get_template_directory_uri() );
	@define( 'CHILD_URL', get_stylesheet_directory_uri() );
	//Loading theme textdomain

	if ( !function_exists('cherry_theme_setup')) {
		function cherry_theme_setup() {
		    load_theme_textdomain( CURRENT_THEME, PARENT_DIR . '/languages' );	 
		}
		add_action('after_setup_theme', 'cherry_theme_setup');
	}
	require_once PARENT_DIR . '/includes/locals.php';
	//Loading Custom function
	include_once(CHILD_DIR . '/includes/custom-function.php');	
	
	//Loading jQuery and Scripts
	require_once PARENT_DIR . '/includes/theme-scripts.php';
	
	//Widget and Sidebar
	require_once CHILD_DIR . '/includes/sidebar-init.php';
	require_once PARENT_DIR . '/includes/register-widgets.php';
	
	//Theme initialization
	require_once CHILD_DIR . '/includes/theme-init.php';
	
	//Additional function
	require_once PARENT_DIR . '/includes/theme-function.php';
	
	//Shortcodes
	require_once PARENT_DIR . '/includes/theme_shortcodes/columns.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/shortcodes.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/posts_grid.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/posts_list.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/mini_posts_list.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/mini_posts_grid.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/alert.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/tabs.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/toggle.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/html.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/misc.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/service_box.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/post_cycle.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/carousel.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/progressbar.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/banner.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/table.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/hero_unit.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/roundabout.php';
	require_once PARENT_DIR . '/includes/theme_shortcodes/categories.php';
	
	//tinyMCE includes
	include_once(PARENT_DIR . '/includes/theme_shortcodes/tinymce/tinymce_shortcodes.php');
	
	//Aqua Resizer for image cropping and resizing on the fly
	require_once PARENT_DIR . '/includes/aq_resizer.php';
	
	// Add the postmeta
	include_once(PARENT_DIR . '/includes/theme-postmeta.php');
	
	// Add the postmeta to Portfolio posts
	include_once(PARENT_DIR . '/includes/theme-portfoliometa.php');
	
	// Add the postmeta to Slider posts
	include_once(PARENT_DIR . '/includes/theme-slidermeta.php');
	
	// Add the postmeta to Testimonials
	include_once(PARENT_DIR . '/includes/theme-testimeta.php');
	
	// Add the postmeta to Our Team posts
	include_once(PARENT_DIR . '/includes/theme-teammeta.php');

	//Loading options.php for theme customizer
	include_once(CHILD_DIR . '/options.php');

	//Plugin Activation
	require_once(CHILD_DIR . '/includes/class-tgm-plugin-activation.php');
	require_once(CHILD_DIR . '/includes/register-plugins.php');

	// Framework Update
	include_once(PARENT_DIR . '/includes/update.php');

	// WP Pointers
	include_once(PARENT_DIR . '/includes/class.wp-help-pointers.php');
	
	// removes detailed login error information for security
	add_filter('login_errors',create_function('$a', "return null;"));
	
	/* 
	 * Loads the Options Panel
	 *
	 * If you're loading from a child theme use stylesheet_directory
	 * instead of template_directory
	 */
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', PARENT_URL . '/admin/' );
		require_once dirname( __FILE__ ) . '/admin/options-framework.php';
	}
	
	
	// Removes Trackbacks from the comment cout	
	if (!function_exists('comment_count')) {
		add_filter('get_comments_number', 'comment_count', 0);
		
		function comment_count( $count ) {
			if ( ! is_admin() ) {
				global $id;
				$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
				return count($comments_by_type['comment']);
			} else {
				return $count;
			}
		}
	
	}
	
	
	// Post Formats
	$formats = array( 
				'aside', 
				'gallery', 
				'link', 
				'image', 
				'quote', 
				'audio',
				'video');
	add_theme_support( 'post-formats', $formats ); 
	add_post_type_support( 'post', 'post-formats' );
	
	
	
	// Custom excpert length
	if(!function_exists('new_excerpt_length')) {
		
		function new_excerpt_length($length) {
			return 60;
		}
		add_filter('excerpt_length', 'new_excerpt_length');
	
	}

  
	
	// enable shortcodes in sidebar
	add_filter('widget_text', 'do_shortcode');
	
	// custom excerpt ellipses for 2.9+
	if(!function_exists('custom_excerpt_more')) {
	
		function custom_excerpt_more($more) {
			return theme_locals("read_more").' &raquo;';
		}
		add_filter('excerpt_more', 'custom_excerpt_more');
	
	}
	
	// no more jumping for read more link
	if(!function_exists('no_more_jumping')) {
		
		function no_more_jumping($post) {
			return '&nbsp;<a href="'.get_permalink().'" class="read-more">'.theme_locals("continue_reading").'</a>';
		}
		add_filter('excerpt_more', 'no_more_jumping');
		
	}
	
	
	// category id in body and post class
	if(!function_exists('category_id_class')) {
		
		function category_id_class($classes) {
			global $post;
			foreach((get_the_category()) as $category)
				$classes [] = 'cat-' . $category->cat_ID . '-id';
				return $classes;
		}
		add_filter('post_class', 'category_id_class');
		add_filter('body_class', 'category_id_class');
		
	}
	
	// Threaded Comments
	if(!function_exists('enable_threaded_comments')) {
		function enable_threaded_comments()
		{
			if (!is_admin()) {
				if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
					wp_enqueue_script('comment-reply');
				}
			}	
		}
		add_action('get_header', 'enable_threaded_comments');
	}

// Navigation with description
	if (! class_exists('description_walker')) {
		class description_walker extends Walker_Nav_Menu {
			function start_el(&$output, $item, $depth, $args) {
				global $wp_query;
				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$class_names = $value = '';

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;

				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
				$class_names = ' class="'. esc_attr( $class_names ) . '"';

				$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

				$description  = ! empty( $item->description ) ? '<span class="desc">'.esc_attr( $item->description ).'</span>' : '';

				if($depth != 0) {
					$description = $append = $prepend = "";
				}

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before;

				if (isset($prepend))
					$item_output .= $prepend;

				$item_output .= apply_filters( 'the_title', $item->title, $item->ID );

				if (isset($append))
					$item_output .= $append;
				
				$item_output .= $description.$args->link_after;					
				$item_output .= '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}
	}
/* CHERRY UPDATE */

	if (current_user_can('update_themes' ))
	{
		$cherry_old_version = get_option("cherry_version", "1.0");
		$cherry_current_version = getCherryVersion();

		if (version_compare($cherry_current_version,  $cherry_old_version) > 0 ||
				get_option("cherry_force_update", false))
		{
			update_cherry($cherry_old_version, $cherry_current_version);
		}
	}
	
	function update_cherry($cherry_old_version, $cherry_current_version) {
	
		/* do update */
	
		update_option("cherry_version", $cherry_current_version);
		update_option("cherry_force_update", false);
	}
	
	function getCherryVersion() {
		$theme_version = 0;

		if (function_exists('wp_get_theme')) {
			$theme_data = wp_get_theme(get_option('template'));
			$theme_version = $theme_data->Version;  
		} else {
			$theme_data = get_theme_data( TEMPLATEPATH . '/style.css');
			$theme_version = $theme_data['Version'];
		}
		
		return $theme_version;
	}
/* END CHERRY UPDATE */
?>