<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'Basic' ) ) :

	/**
	 * Main Basic Class.
	 *
	 * @package		BASIC
	 * @subpackage	Classes/Basic
	 * @since		1.0.0
	 * @author		Rudraksh
	 */
	final class Basic {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Basic
		 */
		private static $instance;

		/**
		 * BASIC helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Basic_Helpers
		 */
		public $helpers;

		/**
		 * BASIC settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Basic_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'basic' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'basic' ), '1.0.0' );
		}

		/**
		 * Main Basic Instance.
		 *
		 * Insures that only one instance of Basic exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Basic	The one true Basic
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Basic ) ) {
				self::$instance					= new Basic;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new Basic_Helpers();
				self::$instance->settings		= new Basic_Settings();

				//Fire the plugin logic
				new Basic_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'BASIC/plugin_loaded' );
			}

			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once BASIC_PLUGIN_DIR . 'core/includes/classes/class-basic-helpers.php';
			require_once BASIC_PLUGIN_DIR . 'core/includes/classes/class-basic-settings.php';

			require_once BASIC_PLUGIN_DIR . 'core/includes/classes/class-basic-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'basic', FALSE, dirname( plugin_basename( BASIC_PLUGIN_FILE ) ) . '/languages/' );
		}

	}

endif; // End if class_exists check.