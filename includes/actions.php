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


// Activate plugins
add_action("activated_plugin", "simple_history_activated_plugin");
// Dectivate plugins
add_action("deactivated_plugin", "simple_history_deactivated_plugin");

add_filter( 'wp_login', array(&$this, 'wp_login'), 10, 3 );							// Successful logins
add_filter( 'wp_login_failed', array(&$this, 'wp_login_failed'), 10, 3 );			// Login failures
add_filter( 'wp_logout', array(&$this, 'wp_logout'), 10, 3 );						// Logouts
		
add_filter( 'user_register', array(&$this, 'user_register'), 10, 3 );				// User creation
add_filter( 'profile_update', array(&$this, 'profile_update'), 10, 3 );				// Profile updates
add_filter( 'wpmu_delete_user', array(&$this, 'delete_user'), 10, 3 ); 				// User deletion
add_filter( 'delete_user', array(&$this, 'delete_user'), 10, 3 );					// User deletion
		
add_filter( 'retrieve_password', array(&$this, 'retrieve_password'), 10, 3 );		// Send password
add_filter( 'password_reset', array(&$this, 'password_reset'), 10, 3 );				// Change password
		
// Posts (and pages)
add_action( 'transition_post_status', array(&$this, 'publish_post'), 10, 3 );
add_action( 'post_updated', array(&$this, 'post_updated'), 10, 3 );
add_action( 'trashed_post', array(&$this, 'trashed_post'));
add_action( 'untrash_post', array(&$this, 'untrashed_post'));
add_action( 'deleted_post', array(&$this, 'deleted_post'));


?>