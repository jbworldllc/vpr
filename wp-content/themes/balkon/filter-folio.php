<?php
/* banner-php */
?>
<div class="folio-grid-filter-wrap">
    <div class="<?php echo esc_attr( $filter_width );?>">
        <div class="filter-holder inline-filter bold-filter fl-wrap">
            <div class="filter-button"><span><?php esc_html_e('Filter : ','balkon' );?></span></div>
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
            <?php if( $show_counter === 'yes' ) : ?>
            <div class="count-folio">
                <div class="num-album"></div>
                <div class="all-album"></div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
    