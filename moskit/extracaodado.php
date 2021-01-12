<?php

$curl = curl_init();

//https://moskit.stoplight.io/docs/api-v1/spec-api-v1.yaml/paths/~1activities/get

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.moskitcrm.com/v1/activities",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Prefer: code=200",
    "apikey: 8bdfd523-0bd9-4311-a1c9-4c5b706c6739"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} 

$json_array=json_decode($response,true); 
display_array_recursive($json_array);
function display_array_recursive($json_rec){
	if($json_rec){
		foreach($json_rec as $key=> $value){
			if(is_array($value)){								
				if ($key<>0) {echo '<br>';}
				echo $key.'<br>';				
				display_array_recursive($value);												
				if ($value == null) {echo 'vazio<br>';}				
			}else{				
				echo $key.':'.$value.'<br>';								
			}	
		}	
	}	
}	
?>