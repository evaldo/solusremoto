<?php

session_start();		
	
include '../database.php';
$pdo = database::connect();

$curl = curl_init();

//https://moskit.stoplight.io/docs/api-v1/spec-api-v1.yaml/paths/~1activities/get

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.moskitcrm.com/v2/deals",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Prefer: code=200",
    "apikey: 3e249198-a0f7-4408-ba5c-dc53a9838677"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} 

$json_array=json_decode($response,true); 


$sql = "delete from integracao.tb_moskit_cnto";
$result = pg_query($pdo, $sql);
if($result){
	echo "";
} 

foreach($json_array as $key => $value) { 
	if ($value["status"] == 'OPEN') {
		$sql = "insert into integracao.tb_moskit_cnto (id_moskit_deal, ds_entde_cnto, nm_cnto, ds_status) values (".$value["id"].", '".$value["origin"]."', '".$value["name"]."', '".$value["status"]."')";    
	} else {
		$sql = "insert into integracao.tb_moskit_cnto (id_moskit_deal, ds_entde_cnto, nm_cnto, ds_status, dt_fchto) values (".$value["id"].", '".$value["origin"]."', '".$value["name"]."', '".$value["status"]."', '".$value["closeDate"]."')"; 
	}
	
	//echo $sql;
	
	$result = pg_query($pdo, $sql);
	if($result){
		echo "";
	} 
	
}

?>