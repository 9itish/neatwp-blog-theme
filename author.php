<?php

get_header();
require get_template_directory() . '/inc/utility.php';

?>

<?php 
// Get the current author data safely
$current_author = (isset($_GET['author_name'])) ? get_user_by('slug', esc_attr($_GET['author_name'])) : get_userdata(get_the_author_meta('ID')); 
?>

<?php do_action('neatwp_blog_before_archive_author_profile'); ?>

<section class="author-profile">
    <!-- Display Author Name -->
    <h1 class="post-list-heading"><?php echo esc_html($current_author->display_name); ?></h1>

    <!-- Display Author Description if available -->
    <?php if (!empty($current_author->description)): ?>
        <p><?php echo esc_html($current_author->description); ?></p>
    <?php endif; ?>
</section>

<?php 

do_action('neatwp_blog_after_archive_author_profile');

$archive_layout = get_theme_mod('neatwp_archive_layout', 'grid');

?>

<h2>Recent Posts by <?php echo esc_html($current_author->display_name); ?></h2>

<?php do_action('neatwp_blog_before_archive_main_content'); ?>

<main id="main-content" class="author-posts n-flex <?php echo $archive_layout == 'grid' ? 'n-flex-aw-112' : 'n-gap-x4' ?>">
    <?php get_template_part('templates/archive', 'post-list', array(
        'archive_layout' => $archive_layout
    )); ?>
</main>

<?php do_action('neatwp_blog_after_archive_main_content'); ?>

<?php

get_footer();

?>