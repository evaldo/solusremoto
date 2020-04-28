<?php
	
	session_start();		
	
    include '../database.php';
    $pdo = database::connect();
	
	//error_reporting(0); 
	
	$itens_por_pagina=30;
	$pagina=intval($_GET['pagina']);
		
	$textoconsulta = "";
	$retSqlServer = "";
	$sql = '';
		
	$sql ="select count(1) AS QTDE_REG FROM integracao.tb_ctrl_leito; ";
	
	$ret = pg_query($pdo, $sql);
	if(!$ret) {
		echo pg_last_error($pdo);
		header(Config::$webLogin);
		exit;
	}
	
	$row = pg_fetch_row($ret);		
	$num_total = $row[1];	
	$num_paginas = ceil($num_total/$itens_por_pagina);
	$num_reg_pagina = $pagina*$itens_por_pagina;
	
	$sql ="select  
		ds_leito,
		ds_andar,
		dt_admss,
		nm_pcnt,
		ds_crtr_intnc,
		dt_nasc_pcnt,
		nm_cnvo,
		nm_mdco,
		nm_psco,
		nm_trpa,
		ds_cid,
		fl_fmnte,
		ds_dieta,
		ds_const,
		dt_prvs_alta,
		fl_rtgrd boolean,
		fl_acmpte boolean,
		fl_status_leito,
		ds_apto_atvd_fisica,
		ds_progra,
		hr_progra,
		fl_txclg_agndd,
		dt_rlzd,
		fl_rstc_visita,
		ds_pssoa_rtrta ,
		tp_dia_leito_manut,
		pac_reg,
		loc_leito_id,
		cd_ctrl_leito
		ds_ocorr,
		ds_sexo
		FROM integracao.tb_ctrl_leito
		ORDER BY 1, 3 LIMIT $itens_por_pagina OFFSET $pagina*$itens_por_pagina ";
			
	$ret = pg_query($pdo, $sql);
	if(!$ret) {
		echo pg_last_error($pdo);
		header(Config::$webLogin);
		exit;
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
			<label style="font-weight:bold; font-size: 11px"> Nome do paciente: <input style="width: 300px; font-size: 11px" type="text" id="buscapac" onkeyup="Busca(3, 'buscapac')" placeholder="Texto da Busca..." title="Texto da Busca"> </label>
			<label style="font-weight:bold; font-size: 11px"> Andar: <input style="width: 300px; font-size: 11px" type="text" id="buscaandar" onkeyup="Busca(1, 'buscaandar')" placeholder="Texto da Busca..." title="Texto da Busca"> </label>			
		</div> <!-- /#top -->
		
		<div id="list" class="row" style="margin-left: 2px; margin-right: 2px">
			
			<div class="table-responsive" style="margin-top: 120px">				
				<table id="tabela" class="display table table-responsive table-striped table-bordered table-sm table-condensed">
				
					<tr style="font-size: 11px">
						<th style="text-align:center">Leito</th>
						<th style="text-align:center">Andar</th>
						<th style="text-align:center">Admissão</th>
						<th style="text-align:center">Paciente</th>
						<th style="text-align:center">Carater de Internação</th>
						<!--<th style="text-align:center">Sexo</th>-->								
						<th style="text-align:center">Data de Nasc.</th>
						<th style="text-align:center">Convênio</th>
						<th style="text-align:center">Médico</th>
						<th style="text-align:center">Psicólogo</th>
						<th style="text-align:center">Terapeuta</th>
						<th style="text-align:center">Grupo de CID</th>
						<th style="text-align:center">Fumante</th>
						<th colspan="2" style="text-align:center">Dieta/Consistência</th>
						<th style="text-align:center">Prvs. de Alta</th>
						<!--<th style="text-align:center">Ocorrências</th>-->
						<th style="text-align:center">Retagd.</th>
						<th style="text-align:center">Acomp.</th>
						<th style="text-align:center">Status</th>
						<th colspan="2" style="text-align:center">Ações</th>
						
					</tr>
					
					<tbody>
					<?php
						
						$cont=1;										
						while($row = sqlsrv_fetch_array($retSqlServer, SQLSRV_FETCH_ASSOC)) {
						?>						
							<tr>
								<td data-toggle="tooltip" data-placement="top" title="Leito" style="font-weight:bold; color:red; background-color:#E0FFFF" id="loc_nome" value="<?php echo $row[1];?>" ><?php echo $row[1];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Andar" style="font-weight:bold; text-align:center" id="ds_andar" value="<?php echo $row[2];?>" ><?php echo $row[2];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Admissão" style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="hsp_dthre" value="<?php echo $row[3];?>" ><?php echo $row[3];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Paciente" id="pac_nome" value="<?php echo $row[4];?>"><?php echo $row[4];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Carater de Internação" id="ds_crtr_intnc" value="<?php echo $row[5];?>"><?php echo $row[5];?></td>
								
								<!--<td id="ds_crtr_intnc"><input type="text" value="<?php echo $row['DS_CRTR_INTNC'];?>" class="form-control"/></td>-->
								
								<!--<td data-toggle="tooltip" data-placement="top" title="Sexo" style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="pac_sexo" value="<?php echo $row['PAC_SEXO'];?>"><?php echo $row['PAC_SEXO'];?></td>-->
								
								<td data-toggle="tooltip" data-placement="top" title="Data de Nasc." style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="pac_nasc" value="<?php echo $row[6];?>"><?php echo $row[6];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Convênio" style="font-weight:bold; background-color:#C0C0C0"id="cnv_nome" value="<?php echo $row[7];?>"><?php echo $row[7];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Médico" id="ds_mdco" value="<?php echo $row[8];?>"><input type="text" value="<?php echo $row[8];?>" style="display:none"/><?php echo $row[8];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Psicólogo" id="ds_psgo" value="<?php echo $row[9];?>"><input type="text" value="<?php echo $row[9];?>" style="display:none"/><?php echo $row[9];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Terapeuta" id="ds_trpta" value="<?php echo $row[10];?>"><input type="text" value="<?php echo $row[10];?>" style="display:none"/><?php echo $row[10];?></td>
								
								<td  data-toggle="tooltip" data-placement="top" title="Grupo de CID" style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="ds_cid" value="<?php echo $row[11];?>"><input type="text" value="<?php echo $row[11];?>" style="display:none"/><?php echo $row[11];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Fumante?" style="text-align:center" id="fl_fmnte" value="<?php echo $row[12];?>" style="width: 15px;"><input type="text" value="<?php echo $row[12];?>" style="display:none"/><?php echo $row[12];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Dieta/Consistência" style="font-weight:bold; background-color:#C0C0C0" id="ds_dieta" value="<?php echo $row[13];?>"><input type="text" value="<?php echo $row[13];?>" style="display:none"/><?php echo $row[13];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Dieta/Consistência" style="font-weight:bold; background-color:#C0C0C0" id="ds_const" value="<?php echo $row[14];?>"><input type="text" value="<?php echo $row[14];?>" style="display:none"/><?php echo $row[14];?></td>
												
								<td data-toggle="tooltip" data-placement="top" title="Prvs. de Alta" style="text-align:center" id="dt_prvs_alta" value="<?php echo $row[15];?>"><input type="text" value="<?php echo $row[15];?>" style="display:none"/><?php echo $row[15];?></td>
								
								<!--<td data-toggle="tooltip" data-placement="top" title="Ocorrências" style="text-align:center; font-weight:bold; background-color:#FFE4C4" id="ds_ocorr" value="<?php echo $row['DS_OCORR'];?>"><input type="text" value="<?php echo $row['DS_OCORR'];?>" style="display:none"/><?php echo $row['DS_OCORR'];?></td>-->
								
								<td data-toggle="tooltip" data-placement="top" title="Retaguarda?" style="text-align:center" id="fl_rtgrd" value="<?php echo $row[16];?>"><input type="text" value="<?php echo $row[16];?>" style="display:none"/><?php echo $row[16];?></td>
								
								<td data-toggle="tooltip" data-placement="top" title="Acompanhante?" style="text-align:center" id="fl_acmp" value="<?php echo $row[17];?>"><input type="text" value="<?php echo $row[17];?>" style="display:none"/><?php echo $row[17];?></td>
								
								<!--Alterar aqui para condição de cores para o status-->
								<td data-toggle="tooltip" data-placement="top" title="Status do Leito" style="text-align:center; font-weight:bold; background-color:red" id="ds_status" value="<?php echo $row[18];?>"></td>
								
								<td class="actions">
									<input type="image" src="../img/lupa_1.png"  height="30" width="30" class="btn-xs visualiza"/>																		
								</td>
								
								<td class="actions">
									<input type="image" src="../img/Update_2.ico"  height="30" width="30" class="btn-xs visualiza"/>									
									
								</td>
								
							</tr>
						<?php $cont=$cont+1;}  ?>	
					</tbody>
				</table>
			</div>
			
		</div> <!-- /#list -->				
		<div>			
			<ul class="pagination">
				<li class="page-item"><a class="page-link" href="gestaoleitos.php?pagina=0">Primeiro</a></li>
				<?php 				
				for ($i=0; $i<$num_paginas;$i++){										
				?>
					<li class="page-item" ><a class="page-link" href="gestaoleitos.php?pagina=<?php echo $i;?>">
						<?php echo $i+1;?></a></li>
				<?php } ?>
				<li class="page-item"><a class="page-link" href="gestaoleitos.php?pagina=<?php echo $num_paginas-1; ?>">Último</a></li>
			</ul>		
		</div>
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
	
</html>
<div id="dataModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Detalhes do Paciente</h4>
			</div>
			<div class="modal-body" id="detalhe_paciente">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>			
<script>
	
	$(document).ready(function(){	  
		$('[data-toggle="tooltip"]').tooltip();		
	});		
	
	$(document).ready(function(){
		$("#tabela").on('click', '.visualiza', function(){
			
			var currentRow=$(this).closest("tr"); 							
			var nm_loc_nome_inteiro = currentRow.find("td:eq(0)").text();
			var nm_loc_nome_trim = nm_loc_nome_inteiro.trim();			
			var nm_loc_nome_replace = nm_loc_nome_trim.replace('LEITO ', '');			
			var nm_loc_nome = nm_loc_nome_replace.trim();			
												
			$.ajax({
				url:"../gestaoleitos/selecao_detalhe_paciente.php",
				method:"POST",
				data:{nm_loc_nome:nm_loc_nome},
				success:function(data){
					$('#detalhe_paciente').html(data);
					$('#dataModal').modal('show');
				}
			});
        });
	});
	
</script>
<?php ?>