<?php
	
	session_start();		
	
    include '../database.php';
    $pdo = database::connect();
	
	error_reporting(0); 	
		
	$textoconsulta = "";	
	$sql = '';
	
	if(isset($_POST['botaoconsultar'])){
	
		$anoInicio = substr($_POST['dataInicioConstulaPrvs'],0,4);
		$mesInicio = substr($_POST['dataInicioConstulaPrvs'],5,2);
		$diaInicio = substr($_POST['dataInicioConstulaPrvs'],8,8);
		
		$dt_consultaInicio = $diaInicio.'/'.$mesInicio.'/'.$anoInicio;
		
		$anoFim = substr($_POST['dataFimConsultaPrvs'],0,4);
		$mesFim = substr($_POST['dataFimConsultaPrvs'],5,2);
		$diaFim = substr($_POST['dataFimConsultaPrvs'],8,8);
		
		$dt_consultaFim = $diaFim.'/'.$mesFim.'/'.$anoFim;
		
		$sql ="SELECT plnj_leito.id_plnj_pcnt_leito
			 , plnj_leito.nm_pcnt_cndat
			 , plnj_leito.dt_nasc
			 , cnvo.cd_cnvo
			 , plnj_leito.nm_cnto
			 , plnj_leito.dt_prvs_admss
			 , plnj_leito.ds_leito
			 , grvd_risco.nm_grvd_risco_pcnt
			 , orig_dmnd.ds_orig_dmnd_plnj_leito
			 , grvd_risco.cd_cor_grvd_risco
			 , plnj_leito.fl_pcnt_adtdo
			 , plnj_leito.ds_quadro_psqtr
			 , to_char(plnj_leito.dt_incs, 'dd/mm/yyyy hh24:mi') dt_incs
			FROM integracao.tb_orig_dmnd_plnj_leito orig_dmnd		   
			   , integracao.tb_plnj_pcnt_leito plnj_leito
			   , integracao.tb_grvd_risco_pcnt grvd_risco
			   , integracao.tb_cnvo cnvo
		WHERE plnj_leito.id_grvd_risco_pcnt = grvd_risco.id_grvd_risco_pcnt
		  and plnj_leito.id_orig_dmnd_plnj_leito = orig_dmnd.id_orig_dmnd_plnj_leito
		  and plnj_leito.id_cnvo = cnvo.id_cnvo	";

		if ($dt_consultaInicio <> '//' and $dt_consultaFim <> '//') {
			
			$sql.= " and plnj_leito.dt_prvs_admss >= to_date('".$dt_consultaInicio."', 'dd/mm/yyyy') "; 
			$sql.= " and plnj_leito.dt_prvs_admss <= to_date('".$dt_consultaFim."', 'dd/mm/yyyy') "; 
			
		}
		
		if ($_POST['sl_fl_pcnt_adtdo'] <> ''){
			
			if ($_POST['sl_fl_pcnt_adtdo'] == 'Sim'){
				$fl_pcnt_adtdo = 1;
			} else {
				$fl_pcnt_adtdo = 0;
			}
			
			$sql.= " and plnj_leito.fl_pcnt_adtdo = ".$fl_pcnt_adtdo." "; 
			
		}
		  
		$sql.= " order by plnj_leito.dt_incs asc ";
				
		$ret = pg_query($pdo, $sql);
		
		if(!$ret) {
			echo pg_last_error($pdo);		
			exit;
		}
		
		
	} else {
	
		$sql ="SELECT plnj_leito.id_plnj_pcnt_leito
			 , plnj_leito.nm_pcnt_cndat
			 , plnj_leito.dt_nasc
			 , cnvo.cd_cnvo
			 , plnj_leito.nm_cnto
			 , plnj_leito.dt_prvs_admss
			 , plnj_leito.ds_leito
			 , grvd_risco.nm_grvd_risco_pcnt
			 , orig_dmnd.ds_orig_dmnd_plnj_leito
			 , grvd_risco.cd_cor_grvd_risco
			 , plnj_leito.fl_pcnt_adtdo
			 , plnj_leito.ds_quadro_psqtr
			 , to_char(plnj_leito.dt_incs, 'dd/mm/yyyy hh24:mi') dt_incs
			FROM integracao.tb_orig_dmnd_plnj_leito orig_dmnd		   
			   , integracao.tb_plnj_pcnt_leito plnj_leito
			   , integracao.tb_grvd_risco_pcnt grvd_risco
			   , integracao.tb_cnvo cnvo
		WHERE plnj_leito.id_grvd_risco_pcnt = grvd_risco.id_grvd_risco_pcnt
		  and plnj_leito.id_orig_dmnd_plnj_leito = orig_dmnd.id_orig_dmnd_plnj_leito
		  and plnj_leito.id_cnvo = cnvo.id_cnvo	
		  and plnj_leito.fl_pcnt_adtdo = 0 
		 order by plnj_leito.dt_incs asc";
				
		$ret = pg_query($pdo, $sql);
		
		if(!$ret) {
			echo pg_last_error($pdo);		
			exit;
		}
		
	}	
	
	if(isset($_POST['insere'])){					
		
		if ($pdo==null){
			header(Config::$webLogin);
		}
		
		try
		{	
			
			$sql = "INSERT INTO integracao.tb_plnj_pcnt_leito(id_plnj_pcnt_leito, nm_pcnt_cndat, dt_nasc, id_cnvo, nm_cnto, dt_prvs_admss, ds_leito, cd_usua_incs, dt_incs, cd_usua_altr, dt_altr, id_grvd_risco_pcnt, id_orig_dmnd_plnj_leito, fl_pcnt_adtdo, ds_quadro_psqtr) VALUES ((select NEXTVAL('integracao.sq_plnj_pcnt_leito')), '".$_POST['nm_pcnt_cndat']."', '".$_POST['dt_nasc']."', ".$_POST['id_cnvo'].", '".$_POST['nm_cnto']."', '".$_POST['dt_prvs_admss']."', '".$_POST['ds_leito']."', '".$_SESSION['usuario']."', current_timestamp, null, null, ".$_POST['id_grvd_risco_pcnt'].", ".$_POST['id_orig_dmnd_plnj_leito'].", 0, '".$_POST['ds_quadro_psqtr']."');";
			
			//echo $sql;
			
			$result = pg_query($pdo, $sql);

			if($result){
				echo "";
			}  
			
			//voltar aqui
			$secondsWait = 0;
			header("Refresh:$secondsWait");

				
		} catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
	
	if(isset($_POST['altera'])){					
		
		if ($pdo==null){
			header(Config::$webLogin);
		}
		
		try
		{	
			
			$sql = "UPDATE integracao.tb_plnj_pcnt_leito set nm_pcnt_cndat = '".$_POST['nm_pcnt_cndat']."', dt_nasc = '".$_POST['dt_nasc']."', id_cnvo = ".$_POST['id_cnvo'].", nm_cnto = '".$_POST['nm_cnto']."', dt_prvs_admss = '".$_POST['dt_prvs_admss']."', ds_leito = '".$_POST['ds_leito']."', id_grvd_risco_pcnt = ".$_POST['id_grvd_risco_pcnt'].", id_orig_dmnd_plnj_leito = ".$_POST['id_orig_dmnd_plnj_leito'].", cd_usua_altr = '".$_SESSION['usuario']."', dt_altr = current_timestamp, fl_pcnt_adtdo = ".$_POST['fl_pcnt_adtdo'].", ds_quadro_psqtr = '".$_POST['ds_quadro_psqtr']."' WHERE id_plnj_pcnt_leito = ".$_POST['id_plnj_pcnt_leito']." ";
			
			//echo $sql;
			
			$result = pg_query($pdo, $sql);

			if($result){
				echo "";
			}  
			
			//voltar aqui
			$secondsWait = 0;
			header("Refresh:$secondsWait");

				
		} catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
	
	if(isset($_POST['deleta'])){					
		
		if ($pdo==null){
			header(Config::$webLogin);
		}
		
		try
		{	
			
			$sql = "DELETE FROM integracao.tb_plnj_pcnt_leito WHERE id_plnj_pcnt_leito = ".$_SESSION['id_plnj_pcnt_leito']." ";
			
			//echo $sql;
			
			$result = pg_query($pdo, $sql);

			if($result){
				echo "";
			}  
			
			//voltar aqui
			$secondsWait = 0;
			header("Refresh:$secondsWait");

				
		} catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
		
?>	

	<!DOCTYPE html>
	<html lang="pt-br">
		<head>
			<style>
				/* tables */
					
				
				.table {
					border-radius: 0px;
					width: 50%;
					margin: 0px auto;
					float: none;
					border: 1px solid black;			
				}
				
				.table-condensed{
				  font-size: 9.5px;
				}
				
				.gif_loader_image{
				  position: fixed;
				  width: 100%;
				  height: 100%;
				  left: 0px;
				  bottom: 0px;
				  z-index: 1001;
				  background:rgba(0,0,0,.8);
				  text-align:center;
				}
				.gif_loader_image img{
				  width:30px;
				  margin-top:40%;
				}
		
				
			</style>
			 <meta charset="utf-8">
			 <meta http-equiv="X-UA-Compatible" content="IE=edge">
			 <meta name="viewport" content="width=device-width, initial-scale=1">
			 <title>Planejamento de Leitos</title>			 
			 <link href="../css/bootstrap.min.css" rel="stylesheet">
			 <link href="../css/style.css" rel="stylesheet">	 			 		 			 
	  
		</head>
		<body id="aplicacao" onload="removeDivsEtapasCarga();">			
			<div class="container" style="margin-left: 0px; margin-right: 0px; position:fixed; margin-top: 0px; background-color:white; max-width: 5000px; height: 130px; border: 1px solid #E6E6E6;">
				<form action="#" method="post" >	
					
					<label style="font-weight:bold; font-size: 11px;">Nome:</label>&nbsp;
					<input style="width: 200px; font-size: 11px;" type="text" id="buscapac" onkeyup="Busca(1, 'buscapac')" placeholder="Paciente..." title="Texto da Busca"> &nbsp;
					<label style="font-weight:bold; font-size: 11px;">Gravidade do Risco:</label>&nbsp;
									
					<?php
					
						$sqlgrvdrisco = "SELECT nm_grvd_risco_pcnt FROM integracao.tb_grvd_risco_pcnt order by 1";				
					
						if ($pdo==null){
								header(Config::$webLogin);
						}	
						$retgrvdrisco = pg_query($pdo, $sqlgrvdrisco);
						if(!$retgrvdrisco) {
							echo pg_last_error($pdo);
							exit;
						}
					?>
						<select id="sl_tp_grvd_risco" style="width: 100px; font-size: 11px;" onchange="Busca(8, 'sl_tp_grvd_risco')">
						<option value=""></option>
									
						<?php
							$cont=1;	
							while($rowgrvdrisco = pg_fetch_row($retgrvdrisco)) {													
							?>
								<option value="<?php echo $rowgrvdrisco[0]; ?>"><?php echo $rowgrvdrisco[0]; ?></option>												
							<?php 
								$cont=$cont+1;
							}
							 ?>	
							
					</select>&nbsp;&nbsp;&nbsp;				
					
					<label style="font-weight:bold; font-size: 11px;">Origem da Demanda:</label>&nbsp;				
											
					<?php
					
						$sqlorigdmnd = "SELECT ds_orig_dmnd_plnj_leito FROM integracao.tb_orig_dmnd_plnj_leito order by 1";	
					
						if ($pdo==null){
								header(Config::$webLogin);
						}	
						$retorigdmnd = pg_query($pdo, $sqlorigdmnd);
						if(!$retorigdmnd) {
							echo pg_last_error($pdo);
							exit;
						}
					?>
						<select id="sl_tp_orig_dmnd" style="width: 100px; font-size: 11px;" onchange="Busca(7, 'sl_tp_orig_dmnd')">
						<option value=""></option>
									
						<?php
							$cont=1;	
							while($roworigdmnd = pg_fetch_row($retorigdmnd)) {													
							?>
								<option value="<?php echo $roworigdmnd[0]; ?>"><?php echo $roworigdmnd[0]; ?></option>												
							<?php 
								$cont=$cont+1;
							}
							 ?>	
							
					</select>&nbsp;						
					
					<label style="font-weight:bold; font-size: 11px;">Convênio:</label>&nbsp;				
											
					<?php
					
						$sqlcnvo = "SELECT cd_cnvo FROM integracao.tb_cnvo order by 1";				
					
						if ($pdo==null){
								header(Config::$webLogin);
						}	
						$retcnvo = pg_query($pdo, $sqlcnvo);
						if(!$retcnvo) {
							echo pg_last_error($pdo);
							exit;
						}
					?>
							<select id="sl_tp_cnvo" style="width: 90px; font-size: 11px;" onchange="Busca(3, 'sl_tp_cnvo')">
						<option value=""></option>
						<option value="-">-</option>
									
						<?php
							$cont=1;	
							while($rowcnvo = pg_fetch_row($retcnvo)) {													
							?>
								<option value="<?php echo $rowcnvo[0]; ?>"><?php echo $rowcnvo[0]; ?></option>												
							<?php 
								$cont=$cont+1;
							}
							 ?>	
							
					</select>&nbsp;	
					
					<br>
					<br>
					
					<label style="font-weight:bold; font-size: 11px;">Listar regstros por:</label>&nbsp;&nbsp;
					<label style="font-weight:bold; font-size: 11px;">Por Dt. Prev. de Admissão: </label>&nbsp;			
					<label style="font-weight:bold; font-size: 11px;">Dt Inicial:</label>&nbsp;
					<input style="font-weight:bold; font-size: 11px;" type="date" id="dataInicioConstulaPrvs" name="dataInicioConstulaPrvs"> &nbsp;
					<label style="font-weight:bold; font-size: 11px;">a</label>&nbsp;
					<label style="font-weight:bold; font-size: 11px;">Dt Final:</label>&nbsp;
					<input style="font-weight:bold; font-size: 11px;" type="date" id="dataFimConsultaPrvs" name="dataFimConsultaPrvs">&nbsp;&nbsp;
					<label style="font-weight:bold; font-size: 11px;">Se paciente admitido: </label>&nbsp;
					<select id="sl_fl_pcnt_adtdo" name="sl_fl_pcnt_adtdo" style="width: 90px; font-size: 11px;" >
						<option value=""></option>					
						<option value="Sim">Sim</option>																	
						<option value="Nao">Não</option>																	
					</select>&nbsp;	
					<input class="btn btn-primary" style="font-size: 11px;" type="submit" value="Consultar" name="botaoconsultar" id="botaoconsultar">
										
					<br>					
					
					<label style="font-weight:bold; font-size: 11px;">Imprimir último filtro por:</label>&nbsp;
					<select  style="font-weight:bold; font-size: 11px;" name="tprelatorio" id="tprelatorio">
					  <option value="grvdrisco" selected>Gravidade de Risco</option>
					  <option value="origdemnd">Origem da Demanda</option>
					  <option value="cnvo">Convênio</option>				  
					</select>
									   
					<label style="font-weight:bold; font-size: 11px;">Imprimir Por Dt. Prev. de Admissão - </label>&nbsp;			
					<label style="font-weight:bold; font-size: 11px;">Dt Inicial:</label>&nbsp;
					<input style="font-weight:bold; font-size: 11px;" type="date" id="dataInicio" name="dataInicio"> &nbsp;
					<label style="font-weight:bold; font-size: 11px;">a</label>&nbsp;
					<label style="font-weight:bold; font-size: 11px;">Dt Final:</label>&nbsp;
					<input style="font-weight:bold; font-size: 11px;" type="date" id="dataFim" name="dataFim">&nbsp;&nbsp;
					<input style="font-size: 11px;" class="btn btn-primary" type="button" value="Imprimir" id="imprimirplanejamento">&nbsp;
					
					<input class="btn btn-primary" style="font-size: 11px;" type="submit" value="Exportar" id="exportarplanejamento">&nbsp;
					
					<input type="button" value="Novo Registro" style="font-size: 11px;" class="btn btn-primary btn-xs insere"/>
				</form>
			</div> <!-- /#top -->
			
			<div id="list" class="row" style="margin-left: 2px; margin-right: 2px">
				
				<div class="table-responsive" style="margin-top: 130px">				
					<table id="tabela" class="display table table-responsive table-striped table-bordered table-sm table-condensed">
					
						<tr style="font-size: 11px">
							<th style="text-align:center">Id.</th>
							<th style="text-align:center">Candidato a vaga</th>
							<th style="text-align:center">Data de Nasc</th>
							<th style="text-align:center">Convênio</th>
							<th style="text-align:center">Contato</th>							
							<th style="text-align:center">Dt. Prev. de Admissão</th>
							<th style="text-align:center">Leito Alocado</th>
							<th style="text-align:center">Origem da Demanda</th>
							<th style="text-align:center">Gravidade do Risco</th>							
							<th style="text-align:center">Paciente Admitido?</th>
							<th style="text-align:center">Quadro Psiquiátrico</th>
							<th style="text-align:center">Data/Hora de inclusão</th>
							<th colspan="3" style="text-align:center">Ações</th>
							
						</tr>
						
						<tbody>
						<?php
							
							$cont=1;										
							while($row = pg_fetch_row($ret)) {
								
							?>

								<tr>
									<td data-toggle="tooltip" data-placement="top" title="Id do Planejamento" style="text-align=center; width:10px; font-weight:bold; color:red; background-color:#E0FFFF" id="id_plnj_pcnt_leito" value="<?php echo $row[0];?>" ><?php echo $row[0];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Candidato" style="font-weight:bold; width:90px" id="nm_pcnt_cndat" value="<?php echo $row[1];?>" ><?php echo $row[1];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Dt. Nascimento" style="text-align:center; width:60px; font-weight:bold; background-color:#C0C0C0" id="dt_nasc" value="<?php echo $row[2];?>" ><?php echo $row[2];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Convênio" style="width:20px" id="cd_cnvo" value="<?php echo $row[3];?>"><?php echo $row[3];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Contato" style="width:100px" id="nm_cnto" value="<?php echo $row[4];?>"><?php echo $row[4];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Dt. Previsao da Admissão" style="text-align:center; width:40px; font-weight:bold; background-color:#C0C0C0" id="dt_prvs_admss" value="<?php echo $row[5];?>"><?php echo $row[5];?></td>
									<td data-toggle="tooltip" data-placement="top" title="Leito Alocado" style="text-align=center; width:35px; font-weight:bold; background-color:#C0C0C0" id="ds_leito" value="<?php echo $row[6];?>"><?php echo $row[6];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Origem da Demanda" id="ds_orig_dmnd_plnj_leito" style="width:75px" value="<?php echo $row[8];?>"><input type="text" value="<?php echo $row[8];?>" style="display:none"/><?php echo $row[8];?></td>
																											
									<td data-toggle="tooltip" data-placement="top" title="Gravidade do Risco" style="color:black; font-weight:bold; width:95px; background-color:<?php echo $row[9];?>" id="nm_grvd_risco_pcnt" value="<?php echo $row[7];?>"><input type="text" value="<?php echo $row[7];?>" style="display:none"/><?php echo $row[7];?></td>
									
									
									<td data-toggle="tooltip" data-placement="top" title="Paciente Admitido?" style="text-align:center; color:black; width:10px; font-weight:bold" id="fl_pcnt_adtdo" value="<?php if ($row[10]==0) {echo "Não";} else {echo "Sim";} ?>"><input type="text" value="<?php echo $row[10];?>" style="display:none"/><?php if ($row[10]==0) {echo "Não";} else {echo "Sim";} ?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Quadro Psiquiátrico" style="text-align:center; color:black; width:100px; font-weight:bold" id="ds_quadro_psqtr" value="<?php echo $row[11];?>"><input type="text" value="<?php echo $row[11];?>" style="display:none"/><?php echo $row[11]; ?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Data/Hora de Inclusão" style="text-align:center; color:black; width:40px; font-weight:bold" id="dt_incs" value="<?php echo $row[12];?>"><input type="text" value="<?php echo $row[12];?>" style="display:none"/><?php echo $row[12]; ?></td>
									
									<td class="actions"  style="width:170px">
										<!--<input type="button" style="font-size: 11px;" value="Visualizar" class="btn btn-primary btn-xs visualiza"/>-->										 	
										<input type="button" style="font-size: 11px;" value="Audit" class="btn btn-success btn-xs visualiza"/>
										<input type="button" style="font-size: 11px;" value="Alt." class="btn btn-warning btn-xs altera"/>
										<input type="button" style="font-size: 11px;" value="Excl." class="btn btn-danger btn-xs delecao"/>								
									</td>
									
								</tr>
							<?php 
							
								$cont=$cont+1;
							}  ?>	
						</tbody>
					</table>
				</div>
				
			</div> <!-- /#list -->				
			
			 <script src="../js/jquery.min.js"></script>
			 <script src="../js/bootstrap.min.js"></script>
			 <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
			 <script>
				function BuscaExato(col, idbusca) {
					  var input, filter, table, tr, td, i, txtValue;
					  input = document.getElementById(idbusca);
					  filter = input.value.toUpperCase();
					  table = document.getElementById("tabela");
					  tr = table.getElementsByTagName("tr");
					  for (i = 0; i < tr.length; i++) {
						td = tr[i].getElementsByTagName("td")[col];
						if (td) {
							txtValue = td.innerHTML;							
							if (txtValue.toUpperCase() == filter) {
								tr[i].style.display = "";
							} else {
								tr[i].style.display = "none";
							}							
							
						}       
					}
				}
					
				 function Busca(col, idbusca) {
					  var input, filter, table, tr, td, i, txtValue;
					  input = document.getElementById(idbusca);
					  filter = input.value.toUpperCase();
					  table = document.getElementById("tabela");
					  tr = table.getElementsByTagName("tr");
					  for (i = 0; i < tr.length; i++) {
						td = tr[i].getElementsByTagName("td")[col];
						if (td) {
						  txtValue = td.textContent || td.innerText;
						  if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						  } else {
							tr[i].style.display = "none";
						  }
						}       
					  }
					}
						
			 </script>
			
	</body>
	
</html>
<div id="visualiza" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Auditoria</h4>
			</div>
			<div class="modal-body" id="visualizacao">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>
<script>
	
	$('#exportarplanejamento').click(function(){
			
			var dataInicio = document.getElementById("dataInicio").value;		
			var dataFim = document.getElementById("dataFim").value;		
			
			$.ajax({
				url : '../gestaoleitos/relatorio_excelplanejamentoleito.php', // give complete url here
				type : 'post',
				data:{dataInicio:dataInicio, dataFim:dataFim},
				success : function(completeHtmlPage) {	
					alert("Faça o download do arquivo de impressão. Abra no Excel e solicite para Salvar Como com o nome desejado.");
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
			});
		});
	
	$('#imprimirplanejamento').click(function(){
			
		var dataInicio = document.getElementById("dataInicio").value;		
		var dataFim = document.getElementById("dataFim").value;		
		
		$.ajax({
			url : '../gestaoleitos/relatorioplanejamentoleito.php', // give complete url here
			type : 'post',
			data:{dataInicio:dataInicio, dataFim:dataFim},
			success : function(completeHtmlPage) {				
				$("html").empty();
				$("html").append(completeHtmlPage);
			}
		});
	});	
	
	$("#tabela").on('click','.delecao',function(){			
		
			var currentRow=$(this).closest("tr"); 
			
			var id_plnj_pcnt_leito = currentRow.find("td:eq(0)").text();										
			var nm_pcnt_cndat = currentRow.find("td:eq(1)").text();	
			
			// AJAX code to submit form.
			$.ajax({
				 type: "POST",
				 url: "../delecao/delecao_planejamento_demanda.php", //
				 data: {id_plnj_pcnt_leito:id_plnj_pcnt_leito, nm_pcnt_cndat:nm_pcnt_cndat},
				 dataType : "text",			 
				 success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				 }
			});
		});
    
		$(document).on('click', '.insere', function(){
			event.preventDefault();			
			$.ajax({
				type: "POST",
				url:"../insercao/insercao_planejamento_demanda.php",															
				success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
			});			
		});		
		
		$("#tabela").on('click','.altera',function(){			
		
			var currentRow=$(this).closest("tr"); 
			
			var id_plnj_pcnt_leito = currentRow.find("td:eq(0)").text();								
			
			// AJAX code to submit form.
			$.ajax({
				 type: "POST",
				 url: "../alteracao/alteracao_planejamento_demanda.php", //
				 data: {id_plnj_pcnt_leito:id_plnj_pcnt_leito},
				 dataType : "text",			 
				 success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				 }
			});
		});
		
		$("#tabela").on('click','.visualiza',function(){			
		
			var currentRow=$(this).closest("tr"); 
			
			var id_plnj_pcnt_leito = currentRow.find("td:eq(0)").text();			
			
			// AJAX code to submit form.
			$.ajax({
				 type: "POST",
				 url: "../visualizacao/auditoria_planejamento_demanda.php", //
				 data: {id_plnj_pcnt_leito:id_plnj_pcnt_leito},
				 dataType : "text",			 
				 success:function(data){
					$('#visualizacao').html(data);
					$('#visualiza').modal('show');
				 }
			});
		});
	
</script>
<?php ?>