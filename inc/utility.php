<?php

function neatwp_pagination_markup() {

    global $wp_query;

    if($wp_query->max_num_pages > 1) {

        $links = paginate_links(array(
            'mid_size'   => 2,
            'prev_text'  => __('&laquo; Previous', 'neatwp-blog-theme'),
            'next_text'  => __('Next &raquo;', 'neatwp-blog-theme'),
            'type'       => 'array', // Returns an array of links
        ));

        if (is_array($links)) {
        
            $output = '<nav class="pagination-container">';
            $output .= '<ul class="pagination pag-disjoint tch-success">';
            foreach ($links as $link) {
                $output .= '<li>' . $link . '</li>';
            }
            $output .= '</ul></nav>';

            return $output;
        }
    }

    return '';
}


function neatwp_post_header_markup($title_tag = 'h2') {

    $output = '<header class="post-header">';
    $output .= '<' . esc_html( $title_tag ) . ' class="post-title">';
    $output .= '<a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">';
    $output .= esc_html( get_the_title() );
    $output .= '</a>';
    $output .= '</' . esc_html( $title_tag ) . '>';
    $output .= '</header>';

    return $output;
}



function neatwp_post_excerpt_markup() {

    $excerpt_length = apply_filters( 'neatwp_blog_excerpt_length', 20 );

    $output = '<div class="post-excerpt">';
    $output .= '<p class="no-mar">'.wp_trim_words( get_the_excerpt(), $excerpt_length, '...' ).'</p>'; 
    $output .= '</div>';

    return $output;
}

function neatwp_post_meta_markup() {

    $output = '<div class="post-meta n-flex n-flex-eq-aw">';

    // Author name
    $output .= '<p class="author-name s-tb-mar">';
    $output .= '<span><i class="fa-solid fa-user"></i></span> ';
    $output .= esc_html( get_the_author_meta( 'display_name' ) );
    $output .= '</p>';

    // Modified date
    $output .= '<time datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '" class="mod-time">';
    $output .= '<span aria-hidden="true"><i class="fa-solid fa-clock" aria-label="Last updated"></i></span> ';
    $output .= esc_html( get_the_modified_date( get_option( 'date_format' ) ) );
    $output .= '</time>';

    $output .= '</div>';

    return $output;
}
