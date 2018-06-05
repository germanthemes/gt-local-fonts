<?php
/*
Plugin Name: GT Typography
Plugin URI: https://germanthemes.de/plugins/gt-typography/
Description: Adds some additional local fonts to the typography options of German Themes.
Author: German Themes
Author URI: https://germanthemes.de
Version: 1.0
Text Domain: gt-typography
Domain Path: /languages/
License: GPL v3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

GT Typography
Copyright(C) 2018, germanthemes.de - kontakt@germanthemes.de
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Main GT_Typography Class
 *
 * @package GT Typography
 */
class GT_Typography {

	/**
	 * Call all Functions to setup the Plugin
	 *
	 * @uses GT_Typography::constants() Setup the constants needed
	 * @uses GT_Typography::includes() Include the required files
	 * @uses GT_Typography::setup_actions() Setup the hooks and actions
	 * @return void
	 */
	static function setup() {

		// Setup Constants.
		self::constants();

		// Setup Translation.
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );

		// Include Files.
		self::includes();

		// Setup Action Hooks.
		self::setup_actions();

	}

	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	static function constants() {

		// Define Plugin Name.
		define( 'GTT_NAME', 'GT Typography' );

		// Define Version Number.
		define( 'GTT_VERSION', '1.0' );

		// Plugin Folder Path.
		define( 'GTT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL.
		define( 'GTT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File.
		define( 'GTT_PLUGIN_FILE', __FILE__ );
	}

	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {

		load_plugin_textdomain( 'gt-typography', false, dirname( plugin_basename( GTT_PLUGIN_FILE ) ) . '/languages/' );

	}

	/**
	 * Include required files
	 *
	 * @return void
	 */
	static function includes() {

		// Include Settings Classes.
		#require_once GTT_PLUGIN_DIR . '/includes/class-tzcat-settings.php';
		#require_once GTT_PLUGIN_DIR . '/includes/class-tzcat-settings-page.php';

	}

	/**
	 * Setup Action Hooks
	 *
	 * @see https://codex.wordpress.org/Function_Reference/add_action WordPress Codex
	 * @return void
	 */
	static function setup_actions() {

		// Change Archive Titles based on user settings.
		#add_filter( 'get_the_archive_title', array( __CLASS__, 'custom_archive_titles' ) );

		// Add Settings link to Plugin actions.
		#add_filter( 'plugin_action_links_' . plugin_basename( GTT_PLUGIN_FILE ), array( __CLASS__, 'plugin_action_links' ) );

	}

	/**
	 * Add Settings link to the plugin actions
	 *
	 * @return array $actions Plugin action links
	 */
	static function plugin_action_links( $actions ) {

		$settings_link = array( 'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'options-general.php?page=themezee-gt-typography' ), __( 'Settings', 'gt-typography' ) ) );

		return array_merge( $settings_link, $actions );
	}
}

// Run Plugin.
GT_Typography::setup();
