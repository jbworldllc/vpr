<?php
/* add_ons_php */

function balkon_addons_get_plugin_options(){ 
    return array(
        'general' => array(
            array(
                "type" => "section",
                'id' => 'general_design_opts',
                "title" => __( 'General Options', 'balkon-add-ons' ),    
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'general_field',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('General option field', 'balkon-add-ons'),  
                'desc'  => '',
            ),

        ),

        'widgets' => array(


            array(
                "type" => "section",
                'id' => 'mailchimp_sub_section',
                "title" => __( 'Mailchimp Section', 'balkon-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'mailchimp_api',
                "title" => __('Mailchimp API key', 'balkon-add-ons'),
                'desc'  => '<a href="'.esc_url('http://kb.mailchimp.com/accounts/management/about-api-keys#Finding-or-generating-your-API-key').'" target="_blank">'.esc_html__('Find your API key','balkon-add-ons' ).'</a>'
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'mailchimp_list_id',
                "title" => __('Mailchimp List ID', 'balkon-add-ons'),
                'desc'  => '<a href="'.esc_url('http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id').'" target="_blank">'.esc_html__('Find your list ID','balkon-add-ons' ).'</a>',
            ),
        
            array(
                "type" => "field",
                "field_type" => "info",
                'id' => 'mailchimp_shortcode',
                "title" => __('Subscribe Shortcode', 'balkon-add-ons'),
                'desc'  => wp_kses_post( __('Use the <code><strong>[balkon_subscribe]</strong></code> shortcode  to display subscribe form inside a post, page or text widget.
                    <br>Available Variables:<br>
                    <code><strong>message</strong></code> (Optional) - The message above subscription form.<br>
                    <code><strong>placeholder</strong></code> (Optional) - The form placeholder text.<br>
                    <code><strong>button</strong></code> (Optional) - The submit button text.<br>
                    <code><strong>list_id</strong></code> (Optional) - List ID. If you want user subscribe to a different list from the option above.<br>
                    <code><strong>class</strong></code> (Optional) - Your extraclass used to style the form.<br><br>
                    Example: <code><strong>[balkon_subscribe list_id="b02fb5f96f" class="your_class_here"]</strong></code>', 'balkon-add-ons') )
                                    
            ),
//             array(
//                 "type" => "section",
//                 'id' => 'tweets_section',
//                 "title" => __( 'Twitter Feeds Section', 'balkon-add-ons' ),
//                 'callback' => function($arg){ 
//                     echo '<p>'.esc_html__('Visit ','balkon-add-ons' ).
//                         '<a href="'.esc_url('https://apps.twitter.com' ).'" target="_blank">'.esc_html__("Twitter's Application Management",'balkon-add-ons' ).'</a> '
//                         .__('page, sign in with your account, click on Create a new application and create your own keys if you haven\'t one.<br> Fill all the fields bellow with those keys.','balkon-add-ons' ).
//                         '</p>';  
//                 }
//             ),

//             array(
//                 "type" => "field",
//                 "field_type" => "text",
//                 'id' => 'consumer_key',
//                 "title" => __('Consumer Key', 'balkon-add-ons'),
//                 'desc'  => ''
//             ),
//             array(
//                 "type" => "field",
//                 "field_type" => "text",
//                 'id' => 'consumer_secret',
//                 "title" => __('Consumer Secret', 'balkon-add-ons'),
//                 'desc'  => ''
//             ),
//             array(
//                 "type" => "field",
//                 "field_type" => "text",
//                 'id' => 'access_token',
//                 "title" => __('Access Token', 'balkon-add-ons'),
//                 'desc'  => ''
//             ),
//             array(
//                 "type" => "field",
//                 "field_type" => "text",
//                 'id' => 'access_token_secret',
//                 "title" => __('Access Token Secret', 'balkon-add-ons'),
//                 'desc'  => ''
//             ),
//             array(
//                 "type" => "field",
//                 "field_type" => "info",
//                 'id' => 'tweets_shortcode',
//                 "title" => __('Access Token Secret', 'balkon-add-ons'),
//                 'desc'  => wp_kses_post( __('You can use <code><strong>Balkon Twitter Feed</strong></code> widget or  <code><strong>[balkon_tweets]</strong></code> shortcode  to display tweets inside a post, page or text widget.
// <br>Available Variables:<br>
// <code><strong>username</strong></code> (Optional) - Option to load tweets from another account. Leave this empty to load from your own.<br>
// <code><strong>list</strong></code> (Optional) - List name to load tweets from. If you define list name you also must define the <strong>username</strong> of the list owner.<br>
// <code><strong>hashtag</strong></code> (Optional) - Option to load tweets with a specific hashtag.<br>
// <code><strong>count</strong></code> (Required) - Number of tweets you want to display.<br>
// <code><strong>list_ticker</strong></code> (Optional) - Display tweets as a list ticker?. Values: <strong>yes</strong> or <strong>no</strong><br>
// <code><strong>follow_url</strong></code> (Optional) - Follow us link.<br>
// <code><strong>extraclass</strong></code> (Optional) - Your extraclass used to style the form.<br><br>
// Example: <code><strong>[balkon_tweets count="3" username="CTHthemes" list_ticker="no" extraclass="your_class_here"]</strong></code>', 'balkon-add-ons') )
                
//             ),
//             // socials share
//             array(
//                 "type" => "section",
//                 'id' => 'widgets_section_3',
//                 "title" => __( 'Socials Share', 'balkon-add-ons' ),
//             ),
//             array(
//                 "type" => "field",
//                 "field_type" => "text",
//                 'id' => 'widgets_share_names',
//                 "title" => __('Socials Share', 'balkon-add-ons'),
//                 'desc'  => __('Enter your social share names separated by a comma.<br> List bellow are available names:<strong><br> facebook,twitter,linkedin,in1,tumblr,digg,googleplus,reddit,pinterest,stumbleupon,email,vk</strong>', 'balkon-add-ons'),
//                 'args'=> array(
//                     'default' => 'facebook, pinterest, googleplus, twitter, linkedin'
//                 ),
//             ),


        ),
        // end tab array


    );
}