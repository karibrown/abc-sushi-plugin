<?php
/*
Plugin Name: New-features
Plugin URI: http://phoenix.sheridanc.on.ca/~ccit3485/
Description: a plugin that will create a custom post type displaying new features.
Version: 1.0
Author: KariAnn Amrita Dewshan
Author URI: http://phoenix.sheridanc.on.ca/~ccit3485/
*/
add_action('init', 'create_new_features'); //creates new features page

function create_new_features() {
    register_post_type( 'new_features', //create new post type
        array(
            'labels' => array( //implementing the appropriate name in the outputs
                'name' => 'New Features',
                'singular_name' => 'New Feature',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Feature',
                'edit' => 'Edit',
                'edit_item' => 'Edit New Feature',
                'new_item' => 'New Feature',
                'view' => 'View',
                'view_item' => 'View New Feature',
                'search_items' => 'Search Features',
                'not_found' => 'No Features Found',
                'not_found_in_trash' => 'No Features found in Trash',
                //options provided in creating this post 
            ),
 //custom post type properties
            'public' => true, //visibility when logged out
            'has_archive' => true, //archive option avalible 
            'menu_position' => 15, //location
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),//displayed features
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-awards', //adds award icon 
            'has_archive' => true,
        )
    );
}
//retrieved from http://code.tutsplus.com/tutorials/a-guide-to-wordpress-custom-post-types-creation-display-and-meta-boxes--wp-27645
?>