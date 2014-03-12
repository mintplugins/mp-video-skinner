<?php
/**
 * This file contains various functions for the MP Video Skinner plugin
 *
 * @since 1.0.0
 *
 * @package    MP Video Skinner
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2014, Move Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */


//Functions which returns the youtube custom player html iframe
function mp_video_skinner( $youtube_video_code, $skin_slug = 'simpleflat' ){
	
		//Get video background image from skin using this filter - defaults to 16x9
		$background_image_sizer = apply_filters( 'mp_video_skinner_placeholder_image', plugins_url( 'assets/images/16x9.gif', dirname( dirname(__FILE__) ) ) );
		
		//Get video background image from skin using this filter - defaults to 16x9
		$bottom_extra = apply_filters( 'mp_video_skinner_bottom_extra', 0 );
		
		$player_output = '<div class="mp-core-oembed-full-width-div" style="display:inline-block; position:relative; width:100%;';
		$player_output .= !empty( $args['min_width'] ) ? ' min-width:' . $args['min_width'] . 'px; margin: 0px auto 0px auto;' : NULL;
		$player_output .= !empty( $args['max_width'] ) ? ' max-width:' . $args['max_width'] . 'px; margin: 0px auto 0px auto;' : NULL;
		$player_output .= '">';
			$player_output .= '<img class="mp-video-skinner-video-placeholder-img mp-video-skinner-' . $skin_slug . '-video-placeholder-img" style="position:relative; display:block; padding:0px; margin-bottom:0px";'; 
			$player_output .= '" width="100%" src="' . $background_image_sizer . '"/>';
			//Iframe youtube embed page
			$player_output .= '<iframe class="mp-video-skinner-video-iframe mp-video-skinner-' . $skin_slug . '-video-iframe" seamless="seamless" scrolling=no" style="position:absolute; width:100%; height:100%; top:0; left:0px;" src="' . add_query_arg( array('mp_video_skinner_youtube_embed' => true, 'video_id' => $youtube_video_code, 'skin' => $skin_slug ), get_bloginfo( 'url' ) ) . '" /></iframe>';
		$player_output .= '</div>';	
		
		return $player_output;
}

/**
 * Embed the Youtube player on a page with nothing else
 */
function mp_video_skinner_youtube_embed_page() {
	
	//Check the url to see if we should make this an "embed" page
	$player_embed = isset($_GET['mp_video_skinner_youtube_embed']) ? $_GET['mp_video_skinner_youtube_embed'] : NULL;
	
	//If we shouldn't make it an embed page
	if ($player_embed != true){
		return;
	}
	
	//Post ID
	$video_id = isset($_GET['video_id']) ? $_GET['video_id'] : NULL;
	
	//Make sure thre's a video value
	if ( empty( $video_id ) ){
		return;	
	}
	
	//TO DO: HERE WE NEED TO SANITIZE VIDEO ID TO MAKE SURE IT ISN"T CODE												
	
	//Create the output for this video
	$video_output = '<div id="mpvsyt-container" class="mpvsyt-container">'; 
			
			//Youtube API is set to replace this id in js above
			$video_output .= '
			
			<div class="mpvsyt-video-container" class="mpvsyt-video-container">
				<iframe id="mpvsyt" type="text/html" src="https://www.youtube.com/embed/' . $video_id . '?enablejsapi=1&controls=0&modestbranding=1&showinfo=0&wmode=transparent&rel=0&autoplay=1" frameborder="0"></iframe>
			</div>';
			
			
			//Video Controls
			$video_output .= '
			<div id="mpvsyt-controls" class="mpvsyt-controls">
				<div class="mpvsyt-control-buttons-container">
					<a class="mpvsyt-play-btn icon-play" href="javascript:void(0);"></a>
					<a class="mpvsyt-pause-btn icon-pause" href="javascript:void(0);"></a>
				</div>
				<div id="mpvsyt-seek-container" class="mpvsyt-seek-container">
					<div class="mpvsyt-seek-area">
						<div class="mpvsyt-loaded-bar"></div>
						<div class="mpvsyt-seek-bar"></div>
					</div>
				</div>
				<div id="mpvsyt-control-volume-container" class="mpvsyt-control-volume-container">
					<div class="mpvsyt-volume-area">
						<div class="mpvsyt-volume-bar"></div>
					</div>
				</div>
				<div id="mpvsyt-control-buttons-container" class="mpvsyt-control-buttons-container">
					<a class="mpvsyt-fullscreen-btn icon-resize-full-alt" href="javascript:void(0);" onclick="mpvsyt_launchFullscreen(document.documentElement);"></a>
				</div>
				
			</div>';
		
	$video_output .= '</div>';
			
	/**
	* Create simple page of our own with nothing but the video
	*/
	?>
	<!DOCTYPE html>
	<html <?php language_attributes(); ?> style="margin:0px!important; overflow-y: hidden;">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="//gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
		
		<?php wp_head(); ?>
		
		<style type="text/css">
		#wpadminbar{
			display:none!important;	
		}
		html, #mp-menu-site-wrap {
			height: 100%;
			overflow-x: hidden;
			position: relative;
		}
		iframe{
			float:left!important;
			width:100%!important;
			height:100%!important;	
		}
		</style>
	</head>
	
	<body style="margin: 0; padding: 0; border: 0; width:100%; height:100%;">
	
		<div id="player" class="full-frame" style="width: 100%; height: 100%; overflow: hidden;">
			
			<?php 
			
			echo $video_output;
			
			?>
			
		</div>
	
	<div style="display:none;">
		<?php wp_footer(); ?>
	</div>
	
	</body>
	</html>
	<?php
	exit;
}
add_action( 'init', 'mp_video_skinner_youtube_embed_page' );