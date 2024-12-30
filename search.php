<?php get_header(); ?>

<main class="search-results-container">
    <h1 class="post-list-heading">
        Search Results for "<?php echo esc_html(get_search_query()); ?>"
    </h1>

    <?php if (have_posts()) { ?>
        <?php while (have_posts()) { 
            the_post(); 
            $title = get_the_title();
        ?>
        <article class="post-list">
            <h2>
                <a href="<?php the_permalink(); ?>">
                    <?php echo esc_html($title); ?>
                </a>
            </h2>
            <time datetime="<?php echo get_the_modified_time('Y-m-d'); ?>">
                Last Updated — <?php echo get_the_modified_date('F j, Y'); ?>
            </time>
            <p><?php the_excerpt(); ?></p>
        </article>
        <?php } ?>

    <?php } else { ?>
        <p class="no-results">
            Sorry, no results were found for your search query. Please try again with different keywords.
        </p>
    <?php } ?>
</main>

<?php get_footer(); ?>
