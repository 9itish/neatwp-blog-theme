<?php

function neatwp_add_site_subtitle_option( $wp_customize ) {
    // Add the setting for the subtitle
    $wp_customize->add_setting( 'site_subtitle', array(
        'default'           => 'Blog',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh', // Use 'postMessage' for live preview
    ) );

    // Add the control for the subtitle
    $wp_customize->add_control( 'site_subtitle', array(
        'label'       => __( 'Site Subtitle', 'neatwp-blog-theme' ),
        'section'     => 'title_tagline', // Add it to the Site Identity section
        'type'        => 'text',
        'priority'    => 25, // Position it below the Site Title field
    ) );

    // Add the setting for the display toggle (title + subtitle or logo)
    $wp_customize->add_setting( 'display_title_subtitle_instead_of_logo', array(
        'default'           => false,
        'sanitize_callback' => 'sanitize_checkbox',
        'transport'         => 'refresh', // Use 'postMessage' for live preview
    ) );

    // Add the control (checkbox) to toggle display
    $wp_customize->add_control( 'display_title_subtitle_instead_of_logo', array(
        'label'    => __( 'Display Site title and subtitle instead of Logo inside the header navigation.', 'neatwp-blog-theme' ),
        'section'  => 'title_tagline',
        'type'     => 'checkbox',
        'priority' => 30,
    ) );

    // Remove the default "Display Title and Tagline" checkbox
    $wp_customize->remove_control( 'display_header_text' );

    // Add your custom control for the footer
    $wp_customize->add_setting( 'display_title_tagline_in_footer', array(
        'default'           => false, // Default is false, meaning the title and tagline are not shown in the footer
        'sanitize_callback' => 'sanitize_checkbox',
        'transport'         => 'refresh', // Refresh the preview when changed
    ) );

    $wp_customize->add_control( 'display_title_tagline_in_footer', array(
        'label'    => __( 'Display Site Title and Tagline in Footer', 'neatwp-blog-theme' ),
        'section'  => 'title_tagline',
        'type'     => 'checkbox',
        'priority' => 50,
    ) );
}
add_action( 'customize_register', 'neatwp_add_site_subtitle_option' );