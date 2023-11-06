<?php
/**
 * @package  KNChurchtoolPlugin
 */
namespace inc\base;

class Activate
{
    public static function activate_plugin() 
	{
		flush_rewrite_rules();
    }
    
}
