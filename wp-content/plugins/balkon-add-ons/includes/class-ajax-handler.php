<?php 
/* add_ons_php */

defined( 'ABSPATH' ) || exit;

class CTH_Class_Ajax_Handler{

    public static function init(){ 
        $ajax_actions = array(
            'balkon_mailchimp',
            'balkon_get_vc_attach_images'
        );
        foreach ($ajax_actions as $action) {
            $funname = str_replace('balkon_addons_', '', $action);
            $funname = str_replace('balkon_', '', $funname);
            add_action('wp_ajax_nopriv_'.$action, array( __CLASS__, $funname )); 
            add_action('wp_ajax_'.$action, array( __CLASS__, $funname ));
        }
    }

    public static function verify_nonce($action_name = ''){
        if (!isset($_REQUEST['_wpnonce']) || $action_name == '' || ! wp_verify_nonce( $_REQUEST['_wpnonce'], $action_name ) ){
            wp_send_json( array(
                'success'   => false,
                'error'     => esc_html__( 'Security checked!, Cheatn huh?', 'balkon-add-ons' ),
                'last_response'     => esc_html__( 'Security checked!, Cheatn huh?', 'balkon-add-ons' ),
                'message'     => esc_html__( 'Security checked!, Cheatn huh?', 'balkon-add-ons' )
            ) );
        }

    }

    public static function mailchimp() {
        require_once CTH_ABSPATH .'inc/classes/Drewm/CTHMailChimp.php';

        $output = array(
            'success'   => false
        );
        self::verify_nonce('balkon_mailchimp');

        if(isset($_POST['_list_id'])&& $_POST['_list_id']){
            $list_id = $_POST['_list_id'];
        }else{
            $list_id = balkon_addons_get_option('mailchimp_list_id'); 
        }

        /*
         * ------------------------------------
         * Mailchimp Email Configuration
         * ------------------------------------
         */
        $MailChimp = new CTH_MailChimp( balkon_addons_get_option('mailchimp_api') );

        $result = $MailChimp->post("lists/$list_id/members", array(
            'email_address' => $_POST['email'],
            'status'        => 'subscribed'
        ) );

        if ($MailChimp->success()) {
            $output['success'] = true;
            $output['message'] = esc_html__('Almost finished. Please check your email and verify.','balkon-add-ons' );
            $output['last_response'] = $MailChimp->getLastResponse();
        } else {
            $output['message'] = esc_html__('Oops. Something went wrong!','balkon-add-ons' );
            $output['last_response'] = $MailChimp->getLastResponse();
        }

        wp_send_json( $output );
    }
    public static function get_vc_attach_images() {
        $images = $_POST['images'];
        $html = $images;
        if($images != '') {
            $images = explode(",", $images);
            if(count($images)){
                $html = '';
                foreach ($images as $key => $img) {
                    $html .= wp_get_attachment_image( $img, 'thumbnail', '', array('class'=>'balkon-ele-attach-thumb') );
                }
            }
        }
        wp_send_json($html );
    }
}   
    

CTH_Class_Ajax_Handler::init();