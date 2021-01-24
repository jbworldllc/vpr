<?php
/* add_ons_php */
defined( 'ABSPATH' ) || exit;
/**
 * CTH_Class_Options class
 *
 * @since 1.3.1
 */
class CTH_Class_Options {

    private $slug; // settings page slug 
    private $page; // settings page slug
    private $options = array(); // global options

    protected $menu_slug = 'balkon-addons';  

    protected $option_tabs = array();

    protected $option_options = array();

    protected $current_section = 'default-section-id';   

    /** Constructor */
    function __construct() {
        
        // if(!get_option('balkon_addons_slug')) update_option( 'balkon_addons_slug', 'settings_page_balkon-addons' );

        // $slug           = get_option('balkon_addons_slug');
        // $this->option_name     = $slug;
        // $this->options  = get_option($slug);

        // delete_option( 'settings_page_balkon-addons' );

        $this->option_name     = $this->menu_slug.'-options';

        // If the theme options don't exist, create them.
        if( false == get_option( $this->option_name ) ) {  
            add_option( $this->option_name , array());
        }else{
            $this->options = get_option( $this->option_name );
        } 

        // end if

        $this->plugin_info();

        $this->init();

    }

    function init() {
        // add_action('init', array(&$this, 'plugin_info'));
        add_action( 'admin_menu', array($this, 'register_settings') );
    }

    function parse_listing_cats($cats = array(),&$return =array(),$parent_id = 0,$curlevel = -1,$maxlevel = 3){
        $return = $return? $return : array();
        if ( !empty($cats) ) :
            foreach( $cats as $cat ) {
                if( $cat->parent == $parent_id ) {
                    // $return[$cat->term_id] = array('name'=>$cat->name,'level'=>$curlevel+1,'children'=>array());
                    $return[] = array('id'=>$cat->term_id,'name'=>$cat->name,'level'=>$curlevel+1);
                    // if($return[$cat->term_id]['level'] < $maxlevel ) $this->parse_listing_cats($cats,$return[$cat->term_id]['children'],$cat->term_id,$return[$cat->term_id]['level']);
                    if($curlevel+1 < $maxlevel ) $this->parse_listing_cats($cats,$return,$cat->term_id,$curlevel+1);

                    
                }
            }
        endif;
        // return $return;
    }

    


    function get_setting_tab_options($tab = 'general'){
        if(isset($this->option_options[$tab])) 
            return $this->option_options[$tab];
        elseif($tab == '') 
            return $this->option_options;
        else 
            return array();
    }


