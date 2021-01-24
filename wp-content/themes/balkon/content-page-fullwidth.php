<?php
/* banner-php */
?>

<article <?php post_class('content-page fw-post cth-page');?>>
	<?php if(has_post_thumbnail( )){ ?>
	<div class="blog-media">
        <?php the_post_thumbnail('balkon_single_thumb',array('class'=>'respimg') ); ?>
    </div>
	<?php } ?>
    <div class="page-content-fullwidth-inner">
        <?php edit_post_link( esc_html__( 'Edit', 'balkon' ), '<span class="edit-link">', '</span>' ); ?>	
		<?php the_content( ); ?>
        <?php
			wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'balkon' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			) );
		?>
       
    </div>
</article>