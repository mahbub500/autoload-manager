<?php
/**
 * All AJAX related functions
 */
namespace Codexpert\Option_Autoload_Manager\App;
use Codexpert\Plugin\Base;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage AJAX
 * @author Mahbub mahbubmr500@gmail.com
 */
class AJAX extends Base {

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

	public function change_autoload_status(){
		$response = [
			'status'	=> 0,
			'message'	=> __( 'Unauthorized', 'option-autoload-manager' ),
		];

		if( ! wp_verify_nonce( $_POST['_wpnonce'] ) ) {
			wp_send_json_success( $response );
		}
		global $wpdb;

	    $id = intval($_POST['id']);
	    $status = intval($_POST['status']);

	    $result = $wpdb->update(
	        $wpdb->prefix . 'options',
	        ['autoload' => $status ? 'on' : 'off'], 
	        ['option_id' => $id],
	        ['%s'], 
	        ['%d']  
	    );

	    $response = [
			'status'	=> 1,
			'message'	=> __( 'Success', 'option-autoload-manager' ),
		];

		wp_send_json_success( 'Success' );



	}


	

}