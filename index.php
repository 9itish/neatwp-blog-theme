<?php 

get_header();
require get_template_directory() . '/inc/utility.php';

?>

<?php 

do_action('neatwp_blog_before_archive_main_content');

$archive_layout = get_theme_mod('neatwp_archive_layout', 'grid');

?>

<main id="main-content" class="tag-posts n-flex <?php echo $archive_layout == 'grid' ? 'n-flex-aw-22334' : 'n-gap-x4' ?>">
    <?php get_template_part('templates/archive', 'post-list', array(
        'archive_layout' => $archive_layout
    )); ?>
</main>

<?php do_action('neatwp_blog_after_archive_main_content'); ?>

<?php get_footer(); ?>
