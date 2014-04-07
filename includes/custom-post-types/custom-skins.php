<?php
/**
 * This page contains functions that create the mpvsyt-custom-skins custom post type
 *
 * @link http://moveplugins.com/doc/
 * @since 1.0.0.0
 *
 * @package    MP Video Skinner
 * @subpackage Functions
 *
 * @copyright   Copyright (c) 2014, Move Plugins
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author      Philip Johnston
 */

/**
 * Custom Skins Custom Post Type
 *
 * @since    1.0.0
 * @link     http://moveplugins.com/doc/
 * @see      mp_core_get_option()
 * @see      register_post_type()
 * @param  	 void
 * @return   void
 */
function mpvsyt_post_type() {
	
	$mpvsyt_labels =  apply_filters( 'mpvsyt_labels', array(
		'name' 				=> 'Custom YouTube Skins',
		'singular_name' 	=> 'Custom YouTube Skin',
		'add_new' 			=> __('New Custom YouTube Skin', 'mp_stacks'),
		'add_new_item' 		=> __('New Custom YouTube Skin', 'mp_stacks'),
		'edit_item' 		=> __('Edit Custom YouTube Skin', 'mp_stacks'),
		'new_item' 			=> __('New Custom YouTube Skin', 'mp_stacks'),
		'all_items' 		=> __('Manage Custom YouTube Skins', 'mp_stacks'),
		'view_item' 		=> __('View Custom YouTube Skins', 'mp_stacks'),
		'search_items' 		=> __('Search Custom YouTube Skins', 'mp_stacks'),
		'not_found' 		=>  __('No Custom YouTube Skins found', 'mp_stacks'),
		'not_found_in_trash'=> __('No Custom YouTube Skins found in Trash', 'mp_stacks'), 
		'parent_item_colon' => '',
		'menu_name' 		=> __('YouTube Skins', 'mp_stacks')
	) );
		
	$mpvsyt_args = array(
		'labels' 			=> $mpvsyt_labels,
		'public' 			=> false,
		'publicly_queryable'=> false,
		'show_ui' 			=> true, 
		'show_in_menu' 		=> true, 
		'query_var' 		=> true,
		'rewrite' 			=> array( 'slug' => 'mpvsyt' ),
		'capability_type' 	=> 'post',
		'has_archive' 		=> false, 
		'hierarchical' 		=> true,
		'supports' 			=> apply_filters('mpvsyt_custom_skins_supports', array( 'title') ),
	); 
		
	register_post_type( 'mpvsyt_custom_skins', apply_filters( 'mpvsyt_custom_skins_post_type_args', $mpvsyt_args ) );
		
}
add_action( 'init', 'mpvsyt_post_type', 0 );

/**
 * Hide Permalink output on single edit screen
 *
 * @since    1.0.0
 * @link     http://moveplugins.com/doc/
 * @param  	 $return 
 * @param  	 $id 
 * @param  	 $new_title 
 * @param  	 $new_slug 
 * @return   $actions
 */
function mpvsyt_custom_skins_perm($return, $id, $new_title, $new_slug){
	global $post;
	if (isset($post->post_type)){
		if($post->post_type == 'mpvsyt_custom_skins'){
			
			$return = NULL;
			
		}
	}

	return $return;
}
add_filter('get_sample_permalink_html', 'mpvsyt_custom_skins_perm', '',4);