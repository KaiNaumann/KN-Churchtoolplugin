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
            
            $cal_CTid =  '3';
            // $cal[0];
            $CTname = $cal[1];
            $CTnametrans = $cal[2];
       
            $appointments = AppointmentRequest::forCalendar($cal_CTid)
            // ->where("from", "2023-11-01")
            // ->where("to", "2025-02-01")
            ->get();
            
            foreach ($appointments as $Appo) 
            {
                // $this->print_array($Appo);

                // Daten für den neuen Eintrag
                
                

                $args = array(
                    'post_type' => 'ctevent',
                    'meta_query' => array(
                        array(
                            'key' => 'acf_ctevent_id',
                            'value' => $Appo->getID(),
                            'compare' => '='
                        )
                    )
                );
        
                // Initialisiere die WP_Query
                $query = new \WP_Query($args);
                
                // Überprüfe, ob es bereits einen Beitrag mit dem gesuchten Wert gibt
                if (!$query->have_posts()) {
                    // Beitrag existiert noch nicht, also erstelle einen neuen Beitrag
                    
                    $new_post = array(
                        'post_title'    => $Appo->getCaption(),
                        'post_content'  => '',
                        'post_status'   => 'publish', // Veröffentlichen Sie den Eintrag
                        'post_type'     => 'ctevent',// Benutzerdefinierter Beitragstyp 'ctevent'
                    // Taxonomy terms
                        // 'tax_input'     => array(
                        //     'calender' => array( $CTnametrans ),
                        // ),
                    );

                   
                    $post_id = wp_insert_post( $new_post );

                    $this->print_array( [$post_id ,',',$Appo->getID()]);

                    // Aktualisiere das ACF-Feld im neuen Beitrag
                    update_field('acf_ctevent_id', $Appo->getID(), $post_id);
                } else {
                    // Beitrag mit dem gesuchten Wert existiert bereits
                    // Füge hier ggf. weiteren Code hinzu, um etwas anderes zu tun
                    // echo $Appo->getID() .' Post gibts schon';
                    $this->print_array( ['ist da,',$Appo->getID()]);
                }

                // Setze die ursprüngliche Abfrage zurück
                wp_reset_postdata();
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
