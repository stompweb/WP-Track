<?php

/**
 * Setup Tracking Post Type & the Action Taxonomy
 *
 * Registers the wp_track post type & wpt_action taxonomy.
 *
 * @access      private
 * @since       0.1
 * @return      void
*/

function wpt_track_event($action, $affected) {

	$current_user = wp_get_current_user();
	
	$trackargs = array(
     	'post_title' => $action . time('t-d-m-y'),
     	'post_type' => 'wpt_track',
     	'post_content' => 'Tracking',
     	'post_status' => 'publish',
    	 'post_author' => $current_user->ID
  	);

  	$id = wp_insert_post( $trackargs );
  
  	wp_set_object_terms( $id, 'save_post', 'wpt_action' );		
  	update_post_meta($id, 'wpt_affected', $affected);
  	
}


?>