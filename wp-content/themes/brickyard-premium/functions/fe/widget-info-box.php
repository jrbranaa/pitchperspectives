<?php
/**
 * Plugin Name: BrickYard Info-Box Widget
 * Description: Displays a box with your custom text and link.
 * Author: Tomas Toman	
 * Version: 1.0
*/

add_action('widgets_init', create_function('', 'return register_widget("brickyard_info_box");'));
class brickyard_info_box extends WP_Widget {
	function brickyard_info_box() {
		$widget_ops = array('classname' => 'homepage-info-box', 'description' => __('Displays a box with your custom text and icon.', 'brickyard') );
		$control_ops = array('width' => 200, 'height' => 400);
		$this->WP_Widget('infobox', __('BrickYard Info-Box', 'brickyard'), $widget_ops, $control_ops);
	}
	function form($instance) {
		// outputs the options form on admin
    if ( $instance ) {
			$icon = esc_attr( $instance[ 'icon' ] );
		}
		else {
			$icon = __( '', 'brickyard' );
		}
    
    if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}
		else {
			$title = __( '', 'brickyard' );
		} 

	  if ( $instance ) {
			$content = esc_attr( $instance[ 'content' ] );
		}
		else {
			$content = __( '', 'brickyard' );
		} ?>
<!-- Icon -->
<p>
	<label for="<?php echo $this->get_field_id('icon'); ?>">
		<?php _e('Icon:', 'brickyard'); ?>
	</label>
  <select class="widefat" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>">
   <option value="info-basket"><?php _e('Basket', 'brickyard'); ?></option>
   <option value="info-book"><?php _e('Book', 'brickyard'); ?></option>
   <option value="info-calendar"><?php _e('Calendar', 'brickyard'); ?></option>
   <option value="info-comments"><?php _e('Comments', 'brickyard'); ?></option>
   <option value="info-download"><?php _e('Download', 'brickyard'); ?></option>
   <option value="info-envelope"><?php _e('Envelope', 'brickyard'); ?></option>
   <option value="info-globe"><?php _e('Globe', 'brickyard'); ?></option>
   <option value="info-heart"><?php _e('Heart', 'brickyard'); ?></option>
   <option value="info-home"><?php _e('Home', 'brickyard'); ?></option>
   <option value="info-notepad"><?php _e('Notepad', 'brickyard'); ?></option>
   <option value="info-pin"><?php _e('Pin', 'brickyard'); ?></option>
   <option value="info-star"><?php _e('Star', 'brickyard'); ?></option>
   <option value="info-tick"><?php _e('Tick', 'brickyard'); ?></option>
   <option value="info-user"><?php _e('User', 'brickyard'); ?></option>
   <option value=""><?php _e('none', 'brickyard'); ?></option>
 </select>
<p style="font-size: 10px; color: #999; margin: 0; padding: 0px;">
	<?php _e('Select an icon which will be displayed beside the title.', 'brickyard'); ?>
</p>
</p>
<!-- Title -->
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('Title:', 'brickyard'); ?>
	</label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<!-- Content -->
<p>
	<label for="<?php echo $this->get_field_id('content'); ?>">
		<?php _e('Text:', 'brickyard'); ?>
	</label>
  <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>
</p> 
<?php } 

function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
    $instance['icon'] = $new_instance['icon'];
    $instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['content'] = esc_textarea($new_instance['content']);
	return $instance;
	}

function widget($args, $instance) {
		// outputs the content of the widget
		 extract( $args );
      $icon = apply_filters('widget_icon', $instance['icon']);
      $title = apply_filters('widget_title', $instance['title']);
			$content = apply_filters('widget_content', $instance['content']); ?>
<?php echo $before_widget; ?>
      <div class="info-box">
<?php if ( $icon != ''  ) { ?>
        <div class="info-box-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/info-box/<?php echo $icon; ?>.png" alt="icon" /></div>
<?php } ?>
        <p class="info-box-headline"><?php echo $title; ?></p>
        <p class="info-box-content"><?php echo $content; ?></p>
      </div>
<?php echo $after_widget; ?>
<?php
	}
}
?>