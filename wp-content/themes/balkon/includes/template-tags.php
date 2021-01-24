<?php 

if(!function_exists('balkon_get_template_part')){
    /**
     * Load a template part into a template
     *
     * Makes it easy for a theme to reuse sections of code in a easy to overload way
     * for child themes.
     *
     * Includes the named template part for a theme or if a name is specified then a
     * specialised part will be included. If the theme contains no {slug}.php file
     * then no template will be included.
     *
     * The template is included using require, not require_once, so you may include the
     * same template part multiple times.
     *
     * For the $name parameter, if the file is called "{slug}-special.php" then specify
     * "special".
      * For the var parameter, simple create an array of variables you want to access in the template
     * and then access them e.g. 
     * 
     * array("var1=>"Something","var2"=>"Another One","var3"=>"heres a third";
     * 
     * becomes
     * 
     * $var1, $var2, $var3 within the template file.
     *
     * @since 1.3.1
     *
     * @param string $slug The slug name for the generic template.
     * @param string $name The name of the specialised template.
     * @param array $vars The list of variables to carry over to the template
     * @author CTHthemes 
     * @ref http://www.zmastaa.com/2015/02/06/php-2/wordpress-passing-variables-get_template_part
     * @ref http://keithdevon.com/passing-variables-to-get_template_part-in-wordpress/
     */
    function balkon_get_template_part( $slug, $name = null, $vars = null ) {

        $template = "{$slug}.php";
        $name = (string) $name;
        if ( '' !== $name && ( file_exists( get_stylesheet_directory() ."/{$slug}-{$name}.php") || file_exists( get_template_directory() ."/{$slug}-{$name}.php") ) ) {
            $template = "{$slug}-{$name}.php";
        }

        if(isset($vars)) extract($vars);
        include(locate_template($template));
    }
}

function balkon_breadcrumbs() {

    if(!balkon_get_option('blog_breadcrumbs')) return;
      
    // Settings
    $separator          = __('/','balkon');//'&gt;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = __('Home','balkon');
    $blog_title         = __('Our Blog','balkon');
     
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat,skill';
      
    // Get the query & post information
    global $post,$wp_query;
      
    // Do not display on the homepage
    if ( !is_front_page() ) {
      
        // Build the breadcrums
        echo '<ul id="' . esc_attr($breadcrums_id ) . '" class="' . esc_attr($class ) . '">';
          
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . esc_attr($home_title ) . '">' . esc_attr($home_title ) . '</a></li>';
        echo '<li class="separator separator-home"> ' . esc_html($separator ) . ' </li>';

        if(is_home()){
            // Blog page
            echo '<li class="item-current item-blog"><strong class="bread-current item-blog">' . esc_attr($blog_title ) . '</strong></li>';
        }
          
        if ( is_archive() && !is_tax() ) {
             
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . get_the_archive_title() . '</strong></li>'; //post_type_archive_title($prefix, false)
             
        } else if ( is_archive() && is_tax() ) {
             
            // If post is a custom post type
            $post_type = get_post_type();
             
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                 
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
             
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
             
            }
             
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
             
        } else if ( is_single() ) {
             
            // If post is a custom post type
            $post_type = get_post_type();
             
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                 
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
             
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';

            }
                // Get post category info
                $category = get_the_category();
                 
                // Get last category post is in
                $last_category = '';
                if($category){
                    $last_category = end(array_values($category));
                 
                    // Get parent any categories and create array
                    $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                    $cat_parents = explode(',',$get_cat_parents);
                     
                    // Loop through parent categories and store in variable $cat_display
                    $cat_display = '';
                    foreach($cat_parents as $parents) {
                        $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                        $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                    }
                }
                
                if(!empty($last_category)) {
                    echo wp_kses_post( $cat_display );
                    echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                     
                // Else if post is in a custom taxonomy
                }
                 
                // If it's a custom post type within a custom taxonomy
                if(empty($last_category) && !empty($custom_taxonomy)) {
                    $custom_taxonomy_arr = explode(",", $custom_taxonomy) ;
                    foreach ($custom_taxonomy_arr as $key => $custom_taxonomy_val) {
                        $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy_val );
                        $cat_id         = $taxonomy_terms[0]->term_id;
                        $cat_nicename   = $taxonomy_terms[0]->slug;
                        $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy_val);
                        $cat_name       = $taxonomy_terms[0]->name;

                        if(!empty($cat_id)) {
                     
                            echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                            echo '<li class="separator"> ' . $separator . ' </li>';
                            echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                         
                        }

                     } 
                    
                  
                }
                 
             
            
             
        } else if ( is_category() ) {
              
            // Category page
            echo '<li class="item-current item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><strong class="bread-current bread-cat-' . $category[0]->term_id . ' bread-cat-' . $category[0]->category_nicename . '">' . $category[0]->cat_name . '</strong></li>';
              
        } else if ( is_page() ) {
              
            // Standard page
            if( $post->post_parent ){
                  
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                  
                // Get parents in the right order
                $anc = array_reverse($anc);
                  
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                  
                // Display parent pages
                echo wp_kses_post( $parents );
                  
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                  
            } else {
                  
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_tag() ) {
              
            // Tag page
              
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args ='include=' . $term_id;
            $terms = get_terms( $taxonomy, $args );
              
            // Display the tag name
            echo '<li class="item-current item-tag-' . $terms[0]->term_id . ' item-tag-' . $terms[0]->slug . '"><strong class="bread-current bread-tag-' . $terms[0]->term_id . ' bread-tag-' . $terms[0]->slug . '">' . $terms[0]->name . '</strong></li>';
          
        } elseif ( is_day() ) {
              
            // Day archive
              
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . __(' Archives','balkon').'</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
              
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . __(' Archives','balkon').'</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
              
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') .  __(' Archives','balkon').'</strong></li>';
              
        } else if ( is_month() ) {
              
            // Month Archive
              
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . __(' Archives','balkon').'</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
              
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . __(' Archives','balkon').'</strong></li>';
              
        } else if ( is_year() ) {
              
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . __(' Archives','balkon').'</strong></li>';
              
        } else if ( is_author() ) {
              
            // Auhor archive
              
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
              
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' .  __(' Author: ','balkon') . $userdata->display_name . '</strong></li>';
          
        } else if ( get_query_var('paged') ) {
              
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="'.__('Page','balkon') . get_query_var('paged') . '">'.__('Page','balkon') . ' ' . get_query_var('paged') . '</strong></li>';
              
        } else if ( is_search() ) {
          
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="'.__('Search results for: ','balkon') . get_search_query() . '">'.__('Search results for: ','balkon') . get_search_query() . '</strong></li>';
          
        } elseif ( is_404() ) {
              
            // 404 page
            echo '<li>' . __('Error 404','balkon') . '</li>';
        }
      
        echo '</ul>';
          
    }
      
}


