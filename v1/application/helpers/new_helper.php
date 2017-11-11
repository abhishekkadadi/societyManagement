<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

 function push_notify($managers,$message){
		
// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AAAATGEzYGI:APA91bEkagYmFofG3ho0doFIDEx4IJPkEBhLYltRP98HiiuA-YvERiC_ANArUEoSbf5BSqDySguex2dndXTAUWYyMVwu6HQV3zrEKUSvw1gZDcvmyRUpAxayV8FqXTYxrmYNKVVFi2SuMBw4aturnEczuW6j0TkfEw' );
$registrationIds =$managers;
// prep the bundle
$msg = array
(
    'message'   => $message,
    'title'     => '',
    'subtitle'  => '',
    'tickerText' => '',
    'vibrate'   => 1,
    'sound'     => 1,
    'largeIcon' => 'large_icon',
    'smallIcon' => 'small_icon'
);
$fields = array
(
    'registration_ids'  => $registrationIds,
    'data'          => $msg
);
 
$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
return;

}