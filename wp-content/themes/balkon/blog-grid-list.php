<?php
/* banner-php */
?>
<div class="posts-list-holder fl-wrap ">
	<?php if(have_posts()) : ?>

	    <?php while(have_posts()) : the_post(); ?>

	        <?php 
	            if(balkon_global_var('blog_list_show_format')) {
	                get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
	            }else{
	                get_template_part('content' );
	            }   
	        ?>

	    <?php endwhile; ?>

	<?php else: ?>

	    <?php get_template_part('content','none' ); ?>

	<?php endif; ?>

    
    
</div>