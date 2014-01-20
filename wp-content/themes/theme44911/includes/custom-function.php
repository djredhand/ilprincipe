<?php
	@define( 'CURRENT_THEME', 'theme44911');

	// Loading child theme textdomain
	load_child_theme_textdomain( CURRENT_THEME, get_stylesheet_directory() . '/languages' );

	// WP Pointers
	add_action('admin_enqueue_scripts', 'myHelpPointers');
	function myHelpPointers() {
	//First we define our pointers 
	$pointers = array(
	   	array(
	       'id' => 'xyz1',   // unique id for this pointer
	       'screen' => 'options-permalink', // this is the page hook we want our pointer to show on
	       'target' => '#submit', // the css selector for the pointer to be tied to, best to use ID's
	       'title' => theme_locals("submit_permalink"),
	       'content' => theme_locals("submit_permalink_desc"),
	       'position' => array( 
	                          'edge' => 'top', //top, bottom, left, right
	                          'align' => 'left', //top, bottom, left, right, middle
	                          'offset' => '0 5'
	                          )
	       ),

	    array(
	       'id' => 'xyz2',   // unique id for this pointer
	       'screen' => 'themes', // this is the page hook we want our pointer to show on
	       'target' => '#toplevel_page_options-framework', // the css selector for the pointer to be tied to, best to use ID's
	       'title' => theme_locals("import_sample_data"),
	       'content' => theme_locals("import_sample_data_desc"),
	       'position' => array( 
	                          'edge' => 'bottom', //top, bottom, left, right
	                          'align' => 'top', //top, bottom, left, right, middle
	                          'offset' => '0 -10'
	                          )
	       ),

	    array(
	       'id' => 'xyz3',   // unique id for this pointer
	       'screen' => 'toplevel_page_options-framework', // this is the page hook we want our pointer to show on
	       'target' => '#toplevel_page_options-framework', // the css selector for the pointer to be tied to, best to use ID's
	       'title' => theme_locals("import_sample_data"),
	       'content' => theme_locals("import_sample_data_desc_2"),
	       'position' => array( 
	                          'edge' => 'left', //top, bottom, left, right
	                          'align' => 'top', //top, bottom, left, right, middle
	                          'offset' => '0 18'
	                          )
	       )
	    // more as needed
	    );
		//Now we instantiate the class and pass our pointer array to the constructor 
		$myPointers = new WP_Help_Pointer($pointers); 
	};



	// Post Cycle Shortcode ====================================== //
	function shortcode_post_cycle($atts, $content = null) {
		extract(shortcode_atts(array(
				'num' => '5',
				'type' => '',
				'meta' => '',
				'effect' => 'slide',
				'thumb' => 'true',
				'thumb_width' => '200',
				'thumb_height' => '180',
				'more_text_single' => theme_locals('read_more'),
				'category' => '',
				'custom_category' => '',				
				'excerpt_count' => '15',
				'pagination' => 'true',
				'navigation' => 'true',
				'custom_class' => ''
		), $atts));
		
		$type_post=$type;
		
		$slider_pagination=$pagination;
		
		$slider_navigation=$navigation;
		
		$random = gener_random(10);		

		$output .= '<script type="text/javascript">
						$(window).load(function() {
							$("#flexslider_'.$random.'").flexslider({
								animation: "'.$effect.'",
								smoothHeight : true,
								directionNav: '.$slider_navigation.',
								controlNav: '.$slider_pagination.'
							});
						});';
		$output .= '</script>';
		$output .= '<div id="flexslider_'.$random.'" class="flexslider no-bg '.$custom_class.'">';
			$output .= '<ul class="slides post-cycle__testi">';
			
			global $post;
			global $my_string_limit_words;
			
			$args = array(
				'post_type' => $type_post,
				'category_name' => $category,
				$type_post . '_category' => $custom_category,
				'numberposts' => $num,
				'orderby' => 'post_date',
				'order' => 'DESC'
			);

			$latest = get_posts($args);
			
			foreach($latest as $post) {
				setup_postdata($post);
				$excerpt = get_the_excerpt();
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
				$url = $attachment_url['0'];
				$image = aq_resize($url, $thumb_width, $thumb_height, true);				

				$output .= '<li class="post-cycle-item">';				
					
					if ($thumb == 'true') {

						if ( has_post_thumbnail($post->ID) ){
							$output .= '<figure class="thumbnail featured-thumbnail"><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
							$output .= '<img  src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
							$output .= '</a></figure>';
						}  else {							

							$thumbid = 0;
							$thumbid = get_post_thumbnail_id($post->ID);
											
							$images = get_children( array(
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'post_type' => 'attachment',
								'post_parent' => $post->ID,
								'post_mime_type' => 'image',
								'post_status' => null,
								'numberposts' => -1
							) ); 

							if ( $images ) {

								$k = 0;
								//looping through the images
								foreach ( $images as $attachment_id => $attachment ) {
									$prettyType = "prettyPhoto[gallery".$i."]";								
									//if( $attachment->ID == $thumbid ) continue;

									$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' ); // returns an array
									$img = aq_resize( $image_attributes[0], $thumb_width, $thumb_height, true ); //resize & crop img
									$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
									$image_title = $attachment->post_title;

									if ( $k == 0 ) {
										$output .= '<figure class="featured-thumbnail">';
										$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
										$output .= '<img  src="'.$img.'" alt="'.get_the_title($post->ID).'" />';
										$output .= '</a></figure>';
									} break;
									$k++;
								}					
							}
						}
					}
					
					if($type_post != 'testi') {
						$output .= '<h5><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
						$output .= get_the_title($post->ID);
						$output .= '</a></h5>';
					}
					
					$custom = get_post_custom($post->ID);

					
					if($meta == 'true' && $type_post != 'testi'){
						$output .= '<span class="meta">';
						$output .= '<span class="post-date">';
						$output .= get_the_time( get_option( 'date_format' ) );
						$output .= '</span>';
						$output .= '<span class="post-comments">'.theme_locals('comments').": ";
						$output .= '<a href="'.get_comments_link($post->ID).'">';
						$output .= get_comments_number($post->ID);
						$output .= '</a>';
						$output .= '</span>';
						$output .= '</span>';
					}

					//display excerpt only for testimonial
					if($type_post == 'testi'){
						$output .= '<div class="row">';
							$output .= '<div class="offset2 span8">';
								$output .= '<div class="excerpt excerpt__testi">';
								$output .= get_the_content();
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
					}

					//display post options
					if($type_post == 'testi'){
					$output .= '<div class="row">';
						$output .= '<div class="offset2 span8">';
					}

							$output .= '<div class="post_options">';
							switch($type_post) {
							    case "team":
							    	$teampos = ($custom["my_team_pos"][0])?$custom["my_team_pos"][0]:"";
							    	$teaminfo = ($custom["my_team_info"][0])?$custom["my_team_info"][0]:"";
							        $output .= "<span class='page-desc'>".$teampos."</span><br><span class='team-content post-content'>".$teaminfo."</span>";
							        break;
							    case "testi":
							    	$testiname = $custom["my_testi_caption"][0]?$custom["my_testi_caption"][0]:"";
									$testiinfo = $custom["my_testi_info"][0]?$custom["my_testi_info"][0]:"";
							        $output .="<span class='user'>".$testiname."</span><span class='info'>".$testiinfo."</span>";
							        break;
							    case "portfolio":
						    		$portfolioClient = $custom["tz_portfolio_client"][0]?$custom["tz_portfolio_client"][0]:"";
									$portfolioDate = $custom["tz_portfolio_date"][0]?$custom["tz_portfolio_date"][0]:"";
									$portfolioInfo = $custom["tz_portfolio_info"][0]?$custom["tz_portfolio_info"][0]:"";
									$portfolioURL = $custom["tz_portfolio_url"][0]?$custom["tz_portfolio_url"][0]:"";
							        $output .="<strong class='portfolio-meta-key'>".theme_locals('client').": </strong><span> ".$portfolioClient."</span><br>";
							       	$output .="<strong class='portfolio-meta-key'>".theme_locals('date').": </strong><span> ".$portfolioDate."</span><br>";
							       	$output .="<strong class='portfolio-meta-key'>".theme_locals('info').": </strong><span> ".$portfolioInfo."</span><br>";
							       	$output .="<a href='".$portfolioURL."'>".theme_locals('launch_project')."</a><br>";
								    break;
			        			default:
			        				$output .="";
							};
							$output .= '</div>';

					if($type_post == 'testi'){
						$output .= '</div>';
					$output .= '</div>';
					}
					
					if($excerpt_count >= 1 && $type_post != 'testi'){
						$output .= '<p class="excerpt">';
						$output .= my_string_limit_words($excerpt,$excerpt_count);
						$output .= '</p>';
					}
					
					if($more_text_single!="" && $type_post!="testi"){
						$output .= '<a href="'.get_permalink($post->ID).'" class="btn btn-primary" title="'.get_the_title($post->ID).'">';
						$output .= $more_text_single;
						$output .= '</a>';
					}
					
				$output .= '</li>';
			}
			$output .= '</ul>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('post_cycle', 'shortcode_post_cycle');




	// Post Grid ====================================== //
	function posts_grid_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			'type' => '',
			'columns' => '3',
			'rows' => '3',
			'order_by' => 'date',
			'order' => 'DESC',
			'thumb_width' => '370',
			'thumb_height' => '250',
			'meta' => '',
			'excerpt_count' => '15',
			'link' => 'yes',
			'link_text' => theme_locals('read_more'),
			'custom_class' => ''
		), $atts));


		$spans = $columns;

		// columns
		switch ($spans) {
			case '1':
				$spans = 'span12';
				break;
			case '2':
				$spans = 'span6';
				break;
			case '3':
				$spans = 'span4';
				break;
			case '4':
				$spans = 'span3';
				break;
			case '6':
				$spans = 'span2';
				break;
		}

		// check what order by method user selected
		switch ($order_by) {
			case 'date':
				$order_by = 'post_date';
				break;
			case 'title':
				$order_by = 'title';
				break;
			case 'popular':
				$order_by = 'comment_count';
				break;
			case 'random':
				$order_by = 'rand';
				break;
		}

		// check what order method user selected (DESC or ASC)
		switch ($order) {
			case 'DESC':
				$order = 'DESC';
				break;
			case 'ASC':
				$order = 'ASC';
				break;
		}

		// show link after posts?
		switch ($link) {
			case 'yes':
				$link = true;
				break;
			case 'no':
				$link = false;
				break;
		}

			global $post;
			global $my_string_limit_words;

			$numb = $columns * $rows;
							
			$args = array(
				'post_type' => $type,
				'numberposts' => $numb,
				'orderby' => $order_by,
				'order' => $order
			);		

			$posts = get_posts($args);
			$i = 0;
			$count = 1;
			$output_end = '';
			if ($numb > count($posts)) {
				$output_end = '</ul>';
			}

			$output = '<ul class="posts-grid row-fluid unstyled '. $custom_class .'">';

			for ( $j=0; $j < count($posts); $j++ ) {
				$post_id = $posts[$j]->ID;
				setup_postdata($posts[$j]);
				$excerpt = get_the_excerpt();
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
				$url = $attachment_url['0'];
				$image = aq_resize($url, $thumb_width, $thumb_height, true);
				$mediaType = get_post_meta($post_id, 'tz_portfolio_type', true);
				$prettyType = 0;

					if ($count > $columns) {
						$count = 1;
						$output .= '<ul class="posts-grid row-fluid unstyled '. $custom_class .'">';
					}

					$output .= '<li class="'. $spans .'">';
						if(has_post_thumbnail($post_id) && $mediaType == 'Image') {
												
							$prettyType = 'prettyPhoto';									

							$output .= '<figure class="featured-thumbnail thumbnail">';
							$output .= '<a href="'.$url.'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
							$output .= '<img  src="'.$image.'" alt="'.get_the_title($post_id).'" />';
							$output .= '<span class="zoom-icon"></span></a></figure>';
						} elseif ($mediaType != 'Video' && $mediaType != 'Audio') {					

							$thumbid = 0;
							$thumbid = get_post_thumbnail_id($post_id);
											
							$images = get_children( array(
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'post_type' => 'attachment',
								'post_parent' => $post_id,
								'post_mime_type' => 'image',
								'post_status' => null,
								'numberposts' => -1
							) ); 

							if ( $images ) {

								$k = 0;
								//looping through the images
								foreach ( $images as $attachment_id => $attachment ) {
									$prettyType = "prettyPhoto[gallery".$i."]";								
									//if( $attachment->ID == $thumbid ) continue;

									$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' ); // returns an array
									$img = aq_resize( $image_attributes[0], $thumb_width, $thumb_height, true ); //resize & crop img
									$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
									$image_title = $attachment->post_title;

									if ( $k == 0 ) {
										if (has_post_thumbnail($post_id)) {
											$output .= '<figure class="featured-thumbnail thumbnail">';
											$output .= '<a href="'.$image_attributes[0].'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
											$output .= '<img src="'.$image.'" alt="'.get_the_title($post_id).'" />';
										} else {
											$output .= '<figure class="featured-thumbnail thumbnail">';
											$output .= '<a href="'.$image_attributes[0].'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
											$output .= '<img  src="'.$img.'" alt="'.get_the_title($post_id).'" />';
										}
									} else {
										$output .= '<figure class="featured-thumbnail thumbnail" style="display:none;">';
										$output .= '<a href="'.$image_attributes[0].'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
										$output .= '<img  src="'.$img.'" alt="'.get_the_title($post_id).'" />';
									}
									$output .= '<span class="zoom-icon"></span></a></figure>';
									$k++;
								}					
							} elseif (has_post_thumbnail($post_id)) {
								$prettyType = 'prettyPhoto';
								$output .= '<figure class="featured-thumbnail thumbnail">';
								$output .= '<a href="'.$url.'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
								$output .= '<img  src="'.$image.'" alt="'.get_the_title($post_id).'" />';
								$output .= '<span class="zoom-icon"></span></a></figure>';
							}
						} else {

							// for Video and Audio post format - no lightbox
							$output .= '<figure class="featured-thumbnail thumbnail"><a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
							$output .= '<img  src="'.$image.'" alt="'.get_the_title($post_id).'" />';
							$output .= '</a></figure>';
						}

						$output .= '<div class="clear"></div>';


						$output .= '<div class="post-grid-holder">';
						$output .= '<h5><a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
							$output .= get_the_title($post_id);
						$output .= '</a></h5>';

						if ($meta == 'yes') {
							// begin post meta
							$output .= '<div class="post_meta">';

								// post category
								$output .= '<span class="post_category">';
								if ($type!='' && $type!='post') {
									$terms = get_the_terms( $post_id, $type.'_category');
									if ( $terms && ! is_wp_error( $terms ) ) {
										$out = array();
										$output .= '<em>Posted in </em>';
										foreach ( $terms as $term )
											$out[] = '<a href="' .get_term_link($term->slug, $type.'_category') .'">'.$term->name.'</a>';
											$output .= join( ' / &nbsp;', $out );
									}
								} else {
									$categories = get_the_category();
									if($categories){
										$out = array();
										$output .= '<em>Posted in </em>';
										foreach($categories as $category)
											$out[] = '<a href="'.get_category_link($category->term_id ).'" title="'.$category->name.'">'.$category->cat_name.'</a> ';
											$output .= join( ', ', $out );
									}
								}
								$output .= '</span>';

								// post date
								$output .= '<span class="post_date">';
								$output .= '<time datetime="'.get_the_time('Y-m-d\TH:i:s', $post_id).'">' .get_the_time( get_option( 'date_format' ), $post_id ). '</time>';
								$output .= '</span>';

								// post author
								$output .= '<span class="post_author">';
								$output .= '<em>by </em>';
								$output .= '<a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta('display_name').'</a>';
								$output .= '</span>';

								// post comment count
								$num = 0;						
								$queried_post = get_post($post_id);
								$cc = $queried_post->comment_count;
								if( $cc == $num || $cc > 1 ) : $cc = $cc.' Comments';
								else : $cc = $cc.' Comment';
								endif;
								$permalink = get_permalink($post_id);
								$output .= '<span class="post_comment">';
								$output .= '<a href="'. $permalink . '" class="comments_link">' . $cc . '</a>';
								$output .= '</span>';

							$output .= '</div>';
							// end post meta

							$output .= '</div>';
							// end post holder

						}

						if($excerpt_count >= 1){
							$output .= '<p class="excerpt">';
								$output .= my_string_limit_words($excerpt,$excerpt_count);
							$output .= '</p>';
						}
						if($link){
							$output .= '<a href="'.get_permalink($post_id).'" class="btn btn-primary" title="'.get_the_title($post_id).'">';
							$output .= $link_text;
							$output .= '</a>';
						}
						$output .= '</li>';
						if ($j == count($posts)-1) {
							$output .= $output_end;
						}
					if ($count % $columns == 0) {
						$output .= '</ul><!-- .posts-grid (end) -->';
					}
				$count++;
				$i++;		

			} // end for
			
			return $output;
	}	 
	add_shortcode('posts_grid', 'posts_grid_shortcode');




	// Service Box ====================================== //
	function service_box_shortcode($atts, $content = null) { 
	    extract(shortcode_atts(
	        array(
				'title' => '',
				'subtitle' => '',
				'icon' => '',
				'text' => '',
				'btn_text' => theme_locals('read_more'),
				'btn_link' => '',
				'btn_size' => '',
				'target' => '',
				'custom_class' => ''
	    ), $atts));
		
		$template_url = get_stylesheet_directory_uri();
	 
		$output =  '<div class="service-box '.$custom_class.'">';
		
		// check what icon user selected
		switch ($icon) {
			case 'no':
				break;
	       	case 'icon1':
				$output .= '<figure class="icon"><i class="icon-magic"></i></figure>';
				break;
	       	case 'icon2':
				$output .= '<figure class="icon"><i class="icon-book"></i></figure>';
				break;
			case 'icon3':
				$output .= '<figure class="icon"><i class="icon-adjust"></i></figure>';
				break;
			case 'icon4':
				$output .= '<figure class="icon"><i class="icon-camera"></i></figure>';
				break;
			case 'icon5':
				$output .= '<figure class="icon"><i class="icon-food"></i></figure>';
				break;
			case 'icon6':
				$output .= '<figure class="icon"><i class="icon-group"></i></figure>';
				break;
			case 'icon7':
				$output .= '<figure class="icon"><i class="icon-globe"></i></figure>';
				break;
			case 'icon8':
				$output .= '<figure class="icon"><i class="icon-facetime-video"></i></figure>';
				break;
			case 'icon9':
				$output .= '<figure class="icon"><i class="icon-ok"></i></figure>';
				break;
			case 'icon10':
				$output .= '<figure class="icon"><i class="icon-home"></i></figure>';
				break;
	    }

	   $output .= '<div class="service-box_body">';
	 
		if ($title!="") {
			$output .= '<h2 class="title">';
			$output .= $title;
			$output .= '</h2>';
		}	 
		if ($subtitle!="") {
			$output .= '<h5 class="sub-title">';
			$output .= $subtitle;
			$output .= '</h5>';
		}		
		if ($text!="") {
			$output .= '<div class="service-box_txt">';
			$output .= $text;
			$output .= '</div>';
		}		
		if ($btn_link!="") {	
			$output .=  '<div class="btn-align"><a href="'.$btn_link.'" title="'.$btn_text.'" class="btn btn-inverse btn-'.$btn_size.' btn-primary " target="'.$target.'">';
			$output .= $btn_text;
			$output .= '</a></div>';
		}
		$output .= '</div>';	 
		$output .= '</div><!-- /Service Box -->';	 
	    return $output;	 
	} 
	add_shortcode('service_box', 'service_box_shortcode');

?>