<?php
// =============================== My Social Networks Widget ====================================== //
class My_SocialNetworksWidget extends WP_Widget {

	function My_SocialNetworksWidget() {
		$widget_ops = array('classname' => 'social_networks_widget', 'description' => theme_locals("social_networks_desc"));
		$this->WP_Widget('social_networks', theme_locals("social_networks"), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		
		$networks['Twitter']['link'] = $instance['twitter'];
		$networks['Facebook']['link'] = $instance['facebook'];
		$networks['Google+']['link'] = $instance['google'];
		$networks['Pinterest']['link'] = $instance['pinterest'];
		$networks['Instagram']['link'] = $instance['instagram'];
		$networks['Github']['link'] = $instance['github'];	
		
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
			
			<ul class="social-alt <?php echo $addClass ?> unstyled">
				
			<?php foreach(array("Facebook", "Twitter", "Google+", "Pinterest", "Instagram", "Github") as $network) : ?>
	    		<?php if (!empty($networks[$network]['link'])) : ?>
				<li class="social-alt_li">
					<?php if($network == 'Google+') {
						$network = "google-plus";
					} ?>
					<?php if($network == 'Instagram') {
						$network = "camera-retro";
					} ?>
					<a class="social-alt_link social-alt__<?php echo strtolower($network); ?>" href="<?php echo $networks[$network]['link']; ?>">
						<i class="icon-<?php echo strtolower($network);?>"></i>
					</a>
				</li>
				<?php endif; ?>
			<?php endforeach; ?>
			  
		</ul>
		<!-- END SOCIAL NETWORKS -->
	  
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['twitter'] = $new_instance['twitter'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['google'] = $new_instance['google'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['instagram'] = $new_instance['instagram'];
		$instance['github'] = $new_instance['github'];

		return $instance;
	}

	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'twitter' => '', 'facebook' => '', 'google' => '', 'pinterest' => '', 'instagram' => '', 'github' => '');
		$instance = wp_parse_args( (array) $instance, $defaults );
			
		$twitter = $instance['twitter'];		
		$facebook = $instance['facebook'];
		$google = $instance['google'];		
		$pinterest = $instance['pinterest'];
		$instagram = $instance['instagram'];	
		$github = $instance['github'];
	
		$title = strip_tags($instance['title']);
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php theme_locals("title") ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php echo 'Facebook' ?>:</legend>
		
		<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php echo 'Facebook URL:' ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" /></p>
	</fieldset>	
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php echo 'Twitter' ?>:</legend>	
	<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php echo 'Twitter URL:' ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" /></p>
	</fieldset>
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php echo 'Google+'; ?>:</legend>
		<p>
			<label for="<?php echo $this->get_field_id('google'); ?>"><?php echo 'Google+ URL:'; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" type="text" value="<?php echo esc_attr($google); ?>" /></p>
	</fieldset>	
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php echo 'Pinterest' ?>:</legend>
	<p><label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php echo 'Pinterest URL:' ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" /></p>
	</fieldset>	
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php echo 'Instagram' ?>:</legend>
	<p><label for="<?php echo $this->get_field_id('instagram'); ?>"><?php echo 'Instagram:' ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo esc_attr($instagram); ?>" /></p>
	</fieldset>	
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php echo 'Github' ?>:</legend>
	<p><label for="<?php echo $this->get_field_id('github'); ?>"><?php echo 'Github URL:' ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('github'); ?>" name="<?php echo $this->get_field_name('github'); ?>" type="text" value="<?php echo esc_attr($github); ?>" /></p>
		</fieldset>

<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("My_SocialNetworksWidget");'));
?>