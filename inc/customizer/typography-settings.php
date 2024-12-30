<?php

function neatwp_typography_customize_register($wp_customize) {
    // Typography Section
    $wp_customize->add_section('neatwp_typography', [
        'title'    => __('Typography', 'neatwp'),
        'priority' => 30,
    ]);

    // Font Family for Headings
    $wp_customize->add_setting('neatwp_heading_font_family', [
        'default'   => 'Arial, sans-serif',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('neatwp_heading_font_family_control', [
        'label'    => __('Heading Font Family', 'neatwp'),
        'section'  => 'neatwp_typography',
        'settings' => 'neatwp_heading_font_family',
        'type'     => 'select',
        'choices'  => array(
            'Roboto'       => 'Roboto',
            'Open Sans'    => 'Open Sans',
            'Lato'         => 'Lato',
            'Montserrat'   => 'Montserrat',
            'Source Sans Pro' => 'Source Sans Pro',
            'Poppins'      => 'Poppins',
        ),
    ]);

    // Font Family for Body Text
    $wp_customize->add_setting('neatwp_body_font_family', [
        'default'   => 'Georgia, serif',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('neatwp_body_font_family_control', [
        'label'    => __('Body Font Family', 'neatwp'),
        'section'  => 'neatwp_typography',
        'settings' => 'neatwp_body_font_family',
        'type'     => 'select',
        'choices'  => array( 
            'Roboto'       => 'Roboto',
            'Open Sans'    => 'Open Sans',
            'Lato'         => 'Lato',
            'Montserrat'   => 'Montserrat',
            'Source Sans Pro' => 'Source Sans Pro',
            'Poppins'      => 'Poppins',
        ),
    ]);

    // Font Size for Body Text
    $wp_customize->add_setting('neatwp_body_font_size', [
        'default'   => 16,
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('neatwp_body_font_size_control', [
        'label'    => __('Body Font Size', 'neatwp'),
        'section'  => 'neatwp_typography',
        'settings' => 'neatwp_body_font_size',
        'type'     => 'number',
        'input_attrs' => ['min' => 12, 'max' => 72],
    ]);
}
add_action('customize_register', 'neatwp_typography_customize_register');