<?php
		
	session_start();		
	
    include '../database.php';
	
	error_reporting(0); 
	
    global $pdo;	
	
	$pdo = database::connect();
	
	$optconsulta = "";
	$textoconsulta = "";	
	$sql = '';
	
	if(isset($_POST['botaoconsultar'])&& $_POST['textoconsulta']<>""){
		
		$textoconsulta = strtoupper($_POST['textoconsulta']);
		
		$sql ="SELECT id_pddo_trtmto, nm_pcnt, to_char(dt_rlzd, 'dd/mm/yyyy') as dt_rlzd
				from tratamento.tb_pddo_trtmto 
				where upper(nm_pcnt) like upper('%" . $textoconsulta . "%') order by dt_rlzd, nm_pcnt asc ";
		
	} else{
		
			$sql ="SELECT id_pddo_trtmto, nm_pcnt, to_char(dt_rlzd, 'dd/mm/yyyy') as dt_rlzd
				from tratamento.tb_pddo_trtmto order by dt_rlzd, nm_pcnt asc";	
	}
	
	if ($pdo==null){
			header(Config::$webLogin);
	}	
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
			if ($_POST['id_hstr_pnel_solic_trtmto']=='null' || $_POST['id_hstr_pnel_solic_trtmto']==null || $_POST['id_hstr_pnel_solic_trtmto']=='') {
				$_POST['id_hstr_pnel_solic_trtmto']='null';
			}
			
			if ($_POST['dt_rlzd'] == null){
				$dt_rlzd = 'null';
			} else {
				$dt_rlzd = "'".$_POST['dt_rlzd']."'";
			}
			
			if ($_POST['dt_aplc'] == null){
				$dt_aplc = 'null';
			} else {
				$dt_aplc = "'".$_POST['dt_aplc']."'";
			}
			
			if ($_POST['dt_diagn'] == null){
				$dt_diagn = 'null';
			} else {
				$dt_diagn = "'".$_POST['dt_diagn']."'";
			}
		
			$sql = "INSERT INTO tratamento.tb_pddo_trtmto(id_pddo_trtmto, id_hstr_pnel_solic_trtmto, cd_pcnt, nm_pcnt, dt_nasc_pcnt, vl_idade_pcnt, nu_peso_pcnt, vl_altura_pcnt, vl_sup_corp, ds_indic_clnic, dt_diagn, cd_cid, ds_plano_trptco, ds_info_rlvnte, ds_diagn_cito_hstpagico, ds_tp_cirurgia, ds_area_irrda, dt_rlzd, dt_aplc, ds_obs_jfta, nu_qtde_ciclo_prta, ds_ciclo_atual, ds_dia_ciclo_atual, ds_intrv_entre_ciclo_dia, ds_estmt, ds_tipo_linha_trtmto, ds_fnlde, ic_tipo_tumor, ic_tipo_nodulo, ic_tipo_metastase, cd_usua_incs, dt_incs, cd_cnvo)
	VALUES ((select NEXTVAL('tratamento.sq_pddo_trtmto')), ". $_POST['id_hstr_pnel_solic_trtmto'].", '". $_POST['cd_pcnt']."', (select nm_pcnt from tratamento.tb_c_pcnt where cd_pcnt = '". $_POST['cd_pcnt']."'), (select dt_nasc_pcnt from tratamento.tb_c_pcnt where cd_pcnt = '". $_POST['cd_pcnt']."'), (select date_part('year', age(now(), (select dt_nasc_pcnt from tratamento.tb_c_pcnt where cd_pcnt = '". $_POST['cd_pcnt']."')))), ". str_replace(",", ".", $_POST['nu_peso_pcnt']).", ". str_replace(",", ".", $_POST['vl_altura_pcnt']).", ". str_replace(",", ".", $_POST['vl_sup_corp']).", UPPER('".str_replace("'", " ",$_POST['ds_indic_clnic'])."'), ".$dt_diagn.", '". $_POST['cd_cid']."', UPPER('". str_replace("'", " ",$_POST['ds_plano_trptco'])."'), UPPER('". str_replace("'", " ",$_POST['ds_info_rlvnte'])."'), UPPER('". str_replace("'", " ",$_POST['ds_diagn_cito_hstpagico'])."'), UPPER('". str_replace("'", " ",$_POST['ds_tp_cirurgia'])."'), UPPER('". str_replace("'", " ",$_POST['ds_area_irrda'])."'), ".$dt_rlzd.", ".$dt_aplc.", UPPER('". str_replace("'", " ",$_POST['ds_obs_jfta'])."'), '". $_POST['nu_qtde_ciclo_prta']."', '". $_POST['ds_ciclo_atual']."', '". $_POST['ds_dia_ciclo_atual']."', '". $_POST['ds_intrv_entre_ciclo_dia']."', '". $_POST['ds_estmt']."' ,'". $_POST['ds_tipo_linha_trtmto']."', '".$_POST['ds_fnlde']."', '". $_POST['ic_tipo_tumor']."', '". $_POST['ic_tipo_nodulo']."', '". $_POST['ic_tipo_metastase']."', '".$_SESSION['usuario']."', current_timestamp, '". $_POST['cd_cnvo']."');";
	
			//echo $sql;
			
			$_SESSION['cd_pcnt'] = $_POST['cd_pcnt'];
			$_SESSION['cd_cnvo'] = $_POST['cd_cnvo'];
			$_SESSION['nu_peso_pcnt'] = $_POST['nu_peso_pcnt'];
			$_SESSION['vl_altura_pcnt'] = $_POST['vl_altura_pcnt'];
			$_SESSION['vl_sup_corp'] = $_POST['vl_sup_corp'];
			$_SESSION['ds_indic_clnic'] = $_POST['ds_indic_clnic'];
			$_SESSION['dt_diagn'] = $dt_diagn;
			$_SESSION['cd_cid'] = $_POST['cd_cid'];
			$_SESSION['ds_estmt'] = $_POST['ds_estmt'];
			$_SESSION['ds_tipo_linha_trtmto'] = $_POST['ds_tipo_linha_trtmto'];
			$_SESSION['ds_fnlde'] = $_POST['ds_fnlde'];
			$_SESSION['ic_tipo_tumor'] = $_POST['ic_tipo_tumor'];
			$_SESSION['ic_tipo_nodulo'] = $_POST['ic_tipo_nodulo'];
			$_SESSION['ic_tipo_metastase'] = $_POST['ic_tipo_metastase'];
			$_SESSION['ds_plano_trptco'] = $_POST['ds_plano_trptco'];
			$_SESSION['ds_info_rlvnte'] = $_POST['ds_info_rlvnte'];
			$_SESSION['ds_diagn_cito_hstpagico'] = $_POST['ds_diagn_cito_hstpagico'];
			$_SESSION['ds_tp_cirurgia'] = $_POST['ds_tp_cirurgia'];
			$_SESSION['ds_area_irrda'] = $_POST['ds_area_irrda'];
			$_SESSION['dt_rlzd'] = $dt_rlzd;
			$_SESSION['dt_aplc'] = $dt_aplc;
			$_SESSION['ds_obs_jfta'] = $_POST['ds_obs_jfta'];
			$_SESSION['nu_qtde_ciclo_prta'] = $_POST['nu_qtde_ciclo_prta'];
			$_SESSION['ds_ciclo_atual'] = $_POST['ds_ciclo_atual'];
			$_SESSION['ds_dia_ciclo_atual'] = $_POST['ds_dia_ciclo_atual'];			
			$_SESSION['ds_intrv_entre_ciclo_dia'] = $_POST['ds_intrv_entre_ciclo_dia'];
			
			$fp = fopen("log_pedido.txt", "a");
			
			// Escreve a mensagem passada através da variável $msg
			$msg = "---------------------Log de Inclusao do Pedido de Tratamento------------------------\n";
			$msg .= "Mensagem gerada pelo usuario: '".$_SESSION['usuario']."' em ".date('d/m/Y')."\n";
			$msg .= "-----------------------------------------------------------------------------------\n";
			$msg .= "Codigo Paciente: '".$_POST['cd_pcnt']."'\n";
			$msg .= "Convênio: '".$_POST['cd_cnvo']."'\n";
			$msg .= "Peso: '".$_POST['nu_peso_pcnt']."'\n";
			$msg .= "Altura: '".$_POST['vl_altura_pcnt']."'\n";
			$msg .= "Sup Corp: '".$_POST['vl_sup_corp']."'\n";
			$msg .= "Indicacao Clinica: '".$_POST['ds_indic_clnic']."'\n";
			$msg .= "Data do Diagnostico: '".$dt_diagn."'\n";
			$msg .= "CID: '".$_POST['cd_cid']."'\n";
			$msg .= "Estadiamento: '".$_POST['ds_estmt']."'\n";
			$msg .= "Tipo Quimio (Linha): '".$_POST['ds_tipo_linha_trtmto']."'\n";
			$msg .= "Finalidade: '".$_POST['ds_fnlde']."'\n";
			$msg .= "Tipo de Tumor: '".$_POST['ic_tipo_tumor']."'\n";
			$msg .= "Tipo de Nodulo: '".$_POST['ic_tipo_nodulo']."'\n";
			$msg .= "Tipo de Metastase: '".$_POST['ic_tipo_metastase']."'\n";
			$msg .= "Plano Terapêutio: '".$_POST['ds_plano_trptco']."'\n";
			$msg .= "Informações Relevantes: '".$_POST['ds_info_rlvnte']."'\n";
			$msg .= "Diagnóstico Histopatologico: '".$_POST['ds_diagn_cito_hstpagico']."'\n";
			$msg .= "Tipo de Cirurgia: '".$_POST['ds_tp_cirurgia']."'\n";
			$msg .= "Área Irradiada: '".$_POST['ds_area_irrda']."'\n";
			$msg .= "Data de Realização: '".$dt_rlzd."'\n";
			$msg .= "Data da Aplicação: '".$dt_aplc."'\n";
			$msg .= "Observação Justificativa: '".$_POST['ds_obs_jfta']."'\n";
			$msg .= "Quantidade de Ciclos Prevsitos: '".$_POST['nu_qtde_ciclo_prta']."'\n";
			$msg .= "Ciclo Atual: '".$_POST['ds_ciclo_atual']."'\n";
			$msg .= "Dias do ciclo atual: '".$_POST['ds_dia_ciclo_atual']."'\n";			
			$msg .= "Intervalo de Ciclos: '".$_POST['ds_intrv_entre_ciclo_dia']."'\n";			
			$msg .= "\n";			
			$msg .= "\n";			
			$msg .= "-----------------------------------------------------------------------------------\n";
			
			$escreve = fwrite($fp, $msg);

			// Fecha o arquivo
			fclose($fp);

			$result = pg_query($pdo, $sql);
			if($result){
				echo "";
			} 

			$sql = "insert into tratamento.tb_log_alrt (id_log_alrt, cd_alrt, ds_alert, cd_usua_incs_alrt, dt_incs_alrt) values ((select NEXTVAL('tratamento.sq_log_alrt')),'INSERCAO DE PEDIDO DE TRATAMENTO', '".str_replace("'"," ", $msg)."', '".$_SESSION['usuario']."', current_timestamp)";
			
			$result = pg_query($pdo, $sql);
			if($result){
				echo "";
			} 
			
			//echo $sql;
			
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
		
			if ($_POST['id_hstr_pnel_solic_trtmto']=='null' || $_POST['id_hstr_pnel_solic_trtmto']==null || $_POST['id_hstr_pnel_solic_trtmto']=='') {
				$_POST['id_hstr_pnel_solic_trtmto']='null';
			}
			
			if ($_POST['dt_rlzd'] == null){
				$dt_rlzd = 'null';
			} else {
				$dt_rlzd = "'".$_POST['dt_rlzd']."'";
			}
			
			if ($_POST['dt_aplc'] == null){
				$dt_aplc = 'null';
			} else {
				$dt_aplc = "'".$_POST['dt_aplc']."'";
			}
			
			if ($_POST['dt_diagn'] == null){
				$dt_diagn = 'null';
			} else {
				$dt_diagn = "'".$_POST['dt_diagn']."'";
			}
			
			$sql = "UPDATE tratamento.tb_pddo_trtmto
	SET id_hstr_pnel_solic_trtmto = ". $_POST['id_hstr_pnel_solic_trtmto']." ,nu_peso_pcnt=". str_replace(",", ".", $_POST['nu_peso_pcnt']).", vl_altura_pcnt=". str_replace(",", ".", $_POST['vl_altura_pcnt']).", vl_sup_corp=". str_replace(",", ".", $_POST['vl_sup_corp']).", ds_indic_clnic=UPPER('". str_replace("'", " ",$_POST['ds_indic_clnic'])."'), dt_diagn=". $dt_diagn.", cd_cid='". $_POST['cd_cid']."', ds_plano_trptco=UPPER('". str_replace("'", " ",$_POST['ds_plano_trptco'])."'), ds_info_rlvnte=UPPER('". str_replace("'", " ",$_POST['ds_info_rlvnte'])."'), ds_diagn_cito_hstpagico=UPPER('". str_replace("'", " ",$_POST['ds_diagn_cito_hstpagico'])."'), ds_tp_cirurgia=UPPER('". str_replace("'", " ",$_POST['ds_tp_cirurgia'])."'), ds_area_irrda=UPPER('". str_replace("'", " ",$_POST['ds_area_irrda'])."'), dt_rlzd=".$dt_rlzd.", dt_aplc=". $dt_aplc.", ds_obs_jfta=UPPER('". str_replace("'", " ",$_POST['ds_obs_jfta'])."'), nu_qtde_ciclo_prta='". $_POST['nu_qtde_ciclo_prta']."', ds_ciclo_atual='". $_POST['ds_ciclo_atual']."', ds_dia_ciclo_atual='". $_POST['ds_dia_ciclo_atual']."', ds_intrv_entre_ciclo_dia='". $_POST['ds_intrv_entre_ciclo_dia']."', ds_estmt='". $_POST['ds_estmt']."', ds_tipo_linha_trtmto='". $_POST['ds_tipo_linha_trtmto']."', ds_fnlde='". $_POST['ds_fnlde']."', ic_tipo_tumor='". $_POST['ic_tipo_tumor']."', ic_tipo_nodulo='". $_POST['ic_tipo_nodulo']."', ic_tipo_metastase='". $_POST['ic_tipo_metastase']."', cd_usua_altr = '".$_SESSION['usuario']."', dt_altr = current_timestamp, cd_cnvo='". $_POST['cd_cnvo']."' where id_pddo_trtmto = ". $_SESSION['id_pddo_trtmto']."";	
			
			//echo $sql;
			
			$result = pg_query($pdo, $sql);

			if($result){
				echo "";
			}  
			
			// Escreve a mensagem passada através da variável $msg
			$msg = "---------------------Log de Alteração do Pedido de Tratamento------------------------\n";
			$msg .= "Mensagem gerada pelo usuario: '".$_SESSION['usuario']."' em ".date('d/m/Y')."\n";
			$msg .= "-----------------------------------------------------------------------------------\n";
			$msg .= "Codigo Paciente: '".$_POST['cd_pcnt']."'\n";
			$msg .= "Convênio: '".$_POST['cd_cnvo']."'\n";
			$msg .= "Peso: '".$_POST['nu_peso_pcnt']."'\n";
			$msg .= "Altura: '".$_POST['vl_altura_pcnt']."'\n";
			$msg .= "Sup Corp: '".$_POST['vl_sup_corp']."'\n";
			$msg .= "Indicacao Clinica: '".$_POST['ds_indic_clnic']."'\n";
			$msg .= "Data do Diagnostico: '".$dt_diagn."'\n";
			$msg .= "CID: '".$_POST['cd_cid']."'\n";
			$msg .= "Estadiamento: '".$_POST['ds_estmt']."'\n";
			$msg .= "Tipo Quimio (Linha): '".$_POST['ds_tipo_linha_trtmto']."'\n";
			$msg .= "Finalidade: '".$_POST['ds_fnlde']."'\n";
			$msg .= "Tipo de Tumor: '".$_POST['ic_tipo_tumor']."'\n";
			$msg .= "Tipo de Nodulo: '".$_POST['ic_tipo_nodulo']."'\n";
			$msg .= "Tipo de Metastase: '".$_POST['ic_tipo_metastase']."'\n";
			$msg .= "Plano Terapêutio: '".$_POST['ds_plano_trptco']."'\n";
			$msg .= "Informações Relevantes: '".$_POST['ds_info_rlvnte']."'\n";
			$msg .= "Diagnóstico Histopatologico: '".$_POST['ds_diagn_cito_hstpagico']."'\n";
			$msg .= "Tipo de Cirurgia: '".$_POST['ds_tp_cirurgia']."'\n";
			$msg .= "Área Irradiada: '".$_POST['ds_area_irrda']."'\n";
			$msg .= "Data de Realização: '".$dt_rlzd."'\n";
			$msg .= "Data da Aplicação: '".$dt_aplc."'\n";
			$msg .= "Observação Justificativa: '".$_POST['ds_obs_jfta']."'\n";
			$msg .= "Quantidade de Ciclos Prevsitos: '".$_POST['nu_qtde_ciclo_prta']."'\n";
			$msg .= "Ciclo Atual: '".$_POST['ds_ciclo_atual']."'\n";
			$msg .= "Dias do ciclo atual: '".$_POST['ds_dia_ciclo_atual']."'\n";			
			$msg .= "Intervalo de Ciclos: '".$_POST['ds_intrv_entre_ciclo_dia']."'\n";			
			$msg .= "\n";			
			$msg .= "\n";			
			$msg .= "-----------------------------------------------------------------------------------\n";

			
			$sql = "insert into tratamento.tb_log_alrt (id_log_alrt, cd_alrt, ds_alert, cd_usua_incs_alrt, dt_incs_alrt) values ((select NEXTVAL('tratamento.sq_pddo_trtmto')),'ALTERACAO DE PEDIDO DE TRATAMENTO', '".str_replace("'"," ", $msg)."', '".$_SESSION['usuario']."', current_timestamp)";
			
			$result = pg_query($pdo, $sql);
			if($result){
				echo "";
			}
			
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
			
			$sql ="SELECT id_hstr_pnel_solic_trtmto from tratamento.tb_pddo_trtmto  WHERE id_pddo_trtmto = ".$_SESSION['id_pddo_trtmto']." ";				
			
			if ($pdo==null){
					header(Config::$webLogin);
			}	
			$ret = pg_query($pdo, $sql);
			if(!$ret) {
				echo pg_last_error($pdo);
				exit;
			}
			
			$row = pg_fetch_row($ret);
			if ($row[0]!=null){
				echo "<div class=\"alert alert-warning alert-dismissible\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<strong>Atenção!</strong> Pedido de tratamento está associado a um tratamento em realização. Exclua o tratamento para ecluir o pedido.</div>";
					
				$secondsWait = 5;
				header("Refresh:$secondsWait");
				
			} else {
			
				// remove do banco			
				$sql = "DELETE FROM tratamento.tb_pddo_trtmto WHERE id_pddo_trtmto = ".$_SESSION['id_pddo_trtmto']."";			
				$result = pg_query($pdo, $sql);

				if($result){
					echo "";
				}  
				
				$secondsWait = 0;
				header("Refresh:$secondsWait");
				
			}
			
		} catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
    	
?>	

	<!DOCTYPE html>
	<html lang="pt-br">
	<head>
	 <meta charset="utf-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <title>Cadastro de Pedido de Tratamento</title>

	 <link href="../css/bootstrap.min.css" rel="stylesheet">
	 <link href="../css/style.css" rel="stylesheet">
	</head>
	<body>

	 <div id="main" class="container-fluid" style="margin-top: 50px"> 
		<div class="container" style="margin-left: 0px">
			<form class="form-inline" action="#" method="post" >				
				<b>Consultar Pacientes:</b>:&nbsp;&nbsp													
				<input class="form-control" name="textoconsulta" type="text" placeholder="Pesquisar">&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="btn btn-primary" style="font-size: 11px;"  type="submit" value="Consultar" name="botaoconsultar">&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" style="font-size: 11px;"  value="Novo Registro" class="btn btn-primary btn-xs insere"/>&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="btn btn-primary" style="font-size: 11px;"  type="button" value="Exportar Último Pedido" id="exportarultimopedido">&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="btn btn-primary" style="font-size: 11px;"  type="button" value="Recuperar Último Pedido" id="recuperaulitmo">&nbsp;&nbsp;&nbsp;&nbsp;
			</form>
		</div> <!-- /#top -->
	 	
		<br>

		<div id="list" class="row">
		
		<div class="table-responsive col-md-12">
			<table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
				<thead>
					<tr>
						<th>Id do Pedido</th>
						<th>Paciente</th>
						<th>Data da Realização</th>	
						<th class="actions">Ações</th>
					</tr>
				</thead>				
				<tbody>
				<?php

					$cont=1;										
					while($row = pg_fetch_row($ret)) {
					?>						
						<tr>
							<td id="id_local_trtmto" value="<?php echo $row[0];?>"><?php echo $row[0];?></td>
							<td id="ds_local_trtmto" value="<?php echo $row[1];?>"><?php echo $row[1];?></td>
							<td id="nu_seq_local_pnel" value="<?php echo $row[2];?>"><?php echo $row[2];?></td>
														
							<td class="actions">								
								<input type="button" value="Visualizar" class="btn btn-success btn-xs visualiza"/>
								<input type="button" value="Alterar" class="btn btn-warning btn-xs altera"/>								
								<input type="button" value="Excluir" class="btn btn-danger btn-xs delecao"/>								
								<input type="button" value="PDF" class="btn btn-info btn-xs imprimirpdf"/>
							</td>
						</tr>
					<?php $cont=$cont+1;} ?>	
				</tbody>
			</table>
		</div>
		
		</div> <!-- /#list -->
		
	 </div> <!-- /#main -->

	 <script src="../js/jquery.min.js"></script>
	 <script src="../js/bootstrap.min.js"></script>
	</body>
	</html>	
	<div id="visualiza" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Visualização dos Dados</h4>
				</div>
				<div class="modal-body" id="visualizacao">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>
	<div id="imprimir" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Impressão</h4>
				</div>
				<div class="modal-body" id="impressao">
				</div>				
			</div>
		</div>
	</div>
	<script>
	$(document).ready(function(){
    
		$("#tabela").on('click','.delecao',function(){			
		
			var currentRow=$(this).closest("tr"); 
			
			var id_pddo_trtmto = currentRow.find("td:eq(0)").text();
			var nm_pcnt = currentRow.find("td:eq(1)").text();	
			var dt_rlzd = currentRow.find("td:eq(2)").text();	
			
			// AJAX code to submit form.
			$.ajax({
				 type: "POST",
				 url: "../delecao/delecao_pedido_tratamento.php", //
				 data: {id_pddo_trtmto:id_pddo_trtmto, nm_pcnt:nm_pcnt, dt_rlzd:dt_rlzd},
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
				url:"../insercao/insercao_pedido_tratamento.php",															
				success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
			});			
		});	

		$("#tabela").on('click','.altera',function(){			
		
			var currentRow=$(this).closest("tr"); 
			
			var id_pddo_trtmto = currentRow.find("td:eq(0)").text();
			var nm_pcnt = currentRow.find("td:eq(1)").text();	
			var dt_rlzd = currentRow.find("td:eq(2)").text();	
			
			// AJAX code to submit form.
			$.ajax({
				 type: "POST",
				 url: "../alteracao/alteracao_pedido_tratamento.php", //
				 data: {id_pddo_trtmto:id_pddo_trtmto, nm_pcnt:nm_pcnt, dt_rlzd:dt_rlzd},
				 dataType : "text",			 
				 success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				 }
			});
		});		
				
		$('#recuperaulitmo').click(function(){	
			$.ajax({
			type : 'POST',
				 url: '../alteracao/alteracao_ulitmo_pedido.php',
				 success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
			});
		});	

		$('#exportarultimopedido').click(function(){			
		
			$.ajax({
				type : 'POST',
				url : 'excelultimopedido.php', // give complete url here								
				success : function(completeHtmlPage) {	
					alert("Faça o download do arquivo de impressão. Abra no Excel e solicite para Salvar Como com o nome desejado.");
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
			});
		});			
		
		
		$("#tabela").on('click', '.visualiza', function(){
			
			var currentRow=$(this).closest("tr");
			
			var id_pddo_trtmto = currentRow.find("td:eq(0)").text();
			var nm_pcnt = currentRow.find("td:eq(1)").text();	
			var dt_rlzd = currentRow.find("td:eq(2)").text();								
						
			$.ajax({
				url:"../visualizacao/visualizacao_pedido_tratamento.php",
				method:"POST",
				data:{id_pddo_trtmto:id_pddo_trtmto, nm_pcnt:nm_pcnt, dt_rlzd:dt_rlzd},
				success:function(data){
					$('#visualizacao').html(data);
					$('#visualiza').modal('show');
				}
			});
        });
		
		$('#exportarultimopedido').click(function(){			
		
		$.ajax({
			type : 'POST',
			url : 'excelultimopedido.php', // give complete url here								
			success : function(completeHtmlPage) {	
				alert("Faça o download do arquivo de impressão. Abra no Excel e solicite para Salvar Como com o nome desejado.");
				$("html").empty();
				$("html").append(completeHtmlPage);
			}
		});
	});	
		
		$("#tabela").on('click', '.imprimirpdf', function(){
			
			var currentRow=$(this).closest("tr");
			
			var id_pddo_trtmto = currentRow.find("td:eq(0)").text();
			var nm_pcnt = currentRow.find("td:eq(1)").text();	
			var dt_rlzd = currentRow.find("td:eq(2)").text();								
						
			$.ajax({
				url:"impressao_por_pedidotratamento.php",
				method:"POST",
				data:{id_pddo_trtmto:id_pddo_trtmto, nm_pcnt:nm_pcnt, dt_rlzd:dt_rlzd},
				success:function(data){
					$('#impressao').html(data);
					$('#imprimir').modal('show');
				}
			});
        });
		
	});		
	
	</script>
<?php ?>