<?php
	
	error_reporting(0);
	
	$page = $_SERVER['PHP_SELF'];
	$sec = "10";
	
	$connection_string = 'DRIVER={SQL Server};SERVER=191.235.100.131,2071;DATABASE=Sd_ClinVilaVerde';

	$user = 'vilaverde';
	$pass = '&tH5#@06bJT';

	$conn = odbc_connect( $connection_string, $user, $pass );

	if( $conn ) {		 
		 $result = odbc_exec($conn, "SELECT * from dbo.vw_painel_farmacia ORDER BY num  ASC");
	
		if(!$result) {
			exit("Erro ao abrir a consulta no Smart");
		}
		
		?>
		
		<html>
			<head>
				<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">				
				<meta charset="utf-8">
				<title>Painel da Farmácia</title>
			</head>
		<body>
		
		<link rel="stylesheet" href="../css/bootstrap.min.css">
            <script src="../js/jquery.min.js"></script>
            <script src="../js/popper.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>            	
			<style>
				p{
					color:white; 
					margin:6px; 
					font-size:1em;
				}
				
				blink {
				   -webkit-animation-name: blink; 
				   -webkit-animation-iteration-count: infinite; 
				   -webkit-animation-timing-function: cubic- 
					bezierr(1.0,0,0,1.0);
					-webkit-animation-duration: 1s;
				}
				
				.blink_me {
			  animation: blinker 1s linear infinite;
			}

			@keyframes blinker {
			  50% {
				opacity: 0;
			  }
			}
			</style>
        </head>
        <body>
		
		<div class="container" align="center">  
		  <form class="form-inline" action="#" method="post" >
				<div class="table-responsive" align="center">
					<table class="table">
						<tr>
							<td width="15%" align="left"><h1>Painel da Farmárcia - Solicitações</h1></td>
						</tr>
					</table>
				</div>
				<p><font color="black">Opções para consulta:</a></p>
				<select class="form-control" name="cmdoptconsulta">					
					<option value="paciente" id="cmboptpaciente">Paciente</option>								
					<option value="paciente" id="cmboptpaciente">Período</option>								
				</select>&nbsp;&nbsp;&nbsp;&nbsp;				
				<input type="text" class="form-control" name="textoconsulta">&nbsp;&nbsp;			
				<input class="btn btn-primary" type="submit" value="Consultar" name="botaoconsultar">&nbsp;&nbsp;					 	
		  </form>		  
		</div>
		<hr>
			
		<br>
		
		<div class="container">
        <div class="card-deck text-center">
		
		<?php
			$output = array();
			while($row=odbc_fetch_object($result))  {     
				?>
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="card text-white bg-success mb-2">
						<div class="card-body"  style="height: 14rem">
							<input type="button" name="view" value="<?php echo trim($row->num); ?>" id="<?php echo trim($row->num); ?>" class="btn btn-secondary btn-xs view_data" />
							<?php
								echo "<p class=\"card-text\">". substr($row->pac_nome, 0, 20) . "</p>";
							?>
						</div>
					</div>
				</div>
				<?php				
			}
			
			$result = odbc_exec($conn, 'select getdate() as data_atual ');
		
			if(!$result) {
				exit("Erro ao consultar Data no Smart");
			}
			$row=odbc_fetch_object($result);
			
			//$data_1 = $row->data_atual;
			//$data_1 = explode("/", $data_1);
			//list($dia, $mes, $ano) = $data_1;
			//$data_1 = "$dia/$mes/$ano";	
			
			//$data_2 = $row->data_atual;		
			
			//$nm_obj = "teste bom!!!";
			//$dt_exec_obj = $data_1;
			//$dt_exec_obj_2 = $data_2;
			
			// $sql = "insert into dbo.log_exec_obj (nm_obj, dt_exec_obj, dt_exec_obj_segundo) VALUES ('".$nm_obj."', '".$dt_exec_obj."', '".$dt_exec_obj_2."')";
			// echo $sql;
			//if (!odbc_exec($conn, $sql)) {
			//	print("SQL statement failed with error:\n");
			//	print(odbc_error($conn).": ".odbc_errormsg($conn)."\n");
			//} else {
			//	print("1 rows inserted.\n");
			//}
			
			unset($conn); 
			unset($result);
			
		}else{
			
			 exit("Connection could not be established.");     
			 
		}
	
	?>
	
	</body>
</html>



