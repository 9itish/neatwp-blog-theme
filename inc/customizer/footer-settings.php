<?php

require_once get_template_directory() . '/inc/customizer/class-wp-customize-label-control.php';

function neatwp_footer_customize_register($wp_customize) {
    $wp_customize->add_section('footer_settings', array(
        'title'    => __('Footer Settings', 'neatwp-blog-theme'),
        'priority' => 130,
    ));

    $wp_customize->add_setting('footer_column_order', array(
        'default'           => '1-2-3-4',
        'sanitize_callback' => 'sanitize_column_order',
    ));

    $wp_customize->add_control('footer_column_order', array(
        'label'    => __('Footer Widget Order', 'neatwp-blog-theme'),
        'section'  => 'footer_settings',
        'settings' => 'footer_column_order',
        'type'     => 'text',
        'description' => __('Enter footer column numbers in the desired order, separated by hyphens. E.g., 4-1-3-2.', 'neatwp-blog-theme'),
    ));

    neatwp_add_footer_display_options($wp_customize);

    neatwp_add_footer_color_options($wp_customize);

    neatwp_add_footer_text_color_options($wp_customize);
}
add_action('customize_register', 'neatwp_footer_customize_register');

function neatwp_add_footer_color_options( $wp_customize ) {

    $wp_customize->add_setting('footer_settings_bg_heading', array(
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control(new WP_Customize_Label_Control($wp_customize, 'footer_settings_bg_heading', array(
        'label'   => __('Section Background Colors', 'neatwp-blog-theme'),
        'type' => 'heading',
        'section' => 'footer_settings',
    )));

    $wp_customize->add_setting('footer_settings_bg_text', array(
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control(new WP_Customize_Label_Control($wp_customize, 'footer_settings_bg_text', array(
        'label'   => __('Choose custom colors that will apply to respective sections of the footer.', 'neatwp-blog-theme'),
        'type' => 'text',
        'section' => 'footer_settings',
    )));

    // List of your color variables
    $color_variables = array(
        'footer-column-section'   => __( 'Widget Columns Section', 'neatwp-blog-theme' ),
        'footer-tagline-section' => __( 'Tagline Section', 'neatwp-blog-theme' ),
        'footer-copyright-section'   => __( 'Copyright Section', 'neatwp-blog-theme' )
    );

    // Add a setting and control for each variable
    foreach ( $color_variables as $var_name => $label ) {
        $wp_customize->add_setting( "neatwp_$var_name"."-color", array(
            'default'           => '', // Default empty for fallback
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "neatwp_$var_name"."-color", array(
            'label'   => $label,
            'section' => 'footer_settings',
            'settings' => "neatwp_$var_name"."-color",
        ) ) );
    }
}

function neatwp_add_footer_text_color_options( $wp_customize ) {

    $wp_customize->add_setting('footer_settings_bg_heading', array(
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control(new WP_Customize_Label_Control($wp_customize, 'footer_settings_bg_heading', array(
        'label'   => __('Section Background Colors', 'neatwp-blog-theme'),
        'type' => 'heading',
        'section' => 'footer_settings',
    )));

    $wp_customize->add_setting('footer_settings_bg_text', array(
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control(new WP_Customize_Label_Control($wp_customize, 'footer_settings_bg_text', array(
        'label'   => __('Choose custom colors that will apply to respective sections of the footer.', 'neatwp-blog-theme'),
        'type' => 'text',
        'section' => 'footer_settings',
    )));

    // List of your color variables
    $color_variables = array(
        'footer-column-section'   => __( 'Widget Columns Section', 'neatwp-blog-theme' ),
        'footer-tagline-section' => __( 'Tagline Section', 'neatwp-blog-theme' ),
        'footer-copyright-section'   => __( 'Copyright Section', 'neatwp-blog-theme' )
    );

    // Add a setting and control for each variable
    foreach ( $color_variables as $var_name => $label ) {
        $wp_customize->add_setting( "neatwp_$var_name"."-color", array(
            'default'           => '', // Default empty for fallback
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "neatwp_$var_name"."-color", array(
            'label'   => $label,
            'section' => 'footer_settings',
            'settings' => "neatwp_$var_name"."-color",
        ) ) );
    }
}

function neatwp_add_footer_display_options( $wp_customize ) {

    $wp_customize->add_setting('footer_settings_display_heading', array(
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control(new WP_Customize_Label_Control($wp_customize, 'footer_settings_display_heading', array(
        'label'   => __('Section Display Settings', 'neatwp-blog-theme'),
        'type' => 'heading',
        'section' => 'footer_settings',
    )));

    $wp_customize->add_setting('footer_settings_display_text', array(
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control(new WP_Customize_Label_Control($wp_customize, 'footer_settings_display_text', array(
        'label'   => __('Select the footer sections that you want visitors to see.', 'neatwp-blog-theme'),
        'type' => 'text',
        'section' => 'footer_settings',
    )));

    $wp_customize->add_setting('footer_widgets_section_display', array(
        'default'           => 1,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('footer_widgets_section_display', array(
        'label'    => __('Widget columns section.', 'neatwp-blog-theme'),
        'section'  => 'footer_settings',
        'settings' => 'footer_widgets_section_display',
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('footer_tagline_section_display', array(
        'default'           => 1,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('footer_tagline_section_display', array(
        'label'    => __('Tagline and Logo section.', 'neatwp-blog-theme'),
        'section'  => 'footer_settings',
        'settings' => 'footer_tagline_section_display',
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('footer_copyright_section_display', array(
        'default'           => 1,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('footer_copyright_section_display', array(
        'label'    => __('Copyright section.', 'neatwp-blog-theme'),
        'section'  => 'footer_settings',
        'settings' => 'footer_copyright_section_display',
        'type'     => 'checkbox'
    ));

}