<?php

include '../database.php';	
session_start();		
//error_reporting(0); 

global $pdo;	

$curl = curl_init();

//https://moskit.stoplight.io/docs/api-v1/spec-api-v1.yaml/paths/~1activities/get

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.moskitcrm.com/v1/deals",
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


display_array_recursive_parte_1($json_array);
display_array_recursive_parte_2($json_array);

function display_array_recursive_parte_1($json_rec){
	
	$id_anterior=0;
	$ds_entidade_contato='';
	$nm_contato='';
	$ds_status='';
	$dt_fchto=0;
	$sql='';
	$sql_value='';
		
	
	$pdo = database::connect();
	
	if($json_rec){
		foreach($json_rec as $key=> $value){
			if(is_array($value)){								
				display_array_recursive_parte_1($value);
				$sql_value='';
				
			}else{

				if ($value <> '0' && $key=='id') {
					$id_anterior=$value;
					$sql_value.= $id_anterior.',';
				}	
				
				if ($key=='name') {
					$nm_contato = $value;
					$sql_value.= "'".$nm_contato."',";
						
				}					
				
				if ($value == 'Deal' && $key=='entity') {
					$ds_entidade_contato = $value;
					$sql_value.= "'".$ds_entidade_contato."',";
				}								
				
				if ($key=='status' ) {
					$ds_status = $value;
					$sql_value.= "'".$ds_status."'";
					$sql = "insert into integracao.tb_moskit_cnto (id_moskit_deal, ds_entde_cnto, nm_cnto, ds_status) values (".$sql_value.");";
				
					//echo $sql .'<br>';
				
					$result = pg_query($pdo, $sql);

					if($result){
						echo "";
					}  
				} 					
			}	
		}

	}	
}
function display_array_recursive_parte_2($json_rec){
	
	$id_anterior=0;	
	
	$pdo = database::connect();
	
	if($json_rec){
		foreach($json_rec as $key=> $value){
			if(is_array($value)){								
				display_array_recursive_parte_2($value);				
			}else{
				if ($value <> '0' && $key=='id') {					
					$id_anterior=$value;					
				}	
				
				if ($key=='closeDate') {					
					$dt_fchto = $value;
					$sql = "update integracao.tb_moskit_cnto set dt_fchto = to_timestamp(".$dt_fchto."/1000) where id_moskit_deal = '".$id_anterior."';";
					
					$result = pg_query($pdo, $sql);

					if($result){
						echo "";
					}  
				} 					
			}	
		}
	}	
}
?>