<?php
/*
* Plugin Name: WS Twitter Follow Button
* Plugin URI: https://wordpress.org/plugins/ws-twitter-follow-button/
* Description: WS Twitter Follow Button plugin provides a small button displayed on your websites to help users easily follow a Twitter account. 
* Author: WebShouters
* Author URI: http://www.webshouters.com/
* Version: 1.0
* Text Domain: ws-twitter-follow-button
* License: GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

class WS_Twitter_Follow_Button_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ws_twitter_follow_button_widget',
            __( 'WS Twitter Follow Button', 'ws-twitter-follow-button' ),
            array(
                'classname'   => 'ws_twitter_follow_button_widget',
                'description' => __( 'Add twitter follow button to your website.', 'ws-twitter-follow-button' )
                )
        );
       
        load_plugin_textdomain( 'ws-twitter-follow-button', false, basename( dirname( __FILE__ ) ) . '/languages' );
       
    }
 
    /**  
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {    
         
        extract( $args );
         
        $title = apply_filters( 'widget_title', $instance['title'] );
		$ws_twfb_username= $instance['ws_twfb_username'];
		$ws_twfb_count= $instance['ws_twfb_count'];
		$ws_twfb_show_username = $instance['ws_twfb_show_username'];
		$ws_twfb_button_size = $instance['ws_twfb_button_size'];
		$ws_twfb_tailoring = $instance['ws_twfb_tailoring'];
         
        echo $before_widget;
         
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
		
		if ( !empty( $ws_twfb_username ) ) {

		?>
		
		<div class="ws_twitter_follow_button_wrap">
			<a href="http://twitter.com/<?php echo $ws_twfb_username; ?>" class="twitter-follow-button" data-show-count="<?php echo $ws_twfb_count; ?>" data-size="<?php echo $ws_twfb_button_size; ?>" data-show-screen-name="<?php echo $ws_twfb_show_username; ?>" data-dnt="<?php echo $ws_twfb_tailoring; ?>" >Follow @<?php echo $ws_twfb_username; ?></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
		
		<?php                     
        
        }

        echo $after_widget;
         
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
         
        $instance = $old_instance;
         
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['ws_twfb_username'] = strip_tags( $new_instance['ws_twfb_username'] );
		$instance['ws_twfb_count'] = strip_tags( $new_instance['ws_twfb_count'] );
		$instance['ws_twfb_show_username'] = strip_tags( $new_instance['ws_twfb_show_username'] );
		$instance['ws_twfb_button_size'] = strip_tags( $new_instance['ws_twfb_button_size'] );
		$instance['ws_twfb_tailoring'] = strip_tags( $new_instance['ws_twfb_tailoring'] );
         
        return $instance;
         
    }
  
    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) {    
     	
		/* Check values */
		if( $instance) {
		
	        $title = esc_attr( $instance['title'] );
			$ws_twfb_username = esc_attr( $instance['ws_twfb_username'] );
			$ws_twfb_count = esc_attr( $instance['ws_twfb_count'] );
			$ws_twfb_show_username = esc_attr( $instance['ws_twfb_show_username'] );
			$ws_twfb_button_size = esc_attr( $instance['ws_twfb_button_size'] );
			$ws_twfb_tailoring = esc_attr( $instance['ws_twfb_tailoring'] );
		
		}
		else{
			$title = __( 'Follow Button', 'ws-twitter-follow-button' );
			$ws_twfb_username = 'webshouter';
			$ws_twfb_count = 'true';
			$ws_twfb_show_username = 'true';
			$ws_twfb_button_size = 'medium';
			$ws_twfb_tailoring = 'false';
		}
        ?>
         
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ws-twitter-follow-button'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        
         <p>
            <label for="<?php echo $this->get_field_id('ws_twfb_username'); ?>"><?php _e('Username:', 'ws-twitter-follow-button'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('ws_twfb_username'); ?>" name="<?php echo $this->get_field_name('ws_twfb_username'); ?>" type="text" value="<?php echo $ws_twfb_username; ?>" />
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id('ws_twfb_count'); ?>"><?php _e('Followers Count:', 'ws-twitter-follow-button'); ?></label> 
			<select id="<?php echo $this->get_field_id('ws_twfb_count'); ?>" name="<?php echo $this->get_field_name('ws_twfb_count'); ?>">
				<option value="true" <?php selected( 'true', $ws_twfb_count ); ?>><?php _e('Yes', 'ws-twitter-follow-button'); ?></option>
				<option value="false" <?php selected( 'false', $ws_twfb_count ); ?>><?php _e('No', 'ws-twitter-follow-button'); ?></option>
			</select>

		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('ws_twfb_show_username'); ?>"><?php _e('Show Username:', 'ws-twitter-follow-button'); ?></label> 
			<select id="<?php echo $this->get_field_id('ws_twfb_show_username'); ?>" name="<?php echo $this->get_field_name('ws_twfb_show_username'); ?>">
				<option value="true" <?php selected( 'true', $ws_twfb_show_username ); ?>><?php _e('Yes', 'ws-twitter-follow-button'); ?></option>
				<option value="false" <?php selected( 'false', $ws_twfb_show_username ); ?>><?php _e('No', 'ws-twitter-follow-button'); ?></option>
			</select>

		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('ws_twfb_button_size'); ?>"><?php _e('Button Size:', 'ws-twitter-follow-button'); ?></label> 
			<select id="<?php echo $this->get_field_id('ws_twfb_button_size'); ?>" name="<?php echo $this->get_field_name('ws_twfb_button_size'); ?>">
				<option value="medium" <?php selected( 'medium', $ws_twfb_button_size ); ?>><?php _e('Medium', 'ws-twitter-follow-button'); ?></option>
				<option value="large" <?php selected( 'large', $ws_twfb_button_size ); ?>><?php _e('Large', 'ws-twitter-follow-button'); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('ws_twfb_tailoring'); ?>"><?php _e('Opt-out of tailoring Twitter:', 'ws-twitter-follow-button'); ?></label> 
			<select id="<?php echo $this->get_field_id('ws_twfb_tailoring'); ?>" name="<?php echo $this->get_field_name('ws_twfb_tailoring'); ?>">
				<option value="true" <?php selected( 'true', $ws_twfb_tailoring ); ?>><?php _e('Yes', 'ws-twitter-follow-button'); ?></option>
				<option value="false" <?php selected( 'false', $ws_twfb_tailoring ); ?>><?php _e('No', 'ws-twitter-follow-button'); ?></option>
			</select>

		</p>
     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'WS_Twitter_Follow_Button_Widget' );
});