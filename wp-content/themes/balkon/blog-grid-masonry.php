<?php
/* banner-php */

$columns_grid = balkon_global_var('blog-grid-columns') ? balkon_global_var('blog-grid-columns') : 'two';
$css_classes = array(
    'gallery-items ver-medium-pad hid-por-info blog-masonry-holder',
    $columns_grid.'-columns'
);
if($columns_grid !== 'one'){
	$css_classes[] = 'blog-grid-multi-cols';
}
$css_class = implode(" ", $css_classes);
?>
<div class="fl-wrap posts-masonry-holder">
<?php if(have_posts()) : ?>
	<div class="<?php echo esc_attr($css_class );?>">
	

		<div class="grid-sizer"></div>

	    <?php while(have_posts()) : the_post(); ?>
			<div class="gallery-item">
                <div class="grid-item-holder">
	        <?php 
                    if(balkon_global_var('blog_list_show_format')) {
                        get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
                    }else{
                        get_template_part('content' );
                    }   
                ?>
				</div>
			</div>
	    <?php endwhile; ?>

	

	</div>

	

<?php else: ?>

    <?php get_template_part('content','none' ); ?>

<?php endif; ?>

</div>