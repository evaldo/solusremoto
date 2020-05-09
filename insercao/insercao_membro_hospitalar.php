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
						<h4 class="modal-title">Inclusão de Membros da Equipe Hospitalar</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">												 
									  <tr>  
										<td style="width:150px"><label>Nome do membro da Equipe Hospitalar:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="nm_memb_equip_hosptr"></td> 							
									  </tr>									  
									  <tr>  
										<td style="width:150px"><label>Tipo de Membro da Equipe Hospitalar:</label></td>  
										<td style="width:400px">
											<select id="sl_memb_equip_hosptr" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_memb_equip_hosptr');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('tp_memb_equip_hosptr').value = selValue;">
											  <option value="null"></option>
											  <option value="MDCO">Médico</option>
											  <option value="PSCO">Psicólogo</option>
											  <option value="TRPA">Terapeuta</option>											  
											</select>
										</td> 
									  </tr>	
									  <input type="text" id="tp_memb_equip_hosptr" name="tp_memb_equip_hosptr" style="display:none"> 
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
