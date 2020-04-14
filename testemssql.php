<?php
// 52.67.44.208
$serverName = "52.67.44.208, 1433";
$connectionInfo = array( "Database"=>"Sd_ClinVilaVerde", "UID"=>"vilaverde", "PWD"=>"*!zEtRebe6hA");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
	$result = sqlsrv_query($conn,"select * FROM dbo.view_db_gest_leitos;");
	
	if($result === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	
	while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) ) {
		echo $row['PAC_REG'].", ".$row['PAC_NOME']."<br />";
	}
 
    unset($conn); 
    unset($result);

?>