    function register_setting_field($field = array(), $tab = ''){
        $default = array(
            'type' => 'section', // section or field
            'field_type' => 'text', // field type for register field only
            'id' => 'default-section-id', // section or field id
            'title' => __( 'Default title', 'balkon-add-ons' ), // section or field title
            // 'callback' => '__return_false', // section or field callback for echo its output
            // 'section_id' => 'default-section-id', // for setting field only // use current_section instead
            // 'args' => array(
            //     'id' => 'default-section-id', // id of the field
            //     'desc' => __( 'Default description', 'balkon-add-ons' ), // id of the field
            // ), // for setting field only

            'desc' => '', // desc of the field

            'args' => array(
                // 'options' => array(key=>value) for radio
            )
        );

        $field = array_merge($default, $field);

        if($field['type'] == 'section'){
            if(!isset($field['callback'])) $field['callback'] = '__return_false';
            // $page_tab = $this->menu_slug.'_widgets-options';
            // $id, $title, $callback, $page
            // $page - The menu page on which to display this section. Should match $menu_slug from Function Reference/add theme page if you are adding a section to an 'Appearance' page, or Function Reference/add options page if you are adding a section to a 'Settings' page.
            add_settings_section( $field['id'], $field['title'], $field['callback'], $this->slug ."-$tab" );

            $this->current_section = $field['id'] ;
        }
        if($field['type'] == 'field'){
            if(!isset($field['callback'])){
                switch ($field['field_type']) {
                    case 'text':
                        $field['callback'] = array($this, 'settings_field_input');
                        break;
                    case 'number':
                        $field['callback'] = array($this, 'settings_field_number');
                        break;
                    case 'textarea':
                        $field['callback'] = array($this, 'settings_field_textarea');
                        break;
                    case 'editor':
                        $field['callback'] = array($this, 'settings_field_editor');
                        break;
                    case 'checkbox':
                        $field['callback'] = array($this, 'settings_field_checkbox');
                        break;
                    case 'radio':
                        $field['callback'] = array($this, 'settings_field_radio');
                        break;
                    case 'select':
                        $field['callback'] = array($this, 'settings_field_select');
                        break;
                    case 'info':
                        $field['callback'] = array($this, 'settings_field_info');
                        break;
                    case 'page_select':
                        $field['callback'] = array($this, 'settings_field_page_select');
                        break;
                    case 'user_select':
                        $field['callback'] = array($this, 'settings_field_user_select');
                        break;
                    case 'image':
                        $field['callback'] = array($this, 'settings_field_image');
                        break;
                    case 'repeat_content':
                        $field['callback'] = array($this, 'settings_field_repeat_content');
                        break;
                    case 'repeat_widget':
                        $field['callback'] = array($this, 'settings_field_repeat_widget');
                        break;
                    case 'currencies':
                        $field['callback'] = array($this, 'settings_field_currencies');
                        break;
                    

                    case 'color':
                        $field['callback'] = array($this, 'settings_field_color');
                        break;
                    case 'lfeatures':
                        $field['callback'] = array($this, 'settings_field_lfeatures');
                        break;
                    case 'cth_tags':
                        $field['callback'] = array($this, 'settings_field_cth_tags');
                        break;
                    case 'toggle_chat':
                        $field['callback'] = array($this, 'settings_field_toggle_chat');
                        break;
                        
                    default:
                        $field['callback'] = array($this, 'settings_field_input');
                        break;
                }
            }
            // $id, $title, $callback, $page, $section, $args
            add_settings_field(
                $field['id'], 
                $field['title'], 
                $field['callback'], 
                $this->slug ."-$tab", 
                $this->current_section, 
                array_merge(array(
                    'id'    => $field['id'], 
                    'desc'  => $field['desc']
                ), $field['args'])
            );
        }
    }

    function register_settings() {
        // add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
        // $this->slug = add_options_page( 'Balkon Add-ons', 'Balkon Add-ons', 'manage_options', $this->menu_slug, array($this, 'view_admin_settings') );
        $this->slug = add_menu_page( 'Balkon Add-ons', 'Balkon Add-ons', 'manage_options', $this->menu_slug, array($this, 'view_admin_settings'), 'dashicons-admin-generic', 99 );

        $this->options  = get_option($this->option_name, array());

        // https://developer.wordpress.org/reference/functions/register_setting/
        // string $option_group, string $option_name, array $args = array()
        register_setting($this->option_name, $this->option_name, array($this, 'sanitize_settings') );

        // if($options){
        //     foreach ($options as $field) {
        //         $this->register_setting_field($field);
        //     }
        // }

        $tabs_options = $this->get_setting_tab_options('');
        if(!empty($tabs_options)){
            foreach ($tabs_options as $tab => $options) {
                if(!empty($options)){
                    foreach ($options as $field) {
                        $this->register_setting_field($field, $tab);
                    }
                }
            }
        }

    }


    function filter_pre_update_option($value, $option, $old_value){
        if($option == $this->option_name){
            if(!is_array($value)) $value = array();
            if(!is_array($old_value)) $old_value = array();
            return array_merge($old_value,$value);
        }
        return $value;
    }

    function settings_field_info($args) {
        $desc = $args['desc'];
        echo "<p class='description desc-info'>$desc</div>";

    }

    function settings_field_input($args) {
        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';
        $value = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');

        echo "<input id='$id' name='{$this->option_name}[{$id}]' size='40' type='text' value='{$value}' />";
        echo "<p class='description'>$desc</div>";

    }

    function settings_field_number($args) {
        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';
        $value = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');

        $attrs = '';
        if(isset($args['min'])) $attrs .= ' min="'.$args['min'].'"';
        if(isset($args['max'])) $attrs .= ' max="'.$args['max'].'"';
        if(isset($args['step'])) $attrs .= ' step="'.$args['step'].'"';

        echo "<input id='$id' name='{$this->option_name}[{$id}]' size='40' type='number' value='{$value}'".$attrs."/>";
        echo "<p class='description'>$desc</div>";

    }

