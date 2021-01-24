<?php

/**
 *
 * @package Balkon - Responsive Architecture Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 31-07-2019
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

if (!function_exists('balkon_hex2rgb')) {
    function balkon_hex2rgb($hex) {
        
        $hex = str_replace("#", "", $hex);
        
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } 
        else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }
}
if (!function_exists('balkon_colourBrightness')) {
    
    /*
     * $hex = '#ae64fe';
     * $percent = 0.5; // 50% brighter
     * $percent = -0.5; // 50% darker
    */
    function balkon_colourBrightness($hex, $percent) {
        
        // Work out if hash given
        $hash = '';
        if (stristr($hex, '#')) {
            $hex = str_replace('#', '', $hex);
            $hash = '#';
        }
        
        /// HEX TO RGB
        $rgb = balkon_hex2rgb($hex);
        
        //// CALCULATE
        for ($i = 0; $i < 3; $i++) {
            
            // See if brighter or darker
            if ($percent > 0) {
                
                // Lighter
                $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
            } 
            else {
                
                // Darker
                $positivePercent = $percent - ($percent * 2);
                $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
            }
            
            // In case rounding up causes us to go to 256
            if ($rgb[$i] > 255) {
                $rgb[$i] = 255;
            }
        }
        
        //// RBG to Hex
        $hex = '';
        for ($i = 0; $i < 3; $i++) {
            
            // Convert the decimal digit to hex
            $hexDigit = dechex($rgb[$i]);
            
            // Add a leading zero if necessary
            if (strlen($hexDigit) == 1) {
                $hexDigit = "0" . $hexDigit;
            }
            
            // Append to the hex string
            $hex.= $hexDigit;
        }
        return $hash . $hex;
    }
}
if (!function_exists('balkon_bg_png')) {
    function balkon_bg_png($color, $input, $output) {
        $image = imagecreatefrompng($input);
        $rgbs = balkon_hex2rgb($color);
        $background = imagecolorallocate($image, $rgbs[0], $rgbs[1], $rgbs[2]);
        
        imagepng($image, $output);
    }
}

if (!function_exists('balkon_stripWhitespace')) {
    
    /**
     * Strip whitespace.
     *
     * @param  string $content The CSS content to strip the whitespace for.
     * @return string
     */
    function balkon_stripWhitespace($content) {
        
        // remove leading & trailing whitespace
        $content = preg_replace('/^\s*/m', '', $content);
        $content = preg_replace('/\s*$/m', '', $content);
        
        // replace newlines with a single space
        $content = preg_replace('/\s+/', ' ', $content);
        
        // remove whitespace around meta characters
        // inspired by stackoverflow.com/questions/15195750/minify-compress-css-with-regex
        $content = preg_replace('/\s*([\*$~^|]?+=|[{};,>~]|!important\b)\s*/', '$1', $content);
        $content = preg_replace('/([\[(:])\s+/', '$1', $content);
        $content = preg_replace('/\s+([\]\)])/', '$1', $content);
        $content = preg_replace('/\s+(:)(?![^\}]*\{)/', '$1', $content);
        
        // whitespace around + and - can only be stripped in selectors, like
        // :nth-child(3+2n), not in things like calc(3px + 2px) or shorthands
        // like 3px -2px
        $content = preg_replace('/\s*([+-])\s*(?=[^}]*{)/', '$1', $content);
        
        // remove semicolon/whitespace followed by closing bracket
        $content = preg_replace('/;}/', '}', $content);
        
        return trim($content);
    }
}

if (!function_exists('balkon_add_rgba_background_inline_style')) {
    function balkon_add_rgba_background_inline_style($color = '#ed5153', $handle = 'skin') {
        $inline_style = '.testimoni-wrapper,.pricing-wrapper,.da-thumbs li  article,.team-caption,.home-centered{background-color:rgba(' . implode(",", hex2rgb($color)) . ', 0.9);}';
        wp_add_inline_style($handle, $inline_style);
    }
}

