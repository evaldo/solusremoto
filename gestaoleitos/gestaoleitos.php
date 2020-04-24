<?php
	
	session_start();		
	
    include '../database.php';
	include '../conexao_sqlserver.php';
	//include '../config.php';
	
    global $objConnSqlServer;	
	
	$objConnSqlServer = conexao_sqlserver::connectSqlServer();	
	$textoconsulta = "";
	$retSqlServer = "";
	$sql = '';
	
	//if(isset($_POST['botaoconsultar'])){
		
		$sql ="select LOC_NOME, 
		        CASE WHEN LTRIM(RTRIM(REPLACE(LOC_NOME, 'LEITO',''))) NOT IN ('ECT1', 'ECT2') THEN
					SUBSTRING(LTRIM(RTRIM(REPLACE(LOC_NOME, 'LEITO',''))), 1, 1) + ' ANDAR'
				ELSE
					LTRIM(RTRIM(REPLACE(LOC_NOME, 'LEITO','')))
				END AS DS_ANDAR,
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
				'SIM' AS FL_FMNTE,
				'Alergia Alimentar' AS DS_DIETA,
				'CONSISTENCIA' AS DS_CONST,
				'01/01/2020' AS DT_PRVS_ALTA,
				', Teste...1, 2, 3..., Teste...1, 2, 3..., Teste...1, 2, 3..., Teste...1, 2, 3...' AS DS_OCORR,
				'RET' as FL_RTGRD,
				'ACM' as FL_ACMP,
				'Em manutenção' as DS_STATUS
		FROM dbo.view_db_gest_leitos ORDER BY 1, 3; ";
		
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
				
			</style>
			 <meta charset="utf-8">
			 <meta http-equiv="X-UA-Compatible" content="IE=edge">
			 <meta name="viewport" content="width=device-width, initial-scale=1">
			 <title>Gestão de Leitos</title>			 
			 <link href="../css/bootstrap.min.css" rel="stylesheet">
			 <link href="../css/style.css" rel="stylesheet">	 			 		 			 
	  
		</head>
		<body id="aplicacao">		 		
	 	<div class="container" style="margin-left: 0px; margin-right: 0px; position:fixed; margin-top: 0px; background-color:white; max-width: 5000px; height: 120px; border: 1px solid #E6E6E6;">
			<h2>Gestão de Leitos</h2>
			<br>
			<label> Nome do paciente: <input style="width: 300px" type="text" id="buscapac" onkeyup="Busca(3, 'buscapac')" placeholder="Texto da Busca..." title="Texto da Busca"> </label>
			<label> Andar: <input style="width: 300px" type="text" id="buscaandar" onkeyup="Busca(1, 'buscaandar')" placeholder="Texto da Busca..." title="Texto da Busca"> </label>			
		</div> <!-- /#top -->
		
		<div id="list" class="row" style="margin-left: 2px; margin-right: 2px">
			
			<div class="table-responsive" style="margin-top: 120px">				
				<table id="tabela" class="display table table-responsive table-striped table-bordered table-sm table-condensed">
				
					<tr>
						<th style="text-align:center">Leito</th>
						<th style="text-align:center">Andar</th>
						<th style="text-align:center">Admissão</th>
						<th style="text-align:center">Paciente</th>
						<th style="text-align:center">Carater de Internação</th>
						<th style="text-align:center">Sexo</th>																			
						<th style="text-align:center">Data de Nasc.</th>
						<th style="text-align:center">Convênio</th>
						<th style="text-align:center">Médico</th>
						<th style="text-align:center">Psicólogo</th>
						<th style="text-align:center">Terapeuta</th>
						<th style="text-align:center">Grupo de CID</th>
						<th style="text-align:center">Fumante</th>
						<th colspan="2" style="text-align:center">Dieta/Consistência</th>
						<th style="text-align:center">Prvs. de Alta</th>
						<th style="text-align:center">Ocorrências</th>
						<th style="text-align:center">Retagd.</th>
						<th style="text-align:center">Acomp.</th>
						<th style="text-align:center">Status</th>
						<th style="text-align:center">Ações</th>
						
					</tr>
					
					<tbody>
					<?php
						
						$cont=1;										
						while($row = sqlsrv_fetch_array($retSqlServer, SQLSRV_FETCH_ASSOC)) {
						?>						
							<tr>
								<td data-toggle="tooltip" data-placement="top" title="Leito" style="font-weight:bold; color:red; background-color:#E0FFFF" id="loc_nome" value="<?php echo $row['LOC_NOME'];?>" ><?php echo $row['LOC_NOME'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Andar" style="font-weight:bold; text-align:center" id="ds_andar" value="<?php echo $row['DS_ANDAR'];?>" ><?php echo $row['DS_ANDAR'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Admissão" style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="hsp_dthre" value="<?php echo $row['HSP_DTHRE'];?>" ><?php echo $row['HSP_DTHRE'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Paciente" id="pac_nome" value="<?php echo $row['PAC_NOME'];?>"><?php echo $row['PAC_NOME'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Carater de Internação" id="ds_crtr_intnc" value="<?php echo $row['DS_CRTR_INTNC'];?>"><?php echo $row['DS_CRTR_INTNC'];?></td>
								
								<!--<td id="ds_crtr_intnc"><input type="text" value="<?php echo $row['DS_CRTR_INTNC'];?>" class="form-control"/></td>-->
								
								<td data-toggle="tooltip" data-placement="top" title="Sexo" style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="pac_sexo" value="<?php echo $row['PAC_SEXO'];?>"><?php echo $row['PAC_SEXO'];?></td>								
								
								<td data-toggle="tooltip" data-placement="top" title="Data de Nasc." style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="pac_nasc" value="<?php echo $row['PAC_NASC'];?>"><?php echo $row['PAC_NASC'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Convênio" style="font-weight:bold; background-color:#C0C0C0"id="cnv_nome" value="<?php echo $row['CNV_NOME'];?>"><?php echo $row['CNV_NOME'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Médico" id="ds_mdco" value="<?php echo $row['DS_MDCO'];?>"><input type="text" value="<?php echo $row['DS_MDCO'];?>" style="display:none"/><?php echo $row['DS_MDCO'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Psicólogo" id="ds_psgo" value="<?php echo $row['DS_PSGO'];?>"><input type="text" value="<?php echo $row['DS_PSGO'];?>" style="display:none"/><?php echo $row['DS_PSGO'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Terapeuta" id="ds_trpta" value="<?php echo $row['DS_TRPTA'];?>"><input type="text" value="<?php echo $row['DS_TRPTA'];?>" style="display:none"/><?php echo $row['DS_TRPTA'];?></td>
								
								<td  data-toggle="tooltip" data-placement="top" title="Grupo de CID" style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="ds_cid" value="<?php echo $row['DS_CID'];?>"><input type="text" value="<?php echo $row['DS_CID'];?>" style="display:none"/><?php echo $row['DS_CID'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Fumante?" style="text-align:center" id="fl_fmnte" value="<?php echo $row['FL_FMNTE'];?>" style="width: 15px;"><input type="text" value="<?php echo $row['FL_FMNTE'];?>" style="display:none"/><?php echo $row['FL_FMNTE'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Dieta/Consistência" style="font-weight:bold; background-color:#C0C0C0" id="ds_dieta" value="<?php echo $row['DS_DIETA'];?>"><input type="text" value="<?php echo $row['DS_DIETA'];?>" style="display:none"/><?php echo $row['DS_DIETA'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Dieta/Consistência" style="font-weight:bold; background-color:#C0C0C0" id="ds_const" value="<?php echo $row['DS_CONST'];?>"><input type="text" value="<?php echo $row['DS_CONST'];?>" style="display:none"/><?php echo $row['DS_CONST'];?></td>
												
								<td data-toggle="tooltip" data-placement="top" title="Prvs. de Alta" style="text-align:center" id="dt_prvs_alta" value="<?php echo $row['DT_PRVS_ALTA'];?>"><input type="text" value="<?php echo $row['DT_PRVS_ALTA'];?>" style="display:none"/><?php echo $row['DT_PRVS_ALTA'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Ocorrências" style="text-align:center; font-weight:bold; background-color:#FFE4C4" id="ds_ocorr" value="<?php echo $row['DS_OCORR'];?>"><input type="text" value="<?php echo $row['DS_OCORR'];?>" style="display:none"/><?php echo $row['DS_OCORR'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Retaguarda?" style="text-align:center" id="fl_rtgrd" value="<?php echo $row['FL_RTGRD'];?>"><input type="text" value="<?php echo $row['FL_RTGRD'];?>" style="display:none"/><?php echo $row['FL_RTGRD'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Acompanhante?" style="text-align:center" id="fl_acmp" value="<?php echo $row['FL_ACMP'];?>"><input type="text" value="<?php echo $row['FL_ACMP'];?>" style="display:none"/><?php echo $row['FL_ACMP'];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Status do Leito" style="text-align:center" id="ds_status" value="<?php echo $row['DS_STATUS'];?>"><input type="text" value="<?php echo $row['DS_STATUS'];?>" style="display:none"/><?php echo $row['DS_STATUS'];?></td>
								
								<td class="actions">								
									<input type="button" value="..." class="btn btn-success btn-xs atualizar"/>
									
								</td>
								
							</tr>
						<?php $cont=$cont+1;}  ?>	
					</tbody>
				</table>
			</div>
			
		</div> <!-- /#list -->				
		
	 <script src="../js/jquery.min.js"></script>
	 <script src="../js/bootstrap.min.js"></script>
	 <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	 <script>
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
	  $('[data-toggle="tooltip"]').tooltip();
	});
	
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