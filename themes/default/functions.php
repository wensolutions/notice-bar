<?php
/**
 * Theme functions.
 *
 * @package Notice_Bar
 */

/**
 * Load scripts and styles for frontend.
 *
 * @since 1.0.0
 */
function notice_bar_default_scripts() {

	wp_enqueue_script( 'nb-default-script', plugins_url( 'themes/default/js/script.js', NB_FILE_PATH ), array( 'jquery' ), false, false );
	wp_enqueue_style( 'nb-default-style', plugins_url( '/themes/default/css/style.css', NB_FILE_PATH ) );

}

add_action( 'wp_enqueue_scripts', 'notice_bar_default_scripts' );

/**
 * Load scripts and styles for admin.
 *
 * @since 1.0.0
 */
function notice_bar_default_admin_scripts() {

	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'nb-default-admin-script', plugins_url( 'themes/default/js/admin.js', NB_FILE_PATH ), array( 'jquery', 'wp-color-picker' ), false, false );

}

add_action( 'admin_enqueue_scripts', 'notice_bar_default_admin_scripts' );


