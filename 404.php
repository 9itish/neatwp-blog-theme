<?php get_header(); ?>

<h1 class="post-list-heading"><?php esc_html_e( 'Page Not Found', 'neatwp-blog-theme' ); ?></h1>

<p class="answer"><?php esc_html_e( 'The URL of the page might have changed. It is also possible the might might have never existed.', 'neatwp-blog-theme' ); ?></p>
<p class="answer"><?php esc_html_e( 'You should try searching our website and see if something useful turns up.', 'neatwp-blog-theme' ); ?></p>

<?php get_search_form(); ?>

<?php
// Improve error logging by validating user input and preventing possible issues
$protocol = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
$full_url = esc_url( $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
$refering_url = isset( $_SERVER['HTTP_REFERER'] ) ? esc_url( $_SERVER['HTTP_REFERER'] ) : 'No referrer';

// Log the error details in a secure way
$not_found = sprintf(
    '<p>The 404 page <a href="%s" class="error">%s</a> was linked from <a href="%s">%s</a>.</p>',
    $full_url, $full_url, $refering_url, $refering_url
);

// Use a safer file logging method
file_put_contents( __DIR__ . '/not_found.html', $not_found, FILE_APPEND | LOCK_EX );
?>

<p class="answer"><?php esc_html_e( 'You can also read the most popular posts published on Tutorialio.', 'neatwp-blog-theme' ); ?></p>

<?php echo do_shortcode( '[selected-posts ids="150, 141, 112"]' ); ?>

<?php get_footer(); ?>