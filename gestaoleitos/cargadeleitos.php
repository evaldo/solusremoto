<?php
	
    global $pdo;
	
	$pdo = @pg_connect("host=187.16.185.242 port=5430 dbname=vila_verde user=postgres password=!V3rd3V1l4#");
	
	$serverName = "52.67.44.208, 1433";
	$connectionInfo = array( "Database"=>"Sd_ClinVilaVerde", "UID"=>"vilaverde", "PWD"=>"*!zEtRebe6hA");
	$sqlserver = sqlsrv_connect( $serverName, $connectionInfo);
		
	global $objConnSqlServer;
	
	if ( $sqlserver )
	{
		$objConnSqlServer = $sqlserver;        				
	} else {
		echo "Erro de Conexão! Não foi possível conectar no Sistema de Prontuário Médico.";
		die( print_r( sqlsrv_errors(), true));			
	}
	
	//$objConnSqlServer = conexao_sqlserver::connectSqlServer();		
	
	$retSqlServer = "";	
	$result = "";
	
	$sql = '';
	$sqlPostgresql = '';
	
	$sqlPostgresql = "DELETE FROM integracao.tb_ctrl_leito_smart;";				
	$result = pg_query($pdo, $sqlPostgresql);

	if($result){
		echo "";
	}  
	
	$sql ="select  LOC_LEITO_ID as LOC_LEITO_ID,
			LOC_NOME as LOC_NOME, 
			SUBSTRING(LOC_LEITO_ID, 1, 1) AS DS_ANDAR,
			convert(nvarchar, hsp_dthre, 103) as HSP_DTHRE, 
			PAC_NOME as PAC_NOME, 		
			PAC_SEXO as PAC_SEXO, 
			convert(nvarchar, PAC_NASC, 103) as PAC_NASC,
			CNV_NOME as CNV_NOME
	FROM dbo.view_db_gest_leitos ORDER BY 1";
	
	
	if ($objConnSqlServer){
		
		$retSqlServer = sqlsrv_query($objConnSqlServer,$sql);
	
		if($retSqlServer === false) {
			die( print_r( sqlsrv_errors(), true) );
		}	
	} else {
		
		echo "Erro de Conexão! Não foi possível conectar no Sistema de Prontuário Médico.";		
		
	}

	while($row = sqlsrv_fetch_array($retSqlServer, SQLSRV_FETCH_ASSOC)) {
		$sqlPostgresql = "INSERT INTO integracao.tb_ctrl_leito_smart (LOC_LEITO_ID, DS_LEITO, DS_ANDAR, DT_PRVS_ALTA, NM_PCNT, DS_SEXO, DT_NASC_PCNT, NM_CNVO) VALUES ('" . $row['LOC_LEITO_ID'] . "', '" . $row['LOC_NOME'] . "', '" . $row['DS_ANDAR'] . "', '" . $row['HSP_DTHRE'] . "', '" . $row['PAC_NOME'] . "', '" . $row['PAC_SEXO'] . "', '" . $row['PAC_NASC'] . "', '" . $row['CNV_NOME'] . "')";
		
		$result = pg_query($pdo, $sqlPostgresql);

		if($result){
			echo "";
		} 		
	}
	
?>