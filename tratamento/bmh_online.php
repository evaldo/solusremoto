<?php
	
		session_start();		
		
		include '../database.php';
		
		global $pdo;	
		
		$pdo = database::connect();	
		$sql = '';
		
		$sql = "SELECT pac_reg
			 , nm_pcnt	 
			 , to_char(dt_admss, 'dd/mm/yyyy hh24:mi') dt_admss
			 , to_char(dt_alta, 'dd/mm/yyyy hh24:mi') dt_alta
			FROM integracao.tb_bmh_online
		where dt_alta is not null
		  and id_mtvo_alta is null
		order by 1 desc";
		
		if ($pdo==null){
			//header(Config::$webLogin);
		}	
		$ret = pg_query($pdo, $sql);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}
		
		
		if(isset($_POST['altera'])){					
			
			if ($pdo==null){
				header(Config::$webLogin);
			}
			
			try
			{	
			
				$sql = "UPDATE integracao.tb_bmh_online SET id_mtvo_alta = ".$_POST['id_mtvo_alta'].", cd_usua_altr = '" . $_SESSION['usuario'] . "', dt_altr = current_timestamp WHERE pac_reg = " . $_POST['pac_reg'] . " and to_char(dt_admss, 'dd/mm/yyyy hh24:mi') = '" . $_SESSION['dt_admss'] . "'";			
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
		
	?>	

		<!DOCTYPE html>
		<html lang="pt-br">
		<head>
		 <meta charset="utf-8">
		 <meta http-equiv="X-UA-Compatible" content="IE=edge">
		 <meta name="viewport" content="width=device-width, initial-scale=1">
		 <title>Boletim Médico On Line</title>

		 <link href="../css/bootstrap.min.css" rel="stylesheet">
		 <link href="../css/style.css" rel="stylesheet">
		  
			</head>
			<body id="aplicacao">
			
			<div class="container" style="margin-left: 0px; margin-right: 0px; position:fixed; margin-top: 0px; background-color:white; max-width: 5000px; height: 135px; border: 1px solid #E6E6E6;">
				<h3>BMHOnLine</h3>
				<br>
				<label style="font-weight:bold;">Filtros para emissão do Relatório</label>
				<br>
				<label style="font-weight:bold;">Data Inicial:</label>&nbsp;
				<input type="date" id="dataInicio" name="dataInicio"> &nbsp;&nbsp;
				<label style="font-weight:bold;">a</label>&nbsp;
				<label style="font-weight:bold;">Data Final:</label>&nbsp;
				<input type="date" id="dataFim" name="dataFim">&nbsp;&nbsp;
				<input class="btn btn-primary" type="button" value="Gerar Relatório" id="imprimir">&nbsp;
				<input class="btn btn-primary" type="submit" value="Exp. BMHOnline" id="exportarbmhonline">&nbsp;
			</div>			
			<div id="list" class="row" style="margin-left: 20px; margin-right: 20px; ">
			
				<div class="table-responsive" style="margin-top: 135px">
					<table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
						<thead>
							<tr>
								<th style="width: 5%;">Código</th>
								<th style="width: 55%;">Paciente</th>
								<th style="width: 20%;">Admissão</th>
								<th style="width: 20%;">Alta</th>
								<th colspan = "2" style="text-align:center">Ações</th>
							</tr>
						</thead>				
						<tbody>
						<?php
							
							$cont=1;										
							while($row = pg_fetch_row($ret)) {
							?>						
								<tr>
									
									<td id="pac_reg" value="<?php echo $row[0];?>"><?php echo $row[0];?></td>
									<td id="nm_pcnt" value="<?php echo $row[1];?>"><?php echo $row[1];?></td>
									<td id="dt_admss" value="<?php echo $row[2];?>"><?php echo $row[2];?></td>
									<td id="dt_alta" value="<?php echo $row[3];?>"><?php echo $row[3];?></td>

									<td class="actions">
										<input type="image" src="../img/lupa_1.png"  height="30" width="30" class="btn-xs visualiza"/>
									</td>
										
									<td class="actions">
										<input type="image" src="../img/Update_2.ico"  height="30" width="30" name="atualizapac" data-toggle="modal" data-target="#atualizapac" class="btn-xs classatualizapac"/>
											
									</td>
									
								</tr>
							<?php $cont=$cont+1;} ?>	
						</tbody>
					</table>
				</div>
			
			</div> <!-- /#list -->
			
		 <script src="../js/jquery.min.js"></script>
		 <script src="../js/bootstrap.min.js"></script>
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
		
		$('#exportarbmhonline').click(function(){
			
			var dataInicio = document.getElementById("dataInicio").value;		
			var dataFim = document.getElementById("dataFim").value;		
			
			$.ajax({
				url : '../gestaoleitos/relatorioexcelbmhonline.php', // give complete url here
				type : 'post',
				data:{dataInicio:dataInicio, dataFim:dataFim},
				success : function(completeHtmlPage) {	
					alert("Faça o download do arquivo de impressão. Abra no Excel e solicite para Salvar Como com o nome desejado.");
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
			});
		});
		
		
		$('#imprimir').click(function(){
			
			var dataInicio = document.getElementById("dataInicio").value;		
			var dataFim = document.getElementById("dataFim").value;		
			
			$.ajax({
				url : '../gestaoleitos/relatorio_bmhonline.php', // give complete url here
				type : 'post',
				data:{dataInicio:dataInicio, dataFim:dataFim},
				success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
			});
		});
	
		$(document).ready(function(){
			$("#tabela").on('click', '.visualiza', function(){
				
				var currentRow=$(this).closest("tr"); 							
				var pac_reg = currentRow.find("td:eq(0)").text();			
				
				$.ajax({
					url:"../gestaoleitos/selecao_detalhe_paciente_bmh_on_line.php",
					method:"POST",
					data:{pac_reg:pac_reg},
					success:function(data){
						$('#detalhe_paciente').html(data);
						$('#dataModal').modal('show');
					}
				});
			});
		});
		
		
		$(document).ready(function(){
			$("#tabela").on('click', '.classatualizapac', function(){
				
				var currentRow=$(this).closest("tr"); 							
				var pac_reg = currentRow.find("td:eq(0)").text();			
				var nm_pcnt = currentRow.find("td:eq(1)").text();
				var dt_admss = currentRow.find("td:eq(2)").text();
				
				$.ajax({
					url:"../gestaoleitos/atualizaaltabmhonline.php",
					method:"POST",
					data:{pac_reg:pac_reg, nm_pcnt:nm_pcnt, dt_admss:dt_admss},
					dataType : "text",			 
					success : function(completeHtmlPage) {				
						$("html").empty();
						$("html").append(completeHtmlPage);
					 }
				});
			});
		});
		
	</script>
<?php  ?>