if (!function_exists('balkon_overridestyle')) {
    function balkon_overridestyle() {
        global $balkon_options;
        
$inline_style = 'body , .loader , footer.content-footer , #subscribe-button, .subcribe-form .subscribe-button , .to-top , .fixed-filter-wrap .count-folio{background-color:' . $balkon_options['main-bg-color'] . ';}';

$inline_style .= 'header.main-header  , .main-footer , .share-wrapper , .footer-inner  , .content-footer:before  , .fs-gallery-wrap .swiper-pagination , .content-nav , .sidebar-menu{
    background-color:' . $balkon_options['theme-bg-color-2'] . ';
}';

$inline_style .= 'header.main-header , .fixed-title , .footer-social , .show-search , .show-share-wrap  , .main-footer , .share-wrapper , .share-icon , .policy-box  , .social-wrap , .social-wrap ul li , .social-wrap ul li:last-child , .fs-gallery-wrap .swiper-pagination , .content-nav , .content-nav li  , .sb-menu-button-wrap, .nav-button-wrap , .menufilter   , .fixed-filter-wrap .gallery-filters , .vis-por-info .grid-item, .hid-por-info .grid-item {

    border-color:' . $balkon_options['theme-bd-color']['rgba'] . ';

}
.movingBallLineG , .footer-header:before , .sb-menu-footer:before , .hid-por-info .grid-item:before, .vis-por-info .grid-item:before, .hid-por-info .grid-item:after, .vis-por-info .grid-item:after , .grid-item h3:before , nav li a.act-link:before, nav.asl li a.act-scrlink:before {
    background-color:' . $balkon_options['theme-bd-color']['rgba'] . ';
}
.show-search:before,
.show-share-wrap div  span:before,
.movingBallG , .list a i  , .sb-menu-button span, .nav-button span , .fixed-filter-wrap .bold-separator{
    background-color:' . $balkon_options['theme-bg-color-3'] . ';
}
body {color:'.$balkon_options['body-text-color'].';}
a {color:'.$balkon_options['hyperlink-text-color']['regular'].';}
a:hover {color:'.$balkon_options['hyperlink-text-color']['hover'].';}
a:active,a:focus {color:'.$balkon_options['hyperlink-text-color']['active'].';}
p {color:'.$balkon_options['paragraph-color'].';}

.nav-holder nav li a , .footer-social li a , .show-search , .show-share-wrap , .fixed-title  , .share-icon:hover , .footer-header span , .footer-header , .footer-box ul li a, .footer-widget ul li a , .policy-box  , .subcribe-form span, .subcribe-form  .subscribe-title , .social-wrap ul li a , .slider-wrap .sw-button, .fs-gallery-wrap .sw-button , .fs-gallery-wrap .swiper-pagination-bullet , .single-slider .swiper-pagination  , .content-nav li a , .content-nav li a.ln span.tooltip, .content-nav li a.rn span.tooltip , .content-nav li a.ln i, .content-nav li a.rn i, .customNavigation a i, .content-nav li a span.tooltip , .content-nav li a.cur-page span , .slider-wrap .gallery-popup, .fs-gallery-wrap .gallery-popup , .box-item a.popup-image  , .header-info li a , .menusb a , .sb-menu-footer , .menufilter .filter-button  , .fixed-filter-wrap h3 , .fixed-filter-wrap .gallery-filters a  , .fixed-filter-wrap .count-folio , .grid-item h3 a , .grid-item h3:after , .nav-holder nav ul li.lidec:before{
    color:' . $balkon_options['theme-color'] . ';
}
header.balkon-header {background-color:' . $balkon_options['header-color']['rgba'] . ';}
.main-footer {background-color: ' . $balkon_options['left-sidebar-bg-color']['rgba'] . ';}
nav li ul {background-color:' . $balkon_options['submenu-bg-color']['rgba'] . ';}
footer.content-footer .footer-inner {background-color:' . $balkon_options['footer-bg-color']['rgba'] . ';}





.nav-holder nav li a,.nav-holder nav li a:focus {color:' . $balkon_options['main-nav-menu-color']['regular'] . ';}
.nav-holder nav li a:hover {color:' . $balkon_options['main-nav-menu-color']['hover'] . ';}
.nav-holder nav li a.ancestor-act-link, .nav-holder nav li a.parent-act-link, .nav-holder nav li a.act-link  {color:' . $balkon_options['main-nav-menu-color']['active'] . ';}
.nav-holder nav li ul a,.nav-holder nav li ul a:focus {color:' . $balkon_options['submenu-color']['regular'] . ';}
.nav-holder nav li ul a:hover {color:' . $balkon_options['submenu-color']['hover'] . ';}
.nav-holder nav li ul li a.ancestor-act-link,.nav-holder nav li ul li a.parent-act-link,.nav-holder nav li ul li a.act-link {color:' . $balkon_options['submenu-color']['active'] . ';}
';
        
        // Remove whitespace
        $inline_style = balkon_stripWhitespace($inline_style);
        
        return $inline_style;
    }
}
