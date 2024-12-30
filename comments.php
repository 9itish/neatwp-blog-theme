<?php
/**
 * The template for displaying comments
 * 
 * This template displays the current comments and the comment form.
 * It is included in single.php or page.php where comments are enabled.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Check if the post is password-protected and if the visitor has not entered the password.
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            printf(
                /* translators: 1: number of comments, 2: post title */
                esc_html( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'neatwp' ) ),
                number_format_i18n( get_comments_number() )
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
            ) );
            ?>
        </ol>

        <?php
        // If comments are paginated, display navigation.
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
            <nav class="comment-navigation">
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'neatwp' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'neatwp' ) ); ?></div>
            </nav>
        <?php endif; ?>

    <?php endif; // Check for have_comments(). ?>

    <?php
    // Display a message if comments are closed and there are comments.
    if ( ! comments_open() && get_comments_number() ) :
    ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'neatwp' ); ?></p>
    <?php endif; ?>

    <?php
    // Customized Comment Form
    comment_form( array(
        'title_reply'         => __( 'Leave a Comment', 'neatwp-blog-theme' ),  // Title above the form
        'title_reply_before'  => '<h3 class="comment-reply-title">',  // Wrapper before title
        'title_reply_after'   => '</h3>',                            // Wrapper after title
        'comment_notes_before' => '<p class="comment-notes">Your email address will not be published.</p>',
        'comment_notes_after'  => '',                                // Removes "You may use HTML tags" note
        'submit_button'       => '<button type="submit" class="n-btn tc-white bgh-success"> '.__( "Post Comment", "neatwp-blog-theme" ).'</button>', // Custom submit button HTML
        'comment_field'       => '
                <div class="form-group">
                    <div class="n-flex n-flex-acjsb">
                        <label for="comment">' . __( 'Comment', 'neatwp-blog-theme' ) . '</label>
                        <textarea id="comment" class="s-pad-x2 s-tb-mar-x4" name="comment" required="required" placeholder="Please be respectful"></textarea>
                    </div>
                </div>',
        'fields'              => array(
            'author' => '
                <div class="form-group">
                    <div class="n-flex n-flex-acjsb">
                        <label for="author">' . __( 'Name', 'neatwp-blog-theme' ) . '</label>
                        <input id="author" name="author" type="text" value="" required="required" placeholder="Larry">
                    </div>
                </div>',
            'email' => '
                <div class="form-group">
                    <div class="n-flex n-flex-acjsb">
                        <label for="email">' . __( 'Email', 'neatwp-blog-theme' ) . '</label>
                        <input id="email" name="email" type="email" value="" required="required" placeholder="larry@website.com">
                    </div>
                </div>',
            'url' => '
                <div class="form-group">
                    <div class="n-flex n-flex-acjsb">
                        <label for="url">' . __( 'Website', 'neatwp-blog-theme' ) . '</label>
                        <input id="url" name="url" type="url" value="" placeholder="website.com">
                    </div>
                </div>',
        ),
    ) );
    ?>

</div><!-- #comments -->
