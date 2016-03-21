<?php 

/*
* Plugin Name: assignment 3  
* Plugin URI: 
* Description: plugin for abc_sushi
* Author: Amrita Singh, 
*
* Version: 2.0
*/

/* ---------------------------------
			SHORTCODES
---------------------------------- */
// taken from lab 2 fucntions.php and changed the directry path taken from "https://codex.wordpress.org/Function_Reference/get_stylesheet_directory_uri"
// this function enqueue's the style css for the plugin 
function enqueue_pl(){
wp_enqueue_style( 'new-css', get_stylesheet_directory_uri()."/newstyle.css" );
}
add_action('wp_enqueue_scripts', 'enqueue_pl');


// Add Shortcode that changes color of the text taken from "http://mysitemyway.com/docs/index.php?title=Fancy_Links_and_Buttons" and lecture 7 slides available on "https://slate.sheridancollege.ca/d2l/le/content/266318/viewContent/4290597/View"
// creates prints a text and another fucntion button() is called here,  which creats a button and links to an external url, the user can change the attributes to suit their needs 
function user_color( $atts , $content = null ) {
return '<div class="change"><p>' . $content . '</br>'. button($content).'</p></div>';
}
add_shortcode( 'user_color', 'user_color' );




/* GOOGLE AD taken from https://speckyboy.com/2011/07/18/getting-started-with-wordpress-shortcodes-examples/*/ 


function showads() {
    return '<script type="text/javascript"><!--
    google_ad_client = "pub-3637220125174754";
    google_ad_slot = "4668915978";
    google_ad_width = 468;
    google_ad_height = 60;
    //-->
    </script>
    <script type="text/javascript"
    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
';
}
add_shortcode('adsense', 'showads');