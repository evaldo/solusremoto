 <?php  
	
	session_start();
	
	include '../database.php';
	$pdo = database::connect();
	
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
						<h4 class="modal-title">Consulta do Status do Leito</h4>
					</div>						
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">									
									   <tr>  
											<td style="width:150px"><label>Leito:</label></td>  
											
											<?php
											
											$sql = "SELECT distinct fl_status_leito, ds_leito from integracao.tb_ctrl_leito order by 1";
											
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
												<select  id="sl_ds_leito" class="form-control" onchange=" 
															var selObj = document.getElementById('sl_ds_leito');
															var selValue = selObj.options[selObj.selectedIndex].value;
															document.getElementById('fl_status_leito').value = selValue;">
												<option value="null"></option>
															
												<?php
													$cont=1;	
													while($row = pg_fetch_row($ret)) {													
													?>
														<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>												
													<?php 
														$cont=$cont+1;
													}
													 ?>	
													
												</select>
											
											</td>
										</tr>
										<tr>
											<td>
												<label>Status:</label>
											</td>
											<td>
												<input type="label" id="fl_status_leito" name="fl_status_leito" disabled>								
											</td> 	 							
									   </tr>
									   						 
								</table>								
							</div>
							<div class="modal-footer">	
								<input type="submit" class="btn btn-danger" name="fecha" value="Fechar" href="history.go()">						
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