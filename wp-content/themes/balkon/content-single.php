<?php
/* banner-php */

if( balkon_global_var('blog_show_views') && function_exists('balkon_set_post_views')){
	balkon_set_post_views(get_the_ID());
}
$show_page_header = get_post_meta(get_the_ID(),'_balkon_show_page_header',true );
$show_page_title = get_post_meta(get_the_ID(),'_balkon_show_page_title',true );

?>
<div <?php post_class('balkon-single-post fl-wrap fw-post single-post' );?>>
	<?php if($show_page_header !== 'yes' || ( $show_page_header == 'yes' && $show_page_title == 'no' )) :?>
    <h1 class="single-post-title"><span><?php single_post_title( );?></span> <?php edit_post_link( esc_html__( 'Edit', 'balkon' ), '<small class="edit-link">', '</small>' ); ?></h1>
    <?php endif;?>
    <?php if( balkon_global_var('blog_date_single')  || balkon_global_var('blog_cats_single')  ):?>
    <ul class="blog-title-opt">
        <?php if( balkon_global_var('blog_date_single') ) :?>
		<li><?php the_date( );?></li>
		<?php endif;?>
        
        <?php if( balkon_global_var('blog_cats_single') ) :?>
			<?php if(get_the_category( )) { ?>
			<li> - </li>
				<li><?php the_category( ); ?></li>		
			<?php } ?>	
		<?php endif;?>
    </ul>
	<?php endif;?>
	<?php if( balkon_global_var('blog_featured_single') ) :?>
	    <?php 
	    // Get the list of files
	    $slider_images = get_post_meta( get_the_ID(), '_balkon_post_slider_images', true);
	    if( !empty($slider_images) ){ ?>
	    <div class="blog-media fl-wrap">
	    	<?php if(get_post_format( ) == 'gallery'):?>
	        <div class="post-gallery-items lightgallery ver-small-pad <?php echo get_post_meta( get_the_ID() , '_balkon_gallery_cols', true );?>-columns">
	            <div class="post-grid-sizer"></div>
	        <?php 
	        foreach ( (array) $slider_images as $img_id => $img_url ) {
	            ?>

	            <div class="post-gallery-item">
	                <div class="grid-item-holder">
	                    <div class="box-item fl-wrap popup-box">
	                        <?php echo wp_get_attachment_image($img_id, 'balkon_gallery_thumb' ); ?>
	                        <a data-src="<?php echo esc_url(wp_get_attachment_url( $img_id ) );?>" class="popup-image"><i class="fa fa-search"></i></a>
	                    </div>
	                </div>
	            </div>

	        <?php
	        }
	        ?>
	        </div>
	        <?php else : ?>
			<div class="single-slider fl-wrap" data-effects="slide">
	            <div class="swiper-container">
	                <div class="swiper-wrapper">
	                <?php 
	                foreach ( (array) $slider_images as $img_id => $img_url ) {
				        echo '<div class="swiper-slide">';
				        echo wp_get_attachment_image($img_id, 'balkon_single_thumb','',array('class'=>'respimg') );
				        echo '</div>';
				    }
					?>
	                </div>
	                <div class="swiper-pagination"></div>
	                <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
	                <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
	            </div>
	        </div>
	    	<?php endif; ?>
	    </div>
	    <?php }elseif(get_post_meta(get_the_ID(), '_balkon_embed_video', true)!=""){ ?>	
	    <div class="blog-media fl-wrap">
	    	<?php if(get_post_format( ) == 'audio'):
	    		$audio_url = get_post_meta(get_the_ID(), '_balkon_embed_video', true);
				if(preg_match('/(.mp3|.ogg|.wma|.m4a|.wav)$/i', $audio_url )){
					$attr = array(
						'src'      => $audio_url,
						'loop'     => '',
						'autoplay' => '',
						'preload'  => 'none'
					);
					echo wp_audio_shortcode( $attr );
				}else{
			?>
	    		<div class="iframe-holder">
					<div class="resp-audio">
						<?php echo wp_oembed_get(esc_url(get_post_meta(get_the_ID(), '_balkon_embed_video', true) ) , array('height'=>'166') ); ?>
					</div>
				</div>
			<?php } ?>
	    	<?php else :?>
	            <div class="iframe-holder">
		            <div class="resp-video">
						<?php echo wp_oembed_get(esc_url(get_post_meta(get_the_ID(), '_balkon_embed_video', true) )); ?>
					</div>
				</div>
        	<?php endif;?>
        </div>
	    <?php
	    }elseif(has_post_thumbnail( )){ ?>
	    <div class="blog-media fl-wrap">
	        <?php the_post_thumbnail('balkon_single_thumb',array('class'=>'respimg') ); ?>
	    </div>
	    <?php } ?>

	<?php endif ; ?>
    <div class="blog-text fl-wrap">
    	<?php if( balkon_global_var('blog_tags_single') && get_the_tags( ) ) :?>
		<div class="pr-tags fl-wrap">
			<span><?php echo  esc_html__( 'Tags: ', 'balkon' ); ?></span>
			<ul>
				<?php the_tags('<li>','</li><li>','</li>');?>
			</ul>
	    </div>
	    <?php endif;?>
        
        <?php the_content( ); ?>
        <?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'balkon' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
		<div class="clearfix"></div>
    </div>
    <?php if( balkon_global_var('blog_show_views')  || balkon_global_var('blog_comments')  ):?>
    <ul class="post-counter single-post-counter">
    	<?php if( balkon_global_var('blog_show_views') && function_exists('balkon_get_post_views') ) :?>
        <li><i class="fa fa-eye" aria-hidden="true"></i><span><?php echo balkon_get_post_views(get_the_ID()); ?></span></li>
        <?php endif;?>
        <?php if( balkon_global_var('blog_comments') ) :?>
        <li><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o" aria-hidden="true"></i><span><?php comments_number( _x('0','0 comment text format', 'balkon'), _x('1','1 comment text format', 'balkon'), _x('%','plural comment text format', 'balkon') ); ?></span></a></li>
        <?php endif;?>
    </ul>
    <?php endif;?>
