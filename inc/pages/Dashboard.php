<?php 
/**
 * @package  nctPlugin
 */
namespace Inc\Pages;

use inc\Api\SettingsApi;
use inc\base\BaseController;
use inc\Api\Callbacks\AdminCallbacks;
use inc\Api\Callbacks\ManagerCallbacks;
use inc\Api\Callbacks\EventsCallbacks;





class Dashboard extends BaseController
{
	public $settings;

	public $callbacks;

	public $callbacks_mngr;

	public $pages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->callbacks_mngr = new ManagerCallbacks();

		$this->event_callbacks = new EventsCallbacks();
		 
		$this->setPages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();
	

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'nct Plugin', 
				'menu_title' => 'new Church Tools', 
				'capability' => 'manage_options', 
				'menu_slug' => 'kn_nct_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'kn_nct_plugin_settings',
				'option_name' => 'kn_nct_plugin',
				'callback' => array( $this->callbacks_mngr, 'CTSanitize' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			 array(
				'id' => 'kn_nct_admin_index',
				'title' => 'Churchtool RESTAPI Manager',
				'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
				'page' => 'kn_nct_plugin'
				 )
			 );


	

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' => 'url',
				'title' => 'URL ',
				'callback' => array( $this->callbacks_mngr, 'textField' ),
				'page' => 'kn_nct_plugin',
				'section' => 'kn_nct_admin_index',
				
				'args' => array(
					'option_name' => 'kn_nct_plugin',
					'label_for' => 'url',
					'placeholder' => 'Churchtool Instance',
					'required' => true,
					)
			)
			,array(
				'id' => 'user',
				'title' => 'Username',
				'callback' => array( $this->callbacks_mngr, 'textField' ),
				'page' => 'kn_nct_plugin',
				'section' => 'kn_nct_admin_index',
				'args' => array(
					'option_name' => 'kn_nct_plugin',
					'label_for' => 'user',
					'placeholder' => 'test@test.de',
					'required' => true,
					)
				)
			,array(
				'id' => 'pw',
				'title' => 'Passwort',
				'callback' => array( $this->callbacks_mngr, 'passwordField' ),
				'page' => 'kn_nct_plugin',
				'section' => 'kn_nct_admin_index',
				'args' => array(
					'option_name' => 'kn_nct_plugin',
					'label_for' => 'password',
					'placeholder' => '12345678',
					'required' => true,
					)
				)
			,
			array(
				'id' => 'status',
				'title' => 'Login Status',
				'callback' => array( $this->callbacks_mngr, 'hiddenfield' ),
				'page' => 'kn_nct_plugin',
				'section' => 'kn_nct_admin_index',
				'args' => array(
					'option_name' => 'kn_nct_plugin',
					'label_for' => 'status',
					'required' => false,
					'placeholder' => '12345678',
					)
				),
				array(
					'id' => 'update',
					'title' => 'Calender Updaten',
					'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
					'page' => 'kn_nct_plugin',
					'section' => 'kn_nct_admin_index',
					'args' => array(
						'option_name' => 'kn_nct_plugin',
						'label_for' => 'update',
						'required' => false,
						'class' => '',	
						
						)
					)
			// ,
			,
				
		);
		

		
		$this->settings->setFields( $args );
	}

	
	
}