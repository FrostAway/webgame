<?php
	/*-----------------------------------------------------------------------------------*/
	/* This file will be referenced every time a template/page loads on your Wordpress site
	/* This is the place to define custom fxns and specialty code
	/*-----------------------------------------------------------------------------------*/

// Define the version so we can easily replace it throughout the theme
define( 'IZWT_VERSION', 1.0 );

/*-----------------------------------------------------------------------------------*/
/* Add Rss feed support to Head section
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/* Register main menu for Wordpress use
/*-----------------------------------------------------------------------------------*/
register_nav_menus( 
	array(
		'primary'	=>	__( 'Primary Menu', 'iz_theme' ), // Register the Primary menu
		// Copy and paste the line above right here if you want to make another menu, 
		// just change the 'primary' to another name
	)
);

/*-----------------------------------------------------------------------------------*/
/* Activate sidebar for Wordpress use
/*-----------------------------------------------------------------------------------*/
function iz_register_sidebars() {
	register_sidebar(array(				// Start a series of sidebars to register
		'id' => 'sidebar', 					// Make an ID
		'name' => 'Sidebar',				// Name it
		'description' => 'Take it on the side...', // Dumb description for the admin side
		'before_widget' => '<div>',	// What to display before each widget
		'after_widget' => '</div>',	// What to display following each widget
		'before_title' => '<h3 class="side-title">',	// What to display before each widget's title
		'after_title' => '</h3>',		// What to display following each widget's title
		'empty_title'=> '',					// What to display in the case of no title defined for a widget
		// Copy and paste the lines above right here if you want to make another sidebar, 
		// just change the values of id and name to another word/name
	));
} 
// adding sidebars to Wordpress (these are created in functions.php)
add_action( 'widgets_init', 'iz_register_sidebars' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function iz_scripts()  { 
	// get the theme directory style.css and link to it in the header
	wp_enqueue_style( 'iz-style', get_template_directory_uri() . '/style.css', '10000', 'all' );			
	// add fitvid
	wp_enqueue_script( 'iz-fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), IZWT_VERSION, true );	
	// add theme scripts
	wp_enqueue_script( 'izweb', get_template_directory_uri() . '/js/theme.min.js', array(), IZWT_VERSION, true );
  
}
add_action( 'wp_enqueue_scripts', 'iz_scripts' ); // Register this fxn and allow Wordpress to call it automatcally in the header

function iz_add_support_theme(){
    add_theme_support('post-thumbnails');
    
}
add_action('after_setup_theme', 'iz_add_support_theme');



// add post type
include_once 'include/post_type.php';
