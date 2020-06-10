 <?php  
	
	session_start();
	$_SESSION['nm_loc_nome']=$_POST['nm_loc_nome'];
	
	include '../database.php';
	$pdo = database::connect();
	
	$sql = "SELECT ds_crtr_intnc     
			, nm_mdco     
			, nm_psco     
			, nm_trpa     
			, ds_cid     
			, case when fl_fmnte = 'T' then 'Sim' else 'Não' end as fl_fmnte
			, ds_dieta     
			, ds_const     
			, case when fl_rtgrd = 'T' then 'Sim' else 'Não' end as fl_rtgrd
			, case when fl_acmpte = 'T' then 'Sim' else 'Não' end as fl_acmpte
			, ds_ocorr     
			, fl_status_leito
			, id_memb_equip_hosptr_mdco
			, id_memb_equip_hosptr_psco
			, id_memb_equip_hosptr_trpa
			, id_status_leito
			, pac_reg
	FROM integracao.tb_ctrl_leito WHERE trim(ds_leito) = '". $_SESSION['nm_loc_nome'] ."'";
		
	$ret = pg_query($pdo, $sql);
	if(!$ret) {
		echo pg_last_error($pdo);
		exit;
	}
	
	$row = pg_fetch_row($ret);

	//Completar as variáveis aqui
	$_SESSION['ds_crtr_intnc'] = $row[0];
	$_SESSION['ds_cid'] = $row[4];
	$_SESSION['fl_fmnte'] = $row[5];
	$_SESSION['ds_dieta'] = $row[6];	
	$_SESSION['ds_const'] = $row[7];
	$_SESSION['fl_rtgrd'] = $row[8];
	$_SESSION['fl_acmpte'] = $row[9];
	$_SESSION['ds_ocorr'] = $row[10];
	$_SESSION['id_memb_equip_hosptr_mdco'] = $row[12];
	$_SESSION['id_memb_equip_hosptr_psco'] = $row[13];
	$_SESSION['id_memb_equip_hosptr_trpa'] = $row[14];
	$_SESSION['pac_reg'] = $row[16];
	
	
	$_SESSION['id_status_leito'] = $row[15];
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
						<h4 class="modal-title">Alteração da Gestão de Leitos</h4>
					</div>						
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">
									<tr>  				
										<td><label>Carater de Internação:</label></td>
										<td><input style="width:600px" type="text" name="ds_crtr_intnc" id="ds_crtr_intnc" value="<?php echo $_SESSION['ds_crtr_intnc']; ?>" class="form-control" /></td>
									</tr>									 
									<tr>  
										<td style="width:150px"><label>Médico:</label></td>  
										
										<?php
										
										$sql = "SELECT id_memb_equip_hosptr, nm_memb_equip_hosptr
										from integracao.tb_equip_hosptr where tp_memb_equip_hosptr = 'MDCO' order by 2";
										
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
											<select  id="sl_memb_equip_hosptr_mdco" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_memb_equip_hosptr_mdco');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('id_memb_equip_hosptr_mdco').value = selValue;">
											<option value="null"></option>
														
											<?php
												$cont=1;																
											
												while($row = pg_fetch_row($ret)) {
													if($row[0]==$_SESSION['id_memb_equip_hosptr_mdco']){														
												?>												
													<option value="<?php echo $row[0]; ?>" selected><?php echo $row[1]; ?></option>
												<?php																		
													} else {
												?>
													<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>												
													<?php } 
												$cont=$cont+1;} ?>	
											</select>
										
										</td> 							
									  </tr>		
									  <tr>  
										<td style="width:150px"><label>Psicólogo:</label></td>  
										
										<?php
										
										$sql = "SELECT id_memb_equip_hosptr, nm_memb_equip_hosptr
										from integracao.tb_equip_hosptr where tp_memb_equip_hosptr = 'PSCO' order by 2";
										
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
											<select  id="sl_memb_equip_hosptr_psco" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_memb_equip_hosptr_psco');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('id_memb_equip_hosptr_psco').value = selValue;">
											<option value="null"></option>
														
											<?php
												$cont=1;																
											
												while($row = pg_fetch_row($ret)) {
													if($row[0]==$_SESSION['id_memb_equip_hosptr_psco']){														
												?>												
													<option value="<?php echo $row[0]; ?>" selected><?php echo $row[1]; ?></option>
												<?php																		
													} else {
												?>
													<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>												
													<?php } 
												$cont=$cont+1;} ?>	
											</select>
										
										</td> 							
									   </tr>		
									   <tr>  
										<td style="width:150px"><label>Terapeuta:</label></td>  
										
										<?php
										
										$sql = "SELECT id_memb_equip_hosptr, nm_memb_equip_hosptr
										from integracao.tb_equip_hosptr where tp_memb_equip_hosptr = 'TRPA' order by 2";
										
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
											<select  id="sl_memb_equip_hosptr_trpa" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_memb_equip_hosptr_trpa');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('id_memb_equip_hosptr_trpa').value = selValue;">
											<option value="null"></option>
														
											<?php
												$cont=1;																
											
												while($row = pg_fetch_row($ret)) {
													if($row[0]==$_SESSION['id_memb_equip_hosptr_trpa']){														
												?>												
													<option value="<?php echo $row[0]; ?>" selected><?php echo $row[1]; ?></option>
												<?php																		
													} else {
												?>
													<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>												
													<?php } 
												$cont=$cont+1;} ?>	
											</select>
										
										</td> 							
									   </tr>
									   <tr>  

									   
											<td><label>Grupo de CID:</label></td>
											<?php
										
												$sql = "SELECT cd_grupo_cid from integracao.tb_c_grupo_cid order by 1";
												
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
												<select  id="sl_cid" class="form-control" onchange="
														var selObj = document.getElementById('sl_cid');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('ds_cid').value = selValue;">
												<option value="null"></option>
															
												<?php
													$cont=1;																											
													while($row = pg_fetch_row($ret)) {
														if($row[0]==$_SESSION['ds_cid']){														
													?>												
														<option value="<?php echo $row[0]; ?>" selected><?php echo $row[0]; ?></option>
													<?php																		
														} else {
													?>
														<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>												
														<?php } 
													$cont=$cont+1;} ?>	
												</select>
										
											</td> 													
											
										</tr>
										<tr>  				
											<td><label>Fumante?</label></td>
											<td style="width:400px">
												<select id="sl_fmnte" class="form-control" onchange=" 
															var selObj = document.getElementById('sl_fmnte');
															var selValue = selObj.options[selObj.selectedIndex].value;
															document.getElementById('fl_fmnte').value = selValue;">
													
													<?php if ($_SESSION['fl_fmnte']=='Sim') { ?>
														<option value="Sim" selected>Sim</option>													
													<?php } else { ?>
														<option value="Sim">Sim</option>
													<?php } ?>
													<?php if ($_SESSION['fl_fmnte']=='Não') { ?>
														<option value="Nao" selected>Não</option>													
													<?php } else { ?>
														<option value="Nao">Não</option>
													<?php } ?>
												</select>
											</td>
										</tr>
										<tr>  				
											<td><label>Dieta:</label></td>
											<td><input style="width:600px" type="text" name="ds_dieta" id="ds_dieta" value="<?php echo $_SESSION['ds_dieta']; ?>" class="form-control" /></td>
										</tr>
										<tr>  				
											<td><label>Consistência:</label></td>
											<td><input style="width:600px" type="text" name="ds_const" id="ds_const" value="<?php echo $_SESSION['ds_const']; ?>" class="form-control" /></td>
										</tr>
										<tr>  				
											<td><label>Retaguarda?</label></td>
											<td style="width:400px">
												<select id="sl_rtgrd" class="form-control" onchange=" 
															var selObj = document.getElementById('sl_rtgrd');
															var selValue = selObj.options[selObj.selectedIndex].value;
															document.getElementById('fl_rtgrd').value = selValue;">
													
													<?php if ($_SESSION['fl_rtgrd']=='Sim') { ?>
														<option value="Sim" selected>Sim</option>													
													<?php } else { ?>
														<option value="Sim">Sim</option>
													<?php } ?>
													<?php if ($_SESSION['fl_rtgrd']=='Não') { ?>
														<option value="Nao" selected>Não</option>													
													<?php } else { ?>
														<option value="Nao">Não</option>
													<?php } ?>
												</select>
											</td>
										</tr>
										<tr>  				
											<td><label>Acompanhante?</label></td>
											<td style="width:400px">
												<select id="sl_acmpte" class="form-control" onchange=" 
															var selObj = document.getElementById('sl_acmpte');
															var selValue = selObj.options[selObj.selectedIndex].value;
															document.getElementById('fl_acmpte').value = selValue;">
													
													<?php if ($_SESSION['fl_acmpte']=='Sim') { ?>
														<option value="Sim" selected>Sim</option>													
													<?php } else { ?>
														<option value="Sim">Sim</option>
													<?php } ?>
													<?php if ($_SESSION['fl_acmpte']=='Não') { ?>
														<option value="Nao" selected>Não</option>													
													<?php } else { ?>
														<option value="Nao">Não</option>
													<?php } ?>
												</select>
											</td>
										</tr>								 
										<tr>  				
											<td><label>Ocorrências:</label></td>
											<td><input style="width:600px" type="text" name="ds_ocorr" id="ds_ocorr" value="<?php echo $_SESSION['ds_ocorr']; ?>" class="form-control" /></td>
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
														if($row[0]==$_SESSION['id_status_leito']){														
													?>												
														<option value="<?php echo $row[0]; ?>" selected><?php echo $row[1]; ?></option>
													<?php																		
														} else {
													?>
														<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>												
														<?php } 
													$cont=$cont+1;} ?>	
												</select>
											
											</td> 	
										</tr>
										
										<!--style="display:none"-->
										<input type="text" id="id_memb_equip_hosptr_mdco" name="id_memb_equip_hosptr_mdco" value="<?php echo$_SESSION['id_memb_equip_hosptr_mdco']; ?>" style="display:none"> 
										
										<input type="text" id="id_memb_equip_hosptr_psco" name="id_memb_equip_hosptr_psco" value="<?php echo $_SESSION['id_memb_equip_hosptr_psco']; ?>" style="display:none">
										
										<input type="text" id="id_memb_equip_hosptr_trpa" name="id_memb_equip_hosptr_trpa" value="<?php echo$_SESSION['id_memb_equip_hosptr_trpa']; ?>" style="display:none"> 
										
										<input type="text" id="fl_fmnte" name="fl_fmnte" value="<?php echo$_SESSION['fl_fmnte']; ?>" style="display:none"> 
										<input type="text" id="fl_rtgrd" name="fl_rtgrd" value="<?php echo$_SESSION['fl_rtgrd']; ?>" style="display:none"> 
										<input type="text" id="fl_acmpte" name="fl_acmpte" value="<?php echo$_SESSION['fl_acmpte']; ?>" style="display:none"> 
										<input type="text" id="id_status_leito" name="id_status_leito" value="<?php echo$_SESSION['id_status_leito']; ?>" style="display:none">
										
										<input type="text" id="ds_cid" name="ds_cid" value="<?php echo$_SESSION['ds_cid']; ?>" style="display:none">
								 								 
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