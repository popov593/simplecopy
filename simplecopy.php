<?php
/**
* Plugin Name: Simple Copy
* Plugin URI: https://www.vipestudio.com
* Description: Simple backup taker
* Version: 1.0
* Author: Ivan Popov
* Author URI: https://ivanpopov.bg
**/

/* Include all */
	foreach ( glob( plugin_dir_path( __FILE__ ) . "subfolder/*.php" ) as $file ) {
                include_once $file;
}

/**
 * Append CSS
*/

// register jquery and style on initialization
add_action('init', 'register_script');
function register_script() {
    wp_register_script( 'smc_jquery', plugins_url('inc/js/js.js', __FILE__), array('jquery'), '2.5.1' );

    wp_register_style( 'smc_style', plugins_url('inc/css/style.css', __FILE__), false, '1.0.0', 'all');
}

// use the registered jquery and style above
add_action('wp_enqueue_scripts', 'enqueue_style');

function enqueue_style(){
   wp_enqueue_script('smc_jquery');

   wp_enqueue_style( 'smc_style' );
}

//add menu element
add_action( 'admin_menu', 'simplecopy_info_menu' );

function simplecopy_info_menu(){

  $page_title = 'Create a backup via Simple Copy';
  $menu_title = 'Simple Copy';
  $capability = 'manage_options';
  $menu_slug  = 'simplecopy';
  $function   = 'simplecopy_page';
  $icon_url   = 'dashicons-plus-alt';
  $position   = 1;

  add_menu_page( $page_title,
                 $menu_title,
                 $capability,
                 $menu_slug,
                 $function,
                 $icon_url,
                 $position );
}

//plugin page
if( !function_exists("simplecopy_page") ) {
function simplecopy_page(){
    
echo "<h1 class='titlesc' style='padding-bottom: 15px;'>Create a backup via Simple Copy</h1>";
echo "<p><a class='button buttonsc' href='../wp-content/plugins/simplecopy/backupplugins.php'>Backup plugins</a></p>";
echo "<p><a class='button buttonsc' href='../wp-content/plugins/simplecopy/backupthemes.php'>Backup themes</a></p>";
//echo "<p><a class='button buttonsc'>Backup WP cores</a></p>";
echo "<p><a class='button buttonsc'  href='../wp-content/plugins/simplecopy/backupdb.php'>Backup database</a></p>";
echo "<p style='padding-bottom: 30px;'></p>";
    
echo '<h2>Existing Plugins Backups:</h2>';
foreach (glob("../wp-content/plugins*.zip") as $filename) { 
echo str_replace("","","<p><a href='$filename'>$filename</a></p>\n");
}
echo "<p style='padding-bottom: 30px;'></p>";

echo '<h2>Existing Themes Backups:</h2>';
foreach (glob("../wp-content/themes*.zip") as $filename) { 
echo str_replace("","","<p><a href='$filename'>$filename</a></p>\n");
}
echo "<p style='padding-bottom: 30px;'></p>";

echo '<h2>Existing Database Backups:</h2>';
foreach (glob("../wp-content/database*.sql") as $filename) { 
echo str_replace("","","<p><a href='$filename'>$filename</a></p>\n");
}
echo "<p style='padding-bottom: 30px;'></p>";

}
}