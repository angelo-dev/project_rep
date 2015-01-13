<?php 
	/**
 * Adds Foo_Widget widget.
 */
class Custom_Text_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'custom_text_widget', // Base ID
			__( 'Custom Text', 'text_domain' ), // Name
			array( 'description' => __( 'A Custom Text Widget', 'text_domain' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title']);
		$head_icon = $instance['head_icon'];
		$content_text = $instance['content_text'];
		$link_text = $instance['link_text'];
		$link =	$instance['link'];
		// $img = '<img class="tooth-icon" src="'.$head_icon.'" alt="tooth-icon">';
		$img = '<span class="tooth-icon" style="background: url('.$head_icon.') no-repeat center center;"></span>';
 		echo $args['before_widget'];
		if ( ! empty( $title ) ) {

			echo $args['before_title'] . $title. $args['after_title'];
			echo $img;
		}
		echo '<div class="textwidget">'.$content_text.'</div>';
		echo '<div class="bottom-link"><a href="'.$link.'" target="_blank" title="Read more about '.$title.'">'.$link_text.'</a></div>';
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = !empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		$head_icon = $instance['head_icon'];
		$content_text = $instance['content_text'];
		$link_text = $instance['link_text'];
		$link =	$instance['link'];
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'head_icon' ); ?>"><?php _e( 'Image:' ); ?></label> 
        <input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'head_icon' ); ?>" name="<?php echo $this->get_field_name( 'head_icon' ); ?>" type="text" value="<?php echo esc_attr( $head_icon ); ?>">
        <img class="custom_media_image" src="<?php echo esc_attr( $head_icon ); ?>" width="40" height="40" />

    	<input type="button" value="Upload Image" class="button custom_media_upload" />
		</p>
		<p>
		<textarea rows="16" cols="20" class="widefat" id="<?php echo $this->get_field_id( 'content_text' ); ?>" name="<?php echo $this->get_field_name( 'content_text' ); ?>"><?php echo esc_attr( $content_text ); ?></textarea>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'link_text' ); ?>"><?php _e( 'Button label:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'link_text' ); ?>" name="<?php echo $this->get_field_name( 'link_text' ); ?>" type="text" value="<?php echo esc_attr( $link_text ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'URL:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['head_icon'] =  $new_instance['head_icon'];
		$instance['content_text'] =  $new_instance['content_text'];
		$instance['link_text'] =  $new_instance['link_text'];
		$instance['link'] =  $new_instance['link'];

		return $instance;
	}

} // class Custom_Text_Widget
// register Foo_Widget widget
function register_foo_widget() {
    register_widget( 'Custom_Text_Widget' );
}
add_action( 'widgets_init', 'register_foo_widget' );

function thg_media_uploader(){
  wp_enqueue_media();
  wp_enqueue_script('thg_media_uploader', get_stylesheet_directory_uri() . '/js/thg-media-uploader.js');
}
add_action('admin_enqueue_scripts', 'thg_media_uploader');
