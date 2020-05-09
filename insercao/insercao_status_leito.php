<?php
//altera_cores.php
	session_start();
	
	include '../database.php';
	
	$pdo = database::connect();	
	
	$sql = '';
	
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
						<h4 class="modal-title">Inclusão de Status de Leitos</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">												 
									  <tr>  
										<td style="width:150px"><label>Descrição do Status de Leitos:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="ds_status_leito"></td> 							
									  </tr>									  
									  <tr>  
										<td style="width:150px"><label>Ativo?</label></td>
										<td style="width:400px">
											<select id="sl_ativo" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_ativo');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('fl_ativo').value = selValue;">
												<option value="null"></option>
												
												<option value="Sim">Sim</option>					
												<option value="Nao">Não</option>
												
											</select>
										</td>
									  </tr>									  
									  <input type="text" id="fl_ativo" name="fl_ativo" value="<?php echo $_POST['fl_ativo']; ?>" style="display:none">
								</table>																
							</div>								
							<div class="modal-footer">	
								<input type="submit" class="btn btn-danger" name="insere" value="Inserir">&nbsp;&nbsp;&nbsp;&nbsp;
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
