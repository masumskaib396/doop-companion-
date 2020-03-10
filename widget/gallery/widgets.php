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

class Doop_Gallery extends \Elementor\Widget_Base{

	public function get_name(){
		return 'doop_gallery';
	}

	public function get_title(){
		return __('Doop Gallery', 'doop');
	}

	public function get_icon(){
		return ('eicon-slider-push');
	}

	public function get_categories(){
		return ['doop'];
	}

	public function get_keywords(){
		return ['gallery', 'slider'];
	}

	protected function _register_controls(){

		$this->start_controls_section('gallery_section',
			[
				'label' => __( 'Gallery', 'eventsio' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		//Start Socail Content
		$repeater = new \Elementor\Repeater();


		$repeater->add_control(
		    'gallery_img',
		    [    
		        'label'         => __( 'Image', 'doop' ),
		        'type'          => Controls_Manager::MEDIA,
		        'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
		    ]
		);

		$this->add_control(
			'gallerys',
			[
				'label'   => __( 'Portfolio Gallery', 'doop' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'gallery_img'  => ['url' => Utils::get_placeholder_image_src()],
					],
					[
						'gallery_img'  => ['url' => Utils::get_placeholder_image_src()],
					],
					[
						'gallery_img'  => ['url' => Utils::get_placeholder_image_src()],
					],
					[
						'gallery_img'  => ['url' => Utils::get_placeholder_image_src()],
					],
					[
						'gallery_img'  => ['url' => Utils::get_placeholder_image_src()],
					],
					[
						'gallery_img'  => ['url' => Utils::get_placeholder_image_src()],
					],
				],
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$gallerys = $settings['gallerys'];

		?>
		<div class="doop__gallery_wraper">
			<div class="doop_gallery_carpusel owl-carousel">
				<?php
				$index = 1;
				foreach ($gallerys as $gallery):

				if ($index % 6 == 1 || $index == 1) { // beginning of the row or first
					echo '<div class="doop--owl-wrap doop__gallery_single">';
				}
				?>
				<a href="<?php echo esc_url($gallery['gallery_img']['url']) ?>" class="doop__gallery_image">
					<img src="<?php echo esc_url($gallery['gallery_img']['url']) ?>">
				</a>
				<?php

				if ($index % 6 == 0 || $index == count($gallerys)) { // end of the row or last
					echo '</div><!-- .doop--owl-wrap -->';
				}

				$index++;
				endforeach ?>
			</div>
		</div>

		<?php

	}

}