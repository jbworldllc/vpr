<?php
/* banner-php */   
$show_left = balkon_global_var('show_left_bar');
$hide_footer_con = 'no';
if(is_singular( )){
    $hide_footer_con = get_post_meta(get_the_ID(),'_balkon_hide_footer',true ) ;

    $hide_left_post = get_post_meta(get_the_ID(),'_balkon_hide_left',true ) ;
    if($show_left && $hide_left_post != 'yes' || $hide_left_post == 'no' ) $show_left = true;
    if($hide_left_post == 'yes' || get_query_var('hide_left','no' ) == 'yes' ) $show_left = false;
}                       
?>
        <?php if($hide_footer_con != 'yes') : ?>
            <div class="height-emulator"></div>
            <footer class="content-footer">
                <div class="footer-inner">
                    <?php 
                    $footer_widgets = balkon_global_var('footer_widgets');
                    if ( !empty($footer_widgets) ) {
                    ?>
                    <div class="row footer-widgets-row"><?php
                        foreach ($footer_widgets as $key => $widget) {
                            if($widget != ''){
                                $widget = explode("|", $widget);
                                if(count($widget) > 1) {
                                    $wicl = $widget[1];
                                }else{
                                    $wicl = 'col-md-4';
                                }

                                $wgid = sanitize_title_with_dashes($widget[0]);

                                if(is_active_sidebar($wgid)){
                                
                                    echo '<div class="dynamic-footer-widget '.esc_attr($wicl ).'">';

                                        dynamic_sidebar($wgid);

                                    echo '</div>';

                                }

                            }
                        }
                    ?></div>
                    <?php
                    }
                    ?>
                    <div class="row footer-copyright-row"><?php echo wp_kses_post( balkon_global_var('footer_copyright') ); ?></div>
                    <div class="to-top"><?php echo wp_kses_post( balkon_global_var('to_top_icon') ); ?></div>
                </div>
            </footer>
        <?php endif;?>
            <!-- content-footer end    -->
            </div>
        </div>

        <div class="search-form-holder fixed-search">
            <div class="search-form-bg"></div>
            <div class="search-form-wrap">
                <div class="container">
                    <?php get_search_form(); ?>
                    <div class="close-fixed-search"></div>
                </div>
                <div class="dublicated-text"></div>
            </div>
        </div>
        <?php if( balkon_global_var('share_names') != '' ): ?>
        <div class="share-wrapper isShare">
            <div class="share-container" data-share="['<?php echo esc_attr( implode("','", array_map("trim",explode(",", balkon_global_var('share_names') ) ) ) );?>']"></div>
        </div>
        <?php elseif(is_active_sidebar('social_share_widget' )) :?>
        <div class="share-wrapper isShare widget_share">
            <div class="share-container " ><?php dynamic_sidebar('social_share_widget' );?></div>
        </div>
        <?php endif;?>

        <!-- Share container  end-->
        <?php if( $show_left ):?>
            <?php if( balkon_global_var('left_bar_width') != '' && balkon_global_var('left_bar_width') != '80px') :?>
            <footer class="main-footer balkon-left-footer" style="width:<?php echo esc_attr( balkon_global_var('left_bar_width') );?>;">
            <?php else :?>
            <footer class="main-footer balkon-left-footer">
            <?php endif;?>
                <?php if( balkon_global_var('show_fixed_title') ) :?>
                <div class="fixed-title"><h1><?php balkon_dynamic_title();?></h1></div>
                <?php endif;?>
                <?php if( balkon_global_var('left_socials') ) :?>
                <div class="footer-social">
                    <?php echo wp_kses_post( balkon_global_var('left_socials') );?>
                </div>
                <?php endif;?>
            </footer>
        <?php endif;?>

        </div>
        <?php wp_footer(); ?>
        
    </body>
</html>