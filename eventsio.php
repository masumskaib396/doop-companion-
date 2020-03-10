<?php

/**
 *
 * @wordpress-plugin
 * Plugin Name:       Doop
 * Plugin URI:        
 * Description:       This Plugin Is a Doop Theme 
 * Version:           1.0.0
 * Author:            Masum Sakib
 * Author URI:       
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       doop
 * Domain Path:       /languages
 */


// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


function doop_load_textdomain(){
	load_plugin_textdomain('doop',false,dirname(__FILE__)."/languages");
}
add_action('plugins_loaded','doop_load_textdomain');

/*
Constants
------------------------------------------ */

/* Set plugin version constant. */
define( 'DOOP_VERSION', '0.1');

/* Set constant path to the plugin directory. */
define( 'DOOP_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

// Plugin Addons Folder Path
define( 'DOOP_ADDONS_DIR', plugin_dir_path( __FILE__ ) . 'widget/' );

// Assets Folder URL
define( 'DOOP_ASSETS_PUBLIC', plugins_url( 'assets', __FILE__ ) );


require_once(DOOP_PATH. 'init.php' );
require_once(DOOP_PATH. '/inc/helper-functions.php' );