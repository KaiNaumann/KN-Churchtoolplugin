<?php
/**
 * @package  NewChurchtoolPlugin
 */
namespace inc\base;


class Deactivate
{
	public static function deactivate_plugin() {
		flush_rewrite_rules();

		// Access the database via SQL
		global $wpdb;
		// $wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'ctevent'" );
		// $wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
		// $wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
		// $wpdb->query( "DELETE FROM `wp_options` WHERE `option_name` = 'kn_nct_plugin'" );
		$wpdb->query( "DELETE FROM `wp_options` WHERE `option_name` = 'kn_nct_cal'" );

	}
}