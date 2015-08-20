<?php
/**
 * Headerdata of Theme options.
 * @package BrickYard
 * @since BrickYard 1.0.0
*/  
global $brickyard_options;
foreach ($brickyard_options as $value) {
	if (isset($value['id']) && get_option( $value['id'] ) === FALSE && isset($value['std'])) {
		$$value['id'] = $value['std'];
	}
	elseif (isset($value['id'])) { $$value['id'] = get_option( $value['id'] ); }
}

// additional js and css
if(	!is_admin()){
function brickyard_fonts_include () {
// Google Fonts
$bodyfont = get_option('brickyard_body_google_fonts');
$headingfont = get_option('brickyard_headings_google_fonts');
$descriptionfont = get_option('brickyard_description_google_fonts');
$headlinefont = get_option('brickyard_headline_google_fonts');
$headlineboxfont = get_option('brickyard_headline_box_google_fonts');
$postentryfont = get_option('brickyard_postentry_google_fonts');
$sidebarfont = get_option('brickyard_sidebar_google_fonts');
$menufont = get_option('brickyard_menu_google_fonts');
$topmenufont = get_option('brickyard_top_menu_google_fonts');

$fonturl = "//fonts.googleapis.com/css?family=";

$bodyfonturl = $fonturl.$bodyfont;
$headingfonturl = $fonturl.$headingfont;
$descriptionfonturl = $fonturl.$descriptionfont;
$headlinefonturl = $fonturl.$headlinefont;
$headlineboxfonturl = $fonturl.$headlineboxfont;
$postentryfonturl = $fonturl.$postentryfont;
$sidebarfonturl = $fonturl.$sidebarfont;
$menufonturl = $fonturl.$menufont;
$topmenufonturl = $fonturl.$topmenufont;
	// Google Fonts
     if ($bodyfont != 'default' && $bodyfont != ''){
      wp_enqueue_style('brickyard-google-font1', $bodyfonturl); 
		 }
     if ($headingfont != 'default' && $headingfont != ''){
      wp_enqueue_style('brickyard-google-font2', $headingfonturl);
		 }
     if ($descriptionfont != 'default' && $descriptionfont != ''){
      wp_enqueue_style('brickyard-google-font3', $descriptionfonturl);
		 }
     if ($headlinefont != 'default' && $headlinefont != ''){
      wp_enqueue_style('brickyard-google-font4', $headlinefonturl); 
		 }
     if ($postentryfont != 'default' && $postentryfont != ''){
      wp_enqueue_style('brickyard-google-font5', $postentryfonturl); 
		 }
     if ($sidebarfont != 'default' && $sidebarfont != ''){
      wp_enqueue_style('brickyard-google-font6', $sidebarfonturl);
		 }
     if ($menufont != 'default' && $menufont != ''){
      wp_enqueue_style('brickyard-google-font8', $menufonturl);
		 }
     if ($topmenufont != 'default' && $topmenufont != ''){
      wp_enqueue_style('brickyard-google-font9', $topmenufonturl);
		 }
     if ($headlineboxfont != 'default' && $headlineboxfont != ''){
      wp_enqueue_style('brickyard-google-font10', $headlineboxfonturl); 
		 }
}
add_action( 'wp_enqueue_scripts', 'brickyard_fonts_include' );
}

// additional js and css
function brickyard_css_include () {
		if (get_option('brickyard_css') == 'Blue' ){
			wp_enqueue_style('brickyard-style-blue', get_template_directory_uri().'/css/blue.css');
		}
    
    if (get_option('brickyard_css') == 'Green' ){
			wp_enqueue_style('brickyard-style-green', get_template_directory_uri().'/css/green.css');
		}

		if (get_option('brickyard_css') == 'Pink' ){
			wp_enqueue_style('brickyard-style-pink', get_template_directory_uri().'/css/pink.css');
		}
    
    if (get_option('brickyard_css') == 'Purple' ){
			wp_enqueue_style('brickyard-style-purple', get_template_directory_uri().'/css/purple.css');
		}
    
		if (get_option('brickyard_css') == 'Red' ){
			wp_enqueue_style('brickyard-style-red', get_template_directory_uri().'/css/red.css');
		}

		if (get_option('brickyard_css') == 'Turquoise' ){
			wp_enqueue_style('brickyard-style-turquoise', get_template_directory_uri().'/css/turquoise.css');
		}
}
add_action( 'wp_enqueue_scripts', 'brickyard_css_include' );

//social scripts
if(	!is_admin() && ($brickyard_share_buttons_page == '' || $brickyard_share_buttons_page == 'Display' || $brickyard_share_buttons_post == '' || $brickyard_share_buttons_post == 'Display' || $brickyard_share_buttons_post_entry == '' || $brickyard_share_buttons_post_entry == 'Display' || $brickyard_share_buttons_products == '' || $brickyard_share_buttons_products == 'Display') ) {

function brickyard_scripts_social() {
$share_buttons_language = get_option('brickyard_share_buttons_language') . '/all.js#xfbml=1';
$share_buttons_language_url = "//connect.facebook.net/";
$share_buttons_language_full_url = $share_buttons_language_url.$share_buttons_language;
	// Register all javascript files
	wp_enqueue_script('brickyard_js_google', '//apis.google.com/js/plusone.js', '', '', 'footer');
  if ( get_option('brickyard_share_buttons_language') != '' ) {
	wp_enqueue_script('brickyard_js_facebook', $share_buttons_language_full_url, '', '', 'footer'); } else {
  wp_enqueue_script('brickyard_js_facebook', '//connect.facebook.net/en_US/all.js#xfbml=1', '', '', 'footer'); }
	wp_enqueue_script('brickyard_js_twitter', '//platform.twitter.com/widgets.js', '', '', 'footer');
	}   
add_action('wp_enqueue_scripts', 'brickyard_scripts_social');	
}	

// Background Image Size
function brickyard_background_image_size() {
    $background_image_size = get_option('brickyard_background_image_size'); 
		if ($background_image_size == 'Cover') { ?>
		<?php _e('#wrapper { background-size: cover; }'); ?>
<?php } 
}

// Background Pattern Opacity
function brickyard_get_background_pattern_opacity() {
    $background_pattern_opacity = get_option('brickyard_background_pattern_opacity'); 
		if ($background_pattern_opacity != '' && $background_pattern_opacity != '100' && $background_pattern_opacity != 'Default') { ?>
		<?php _e('#wrapper .pattern { opacity: 0.'); ?><?php echo $background_pattern_opacity ?><?php _e('; filter: alpha(opacity='); ?><?php echo $background_pattern_opacity ?><?php _e('); }'); ?>
<?php } 
    elseif ($background_pattern_opacity == '100') { ?>
    <?php _e('#wrapper .pattern { opacity: 1; filter: alpha(opacity=100); }');
}  
} 

