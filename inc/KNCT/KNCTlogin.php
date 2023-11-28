<?php

// require __DIR__ . '/vendor/autoload.php';

// Use churchtools api wrapper from:
// https://github.com/5pm-HDH/churchtools-api

// probably a bit dated...
// https://github.com/vineyardkoeln/churchtools-api
namespace inc\KNCT;

use \CTApi\CTConfig;



class KNctLogin 
 {
  function url_exists($url) {
    $response = wp_safe_remote_head($url); // Send a HEAD request to the URL

    if (is_wp_error($response)) {
        return false; // URL does not exist or there was an error
    }
    $response_code = wp_remote_retrieve_response_code($response);
  
    return $response_code === 200; // Check if the response code is 200 (OK)
  }
  public function ct_login($data) 

  {
    
    $url = "https://" . $data['url'].".church.tools";
    $usr = $data['user'];
    $pwd = $data['password'];

    
  
      

    
    // Configuration
    CTConfig::setApiUrl($url);
    //authenticates the application and load the api-key into the config
      try {
        CTConfig::authWithCredentials(
          $usr,
          $pwd
        );
      } catch ( Exception $e){
        echo $e->getMessage();
        return;
      }


      // if everything works fine, the api-key is stored in your config
      $isValid = CTConfig::validateAuthentication();
      if($isValid){
          // echo "ApiKey is still valid!";
          $data = get_option( 'kn_nct_plugin' );
          $data['status']= 'ApiKey is still valid';
          
          update_option( 'kn_nct_plugin', $data);


      }else{
          $data = get_option( 'kn_nct_plugin' );
          $data['status']=  "ApiKey is not valid anymore!";
          update_option( 'kn_nct_plugin', $data);
      }


  }
  public function register() 
	{

    
    $data = get_option( 'kn_nct_plugin' );
    $url = "https://" . $data['url'].".church.tools";
    $isValid = $data['url'] != '' AND $data['user'] != '' AND $data['password'] != '' AND $this-> url_exists($url);;

    if ($isValid)
        {
            $this-> ct_login($data);
            
    
        }
    else
        {
          $data['status'] = 'Nicht vollständig';
          update_option( 'kn_nct_plugin', $data);
        }
    return;
	}

}


