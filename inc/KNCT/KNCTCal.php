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
        
        
        function add_new_term_to_custom_category_taxonomy() {
           
        }        
        
        public function list_taxonomy_terms_for_ctevent($taxonomy_name) {
            
            $taxonomy = 'kalender';  // Replace 'kalender' with your actual taxonomy slug
            $post_type = 'ctevent';   // Replace 'ctevent' with your actual custom post type
            
            $terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'hide_empty' => false, // Set to true if you want to hide terms with no posts
            ));
            
            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<ul>';
                foreach ($terms as $term) {
                    echo '<li>' . $term->term_id . ': ' . $term->name . '</li>';
                }
                echo '</ul>';
            } else {
                echo 'No terms found.';
            }

        }
        
        function create_new_term($id, $name,$nametrans  ) {
            $term = $name; // Replace with the name of the term you want to create
            $description = $nametrans ;
            $taxonomy = 'kalender'; // Replace with your actual taxonomy slug
            $args = array(
                'description' => $description, // Add a description if needed
                'slug'        => sanitize_title($term),
            );
        
            $result = wp_insert_term($term, $taxonomy, $args);
        
            if (is_wp_error($result)) {
                echo 'Error creating term: ' . $result->get_error_message();
            } else {
                echo 'Term created successfully with ID ' . $result['term_id'];
            }
        }

        
        
        public function knct_get_CalID()
        {
            $allCalendars = CalendarRequest::all();
            $data = get_option( 'kn_nct_cal' );
            foreach($allCalendars as $Calender)
                 {
                    
                    $CTid = $Calender->getId();
                    $CTname = $Calender->getName();
                    $CTnametrans = $Calender->getNameTranslated();
                    if (in_array($CTid, $data)) {
                    }
                    else{
                  array_push($data, $CTid);
                        }
                add_action('init', function() use ($CTid) {
                            // Your code here that uses $CTid
                            $this->create_new_term($CTid, $CTname,$CTnametrans );
                        });
            };

             update_option( 'kn_nct_cal',$data );
           $cal =  $this ->print_array ($data);
        //    $this-> create_new_term();
        //    add_action( 'init', array ($this, 'create_new_term'));


        }
        
    public function register() 
	{
    
        $data = get_option( 'kn_nct_plugin' );
        
        $update = $data ['update'] ?? false;
        
       
        if ($update)  {
            $this-> knct_get_CalID();
        };
        
    //    $this-> list_taxonomy_terms_for_ctevent('kalender');
    //    $this-> list_taxonomy_terms_for_ctevent('category');
        // 
        
        
        // $this->add_new_term_to_custom_category_taxonomy();

    return;
	}

 }