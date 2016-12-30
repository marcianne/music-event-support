<?php defined('ABSPATH') or die("No script kiddies please!");
/** Custom Post Type for providing workshop info **/

function register_cpt_workshop() {
$icon_path = MECPT_PLUGIN_URL . 'img/icons/class.png';
    $labels = array( 
        'name' => _x( 'Workshops', 'workshops' ),
        'singular_name' => _x( 'Workshop', 'workshop' ),
        'add_new' => _x( 'Add New', 'workshop' ),
        'add_new_item' => _x( 'Add New Workshop', 'workshop' ),
        'edit_item' => _x( 'Edit Workshop', 'workshop' ),
        'new_item' => _x( 'New Workshop', 'workshop' ),
        'view_item' => _x( 'View Workshop', 'workshop' ),
        'search_items' => _x( 'Search Workshops', 'workshop' ),
        'not_found' => _x( 'No workshops found', 'workshop' ),
        'not_found_in_trash' => _x( 'No workshops found in Trash', 'workshop' ),
        'parent_item_colon' => _x( 'Parent workshop:', 'workshop' ),
        'menu_name' => _x( 'Workshops', 'workshop' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Info page for each TJW workshop.',
        'supports' => array( 'title', 'thumbnail', 'editor', 'post-formats' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true, 
        'menu_position'       => 5, 
        'menu_icon'   => $icon_path,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => 'workshops' ),
        'capability_type' => 'post'
    );

    register_post_type( 'workshop', $args );
}

add_action( 'init', 'register_cpt_workshop' );

// Metaboxes for workshop CPT

add_filter( 'cmb2_meta_boxes', 'cmb2_workshop_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_workshop_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb2_';

	// Metabox for every post type

	$meta_boxes[] = array(
	'id'            => 'slidedeck2',
	'title'         => __( 'Slider Image:', 'cmb2' ),
	'object_types'  => array( 'page', 'post', 'instructor', 'workshop', 'performer', 'sponsor'), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
	// 'cmb_styles' => false, // false to disable the CMB stylesheet
	'fields'        => array(


	array(
	'name' => 'Front Page Slideshow Image',
	'desc' => 'For best results, image should be cropped to a 3:1 aspect ratio',
	'id' => $prefix . 'slidedeck2_image',
	'type' => 'file',
	'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
	),

	));	
	
	

/**
	 * Metaboxes for Workshop/Event Post Type
	 */
	$meta_boxes[] = array(
		'id'            => 'workshops_metabox',
		'title'         => __( 'Workshop Details:', 'cmb2' ),
		'object_types'  => array( 'workshop'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		'fields'        => array(
			array(
				'name'       => __( 'Instructor(s)', 'cmb2' ),
				'desc'       => __( 'Be sure to create a new "Instructor" bio using the same name.', 'cmb2' ),
				'id'         => $prefix . 'instructorname',
				'type'       => 'text',
				// 'options'	=> get_workshop_instructors(),
				// 'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
			 'repeatable'      => true,
			),
			array(
				'name' => __( 'Instructor Email', 'cmb2' ),
				'desc' => __( 'If potential registrants have questions about the class, what email should they send inquiries to?', 'cmb2' ),
				'id'   => $prefix . 'email',
				'type' => 'text_email',
				// 'repeatable' => true,
			),	
			
			array(
				'name'    => __( 'Prerequisites', 'cmb2' ),
				'desc'    => __( 'How much previous experience should attendees have in order to benefit from the workshop?', 'cmb2' ),
				'id'      => $prefix . 'workshop_experience',
				'type'    => 'textarea_small',
				// 'options' => array( 'textarea_rows' => 3, ),
			),
			array(
				'name'    => __( 'Instructor Materials', 'cmb2' ),
				'desc'    => __( 'Upload course materials-- docs & recordings', 'cmb2' ),
				'id'      => $prefix . 'workshop_docs',
				'type'    => 'file_list',
				// 'options' => array( 'textarea_rows' => 3, ),
			),
			
			array(
				'name'    => __( 'Workshop Date', 'cmb2' ),
				'desc'    => __( 'Displays on Event Page & Archives', 'cmb2' ),
				'id'      => $prefix . 'workshop_date',
				'type'    => 'text_date',
				'date_format' => 'l, F j, Y',
			),
			
			array(
				'name'    => __( 'Workshop Start Time', 'cmb2' ),
				'desc'    => __( 'Displays on Event Page & Archives', 'cmb2' ),
				'id'      => $prefix . 'workshop_time',
				'type'    => 'text_time',
				// 'options' => array( 'textarea_rows' => 3, ),
			),
			
			array(
				'name'    => __( 'Workshop Cost', 'cmb2' ),
				'desc'    => __( 'Displays on Event Page & Archives', 'cmb2' ),
				'id'      => $prefix . 'workshop_cost',
				'type'    => 'text_money',
				// 'options' => array( 'textarea_rows' => 3, ),
			),
			array(
				'name'    => __( 'Weekend Pass Cost', 'cmb2' ),
				'desc'    => __( 'Displays on Event Page & Archives', 'cmb2' ),
				'id'      => $prefix . 'weekend_cost',
				'type'    => 'text_money',
				// 'options' => array( 'textarea_rows' => 3, ),
			),
			
		),
	);


	return $meta_boxes;
}