// Display sidebar
function brickyard_display_sidebar() {
    $display_sidebar = get_option('brickyard_display_sidebar'); 
		if ($display_sidebar == 'Hide') { ?>
		<?php _e('#wrapper #container #main-content #content { width: 100%; }'); ?>
<?php } 
}

// Display header Search Form - header content width
function brickyard_display_search_form() {
    $display_search_form = get_option('brickyard_display_search_form'); 
		if ($display_search_form == 'Hide') { ?>
		<?php _e('#wrapper #header .header-content .site-title, #wrapper #header .header-content .site-description, #wrapper #header .header-content .header-logo { max-width: 100%; }'); ?>
<?php } 
}

// Display Meta Box on posts - post entries styling
function brickyard_display_meta_post_entry() {
    $display_meta_post_entry = get_option('brickyard_display_meta_post'); 
		if ($display_meta_post_entry == 'Hide') { ?>
		<?php _e('#wrapper #main-content .post-entry .attachment-post-thumbnail { margin-bottom: 17px; } #wrapper #main-content .post-entry .post-entry-content { margin-bottom: -4px; } #wrapper #main-content .post-entry .social-share { margin-bottom: 5px; padding: 0; }'); ?>
<?php } 
}

// Social Networks Links hover color
function brickyard_get_social_icons_background_color() {
    $social_icons_background_color = get_option('brickyard_social_icons_background_color'); 
		if ($social_icons_background_color != '#' && $social_icons_background_color != '') { ?>
		<?php _e('#wrapper #container #top-navigation-wrapper .top-navigation .header-icons a:hover { background-color: '); ?><?php echo $social_icons_background_color ?><?php _e(' !important; }'); ?>
<?php } 
}

// Top Menu background color
function brickyard_get_top_menu_background_color() {
    $top_menu_background_color = get_option('brickyard_top_menu_background_color'); 
		if ($top_menu_background_color != '#' && $top_menu_background_color != '') { ?>
		<?php _e('#wrapper #top-navigation-wrapper, .js #container #top-navigation-wrapper .selectnav { background-color: '); ?><?php echo $top_menu_background_color ?><?php _e(' !important; }'); ?>
<?php } 
}

// Top Menu drop-down submenus background color
function brickyard_get_top_submenu_background_color() {
    $top_submenu_background_color = get_option('brickyard_top_submenu_background_color'); 
		if ($top_submenu_background_color != '#' && $top_submenu_background_color != '') { ?>
		<?php _e('#wrapper .top-navigation ul ul { background-color: '); ?><?php echo $top_submenu_background_color ?><?php _e('; }'); ?>
<?php } 
}

// Top Menu drop-down submenus border color
function brickyard_get_top_submenu_border_color() {
    $top_submenu_border_color = get_option('brickyard_top_submenu_border_color'); 
		if ($top_submenu_border_color != '#' && $top_submenu_border_color != '') { ?>
		<?php _e('#wrapper .top-navigation ul ul, #wrapper .top-navigation ul ul li { border-color: '); ?><?php echo $top_submenu_border_color ?><?php _e('; }'); ?>
<?php } 
}

// Top Menu drop-down submenus hover color
function brickyard_get_top_submenu_hover_color() {
    $top_submenu_hover_color = get_option('brickyard_top_submenu_hover_color'); 
		if ($top_submenu_hover_color != '#' && $top_submenu_hover_color != '') { ?>
		<?php _e('html #wrapper #top-navigation-wrapper .top-navigation ul ul a:hover, html #wrapper #top-navigation-wrapper .top-navigation ul ul :hover > a { background-color: '); ?><?php echo $top_submenu_hover_color ?><?php _e(' !important; }'); ?>
<?php } 
}

// Main Menu background color
function brickyard_get_main_menu_background_color() {
    $main_menu_background_color = get_option('brickyard_main_menu_background_color'); 
		if ($main_menu_background_color != '#' && $main_menu_background_color != '') { ?>
		<?php _e('#wrapper #header .menu-box, .js #container #header .menu-box .selectnav { background-color: '); ?><?php echo $main_menu_background_color ?><?php _e(' !important; }'); ?>
<?php } 
}

// Main Menu border color
function brickyard_get_main_menu_border_color() {
    $main_menu_border_color = get_option('brickyard_main_menu_border_color'); 
		if ($main_menu_border_color != '#' && $main_menu_border_color != '') { ?>
		<?php _e('#wrapper #header .menu-box { border-color: '); ?><?php echo $main_menu_border_color ?><?php _e('; }'); ?>
<?php } 
}

// Main Menu Links border color
function brickyard_get_main_menu_links_border_color() {
    $main_menu_links_border_color = get_option('brickyard_main_menu_links_border_color'); 
		if ($main_menu_links_border_color != '#' && $main_menu_links_border_color != '') { ?>
		<?php _e('#wrapper .menu-box .link-home, #wrapper .menu-box a { border-color: '); ?><?php echo $main_menu_links_border_color ?><?php _e('; }'); ?>
<?php } 
}

// Main Menu drop-down submenus background color
function brickyard_get_main_submenu_background_color() {
    $main_submenu_background_color = get_option('brickyard_main_submenu_background_color'); 
		if ($main_submenu_background_color != '#' && $main_submenu_background_color != '') { ?>
		<?php _e('#wrapper .menu-box ul ul { background-color: '); ?><?php echo $main_submenu_background_color ?><?php _e('; }'); ?>
<?php } 
}

// Main Menu drop-down submenus border color
function brickyard_get_main_submenu_border_color() {
    $main_submenu_border_color = get_option('brickyard_main_submenu_border_color'); 
		if ($main_submenu_border_color != '#' && $main_submenu_border_color != '') { ?>
		<?php _e('#wrapper #header .menu-box ul ul, #wrapper #header .menu-box ul ul li { border-color: '); ?><?php echo $main_submenu_border_color ?><?php _e('; }'); ?>
<?php } 
}

// Main Menu drop-down submenus hover color
function brickyard_get_main_submenu_hover_color() {
    $main_submenu_hover_color = get_option('brickyard_main_submenu_hover_color'); 
		if ($main_submenu_hover_color != '#' && $main_submenu_hover_color != '') { ?>
		<?php _e('html #wrapper #header .menu-box ul ul a:hover, html #wrapper #header .menu-box ul ul :hover > a { background-color: '); ?><?php echo $main_submenu_hover_color ?><?php _e(' !important; }'); ?>
<?php } 
}

// Header Content background color
function brickyard_get_header_content_background_color() {
    $header_content_background_color = get_option('brickyard_header_content_background_color'); 
		if ($header_content_background_color != '#' && $header_content_background_color != '') { ?>
		<?php _e('#wrapper #header .header-content { background-color: '); ?><?php echo $header_content_background_color ?><?php _e('; } '); ?>
<?php } 
}

