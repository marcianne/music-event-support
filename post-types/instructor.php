<?php defined('ABSPATH') or die("No script kiddies please!");
/** Custom Post Type for providing biographies & photos of TJW instructors **/

if ( ! function_exists('register_cpt_instructor') ) {

// Register Custom Post Type
function register_cpt_instructor() {
$icon_path = MECPT_PLUGIN_URL . 'img/icons/instructor.png';
	$labels = array(
		'name'                => _x( 'Instructors', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Instructor', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Instructor', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Instructor:', 'text_domain' ),
		'all_items'           => __( 'All Instructors', 'text_domain' ),
		'view_item'           => __( 'View Instructor', 'text_domain' ),
		'add_new_item'        => __( 'Add New Instructor', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Instructor', 'text_domain' ),
		'update_item'         => __( 'Update Instructor', 'text_domain' ),
		'search_items'        => __( 'Search Instructor', 'text_domain' ),
		'not_found'           => __( 'Instructor Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Instructor Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'instructor', 'text_domain' ),
		'description'         => __( 'Bios, photos & URLs for each individual TJW instructor.', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'   => $icon_path,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite' => array('slug' => 'instructors'),
		'capability_type'     => 'page',
	);
	register_post_type( 'instructor', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_cpt_instructor', 0 );

}

// Metaboxes for instructor CPT

add_filter( 'cmb2_meta_boxes', 'cmb2_instructor_metaboxes' );
function cmb2_instructor_metaboxes( array $meta_boxes ) {

// Start with an underscore to hide fields from custom fields list
$prefix = '_cmb2_';

/**
* Metaboxes for Instructor Post Type
*/
$meta_boxes[] = array(
'id'            => 'instructor_details_metabox',
'title'         => __( 'Instructor Details:', 'cmb2' ),
'object_types'  => array( 'instructor'), // Post type
'context'       => 'normal',
'priority'      => 'high',
'show_names'    => true, // Show field names on the left
// 'cmb_styles' => false, // false to disable the CMB stylesheet
'fields'        => array(

array(
'name'       => __( 'Workshop Taught', 'cmb2' ),
'desc'       => __( 'Be sure to create a workshop post using the same name.', 'cmb2' ),
'id'         => $prefix . 'workshopstaughtnames',
'type'       => 'text',
// 'options'	=> get_workshop_instructors(),
// 'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
// 'on_front'        => false, // Optionally designate a field to wp-admin only
'repeatable'      => false,
),

));



$meta_boxes[] = array(
'id'            => 'social_media',
'title'         => __( 'Web & Social Media Links', 'cmb2'),
'object_types'  => array('instructor', 'performer', 'sponsor'),
'context'       => 'normal',
'priority'      => 'high',
'show_names'    => true, // Show field names on the left
// 'cmb_styles' => false, // false to disable the CMB stylesheet
'fields'        => array(

array(
'name' => __( 'Website(s) & Email', 'cmb2' ),
'id'   => $prefix . 'WWWurls',
'type' => 'text_url',
// 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
'repeatable' => 'true',
),

array(
'name' => __( 'Facebook', 'cmb2' ),
//	'desc' => __( 'field description (optional)', 'cmb2' ),
'id'   => $prefix . 'facebookurl',
'type' => 'text_url',
),
array(
'name' => __( 'Twitter', 'cmb2' ),
//	'desc' => __( 'field description (optional)', 'cmb2' ),
'id'   => $prefix . 'twitterurl',
'type' => 'text_url',
),
array(
'name' => __( 'Google+', 'cmb2' ),
//	'desc' => __( '', 'cmb2' ),
'id'   => $prefix . 'googleplusurl',
'type' => 'text_url',
),
array(
'name' => __( 'YouTube', 'cmb2' ),
//	'desc' => __( '', 'cmb2' ),
'id'   => $prefix . 'youtube',
'type' => 'text_url',
),
));




return $meta_boxes;
}
