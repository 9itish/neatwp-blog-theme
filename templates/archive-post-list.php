<?php if (have_posts()) { ?>
        <?php while (have_posts()) { the_post(); ?>
            <!-- Set the ID attribute of each post to the current post ID for differentiation.  -->
            <?php $card_shape = get_theme_mod('neatwp_archive_post_cards_shape', 'rectangle');

            $card_hover_effect = get_theme_mod('neatwp_archive_card_hover_effect', 'zoom');

            
            $archive_layout = $archive_layout = $args['archive_layout'] ?? 'grid'; ?>

            <div class="article-item-wrapper <?php echo $archive_layout == 'grid' ? 's-pad-x2' : '' ?>">

            <?php 
            // The post_class() function already outputs the class attribute. So, we just append our class name to the string passed to the post_class() function.
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('n-card n-bshadow s-pad-x2 ' . ($card_shape == 'rounded' ? 'n-round-x2 ' : '').($card_hover_effect == 'zoom' ? 'n-h-zoom' : 'n-h-bshadow')); ?>>

                <?php

                if (get_theme_mod('neatwp_archive_card_show_post_thumbnail', 1)) {

                    if (has_post_thumbnail()) {

                        do_action('neatwp_blog_before_archive_post_thumbnail');

                        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        echo '<img class="n-image-responsive n-round-x5" src="' . esc_url($image_url) . '" alt="">';

                        do_action('neatwp_blog_before_archive_post_thumbnail');
                    }

                }
                
                ?>
                
                <?php

                if (get_theme_mod('neatwp_archive_card_show_heading', 1)) {

                    do_action('neatwp_blog_before_archive_post_header');
                    echo neatwp_post_header_markup();
                    do_action('neatwp_blog_after_archive_post_header');

                }

                ?>

                <?php

                if (get_theme_mod('neatwp_archive_card_show_excerpt', 1)) {

                    do_action('neatwp_blog_before_archive_post_excerpt');
                    echo neatwp_post_excerpt_markup();
                    do_action('neatwp_blog_after_archive_post_excerpt');

                }

                ?>

                <?php

                if (get_theme_mod('neatwp_archive_card_show_meta', 1)) {

                    do_action('neatwp_blog_before_archive_post_meta');
                    echo neatwp_post_meta_markup();
                    do_action('neatwp_blog_after_archive_post_meta');

                }

                ?>

            </article>
            </div>
        <?php } ?>

    <?php } else { ?>
        <p><?php _e( 'No posts found.', 'neatwp-blog-theme' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Return to homepage', 'neatwp-blog-theme' ); ?></a></p>
    <?php } ?>

<?php

echo neatwp_pagination_markup();

?>
