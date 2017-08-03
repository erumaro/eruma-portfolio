<?php 
/**
 * Plugin Name: Eruma Portfolio
 * Plugin URI: http://www.eruma.se/
 * Description: This plugin is designed to create a portfolio for web developers to add to their websites.
 * Version: 1.0.0
 * Author: Tobias Årud
 * Author URI: http://www.eruma.se/
 * License: GPL2
 * 
 */

/**
* Advanced Custom Fields
**/
// 1. customize ACF path
add_filter('advanced-custom-fields/settings/path', 'my_acf_settings_path');
 
function my_acf_settings_path( $path ) {
 
    // update path
    $path = plugin_basename('/advanced-custom-fields/');
    
    // return
    return $path;
    
}

// 2. customize ACF dir
add_filter('advanced-custom-fields/settings/dir', 'my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {
 
    // update path
    $dir = plugin_basename('/advanced-custom-fields/');
    
    // return
    return $dir;
    
}
 

// 3. Hide ACF field group menu item
add_filter('advanced-custom-fields/settings/show_admin', '__return_false');


// 4. Include ACF
include_once( dirname( __FILE__ ) . '/advanced-custom-fields/acf.php' );

// Add scripts and styles
add_action('wp_enqueue_scripts', 'eruma_portfolio_scripts');
function eruma_portfolio_scripts(){
    wp_enqueue_style( 'portfolio-style', plugins_url('portfolio.css', __FILE__ ));
}

?>