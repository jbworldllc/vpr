<?php
/* add_ons_php */
if(!function_exists('balkon_get_post_views')){
    function balkon_get_post_views($postID){
        $count_key = '_balkon_post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0";
        }
        return $count;
    }
}

if(!function_exists('balkon_set_post_views')){
    function balkon_set_post_views($postID) {
        $count_key = '_balkon_post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}
