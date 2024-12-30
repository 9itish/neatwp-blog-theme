<?php

function neatwp_theme_settings_page() {
    $theme_name = wp_get_theme()->get('Name');

    // Add settings page under the "Appearance" menu
    add_theme_page(
        $theme_name,  // Page title - uses the theme name
        $theme_name,  // Menu title - uses the theme name
        'manage_options',          // Capability required to access the page
        'neatwp_theme_settings',   // Menu slug
        'neatwp_theme_settings_form' // Function to display the form
    );
}
add_action('admin_menu', 'neatwp_theme_settings_page');

/* NeatWP Blog Theme Customizer */

function neatwp_theme_settings_form() {
    ?>
    <div class="wrap">
        <h1><?php echo wp_get_theme()->get('Name') . ' Settings'; ?></h1>

        <form method="post" action="options.php">
            <?php
            settings_fields('neatwp_theme_settings_group');
            do_settings_sections('neatwp_theme_settings');
            ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Default Gravatar URL</th>
                    <td>
                        <input type="text" name="neatwp_default_gravatar_url" value="<?php echo esc_attr(get_option('neatwp_default_gravatar_url')); ?>" class="regular-text" />
                    </td>
                </tr>

                <!-- Add other fields as needed -->
                <tr valign="top">
                    <th scope="row">Another Setting</th>
                    <td>
                        <input type="text" name="neatwp_another_setting" value="<?php echo esc_attr(get_option('neatwp_another_setting')); ?>" class="regular-text" />
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}


function neatwp_theme_settings_init() {
    // Register the settings group
    register_setting(
        'neatwp_theme_settings_group', // Settings group name
        'neatwp_default_gravatar_url'   // Option name
    );

    register_setting(
        'neatwp_theme_settings_group', // Settings group name
        'neatwp_another_setting'       // Option name
    );

    // Add a settings section (optional)
    add_settings_section(
        'neatwp_theme_settings_section', // Section ID
        'Default Settings',              // Section title
        null,                            // Callback for the section (can be null)
        'neatwp_theme_settings'          // Page slug
    );
}
add_action('admin_init', 'neatwp_theme_settings_init');