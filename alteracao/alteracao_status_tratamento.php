<?php
//altera_cores.php
	session_start();
	$_SESSION['id_status_trtmto']=$_POST['id_status_trtmto'];
	
    include '../database.php';	
	
	$pdo = database::connect();

	$sql = "SELECT id_status_trtmto, ds_status_trtmto, fl_ativo, cd_cor_status_trtmto from tratamento.tb_c_status_trtmto where id_status_trtmto = '".$_POST['id_status_trtmto']."'";

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
						<h4 class="modal-title">Alteração do Local de Tratamento</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">
									 <tr>  
										<td style="width:150px"><label>Id do Status de Tratamento:</label></td>  
										<td style="width:150px"><p class="form-control-static" name="id_status_trtmto"><?php echo $_POST['id_status_trtmto']; ?></p>
										</td>  
									 </tr>
									  <tr>  
										<td style="width:150px"><label>Descrição do Status de Tratamento:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="ds_status_trtmto" value="<?php echo $_POST['ds_status_trtmto']; ?>"></td> 							
									  </tr>	
									 <tr>  
										<td style="width:150px"><label>Flag Ativo?</label></td>
										<td style="width:150px">
											<select  class="form-control" id="flativo" onchange=" 
														var selObj = document.getElementById('flativo');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('fl_ativo').value = selValue;">
													<?php												
														if($row[2]==1){														
													?>
														<option value="1" selected>Sim</option>
														<option value="0">Não</option>
													<?php												
														} else {
													?>
														<option value="1">Sim</option>
														<option value="0" selected>Não</option>
													<?php												
														} 
													?>
											</select>
										</td>  
									 </tr>
									  <tr>  
										<td style="width:150px"><label>Cor no Painel:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="cd_cor_status_trtmto" value="<?php echo $_POST['cd_cor_status_trtmto']; ?>"></td> 							
									  </tr>	
									  
								</table>																
							</div>								
							<div class="modal-footer">	
								<input type="submit" class="btn btn-danger" name="altera" value="Alterar">&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" class="btn btn-primary" onclick="history.go()" value="Voltar">						
							</div>									
						</div>
						<input type="text" id="fl_ativo" name="fl_ativo" style="display:none" value="<?php echo $row[2]; ?>"> 
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
