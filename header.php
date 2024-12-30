<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title: Dynamic and SEO-friendly -->
    <title><?php bloginfo('name'); ?><?php wp_title('•', true); ?></title>

    <!-- Favicon: Customizable through Customizer or default fallback -->
    <link rel="icon" href="<?php echo get_theme_mod('site_favicon', get_stylesheet_directory_uri() . '/favicon.png'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo get_theme_mod('site_favicon', get_stylesheet_directory_uri() . '/favicon.png'); ?>" type="image/x-icon">

    <!-- WordPress Head -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="top">

<div class="nav-wrapper n-bshadow s-pad">
<nav class="n-navigation main-nav tc-neutral">

    <?php
    $site_name = get_bloginfo('name'); // Get the full site name
    $name_parts = explode(' ', $site_name); // Split into parts by space

    // Ensure you handle cases where there might not be two parts
    $first_part = isset($name_parts[0]) ? $name_parts[0] : '';
    $second_part = isset($name_parts[1]) ? $name_parts[1] : '';

    $display_title_subtitle = get_theme_mod( 'display_title_subtitle_instead_of_logo', false );

    $display_logo = has_custom_logo() && !$display_title_subtitle;

    $nav_brand_classes = "nav-brand";

    if($display_logo) {
        $nav_brand_classes .= " show-logo";
    }
    ?>

    <a href="<?php echo esc_url(home_url('/')); ?>" class="<?php echo $nav_brand_classes; ?>">
        <?php
        
        if ($display_logo) :
            $logo_id = get_theme_mod('custom_logo'); // Get the logo's attachment ID
            $logo_url = wp_get_attachment_image_url($logo_id, 'full'); // Get the URL of the logo
            echo '<img class="site-logo" src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . '">';
        else :
        ?>
            <span class="bg-brand-primary tc-white s-lr-pad site-name"><?php echo esc_html(get_bloginfo('name')); ?></span>
            <?php if ( get_theme_mod( 'site_subtitle', '' ) ) : ?>
            <span class="tc-white bg-brand-secondary s-lr-pad site-subtitle"><?php echo esc_html(get_theme_mod( 'site_subtitle' )); ?></span>
            <?php endif; ?>
        <?php endif; ?>
    </a>


    <!-- Menu opener icon -->
    <i class="fa-solid fa-bars menu-opener" data-close="fa-bars" data-open="fa-xmark"></i>

    <!-- Navigation links -->
    <div class="n-navlink-group">
        <?php
        // Output WordPress menu
        wp_nav_menu(array(
            'theme_location' => 'primary', // the menu location assigned in the WordPress admin
            'container' => 'ol', // wraps the menu in an <ol> element
            'menu_class' => '', // remove default <ul> class
            'items_wrap' => '<ol>%3$s</ol>', // Custom wrap to use <ol> instead of <ul>
            'link_before' => '', // remove unwanted text before each link
            'link_after' => '', // remove unwanted text after each link
            'depth' => 1, // Prevents nested menus if you want to avoid it
        ));
        ?>
    </div>
</nav>
</div>

<div id="wrapper" class="n-wrapper">
    <div class="overlay"></div>

    <!-- Page Content Wrapper -->
    <div id="page-content-wrapper">
        <div class="container n-flex">
            <?php if (!is_404() && !is_home()) { ?>
                <div class="main-content-wrapper n-mw-2-3 s-pad-x4 has-sidebar">
            <?php } else { ?>
                <div class="main-content-wrapper">
            <?php } ?>
                
