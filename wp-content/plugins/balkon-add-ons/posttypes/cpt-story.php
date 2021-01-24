<?php
/* add_ons_php */

class CTH_Class_Story_CPT extends CTH_Class_CPT {  
    protected $name = 'cth_resume';

    protected function init(){
        parent::init();
    }
    public function register(){

        $labels = array( 
        'name' => __( 'Resume', 'balkon-add-ons' ),
        'singular_name' => __( 'Resume', 'balkon-add-ons' ),
        'add_new' => __( 'Add New Resume', 'balkon-add-ons' ),
        'add_new_item' => __( 'Add New Resume', 'balkon-add-ons' ),
        'edit_item' => __( 'Edit Resume', 'balkon-add-ons' ),
        'new_item' => __( 'New Resume', 'balkon-add-ons' ),
        'view_item' => __( 'View Resume', 'balkon-add-ons' ),
        'search_items' => __( 'Search Resumes', 'balkon-add-ons' ),
        'not_found' => __( 'No Resumes found', 'balkon-add-ons' ),
        'not_found_in_trash' => __( 'No Resums found in Trash', 'balkon-add-ons' ),
        'parent_item_colon' => __( 'Parent Resume:', 'balkon-add-ons' ),
        'menu_name' => __( 'Balkon Resumes', 'balkon-add-ons' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => __( 'List Resumes', 'balkon-add-ons' ),
        'supports' => array( 'title', 'editor','excerpt'/*, 'thumbnail','comments', 'post-formats'*/),
        //'taxonomies' => array('story_tax'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => CTH_DIR_URL .'assets/admin_ico_story.png', 
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => __('resume','balkon-add-ons') ),
        'capability_type' => 'post'
    );

        register_post_type( $this->name , $args );
    }

    /**
     * Save post metadata when a post is saved.
     *
     * @param int $post_id The post ID.
     * @param post $post The post object.
     * @param bool $update Whether this is an existing post being updated or not.
     */
    public function save_post($post_id, $post, $update){
        if(!$this->can_save($post_id)) return;
    }


    protected function set_meta_columns(){
        $this->has_columns = true;
    }
    public function meta_columns_head($columns){
        
        $columns['_id'] = __( 'ID', 'balkon-add-ons' );
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_id') { 
            echo $post_ID;
        }
        
    }

    
}

new CTH_Class_Story_CPT();




