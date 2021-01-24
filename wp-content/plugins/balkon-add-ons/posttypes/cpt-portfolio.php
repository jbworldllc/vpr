<?php
/* add_ons_php */

class CTH_Class_Portfolio_CPT extends CTH_Class_CPT
{
    protected $name = 'portfolio';

    protected function init()
    {
        parent::init();

        add_action('init', array($this, 'taxonomies'), 0);
        add_action('manage_edit-portfolio_cat_columns', array($this, 'tax_cat_columns_head'));
        add_action('manage_portfolio_cat_custom_column', array($this, 'tax_cat_columns_content'), 10 , 3);
    }
    public function register()
    {

        $labels = array(
            'name'               => __('Portfolio', 'balkon-add-ons'),
            'singular_name'      => __('Portfolio', 'balkon-add-ons'),
            'add_new'            => __('Add New Portfolio', 'balkon-add-ons'),
            'add_new_item'       => __('Add New Portfolio', 'balkon-add-ons'),
            'edit_item'          => __('Edit Portfolio', 'balkon-add-ons'),
            'new_item'           => __('New Portfolio', 'balkon-add-ons'),
            'view_item'          => __('View Portfolio', 'balkon-add-ons'),
            'search_items'       => __('Search Portfolios', 'balkon-add-ons'),
            'not_found'          => __('No Portfolios found', 'balkon-add-ons'),
            'not_found_in_trash' => __('No Portfolios found in Trash', 'balkon-add-ons'),
            'parent_item_colon'  => __('Parent Portfolio:', 'balkon-add-ons'),
            'menu_name'          => __('Balkon Portfolios', 'balkon-add-ons'),
        );

        $args = array(
            'labels'              => $labels,
            'hierarchical'        => true,
            'description'         => 'List Portfolios',
            'supports'            => array('title', 'editor', 'thumbnail', 'comments', 'excerpt' /*, 'post-formats'*/),
            'taxonomies'          => array('portfolio_cat', 'post_tag'),
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 20,
            'menu_icon'           => CTH_DIR_URL . 'assets/admin_ico_portfolio.png',
            'show_in_nav_menus'   => true,
            'publicly_queryable'  => true,
            'exclude_from_search' => false,
            'has_archive'         => true,
            'query_var'           => true,
            'can_export'          => true,
            'rewrite'             => array('slug' => __('portfolio', 'balkon-add-ons')),
            'capability_type'     => 'post',
        );

        register_post_type('portfolio', $args);
    }

    public function taxonomies()
    {
        $labels = array(
            'name'              => __('Portfolio Categories', 'balkon-add-ons'),
            'singular_name'     => __('Category', 'balkon-add-ons'),
            'search_items'      => __('Search Categories', 'balkon-add-ons'),
            'all_items'         => __('All Categories', 'balkon-add-ons'),
            'parent_item'       => __('Parent Category', 'balkon-add-ons'),
            'parent_item_colon' => __('Parent Category:', 'balkon-add-ons'),
            'edit_item'         => __('Edit Category', 'balkon-add-ons'),
            'update_item'       => __('Update Category', 'balkon-add-ons'),
            'add_new_item'      => __('Add New Category', 'balkon-add-ons'),
            'new_item_name'     => __('New Category Name', 'balkon-add-ons'),
            'menu_name'         => __('Portfolio Categories', 'balkon-add-ons'),
        );

// Now register the taxonomy

        register_taxonomy('portfolio_cat', array('portfolio'), array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => __('portfolio_cat', 'balkon-add-ons')),
        ));

    }

    function tax_cat_columns_head($defaults){
        $defaults['_id'] = __('ID','balkon-add-ons');
        return $defaults;
    }
    function tax_cat_columns_content($c, $column_name, $term_id){
        if ($column_name == '_id') {
            echo $term_id;
        }
    }

    protected function set_meta_columns()
    {
        $this->has_columns = true;
    }
    public function meta_columns_head($columns)
    {
        $columns['_thumbnail'] = __('Thumbnail', 'balkon-add-ons');
        $columns['_id']        = __('ID', 'balkon-add-ons');
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID)
    {
        if ($column_name == '_id') {
            echo $post_ID;
        }
        if ($column_name == '_thumbnail') {
            echo get_the_post_thumbnail($post_ID, 'thumbnail', array('style' => 'width:100px;height:auto;'));
        }
    }

}

new CTH_Class_Portfolio_CPT();

/**
 * Taxonomy meta box
 *
 * @since Balkon 1.0
 */
require_once CTH_ABSPATH . 'inc/cth_taxonomy_fields.php';
require_once CTH_ABSPATH . 'inc/portfolio_cat_metabox_fields.php';

