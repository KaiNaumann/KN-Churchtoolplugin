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
        // define('WP_USE_THEMES', false);
        // require('path-to-your-wordpress/wp-load.php');
        $cal_data = get_option ( 'kn_nct_cal' );
       

        foreach ($cal_data as $cal) {
            $cal_CTid = $cal[0];
            $cal_CT_name = $cal[2];
            $appointments = AppointmentRequest::forCalendar($cal_CTid)->get();
            // // $this->print_array($appointments);
            foreach ($appointments as $appointment)
            {
                $CT_appointment_titel = $appointment->getCaption();
                $CT_appointment_id = $appointment->getid();
                // Überprüfe, ob die Kategorie mit dem gegebenen Titel vorhanden ist
                $term = get_term_by('name', $cal_CT_name, 'calender');
                // if ($term) {
                    $term_id = $term->term_id;
                //     echo 'Die Term-ID für "Dein Taxonomie-Titel" in "calender" ist: ' . $term_id;
                // } else {
                //     echo 'Der Term wurde nicht gefunden.';
                // }

                $new_post = array(
                    'post_title'    => $CT_appointment_titel,
                    'post_content'  => $CT_appointment_id,
                    'post_status'   => 'publish', // Veröffentlichen Sie den Eintrag
                    'post_type'     => 'ctevent',// Benutzerdefinierter Beitragstyp 'ctevent'
                    // Taxonomy terms
                        'tax_input'     => array(
                            'calender' => $term_id
                        ),
                    );

                // Definiere die Abfrage für den Post-Typ 'ctevent'
                $args = array(
                    'post_type' => 'ctevent',  // Ändere dies auf den gewünschten Post-Typ, wenn es nicht 'post' ist
                        'post_status' => 'publish',  // Du kannst den Status anpassen, wenn nötig
                        'posts_per_page' => 1,  // Hier wird nur ein Beitrag abgerufen
                        'meta_query' => array(
                            array(
                                'key' => 'post_content',
                                'value' => $CT_appointment_id,
                                'compare' => '='
                            )
    )
                );

                // Erstelle die Abfrage
                $ctevent_query = new \WP_Query($args);

                // Überprüfe, ob es Beiträge gibt
                if ($ctevent_query->have_posts()) {
                    echo 'Es gibt Beiträge vom Post-Typ ctevent.';
                    
                    // Setze die Abfrage zurück, um Konflikte zu vermeiden
                    wp_reset_postdata();
                } else {
                    
                    $post_id = wp_insert_post( $new_post );

                    // $this->print_array( [$post_id ,',',$CT_appointment_id]);
                };

                
            };

        
        }
            
            
    }

    public function register() 
	{

       
        // ... other details
    
        add_action('init', array ($this, 'knct_get_Appointments'));

    return;
	}

 }
