<?php
/* add_ons_php */

class CTH_Class_Testimonial_CPT extends CTH_Class_CPT {  
    protected $name = 'cth_testimonial';

    protected function init(){
        parent::init();
    }
    public function register(){

        $labels = array( 
        'name' => __( 'Testimonial', 'balkon-add-ons' ),
        'singular_name' => __( 'Testimonial', 'balkon-add-ons' ),
        'add_new' => __( 'Add New Testimonial', 'balkon-add-ons' ),
        'add_new_item' => __( 'Add New Testimonial', 'balkon-add-ons' ),
        'edit_item' => __( 'Edit Testimonial', 'balkon-add-ons' ),
        'new_item' => __( 'New Testimonial', 'balkon-add-ons' ),
        'view_item' => __( 'View Testimonial', 'balkon-add-ons' ),
        'search_items' => __( 'Search Testimonials', 'balkon-add-ons' ),
        'not_found' => __( 'No Testimonials found', 'balkon-add-ons' ),
        'not_found_in_trash' => __( 'No Testimonials found in Trash', 'balkon-add-ons' ),
        'parent_item_colon' => __( 'Parent Testimonial:', 'balkon-add-ons' ),
        'menu_name' => __( 'Balkon Testimonials', 'balkon-add-ons' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'List Testimonials',
        'supports' => array( 'title', 'editor', 'thumbnail'/*,'comments', 'post-formats'*/),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-format-chat', 
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => __('cth_testimonial','balkon-add-ons') ),
        'capability_type' => 'post'
    );
        register_post_type( $this->name , $args );
    }


    protected function set_meta_columns(){
        $this->has_columns = true;
    }
    public function meta_columns_head($columns){
        
        $columns['_thumbnail'] = __('Thumbnail', 'balkon-add-ons');
        $columns['_rating'] = __( 'Rating', 'balkon-add-ons' );
        $columns['_id'] = __( 'ID', 'balkon-add-ons' );

        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_id') {
            echo $post_ID;
        }
        if ($column_name == '_thumbnail') {
            echo get_the_post_thumbnail($post_ID, 'thumbnail', array('style' => 'width:100px;height:auto;'));
        }
        if ($column_name == '_rating') {
            $rated = get_post_meta($post_ID, '_balkon_testim_rate', true );
            if($rated != '' && $rated != 'no'){
                $ratedval = floatval($rated);
                echo '<ul class="star-rating">';
                for ($i=1; $i <= 5; $i++) { 
                    if($i <= $ratedval){
                        echo '<li><i class="testimfa testimfa-star"></i></li>';
                    }else{
                        if($i - 0.5 == $ratedval){
                            echo '<li><i class="testimfa testimfa-star-half"></i></li>';
                        }
                    }
                    
                }
                echo '</ul>';
            }else{
                esc_html_e('Not Rated','balkon-add-ons' );
            }
        }
        
    }

    
}

new CTH_Class_Testimonial_CPT();




