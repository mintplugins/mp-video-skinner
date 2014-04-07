<?php

/**
 * Styles for site holding embedded iframe
 *
 * @since    1.0.0
 * @link       http://moveplugins.com/doc/
 * @see      function_name()
 * @param  array $args See link for description.
 * @return   void
 */
function mp_video_skinner_site_scripts(){
		
	//MP Video Skinner Site CSS
	wp_enqueue_style( 'mp_video_skinner_site_css', plugins_url( 'css/mp-video-skinner-site.css', dirname(__FILE__) ) );			
			
}
add_action( 'wp_enqueue_scripts', 'mp_video_skinner_site_scripts', 20 );
 
 /**
 * Scripts/styles for embed screen 
 *
 * @since    1.0.0
 * @link       http://moveplugins.com/doc/
 * @see      function_name()
 * @param  array $args See link for description.
 * @return   void
 */
function mp_video_skinner_footer_scripts(){
	
	//Video ID
	$video_id = isset($_GET['video_id']) ? $_GET['video_id'] : NULL;
				
	//If a Youtube URL has been entered by the user
	if (!empty($video_id)){
		
		//Youtube JS
		wp_enqueue_script( 'mp_video_skinner_youtube_js', plugins_url( 'js/youtube-scripts/youtube.js', dirname(__FILE__) ), array( 'jquery' ) );
		wp_localize_script( 'mp_video_skinner_youtube_js', 'mp_video_skinner_vars', array(
			'autoplay' => apply_filters( 'mp_video_skinner_youtube_autoplay', true ),
			'video_id' => $video_id
		));	
		
		//Youtube Player Skinner CSS
		wp_enqueue_style( 'mp_video_skinner_embed_css', plugins_url( 'css/mp-video-skinner-embed.css', dirname(__FILE__) ) );	
		
		}
		
		do_action( 'mp_video_skinner_skins_enqueue' );
			
}
add_action( 'mp_video_skinner_embed_enqueue', 'mp_video_skinner_footer_scripts', 10 );


/**
 * Admin Scripts/Styles
 *
 * @since    1.0.0
 * @link       http://moveplugins.com/doc/
 * @see      function_name()
 * @param  array $args See link for description.
 * @return   void
 */
function mp_video_skinner_admin_scripts(){
		
	//Shortcode Script JS
	wp_enqueue_script( 'mp_video_skinner_admin_js', plugins_url( 'js/shortcode.js', dirname(__FILE__) ), array( 'jquery' ) );	
			
}
add_action( 'admin_enqueue_scripts', 'mp_video_skinner_admin_scripts', 20 );