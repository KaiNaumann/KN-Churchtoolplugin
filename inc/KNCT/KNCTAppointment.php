<?php

// Use churchtools api wrapper from:
// https://github.com/5pm-HDH/churchtools-api

// probably a bit dated...
// https://github.com/vineyardkoeln/churchtools-api
namespace inc\KNCT;

use CTApi\Models\Calendars\Appointment\Appointment;
use CTApi\Models\Calendars\Appointment\AppointmentRequest;
use CTApi\Models\Calendars\Calendar\CalendarRequest;

        



class KNctAppointment
 {
    function knct_get_Appointments()
    {
        $calender = get_option ( 'kn_nct_cal' );
       
        $appointments = AppointmentRequest::forCalendars($calender)
            ->where("from", "2023-02-01")
            ->where("to", "2024-02-01")->get();
            foreach ($appointments as $lastAppointment) {
            

            echo '<br>' .( $lastAppointment->getId());
            // Output: 848

            echo '<br>' .( $lastAppointment->getCaption());
            // Output: "Service"

            echo '<br>' .( $lastAppointment->getStartDate());
            // Output: "2022-08-07T15:00:00Z"

            echo '<br>' .( $lastAppointment->getEndDate());
            // Output: "2022-08-07T16:00:00Z"

            echo '<br>' .( $lastAppointment->getStartDateAsDateTime()?->format("Y-m-d H:i:s"));
            // Output: "2022-08-07 15:00:00"

            echo '<br>' .( $lastAppointment->getEndDateAsDateTime()?->format("Y-m-d H:i:s"));
            // Output: "2022-08-07 16:00:00"


            echo '<br>' .( $lastAppointment->getAllDay());
            // Output: "false"


            echo '<br>' .( $lastAppointment->getNote());
            // Output: "Test Note"

            echo '<br>' .( $lastAppointment->getVersion());
            // Output: 1

            echo '<br>' .( $lastAppointment->getInformation());
            // Output: "Information Text"

            echo '<br>' .( $lastAppointment->getLink());
            // Output: "https://example.com"

            echo '<br>' .( $lastAppointment->getIsInternal());
            // Output: false


            // Repeat of Appointment
            echo '<br>' .( $lastAppointment->getRepeatId());
            // Output: 0

            echo '<br>' .( $lastAppointment->getRepeatFrequency());
            // Output: 1


            // Retrieve Address:
            echo '<br>' .( $lastAppointment->getAddress()?->getMeetingAt());
            // Output: "Evangelische Brückengemeinde"

            echo '<br>' .( $lastAppointment->getAddress()?->getStreet());
            // Output: "Wilhelmstraße 132"

            echo '<br>' .( $lastAppointment->getAddress()?->getAddition());
            // Output: "-"

            echo '<br>' .( $lastAppointment->getAddress()?->getDistrict());
            // Output: "-"

            echo '<br>' .( $lastAppointment->getAddress()?->getZip());
            // Output: "89518"

            echo '<br>' .( $lastAppointment->getAddress()?->getCity());
            // Output: "Heidenheim an der Brenz"

            echo '<br>' .( $lastAppointment->getAddress()?->getCountry());
            // Output: "DE"

            echo '<br>' .( $lastAppointment->getAddress()?->getLatitude());
            // Output: "48.680651"

            echo '<br>' .( $lastAppointment->getAddress()?->getLongitude());
            // Output: "10.130883553439624"
            echo '<p>';
        }
        


    }

    public function register() 
	{

    
    $this-> knct_get_Appointments();

    return;
	}

 }
