<?php
	
	session_start();		
	
    //include '../database.php';
	include 'conexao_sqlserver.php';
	//include 'config.php';
	
    global $objConnSqlServer;	
	
	$objConnSqlServer = conexao_sqlserver::connectSqlServer();	
	$textoconsulta = "";
	$retSqlServer = "";
	$sql = '';
	
	//if(isset($_POST['botaoconsultar'])){
		
		$sql ="select LOC_NOME, 
				convert(nvarchar, hsp_dthre, 103) as HSP_DTHRE, 
				PAC_NOME, 
				'CARACTER DE INTERN' AS DS_CRTR_INTNC, 
				PAC_SEXO, 
				convert(nvarchar, PAC_NASC, 103) as PAC_NASC,
				CNV_NOME,
				'MEDICO' AS DS_MDCO,
				'PSICOLOGO' AS DS_PSGO,
				'TERAPEUTA' AS DS_TRPTA,
				'FF-66' AS DS_CID,
				'S-N' AS FL_FMNTE,
				'DIETA' AS DS_DIETA,
				'CONSISTENCIA' AS DS_CONST,
				'01/01/2020' AS DT_PRVS_ALTA,
				'DS' AS DS_OCORR
		FROM dbo.view_db_gest_leitos; ";
		
		if ($objConnSqlServer){
			
			$retSqlServer = sqlsrv_query($objConnSqlServer,$sql);
		
			if($retSqlServer === false) {
				die( print_r( sqlsrv_errors(), true) );
			}	
		} else {
			
			echo "<div class=\"alert alert-warning alert-dismissible\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<strong>Erro de Conexão!</strong> Não foi possível conectar no Sistema de Prontuário Médico.</div>";
			
			//header(Config::$webLogin);
		}	
		
	//}
		
