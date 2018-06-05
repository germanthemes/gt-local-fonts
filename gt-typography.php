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

		// Setup Translation.
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );

		// Add fonts to the default font list in Customizer.
		add_filter( 'gt_typography_fonts', array( __CLASS__, 'add_fonts' ) );

		// Load fonts in frontend.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_fonts' ), 1 );
	}

	/**
	 * The list of fonts.
	 *
	 * @return array $fonts List of fonts.
	 */
	static function fonts() {

		$fonts = array(
			'Amaranth'      => 'Amaranth',
			'Lato'          => 'Lato',
			'Montserrat'    => 'Montserrat',
			'Muli'          => 'Muli',
			'Open Sans'     => 'Open Sans',
			'Oswald'        => 'Oswald',
			'PT Sans'       => 'PT Sans',
			'Raleway'       => 'Raleway',
			'Rambla'        => 'Rambla',
			'Roboto'        => 'Roboto',
			'Titillium Web' => 'Titillium Web',
			'Ubuntu'        => 'Ubuntu',
		);

		return $fonts;
	}

	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {

		load_plugin_textdomain( 'gt-typography', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

	/**
	 * Add new fonts to the default font list in Customizer.
	 *
	 * @return array $fonts List of fonts.
	 */
	static function add_fonts( $fonts ) {

		return array_merge( $fonts, self::fonts() );

	}

	/**
	 * Enqueue fonts.
	 */
	static function enqueue_fonts() {

		// Return early if the current theme does not support the plugin.
		if ( ! current_theme_supports( 'gt-typography' ) ) {
			return;
		}

		$theme_support = get_theme_support( 'gt-typography' );

		// Return if there are no selected fonts.
		if ( ! ( isset( $theme_support[0]['selected_fonts'] ) && is_array( $theme_support[0]['selected_fonts'] ) ) ) {
			return;
		}

		// Get selected fonts.
		$selected_fonts = $theme_support[0]['selected_fonts'];

		// Get available fonts.
		$fonts = self::fonts();

		if ( array_key_exists( 'Amaranth', $fonts ) && in_array( 'Amaranth', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-amaranth-font', plugins_url( '/assets/css/amaranth.css', __FILE__ ), array(), '8.0' );
		}

		if ( array_key_exists( 'Lato', $fonts ) && in_array( 'Lato', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-lato-font', plugins_url( '/assets/css/lato.css', __FILE__ ), array(), '14.0' );
		}

		if ( array_key_exists( 'Montserrat', $fonts ) && in_array( 'Montserrat', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-montserrat-font', plugins_url( '/assets/css/montserrat.css', __FILE__ ), array(), '12.0' );
		}

		if ( array_key_exists( 'Muli', $fonts ) && in_array( 'Muli', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-muli-font', plugins_url( '/assets/css/muli.css', __FILE__ ), array(), '11.0' );
		}

		if ( array_key_exists( 'Open Sans', $fonts ) && in_array( 'Open Sans', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-open-sans-font', plugins_url( '/assets/css/open-sans.css', __FILE__ ), array(), '15.0' );
		}

		if ( array_key_exists( 'Oswald', $fonts ) && in_array( 'Oswald', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-oswald-font', plugins_url( '/assets/css/oswald.css', __FILE__ ), array(), '16.0' );
		}

		if ( array_key_exists( 'PT Sans', $fonts ) && in_array( 'PT Sans', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-pt-sans-font', plugins_url( '/assets/css/pt-sans.css', __FILE__ ), array(), '9.0' );
		}

		if ( array_key_exists( 'Raleway', $fonts ) && in_array( 'Raleway', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-raleway-font', plugins_url( '/assets/css/raleway.css', __FILE__ ), array(), '12.0' );
		}

		if ( array_key_exists( 'Rambla', $fonts ) && in_array( 'Rambla', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-rambla-font', plugins_url( '/assets/css/rambla.css', __FILE__ ), array(), '5.0' );
		}

		if ( array_key_exists( 'Roboto', $fonts ) && in_array( 'Roboto', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-roboto-font', plugins_url( '/assets/css/roboto.css', __FILE__ ), array(), '18.0' );
		}

		if ( array_key_exists( 'Titillium Web', $fonts ) && in_array( 'Titillium Web', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-titillium-web-font', plugins_url( '/assets/css/titillium-web.css', __FILE__ ), array(), '6.0' );
		}

		if ( array_key_exists( 'Ubuntu', $fonts ) && in_array( 'Ubuntu', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-ubuntu-font', plugins_url( '/assets/css/ubuntu.css', __FILE__ ), array(), '12.0' );
		}
	}
}

// Run Plugin.
GT_Typography::setup();
