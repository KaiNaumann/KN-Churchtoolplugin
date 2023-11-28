<?php

/**
 * @package  NKChurchtoolPlugin
 */
namespace inc;

final class init 
{
    
     public static function register_services()
    {
    
        foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
    }


    public static function get_services() 
    {
        return [
			            
            base\Enqueue::class,
            pages\Dashboard::class,
            KNCT\KNctSetup::class,
            KNCT\KNctLogin::class,
            KNCT\KNctCal::class,
            KNCT\KNctAppointment::class,
               
        ];
    }
    private static function instantiate( $class )
	{
		$service = new $class();

		return $service;
	}
}

