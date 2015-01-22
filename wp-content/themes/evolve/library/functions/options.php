<?php   
/**
* A unique identifier is defined to store the options in the database and reference them from the theme.
* By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
* If the identifier changes, it'll appear as if the options have been reset.
*
*/

function evolve_option_name() {

// This gets the theme name from the stylesheet (lowercase and without spaces)
$themename = wp_get_theme();
$themename = $themename['Name'];
$themename = preg_replace("/\W/", "", strtolower($themename) );

$evolve_settings = get_option('evolve');
$evolve_settings['id'] = 'evolve-theme';
update_option('evolve', $evolve_settings); 

}

/**
* Defines an array of options that will be used to generate the settings page and be saved in the database.
* When creating the "id" fields, make sure to use all lowercase and no spaces.
*
*/

function evolve_options() {


// Pull all the categories into an array
$options_categories = array();
$options_categories_obj = get_categories();
foreach ($options_categories_obj as $category) {
$options_categories[$category->cat_ID] = $category->cat_name;
}

// Pull all the pages into an array
$options_pages = array();
$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
$options_pages[''] = 'Select a page:';
foreach ($options_pages_obj as $page) {
$options_pages[$page->ID] = $page->post_title;
}

// If using image radio buttons, define a directory path
$imagepath = get_template_directory_uri() . '/library/functions/images/';
$imagepathfolder = get_template_directory_uri() . '/library/media/images/';
$evlshortname = "evl";
$template_url = get_template_directory_uri();

$options = array();


// Layout

$options[] = array( "name" => $evlshortname."-tab-1", "id" => $evlshortname."-tab-1",
"type" => "open-tab");



$options['evl_layout'] = array( 
"name" => __( 'Select a layout', 'evolve' ),
"desc" => __( 'Select main content and sidebar alignment.', 'evolve' ),
"id" => $evlshortname."_layout",
"std" => "2cl",
"type" => "images",
"options" => array(
'1c' => $imagepath . '1c.png',
'2cl' => $imagepath . '2cl.png',
'2cr' => $imagepath . '2cr.png',
'3cm' => $imagepath . '3cm.png',
'3cr' => $imagepath . '3cr.png',
'3cl' => $imagepath . '3cl.png'
)
);

$options['evl_width_layout'] = array( 
"name" => __( 'Layout Style', 'evolve' ),
"desc" => __( '<strong>Boxed version</strong> automatically enables custom background', 'evolve' ),
"id" => $evlshortname."_width_layout",
"std" => "fixed",
"type" => "select",
"options" => array(
'fixed' => __( 'Boxed &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'fluid' => __( 'Wide', 'evolve' )
)
);

$options['evl_width_px'] = array( 
"name" => __( 'Layout Width', 'evolve' ),
"desc" => __( 'Select the width for your website', 'evolve' ),
"id" => $evlshortname."_width_px",
"std" => "1200",
"type" => "select",
"options" => array(
'800' => __( '800px', 'evolve' ),
'985' => __( '985px', 'evolve' ),
'1200' => __( '1200px &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'1600' => __( '1600px', 'evolve' )
)
);



$options[] = array( "name" => $evlshortname."-tab-1", "id" => $evlshortname."-tab-1",
"type" => "close-tab" );



// Posts

$options[] = array( "name" => $evlshortname."-tab-2", "id" => $evlshortname."-tab-2",
"type" => "open-tab");



$options['evl_post_layout'] = array( "name" => __( 'Blog layout', 'evolve' ),
"desc" => __( 'Grid layout with <strong>3</strong> posts per row is recommended to use with disabled <strong>Sidebar(s)</strong>', 'evolve' ),
"id" => $evlshortname."_post_layout",
"type" => "images",
"std" => "two",
"options" => array(
'one' => $imagepath . 'one-post.png',
'two' => $imagepath . 'two-posts.png',
'three' => $imagepath . 'three-posts.png',
));

$options['evl_excerpt_thumbnail'] = array( "name" => __( 'Enable post excerpts', 'evolve' ),
"desc" => __( 'Check this box if you want to display post excerpts on one column blog layout', 'evolve' ),
"id" => $evlshortname."_excerpt_thumbnail",
"type" => "checkbox",
"std" => "0");

$options['evl_featured_images'] = array( "name" => __( 'Enable featured images', 'evolve' ),
"desc" => __( 'Check this box if you want to display featured images', 'evolve' ),
"id" => $evlshortname."_featured_images",
"type" => "checkbox",
"std" => "1");
    
$options['evl_thumbnail_default_images'] = array( "name" => __( 'Hide default thumbnail images', 'evolve' ),
"desc" => __( 'Check this box if you don\'t want to display default thumbnail images', 'evolve' ),
"id" => $evlshortname."_thumbnail_default_images",
"type" => "checkbox",
"std" => "0");
    

$options['evl_author_avatar'] = array( "name" => __( 'Enable post author avatar', 'evolve' ),
"desc" => __( 'Check this box if you want to display post author avatar', 'evolve' ),
"id" => $evlshortname."_author_avatar",
"type" => "checkbox",
"std" => "0");

$options['evl_header_meta'] = array( "name" => __( 'Post meta header placement', 'evolve' ),
"desc" => __( 'Choose placement of the post meta header - Date, Author, Comments', 'evolve' ),
"id" => $evlshortname."_header_meta",
"type" => "select",
"std" => "single_archive",
"options" => array(
'single_archive' => __( 'Single posts + Archive pages &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'single' => __( 'Single posts', 'evolve' ),
'disable' => __( 'Disable', 'evolve' )
));

$options['evl_share_this'] = array( "name" => __( '\'Share This\' buttons placement', 'evolve' ),
"desc" => __( 'Choose placement of the \'Share This\' buttons', 'evolve' ),
"id" => $evlshortname."_share_this",
"type" => "select",
"std" => "single",
"options" => array(
'single' => __( 'Single posts &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'single_archive' => __( 'Single posts + Archive pages', 'evolve' ),
'all' => __( 'All pages', 'evolve' ),
'disable' => __( 'Disable', 'evolve' )
));

$options['evl_post_links'] = array( "name" => __( 'Position of previous/next posts links', 'evolve' ),
"desc" => __( 'Choose the position of the <strong>Previous/Next Post</strong> links', 'evolve' ),
"id" => $evlshortname."_post_links",
"type" => "select",
"std" => "after",
"options" => array(
'after' => __( 'After posts &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'before' => __( 'Before posts', 'evolve' ),
'both' => __( 'Both', 'evolve' )
));

$options['evl_similar_posts'] = array( "name" => __( 'Display Similar posts', 'evolve' ),
"desc" => __( 'Choose if you want to display <strong>Similar posts</strong> in articles', 'evolve' ),
"id" => $evlshortname."_similar_posts",
"type" => "select",
"std" => "disable",
"options" => array(
'disable' => __( 'Disable &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'category' => __( 'Match by categories', 'evolve' ),
'tag' => __( 'Match by tags', 'evolve' )
));

$options[] = array( "name" => $evlshortname."-tab-2", "id" => $evlshortname."-tab-2",
"type" => "close-tab" );


// Subscribe buttons

$options[] = array( "name" => $evlshortname."-tab-3", "id" => $evlshortname."-tab-3",
"type" => "open-tab");


$options['evl_social_links'] = array( "name" => __( 'Enable Subscribe/Social links in header', 'evolve' ),
"desc" => __( 'Check this box if you want to display Subscribe/Social links in header', 'evolve' ),
"id" => $evlshortname."_social_links",
"type" => "checkbox",
"std" => "1");

$options['evl_social_color_scheme'] = array( "name" => __( 'Subscribe/Social icons color', 'evolve' ),
"desc" => __( 'Choose the color scheme of subscribe/social icons', 'evolve' ),
"id" => $evlshortname."_social_color_scheme",
"type" => "color",
"std" => "#999999"
);

$options['evl_social_icons_size'] = array( "name" => __( 'Subscribe/Social icons size', 'evolve' ),
"desc" => __( 'Choose the size of subscribe/social icons', 'evolve' ),
"id" => $evlshortname."_social_icons_size",
"type" => "select",
"std" => "normal",
"options" => array(
'normal' => __( 'Normal &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'small' => __( 'Small', 'evolve' ),
'large' => __( 'Large', 'evolve' ),
'x-large' => __( 'X-Large', 'evolve' )
));

// RSS Feed  

$options['evl_show_rss'] = array( "name" => "Enable RSS Feed",
"desc" => "Check this box to enable RSS Feed",
"id" => $evlshortname."_show_rss",
"type" => "checkbox",
"std" => "1");     

$options['evl_rss_feed'] = array( "name" => __( 'RSS Feed', 'evolve' ),
"desc" => __( 'Insert custom RSS Feed URL, e.g. <strong>http://feeds.feedburner.com/Example</strong>', 'evolve' ),
"id" => $evlshortname."_rss_feed",
"type" => "text",
"class" => "hidden",
"std" => "");

// Newsletter

$options['evl_newsletter'] = array( "name" => __( 'Newsletter', 'evolve' ),
"desc" => __( 'Insert custom newsletter URL, e.g. <strong>http://feedburner.google.com/fb/a/mailverify?uri=Example&amp;loc=en_US</strong>', 'evolve' ),
"id" => $evlshortname."_newsletter",
"type" => "text",
"std" => "");

// Facebook

$options['evl_facebook'] = array( "name" => __( 'Facebook', 'evolve' ),
"desc" => __( 'Insert your Facebook URL', 'evolve' ),
"id" => $evlshortname."_facebook",
"type" => "text",
"std" => "");

// Twitter

$options['evl_twitter_id'] = array( "name" => __( 'Twitter', 'evolve' ),
"desc" => __( 'Insert your Twitter URL', 'evolve' ),
"id" => $evlshortname."_twitter_id",
"type" => "text",
"std" => "");


// Instagram

$options['evl_instagram'] = array( "name" => __( 'Instagram', 'evolve' ),
"desc" => __( 'Insert your Instagram URL', 'evolve' ),
"id" => $evlshortname."_instagram",
"type" => "text",
"std" => "");

// Skype

$options['evl_skype'] = array( "name" => __( 'Skype', 'evolve' ),
"desc" => __( 'Insert your Skype ID', 'evolve' ),
"id" => $evlshortname."_skype",
"type" => "text",
"std" => "");

// YouTube

$options['evl_youtube'] = array( "name" => __( 'YouTube', 'evolve' ),
"desc" => __( 'Insert your YouTube URL', 'evolve' ),
"id" => $evlshortname."_youtube",
"type" => "text",
"std" => "");

// Flickr

$options['evl_flickr'] = array( "name" => __( 'Flickr', 'evolve' ),
"desc" => __( 'Insert your Flickr URL', 'evolve' ),
"id" => $evlshortname."_flickr",
"type" => "text",
"std" => "");

// LinkedIn

$options['evl_linkedin'] = array( "name" => __( 'LinkedIn', 'evolve' ),
"desc" => __( 'Insert your LinkedIn profile URL', 'evolve' ),
"id" => $evlshortname."_linkedin",
"type" => "text",
"std" => "");

// Google Plus

$options['evl_googleplus'] = array( "name" => __( 'Google Plus', 'evolve' ),
"desc" => __( 'Insert your Google Plus profile URL', 'evolve' ),
"id" => $evlshortname."_googleplus",
"type" => "text",
"std" => "");

// Pinterest

$options['evl_pinterest'] = array( "name" => __( 'Pinterest', 'evolve' ),
"desc" => __( 'Insert your Pinterest profile URL', 'evolve' ),
"id" => $evlshortname."_pinterest",
"type" => "text",
"std" => "");

$options[] = array( "name" => $evlshortname."-tab-3", "id" => $evlshortname."-tab-3",
"type" => "close-tab" );


// Header content

$options[] = array( "name" => $evlshortname."-tab-4", "id" => $evlshortname."-tab-4",
"type" => "open-tab");


$options['evl_header_logo'] = array( "name" => __( 'Custom logo', 'evolve' ),
"desc" => __( 'Upload a logo for your theme, or specify an image URL directly.', 'evolve' ),
"id" => $evlshortname."_header_logo",
"type" => "upload",
"std" => "");

$options['evl_pos_logo'] = array( "name" => __( 'Logo position', 'evolve' ),
"desc" => __( 'Choose the position of your custom logo', 'evolve' ),
"id" => $evlshortname."_pos_logo",
"type" => "select",
"std" => "left",
"options" => array(
'left' => __( 'Left &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'right' => __( 'Right', 'evolve' ),
'disable' => __( 'Disable', 'evolve' )
));

$options['evl_blog_title'] = array( "name" => __( 'Disable Blog Title', 'evolve' ),
"desc" => __( 'Check this box if you don\'t want to display title of your blog', 'evolve' ),
"id" => $evlshortname."_blog_title",
"type" => "checkbox",
"std" => "0");

$options['evl_tagline_pos'] = array( "name" => __( 'Blog Tagline position', 'evolve' ),
"desc" => __( 'Choose the position of blog tagline', 'evolve' ),
"id" => $evlshortname."_tagline_pos",
"type" => "select",
"std" => "next",
"options" => array(
'next' => __( 'Next to blog title &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'above' => __( 'Above blog title', 'evolve' ),
'under' => __( 'Under blog title', 'evolve' ),
'disable' => __( 'Disable', 'evolve' )
));

$options['evl_main_menu'] = array( "name" => __( 'Disable main menu', 'evolve' ),
"desc" => __( 'Check this box if you don\'t want to display main menu', 'evolve' ),
"id" => $evlshortname."_main_menu",
"type" => "checkbox",
"std" => "0");
    
$options['evl_main_menu_hover_effect'] = array( "name" => __( 'Disable main menu Hover Effect', 'evolve' ),
"desc" => __( 'Check this box if you don\'t want to display main menu hover effect', 'evolve' ),
"id" => $evlshortname."_main_menu_hover_effect",
"type" => "checkbox",
"std" => "0");
    
    

$options['evl_sticky_header'] = array( "name" => __( 'Enable sticky header', 'evolve' ),
"desc" => __( 'Check this box if you want to display sticky header', 'evolve' ),
"id" => $evlshortname."_sticky_header",
"type" => "checkbox",
"std" => "1");

$options['evl_searchbox'] = array( "name" => __( 'Enable searchbox in main menu', 'evolve' ),
"desc" => __( 'Check this box if you want to display searchbox in main menu', 'evolve' ),
"id" => $evlshortname."_searchbox",
"type" => "checkbox",
"std" => "1");

$options['evl_widgets_header'] = array( "name" => __( 'Number of widget cols in header', 'evolve' ),
"desc" => __( 'Select how many header widget areas you want to display.', 'evolve' ),
"id" => $evlshortname."_widgets_header",
"type" => "images",
"std" => "disable",
"options" => array(
'disable' => $imagepath . '1c.png',
'one' => $imagepath . 'header-widgets-1.png',
'two' => $imagepath . 'header-widgets-2.png',
'three' => $imagepath . 'header-widgets-3.png',
'four' => $imagepath . 'header-widgets-4.png',
));

$options['evl_header_widgets_placement'] = array(
"name" => __( 'Header widgets placement', 'evolve' ),
"desc" => __( 'Choose where to display header widgets', 'evolve' ),
"id" => $evlshortname."_header_widgets_placement",
"std" => "home",
"type" => "select",
"options" => array(
'home' => __( 'Home page &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'single' => __( 'Single Post', 'evolve' ),
'page' => __( 'Pages', 'evolve' ),
'all' => __( 'All pages', 'evolve' )
)
);

$options[] = array( "name" => $evlshortname."-tab-4", "id" => $evlshortname."-tab-4",
"type" => "close-tab" );


// Footer content

$options[] = array( "name" => $evlshortname."-tab-5", "id" => $evlshortname."-tab-5",
"type" => "open-tab");

$options['evl_widgets_num'] = array( "name" => __( 'Number of widget cols in footer', 'evolve' ),
"desc" => __( 'Select how many footer widget areas you want to display.', 'evolve' ),
"id" => $evlshortname."_widgets_num",
"type" => "images",
"std" => "disable",
"options" => array(
'disable' => $imagepath . '1c.png',
'one' => $imagepath . 'footer-widgets-1.png',
'two' => $imagepath . 'footer-widgets-2.png',
'three' => $imagepath . 'footer-widgets-3.png',
'four' => $imagepath . 'footer-widgets-4.png',
));

$options['evl_footer_content'] = array( "name" => __( 'Custom footer', 'evolve' ),
"desc" => __( 'Available <strong>HTML</strong> tags and attributes:<br /><br /> <code> &lt;b&gt; &lt;i&gt; &lt;a href="" title=""&gt; &lt;blockquote&gt; &lt;del datetime=""&gt; <br /> &lt;ins datetime=""&gt; &lt;img src="" alt="" /&gt; &lt;ul&gt; &lt;ol&gt; &lt;li&gt; <br /> &lt;code&gt; &lt;em&gt; &lt;strong&gt; &lt;div&gt; &lt;span&gt; &lt;h1&gt; &lt;h2&gt; &lt;h3&gt; &lt;h4&gt; &lt;h5&gt; &lt;h6&gt; <br /> &lt;table&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td&gt; &lt;br /&gt; &lt;hr /&gt;</code>', 'evolve' ),
"id" => $evlshortname."_footer_content",
"type" => "textarea",
"std" => "<p id=\"copyright\"><span class=\"credits\"><a href=\"http://theme4press.com/evolve-multipurpose-wordpress-theme/\">evolve</a> theme by Theme4Press&nbsp;&nbsp;&bull;&nbsp;&nbsp;Powered by <a href=\"http://wordpress.org\">WordPress</a></span></p>"
); 

$options[] = array( "name" => $evlshortname."-tab-5", "id" => $evlshortname."-tab-5",
"type" => "close-tab" );


// Typography

$options[] = array( "id" => $evlshortname."-tab-6",
"type" => "open-tab");

$options['evl_title_font'] = array( "name" => __( 'Blog Title font', 'evolve' ),
"desc" => __( 'Select the typography you want for your blog title. * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_title_font",
"type" => "typography",
"std" => array('size' => '39px', 'face' => 'Roboto','style' => 'bold','color' => '')
);

$options['evl_tagline_font'] = array( "name" => __( 'Blog tagline font', 'evolve' ),
"desc" => __( 'Select the typography you want for your blog tagline. * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_tagline_font",
"type" => "typography",
"std" => array('size' => '13px', 'face' => 'Roboto','style' => 'normal','color' => '')
);

$options['evl_menu_font'] = array( "name" => __( 'Main menu font', 'evolve' ),
"desc" => __( 'Select the typography you want for your main menu. * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_menu_font",
"type" => "typography",
"std" => array('size' => '14px', 'face' => 'Roboto','style' => 'normal','color' => '')
);

$options['evl_post_font'] = array( "name" => __( 'Post title font', 'evolve' ),
"desc" => __( 'Select the typography you want for your post titles. * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_post_font",
"type" => "typography",
"std" => array('size' => '28px', 'face' => 'Roboto','style' => 'normal','color' => '')
);

$options['evl_content_font'] = array( "name" => __( 'Content font', 'evolve' ),
"desc" => __( 'Select the typography you want for your blog content. * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_content_font",
"type" => "typography",
"std" => array('size' => '16px', 'face' => 'Roboto','style' => 'normal','color' => '')
);

$options['evl_heading_font'] = array( "name" => __( 'Headings font', 'evolve' ),
"desc" => __( 'Select the typography you want for your blog headings (H1, H2, H3, H4, H5, H6). * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_heading_font",
"type" => "typography",
"std" => array('size' => 'none', 'face' => 'Roboto','style' => 'normal','color' => '')
);

$options[] = array( "name" => $evlshortname."-tab-6", "id" => $evlshortname."-tab-6",
"type" => "close-tab" );


// Extra Options

$options[] = array( "id" => $evlshortname."-tab-7",
"type" => "open-tab");

$options['evl_breadcrumbs'] = array( "name" => "Enable Breadcrumbs Navigation",
"desc" => "Check this box if you want to enable breadcrumbs navigation",
"id" => $evlshortname."_breadcrumbs",
"type" => "checkbox",
"std" => "1");

$options['evl_nav_links'] = array( "name" => __( 'Position of navigation links', 'evolve' ),
"desc" => __( 'Choose the position of the <strong>Older/Newer Posts</strong> links', 'evolve' ),
"id" => $evlshortname."_nav_links",
"type" => "select",
"std" => "after",
"options" => array(
'after' => __( 'After posts &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'before' => __( 'Before posts', 'evolve' ),
'both' => __( 'Both', 'evolve' )
));

$options['evl_pos_button'] = array( "name" => __( 'Position of \'Back to Top\' button', 'evolve' ),
"desc" => "",
"id" => $evlshortname."_pos_button",
"type" => "select",
"std" => "right",
"options" => array(
'disable' => __( 'Disable', 'evolve' ),
'left' => __( 'Left', 'evolve' ),
'right' => __( 'Right &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'middle' => __( 'Middle', 'evolve' )
));

$options['evl_parallax_slider_support'] = array( "name" => __( 'Enable Parallax Slider support', 'evolve' ),
"desc" => __( 'Check this box if you want to enable Parallax Slider support', 'evolve' ),
"id" => $evlshortname."_parallax_slider_support",
"type" => "checkbox",
"std" => "1");

$options['evl_carousel_slider'] = array( "name" => __( 'Enable Carousel Slider support', 'evolve' ),
"desc" => __( 'Check this box if you want to enable Carousel Slider support', 'evolve' ),
"id" => $evlshortname."_carousel_slider",
"type" => "checkbox",
"std" => "1");

$options['evl_status_gmap'] = array( "name" => __( 'Enable Google Map Scripts', 'evolve' ),
"desc" => __( 'Check this box if you want to enable Google Map Scripts', 'evolve' ),
"id" => $evlshortname."_status_gmap",
"type" => "checkbox",
"std" => "1");

$options['evl_animatecss'] = array( "name" => __( 'Enable Animate.css plugin support', 'evolve' ),
"desc" => __( 'Check this box if you want to enable Animate.css plugin support - (menu hover effect, featured image hover effect, button hover effect, etc.)', 'evolve' ),
"id" => $evlshortname."_animatecss",
"type" => "checkbox",
"std" => "1");

$options[] = array( "name" => $evlshortname."-tab-7", "id" => $evlshortname."-tab-7",
"type" => "close-tab" );


// General Styling


$options[] = array( "name" => $evlshortname."-tab-10", "id" => $evlshortname."-tab-10",
"type" => "open-tab");


$options['evl_content_back'] = array( "name" => "Content color",
"desc" => "Background color of content",
"id" => $evlshortname."_content_back",
"type" => "select",
"std" => "light",
"options" => array(
'light' => __( 'Light', 'evolve' ),
'dark' => __( 'Dark', 'evolve' )
));

$options['evl_menu_back'] = array( "name" => "Menu color",
"desc" => "Background color of main menu",
"id" => $evlshortname."_menu_back",
"type" => "select",
"std" => "light",
"options" => array(
'light' => __( 'Light', 'evolve' ),
'dark' => __( 'Dark', 'evolve' )
));


$options['evl_menu_back_color'] = array( "name" => "Or custom menu color",
"desc" => "Custom background color of main menu. <strong>Dark menu must be enabled.</strong>",
"id" => $evlshortname."_menu_back_color",
"type" => "color",
"std" => ""
);

$options['evl_disable_menu_back'] = array( "name" => "Disable Menu Background",
"desc" => "Check this box if you want to disable menu background",
"id" => $evlshortname."_disable_menu_back",
"type" => "checkbox",
"std" => "0");

$options['evl_header_footer_back_color'] = array( "name" => "Header and Footer color",
"desc" => "Custom background color of header and footer",
"id" => $evlshortname."_header_footer_back_color",
"type" => "color",
"std" => ""
);

$options['evl_pattern'] = array( "name" => __( 'Header and Footer pattern', 'evolve' ),
"desc" => __( 'Choose the pattern for header and footer background', 'evolve' ),
"id" => $evlshortname."_pattern",
"type" => "images",
"std" => "pattern_8.png",
"options" => array(
'none' => $imagepathfolder . '/header-two/none.jpg',
'pattern_1.png' => $imagepathfolder . '/pattern/pattern_1_thumb.png',
'pattern_2.png' => $imagepathfolder . '/pattern/pattern_2_thumb.png',
'pattern_3.png' => $imagepathfolder . '/pattern/pattern_3_thumb.png',
'pattern_4.png' => $imagepathfolder . '/pattern/pattern_4_thumb.png',
'pattern_5.png' => $imagepathfolder . '/pattern/pattern_5_thumb.png',
'pattern_6.png' => $imagepathfolder . '/pattern/pattern_6_thumb.png',
'pattern_7.png' => $imagepathfolder . '/pattern/pattern_7_thumb.png',
'pattern_8.png' => $imagepathfolder . '/pattern/pattern_8_thumb.png'
));


$options['evl_scheme_widgets'] = array( "name" => __( 'Color scheme of the slideshow and widgets area', 'evolve' ),
"desc" => __( 'Choose the color scheme for the area below header menu', 'evolve' ),
"id" => $evlshortname."_scheme_widgets",
"type" => "color",
"std" => "#595959"
);

$options['evl_scheme_background'] = array( "name" => __( 'Background Image of the slideshow and widgets area', 'evolve' ),
"desc" => __( 'Upload an image for the area below header menu', 'evolve' ),
"id" => $evlshortname."_scheme_background",
"type" => "upload",
"std" => '',
);

$options['evl_scheme_background_100'] = array( "name" => __( '100% Background Image', 'evolve' ),
"desc" => "Have background image always at 100% in width and height and scale according to the browser size.",
"id" => $evlshortname."_scheme_background_100",
"type" => "checkbox",
"std" => "0");

$options['evl_scheme_background_repeat'] = array( "name" => __( 'Background Repeat', 'evolve' ),
"desc" => "",
"id" => $evlshortname."_scheme_background_repeat",
"type" => "select",
"std" => "no-repeat",
"options" => array(
'repeat' => __( 'repeat', 'evolve' ),
'repeat-x' => __( 'repeat-x', 'evolve' ),
'repeat-y' => __( 'repeat-y', 'evolve' ),
'no-repeat' => __( 'no-repeat &nbsp;&nbsp;&nbsp;(default)', 'evolve' )
));

$options['evl_general_link'] = array( "name" => __( 'General Link Color', 'evolve' ),
"desc" => __( 'Custom color for links', 'evolve' ),
"id" => $evlshortname."_general_link",
"type" => "color",
"std" => "#7a9cad"
);

$options['evl_button_1'] = array( "name" => "Buttons 1 Color",
"desc" => "Custom color for buttons: Read more, Reply",
"id" => $evlshortname."_button_1",
"type" => "color",
"std" => ""
);

$options['evl_button_2'] = array( "name" => "Buttons 2 Color",
"desc" => "Custom color for buttons: Post Comment, Submit",
"id" => $evlshortname."_button_2",
"type" => "color",
"std" => ""
);

$options['evl_widget_background'] = array( "name" => "Enable Widget Title Black Background",
"desc" => "Check this box if you want to enable black background for widget titles",
"id" => $evlshortname."_widget_background",
"type" => "checkbox",
"std" => "0");

$options['evl_widget_background_image'] = array( "name" => "Disable Widget Background",
"desc" => "Check this box if you want to disable widget background",
"id" => $evlshortname."_widget_background_image",
"type" => "checkbox",
"std" => "0");

$options[] = array( "name" => $evlshortname."-tab-10", "id" => $evlshortname."-tab-10",
"type" => "close-tab" );


// Custom CSS

$options[] = array( "id" => $evlshortname."-tab-11",
"type" => "open-tab");

$options['evl_css_content'] = array( "name" => "Custom CSS",
"desc" => '<strong>For advanced users only</strong>: insert custom CSS, default <a href="'.$template_url.'/style.css" target="_blank">style.css</a> file',
"id" => $evlshortname."_css_content",
"type" => "textarea",
"std" => "");

$options[] = array( "name" => $evlshortname."-tab-11", "id" => $evlshortname."-tab-11",
"type" => "close-tab" );


// Parallax Slider

$options[] = array( "id" => $evlshortname."-tab-8",
"type" => "open-tab");


$options['evl_parallax_slider'] = array( "name" => __( 'Parallax Slider placement', 'evolve' ),
"desc" => __( 'Display Parallax Slider on the homepage, all pages or select the slider in the post/page edit mode.', 'evolve' ),
"id" => $evlshortname."_parallax_slider",
"type" => "select",
"std" => "post",
"options" => array(
'homepage' => __( 'Homepage only', 'evolve' ),
'post' => __( 'Manually select in a Post/Page edit mode &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'all' => __( 'All pages', 'evolve' )
));

$options['evl_parallax_speed'] = array( "name" => "Parallax Speed",
"desc" => 'Input the time between transitions (Default: 4000);',
"id" => $evlshortname."_parallax_speed",
"type" => "text",
"std" => "4000");

$options['evl_parallax_slide_title_font'] = array( "name" => __( 'Slider Title font', 'evolve' ),
"desc" => __( 'Select the typography you want for the slide title. * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_parallax_slide_title_font",
"type" => "typography",
"std" => array('size' => '36px', 'face' => 'Roboto','style' => 'normal','color' => '')
);

$options['evl_parallax_slide_desc_font'] = array( "name" => __( 'Slider Description font', 'evolve' ),
"desc" => __( 'Select the typography you want for the slide description. * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_parallax_slide_desc_font",
"type" => "typography",
"std" => array('size' => '18px', 'face' => 'Roboto','style' => 'normal','color' => '')
);

$options['evl_show_slide1'] = array( "name" => "Enable Slide 1",
"desc" => "Check this box to enable Slide 1",
"id" => $evlshortname."_show_slide1",
"type" => "checkbox",
"std" => "1");

$options['evl_slide1_img'] = array( "name" => __( 'Slide 1 Image', 'evolve' ),
"desc" => __( 'Upload an image for the Slide 1, or specify an image URL directly.', 'evolve' ),
"id" => $evlshortname."_slide1_img",
"type" => "upload",
"class" => "hidden",
"std" => $imagepathfolder . 'parallax/6.png');

$options['evl_slide1_title'] = array( "name" => "Slide 1 Title",
"desc" => '',
"id" => $evlshortname."_slide1_title",
"type" => "text",
"class" => "hidden",
"std" => __( 'Super Awesome WP Theme', 'evolve' ));

$options['evl_slide1_desc'] = array( "name" => "Slide 1 Description",
"desc" => '',
"id" => $evlshortname."_slide1_desc",
"type" => "textarea",
"class" => "hidden",
"std" => __( 'Absolutely free of cost theme with amazing design and premium features which will impress your visitors', 'evolve' ));

$options['evl_slide1_button'] = array( "name" => "Slide 1 Button",
"desc" => '',
"id" => $evlshortname."_slide1_button",
"type" => "textarea",
"class" => "hidden",
"std" => __( '<a class="da-link" href="#">Learn more</a>', 'evolve' ));

$options['evl_show_slide2'] = array( "name" => "Enable Slide 2",
"desc" => "Check this box to enable Slide 2",
"id" => $evlshortname."_show_slide2",
"type" => "checkbox",
"std" => "1");

$options['evl_slide2_img'] = array( "name" => __( 'Slide 2 Image', 'evolve' ),
"desc" => __( 'Upload an image for the Slide 2, or specify an image URL directly.', 'evolve' ),
"id" => $evlshortname."_slide2_img",
"type" => "upload",
"class" => "hidden",
"std" => $imagepathfolder . 'parallax/5.png');

$options['evl_slide2_title'] = array( "name" => "Slide 2 Title",
"desc" => '',
"id" => $evlshortname."_slide2_title",
"type" => "text",
"class" => "hidden",
"std" => __( 'Bootstrap and Font Awesome Ready', 'evolve' ));

$options['evl_slide2_desc'] = array( "name" => "Slide 2 Description",
"desc" => '',
"id" => $evlshortname."_slide2_desc",
"type" => "textarea",
"class" => "hidden",
"std" => __( 'Built-in Bootstrap Elements and Font Awesome let you do amazing things with your website', 'evolve' ));

$options['evl_slide2_button'] = array( "name" => "Slide 2 Button",
"desc" => '',
"id" => $evlshortname."_slide2_button",
"type" => "textarea",
"class" => "hidden",
"std" => __( '<a class="da-link" href="#">Learn more</a>', 'evolve' ));

$options['evl_show_slide3'] = array( "name" => "Enable Slide 3",
"desc" => "Check this box to enable Slide 3",
"id" => $evlshortname."_show_slide3",
"type" => "checkbox",
"std" => "1");

$options['evl_slide3_img'] = array( "name" => __( 'Slide 3 Image', 'evolve' ),
"desc" => __( 'Upload an image for the Slide 3, or specify an image URL directly.', 'evolve' ),
"id" => $evlshortname."_slide3_img",
"type" => "upload",
"class" => "hidden",
"std" => $imagepathfolder . 'parallax/4.png');

$options['evl_slide3_title'] = array( "name" => "Slide 3 Title",
"desc" => '',
"id" => $evlshortname."_slide3_title",
"type" => "text",
"class" => "hidden",
"std" => __( 'Easy to use control panel', 'evolve' ));

$options['evl_slide3_desc'] = array( "name" => "Slide 3 Description",
"desc" => '',
"id" => $evlshortname."_slide3_desc",
"type" => "textarea",
"class" => "hidden",
"std" => __( 'Select of 500+ Google Fonts, choose layout as you need, set up your social links', 'evolve' ));

$options['evl_slide3_button'] = array( "name" => "Slide 3 Button",
"desc" => '',
"id" => $evlshortname."_slide3_button",
"type" => "textarea",
"class" => "hidden",
"std" => __( '<a class="da-link" href="#">Learn more</a>', 'evolve' ));

$options['evl_show_slide4'] = array( "name" => "Enable Slide 4",
"desc" => "Check this box to enable Slide 4",
"id" => $evlshortname."_show_slide4",
"type" => "checkbox",
"std" => "1");

$options['evl_slide4_img'] = array( "name" => __( 'Slide 4 Image', 'evolve' ),
"desc" => __( 'Upload an image for the Slide 4, or specify an image URL directly.', 'evolve' ),
"id" => $evlshortname."_slide4_img",
"type" => "upload",
"class" => "hidden",
"std" => $imagepathfolder . 'parallax/1.png');

$options['evl_slide4_title'] = array( "name" => "Slide 4 Title",
"desc" => '',
"id" => $evlshortname."_slide4_title",
"type" => "text",
"class" => "hidden",
"std" => __( 'Fully responsive theme', 'evolve' ));

$options['evl_slide4_desc'] = array( "name" => "Slide 4 Description",
"desc" => '',
"id" => $evlshortname."_slide4_desc",
"type" => "textarea",
"class" => "hidden",
"std" => __( 'Adaptive to any screen depending on the device being used to view the site', 'evolve' ));

$options['evl_slide4_button'] = array( "name" => "Slide 4 Button",
"desc" => '',
"id" => $evlshortname."_slide4_button",
"type" => "textarea",
"class" => "hidden",
"std" => __( '<a class="da-link" href="#">Learn more</a>', 'evolve' ));

$options['evl_show_slide5'] = array( "name" => "Enable Slide 5",
"desc" => "Check this box to enable Slide 5",
"id" => $evlshortname."_show_slide5",
"type" => "checkbox",
"std" => "1");

$options['evl_slide5_img'] = array( "name" => __( 'Slide 5 Image', 'evolve' ),
"desc" => __( 'Upload an image for the Slide 5, or specify an image URL directly.', 'evolve' ),
"id" => $evlshortname."_slide5_img",
"type" => "upload",
"class" => "hidden",
"std" => $imagepathfolder . 'parallax/3.png');

$options['evl_slide5_title'] = array( "name" => "Slide 5 Title",
"desc" => '',
"id" => $evlshortname."_slide5_title",
"type" => "text",
"class" => "hidden",
"std" => __( 'Unlimited color schemes', 'evolve' ));

$options['evl_slide5_desc'] = array( "name" => "Slide 5 Description",
"desc" => '',
"id" => $evlshortname."_slide5_desc",
"type" => "textarea",
"class" => "hidden",
"std" => __( 'Upload your own logo, change background color or images, select links color which you love - it\'s limitless', 'evolve' ));

$options['evl_slide5_button'] = array( "name" => "Slide 5 Button",
"desc" => '',
"id" => $evlshortname."_slide5_button",
"type" => "textarea",
"class" => "hidden",
"std" => __( '<a class="da-link" href="#">Learn more</a>', 'evolve' ));


$options[] = array( "name" => $evlshortname."-tab-8", "id" => $evlshortname."-tab-8",
"type" => "close-tab" );


// Posts Slider

$options[] = array( "id" => $evlshortname."-tab-9",
"type" => "open-tab");

$options['evl_posts_slider'] = array( "name" => __( 'Posts Slider placement', 'evolve' ),
"desc" => __( 'Display Posts Slider on the homepage, all pages or select the slider in the post/page edit mode.', 'evolve' ),
"id" => $evlshortname."_posts_slider",
"type" => "select",
"std" => "post",
"options" => array(
'homepage' => __( 'Homepage only', 'evolve' ),
'post' => __( 'Manually select in a Post/Page edit mode &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'all' => __( 'All pages', 'evolve' )
));

$options['evl_posts_number'] = array( "name" => __( 'Number of posts to display', 'evolve' ),
"desc" => "",
"id" => $evlshortname."_posts_number",
"type" => "select",
"std" => "5",
"options" => array(
'1' => __( '1', 'evolve' ),
'2' => __( '2', 'evolve' ),
'3' => __( '3', 'evolve' ),
'4' => __( '4', 'evolve' ),
'5' => __( '5 &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'6' => __( '6', 'evolve' ),
'7' => __( '7', 'evolve' ),
'8' => __( '8', 'evolve' ),
'9' => __( '9', 'evolve' ),
'10' => __( '10', 'evolve' ),
));

$options['evl_posts_slider_content'] = array( "name" => __( 'Slideshow content', 'evolve' ),
"desc" => __( 'Choose to display latest posts or posts of a category.', 'evolve' ),
"id" => $evlshortname."_posts_slider_content",
"type" => "select",
"std" => "recent",
"options" => array(
'recent' => __( 'Recent posts &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'category' => __( 'Posts in category', 'evolve' )
));

$options['evl_posts_slider_id'] = array( "name" => __( 'Category ID(s)', 'evolve' ),
"desc" => __( 'Enter category ID(s) of posts separated by commas, e.g. 1,6,59,86. <strong>Posts in category</strong> option must be enabled', 'evolve' ),
"id" => $evlshortname."_posts_slider_id",
"type" => "text",
"std" => ""
);

$options['evl_carousel_speed'] = array( "name" => "Slider Speed",
"desc" => 'Input the time between transitions (Default: 3500);',
"id" => $evlshortname."_carousel_speed",
"type" => "text",
"std" => "7000");

$options['evl_carousel_slide_title_font'] = array( "name" => __( 'Slider Title font', 'evolve' ),
"desc" => __( 'Select the typography you want for the slide title. * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_carousel_slide_title_font",
"type" => "typography",
"std" => array('size' => '36px', 'face' => 'Roboto','style' => 'normal','color' => '')
);

$options['evl_carousel_slide_desc_font'] = array( "name" => __( 'Slider Description font', 'evolve' ),
"desc" => __( 'Select the typography you want for the slide description. * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_carousel_slide_desc_font",
"type" => "typography",
"std" => array('size' => '18px', 'face' => 'Roboto','style' => 'normal','color' => '')
);

$options[] = array( "name" => $evlshortname."-tab-9", "id" => $evlshortname."-tab-9",
"type" => "close-tab" );

// Back Up Options

$options[] = array( "id" => $evlshortname."-tab-12",
"type" => "open-tab");

$options[] = array( "name" => __( 'Backup Options', 'evolve' ),
"type" => "backup",
"id" => $evlshortname."_backup"
);

$options[] = array( "name" => $evlshortname."-tab-12", "id" => $evlshortname."-tab-12",
"type" => "close-tab" );


// Contact Options

$options[] = array( "id" => $evlshortname."-tab-13",
"type" => "open-tab");

$options['evl_gmap_type'] = array( "name" => "Google Map Type",
"desc" => "Select the type of google map to show on the contact page.",
"id" => $evlshortname."_gmap_type",
"std" => "hybrid",
"options" => array('roadmap' => 'roadmap', 'satellite' => 'satellite', 'hybrid' => 'hybrid &nbsp;&nbsp;&nbsp;(default)', 'terrain' => 'terrain'),
"type" => "select");

$options['evl_gmap_width'] = array( "name" => "Google Map Width",
"desc" => "(in pixels or percentage, e.g.:100% or 100px)",
"id" => $evlshortname."_gmap_width",
"std" => "100%",
"type" => "text");

$options['evl_gmap_height'] = array( "name" => "Google Map Height",
"desc" => "(in pixels, e.g.: 100px)",
"id" => $evlshortname."_gmap_height",
"std" => "415px",
"type" => "text");

$options['evl_gmap_address'] = array( "name" => "Google Map Address",
"desc" => "Example: 775 New York Ave, Brooklyn, Kings, New York 11203.<br /> For multiple markers, separate the addresses with the | symbol. ex: Address 1|Address 2|Address 3.",
"id" => $evlshortname."_gmap_address",
"std" => "Via dei Fori Imperiali",
"type" => "text");

$options['evl_sent_email_header'] = array( "name" => "Sent Email Header (From)", 
"desc" => "Insert name of header which will be in the header of sent email.", 
"id" => $evlshortname."_sent_email_header", 
"std" => get_bloginfo('name'), 
"type" => "text"); 

$options['evl_email_address'] = array( "name" => "Email Address",
"desc" => "Enter the email adress the form will be sent to.",
"id" => $evlshortname."_email_address",
"std" => "",
"type" => "text");

$options['evl_map_zoom_level'] = array( "name" => "Map Zoom Level",
"desc" => "Higher number will be more zoomed in.",
"id" => $evlshortname."_map_zoom_level",
"std" => "18",
"type" => "text");

$options['evl_map_pin'] = array( "name" => "Hide Address Pin",
"desc" => "Check the box to hide the address pin.",
"id" => $evlshortname."_map_pin",
"std" => 0,
"type" => "checkbox");

$options['evl_map_popup'] = array( "name" => "Show Map Popup On Click",
"desc" => "Check the box to keep the popup graphic with address info hidden when the google map loads. It will only show when the pin on the map is clicked.",
"id" => $evlshortname."_map_popup",
"std" => 0,
"type" => "checkbox");

$options['evl_map_scrollwheel'] = array( "name" => "Disable Map Scrollwheel",
"desc" => "Check the box to disable scrollwheel on google maps.",
"id" => $evlshortname."_map_scrollwheel",
"std" => 0,
"type" => "checkbox");

$options['evl_map_scale'] = array( "name" => "Disable Map Scale",
"desc" => "Check the box to disable scale on google maps.",
"id" => $evlshortname."_map_scale",
"std" => 0,
"type" => "checkbox");

$options['evl_map_zoomcontrol'] = array( "name" => "Disable Map Zoom & Pan Control Icons",
"desc" => "Check the box to disable zoom control icon and pan control icon on google maps.",
"id" => $evlshortname."_map_zoomcontrol",
"std" => 0,
"type" => "checkbox");

if (!function_exists('recaptcha_get_html')) {

$options[] = array( "name" => "Required Captcha Plugin",
"desc" => "Please install <a href='http://wordpress.org/plugins/wp-recaptcha/'>WP-reCAPTCHA</a> plugin to enable spam protection on the contact page.",
"id" => $evlshortname."_captcha_plugin",
"std" => 0,
"type" => "info");
}

$options[] = array( "name" => "Recaptcha Public Key",
"desc" => "Follow the steps in our docs to get your key",
"id" => $evlshortname."_recaptcha_public",
"std" => "",
"type" => "text");

$options[] = array( "name" => "Recaptcha Private Key",
"desc" => "Follow the steps in our docs to get your key",
"id" => $evlshortname."_recaptcha_private",
"std" => "",
"type" => "text");

$options[] = array( "name" => $evlshortname."-tab-13", "id" => $evlshortname."-tab-13",
"type" => "close-tab" );


// Bootstrap Slider

$options[] = array( "id" => $evlshortname."-tab-14",
"type" => "open-tab");

$options['evl_bootstrap_slider'] = array( "name" => __( 'Bootstrap Slider placement', 'evolve' ),
"desc" => __( 'Display Bootstrap Slider on the homepage, all pages or select the slider in the post/page edit mode.', 'evolve' ),
"id" => $evlshortname."_bootstrap_slider",
"type" => "select",
"std" => "homepage",
"options" => array(
'homepage' => __( 'Homepage only &nbsp;&nbsp;&nbsp;(default)', 'evolve' ),
'post' => __( 'Manually select in a Post/Page edit mode', 'evolve' ),
'all' => __( 'All pages', 'evolve' )
));

$options['evl_bootstrap_speed'] = array( "name" => "Speed",
"desc" => 'Input the time between transitions (Default: 7000);',
"id" => $evlshortname."_bootstrap_speed",
"type" => "text",
"std" => "7000");

$options['evl_bootstrap_slide_title_font'] = array( "name" => __( 'Slider Title font', 'evolve' ),
"desc" => __( 'Select the typography you want for the slide title. * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_bootstrap_slide_title_font",
"type" => "typography",
"std" => array('size' => '36px', 'face' => 'Roboto','style' => 'normal','color' => '')
);

$options['evl_bootstrap_slide_desc_font'] = array( "name" => __( 'Slider Description font', 'evolve' ),
"desc" => __( 'Select the typography you want for the slide description. * non web-safe font.', 'evolve' ),
"id" => $evlshortname."_bootstrap_slide_desc_font",
"type" => "typography",
"std" => array('size' => '18px', 'face' => 'Roboto','style' => 'normal','color' => '')
);

$options['evl_bootstrap_slide1'] = array( "name" => "Enable Slide 1",
"desc" => "Check this box to enable Slide 1",
"id" => $evlshortname."_bootstrap_slide1",
"type" => "checkbox",
"std" => "1");

$options['evl_bootstrap_slide1_img'] = array( "name" => __( 'Slide 1 Image', 'evolve' ),
"desc" => __( 'Upload an image for the Slide 1, or specify an image URL directly.', 'evolve' ),
"id" => $evlshortname."_bootstrap_slide1_img",
"type" => "upload",
"class" => "hidden",
"std" => $imagepathfolder . 'bootstrap-slider/1.jpg');

$options['evl_bootstrap_slide1_title'] = array( "name" => "Slide 1 Title",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide1_title",
"type" => "text",
"class" => "hidden",
"std" => __( 'Super Awesome WP Theme', 'evolve' ));

$options['evl_bootstrap_slide1_desc'] = array( "name" => "Slide 1 Description",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide1_desc",
"type" => "textarea",
"class" => "hidden",
"std" => __( 'Absolutely free of cost theme with amazing design and premium features which will impress your visitors', 'evolve' ));

$options['evl_bootstrap_slide1_button'] = array( "name" => "Slide 1 Button",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide1_button",
"type" => "textarea",
"class" => "hidden",
"std" => __( '<a class="button" href="#">Learn more</a>', 'evolve' ));

$options['evl_bootstrap_slide2'] = array( "name" => "Enable Slide 2",
"desc" => "Check this box to enable Slide 2",
"id" => $evlshortname."_bootstrap_slide2",
"type" => "checkbox",
"std" => "1");

$options['evl_bootstrap_slide2_img'] = array( "name" => __( 'Slide 2 Image', 'evolve' ),
"desc" => __( 'Upload an image for the Slide 2, or specify an image URL directly.', 'evolve' ),
"id" => $evlshortname."_bootstrap_slide2_img",
"type" => "upload",
"class" => "hidden",
"std" => $imagepathfolder . 'bootstrap-slider/2.jpg');

$options['evl_bootstrap_slide2_title'] = array( "name" => "Slide 2 Title",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide2_title",
"type" => "text",
"class" => "hidden",
"std" => __( 'Bootstrap and Font Awesome Ready', 'evolve' ));

$options['evl_bootstrap_slide2_desc'] = array( "name" => "Slide 2 Description",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide2_desc",
"type" => "textarea",
"class" => "hidden",
"std" => __( 'Built-in Bootstrap Elements and Font Awesome let you do amazing things with your website', 'evolve' ));

$options['evl_bootstrap_slide2_button'] = array( "name" => "Slide 2 Button",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide2_button",
"type" => "textarea",
"class" => "hidden",
"std" => __( '<a class="button" href="#">Learn more</a>', 'evolve' ));

$options['evl_bootstrap_slide3'] = array( "name" => "Enable Slide 3",
"desc" => "Check this box to enable Slide 3",
"id" => $evlshortname."_bootstrap_slide3",
"type" => "checkbox",
"std" => "1");

$options['evl_bootstrap_slide3_img'] = array( "name" => __( 'Slide 3 Image', 'evolve' ),
"desc" => __( 'Upload an image for the Slide 3, or specify an image URL directly.', 'evolve' ),
"id" => $evlshortname."_bootstrap_slide3_img",
"type" => "upload",
"class" => "hidden",
"std" => $imagepathfolder . 'bootstrap-slider/3.jpg');

$options['evl_bootstrap_slide3_title'] = array( "name" => "Slide 3 Title",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide3_title",
"type" => "text",
"class" => "hidden",
"std" => __( 'Easy to use control panel', 'evolve' ));

$options['evl_bootstrap_slide3_desc'] = array( "name" => "Slide 3 Description",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide3_desc",
"type" => "textarea",
"class" => "hidden",
"std" => __( 'Select of 500+ Google Fonts, choose layout as you need, set up your social links', 'evolve' ));

$options['evl_bootstrap_slide3_button'] = array( "name" => "Slide 3 Button",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide3_button",
"type" => "textarea",
"class" => "hidden",
"std" => __( '<a class="button" href="#">Learn more</a>', 'evolve' ));

$options['evl_bootstrap_slide4'] = array( "name" => "Enable Slide 4",
"desc" => "Check this box to enable Slide 4",
"id" => $evlshortname."_bootstrap_slide4",
"type" => "checkbox",
"std" => "1");

$options['evl_bootstrap_slide4_img'] = array( "name" => __( 'Slide 4 Image', 'evolve' ),
"desc" => __( 'Upload an image for the Slide 4, or specify an image URL directly.', 'evolve' ),
"id" => $evlshortname."_bootstrap_slide4_img",
"type" => "upload",
"class" => "hidden",
"std" => $imagepathfolder . 'bootstrap-slider/4.jpg');

$options['evl_bootstrap_slide4_title'] = array( "name" => "Slide 4 Title",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide4_title",
"type" => "text",
"class" => "hidden",
"std" => __( 'Fully responsive theme', 'evolve' ));

$options['evl_bootstrap_slide4_desc'] = array( "name" => "Slide 4 Description",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide4_desc",
"type" => "textarea",
"class" => "hidden",
"std" => __( 'Adaptive to any screen depending on the device being used to view the site', 'evolve' ));

$options['evl_bootstrap_slide4_button'] = array( "name" => "Slide 4 Button",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide4_button",
"type" => "textarea",
"class" => "hidden",
"std" => __( '<a class="button" href="#">Learn more</a>', 'evolve' ));

$options['evl_bootstrap_slide5'] = array( "name" => "Enable Slide 5",
"desc" => "Check this box to enable Slide 5",
"id" => $evlshortname."_bootstrap_slide5",
"type" => "checkbox",
"std" => "1");

$options['evl_bootstrap_slide5_img'] = array( "name" => __( 'Slide 5 Image', 'evolve' ),
"desc" => __( 'Upload an image for the Slide 5, or specify an image URL directly.', 'evolve' ),
"id" => $evlshortname."_bootstrap_slide5_img",
"type" => "upload",
"class" => "hidden",
"std" => $imagepathfolder . 'bootstrap-slider/5.jpg');

$options['evl_bootstrap_slide5_title'] = array( "name" => "Slide 5 Title",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide5_title",
"type" => "text",
"class" => "hidden",
"std" => __( 'Unlimited color schemes', 'evolve' ));

$options['evl_bootstrap_slide5_desc'] = array( "name" => "Slide 5 Description",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide5_desc",
"type" => "textarea",
"class" => "hidden",
"std" => __( 'Upload your own logo, change background color or images, select links color which you love - it\'s limitless', 'evolve' ));

$options['evl_bootstrap_slide5_button'] = array( "name" => "Slide 5 Button",
"desc" => '',
"id" => $evlshortname."_bootstrap_slide5_button",
"type" => "textarea",
"class" => "hidden",
"std" => __( '<a class="button" href="#">Learn more</a>', 'evolve' ));

$options[] = array( "name" => $evlshortname."-tab-14", "id" => $evlshortname."-tab-14",
"type" => "close-tab" );


// Front Page Content Boxes

$options[] = array( "id" => $evlshortname."-tab-15",
"type" => "open-tab");

$options['evl_content_boxes'] = array( "name" => "Enable Front Page Content Boxes",
"desc" => "Check this box to enable Front Page Content Boxes",
"id" => $evlshortname."_content_boxes",
"type" => "checkbox",
"std" => "1");

$options['evl_content_box1_title'] = array( "name" => "Content Box 1 Title",
"desc" => '',
"id" => $evlshortname."_content_box1_title",
"type" => "text",
"std" => __( 'Beautifully Simple', 'evolve' ));

$options['evl_content_box1_icon'] = array( "name" => "Content Box 1 Icon (FontAwesome)",
"desc" => '',
"id" => $evlshortname."_content_box1_icon",
"type" => "text",
"std" => "fa-cube");

$options['evl_content_box1_icon_color'] = array( "name" => "Content Box 1 Icon Color",
"desc" => '',
"id" => $evlshortname."_content_box1_icon_color",
"type" => "color",
"std" => "#faa982");

$options['evl_content_box1_desc'] = array( "name" => "Content Box 1 Description",
"desc" => '',
"id" => $evlshortname."_content_box1_desc",
"type" => "textarea",
"std" => __( 'Clean and modern theme with smooth and pixel perfect design', 'evolve' ));

$options['evl_content_box1_button'] = array( "name" => "Content Box 1 Button",
"desc" => '',
"id" => $evlshortname."_content_box1_button",
"type" => "textarea",
"std" => __( '<a class="read-more btn" href="#">Learn more</a>', 'evolve' ));

$options['evl_content_box2_title'] = array( "name" => "Content Box 2 Title",
"desc" => '',
"id" => $evlshortname."_content_box2_title",
"type" => "text",
"std" => __( 'Easy Customizable', 'evolve' ));

$options['evl_content_box2_icon'] = array( "name" => "Content Box 2 Icon (FontAwesome)",
"desc" => '',
"id" => $evlshortname."_content_box2_icon",
"type" => "text",
"std" => "fa-circle-o-notch");

$options['evl_content_box2_icon_color'] = array( "name" => "Content Box 2 Icon Color",
"desc" => '',
"id" => $evlshortname."_content_box2_icon_color",
"type" => "color",
"std" => "#8fb859");

$options['evl_content_box2_desc'] = array( "name" => "Content Box 2 Description",
"desc" => '',
"id" => $evlshortname."_content_box2_desc",
"type" => "textarea",
"std" => __( 'Over a hundred theme options ready to make your website unique', 'evolve' ));

$options['evl_content_box2_button'] = array( "name" => "Content Box 2 Button",
"desc" => '',
"id" => $evlshortname."_content_box2_button",
"type" => "textarea",
"std" => __( '<a class="read-more btn" href="#">Learn more</a>', 'evolve' ));

$options['evl_content_box3_title'] = array( "name" => "Content Box 3 Title",
"desc" => '',
"id" => $evlshortname."_content_box3_title",
"type" => "text",
"std" => __( 'Contact Form Ready', 'evolve' ));

$options['evl_content_box3_icon'] = array( "name" => "Content Box 3 Icon (FontAwesome)",
"desc" => '',
"id" => $evlshortname."_content_box3_icon",
"type" => "text",
"std" => "fa-send");

$options['evl_content_box3_icon_color'] = array( "name" => "Content Box 3 Icon Color",
"desc" => '',
"id" => $evlshortname."_content_box3_icon_color",
"type" => "color",
"std" => "#78665e");

$options['evl_content_box3_desc'] = array( "name" => "Content Box 3 Description",
"desc" => '',
"id" => $evlshortname."_content_box3_desc",
"type" => "textarea",
"std" => __( 'Built-In Contact Page with Google Maps is a standard for this theme', 'evolve' ));

$options['evl_content_box3_button'] = array( "name" => "Content Box 3 Button",
"desc" => '',
"id" => $evlshortname."_content_box3_button",
"type" => "textarea",
"std" => __( '<a class="read-more btn" href="#">Learn more</a>', 'evolve' ));

$options[] = array( "name" => $evlshortname."-tab-15", "id" => $evlshortname."-tab-15",
"type" => "close-tab" );


return $options;
}

/**
 * Front End Customizer
 *
 * WordPress 3.4 Required
 */
add_action( 'customize_register', 'evolve_customizer_register' );
        
function evolve_customizer_register( $wp_customize ) {
    /**
     * This is optional, but if you want to reuse some of the defaults
     * or values you already have built in the options panel, you
     * can load them into $options for easy reference
     */
	get_template_part('library/functions/customizer-class') ; 
    $customizer_array = array(
        'layout' => array(
            'name' => __( 'General', 'evolve'),
            'priority' => 101,
            'settings' => array(
                'evl_layout',            
                'evl_width_layout',
                'evl_width_px',
                )
        ),
        'header' => array(
            'name' => __( 'Header', 'evolve'),
            'priority' => 102,
            'settings' => array(
                'evl_header_logo',
                'evl_pos_logo',
                'evl_blog_title',
                'evl_tagline_pos',
                'evl_main_menu',
                'evl_sticky_header',
                'evl_searchbox',
                'evl_widgets_header',                
                'evl_header_widgets_placement',
            )
        ),
        'footer' => array(
            'name' => __( 'Footer', 'evolve'),
            'priority' => 103,
            'settings' => array(
                'evl_widgets_num',
                'evl_footer_content',
            )
        ),   
        'typography' => array(
            'name' => __( 'Typography', 'evolve'),
            'priority' => 104,
            	'settings' => array(
                'evl_title_font',
                'evl_tagline_font',
                'evl_menu_font',
                'evl_post_font',
                'evl_content_font',
                'evl_heading_font',
         
            )
        ),    
        'styling' => array(
            'name' => __( 'Styling', 'evolve'),
            'priority' => 105,
            'settings' => array(
                'evl_content_back',
                'evl_menu_back',
                'evl_menu_back_color',
                'evl_disable_menu_back',
                'evl_header_footer_back_color',
                'evl_pattern',
                'evl_scheme_widgets',
                'evl_scheme_background',
                'evl_scheme_background_100',
                'evl_scheme_background_repeat',
                'evl_general_link',
                'evl_button_1',
                'evl_button_2',
                'evl_widget_background',
                'evl_widget_background_image',
            )
        ),      
        'blog' => array(
            'name' => __( 'Blog', 'evolve'),
            'priority' => 106,
            'settings' => array(
                'evl_post_layout',
                'evl_excerpt_thumbnail',
                'evl_featured_images',
                'evl_author_avatar',
                'evl_header_meta',
                'evl_share_this',
                'evl_post_links',
                'evl_similar_posts',
            )
        ),   
        'social' => array(
            'name' => __( 'Social Media Links', 'evolve'),
            'priority' => 107,
            'settings' => array(
                'evl_social_links',
                'evl_social_color_scheme',
                'evl_social_icons_size',
                'evl_show_rss',                
                'evl_rss_feed',
                'evl_newsletter',
                'evl_facebook',
                'evl_twitter_id',
                'evl_instagram',
                'evl_skype',
                'evl_youtube',
                'evl_flickr',
                'evl_linkedin',
                'evl_googleplus',
                'evl_pinterest',                
            )
        ),   
        'boxes' => array(
            'name' => __( 'Front Page Content Boxes', 'evolve'),
            'priority' => 108,
            'settings' => array(
               'evl_content_boxes',
               'evl_content_box1_title',
               'evl_content_box1_icon',
               'evl_content_box1_icon_color',
               'evl_content_box1_desc',
               'evl_content_box1_button',
               'evl_content_box2_title',
               'evl_content_box2_icon',
               'evl_content_box2_icon_color',
               'evl_content_box2_desc',
               'evl_content_box2_button',
               'evl_content_box3_title',
               'evl_content_box3_icon',
               'evl_content_box3_icon_color',
               'evl_content_box3_desc',
               'evl_content_box3_button',
            )
        ),    
        'bootstrap' => array(
            'name' => __( 'Bootstrap Slider', 'evolve'),
            'priority' => 109,
            'settings' => array(
               'evl_bootstrap_slider',
               'evl_bootstrap_speed',
               'evl_bootstrap_slide_title_font',
               'evl_bootstrap_slide_desc_font',
               'evl_bootstrap_slide1',
               'evl_bootstrap_slide1_img',
               'evl_bootstrap_slide1_title',
               'evl_bootstrap_slide1_desc',
               'evl_bootstrap_slide1_button',
               'evl_bootstrap_slide2',
               'evl_bootstrap_slide2_img',
               'evl_bootstrap_slide2_title',
               'evl_bootstrap_slide2_desc',
               'evl_bootstrap_slide2_button',
               'evl_bootstrap_slide3',
               'evl_bootstrap_slide3_img',
               'evl_bootstrap_slide3_title',
               'evl_bootstrap_slide3_desc',
               'evl_bootstrap_slide3_button',
               'evl_bootstrap_slide4',
               'evl_bootstrap_slide4_img',
               'evl_bootstrap_slide4_title',
               'evl_bootstrap_slide4_desc',
               'evl_bootstrap_slide4_button',
               'evl_bootstrap_slide5',
               'evl_bootstrap_slide5_img',
               'evl_bootstrap_slide5_title',
               'evl_bootstrap_slide5_desc',
               'evl_bootstrap_slide5_button',
            )
        ),        
        'parallax' => array(
            'name' => __( 'Parallax Slider', 'evolve'),
            'priority' => 110,
            'settings' => array(        
               'evl_parallax_slider',
               'evl_parallax_speed',
               'evl_parallax_slide_title_font',
               'evl_parallax_slide_desc_font',
               'evl_show_slide1',
               'evl_slide1_img',
               'evl_slide1_title',
               'evl_slide1_desc',
               'evl_slide1_button',
               'evl_show_slide2',
               'evl_slide2_img',
               'evl_slide2_title',
               'evl_slide2_desc',
               'evl_slide2_button',
               'evl_show_slide3',
               'evl_slide3_img',
               'evl_slide3_title',
               'evl_slide3_desc',
               'evl_slide3_button',
               'evl_show_slide4',
               'evl_slide4_img',
               'evl_slide4_title',
               'evl_slide4_desc',
               'evl_slide4_button',
               'evl_show_slide5',
               'evl_slide5_img',
               'evl_slide5_title',
               'evl_slide5_desc',
               'evl_slide5_button',
            )
        ),   
        'posts' => array(
            'name' => __( 'Posts Slider', 'evolve'),
            'priority' => 111,
            'settings' => array(        
               'evl_posts_slider',
               'evl_posts_number',
               'evl_posts_slider_content',
               'evl_posts_slider_id',
               'evl_carousel_speed',
               'evl_carousel_slide_title_font',
               'evl_carousel_slide_desc_font',
            )
        ),   
        'contact' => array(
            'name' => __( 'Contact', 'evolve'),
            'priority' => 112,
            'settings' => array(        
               'evl_gmap_type',
               'evl_gmap_width',
               'evl_gmap_height',
               'evl_gmap_address',
               'evl_sent_email_header',
               'evl_email_address',
               'evl_map_zoom_level',
               'evl_map_pin',
               'evl_map_popup',
               'evl_map_scrollwheel',
               'evl_map_scale',
               'evl_map_zoomcontrol',
            )
        ),    
        'extra' => array(
            'name' => __( 'Extra', 'evolve'),
            'priority' => 113,
            'settings' => array(        
               'evl_breadcrumbs',
               'evl_nav_links',
               'evl_pos_button',
               'evl_parallax_slider_support',
               'evl_carousel_slider',
               'evl_status_gmap',
               'evl_animatecss',
            )
        ),   
        'css' => array(
            'name' => __( 'Custom CSS', 'evolve'),
            'priority' => 114,
            'settings' => array(        
               'evl_css_content',
            )
        ),          
                                                                      
    );
	global $my_image_controls;
	$my_image_controls = array();
    $options = evolve_options();
    $i = 0;
    foreach ( $customizer_array as $name => $val ) {
        $wp_customize->add_section( "evolve-theme_$name", array(
            'title' => $val['name'],
            'priority' => $val['priority']
        ) );
        foreach ( $val['settings'] as $setting ) {


//evl_sanitize_typography
        	if ( $options[$setting]['type'] == 'typography' ){
        		$wp_customize->add_setting( "evolve-theme[$setting]", array(
	                'default' => $options[$setting]['std'],
	                'type' => 'option',
	                'sanitize_callback' => 'evl_sanitize_typography',
	            ) );
        	}

        	else{
                
                
                /*          
	            $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                'default' => $options[$setting]['std'],
	                'type' => 'option'
	            ) );
                */
                
                 //sanitize everything else
                
                switch($options[$setting]['id'])
                {
                   
                       
                    /* image sanitization start */
                    
                    case "evl_header_logo":
                    case "evl_scheme_background":
                    case "evl_bootstrap_slide1_img":
                    case "evl_bootstrap_slide2_img":
                    case "evl_bootstrap_slide3_img":
                    case "evl_bootstrap_slide4_img":
                    case "evl_bootstrap_slide5_img":
                    case "evl_slide1_img":
                    case "evl_slide2_img":
                    case "evl_slide3_img":
                    case "evl_slide4_img":
                    case "evl_slide5_img":
                    case "evl_scheme_background":
                    
                       $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                       'default' => $options[$setting]['std'],
                           'type' => 'option',
                           'sanitize_callback' => 'evl_sanitize_upload'
	                    ));
                    
                       break;
                 
                    // image sanitization end
                    
                   
                    // hex color sanitization start
                    
                    case "evl_menu_back_color":
                    case "evl_header_footer_back_color":
                    case "evl_scheme_widgets":
                    case "evl_general_link":
                    case "evl_button_1":
                    case "evl_button_2":
                    case "evl_social_color_scheme":
                    case "evl_content_box1_icon_color":
                    case "evl_content_box2_icon_color":
                    case "evl_content_box3_icon_color":
                    
                    
                        $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                       'default' => $options[$setting]['std'],
                           'type' => 'option',
                           'sanitize_callback' => 'sanitize_hex_color'
	                    ));
                    
                    break;
                    
                    
                  
                    // hex color sanitization end 
                    
            
                    
                    // select sanitization start 
                    
                    case "evl_layout":
                    case "evl_width_layout":
                    case "evl_post_links":
                    case "evl_pos_logo":
                    case "evl_tagline_pos":
                    case "evl_widgets_header":
                    case "evl_header_widgets_placement":
                    case "evl_widgets_num":
                    case "evl_content_back":
                    case "evl_menu_back":
                    case "evl_pattern":
                    case "evl_scheme_background_repeat":
                    case "evl_post_layout":
                    case "evl_header_meta":
                    case "evl_share_this":
                    case "evl_similar_posts":
                    case "evl_social_icons_size":
                    case "evl_bootstrap_slider":
                    case "evl_parallax_slider":
                    case "evl_posts_slider":
                    case "evl_posts_number":
                    case "evl_posts_slider_content":
                    case "evl_gmap_type":
                    case "evl_nav_links":
                    case "evl_pos_button":
                    
                        $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                       'default' => $options[$setting]['std'],
                           'type' => 'option',
                           'sanitize_callback' => 'evl_sanitize_choices'
	                    ));
                    
                    break;
                    
                  
                    // select sanitization end 
                 
                    
                    // numerical text sanitization start 
                    
                    case "evl_bootstrap_speed":
                    case "evl_parallax_speed":
                    case "evl_carousel_speed":
                    case "evl_map_zoom_level":
                    case "evl_width_px":
                        $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                       'default' => $options[$setting]['std'],
                           'type' => 'option',
                           'sanitize_callback' => 'evl_sanitize_numbers'
	                    ));
                    
                    break;
                    
                    // numerical text sanitization end 
                    
                    
                    // pixel sanitization start 
                    
                    case "evl_gmap_width":
                    case "evl_gmap_height":
                        $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                       'default' => $options[$setting]['std'],
                           'type' => 'option',
                           'sanitize_callback' => 'evl_sanitize_pixel'
	                    ));
                    
                    break;
                    
                    // pixel sanitization end 
                    
                    
                    
                    
                    // text url sanitization start 
                                      
                    case "evl_newsletter":
                    case "evl_facebook":
                    case "evl_rss_feed":
                    case "evl_twitter_id":
                    case "evl_instagram":
                    case "evl_skype":
                    case "evl_youtube":
                    case "evl_flickr":
                    case "evl_linkedin":
                    case "evl_googleplus":
                    case "evl_pinterest":
                    
                        $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                       'default' => $options[$setting]['std'],
                           'type' => 'option',
                           'sanitize_callback' => 'esc_url_raw'
	                    ));
                    
                      break;
                    
                            
                    // text url sanitization end 
                    
                    
                    
                    // text field sanitization start 
                    
                    case "evl_content_box1_title":
                    case "evl_bootstrap_slide1_title":
                    case "evl_bootstrap_slide2_title":
                    case "evl_bootstrap_slide3_title":
                    case "evl_bootstrap_slide4_title":
                    case "evl_bootstrap_slide5_title":
                    case "evl_content_box2_title":
                    case "evl_content_box3_title":
                    case "evl_slide1_title":
                    case "evl_slide2_title":
                    case "evl_slide3_title":
                    case "evl_slide4_title":
                    case "evl_slide5_title":
                    case "evl_posts_slider_id":
                    case "evl_gmap_address":
                    case "evl_sent_email_header":
                        $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                       'default' => $options[$setting]['std'],
                           'type' => 'option',
                           'sanitize_callback' => 'evl_sanitize_text_field'
	                    ));
                    
                    break;
                    
                     // text field sanitization end 
                    
                    
                    
                    // fontawesome fields sanitization start 
                     
                    case "evl_content_box1_icon":
                    case "evl_content_box2_icon":
                    case "evl_content_box3_icon":
                    
                        $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                       'default' => $options[$setting]['std'],
                           'type' => 'option',
                           'sanitize_callback' => 'evl_sanitize_text_field'
	                    ));
                    
                    break;
                    
                   // fontawesome fields sanitization end 
                    
                    
                    
                    // text email field sanitization start 
                    
                    case "evl_email_address":
                    
                        $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                       'default' => $options[$setting]['std'],
                           'type' => 'option',
                           'sanitize_callback' => 'sanitize_email'
	                    ));
                    
                    break;
                    
                    
                    // text email field sanitization end 
                    
                    
                    
                    
                    
                   
                    
                    // textarea sanitization start 
                    
                    case "evl_footer_content":
                    case "evl_content_box1_desc":
                    case "evl_content_box1_button":
                    case "evl_content_box2_desc":
                    case "evl_content_box2_button":
                    case "evl_content_box3_desc":
                    case "evl_content_box3_button":
                    case "evl_bootstrap_slide1_desc":
                    case "evl_bootstrap_slide1_button":
                    case "evl_bootstrap_slide2_desc":
                    case "evl_bootstrap_slide2_button":
                    case "evl_bootstrap_slide3_desc":
                    case "evl_bootstrap_slide3_button":
                    case "evl_bootstrap_slide4_desc":
                    case "evl_bootstrap_slide4_button":
                    case "evl_bootstrap_slide5_desc":
                    case "evl_bootstrap_slide5_button":
                    case "evl_slide1_desc":
                    case "evl_slide1_button":
                    case "evl_slide2_desc":
                    case "evl_slide2_button":
                    case "evl_slide3_desc":
                    case "evl_slide3_button":
                    case "evl_slide4_desc":
                    case "evl_slide4_button":
                    case "evl_slide5_desc":
                    case "evl_slide5_button":
                    case "evl_css_content":
                     
                        $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                       'default' => $options[$setting]['std'],
                           'type' => 'option',
                           'sanitize_callback' => 'evl_sanitize_textarea'
	                    ));
                    
                        break;
                  
                    // textarea sanitization end 
                    
                    
                    
                    // checkbox sanitization start 
                    
                    case "evl_blog_title":
                    case "evl_main_menu":
                    case "evl_disable_menu_back":
                    case "evl_scheme_background_100":
                    case "evl_widget_background":
                    case "evl_widget_background_image":
                    case "evl_excerpt_thumbnail":
                    case "evl_author_avatar":
                    case "evl_map_pin":
                    case "evl_map_popup":
                    case "evl_map_scrollwheel":
                    case "evl_map_scale":
                    case "evl_map_zoomcontrol":
                    // Following has 1 by default for the checkbox 
                    case "evl_sticky_header":
                    case "evl_searchbox":
                    case "evl_featured_images":
                    case "evl_social_links":
                    case "evl_show_rss":
                    case "evl_content_boxes":
                    case "evl_bootstrap_slide1":
                    case "evl_bootstrap_slide2":
                    case "evl_bootstrap_slide3":
                    case "evl_bootstrap_slide4":
                    case "evl_bootstrap_slide5":
                    case "evl_show_slide1":
                    case "evl_show_slide2":
                    case "evl_show_slide3":
                    case "evl_show_slide4":
                    case "evl_show_slide5":
                    case "evl_breadcrumbs":
                    case "evl_parallax_slider_support":
                    case "evl_carousel_slider":
                    case "evl_status_gmap":
                    case "evl_animatecss":
                   
                       $wp_customize->add_setting( "evolve-theme[$setting]", array(
	                       'default' => $options[$setting]['std'],
                           'type' => 'option',
                           'sanitize_callback' => 'evl_sanitize_checkbox'
	                    ));
                       break;
                    
                    // checkbox sanitization end
                    
                    
                    
                }                
        	}

            
            if ( $options[$setting]['type'] == 'radio' || $options[$setting]['type'] == 'select' ) {
                $wp_customize->add_control( "evolve-theme_$setting", array(
                    'label' => $options[$setting]['name'],
                    'section' => "evolve-theme_$name",
                    'settings' => "evolve-theme[$setting]",
                    'type' => $options[$setting]['type'],
                    'choices' => $options[$setting]['options'],
                    'priority' => $i
                ) );
            } elseif ( $options[$setting]['type'] == 'text' || $options[$setting]['type'] == 'checkbox' ) {
                $wp_customize->add_control( "evolve-theme_$setting", array(
                    'label' => $options[$setting]['name'],
                    'section' => "evolve-theme_$name",
                    'settings' => "evolve-theme[$setting]",
                    'type' => $options[$setting]['type'],
                    'priority' => $i
                ) );
            } elseif ( $options[$setting]['type'] == 'color' ) {
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "evolve-theme_$setting", array(
                            'label' => $options[$setting]['name'],
                            'section' => "evolve-theme_$name",
                            'settings' => "evolve-theme[$setting]",
                            'type' => $options[$setting]['type'],
                            'priority' => $i
                                ) ) );

            /********************************************
            *
            * Typography add new by ddo
            *
            * code cho class evl_Customize_Typography_Control dat o :
            * library/functions/customizer-class.php
            *
            *********************************************/
            
            } elseif ( $options[$setting]['type'] == 'typography' ) {
            	
                $wp_customize->add_control( new evl_Customize_Typography_Control( $wp_customize, "evolve-theme_$setting", array(
                            'label' => $options[$setting]['name'],
                            'section' => "evolve-theme_$name",
                            'settings' => "evolve-theme[$setting]",
                             
                            'priority' => $i
                                ) ) );    

            } elseif ( $options[$setting]['type'] == 'upload' ) {
				$my_image_controls["evolve-theme_$setting"] =  evolve_add_image_control($options,$setting, $name,$i);

				
			} elseif ( $options[$setting]['type'] == 'images' ) {
                $wp_customize->add_control( new evl_Customize_Image_Control( $wp_customize, "evolve-theme_$setting", array(
                            'label' => $options[$setting]['name'],
                            'section' => "evolve-theme_$name",
                            'settings' => "evolve-theme[$setting]",
							'type' => $options[$setting]['type'],
							'choices' => $options[$setting]['options'],
							'priority' => $i
                                ) ) );
            } elseif ( $options[$setting]['type'] == 'textarea' ) {
                $wp_customize->add_control( new evl_Customize_Textarea_Control( $wp_customize, "evolve-theme_$setting", array(
                            'label' => $options[$setting]['name'],
                            'section' => "evolve-theme_$name",
                            'settings' => "evolve-theme[$setting]",
							'type' => $options[$setting]['type'],
							'priority' => $i
                                ) ) );
            }
            $i++;
        }
    }
    foreach ($my_image_controls as $id => $control) {
				   $control->add_tab( 'library',   __( 'Media Library', 'evolve' ), 'evolve_library_tab' );
            
     }  

}

function evolve_library_tab() {
	
    global $my_image_controls;
    static $tab_num = 0; // Sync tab to each image control
   
    $control = array_slice($my_image_controls, $tab_num, 1);
      
    ?>
    <a class="choose-from-library-link button"
        data-controller = "<?php printf ('%s', esc_attr( key($control) )); ?>">
        <?php _e( 'Open Library', 'evolve' ); ?>
    </a>
     
    <?php
    $tab_num++;

}   

function evolve_add_image_control( $options,$setting, $name,$i) {
    global $wp_customize;
    $control =
    new WP_Customize_Image_Control( $wp_customize, "evolve-theme_$setting",
        array(
        'label'         => $options[$setting]['name'],
        'section'       => "evolve-theme_$name",
        'priority'      => $i,
        'settings'      => "evolve-theme[$setting]"// "evolve-theme[$setting]"
        )
    );
   
    $wp_customize->add_control($control);
    return $control;
}