    function settings_field_textarea($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';
        // $options = $this->options;

        // $default = "#login {width: 500px} .success {background-color: #F0FFF8; border: 1px solid #CEEFE1;}";

        // if(!isset($options['custom_style'])) $options['custom_style'] = $default;
        // $text = $options['custom_style'];

        $value = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');

        echo "<textarea id='{$id}' name='{$this->option_name}[{$id}]' rows='7' cols='50' class='large-text code'>{$value}</textarea>";
        echo "<p class='description'>$desc</div>";

    }

    function settings_field_editor($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';

        $value = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');

        /**
         * 2.
         * This code renders an editor box and a submit button.
         * The box will have 15 rows, the quicktags won't load
         * and the PressThis configuration is used.
         */
        $editor_args = array(
            'textarea_rows' => isset($args['rows'])? $args['rows'] : 10,
            'textarea_name'=> $this->option_name .'['. $id .']',
            'teeny' => true,
            'quicktags' => true
        );
        wp_editor( $value, $this->option_name .'_'. $id .'_', $editor_args );
        echo "<p class='description'>$desc</div>";

    }

    function settings_field_checkbox($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : (isset($args['default']) ? $args['default'] : '');
        $value = isset($args['value'])? $args['value'] : 1;

        $checked = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');

        echo '<label for="'. $id .'">';
            echo '<input type="hidden" name="'. $this->option_name .'['. $id .']" value="">';
            echo '<input type="checkbox" id="'.$id.'" name="'. $this->option_name .'['. $id .']" value="'.$value.'" '. checked( $checked, $value, false ) .'/>';
        echo '&nbsp;' . $desc .'</label>';

    }

    function settings_field_image($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';

        $value = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');

        // echo '<label for="'. $id .'">';
        //     echo '<input type="checkbox" id="'.$id.'" name="'. $this->option_name .'['. $id .']" value="1" '. checked( $value, 1, false ) .'/>';
        // echo '&nbsp;' . $desc .'</label>';


        echo '<img id="'. $this->option_name .'['. $id .'][preview]" src="'.(isset($value['url']) ? esc_attr($value['url']) : '').'" alt="" '.(isset($value['url']) ? ' style="display:block;width:200px;height=auto;"' : ' style="display:none;width:200px;height=auto;"').'>';
        echo '<input type="hidden" name="'. $this->option_name .'['. $id .'][url]" id="'. $this->option_name .'['. $id .'][url]" value="'.(isset($value['url']) ? esc_attr($value['url']) : '').'">';
        echo '<input type="hidden" name="'. $this->option_name .'['. $id .'][id]" id="'. $this->option_name .'['. $id .'][id]" value="'.(isset($value['id']) ? esc_attr($value['id']) : '').'">';
        
        echo '<p class="description"><a href="#" data-uploader_title="'.esc_html__( 'Select Image', 'balkon-add-ons' ).'" class="button button-primary upload_image_button metakey-'.$this->option_name.' fieldkey-'.$id.'">'.esc_html__('Upload Image', 'balkon-add-ons').'</a>  <a href="#" class="button button-secondary remove_image_button metakey-'.$this->option_name.' fieldkey-'.$id.'">'.esc_html__('Remove', 'balkon-add-ons').'</a></p>';


        echo "<p class='description'>$desc</div>";

    }

    function settings_field_radio($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';

        $value = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');

        if (isset($args['options']) && !empty($args['options'])) {
            foreach ($args['options'] as $option_value => $option_text) {
                // $checked = ' ';
                // if (get_option($value['id']) == $option_value) {
                //     $checked = ' checked="checked" ';
                // }
                // else if (get_option($value['id']) === FALSE && $value['std'] == $option_value){
                //     $checked = ' checked="checked" ';
                // }
                // else {
                //     $checked = ' ';
                // }
                echo '<div class="mnt-radio" style="display:inline-block;padding:0 10px 0 0;"><input type="radio" name="'. $this->option_name .'['. $id .']" value="'.
                    $option_value.'" '.checked( $option_value, $value, false )."/>".$option_text."</div>\n";

                if(isset($args['options_block']) && $args['options_block']) echo '<br />';
            }
        }


        echo "<p class='description'>$desc</div>";


    }