?>	

	<!DOCTYPE html>
	<html lang="pt-br">
	<head>
	 <meta charset="utf-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <title>Gestão de Leitos</title>

	 <link href="../css/bootstrap.min.css" rel="stylesheet">
	 <link href="../css/style.css" rel="stylesheet">
	  
		</head>
		<body id="aplicacao">
		 <div id="main" class="container-fluid" style="margin-top: 50px"> 
			<div class="container" style="margin-left: 0px ">
				<h2>Gestão de Leitos</h2>
				<br>				
				<hr>				
			</div>			
		</div> <!-- /#top -->
	 	
		<br>		

		<div id="list" class="row" style="margin-left: 5px; margin-right: 5px; ">
		
			<div class="table-responsive">
				<table class="table table-striped" cellspacing="5" cellpadding="2" id="tabela">
					<thead>
						<tr>
							<th style="width: 30%;">Leito</th>
							<th style="width: 10%;">Admissão</th>
							<th style="width: 40%;">Paciente</th>
							<th style="width: 40%;">Carater de Interação</th>
							<th style="width: 5%;">Sexo</th>																			
							<th style="width: 10%;">Data de Nasc.</th>
							<th style="width: 30%;">Convênio</th>
							<th style="width: 15%;">Médico</th>
							<th style="width: 15%;">Psicólogo</th>
							<th style="width: 15%;">Terapeuta</th>
							<th style="width: 15%;">CID</th>
							<th style="width: 5%;">Fumante</th>
							<th rowspan="2" style="width: 30%;">Dieta/Consistência</th>
							<th style="width: 10%;">Prvs. de Alta</th>
							<th style="width: 30%;">Ocorrências</th>
							
						</tr>
					</thead>				
					<tbody>
					<?php
						
						$cont=1;										
						while($row = sqlsrv_fetch_array($retSqlServer, SQLSRV_FETCH_ASSOC)) {
						?>						
							<tr>
								<td id="loc_nome" value="<?php echo $row['LOC_NOME'];?>" ><?php echo $row['LOC_NOME'];?></td>
								
								<td id="hsp_dthre" value="<?php echo $row['HSP_DTHRE'];?>" ><?php echo $row['HSP_DTHRE'];?></td>
								
								<td id="pac_nome" value="<?php echo $row['PAC_NOME'];?>" style="width: 15px;"><?php echo $row['PAC_NOME'];?></td>
								
								<td id="ds_crtr_intnc" value="<?php echo ['DS_CRTR_INTNC'];?>" style="width: 15px;"><input type="text" value="<?php echo $row['DS_CRTR_INTNC'];?>" style="display:none"/><?php echo $row['DS_CRTR_INTNC'];?></td>
								
								<td id="pac_sexo" value="<?php echo $row['PAC_SEXO'];?>" style="width: 15px;"><?php echo $row['PAC_SEXO'];?></td>								
								
								<td id="pac_nasc" value="<?php echo $row['PAC_NASC'];?>" style="width: 15px;"><?php echo $row['PAC_NASC'];?></td>
								
								<td id="cnv_nome" value="<?php echo $row['CNV_NOME'];?>" style="width: 15px;"><?php echo $row['CNV_NOME'];?></td>
								
								<td id="ds_mdco" value="<?php echo $row['DS_MDCO'];?>" style="width: 15px;"><input type="text" value="<?php echo $row['DS_MDCO'];?>" style="display:none"/><?php echo $row['DS_MDCO'];?></td>
								
								<td id="ds_psgo" value="<?php echo $row['DS_PSGO'];?>" style="width: 15px;"><input type="text" value="<?php echo $row['DS_PSGO'];?>" style="display:none"/><?php echo $row['DS_PSGO'];?></td>
								
								<td id="ds_trpta" value="<?php echo $row['DS_TRPTA'];?>" style="width: 15px;"><input type="text" value="<?php echo $row['DS_TRPTA'];?>" style="display:none"/><?php echo $row['DS_TRPTA'];?></td>
								
								<td id="ds_cid" value="<?php echo $row['DS_CID'];?>" style="width: 15px;"><input type="text" value="<?php echo $row['DS_CID'];?>" style="display:none"/><?php echo $row['DS_CID'];?></td>
								
								<td id="fl_fmnte" value="<?php echo $row['FL_FMNTE'];?>" style="width: 15px;"><input type="text" value="<?php echo $row['FL_FMNTE'];?>" style="display:none"/><?php echo $row['FL_FMNTE'];?></td>
								
								<td id="ds_dieta" value="<?php echo $row['DS_DIETA'];?>" style="width: 15px;"><input type="text" value="<?php echo $row['DS_DIETA'];?>" style="display:none"/><?php echo $row['DS_DIETA'];?></td>
								
								<td id="ds_const" value="<?php echo $row['DS_CONST'];?>" style="width: 15px;"><input type="text" value="<?php echo $row['DS_CONST'];?>" style="display:none"/><?php echo $row['DS_CONST'];?></td>
												
								<td id="dt_prvs_alta" value="<?php echo $row['DT_PRVS_ALTA'];?>" style="width: 15px;"><input type="text" value="<?php echo $row['DT_PRVS_ALTA'];?>" style="display:none"/><?php echo $row['DT_PRVS_ALTA'];?></td>
								
								<td id="ds_ocorr" value="<?php echo $row['DS_OCORR'];?>" style="width: 15px;"><input type="text" value="<?php echo $row['DS_OCORR'];?>" style="display:none"/><?php echo $row['DS_OCORR'];?></td>
								
							</tr>
						<?php $cont=$cont+1;}  ?>	
					</tbody>
				</table>
			</div>
		
		</div> <!-- /#list -->
		
	 <script src="../js/jquery.min.js"></script>
	 <script src="../js/bootstrap.min.js"></script>
	</body>
	<!--function selecionaPresenca(indexCol, flagPresenca) {
			
		  var iLinhaTabela;
		  
		  for(iLinhaTabela = 1;iLinhaTabela <= document.getElementById("tabela").rows.length;iLinhaTabela++){
		  
			  var celpresenca = document.getElementById("tabela").rows[iLinhaTabela].cells;		
				
			  celpresenca[indexCol].childNodes[0].selectedIndex=0;
			  
			  for(i = 0;i <= celpresenca[0].childNodes[0].length;i++){
				
				if (celpresenca[indexCol].childNodes[0].options[i].text==flagPresenca){
					celpresenca[indexCol].childNodes[0].value=flagPresenca;					
					break;
				}
				
				celpresenca[indexCol].childNodes[0].selectedIndex=i;
			  }
			  
			  //var celtextojust = document.getElementById("tabela").rows[iLinhaTabela].cells;
			  //alert(celtextojust[1].childNodes[0].value);
		  }
		  
		}		
		function realiza() {
			
		  var iLinhaTabela;
		  
		  for(iLinhaTabela = 1;iLinhaTabela <= 2;iLinhaTabela++){
			  //document.getElementById("tabela").rows.length
		  
			  var cel = document.getElementById("tabela").rows[iLinhaTabela].cells;		
			  
			  //alert("../agenda/atualizagrupoatividadepaciente.php?id_agdmto_atvd_pts=" + cel[2].childNodes[0].value +"?fl_agdmto_atvd_rlzd_pts=" + cel[3].childNodes[0].value +"?id_jtfc_atvd_pts=" + cel[4].childNodes[1].value +"?ds_jtfc_atvd_pts=" + cel[5].childNodes[0].value);
			  
			  var sql='teste';
			  
			  var sendData = function() {
				  $.post('test.php', {
					data: sql
				  }, function(response) {
					console.log(response);
				  });
				}
				sendData();			
			  
		  }
		  
		}	  -->

	</html>		
