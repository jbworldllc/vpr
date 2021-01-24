<?php
/* banner-php */
get_header(); ?>

<div class="content full-height password-sec">
    <div class="password-wrap">
        <div class="container">
            <h1 class="protected-text"><?php the_title( );?></h1>

            <?php echo get_the_password_form(); ?>
        
            <?php if( balkon_global_var('password_page_intro') ){
                echo wp_kses_post(balkon_global_var('password_page_intro'));
            } ?>
        </div>
    </div>
    <div class="partcile-dec" data-count="200" data-color="#ccc"></div>
</div>
<?php     
get_footer();