// Main Content background color
function brickyard_get_main_content_background_color() {
    $main_content_background_color = get_option('brickyard_main_content_background_color'); 
		if ($main_content_background_color != '#' && $main_content_background_color != '') { ?>
		<?php _e('#wrapper #main-content .entry-content, #wrapper #main-content .sidebar-widget, .page-template-template-page-builder-php #main-content .panel, .page-template-template-page-builder-full-width-php #main-content .panel, #wrapper .entry-headline-text, #sidebar .sidebar-headline-text, #wrapper .brickyard_widget_content .tab_title.selected a { background-color: '); ?><?php echo $main_content_background_color ?><?php _e('; }'); ?>
<?php } 
}

// Shadows color
function brickyard_get_shadows_color() {
    $shadows_color = get_option('brickyard_shadows_color'); 
		if ($shadows_color != '#' && $shadows_color != '') { ?>
		<?php _e('#wrapper #header, #wrapper #wrapper-footer, #wrapper .entry-content, #wrapper .sidebar-widget, .page-template-template-page-builder-php #main-content .panel, .page-template-template-page-builder-full-width-php #main-content .panel { -webkit-box-shadow: 0 0 3px '); ?><?php echo $shadows_color ?><?php _e('; -moz-box-shadow: 0 0 3px '); ?><?php echo $shadows_color ?><?php _e('; box-shadow: 0 0 3px '); ?><?php echo $shadows_color ?><?php _e('; }'); ?>
<?php } 
}

// Post Author’s Comments background color
function brickyard_get_author_comments_background_color() {
    $author_comments_background_color = get_option('brickyard_author_comments_background_color'); 
		if ($author_comments_background_color != '#' && $author_comments_background_color != '') { ?>
		<?php _e('#wrapper #comments .bypostauthor { background-color: '); ?><?php echo $author_comments_background_color ?><?php _e('; }'); ?>
<?php } 
}

// Sticky Post background color
function brickyard_get_sticky_post_background_color() {
    $sticky_post_background_color = get_option('brickyard_sticky_post_background_color'); 
		if ($sticky_post_background_color != '#' && $sticky_post_background_color != '') { ?>
		<?php _e('#wrapper #container #main-content .sticky { background-color: '); ?><?php echo $sticky_post_background_color ?><?php _e('; }'); ?>
<?php } 
}

// BrickYard Posts-Thumbnail items hover color
function brickyard_get_posts_thumbnail_background_color() {
    $posts_thumbnail_background_color = get_option('brickyard_posts_thumbnail_background_color'); 
		if ($posts_thumbnail_background_color != '#' && $posts_thumbnail_background_color != '') { ?>
		<?php _e('#wrapper #container .post-entry-thumbnail .thumbnail-hover { background-color: '); ?><?php echo $posts_thumbnail_background_color ?><?php _e('; }'); ?>
<?php } 
}

// Highlighted text background color
function brickyard_get_highlight_background_color() {
    $highlight_background_color = get_option('brickyard_highlight_background_color'); 
		if ($highlight_background_color != '#' && $highlight_background_color != '') { ?>
		<?php _e('#wrapper #container .highlight-text { background-color: '); ?><?php echo $highlight_background_color ?><?php _e('; }'); ?>
<?php } 
}

// Footer background color
function brickyard_get_footer_background_color() {
    $footer_background_color = get_option('brickyard_footer_background_color'); 
		if ($footer_background_color != '#' && $footer_background_color != '') { ?>
		<?php _e('html #wrapper #container #wrapper-footer, #wrapper .footer-headline-text { background-color: '); ?><?php echo $footer_background_color ?><?php _e('; } '); ?>
<?php } 
}

// Footer Notices background color
function brickyard_get_footer_notices_background_color() {
    $footer_notices_background_color = get_option('brickyard_footer_notices_background_color'); 
		if ($footer_notices_background_color != '#' && $footer_notices_background_color != '') { ?>
		<?php _e('#wrapper #wrapper-footer .footer-signature { background-color: '); ?><?php echo $footer_notices_background_color ?><?php _e('; }'); ?>
<?php } 
}

// Searchform border color
function brickyard_get_searchform_border_color() {
    $searchform_border_color = get_option('brickyard_searchform_border_color'); 
		if ($searchform_border_color != '#' && $searchform_border_color != '') { ?>
		<?php _e('html #wrapper #searchform .searchform-wrapper #s { border-color: '); ?><?php echo $searchform_border_color ?><?php _e(' !important; }'); ?>
<?php } 
}

// Search Button background color
function brickyard_get_searchform_button_background_color() {
    $searchform_button_background_color = get_option('brickyard_searchform_button_background_color'); 
		if ($searchform_button_background_color != '#' && $searchform_button_background_color != '') { ?>
		<?php _e('#wrapper #searchform .searchform-wrapper .send { background-color: '); ?><?php echo $searchform_button_background_color ?><?php _e('; }'); ?>
<?php } 
}

// Search Button hover color
function brickyard_get_searchform_button_hover_color() {
    $searchform_button_hover_color = get_option('brickyard_searchform_button_hover_color'); 
		if ($searchform_button_hover_color != '#' && $searchform_button_hover_color != '') { ?>
		<?php _e('#wrapper #searchform .searchform-wrapper .send:hover { background-color: '); ?><?php echo $searchform_button_hover_color ?><?php _e('; }'); ?>
<?php } 
}

// Form Fields background color
function brickyard_get_form_fields_background_color() {
    $form_fields_background_color = get_option('brickyard_form_fields_background_color'); 
		if ($form_fields_background_color != '#' && $form_fields_background_color != '') { ?>
		<?php _e('#searchform .searchform-wrapper #s, #wrapper input[type="text"], #wrapper input[type="file"], #wrapper input[type="password"], #wrapper input[type="number"], #wrapper input[type="search"], #wrapper input[type="email"], #wrapper input[type="url"], #wrapper textarea, #wrapper select { background-color: '); ?><?php echo $form_fields_background_color ?><?php _e(' !important; }'); ?>
<?php } 
}

// Form Fields border color
function brickyard_get_form_fields_border_color() {
    $form_fields_border_color = get_option('brickyard_form_fields_border_color'); 
		if ($form_fields_border_color != '#' && $form_fields_border_color != '') { ?>
		<?php _e('body #searchform .searchform-wrapper #s, #wrapper input[type="text"], #wrapper input[type="file"], #wrapper input[type="password"], #wrapper input[type="number"], #wrapper input[type="search"], #wrapper input[type="email"], #wrapper input[type="url"], #wrapper textarea, #wrapper select { border-color: '); ?><?php echo $form_fields_border_color ?><?php _e('; }'); ?>
<?php } 
}