    function settings_field_select($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';

        $value = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');

        $field_class = 'select_field' . (isset($args['multiple']) && $args['multiple'] == true ? ' multiple_field':'') . (isset($args['use-select2']) && $args['use-select2'] == true ? ' use-select2':'');

        if(isset($args['multiple']) && $args['multiple'] == true){
            echo '<input type="hidden" name="'.$this->option_name .'['. $id .'][]'.'">'."\n";
            echo '<select id="'. $this->option_name .'['. $id .']" class="'.$field_class.'" name="'. $this->option_name .'['. $id ."][]\" multiple=\"multiple\">\n";
                if (isset($args['options']) && !empty($args['options'])) {
                    foreach ($args['options'] as $option_value => $option_text) {
                        echo "\t".'<option value="'.$option_value.'" '. (in_array($option_value, (array)$value)? ' selected="selected"':'').'>'.$option_text."</option>\n";
                    }
                }
            echo "</select>\n";
        }else{
            echo '<select id="'. $this->option_name .'['. $id .']" class="'.$field_class.'" name="'. $this->option_name .'['. $id ."]\">\n";
                if (isset($args['options']) && !empty($args['options'])) {
                    foreach ($args['options'] as $option_value => $option_text) {
                        echo "\t".'<option value="'.$option_value.'" '.selected( $value, $option_value, false ).'>'.$option_text."</option>\n";
                    }
                }
            echo "</select>\n";
        }

        echo "<p class='description'>$desc</div>";


    }

    function settings_field_page_select($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';

        $value = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');

        $options = isset($args['options']) ? $args['options'] : array();

        $all_page_ids = get_all_page_ids();
        if(!empty($all_page_ids)){
        echo '<select id="'. $this->option_name .'['. $id .']" class="post_form" name="'. $this->option_name .'['. $id .']">\n';
            $is_selected = false;
            if(!empty($options)){
                foreach ($options as $opt) {
                    if( isset($opt[0]) && isset($opt[1]) ){
                        echo '<option value="'.$opt[0].'" '.selected( $value, $opt[0], false ).'>'.$opt[1]."</option>\n";
                        if($value == $opt[0]) $is_selected = true;
                    } 
                }
            }
            foreach ($all_page_ids as $key => $p_id) {
                $p_p = get_post($p_id);
                if($p_p->post_status == 'publish'){
                    $selected = ' ';
                    if($is_selected != true){
                        if( $value == $p_id ){
                            $selected = ' selected="selected" ';
                            $is_selected = true;
                        }
                        elseif( isset($args['default_title']) && $args['default_title'] == $p_p->post_title ){
                            $selected = ' selected="selected" ';
                            $is_selected = true;
                        }
                    }
                        
            
                    echo '<option value="'.$p_id.'" '.$selected.'>'.$p_p->post_title."</option>\n";
                }
                
            }
        echo "</select>\n";
        } 

        echo "<p class='description'>$desc</div>";


    }

    function settings_field_user_select($args){
            if(!isset($args['id'])) return;
            $desc = isset($args['desc'])? $args['desc'] : '';

            $id = $args['id'];
            $value = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');

            $all_user = get_users(array(
                'role__in' => array('Administrator', 'Editor')
            ));
            if(!empty($all_user)){
                echo '<select id="'. $this->option_name .'['. $id .']" class="post_form" name="'. $this->option_name .'['. $id .']">\n';
                    
                    foreach ($all_user as $key => $user) {
                        $selected = '';
                        if($value == $user->ID){
                            $selected = 'selected="selected" ';
                        }
                        echo '<option value="'.$user->ID.'" '.$selected.'>'.$user->user_login."</option>\n";
                    }
                echo "</select>\n";
            }
            echo "<p class='description'>$desc</div>";
        }

