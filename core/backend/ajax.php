<?php
/**
 * AJAX functions.
 *
 * @package Notice_Bar
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_action( 'wp_ajax_nb_load_theme_settings', 'nb_load_theme_settings' );
add_action( 'wp_ajax_nopriv_nb_load_theme_settingsr', 'nb_load_theme_settings' );

/**
 * Callback for loading theme settings.
 *
 * @since 1.0.0
 *
 * @todo nonce implementation
 */
function nb_load_theme_settings() {

	global $notice_bar_themes;

	$theme_settings = $notice_bar_themes->settings();

	if ( ! $theme_settings ) {

		$output['status'] = 'error';
		$output['message'] = __( 'Theme is broken' , 'notice-bar' );

	} else {

		$output['status'] = 'success';
		$output['data'] = $theme_settings;

	}

	echo wp_json_encode( $output );

	die();
}

add_action( 'wp_ajax_nb_load_theme_preview', 'nb_load_theme_preview' );
add_action( 'wp_ajax_nopriv_nb_load_theme_preview', 'nb_load_theme_preview' );

/**
 * Callback for previewing theme.
 *
 * @since 1.0.0
 *
 * @todo nonce implementation
 */
function nb_load_theme_preview() {

	global $notice_bar_themes;

	$theme_demo = $notice_bar_themes->admin_demo();

	if ( ! $theme_demo ) {

		$output['status'] = 'error';
		$output['message'] = __( 'Theme demo is broken', 'notice-bar' );

	} else {

		$output['status'] = 'success';
		$output['demo'] = $theme_demo;

	}

	echo wp_json_encode( $output );

	die();
}
