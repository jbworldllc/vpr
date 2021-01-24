<?php
/* Enable shortcode in widget text content */
add_filter('widget_text', 'do_shortcode');

if(!function_exists('faicon_sc')) {

    function faicon_sc( $atts, $content="" ) {
    
        extract(shortcode_atts(array(
               'name' =>"magic",
               'class'=>'',
         ), $atts));

        $name = str_replace(array("fa fa-","fa-"), "", $name);

        $classes = 'fa fa-'.$name;
        if(!empty($class)){
            $classes .= ' '.$class;
        }
        
        return '<i class="'.$classes.'"></i>'. $content;
     
    }
        
    add_shortcode( 'faicon', 'faicon_sc' ); //Icon
}
if(!function_exists('balkon_instagram_sc')){
    function balkon_instagram_sc($atts, $content = ''){

        extract(shortcode_atts(array(
               'limit' =>"6",
               'get'=>'user',//tagged
               'clientid'=>'5d9aa6ad29704bcb9e7e151c9b7afcbc',
               'access'=>'3075034521.5d9aa6a.284ff8339f694dbfac8f265bf3e93c8a',
               'userid'=>'3075034521',
               'tagged'=>'balkon',
               'resolution'=>'thumbnail',
               'columns'=>'3'
         ), $atts));

        if($get == 'tagged'){
            $getval = $tagged;
        }else if($get == 'user'){
            $getval = $userid;
        }else {
            $getval = 'popular';
        }

        ob_start();

        ?>

        <div class="cththemes-instafeed grid-cols-<?php echo esc_attr($columns );?>" data-limit="<?php echo esc_attr($limit );?>" data-get="<?php echo esc_attr($get );?>" data-getval="<?php echo esc_attr($getval );?>" data-client="<?php echo esc_attr($clientid );?>" data-access="<?php echo esc_attr($access );?>" data-res="<?php echo esc_attr($resolution );?>"><div class='cth-insta-thumb'><ul class="cththemes-instafeed-ul" id="<?php echo uniqid('cththemes-instafeed');?>"></ul></div></div>

        <?php

        $output = ob_get_clean();

        return $output;

    }

    add_shortcode( 'balkon_instagram', 'balkon_instagram_sc' ); 
}

if(!function_exists('balkon_mailchimp_sc')) {

    function balkon_mailchimp_sc( $atts, $content="" ) {
        
        extract(shortcode_atts(array(
           'class'=>'',
           'title'=>'Newsletter',
           'subtitle'=>'',
           'placeholder'=>'email',
           'button'=>'Submit',
           'list_id' => '',
        ), $atts));

        $return = '';
            
        $return .='<div class="subcribe-form fl-wrap">';
        if(!empty($title)){
            $return .='<div class="subscribe-title">'.$title.'</div>';
        }
            $return .='<form  class="balkon_mailchimp-form">';
                $return .='<input type="email"  class="enteremail" name="email" placeholder="'.$placeholder.'" required>';
                $return .='<button type="submit" class="subscribe-button">'.$button.'</button>';
                if(!empty($subtitle)){
                    $return .='<p class="subscribe-subtitle">'.$subtitle.'</p>';
                }
                $return .='<label class="subscribe-message"></label>';
                // this prevent automated script for unwanted spam
                if ( function_exists( 'wp_create_nonce' ) ) {
                    $return .='<input type="hidden" name="_wpnonce" value="'.wp_create_nonce( 'balkon_mailchimp' ).'">';
                }

            if($list_id != '') $return .='<input type="hidden" name="mailchimp_list_id" value="'.$list_id.'">';

            $return .='</form>';
        
        $return .='</div>';
        return $return;
    }
        
    add_shortcode( 'balkon_mailchimp', 'balkon_mailchimp_sc' ); //Mailchimp

}
