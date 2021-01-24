<?php
/* add_ons_php */

class CTH_Class_Member_CPT extends CTH_Class_CPT {  
    protected $name = 'member';

    protected function init(){
        parent::init();
    }
    public function register(){

        $labels = array( 
        'name' => __( 'Members', 'balkon-add-ons' ),
        'singular_name' => __( 'Member', 'balkon-add-ons' ),
        'add_new' => __( 'Add New Member', 'balkon-add-ons' ),
        'add_new_item' => __( 'Add New Member', 'balkon-add-ons' ),
        'edit_item' => __( 'Edit Member', 'balkon-add-ons' ),
        'new_item' => __( 'New Member', 'balkon-add-ons' ),
        'view_item' => __( 'View Member', 'balkon-add-ons' ),
        'search_items' => __( 'Search Members', 'balkon-add-ons' ),
        'not_found' => __( 'No Members found', 'balkon-add-ons' ),
        'not_found_in_trash' => __( 'No Members found in Trash', 'balkon-add-ons' ),
        'parent_item_colon' => __( 'Parent Member:', 'balkon-add-ons' ),
        'menu_name' => __( 'Balkon Members', 'balkon-add-ons' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'List Members',
        'supports' => array( 'title', 'editor', 'thumbnail','excerpt'/*,'comments', 'post-formats'*/),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' =>  'dashicons-groups',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => __('member','balkon-add-ons') ),
        'capability_type' => 'post'
    );
        register_post_type( $this->name , $args );
    }


    protected function set_meta_columns(){
        $this->has_columns = true;
    }
    public function meta_columns_head($columns){
        
        $columns['_thumbnail'] = __('Thumbnail', 'balkon-add-ons');
        
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
        
    }

    
}

new CTH_Class_Member_CPT();