//pagination
function balkon_pagination($prev = 'Prev', $next = 'Next', $pages = '') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    $pagination = array('base' => str_replace(999999999, '%#%', get_pagenum_link(999999999)), 'format' => '', 'current' => max(1, get_query_var('paged')), 'total' => $pages, 'prev_text' => __($prev, 'balkon'), 'next_text' => __($next, 'balkon'), 'type' => 'list', 'end_size' => 3, 'mid_size' => 3);
    $return = paginate_links($pagination);
    if (!$return) return;
    $return = str_replace("<ul class='page-numbers'>", '<ul class="pagination">', $return);
    echo '<div class="row"><div class="col-md-12">' .  $return . '</div></div>';
}

function balkon_custom_pagination($pages = '', $range = 2, $current_query = '') {
    
    $showitems = ($range * 2) + 1;
    
    if ($current_query == '') {
        global $paged;
        if (empty($paged)) $paged = 1;
    } 
    else {
        $paged = $current_query->query_vars['paged'];
    }
    
    if ($pages == '') {
        if ($current_query == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        } 
        else {
            $pages = $current_query->max_num_pages;
        }
    }
    
    if (1 != $pages) {
        echo "<div class='balkon_pagination clearfix'>";
        
        if ($paged > 1) echo "<a class='pagination-prev' href='" . get_pagenum_link($paged - 1) . "'><span class='page-prev'></span>" . __('Previous', 'balkon') . "</a>";
        
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                if($paged == $i)
                    echo "<span class='current'>" . $i . "</span>";
                else
                    echo "<a href='" . get_pagenum_link($i) . "' class='inactive'>" . $i . "</a>";
                
            }
        }
        
        if ($paged < $pages) echo "<a class='pagination-next' href='" . get_pagenum_link($paged + 1) . "'>" . __('Next', 'balkon') . "<span class='page-next'></span></a>";
        
        echo "</div>\n";
    }
}

