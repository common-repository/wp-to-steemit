<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.bwpsteam.com
 * @since      1.0.0
 *
 * @package    Posttosteemit
 * @subpackage Posttosteemit/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Posttosteemit
 * @subpackage Posttosteemit/public
 * @author     Vũ Vương Vĩ <vuvuongvi@gmail.com>
 */
class Posttosteemit_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Posttosteemit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Posttosteemit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/posttosteemit-public.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name . 'pts', plugin_dir_url( __FILE__ ) . 'css/pts.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Posttosteemit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Posttosteemit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name . '-to-markdown', plugins_url('../lib/to-markdown/to-markdown.js', __FILE__ ) );
		wp_enqueue_script( $this->plugin_name . '-steem', plugins_url('../lib/steem/steem.min.js', __FILE__ ) );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/posttosteemit-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-steem-pop-up', plugin_dir_url(__FILE__) . 'js/dist/bundle.js', array( 'jquery' ), $this->version, false);
		wp_enqueue_script( $this->plugin_name . '-steem-pop-up', plugin_dir_url(__FILE__) . 'js/dist/bundle.js.map', array( 'jquery' ), $this->version, false);
		wp_localize_script( $this->plugin_name, 'ajax_object', array(
			'pst_options' => get_option( 'pst_options' ),
			'ajax_url' => admin_url( 'admin-ajax.php' )
		));

	}

	public function pts_add_content($content) {
		if ( current_user_can( 'edit_pages' ) && current_user_can( 'edit_posts' ) ) {
			$button = '';
			$visible_perm_link = '<div style="display:none" class="pts_visible_perm_link">' . sanitize_title(get_the_title()) . '</div>';
			$visible_title = '<div style="display:none" class="pts_visible_title">' . get_the_title() . '</div>';
			$visible_content = '<div style="display:none" class="pts_visible_content">' . $content . '</div>';
			if(is_singular() || is_home()) {
				$button .= '<button class="button pts_steemit_btn">Steemit</button>';
				return $content . $visible_content . $visible_title . $visible_perm_link .$button;
			} else {
				return $content;
			}
		} else {
			return $content;
		}

	}

}
