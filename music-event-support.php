<?php defined('ABSPATH') or die("No script kiddies please!");
/**
 * Plugin Name: Music Event Support
 * Plugin URI: http://www.marcianneoday.com/mecpt
 * Description: Includes custom post types and display options for instructors, workshops, performers & sponsors.
 * Version: 2.0.0
 * Author: Marcianne O'Day
 * Author URI: facebook.com/marcianne.oday
 * GPL2
 */
// define constants for includes 
define( 'MECPT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'MECPT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function load_custom_wp_admin_style() {
$admin_style_path = MECPT_PLUGIN_URL . '/admin/styles.css';
wp_register_style( 'custom_wp_admin_css', $admin_style_path );
wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
 
// check for missing plugin dependencies and advise activation  
function list_missing_plugins() {
if ( ! function_exists( 'get_plugins' ) ) { require_once ABSPATH . 'wp-admin/includes/plugin.php'; }
// plugin names to compare with get_option('active_plugins') array
$necessary_plugins = array( 
'CMB2',
'CMB2 Field Type: Select2', 
'CMB2 Post Search field'
);
// current active plugins
$apl = get_option('active_plugins');
$plugins = get_plugins();
$activated_plugins=array();
foreach ( $apl as $p ) {  
if(isset($plugins[$p])){
array_push($activated_plugins, $plugins[$p]['Name']);
}   
}
$missing_plugins = array_diff($necessary_plugins, $activated_plugins);
foreach($missing_plugins as $missing_plugin){
$message = "For full site functionality, please activate {$missing_plugin}.";
MECPT_admin_notice($message);
}
}
add_action( 'plugins_loaded', 'list_missing_plugins' );    
// reusable function for displaying error notices in admin area
function MECPT_admin_notice($message) {
$class = 'notice notice-error';
$print_notice = __( $message, 'sample-text-domain' );
printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $print_notice ); 
}

// include CPTS
require( MECPT_PLUGIN_PATH . 'post-types/instructor.php');
require( MECPT_PLUGIN_PATH . 'post-types/workshop.php');
require( MECPT_PLUGIN_PATH . 'post-types/sponsor.php');
