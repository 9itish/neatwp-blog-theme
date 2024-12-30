<?php

function neatwp_add_site_color_options( $wp_customize ) {
    // Add a section for color settings
    $wp_customize->add_section( 'neatwp_colors_section', array(
        'title'    => __( 'Site Colors', 'neatwp-blog-theme' ),
        'priority' => 30,
    ) );

    // List of your color variables
    $color_variables = array(
        'brand-primary'   => __( 'Brand Primary', 'neatwp-blog-theme' ),
        'brand-secondary' => __( 'Brand Secondary', 'neatwp-blog-theme' ),
        'link'   => __( 'Link Color', 'neatwp-blog-theme' ),
        'link-hover'   => __( 'Link Hover Color', 'neatwp-blog-theme' ),
        'post-sidebar-bg'   => __( 'Post Sidebar Background', 'neatwp-blog-theme' ),
        'pagination-bg'   => __( 'Pagination Background', 'neatwp-blog-theme' ),
        'text'      => __( 'Text Color', 'neatwp-blog-theme' ),
        'border'    => __( 'Border Color', 'neatwp-blog-theme' )
    );

    // Add a setting and control for each variable
    foreach ( $color_variables as $var_name => $label ) {
        $wp_customize->add_setting( "neatwp_$var_name", array(
            'default'           => '', // Default empty for fallback
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "neatwp_$var_name", array(
            'label'   => $label,
            'section' => 'neatwp_colors_section',
            'settings' => "neatwp_$var_name",
        ) ) );
    }
}
add_action( 'customize_register', 'neatwp_add_site_color_options' );