    function settings_field_repeat_content($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';

        $fields = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');
        
        $option_field_name = $this->option_name .'['. $id .']';

        echo '<input type="hidden" name="'.$option_field_name .'">'."\n";

        ?>
        <div class="addons-form">
            <div class="repeater-fields-wrap"  data-tmpl="tmpl-content-addfield">
                <div class="repeater-fields">
                <?php 
                if(!empty($fields)){
                    foreach ((array)$fields as $key => $field) {
                        balkon_addons_get_template_part('templates-inner/add-field',false, array( 'index'=>$key,'name'=>$option_field_name,'field'=>$field ) );
                    }
                }
                ?>
                </div>
                <button class="btn addfield" type="button"><?php  esc_html_e( 'Add Field','balkon-add-ons' );?></button>
            </div>
        </div>

        <?php

        echo "<p class='description'>$desc</div>";

        add_action( 'admin_footer', function()use($option_field_name){
            ?>
            <script type="text/template" id="tmpl-content-addfield">
                <?php balkon_addons_get_template_part('templates-inner/add-field',false, array( 'name'=>$option_field_name ) );?>
            </script>
            <?php
        });
    }

    function settings_field_repeat_widget($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';

        $widgets = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');
        // echo '<pre>';var_dump($widgets);
        $option_field_name = $this->option_name .'['. $id .']';
        echo '<input type="hidden" name="'.$option_field_name .'">'."\n";

        ?>
        <div class="addons-form">
            <div class="repeater-widgets-wrap"  data-tmpl="tmpl-content-addwidget">
                <div class="repeater-widgets">
                <?php 
                if(!empty($widgets)){
                    foreach ((array)$widgets as $key => $widget) {
                        balkon_addons_get_template_part('templates-inner/add-widget',false, array( 'index'=>$key,'name'=>$option_field_name,'widget'=>$widget ) );
                    }
                }
                ?>
                </div>
                <button class="btn addwidget" data-name="<?php echo esc_attr( $option_field_name ); ?>" type="button"><?php  esc_html_e( 'Add Widget','balkon-add-ons' );?></button>
            </div>
        </div>
        <?php
        echo "<p class='description'>$desc</div>";
    }

    function settings_field_currencies($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';

        $currencies = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');
        // echo '<pre>';var_dump($currencies);
        $option_field_name = $this->option_name .'['. $id .']';
        echo '<input type="hidden" name="'.$option_field_name .'">'."\n";

        ?>
        <div class="addons-form">
            <div class="repeater-widgets-wrap"  data-tmpl="tmpl-currency">
                <div class="repeater-widgets">
                    <div class="name-columns">
                        <h4 class="col-first"><?php esc_html_e( 'Currency code', 'balkon-add-ons' ) ?></h4>
                        <h4><?php esc_html_e( 'Currency symbol', 'balkon-add-ons' ) ?></h4>
                        <h4><?php esc_html_e( 'Currency rate', 'balkon-add-ons' ) ?></h4>
                        <h4 class="btn-rate"><?php esc_html_e( 'Current rate', 'balkon-add-ons' ) ?></h4>
                        <h4 class="btn-pos"><?php esc_html_e( 'Currency position', 'balkon-add-ons' ) ?></h4>
                        <h4><?php esc_html_e( 'Number of decimal', 'balkon-add-ons' ) ?></h4>
                        <h4><?php esc_html_e( 'Thousand separator', 'balkon-add-ons' ) ?></h4>
                        <h4><?php esc_html_e( 'Decimal separator', 'balkon-add-ons' ) ?></h4>
                    </div>
                <?php 
                // var_dump($currencies);
                if(!empty($currencies)){
                    if(isset($currencies['base'])){
                        $base = $currencies['base'];
                        unset($currencies['base']);
                    }
                    $new_key = 0;
                    foreach ((array)$currencies as $key => $currency) {
                        if($key !== 'base'){
                            balkon_addons_get_template_part('templates-inner/add-currency',false, array( 'index'=>$new_key,'name'=>$option_field_name,'currency'=>$currency, 'base'   => $base ) );
                            $new_key++;
                        } 
                    }
                }
                ?>
                </div>
                <button class="btn addwidget" data-name="<?php echo esc_attr( $option_field_name ); ?>" type="button"><?php  esc_html_e( 'Add Currency','balkon-add-ons' );?></button>
            </div>
        </div>
        <?php
        echo "<p class='description'>$desc</div>";
    }

