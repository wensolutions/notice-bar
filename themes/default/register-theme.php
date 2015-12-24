<?php
/**
 * Theme registration.
 *
 * @package Notice_Bar
 */

/**
 * Theme Class.
 */
class Notice_Bar_Default_Theme_Register {

	/**
	 * Theme path.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string Path of current theme.
	 */
	private $theme_path;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

	 	$this->theme_path = dirname( __FILE__ );

	}

	/**
	 * Load settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array $theme_settings Theme Settings.
	 * @return array Settings.
	 */
	function settings( $theme_settings = array() ) {

		ob_start();
		include $this->theme_path . '/views/admin/settings.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

	/**
	 * Admin scripts.
	 *
	 * @since 1.0.0
	 */
	function admin_scripts() {

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'nb-default-admin-script', plugins_url( 'themes/default/js/admin.js', NB_FILE_PATH ), array( 'jquery', 'wp-color-picker' ), false, false );
		wp_enqueue_style( 'nb-font-awesome', plugins_url( '/assets/css/font-awesome.min.css', NB_FILE_PATH ) );

		wp_enqueue_style( 'nb-default-style', plugins_url( '/themes/default/css/style.css', NB_FILE_PATH ) );

	}

	/**
	 * Load admin demo.
	 *
	 * @since 1.0.0
	 *
	 * @return string Notice content.
	 */
	function admin_demo( $theme_settings ) {

		global $notice_bar_themes;
		ob_start();
		include $this->theme_path . '/views/frontend/notice.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

	/**
	 * Load frontend view.
	 *
	 * @since 1.0.0
	 */
	function frontend() {

		global $notice_bar_themes;
		ob_start();
		$theme_settings = $notice_bar_themes->current_theme_settings();
		include $this->theme_path . '/views/frontend/notice.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

	/**
	 * Frontend scripts.
	 *
	 * @since 1.0.0
	 */
	function frontend_scripts() {

		wp_enqueue_script( 'nb-default-script', plugins_url( 'themes/default/js/script.js', NB_FILE_PATH ), array( 'jquery' ), false, false );
		wp_enqueue_style( 'nb-font-awesome', plugins_url( '/assets/css/font-awesome.min.css', NB_FILE_PATH ) );
		wp_enqueue_style( 'nb-default-style', plugins_url( '/themes/default/css/style.css', NB_FILE_PATH ) );

	}
}
