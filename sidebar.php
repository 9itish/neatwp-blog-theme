<aside id="sidebar" class="widgets-area post-sidebar s-pad-x4" role="complementary" aria-labelledby="sidebar-title">
    <h2 id="sidebar-title" class="screen-reader-text">Sidebar</h2>
    <?php if (is_active_sidebar('sidebar-posts')) { ?>
        <?php dynamic_sidebar('sidebar-posts'); ?>
    <?php } else { ?>
        <p>No widgets added yet. Add widgets in the WordPress admin area.</p>
    <?php } ?>
</aside>
