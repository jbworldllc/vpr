<?php
/* banner-php */
if ( post_password_required() ) {
    get_template_part( 'password_protected_page' );
    return;
}
get_header();


while(have_posts()) : the_post(); 

    the_content();
    wp_link_pages();


endwhile;

get_footer();
