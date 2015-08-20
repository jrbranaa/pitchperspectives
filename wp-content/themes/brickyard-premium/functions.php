<?php
/**
 * BrickYard functions and definitions.
 * @package BrickYard
 * @since BrickYard 1.0.0
*/

/**
 * BrickYard theme variables.
 *  
*/    
$brickyard_themename = "BrickYard Premium";			//Theme Name
$brickyard_themever = "1.2.3";									//Theme version
$brickyard_shortname = "brickyard";							//Shortname 
$brickyard_manualurl = get_template_directory_uri() . '/docs/documentation.html';	//Manual Url
// Set path to BrickYard Framework and theme specific functions
$brickyard_be_path = get_template_directory() . '/functions/be/';									//BackEnd Path
$brickyard_fe_path = get_template_directory() . '/functions/fe/';									//FrontEnd Path 
$brickyard_be_pathimages = get_template_directory_uri() . '/functions/be/images';		//BackEnd Path
$brickyard_fe_pathimages = get_template_directory_uri() . '';	//FrontEnd Path
//Include Framework [BE] 
require_once ($brickyard_be_path . 'fw-setup.php');		   // Init 
require_once ($brickyard_be_path . 'fw-options.php');	 	 // Framework Init  
// Include Theme specific functionality [FE] 
require_once ($brickyard_fe_path . 'headerdata.php');		 // Include css and js
require_once ($brickyard_fe_path . 'library.php');	       // Include library, functions
require_once ($brickyard_fe_path . 'widget-social.php');	 // Social Widget
require_once ($brickyard_fe_path . 'widget-twitter.php'); // Twitter Widget
require_once ($brickyard_fe_path . 'widget-facebook.php');// Facebook Widget
require_once ($brickyard_fe_path . 'widget-info-box.php');// Info-Box Widget
require_once ($brickyard_fe_path . 'widget-posts-column.php');// Posts-Column Widget
require_once ($brickyard_fe_path . 'widget-posts-default.php');// Posts-Default Widget
require_once ($brickyard_fe_path . 'widget-posts-grid.php');// Posts-Grid Widget
require_once ($brickyard_fe_path . 'widget-posts-list.php');// Posts-List Widget
require_once ($brickyard_fe_path . 'widget-posts-slider.php');// Posts-Slider Widget
require_once ($brickyard_fe_path . 'widget-posts-thumbnail.php');// Posts-Thumbnail Widget
require_once ($brickyard_fe_path . 'google-map-shortcode.php');// Google Maps Shortcode
require_once ($brickyard_fe_path . '/wp-display-header/wp-display-header.php');// Different Header Images for individual pages
require_once ($brickyard_fe_path . '/wp-tab-widget/wp-tab-widget.php');// Tab Widget



/**
 * BrickYard theme basic setup.
 *  
*/
function brickyard_setup() {
	// Makes BrickYard available for translation.
	load_theme_textdomain( 'brickyard', get_template_directory() . '/languages' );
  // This theme styles the visual editor to resemble the theme style.
  $brickyard_font_url = add_query_arg( 'family', 'Oswald', "//fonts.googleapis.com/css" );
  add_editor_style( array( 'editor-style.css', $brickyard_font_url ) );
	// Adds RSS feed links to <head> for posts and comments.  
	add_theme_support( 'automatic-feed-links' );
	// This theme supports custom background color and image.
	$defaults = array(
	'default-color' => '', 
  'default-image' => '',
	'wp-head-callback' => '_custom_background_cb',
	'admin-head-callback' => '',
	'admin-preview-callback' => '' );  
  add_theme_support( 'custom-background', $defaults );
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 972, 9999 );
  add_image_size( 'grid-thumb', 196, 131, true );
  add_image_size( 'square-thumb', 60, 60, true );
  add_image_size( 'slider-thumb', 148, 100, true );
  add_image_size( 'thumbnail-thumb', 153, 102, true );
  // This theme uses a custom header background image.
  $args = array(
	'width' => 1012,
  'flex-width' => true,
  'flex-height' => true,
  'header-text' => false,
  'random-default' => true,);
  add_theme_support( 'custom-header', $args );
  add_theme_support( 'title-tag' );
  add_theme_support( 'woocommerce' );
  global $content_width;
  if ( ! isset( $content_width ) ) { $content_width = 616; }
}
add_action( 'after_setup_theme', 'brickyard_setup' );

