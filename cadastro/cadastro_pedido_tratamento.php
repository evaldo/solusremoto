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
		
			$sql = "insert into tratamento.tb_c_local_trtmto (id_local_trtmto, ds_local_trtmto, nu_seq_local_pnel, cd_usua_incs, dt_incs) values ((select NEXTVAL('tratamento.sq_equipe')), '". $_POST['ds_local_trtmto']."', ". $_POST['nu_seq_local_pnel'].", '".$_SESSION['usuario']."', current_timestamp);";

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
			
			$sql = "update tratamento.tb_c_local_trtmto set ds_local_trtmto = '". $_POST['ds_local_trtmto']."', cd_usua_altr = '".$_SESSION['usuario']."', nu_seq_local_pnel = ". $_POST['nu_seq_local_pnel'].",  dt_altr = current_timestamp where id_local_trtmto = ". $_SESSION['id_local_trtmto']."";	
			
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
			// remove do banco			
			$sql = "DELETE FROM tratamento.tb_c_local_trtmto WHERE id_local_trtmto = ".$_SESSION['id_local_trtmto']."";			
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
		<div class="modal-dialog">
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
	<script>
	$(document).ready(function(){
    
		$("#tabela").on('click','.delecao',function(){			
		
			var currentRow=$(this).closest("tr"); 
			
			var id_local_trtmto = currentRow.find("td:eq(0)").text();
			var ds_local_trtmto = currentRow.find("td:eq(1)").text();	
			var nu_seq_local_pnel = currentRow.find("td:eq(2)").text();	
			
			// AJAX code to submit form.
			$.ajax({
				 type: "POST",
				 url: "../delecao/delecao_local_tratamento.php", //
				 data: {id_local_trtmto:id_local_trtmto, ds_local_trtmto:ds_local_trtmto, nu_seq_local_pnel:nu_seq_local_pnel},
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
			
			var id_local_trtmto = currentRow.find("td:eq(0)").text();
			var ds_local_trtmto = currentRow.find("td:eq(1)").text();			
			var nu_seq_local_pnel = currentRow.find("td:eq(2)").text();
			
			// AJAX code to submit form.
			$.ajax({
				 type: "POST",
				 url: "../alteracao/alteracao_local_tratamento.php", //
				 data: {id_local_trtmto:id_local_trtmto, ds_local_trtmto:ds_local_trtmto, nu_seq_local_pnel:nu_seq_local_pnel},
				 dataType : "text",			 
				 success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				 }
			});
		});		
		
		
		$("#tabela").on('click', '.visualiza', function(){
			
			var currentRow=$(this).closest("tr"); 			
			var id_local_trtmto = currentRow.find("td:eq(0)").text();							
						
			$.ajax({
				url:"../visualizacao/visualizacao_local_tratamento.php",
				method:"POST",
				data:{id_local_trtmto:id_local_trtmto},
				success:function(data){
					$('#visualizacao').html(data);
					$('#visualiza').modal('show');
				}
			});
        });
		
	});		
	
	</script>
<?php ?>