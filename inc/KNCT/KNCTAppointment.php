<?php

// Use churchtools api wrapper from:
// https://github.com/5pm-HDH/churchtools-api

// probably a bit dated...
// https://github.com/vineyardkoeln/churchtools-api
namespace inc\KNCT;

use CTApi\Models\Calendars\Appointment\Appointment;
use CTApi\Models\Calendars\Appointment\AppointmentRequest;
use CTApi\Models\Calendars\Calendar\CalendarRequest;
use CTApi\Models\Calendars\CombinedAppointment\CombinedAppointmentRequest;
use CTApi\Models\Events\Event\EventAgendaRequest;
use CTApi\Models\Events\Event\EventRequest;

        



class KNctAppointment
 {
    public function print_array($array)
        {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

    
    function knct_get_Appointments()
    {
        $cal_data = get_option ( 'kn_nct_cal' );
        foreach ($cal_data as $cal) {
            
            $CTid = $cal[0];
            $CTname = $cal[1];
            $CTnametrans = $cal[2];
       
            $appointments = AppointmentRequest::forCalendar($CTid)
            // ->where("from", "2023-11-01")
            // ->where("to", "2025-02-01")
            ->get();
            
            foreach ($appointments as $Appo) 
            {
            // Daten für den neuen Eintrag
                $new_post = array(
                    'post_title'    => $Appo->getID(),
                    'post_content'  => $Appo->getCaption(),
                    'post_status'   => 'publish', // Veröffentlichen Sie den Eintrag
                    'post_type'     => 'ctevent',// Benutzerdefinierter Beitragstyp 'ctevent'
                // Taxonomy terms
                    // 'tax_input'     => array(
                    //     'calender' => array( $CTnametrans ),
                    // ),
                );
                // $this-> print_array($new_post);
                $post_id = wp_insert_post( $new_post );

                
            }
       
        };


    }

    public function register() 
	{

       
        // ... other details
    
        add_action('init', array ($this, 'knct_get_Appointments'));

    return;
	}

 }