// Buttons background color
function brickyard_get_form_buttons_background_color() {
    $form_buttons_background_color = get_option('brickyard_form_buttons_background_color'); 
		if ($form_buttons_background_color != '#' && $form_buttons_background_color != '') { ?>
		<?php _e('#wrapper input[type="submit"], #wrapper input[type="reset"], #wrapper .custom-button, html #wrapper #container .panel-row-style-brickyard .origin-widget-button a, #wrapper #container .post-entry .read-more-button { background-color: '); ?><?php echo $form_buttons_background_color ?><?php _e(' !important; }'); ?>
<?php } 
}

// Buttons hover color
function brickyard_get_form_buttons_hover_color() {
    $form_buttons_hover_color = get_option('brickyard_form_buttons_hover_color'); 
		if ($form_buttons_hover_color != '#' && $form_buttons_hover_color != '') { ?>
		<?php _e('#wrapper input[type="submit"]:hover, #wrapper input[type="reset"]:hover, #wrapper .custom-button:hover, html #wrapper #container .panel-row-style-brickyard .origin-widget-button a:hover, #wrapper #container .post-entry .read-more-button:hover { background: '); ?><?php echo $form_buttons_hover_color ?><?php _e(' !important; }'); ?>
<?php } 
}

// Table Headers background color
function brickyard_get_table_headers_background_color() {
    $table_headers_background_color = get_option('brickyard_table_headers_background_color'); 
		if ($table_headers_background_color != '#' && $table_headers_background_color != '') { ?>
		<?php _e('#wrapper table th { background-color: '); ?><?php echo $table_headers_background_color ?><?php _e('; }'); ?>
<?php } 
}

// TEXT COLORS AND FONTS
// Body font and color
function brickyard_get_body_font() {
    $bodyfont = get_option('brickyard_body_google_fonts');
    $body_color = get_option('brickyard_body_color'); 
		if ($bodyfont != 'default' && $body_color != '#' && $bodyfont != '') { ?>
		<?php _e('html body, #wrapper blockquote, #wrapper q, #wrapper #container #comments .comment, #wrapper #container #comments .comment time, #wrapper #container #commentform .form-allowed-tags, #wrapper #container #commentform p, #wrapper input, #wrapper button, #wrapper select, #wrapper #content .breadcrumb-navigation, #wrapper #main-content .post-meta { font-family: "'); ?><?php echo $bodyfont ?><?php _e('", Arial, Helvetica, sans-serif; color: '); ?><?php echo $body_color ?><?php _e('; }'); }
    elseif ($bodyfont != 'default' && $body_color == '#') { ?>
    <?php _e('html body, #wrapper blockquote, #wrapper q, #wrapper #container #comments .comment, #wrapper #container #comments .comment time, #wrapper #container #commentform .form-allowed-tags, #wrapper #container #commentform p, #wrapper input, #wrapper button, #wrapper select, #wrapper #content .breadcrumb-navigation, #wrapper #main-content .post-meta { font-family: "'); ?><?php echo $bodyfont ?><?php _e('", Arial, Helvetica, sans-serif; }'); }
    elseif ($bodyfont == 'default' && $body_color != '#') { ?>
    <?php _e('html body, #wrapper blockquote, #wrapper q, #wrapper #container #comments .comment, #wrapper #container #comments .comment time, #wrapper #container #commentform .form-allowed-tags, #wrapper #container #commentform p, #wrapper input, #wrapper button, #wrapper select, #wrapper #content .breadcrumb-navigation, #wrapper #main-content .post-meta { color: '); ?><?php echo $body_color ?><?php _e('; }'); ?>
<?php } 
}

// Main Content area font size
function brickyard_get_body_google_fonts_size() {
    $body_google_fonts_size = get_option('brickyard_body_google_fonts_size'); 
		if ($body_google_fonts_size != '13' && $body_google_fonts_size != '') { ?>
		<?php _e('body p, body ul, body ol, body li, body dl, body address, body table { font-size: '); ?><?php echo $body_google_fonts_size ?><?php _e('px; }'); ?>
<?php } 
}

// Site title font
function brickyard_get_headings_google_fonts() {
    $headingfont = get_option('brickyard_headings_google_fonts'); 
		if ($headingfont != 'default' && $headingfont != '') { ?>
		<?php _e('#wrapper #header .site-title { font-family: "'); ?><?php echo $headingfont ?><?php _e('", Arial, Helvetica, sans-serif; }'); ?>
<?php } 
}

// Site title font size
function brickyard_get_headings_google_fonts_size() {
    $headingfont_size = get_option('brickyard_headings_google_fonts_size'); 
		if ($headingfont_size != '48' && $headingfont_size != '') { ?>
		<?php _e('#wrapper #header .site-title { font-size: '); ?><?php echo $headingfont_size ?><?php _e('px; }'); ?>
<?php } 
}

// Site title color
function brickyard_get_site_title_color() {
    $site_title_color = get_option('brickyard_site_title_color'); 
		if ($site_title_color != '#' && $site_title_color != '') { ?>
		<?php _e('#wrapper #header .site-title a { color: '); ?><?php echo $site_title_color ?><?php _e('; }'); ?>
<?php } 
}

// Site title hover color
function brickyard_get_site_title_hover_color() {
    $site_title_hover_color = get_option('brickyard_site_title_hover_color'); 
		if ($site_title_hover_color != '#' && $site_title_hover_color != '') { ?>
		<?php _e('#wrapper #header .site-title a:hover { color: '); ?><?php echo $site_title_hover_color ?><?php _e('; }'); ?>
<?php } 
}

// Site description font and color
function brickyard_get_description_font() {
    $descriptionfont = get_option('brickyard_description_google_fonts');
    $site_description_color = get_option('brickyard_site_description_color'); 
		if ($descriptionfont != 'default' && $site_description_color != '#' && $descriptionfont != '') { ?>
		<?php _e('#wrapper #header .site-description {font-family: "'); ?><?php echo $descriptionfont ?><?php _e('", Arial, Helvetica, sans-serif; color: '); ?><?php echo $site_description_color ?><?php _e('; }'); }
    elseif ($descriptionfont != 'default' && $site_description_color == '#') { ?>
    <?php _e('#wrapper #header .site-description {font-family: "'); ?><?php echo $descriptionfont ?><?php _e('", Arial, Helvetica, sans-serif; }'); }
    elseif ($descriptionfont == 'default' && $site_description_color != '#') { ?>
    <?php _e('#wrapper #header .site-description { color: '); ?><?php echo $site_description_color ?><?php _e('; }'); ?>
<?php } 
}

// Site description font size
function brickyard_get_description_font_size() {
    $descriptionfont_size = get_option('brickyard_description_google_fonts_size'); 
		if ($descriptionfont_size != '20' && $descriptionfont_size != '') { ?>
		<?php _e('#wrapper #header .site-description { font-size: '); ?><?php echo $descriptionfont_size ?><?php _e('px; }'); ?>
<?php } 
}

