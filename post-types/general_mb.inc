<?php defined('ABSPATH') or die("No script kiddies please!");

// Metaboxes for every post type
$prefix = '_cmb2_';

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

return $meta_boxes;
