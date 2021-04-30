<?php
//altera_cores.php
	session_start();
	$_SESSION['id_orig_dmnd_plnj_leito']=$_POST['id_orig_dmnd_plnj_leito'];
	
    include '../database.php';	
	
	$pdo = database::connect();

	$sql = "SELECT id_orig_dmnd_plnj_leito, ds_orig_dmnd_plnj_leito from integracao.tb_orig_dmnd_plnj_leito where id_orig_dmnd_plnj_leito = ".$_POST['id_orig_dmnd_plnj_leito']." ";

	if ($pdo==null){
			header(Config::$webLogin);
	}	
	$ret = pg_query($pdo, $sql);
	if(!$ret) {
		echo pg_last_error($pdo);
		exit;
	}
	
	$row = pg_fetch_row($ret);
		
	$id_orig_dmnd_plnj_leito = $row[0];
	$ds_orig_dmnd_plnj_leito = $row[1];	
	
	$sql = "SELECT id_orig_dmnd_plnj_leito, ds_orig_dmnd_plnj_leito from integracao.tb_orig_dmnd_plnj_leito order by 1";
	
	if ($pdo==null){
			header(Config::$webLogin);
	}	
    $ret = pg_query($pdo, $sql);
    if(!$ret) {
        echo pg_last_error($pdo);
        exit;
    }
	
?>
	<!DOCTYPE html>
	<html lang="pt-br">
	<head>
	 <meta charset="utf-8">
	 <link href="../css/bootstrap.min.css" rel="stylesheet">
	 <link href="../css/style.css" rel="stylesheet">
	</head>
	<body style="margin-right: 0; margin-left: 0">	
		<div class="container" style="width: 100%;  margin-right: 0; margin-left: 0; position: relative;">
		  <div class="modal-dialog">
				<div class="modal-content" style="width:800px">
					<div class="container">						
						<h4 class="modal-title">Alteração da Origem da Demanda</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">
									 <tr>  
										<td style="width:150px"><label>Id da Origem da Demanda:</label></td>  
										<td style="width:150px"><p class="form-control-static" name="id_orig_dmnd_plnj_leito"><?php echo $_POST['id_orig_dmnd_plnj_leito']; ?></p>
										</td>  
									 </tr>
									  <tr>  
										<td style="width:150px"><label>Descrição da Origem da Demanda:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="ds_orig_dmnd_plnj_leito" value="<?php echo $_POST['ds_orig_dmnd_plnj_leito']; ?>"></td> 							
									  </tr>									  									 	
								</table>																
							</div>								
							<div class="modal-footer">	
								<input type="submit" class="btn btn-danger" name="altera" value="Alterar">&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" class="btn btn-primary" onclick="history.go()" value="Voltar">						
							</div>									
						</div>
					</form>
				</div>
			</div>
		</div>		
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</body>
	</html>
		
<?php 
    
	
?>