<script>		
	$(document).ready(function(){		  			
		$("#aplicacao").on('click', '.realiza', function(){
		
		var iLinhaTabela=0;
		var sql="";
		
		var sessionusua='<?php echo $_SESSION['usuario']; ?>';		
		var id_atvd_pts='<?php echo $_SESSION['id_atvd_pts_text']; ?>';
	  
		for(iLinhaTabela = 1;iLinhaTabela < document.getElementById("tabela").rows.length;iLinhaTabela++){
		
			var cel = document.getElementById("tabela").rows[iLinhaTabela].cells;			
			
			var id_agdmto_atvd_pts = cel[2].childNodes[0].value;			
			var fl_agdmto_atvd_rlzd_pts = cel[3].childNodes[0].value;			
			var id_jtfc_atvd_pts = cel[4].childNodes[1].value;
			var ds_jtfc_atvd_pts = cel[5].childNodes[0].value;
			
			if(id_jtfc_atvd_pts==""){
				id_jtfc_atvd_pts="null";				
			} 			
			
			if(id_jtfc_atvd_pts=="null"){				
				ds_jtfc_atvd_pts="";
			}
			
			if(fl_agdmto_atvd_rlzd_pts=="S"){
				id_jtfc_atvd_pts="null";
				ds_jtfc_atvd_pts="";
			}
			
			sql += "update pts.tb_agdmto_atvd_pts set vl_meta_atvd_pts = (select vl_meta_atvd_pts from pts.tb_c_atvd_pts where id_atvd_pts = " + id_atvd_pts + "), ds_jtfc_atvd_pts= '" + ds_jtfc_atvd_pts + "' , id_jtfc_atvd_pts = " +id_jtfc_atvd_pts + ", fl_agdmto_atvd_rlzd_pts = '" + fl_agdmto_atvd_rlzd_pts + "', cd_usua_resp_atvd_pts = (select cd_usua_acesso from pts.tb_c_usua_acesso where nm_usua_acesso = '" + sessionusua + "'), cd_usua_altr = '" + sessionusua + "', dt_altr = current_timestamp where id_agdmto_atvd_pts = " + id_agdmto_atvd_pts + ";"
			
		}				
		$.ajax({
				url:"../agenda/atualizagrupoatividadepaciente.php",
				method:"POST",
				data:{sql:sql},
				dataType : "text",			 
				success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
		});
		
	});
		
});	
</script>
<?php ?>