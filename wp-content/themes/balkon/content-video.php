<?php
/* banner-php */
 
?>
<div <?php post_class('content-video fl-wrap fw-post');?>>
    <h2 class="single-post-title"><a href="<?php the_permalink();?>"><span><?php the_title( );?></span></a><?php edit_post_link( esc_html__( 'Edit', 'balkon' ), '<small class="edit-link">', '</small>' ); ?></h2>
    <?php if( balkon_global_var('blog_date')  || balkon_global_var('blog_cats')  ):?>
    <ul class="blog-title-opt">
        <?php if( balkon_global_var('blog_date') ) :?>
		<li><?php the_time(get_option('date_format'));?></li>
		<?php endif;?>
        
        <?php if( balkon_global_var('blog_cats') ) :?>
			<?php if(get_the_category( )) { ?>
			<li> - </li>
				<li><?php the_category( ); ?></li>		
			<?php } ?>	
		<?php endif;?>
    </ul>
	<?php endif;?>
    <!-- blog media -->
    <?php 
	
    if(get_post_meta(get_the_ID(), '_balkon_embed_video', true)!=""){  ?>
    <div class="blog-media fl-wrap">
        <div class="iframe-holder">
            <div class="resp-video">
				<?php echo wp_oembed_get(esc_url(get_post_meta(get_the_ID(), '_balkon_embed_video', true) )); ?>
			</div>
		</div>
	</div>
	<?php
	}elseif(has_post_thumbnail( )){ ?>
	<div class="blog-media fl-wrap">
        <?php the_post_thumbnail('balkon_blog_thumb',array('class'=>'respimg') ); ?>
    </div>
	<?php } ?>
    <div class="blog-text fl-wrap">
    	<?php if( balkon_global_var('blog_tags') && get_the_tags( ) ) :?>
		<div class="pr-tags fl-wrap">
			<span><?php echo  esc_html__( 'Tags: ', 'balkon' ); ?></span>
			<ul>
				<?php the_tags('<li>','</li><li>','</li>');?>
			</ul>
	    </div>
	    <?php endif;?>
        
        <?php the_excerpt();?>
	    <?php
			wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'balkon' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			) );
		?>
		<div class="clearfix"></div>
        <a href="<?php the_permalink();?>" class="btn float-btn flat-btn"><?php esc_html_e('Read more','balkon');?> </a>
        <?php if( balkon_global_var('blog_show_views')  || balkon_global_var('blog_comments')  ):?>
        <ul class="post-counter">
        	<?php if( balkon_global_var('blog_show_views') && function_exists('balkon_get_post_views') ) :?>
            <li><i class="fa fa-eye" aria-hidden="true"></i><span><?php echo balkon_get_post_views(get_the_ID()); ?></span></li>
            <?php endif;?>
            <?php if( balkon_global_var('blog_comments') ) :?>
            <li><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o" aria-hidden="true"></i><span><?php comments_number( _x('0','0 comment text format', 'balkon'), _x('1','1 comment text format', 'balkon'), _x('%','plural comment text format', 'balkon') ); ?></span></a></li>
            <?php endif;?>
        </ul>
        <?php endif;?>
    </div>
</div>