// Page/post main headlines color
function brickyard_get_main_headlines_color() {
    $main_headlines_color = get_option('brickyard_main_headlines_color'); 
		if ($main_headlines_color != '#' && $main_headlines_color != '') { ?>
		<?php _e('#wrapper #main-content #content .content-headline .entry-headline { color: '); ?><?php echo $main_headlines_color ?><?php _e('; }'); ?>
<?php } 
}

// Page/post headlines font and color
function brickyard_get_headlines_font() {
    $headlinefont = get_option('brickyard_headline_google_fonts');
    $headlines_color = get_option('brickyard_headlines_color'); 
		if ($headlinefont != 'default' && $headlines_color != '#' && $headlinefont != '') { ?>
		<?php _e('#wrapper h1, #wrapper h2, #wrapper h3, #wrapper h4, #wrapper h5, #wrapper h6, #wrapper #container .navigation .section-heading, #wrapper .info-box .info-box-headline, #wrapper #comments .entry-headline { font-family: "'); ?><?php echo $headlinefont ?><?php _e('", Arial, Helvetica, sans-serif; color: '); ?><?php echo $headlines_color ?><?php _e('; }'); }
    elseif ($headlinefont != 'default' && $headlines_color == '#') { ?>
		<?php _e('#wrapper h1, #wrapper h2, #wrapper h3, #wrapper h4, #wrapper h5, #wrapper h6, #wrapper #container .navigation .section-heading, #wrapper .info-box .info-box-headline, #wrapper #comments .entry-headline { font-family: "'); ?><?php echo $headlinefont ?><?php _e('", Arial, Helvetica, sans-serif; }'); } 
    elseif ($headlinefont == 'default' && $headlines_color != '#') { ?>
		<?php _e('#wrapper h1, #wrapper h2, #wrapper h3, #wrapper h4, #wrapper h5, #wrapper h6, #wrapper #container .navigation .section-heading, #wrapper .info-box .info-box-headline, #wrapper #comments .entry-headline { color: '); ?><?php echo $headlines_color ?><?php _e('; }');?>
<?php } 
}

// H1 Headlines font size
function brickyard_get_headline_h1_size() {
    $headline_h1_size = get_option('brickyard_headline_h1_size'); 
		if ($headline_h1_size != '27' && $headline_h1_size != '') { ?>
		<?php _e('#wrapper h1 { font-size: '); ?><?php echo $headline_h1_size ?><?php _e('px; }'); ?>
<?php } 
}

// H2 Headlines font size
function brickyard_get_headline_h2_size() {
    $headline_h2_size = get_option('brickyard_headline_h2_size'); 
		if ($headline_h2_size != '21' && $headline_h2_size != '') { ?>
		<?php _e('#wrapper h2 { font-size: '); ?><?php echo $headline_h2_size ?><?php _e('px; }'); ?>
<?php } 
}

// H3 Headlines font size
function brickyard_get_headline_h3_size() {
    $headline_h3_size = get_option('brickyard_headline_h3_size'); 
		if ($headline_h3_size != '18' && $headline_h3_size != '') { ?>
		<?php _e('#wrapper h3 { font-size: '); ?><?php echo $headline_h3_size ?><?php _e('px; }'); ?>
<?php } 
}

// H4 Headlines font size
function brickyard_get_headline_h4_size() {
    $headline_h4_size = get_option('brickyard_headline_h4_size'); 
		if ($headline_h4_size != '16' && $headline_h4_size != '') { ?>
		<?php _e('#wrapper h4 { font-size: '); ?><?php echo $headline_h4_size ?><?php _e('px; }'); ?>
<?php } 
}

// H5 Headlines font size
function brickyard_get_headline_h5_size() {
    $headline_h5_size = get_option('brickyard_headline_h5_size'); 
		if ($headline_h5_size != '14' && $headline_h5_size != '') { ?>
		<?php _e('#wrapper h5 { font-size: '); ?><?php echo $headline_h5_size ?><?php _e('px; }'); ?>
<?php } 
}

// H6 Headlines font size
function brickyard_get_headline_h6_size() {
    $headline_h6_size = get_option('brickyard_headline_h6_size'); 
		if ($headline_h6_size != '13' && $headline_h6_size != '') { ?>
		<?php _e('#wrapper h6 { font-size: '); ?><?php echo $headline_h6_size ?><?php _e('px; }'); ?>
<?php } 
}

// BrickYard Posts Widgets headlines font
function brickyard_get_headline_box_google_fonts() {
    $headline_box_google_fonts = get_option('brickyard_headline_box_google_fonts'); 
		if ($headline_box_google_fonts != 'default' && $headline_box_google_fonts != '') { ?>
		<?php _e('#wrapper #container #main-content section .entry-headline { font-family: "'); ?><?php echo $headline_box_google_fonts ?><?php _e('", Arial, Helvetica, sans-serif; }'); ?>
<?php } 
}

// BrickYard Posts Widgets headlines color
function brickyard_get_homepage_headlines_color() {
    $homepage_headlines_color = get_option('brickyard_homepage_headlines_color'); 
		if ($homepage_headlines_color != '#' && $homepage_headlines_color != '') { ?>
		<?php _e('#wrapper #container #main-content section .entry-headline { color: '); ?><?php echo $homepage_headlines_color ?><?php _e('; }'); ?>
<?php } 
}

// BrickYard Posts Widgets headlines font size
function brickyard_get_headline_box_google_fonts_size() {
    $headline_box_google_fonts_size = get_option('brickyard_headline_box_google_fonts_size'); 
		if ($headline_box_google_fonts_size != '27' && $headline_box_google_fonts_size != '') { ?>
		<?php _e('#wrapper #container #main-content section .entry-headline { font-size: '); ?><?php echo $headline_box_google_fonts_size ?><?php _e('px; }'); ?>
<?php } 
}

// Post entry font
function brickyard_get_postentry_font() {
    $postentryfont = get_option('brickyard_postentry_google_fonts'); 
		if ($postentryfont != 'default' && $postentryfont != '') { ?>
		<?php _e('#wrapper #main-content .post-entry .post-entry-headline, #wrapper #main-content .slides li a, #wrapper #main-content .home-list-posts ul li a { font-family: "'); ?><?php echo $postentryfont ?><?php _e('", Arial, Helvetica, sans-serif; }'); ?>
<?php } 
}

// Post entry font size
function brickyard_get_postentry_font_size() {
    $postentryfont_size = get_option('brickyard_postentry_google_fonts_size'); 
		if ($postentryfont_size != '21' && $postentryfont_size != '') { ?>
		<?php _e('#wrapper #main-content .post-entry .post-entry-headline { font-size: '); ?><?php echo $postentryfont_size ?><?php _e('px; }'); ?>
<?php } 
}

