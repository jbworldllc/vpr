<?php
/**
 * @package Balkon - Creative  Responsive  Architecture WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date: 31-07-2019
 * @version: 1.0
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
?>
<?php if(is_page_template('homepage-onepage.php' )):?>
    <div class="scroll-init menusb balkon-sbmenu">
        <?php 
            $defaults1= array(
                'theme_location'  => 'onepage',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'balkon_onepage-sidebar-nav',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'walker'          => new Walker_Nav_Menu(),
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 0,
            );
            
            if ( has_nav_menu( 'onepage' ) ) {
                wp_nav_menu( $defaults1 );
            }
        ?>
    </div>
<?php else :?>
    <div class="menusb balkon-sbmenu <?php 
    if( balkon_global_var('show_submenu_mobile') ){
        echo ' show-sub-mobile';
    }?>">
        <?php 
            $defaults1= array(
                'theme_location'  => 'primary',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'balkon_main-nav',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'walker'          => new Walker_Nav_Menu(),
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 0,
            );
            
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( $defaults1 );
            }
        ?>
    </div>
<?php endif;?>