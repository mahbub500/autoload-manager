<?php
/**
 * All public facing functions
 */
namespace WPpluginhub\Option_Autoload_Manager\App;
use WpPluginHub\Plugin\Base;
use WpPluginHub\Option_Autoload_Manager\Helper;
/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Front
 * @author Mahbub mahbubmr500@gmail.com
 */
class Front extends Base {

	public $plugin;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= $this->plugin['Version'];
	}

	public function head() {}
	
	/**
	 * Enqueue JavaScripts and stylesheets
	 */
	public function enqueue_scripts() {
		$min = defined( 'OPTION_AUTOLOAD_MANAGER_DEBUG' ) && OPTION_AUTOLOAD_MANAGER_DEBUG ? '' : '.min';

		wp_enqueue_style( $this->slug, plugins_url( "/assets/css/front{$min}.css", OPTION_AUTOLOAD_MANAGER ), '', $this->version, 'all' );

		wp_enqueue_script( $this->slug, plugins_url( "/assets/js/front{$min}.js", OPTION_AUTOLOAD_MANAGER ), [ 'jquery' ], $this->version, true );
		
		$localized = [
			'ajaxurl'	=> admin_url( 'admin-ajax.php' ),
			'_wpnonce'	=> wp_create_nonce(),
		];
		wp_localize_script( $this->slug, 'OPTION_AUTOLOAD_MANAGER', apply_filters( "{$this->slug}-localized", $localized ) );
	}

	public function modal() {
		echo '
		<div id="option-autoload-manager-modal" style="display: none">
			<img id="option-autoload-manager-modal-loader" src="' . esc_attr( OPTION_AUTOLOAD_MANAGER_ASSET . '/img/loader.gif' ) . '" />
		</div>';
	}
}