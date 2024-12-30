<?php get_header(); ?>

<main class="single-post">
    <?php if (have_posts()) { ?>
        <?php while (have_posts()) { 
            the_post(); 
            $title = get_the_title(); ?>

            <!-- Post Title -->
            <?php do_action('neatwp_blog_before_post_title'); ?>
            <h1><?php echo esc_html($title); ?></h1>
            <?php do_action('neatwp_blog_after_post_title'); ?>

            <!-- Post Metadata -->
            <?php do_action('neatwp_blog_before_post_meta'); ?>
            <div class="post-meta n-flex n-flex-eq-sw">
                <div>
                    <time datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>" class="mod-time"><span><i class="fa-solid fa-clock"></i> Last Updated</span> — <?php echo esc_html(get_the_modified_date('F j, Y')); ?></time>

                    <?php if (get_the_author_meta('display_name')) { ?>
                        <p class="author-name s-tb-mar">
                            <span><i class="fa-solid fa-user"></i> Author</span> — 
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="author-link">
                                <?php echo esc_html(get_the_author_meta('display_name')); ?>
                            </a>
                        </p>
                    <?php } ?>
                </div>
                <div><?php edit_post_link('Edit Post', '<p class="edit-link no-mar">', '</p>'); ?></div>
            </div>
            <?php do_action('neatwp_blog_after_post_meta'); ?>

            <!-- Post Content -->
            <?php do_action('neatwp_blog_before_post_content'); ?>
            <article class="post-content">
                <?php the_content(); ?>
            </article>
            <?php do_action('neatwp_blog_after_post_content'); ?>

            <!-- Post Categories -->
            <div class="post-categories">
                <p><span class="bg-success tc-white s-pad">Categories</span> — <?php the_category(' '); ?></p>
            </div>

            <!-- Post Tags -->
            <div class="post-tags">
                <p><span class="bg-neutral tc-white s-pad">Tags</span> — <?php the_tags(' '); ?></p>
            </div>


            <!-- Comments Section -->
            <?php do_action('neatwp_blog_before_comments'); ?>
            <?php if (comments_open() || get_comments_number()) { ?>
                <div class="comments-section s-tb-mar-x4">
                    <?php comments_template(); ?>
                </div>
            <?php } ?>
            <?php do_action('neatwp_blog_after_comments'); ?>
        <?php } ?>
    <?php } ?>
</main>

<?php get_footer(); ?>
