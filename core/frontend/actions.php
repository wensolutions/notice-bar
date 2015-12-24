<?php
/**
 * Class for plugin actions.
 *
 * @package Notice_Bar
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display Class.
 */
class Notice_Bar_Actions{

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue Scripts.
	 *
	 * @since 1.0.0
	 */
	function enqueue_scripts() {

		

		wp_register_script( 'notice-bar-functions', NB_FILE_URL . '/assets/js/notice-bar-functions.js', array( 'jquery' ), '1.0.0', false );

        wp_enqueue_script( 'notice-bar-functions' );

	}
	
}

new Notice_Bar_Actions();
