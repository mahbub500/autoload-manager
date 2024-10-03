<?php
/**
 * All admin facing functions
 */
namespace WPpluginhub\Option_Autoload_Manager\App;
use WPpluginhub\Plugin\Base;
use WPpluginhub\Plugin\Metabox;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Admin
 * @author Mahbub mahbubmr500@gmail.com
 */
class Admin extends Base {

	public $plugin;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->server	= $this->plugin['server'];
		$this->version	= $this->plugin['Version'];
	}

	/**
	 * Internationalization
	 */
	public function i18n() {
		load_plugin_textdomain( 'option-autoload-manager', false, OPTION_AUTOLOAD_MANAGER_DIR . '/languages/' );
	}

	/**
	 * Installer. Runs once when the plugin in activated.
	 *
	 * @since 1.0
	 */
	public function install() {

		if( ! get_option( 'option-autoload-manager_version' ) ){
			update_option( 'option-autoload-manager_version', $this->version );
		}
		
		if( ! get_option( 'option-autoload-manager_install_time' ) ){
			update_option( 'option-autoload-manager_install_time', time() );
		}
	}

	/**
	 * Enqueue JavaScripts and stylesheets
	 */
	public function enqueue_scripts() {
		$min = defined( 'OPTION_AUTOLOAD_MANAGER_DEBUG' ) && OPTION_AUTOLOAD_MANAGER_DEBUG ? '' : '.min';
		
		wp_enqueue_style( $this->slug, plugins_url( "/assets/css/admin{$min}.css", OPTION_AUTOLOAD_MANAGER ), '', $this->version, 'all' );

		wp_enqueue_script( $this->slug, plugins_url( "/assets/js/admin{$min}.js", OPTION_AUTOLOAD_MANAGER ), [ 'jquery' ], $this->version, true );

		wp_enqueue_style( 'dataTable', 'https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css', '', $this->version, 'all' );

		wp_enqueue_script( 'dataTable', 'https://cdn.datatables.net/2.1.7/js/dataTables.min.js', [ 'jquery' ], $this->version, true );

		$localized = [
			'ajaxurl'	=> admin_url( 'admin-ajax.php' ),
			'_wpnonce'	=> wp_create_nonce(),
		];
		wp_localize_script( $this->slug, 'OPTION_AUTOLOAD_MANAGER', apply_filters( "{$this->slug}-localized", $localized ) );
	}

	public function footer_text( $text ) {
		if( get_current_screen()->parent_base != $this->slug ) return $text;

		return sprintf( __( 'Built with %1$s by the folks at <a href="%2$s" target="_blank">WPpluginhub, Inc</a>.' ), '&hearts;', 'https://codexpert.io' );
	}

	public function modal() {
		echo '
		<div id="option-autoload-manager-modal" style="display: none">
			<img id="option-autoload-manager-modal-loader" src="' . esc_attr( OPTION_AUTOLOAD_MANAGER_ASSET . '/img/loader.gif' ) . '" />
		</div>';
	}
}