<?php

// require __DIR__ . '/vendor/autoload.php';

// Use churchtools api wrapper from:
// https://github.com/5pm-HDH/churchtools-api

// probably a bit dated...
// https://github.com/vineyardkoeln/churchtools-api
namespace inc\KNCT;

use \CTApi\CTConfig;
use CTApi\Models\Events\Event\EventAgendaRequest;
use CTApi\Models\Events\Event\EventRequest;



class KNctEvent
 {
    function knct_get_events()
    {
        // Retrieve all events
        // $allEvents = EventRequest::all();
        // Filter events in period
        $new_events = EventRequest::where('from', '2023-10-24')
                                        ->where('to', '2023-12-26')
                                        ->orderBy('id')
                                        ->get();
            
  
     foreach($new_events as $new_event)
     {
        
        echo '<p>'.( $new_event->getId());
        // Output: 21

        echo '<p>'.( $new_event->getGuid());
        // Output: "guid21"

        echo '<p>'.( $new_event->getName());
        // Output: "Sunday Service"

        echo '<p>'.( $new_event->getDescription());
        // Output: "Service Description"

        echo '<p>'.( $new_event->getStartDate());
        // Output: "2021-09-02 20:15:00"

        echo '<p>'.( $new_event->getEndDate());
        // Output: "2021-09-02 22:00:00"

        echo '<p>'.( $new_event->getStartDateAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "2021-09-02 20:15:00"

        echo '<p>'.( $new_event->getEndDateAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "2021-09-02 22:00:00"

        echo '<p>'.( $new_event->getChatStatus());
        // Output: false

    //     echo '<p>'.( $new_event->getPermissions());
    //     // Output: null

    //     echo '<p>'.( $new_event->getCalendar());
    //     // Output: null

    //     echo '<p>'.( $new_event->getEventServices());
    //     // Output: []
     }
    }

    public function register() 
	{

    
    $this-> knct_get_events();

    return;
	}

 }
