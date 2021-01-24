<?php
/* add_ons_php */

//For post_tag taxonomy
// Add term page
function balkon_post_tag_add_new_meta_field() {
    
    // this will add the custom meta field to the add new term page
    wp_enqueue_media();
    wp_enqueue_script('balkon_tax_meta', CTH_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    balkon_radio_options_field(array(
                                'id'=>'tax_show_header',
                                'name'=>esc_html__('Show Header Section','balkon-add-ons'),
                                'values' => array(
                                        'yes'=> esc_html__('Yes','balkon-add-ons'),
                                        'no'=> esc_html__('No','balkon-add-ons'),
                                    ),
                                'default'=>'yes'
    ));
    balkon_select_media_file_field('cat_header_image',esc_html__('Header Background Image','balkon-add-ons'), array());
    balkon_radio_options_field(array(
                                'id'=>'tax_title_in_content',
                                'name'=>esc_html__('Show Tag Info','balkon-add-ons'),
                                'values' => array(
                                        'yes'=> esc_html__('Yes','balkon-add-ons'),
                                        'no'=> esc_html__('No','balkon-add-ons'),
                                    ),
                                
                                'default'=>'no'
    ) );

}
add_action('post_tag_add_form_fields', 'balkon_post_tag_add_new_meta_field', 10, 2);

// Edit term page
function balkon_post_tag_edit_meta_field($term) {
    wp_enqueue_media();
    wp_enqueue_script('balkon_tax_meta', CTH_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    
    // put the term ID into a variable
    $t_id = $term->term_id;
    
    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option("balkon_taxonomy_post_tag_$t_id");

    balkon_radio_options_field(array(
                                'id'=>'tax_show_header',
                                'name'=>esc_html__('Show Header Section','balkon-add-ons'),
                                'values' => array(
                                        'yes'=> esc_html__('Yes','balkon-add-ons'),
                                        'no'=> esc_html__('No','balkon-add-ons'),
                                    ),

                                'default'=>'yes'
    ),$term_meta,false);
    balkon_select_media_file_field('cat_header_image',esc_html__('Header Background Image','balkon-add-ons'), $term_meta,false);
    balkon_radio_options_field(array(
                                'id'=>'tax_title_in_content',
                                'name'=>esc_html__('Show Tag Info','balkon-add-ons'),
                                'values' => array(
                                        'yes'=> esc_html__('Yes','balkon-add-ons'),
                                        'no'=> esc_html__('No','balkon-add-ons'),
                                    ),
                                
                                'default'=>'no'
    ) ,$term_meta,false);
}
add_action('post_tag_edit_form_fields', 'balkon_post_tag_edit_meta_field', 10, 2);

// Save extra taxonomy fields callback function.
function balkon_save_post_tag_custom_meta($term_id) {
    if (isset($_POST['term_meta'])) {
        $t_id = $term_id;
        $term_meta = get_option("balkon_taxonomy_post_tag_$t_id");
        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        
        // Save the option array.
        update_option("balkon_taxonomy_post_tag_$t_id", $term_meta);
    }
}
add_action('edited_post_tag', 'balkon_save_post_tag_custom_meta', 10, 2);
add_action('create_post_tag', 'balkon_save_post_tag_custom_meta', 10, 2);
