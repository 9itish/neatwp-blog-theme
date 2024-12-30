<?php if ((is_page() || is_archive()) && is_active_sidebar('sidebar-pages')) : ?>
    <aside id="sidebar" class="widgets-area page-sidebar s-pad-x4" role="complementary" aria-labelledby="sidebar-title">
        <h2 id="sidebar-title" class="screen-reader-text">Page Sidebar</h2>
        <?php dynamic_sidebar('sidebar-pages'); ?>
    </aside>
<?php endif; ?>