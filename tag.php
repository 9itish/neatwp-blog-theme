<?php 

get_header();
require get_template_directory() . '/inc/utility.php';

?>

<h1 class="post-list-heading">
    <?php
    $tag_name = single_tag_title( '', false );
    printf( esc_html__( 'Tag Archives: %s', 'neatwp-blog-theme' ), esc_html( $tag_name ) );
    ?>
</h1>

<?php 

do_action('neatwp_blog_before_archive_main_content');

$archive_layout = get_theme_mod('neatwp_archive_layout', 'grid');

?>

<main id="main-content" class="tag-posts n-flex <?php echo $archive_layout == 'grid' ? 'n-flex-aw-112' : 'n-gap-x4' ?>">
    <?php get_template_part('templates/archive', 'post-list', array(
        'archive_layout' => $archive_layout
    )); ?>
</main>

<?php do_action('neatwp_blog_after_archive_main_content'); ?>

<?php

get_footer();

?>