<?php
/**
 * Widget API: Balkon_Banner class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 1.3.1
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 1.3.1
 *
 * @see WP_Widget
 */
class Balkon_Banner extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 1.3.1
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'balkon_banner', 'description' => __( "Balkon banner widget",'balkon-add-ons') );
		// Add Widget scripts
   		add_action('admin_enqueue_scripts', array($this, 'scripts'));
 
		parent::__construct('balkon-banner', __('Balkon Banner','balkon-add-ons'), $widget_ops);
		$this->alt_option_name = 'balkon_banner';
	}

	public function scripts()
	{
	   	wp_enqueue_script( 'media-upload' );
	   	wp_enqueue_media();
	   	wp_enqueue_script('balkon_au_wid_js', CTH_DIR_URL . 'assets/admin/balkon_au_wid_js.js', array('jquery'));
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 1.3.1
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Banner widget' ,'balkon-add-ons');

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$banner_img = ! empty( $instance['banner_img'] ) ? $instance['banner_img'] : '';
		$banner_link = ! empty( $instance['banner_link'] ) ? $instance['banner_link'] : '';
		if(!empty($banner_img)) :
		?>

		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>

			<div class="banner-widget">

			<?php if(!empty($banner_link)) :?>
			<a href="<?php echo esc_url($banner_link );?>" <?php echo !empty( $instance['show_in_new_tab'] ) ? 'target="_blank"' : 'target="_self"'; ?>>
			<?php endif;?>

	      		<img src="<?php echo esc_url($banner_img); ?>" class="respimg">

	   		<?php if(!empty($banner_link)) :?>
			</a>
			<?php endif;?>

	        </div>

        <?php echo $args['after_widget']; ?>

	<?php

		endif;

	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 1.3.1
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		$instance['banner_img'] = ( ! empty( $new_instance['banner_img'] ) ) ? $new_instance['banner_img'] : '';

		$instance['banner_link'] = ( ! empty( $new_instance['banner_link'] ) ) ? $new_instance['banner_link'] : '';

		$instance['show_in_new_tab'] = ! empty( $new_instance['show_in_new_tab'] );

		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 1.3.1
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'banner_img' => '') );

		$title     = sanitize_text_field( $instance['title'] );
		$banner_img = ! empty( $instance['banner_img'] ) ? $instance['banner_img'] : '';
		
		$banner_link = isset( $instance['banner_link'] ) ? $instance['banner_link'] : '';
		$show_in_new_tab = isset( $instance['show_in_new_tab'] ) ? $instance['show_in_new_tab'] : 1;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'balkon-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p>
      	<label for="<?php echo $this->get_field_id( 'banner_img' ); ?>"><?php _e( 'Photo:','balkon-add-ons' ); ?></label>
      	<input class="widefat" id="<?php echo $this->get_field_id( 'banner_img' ); ?>" name="<?php echo $this->get_field_name( 'banner_img' ); ?>" type="text" value="<?php echo esc_url( $banner_img ); ?>" />
      	<br>
      	<button class="balkon_author_upload_image_button button button-primary"><?php _e('Upload Image','balkon-add-ons');?></button>
   		</p>

   		<p><label for="<?php echo $this->get_field_id( 'banner_link' ); ?>"><?php _e( 'Link:' ,'balkon-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'banner_link' ); ?>" name="<?php echo $this->get_field_name( 'banner_link' ); ?>" type="text" value="<?php echo $banner_link; ?>" /></p>


   		<p><input id="<?php echo $this->get_field_id('show_in_new_tab'); ?>" name="<?php echo $this->get_field_name('show_in_new_tab'); ?>" type="checkbox"<?php checked( $show_in_new_tab ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('show_in_new_tab'); ?>"><?php _e('Open in new tab','balkon-add-ons'); ?></label></p>

<?php
	}
}