//Get thumbnail url
function balkon_thumbnail_url($size) {
    if ($size == '') {
        $url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
        return $url;
    }else {
        $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size);
        return $url[0];
    }
}

function balkon_post_nav($extraclass = '') {
    global $post;
    
    // Don't print empty markup if there's nowhere to navigate.
    $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);
    if (!$next && !$previous) return;
?>
    <ul class="pager <?php
    echo esc_attr($extraclass); ?> clearfix">
      <li class="previous">
        <?php
    previous_post_link('%link', _x('<i class="fa fa-long-arrow-left"></i>', 'Previous post link', 'balkon')); ?>
      </li>
      <li class="next">
        <?php
    next_post_link('%link', _x('<i class="fa fa-long-arrow-right"></i>', 'Next post link', 'balkon')); ?>
      </li>
    </ul>   
<?php
}



function balkon_list_post_author(){
    if( balkon_get_option( 'blog_author') ): ?>
    <div class="post-author">
        <?php echo get_avatar(get_the_author_meta('user_email'), '80', '//0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80', get_the_author_meta( 'display_name' ) ); ?>
        <?php esc_html_e( 'By ',  'balkon' ) ; the_author_posts_link( );?>
    </div>
    <?php endif;
}
function balkon_list_post_metas(){
    if( balkon_get_option( 'author_checkbox' )  || balkon_get_option( 'date_checkbox' ) || balkon_get_option( 'cats_checkbox' ) || balkon_get_option( 'tag_checkbox' ) ||  balkon_get_option( 'comment_checkbox' ) ):?>
    <div class="col-md-2">
        <div class="article-meta">
            <?php if( balkon_get_option( 'author_checkbox') ) :?>
            <div class="meta-author">
                <i class="fa fa-user fa-2x"></i>
                <?php the_author_posts_link( );?>                                                   
            </div>
            <?php endif;?>
            
            <?php if( balkon_get_option( 'date_checkbox' ) ) :?>
            <div class="meta-date">
                <i class="fa fa-calendar fa-2x"></i>
                <a href="<?php echo get_day_link((int)get_the_time('Y' ), (int)get_the_time('m' ), (int)get_the_time('d' )); ?>"><?php the_time(get_option('date_format'));?></a>                           
            </div> 
            <?php endif;?>

            <?php if( balkon_get_option( 'cats_checkbox' ) ) :?>
                <?php if(get_the_category( )) { ?>
                <div class="meta-cats">
                    <i class="fa fa-file fa-2x"></i>
                    <?php the_category(', ' );?>                    
                </div>  
                <?php } ?> 
            <?php endif;?>

            <?php if( balkon_get_option( 'tag_checkbox' ) ) :?>
                <?php if(get_the_tags( )) { ?>
                <div class="meta-tags">
                    <i class="fa fa-tags fa-2x"></i>
                    <?php the_tags('',', ','');?>           
                </div>
                <?php } ?> 
            <?php endif;?>

            <?php if( balkon_get_option( 'comment_checkbox' ) ) :?>
                <div class="meta-comments">
                    <i class="fa fa-comments fa-2x"></i>
                    <?php comments_popup_link(__('0 comment', 'balkon'), __('1 comment', 'balkon'), __('% comments', 'balkon')); ?>                      
                </div> 
            <?php endif;?>

        </div>
    </div>
    <div class="col-md-10">
    <?php else :?>
    <div class="col-md-12">
    <?php endif;

}

function balkon_list_post_tags(){
    if( balkon_get_option( 'blog_tags' ) && get_the_tags( ) ) :?>
    <span class="fw-separator"></span>
    <div class="list-single-main-item-title fl-wrap tag-heading">
        <h3 class="list-single-tags-item"><?php esc_html_e( 'Tags', 'balkon' ); ?></h3>
    </div>
    <div class="list-single-tags tags-stylwrap blog-tags">
        <?php the_tags('','','');?>                                                                          
    </div>
    <?php endif;
}

