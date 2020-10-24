<?php
//altera_cores.php
	session_start();
	$_SESSION['id_acesso_transac_integracao']=$_POST['id_acesso_transac_integracao'];
	
    include '../database.php';	
	
	$pdo = database::connect();

	$sql = "SELECT transac.id_acesso_transac_integracao, menu.nm_menu_sist_integracao, transac.nm_acesso_transac_integracao, transac.cd_transac_integracao, transac.cd_form_transac_integracao, transac.cd_usua_incs, transac.dt_incs, transac.cd_usua_altr, transac.dt_altr, transac.id_menu_sist_integracao
	FROM integracao.tb_c_acesso_transac_integracao transac, integracao.tb_c_menu_sist_integracao menu where transac.id_menu_sist_integracao = menu.id_menu_sist_integracao and transac.id_acesso_transac_integracao = ".$_POST['id_acesso_transac_integracao']."";

	if ($pdo==null){
			header(Config::$webLogin);
	}	
	$ret = pg_query($pdo, $sql);
	if(!$ret) {
		echo pg_last_error($pdo);
		exit;
	}
	
	$row = pg_fetch_row($ret);	
		
	$id_acesso_transac_integracao = $row[0];
	$nm_menu_sist_integracao = $row[1];
	$nm_acesso_transac_integracao = $row[2];
	$cd_transac_integracao = $row[3];
	$cd_form_transac_integracao = $row[4];	
	$id_menu_sist_integracao = $row[9];	
	
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
						<h4 class="modal-title">Alteração das Transações de Menu</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">			
									 <tr>  
										<td style="width:150px"><label>Identificador da Transação:</label></td>  
										<td style="width:150px"><p class="form-control-static" name="id_acesso_transac_integracao"><?php echo $_POST['id_acesso_transac_integracao']; ?></p>
										</td>  
									 </tr>
									 <tr>  
										<td style="width:150px"><label>Nome da Transação:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="nm_acesso_transac_integracao" value="<?php echo $nm_acesso_transac_integracao; ?>"></td> 							
									  </tr>									  									  
									  <tr>  
										<td style="width:150px"><label>Menu/Funcionalidade:</label></td>  
										
										<?php
										
										$sql = "SELECT nm_menu_sist_integracao, id_menu_sist_integracao from integracao.tb_c_menu_sist_integracao order by 1";
										
										if ($pdo==null){
												header(Config::$webLogin);
										}	
										$ret = pg_query($pdo, $sql);
										if(!$ret) {
											echo pg_last_error($pdo);
											exit;
										}
										?>
										<td style="width:150px">
											<select  id="gmenu" class="form-control" onchange=" 
														var selObj = document.getElementById('gmenu');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('id_menu_sist_integracao').value = selValue;">
											<option value="null"></option>
														
											<?php
												$cont=1;																	
											
												while($row = pg_fetch_row($ret)) {
													if($row[0]==$nm_menu_sist_integracao){														
												?>												
													<option value="<?php echo $row[1]; ?>" selected><?php echo $row[0]; ?></option>
												<?php																		
													} else {
												?>
													<option value="<?php echo $row[1]; ?>"><?php echo $row[0]; ?></option>												
													<?php } 
												$cont=$cont+1;} ?>	
											</select>
										
										</td> 							
									  </tr>
									  <tr>  
										<td style="width:150px"><label>Código da Transação:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="cd_transac_integracao" value="<?php echo $cd_transac_integracao; ?>"></td> 							
									  </tr>									  
									  <tr>  
										<td style="width:150px"><label>Cód da Func/Menu no Integração:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="cd_form_transac_integracao" value="<?php echo $cd_form_transac_integracao; ?>" size="65"></td> 							
									  </tr>
									   
									  <input type="text" id="id_menu_sist_integracao" name="id_menu_sist_integracao" value="<?php echo $id_menu_sist_integracao; ?>" style="display:none"> 
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
