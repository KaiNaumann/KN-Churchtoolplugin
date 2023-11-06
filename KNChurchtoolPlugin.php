<?php
/**
 * @package  KNChurchtoolPlugin
 */

/*
Plugin Name: KN Churchtool Plugin
Plugin URI: https://github.com/KaiNaumann/KNChurchtoolPlugin/
Description: FEG ASchaffenburg Churchtool Plugin
Version: 0.1.0.0
Requires at least: 5.8
Requires PHP: 5.6.20
Author: Kai Naumann
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: fegabctools
Domain Path:  /languages
*/


/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// If this file is called firectly, abort!!!

defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );


ini_set('display_errors', 1);


// // Require once the Composer Autoload

// if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
// 	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
// }

// /**
//  * The code that runs during plugin activation
//  */
// function activate_nct_plugin() {

// 		inc\base\Activate::Activate_plugin();

// }

// register_activation_hook ( __FILE__, 'activate_nct_plugin' );

// /**
//  * The code that runs during plugin deactivation
//  */
// function deactivate_nct_plugin() {
// 	inc\base\Deactivate::Deactivate_plugin();
// }
// register_deactivation_hook( __FILE__, 'deactivate_nct_plugin' );

// /**
//  * Initialize all the core classes of the plugin
//  */

//  if ( class_exists( 'inc\\init' ) ) {
// 	inc\init::register_services();
// }

// require 'plugin-update-checker/plugin-update-checker.php';
// $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
// 	'https://github.com/KaiNaumann/KNChurchtoolPlugin/',
// 	__FILE__,
// 	'KNChurchtoolPlugin'
// );

// //Set the branch that contains the stable release.
// $myUpdateChecker->setBranch('fegab');

// //Optional: If you're using a private repository, specify the access token like this:
// $myUpdateChecker->setAuthentication('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');
