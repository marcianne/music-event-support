<?php defined('ABSPATH') or die("No script kiddies please!");
/** Post with branding & sponsor info for each supporting business **/

add_action( 'init', 'register_cpt_sponsor' );

function register_cpt_sponsor() {
$icon_path = MECPT_PLUGIN_URL . 'img/icons/sponsors.png';
    $labels = array( 
        'name' => _x( 'Sponsors', 'sponsors' ),
        'singular_name' => _x( 'Sponsor', 'sponsor' ),
        'add_new' => _x( 'Add New', 'sponsor' ),
        'add_new_item' => _x( 'Add New Sponsor', 'sponsor' ),
        'edit_item' => _x( 'Edit Sponsor', 'sponsor' ),
        'new_item' => _x( 'New Sponsor', 'sponsor' ),
        'view_item' => _x( 'View Sponsor', 'sponsor' ),
        'search_items' => _x( 'Search Sponsors', 'sponsor' ),
        'not_found' => _x( 'No sponsors found', 'sponsor' ),
        'not_found_in_trash' => _x( 'No sponsors found in Trash', 'sponsor' ),
        'parent_item_colon' => _x( 'Parent Sponsor:', 'sponsor' ),
        'menu_name' => _x( 'Sponsors', 'sponsor' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Info page for each TJW sponsor.',
        'supports' => array( 'title', 'thumbnail', 'editor', 'post-formats' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon'   => $icon_path,
        'menu_position'       => 5,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => 'sponsors' ),
        'capability_type' => 'post'
    );

    register_post_type( 'sponsor', $args );
}

// Metaboxes for Sponsor CPT

add_filter( 'cmb2_meta_boxes', 'cmb2_sponsor_metaboxes' );

function cmb2_sponsor_metaboxes( array $meta_boxes ) {

// Start with an underscore to hide fields from custom fields list
$prefix = '_cmb2_';

$meta_boxes[] = array(
'id'            => 'sponsor_details_metabox',
'title'         => __( 'About This Sponsor:', 'cmb2' ),
'object_types'  => array( 'sponsor'), // Post type
'context'       => 'normal',
'priority'      => 'high',
'show_names'    => true, // Show field names on the left
// 'cmb_styles' => false, // false to disable the CMB stylesheet
'fields'        => array(

array(
'name' => 'Phone',
'id' => $prefix . 'phone',
'desc' => 'If applicable, otherwise leave empty.',
'type' => 'text',
),
array(
'name' => 'City, State',
'id' => $prefix . 'sponsor_locale',
// 'desc' => 'If applicable, otherwise leave empty.',
'type' => 'text',
),

));

$meta_boxes[] = array(
'id'            => 'sponsor_logo_metabox',
'title'         => __( 'Promotional Imagery:', 'cmb2' ),
'object_types'  => array( 'sponsor', 'performer'), // Post type
'context'       => 'normal',
'priority'      => 'high',
'show_names'    => true, // Show field names on the left
// 'cmb_styles' => false, // false to disable the CMB stylesheet
'fields'        => array(


array(
'name' => 'Logo',
'desc' => 'Upload an image or enter an URL.',
'id' => $prefix . 'logo_image',
'type' => 'file',
'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
),

array(
'name' => 'Badge',
'desc' => 'Will be featured on pages and archives. Aspect ratio should be 1:1.',
'id' => $prefix . 'badge_image',
'type' => 'file',
'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
),
));

}