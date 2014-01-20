<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

if(!function_exists('optionsframework_option_name')) {
	function optionsframework_option_name() {
		// This gets the theme name from the stylesheet (lowercase and without spaces)
		$themename = CURRENT_THEME;
		
		$optionsframework_settings = get_option('optionsframework');
		$optionsframework_settings['id'] = $themename;
		update_option('optionsframework', $optionsframework_settings);		
	}
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

 
if(!function_exists('optionsframework_options')) {

	function optionsframework_options() {
	
		// Logo type
		$logo_type = array(
			"image_logo" => theme_locals("image_logo"),
			"text_logo" => theme_locals("text_logo")
		);
		
		// Search box in the header
		$g_search_box = array(
			"no" => theme_locals("no"),
			"yes" => theme_locals("yes")
		);

		// Breadcrumbs in the page
		$g_breadcrumbs = array(
			"no" => theme_locals("no"),
			"yes" => theme_locals("yes")
		);		
		
		// Background Defaults
		$background_defaults = array(
			'color' => '#000000', 
			'image' => get_stylesheet_directory_uri() . '/images/pattern.gif', 
			'repeat' => 'repeat',
			'position' => 'top center',
			'attachment'=>'scroll'
		);
		
		// Superfish fade-in animation
		$sf_f_animation_array = array(
			"show" => theme_locals("enable fade-in animation"),
			"false" => theme_locals("disable fade-in animation")
		);
		
		// Superfish slide-down animation
		$sf_sl_animation_array = array(
			"show" => theme_locals("enable slide-down animation"),
			"false" => theme_locals("disable slide-down animation")
		);
		
		// Superfish animation speed
		$sf_speed_array = array(
			"slow" => theme_locals("slow_speed"),"normal" => theme_locals("normal_speed"),
			"fast" => theme_locals("fast_speed")
		);
		
		// Superfish arrows markup
		$sf_arrows_array = array(
			"true" => theme_locals("yes"),
			"false" => theme_locals("no")
		);		
		
		// Fonts
		$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
		asort($typography_mixed_fonts);
		
		
		// Slider effects
		$sl_effect_array = array("random" => theme_locals("random"), "simpleFade" => theme_locals("simpleFade"), "curtainTopLeft" => theme_locals("curtainTopLeft"), "curtainTopRight" => theme_locals("curtainTopRight"), "curtainBottomLeft" => theme_locals("curtainBottomLeft"), "curtainBottomRight" => theme_locals("curtainBottomRight"), "curtainSliceLeft" => theme_locals("curtainSliceLeft"), "curtainSliceRight" => theme_locals("curtainSliceRight"), "blindCurtainTopLeft" => theme_locals("blindCurtainTopLeft"), "blindCurtainTopRight" => theme_locals("blindCurtainTopRight"), "blindCurtainBottomLeft" => theme_locals("blindCurtainBottomLeft"), "blindCurtainBottomRight" => theme_locals("blindCurtainBottomRight"), "blindCurtainSliceBottom" => theme_locals("blindCurtainSliceBottom"), "blindCurtainSliceTop" => theme_locals("blindCurtainSliceTop"), "stampede" => theme_locals("stampede"), "mosaic" => theme_locals("mosaic"), "mosaicReverse" => theme_locals("mosaicReverse"), "mosaicRandom" => theme_locals("mosaicRandom"), "mosaicSpiral" => theme_locals("mosaicSpiral"), "mosaicSpiralReverse" => theme_locals("mosaicSpiralReverse"), "topLeftBottomRight" => theme_locals("topLeftBottomRight"), "bottomRightTopLeft" => theme_locals("bottomRightTopLeft"), "bottomLeftTopRight" => theme_locals("bottomLeftTopRight"));
	 
		// Banner effects
		$sl_banner_array = array("moveFromLeft" => theme_locals("moveFromLeft"), "moveFromRight" => theme_locals("moveFromRight"), "moveFromTop" => theme_locals("moveFromTop"), "moveFromBottom" => theme_locals("moveFromBottom"), "fadeIn" => theme_locals("fadeIn"), "fadeFromLeft" => theme_locals("fadeFromLeft"), "fadeFromRight" => theme_locals("fadeFromRight"), "fadeFromTop" => theme_locals("fadeFromTop"), "fadeFromBottom" => theme_locals("fadeFromBottom"));
	 
		// Slider columns
		$sl_columns_array = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10", "11" => "11", "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16", "17" => "17", "18" => "18", "19" => "19", "20" => "20");
	 
		// Slider rows
		$sl_rows_array = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10", "11" => "11", "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16", "17" => "17", "18" => "18", "19" => "19", "20" => "20");
	 
		// Slideshow
		$sl_slideshow_array = array("true" => theme_locals("yes"),"false" => theme_locals("no"));
	 
		// Thumbnails
		$sl_thumbnails_array = array("true" => theme_locals("yes"),"false" => theme_locals("no"));
	 
		// Slider control navigation
		$sl_control_nav_array = array("true" => theme_locals("yes"),"false" => theme_locals("no"));
	 
		// Slider direct navigation
		$sl_dir_nav_array = array("true" => theme_locals("yes"),"false" => theme_locals("no"));
	 
		// Slider direct navigation on hover
		$sl_dir_nav_hide_array = array("true" => theme_locals("yes"),"false" => theme_locals("no"));
	 
		// Slider play/pause button
		$sl_play_pause_button_array = array("true" => theme_locals("yes"),"false" => theme_locals("no"));

		// Slider loader
		$sl_loader_array = array("no" => theme_locals("none"), "pie" => theme_locals("pie"), "bar" => theme_locals("bar"));
		
		// Footer menu
		$footer_menu_array = array("true" => theme_locals("yes"), "false" => theme_locals("no"));
		
		// Featured image size on the blog.
		$post_image_size_array = array("normal" => theme_locals("normal_size"),"large" => theme_locals("large_size"));
		
		// Featured image size on the single page.
		$single_image_size_array = array("normal" => theme_locals("normal_size"),"large" => theme_locals("large_size"));
		
		// Meta for blog
		$post_meta_array = array("true" => theme_locals("yes"), "false" => theme_locals("no"));
		
		// Meta for blog
		$post_excerpt_array = array(
			"true" => theme_locals("yes"),
			"false" => theme_locals("no")
		);
			
		// If using image radio buttons, define a directory path
		$imagepath =  get_template_directory_uri() . '/includes/images/';
			
		$options = array();
		
		$options[] = array( "name" => theme_locals('general'),
							"type" => "heading");
		
		$options['body_background'] = array( 
							"name" =>  theme_locals('body_name'),
							"desc" => theme_locals('body_desc'),
							"id" => "body_background",
							"std" => $background_defaults, 
							"type" => "background");
		
		$options['header_color'] = array( "name" => theme_locals('header_name'),
							"desc" => theme_locals('header_desc'),
							"id" => "header_color",
							"std" => "#2c3e50",
							"type" => "color");
		
		$options['links_color'] = array( "name" => theme_locals('buttons_name'),
							"desc" => theme_locals('buttons_desc'),
							"id" => "links_color",
							"std" => "",
							"type" => "color");
							
							
		$options['google_mixed_3'] = array( 'name' => theme_locals('body_text_name'),
							'desc' => theme_locals('body_text_desc'),
							'id' => 'google_mixed_3',
							'std' => array( 'size' => '13px', 'lineheight' => '22px', 'face' => 'PT Serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#5e5e5e'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
							
		$options['h1_heading'] = array( 'name' => theme_locals('h1_name'),
							'desc' => theme_locals('h1_desc'),
							'id' => 'h1_heading',
							'std' => array( 'size' => '30px', 'lineheight' => '36px', 'face' => 'PT Serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#2c2c2c'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
		
		$options['h2_heading'] = array( 'name' => theme_locals('h2_name'),
							'desc' => theme_locals('h2_desc'),
							'id' => 'h2_heading',
							'std' => array( 'size' => '24px', 'lineheight' => '28px', 'face' => 'PT Serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#2c2c2c'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
							
		$options['h3_heading'] = array( 'name' => theme_locals('h3_name'),
							'desc' => theme_locals('h3_desc'),
							'id' => 'h3_heading',
							'std' => array( 'size' => '18px', 'lineheight' => '20px', 'face' => 'PT Serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#2c2c2c'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
		
		$options['h4_heading'] = array( 'name' => theme_locals('h4_name'),
							'desc' => theme_locals('h4_desc'),
							'id' => 'h4_heading',
							'std' => array( 'size' => '14px', 'lineheight' => '18px', 'face' => 'PT Serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#2c2c2c'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
							
		$options['h5_heading'] = array( 'name' => theme_locals('h5_name'),
							'desc' => theme_locals('h5_desc'),
							'id' => 'h5_heading',
							'std' => array( 'size' => '12px', 'lineheight' => '18px', 'face' => 'PT Serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#2c2c2c'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
							
		$options['h6_heading'] = array( 'name' => theme_locals('h6_name'),
							'desc' => theme_locals('h6_desc'),
							'id' => 'h6_heading',
							'std' => array( 'size' => '11px', 'lineheight' => '18px', 'face' => 'PT Serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#2c2c2c'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
		
		
		$options['g_search_box_id'] = array( "name" => theme_locals('search_name'),
							"desc" => theme_locals('search_desc'),
							"id" => "g_search_box_id",
							"type" => "radio",
							"std" => "yes",
							"options" => $g_search_box);

		$options['g_breadcrumbs_id'] = array( "name" => theme_locals('breadcrumbs_name'),
							"desc" => theme_locals('breadcrumbs_desc'),
							"id" => "g_breadcrumbs_id",
							"type" => "radio",
							"std" => "yes",
							"options" => $g_breadcrumbs);

		$options[] = array( "name" => __("Header button text", 'theme44911'),
							"desc" => __("Type text for header button.", 'theme44911'),
							"id" => "header_btn_txt",
							"std" => __("Download samples", 'theme44911'),
							"type" => "text");

		$options[] = array( "name" => __("Header button URL", 'theme44911'),
							"desc" => __("Put link for header button.", 'theme44911'),
							"id" => "header_btn_link",
							"std" => "#",
							"type" => "text");
		
		$options[] = array( "name" => theme_locals('css_name'),
							"desc" => theme_locals('css_desc'),
							"id" => "custom_css",
							"std" => "",
							"type" => "textarea");		
		
		
		$options[] = array( "name" => theme_locals('logo_favicon'),
							"type" => "heading");
		
		$options['logo_type'] = array( "name" => theme_locals('logo_name'),
							"desc" => theme_locals('logo_desc'),
							"id" => "logo_type",
							"std" => "image_logo",
							"type" => "radio",
							"options" => $logo_type);

		$options[] = array( 'name' => theme_locals('logo_t_name'),
							'desc' => theme_locals('logo_t_desc'),
							'id' => 'logo_typography',
							'std' => array( 'size' => '40px', 'lineheight' => '48px', 'face' => 'Arial, Helvetica, sans-serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#049CDB'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
		
		$options['logo_url'] = array( "name" => theme_locals('logo_image_path'),
							"desc" => theme_locals('logo_image_path_desc'),
							"id" => "logo_url",
							"std" => get_stylesheet_directory_uri() . "/images/logo.png",
							"type" => "upload");
							
		$options['favicon'] = array( "name" => theme_locals('favicon_name'),
							"desc" => theme_locals('favicon_desc'),
							"id" => "favicon",
							"std" => get_stylesheet_directory_uri() . "/favicon.ico",
							"type" => "upload");
							
		
		
		$options[] = array( "name" => theme_locals('navigation'),
							"type" => "heading");

		$options[] = array( 'name' => theme_locals('menu_t_name'),
							'desc' => theme_locals('menu_t_desc'),
							'id' => 'menu_typography',
							'std' => array( 'size' => '16px', 'lineheight' => '20px', 'face' => 'PT Serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#2c2c2c'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
		
		$options[] = array( "name" => theme_locals('delay_name'),
							"desc" => theme_locals('delay_desc'),
							"id" => "sf_delay",
							"std" => "1000",
							"class" => "tiny",
							"type" => "text");
		
		$options[] = array( "name" => theme_locals('fade_name'),
							"desc" => theme_locals('fade_desc'),
							"id" => "sf_f_animation",
							"std" => "show",
							"type" => "radio",
							"options" => $sf_f_animation_array);
		
		$options[] = array( "name" => theme_locals('slide_name'),
							"desc" => theme_locals('slide_desc'),
							"id" => "sf_sl_animation",
							"std" => "show",
							"type" => "radio",
							"options" => $sf_sl_animation_array);
		
		$options[] = array( "name" => theme_locals('speed_name'),
							"desc" => theme_locals('speed_desc'),
							"id" => "sf_speed",
							"type" => "select",
							"std" => "normal",
							"class" => "tiny", //mini, tiny, small
							"options" => $sf_speed_array);
		
		$options[] = array( "name" => theme_locals('arrows_name'),
							"desc" => theme_locals('arrows_desc'),
							"id" => "sf_arrows",
							"std" => "false",
							"type" => "radio",
							"options" => $sf_arrows_array);		
		
		
		$options[] = array( "name" => theme_locals('slider'),
                            "type" => "heading");
 
        $options['sl_effect'] = array( "name" => theme_locals('effect_name'),
                            "desc" => theme_locals('effect_desc'),
                            "id" => "sl_effect",
                            "std" => "random",
                            "type" => "select",
                            "class" => "tiny", //mini, tiny, small
                            "options" => $sl_effect_array);
 
        $options['sl_columns'] = array( "name" => theme_locals('columns_name'),
                            "desc" => theme_locals('columns_desc'),
                            "id" => "sl_columns",
                            "std" => "12",
                            "type" => "select",
                            "class" => "small", //mini, tiny, small
                            "options" => $sl_columns_array);
 
        $options['sl_rows'] = array( "name" => theme_locals('rows_name'),
                            "desc" => theme_locals('rows_desc'),
                            "id" => "sl_rows",
                            "std" => "8",
                            "type" => "select",
                            "class" => "small", //mini, tiny, small
                            "options" => $sl_rows_array);
 
        $options[] = array( "name" =>  theme_locals('banner_name'),
	                        "desc" =>  theme_locals('banner_desc'),
	                        "id" => "sl_banner",
	                        "std" => "fadeIn",
	                        "type" => "select",
	                        "class" => "tiny", //mini, tiny, small
	                        "options" => $sl_banner_array);
 
        $options['sl_pausetime'] = array( "name" => theme_locals('pause_name'),
                            "desc" => theme_locals('pause_desc'),
                            "id" => "sl_pausetime",
                            "std" => "7000",
                            "class" => "tiny",
                            "type" => "text");
 
        $options['sl_animation_speed'] = array( "name" => theme_locals('animation_name'),
                            "desc" => theme_locals('animation_desc'),
                            "id" => "sl_animation_speed",
                            "std" => "1500",
                            "class" => "tiny",
                            "type" => "text");
 
        $options['sl_slideshow'] = array( "name" => theme_locals('slideshow_name'),
                            "desc" => theme_locals('slideshow_desc'),
                            "id" => "sl_slideshow",
                            "std" => "true",
                            "type" => "radio",
                            "options" => $sl_slideshow_array);
 
        $options['sl_thumbnails'] = array( "name" => theme_locals('thumbnails_name'),
                            "desc" => theme_locals('thumbnails_desc'),
                            "id" => "sl_thumbnails",
                            "std" => "true",
                            "type" => "radio",
                            "options" => $sl_thumbnails_array);
 
        $options['sl_control_nav'] = array( "name" => theme_locals('pagination_name'),
                            "desc" => theme_locals('pagination_desc'),
                            "id" => "sl_control_nav",
                            "std" => "true",
                            "type" => "radio",
                            "options" => $sl_control_nav_array);
 
        $options['sl_dir_nav'] = array( "name" => theme_locals('navigation_name'),
                            "desc" => theme_locals('navigation_desc'),
                            "id" => "sl_dir_nav",
                            "std" => "false",
                            "type" => "radio",
                            "options" => $sl_dir_nav_array);
 
        $options[] = array( "name" => theme_locals('hover_name'),
                            "desc" => theme_locals('hover_desc'),
                            "id" => "sl_dir_nav_hide",
                            "std" => "false",
                            "type" => "radio",
                            "options" => $sl_dir_nav_hide_array);
 
        $options['sl_play_pause_button'] = array( "name" => theme_locals('button_name'),
                            "desc" => theme_locals('button_desc'),
                            "id" => "sl_play_pause_button",
                            "std" => "false",
                            "type" => "radio",
                            "options" => $sl_play_pause_button_array);

        $options['sl_loader'] = array( "name" => theme_locals('loader_name'),
                            "desc" => theme_locals('loader_desc'),
                            "id" => "sl_loader",
                            "std" => "no",
                            "type" => "select",
                            "class" => "small", //mini, tiny, small
                            "options" => $sl_loader_array);
		
		
		
		$options[] = array( "name" => theme_locals('blog'),
							"type" => "heading");
		
		$options[] = array( "name" => theme_locals('blog_name'),
							"desc" => theme_locals('blog_desc'),
							"id" => "blog_text",
							"std" => theme_locals('blog'),
							"type" => "text");
		
		$options[] = array( "name" => theme_locals('posts_name'),
							"desc" => theme_locals('posts_desc'),
							"id" => "blog_related",
							"std" => theme_locals('posts_std'),
							"type" => "text");
		
		$options['blog_sidebar_pos'] = array( "name" => theme_locals('sidebar_name'),
							"desc" => theme_locals('sidebar_desc'),
							"id" => "blog_sidebar_pos",
							"std" => "right",
							"type" => "images",
							"options" => array(
								'left' => $imagepath . '2cl.png',
								'right' => $imagepath . '2cr.png',)
							);
		
		$options['post_image_size'] = array( "name" => theme_locals('image_size_name'),
							"desc" => theme_locals('image_size_desc'),
							"id" => "post_image_size",
							"type" => "select",
							"std" => "large_size",
							"class" => "small", //mini, tiny, small
							"options" => $post_image_size_array);
		
		$options['single_image_size'] = array( "name" => theme_locals('single_post_image_name'),
							"desc" => theme_locals('single_post_image_desc'),
							"id" => "single_image_size",
							"type" => "select",
							"std" => "large_size",
							"class" => "small", //mini, tiny, small
							"options" => $single_image_size_array);
		
		$options['post_meta'] = array( "name" => theme_locals('meta_name'),
							"desc" => theme_locals('meta_desc'),
							"id" => "post_meta",
							"std" => "true",
							"type" => "radio",
							"options" => $post_meta_array);
		
		$options['post_excerpt'] = array( "name" => theme_locals('excerpt_name'),
							"desc" => theme_locals('excerpt_desc'),
							"id" => "post_excerpt",
							"std" => "true",
							"type" => "radio",
							"options" => $post_excerpt_array);
		

		$options[] = array( "name" => theme_locals("portfolio"),
							"type" => "heading");

		$options['folio_filter'] = array( "name" => theme_locals("filter_name"),
							"desc" => theme_locals("filter_desc"),
							"id" => "folio_filter",
							"std" => "cat",
							"type" => "select",
							"options" => array(
											"cat"	=>	theme_locals("by_category"),
											"tag"	=>	theme_locals("by_tags"),
											"none"	=>	theme_locals("none")));
		
		$options['folio_title'] = array( "name" => theme_locals("show_title_name"),
							"desc" => theme_locals("show_title_desc"),
							"id" => "folio_title",
							"std" => "yes",
							"type" => "radio",
							"options" => array(
											"yes" => theme_locals("yes"),
											"no"	=> theme_locals("no")));

		$options['folio_excerpt'] = array( "name" => theme_locals("show_excerpt_name"),
							"desc" => theme_locals("show_excerpt_desc"),
							"id" => "folio_excerpt",
							"std" => "yes",
							"type" => "radio",
							"options" => array(
											"yes" => theme_locals("yes"),
											"no"	=> theme_locals("no")));

		$options['folio_excerpt_count'] = array( "name" => theme_locals("excerpt_words_name"),
							"desc" => theme_locals("excerpt_words_desc"),
							"id" => "folio_excerpt_count",
							"std" => "20",
							"class" => "small",
							"type" => "text");

		$options['folio_btn'] = array( "name" => theme_locals("show_button_name"),
							"desc" => theme_locals("show_button_desc"),
							"id" => "folio_btn",
							"std" => "yes",
							"type" => "radio",
							"options" => array(
											"yes" => theme_locals("yes"),
											"no"	=> theme_locals("no")));

		$options['layout_mode'] = array( "name" => theme_locals("layout_name"),
							"desc" => theme_locals("layout_desc"),
							"id" => "layout_mode",
							"type" => "select",
							"std" => "fitRows",
							"class" => "small", //mini, tiny, small
							"options" => array(
											"fitRows" => theme_locals("fit_rows"),
											"masonry" => theme_locals("masonry")));

		$options['items_count2'] = array( "name" => theme_locals("portfolio_2_name"),
							"desc" => theme_locals("portfolio_2_desc"),
							"id" => "items_count2",
							"std" => "8",
							"class" => "small",
							"type" => "text");

		$options['items_count3'] = array( "name" => theme_locals("portfolio_3_name"),
							"desc" => theme_locals("portfolio_3_desc"),
							"id" => "items_count3",
							"std" => "9",
							"class" => "small",
							"type" => "text");
		
		$options['items_count4'] = array( "name" => theme_locals("portfolio_4_name"),
							"desc" => theme_locals("portfolio_4_desc"),
							"id" => "items_count4",
							"std" => "12",
							"class" => "small",
							"type" => "text");
		
		
		$options[] = array( "name" => theme_locals("footer"),
							"type" => "heading");
		
		$options['footer_text'] = array( "name" => theme_locals("copyright_text_name"),
							"desc" => theme_locals("copyright_text_desc"),
							"id" => "footer_text",
							"std" => "",
							"type" => "textarea");
		
		$options[] = array( "name" => theme_locals("google_name"),
							"desc" => theme_locals("google_desc"),
							"id" => "ga_code",
							"std" => "",
							"type" => "textarea");
		
		$options['feed_url'] = array( "name" => theme_locals("feedburner_name"),
							"desc" => theme_locals("feedburner_desc"),
							"id" => "feed_url",
							"std" => "",
							"type" => "text");
		
		$options['footer_menu'] = array( "name" => theme_locals("footer_menu_name"),
							"desc" => theme_locals("footer_menu_desc"),
							"id" => "footer_menu",
							"std" => "true",
							"type" => "radio",
							"options" => $footer_menu_array);

		$options[] = array( 'name' => theme_locals("footer_menu_typography_name"),
							'desc' => theme_locals("footer_menu_typography_desc"),
							'id' => 'footer_menu_typography',
							'std' => array( 'size' => '12px', 'lineheight' => '22px', 'face' => 'PT Serif', 'style' => 'italic', 'character'  => 'latin', 'color' => '#ffffff'),
							'type' => 'typography',
							'options' => array(
									'faces' => $typography_mixed_fonts )
							);
		
		return $options;
	}
	
}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');


if(!function_exists('optionsframework_custom_scripts')) {

	function optionsframework_custom_scripts() { ?>

		<script type="text/javascript">
		jQuery(document).ready(function($) {

			$('#example_showhidden').click(function() {
					$('#section-example_text_hidden').fadeToggle(400);
			});
			
			if ($('#example_showhidden:checked').val() !== undefined) {
				$('#section-example_text_hidden').show();
			}
			
		});
		</script>

		<?php
		}

}



/**
* Front End Customizer
*
* WordPress 3.4 Required
*/
add_action( 'customize_register', 'cherry_register' );

if(!function_exists('cherry_register')) {

	function cherry_register($wp_customize) {
		/**
		 * This is optional, but if you want to reuse some of the defaults
		 * or values you already have built in the options panel, you
		 * can load them into $options for easy reference
		 */
		$options = optionsframework_options();
		
		
		
		/*-----------------------------------------------------------------------------------*/
		/*	General
		/*-----------------------------------------------------------------------------------*/
		$wp_customize->add_section( 'cherry_header', array(
			'title' => theme_locals('general'),
			'priority' => 200
		));
		
		/* Background Image*/
		$wp_customize->add_setting( 'cherry[body_background][image]', array(
			'default' => $options['body_background']['std']['image'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'body_background_image', array(
			'label'   => theme_locals('background_image'),
			'section' => 'cherry_header',
			'settings'   => 'cherry[body_background][image]'
		) ) );
		
		
		/* Background Color*/
		$wp_customize->add_setting( 'cherry[body_background][color]', array(
			'default' => $options['body_background']['std']['color'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_background', array(
			'label'   => theme_locals('background_color'),
			'section' => 'cherry_header',
			'settings'   => 'cherry[body_background][color]'
		) ) );
		
		/* Header Color */
		$wp_customize->add_setting( 'cherry[header_color]', array(
			'default' => $options['header_color']['std'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
			'label'   => $options['header_color']['name'],
			'section' => 'cherry_header',
			'settings'   => 'cherry[header_color]'
		) ) );
		
		
		/* Body Font Face */
		$wp_customize->add_setting( 'cherry[google_mixed_3][face]', array(
			'default' => $options['google_mixed_3']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'cherry_google_mixed_3', array(
				'label' => $options['google_mixed_3']['name'],
				'section' => 'cherry_header',
				'settings' => 'cherry[google_mixed_3][face]',
				'type' => 'select',
				'choices' => $options['google_mixed_3']['options']['faces']
		) );
		
		
		/* Buttons and Links Color */
		$wp_customize->add_setting( 'cherry[links_color]', array(
			'default' => $options['links_color']['std'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'links_color', array(
			'label'   => $options['links_color']['name'],
			'section' => 'cherry_header',
			'settings'   => 'cherry[links_color]'
		) ) );
		
		/* H1 Heading font face */
		$wp_customize->add_setting( 'cherry[h1_heading][face]', array(
			'default' => $options['h1_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'cherry_h1_heading', array(
				'label' => $options['h1_heading']['name'],
				'section' => 'cherry_header',
				'settings' => 'cherry[h1_heading][face]',
				'type' => 'select',
				'choices' => $options['h1_heading']['options']['faces']
		) );
		
		/* H2 Heading font face */
		$wp_customize->add_setting( 'cherry[h2_heading][face]', array(
			'default' => $options['h2_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'cherry_h2_heading', array(
				'label' => $options['h2_heading']['name'],
				'section' => 'cherry_header',
				'settings' => 'cherry[h2_heading][face]',
				'type' => 'select',
				'choices' => $options['h2_heading']['options']['faces']
		) );

		/* H3 Heading font face */
		$wp_customize->add_setting( 'cherry[h3_heading][face]', array(
			'default' => $options['h3_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'cherry_h3_heading', array(
				'label' => $options['h3_heading']['name'],
				'section' => 'cherry_header',
				'settings' => 'cherry[h3_heading][face]',
				'type' => 'select',
				'choices' => $options['h3_heading']['options']['faces']
		) );

		/* H4 Heading font face */
		$wp_customize->add_setting( 'cherry[h4_heading][face]', array(
			'default' => $options['h4_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'cherry_h4_heading', array(
				'label' => $options['h4_heading']['name'],
				'section' => 'cherry_header',
				'settings' => 'cherry[h4_heading][face]',
				'type' => 'select',
				'choices' => $options['h4_heading']['options']['faces']
		) );

		/* H5 Heading font face */
		$wp_customize->add_setting( 'cherry[h5_heading][face]', array(
			'default' => $options['h5_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'cherry_h5_heading', array(
				'label' => $options['h5_heading']['name'],
				'section' => 'cherry_header',
				'settings' => 'cherry[h5_heading][face]',
				'type' => 'select',
				'choices' => $options['h5_heading']['options']['faces']
		) );
		
		/* H6 Heading font face */
		$wp_customize->add_setting( 'cherry[h6_heading][face]', array(
			'default' => $options['h6_heading']['std']['face'],
			'type' => 'option'
		) );
		
		$wp_customize->add_control( 'cherry_h6_heading', array(
				'label' => $options['h6_heading']['name'],
				'section' => 'cherry_header',
				'settings' => 'cherry[h6_heading][face]',
				'type' => 'select',
				'choices' => $options['h6_heading']['options']['faces']
		) );
		
		
		/* Search Box*/
		$wp_customize->add_setting( 'cherry[g_search_box_id]', array(
				'default' => $options['g_search_box_id']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_g_search_box_id', array(
				'label' => $options['g_search_box_id']['name'],
				'section' => 'cherry_header',
				'settings' => 'cherry[g_search_box_id]',
				'type' => $options['g_search_box_id']['type'],
				'choices' => $options['g_search_box_id']['options']
		) );
		
		
		/*-----------------------------------------------------------------------------------*/
		/*	Logo
		/*-----------------------------------------------------------------------------------*/
		
		$wp_customize->add_section( 'cherry_logo', array(
			'title' => theme_locals('logo'),
			'priority' => 201
		) );
		
		/* Logo Type */
		$wp_customize->add_setting( 'cherry[logo_type]', array(
				'default' => $options['logo_type']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_logo_type', array(
				'label' => $options['logo_type']['name'],
				'section' => 'cherry_logo',
				'settings' => 'cherry[logo_type]',
				'type' => $options['logo_type']['type'],
				'choices' => $options['logo_type']['options']
		) );
		
		/* Logo Path */
		$wp_customize->add_setting( 'cherry[logo_url]', array(
			'type' => 'option'
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_url', array(
			'label' => $options['logo_url']['name'],
			'section' => 'cherry_logo',
			'settings' => 'cherry[logo_url]'
		) ) );
		
		
		
		/*-----------------------------------------------------------------------------------*/
		/*  Slider
		/*-----------------------------------------------------------------------------------*/
		 
		$wp_customize->add_section( 'cherry_slider', array(
			'title' => theme_locals('slider_name'),
			'priority' => 202
		) );
		 
		/* Slider Effect */
		$wp_customize->add_setting( 'cherry[sl_effect]', array(
				'default' => $options['sl_effect']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_sl_effect', array(
				'label' => $options['sl_effect']['name'],
				'section' => 'cherry_slider',
				'settings' => 'cherry[sl_effect]',
				'type' => $options['sl_effect']['type'],
				'choices' => $options['sl_effect']['options']
		) );
		 
		/* Pause time */
		$wp_customize->add_setting( 'cherry[sl_pausetime]', array(
				'default' => $options['sl_pausetime']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_sl_pausetime', array(
				'label' => $options['sl_pausetime']['name'],
				'section' => 'cherry_slider',
				'settings' => 'cherry[sl_pausetime]',
				'type' => $options['sl_pausetime']['type']
		) );
		 
		/* Animation speed */
		$wp_customize->add_setting( 'cherry[sl_animation_speed]', array(
				'default' => $options['sl_animation_speed']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_sl_animation_speed', array(
				'label' => $options['sl_animation_speed']['name'],
				'section' => 'cherry_slider',
				'settings' => 'cherry[sl_animation_speed]',
				'type' => $options['sl_animation_speed']['type']
		) );
		 
		/* Auto slideshow */
		$wp_customize->add_setting( 'cherry[sl_slideshow]', array(
				'default' => $options['sl_slideshow']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_sl_slideshow', array(
				'label' => $options['sl_slideshow']['name'],
				'section' => 'cherry_slider',
				'settings' => 'cherry[sl_slideshow]',
				'type' => $options['sl_slideshow']['type'],
				'choices' => $options['sl_slideshow']['options']
		) );
		 
		/* Slide thumbnails */
		$wp_customize->add_setting( 'cherry[sl_thumbnails]', array(
				'default' => $options['sl_thumbnails']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_sl_thumbnails', array(
				'label' => $options['sl_thumbnails']['name'],
				'section' => 'cherry_slider',
				'settings' => 'cherry[sl_thumbnails]',
				'type' => $options['sl_thumbnails']['type'],
				'choices' => $options['sl_thumbnails']['options']
		) );
		 
		/* Show pagination? */
		$wp_customize->add_setting( 'cherry[sl_control_nav]', array(
				'default' => $options['sl_control_nav']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_sl_control_nav', array(
				'label' => $options['sl_control_nav']['name'],
				'section' => 'cherry_slider',
				'settings' => 'cherry[sl_control_nav]',
				'type' => $options['sl_control_nav']['type'],
				'choices' => $options['sl_control_nav']['options']
		) );   
		 
		/* Display next & prev navigation? */
		$wp_customize->add_setting( 'cherry[sl_dir_nav]', array(
				'default' => $options['sl_dir_nav']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_sl_dir_nav', array(
				'label' => $options['sl_dir_nav']['name'],
				'section' => 'cherry_slider',
				'settings' => 'cherry[sl_dir_nav]',
				'type' => $options['sl_dir_nav']['type'],
				'choices' => $options['sl_dir_nav']['options']
		) );
		 
		/* Play/Pause button */
		$wp_customize->add_setting( 'cherry[sl_play_pause_button]', array(
				'default' => $options['sl_play_pause_button']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_sl_play_pause_button', array(
				'label' => $options['sl_play_pause_button']['name'],
				'section' => 'cherry_slider',
				'settings' => 'cherry[sl_play_pause_button]',
				'type' => $options['sl_play_pause_button']['type'],
				'choices' => $options['sl_play_pause_button']['options']
		) );
		

		/* Loader */
		$wp_customize->add_setting( 'cherry[sl_loader]', array(
				'default' => $options['sl_loader']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_sl_loader', array(
				'label' => $options['sl_loader']['name'],
				'section' => 'cherry_slider',
				'settings' => 'cherry[sl_loader]',
				'type' => $options['sl_loader']['type'],
				'choices' => $options['sl_loader']['options']
		) );
		
		
		
		
		/*-----------------------------------------------------------------------------------*/
		/*	Blog
		/*-----------------------------------------------------------------------------------*/
		
		
		$wp_customize->add_section( 'cherry_blog', array(
				'title' => theme_locals('blog'),
				'priority' => 203
		) );
		
		/* Blog image size */
		$wp_customize->add_setting( 'cherry[post_image_size]', array(
				'default' => $options['post_image_size']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_post_image_size', array(
				'label' => $options['post_image_size']['name'],
				'section' => 'cherry_blog',
				'settings' => 'cherry[post_image_size]',
				'type' => $options['post_image_size']['type'],
				'choices' => $options['post_image_size']['options']
		) );
		
		/* Single post image size */
		$wp_customize->add_setting( 'cherry[single_image_size]', array(
				'default' => $options['single_image_size']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_single_image_size', array(
				'label' => $options['single_image_size']['name'],
				'section' => 'cherry_blog',
				'settings' => 'cherry[single_image_size]',
				'type' => $options['single_image_size']['type'],
				'choices' => $options['single_image_size']['options']
		) );
		
		/* Post Meta */
		$wp_customize->add_setting( 'cherry[post_meta]', array(
				'default' => $options['post_meta']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_post_meta', array(
				'label' => $options['post_meta']['name'],
				'section' => 'cherry_blog',
				'settings' => 'cherry[post_meta]',
				'type' => $options['post_meta']['type'],
				'choices' => $options['post_meta']['options']
		) );
		
		/* Post Excerpt */
		$wp_customize->add_setting( 'cherry[post_excerpt]', array(
				'default' => $options['post_excerpt']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_post_excerpt', array(
				'label' => $options['post_excerpt']['name'],
				'section' => 'cherry_blog',
				'settings' => 'cherry[post_excerpt]',
				'type' => $options['post_excerpt']['type'],
				'choices' => $options['post_excerpt']['options']
		) );
		
		
		
		/*-----------------------------------------------------------------------------------*/
		/*	Footer
		/*-----------------------------------------------------------------------------------*/
		
		$wp_customize->add_section( 'cherry_footer', array(
			'title' => theme_locals('footer'),
			'priority' => 204
		) );
			
		/* Footer Copyright Text */
		$wp_customize->add_setting( 'cherry[footer_text]', array(
				'default' => $options['footer_text']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_footer_text', array(
				'label' => $options['footer_text']['name'],
				'section' => 'cherry_footer',
				'settings' => 'cherry[footer_text]',
				'type' => 'text'
		) );
		
		
		/* Display Footer Menu */
		$wp_customize->add_setting( 'cherry[footer_menu]', array(
				'default' => $options['footer_menu']['std'],
				'type' => 'option'
		) );
		$wp_customize->add_control( 'cherry_footer_menu', array(
				'label' => $options['footer_menu']['name'],
				'section' => 'cherry_footer',
				'settings' => 'cherry[footer_menu]',
				'type' => $options['footer_menu']['type'],
				'choices' => $options['footer_menu']['options']
		) );
		

		
	};

}