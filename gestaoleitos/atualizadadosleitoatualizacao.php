 <?php  
	
	session_start();
	
	include '../database.php';
	$pdo = database::connect();
	
	if (isset($_POST['nm_loc_nome'])){	
		//$_SESSION['nm_loc_nome']=$_POST['nm_loc_nome'];
		$nm_loc_nome=$_POST['nm_loc_nome'];
		
		$sql = "SELECT ds_crtr_intnc     
				, nm_mdco     
				, nm_psco     
				, nm_trpa     
				, ds_cid     
				, case when fl_fmnte = true then 
					'Sim' 
				  else 
					case when fl_fmnte = false then
						'Não' 
					else	
						''
				  end end as fl_fmnte
				, ds_dieta     
				, ds_const
				, case when fl_rtgrd = true then 
					'Sim' 
				  else 
					case when fl_rtgrd = false then
						'Não' 
					else	
						''
				  end end as fl_rtgrd			
				, case when fl_acmpte = true then 
					'Sim' 
				  else 
					case when fl_acmpte = false then
						'Não' 
					else	
						''
				  end end as fl_acmpte			
				, ds_ocorr     
				, fl_status_leito
				, id_memb_equip_hosptr_mdco
				, id_memb_equip_hosptr_psco
				, id_memb_equip_hosptr_trpa
				, id_status_leito
				, pac_reg
				, nm_pcnt
				, case when fl_fmnte = 'T' then 'true' else 'false' end fl_fmnte
				, case when fl_rtgrd = 'T' then 'true' else 'false' end fl_rtgrd 
				, case when fl_acmpte = 'T' then 'true' else 'false' end fl_acmpte  
		FROM integracao.tb_ctrl_leito WHERE trim(ds_leito) = '". $_POST['nm_loc_nome'] ."'";
			
		$ret = pg_query($pdo, $sql);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}
		
		$row = pg_fetch_row($ret);

		//Completar as variáveis aqui
		$ds_crtr_intnc = $row[0];
		$ds_cid = $row[4];
		$fl_fmnte = $row[5];
		$ds_dieta = $row[6];	
		$ds_const = $row[7];
		$fl_rtgrd = $row[8];
		$fl_acmpte = $row[9];
		$ds_ocorr = $row[10];
		$id_memb_equip_hosptr_mdco = $row[12];
		$id_memb_equip_hosptr_psco = $row[13];
		$id_memb_equip_hosptr_trpa = $row[14];
		$pac_reg = $row[16];
		$nm_pcnt = $row[17];
		
		
		$fl_fmntelogico = $row[18];
		$fl_rtgrdlogico = $row[19];
		$fl_acmptelogico = $row[20];
		
		
		$id_status_leito = $row[15];
		
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
						<h5 class="modal-title">Alteração da Gestão de Leitos - <?php echo $nm_pcnt;?> - em - <?php echo $_POST['nm_loc_nome'];?></h5>
					</div>						
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">
								
								
									<tr>  				
										<td><label>Carater de Internação:</label></td>

											<?php
												$sql = "SELECT ds_crtr_intnc FROM integracao.tb_crtr_intnc order by 1";
												
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
											<select  id="sl_crtr_intnc" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_crtr_intnc');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('ds_crtr_intnc').value = selValue;">
											<option value=" "></option>
														
											<?php
												$cont=1;																
											
												while($row = pg_fetch_row($ret)) {
													if($row[0]==$ds_crtr_intnc){														
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
													if($row[0]==$id_memb_equip_hosptr_psco){														
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
													if($row[0]==$id_memb_equip_hosptr_trpa){														
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
														if($row[0]==$ds_cid){														
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
													<option value="null"></option>
													<?php if ($fl_fmnte=='Sim') { ?>
														<option value="true" selected>Sim</option>													
													<?php } else { ?>
														<option value="true">Sim</option>
													<?php } ?>
													<?php if ($fl_fmnte=='Não') { ?>
														<option value="false" selected>Não</option>													
													<?php } else { ?>
														<option value="false">Não</option>
													<?php } ?>
												</select>
											</td>
										</tr>
										<tr>  				
											<td><label>Dieta:</label></td>
											
											
											
											<?php
												$sql = "SELECT ds_dieta FROM integracao.tb_dieta order by 1";
												
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
											<select  id="sl_dieta" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_dieta');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('ds_dieta').value = selValue;">
											<option value=" "></option>
														
											<?php
												$cont=1;																
											
												while($row = pg_fetch_row($ret)) {
													if($row[0]==$ds_dieta){														
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
											<td><label>Consistência:</label></td>
											
											
											<?php
												$sql = "SELECT ds_const FROM integracao.tb_const order by 1";
												
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
											<select  id="sl_const" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_const');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('ds_const').value = selValue;">
											<option value=" "></option>
														
											<?php
												$cont=1;																
											
												while($row = pg_fetch_row($ret)) {
													if($row[0]==$ds_const){														
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
											<td><label>Retaguarda?</label></td>
											<td style="width:400px">
												<select id="sl_rtgrd" class="form-control" onchange=" 
															var selObj = document.getElementById('sl_rtgrd');
															var selValue = selObj.options[selObj.selectedIndex].value;
															document.getElementById('fl_rtgrd').value = selValue;">
													<option value="null"></option>
													<?php if ($fl_rtgrd=='Sim') { ?>
														<option value="true" selected>Sim</option>													
													<?php } else { ?>
														<option value="true">Sim</option>
													<?php } ?>
													<?php if ($fl_rtgrd=='Não') { ?>
														<option value="false" selected>Não</option>													
													<?php } else { ?>
														<option value="false">Não</option>
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
													<option value="null"></option>
													<?php if ($fl_acmpte=='Sim') { ?>
														<option value="true" selected>Sim</option>													
													<?php } else { ?>
														<option value="true">Sim</option>
													<?php } ?>
													<?php if ($fl_acmpte=='Não') { ?>
														<option value="false" selected>Não</option>													
													<?php } else { ?>
														<option value="false">Não</option>
													<?php } ?>
												</select>
											</td>
										</tr>								 
										<tr>  				
											<td><label>Ocorrências:</label></td>
											<td><input style="width:600px" type="text" name="ds_ocorr" id="ds_ocorr" value="<?php echo $ds_ocorr; ?>" class="form-control" /></td>
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
														if($row[0]==$id_status_leito){														
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
										
										
										<input type="text" name="nm_loc_nome" id="nm_loc_nome" value="<?php echo $nm_loc_nome; ?>" style="display:none">
										
										<input type="text" name="pac_reg" id="pac_reg" value="<?php echo $pac_reg; ?>" style="display:none">
										
										<input type="text" name="ds_crtr_intnc" id="ds_crtr_intnc" value="<?php echo $ds_crtr_intnc; ?>" style="display:none">
										
										<input type="text" name="ds_dieta" id="ds_dieta" value="<?php echo $ds_dieta; ?>" style="display:none">
										
										<input type="text" name="ds_const" id="ds_const" value="<?php echo $ds_const; ?>" style="display:none">
										
										
										<input type="text" id="id_memb_equip_hosptr_mdco" name="id_memb_equip_hosptr_mdco" value="<?php echo $id_memb_equip_hosptr_mdco; ?>" style="display:none"> 
										
										<input type="text" id="id_memb_equip_hosptr_psco" name="id_memb_equip_hosptr_psco" value="<?php echo $id_memb_equip_hosptr_psco; ?>" style="display:none">
										
										<input type="text" id="id_memb_equip_hosptr_trpa" name="id_memb_equip_hosptr_trpa" value="<?php echo $id_memb_equip_hosptr_trpa; ?>" style="display:none"> 
										
										<input type="text" id="fl_fmnte" name="fl_fmnte" value="<?php echo$fl_fmntelogico; ?>" style="display:none"> 
										<input type="text" id="fl_rtgrd" name="fl_rtgrd" value="<?php echo$fl_rtgrdlogico; ?>" style="display:none"> 
										<input type="text" id="fl_acmpte" name="fl_acmpte" value="<?php echo$fl_acmptelogico; ?>" style="display:none"> 
										
										<input type="text" id="id_status_leito" name="id_status_leito" value="<?php echo $id_status_leito; ?>" style="display:none">
										
										<input type="text" id="ds_cid" name="ds_cid" value="<?php echo $ds_cid; ?>" style="display:none">
								 								 
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