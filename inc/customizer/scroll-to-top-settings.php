<?php

function neatwp_scroll_top_customize_register($wp_customize)
{

    $wp_customize->add_section('neatwp_scrolltop', [
        'title'    => __('Scroll to Top Settings', 'neatwp'),
        'priority' => 30,
    ]);


    $wp_customize->add_setting('neatwp_scroll_top_toggle', [
        'default'   => 1,
        'sanitize_callback' => 'sanitize_checkbox'
    ]);

    $wp_customize->add_control('neatwp_scroll_top_toggle_control', [
        'label'    => __('Enable Scroll to Top.', 'neatwp'),
        'section'  => 'neatwp_scrolltop',
        'settings' => 'neatwp_scroll_top_toggle',
        'type'     => 'checkbox'
    ]);

    $wp_customize->add_setting('neatwp_scroll_top_percentage', [
        'default'           => 1,
        'sanitize_callback' => 'sanitize_checkbox',
    ]);
    
    $wp_customize->add_control('neatwp_scroll_top_percentage_control', [
        'label'    => __('Show scroll percentage inside button.', 'neatwp'),
        'section'  => 'neatwp_scrolltop',
        'settings' => 'neatwp_scroll_top_percentage',
        'type'     => 'checkbox',
    ]);

    // Add the scroll visibility percentage setting
    $wp_customize->add_setting('neatwp_scroll_top_threshold', [
        'default'           => 10, // Default visibility percentage
        'sanitize_callback' => 'absint', // Ensure the value is an absolute integer
    ]);

    // Add the control for scroll visibility percentage
    $wp_customize->add_control('neatwp_scroll_top_threshold_control', [
        'label'       => __('Scroll Visibility Threshold (%)', 'neatwp'),
        'description' => __('Specify the scroll percentage after which the button becomes visible.', 'neatwp'),
        'section'     => 'neatwp_scrolltop',
        'settings'    => 'neatwp_scroll_top_threshold',
        'type'        => 'number', // Number input
        'input_attrs' => [
            'min'  => 1,  // Minimum value
            'max'  => 50, // Maximum value
            'step' => 1,   // Increment step
        ],
    ]);

    $wp_customize->add_setting('neatwp_scroll_top_position', [
        'default'           => 'right',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('neatwp_scroll_top_position_control', [
        'label'    => __('Select if the button should be in the bottom left or the bottom right corner.', 'neatwp'),
        'section'  => 'neatwp_scrolltop',
        'settings' => 'neatwp_scroll_top_position',
        'type'     => 'radio',
        'choices'  => [
            'left'   => __('Left', 'neatwp'),
            'right'  => __('Right', 'neatwp'),
        ],
    ]);

    $wp_customize->add_setting('neatwp_scroll_top_shape', [
        'default'           => 'rectangle',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('neatwp_scroll_top_shape_control', [
        'label'    => __('Select button shape.', 'neatwp'),
        'section'  => 'neatwp_scrolltop',
        'settings' => 'neatwp_scroll_top_shape',
        'type'     => 'select',
        'choices'  => [
            'rectangle' => __('Rectangle', 'neatwp'),
            'rounded' => __('Rounded', 'neatwp'),
        ],
    ]);

    $wp_customize->add_setting('neatwp_scroll_top_size', [
        'default'           => 'medium',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('neatwp_scroll_top_size_control', [
        'label'    => __('Select the button size.', 'neatwp'),
        'section'  => 'neatwp_scrolltop',
        'settings' => 'neatwp_scroll_top_size',
        'type'     => 'select',
        'choices'  => [
            'x-small'  => __('Extra Small', 'neatwp'),
            'small'  => __('Small', 'neatwp'),
            'medium' => __('Medium', 'neatwp'),
            'large'  => __('Large', 'neatwp'),
            'x-large'  => __('Extra Large', 'neatwp'),
        ],
    ]);
}
add_action('customize_register', 'neatwp_scroll_top_customize_register');
