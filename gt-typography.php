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
			'Amaranth'          => esc_html__( 'Amaranth', 'gt-typography' ),
			'Arimo'             => esc_html__( 'Arimo', 'gt-typography' ),
			'Crimson Text'      => esc_html__( 'Crimson Text', 'gt-typography' ),
			'Dosis'             => esc_html__( 'Dosis', 'gt-typography' ),
			'Fira Sans'         => esc_html__( 'Fira Sans', 'gt-typography' ),
			'Hind'              => esc_html__( 'Hind', 'gt-typography' ),
			'Inconsolata'       => esc_html__( 'Inconsolata', 'gt-typography' ),
			'Indie Flower'      => esc_html__( 'Indie Flower', 'gt-typography' ),
			'Josefin Sans'      => esc_html__( 'Josefin Sans', 'gt-typography' ),
			'Lato'              => esc_html__( 'Lato', 'gt-typography' ),
			'Libre Baskerville' => esc_html__( 'Libre Baskerville', 'gt-typography' ),
			'Lobster Two'       => esc_html__( 'Lobster Two', 'gt-typography' ),
			'Merriweather'      => esc_html__( 'Merriweather', 'gt-typography' ),
			'Montserrat'        => esc_html__( 'Montserrat', 'gt-typography' ),
			'Muli'              => esc_html__( 'Muli', 'gt-typography' ),
			'Nunito'            => esc_html__( 'Nunito', 'gt-typography' ),
			'Open Sans'         => esc_html__( 'Open Sans', 'gt-typography' ),
			'Oswald'            => esc_html__( 'Oswald', 'gt-typography' ),
			'Philosopher'       => esc_html__( 'Philosopher', 'gt-typography' ),
			'Poppins'           => esc_html__( 'Poppins', 'gt-typography' ),
			'PT Sans'           => esc_html__( 'PT Sans', 'gt-typography' ),
			'Quicksand'         => esc_html__( 'Quicksand', 'gt-typography' ),
			'Raleway'           => esc_html__( 'Raleway', 'gt-typography' ),
			'Rambla'            => esc_html__( 'Rambla', 'gt-typography' ),
			'Roboto'            => esc_html__( 'Roboto', 'gt-typography' ),
			'Signika'           => esc_html__( 'Signika', 'gt-typography' ),
			'Titillium Web'     => esc_html__( 'Titillium Web', 'gt-typography' ),
			'Ubuntu'            => esc_html__( 'Ubuntu', 'gt-typography' ),
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

		if ( array_key_exists( 'Arimo', $fonts ) && in_array( 'Arimo', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-arimo-font', plugins_url( '/assets/css/arimo.css', __FILE__ ), array(), '11.0' );
		}

		if ( array_key_exists( 'Crimson Text', $fonts ) && in_array( 'Crimson Text', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-crimson-text-font', plugins_url( '/assets/css/crimson-text.css', __FILE__ ), array(), '8.0' );
		}

		if ( array_key_exists( 'Dosis', $fonts ) && in_array( 'Dosis', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-dosis-font', plugins_url( '/assets/css/dosis.css', __FILE__ ), array(), '7.0' );
		}

		if ( array_key_exists( 'Fira Sans', $fonts ) && in_array( 'Fira Sans', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-fira-sans-font', plugins_url( '/assets/css/fira-sans.css', __FILE__ ), array(), '8.0' );
		}

		if ( array_key_exists( 'Hind', $fonts ) && in_array( 'Hind', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-hind-font', plugins_url( '/assets/css/hind.css', __FILE__ ), array(), '8.0' );
		}

		if ( array_key_exists( 'Inconsolata', $fonts ) && in_array( 'Inconsolata', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-inconsolata-font', plugins_url( '/assets/css/inconsolata.css', __FILE__ ), array(), '16.0' );
		}

		if ( array_key_exists( 'Indie Flower', $fonts ) && in_array( 'Indie Flower', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-indie-flower-font', plugins_url( '/assets/css/indie-flower.css', __FILE__ ), array(), '9.0' );
		}

		if ( array_key_exists( 'Josefin Sans', $fonts ) && in_array( 'Josefin Sans', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-josefin-sans-font', plugins_url( '/assets/css/josefin-sans.css', __FILE__ ), array(), '12.0' );
		}

		if ( array_key_exists( 'Lato', $fonts ) && in_array( 'Lato', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-lato-font', plugins_url( '/assets/css/lato.css', __FILE__ ), array(), '14.0' );
		}

		if ( array_key_exists( 'Libre Baskerville', $fonts ) && in_array( 'Libre Baskerville', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-libre-baskerville-font', plugins_url( '/assets/css/libre-baskerville.css', __FILE__ ), array(), '5.0' );
		}

		if ( array_key_exists( 'Lobster Two', $fonts ) && in_array( 'Lobster Two', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-lobster-two-font', plugins_url( '/assets/css/lobster-two.css', __FILE__ ), array(), '10.0' );
		}

		if ( array_key_exists( 'Merriweather', $fonts ) && in_array( 'Merriweather', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-merriweather-font', plugins_url( '/assets/css/merriweather.css', __FILE__ ), array(), '19.0' );
		}

		if ( array_key_exists( 'Montserrat', $fonts ) && in_array( 'Montserrat', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-montserrat-font', plugins_url( '/assets/css/montserrat.css', __FILE__ ), array(), '12.0' );
		}

		if ( array_key_exists( 'Muli', $fonts ) && in_array( 'Muli', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-muli-font', plugins_url( '/assets/css/muli.css', __FILE__ ), array(), '11.0' );
		}

		if ( array_key_exists( 'Nunito', $fonts ) && in_array( 'Nunito', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-nunito-font', plugins_url( '/assets/css/nunito.css', __FILE__ ), array(), '9.0' );
		}

		if ( array_key_exists( 'Open Sans', $fonts ) && in_array( 'Open Sans', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-open-sans-font', plugins_url( '/assets/css/open-sans.css', __FILE__ ), array(), '15.0' );
		}

		if ( array_key_exists( 'Oswald', $fonts ) && in_array( 'Oswald', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-oswald-font', plugins_url( '/assets/css/oswald.css', __FILE__ ), array(), '16.0' );
		}

		if ( array_key_exists( 'Philosopher', $fonts ) && in_array( 'Philosopher', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-philosopher-font', plugins_url( '/assets/css/philosopher.css', __FILE__ ), array(), '9.0' );
		}

		if ( array_key_exists( 'Poppins', $fonts ) && in_array( 'Poppins', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-poppins-font', plugins_url( '/assets/css/poppins.css', __FILE__ ), array(), '5.0' );
		}

		if ( array_key_exists( 'PT Sans', $fonts ) && in_array( 'PT Sans', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-pt-sans-font', plugins_url( '/assets/css/pt-sans.css', __FILE__ ), array(), '9.0' );
		}

		if ( array_key_exists( 'Quicksand', $fonts ) && in_array( 'Quicksand', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-quicksand-font', plugins_url( '/assets/css/quicksand.css', __FILE__ ), array(), '7.0' );
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

		if ( array_key_exists( 'Signika', $fonts ) && in_array( 'Signika', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-typography-signika-font', plugins_url( '/assets/css/signika.css', __FILE__ ), array(), '8.0' );
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
