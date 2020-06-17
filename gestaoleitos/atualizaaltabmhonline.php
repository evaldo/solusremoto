 <?php  
	
	if(isset($_POST["pac_reg"]))
	{
	
		session_start();
		$_SESSION['dt_admss'] = $_POST['dt_admss'];
		
		include '../database.php';
		$pdo = database::connect();
		
		
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
						<h4 class="modal-title">Motivo de Alta</h4>
					</div>						
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">
								<tr>  
									<td width="50%"><label>Registro do Paciente:</label></td>  
									<td width="500%"><?php echo $_POST['pac_reg']."-".$_POST['nm_pcnt']; ?></td>  
								 </tr>
								  <tr>  
									<td width="50%"><label>Admissão:</label></td>  
									<td width="500%"><?php echo $_POST['dt_admss']; ?></td>  
								 </tr>	
								
									   <tr>  
										<td style="width:150px"><label>Motivo de Alta:</label></td>  
										
										<?php
										
										$sql = "SELECT distinct ds_mtvo_alta, id_mtvo_alta from integracao.tb_mtvo_alta order by 1";
										
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
											<select  id="sl_ds_mtvo_alta" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_ds_mtvo_alta');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('id_mtvo_alta').value = selValue;">
											<option value="null"></option>
														
											<?php
												$cont=1;	
												while($row = pg_fetch_row($ret)) {													
												?>
													<option value="<?php echo $row[1]; ?>"><?php echo $row[0]; ?></option>												
												<?php 
													$cont=$cont+1;
												}
												 ?>	
												
											</select>
										
										</td> 							
									   </tr>
									   
										<!--style="display:none"-->
										
										<input type="text" id="id_mtvo_alta" name="id_mtvo_alta" style="display:none">
										<input type="text" id="pac_reg" name="pac_reg" value =<?php echo $_POST['pac_reg']; ?>  style="display:none">
										<input type="text" id="dt_admss" name="dt_admss" value =<?php echo $_POST['dt_admss']; ?> style="display:none">
										
								 								 
								</table>								
							</div>
							<div class="modal-footer">	
								<input type="submit" class="btn btn-danger" name="altera" value="Alterar">						
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