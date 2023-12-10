<?php
/**
 * @package  KNChurchtoolPlugin
 */
namespace inc\base;
use CTApi\CTLog;
class Activate
{

	
    public static function activate_plugin() 
	{
		flush_rewrite_rules();

		CTLog::enableFileLog(); // enable logfile

// Grundwerte setzten
        $existingOptions = get_option('kn_nct_plugin');

        // Überprüfen, ob das Options-Array bereits existiert
        if (false === $existingOptions) {
            // Wenn es nicht existiert, ein leeres Array erstellen
            $existingOptions = array();
        }

		$default_KN_NCT = [
			'url'			=>'',
			'user'			 => '',
			'password'		 => '',
			'status'		 => '',
			'update' 		=> FALSE
			];


	if ( !get_option( 'kn_nct_plugin' ) ) {
			add_option( 'kn_nct_plugin',$default_KN_NCT );
            
		} else 
		{
			$data = get_option( 'kn_nct_plugin' );
        
			$default_KN_NCT = [
				'url'=>$data['url'],
				'user' => $data['user'],
				'password' => $data['password'],
				'status' => 'new',
				
			];
			update_option( 'kn_nct_plugin', $default_KN_NCT );

		};
		
// Calender Array erstellen
		
	$existingOptions = get_option('kn_nct_cal');

// Überprüfen, ob das Options-Array bereits existiert
		if (false === $existingOptions) {
			// Wenn es nicht existiert, ein leeres Array erstellen
			$existingOptions = array();
		}
		$default_KN_NCT_cal = [];
		if ( !get_option( 'kn_nct_cal' ) ) {
			add_option( 'kn_nct_cal',$default_KN_NCT_cal );
            
		}
       
		
	}

	

    
}