function balkon_single_post_author(){
    if( balkon_get_option( 'single_author' ) ):?>
    <div class="post-author">
        <?php echo get_avatar(get_the_author_meta('user_email'), '80', '//0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80', get_the_author_meta( 'display_name' ) );?>
        <?php esc_html_e( 'By ',  'balkon' ) ; the_author_posts_link( );?>
    </div>
    <?php endif;
}
function balkon_single_post_metas(){
    if( balkon_get_option( 'single_date' )  || balkon_get_option( 'single_cats' ) || balkon_get_option( 'single_comments' )  ):?>
    <div class="post-opt">
        <ul class="blog-title-opt">
            <?php if( balkon_get_option( 'single_date' ) ) :?>
            <li><i class="fal fa-calendar"></i><span><?php the_time(get_option('date_format'));?></span></li>
            <?php endif;?>
            
            <?php if( balkon_get_option( 'single_views' ) && function_exists('balkon_addons_get_post_views') ) :?>
            <li><i class="fal fa-eye"></i> <span><?php echo balkon_addons_get_post_views(get_the_ID());?></span></li>
            <?php endif;?>

            <?php if( balkon_get_option( 'single_cats' ) ) :?>
                <?php if(get_the_category( )) { ?>
                <li><i class="fal fa-tags"></i><?php the_category( ' , ' ); ?></li>  
                <?php } ?>  
            <?php endif;?>

            <?php if( balkon_get_option( 'single_comments' ) ):?>
            <li><i class="far fa-comments"></i> <?php comments_popup_link( esc_html_x('0 comment','comment counter None format' ,'balkon'), esc_html_x('1 comment','comment counter One format', 'balkon'), esc_html_x('% comments','comment counter Plural format', 'balkon') ); ?></li>
            <?php endif;?>

        </ul>
    </div>
    <?php endif;
}
function balkon_single_post_tags(){
    if( balkon_get_option( 'single_tags' ) && get_the_tags( ) ) :?>
    <span class="fw-separator"></span>
    <div class="list-single-main-item-title fl-wrap tag-heading">
        <h3><?php esc_html_e( 'Tags', 'balkon' ); ?></h3>
    </div>
    <div class="list-single-tags tags-stylwrap blog-tags">
        <?php the_tags('','','');?>                                                                          
    </div>
    <?php endif;
}
function balkon_link_pages($class = 'post-list'){
    wp_link_pages( 
        array(
            'before'      => '<div class="page-links page-links-'.$class.'"><div class="page-links-title">' . esc_html__( 'Pages: ', 'balkon' ) . '</div>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) 
    );
}

function balkon_single_header_icon(){
    $icon = balkon_get_option('blog_page_icon');
    if(is_single()) $icon = get_post_meta( get_the_ID(), '_cmb_icon_class', true );
    if(empty($icon)) return;
    ?>
    <div class="col-md-8 col-md-offset-2 text-center single-header-icon">
        <div class="inner-icon">
            <div class="inner-icon-border">
                <div class="inner-icon-body">
                    <?php echo wp_kses_post( $icon );?>
                </div>
            </div>
        </div>
    </div>
    <?php
}


function balkon_portfolio_single_post_metas(){
    if(balkon_get_option('folio_date_checkbox')||balkon_get_option('folio_show_title')||balkon_get_option('folio_author_checkbox')||balkon_get_option('folio_cats_checkbox')||balkon_get_option('folio_comment_checkbox')): ?>
    <div class="article-head">
    <?php if(balkon_get_option('folio_date_checkbox')) :?>
        <div class="date-post marginbot20">
            <span class="date"><?php the_time('d' );?></span>
            <span class="mo-year"><?php the_time('m-Y' );?></span>
        </div>
        
    <?php endif;?>

    <?php if(balkon_get_option('folio_show_title')) :?>
        <h3><?php the_title( );?></h3>
    <?php endif;?>
        <ul class="meta-post">
        <?php if(balkon_get_option('folio_author_checkbox')) :?>
            <li>
                <i class="fa fa-user"></i>
                <?php the_author_posts_link( );?>                                                   
            </li>
        <?php endif;?> 
        <?php if(balkon_get_option('folio_cats_checkbox')) :?>
        <?php if(get_the_terms(get_the_ID(), 'skill' )) { ?>
            <li>
                <i class="fa fa-file"></i>
                <?php the_terms( get_the_ID(), 'skill', '', ', ' ,'');?>                    
            </li>   
            <?php } ?>  
        <?php endif;?>
        <?php if(balkon_get_option('folio_comment_checkbox')) :?>
            <li>
                <i class="fa fa-comments"></i>
                <?php comments_popup_link(__('0 comment', 'balkon'), __('1 comment', 'balkon'), __('% comments', 'balkon')); ?>                      
            </li>
        <?php endif;?>
        </ul>
    </div>
    <?php endif;
}

