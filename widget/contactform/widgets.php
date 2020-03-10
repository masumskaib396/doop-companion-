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

class Doop_Contactform extends \Elementor\Widget_Base{

	public function get_name(){
		return 'doop_contactfrm';
	}

	public function get_title(){
		return __('Doop Contact Form7', 'doop');
	}

	public function get_icon(){
		return ('eicon-mail ekit-widget-icon');
	}

	public function get_categories(){
		return ['doop'];
	}

	public function get_keywords(){
		return ['contactform'];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'_section_cf7',
			[
				'label' => doop_is_cf7_activated() ? __( 'Contact Form 7', 'Doop' ) : __( 'Notice', 'Doop' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        if ( ! doop_is_cf7_activated() ) {
            $this->add_control(
                'cf7_missing_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(
                        __( 'Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', 'Doop' ),
                        '<a href="https://wordpress.org/plugins/contact-form-7/" target="_blank" rel="noopener">Contact Form 7</a>'
                    ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                ]
            );
            $this->end_controls_section();
            return;
        }

        $this->add_control(
            'form_id',
            [
                'label' => __( 'Select Your Form', 'Doop' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ['' => __( '', 'Doop' ) ] + \doop_get_cf7_forms(),
            ]
        );

        $this->add_control(
            'html_class',
            [
                'label' => __( 'HTML Class', 'Doop' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'description' => __( 'Add CSS custom class to the form.', 'Doop' ),
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {

		$settings = $this->get_settings_for_display();

		 if ( ! doop_is_cf7_activated() ) {
            return;
        }

        if ( ! empty( $settings['form_id'] ) ) {
            echo doop_do_shortcode( 'contact-form-7', [
                'id' => $settings['form_id'],
                'html_class' => 'doop-cf7-form ' . doop_sanitize_html_class_param( $settings['html_class'] ),
			] );
        }
    }


}


