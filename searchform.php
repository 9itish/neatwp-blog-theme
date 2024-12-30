<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form n-flex n-flex-fw">
    <label for="search-field" class="screen-reader-text">Search Website</label>
    <input 
        type="search" 
        id="search-field" 
        class="form-control n-fw n-w-75" 
        placeholder="Search Website" 
        value="<?php echo esc_attr(get_search_query()); ?>" 
        name="s" 
        title="Search" 
        aria-label="Search"
    />
    <button type="submit" class="search-submit n-fw n-w-20 n-btn bgh-success tc-white" aria-label="Submit search">
        <i class="fas fa-search"></i>
    </button>
</form>
