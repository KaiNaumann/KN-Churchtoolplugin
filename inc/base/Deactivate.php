<?php
/**
 * @package  NewChurchtoolPlugin
 */
namespace inc\base;


class Deactivate
{
	public static function deactivate_plugin() {
		flush_rewrite_rules();

	}
}