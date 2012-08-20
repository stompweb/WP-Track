<?php
/*
Plugin Name: WP Track
Plugin URI: http://stomptheweb.co.uk/wp-track/
Description: Track your users actions across the site. Once activated it's accessible under <strong>Tools &rarr; Tracking</strong>
Version: 0.1
Author: Steven Jones
Author URI: http://www.stomptheweb.co.uk
*/

/*  Copyright 2005-2006  Ricardo Galli Granada  (email : gallir@uib.es)
    Copyright 2007-2012 Donncha O Caoimh (http://ocaoimh.ie/) and many others.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/

// plugin folder url
if(!defined('WPT_PLUGIN_URL')) {
	define('WPT_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}
// plugin folder path
if(!defined('WPT_PLUGIN_DIR')) {
	define('WPT_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
}
// plugin root file
if(!defined('WPT_PLUGIN_FILE')) {
	define('WPT_PLUGIN_FILE', __FILE__);
}

/*
|--------------------------------------------------------------------------
| INCLUDES
|--------------------------------------------------------------------------
*/

include_once( WPT_PLUGIN_DIR . '/includes/post-types.php');
include_once( WPT_PLUGIN_DIR . '/includes/admin.php');
include_once( WPT_PLUGIN_DIR . '/includes/functions.php');

/*
|--------------------------------------------------------------------------
| CORE
|--------------------------------------------------------------------------
*/

include_once( WPT_PLUGIN_DIR . '/includes/actions.php');
