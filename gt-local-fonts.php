<?php
/*
Plugin Name: GT Local Fonts
Plugin URI: https://germanthemes.de/gt-local-fonts/
Description: Adds additional local fonts to the typography options of GermanThemes.
Author: GermanThemes
Author URI: https://germanthemes.de/
Version: 1.0
Text Domain: gt-local-fonts
Domain Path: /languages/
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

GT Local Fonts
Copyright(C) 2019, germanthemes.de - support@germanthemes.de
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Main GermanThemes_Local_Fonts Class
 *
 * @package GT Local Fonts
 */
class GermanThemes_Local_Fonts {

	/**
	 * Call all Functions to setup the Plugin
	 *
	 * @uses GermanThemes_Local_Fonts::constants() Setup the constants needed
	 * @uses GermanThemes_Local_Fonts::includes() Include the required files
	 * @uses GermanThemes_Local_Fonts::setup_actions() Setup the hooks and actions
	 * @return void
	 */
	static function setup() {

		// Setup Translation.
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );

		// Add fonts to the default font list in Customizer.
		add_filter( 'gt_typography_fonts', array( __CLASS__, 'add_fonts' ) );

		// Load fonts in frontend.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_fonts' ), 1 );

		// Load fonts in editor.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'enqueue_fonts' ), 1 );
	}

	/**
	 * The list of fonts.
	 *
	 * @return array $fonts List of fonts.
	 */
	static function fonts() {

		$fonts = array(
			'Amaranth'          => esc_html__( 'Amaranth', 'gt-local-fonts' ),
			'Arimo'             => esc_html__( 'Arimo', 'gt-local-fonts' ),
			'Crimson Text'      => esc_html__( 'Crimson Text', 'gt-local-fonts' ),
			'Dosis'             => esc_html__( 'Dosis', 'gt-local-fonts' ),
			'Fira Sans'         => esc_html__( 'Fira Sans', 'gt-local-fonts' ),
			'Hind'              => esc_html__( 'Hind', 'gt-local-fonts' ),
			'Inconsolata'       => esc_html__( 'Inconsolata', 'gt-local-fonts' ),
			'Indie Flower'      => esc_html__( 'Indie Flower', 'gt-local-fonts' ),
			'Josefin Sans'      => esc_html__( 'Josefin Sans', 'gt-local-fonts' ),
			'Lato'              => esc_html__( 'Lato', 'gt-local-fonts' ),
			'Libre Baskerville' => esc_html__( 'Libre Baskerville', 'gt-local-fonts' ),
			'Lobster Two'       => esc_html__( 'Lobster Two', 'gt-local-fonts' ),
			'Merriweather'      => esc_html__( 'Merriweather', 'gt-local-fonts' ),
			'Montserrat'        => esc_html__( 'Montserrat', 'gt-local-fonts' ),
			'Muli'              => esc_html__( 'Muli', 'gt-local-fonts' ),
			'Nunito'            => esc_html__( 'Nunito', 'gt-local-fonts' ),
			'Open Sans'         => esc_html__( 'Open Sans', 'gt-local-fonts' ),
			'Oswald'            => esc_html__( 'Oswald', 'gt-local-fonts' ),
			'Philosopher'       => esc_html__( 'Philosopher', 'gt-local-fonts' ),
			'Poppins'           => esc_html__( 'Poppins', 'gt-local-fonts' ),
			'PT Sans'           => esc_html__( 'PT Sans', 'gt-local-fonts' ),
			'Quicksand'         => esc_html__( 'Quicksand', 'gt-local-fonts' ),
			'Raleway'           => esc_html__( 'Raleway', 'gt-local-fonts' ),
			'Rambla'            => esc_html__( 'Rambla', 'gt-local-fonts' ),
			'Roboto'            => esc_html__( 'Roboto', 'gt-local-fonts' ),
			'Signika'           => esc_html__( 'Signika', 'gt-local-fonts' ),
			'Titillium Web'     => esc_html__( 'Titillium Web', 'gt-local-fonts' ),
			'Ubuntu'            => esc_html__( 'Ubuntu', 'gt-local-fonts' ),
		);

		return $fonts;
	}

	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {
		load_plugin_textdomain( 'gt-local-fonts', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
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

		// Return early if the current theme does not support typography options.
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
			wp_enqueue_style( 'gt-local-fonts-amaranth', plugins_url( '/assets/css/amaranth.css', __FILE__ ), array(), '8.0' );
		}

		if ( array_key_exists( 'Arimo', $fonts ) && in_array( 'Arimo', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-arimo', plugins_url( '/assets/css/arimo.css', __FILE__ ), array(), '11.0' );
		}

		if ( array_key_exists( 'Crimson Text', $fonts ) && in_array( 'Crimson Text', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-crimson-text', plugins_url( '/assets/css/crimson-text.css', __FILE__ ), array(), '8.0' );
		}

		if ( array_key_exists( 'Dosis', $fonts ) && in_array( 'Dosis', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-dosis', plugins_url( '/assets/css/dosis.css', __FILE__ ), array(), '7.0' );
		}

		if ( array_key_exists( 'Fira Sans', $fonts ) && in_array( 'Fira Sans', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-fira-sans', plugins_url( '/assets/css/fira-sans.css', __FILE__ ), array(), '8.0' );
		}

		if ( array_key_exists( 'Hind', $fonts ) && in_array( 'Hind', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-hind', plugins_url( '/assets/css/hind.css', __FILE__ ), array(), '8.0' );
		}

		if ( array_key_exists( 'Inconsolata', $fonts ) && in_array( 'Inconsolata', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-inconsolata', plugins_url( '/assets/css/inconsolata.css', __FILE__ ), array(), '16.0' );
		}

		if ( array_key_exists( 'Indie Flower', $fonts ) && in_array( 'Indie Flower', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-indie-flower', plugins_url( '/assets/css/indie-flower.css', __FILE__ ), array(), '9.0' );
		}

		if ( array_key_exists( 'Josefin Sans', $fonts ) && in_array( 'Josefin Sans', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-josefin-sans', plugins_url( '/assets/css/josefin-sans.css', __FILE__ ), array(), '12.0' );
		}

		if ( array_key_exists( 'Lato', $fonts ) && in_array( 'Lato', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-lato', plugins_url( '/assets/css/lato.css', __FILE__ ), array(), '14.0' );
		}

		if ( array_key_exists( 'Libre Baskerville', $fonts ) && in_array( 'Libre Baskerville', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-libre-baskerville', plugins_url( '/assets/css/libre-baskerville.css', __FILE__ ), array(), '5.0' );
		}

		if ( array_key_exists( 'Lobster Two', $fonts ) && in_array( 'Lobster Two', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-lobster-two', plugins_url( '/assets/css/lobster-two.css', __FILE__ ), array(), '10.0' );
		}

		if ( array_key_exists( 'Merriweather', $fonts ) && in_array( 'Merriweather', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-merriweather', plugins_url( '/assets/css/merriweather.css', __FILE__ ), array(), '19.0' );
		}

		if ( array_key_exists( 'Montserrat', $fonts ) && in_array( 'Montserrat', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-montserrat', plugins_url( '/assets/css/montserrat.css', __FILE__ ), array(), '12.0' );
		}

		if ( array_key_exists( 'Muli', $fonts ) && in_array( 'Muli', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-muli', plugins_url( '/assets/css/muli.css', __FILE__ ), array(), '11.0' );
		}

		if ( array_key_exists( 'Nunito', $fonts ) && in_array( 'Nunito', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-nunito', plugins_url( '/assets/css/nunito.css', __FILE__ ), array(), '9.0' );
		}

		if ( array_key_exists( 'Open Sans', $fonts ) && in_array( 'Open Sans', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-open-sans', plugins_url( '/assets/css/open-sans.css', __FILE__ ), array(), '15.0' );
		}

		if ( array_key_exists( 'Oswald', $fonts ) && in_array( 'Oswald', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-oswald', plugins_url( '/assets/css/oswald.css', __FILE__ ), array(), '16.0' );
		}

		if ( array_key_exists( 'Philosopher', $fonts ) && in_array( 'Philosopher', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-philosopher', plugins_url( '/assets/css/philosopher.css', __FILE__ ), array(), '9.0' );
		}

		if ( array_key_exists( 'Poppins', $fonts ) && in_array( 'Poppins', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-poppins', plugins_url( '/assets/css/poppins.css', __FILE__ ), array(), '5.0' );
		}

		if ( array_key_exists( 'PT Sans', $fonts ) && in_array( 'PT Sans', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-pt-sans', plugins_url( '/assets/css/pt-sans.css', __FILE__ ), array(), '9.0' );
		}

		if ( array_key_exists( 'Quicksand', $fonts ) && in_array( 'Quicksand', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-quicksand', plugins_url( '/assets/css/quicksand.css', __FILE__ ), array(), '7.0' );
		}

		if ( array_key_exists( 'Raleway', $fonts ) && in_array( 'Raleway', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-raleway', plugins_url( '/assets/css/raleway.css', __FILE__ ), array(), '12.0' );
		}

		if ( array_key_exists( 'Rambla', $fonts ) && in_array( 'Rambla', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-rambla', plugins_url( '/assets/css/rambla.css', __FILE__ ), array(), '5.0' );
		}

		if ( array_key_exists( 'Roboto', $fonts ) && in_array( 'Roboto', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-roboto', plugins_url( '/assets/css/roboto.css', __FILE__ ), array(), '18.0' );
		}

		if ( array_key_exists( 'Signika', $fonts ) && in_array( 'Signika', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-signika', plugins_url( '/assets/css/signika.css', __FILE__ ), array(), '8.0' );
		}

		if ( array_key_exists( 'Titillium Web', $fonts ) && in_array( 'Titillium Web', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-titillium-web', plugins_url( '/assets/css/titillium-web.css', __FILE__ ), array(), '6.0' );
		}

		if ( array_key_exists( 'Ubuntu', $fonts ) && in_array( 'Ubuntu', $selected_fonts, true ) ) {
			wp_enqueue_style( 'gt-local-fonts-ubuntu', plugins_url( '/assets/css/ubuntu.css', __FILE__ ), array(), '12.0' );
		}
	}
}

// Run Plugin.
GermanThemes_Local_Fonts::setup();
