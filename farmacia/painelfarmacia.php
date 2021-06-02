<?php
	
	error_reporting(0);
	
	$pdo = @pg_connect("host=187.16.185.242 port=5430 dbname=vila_verde user=postgres password=!V3rd3V1l4#");
    
	$sql="SELECT tp_atlz_pnel FROM integracao.tb_param_pnel_farmc";
		
	if ($pdo==null){
			header(Config::$webLogin);
	}	
    $ret = pg_query($pdo, $sql);
    if(!$ret) {
        echo pg_last_error($pdo);
        exit;
    }
	
	$rowparamfarmc = pg_fetch_row($ret);	
	
	$page = $_SERVER['PHP_SELF'];
	$sec = $rowparamfarmc[0];	
			
	$connection_string = 'DRIVER={SQL Server};SERVER=191.235.100.131,2071;DATABASE=Sd_ClinVilaVerde';

	$user = 'vilaverde';
	$pass = '&tH5#@06bJT';

	$conn = odbc_connect( $connection_string, $user, $pass );
	
	if(isset($_POST['botaoconsultar'])){		
		
		if( $conn ) {		 
			$result = odbc_exec($conn, "SELECT getdate() as dataatual");	
			if(!$result) {
				exit("Erro ao abrir a consulta no Smart");
			}
		}else{			
			exit("Connection could not be established.");     			 
		}
		
		$rowdataatual=odbc_fetch_object($result);
		
		$ano = substr($rowdataatual->dataatual,0,4);
		$mes = substr($rowdataatual->dataatual,5,2);
		$dia = substr($rowdataatual->dataatual,8,2);
					
		$dataatual = trim($ano)."/".trim($mes)."/".trim($dia);
		
		$data_1 = $dataatual;
		$data_2 = $dataatual;			
		
		if($_POST['dtinicio'] <> "//"){
			$ano = substr($_POST['dtinicio'],0,4);
			$mes = substr($_POST['dtinicio'],5,2);
			$dia = substr($_POST['dtinicio'],8,2);
					
			$data_1 = trim($ano)."/".trim($mes)."/".trim($dia);
			$data_1_update = trim($dia)."/".trim($mes)."/".trim($ano);
			
		} 
		
		if($_POST['dtfim'] <> "//"){
			$ano = substr($_POST['dtfim'],0,4);
			$mes = substr($_POST['dtfim'],5,2);
			$dia = substr($_POST['dtfim'],8,2);
					
			$data_2 = trim($ano)."/".trim($mes)."/".trim($dia);
			$data_2_update = trim($dia)."/".trim($mes)."/".trim($ano);
			
		}		
				
		$query = "SELECT * 
					FROM dbo.vw_painel_farmacia 
				 WHERE sma_data >= '".$data_1."' 
				   AND sma_data <= '".$data_2."' 
				 ORDER BY num  ASC";
		
		if ($pdo==null){
			header(Config::$webLogin);
		}		
		try
		{	
			$sql = "update integracao.tb_param_pnel_farmc 
					set dt_inicial_cnlta_pnel = to_date('".$data_1_update."', 'dd/mm/yyyy')
					    , dt_final_cnlta_pnel = to_date('".$data_2_update."', 'dd/mm/yyyy')";				
			$result = pg_query($pdo, $sql);
			if($result){
				echo "";
			}  			
			
		} catch(PDOException $e) {
			die($e->getMessage());
		}
		
		$sql="SELECT to_char(dt_inicial_cnlta_pnel, 'yyyy/mm/dd'), to_char(dt_final_cnlta_pnel, 'yyyy/mm/dd') FROM integracao.tb_param_pnel_farmc";
		
		if ($pdo==null){
				header(Config::$webLogin);
		}	
		$ret = pg_query($pdo, $sql);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}
		
		$rowparamfarmc = pg_fetch_row($ret);
		$data_1 = $rowparamfarmc[0];
		$data_2 = $rowparamfarmc[1];		
		$query = "SELECT * 
					FROM dbo.vw_painel_farmacia 
				 WHERE sma_data >= '".$data_1."' 
				   AND sma_data <= '".$data_2."' 
				 ORDER BY num  ASC";
		
	
	} else{
		
		$sql="SELECT to_char(dt_inicial_cnlta_pnel, 'yyyy/mm/dd'), to_char(dt_final_cnlta_pnel, 'yyyy/mm/dd') FROM integracao.tb_param_pnel_farmc";
		
		if ($pdo==null){
				header(Config::$webLogin);
		}	
		$ret = pg_query($pdo, $sql);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}
		
		$rowparamfarmc = pg_fetch_row($ret);
		$data_1 = $rowparamfarmc[0];
		$data_2 = $rowparamfarmc[1];		
		$query = "SELECT * 
					FROM dbo.vw_painel_farmacia 
				 WHERE sma_data >= '".$data_1."' 
				   AND sma_data <= '".$data_2."' 
				 ORDER BY num  ASC";
				 
	}

	if( $conn ) {		 
		 $result = odbc_exec($conn, $query);
	
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
				<p><h1><font color="black">Painel da Farmárcia - Solicitações</h1></p>
				<p align = "left"><b><font color="black">Opções para consulta</b></p>
				<font color="black">Por Período de Solicitação:
				<!--<select class="form-control" name="cmdoptconsulta">					
					<option value="paciente" id="cmboptpaciente">Paciente</option>								
					<option value="paciente" id="cmboptpaciente">Período</option>								
				</select>&nbsp;&nbsp;&nbsp;&nbsp;				
				<input type="text" class="form-control" name="textoconsulta">&nbsp;&nbsp;-->				
				<input type="date" class="form-control" id="dtinicio" name="dtinicio" placeholder="Formato: dd/mm/yyyy">&nbsp;a&nbsp;
				<input type="date" class="form-control" id="dtfim" name="dtfim" placeholder="Formato: dd/mm/yyyy">
				<input class="btn btn-primary" type="submit" value="Consultar" name="botaoconsultar">&nbsp;&nbsp;	
				Última consulta elaborada:&nbsp;&nbsp;<?php echo $data_1; ?>&nbsp;&nbsp;e&nbsp;&nbsp;<?php echo $data_2; ?>
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
<div id="dataModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Detalhes da Solicitação</h4>
			</div>
			<div class="modal-body" id="detalhe_solicitacao">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).on('click', '.view_data', function(){
		//$('#dataModal').modal();
		var num = $(this).attr("id");
		$.ajax({
			url:"../farmacia/selecao_detalhe_solicitacao.php",
			method:"POST",
			data:{num:num},
			success:function(data){
				$('#detalhe_solicitacao').html(data);
				$('#dataModal').modal('show');
			}
		});
	});
		
	function blink(selector) {
	$(selector).fadeOut('slow', function() {
		$(this).fadeIn('slow', function() {
			blink(this);
		});
	});
	}

	blink('.piscar');
	
</script>
<?php

?>



