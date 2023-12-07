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
    function knct_write_term(){

    
}

        public function knct_get_Cal($cal_data,$data)
    {
        $allCalendars = CalendarRequest::all();
        foreach($allCalendars as $Calender)
             {
                                                   
                $CTid = $Calender->getId();
                $CTname = $Calender->getName();
                $CTnametrans = $Calender->getNameTranslated();
                
                $new_cal_data = array($CTid,$CTname,$CTnametrans);
                
                

                if (in_array($CTid, $data)) {
                }
                else{
                    array_push($data, $CTid);
                    array_push($cal_data, $new_cal_data);
                };
             };

         update_option( 'kn_nct_plugin',$data );
         update_option( 'kn_nct_cal',$cal_data );
         add_action('init', array ($this,'knct_term_Calendar'));

       
    }  

    
    public function knct_term_Calendar()
    {
        $cal_data = get_option( 'kn_nct_cal' );
        // $this-> print_array($cal_data);

        foreach ($cal_data as $cal) {
            
            $CTid = $cal[0];
            $CTname = $cal[1];
            $CTnametrans = $cal[2];

            // Name des Begriffs, den Sie erstellen möchten
            $term_name = $CTname;

            // Taxonomie, zu der der Begriff hinzugefügt werden soll
            $taxonomy = 'calender'; // Ersetzen Sie 'Ihre_Taxonomie' durch den tatsächlichen Namen Ihrer Taxonomie

            // Optionen für den Begriff (optional)
            $args = array(
                'description' => $CTid,
                'slug'        => $CTnametrans,
                'parent'      => 0, // ID des übergeordneten Begriffs (falls zutreffend)
            );

            // Fügen Sie den Begriff zur Taxonomie hinzu
            wp_insert_term($term_name, $taxonomy, $args);

           

        };
    }

    public function register() 
	{
        global $Cal_data;

    
        $data = get_option( 'kn_nct_plugin' );
        $cal_data = get_option( 'kn_nct_cal' );
        $update = $data ['update'] ?? false;
               
        if ($update)  {
            $this-> knct_get_Cal($cal_data, $data);
            
                            
        };
           

    return;
	}
 }     