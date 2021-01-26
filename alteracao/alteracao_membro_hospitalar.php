<?php
//altera_cores.php
	session_start();
	$_SESSION['id_memb_equip_hosptr']=$_POST['id_memb_equip_hosptr'];
	
    include '../database.php';	
	
	$pdo = database::connect();

	$sql = "SELECT equip.id_memb_equip_hosptr
			 , equip.nm_memb_equip_hosptr
			 , equip.tp_memb_equip_hosptr
			 , case when equip.tp_memb_equip_hosptr = 'MDCO' then
					'MEDICO'
			   else	case when equip.tp_memb_equip_hosptr = 'PSCO' then
						'PSICÓLOGO'
					else case when equip.tp_memb_equip_hosptr = 'TRPA' then 
							'TERAPEUTA'
						 else ''
			   end end end ds_memb_equip_hosptr
			 , (select nm_memb_equip_hosptr FROM integracao.tb_equip_hosptr where id_memb_equip_hosptr = equip.id_mdco_horiz) as nm_mdco_horiz
			 , equip.id_mdco_horiz
			 , equip.fl_mdco_assite_horiz
		from integracao.tb_equip_hosptr equip
		where equip.id_memb_equip_hosptr = '".$_POST['id_memb_equip_hosptr']."'";

	if ($pdo==null){
			header(Config::$webLogin);
	}	
	$ret = pg_query($pdo, $sql);
	if(!$ret) {
		echo pg_last_error($pdo);
		exit;
	}
	
	$row = pg_fetch_row($ret);

	$nm_mdco_horiz = $row[4];
	$id_mdco_horiz = $row[5];
	$fl_mdco_assite_horiz = $row[6];
	
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
						<h4 class="modal-title">Alteração de Membros da Equipe Hospitalar</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">
									 <tr>  
										<td style="width:150px"><label>Id do Membro da Equipe Hospitalar:</label></td>  
										<td style="width:150px"><p class="form-control-static" name="id_memb_equip_hosptr"><?php echo $_POST['id_memb_equip_hosptr']; ?></p>
										</td>  
									 </tr>
									  <tr>  
										<td style="width:150px"><label>Nome do Membro da Equipe Hospitalar:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="nm_memb_equip_hosptr" value="<?php echo $_POST['nm_memb_equip_hosptr']; ?>"></td> 							
									  </tr>									  
									  <tr>  
										<td style="width:150px"><label>Tipo de Membro da Equipe Hospitalar:</label></td>  
										<td style="width:400px">
											
											<select id="sl_memb_equip_hosptr" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_memb_equip_hosptr');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('tp_memb_equip_hosptr').value = selValue;">
												<option value="null"></option>
												<?php if ($row[2]=='MDCO') { ?>
													<option value="MDCO" selected>Médico</option>													
												<?php } else { ?>
													<option value="MDCO">Médico</option>
												<?php }  ?>
												<?php if ($row[2]=='PSCO') { ?>
													<option value="PSCO" selected>Psicólogo</option>													
												<?php } else { ?>
													<option value="PSCO">Psicólogo</option>
												<?php }  ?>
												<?php if ($row[2]=='TRPA') { ?>
													<option value="TRPA" selected>Terapeuta</option>													
												<?php } else { ?>
													<option value="TRPA">Terapeuta</option>
												<?php }  ?>
																							  
											</select>
										</td> 
									  </tr>

									  <tr>  
										<td style="width:150px"><label>Médico Horizontal/Assistente?</label></td>
											<td style="width:400px">
												<select id="sl_mdco_assite_horiz" class="form-control" onchange=" 
															var selObj = document.getElementById('sl_mdco_assite_horiz');
															var selValue = selObj.options[selObj.selectedIndex].value;
															document.getElementById('fl_mdco_assite_horiz').value = selValue;">
													<option value="null"></option>
													<?php if ($fl_mdco_assite_horiz=='A') { ?>
														<option value="A" selected>Assistente</option>													
													<?php } else { ?>
														<option value="A">Assistente</option>
													<?php } ?>													
													<?php if ($fl_mdco_assite_horiz=='H') { ?>
														<option value="H" selected>Horizontal</option>													
													<?php } else { ?>
														<option value="H">Horizontal</option>
													<?php } ?>
												</select>
											</td>
										</td>
									  </tr>	

									  
									  <tr>  
										<td style="width:150px"><label>Médico Horizontal:</label></td>  										
										<?php
										
										$sql = "SELECT id_memb_equip_hosptr, nm_memb_equip_hosptr from integracao.tb_equip_hosptr order by 1";
										
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
											<select  id="sel_mdco_horiz" class="form-control" onchange=" 
														var selObj = document.getElementById('sel_mdco_horiz');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('id_mdco_horiz').value = selValue;">
											<option value="null"></option>
														
											<?php
												$cont=1;																	
											
												while($row = pg_fetch_row($ret)) {
													if($row[1]==$nm_mdco_horiz){														
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
									  </tr>	
									  <input type="text" id="tp_memb_equip_hosptr" name="tp_memb_equip_hosptr" value="<?php echo $_POST['tp_memb_equip_hosptr']; ?>" style="display:none">							
									  <!--style="display:none"-->
									  <input type="text" id="id_mdco_horiz" name="id_mdco_horiz" value="<?php echo $id_mdco_horiz; ?>" style="display:none">
									  <input type="text" id="fl_mdco_assite_horiz" name="fl_mdco_assite_horiz" value="<?php echo $fl_mdco_assite_horiz ; ?>" style="display:none">																				
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
