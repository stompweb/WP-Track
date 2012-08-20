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

function wpt_setup_post_types() {

	register_post_type("wpt_track",
           array(
                   "labels" => array(
                   "name" => "Tracking",
                 ),
                 "public" => true,
                 "has_archive" => true,
                 "capability_type" => "post",
                 "rewrite" => true
            )
        );	
}
add_action('init', 'wpt_setup_post_types', 10);

function wpt_setup_event_taxonomies() {

	$labels = array(
		'name' => _x( 'Actions', 'taxonomy general name' ),
		'singular_name' => _x( 'Action', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Actions' ),
		'all_items' => __( 'All Actions' ),
		'menu_name' => __( 'Actions' ),
	); 	
		
	register_taxonomy('wpt_action',array('wpt_track'), array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'public' => true
	));
	
}
add_action('init', 'wpt_setup_event_taxonomies', 10);


?>