// Post entry color
function brickyard_get_postentry_color() {
    $post_entry_color = get_option('brickyard_post_entry_color'); 
		if ($post_entry_color != '#' && $post_entry_color != '') { ?>
		<?php _e('#wrapper #main-content .post-entry .post-entry-headline a, #wrapper #main-content .slides li a, #wrapper #main-content .home-list-posts ul li a { color: '); ?><?php echo $post_entry_color ?><?php _e('; }'); ?>
<?php } 
}  

// Post entry hover color
function brickyard_get_postentry_hover_color() {
    $post_entry_hover_color = get_option('brickyard_post_entry_hover_color'); 
		if ($post_entry_hover_color != '#' && $post_entry_hover_color != '') { ?>
		<?php _e('#wrapper #main-content .post-entry .post-entry-headline a:hover, #wrapper #main-content .slides li a:hover, #wrapper #main-content .home-list-posts ul li a:hover { color: '); ?><?php echo $post_entry_hover_color ?><?php _e(' !important; }'); ?>
<?php } 
} 

// Sidebar widget headlines font and color
function brickyard_get_sidebar_widget_font() {
    $sidebarfont = get_option('brickyard_sidebar_google_fonts');
    $sidebar_widget_color = get_option('brickyard_sidebar_widget_color');
		if ($sidebarfont != 'default' && $sidebar_widget_color != '#' && $sidebarfont != '') { ?>
		<?php _e('#wrapper #container #sidebar .sidebar-widget .sidebar-headline { font-family: "'); ?><?php echo $sidebarfont ?><?php _e('", Arial, Helvetica, sans-serif; color: '); ?><?php echo $sidebar_widget_color ?><?php _e('; }'); }
    elseif ($sidebarfont != 'default' && $sidebar_widget_color == '#') { ?>
		<?php _e('#wrapper #container #sidebar .sidebar-widget .sidebar-headline { font-family: "'); ?><?php echo $sidebarfont ?><?php _e('", Arial, Helvetica, sans-serif; }'); }
    elseif ($sidebarfont == 'default' && $sidebar_widget_color != '#') { ?>
		<?php _e('#wrapper #container #sidebar .sidebar-widget .sidebar-headline { color: '); ?><?php echo $sidebar_widget_color ?><?php _e('; }'); ?>
<?php } 
}

// Sidebar widget headlines font size
function brickyard_get_sidebar_widget_font_size() {
    $sidebarfont_size = get_option('brickyard_sidebar_google_fonts_size'); 
		if ($sidebarfont_size != '19' && $sidebarfont_size != '') { ?>
		<?php _e('#wrapper #container #sidebar .sidebar-widget .sidebar-headline { font-size: '); ?><?php echo $sidebarfont_size ?><?php _e('px; }'); ?>
<?php } 
}

// Sidebar Text color
function brickyard_get_sidebar_text_color() {
    $sidebar_text_color = get_option('brickyard_sidebar_text_color'); 
		if ($sidebar_text_color != '#' && $sidebar_text_color != '') { ?>
		<?php _e('#wrapper #container #sidebar .sidebar-widget p, #wrapper #container #sidebar .sidebar-widget ul li, #wrapper #container #sidebar .sidebar-widget ol li, #wrapper #container #sidebar .sidebar-widget table { color: '); ?><?php echo $sidebar_text_color ?><?php _e('; }'); ?>
<?php } 
}

// Footer widget headlines font and color
function brickyard_get_footer_widget_font() {
    $sidebarfont = get_option('brickyard_sidebar_google_fonts');
    $footer_widget_color = get_option('brickyard_footer_widget_color');
		if ($sidebarfont != 'default' && $footer_widget_color != '#' && $sidebarfont != '') { ?>
		<?php _e('#wrapper #wrapper-footer #footer .footer-widget .footer-headline { font-family: "'); ?><?php echo $sidebarfont ?><?php _e('", Arial, Helvetica, sans-serif; color: '); ?><?php echo $footer_widget_color ?><?php _e('; }'); }
    elseif ($sidebarfont != 'default' && $footer_widget_color == '#') { ?>
		<?php _e('#wrapper #wrapper-footer #footer .footer-widget .footer-headline { font-family: "'); ?><?php echo $sidebarfont ?><?php _e('", Arial, Helvetica, sans-serif; }'); }
    elseif ($sidebarfont == 'default' && $footer_widget_color != '#') { ?>
		<?php _e('#wrapper #wrapper-footer #footer .footer-widget .footer-headline { color: '); ?><?php echo $footer_widget_color ?><?php _e('; }'); ?>
<?php } 
}

// Footer widget headlines font size
function brickyard_get_footer_widget_font_size() {
    $footerfont_size = get_option('brickyard_footer_google_fonts_size'); 
		if ($footerfont_size != '19' && $footerfont_size != '') { ?>
		<?php _e('#wrapper #wrapper-footer #footer .footer-widget .footer-headline { font-size: '); ?><?php echo $footerfont_size ?><?php _e('px; }'); ?>
<?php } 
}

// Footer Text color
function brickyard_get_footer_text_color() {
    $footer_text_color = get_option('brickyard_footer_text_color'); 
		if ($footer_text_color != '#' && $footer_text_color != '') { ?>
		<?php _e('#wrapper #footer .footer-widget p, #wrapper #footer .footer-widget ul li, #wrapper #footer .footer-widget ol li, #wrapper #footer .footer-widget table, #wrapper .footer-signature .footer-signature-content p { color: '); ?><?php echo $footer_text_color ?><?php _e('; }'); ?>
<?php } 
}

// Footer Notices Text color
function brickyard_get_footer_notices_text_color() {
    $footer_notices_text_color = get_option('brickyard_footer_notices_text_color'); 
		if ($footer_notices_text_color != '#' && $footer_notices_text_color != '') { ?>
		<?php _e('#wrapper #wrapper-footer .footer-signature .footer-signature-content p { color: '); ?><?php echo $footer_notices_text_color ?><?php _e('; }'); ?>
<?php } 
}

// Main content links color
function brickyard_get_content_links_color() {
    $content_links_color = get_option('brickyard_content_links_color'); 
		if ($content_links_color != '#' && $content_links_color != '') { ?>
		<?php _e('#wrapper #content a { color: '); ?><?php echo $content_links_color ?><?php _e('; }'); ?>
<?php } 
}

// Sidebar links color
function brickyard_get_sidebar_links_color() {
    $sidebar_links_color = get_option('brickyard_sidebar_links_color'); 
		if ($sidebar_links_color != '#' && $sidebar_links_color != '') { ?>
		<?php _e('#wrapper #container #sidebar a { color: '); ?><?php echo $sidebar_links_color ?><?php _e('; }'); ?>
<?php } 
}

