<?php
/**
 * Class for managing themes.
 *
 * @package Notice_Bar
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Themes Class.
 */
class Notice_Bar_Themes{

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		add_action( 'init', array( $this, 'register' ) );
		add_action( 'wp_footer', array( $this, 'frontend' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );

	}

	/**
	 * Register themes.
	 *
	 * @since 1.0.0
	 */
	function register() {
		$themes = array();

		$themes = apply_filters( 'register_nb_themes', $themes );

		$themes['default'] = array(
			'name'           => __( 'Default', 'notice-bar' ),
			'path'           => NB_THEME_PATH . '/default',
			'register_class' => 'Notice_Bar_Default_Theme_Register',
		);
		$GLOBALS['nb_themes'] = $themes;
	}

	/**
	 * Fetch all themes.
	 *
	 * @since 1.0.0
	 */
	public static function list_all() {
		global $nb_themes;

		$themes = array();

		foreach ( glob( NB_THEME_PATH . '/*' ) as $dir_path ) {

			if ( is_dir( $dir_path ) && opendir( $dir_path ) ) {

				$config_file = $dir_path . '/config.php';

				if ( file_exists( $config_file ) ) {

					$config = include $config_file;

					$base_name = basename( $dir_path );
					$themes[ $base_name ] = $config['theme_name'];

				}
			}
		}

		return $themes;
	}

	/**
	 * Fetch theme configs.
	 *
	 * @since 1.0.0
	 *
	 * @param string $theme Theme.
	 */
	function get_theme_configs( $theme = 'default' ) {

		global $nb_themes;

		$theme_path = '';
	    if ( array_key_exists( $theme, $nb_themes ) ) {
	        $theme_path = $nb_themes[ $theme ]['path'];
	    }

	    $output = array();
	    if ( '' !== $theme_path && is_dir( $theme_path ) ) {
	        if ( file_exists( $theme_path . '/register-theme.php' ) ) {
	            include_once $theme_path . '/register-theme.php';
	            return new $nb_themes[ $theme ]['register_class'];

	        } else {
	        	return false;
	        }
		} else {
	    	return false;
	    }

	}

	/**
	 * Fetch active theme configs.
	 *
	 * @since 1.0.0
	 */
	function active_theme_configs() {
		$ws_notice_settings = get_option( NB_SETTINGS_NAME );
		$theme_settings = $ws_notice_settings[ 'theme_'.$ws_notice_settings['theme'].'_settings' ];

		$theme = $ws_notice_settings['theme'];

		return $this->get_theme_configs( $theme );
	}

	/**
	 * Fetch theme settings.
	 *
	 * @since 1.0.0
	 *
	 * @param string $theme Theme.
	 */
	function theme_settings( $theme ) {
		$ws_notice_settings = get_option( NB_SETTINGS_NAME );
		$theme_settings = $ws_notice_settings[ 'theme_'.$theme.'_settings' ];

		return $theme_settings;
	}

	/**
	 * Fetch current theme settings.
	 *
	 * @since 1.0.0
	 */
	function current_theme_settings() {
		$ws_notice_settings = get_option( NB_SETTINGS_NAME );
		$theme_settings = $ws_notice_settings[ 'theme_'.$ws_notice_settings['theme'].'_settings' ];
		return $theme_settings;
	}

	/**
	 * Fetch all settings.
	 *
	 * @since 1.0.0
	 */
	function get_all_settings() {

		$ws_notice_settings = get_option( NB_SETTINGS_NAME );

		return $ws_notice_settings;

	}

	/**
	 * Fetch settings.
	 *
	 * @since 1.0.0
	 */
	function settings() {
		if ( ! isset( $_POST['theme'] ) ) {
			return false;
		}

		$theme = sanitize_text_field( $_POST['theme'] );

		$active_theme_configs = $this->get_theme_configs( $theme );

		if ( ! $active_theme_configs ) {
			return;
		}

		$ws_notice_settings = get_option( NB_SETTINGS_NAME );

		$theme_settings = array();
		if ( isset( $ws_notice_settings[ 'theme_'.$theme.'_settings' ] ) ) {
			$theme_settings = $ws_notice_settings[ 'theme_'.$theme.'_settings' ];
		}

		return $active_theme_configs->settings( $theme_settings );

	}

	/**
	 * Admin scripts.
	 *
	 * @since 1.0.0
	 */
	function admin_scripts() {

		$screen = get_current_screen();
		if ( 'toplevel_page_notice-bar' !== $screen->base ) {
			return;
		}

		$active_theme_configs = $this->active_theme_configs();

		if ( ! $active_theme_configs ) {
			return;
		}

		echo $active_theme_configs->admin_scripts();

	}

	/**
	 * Admin demo.
	 *
	 * @since 1.0.0
	 */
	function admin_demo() {

		if ( ! isset( $_POST[NB_SETTINGS_NAME]['theme'] ) ) {
	        return false;
	    }

		$theme = sanitize_text_field( $_POST[NB_SETTINGS_NAME]['theme'] );

		$active_theme_configs = $this->get_theme_configs( $theme );

		if ( ! $active_theme_configs ) {
			return false;
		}

		$theme_settings = $_POST[NB_SETTINGS_NAME][ 'theme_'.$theme.'_settings' ];

		$output = sprintf( '<div id="nb-theme-live-demo">%s</div>', $active_theme_configs->admin_demo( $theme_settings,true ) );
		return $output;

	}

	/**
	 * Frontend configs.
	 *
	 * @since 1.0.0
	 */
	function frontend() {
		$active_theme_configs = $this->active_theme_configs();
		$settings = $this->get_all_settings();
		if ( 'enabled' === $settings['status'] && false !== $active_theme_configs ) {
			echo $active_theme_configs->frontend();
		}
	}

	/**
	 * Frontend scripts.
	 *
	 * @since 1.0.0
	 */
	function frontend_scripts() {

		$active_theme_configs = $this->active_theme_configs();
		$settings = $this->get_all_settings();
		if ( 'enabled' === $settings['status'] && false !== $active_theme_configs ) {
			echo $active_theme_configs->frontend_scripts();
		}
	}
}

$GLOBALS['notice_bar_themes'] = new Notice_Bar_Themes();
