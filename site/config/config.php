<?php

return [
    'debug'  => true,
    'home' => 'station-gdm',
    'routes' => [
    	[
	      'pattern' => 'newsletter-subscribe',
	      'method' => 'POST',
	      'action'  => function () {
	        $LIST_ID = '0b2f1b107f';
	        $API_KEY = '4128d0a8a3da8e3dd1c51d6e516286c0-us17';
	        $API_SERVER = 'us17';
	        $url = "https://${API_SERVER}.api.mailchimp.com/3.0/lists/${LIST_ID}/members";

	        $user_email = $_POST['newsletter-email'];
	        $params = ['email_address' => $user_email, 'status' => 'subscribed'];
	       
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params)); 
	        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	          'Content-type: application/json'
	        )); 
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_USERPWD,  "key:" . $API_KEY);
	         
	        $response = curl_exec($ch);
	        curl_close($ch);
	        return $response;

	      }
	    ]
    ]
];