<?php
/* add_ons_php */
/**
 * Shortcode attributes
 * @var $atts
 * @var $css
 * @var $el_class
 * @var $partnerimgs
 * @var $target
 * @var $columns
 * @var $parallax_value
 * @var $content - shortcode content
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Balkon_Clients
 */
$el_class = $partnerimgs = $parallax_value = $columns = $target = $css = $thumbnail_size = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = array(
    'clients-list fl-wrap',
    'clients-'.$columns.'-cols',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
if(!empty($partnerimgs)){
    $partners = $partnerlinks = array();
    $partners = explode(",", $partnerimgs);
    if(!empty($content)){
        $seppos = strpos(strip_tags($content), "|");
        if($seppos !== false){
            $partnerlinks = explode("|", strip_tags($content));
        }else{
            $partnerlinks = preg_split( '/\r\n|\r|\n/', strip_tags($content) );
        }
    }

    if( strpos($thumbnail_size, "x") !== false){
        $thumbnail_size = explode("x", $thumbnail_size);
    }

    ?>

    <div class="<?php echo esc_attr($css_class ); ?>">
        <ul>
        <?php foreach ($partners as $key => $img) { ?>
            <?php if(isset($partnerlinks[$key])) :?>
                <li><a href="<?php echo esc_url($partnerlinks[$key] );?>" target="<?php echo esc_attr($target );?>">
            <?php else : ?>
                <li><a href="javascript:void(0)">
            <?php endif;?>
                    <?php echo wp_get_attachment_image( $img, $thumbnail_size, false, array('class'=>'respimg') );?>
                </a></li>
        <?php } ?>
        </ul>
    </div>

<?php } ?>