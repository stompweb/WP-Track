<?php

add_action( 'post_updated', 'my_project_updated_send_email' );

function my_project_updated_send_email( $post_id ) {

	$args = array(
		'post_type' => 'wpt_track',
		'post_status' => 'publish',
		'showposts' => -1
	);
					
	$delete_query = new WP_Query( $args ); 

	while ( $delete_query->have_posts() ) : $delete_query->the_post();

		wp_delete_post( get_the_ID() ); 

	endwhile; 
	

	//verify post is not a revision
	if ( !wp_is_post_revision( $post_id ) ) {

		$loop = 1;
		if ($loop == 1) {
			wpt_track_event('save_post', $post_id);
		 	$loop = 2;
		}
		
	}

}

function simple_history_activated_plugin($plugin_name) {
	$plugin_name = urlencode($plugin_name);
	$loop = 1;
		if ($loop == 1) {
			wpt_track_event('poo', $post_id);
		 	$loop = 2;
		}
}


add_action('activated_plugin', 'wpt_activated_plugin'); 							// Activated Plugin
add_action('deactivated_plugin', 'wpt_history_deactivated_plugin');					// Deactived Plugin

add_filter( 'wp_login', 'wpt_login', 10, 3 );										// Successful login
add_filter( 'wp_login_failed', 'wpt_login_failed', 10, 3 );							// Login failure
add_filter( 'wp_logout', 'wpt_logout', 10, 3 );										// Logout
		
add_filter( 'user_register', 'wpt_user_register', 10, 3 );							// User creation
add_filter( 'profile_update', 'wpt_profile_update', 10, 3 );						// Profile update
add_filter( 'wpmu_delete_user', 'wpt_logout', 10, 3 ); 								// User deletion (WPMU)
add_filter( 'delete_user', 'wpt_delete_user', 10, 3 );								// User deletion
		
add_filter( 'retrieve_password', 'wpt_retrieve_password', 10, 3 );					// Send password
add_filter( 'password_reset', 'wpt_reset_password', 10, 3 );						// Change password
		
add_action( 'transition_post_status', 'wpt_publish_post', 10, 3 );					// Post published
add_action( 'post_updated', 'wpt_update_post', 10, 3 );								// Post updated
add_action( 'trashed_post', 'wpt_trashed_post');										// Post binned
add_action( 'untrash_post', 'wpt_restore_post');										// Post restored
add_action( 'deleted_post', 'wpt_delete_post');										// Post deleted


?>