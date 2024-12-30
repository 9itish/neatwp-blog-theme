<?php

require_once get_template_directory() . '/inc/customizer/class-wp-customize-label-control.php';

function neatwp_archive_customize_register($wp_customize) {
    $wp_customize->add_section('archive_settings', array(
        'title'    => __('Archive Settings', 'neatwp-blog-theme'),
        'priority' => 130,
    ));

    $wp_customize->add_setting('neatwp_archive_post_cards_shape', [
        'default'           => 'rectangle',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('neatwp_archive_post_cards_shape_control', [
        'label'    => __('Select post card shape.', 'neatwp'),
        'section'  => 'archive_settings',
        'settings' => 'neatwp_archive_post_cards_shape',
        'type'     => 'select',
        'choices'  => [
            'rectangle' => __('Rectangle', 'neatwp'),
            'rounded' => __('Rounded', 'neatwp'),
        ],
        'description' => __('When the posts on the archive pages are in card format, you can selectwhether they should be rectangular or have rounded corners.', 'neatwp-blog-theme'),
    ]);

    $wp_customize->add_setting('neatwp_archive_layout', array(
        'default'   => 'grid',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('neatwp_archive_layout_control', array(
        'type'    => 'select',
        'section' => 'archive_settings',
        'settings' => 'neatwp_archive_layout',
        'label'   => __('Archive Layout', 'neatwp-blog-theme'),
        'choices' => array(
            'grid'    => __('Grid', 'neatwp-blog-theme'),
            'list'    => __('List', 'neatwp-blog-theme')
        ),
    ));

    $wp_customize->add_setting('neatwp_archive_card_hover_effect', array(
        'default'   => 'zoom',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('neatwp_archive_card_hover_effect_control', array(
        'type'    => 'select',
        'section' => 'archive_settings',
        'settings' => 'neatwp_archive_card_hover_effect',
        'label'   => __('Archive Post Cards Hover Effect', 'neatwp-blog-theme'),
        'choices' => array(
            'zoom'    => __('Zoom', 'neatwp-blog-theme'),
            'box-shadow'    => __('Box Shadow', 'neatwp-blog-theme')
        ),
    ));

    $wp_customize->add_setting('archive_settings_card_content_heading', array(
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control(new WP_Customize_Label_Control($wp_customize, 'archive_settings_card_content_heading', array(
        'label'   => __('Post Card Content Visibility', 'neatwp-blog-theme'),
        'type' => 'heading',
        'section' => 'archive_settings',
    )));

    $wp_customize->add_setting('archive_settings_card_content_text', array(
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control(new WP_Customize_Label_Control($wp_customize, 'archive_settings_card_content_text', array(
        'label'   => __('Select the post card elements you want visitors to see.', 'neatwp-blog-theme'),
        'type' => 'text',
        'section' => 'archive_settings',
    )));

    $wp_customize->add_setting('neatwp_archive_card_show_post_thumbnail', array(
        'default'           => 1,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('neatwp_archive_card_show_post_thumbnail_control', array(
        'label'    => __('Featured Image', 'neatwp-blog-theme'),
        'section'  => 'archive_settings',
        'settings' => 'neatwp_archive_card_show_post_thumbnail',
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('neatwp_archive_card_show_heading', array(
        'default'           => 1,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('neatwp_archive_card_show_heading_control', array(
        'label'    => __('Post Title', 'neatwp-blog-theme'),
        'section'  => 'archive_settings',
        'settings' => 'neatwp_archive_card_show_heading',
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('neatwp_archive_card_show_excerpt', array(
        'default'           => 1,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('neatwp_archive_card_show_excerpt_control', array(
        'label'    => __('Post Excerpt', 'neatwp-blog-theme'),
        'section'  => 'archive_settings',
        'settings' => 'neatwp_archive_card_show_excerpt',
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting('neatwp_archive_card_show_meta', array(
        'default'           => 1,
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('neatwp_archive_card_show_meta_control', array(
        'label'    => __('Post Meta', 'neatwp-blog-theme'),
        'section'  => 'archive_settings',
        'settings' => 'neatwp_archive_card_show_meta',
        'type'     => 'checkbox'
    ));

    $wp_customize->add_setting( "neatwp_archive_card_meta_color", array(
        'default'           => '', // Default empty for fallback
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "neatwp_archive_card_meta_color", array(
        'label'   => 'Post Card Meta',
        'section' => 'archive_settings',
        'settings' => "neatwp_archive_card_meta_color",
    ) ) );


}
add_action('customize_register', 'neatwp_archive_customize_register');