/**
 * Enqueues scripts and styles for front-end.
 *
*/
function brickyard_scripts_styles() {
	global $wp_styles, $wp_scripts;
	// Adds JavaScript
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
    wp_enqueue_script( 'brickyard-flexslider', get_template_directory_uri() . '/js/flexslider.js', array( 'jquery' ), '2.2.2', true );
    wp_enqueue_script( 'brickyard-flexslider-settings', get_template_directory_uri() . '/js/flexslider-settings.js', array( 'jquery' ), '2.2.0', true );
    wp_enqueue_script( 'brickyard-placeholders', get_template_directory_uri() . '/js/placeholders.js', array(), '3.0.2', true );
    wp_enqueue_script( 'brickyard-scroll-to-top', get_template_directory_uri() . '/js/scroll-to-top.js', array( 'jquery' ), '1.0', true );
    if ( !is_page_template('template-landing-page.php') ) {
    wp_enqueue_script( 'brickyard-menubox', get_template_directory_uri() . '/js/menubox.js', array(), '1.0', true ); }
    wp_enqueue_script( 'brickyard-selectnav', get_template_directory_uri() . '/js/selectnav.js', array(), '0.1', true );
    wp_enqueue_script( 'brickyard-responsive', get_template_directory_uri() . '/js/responsive.js', array(), '1.0', true ); 
    wp_enqueue_script( 'brickyard-html5-ie', get_template_directory_uri() . '/js/html5.js', array(), '3.6', false );
    $wp_scripts->add_data( 'brickyard-html5-ie', 'conditional', 'lt IE 9' );  
	// Loads the main stylesheet.
	  wp_enqueue_style( 'brickyard-style', get_stylesheet_uri() );
    wp_enqueue_style( 'brickyard-google-font-default', '//fonts.googleapis.com/css?family=Oswald&amp;subset=latin,latin-ext' );
    wp_enqueue_style( 'brickyard-tab-widget', get_template_directory_uri() . '/functions/fe/wp-tab-widget/css/wp-tab-widget.css' );
    if ( class_exists( 'woocommerce' ) ) { wp_enqueue_style( 'brickyard-woocommerce-custom', get_template_directory_uri() . '/css/woocommerce-custom.css' ); }
}
add_action( 'wp_enqueue_scripts', 'brickyard_scripts_styles' );

/**
 * Backwards compatibility for older WordPress versions which do not support the Title Tag feature.
 *  
*/
if ( ! function_exists( '_wp_render_title_tag' ) ) {
function brickyard_wp_title( $title, $sep ) {
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	return $title;
}
add_filter( 'wp_title', 'brickyard_wp_title', 10, 2 );
}

/**
 * Register our menus.
 *
 */
function brickyard_register_my_menus() {
  register_nav_menus(
    array(
      'main-navigation' => __( 'Main Header Menu', 'brickyard' ),
      'top-navigation' => __( 'Top Header Menu', 'brickyard' )
    )
  );
}
add_action( 'after_setup_theme', 'brickyard_register_my_menus' );

