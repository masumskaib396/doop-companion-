<?php 

use \Elementor\Plugin as Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Doop_Extension {
	
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.6.0';
	const MINIMUM_PHP_VERSION = '5.6';


	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	

	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	public function i18n() {
		load_plugin_textdomain( 'doop' );
	}

	

	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}
		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		//add_action( 'elementor/editor/after_enqueue_styles', array ( $this, 'pawelements_editor_styles' ) );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered',[$this,'register_new_category']);
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'doop_frontend_after_scripts' ] );
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'doop_register_frontend_scripts' ] );
		add_action( 'wp_enqueue_scripts', array( $this, 'doop_register_frontend_styles' ), 10 );
		
	}
	

	function doop_frontend_after_scripts(){
		wp_enqueue_script(
            'doop-owl-carousel',
            DOOP_ASSETS_PUBLIC . '/js/owl.carousel.min.js',
            array('jquery'),
            DOOP_VERSION,
            true
        );
        wp_enqueue_script(
            'doop-magnific-popup',
            DOOP_ASSETS_PUBLIC . '/js/jquery.magnific-popup.min.js',
            array('jquery'),
            DOOP_VERSION,
            true
        );
		 wp_enqueue_script(
	        'doop-promoslider',
	        DOOP_ASSETS_PUBLIC . '/js/promoslider.js',
	        array('jquery', 'doop-owl-carousel'),
	        DOOP_VERSION,
	        true
	    );
		wp_enqueue_script(
	        'doop-gallery',
	        DOOP_ASSETS_PUBLIC . '/js/gallery.js',
	        array('jquery'),
	        DOOP_VERSION,
	        true
	    );
		

       
	}



	

	/**
	 * Load Frontend Script
	 *
	*/
	public function doop_register_frontend_scripts(){
		wp_enqueue_style(
            'doop-widgets',
            DOOP_ASSETS_PUBLIC . '/css/widgets.css',
            array(),
            DOOP_VERSION
        );

		wp_enqueue_script(
            'doop-main',
            DOOP_ASSETS_PUBLIC . '/js/main.js',
            array(),
            DOOP_VERSION
        );

	}

	/**
	 * Load Frontend Styles
	 *
	*/
	public function doop_register_frontend_styles(){
		wp_enqueue_style(
            'doop-owlcarousel',
            DOOP_ASSETS_PUBLIC . '/css/owl.carousel.min.css',
            array(),
            DOOP_VERSION
        );
        wp_enqueue_style(
            'doop-widgets',
            DOOP_ASSETS_PUBLIC . '/css/widgets.css',
            array(),
            DOOP_VERSION
        );
        wp_enqueue_style(
            'doop-magnific-popup',
            DOOP_ASSETS_PUBLIC . '/css/magnific-popup.css',
            array(),
            DOOP_VERSION
        );
	}


	
	/**
	 * Widgets Catgory
	 *
	*/
	public function register_new_category($manager){
	   $manager->add_category('doop',
			[
				'title' => __( 'Doop Companion  Addons', 'doop-companion' ),
			]);
	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'doop-companion' ),
			'<strong>' . esc_html__( 'Elementor doop Extension', 'doop-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'doop-companion' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'doop-companion' ),
			'<strong>' . esc_html__( 'Elementor doop Extension', 'doop-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'doop-companion' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'doop-companion' ),
			'<strong>' . esc_html__( 'Elementor doop Extension', 'doop-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'doop-companion' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function init_widgets() {

		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
		//Include Widget files


		//Slider Widget
		require_once( DOOP_ADDONS_DIR . 'gallery/widgets.php' );
		$widgets_manager->register_widget_type( new \Doop\Widgets\Elementor\Doop_Gallery() );

		//Gallery Widget
		require_once( DOOP_ADDONS_DIR . 'promoslider/widgets.php' );
		$widgets_manager->register_widget_type( new \Doop\Widgets\Elementor\Doop_Promoslider() );

		//Blog Widget
		require_once( DOOP_ADDONS_DIR . 'blog/widgets.php' );
		$widgets_manager->register_widget_type( new \Doop\Widgets\Elementor\Doop_Blog() );

		//Gallery Widget
		require_once( DOOP_ADDONS_DIR . 'contactform/widgets.php' );
		$widgets_manager->register_widget_type( new \Doop\Widgets\Elementor\Doop_Contactform() );

		

	}


}
Doop_Extension::instance();
