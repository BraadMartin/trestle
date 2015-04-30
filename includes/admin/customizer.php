<?php
/**
 * Trestle Customizer Controls.
 *
 * @since  1.0.0
 *
 * @package  Trestle
 */

add_action( 'customize_preview_init', 'trestle_customizer_preview_js' );
/**
 * Enqueue scripts for the site preview iframe on the customizer screen.
 *
 * @since  1.0.0
 */
function trestle_customizer_preview_js() {

	wp_enqueue_script(
		'trestle_customizer',
		get_stylesheet_directory_uri() . '/includes/admin/customizer.js',
		array( 'jquery', 'customize-preview' ), // Dependencies
		null, // Version
		true // Load in Footer
	);
}

add_action( 'customize_register', 'trestle_customizer_controls' );
/**
 * Register Trestle's controls.
 *
 * @since  1.0.0
 *
 * @param  $wp_customize  The Customizer Object.
 */
function trestle_customizer_controls( $wp_customize ) {

	/**
	 * Trestle Settings Section.
	 */

	// Add the section.
	$wp_customize->add_section(
		'trestle_settings_section',
		array(
			'title' 	=> __( 'Trestle Settings', 'trestle' ),
			'priority'  => 160,
		)
	);

	// Layout.
	$wp_customize->add_setting(
		'trestle-settings[layout]',
		array(
			'default'			=> genesis_get_option( 'layout', 'trestle-settings' ),
			'type'				=> 'option',
			'transport' 		=> 'postMessage',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_layout_control',
		array(
			'section'   => 'trestle_settings_section',
			'settings'  => 'trestle-settings[layout]',
			'label'     => __( 'Layout', 'trestle' ),
			'type'      => 'radio',
			'choices'   => array(
				'bubble'  => __( 'Bubble', 'trestle' ),
				'solid'   => __( 'Solid', 'trestle' ),
			)
		)
	);

	// Upload a logo.
	$wp_customize->add_setting(
		'trestle-settings[logo_url]',
		array(
			'default'     		=> genesis_get_option( 'logo_url', 'trestle-settings' ),
			'type'        		=> 'option',
			'transport'   		=> 'postMessage',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'trestle_logo_control',
			array(
				'label'      => __( 'Upload a logo', 'trestle' ),
				'section'    => 'trestle_settings_section',
				'settings'   => 'trestle-settings[logo_url]',
			)
		)
	);

	// Upload a mobile logo.
	$wp_customize->add_setting(
		'trestle-settings[logo_url_mobile]',
		array(
			'default'     		=> genesis_get_option( 'logo_url_mobile', 'trestle-settings' ),
			'type'        		=> 'option',
			'transport'   		=> 'postMessage',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'trestle_mobile_logo_control',
			array(
			   'label'      => __( 'Upload a mobile logo', 'trestle' ),
			   'section'    => 'trestle_settings_section',
			   'settings'   => 'trestle-settings[logo_url_mobile]',
			)
		)
	);

	// Upload a mobile logo.
	$wp_customize->add_setting(
		'trestle-settings[favicon_url]',
		array(
			'default'     		=> genesis_get_option( 'favicon_url', 'trestle-settings' ),
			'type'        		=> 'option',
			'transport'   		=> 'postMessage',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'trestle_favicon_control',
			array(
			   'label'      => __( 'Upload a favicon', 'trestle' ),
			   'section'    => 'trestle_settings_section',
			   'settings'   => 'trestle-settings[favicon_url]',
			)
		)
	);

	// Primary nav style.
	$wp_customize->add_setting(
		'trestle-settings[nav_primary_location]',
		array(
			'default'			=> genesis_get_option( 'nav_primary_location', 'trestle-settings' ),
			'type'				=> 'option',
			'transport' 		=> 'postMessage',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_nav_primary_location_control',
		array(
			'section'   => 'trestle_settings_section',
			'settings'  => 'trestle-settings[nav_primary_location]',
			'label'     => __( 'Menu style', 'trestle' ),
			'type'      => 'select',
			'choices'   => array(
				'full'  	=> __( 'Full Width', 'trestle' ),
				'header'   	=> __( 'Header Right', 'trestle' ),
			)
		)
	);

	// Primary nav extras.
	$wp_customize->add_setting(
		'trestle-settings[search_in_nav]',
		array(
			'default'			=> genesis_get_option( 'search_in_nav', 'trestle-settings' ),
			'type'				=> 'option',
			'transport' 		=> 'postMessage',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_custom_nav_extras_text_control',
		array(
			'section'   => 'trestle_settings_section',
			'settings'  => 'trestle-settings[search_in_nav]',
			'label'     => __( 'Add search to mobile navigation', 'trestle' ),
			'type'		=> 'checkbox',
		)
	);

	// Blog post custom read more link text.
	$wp_customize->add_setting(
		'trestle-settings[read_more_text]',
		array(
			'default'			=> genesis_get_option( 'read_more_text', 'trestle-settings' ),
			'type'				=> 'option',
			'transport' 		=> 'postMessage',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'trestle_read_more_text_control',
		array(
			'section'   => 'trestle_settings_section',
			'settings'  => 'trestle-settings[read_more_text]',
			'label'     => __( 'Custom read more link text', 'trestle' ),
		)
	);

	// Post revisions number.
	$wp_customize->add_setting(
		'trestle-settings[revisions_number]',
		array(
			'default'			=> genesis_get_option( 'revisions_number', 'trestle-settings' ),
			'type'				=> 'option',
			'transport' 		=> 'postMessage',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_revisions_number_control',
		array(
			'section'   => 'trestle_settings_section',
			'settings'  => 'trestle-settings[revisions_number]',
			'label'     => __( 'Number of post revisions', 'trestle' ),
			'type'      => 'select',
			'choices'   => array(
				'-1'    => __( 'Unlimited', 'trestle' ),
				'0'  	=> '0',
				'1' 	=> '1',
				'2'		=> '2',
				'3'		=> '3',
				'4'		=> '4',
				'5' 	=> '5',
				'6'		=> '6',
				'7' 	=> '7',
				'8' 	=> '8',
				'9' 	=> '9',
				'10' 	=> '10',
			)
		)
	);

	// Footer Widget Areas.
	$wp_customize->add_setting(
		'trestle-settings[footer_widgets_number]',
		array(
			'default'			=> genesis_get_option( 'footer_widgets_number', 'trestle-settings' ),
			'type'				=> 'option',
			'transport' 		=> 'postMessage',
			'capability' 		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_footer_widgets_number_control',
		array(
			'section'   => 'trestle_settings_section',
			'settings'  => 'trestle-settings[footer_widgets_number]',
			'label'     => __( 'Number of footer widgets', 'trestle' ),
			'type'      => 'select',
			'choices'   => array(
				'0'  	=> '0',
				'1' 	=> '1',
				'2'		=> '2',
				'3'		=> '3',
				'4'		=> '4',
				'5' 	=> '5',
				'6'		=> '6',
			)
		)
	);

	// Add a label for the link icons.
	$wp_customize->add_setting(
		'trestle-settings[link_icons_title]',
		array(
			'default'			=> '',
			'type'				=> 'option',
		)
	);
	$wp_customize->add_control(
		'trestle_link_icons_title',
		array(
			'section'	=> 'trestle_settings_section',
			'settings'	=> 'trestle-settings[link_icons_title]',
			'label'		=> __( 'Icon links', 'trestle' ),
			'type'		=> 'hidden',
		)
	);

	// External Link Icons.
	$wp_customize->add_setting(
		'trestle-settings[external_link_icons]',
		array(
			'default'			=> genesis_get_option( 'external_link_icons', 'trestle-settings' ),
			'type'				=> 'option',
			'transport' 		=> 'postMessage',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_external_link_icons',
		array(
			'section'	=> 'trestle_settings_section',
			'settings'	=> 'trestle-settings[external_link_icons]',
			'label'		=> __( 'Add icons to external links', 'trestle' ),
			'type'		=> 'checkbox',
		)
	);

	// E-mail Link Icons.
	$wp_customize->add_setting(
		'trestle-settings[email_link_icons]',
		array(
			'default'			=> genesis_get_option( 'email_link_icons', 'trestle-settings' ),
			'type'				=> 'option',
			'transport' 		=> 'postMessage',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_email_link_icons',
		array(
			'section'	=> 'trestle_settings_section',
			'settings'	=> 'trestle-settings[email_link_icons]',
			'label'		=> __( 'Add icons to email links', 'trestle' ),
			'type'		=> 'checkbox',
		)
	);

	// PDF Link Icons.
	$wp_customize->add_setting(
		'trestle-settings[pdf_link_icons]',
		array(
			'default'			=> genesis_get_option( 'pdf_link_icons', 'trestle-settings' ),
			'type'				=> 'option',
			'transport' 		=> 'postMessage',
			'capability'		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_pdf_link_icons',
		array(
			'section'	=> 'trestle_settings_section',
			'settings'	=> 'trestle-settings[pdf_link_icons]',
			'label'		=> __( 'Add icons to .pdf links', 'trestle' ),
			'type'		=> 'checkbox',
		)
	);

	// Doc Link Icons.
	$wp_customize->add_setting(
		'trestle-settings[doc_link_icons]',
		array(
			'default'			=> genesis_get_option( 'doc_link_icons', 'trestle-settings' ),
			'type'				=> 'option',
			'transport' 		=> 'postMessage',
			'capability' 		=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_doc_link_icons',
		array(
			'section'	=> 'trestle_settings_section',
			'settings'	=> 'trestle-settings[doc_link_icons]',
			'label'		=> __( 'Add icons to .doc links', 'trestle' ),
			'type'		=> 'checkbox',
		)
	);

}
