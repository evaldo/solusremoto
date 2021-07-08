<?php
	
	session_start();		
	
    include '../database.php';
    $pdo = database::connect();
	
	error_reporting(0); 	
		
	$textoconsulta = "";
	$retSqlServer = "";
	$sql = '';
	
		
	$sql ="select 1, 2, 3, 4, 5, 6";
			
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
			
			
			$sql = "SELECT status_trtmto.id_equipe
				 , equipe.ds_equipe
				 , status_trtmto.id_status_trtmto	 
				 , status_trtmto.ds_status_trtmto
				 , equipe.nu_seq_equipe_pnel
			FROM tratamento.tb_c_status_trtmto status_trtmto
			   , tratamento.tb_c_equipe equipe
			WHERE equipe.id_equipe = status_trtmto.id_equipe
			  and status_trtmto.fl_ativo = 1
			  and status_trtmto.fl_status_inicial_trtmto = 1
			ORDER BY equipe.nu_seq_equipe_pnel ";
			
			//Para cada registro acima inserir o tratamento para o paciente. Criar um loop para a inserção
			
			$sql = "insert into tratamento.tb_c_menu_sist_tratamento values ((select NEXTVAL('tratamento.sq_menu_sist_tratamento')), '". $_POST['nm_menu_sist_tratamento']."', '". $fl_menu_princ ."', ".$_POST['id_menu_supr'].", '". $_POST['nm_objt'] ."', '". $_POST['nm_link_objt'] ."', '". $_SESSION['usuario'] ."', current_timestamp, null,null);";

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
		
			$sql = "UPDATE integracao.tb_ctrl_leito SET WHERE trim(ds_leito) = '". $_POST['nm_loc_nome'] ."'";
						
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
			 <title>Processo de Solicitação e Agendamento de Quimioterapia</title>			 
			 <link href="../css/bootstrap.min.css" rel="stylesheet">
			 <link href="../css/style.css" rel="stylesheet">	 			 		 			 
	  
		</head>
		<body id="aplicacao" onload="removeDivsEtapasCarga();">			
			<div class="container" style="margin-left: 0px; margin-right: 0px; position:fixed; margin-top: 0px; background-color:white; max-width: 5000px; height: 50px; border: 1px solid #E6E6E6;">
			
				<input class="btn btn-primary" style="font-size: 11px;" type="submit" value="Exportar" id="exportarplanejamento">&nbsp;
						
				<input type="button" value="Novo Paciente" style="font-size: 11px;" class="btn btn-primary btn-xs insere"/>
			
			</div>
			
			<div id="list" class="row" style="margin-left: 2px; margin-right: 2px">
				
				<div class="table-responsive" style="margin-top: 50px">				
					<table id="tabela" class="display table table-responsive table-striped table-bordered table-sm table-condensed">
					
						<tr style="font-size: 11px">
							<?php
								$sqlequipe ="select ds_equipe from tratamento.tb_c_equipe order by nu_seq_equipe_pnel asc";
				
								$retequipe = pg_query($pdo, $sqlequipe);
								
								if(!$retequipe) {
									echo pg_last_error($pdo);		
									exit;
								}
								
								while($rowequipe = pg_fetch_row($retequipe)) {
								
							?>
									<th style="text-align:center"><?php echo $rowequipe[0]; ?></th>
							<?php 							
								
							}  ?>
							<th colspan="3" style="text-align:center">Ações</th>
						</tr>
						
						<tbody>
						<?php
							
							$cont=1;										
							while($row = pg_fetch_row($ret)) {
								?>											
								<tr >
									<td data-toggle="tooltip" data-placement="top" title=<?php echo $row[1];?> style="font-weight:bold; color:red; background-color:#E0FFFF" id="<?php echo $row[0];?>" value="<?php echo $row[0];?>" ><?php echo $row[1];?></td>
									<td data-toggle="tooltip" data-placement="top" title=<?php echo $row[1];?> style="font-weight:bold; color:red; background-color:#E0FFFF" id="<?php echo $row[0];?>" value="<?php echo $row[0];?>" ><?php echo $row[1];?></td>
									<td data-toggle="tooltip" data-placement="top" title=<?php echo $row[1];?> style="font-weight:bold; color:red; background-color:#E0FFFF" id="<?php echo $row[0];?>" value="<?php echo $row[0];?>" ><?php echo $row[1];?></td>
									<td data-toggle="tooltip" data-placement="top" title=<?php echo $row[1];?> style="font-weight:bold; color:red; background-color:#E0FFFF" id="<?php echo $row[0];?>" value="<?php echo $row[0];?>" ><?php echo $row[1];?></td>
									<td data-toggle="tooltip" data-placement="top" title=<?php echo $row[1];?> style="font-weight:bold; color:red; background-color:#E0FFFF" id="<?php echo $row[0];?>" value="<?php echo $row[0];?>" ><?php echo $row[1];?></td>
									<td data-toggle="tooltip" data-placement="top" title=<?php echo $row[1];?> style="font-weight:bold; color:red; background-color:#E0FFFF" id="<?php echo $row[0];?>" value="<?php echo $row[0];?>" ><?php echo $row[1];?></td>				
									<td class="actions">
										<input type="image" src="../img/lupa_1.png"  height="23" width="23" class="btn-xs visualiza"/>
									</td>
									<td class="actions">
										<input type="image" src="../img/Update_2.ico"  height="23" width="23" name="atualizaleito" data-toggle="modal" data-target="#atualizaleito" class="btn-xs classatualizaleito"/>
									</td>
									<td class="actions">
										<input type="image" src="../img/imprimileito.png"  height="23" width="23"  class="btn-xs imprimileito"/>
									</td>
							</tr>
							<?php 
							
								$cont=$cont+1;
							}  ?>
									
						</tbody>
					</table>
				</div>
				
			</div> 
			 <script src="../js/jquery.min.js"></script>
			 <script src="../js/bootstrap.min.js"></script>
			 <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
			
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
		$("#tabela").on('click', '.loader', function(){
			
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
	
	$(document).on('click', '.insere', function(){
			event.preventDefault();			
			$.ajax({
				type: "POST",
				url:"../insercao/insercao_paciente.php",															
				success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
			});			
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