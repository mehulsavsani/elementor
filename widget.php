<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function register_list_widget( $widgets_manager ) {

    require_once( get_parent_theme_file_path(). '/elements/testimonial2.php' );
    require_once( get_parent_theme_file_path(). '/elements/box-slider.php' );

    $widgets_manager->register( new \Elementor_Testimonial_Widget() );
    $widgets_manager->register( new \Elementor_Box_Slider_Widget() );

}
add_action( 'elementor/widgets/register', 'register_list_widget' );