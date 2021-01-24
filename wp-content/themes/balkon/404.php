<?php
/* banner-php */

get_header(); ?>

<div class="content full-height error-404-sec">
    <div class="error-wrap">
        <div class="container">
            <h1 class="error-text"><?php esc_html_e('404','balkon' );?></h1>
            <?php if( balkon_global_var('404_intro') ){
                echo wp_kses_post( balkon_global_var('404_intro') );
            } ?>
        
            <?php if( balkon_global_var('back_home_link') ) :?>
                <a href="<?php echo esc_url( balkon_global_var('back_home_link') );?>" class="btn float-btn flat-btn"><?php esc_html_e('Back to home','balkon' );?></a>
            <?php endif;?>    
        </div>
    </div>
    <div class="partcile-dec" data-count="200" data-color="#ccc"></div>
</div>
<?php 
    get_footer();
?>