// Footer links color
function brickyard_get_footer_links_color() {
    $footer_links_color = get_option('brickyard_footer_links_color'); 
		if ($footer_links_color != '#' && $footer_links_color != '') { ?>
		<?php _e('#wrapper #wrapper-footer #footer a { color: '); ?><?php echo $footer_links_color ?><?php _e('; }'); ?>
<?php } 
}

// Footer Notices links color
function brickyard_get_footer_notices_links_color() {
    $footer_notices_links_color = get_option('brickyard_footer_notices_links_color'); 
		if ($footer_notices_links_color != '#' && $footer_notices_links_color != '') { ?>
		<?php _e('#wrapper #wrapper-footer .footer-signature .footer-signature-content a { color: '); ?><?php echo $footer_notices_links_color ?><?php _e('; }'); ?>
<?php } 
}

// Main Header menu links color
function brickyard_get_main_header_menu_color() {
    $main_header_menu_color = get_option('brickyard_main_header_menu_color'); 
		if ($main_header_menu_color != '#' && $main_header_menu_color != '') { ?>
		<?php _e('#wrapper #header .menu-box a, #wrapper #header .menu-box a:visited, .js #container #header .menu-box .selectnav { color: '); ?><?php echo $main_header_menu_color ?><?php _e('; }'); ?>
<?php } 
}

// Main Header menu links hover color
function brickyard_get_main_header_menu_hover_color() {
    $main_header_menu_hover_color = get_option('brickyard_main_header_menu_hover_color'); 
		if ($main_header_menu_hover_color != '#' && $main_header_menu_hover_color != '') { ?>
		<?php _e('#wrapper #header .menu-box a:hover, #wrapper #header .menu-box :hover > a { color: '); ?><?php echo $main_header_menu_hover_color ?><?php _e('; }'); ?>
<?php } 
}

// Main Header menu links hover background color
function brickyard_get_main_header_menu_hover_background_color() {
    $main_header_menu_hover_background_color = get_option('brickyard_main_header_menu_hover_background_color'); 
		if ($main_header_menu_hover_background_color != '#' && $main_header_menu_hover_background_color != '') { ?>
		<?php _e('#wrapper #header .menu-box a:hover, #wrapper #header .menu-box :hover > a { background-color: '); ?><?php echo $main_header_menu_hover_background_color ?><?php _e('; }'); ?>
<?php } 
}

// Active Main Header menu links color
function brickyard_get_active_main_header_menu_color() {
    $active_main_header_menu_color = get_option('brickyard_active_main_header_menu_color');
    if ($active_main_header_menu_color != '#' && $active_main_header_menu_color != '') { ?>
		<?php _e('html #wrapper #header .menu-box .current-menu-item > a, html #wrapper #header .menu-box .current-menu-ancestor > a, html #wrapper #header .menu-box .current_page_item > a, html #wrapper #header .menu-box .current-page-ancestor > a { color: '); ?><?php echo $active_main_header_menu_color ?><?php _e('; }'); ?>
<?php } 
}

// Active Main Header menu links background color
function brickyard_get_active_main_header_menu_background_color() {
    $active_main_header_menu_background_color = get_option('brickyard_active_main_header_menu_background_color');
    if ($active_main_header_menu_background_color != '#' && $active_main_header_menu_background_color != '') { ?>
		<?php _e('html #wrapper #header .menu-box .current-menu-item > a, html #wrapper #header .menu-box .current-menu-ancestor > a, html #wrapper #header .menu-box .current_page_item > a, html #wrapper #header .menu-box .current-page-ancestor > a, html .home #container #header .menu-box .link-home { background-color: '); ?><?php echo $active_main_header_menu_background_color ?><?php _e('; }'); ?>
<?php } 
}

// Top Header menu links color
function brickyard_get_top_header_menu_color() {
    $top_header_menu_color = get_option('brickyard_top_header_menu_color'); 
		if ($top_header_menu_color != '#' && $top_header_menu_color != '') { ?>
		<?php _e('#wrapper #top-navigation-wrapper .top-navigation a, #wrapper #top-navigation-wrapper .top-navigation a:visited, .js #container #top-navigation-wrapper .selectnav { color: '); ?><?php echo $top_header_menu_color ?><?php _e('; }'); ?>
<?php } 
}

// Top Header menu links hover color
function brickyard_get_top_header_menu_hover_color() {
    $top_header_menu_hover_color = get_option('brickyard_top_header_menu_hover_color'); 
		if ($top_header_menu_hover_color != '#' && $top_header_menu_hover_color != '') { ?>
		<?php _e('#wrapper #top-navigation-wrapper .top-navigation a:hover, #wrapper #top-navigation-wrapper .top-navigation :hover > a { color: '); ?><?php echo $top_header_menu_hover_color ?><?php _e('; }'); ?>
<?php } 
}

// Top Header menu links hover background color
function brickyard_get_top_header_menu_hover_background_color() {
    $top_header_menu_hover_background_color = get_option('brickyard_top_header_menu_hover_background_color'); 
		if ($top_header_menu_hover_background_color != '#' && $top_header_menu_hover_background_color != '') { ?>
		<?php _e('#wrapper #top-navigation-wrapper .top-navigation ul a:hover, #wrapper #top-navigation-wrapper .top-navigation ul :hover > a { background-color: '); ?><?php echo $top_header_menu_hover_background_color ?><?php _e('; }'); ?>
<?php } 
}

// Active Top Header menu links color
function brickyard_get_active_top_header_menu_color() {
    $active_top_header_menu_color = get_option('brickyard_active_top_header_menu_color');
    if ($active_top_header_menu_color != '#' && $active_top_header_menu_color != '') { ?>
		<?php _e('html #wrapper #top-navigation-wrapper .top-navigation .current-menu-item > a, html #wrapper #top-navigation-wrapper .top-navigation .current-menu-ancestor > a, html #wrapper #top-navigation-wrapper .top-navigation .current_page_item > a, html #wrapper #top-navigation-wrapper .top-navigation .current-page-ancestor > a { color: '); ?><?php echo $active_top_header_menu_color ?><?php _e('; }'); ?>
<?php } 
}

// Top Menu drop-down submenus items text color
function brickyard_get_top_submenu_text_color() {
    $top_submenu_text_color = get_option('brickyard_top_submenu_text_color'); 
		if ($top_submenu_text_color != '#' && $top_submenu_text_color != '') { ?>
		<?php _e('html #wrapper #top-navigation-wrapper .top-navigation ul ul a, html #wrapper #top-navigation-wrapper .top-navigation ul ul a:visited { color: '); ?><?php echo $top_submenu_text_color ?><?php _e(' !important; }'); ?>
<?php } 
}

// Main Header menu font
function brickyard_get_menu_font() {
    $menufont = get_option('brickyard_menu_google_fonts'); 
		if ($menufont != 'default' && $menufont != '') { ?>
		<?php _e('#wrapper #header .menu-box ul li a { font-family: "'); ?><?php echo $menufont ?><?php _e('", Arial, Helvetica, sans-serif; }'); ?>
<?php } 
}

