<?php
// 52.67.44.208

$connection_string = 'DRIVER={SQL Server};SERVER=191.235.100.131,2071;DATABASE=Sd_ClinVilaVerde';

$user = 'vilaverde';
$pass = '&tH5#@06bJT';

$conn = odbc_connect( $connection_string, $user, $pass );

//$serverName = "191.235.100.131,2071";
//$connectionInfo = array( "Database"=>"Sd_ClinVilaVerde", "UID"=>"vilaverde", "PWD"=>"&tH5#@06bJT");
//$conn = sqlsrv_connect( $serverName, $connectionInfo);

	if( $conn ) {
		 echo "Connection established.<br />";
		 $result = odbc_exec($conn, 'select * FROM dbo.view_db_gest_leitos;');
	
		if(!$result) {
			exit("Erro ao abrir a consulta no Smart");
		}
		
		$output = array();
		while($row=odbc_fetch_object($result))  {     
			echo "".$row->PAC_REG." - ".$row->PAC_NOME." </br>" ;					
		}
		
		echo(json_encode($output));
		
		unset($conn); 
		unset($result);
		
	}else{
		
		 exit("Connection could not be established.");     
		 
	}
	
?>


