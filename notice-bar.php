<?php
/**
 * Plugin Name: Notice Bar
 * Description: A simple plugin to show notice bar in WordPress sites.
 * Plugin URI: http://wensolutions.com/plugins/notice-bar/
 * Author: WEN Solutions
 * Author URI: http://wensolutions.com
 * Version: 1.0
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: notice-bar
 *
 * @package Notice_Bar
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NB_BASE_PATH', dirname( __FILE__ ) );
define( 'NB_FILE_PATH', __FILE__ );
define( 'NB_THEME_PATH', NB_BASE_PATH . '/themes' );
define( 'NB_SETTINGS_NAME', '_nb_plugin_settings' );
define( 'NB_FILE_URL', plugins_url( '', __FILE__ ) );

if ( ! class_exists( 'Notice_Bar' ) ) :

	/**
	 * Main Class.
	 */
	class Notice_Bar {

		/**
		 * Plugin instance.
		 *
		 * @var Notice_Bar The single instance of the class.
		 * @since 1.0.0
		 */
		private static $instance = null;

		/**
		 * Main Notice_Bar Instance.
		 *
		 * Ensures only one instance of Notice_Bar is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 * @return Notice_Bar - Main instance.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self; }

			return self::$instance;
		}

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		private function __construct() {

			$this->includes();
			$this->init_hooks();

		}

		/**
		 * Hook into actions and filters.
		 *
		 * @since 1.0.0
		 * @access private
		 */
		private function init_hooks() {

			// Load plugin text domain for localization.
			load_plugin_textdomain( 'notice-bar', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

			// Add settings link in plugin listing.
			$plugin = plugin_basename( __FILE__ );
			add_filter( 'plugin_action_links_' . $plugin, array( $this, 'add_settings_link' ) );
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @since 1.0.0
		 */
		public function includes() {

			include NB_BASE_PATH . '/core/helpers.php';
			include NB_BASE_PATH . '/core/themes.php';
			include NB_BASE_PATH . '/core/backend/settings.php';
			include NB_BASE_PATH . '/core/backend/ajax.php';
			include NB_BASE_PATH . '/core/frontend/actions.php';

		}


		/**
		 * Activate.
		 *
		 * @since 1.0.0
		 */
		public static function activate() {
			$default_settings = array(
				'status'                 => 'disabled',
				'theme'                  => 'default',
				'theme_default_settings' => array(
					'message'          => __( 'Notice bar for all your custom notifications for your site visitors. Tweak them as you like using flexible options.', 'notice-bar' ),
					'position'         => 'top',
					'button_label'     => __( 'Button', 'notice-bar' ),
					'button_link'      => '#',
					'button_target'    => '_self',
					'background_color' => '#dd3333',
					'font_color'       => '#ffffff',
					'font_size'       => 12,
					'bar_control'      => 'always',
					),
				);
			if ( ! get_option( NB_SETTINGS_NAME ) ) {
		        update_option( NB_SETTINGS_NAME, $default_settings );
			}
		}

		/**
		 * Deactivate.
		 *
		 * @since 1.0.0
		 */
		public static function deactivate() {

		}

		/**
		 * Links in plugin listing.
		 *
		 * @since 1.0.0
		 *
		 * @param array $links Array of links.
		 * @return array Modified array of links.
		 */
		public static function add_settings_link( $links ) {
			$url = add_query_arg( array(
				'page' => 'notice-bar',
				),
				admin_url( 'admin.php' )
			);
			$settings_link = '<a href="' . esc_url( $url ) . '">' . __( 'Settings', 'notice-bar' ) . '</a>';
			array_unshift( $links, $settings_link );
			return $links;
		}
	}

endif;

// Trigger plugin instance.
add_action( 'plugins_loaded', array( 'Notice_Bar', 'get_instance' ) );

// Activation hook.
register_activation_hook( __FILE__, array( 'Notice_Bar', 'activate' ) );

// Deactivation hook.
register_deactivation_hook( __FILE__, array( 'Notice_Bar', 'deactivate' ) );
