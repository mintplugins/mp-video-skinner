<?php

/**
 * Show "Insert Shortcode" above posts
 */
function mp_video_skinner_show_insert_shortcode(){
	
	$post_id = isset($_GET['post']) ? $_GET['post'] : NULL;
	
	//Skins array and filter
	$skins = apply_filters('mp_video_skinner_skins', array( "none" => 'None' ));
	
	$args = array(
		'shortcode_id' => 'mp_video_skinner',
		'shortcode_title' => __('Skinned YouTube Video', 'mp_core'),
		'shortcode_description' => __( 'Use the form below to insert the Skinned YouTube Video ', 'mp_core' ),
		'shortcode_options' => array(
			array(
				'option_id' => 'video_url',
				'option_title' => 'Video URL or Embed Code',
				'option_description' => 'Enter the YouTube Video URL or Embed Code',
				'option_type' => 'textarea',
				'option_value' => '',
			),
			array(
				'option_id' => 'skin_slug',
				'option_title' => 'Choose a Skin',
				'option_description' => 'Select the skin to use for this video',
				'option_type' => 'select',
				'option_value' => $skins
			),
			array(
				'option_id' => 'skin_options',
				'option_title' => '',
				'option_description' => '',
				'option_type' => 'basictext',
				'option_value' => ''
			),
		)
	); 
	
	
	//Shortcode args filter
	$args = has_filter('mp_video_skinner_insert_shortcode_args') ? apply_filters('mp_video_skinner_insert_shortcode_args', $args) : $args;
	
	new MP_CORE_Shortcode_Insert($args);	
}
add_action('init', 'mp_video_skinner_show_insert_shortcode');

/**
 * Shortcode which is used to display the HTML content on a post
 */
function mp_video_skinner_display_shortcode( $atts ) {
	
	//shortcode vars passed-in
	$vars =  shortcode_atts( array(
		'video_url' => NULL,
		'skin_slug' => NULL
	), $atts );
	
	//Post id 
	$post_id = get_the_id();
					
	//Show the video with skin in iframe
	return mp_video_skinner($vars['video_url'], $vars['skin_slug']);
	
}
add_shortcode( 'mp_video_skinner', 'mp_video_skinner_display_shortcode' );