<?php
/*
Plugin Name:  Bookstore
Plugin URI:   https://wordpress.org/
Description:  WordPress plugin for helping bookstores organise their books by adding book CPT, genre, and author taxonomies 
Version:      1.0
Author:       Yalda Sharafi 
Author URI:   yalda.sharafi@gmail.com
License:      
License URI:  
Text Domain:  veronalabs
Domain Path:  /languages
*/

//Styles
function books_styles() {
    wp_register_style( 'books',  plugin_dir_url( __FILE__ ) . '/css/books.css' ); 
    wp_enqueue_style( 'books' );                         
}
add_action( 'admin_init', 'books_styles' );

//Includes
include( plugin_dir_path( __FILE__ ) . 'includes/books-cpt.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/cpt-taxonomies-filter.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/cpt-metabox.php' );










