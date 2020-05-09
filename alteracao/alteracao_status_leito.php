<?php
//altera_cores.php
	session_start();
	$_SESSION['id_status_leito']=$_POST['id_status_leito'];
	
    include '../database.php';	
	
	$pdo = database::connect();

	$sql = "SELECT id_status_leito, ds_status_leito, fl_ativo
				from integracao.tb_status_leito
		where id_status_leito = '".$_POST['id_status_leito']."'";

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
						<h4 class="modal-title">Alteração de Status de Leito</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">
									 <tr>  
										<td style="width:150px"><label>Id do Status de Leito:</label></td>  
										<td style="width:150px"><p class="form-control-static" name="id_status_leito"><?php echo $_POST['id_status_leito']; ?></p>
										</td>  
									 </tr>
									  <tr>  
										<td style="width:150px"><label>Descrição do Status de Leito:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="ds_status_leito" value="<?php echo $_POST['ds_status_leito']; ?>"></td> 							
									  </tr>	
									  <tr>  
										<td style="width:150px"><label>Ativo?</label></td>
											<td style="width:400px">
												<select id="sl_ativo" class="form-control" onchange=" 
															var selObj = document.getElementById('sl_ativo');
															var selValue = selObj.options[selObj.selectedIndex].value;
															document.getElementById('fl_ativo').value = selValue;">
													<option value="null"></option>
													<?php if ($row[2]=='Sim') { ?>
														<option value="Sim" selected>Sim</option>													
													<?php } else { ?>
														<option value="Sim">Sim</option>
													<?php } ?>
													<?php if ($row[2]=='Nao') { ?>
														<option value="Nao" selected>Não</option>													
													<?php } else { ?>
														<option value="Nao">Não</option>
													<?php } ?>
												</select>
											</td>
										</td>
									  </tr>									  
									  <input type="text" id="fl_ativo" name="fl_ativo" value="<?php echo $_POST['fl_ativo']; ?>" style="display:none">
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
