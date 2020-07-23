<?php
	
		session_start();		
		
		include '../database.php';
		
		global $pdo;	
		
		$pdo = database::connect();	
		$sql = "";
		
		if(isset($_POST['botaoconsultar'])){
			
			$_SESSION['dataInicio']=$_POST['dataInicio'];			
			$_SESSION['dataFim']=$_POST['dataFim'];
			
			//2020-06-23
			$dia = substr($_SESSION['dataInicio'], 8, 2);
			$mes = substr($_SESSION['dataInicio'], 5, 2);
			$ano = substr($_SESSION['dataInicio'], 0, 4);
			
			$_SESSION['dataInicio'] = trim($dia).'/'.trim($mes).'/'.$ano;
			
			$dia = substr($_SESSION['dataFim'], 8, 2);
			$mes = substr($_SESSION['dataFim'], 5, 2);
			$ano = substr($_SESSION['dataFim'], 0, 4);
			
			$_SESSION['dataFim'] = trim($dia).'/'.trim($mes).'/'.$ano;
			
			$sql = "SELECT bmh.pac_reg
				 , bmh.nm_pcnt	 
				 , to_char(bmh.dt_admss, 'dd/mm/yyyy hh24:mi') dt_admss
				 , to_char(bmh.dt_alta, 'dd/mm/yyyy hh24:mi') dt_alta
				 , mtvo.ds_mtvo_alta
				FROM integracao.tb_bmh_online bmh
				   , integracao.tb_mtvo_alta mtvo
			where mtvo.id_mtvo_alta = bmh.id_mtvo_alta
			  and to_date(to_char(bmh.dt_admss, 'dd/mm/yyyy'), 'dd/mm/yyyy') >= to_date('".$_SESSION['dataInicio']."', 'dd/mm/yyyy')  
			  and to_date(to_char(bmh.dt_admss, 'dd/mm/yyyy'), 'dd/mm/yyyy') <= to_date('".$_SESSION['dataFim']."', 'dd/mm/yyyy') 
			  and bmh.dt_alta is not null
			order by 2 asc";			

		} else {

			$sql = "SELECT bmh.pac_reg
				 , bmh.nm_pcnt	 
				 , to_char(bmh.dt_admss, 'dd/mm/yyyy hh24:mi') dt_admss
				 , to_char(bmh.dt_alta, 'dd/mm/yyyy hh24:mi') dt_alta
				 , mtvo.ds_mtvo_alta
				FROM integracao.tb_bmh_online bmh
				   , integracao.tb_mtvo_alta mtvo
			where mtvo.id_mtvo_alta = bmh.id_mtvo_alta		
			order by 2 asc";
		
		}
		
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
		 <title>Alteração do Destino de Alta</title>

		 <link href="../css/bootstrap.min.css" rel="stylesheet">
		 <link href="../css/style.css" rel="stylesheet">
		  
			</head>
			<body id="aplicacao">
			
			<div class="container" style="margin-left: 0px; margin-right: 0px; position:fixed; margin-top: 0px; background-color:white; max-width: 5000px; height: 135px; border: 1px solid #E6E6E6;">
				<br>								
				<h3>Alteração do Destino de Alta</h3>
				<br>				
				<form class="form-inline" action="#" method="post" >										
					<label style="font-weight:bold;">Filtros para consulta - </label>&nbsp;&nbsp;
					<label style="font-weight:bold;">Data Inicial:</label>&nbsp;
					<input type="date" id="dataInicio" name="dataInicio"> &nbsp;&nbsp;
					<label style="font-weight:bold;">a</label>&nbsp;
					<label style="font-weight:bold;">Data Final:</label>&nbsp;
					<input type="date" id="dataFim" name="dataFim">&nbsp;&nbsp;
					<input class="btn btn-primary" type="submit" value="Consultar" name="botaoconsultar">&nbsp;
				</form>
			</div>
			<div id="list" class="row" style="margin-left: 20px; margin-right: 20px; ">
			
				<div class="table-responsive" style="margin-top: 135px">
					<table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
						<thead>
							<tr>
								<th style="width: 5%;">Código</th>
								<th style="width: 40%;">Paciente</th>
								<th style="width: 15%;">Admissão</th>
								<th style="width: 15%;">Alta</th>
								<th style="width: 40%;">Destino de Alta</th>
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
									<td id="dt_alta" value="<?php echo $row[4];?>"><?php echo $row[4];?></td>
	
									<td class="actions">
										<input type="image" src="../img/Update_2.ico"  height="30" width="30" name="atualizadestinoalta" data-toggle="modal" data-target="#atualizadestinoalta" class="btn-xs atualizadestinoalta"/>
											
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
	<script>	
		
		
		$(document).ready(function(){
			$("#tabela").on('click', '.atualizadestinoalta', function(){
				
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