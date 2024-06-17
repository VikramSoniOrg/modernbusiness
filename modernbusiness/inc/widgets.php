<?php
/*Social Icons Widget*/
class mb_social_icons_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'mb_social_icons_widget',     

        // Widget name will appear in UI
        __('MB Social Icons'),    

        // Widget description
        array( 'description' => __( 'Adds social icons in sidebar.'), ) 
        );
    }


    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title      = apply_filters( 'widget_title', $instance['title'] );
        $twitter    = apply_filters( 'widget_title', $instance['twitter'] );
        $facebook   = apply_filters( 'widget_title', $instance['facebook'] );
        $linkedin   = apply_filters( 'widget_title', $instance['linkedin'] );
        $youtube    = apply_filters( 'widget_title', $instance['youtube'] );
        // before and after widget arguments are defined by themes

        echo $args['before_widget'];            

        if ( empty( $title ) )
            $title = 'Follow Us';

        echo $args['before_title'] . $title . $args['after_title'];

        if ($twitter): ?>
        <a class="fs-5 px-2 link-dark" href="<?php echo $twitter; ?>" target="_blank"><i class="bi-twitter"></i></a>
        <?php endif; ?>

        <?php if ($facebook): ?>
        <a class="fs-5 px-2 link-dark" href="<?php echo $facebook; ?>" target="_blank"><i class="bi-facebook"></i></a>
        <?php endif; ?>

        <?php if ($linkedin): ?>
        <a class="fs-5 px-2 link-dark" href="<?php echo $linkedin; ?>" target="_blank"><i class="bi-linkedin"></i></a>
        <?php endif; ?>

        <?php if ($youtube): ?>
        <a class="fs-5 px-2 link-dark" href="<?php echo $youtube; ?>" target="_blank"><i class="bi-youtube"></i></a>
        <?php endif;

        echo $args['after_widget'];
    }



    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title      = $instance[ 'title' ];
            $twitter    = $instance[ 'twitter' ];
            $facebook   = $instance[ 'facebook' ];
            $linkedin   = $instance[ 'linkedin' ];
            $youtube    = $instance[ 'youtube' ];
        }
        else {
            $title = __( 'Follow us' );
            $twitter    = '';
            $facebook   = '';
            $linkedin   = '';
            $youtube    = '';
        }

        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter Link:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook Link:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'LinkedIn Link:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="text" value="<?php echo esc_attr( $linkedin ); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'YouTube Link:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>" />
        </p>
        <?php
    }



    // Updating widget replacing old instances with new

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']      = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['twitter']    = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
        $instance['facebook']   = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
        $instance['linkedin']   = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
        $instance['youtube']    = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';

        return $instance;

    }

}
/*Social Icons Widget*/

// register widgets
function mb_widgets() {
    register_widget( 'mb_social_icons_widget' );
}

add_action( 'widgets_init', 'mb_widgets' );