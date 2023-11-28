<?php 
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Api\Callbacks;

class EventsCallbacks
{
	public function print_array($array)
	{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
	}

	public function eventsSectionManager()
	{
		echo 'Configure the settings for getting Events as you want.';
	}

	public function eventsSanitize( $input )
	{
		return $input;
	}


		public function CalcheckboxField( $args ) 	
		{
			$option_name = $args['option_name'];
			$options = get_option( $option_name );

		

			// $this->print_array ($options);
			foreach ($options as $option ) {
				$name = $option ['name'];
				$checkbox = $option ['checked'];
				$checked = isset($checkbox) ? ($checkbox ? true : false) : false;
				echo 'name'. $name ."<p>";
				echo 'Check'.$checked."<p>";


				// echo '<div class=""><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ( $checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
			 } ;


		}
}