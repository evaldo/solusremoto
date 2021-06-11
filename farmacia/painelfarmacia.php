<?php
	
	error_reporting(0);
	
	$pdo = @pg_connect("host=187.16.185.242 port=5430 dbname=vila_verde user=postgres password=!V3rd3V1l4#");
    
	$sql="SELECT tp_atlz_pnel, nu_minuto_lmte_1, nu_minuto_lmte_2, nu_minuto_lmte_3, cd_cor_minuto_limite_1, cd_cor_minuto_limite_2, cd_cor_minuto_limite_3, nu_minuto_lmte_utma_cnlta FROM integracao.tb_param_pnel_farmc";
		
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
	$nu_minuto_lmte_1 = $rowparamfarmc[1];	
	$nu_minuto_lmte_2 = $rowparamfarmc[2];	
	$nu_minuto_lmte_3 = $rowparamfarmc[3];	
	$cd_cor_minuto_limite_1 = $rowparamfarmc[4];	
	$cd_cor_minuto_limite_2 = $rowparamfarmc[5];	
	$cd_cor_minuto_limite_3 = $rowparamfarmc[6];
	$nu_minuto_lmte_utma_cnlta = $rowparamfarmc[7];

	$datahoraatualpainel = new DateTime();
			
	$connection_string = 'DRIVER={SQL Server};SERVER=191.235.100.131,2071;DATABASE=Sd_ClinVilaVerde';

	$user = 'vilaverde';
	$pass = '&tH5#@06bJT';

	$conn = odbc_connect( $connection_string, $user, $pass );
	
	if( $conn ) {		 
		$result = odbc_exec($conn, "SELECT getdate() as dataatual");	
		if(!$result) {
			exit("Erro ao abrir a consulta no Smart");
		}
	}else{			
		exit("Connection could not be established.");     			 
	}
	
	$rowdataatual=odbc_fetch_object($result);		
	$datahoraatualpainel = new DateTime($rowdataatual->dataatual);	
	
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
		//DATEDIFF(minute, sma_data, getdate())
		$query = "SELECT format(convert(date, sma_data), 'dd/MM/yyyy') as sma_data
					   , format(sma_data, 'HH:mm') as sma_hora
					   , num
					   , pac_nome
					   , leito
					   , sma_usr_login_sol
					   , sba_nome
					   , DATEDIFF(minute, sma_data, getdate()) AS minutos 
				 FROM dbo.vw_painel_farmacia 
				 WHERE CAST(sma_data as DATE) between '".$data_1."' and '".$data_2."' ";
		if($nu_minuto_lmte_utma_cnlta > 0){
				$query.= " AND DATEDIFF(minute, sma_data, getdate()) <= ".$nu_minuto_lmte_utma_cnlta." ";
		}
		
		$query.= " ORDER BY CAST(sma_data as DATE) DESC, format(sma_data, 'HH:mm') DESC";
		
		if ($pdo==null){
			header(Config::$webLogin);
		}		
		try
		{	
			if ($data_1_update <> '//' && $data_2_update <> '//'){
				$sql = " update integracao.tb_param_pnel_farmc set dt_inicial_cnlta_pnel = to_date('".$data_1_update."', 'dd/mm/yyyy'), dt_final_cnlta_pnel = to_date('".$data_2_update."', 'dd/mm/yyyy'), nu_minuto_lmte_utma_cnlta = ".$_POST['nu_minuto_lmte']." ";
			} else {
				$sql = " update integracao.tb_param_pnel_farmc set nu_minuto_lmte_utma_cnlta = ".$_POST['nu_minuto_lmte']." ";
			}
			$result = pg_query($pdo, $sql);
			
			//echo $sql;
			
			if($result){
				echo "";
			}  			
			
		} catch(PDOException $e) {
			die($e->getMessage());
		}
		
		$sql="SELECT to_char(dt_inicial_cnlta_pnel, 'yyyy/mm/dd'), to_char(dt_final_cnlta_pnel, 'yyyy/mm/dd'), nu_minuto_lmte_utma_cnlta FROM integracao.tb_param_pnel_farmc";
		
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
		$nu_minuto_lmte_utma_cnlta = $rowparamfarmc[2]; 
		
		$query = "SELECT format(convert(date, sma_data), 'dd/MM/yyyy') as sma_data
					   , format(sma_data, 'HH:mm') as sma_hora
					   , num
					   , pac_nome
					   , leito
					   , sma_usr_login_sol
					   , sba_nome
					   , DATEDIFF(minute, sma_data, getdate()) AS minutos 
				 FROM dbo.vw_painel_farmacia 
				 WHERE CAST(sma_data as DATE) between '".$data_1."' and '".$data_2."' ";
		if($nu_minuto_lmte_utma_cnlta > 0){
				$query.= " AND DATEDIFF(minute, sma_data, getdate()) <= ".$nu_minuto_lmte_utma_cnlta." ";
		}
		
		$query.= " ORDER BY CAST(sma_data as DATE) DESC, format(sma_data, 'HH:mm') DESC";
	
	} else{
		
		$sql="SELECT to_char(dt_inicial_cnlta_pnel, 'yyyy/mm/dd'), to_char(dt_final_cnlta_pnel, 'yyyy/mm/dd'), nu_minuto_lmte_utma_cnlta FROM integracao.tb_param_pnel_farmc";
		
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
		$nu_minuto_lmte_utma_cnlta = $rowparamfarmc[2];		
		
		$query = "SELECT format(convert(date, sma_data), 'dd/MM/yyyy') as sma_data
					   , format(sma_data, 'HH:mm') as sma_hora
					   , num
					   , pac_nome
					   , leito
					   , sma_usr_login_sol
					   , sba_nome
					   , DATEDIFF(minute, sma_data, getdate()) AS minutos 
				 FROM dbo.vw_painel_farmacia 
				 WHERE CAST(sma_data as DATE) between '".$data_1."' and '".$data_2."' ";
		if($nu_minuto_lmte_utma_cnlta > 0){
				$query.= " AND DATEDIFF(minute, sma_data, getdate()) <= ".$nu_minuto_lmte_utma_cnlta." ";
		}
		
		$query.= " ORDER BY CAST(sma_data as DATE) DESC, format(sma_data, 'HH:mm') DESC";
				 
	}

	if( $conn ) {		 
		 $result = odbc_exec($conn, $query);
		 //echo $query;
		if(!$result) {
			exit("Erro ao abrir a consulta no Smart");
		}
		
		?>
		
		<html>
			<head>
				<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">				
				<meta charset="utf-8">
				<title>Painel de Dispensação</title>
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
			
			table.table{
				border-collapse: collapse;
			}
			table.table td, table.table th{
			  border: 1px solid #ccc;
			}
			.table{
				margin:0 auto;
			}
			</style>
        </head>
        <body>
		
		<div class="container" align="center">  
		  <form class="form-inline" action="#" method="post" >
				<p><h1><font color="black">Painel de Dispensação</h1></p>				
				<p><font color="black">Filtro Por Data de Solicitação:
				<!--<select class="form-control" name="cmdoptconsulta">					
					<option value="paciente" id="cmboptpaciente">Paciente</option>								
					<option value="paciente" id="cmboptpaciente">Período</option>								
				</select>&nbsp;&nbsp;&nbsp;&nbsp;-->			
				<!--<input type="text" class="form-control" name="textoconsulta">&nbsp;&nbsp;-->
				<input type="date" class="form-control" id="dtinicio" name="dtinicio" placeholder="Formato: dd/mm/yyyy">&nbsp;a&nbsp;
				<input type="date" class="form-control" id="dtfim" name="dtfim" placeholder="Formato: dd/mm/yyyy">
				Filtro por tempo de Solicitação (em minutos):				
				<select class="form-control" id="sl_nu_minuto_lmte" name="sl_nu_minuto_lmte" onchange=" 
						var selObj = document.getElementById('sl_nu_minuto_lmte');
						var selValue = selObj.options[selObj.selectedIndex].value;
						document.getElementById('nu_minuto_lmte').value = selValue;">					
					<option value="0" id="nu_minuto_lmte_0"></option>		
					<option value="<?php echo $nu_minuto_lmte_1; ?>" id="nu_minuto_lmte_1"><?php echo $nu_minuto_lmte_1; ?></option>		
					<option value="<?php echo $nu_minuto_lmte_2; ?>" id="nu_minuto_lmte_2"><?php echo $nu_minuto_lmte_2; ?></option>		
					<option value="<?php echo $nu_minuto_lmte_3; ?>" id="nu_minuto_lmte_3"><?php echo $nu_minuto_lmte_3; ?></option>		
				</select>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="nu_minuto_lmte" id="nu_minuto_lmte" value="<?php echo $nu_minuto_lmte_utma_cnlta; ?>" style="display:none">
				<input class="btn btn-primary" type="submit" value="Ir" name="botaoconsultar"></p>	
				<hr>
				<p align = "left"><font color="black">Última consulta:&nbsp;&nbsp;<?php echo $data_1; ?>&nbsp;&nbsp;e&nbsp;&nbsp;<?php echo $data_2; ?>&nbsp;&nbsp;<font color="black">- Por minutos:&nbsp;&nbsp;<?php echo $nu_minuto_lmte_utma_cnlta; ?>
				<p align = "left"><font color="black">Data/Hora da Última Atualização:&nbsp;&nbsp;<?php echo $datahoraatualpainel->format('d-m-Y H:i:s'); ?></p>
				<!--<input class="btn btn-primary" type="button" value="Legenda" name="legenda" data-toggle="modal" data-target="#modallegenda">-->				
		  </form>		  
		</div>
		<hr>
			
		<br>
		
		<div id="list" class="row" align="center" style="margin-left: 0px; margin-right: 0px">
				
			<div class="table-responsive">							
				<table id="tabela" class="table">
				
					<tr>
						<th style="text-align:center">Data</th>
						<th style="text-align:center">Hora</th>
						<th style="text-align:center">Num Solicitação</th>
						<th style="text-align:center">Paciente</th>
						<th style="text-align:center">Leito</th>					
						<th style="text-align:center">Requisitante</th>
						<th style="text-align:center">Sub-Almoxerifado</th>
					</tr>
					
					<tbody>
			
						<?php
							$output = array();
							while($row=odbc_fetch_object($result))  {
								
								$corminutolimite = "white";
								
								if ($row->minutos <= $nu_minuto_lmte_1){
									$corminutolimite = $cd_cor_minuto_limite_1;
								} elseif ($row->minutos <= $nu_minuto_lmte_2){
									$corminutolimite = $cd_cor_minuto_limite_2;
								} elseif ($row->minutos <= $nu_minuto_lmte_3){
									$corminutolimite = $cd_cor_minuto_limite_3;
								}
								
								//$corminutolimite = 'tomato';
								
								?>					
								<tr style="background-color:<?php echo $corminutolimite;?>">
									<td   title="data" id="sma_data" value="<?php echo $row->sma_data;?>"><?php echo $row->sma_data;?></td>
									<td   title="hora" id="sma_hora" value="<?php echo $row->sma_hora;?>"><?php echo $row->sma_hora;?></td>
									<td   title="num" id="num" value="<?php echo $row->num;?>"><?php echo $row->num;?></td>
									<td   title="pac_nome" id="pac_nome" value="<?php echo $row->pac_nome;?>"><?php echo $row->pac_nome;?></td>
									<td   title="leito" id="leito" value="<?php echo $row->leito;?>"><?php echo $row->leito;?></td>
									<td   title="sma_usr_login_sol" id="sma_usr_login_sol" value="<?php echo $row->sma_usr_login_sol;?>"><?php echo $row->sma_usr_login_sol;?></td>
									<td   title="sba_nome" id="sba_nome" value="<?php echo $row->sba_nome;?>"><?php echo utf8_encode($row->sba_nome);?></td>
								</tr>
							<?php 
							
								$cont=$cont+1;
							}  ?>	
					</tbody>
				</table>

			</div>
				
		</div>
		<?php				
		
			unset($conn); 
			unset($result);
			
		}else{			
			exit("Connection could not be established.");     			 
		}
	
	?>
	
	</body>
	<!--<div class="modal fade" id="modallegenda">
		<div class="modal-dialog">			
		<!-- Modal content-->
			<!--<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Legenda</h4>
				</div>
				<div class="col-sm-10 col-md-10 col-lg-10">
					<div class="card text-white bg-success mb-2">
						<div class="card-body"  style="height: 14rem">
							<input type="button" name="view" value="Núm da Solicit" class="btn btn-secondary btn-xs" />
							<?php
								echo "<p class=\"card-text\">Nome do Paciente</p>";
							?>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			 </div>				  
		</div>
	</div>
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
	
</script>-->
<?php

?>



