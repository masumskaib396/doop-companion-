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

class Doop_Blog extends \Elementor\Widget_Base{

	public function get_name(){
		return 'doop_blog';
	}

	public function get_title(){
		return __('Doop Blog', 'doop');
	}

	public function get_icon(){
		return ('eicon-blog');
	}

	public function get_categories(){
		return ['doop'];
	}

	public function get_keywords(){
		return ['blog'];
	}

	protected function _register_controls(){

		$this->start_controls_section('blog_section',
			[
				'label' => __( 'Blog Section', 'eventsio' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 3,
			'post_status'  => 'publish',
			'ignore_sticky_posts' => 1,
		);

		$doop_post = new \WP_Query($args);

		?>
			
		<div class="doop__blog__section">
			<?php while($doop_post->have_posts()): $doop_post->the_post() ?>
				<div class="doop__blog__single">
					<div class="doop__blo__content">
						<h2 class="headding"><?php the_title(); ?></h2>
						<span class="date"><?php echo  get_the_date() ?></span>
						<?php the_excerpt(); ?>
						<a href="<?php permalink_link(); ?>" class="redmore__btn"><i class="icon icon-right-arrow"></i></a>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		

		


		<?php

	}

}