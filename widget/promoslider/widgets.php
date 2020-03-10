<?php
/**
 * Thmpw Logo Widget.
 *
 *
 * @since 1.0.0
 */
namespace Doop\Widgets\Elementor;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;
use  Elementor\Scheme_Color;
use  Elementor\Group_Control_Typography;
use  Elementor\Scheme_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Doop_Promoslider extends \Elementor\Widget_Base{

	public function get_name(){
		return 'doop_promoslider';
	}

	public function get_title(){
		return __('Doop Promoslider', 'doop');
	}

	public function get_icon(){
		return ('eicon-slider-push');
	}

	public function get_categories(){
		return ['doop'];
	}

	public function get_keywords(){
		return ['slider'];
	}

	protected function _register_controls(){

		$this->start_controls_section('gallery_section',
			[
				'label' => __( 'Promo Slider', 'eventsio' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Start Socail Content
		$repeater = new \Elementor\Repeater();


		$repeater->add_control(
		    'title',
		    [    
		        'label'         => __( 'Title', 'doop' ),
		        'type'          => Controls_Manager::TEXT,
		    ]
		);

		$repeater->add_control(
		    'headding',
		    [    
		        'label'         => __( 'Headding', 'doop' ),
		        'type'          => Controls_Manager::TEXTAREA,
		    ]
		);
		$repeater->add_control(
		    'content',
		    [    
		        'label'         => __( 'Content', 'doop' ),
		        'type'          => Controls_Manager::WYSIWYG,
		    ]
		);

		$this->add_control(
			'promoslider',
			[
				'label'   => __( 'Promo 	Slider ', 'doop' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '<# print(title.slice(0,1).toUpperCase() + title.slice(1)) #>',
				'default' => [
					[
						'title'      => 'OUR COMPANY', 'doop',
						'headding'      => 'Headdin1', 'doop',
						'content'      => 'Vestibulum ac diam sit amet quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.Vestibulum ac diam sit amet.Quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.', 'doop',
					],
					[
						'title'      => 'OUR COMPANY', 'doop',
						'headding'      => 'Headdin2', 'doop',
						'content'      => 'Vestibulum ac diam sit amet quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.Vestibulum ac diam sit amet.Quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.', 'doop',
					],
					[
						'title'      => 'OUR COMPANY', 'doop',
						'headding'      => 'Headdin3', 'doop',
						'content'      => 'Vestibulum ac diam sit amet quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.Vestibulum ac diam sit amet.Quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.', 'doop',
					]
				],
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$promoslider = $settings['promoslider'];

		?>
			<div class="doop__slide__wraper">
				<div class="doop__proslider owl-carousel ">

					<?php foreach ($promoslider as $promoslide): ?>
						<div class="doop__proslider__slingle">
							<div class="doop__content">
								<span><?php echo esc_html($promoslide['title']) ?></span>
								<h2><?php echo doop_allowed_html($promoslide['headding']) ?></h2>
								<?php echo doop_get_meta($promoslide['content']) ?>
							</div>
						</div>
					<?php endforeach ?>
					
				</div>
			</div>
		<?php

	}

}