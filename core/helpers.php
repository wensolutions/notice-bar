<?php
/**
 * Helper functions.
 *
 * @package Notice_Bar
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'print_pre' ) ) :

	/**
	 * Display given value.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $array Value to be displayed.
	 */
	function print_pre( $array ) {

	    $output = '<pre';
		$output .= ' style="border:1px solid red; background-color:#eee;margin:3px;height:auto; margin-left:3%; overflow:hidden; width:94%;padding:5px; color:#000; text-align:left; white-space: pre-wrap; white-space: -moz-pre-wrap !important; word-wrap: break-word; white-space: -o-pre-wrap; clear: both; white-space: -pre-wrap;"';
		$output .= '>';
		echo $output;
		print_r( $array );
		echo '</pre>';
	}
endif;
