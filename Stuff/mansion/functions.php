<?php

//add theme options
require_once ( TEMPLATEPATH . '/includes/theme-options.php' );

if ( function_exists('register_sidebar') )
    register_sidebar();

// Add Post Thumbnail Theme Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured', 401, 301, true );
}

$includes_path = TEMPLATEPATH . '/includes/';

// load javascripts
require_once ($includes_path . 'theme-js.php');

// Load Post Images
require_once ($includes_path . 'images.php');

// Add Menu Theme Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'nav-menus' );
	add_action( 'init', 'register_gpp_menus' );

	function register_gpp_menus() {
		register_nav_menus(
			array(
				'main-menu' => __( 'Главное меню' )
			)
		);
	}
}


//get thumbnail
function postimage($size=medium) {
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'numberposts' => 1,
		'order' => 'ASC',
		'post_mime_type' => 'image',)))
	{
		foreach( $images as $image ) {
			$attachmentimage=wp_get_attachment_image( $image->ID, $size );
			echo $attachmentimage.apply_filters('the_title', $parent->post_title);
		}
	} 
}

//get thumbnails
function postimages($size=medium) {
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'post_mime_type' => 'image')))
	{
		foreach( $images as $image ) {
			$attachmenturl=wp_get_attachment_url($image->ID);
			
			if($size=='featured') {
				$attachmentimage=wp_get_attachment_image( $image->ID, array(401, 301) );
			} else {
				$attachmentimage=wp_get_attachment_image( $image->ID, $size );
			}
			
			
			$imagelink=get_permalink($image->post_parent);

			echo '<div class="box"><a href="'.$imagelink.'">'.$attachmentimage.apply_filters('the_title', $parent->post_title).'</a></div>';
		}
	} 
}


//check any attachment 
function checkimage($size=medium) {
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'numberposts' => 1,
		'post_mime_type' => 'image',)))
	{
		foreach( $images as $image ) {
			$attachmentimage=wp_get_attachment_image( $image->ID, $size );
			return $attachmentimage;
		}
	} 
}

function trim_excerpt($text) {
  return rtrim($text,'[...]');
}
add_filter('get_the_excerpt', 'trim_excerpt');
function new_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');

// Hostenko 
// убираем виджеты с дашборда
function remove_dashboard_widgets(){
  global$wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

// Виджет темы в dashboard
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
wp_add_dashboard_widget('custom_help_widget', 'Описание темы', 'custom_dashboard_help');
}
function custom_dashboard_help() {
echo '<a href="http://hostenko.com"><img src="http://hostenko.com/pics/widget_logo.png" style="float: left; margin: 0 10px 10px 0;"></a>
<p><b>Перед наполнением Вашего сайта информацией рекомендуем ознакомиться с <a href="http://hostenko.com/theme_description.php?theme=27">руководством по данной теме</a></b>.</p>
<p>Тема переведена <a href="http://hostenko.com">Hostenko</a> — специализированным хостингом для сайтов на WordPress с мастером его автоматической установки.</p>';
}

// Копирайт в футере
function remove_footer_admin () {
    echo 'Русские <a href="http://hostenko.com/themes">WordPress темы</a> — <a href="http://hostenko.com">Hostenko</a>';
} 
add_filter('admin_footer_text', 'remove_footer_admin');

// Меню Hостенко
add_action("admin_bar_menu", "customize_menu");
function customize_menu(){
global $wp_admin_bar;
  $wp_admin_bar->add_menu(array(
   "id" => "hostenko_menu",
   "title" => "Hostenko",
   "href" => "http://hostenko.com",
   "meta" => array("target" => "blank")
));
$wp_admin_bar->add_menu(array(
   "id" => "hostenko_menu_child",
    "title" => "Личный кабинет",
    "parent" => "hostenko_menu",
    "href" => "http://hostenko.com/cabinet",
	"meta" => array("target" => "blank")
));
$wp_admin_bar->add_menu(array(
   "id" => "hostenko_menu_child2",
    "title" => "WordPress темы",
    "parent" => "hostenko_menu",
    "href" => "http://hostenko.com/themes",
	"meta" => array("target" => "blank")
));
$wp_admin_bar->add_menu(array(
   "id" => "hostenko_menu_child3",
    "title" => "Блог Hostenko",
    "parent" => "hostenko_menu",
    "href" => "http://blog.hostenko.com",
	"meta" => array("target" => "blank")
));
}
// RSS-виджет Wordpresso
function wordpresso_rss_output(){
    echo '<div class="rss-widget">';
    echo '<a href="http://wordpresso.org"><img src="http://wordpresso.org/pics/widget_logo.png" style="float: left; margin: 0 10px 10px 0;"></a><br style="clear:both;"/>'; 
       wp_widget_rss_output(array(
            'url' => 'http://feeds.feedburner.com/Wordpresso',
            'title' => 'Wordpresso RSS',
            'items' => 3, 
            'show_summary' => 1,
            'show_author' => 0,
            'show_date' => 1
       ));
       
       echo "</div>";
}
add_action('wp_dashboard_setup', 'wordpresso_rss_widget');
function wordpresso_rss_widget(){
wp_add_dashboard_widget( 'wordpresso-rss', 'Wordpresso RSS', 'wordpresso_rss_output');
}

?>