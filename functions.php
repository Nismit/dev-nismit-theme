<?php
/**
 * archive_nislog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package archive_nislog
 */

if ( ! function_exists( 'archive_nislog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function archive_nislog_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on archive_nislog, use a find and replace
	 * to change 'archive_nislog' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'archive_nislog', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif;
add_action( 'after_setup_theme', 'archive_nislog_setup' );

/**
* WordPress clean up
*/
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link');

function disable_emojis() {
	// all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'disable_emojis' );

/**
* Add function of table plugin to TinyMCE
*
* @param array() - plugin cdn url
* @see https://codex.wordpress.org/TinyMCE#Change_Log
* @see https://cdnjs.com/libraries/tinymce/
*/
function plugin_table_mce( $plugins ) {
	$plugins['table'] = '//cdnjs.cloudflare.com/ajax/libs/tinymce/4.6.2/plugins/table/plugin.min.js';
	return $plugins;
}
add_filter('mce_external_plugins', 'plugin_table_mce');

/**
* Add button(s) in visual editor
* @param array() - button title
*/
function add_buttons_mce( $buttons ) {
	$buttons[] = 'table';
	return $buttons;
}
add_filter( 'mce_buttons', 'add_buttons_mce' );

/**
* Filter function used to remove the tinymce emoji plugin.
*
* @param    array  $plugins
* @return   array  Difference betwen the two arrays
*/
function disable_emojicons_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
   return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
   return array();
 }
}

/**
* Remove all styles and js version
*
* @param string		css file, script file
* @return string	removed version file
*/
function remove_version( $src ) {
	if ( strpos( $src, 'ver='. get_bloginfo( 'version' ))) {
	 $src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'remove_version');
add_filter( 'script_loader_src', 'remove_version');


/**
 * Enqueue scripts and styles.
 */
function load_scripts() {
	wp_enqueue_style( 'cdn_font', '//fonts.googleapis.com/css?family=Open+Sans|Oswald:700', array(), null );

	wp_enqueue_style( 'style', get_template_directory_uri().'/dist/styles/style.css', array(), null );

	wp_enqueue_script( 'syntax', get_template_directory_uri(). '/dist/scripts/prism.min.js', array(), null, true );

	//wp_enqueue_script( 'archive_nislog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	//wp_enqueue_script( 'archive_nislog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );

/**
 * Popular posts tracking
 *
 * Tracks the number of logged out user views for a post in a custom field
 */
function track_views_posts() {
	// Only run the process for single posts, pages and post types when the user is logged out
	if ( is_singular() && !is_user_logged_in() ) {

		global $post;
		$custom_field = '_views_count';

		// Only track a one view per post for a single visitor session to avoid duplications
		if ( !isset( $_SESSION["post-views-count-{$post->ID}"] ) ) {

			// Update view count
			$view_count = get_post_meta( $post->ID, $custom_field, true );
			$stored_count = ( isset($view_count) && !empty($view_count) ) ? ( intval($view_count) + 1 ) : 1;
			$update_meta = update_post_meta( $post->ID, $custom_field, $stored_count );

			// Check for errors
			if ( is_wp_error($update_meta) ) {
				error_log( $update_meta->get_error_message(), 0 );
			}

			// Store session in "viewed" state
			$_SESSION["post-views-count-{$post->ID}"] = 1;
		}

		// Show view the count for testing purposes (add "?show_count=1" onto the URL)
		if ( isset($_GET['show_count']) && intval($_GET['show_count']) == 1 ) {
			echo '<p style="color:red; text-align:center; margin:1em 0;">';
			echo get_post_meta( $post->ID, $custom_field, true );
			echo ' views of this post</p>';
		}
	}
}
add_action('wp_head', 'track_views_posts');

/**
* Init session
*/
function init_session() {
	// Set/check session
	if ( !session_id() ) {
		session_start();
	}
}
add_action('init', 'init_session');

// function custom_editor_block_formats( $settings ){
// 	$settings[ 'block_formats' ] = '段落=p;見出し2=h2;見出し3=h3;見出し4=h4;整形済みテキスト=pre;';
// 	return $settings;
// }
// add_filter( 'tiny_mce_before_init', 'custom_editor_block_formats' );

/**
* Get all tags from specific category
*
* @param string category id
* @return mixed include tag link
*/
function get_tags_from_category( $args ) {
	global $wpdb;
		$query = "
			SELECT DISTINCT terms2.term_id as term_id, terms2.name as name, t2.count as count
			FROM
				$wpdb->posts as p1
					LEFT JOIN $wpdb->term_relationships as r1 ON p1.ID = r1.object_ID
					LEFT JOIN $wpdb->term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
					LEFT JOIN $wpdb->terms as terms1 ON t1.term_id = terms1.term_id,
				$wpdb->posts as p2
					LEFT JOIN $wpdb->term_relationships as r2 ON p2.ID = r2.object_ID
					LEFT JOIN $wpdb->term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
					LEFT JOIN $wpdb->terms as terms2 ON t2.term_id = terms2.term_id
				WHERE
					t1.taxonomy = 'category' AND p1.post_status = 'publish'
				AND
					terms1.term_id = " . $args->term_id . "
				AND
					t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
				AND
					p1.ID = p2.ID
		";
		$tags = $wpdb->get_results($query);

		foreach($tags as $key => $tag) {
			$link = get_term_link( intval( $tag->term_id ), 'post_tag'  );

			if ( is_wp_error( $link ) ) {
				return false;
			}

			$tags[$key]->link = $link;
		}

		return $tags;
}

function source_view_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'caption' => 'filename',
				'lang' => 'lang'
    ), $atts ) );
		return '<span class="caption">'. esc_attr($caption) .'</span><code class="language-'. esc_attr($lang) .'">'. $content .'</code>';
}
add_shortcode('source', 'source_view_shortcode');

function code_view_shortcode( $atts, $content = null ) {
		return '<code>'. $content .'</code>';
}
add_shortcode('code', 'code_view_shortcode');
