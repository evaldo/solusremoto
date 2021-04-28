<?php
//insercao_usuario.php
	session_start();			
	
    include '../database.php';	
	
	$pdo = database::connect();
	$optconsulta = "";
	$textoconsulta = "";
	
?>	
	<!DOCTYPE html>
	<html lang="pt-br">
	<head>
	 <meta charset="utf-8">
	 <link href="../css/bootstrap.min.css" rel="stylesheet">
	 <link href="../css/style.css" rel="stylesheet">
	 
</head>
	</head>
	<body style="margin-right: 0; margin-left: 0">	
		<div class="container" style="width: 100%;  margin-right: 0; margin-left: 0; position: relative;">
		  <div class="modal-dialog">
				<div class="modal-content" style="width:800px">
					<div class="container">						
						<h4 class="modal-title">Inserção do Planejamento da Demanda de Leitos</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">
 								    <tr>
										<td style="text-align:left"><label>Origem da Demanda:</label></td>										
										<td>
										
											<?php
											
												$sqlorigdmnd = "SELECT ds_orig_dmnd_plnj_leito, id_orig_dmnd_plnj_leito FROM integracao.tb_orig_dmnd_plnj_leito order by 1";	
											
												if ($pdo==null){
														header(Config::$webLogin);
												}	
												$retorigdmnd = pg_query($pdo, $sqlorigdmnd);
												if(!$retorigdmnd) {
													echo pg_last_error($pdo);
													exit;
												}
											?>
											
											<select class="form-control" id="id_orig_dmnd_plnj_leito" name="id_orig_dmnd_plnj_leito" style="width: 300px" onchange=" 
														var selObj = document.getElementById('id_orig_dmnd_plnj_leito');
														var selValue = selObj.options[selObj.selectedIndex].text;
														var moskit = selValue.toUpperCase();														
														if (moskit == 'MOSKIT')	{															
															document.getElementById('id_moskit_deal').style.display = 'block';
															document.getElementById('nm_pcnt_cndat').style.display = 'none';														
														} else {															
															document.getElementById('id_moskit_deal').style.display = 'none';
															document.getElementById('nm_pcnt_cndat').style.display = 'block';														
														}														
														;">
											<option value=""></option>
														
											<?php
												$cont=1;	
												while($roworigdmnd = pg_fetch_row($retorigdmnd)) {													
												?>
													<option value="<?php echo $roworigdmnd[1]; ?>"><?php echo $roworigdmnd[0]; ?></option>												
												<?php 
													$cont=$cont+1;
												}
											?>														
											</select>&nbsp;										  
											
										</td>  
									</tr>									  
									<tr>
										<td style="width:200px; text-align:left"><label>Candidato à vaga:</label></td>  
										
										
										<td style="width:200px">

											
											<?php
											
												$sqlmoskit = "SELECT nm_cnto, id_moskit_deal FROM integracao.tb_moskit_cnto order by 1";	
											
												if ($pdo==null){
														header(Config::$webLogin);
												}	
												$retmoskit = pg_query($pdo, $sqlmoskit);
												if(!$retmoskit) {
													echo pg_last_error($pdo);
													exit;
												}
											?>
											<!--display:none;--> 
											<select class="form-control" id="id_moskit_deal" name="id_moskit_deal" style="width: 350px;display:none" onchange=" 
														var selObj = document.getElementById('id_moskit_deal');
														var selText = selObj.options[selObj.selectedIndex].text;														
														document.getElementById('nm_pcnt_cndat').value = selText;">
											<option value=""></option>
														
											<?php
												$cont=1;	
												while($rowmoskit = pg_fetch_row($retmoskit)) {													
												?>
													<option value="<?php echo $rowmoskit[1]; ?>"><?php echo $rowmoskit[0]; ?></option>												
												<?php 
													$cont=$cont+1;
												}
											?>														
											</select>&nbsp;	
											
											
											<input type="text" class="form-control" style="width:500px;display:block" id="nm_pcnt_cndat" name="nm_pcnt_cndat"/>
											
										</td>  
										
										
									</tr>
									
									<tr>  
									   <td style="width:200px; text-align:left"><label style="text-align=left;">Dt. de Nascimento:</label></td>  
									   <td style="width:200px"><input type="date" class="form-control" name="dt_nasc" placeholder="Formato: dd/mm/yyyy"></td>  
									</tr>
									
									
									<tr>  
									   <td style="width:200px; text-align:left"><label>Convênio:</label></td>  
									   <td style="width:200px">
											
											<?php
				
												$sqlcnvo = "SELECT cd_cnvo, id_cnvo FROM integracao.tb_cnvo order by 1";				
											
												if ($pdo==null){
														header(Config::$webLogin);
												}	
												$retcnvo = pg_query($pdo, $sqlcnvo);
												if(!$retcnvo) {
													echo pg_last_error($pdo);
													exit;
												}
											?>
												<select class="form-control" id="id_cnvo" name="id_cnvo" style="width: 200px">
												<option value=""></option>												
															
												<?php
													$cont=1;	
													while($rowcnvo = pg_fetch_row($retcnvo)) {													
													?>
														<option value="<?php echo $rowcnvo[1]; ?>"><?php echo $rowcnvo[0]; ?></option>												
													<?php 
														$cont=$cont+1;
													}
													 ?>	
													
											</select>
											
									   </td>  
									</tr>
									
									<tr>  
									   <td style="width:200px; text-align:left"><label>Contato:</label></td>  
									   <td style="width:200px"><input style="width:500px" class="form-control" name="nm_cnto"></td>  
									</tr>
									
									<tr>  
									   <td style="text-align:left"><label>Dt. Prevs. de Admiss:</label></td>  
									   <td style="width:200px"><input type="date" class="form-control" name="dt_prvs_admss" placeholder="Formato: dd/mm/yyyy"></td>  
									</tr>
									
									
									<tr>  
									   <td style="width:200px; text-align:left"><label>Leito:</label></td>  
									   <td style="width:200px">
											
											<?php
				
												$sqlleito = "select ds_leito from integracao.tb_leito order by 1";				
											
												if ($pdo==null){
														header(Config::$webLogin);
												}	
												$retleito = pg_query($pdo, $sqlleito);
												if(!$retleito) {
													echo pg_last_error($pdo);
													exit;
												}
											?>
												<select class="form-control" style="width:200px" id="ds_leito" name="ds_leito" style="width: 100px">
												<option value=""></option>												
															
												<?php
													$cont=1;	
													while($rowleito = pg_fetch_row($retleito)) {													
													?>
														<option value="<?php echo $rowleito[0]; ?>"><?php echo $rowleito[0]; ?></option>												
													<?php 
														$cont=$cont+1;
													}
													 ?>	
													
											</select>
											
									   </td>  
									</tr>
									
									<tr>  
									   <td style="width:200px; text-align:left"><label>Gravidade do Risco:</label></td>  
									   <td style="width:200px">
											
											<?php
				
												$sqlgrvdrisco = "SELECT nm_grvd_risco_pcnt, id_grvd_risco_pcnt FROM integracao.tb_grvd_risco_pcnt order by 1";				
											
												if ($pdo==null){
														header(Config::$webLogin);
												}	
												$retgrvdrisco = pg_query($pdo, $sqlgrvdrisco);
												if(!$retgrvdrisco) {
													echo pg_last_error($pdo);
													exit;
												}
											?>
												<select class="form-control" style="width:200px" id="id_grvd_risco_pcnt" name="id_grvd_risco_pcnt" style="width: 100px">
												<option value=""></option>
															
												<?php
													$cont=1;	
													while($rowgrvdrisco = pg_fetch_row($retgrvdrisco)) {													
													?>
														<option value="<?php echo $rowgrvdrisco[1]; ?>"><?php echo $rowgrvdrisco[0]; ?></option>												
													<?php 
														$cont=$cont+1;
													}
													 ?>	
													
											</select>
											
									   </td>  
									</tr>
									
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
		<script>			
	 </script>
	</body>
	</html>	
<?php 
    
	
?>