/**
 * Register our sidebars and widgetized areas.
 *
*/
function brickyard_widgets_init() {
  register_sidebar( array(
		'name' => __( 'Right Sidebar', 'brickyard' ),
		'id' => 'sidebar-1',
		'description' => __( 'Right sidebar which appears on all posts and pages.', 'brickyard' ),
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s"><div class="sidebar-widget-inner">',
		'after_widget' => '</div></div>',
		'before_title' => ' <p class="sidebar-headline"><span class="sidebar-headline-text">',
		'after_title' => '</span></p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer left widget area', 'brickyard' ),
		'id' => 'sidebar-2',
		'description' => __( 'Left column with widgets in footer.', 'brickyard' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-headline"><span class="footer-headline-text">',
		'after_title' => '</span></p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer middle widget area', 'brickyard' ),
		'id' => 'sidebar-3',
		'description' => __( 'Middle column with widgets in footer.', 'brickyard' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-headline"><span class="footer-headline-text">',
		'after_title' => '</span></p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer right widget area', 'brickyard' ),
		'id' => 'sidebar-4',
		'description' => __( 'Right column with widgets in footer.', 'brickyard' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-headline"><span class="footer-headline-text">',
		'after_title' => '</span></p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer notices', 'brickyard' ),
		'id' => 'sidebar-5',
		'description' => __( 'The line for copyright and other notices below the footer widget areas. Insert here one Text widget. The "Title" field at this widget should stay empty.', 'brickyard' ),
		'before_widget' => '<div class="footer-signature"><div class="footer-signature-content">',
		'after_widget' => '</div></div>',
		'before_title' => '',
		'after_title' => '',
	) );
  register_sidebar( array(
		'name' => __( 'Latest Posts Homepage widget area', 'brickyard' ),
		'id' => 'sidebar-6',
		'description' => __( 'The area for any BrickYard Posts Widgets, which displays latest posts from a specific category below the default Latest Posts area.', 'brickyard' ),
		'before_widget' => '<div class="entry-content"><div class="entry-content-inner">',
		'after_widget' => '</div></div>',
		'before_title' => '',
		'after_title' => '',
	) );
  register_sidebar( array(
		'name' => __( 'Homepage slideshow', 'brickyard' ),
		'id' => 'sidebar-7',
		'description' => __( 'The area for Cyclone Slider Widget which displays a slideshow on your homepage.', 'brickyard' ),
		'before_widget' => '<div id="slideshow-wrapper">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'brickyard_widgets_init' );

/**
 * Post excerpt settings.
 *
*/
function brickyard_custom_excerpt_length( $length ) {
return 40;
}
add_filter( 'excerpt_length', 'brickyard_custom_excerpt_length', 20 );
function brickyard_new_excerpt_more( $more ) {
global $post;
return '...<br /><a class="read-more-button" href="'. esc_url( get_permalink($post->ID) ) . '">' . __( 'Read more', 'brickyard' ) . '</a>';}
add_filter( 'excerpt_more', 'brickyard_new_excerpt_more' );

/**
 * Short title for Grid Posts.
 *
*/
function brickyard_short_title() {
$title = get_the_title();
$limit = "22";
$pad = "...";
if( strlen( $title ) <= $limit) {
echo $title;
} else {
$title = substr( $title, 0, $limit ) . $pad;
echo $title;
}
} 

if ( ! function_exists( 'brickyard_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
*/
function brickyard_content_nav( $html_id ) {
	global $wp_query;
	$html_id = esc_attr( $html_id );
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div id="<?php echo $html_id; ?>" class="navigation" role="navigation">
    <div class="navigation-inner">
			<h2 class="navigation-headline section-heading"><?php _e( 'Post navigation', 'brickyard' ); ?></h2>
      <div class="nav-wrapper">
			 <p class="navigation-links">
<?php $big = 999999999;
echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
  'prev_text' => __( '&larr; Previous', 'brickyard' ),
	'next_text' => __( 'Next &rarr;', 'brickyard' ),
	'total' => $wp_query->max_num_pages,
	'add_args' => false
) );
?>
        </p>
      </div>
		</div>
    </div>
	<?php endif;
}
endif;

/**
 * Displays navigation to next/previous posts on single posts pages.
 *
*/
function brickyard_prev_next($nav_id) { ?>
<?php $brickyard_previous_post = get_adjacent_post( false, "", true );
$brickyard_next_post = get_adjacent_post( false, "", false ); ?>
<div id="<?php echo $nav_id; ?>" class="navigation" role="navigation">
	<div class="nav-wrapper">
<?php if ( !empty($brickyard_previous_post) ) { ?>
  <p class="nav-previous"><a href="<?php echo esc_url(get_permalink($brickyard_previous_post->ID)); ?>" title="<?php echo esc_attr($brickyard_previous_post->post_title); ?>"><?php _e( '&larr; Previous post', 'brickyard' ); ?></a></p>
<?php } if ( !empty($brickyard_next_post) ) { ?>
	<p class="nav-next"><a href="<?php echo esc_url(get_permalink($brickyard_next_post->ID)); ?>" title="<?php echo esc_attr($brickyard_next_post->post_title); ?>"><?php _e( 'Next post &rarr;', 'brickyard' ); ?></a></p>
<?php } ?>
   </div>
</div>
<?php } 

if ( ! function_exists( 'brickyard_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
*/
function brickyard_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'brickyard' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'brickyard' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<span><b class="fn">%1$s</b> %2$s</span>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<span>' . __( '(Post author)', 'brickyard' ) . '</span>' : ''
					);
					printf( '<time datetime="%2$s">%3$s</time>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						// translators: 1: date, 2: time
						sprintf( __( '%1$s at %2$s', 'brickyard' ), get_comment_date(''), get_comment_time() )
					);
				?>
			</div><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'brickyard' ); ?></p>
			<?php endif; ?>

			<div class="comment-content comment">
				<?php comment_text(); ?>
			 <div class="reply">
			   <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'brickyard' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
			   <?php edit_comment_link( __( 'Edit', 'brickyard' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .comment-content -->
		</div><!-- #comment-## -->
	<?php
		break;
	endswitch;
}
endif;

/**
 * Function for adding custom classes to the menu objects.
 *
*/
add_filter( 'wp_nav_menu_objects', 'brickyard_filter_menu_class', 10, 2 );
function brickyard_filter_menu_class( $objects, $args ) {

    $ids        = array();
    $parent_ids = array();
    $top_ids    = array();
    foreach ( $objects as $i => $object ) {

        if ( 0 == $object->menu_item_parent ) {
            $top_ids[$i] = $object;
            continue;
        }
 
        if ( ! in_array( $object->menu_item_parent, $ids ) ) {
            $objects[$i]->classes[] = 'first-menu-item';
            $ids[]          = $object->menu_item_parent;
        }
 
        if ( in_array( 'first-menu-item', $object->classes ) )
            continue;
 
        $parent_ids[$i] = $object->menu_item_parent;
    }
 
    $sanitized_parent_ids = array_unique( array_reverse( $parent_ids, true ) );
 
    foreach ( $sanitized_parent_ids as $i => $id )
        $objects[$i]->classes[] = 'last-menu-item';
 
    return $objects; 
}

/**
 * Function for rendering CSS3 features in IE.
 *
*/
add_filter( 'wp_head' , 'brickyard_pie' );
function brickyard_pie() { ?>
<!--[if IE]>
<style type="text/css" media="screen">
#header, #wrapper-footer, .entry-content, .sidebar-widget, .page-template-template-page-builder-php .panel, .page-template-template-page-builder-full-width-php .panel {
        behavior: url("<?php echo get_template_directory_uri() . '/css/pie/PIE.php'; ?>");
        zoom: 1;
}
</style>
<![endif]-->
<?php }

/**
 * Include the TGM_Plugin_Activation class.
 *  
*/
if ( current_user_can ( 'install_plugins' ) ) {
require_once get_template_directory() . '/class-tgm-plugin-activation.php'; 
add_action( 'tgmpa_register', 'brickyard_my_theme_register_required_plugins' );

function brickyard_my_theme_register_required_plugins() {

$plugins = array(
		array(
			'name'     => 'Breadcrumb NavXT',
			'slug'     => 'breadcrumb-navxt',
			'source'   => get_template_directory_uri() . '/plugins/breadcrumb-navxt.zip',
			'required' => false,
		),
    array(
			'name'     => 'Custom Background Extended',
			'slug'     => 'custom-background-extended',
			'source'   => get_template_directory_uri() . '/plugins/custom-background-extended.zip',
			'required' => false,
		),
    array(
			'name'     => 'Cyclone Slider 2',
			'slug'     => 'cyclone-slider',
			'source'   => get_template_directory_uri() . '/plugins/cyclone-slider-2.zip',
			'required' => false,
		),
    array(
			'name'     => 'Dagon Design Sitemap Generator',
			'slug'     => 'sitemap-generator',
			'source'   => get_template_directory_uri() . '/plugins/sitemap-generator.zip',
			'required' => false,
		),
    array(
			'name'     => 'Page Builder by SiteOrigin',
			'slug'     => 'siteorigin-panels',
			'source'   => get_template_directory_uri() . '/plugins/siteorigin-panels.zip',
			'required' => false,
		),
	);
 
 
$config = array(
		'domain'       => 'brickyard',
    'menu'         => 'install-my-theme-plugins',
		'strings'    	 => array(
		'page_title'             => __( 'Install Recommended Plugins', 'brickyard' ),
		'menu_title'             => __( 'Install Plugins', 'brickyard' ),
		'instructions_install'   => __( 'The %1$s plugin is required for this theme. Click on the big blue button below to install and activate %1$s.', 'brickyard' ),
		'instructions_activate'  => __( 'The %1$s is installed but currently inactive. Please go to the <a href="%2$s">plugin administration page</a> page to activate it.', 'brickyard' ),
		'button'                 => __( 'Install %s Now', 'brickyard' ),
		'installing'             => __( 'Installing Plugin: %s', 'brickyard' ),
		'oops'                   => __( 'Something went wrong with the plugin API.', 'brickyard' ), // */
		'notice_can_install'     => __( 'This theme requires the %1$s plugin. <a href="%2$s"><strong>Click here to begin the installation process</strong></a>. You may be asked for FTP credentials based on your server setup.', 'brickyard' ),
		'notice_cannot_install'  => __( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'brickyard' ),
		'notice_can_activate'    => __( 'This theme requires the %1$s plugin. That plugin is currently inactive, so please go to the <a href="%2$s">plugin administration page</a> to activate it.', 'brickyard' ),
		'notice_cannot_activate' => __( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'brickyard' ),
		'return'                 => __( 'Return to Recommended Plugins Installer', 'brickyard' ),
),
); 
brickyard_tgmpa( $plugins, $config ); 
}}

/**
 * Page Builder custom Row Style.
 *  
*/
function brickyard_panels_row_styles($styles) {
    $styles['brickyard'] = __('BrickYard', 'brickyard');
    return $styles;
}
add_filter('siteorigin_panels_row_styles', 'brickyard_panels_row_styles');

/**
 * Custom Shortcodes.
 *
*/
function brickyard_button_shortcode($atts, $content = null) {
   extract(shortcode_atts(array('link' => '#'), $atts));
   return '<a class="custom-button" href="'.$link.'">' . do_shortcode($content) . '</a>';
}
add_shortcode( 'button', 'brickyard_button_shortcode' );
add_filter('widget_text', 'do_shortcode');

function brickyard_highlight_shortcode($atts, $content = null) {
   return '<span class="highlight-text">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'highlight', 'brickyard_highlight_shortcode' );

function brickyard_table_shortcode($atts) {
    extract( shortcode_atts( array(
        'cols' => 'none',
        'data' => 'none',
    ), $atts ) );
    $cols = explode(',',$cols);
    $data = explode(',',$data);
    $total = count($cols);
    $output = '<table><tr>';
    foreach($cols as $col):
        $output .= '<th>'.$col.'</th>';
    endforeach;
    $output .= '</tr><tr>';
    $counter = 1;
    foreach($data as $datum):
        $output .= '<td>'.$datum.'</td>';
        if($counter%$total==0):
            $output .= '</tr>';
        endif;
        $counter++;
    endforeach;
        $output .= '</table>';
    return $output;
}
add_shortcode( 'table', 'brickyard_table_shortcode' );

function brickyard_image_shortcode($atts, $content = null){
return '<img src="'.$atts['src'].'" alt="" />';
}
add_shortcode('image','brickyard_image_shortcode');

/**
 * Shortcode for displaying lists of posts.
 *  
*/
add_shortcode( 'display-posts', 'brickyard_display_posts_shortcode' );
function brickyard_display_posts_shortcode( $atts ) {
	// Original Attributes, for filters
	$original_atts = $atts;
	// Pull in shortcode attributes and set defaults
	$atts = shortcode_atts( array(
		'author'              => '',
		'category'            => '',
		'date_format'         => '(n/j/Y)',
		'id'                  => false,
		'ignore_sticky_posts' => false,
		'image_size'          => false,
		'include_content'     => false,
		'include_date'        => false,
		'include_excerpt'     => false,
		'meta_key'            => '',
		'no_posts_message'    => '',
		'offset'              => 0,
		'order'               => 'DESC',
		'orderby'             => 'date',
		'post_parent'         => false,
		'post_status'         => 'publish',
		'post_type'           => 'post',
		'posts_per_page'      => '10',
		'tag'                 => '',
		'tax_operator'        => 'IN',
		'tax_term'            => false,
		'taxonomy'            => false,
		'wrapper'             => 'ul',
	), $atts );
	$author = sanitize_text_field( $atts['author'] );
	$category = sanitize_text_field( $atts['category'] );
	$date_format = sanitize_text_field( $atts['date_format'] );
	$id = $atts['id']; // Sanitized later as an array of integers
	$ignore_sticky_posts = (bool) $atts['ignore_sticky_posts'];
	$image_size = sanitize_key( $atts['image_size'] );
	$include_content = (bool)$atts['include_content'];
	$include_date = (bool)$atts['include_date'];
	$include_excerpt = (bool)$atts['include_excerpt'];
	$meta_key = sanitize_text_field( $atts['meta_key'] );
	$no_posts_message = sanitize_text_field( $atts['no_posts_message'] );
	$offset = intval( $atts['offset'] );
	$order = sanitize_key( $atts['order'] );
	$orderby = sanitize_key( $atts['orderby'] );
	$post_parent = $atts['post_parent']; // Validated later, after check for 'current'
	$post_status = $atts['post_status']; // Validated later as one of a few values
	$post_type = sanitize_text_field( $atts['post_type'] );
	$posts_per_page = intval( $atts['posts_per_page'] );
	$tag = sanitize_text_field( $atts['tag'] );
	$tax_operator = $atts['tax_operator']; // Validated later as one of a few values
	$tax_term = sanitize_text_field( $atts['tax_term'] );
	$taxonomy = sanitize_key( $atts['taxonomy'] );
	$wrapper = sanitize_text_field( $atts['wrapper'] );	
	// Set up initial query for post
	$args = array(
		'category_name'       => $category,
		'order'               => $order,
		'orderby'             => $orderby,
		'post_type'           => explode( ',', $post_type ),
		'posts_per_page'      => $posts_per_page,
		'tag'                 => $tag,
	);	
	// Ignore Sticky Posts
	if( $ignore_sticky_posts )
		$args['ignore_sticky_posts'] = true;	
	// Meta key (for ordering)
	if( !empty( $meta_key ) )
		$args['meta_key'] = $meta_key;	
	// If Post IDs
	if( $id ) {
		$posts_in = array_map( 'intval', explode( ',', $id ) );
		$args['post__in'] = $posts_in;
	}	
	// Post Author
	if( !empty( $author ) )
		$args['author_name'] = $author;		
	// Offset
	if( !empty( $offset ) )
		$args['offset'] = $offset;	
	// Post Status	
	$post_status = explode( ', ', $post_status );		
	$validated = array();
	$available = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'any' );
	foreach ( $post_status as $unvalidated )
		if ( in_array( $unvalidated, $available ) )
			$validated[] = $unvalidated;
	if( !empty( $validated ) )		
		$args['post_status'] = $validated;	
	// If taxonomy attributes, create a taxonomy query
	if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {
		// Term string to array
		$tax_term = explode( ', ', $tax_term );		
		// Validate operator
		if( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) )
			$tax_operator = 'IN';					
		$tax_args = array(
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $tax_term,
					'operator' => $tax_operator
				)
			)
		);		
		// Check for multiple taxonomy queries
		$count = 2;
		$more_tax_queries = false;
		while( 
			isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) && 
			isset( $original_atts['tax_' . $count . '_term'] ) && !empty( $original_atts['tax_' . $count . '_term'] ) 
		):		
			// Sanitize values
			$more_tax_queries = true;
			$taxonomy = sanitize_key( $original_atts['taxonomy_' . $count] );
	 		$terms = explode( ', ', sanitize_text_field( $original_atts['tax_' . $count . '_term'] ) );
	 		$tax_operator = isset( $original_atts['tax_' . $count . '_operator'] ) ? $original_atts['tax_' . $count . '_operator'] : 'IN';
	 		$tax_operator = in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ? $tax_operator : 'IN';	 		
	 		$tax_args['tax_query'][] = array(
	 			'taxonomy' => $taxonomy,
	 			'field' => 'slug',
	 			'terms' => $terms,
	 			'operator' => $tax_operator
	 		);
			$count++;			
		endwhile;		
		if( $more_tax_queries ):
			$tax_relation = 'AND';
			if( isset( $original_atts['tax_relation'] ) && in_array( $original_atts['tax_relation'], array( 'AND', 'OR' ) ) )
				$tax_relation = $original_atts['tax_relation'];
			$args['tax_query']['relation'] = $tax_relation;
		endif;		
		$args = array_merge( $args, $tax_args );
	}	
	// If post parent attribute, set up parent
	if( $post_parent ) {
		if( 'current' == $post_parent ) {
			global $post;
			$post_parent = $post->ID;
		}
		$args['post_parent'] = intval( $post_parent );
	}	
	// Set up html elements used to wrap the posts. 
	// Default is ul/li, but can also be ol/li and div/div
	$wrapper_options = array( 'ul', 'ol', 'div' );
	if( ! in_array( $wrapper, $wrapper_options ) )
		$wrapper = 'ul';
	$inner_wrapper = 'div' == $wrapper ? 'div' : 'li';	
	$listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $original_atts ) );
	if ( ! $listing->have_posts() )
		return apply_filters( 'display_posts_shortcode_no_results', wpautop( $no_posts_message ) );		
	$inner = '';
	while ( $listing->have_posts() ): $listing->the_post(); global $post;		
		$image = $date = $excerpt = $content = '';		
		$title = '<a class="title" href="' . apply_filters( 'the_permalink', get_permalink() ) . '">' . apply_filters( 'the_title', get_the_title() ) . '</a>';		
		if ( $image_size && has_post_thumbnail() )  
			$image = '<a class="image" href="' . get_permalink() . '">' . get_the_post_thumbnail( $post->ID, $image_size ) . '</a> ';			
		if ( $include_date ) 
			$date = ' <span class="date">' . get_the_date( $date_format ) . '</span>';		
		if ( $include_excerpt ) 
			$excerpt = ' <span class="excerpt-dash">-</span> <span class="excerpt">' . get_the_excerpt() . '</span>';			
		if( $include_content )
			$content = '<div class="content">' . apply_filters( 'the_content', get_the_content() ) . '</div>'; 		
		$class = array( 'listing-item' );
		$class = apply_filters( 'display_posts_shortcode_post_class', $class, $post, $listing );
		$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $image . $title . $date . $excerpt . $content . '</' . $inner_wrapper . '>';		
		// If post is set to private, only show to logged in users
		if( 'private' == get_post_status( $post->ID ) && !current_user_can( 'read_private_posts' ) )
			$output = '';		
		$inner .= apply_filters( 'display_posts_shortcode_output', $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class );		
	endwhile; wp_reset_postdata();	
	$open = apply_filters( 'display_posts_shortcode_wrapper_open', '<' . $wrapper . ' class="display-posts-listing">', $original_atts );
	$close = apply_filters( 'display_posts_shortcode_wrapper_close', '</' . $wrapper . '>', $original_atts );
	$return = $open . $inner . $close;
	return $return;
}

/**
 * WooCommerce custom template modifications.
 *  
*/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
function brickyard_woocommerce_modifications() {
  remove_action ( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 ); 
}  
add_action ( 'init', 'brickyard_woocommerce_modifications' );
add_filter ( 'woocommerce_show_page_title', '__return_false' );
}

/**
 * Initialize the update checker.
 *  
*/
require 'theme-update-checker.php';
$example_update_checker = new ThemeUpdateChecker(
    'brickyard-premium',
    'http://www.tomastoman.cz/updates/brickyard.json'
); ?>