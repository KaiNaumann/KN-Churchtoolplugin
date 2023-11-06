<?php 
/**
 * @package  NewChurchtoolPlugin
 */

 namespace inc\base;


 use inc\base\BaseController;
 
class Enqueue extends BaseController
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}
	
	/**
	 * Summary of enqueue
	 * @return void
	 */
	function enqueue() {
		// enqueue all our scripts
	
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'asset/css/knct-plugin-admin-style.css' );
		// wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'asset/js/knct-plugin-admin.js' );
	}
}