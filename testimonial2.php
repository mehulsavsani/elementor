<?php
use Elementor\Repeater;
class Elementor_Testimonial_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'elementor_testimonial_widget';
    }

    public function get_title() {
        return esc_html__( 'Testimonial', 'elementor-addon' );
    }

    public function get_icon() {
        return 'eicon-editor-code';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    public function get_keywords() {
        return [ 'tvistech' ];
    }

    public function get_script_depends() {

        // wp_register_script( 'widget-script-1', 'https://unpkg.com/swiper@8/swiper-bundle.min.js');
        wp_enqueue_style( 'ts-slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css' );
        wp_enqueue_style( 'ts-stylesheet', get_template_directory_uri() .'/elements/css/stylesheet.css' );
        wp_register_script( 'tv-slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js' );
        wp_register_script( 'star-rating', get_template_directory_uri() .'/elements/js/jquery.star-rating-svg.js' );
        wp_register_script( 'ts-custom', get_template_directory_uri() .'/elements/js/custom.js' );

        return [
            'ts-slick',
            'ts-stylesheet',
            'tv-slick',
            'star-rating',
            'ts-custom',
        ];

    }



    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Options', 'tvistech'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Use the repeater to define one one set of the items we want to repeat look like
        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_title',
            [
                'label' => __( 'Title', 'tvistech'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( "Title"),
                'placeholder' => __( 'Title'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_position',
            [
                'label' => __( 'Position', 'tvistech'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( "Position"),
                'placeholder' => __( 'Position'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'star_rating',
            [
                'label' => esc_html__( 'Star rating', 'tvistech' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'deg' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 0.5
                    ],                  
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 5,
                ],
            ]
        );

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => __( 'Choose Image', 'tvistech'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'testimonial_description',
            [
                'label' => __( 'Description', 'tvistech'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __(""),
                'placeholder' => __( 'Position'),
                'label_block' => true,
            ]
        );
        // Add the
        $this->add_control(
            'options_list',
            [
                'label' => __( 'Testimonials', 'tvistech'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    []
                ],
                'title_field' => '{{{ testimonial_title }}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_options',
            [
                'label' => __( 'Slider Options', 'tvistech'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'slider_arrow',
            [
                'label' => esc_html__( 'Slider Nav', 'tvistech' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'true', 'tvistech' ),
                'label_off' => esc_html__( 'false', 'tvistech' ),
                'return_value' => 'true',
                'default' => 'false'
            ]
        );
        $this->add_control(
            'slider_dots',
            [
                'label' => esc_html__( 'Slider Dots', 'tvistech' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'true', 'tvistech' ),
                'label_off' => esc_html__( 'false', 'tvistech' ),
                'return_value' => 'true',
                'default' => 'false'
            ]
        );
        $this->add_control(
            'slider_loop',
            [
                'label' => esc_html__( 'Slider loop', 'tvistech' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'true', 'tvistech' ),
                'label_off' => esc_html__( 'false', 'tvistech' ),
                'return_value' => 'true',
                'default' => 'false'
            ]
        );
        $this->add_control(
            'slidesToShow',
            [
                'label' => esc_html__( 'slides To Show', 'tvistech' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'deg' => [
                        'min' => 1,
                        'max' => 6,
                    ],                  
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 1,
                ],
            ]
        );
        $this->add_control(
            'slidesToScroll',
            [
                'label' => esc_html__( 'slides To Scroll', 'tvistech' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'deg' => [
                        'min' => 1,
                        'max' => 6,
                    ],                  
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 1,
                ],
            ]
        );
    }


    protected function render() {
        $options_list = $this->get_settings_for_display('options_list');
        $el_unique_id = 'slider-'.uniqid();
        
        $options_list = array_reverse($options_list);

        $slider_arrow = $this->get_settings_for_display('slider_arrow');
        $slider_dots = $this->get_settings_for_display('slider_dots');
        $slider_loop = $this->get_settings_for_display('slider_loop');
        $slidesToShow = $this->get_settings_for_display('slidesToShow');
        $slidesToScroll = $this->get_settings_for_display('slidesToScroll');


        $s_arrow = 'false';
        if ($slider_arrow == 'true') {
            $s_arrow = 'true';
        }else{
            $s_arrow = 'false';
        }
		
		$s_dots = 'false';
        if ($slider_dots == 'true') {
            $s_dots = 'true';
        }else{
            $s_dots = 'false';
        }
		
		$s_loop = 'false';
        if ($slider_loop == 'true') {
            $s_loop = 'true';
        }else{
            $s_loop = 'false';
        }
        
        ?>
        <div class="testimonial_main">
                <div class="testimonial_slider <?php echo $el_unique_id; ?>">
                <?php foreach ($options_list as $option_item) { ?>
                <div class="testimonial_list">
                    <div class="testimonial_inner">
                         <?php if ($option_item['testimonial_description']): ?>
                             <div class="testimonial_desc">
                                 <?php echo $option_item['testimonial_description']; ?>
                             </div>
                         <?php endif ?>

                         <?php if ($option_item['testimonial_image']['url']): ?>
                            <div class="testimonial_img">
                                <img src='<?php echo $option_item['testimonial_image']['url']; ?>' />
                            </div>
                         <?php endif ?>
                         
                         <div class="testimonial_footer">
                             <?php if ($option_item['testimonial_title']): ?>
                             <h2 class="testimonial_title"><?php echo $option_item['testimonial_title']; ?></h2>
                             <?php endif ?>
                             <?php if ($option_item['testimonial_position']): ?>
                                <h5 class="testimonial_position"><?php echo $option_item['testimonial_position']; ?></h5>
                             <?php endif ?>
                             <?php if ($option_item['testimonial_position']): ?>
                                <div class="testimonial_star" data-rating="<?php echo $option_item['star_rating']['size']; ?>"></div>
                             <?php endif ?>
                          </div>

                    </div>

                  </div>
                <?php } ?>
            </div>
        </div>

            <script type="text/javascript">
                jQuery(document).ready(function(){
                   jQuery('.<?php echo $el_unique_id; ?>').slick({
                      dots: <?php echo $s_dots; ?>,
                      arrows: <?php echo $s_arrow; ?>,
                      infinite: <?php echo $s_loop; ?>,
                      slidesToShow: <?php echo $slidesToShow['size']; ?>,
                      slidesToScroll: <?php echo $slidesToScroll['size']; ?>,
                      responsive: [

                      ]
                    });
               });
            </script>
        <?php
    }
}