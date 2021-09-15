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
		
			$sql = "INSERT INTO tratamento.tb_pddo_trtmto(id_pddo_trtmto, id_hstr_pnel_solic_trtmto, cd_pcnt, nm_pcnt, dt_nasc_pcnt, vl_idade_pcnt, nu_peso_pcnt, vl_altura_pcnt, vl_sup_corp, ds_indic_clnic, dt_diagn, cd_cid, ds_plano_trptco, ds_info_rlvnte, ds_diagn_cito_hstpagico, ds_tp_cirurgia, ds_area_irrda, dt_rlzd, dt_aplc, ds_obs_jfta, nu_qtde_ciclo_prta, ds_ciclo_atual, ds_dia_ciclo_atual, ds_intrv_entre_ciclo_dia, ds_estmt, ds_tipo_linha_trtmto, ds_fnlde, ic_tipo_tumor, ic_tipo_nodulo, ic_tipo_metastase, cd_usua_incs, dt_incs)
	VALUES ((select NEXTVAL('tratamento.sq_pddo_trtmto')), ". $_POST['id_hstr_pnel_solic_trtmto'].", '". $_POST['cd_pcnt']."', (select nm_pcnt from tratamento.tb_c_pcnt where cd_pcnt = '". $_POST['cd_pcnt']."'), (select dt_nasc_pcnt from tratamento.tb_c_pcnt where cd_pcnt = '". $_POST['cd_pcnt']."'), (select date_part('year', age(now(), (select dt_nasc_pcnt from tratamento.tb_c_pcnt where cd_pcnt = '". $_POST['cd_pcnt']."')))), ". str_replace(",", ".", $_POST['nu_peso_pcnt']).", ". str_replace(",", ".", $_POST['vl_altura_pcnt']).", ". str_replace(",", ".", $_POST['vl_sup_corp']).", '". $_POST['ds_indic_clnic']."', '". $_POST['dt_diagn']."', '". $_POST['cd_cid']."', '". $_POST['ds_plano_trptco']."', '". $_POST['ds_info_rlvnte']."', '". $_POST['ds_diagn_cito_hstpagico']."', '". $_POST['ds_tp_cirurgia']."', '". $_POST['ds_area_irrda']."', '". $_POST['dt_rlzd']."', '". $_POST['dt_aplc']."', '". $_POST['ds_obs_jfta']."', '". $_POST['nu_qtde_ciclo_prta']."', '". $_POST['ds_ciclo_atual']."', '". $_POST['ds_dia_ciclo_atual']."', '". $_POST['ds_intrv_entre_ciclo_dia']."', '". $_POST['ds_estmt']."' ,'". $_POST['ds_tipo_linha_trtmto']."', '". $_POST['ds_fnlde']."', '". $_POST['ic_tipo_tumor']."', '". $_POST['ic_tipo_nodulo']."', '". $_POST['ic_tipo_metastase']."', '".$_SESSION['usuario']."', current_timestamp);";
	
			//echo $sql;

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
	
	if(isset($_POST['altera'])){					
		
		if ($pdo==null){
			header(Config::$webLogin);
		}
		
		try
		{	
		
			if ($_POST['id_hstr_pnel_solic_trtmto']=='null' || $_POST['id_hstr_pnel_solic_trtmto']==null || $_POST['id_hstr_pnel_solic_trtmto']=='') {
				$_POST['id_hstr_pnel_solic_trtmto']='null';
			}
			
			$sql = "UPDATE tratamento.tb_pddo_trtmto
	SET id_hstr_pnel_solic_trtmto = ". $_POST['id_hstr_pnel_solic_trtmto']." ,nu_peso_pcnt=". str_replace(",", ".", $_POST['nu_peso_pcnt']).", vl_altura_pcnt=". str_replace(",", ".", $_POST['vl_altura_pcnt']).", vl_sup_corp=". str_replace(",", ".", $_POST['vl_sup_corp']).", ds_indic_clnic='". $_POST['ds_indic_clnic']."', dt_diagn='". $_POST['dt_diagn']."', cd_cid='". $_POST['cd_cid']."', ds_plano_trptco='". $_POST['ds_plano_trptco']."', ds_info_rlvnte='". $_POST['ds_info_rlvnte']."', ds_diagn_cito_hstpagico='". $_POST['ds_diagn_cito_hstpagico']."', ds_tp_cirurgia='". $_POST['ds_tp_cirurgia']."', ds_area_irrda='". $_POST['ds_area_irrda']."', dt_rlzd='". $_POST['dt_rlzd']."', dt_aplc='". $_POST['dt_aplc']."', ds_obs_jfta='". $_POST['ds_obs_jfta']."', nu_qtde_ciclo_prta='". $_POST['nu_qtde_ciclo_prta']."', ds_ciclo_atual='". $_POST['ds_ciclo_atual']."', ds_dia_ciclo_atual='". $_POST['ds_dia_ciclo_atual']."', ds_intrv_entre_ciclo_dia='". $_POST['ds_intrv_entre_ciclo_dia']."', ds_estmt='". $_POST['ds_estmt']."', ds_tipo_linha_trtmto='". $_POST['ds_tipo_linha_trtmto']."', ds_fnlde='". $_POST['ds_fnlde']."', ic_tipo_tumor='". $_POST['ic_tipo_tumor']."', ic_tipo_nodulo='". $_POST['ic_tipo_nodulo']."', ic_tipo_metastase='". $_POST['ic_tipo_metastase']."', cd_usua_altr = '".$_SESSION['usuario']."', dt_altr = current_timestamp where id_pddo_trtmto = ". $_SESSION['id_pddo_trtmto']."";	
			
			//echo $sql;
			
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
				<input class="btn btn-primary" type="submit" value="Consultar" name="botaoconsultar">&nbsp;&nbsp;											
				<input type="button" value="Novo Registro" class="btn btn-primary btn-xs insere"/>				
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