    function settings_field_toggle_chat($args){
        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';
        
        $arr_params = array( 'action' => 'toggle_chat', 'addonstab'=>'chat' );
        echo '<a class="button" href="'.esc_url( add_query_arg( $arr_params ) ).'">Toogle Chat</a>';
        echo "<p class='description'>$desc</div>";
    }

    function settings_field_color($args) {
        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';
        $value = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : '');

        echo "<input id='$id' class='cth-color-field' name='{$this->option_name}[{$id}]' size='40' type='text' value='{$value}' />";
        echo "<p class='description'>$desc</div>";

    }

    function settings_field_lfeatures($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';

        $selected = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : array());
        $option_field_name = $this->option_name .'['. $id .']';
        echo '<input type="hidden" name="'.$option_field_name .'">'."\n";


        $features = get_terms( array(
            'orderby'       => 'count',
            'taxonomy'      => 'listing_feature',
            'hide_empty'    => isset($args['hide_empty']) ? $args['hide_empty'] : true,
        ) );

        if ( ! empty( $features ) && ! is_wp_error( $features ) ){

            $feature_group = array();
            foreach( $features as $key => $term){
                if(balkon_addons_get_option('feature_parent_group') == 'yes'){
                    if($term->parent){
                        if(!isset($feature_group[$term->parent]) || !is_array($feature_group[$term->parent])) $feature_group[$term->parent] = array();
                        $feature_group[$term->parent][$term->term_id] = $term->name;
                    }else{
                        if(!isset($feature_group[$term->term_id])) $feature_group[$term->term_id] = $term->name;
                    }
                }else{
                    if(!isset($feature_group[$term->term_id])) $feature_group[$term->term_id] = $term->name;
                }
                    
            }



            echo '<div class="lcat-features-wrap">';
            foreach( $feature_group as $tid => $tvalue){
                if( is_array( $tvalue ) && count( $tvalue ) ){
                    $term = get_term_by( 'id', $tid , 'listing_feature' );
                    // var_dump($term);
                    if($term){

                        $fea_checked = '';
                        if (in_array($tid, (array)$selected)) $fea_checked = ' checked="checked"';
                        echo    '<div class="lcat-feature-item lcat-feature-item-has-children">
                                        
                                        <label class="lcat-fea-lbl" for="'.$option_field_name.'_'.$tid.'">
                                            <input type="checkbox" id="'.$option_field_name.'_'.$tid.'" name="'.$option_field_name.'['.$tid.']" value="'.$tid.'"'.$fea_checked.'>' . $term->name . '
                                        </label>

                                    </div>';


                        echo '<div class="lcat-feature-children">';

                        foreach ($tvalue as $id => $name) {
                            $fea_checked = '';
                            if (in_array($id, (array)$selected)) $fea_checked = ' checked="checked"';
                            echo    '<div class="lcat-feature-item">
                                            
                                            <label class="lcat-fea-lbl" for="'.$option_field_name.'_'.$id.'">
                                                <input type="checkbox" id="'.$option_field_name.'_'.$id.'" name="'.$option_field_name.'['.$id.']" value="'.$id.'"'.$fea_checked.'>' . $name . '
                                            </label>

                                        </div>';
                        }

                        echo '</div>';
                    }
                    
                }else{
                    $fea_checked = '';
                    if (in_array($tid, (array)$selected)) $fea_checked = ' checked="checked"';
                    echo    '<div class="lcat-feature-item">
                                    
                                    <label class="lcat-fea-lbl" for="'.$option_field_name.'_'.$tid.'">
                                        <input type="checkbox" id="'.$option_field_name.'_'.$tid.'" name="'.$option_field_name.'['.$tid.']" value="'.$tid.'"'.$fea_checked.'>' . $tvalue . '
                                    </label>

                                </div>';

                }
                
                    
            }
            echo '</div>';//end content-widgets-wrap

        }

        echo "<p class='description'>$desc</div>";
    }


    function settings_field_cth_tags($args) {

        if(!isset($args['id'])) return;
        $id = $args['id'];
        $desc = isset($args['desc'])? $args['desc'] : '';

        $selected = isset($this->options[$id]) ? $this->options[$id] : (isset($args['default']) ? $args['default'] : array());
        $option_field_name = $this->option_name .'['. $id .']';
        echo '<input type="hidden" name="'.$option_field_name .'">'."\n";


        $features = get_terms( array(
            'orderby'       => 'count',
            'taxonomy'      => 'post_tag',
            'hide_empty'    => isset($args['hide_empty']) ? $args['hide_empty'] : true,
        ) );

        if ( ! empty( $features ) && ! is_wp_error( $features ) ){

            echo '<div class="lcat-features-wrap">';
            foreach( $features as $key => $term){
                $fea_checked = '';
                if (in_array($term->term_id, (array)$selected)) $fea_checked = ' checked="checked"';
                echo    '<div class="lcat-feature-item">
                                
                                <label class="lcat-fea-lbl" for="'.$option_field_name.'_'.$term->term_id.'">
                                    <input type="checkbox" id="'.$option_field_name.'_'.$term->term_id.'" name="'.$option_field_name.'['.$term->term_id.']" value="'.$term->term_id.'"'.$fea_checked.'>' . $term->name . '
                                </label>

                            </div>';
            }
            echo '</div>';

        }

        echo "<p class='description'>$desc</div>";
    }


    

    /** 
     * Sanitize options
     *
     * @todo    Check if author/key is valid
     * @since   1.0
     */
    function sanitize_settings($args) {

        return $args;
    }

    /**
     * Main Settings panel
     *
     * @since   1.0
     */
    function view_admin_settings() {
        ?>
        <div class="wrap">

            <div id="icon-options-general" class="icon32"></div>
            <h2><?php _e( 'Balkon Add-Ons Settings', 'balkon-add-ons' ); ?></h2>
        
            <?php //settings_errors(); ?>
            <?php
            $active_tab = isset( $_GET[ 'addonstab' ] ) ? $_GET[ 'addonstab' ] : 'general';
            ?>
            <h2 class="nav-tab-wrapper">
                <?php
                foreach ($this->option_tabs as $id => $title) {
                    ?>
                    <a href="#cth-addons-tab-<?php echo $id; ?>" data-tabid="<?php echo $id; ?>" class="nav-tab cth-addons-tab <?php echo $active_tab == $id ? ' nav-tab-active' : ''; ?>"><?php echo $title;?></a>
                    <?php
                }
                ?>
            </h2>


            <form action="options.php" method="post" id="ctb-addons-options-form">
            <?php
            // $slug = $this->option_name;
            // A settings group name. This should match the group name used in register_setting().
            settings_fields($this->option_name); // Output nonce, action, and option_page fields for a settings page
            // $page - The slug name of the page whose settings sections you want to output. This should match the page name used in add_settings_section().
            // do_settings_sections($this->slug);
            echo "<div class=\"cth-addons-tab-content\">";
            $tabs_options = $this->get_setting_tab_options('');
            if(!empty($tabs_options)){
                foreach ($tabs_options as $tab => $options) {
                    echo "<div id=\"cth-addons-tab-$tab\" class=\"cth-addons-pane cth-addons-tab-$tab".($active_tab == $tab ? ' current' : '')."\">";
                    do_settings_sections($this->slug. "-$tab");
                    echo "</div>";
                }
            }
            echo "</div>";

            submit_button();
            ?>
            </form>

        </div>
        <?php
    }
    
    function plugin_info() {
        // if(!is_admin() && is_user_logged_in() && in_array( balkon_addons_get_user_role(), balkon_addons_get_option('admin_bar_hide_roles') ) ) {
        //         show_admin_bar( false );
        //     }
        $this->option_tabs = array( 
            'general'           => esc_html__( 'General', 'balkon-add-ons' ),
            
            // 'gmap'              => esc_html__( 'Google Map', 'balkon-add-ons' ),
            
            'widgets'           => esc_html__( 'Widgets', 'balkon-add-ons' ),
            
        );
        // get option array from includes/option_values.php function
        $this->option_options = balkon_addons_get_plugin_options();
    }

}

new CTH_Class_Options();


