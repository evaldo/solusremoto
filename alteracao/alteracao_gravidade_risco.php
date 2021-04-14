<?php
//altera_cores.php
	session_start();
	$_SESSION['id_grvd_risco_pcnt']=$_POST['id_grvd_risco_pcnt'];
	
    include '../database.php';	
	
	$pdo = database::connect();

	$sql = "SELECT id_grvd_risco_pcnt, nm_grvd_risco_pcnt, cd_cor_grvd_risco from integracao.tb_grvd_risco_pcnt where id_grvd_risco_pcnt = ".$_POST['id_grvd_risco_pcnt']." ";

	if ($pdo==null){
			header(Config::$webLogin);
	}	
	$ret = pg_query($pdo, $sql);
	if(!$ret) {
		echo pg_last_error($pdo);
		exit;
	}
	
	$row = pg_fetch_row($ret);
		
	$id_grvd_risco_pcnt = $row[0];
	$nm_grvd_risco_pcnt = $row[1];
	$cd_cor_grvd_risco = $row[2];
	
	$sql = "SELECT id_grvd_risco_pcnt, nm_grvd_risco_pcnt, cd_cor_grvd_risco from integracao.tb_grvd_risco_pcnt order by 1";
	
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
						<h4 class="modal-title">Alteração da Gravidade de Risco</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">
									 <tr>  
										<td style="width:150px"><label>Id da Gravidade de Risco:</label></td>  
										<td style="width:150px"><p class="form-control-static" name="id_grvd_risco_pcnt"><?php echo $_POST['id_grvd_risco_pcnt']; ?></p>
										</td>  
									 </tr>
									  <tr>  
										<td style="width:150px"><label>Descrição da Gravidade de Risco:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="nm_grvd_risco_pcnt" value="<?php echo $_POST['nm_grvd_risco_pcnt']; ?>"></td> 							
									  </tr>									  
									  <tr>  
										<td style="width:150px"><label>Cor da Gravidade de Risco:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="cd_cor_grvd_risco" value="<?php echo $_POST['cd_cor_grvd_risco']; ?>"></td> 							
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
