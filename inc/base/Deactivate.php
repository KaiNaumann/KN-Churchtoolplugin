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
		$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'ctevent'" );
		$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
		$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
		// $wpdb->query( "DELETE FROM `wp_options` WHERE `option_name` = 'kn_nct_plugin'" );
		$wpdb->query( "DELETE FROM `wp_options` WHERE `option_name` = 'kn_nct_cal'" );
		// Taxonomie-Namen
			$taxonomy_name = 'calender';

			// SQL-Abfrage zum Löschen aller Begriffe dieser Taxonomie
			$sql = "DELETE FROM $wpdb->term_taxonomy WHERE taxonomy = '$taxonomy_name'";
			$wpdb->query($sql);

			// Optional: Zurücksetzen der Auto-Increment-Werte der Term-Tabelle
			$wpdb->query("ALTER TABLE $wpdb->terms AUTO_INCREMENT = 1");
			$wpdb->query("ALTER TABLE $wpdb->term_taxonomy AUTO_INCREMENT = 1");
			$taxonomy_name = 'kalender';

			// SQL-Abfrage zum Löschen aller Begriffe dieser Taxonomie
			$sql = "DELETE FROM $wpdb->term_taxonomy WHERE taxonomy = '$taxonomy_name'";
			$wpdb->query($sql);

			// Optional: Zurücksetzen der Auto-Increment-Werte der Term-Tabelle
			$wpdb->query("ALTER TABLE $wpdb->terms AUTO_INCREMENT = 1");
			$wpdb->query("ALTER TABLE $wpdb->term_taxonomy AUTO_INCREMENT = 1");
	}
}