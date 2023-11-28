<?php 
/**
 * @package  nctPlugin
 */
namespace inc\Api\Callbacks;

use inc\base\BaseController;


class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	public function print_array($array)
	{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
	}

}