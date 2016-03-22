<?php 

/*
* Plugin Name: 3rd assignment-shortcodes 
* Plugin URI: 
* Description: shortcodes used to enhance the clients website 
* Author: Amrita Singh, KariAnn, Dewshan
*
* Version: 2.0
*/
/*-------------------------------------
 function enqueue's the style css for the plugin 
 taken from lab 2 fucntions.php and changed the directry path taken from "https://codex.wordpress.org/Function_Reference/get_stylesheet_directory_uri"
 ----------------------------------------*/
function enqueue_pl(){
wp_enqueue_style( 'new-css', get_stylesheet_directory_uri()."/css/style.css" );
}
add_action('wp_enqueue_scripts', 'enqueue_pl');



// Add Shortcode that changes color of the text taken from "http://mysitemyway.com/docs/index.php?title=Fancy_Links_and_Buttons" and lecture 7 slides available on "https://slate.sheridancollege.ca/d2l/le/content/266318/viewContent/4290597/View"
// creates prints a text and another fucntion button() is called here,  which creats a button and links to an external url, the user can change the attributes to suit their needs 
function user_color( $atts , $content = null ) {
return '<div class="change"><p>' . $content . '</br>'. button($content).'</p></div>';
}
add_shortcode( 'user_color', 'user_color' );




 
/*---------------------------------------
creates a button who's attributes can be changed by the user
taken from lecture 7 slides available at "https://slate.sheridancollege.ca/d2l/le/content/266318/viewContent/4290597/View"
------------------------------------------------*/
function social( $atts , $content = null ) {
extract( shortcode_atts(
array(
'title' => 'The Title',
'link' => 'https://twitter.com',
'linktxt' => 'Button Text',
'buttoncolor'=> 'Color',
'buttontext'=> 'button text',


), $atts )
);
return '<div class="userbutton" ><h2>'. $title . '</h2><div class="link-txt">'. $content.
'</div><p><a href="' . $link .'" class="the-link">' . $linktxt .'</a></p></div>';
}
add_shortcode( 'social', 'social' );





/*----------------------------------------------------
  DISPLAYS GOOGLE MAP 
  taken from http://wptricks.net/how-to-inserting-google-maps-into-wordpress/  
  ----------------------------------------------------*/


function googlemap($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '640',
      "height" => '480',
      "src" => ' '
   ), $atts));
   return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed" ></iframe>';
}
add_shortcode("googlemap", "googlemap");


/* --------------------------------------
 DISPLAYS MOST RECENT POSTS 
 taken from https://generatewp.com/shortcodes/?clone=recent-posts-shortcode
 ---------------------------------------------------*/

// Add Shortcode
function recent_posts_shortcode( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'posts' => '5',
			
		), $atts )
	);

	// Code
	$output = '<ul>';
	$the_query = new WP_Query( array ( 'posts_per_page' => $posts ) );
	while ( $the_query->have_posts() ):
		$the_query->the_post();
		$output .= '<li>' . get_the_title() . '</li>';
		
		
	endwhile;
	wp_reset_postdata();
	$output .= '</ul>';
	return $output;

}
add_shortcode( 'recent-posts', 'recent_posts_shortcode' );


/* --------------------------------------------
 shows date on each posts 
 taken from https://www.doitwithwp.com/insert-the-current-datetime-in-posts-or-pages/
 ---------------------------- */
function showdate(){
if ( has_post_format( 'standard' )) {
       return the_time('F j, Y');
} else if (has_post_format('gallery')) {
       return the_time('l jS F Y h:i:s A');
} else if (has_post_format('image')) {
       return the_time('l');
} 
 else  return date('F jS, Y');
}
add_shortcode( 'date', 'showdate' );



/* ----------------------------------------------
 Add Signature Image after single post code 
  taken from http://www.1dogwoof.com/2013/11/how-to-add-a-signature-to-all-wordpress-posts.html
and image taken from http://www.freeimages.com/search/sushi?free=1
---------------------------------------------------------------------------------*/ 

add_filter('the_content','add_signature', 1);
function add_signature($text) {
 global $post;
 if(($post->post_type == 'page')) 
    $text .= '<div class="signature"><img src="http://phoenix.sheridanc.on.ca/~ccit3485/wp-content/themes/abc-sushi/img/i-love-sushi.jpg"></div>';
    return $text;
}

/* ----------------------------------
DISLPAY MAIN MENU POST/PAGE WITHIN PAGE/POST
-----------------------------------*/
// taken from https://www.doitwithwp.com/include-a-post-within-a-post-or-page/
function diww_include_post($atts) {
  $thepostid = intval($atts[id]);
	$output = '';
	query_posts("p=$thepostid");
	if (have_posts()) : while (have_posts()) : the_post();
		$output .= get_the_title()."        ".get_the_content($post->ID);
	endwhile; else:
		// failed, output nothing
	endif;
	wp_reset_query();
	return $output;
}
add_shortcode("include_post", "diww_include_post");

/* ------------------------------------
 DISPLAYS POST IDS IN WORDPRESS  WHEN LOGGED INTO WORDPRESS
 TAKEN FROM https://www.doitwithwp.com/add-a-column-to-easily-note-the-post-id/
 --------------------------------------- */
 
 
// ADD COLUMN IN EDITOR FOR POST ID //
function posts_columns_id($defaults){
    $defaults['wps_post_id'] = __('ID');
    return $defaults;
}
function posts_custom_id_columns($column_name, $id){
  if($column_name === 'wps_post_id'){
        	echo $id;
    }
}
add_filter('manage_posts_columns', 'posts_columns_id', 5);
add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
add_filter('manage_pages_columns', 'posts_columns_id', 5);
add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);




/* -----------------------------------------
 PRINTS CUSTOM POST TYPE 
  TAKEN FROM http://www.tcbarrett.com/2012/11/wordpress-shortcode-to-make-a-list-of-your-custom-post-type-posts/#.VvDdUD-Kwxh
  ---------------------------------------------*/
  
  
add_shortcode( 'custom_posts', 'tcb_sc_custom_posts' );
function tcb_sc_custom_posts( $atts ){
  global $post;
  $default = array(
    'type'      => 'product',
    'post_type' => '',
    'limit'     => 10,
    'status'    => 'publish'
  );
  $r = shortcode_atts( $default, $atts );
  extract( $r );

  if( empty($post_type) )
    $post_type = $type;

  $post_type_ob = get_post_type_object( $post_type );
  if( !$post_type_ob )
    return '<div class="warning"><p>No such post type <em>' . $post_type . '</em> found.</p></div>';

  $return = '<h3>' . $post_type_ob->name . '</h3>';

  $args = array(
    'post_type'   => $post_type,
    'numberposts' => $limit,
    'post_status' => $status,
  );

  $posts = get_posts( $args );
  if( count($posts) ):
    $return .= '<ul>';
    foreach( $posts as $post ): setup_postdata( $post );
      $return .= '<li>' . get_the_title() . '</li>';
    endforeach; wp_reset_postdata();
    $return .= '</ul>';
  else :
    $return .= '<p>No posts found.</p>';
  endif;

  return $return;
}

?>
