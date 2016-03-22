-------------------------3rdshortcode.php-------------------------------------------

This short code file is used to register a custom post type for Artsy Sushi's featured products. At the start of this document along with every other php document the Plugin name, a desciption and authors are indicated to provide both the computer and future users an idea of what type of php file is being delt with. Shortcodes with $attributes are pieces of information that remain variable and depend on the users desired output. In understanding the given code below is provided a brief description of the various shortcodes, and what is required from the user in using these shortcodes. 

	When considering Shortcodes it is often called within the text area provided in wordpress, one must call the function and state the attr and lastly allow the attr to represent a unique title "  " and then apply text and close the function similar to html layout[ Function arraycall-1=" " arraycall-2=" "...] additional text[/function]

	<!--function enqueue_pl(){
	wp_enqueue_style( 'new-css', get_stylesheet_directory_uri()."/css/style.css" );
	}
	add_action('wp_enqueue_scripts', 'enqueue_pl'); -->
First in this function a style sheet is enqueued, telling the computer to apply any information located in the style.css folder to the output provided by this shortcode file.
		<!--function user_color( $atts , $content = null ) {
	return '<div class="change"><p>' . $content . '</br>'. button($content).'</p></div>';
	}
	add_shortcode( 'user_color', 'user_color' );-->

A function is specified [user_color] and provides the user the ability to modify and change the color output as one desires, also provides the user with the ability to create a external url linked to the specified content. When attempting to use this color attribute one must select the post or page desired to change and call the function in squared brackets and select one of the options from the array options provides, ie: in the text area write[social title=" " link= " " ....] additional text [/social]. 
		 

		<!--function social( $atts , $content = null ) {
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
	add_shortcode( 'social', 'social' );-->

	avalible functions include the following :
	 (this provides the opporunity for the user to understand what we used our short codes for and what they are able to change and call within their files along with a brief description of what occurs)


This function [social] provides a series of attributes that can be modified on the webpage according to the users desire, allowing for the webpage to aquire a unique tone to the users satisfaciton. User must place inline text within the post of their choice in order to add this button into the theme. Replacing the $attributes with the appropriate requirements. 
	<!--function googlemap($atts, $content = null) {
	   extract(shortcode_atts(array(
	      "width" => '640',
	      "height" => '480',
	      "src" => ' '
	   ), $atts));
	   return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed" ></iframe>';
	}
	add_shortcode("googlemap", "googlemap"); -->
This function [googlemap] provides the users with a locations service where this short code outputs an image within the given frame 

	<!--// Add Shortcode
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
	add_shortcode( 'recent-posts', 'recent_posts_shortcode' ); -->

<!--register_post_type( 'photos',
		    array(
		        'labels' => array(
		            'name' => __( 'photos' ),
		            'singular_name' => __( 'photo' )
		        ),
		        'public' => true,
		        'supports' => array(
		            'title',
		            'editor',
		            'author',
		            'thumbnail',
		            'excerpt',
		            'comments'
		        ),
		        'capability_type' => 'post',
		        'rewrite' => array('slug'=> $slug)
		    )
		);
		function scRecentPhoto() {
		global $post;

		$photoargs = array(
		'post_type' => 'photos',
		'posts_per_page' => 5,
		 );
		$photoloop = new WP_Query($photoargs);

		while ( $photoloop->have_posts() ) : $photoloop->the_post(); 
		$output = get_the_post_thumbnail(array(280,130));
		$output .= '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
		$output .= '<p>' . get_the_excerpt() . '</p>';
		endwhile;

		return $output;
		}
		add_shortcode('recentphoto', 'scRecentPhoto');

		-->
This post type [photos] notifies the computer that if there are thumbnails to present them. Throughout this array it provides characteristics for the computer to consider. Thumbnail individual names a common name for the group of photos. The supports are changes that the users are allowed to make to this registered post type and public specifies who is able to see these changes. The function given is [scRecentPhoto] where when calling this function limits and a loop is put into place. A while statement is used to test the given query and  if this statement is true then the output 


	Other changing functions avalible are:
	(however this changes as the days do and can not be changed by the user) 

This function adds recent posts[recent_posts_shortcode], it provides attributes for the given posts and a limit is applied. It outputs a list of post titles <!--with a permalink attached to each one-->

		<!--function showdate(){
		if ( has_post_format( 'standard' )) {
		       return the_time('F j, Y');
		} else if (has_post_format('gallery')) {
		       return the_time('l jS F Y h:i:s A');
		} else if (has_post_format('image')) {
		       return the_time('l');
		} //else if(has_post_format('quote'){
		       //the_time('jS F y');
		//} 
		 else  return date('F jS, Y');
		}
		add_shortcode( 'date', 'showdate' );-->
This function [showdate], allows the user to keep note of each post and entry made as this shortcode outputs the date and time on several different aspects of the website. These being the general forum, the gallery, images, and quotes.
		<!-- add_filter('the_content','add_signature', 1);
		function add_signature($text) {
		 global $post;
		 if(($post->post_type == 'page')) 
		    $text .= '<div class="signature"><img src="http://phoenix.sheridanc.on.ca/~ccit3485/wp-content/themes/abc-sushi/img/i-love-sushi.jpg"></div>';
		    return $text;
		} -->
This function[add_filter] will add a personal signature to the given posts located on a page, an if statement has been put into place where if there is is a page the signature feature will be applied. 
		<!--function hide_email_from_scrapers( $atts , $content = null ) {
			if ( ! is_email( $content ) ) {
				return;
			}
		 
			return '<a href="mailto:' . antispambot( $content, 1 ) . '">' . antispambot( $content, 1 ) . '</a>';
		}
		add_shortcode( 'hide_email', 'hide_email_from_scrapers' );-->
The function [hide_email_from_scrapers], protects emails from spams and risks similar to these ones. Protective measures used to ensure the users safety
		

References: 
https://codex.wordpress.org/Function_Reference/get_stylesheet_directory_uri
http://mysitemyway.com/docs/index.php?title=Fancy_Links_and_Buttons
https://slate.sheridancollege.ca/d2l/le/content/266318/viewContent/4290597/View
http://wptricks.net/how-to-inserting-google-maps-into-wordpress/
https://generatewp.com/shortcodes/?clone=recent-posts-shortcode
https://www.doitwithwp.com/insert-the-current-datetime-in-posts-or-pages/
http://www.1dogwoof.com/2013/11/how-to-add-a-signature-to-all-wordpress-posts.html
and image taken from http://www.freeimages.com/search/sushi?free=1
https://www.doitwithwp.com/obfuscating-email-addresses-wordpress/
http://wordpress.stackexchange.com/questions/52246/using-thumbnail-functions-inside-a-shortcode
//www.doitwithwp.com/add-a-column-to-easily-note-the-post-id/
http://www.tcbarrett.com/2012/11/wordpress-shortcode-to-make-a-list-of-your-custom-post-type-posts/#.VvDdUD-Kwxh



-------------------------post-types.php-------------------------------------------

In this plug in, its purpose is to register custom post types for featured products. Through the creation of new functions and setting a $attr to the called function it provides the user with the ability to change and modify any settings within the custom post type, given that they have a $labels value. Within the arrays listed the user is able to merely place inline text into their custom post type and change the quoted attributes. We have given them the opporunity to personalize the creation of the posts presented. In this case knowing the labelling and function titles is not necessary as this array $labels informs the computer of the labels for the given post type. When using this plug in on your site it is made to display on the front page of the site. It is located below the original posts of the content. In activating this the custom post prints out title of  



 

References:

