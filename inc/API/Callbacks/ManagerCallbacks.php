<?php 
/**
 * @package  fegabctoolsPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;



class ManagerCallbacks extends BaseController
{
	
	
	
	
	
	public function checkboxSanitize( $input )
	{
		$output = array();

		foreach ( $this->managers as $key => $value ) {
			$output[$key] = isset( $input[$key] ) ? true : false;
		}

		return $output;
	}
	

	public function adminSectionManager()
	{
		echo 'Please add your RESTAPI Settings';
	}

	
	public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checkbox = get_option( $option_name );
		$checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;
		

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ( $checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
	}
	public function textField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$input = get_option( $option_name );
		$value = $input[$name];
		$required = $args['required'];
		
	echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" ' .( $required ? ' required' : '') . ' value="' . $value . '" placeholder="' . $args['placeholder'] .   '">';
	}
	public function emailField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$input = get_option( $option_name );
		$value = $input[$name];
		$required = $args['required'];
		

		echo '<input type="email" class="regular-email" id="' . $name . '" name="' . $option_name . '[' . $name . ']" ' .( $required ? ' required' : '') . 'value="' . $value . '" placeholder="' . $args['placeholder'] . '">';
	}
	public function PasswordField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$input = get_option($option_name );
		$value = $input[$name];
		$required = $args['required'];
				
		echo '<input type="password" class="regular-password" id="' . $name . '" name="' . $option_name . '[' . $name . ']"' .( $required ? ' required' : '') . ' value="' . $value . '" placeholder="' . $args['placeholder'] . '">';
	}
	public function hiddenfield($args){
		
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$input = get_option( $option_name );
		$value = $input[$name];
		$required = $args['required'];
		
		 	 echo '<input type="hidden" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" ' .( $required ? ' required' : '') . ' value="' . $value . '" placeholder="' . $args['placeholder'] .   '">';
			 echo $value;
	}
	public function hiddenarray($args){
		
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$input = get_option($option_name );
		
		foreach ($input[$name] as $key ) {
			echo $key['name']; 
			echo " , ";
		}
		
	}

	


}