// Main Header menu font size
function brickyard_get_menu_font_size() {
    $menufont_size = get_option('brickyard_menu_google_fonts_size'); 
		if ($menufont_size != '14' && $menufont_size != '') { ?>
		<?php _e('#wrapper #header .menu-box ul li a { font-size: '); ?><?php echo $menufont_size ?><?php _e('px; }'); ?>
<?php } 
}

// Top Header menu font
function brickyard_get_top_menu_font() {
    $topmenufont = get_option('brickyard_top_menu_google_fonts'); 
		if ($topmenufont != 'default' && $topmenufont != '') { ?>
		<?php _e('#wrapper #top-navigation-wrapper .top-navigation ul li { font-family: "'); ?><?php echo $topmenufont ?><?php _e('", Arial, Helvetica, sans-serif; }'); ?>
<?php } 
}

// Top Header menu font size
function brickyard_get_top_menu_font_size() {
    $top_menufont_size = get_option('brickyard_top_menu_google_fonts_size'); 
		if ($top_menufont_size != '13' && $top_menufont_size != '') { ?>
		<?php _e('#wrapper #top-navigation-wrapper .top-navigation ul li a, html #wrapper #wrapper-header .top-navigation ul ul a { font-size: '); ?><?php echo $top_menufont_size ?><?php _e('px; }'); ?>
<?php } 
}

// User defined CSS.
function brickyard_get_own_css() {
    $own_css = get_option('brickyard_own_css'); 
		if ($own_css != '') { ?>
		<?php echo esc_attr($own_css); ?>
<?php } 
}

// Display custom CSS.
function brickyard_custom_styles() { ?>
<?php echo ("<style type='text/css'>"); ?>
<?php brickyard_get_own_css(); ?>
<?php brickyard_background_image_size(); ?>
<?php brickyard_get_background_pattern_opacity(); ?>
<?php brickyard_display_sidebar(); ?>
<?php brickyard_display_search_form(); ?>
<?php brickyard_display_meta_post_entry(); ?>
<?php brickyard_get_social_icons_background_color(); ?>
<?php brickyard_get_top_menu_background_color(); ?>
<?php brickyard_get_top_submenu_background_color(); ?>
<?php brickyard_get_top_submenu_border_color(); ?>
<?php brickyard_get_top_submenu_hover_color(); ?>
<?php brickyard_get_main_menu_background_color(); ?>
<?php brickyard_get_main_menu_border_color(); ?>
<?php brickyard_get_main_menu_links_border_color(); ?>
<?php brickyard_get_main_submenu_background_color(); ?>
<?php brickyard_get_main_submenu_border_color(); ?>
<?php brickyard_get_main_submenu_hover_color(); ?>
<?php brickyard_get_header_content_background_color(); ?>
<?php brickyard_get_main_content_background_color(); ?>
<?php brickyard_get_shadows_color(); ?>
<?php brickyard_get_author_comments_background_color(); ?>
<?php brickyard_get_sticky_post_background_color(); ?>
<?php brickyard_get_posts_thumbnail_background_color(); ?>
<?php brickyard_get_highlight_background_color(); ?>
<?php brickyard_get_footer_background_color(); ?>
<?php brickyard_get_footer_notices_background_color(); ?>
<?php brickyard_get_searchform_border_color(); ?>
<?php brickyard_get_searchform_button_background_color(); ?>
<?php brickyard_get_searchform_button_hover_color(); ?>
<?php brickyard_get_form_fields_background_color(); ?>
<?php brickyard_get_form_fields_border_color(); ?>
<?php brickyard_get_form_buttons_background_color(); ?>
<?php brickyard_get_form_buttons_hover_color(); ?>
<?php brickyard_get_table_headers_background_color(); ?>
<?php brickyard_get_body_font(); ?>
<?php brickyard_get_body_google_fonts_size(); ?>
<?php brickyard_get_headings_google_fonts(); ?>
<?php brickyard_get_headings_google_fonts_size(); ?>
<?php brickyard_get_site_title_color(); ?>
<?php brickyard_get_site_title_hover_color(); ?>
<?php brickyard_get_description_font(); ?>
<?php brickyard_get_description_font_size(); ?>
<?php brickyard_get_main_headlines_color(); ?>
<?php brickyard_get_headlines_font(); ?>
<?php brickyard_get_headline_h1_size(); ?>
<?php brickyard_get_headline_h2_size(); ?>
<?php brickyard_get_headline_h3_size(); ?>
<?php brickyard_get_headline_h4_size(); ?>
<?php brickyard_get_headline_h5_size(); ?>
<?php brickyard_get_headline_h6_size(); ?>
<?php brickyard_get_headline_box_google_fonts(); ?>
<?php brickyard_get_homepage_headlines_color(); ?>
<?php brickyard_get_headline_box_google_fonts_size(); ?>
<?php brickyard_get_postentry_font(); ?>
<?php brickyard_get_postentry_font_size(); ?>
<?php brickyard_get_postentry_color(); ?>
<?php brickyard_get_postentry_hover_color(); ?>
<?php brickyard_get_sidebar_widget_font(); ?>
<?php brickyard_get_sidebar_widget_font_size(); ?>
<?php brickyard_get_sidebar_text_color(); ?>
<?php brickyard_get_footer_widget_font(); ?>
<?php brickyard_get_footer_widget_font_size(); ?>
<?php brickyard_get_footer_text_color(); ?>
<?php brickyard_get_footer_notices_text_color(); ?>
<?php brickyard_get_content_links_color(); ?>
<?php brickyard_get_sidebar_links_color(); ?>
<?php brickyard_get_footer_links_color(); ?>
<?php brickyard_get_footer_notices_links_color(); ?>
<?php brickyard_get_main_header_menu_color(); ?>
<?php brickyard_get_main_header_menu_hover_color(); ?>
<?php brickyard_get_main_header_menu_hover_background_color(); ?>
<?php brickyard_get_active_main_header_menu_color(); ?>
<?php brickyard_get_active_main_header_menu_background_color(); ?>
<?php brickyard_get_top_header_menu_color(); ?>
<?php brickyard_get_top_header_menu_hover_color(); ?>
<?php brickyard_get_top_header_menu_hover_background_color(); ?>
<?php brickyard_get_active_top_header_menu_color(); ?>
<?php brickyard_get_top_submenu_text_color(); ?>
<?php brickyard_get_menu_font(); ?>
<?php brickyard_get_menu_font_size(); ?>
<?php brickyard_get_top_menu_font(); ?>
<?php brickyard_get_top_menu_font_size(); ?>
<?php echo ("</style>"); ?>
<?php
} 
add_action('wp_enqueue_scripts', 'brickyard_custom_styles');	?>