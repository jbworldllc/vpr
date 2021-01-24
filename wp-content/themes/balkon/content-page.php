<?php
/* banner-php */
?>

<article <?php post_class('content-page fw-post cth-page');?>>
	<h2 class="single-post-title"><span><?php the_title( );?></span><?php edit_post_link( esc_html__( 'Edit', 'balkon' ), '<small class="edit-link">', '</small>' ); ?></h2>
	<?php if(has_post_thumbnail( )){ ?>
	<div class="blog-media fl-wrap">
        <?php the_post_thumbnail('balkon_single_thumb',array('class'=>'respimg') ); ?>
    </div>
	<?php } ?>
    
    <div class="page-content-inner">
        	
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