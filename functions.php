<?php

// Theme setup functions
function neatwp_theme_setup() {
    // Enable support for various theme features
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form'));

    add_theme_support('custom-logo');

    // Register primary navigation menu
    register_nav_menu('primary', 'Primary Navigation');
}
add_action('init', 'neatwp_theme_setup');

// Include Customizer settings
require get_template_directory() . '/inc/customizer/archive-settings.php';
require get_template_directory() . '/inc/customizer/color-settings.php';
require get_template_directory() . '/inc/customizer/footer-settings.php';
require get_template_directory() . '/inc/customizer/site-identity-settings.php';
require get_template_directory() . '/inc/customizer/typography-settings.php';
require get_template_directory() . '/inc/customizer/scroll-to-top-settings.php';

require get_template_directory() . '/inc/sanitization.php';




function neatwp_theme_enqueue_assets() {

    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css', array(), null);

    wp_enqueue_style('prism-style', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css', array(), null);


    // wp_enqueue_style('neatu-css', 'https://cdn.jsdelivr.net/gh/9itish/neatu-css-framework/css/neatu.min.css', array(), null);
    // wp_enqueue_script('neatu-js', 'https://cdn.jsdelivr.net/gh/9itish/neatu-css-framework/js/neatu.js', array(), null, true);

    wp_enqueue_style('neatu-css', 'https://cdn.jsdelivr.net/gh/9itish/neatu-css-framework@v2.0.2/css/neatu.min.css
', array(), null);
    wp_enqueue_script('neatu-js', 'https://cdn.jsdelivr.net/gh/9itish/neatu-css-framework@v2.0.2/js/neatu.js', array(), null, true);

    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/style.min.css', array(), filemtime(get_stylesheet_directory() . '/css/style.min.css'));
    
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/script.js', array('jquery'), filemtime(get_stylesheet_directory() . '/script.js'), true);

    wp_localize_script('theme-script', 'neatwpSettings', [
        'scrollPercentage' => get_theme_mod('neatwp_scroll_top_percentage', 1),
        'scrollThreshold' => get_theme_mod('neatwp_scroll_top_threshold', 10),
    ]);

    wp_enqueue_script('prism-js', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js', array(), '1.29.0', true);

}
add_action('wp_enqueue_scripts', 'neatwp_theme_enqueue_assets');

function neatwp_enqueue_customizer_assets() {
    wp_enqueue_style(
        'neatwp-customizer-styles', // Handle for the stylesheet
        get_template_directory_uri() . '/css/customizer.css', // Path to the stylesheet
        array(), // Dependencies (none in this case)
        filemtime(get_stylesheet_directory() . '/css/customizer.min.css') // Version
    );
}
add_action('customize_controls_enqueue_scripts', 'neatwp_enqueue_customizer_assets');



// Widget setup functions
function neatwp_widget_setup() {
    // Register the first sidebar (Post Sidebar)
    register_sidebar(array(
        'name'          => 'Post Sidebar',
        'id'            => 'sidebar-posts',
        'class'         => 'custom',
        'description'   => 'Post Sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s s-tb-mar-x4">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Register the second sidebar (Page Sidebar)
    register_sidebar(array(
        'name'          => 'Page Sidebar',
        'id'            => 'sidebar-pages',
        'class'         => 'custom',
        'description'   => 'Page Sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s s-tb-mar-x4">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'neatwp_widget_setup');


function neatwp_custom_search_block_render($block_content, $block) {
    if ($block['blockName'] === 'core/search') {
        ob_start();
        require locate_template('searchform.php');
        return ob_get_clean();
    }
    return $block_content;
}
add_filter('render_block', 'neatwp_custom_search_block_render', 10, 2);

// Update user_nicename programmatically
function neatwp_update_user_nicename($user_id) {
    $user_info = get_userdata($user_id);

    // Check if the user is an author
    if (in_array('editor', $user_info->roles)) {
        // Set user_nicename to something more secure (e.g., based on display_name)
        $new_nicename = sanitize_title($user_info->display_name);

        if ($user_info->user_nicename === $new_nicename) {
            return; // Exit to prevent unnecessary updates
        }

        // Avoid setting the nicename to an already existing one
        $original_nicename = $new_nicename;
        $counter = 1;
        while (username_exists($new_nicename)) {
            $new_nicename = $original_nicename . '-' . $counter;
            $counter++;
        }

        if ($user_info->user_nicename !== $new_nicename) {
            // Update user_nicename
            wp_update_user([
                'ID' => $user_id,
                'user_nicename' => $new_nicename
            ]);
        }
    }
}
add_action('profile_update', 'neatwp_update_user_nicename');

function neatwp_update_default_date_format() {
    $current_format = get_option('date_format');
    $desired_format = 'M j, Y';

    if ($current_format !== $desired_format) {
        update_option('date_format', $desired_format);
    }
}
add_action('after_setup_theme', 'neatwp_update_default_date_format');


// // Change the author base (optional)
// function neatwp_custom_author_base() {
//     global $wp_rewrite;
//     $wp_rewrite->author_base = 'writer'; // Change 'writer' to a neutral base term
//     $wp_rewrite->flush_rules(); // Flush rewrite rules to apply changes
// }
// add_action('init', 'neatwp_custom_author_base');


// // Modify author URL structure to use custom nicename
// function neatwp_modify_author_slug($author_link, $author_id) {
//     // Get the user info
//     $user_info = get_userdata($author_id);
    
//     // Use the updated user_nicename
//     $new_slug = $user_info->user_nicename;
    
//     // Modify the author link
//     return str_replace('/author/', '/writer/', $author_link);
// }
// add_filter('author_link', 'neatwp_modify_author_slug', 10, 2);

// Function to display random posts
function neatwp_random_posts() {
    $random_args = array(
        'post_type'           => 'post',
        'posts_per_page'      => 5,
        'orderby'             => 'rand',
        'no_found_rows'       => true,
        'ignore_sticky_posts' => 1,
    );

    $loop = new WP_Query($random_args);
    $counter = 0;
    $string = '<ul>';

    while ($loop->have_posts() && $counter < 5) : 
        $loop->the_post();
        $string .= '<li><a href="' . get_permalink() . '?utm_source=random_posts&utm_medium=organic&utm_campaign=website_traffic">' . get_the_title() . '</a></li>';
        $counter++;
    endwhile;

    $string .= '</ul>';

    wp_reset_postdata();
    return $string;
}
add_shortcode('random-posts', 'neatwp_random_posts');

// Function to display latest posts
function neatwp_latest_posts($atts) {

    $atts = shortcode_atts(array(
        'before' => '' // Default is an empty string if 'before' is not provided
    ), $atts);

    $before_content = !empty($atts['before']) ? strip_tags(wp_kses_post($atts['before'])) : '';

    $latest_args = array(
        'post_type'           => 'post',
        'posts_per_page'      => 5,
        'orderby'             => 'modified',
        'no_found_rows'       => true,
        'ignore_sticky_posts' => 1,
    );

    $last_loop = new WP_Query($latest_args);
    $counter = 0;

    $string = '';

    if (!empty($before_content)) {
        $string .= '<h3 class="no-mar">'.$before_content.'</h3>'; // 'before' content is passed directly, without <p> tags
    }

    $string .= '<ol class="no-mar">';

    while ($last_loop->have_posts() && $counter < 5) : 
        $last_loop->the_post();
        $string .= '<li><a href="' . get_permalink() . '?utm_source=latest_posts&utm_medium=organic&utm_campaign=website_traffic">' . get_the_title() . '</a></li>';
        $counter++;
    endwhile;

    $string .= '</ol>';
    wp_reset_postdata();

    $start_tag = substr($string, 0, 3);
    $end_tag = substr($string, -4);
    
    return $string;
}
add_shortcode('latest-posts', 'neatwp_latest_posts');

// Function to display selected posts based on IDs
function neatwp_selected_posts($atts = []) {
    // Get post IDs from attributes
    $post_ids = explode(',', $atts['ids']);

    $selected_args = array(
        'post_type'           => 'post',
        'posts_per_page'      => 5,
        'orderby'             => 'modified',
        'no_found_rows'       => true,
        'ignore_sticky_posts' => 1,
        'post__in'            => $post_ids,
    );

    $selected_loop = new WP_Query($selected_args);
    $counter = 0;
    $string = '<ul>';

    while ($selected_loop->have_posts() && $counter < 5) : 
        $selected_loop->the_post();
        $string .= '<li><a href="' . get_permalink() . '?utm_source=selected_posts&utm_medium=organic&utm_campaign=website_traffic">' . get_the_title() . '</a></li>';
        $counter++;
    endwhile;

    $string .= '</ul>';
    wp_reset_postdata();
    return substr($string, 4, -5);
}
add_shortcode('selected-posts', 'neatwp_selected_posts');


function neatwp_output_custom_colors() {
    // Get the values of all color settings
    $colors = array(
        'brand-primary-color'   => get_theme_mod( 'neatwp_brand-primary', '#0C3671' ), // Default fallback
        'brand-secondary-color ' => get_theme_mod( 'neatwp_brand-secondary', '#E68100' ),
        'link-color'   => get_theme_mod( 'neatwp_link', '#4CAF50' ),
        'link-hover-color'   => get_theme_mod( 'neatwp_link-hover', '#E53935' ),
        'post-sidebar-bg-color'   => get_theme_mod( 'neatwp_post-sidebar-bg', '#F57C00' ),
        'pagination-bg-color'   => get_theme_mod( 'neatwp_pagination-bg', '#2196F3' ),
        'text-color'   => get_theme_mod( 'neatwp_text', '#222222' ),
        'border-color'   => get_theme_mod( 'neatwp_border', '#AAAAAA' ),
        'footer-column-section-color' => get_theme_mod('neatwp_footer-column-section-color', '#000D'),
        'footer-tagline-section-color' => get_theme_mod('neatwp_footer-tagline-section-color', '#000E'),
        'footer-copyright-section-color' => get_theme_mod('neatwp_footer-copyright-section-color', '#000'),
        'archive-post-card-meta-color'   => get_theme_mod( 'neatwp_archive_card_meta_color', '#E68100' ),
    );

    // Start building the CSS block
    $custom_css = ":root {\n";
    foreach ( $colors as $var => $value ) {
        if ( $value ) {
            $custom_css .= "--n-$var: $value;\n";
        }
    }
    $custom_css .= "}\n";

    $heading_font_family = get_theme_mod('neatwp_heading_font_family', 'Arial, sans-serif');
    $body_font_family    = get_theme_mod('neatwp_body_font_family', 'Georgia, serif');
    $body_font_size      = get_theme_mod('neatwp_body_font_size', 16);

    $custom_css .= "
        :root {
            --n-base-font-size: {$body_font_size}px;
        }

        body {
           color: var(--n-text-color);
        }

        a {
            color: var(--n-link-color);
        }

        a:hover {
            color: var(--n-link-hover-color);
        }

        .post-sidebar {
            background: var(--n-post-sidebar-bg-color);
        }

        ul.pagination.pag-disjoint {
            color: var(--n-pagination-bg-color);
        }

        ul.pagination.pag-disjoint li:hover {
            color: white;
            background: color-mix(in srgb, var(--n-pagination-bg-color) 85%, black);
        }

        @media (min-width: 992px) {
            :root {
                --n-base-font-size: ".($body_font_size + 1)."px;
            }
        }

        @media (min-width: 1400px) {
            :root {
                --n-base-font-size: ".($body_font_size + 2)."px;
            }
        }

        body {
            font-family: {$body_font_family};
        }
        h1, h2, h3, h4, h5, h6 { 
            font-family: {$heading_font_family};
        }
    ";

    echo '<style type="text/css">' . $custom_css . '</style>';
}
add_action( 'wp_head', 'neatwp_output_custom_colors' );



function neatwp_register_footer_widgets() {
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => __('Footer Column ' . $i, 'neatwp'),
            'id'            => 'footer-column-' . $i,
            'description'   => __('Add widgets here for Footer Column ' . $i, 'neatwp'),
            'before_widget' => '<div class="footer-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="footer-widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'neatwp_register_footer_widgets');


// Add custom attributes to the 'Next' and 'Previous' page links in pagination
add_filter('next_posts_link_attributes', 'neatwp_add_next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'neatwp_add_previous_posts_link_attributes');

/**
 * Adds a custom class to the 'Next' page link in pagination.
 *
 * @return string HTML attributes for the 'Next' page link.
 */
function neatwp_add_next_posts_link_attributes() {
    return 'class="next-posts-page"';
}

/**
 * Adds a custom class to the 'Previous' page link in pagination.
 *
 * @return string HTML attributes for the 'Previous' page link.
 */
function neatwp_add_previous_posts_link_attributes() {
    return 'class="previous-posts-page"';
}


/**
 * Modifies the number of posts per page on author archive pages.
 *
 * Sets the 'posts_per_page' to 5 and orders the posts by modification date.
 *
 * @param WP_Query $query The current WP_Query object.
 */
// function neatwp_tweak_posts_per_page($query) {
//     // Ensure we're not in the admin area and that it's the main query on the author archive page.
//     if (!is_admin() && $query->is_main_query() && is_author()) {
//         // Set the number of posts per page to 5 and order by modification date.
//         $query->set('posts_per_page', 5);
//         $query->set('orderby', 'modified');
//     }
// }
// add_action('pre_get_posts', 'neatwp_tweak_posts_per_page');


function add_image_insert_override($sizes)
{
    unset($sizes['medium_large']); // Only remove sizes you are sure you won't need
    unset($sizes['1536x1536']);
    unset($sizes['2048x2048']);
    
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'add_image_insert_override');

function neatwp_add_classes_to_all_images($block_content) {
    $block_content = preg_replace('/<img(.*?)class="/', '<img$1class="n-bshadow n-round-x2 ', $block_content);
    return $block_content;
}
add_filter('render_block', 'neatwp_add_classes_to_all_images');



add_filter('auto_update_plugin', '__return_true');

function neatwp_custom_comment_form_defaults($defaults) {
    if (is_user_logged_in()) {
        $user = wp_get_current_user(); // Get current user info
        $profile_url = get_edit_profile_url($user->ID); // Profile edit URL
        $logout_url = wp_logout_url(get_permalink()); // Logout URL

        $defaults['logged_in_as'] = sprintf(
            '<div class="n-flex n-flex-eq-aw"><p class="logged-in-as">Logged in as %1$s.</p>
             <p class="n-flex edit-logout"><a href="%2$s"><i class="fa-solid fa-user-pen"></i> Edit profile</a><a href="%3$s"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log out</a></p></div>',
            esc_html($user->display_name),
            esc_url($profile_url),
            esc_url($logout_url)
        );
    }

    return $defaults;
}
add_filter('comment_form_defaults', 'neatwp_custom_comment_form_defaults');

function neatwp_enqueue_google_fonts() {
    // Get fonts from Customizer settings
    $heading_font = get_theme_mod('neatwp_heading_font_family', 'Roboto');
    $body_font    = get_theme_mod('neatwp_body_font_family', 'Open Sans');

    // Build Google Fonts URL
    $query_args = [
        'family' => urlencode("$heading_font:wght@400;700|$body_font:wght@400;700"),
        'display' => 'swap',
    ];
    $google_fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css2');

    // Enqueue Google Fonts
    wp_enqueue_style('neatwp-google-fonts', $google_fonts_url, [], null);
}
add_action('wp_enqueue_scripts', 'neatwp_enqueue_google_fonts');


function neatwp_custom_avatar($avatar, $id_or_email, $size, $default, $alt) {
    // Get the logo URL set in the theme (if exists)
    $logo_url = get_theme_mod('custom_logo');
    
    // If logo is set, use the logo URL, otherwise generate the placeholder with first letter of the blog name
    if ($logo_url) {
        $avatar_url = wp_get_attachment_image_url($logo_url, 'full');
    } else {
        // Get the first letter of the site name (fallback if no logo exists)
        $blog_name = get_bloginfo('name');
        $first_letter = strtoupper(substr($blog_name, 0, 1));
        
        // Create the placeholder image URL
        $avatar_url = "https://placehold.co/{$size}x{$size}/000/FFF?text={$first_letter}";
    }

    $user = false;

    if (is_numeric($id_or_email)) {
        // If numeric, treat it as a user ID
        $user = get_user_by('id', (int) $id_or_email);
    } elseif (is_object($id_or_email) && $id_or_email instanceof WP_Comment) {
        // If it's a WP_Comment object, get the user ID or author email
        if (!empty($id_or_email->user_id)) {
            $user = get_user_by('id', (int) $id_or_email->user_id);
        } elseif (!empty($id_or_email->comment_author_email)) {
            $user = get_user_by('email', $id_or_email->comment_author_email);
        }
    } elseif (is_string($id_or_email)) {
        // If it's a string, treat it as an email address
        $user = get_user_by('email', $id_or_email);
    }

    // If the user exists, use the custom avatar URL, otherwise use the default Gravatar logic
    if (!$user) {
        return $avatar; // Return the default avatar if user not found
    }

    // Custom avatar logic...
    $avatar_url = 'https://www.gravatar.com/avatar/' . md5($user->user_email) . '?d=' . urlencode($default) . '&s=' . $size;

    // Apply the custom avatar HTML
    $avatar = "<img src='{$avatar_url}' alt='{$alt}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";

    return $avatar;
}
add_filter('get_avatar', 'neatwp_custom_avatar', 10, 5);





function allow_img_srcset_content() {
    global $allowedposttags, $allowedtags;

    // New attribute for <img> tag
    $newattribute = "srcset";

    // Allow the 'srcset' attribute in the img tag
    $allowedposttags["img"][$newattribute] = true;
    $allowedtags["img"][$newattribute] = true;
}
add_action('init', 'allow_img_srcset_content');


function myformatTinyMCE($in) {
    // Disable the HTML verification in TinyMCE editor
    $in['verify_html'] = false;
    return $in;
}
add_filter('tiny_mce_before_init', 'myformatTinyMCE');



function comment_links_in_new_tab($text) {
    $return = str_replace('<a', '<a target="_blank"', $text);
    return $return;
}
add_filter('get_comment_author_link', 'comment_links_in_new_tab');
add_filter('comment_text', 'comment_links_in_new_tab');



function neatwp_custom_sender_email($original_email_address) {
    return 'admin@example.com';  
}
add_filter('wp_mail_from', 'neatwp_custom_sender_email');


function neatwp_custom_sender_name($original_email_from) {
    return 'Your Site Name';  
}
add_filter('wp_mail_from_name', 'neatwp_custom_sender_name');


function neatwp_mail_content_type() {
    return "text/html";
}
add_filter('wp_mail_content_type', 'neatwp_mail_content_type');


// Front-end not executed in the wp admin and the wp customizer (for compatibility reasons)

// See: https://core.trac.wordpress.org/ticket/45130 and https://core.trac.wordpress.org/ticket/37110

/**
 * Deregisters the default WordPress jQuery and registers the latest version of jQuery.
 * 
 * This function ensures that the latest version of jQuery is loaded on the frontend, except for
 * when in the admin area or the customizer preview.
 */
function neatwp_load_latest_jquery() {
    // Check if we are in the WordPress admin or customizer preview
    $wp_admin = is_admin();
    $wp_customizer = is_customize_preview();

    // Only modify jQuery on the frontend, not in the WP admin or customizer preview
    if ($wp_admin || $wp_customizer) {
        return; // Exit early if in admin or customizer
    }

    // Deregister WordPress's default jQuery and its migration script
    wp_deregister_script('jquery'); // Deregister the 'jquery' handle (which loads both jquery-core and jquery-migrate)
    wp_deregister_script('jquery-core'); // Deregister jQuery core
    wp_deregister_script('jquery-migrate'); // Deregister jQuery Migrate

    // Register the latest version of jQuery from CDN (cdnjs)
    wp_register_script('jquery-core', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js', '', null, true);
    wp_register_script('jquery-migrate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.3.0/jquery-migrate.min.js', '', null, true);

    /**
     * Register jQuery as a dependency for other scripts that might need it
     * The 'jquery' handle will now point to our registered scripts, using 'jquery-core' and 'jquery-migrate' as dependencies.
     * This ensures other scripts will be loaded after jQuery.
     */
    wp_register_script('jquery', false, array('jquery-core', 'jquery-migrate'), null, true);

    // Enqueue the registered jQuery script
    wp_enqueue_script('jquery');
}

// Hook the function into 'wp_enqueue_scripts' to run on the frontend
add_action('wp_enqueue_scripts', 'neatwp_load_latest_jquery');


function custom_password_reset_email($message, $key, $user_login, $user_data) {
    // Decode quoted-printable characters
    $decodedMessage = quoted_printable_decode($message);
    return $decodedMessage;
}
add_filter('retrieve_password_message', 'custom_password_reset_email', 10, 4);

function send_smtp_email($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host =       SMTP_HOST;
    $phpmailer->Username =   SMTP_USER;
    $phpmailer->Password =   SMTP_PASSWORD;
    $phpmailer->From =       SMTP_FROM;
    $phpmailer->FromName =   SMTP_FROMNAME;
    $phpmailer->Port =       SMTP_PORT;
    $phpmailer->SMTPAuth =   SMTP_AUTH;
    $phpmailer->SMTPSecure = SMTP_SECURE;
}
add_action('phpmailer_init', 'send_smtp_email');


// Step 4: Callback function to display field for site tagline
function neatwp_site_tagline_field_cb() {
    // Get the current value of the setting (if any)
    $options = get_option('neatwp_theme_options');
    ?>
    <input type="text" name="neatwp_theme_options[site_tagline]" value="<?php echo isset($options['site_tagline']) ? esc_attr($options['site_tagline']) : ''; ?>" />
    <?php
}

// Step 5: Callback function for section description
function neatwp_general_settings_cb() {
    echo '<p>Customize the general settings of the theme here.</p>';
}

function neatwp_customize_register($wp_customize) {

    // Add a custom section for theme options
    $wp_customize->add_section('neatwp_theme_options', array(
        'title'    => __('Theme Options', 'neatwp'),
        'priority' => 30,
    ));

    // Add a setting for custom logo URL
    $wp_customize->add_setting('neatwp_logo_url', array(
        'default'   => home_url(), // Default to the site's homepage URL
        'transport' => 'refresh',
    ));

    // Add control to update the logo URL
    $wp_customize->add_control('neatwp_logo_url', array(
        'label'   => __('Logo URL', 'neatwp'),
        'section' => 'neatwp_theme_options',
        'type'    => 'url',
    ));

    // Add a setting for the site color
    $wp_customize->add_setting('neatwp_site_color', array(
        'default'   => '#00aaff', // Default color (can still be changed by the user)
        'transport' => 'refresh',
    ));

    // Add control for the site color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'neatwp_site_color', array(
        'label'   => __('Site Color', 'neatwp'),
        'section' => 'neatwp_theme_options',
        'settings' => 'neatwp_site_color',
    )));

}
// add_action('customize_register', 'neatwp_customize_register');


function neatwp_customize_js() {
    // Enqueue the script for the Customizer
    wp_enqueue_script(
        'neatwp-customizer-js', // Handle
        get_template_directory_uri() . '/js/admin/customizer.js', // Path to your custom JS file
        array( 'jquery', 'customize-controls' ), // Dependencies
        null, // No version (you can add one if needed)
        true // Load in footer
    );
}
add_action( 'customize_controls_enqueue_scripts', 'neatwp_customize_js' );