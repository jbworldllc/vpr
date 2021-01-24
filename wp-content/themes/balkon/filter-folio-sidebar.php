<?php
/* banner-php */
?>
<div class="fixed-filter-wrap">
    <div class="partcile-dec" data-count="110" data-color="#ccc"></div>
    <div class="fixed-filter fl-wrap">
    <?php if(isset($sidebar_title) && $sidebar_title !=''): ?>
        <h3 class="fixed-sec-title"><?php echo esc_html( $sidebar_title );?></h3>
        <div class="bold-separator"></div>
    <?php endif;?>
        <div class="filter-button hid-filt-button"><?php esc_html_e('Filter','balkon' );?></div>
        <div class="gallery-filters">
        <?php if(balkon_global_var('folio_filter_all')): ?>
            <a href="#" class="gallery-filter gallery-filter-active"  data-filter="*"><?php esc_html_e('All Works','balkon' );?></a>
        <?php endif;?>
            <?php $key = 0; foreach($portfolio_cats as $portfolio_cat) { ?>
                <?php if(!balkon_global_var('folio_filter_all') && $key == 0 ): ?>
                    <a href="#" class="gallery-filter gallery-filter-active" data-filter=".portfolio_cat-<?php echo esc_attr($portfolio_cat->slug ); ?>"><?php echo esc_html($portfolio_cat->name ); ?></a>
                <?php else : ?>
                    <a href="#" class="gallery-filter " data-filter=".portfolio_cat-<?php echo esc_attr($portfolio_cat->slug ); ?>"><?php echo esc_html($portfolio_cat->name ); ?></a>
                <?php endif;?>
            <?php $key++; } ?>
        </div>
        <div class="clearfix"></div>
        <?php if( $show_counter === 'yes' ) : ?>
        <div class="count-folio clearfix">
            <div class="num-album"></div>
            <div class="all-album"></div>
        </div>
        <?php endif;?>
    </div>
</div>