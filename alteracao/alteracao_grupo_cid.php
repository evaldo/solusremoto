<?php
//altera_cores.php
	session_start();
	$_SESSION['cd_grupo_cid']=$_POST['cd_grupo_cid'];
	$_SESSION['ds_dtlh_cid']=$_POST['ds_dtlh_cid'];
	
    include '../database.php';	
	
	$pdo = database::connect();

	$sql = "SELECT cd_grupo_cid, ds_grupo_cid, ds_dtlh_cid from integracao.tb_c_grupo_cid where cd_grupo_cid = '".$_POST['cd_grupo_cid']."'";

	if ($pdo==null){
			header(Config::$webLogin);
	}	
	$ret = pg_query($pdo, $sql);
	if(!$ret) {
		echo pg_last_error($pdo);
		exit;
	}
	
	$row = pg_fetch_row($ret);	
	
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
						<h4 class="modal-title">Alteração de Grupo CID</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">
									 <tr>  
										<td style="width:150px"><label>Código do Grupo CID:</label></td>  
										<td style="width:150px"><p class="form-control-static" name="cd_grupo_cid"><?php echo $_POST['cd_grupo_cid']; ?></p>
										</td>  
									 </tr>
									  <tr>  
										<td style="width:150px"><label>Descrição do Grupo CID:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="ds_grupo_cid" value="<?php echo $_POST['ds_grupo_cid']; ?>"></td> 							
									  </tr>	
									<tr>  
										<td style="width:150px"><label>Detalhe do Código de CID:</label></td> 
										<td style="width:150px"><p class="form-control-static" name="ds_dtlh_cid"><?php echo $_POST['ds_dtlh_cid']; ?></p>
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
