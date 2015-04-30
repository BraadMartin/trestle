<?php

/**
 * Theme functionality.
 *
 * @since  1.0.0
 *
 * @package Trestle
 */

/*===========================================
 * Required Files
===========================================*/

// Theme functions.
require_once dirname( __FILE__ ) . '/includes/functions/theme-functions.php';

// Admin functionality.
require_once dirname( __FILE__ ) . '/includes/admin/admin.php';

// Customizer controls.
require_once dirname( __FILE__ ) . '/includes/admin/customizer.php';

// Shortcodes.
require_once dirname( __FILE__ ) . '/includes/shortcodes/shortcodes.php';

// Additional sidebars.
require_once dirname( __FILE__ ) . '/includes/widget-areas/widget-areas.php';

// Plugin activation class.
require_once dirname( __FILE__ ) . '/includes/classes/class-tgm-plugin-activation.php';

// Better Font Awesome Library.
require_once dirname( __FILE__ ) . '/lib/better-font-awesome-library/better-font-awesome-library.php';


add_action( 'genesis_setup', 'trestle_theme_setup', 15 );
/**
 * Initialize Trestle.
 *
 * @since  1.0.0
 */
function trestle_theme_setup() {

	/*===========================================
	 * Theme Setup
	===========================================*/

	// Child theme definitions (do not remove).
	define( 'CHILD_THEME_NAME', 'Trestle' );
	define( 'CHILD_THEME_URL', 'http://demo.mightyminnow.com/theme/trestle/' );
	define( 'CHILD_THEME_VERSION', '1.2.0' );
	define( 'TRESTLE_SETTINGS_FIELD', 'trestle-settings' );

	// Setup default theme settings.
	trestle_settings_defaults();

	// Load theme text domain.
	load_theme_textdomain( 'trestle', get_stylesheet_directory() . '/languages' );

	// Add HTML5 markup structure.
	add_theme_support( 'html5' );

	// Add viewport meta tag for mobile browsers.
	add_theme_support( 'genesis-responsive-viewport' );

	// Add support for footer widgets if specified in Trestle settings.
	$trestle_footer_widgets_number = esc_attr( genesis_get_option( 'footer_widgets_number', 'trestle-settings' ) );
	add_theme_support( 'genesis-footer-widgets', $trestle_footer_widgets_number );
}
