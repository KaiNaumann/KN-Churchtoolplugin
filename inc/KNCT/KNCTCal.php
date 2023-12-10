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
                $CT_Term_id = '';
                
                $new_cal_data = array($CTid,$CTname,$CTnametrans);
                
                
           
                if (in_array($new_cal_data, $cal_data)) {
                    
                }
                else{
                    
                    array_push($data, $CTid);
                    array_push($cal_data, $new_cal_data);
                    update_option( 'kn_nct_plugin',$data );
                    update_option( 'kn_nct_cal',$cal_data );
                    add_action('init', array ($this,'knct_term_Calendar'));
                };
             };

         

       
    }  

    
    public function knct_term_Calendar()
    {
        $cal_data = get_option( 'kn_nct_cal' );

        foreach ($cal_data as $cal) {

            $CTid = $cal[0];
            $CTname = $cal[1];
            $CTnametrans = $cal[2];

            
            $term_name = $CTname;

            // Taxonomie, zu der der Begriff hinzugefügt werden soll
            $taxonomy = 'calender'; // Ersetzen Sie 'Ihre_Taxonomie' durch den tatsächlichen Namen Ihrer Taxonomie

            // Optionen für den Begriff (optional)
            $args = array(
                'description' => $CTname,
                'slug'        => $CTnametrans,
                'parent'      => 0, // ID des übergeordneten Begriffs (falls zutreffend)
            );

            // Fügen Sie den Begriff zur Taxonomie hinzu
            $CT_Term_id = wp_insert_term($term_name, $taxonomy, $args);

           

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