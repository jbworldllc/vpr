<?php
/* add_ons_php */

add_action('wp_ajax_nopriv_balkon_mailchimp', 'balkon_mailchimp_subscribe_callback');
add_action('wp_ajax_balkon_mailchimp', 'balkon_mailchimp_subscribe_callback');

/*
 *  @desc   Register user
*/
require_once CTH_ABSPATH .'/inc/classes/Drewm/CTHMailChimp.php';
function balkon_mailchimp_subscribe_callback() {
    $output = array();
    $output['success'] = 'no';

    if ( ! isset( $_POST['balkon_mailchimp_nonce'] ) || ! wp_verify_nonce( $_POST['balkon_mailchimp_nonce'], 'balkon_mailchimp_action' ) ){
        $output['message'] = esc_html__('Sorry, your nonce did not verify.','balkon-add-ons' );
        wp_send_json( $output );
    }
    if(isset($_POST['mailchimp_list_id'])&& $_POST['mailchimp_list_id']){
        $list_id = $_POST['mailchimp_list_id'];
    }else{
        $list_id = balkon_get_option('mailchimp_list_id') ;
    }

    /*
     * ------------------------------------
     * Mailchimp Email Configuration
     * ------------------------------------
     */
    $MailChimp = new CTH_MailChimp(balkon_get_option('mailchimp_api'));

    $result = $MailChimp->post("lists/$list_id/members", array(
        'email_address' => $_POST['email'],
        'status'        => 'subscribed'
    ) );

    if ($MailChimp->success()) {
        $output['success'] = 'yes';
        $output['message'] = esc_html__('Almost finished. Please check your email and verify.','balkon-add-ons' );
        $output['last_response'] = $MailChimp->getLastResponse();
    } else {
        $output['message'] = esc_html__('Oops. Something went wrong!','balkon-add-ons' );
        $output['last_response'] = $MailChimp->getLastResponse();
    }

    wp_send_json( $output );
}

add_action('wp_ajax_nopriv_balkon_get_vc_attach_images', 'balkon_get_vc_attach_images_callback');
add_action('wp_ajax_balkon_get_vc_attach_images', 'balkon_get_vc_attach_images_callback');

function balkon_get_vc_attach_images_callback() {
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
