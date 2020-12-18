<?php
	
	error_reporting(0);
	
	$connection_string = 'DRIVER={SQL Server};SERVER=191.235.100.131,2071;DATABASE=Sd_ClinVilaVerde_Teste';

	$user = 'vilaverde';
	$pass = '&tH5#@06bJT';

	$conn = odbc_connect( $connection_string, $user, $pass );

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
		
		$result = odbc_exec($conn, 'select getdate() as data_atual ');
	
		if(!$result) {
			exit("Erro ao consultar Data no Smart");
		}
		
		$row=odbc_fetch_object($result);
		
		$data_1 = $row->data_atual;
		$data_1 = explode("/", $data_1);
		list($dia, $mes, $ano) = $data_1;
		$data_1 = "$dia/$mes/$ano";	
		
		$data_2 = $row->data_atual;		
		
		$nm_obj = "teste bom!!!";
		$dt_exec_obj = $data_1;
		$dt_exec_obj_2 = $data_2;
		
		 $sql = "insert into dbo.log_exec_obj (nm_obj, dt_exec_obj, dt_exec_obj_segundo) VALUES ('".$nm_obj."', '".$dt_exec_obj."', '".$dt_exec_obj_2."')";
		 echo $sql;
		if (!odbc_exec($conn, $sql)) {
			print("SQL statement failed with error:\n");
			print(odbc_error($conn).": ".odbc_errormsg($conn)."\n");
		} else {
			print("1 rows inserted.\n");
		}
		
		unset($conn); 
		unset($result);
		
	}else{
		
		 exit("Connection could not be established.");     
		 
	}
	
?>


