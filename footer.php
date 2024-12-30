</div>

<?php if (!is_404() && !is_home()) { ?>
    <div class="sidebar-wrapper n-mw-1-3 s-pad-x4">
        <?php if (is_page() || is_archive()) {
            do_action('neatwp_blog_before_page_sidebar');
            get_sidebar('pages');
            do_action('neatwp_blog_after_page_sidebar');
        } else {
            do_action('neatwp_blog_before_general_sidebar');
            get_sidebar();
            do_action('neatwp_blog_after_general_sidebar');
        } ?>
    </div>
<?php } ?>

<?php if (get_theme_mod('neatwp_scroll_top_toggle', 1)) {
    $scroll_position = get_theme_mod('neatwp_scroll_top_position', 'right');
    $scroll_shape = get_theme_mod('neatwp_scroll_top_shape', 'rectangle');
    $scroll_font_size = get_theme_mod('neatwp_scroll_top_size', 'medium');
    $font_size_class = '';

    switch ($scroll_font_size) {
        case 'x-small': $font_size_class = 'txt-xs'; break;
        case 'small': $font_size_class = 'txt-sm'; break;
        case 'large': $font_size_class = 'txt-lg'; break;
        case 'x-large': $font_size_class = 'txt-xl'; break;
        default: $font_size_class = ''; break;
    }
?>
    <a href="#top" class="to-top <?php echo $scroll_position == 'left' ? 'fix-left' : ''; ?> <?php echo $scroll_shape == 'rounded' ? 'n-round-x2' : ''; ?> <?php echo $font_size_class; ?> s-pad-x2">
        <?php if (get_theme_mod('neatwp_scroll_top_percentage', 1)) { ?> <span class="scroll-amount">0%</span> <?php } ?>
        <i class="fas fa-angle-double-up"></i>
    </a>
<?php } ?>

<!-- Clear floated elements -->
<div style="clear: both;"></div>

</div> <!-- Closing container -->
</div>
</div>
<footer class="website-footer">
    <?php if (get_theme_mod('footer_widgets_section_display', 1)) {
        do_action('neatwp_blog_before_footer_widgets_section'); ?>
        <div class="footer-widgets-section footer-section s-pad-x6">
            <div class="footer-widget-wrapper n-flex n-flex-aw-1234">
                <?php
                $order = get_theme_mod('footer_column_order', '1-2-3-4');
                $order = explode('-', $order);

                if (!empty($order)) {
                    foreach ($order as $index) {
                        $sidebar_id = "footer-column-" . intval($index);
                        if (is_active_sidebar($sidebar_id)) {
                            do_action('neatwp_blog_before_footer_sidebar', $sidebar_id);
                            echo '<div class="footer-column s-lr-pad-x4">';
                            dynamic_sidebar($sidebar_id);
                            echo '</div>';
                            do_action('neatwp_blog_after_footer_sidebar', $sidebar_id);
                        }
                    }
                }
                ?>
            </div>
        </div>
    <?php do_action('neatwp_blog_after_footer_widgets_section');
    } ?>

    <?php if (get_theme_mod('footer_tagline_section_display', 1)) {
        do_action('neatwp_blog_before_footer_tagline_section'); ?>
        <div class="footer-tagline-section footer-section s-lr-pad-x6">
            <div class="footnote-wrapper n-flex n-flex-eq-aw">
                <?php

                $display_title_tagline_in_footer = get_theme_mod('display_title_tagline_in_footer', false);

                $site_name = get_bloginfo('name');
                $tagline = get_bloginfo('description');

                ?>
                <p><span class="title"><?php echo $site_name; ?></span><br><span class="tagline"><?php echo $tagline; ?></span></p>

                <?php

                if (has_custom_logo()) {
                    $logo_id = get_theme_mod('custom_logo'); // Get the logo's attachment ID
                    $logo_url = wp_get_attachment_image_url($logo_id, 'full'); // Get the URL of the logo
                    echo '<img class="site-logo" src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . '">';
                }

                ?>
            </div>
        </div>
    <?php do_action('neatwp_blog_after_footer_tagline_section');
    } ?>

    <?php if (get_theme_mod('footer_copyright_section_display', 1)) {
        do_action('neatwp_blog_before_footer_copyright_section'); ?>
        <div class="footer-copyright-section footer-section s-lr-pad-x6">
            <div class="footnote-wrapper">
                <p class="copyright-notice">Copyright © <?php echo date("Y") . ' ' . $site_name; ?>. All rights reserved.</p>
            </div>
        </div>
    <?php do_action('neatwp_blog_after_footer_copyright_section');
    } ?>
</footer>

<?php

// Output performance information in the console
$time_taken = sprintf("%0.2f", microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]);
$memory_used = sprintf("%0.2f", memory_get_peak_usage(false) / (1024 * 1024));

wp_footer(); // Important: Always include this for plugin compatibility
?>

<script type="text/javascript">
    console.info('<?php echo $time_taken; ?> Seconds');
    console.info('<?php echo $memory_used; ?> MB');
</script>

</body>

</html>