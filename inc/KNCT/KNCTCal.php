<?php

// Use churchtools api wrapper from:
// https://github.com/5pm-HDH/churchtools-api

// probably a bit dated...
// https://github.com/vineyardkoeln/churchtools-api

namespace inc\KNCT;

use CTApi\Models\Calendars\Appointment\Appointment;
use CTApi\Models\Calendars\Appointment\AppointmentRequest;
use CTApi\Models\Calendars\Calendar\CalendarRequest;
use inc\Api\Callbacks\AdminCallbacks;
        



class KNctCal 
 {
        public function print_array($array)
        {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }
        function knct_get_CalID()
        {
            $allCalendars = CalendarRequest::all();
            $data = get_option( 'kn_nct_cal' );
            foreach($allCalendars as $Calender)
                {
                    
                    $CTid = $Calender->getId();
                    if (in_array($CTid, $data)) {
                    }
                    else{
                    array_push($data, $CTid);
                    }
                };

            update_option( 'kn_nct_cal',$data );

        }
        
    public function register() 
	{
    
        $data = get_option( 'kn_nct_plugin' );
        
        $update = $data ['update'] ?? false;
        
       
        if ($update)  {
            $this-> knct_get_CalID();
        };

    // return;
	}

 }