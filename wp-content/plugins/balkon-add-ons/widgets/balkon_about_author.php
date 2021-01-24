<?php
/**
 * Widget API: Balkon_About_Author class
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
class Balkon_About_Author extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 1.3.1
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'balkon_about_author', 'description' => __( "Balkon about author widget",'balkon-add-ons') );
		// Add Widget scripts
   		add_action('admin_enqueue_scripts', array($this, 'scripts'));
 
		parent::__construct('balkon-about-author', __('Balkon Author','balkon-add-ons'), $widget_ops);
		$this->alt_option_name = 'balkon_about_author';
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'About Author' ,'balkon-add-ons');

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$au_text = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$au_name = ! empty( $instance['au_name'] ) ? $instance['au_name'] : '';

		$au_photo = ! empty( $instance['au_photo'] ) ? $instance['au_photo'] : '';
		$au_sig = ! empty( $instance['au_sig'] ) ? $instance['au_sig'] : '';


		$text = apply_filters( 'balkon_author_widget_text', $au_text, $instance, $this );

		?>

		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>

			<div class="about-widget">
			<?php if($au_photo): ?>
	      		<img src="<?php echo esc_url($au_photo); ?>" class="respimg" alt="<?php esc_attr_e('author photo','balkon-add-ons' );?>">
	   		<?php endif;?>
	   		<?php if($au_name): ?>
	            <h4><?php echo esc_html($au_name); ?></h4>
	        <?php endif;?>
	            <?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
	        <?php if($au_sig): ?>
	      		<div class="signature"><img src="<?php echo esc_url($au_sig); ?>" alt="<?php esc_attr_e('author signature','balkon-add-ons' );?>"></div>
	   		<?php endif;?>
	        </div>

        <?php echo $args['after_widget']; ?>

	<?php

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

		$instance['au_photo'] = ( ! empty( $new_instance['au_photo'] ) ) ? $new_instance['au_photo'] : '';
		$instance['au_sig'] = ( ! empty( $new_instance['au_sig'] ) ) ? $new_instance['au_sig'] : '';

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = wp_kses_post( $new_instance['text'] );
		}

		$instance['au_name'] = ( ! empty( $new_instance['au_name'] ) ) ? $new_instance['au_name'] : '';

		$instance['filter'] = ! empty( $new_instance['filter'] );

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

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '','au_photo' => '', 'au_sig' => '') );

		$title     = sanitize_text_field( $instance['title'] );
		$au_photo = ! empty( $instance['au_photo'] ) ? $instance['au_photo'] : '';
		$au_sig = ! empty( $instance['au_sig'] ) ? $instance['au_sig'] : '';

		

		$au_name = isset( $instance['au_name'] ) ? $instance['au_name'] : '';
		$filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'balkon-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p>
      	<label for="<?php echo $this->get_field_id( 'au_photo' ); ?>"><?php _e( 'Author Photo:','balkon-add-ons' ); ?></label>
      	<input class="widefat" id="<?php echo $this->get_field_id( 'au_photo' ); ?>" name="<?php echo $this->get_field_name( 'au_photo' ); ?>" type="text" value="<?php echo esc_url( $au_photo ); ?>" />
      	<br>
      	<button class="balkon_author_upload_image_button button button-primary"><?php _e('Upload Image','balkon-add-ons');?></button>
   		</p>

   		

   		<p><label for="<?php echo $this->get_field_id( 'au_name' ); ?>"><?php _e( 'Author Name:' ,'balkon-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'au_name' ); ?>" name="<?php echo $this->get_field_name( 'au_name' ); ?>" type="text" value="<?php echo $au_name; ?>" /></p>


		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Author Description:' ,'balkon-add-ons'); ?></label>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

   		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs','balkon-add-ons'); ?></label></p>
		
		<p>
      	<label for="<?php echo $this->get_field_id( 'au_sig' ); ?>"><?php _e( 'Author Signature:' ,'balkon-add-ons'); ?></label>
      	<input class="widefat" id="<?php echo $this->get_field_id( 'au_sig' ); ?>" name="<?php echo $this->get_field_name( 'au_sig' ); ?>" type="text" value="<?php echo esc_url( $au_sig ); ?>" />
      	<br>
      	<button class="balkon_author_upload_image_button button button-primary"><?php _e('Upload Image','balkon-add-ons');?></button>
   		</p>
<?php
	}
}
