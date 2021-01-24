<?php
/* banner-php */
/**
 * Template Name: Home Page - Folio Filter
 *
 */

if ( post_password_required() ) {
    get_template_part( 'password_protected_page' );
    return;
}

get_header('filter'); ?>

<?php while(have_posts()) : the_post(); ?>

	<?php the_content(); ?>
	<?php wp_link_pages(); ?>

<?php endwhile; ?>   
<?php 
    get_footer( );
?>