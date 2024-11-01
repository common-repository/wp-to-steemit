<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.bwpsteam.com
 * @since      1.0.0
 *
 * @package    Posttosteemit
 * @subpackage Posttosteemit/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Posttosteemit
 * @subpackage Posttosteemit/admin
 * @author     Vũ Vương Vĩ <vuvuongvi@gmail.com>
 */
class Posttosteemit_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

	}

	/**
	 * Register the JavaScript for the admin area.
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
	}

	/**
	 * Create plugin setting menu
	 */
	public function pst_create_setting_menu() {

		add_menu_page('Post to Steemit Plugin Settings', 'Post to Steemit', 'administrator', __FILE__, array($this, 'pts_settings'), 'dashicons-unlock');

	}


	/**
	 * Callback for Steemit username settings
	 */
	function pst_steemit_username() {

	    $options = get_option( 'pst_options' );
		echo "<input id='pst_steemit_username' name='pst_options[pst_steemit_username]' placeholder='Username' type='text' value='". $options['pst_steemit_username'] . "'/>";

	}

	/**
	 * Callback for Steemit password settings
	 */
	public function pst_steemit_password() {

		$options = get_option( 'pst_options' );
		echo "<input id='pst_steemit_password' name='pst_options[pst_steemit_password]' placeholder='Password or WIF' type='password' value='" .$options['pst_steemit_password'] . "' />";

	}

	public function pst_steemit_posting_key() {

        $options = get_option( 'pst_options' );
        echo "<input id='pst_steemit_posting_key' name='pst_options[pst_steemit_posting_key]' placeholder='Posting key' type='password' value='" .$options['pst_steemit_posting_key'] . "' />";

    }

	/**
	 * Register plugin settings
	 */
	public function pst_register_settings() {

		register_setting('pst_options', 'pst_options', 'pst_options_validate');
		add_settings_section('pst_defaults', 'Steemit Settings', array($this, 'defaults_output'), 'pst-settings');
		add_settings_field('pst_steemit_username', 'Steemit Username (*)', array($this, 'pst_steemit_username'), 'pst-settings', 'pst_defaults');
		add_settings_field('pst_steemit_password', 'Steemit Password (deprecated)', array($this, 'pst_steemit_password'), 'pst-settings', 'pst_defaults');
        add_settings_field('pst_steemit_posting_key', 'Steemit Posting Key (*)', array($this, 'pst_steemit_posting_key'), 'pst-settings', 'pst_defaults');


    }

	public function defaults_output() {

	}

	/**
	 * Implement plugin settings
	 */
	public function pts_settings() {

		if ( !current_user_can('manage_options') ) {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}

		?>
		<div class="wrap">
			<style>
				.notice.pda-notice {
					border-left-color: #0194F3 !important;
					padding: 20px;
				}
				.rtl .notice.pda-notice {
					border-right-color: #0194F3 !important;
				}
				.notice.pda-notice .pda-notice-inner {
					display: table;
					width: 100%;
				}
				.notice.pda-notice .pda-notice-inner .pda-notice-icon,
				.notice.pda-notice .pda-notice-inner .pda-notice-content,
				.notice.pda-notice .pda-notice-inner .pda-install-now {
					display: table-cell;
					vertical-align: middle;
				}
				.notice.pda-notice .pda-notice-icon {
					color: #0194F3;
					font-size: 50px;
					width: 50px;
				}
				.notice.pda-notice .pda-notice-content {
					padding: 0 20px;
				}
				.notice.pda-notice p {
					padding: 0;
					margin: 0;
				}
				.notice.pda-notice h3 {
					margin: 0 0 5px;
				}
				.notice.pda-notice .pda-install-now {
					text-align: center;
				}
				.notice.pda-notice .pda-install-now .pda-install-button {
					background-color: #0194F3;
					color: #fff;
					border-color: #0da8f3;
					box-shadow: 0 1px 0 #0da8f3;
					padding: 5px 30px;
					height: auto;
					line-height: 20px;
					text-transform: capitalize;
					float: right;
				}
				.notice.pda-notice .pda-install-now .pda-install-button i {
					padding-right: 5px;
				}
				.rtl .notice.pda-notice .pda-install-now .pda-install-button i {
					padding-right: 0;
					padding-left: 5px;
				}
				.notice.pda-notice .pda-install-now .pda-install-button:hover {
					background-color: #0da8f3;
				}
				.notice.pda-notice .pda-install-now .pda-install-button:active {
					box-shadow: inset 0 1px 0 #0da8f3;
					transform: translateY(1px);
				}
				@media (max-width: 767px) {
					.notice.pda-notice {
						padding: 10px;
					}
					.notice.pda-notice .pda-notice-inner {
						display: block;
					}
					.notice.pda-notice .pda-notice-inner .pda-notice-content {
						display: block;
						padding: 0;
					}
					.notice.pda-notice .pda-notice-inner .pda-notice-icon,
					.notice.pda-notice .pda-notice-inner .pda-install-now {
						display: none;
					}
				}
			</style>
<!--			<div class="notice updated is-dismissible pda-notice pda-install-elementor">-->
<!--				<div class="pda-notice-inner">-->
<!--					<div class="pda-notice-icon">-->
<!--						<img width="64" height="64" src="https://ps.w.org/prevent-direct-access/assets/icon-128x128.jpg?rev=1300338" alt="PDA Logo" />-->
<!--					</div>-->
<!--					<div class="pda-notice-content">-->
<!--						<h3>--><?php //_e( 'Do you like Prevent Direct Access? You\'ll love its Gold version!'); ?><!--</h3>-->
<!--						<p>--><?php //_e( 'Please upgrade to ' ); ?>
<!--							<a target="_blank" href="--><?php //echo sprintf(constant( 'PDA_HOME_PAGE' ), 'user-website' , "settings-notification-link") ?><!--" target="_blank">--><?php //_e( 'Gold version' ); ?><!--</a> to change default settings!</p>-->
<!--					</div>-->
<!--					<div class="pda-install-now">-->
<!--						<a class="button pda-install-button" target="_blank" href="--><?php //echo sprintf(constant( 'PDA_HOME_PAGE' ), 'user-website', 'settings-notification-cta') ?><!--"><i class="dashicons dashicons-download"></i>--><?php //_e( 'Get Gold version Now!' ); ?><!--</a>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
			<form method="post" action="options.php">
				<?php
				settings_fields( 'pst_options' );
				do_settings_sections( 'pst-settings' );
				?>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>
			</form>
		</div>
		<?php
	}

}
	