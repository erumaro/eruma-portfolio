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


// Include Syntaxhighlighter
include_once( dirname( __FILE__ ) . '/syntaxhighlighter/syntaxhighlighter.php' );

// Add scripts and styles
add_action('wp_enqueue_scripts', 'eruma_portfolio_scripts');
function eruma_portfolio_scripts(){
    if ( is_archive( 'projects' ) ) {
        wp_enqueue_style( 'portfolio-style', plugins_url('dist/portfolio.css', __FILE__ ));
        wp_enqueue_script( 'portfolio-manifest-js', plugins_url('dist/manifest.js', __FILE__ ), '', '', true);
        wp_enqueue_script( 'portfolio-vendor-js', plugins_url('dist/vendor.js', __FILE__ ), '', '', true);
        wp_enqueue_script( 'portfolio-bundle-js', plugins_url('dist/bundle.js', __FILE__ ), '', '', true);

        $wnm_custom = array( 
            'restURL' => get_rest_url(),
            'pluginURL' => plugins_url('eruma-portfolio')
        );
        wp_localize_script('portfolio-bundle-js', 'wpglobals', $wnm_custom);  
    }
}

/**
* Custom Taxonomy and Post Type
**/
add_action( 'init', 'projects_post_type', 0 );
function projects_post_type() {
	$labels = array(
		'name'                  => _x( 'Projects', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Projects', 'text_domain' ),
		'name_admin_bar'        => __( 'Project', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Project', 'text_domain' ),
		'description'           => __( 'Web dev projects', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
		'taxonomies'            => array( 'technology', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'projects', $args );
}

// Register Custom Taxonomy
add_action( 'init', 'technologies', 0 );
function technologies() {
	$labels = array(
		'name'                       => _x( 'Technologies', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Technology', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Technology', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'technology', array( 'projects' ), $args );
}

?>