</div>



<?php if( balkon_global_var('blog_author_single') && get_the_author_meta('description') !='' ) :?>
<div class="post-author clearfix">
    <div class="author-img">
        <?php 
            echo get_avatar(get_the_author_meta('user_email'),$size='80',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80' );
        ?>	
    </div>
    <div class="author-content">
        <h5><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('nickname');?></a></h5>
        <p><?php echo get_the_author_meta('description');?></p>
        <?php if ( 'no' !== _x( 'yes', 'Show author socials on single post page: yes or no', 'balkon' ) ) : ?>
        <div class="author-social">
            <ul>
                <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_twitterurl' ,true)!=''){ ?>
			    	<li><a title="<?php esc_html_e('Follow on Twitter','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_twitterurl' ,true)); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
			    <?php } ?>
			    <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_facebookurl' ,true)!=''){ ?>
			    	<li><a title="<?php esc_html_e('Like on Facebook','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_facebookurl' ,true)); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
			    <?php } ?>
			    <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_googleplusurl' ,true)!=''){ ?>
			    	<li><a title="<?php esc_html_e('Circle on Google Plus','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_googleplusurl' ,true)) ;?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			    <?php } ?>
			    <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_linkedinurl' ,true)!=''){ ?>
			    	<li><a title="<?php esc_html_e('Be Friend on Linkedin','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_linkedinurl' ,true) ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
			    <?php } ?>
			    <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_instagramurl' ,true)!=''){ ?>
			    	<li><a title="<?php esc_html_e('Follow on Instagram','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_instagramurl' ,true) ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
			    <?php } ?>
			    <?php if(get_user_meta(get_the_author_meta('ID'), '_balkon_tumblrurl' ,true)!=''){ ?>
			    	<li><a title="<?php esc_html_e('Follow on  Tumblr','balkon');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_balkon_tumblrurl' ,true) ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
			    <?php } ?>	
            </ul>
        </div>
        <?php endif; ?>	 
    </div>
</div>
<?php endif;?>


<?php
if ( comments_open() || get_comments_number() ) :
	
 	comments_template(); 
 	
endif; ?> 
              
