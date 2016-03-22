<?php 
/*Plugin Name: Create Product Post Type
Description: This plugin registers a custom post type for featured products.
License: GPLv2
Authors: Dewshan Sarathchandra, Amrita Singh, Kariann Brown 
Code referenced from: www.wpbeginner.com/wp-tutorials/how-to-create-custom-post-types-in-wordpress/
*/

/* ---------------------------------
	CUSTOM POST TYPE
---------------------------------- */

/* register custom post type function */
function wpmudev_create_post_type() {

// Set UI labels for Custom post type
	$labels = array(
 	'name' => 'Products',
    	'singular_name' => 'Product',
    	'add_new' => 'Add New Product',
    	'add_new_item' => 'Add New Product',
    	'edit_item' => 'Edit Product',
    	'new_item' => 'New Product',
    	'all_items' => 'All Products',
    	'view_item' => 'View Product',
    	'search_items' => 'Search Products',
    	'not_found' =>  'No Products Found',
    	'not_found_in_trash' => 'No Products found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Products',
    );

/*register post type */
	register_post_type( 'product', array(
		'labels' => $labels,
		'has_archive' => true,
 		'public' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),	
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'products' ),
		)
	);
}
/* Hook into the 'init' action so that the custom post type will not be unnecessarily executed. */
add_action( 'init', 'wpmudev_create_post_type' );

/* Display Custom Post Type on the front page */
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

function add_my_post_types_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'product' ) );
	return $query;
}

/* Adds shortcode to display latest posts */
function my_recent_posts_shortcode($atts){
 $q = new WP_Query(
   array( 'orderby' => 'date', 'posts_per_page' => '4')
 );
$list = '<ul class="recent-posts">';
while($q->have_posts()) : $q->the_post();
 $list .= '<li>' . get_the_date() . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' . '<br />' . get_the_excerpt() . '</li>';
endwhile;
wp_reset_query();
return $list . '</ul>';
}
add_shortcode('recent-posts', 'my_recent_posts_shortcode');

?>
