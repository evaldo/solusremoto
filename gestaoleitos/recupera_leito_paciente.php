<?php
//select.php
session_start();
$output = '';
	
include '../database.php';
$pdo = database::connect();

$tipoconsultaleito = "";

if(isset($_GET['tipoconsultaleito'])) {
	
    $tipoconsultaleito = $_GET['tipoconsultaleito'];
	
	if ($tipoconsultaleito == "acmpt") {			
		$query = "select 
				  ds_leito
				, nm_pcnt 
				FROM integracao.tb_ctrl_leito WHERE fl_acmpte = 'true' ";
			
		$output .= '  
		<div class="table-responsive">  
           <table class="table table-bordered">
		   <tr>
			<th>Leito</th>
			<th>Paciente</th>
		   </tr>';
		$ret = pg_query($pdo, $query);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}   
		   
		//$row = pg_fetch_row($ret);
		while($row = pg_fetch_row($ret)) {
			$output .= '		
						 <tr>  							
							<td width="50%">'.$row[0].'</td>  							
							<td width="200%">'.$row[1].'</td>  
						 </tr>';
		}
		$output .= '</table></div>';
		
		echo $output;
			
			
	}
	
	if ($tipoconsultaleito == "rtgrd") {
		
		$query = "select 
				  ds_leito
				, nm_pcnt 
				FROM integracao.tb_ctrl_leito WHERE fl_rtgrd = 'true' ";
			
		$output .= '  
		<div class="table-responsive">  
           <table class="table table-bordered">
		   <tr>
			<th>Leito</th>
			<th>Paciente</th>
		   </tr>';
		$ret = pg_query($pdo, $query);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}   
		   
		//$row = pg_fetch_row($ret);
		while($row = pg_fetch_row($ret)) {
			$output .= '		
						 <tr>  							
							<td width="50%">'.$row[0].'</td>  							
							<td width="200%">'.$row[1].'</td>  
						 </tr>';
		}
		$output .= '</table></div>';
		
		echo $output;
			
	}
	
	if ($tipoconsultaleito == "status") {
		
		$query = "select 
				  fl_status_leito
				, count(1)
				FROM integracao.tb_ctrl_leito group by fl_status_leito";
			
		$output .= '  
		<div class="table-responsive">  
           <table class="table table-bordered">
		   <tr>
			<th>Status</th>
			<th>Quantidade</th>
		   </tr>';
		$ret = pg_query($pdo, $query);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}   
		   
		//$row = pg_fetch_row($ret);
		while($row = pg_fetch_row($ret)) {
			$output .= '		
						 <tr>  							
							<td width="50%">'.$row[0].'</td>  							
							<td width="200%" align="center">'.$row[1].'</td>  
						 </tr>';
		}
		$output .= '</table></div>';
		
		echo $output;
			
	}
	
	
	if ($tipoconsultaleito == "mdco_horiz") {
		
		$query = "SELECT nm_mdco_horiz
				 , count(id_mdco_horiz)     	 
			FROM integracao.tb_bmh_online 
			where nm_mdco_horiz is not null
			  and dt_alta is null
			group by nm_mdco_horiz";
			
		$output .= '  
		<div class="table-responsive">  
           <table class="table table-bordered">
		   <tr>
			<th>Médico Horizontal</th>
			<th>Pacientes Atendidos</th>
		   </tr>';
		$ret = pg_query($pdo, $query);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}   
		   
		//$row = pg_fetch_row($ret);
		while($row = pg_fetch_row($ret)) {
			$output .= '		
						 <tr>  							
							<td width="50%">'.$row[0].'</td>  							
							<td width="200%" align="center">'.$row[1].'</td>  
						 </tr>';
		}
		$output .= '</table></div>';
		
		echo $output;
			
	}
	
	if ($tipoconsultaleito == "mdco_assite") {
		
		$query = "SELECT nm_mdco_assite
				 , count(nm_mdco_assite)     	 
			FROM integracao.tb_bmh_online 
			where nm_mdco_assite is not null
			  and dt_alta is null
			group by nm_mdco_assite";
			
		$output .= '  
		<div class="table-responsive">  
           <table class="table table-bordered">
		   <tr>
			<th>Médico Assistente</th>
			<th>Pacientes Atendidos</th>
		   </tr>';
		$ret = pg_query($pdo, $query);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}   
		   
		//$row = pg_fetch_row($ret);
		while($row = pg_fetch_row($ret)) {
			$output .= '		
						 <tr>  							
							<td width="50%">'.$row[0].'</td>  							
							<td width="200%" align="center">'.$row[1].'</td>  
						 </tr>';
		}
		$output .= '</table></div>';
		
		echo $output;
			
	}
	
	
}
?>
