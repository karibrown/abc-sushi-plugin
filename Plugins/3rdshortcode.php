<?php 

/*
* Plugin Name: 3rd assignment-shortcodes 
* Plugin URI: 
* Description: shortcodes used to enhance the clients website 
* Author: Amrita Singh 
*
* Version: 2.0
*/
// taken from lab 2 fucntions.php and changed the directry path taken from "https://codex.wordpress.org/Function_Reference/get_stylesheet_directory_uri"
// this function enqueue's the style css for the plugin 
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




//adds a section from an external source taken from lecture 7 slides available at "https://slate.sheridancollege.ca/d2l/le/content/266318/viewContent/4290597/View"
// creates a button who's attributes can be changed by the user
function social( $atts , $content = null ) {
extract( shortcode_atts(
array(
'title' => 'The Title',
'link' => 'https://twitter.com',
'linktxt' => 'Button Text',
'buttoncolor'=> 'Color',
'buttontext'=>' button text',


), $atts )
);
return '<div class="userbutton" ><h2>'. $title . '</h2><div class="link-txt">'. $content.
'</div><p><a href="' . $link .'" class="the-link">' . $linktxt . '</a></p></div>';
}
add_shortcode( 'social', 'social' );

/* GOOGLE AD taken from http://wptricks.net/how-to-inserting-google-maps-into-wordpress/  */ 
//Google Maps Shortcode

function googlemap($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '640',
      "height" => '480',
      "src" => ' '
   ), $atts));
   return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed" ></iframe>';
}
add_shortcode("googlemap", "googlemap");


/* most recent 5 posts taken from https://generatewp.com/shortcodes/?clone=recent-posts-shortcode*/

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

/* shows date on each posts taken from https://www.doitwithwp.com/insert-the-current-datetime-in-posts-or-pages/ */
function showdate(){
    return date('F jS, Y');
}
add_shortcode( 'date', 'showdate' );



/* Add Signature Image after single post code taken from http://www.1dogwoof.com/2013/11/how-to-add-a-signature-to-all-wordpress-posts.html
and image taken from http://www.freeimages.com/search/sushi?free=1*/ 

add_filter('the_content','add_signature', 1);
function add_signature($text) {
 global $post;
 if(($post->post_type == 'page')) 
    $text .= '<div class="signature"><img src="http://phoenix.sheridanc.on.ca/~ccit3485/wp-content/themes/abc-sushi/img/i-love-sushi.jpg"></div>';
    return $text;
}
?>
