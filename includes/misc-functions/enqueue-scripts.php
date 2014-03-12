<?php

 
function mp_video_skinner_footer_scripts(){
	
	//Video ID
	$video_id = isset($_GET['video_id']) ? $_GET['video_id'] : NULL;
				
	//If a Youtube URL has been entered by the user
	if (!empty($video_id)){
		
		//Youtube JS
		wp_enqueue_script( 'mp_video_skinner_youtube_js', plugins_url( 'js/youtube-scripts/youtube.js', dirname(__FILE__) ), array( 'jquery' ) );
		wp_localize_script( 'mp_video_skinner_youtube_js', 'mp_video_skinner_vars', array(
			'video_id' => $video_id,
			'autoplay' => apply_filters( 'mp_video_skinner_youtube_autoplay', true )
		));	
		
		//Youtube Player Skinner CSS
		wp_enqueue_style( 'mp_video_skinner_css', plugins_url( 'css/mp-video-skinner.css', dirname(__FILE__) ) );	
		
		}
		
		do_action( 'mp_video_skinner_skins_enqueue' );
			
}
add_action( 'wp_enqueue_scripts', 'mp_video_skinner_footer_scripts', 10 );