<?php
	
	session_start();		
	
    include '../database.php';
    $pdo = database::connect();
	
	error_reporting(0); 	
		
	$textoconsulta = "";	
	$sql = '';
	
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
		FROM integracao.tb_orig_dmnd_plnj_leito orig_dmnd		   
		   , integracao.tb_plnj_pcnt_leito plnj_leito
		   , integracao.tb_grvd_risco_pcnt grvd_risco
		   , integracao.tb_cnvo cnvo
	WHERE plnj_leito.id_grvd_risco_pcnt = grvd_risco.id_grvd_risco_pcnt
	  and plnj_leito.id_orig_dmnd_plnj_leito = orig_dmnd.id_orig_dmnd_plnj_leito
	  and plnj_leito.id_cnvo = cnvo.id_cnvo		";
			
	$ret = pg_query($pdo, $sql);
	
	if(!$ret) {
		echo pg_last_error($pdo);		
		exit;
	}
	
	if(isset($_POST['insere'])){					
		
		if ($pdo==null){
			header(Config::$webLogin);
		}
		
		try
		{	
			
			$sql = "INSERT INTO integracao.tb_plnj_pcnt_leito(id_plnj_pcnt_leito, nm_pcnt_cndat, dt_nasc, id_cnvo, nm_cnto, dt_prvs_admss, ds_leito, cd_usua_incs, dt_incs, cd_usua_altr, dt_altr, id_grvd_risco_pcnt, id_orig_dmnd_plnj_leito, fl_pcnt_adtdo) VALUES ((select NEXTVAL('integracao.sq_plnj_pcnt_leito')), '".$_POST['nm_pcnt_cndat']."', '".$_POST['dt_nasc']."', ".$_POST['id_cnvo'].", '".$_POST['nm_cnto']."', '".$_POST['dt_prvs_admss']."', '".$_POST['ds_leito']."', '".$_SESSION['usuario']."', current_timestamp, null, null, ".$_POST['id_grvd_risco_pcnt'].", ".$_POST['id_orig_dmnd_plnj_leito'].", 0);";
			
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
				<br>
				<label style="font-weight:bold; font-size: 11px;">Nome:</label>&nbsp;
				<input style="width: 200px; font-size: 11px;" type="text" id="buscapac" onkeyup="Busca(2, 'buscapac')" placeholder="Paciente..." title="Texto da Busca"> &nbsp;
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
						<select id="sl_tp_cnvo" style="width: 90px; font-size: 11px;" onchange="BuscaExato(3, 'sl_tp_cnvo')">
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
				
				<label style="font-weight:bold; font-size: 11px;">Imprimir último filtro por:</label>&nbsp;
				<select  style="font-weight:bold; font-size: 11px;" name="tprelatorio" id="tprelatorio">
				  <option value="grvdrisco" selected>Gravidade de Risco</option>
				  <option value="origdemnd">Origem da Demanda</option>
				  <option value="cnvo">Convênio</option>				  
				</select>
					   			   
				<label style="font-weight:bold; font-size: 11px;">Exportar/Imprimir Por Período - </label>&nbsp;			
				<label style="font-weight:bold; font-size: 11px;">Dt Inicial:</label>&nbsp;
				<input style="font-weight:bold; font-size: 11px;" type="date" id="dataInicio" name="dataInicio"> &nbsp;&nbsp;
				<label style="font-weight:bold; font-size: 11px;">a</label>&nbsp;
				<label style="font-weight:bold; font-size: 11px;">Dt Final:</label>&nbsp;
				<input style="font-weight:bold; font-size: 11px;" type="date" id="dataFim" name="dataFim">&nbsp;&nbsp;
				<input style="font-size: 11px;" class="btn btn-primary" type="button" value="Imprimir" id="imprimirplanejamento">&nbsp;
				
				<input class="btn btn-primary" style="font-size: 11px;" type="submit" value="Exportar" id="exportarplanejamento">&nbsp;
				
				<input type="button" value="Novo Registro" style="font-size: 11px;" class="btn btn-primary btn-xs insere"/>
				
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
							<th colspan="3" style="text-align:center">Ações</th>
							
						</tr>
						
						<tbody>
						<?php
							
							$cont=1;										
							while($row = pg_fetch_row($ret)) {
								
							?>

								<tr >
									<td data-toggle="tooltip" data-placement="top" title="Id do Planejamento" style="text-align=center; font-weight:bold; color:red; background-color:#E0FFFF" id="id_plnj_pcnt_leito" value="<?php echo $row[0];?>" ><?php echo $row[0];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Candidato" style="font-weight:bold; text-align:center" id="nm_pcnt_cndat" value="<?php echo $row[1];?>" ><?php echo $row[1];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Dt. Nascimento" style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="dt_nasc" value="<?php echo $row[2];?>" ><?php echo $row[2];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Convênio" id="cd_cnvo" value="<?php echo $row[3];?>"><?php echo $row[3];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Contato" id="nm_cnto" value="<?php echo $row[4];?>"><?php echo $row[4];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Dt. Previsao da Admissão" style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="dt_prvs_admss" value="<?php echo $row[5];?>"><?php echo $row[5];?></td>
									<td data-toggle="tooltip" data-placement="top" title="Leito Alocado" style="text-align=center; font-weight:bold; background-color:#C0C0C0" id="ds_leito" value="<?php echo $row[6];?>"><?php echo $row[6];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Origem da Demanda" id="ds_orig_dmnd_plnj_leito" value="<?php echo $row[8];?>"><input type="text" value="<?php echo $row[8];?>" style="display:none"/><?php echo $row[8];?></td>
																											
									<td data-toggle="tooltip" data-placement="top" title="Gravidade do Risco" style="color:black; font-weight:bold; background-color:<?php echo $row[9];?>" id="nm_grvd_risco_pcnt" value="<?php echo $row[7];?>"><input type="text" value="<?php echo $row[7];?>" style="display:none"/><?php echo $row[7];?></td>
									
									<td class="actions">
										<input type="image" src="../img/lupa_1.png"  height="23" width="23" class="btn-xs visualiza"/>
									</td>
									
									<td class="actions">																		
										<input type="button" style="font-size: 11px;" value="Alterar" class="btn btn-warning btn-xs altera"/>								
										<input type="button" style="font-size: 11px;" value="Excluir" class="btn btn-danger btn-xs delecao"/>								
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
			
			// AJAX code to submit form.
			$.ajax({
				 type: "POST",
				 url: "../delecao/delecao_planejamento_demanda.php", //
				 data: {id_plnj_pcnt_leito:id_plnj_pcnt_leito},
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
	
</script>
<?php ?>