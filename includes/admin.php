<?php

/**
 * Changed admin UI for post type
 *
 *
 * @access      private
 * @since       0.1
 * @return      void
*/

// Change the appearance of the edit column for order
function wpt_track_columns($columns) {
    unset($columns['title']);
    unset($columns['date']);
	$columns['wpt_action'] = 'Action';
    $columns['wpt_affected'] = 'Affected';
	$columns['wpt_user'] = 'User';
	$columns['wpt_date'] = 'Date';
	$columns['wpt_ip'] = 'IP address';		    
    return $columns;
}

// Store data for new columns for orders
function wpt_tracking_columns( $column ) {

	global $post;
	switch ( $column )
	{
		case 'wpt_action':
			$term_list = wp_get_post_terms($post->ID, 'wpt_action', array("fields" => "all"));
			foreach ($term_list as $term) {
				echo $term->name;
			}
			break;
		case 'wpt_affected':
			$item_id = get_post_meta( $post->ID , 'wpt_affected' , true ); 
			$item = get_post($item_id); 
			echo $item->post_title;
			break;			
		case 'wpt_user':
		 	$user = get_userdata( $post->post_author ); 
		 	echo $user->first_name . ' ' . $user->last_name. ' (' . $post->post_author . ')';
			break;
		case 'wpt_date':
			echo the_time() . ' on ' . get_the_date(); 
			break;
		case 'wpt_ip':
			echo get_post_meta( $post->ID , 'event' , true ); 
			break;									
	}
}

add_action( 'manage_posts_custom_column' , 'wpt_tracking_columns' );
add_filter('manage_edit-wpt_track_columns' , 'wpt_track_columns');

// Add actions filter
add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
function my_restrict_manage_posts() {
	global $typenow;
	$taxonomy = 'wpt_action';
	if( $typenow == "wpt_track" ){
		$filters = array($taxonomy);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Show All $tax_name</option>";
			foreach ($terms as $term) { echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; }
			echo "</select>";
		}
	}
}

add_action('restrict_manage_posts', 'author_filter');

function author_filter() {
$args = array('name' => 'author', 'show_option_all' => 'View all Users');
if (isset($_GET['user'])) {
    $args['selected'] = $_GET['user'];
}
wp_dropdown_users($args);
}


//Remove custom post types from the menu and put them under the sub menus.
function addRedirectMenuPages() {
	$parent_slug   = "tools.php";        // the slug of the parent page that you want to add a sub page to
	$menu_title    = "Tracking";    // the menu name of the new page you are adding
	$capability    = "install_plugins";  // the capability
	$menu_slug     = "edit.php?post_type=wpt_track";    // the slug for the new page
	$redirect_slug = "edit.php?post_type=wpt_track";       // the slug of the page that you want to re-direct the user to when they click on this menu item

	if(preg_match("/${menu_slug}$/", $_SERVER["REQUEST_URI"])) {
		header("Location: $redirect_slug");
       	exit();
	}

	$callback_function = create_function('', 'add_submenu_page("' . $parent_slug . '", "none", "' . $menu_title . '", "' . $capability . '", "' . $menu_slug . '");');

	add_action("admin_menu", $callback_function);
	
	
}

add_action("init", "addRedirectMenuPages");


?>