<?php
/*
Plugin Name: WSUWP JSON Web Template
Plugin URI: https://web.wsu.edu/
Description: Provide JSON web templates for external applications.
Author: washingtonstateuniversity, jeremyfelt
Version: 0.0.0
*/

class WSUWP_JSON_Web_Template {
	private static $instance;

	/**
	 * @var string The slug used for the content type.
	 */
	var $content_type = 'json_web_template';

	/**
	 * Maintain and return the one instance and initiate hooks when
	 * called the first time.
	 *
	 * @return \WSUWP_JSON_Web_Template
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new WSUWP_JSON_Web_Template();
			self::$instance->setup_hooks();
		}
		return self::$instance;
	}

	/**
	 * Setup hooks used by the plugin.
	 */
	public function setup_hooks() {
		add_action( 'init', array( $this, 'register_content_type' ) );
	}

	/**
	 * Register a content type to track web templates used for a specific site and theme.
	 */
	public function register_content_type() {
		$args = array(
			'labels' => array(
				'name' => 'Web Templates',
				'singular_name' => 'Web Template',
				'add_new_item' => 'Add New Web Template',
				'add_new' => 'Add New',
			),
			'description' => 'Web templates used by external applications.',
			'public' => true,
			'hierarchical' => false,
			'menu_position' => 10,
			'menu_icon' => 'dashicons-slides',
			'supports' => array(
				'title',
				'editor',
				'revisions',
			),
			'taxonomies' => array(),
			'has_archive' => false,
			'rewrite' => array(
				'slug' => 'web-template',
				'with_front' => false,
			),
		);

		register_post_type( $this->content_type, $args );
	}
}

add_action( 'plugins_loaded', 'WSUWP_JSON_Web_Template' );
/**
 * Start things up.
 *
 * @return \WSUWP_JSON_Web_Template
 */
function WSUWP_JSON_Web_Template() {
	return WSUWP_JSON_Web_Template::get_instance();
}