 <?php  
	
	session_start();
	
	include '../database.php';
	$pdo = database::connect();
	
	if(isset($_POST['altera'])){					
		
		if ($pdo==null){
			header(Config::$webLogin);
		}
		
		try
		{	
		
			$sql = "UPDATE integracao.tb_ctrl_leito SET id_status_leito = ".$_POST['id_status_leito'].", fl_status_leito = (select ds_status_leito from integracao.tb_status_leito where id_status_leito = " . $_POST['id_status_leito'] . "), cd_usua_altr = '" . $_SESSION['usuario'] . "', dt_altr = current_timestamp WHERE ds_leito = '".$_POST['ds_leito']."'";
			
			$result = pg_query($pdo, $sql);

			if($result){
				echo "";
			}
				
			$secondsWait = 0;
			header("Refresh:$secondsWait");

				
		} catch(PDOException $e)
		{
			die($e->getMessage());
		}
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
						<h4 class="modal-title">Alteração do Status do Leito</h4>
					</div>						
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">									
									   <tr>  
										<td style="width:150px"><label>Leito:</label></td>  
										
										<?php
										
										$sql = "SELECT distinct ds_leito from integracao.tb_ctrl_leito order by 1";
										
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
														document.getElementById('ds_leito').value = selValue;">
											<option value="null"></option>
														
											<?php
												$cont=1;	
												while($row = pg_fetch_row($ret)) {													
												?>
													<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>												
												<?php 
													$cont=$cont+1;
												}
												 ?>	
												
											</select>
										
										</td> 							
									   </tr>
									   
									   <tr>  				
											<td><label>Status:</label></td>
								 
											<?php
											
											$sql = "SELECT id_status_leito, ds_status_leito, fl_ativo			from integracao.tb_status_leito where fl_ativo = 'Sim' order by 2";
											
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
												<select  id="sl_status_leito" class="form-control" onchange=" 
															var selObj = document.getElementById('sl_status_leito');
															var selValue = selObj.options[selObj.selectedIndex].value;
															document.getElementById('id_status_leito').value = selValue;">	
												<?php
													$cont=1;
													
													while($row = pg_fetch_row($ret)) {
													?>												
														<option value="<?php echo $row[0]; ?>" selected><?php echo $row[1]; ?></option>
													<?php
														$cont=$cont+1;
													} 
													?>	
												</select>
											
											</td> 	
										</tr>
										
										<!--style="display:none"-->
										<input type="text" id="ds_leito" name="ds_leito" style="display:none"> 
										
										<input type="text" id="id_status_leito" name="id_status_leito" style="display:none">
										
								 								 
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