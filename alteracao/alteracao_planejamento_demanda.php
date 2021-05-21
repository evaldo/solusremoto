<?php
//insercao_usuario.php
	session_start();			
	
    include '../database.php';	
	
	$pdo = database::connect();
	$optconsulta = "";
	$textoconsulta = "";
	
	$sqlplnj ="SELECT plnj_leito.id_plnj_pcnt_leito
		 , plnj_leito.nm_pcnt_cndat
		 , plnj_leito.dt_nasc
		 , cnvo.cd_cnvo
		 , plnj_leito.nm_cnto
		 , plnj_leito.dt_prvs_admss
		 , plnj_leito.ds_leito
		 , grvd_risco.nm_grvd_risco_pcnt
		 , orig_dmnd.ds_orig_dmnd_plnj_leito
		 , grvd_risco.cd_cor_grvd_risco
		 , plnj_leito.fl_pcnt_adtdo
		 , plnj_leito.ds_quadro_psqtr
		FROM integracao.tb_orig_dmnd_plnj_leito orig_dmnd		   
		   , integracao.tb_plnj_pcnt_leito plnj_leito
		   , integracao.tb_grvd_risco_pcnt grvd_risco
		   , integracao.tb_cnvo cnvo
	WHERE plnj_leito.id_grvd_risco_pcnt = grvd_risco.id_grvd_risco_pcnt
	  and plnj_leito.id_orig_dmnd_plnj_leito = orig_dmnd.id_orig_dmnd_plnj_leito
	  and plnj_leito.id_cnvo = cnvo.id_cnvo 
	  and plnj_leito.id_plnj_pcnt_leito = ".$_POST['id_plnj_pcnt_leito']."";
	
    $retplnj = pg_query($pdo, $sqlplnj);
    if(!$retplnj) {
        echo pg_last_error($pdo);
        exit;
    }
	
	$rowplnj = pg_fetch_row($retplnj);
	
	$nm_pcnt_cndat = $rowplnj[1] ;
	$dt_nasc = $rowplnj[2] ;
	$cd_cnvo = $rowplnj[3] ;
	$nm_cnto = $rowplnj[4] ;
	$dt_prvs_admss = $rowplnj[5] ;
	$ds_leito = $rowplnj[6] ;
	$nm_grvd_risco_pcnt = $rowplnj[7] ;
	$ds_orig_dmnd_plnj_leito = $rowplnj[8] ;
	$fl_pcnt_adtdo = $rowplnj[10] ;
	$ds_quadro_psqtr = $rowplnj[11] ;
	
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
						<h4 class="modal-title">Alteração do Planejamento da Demanda de Leitos</h4>
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
													if ($roworigdmnd[0] == $ds_orig_dmnd_plnj_leito ){
													?>
														<option value="<?php echo $roworigdmnd[1]; ?>" selected><?php echo $roworigdmnd[0]; ?></option>
													<?php
													} else {
													?>
														<option value="<?php echo $roworigdmnd[1]; ?>"><?php echo $roworigdmnd[0]; ?></option>
													<?php
													}  
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
											<!--<select class="form-control" id="id_moskit_deal" name="id_moskit_deal" style="width: 350px;display:none" onchange=" 
														var selObj = document.getElementById('id_moskit_deal');
														var selText = selObj.options[selObj.selectedIndex].text;														
														document.getElementById('nm_pcnt_cndat').value = selText;">
											<option value=""></option>
														
											<?php
												$cont=1;	
												while($rowmoskit = pg_fetch_row($retmoskit)) {													
													if ($rowmoskit[0] == $nm_pcnt_cndat ){
													?>
														<option value="<?php echo $rowmoskit[1]; ?>" selected><?php echo $rowmoskit[0]; ?></option>
													<?php
													} else {
													?>
														<option value="<?php echo $rowmoskit[1]; ?>"><?php echo $rowmoskit[0]; ?></option>
													<?php
													}  
													$cont=$cont+1;
												}
											?>														
											</select>&nbsp;-->
											
											<input type="text" class="form-control" style="width:500px;display:block" id="nm_pcnt_cndat" name="nm_pcnt_cndat" value="<?php echo $nm_pcnt_cndat; ?>"></input>
											
										</td>  
										
										
									</tr>
									
									<tr>  
									   <td style="width:200px; text-align:left"><label style="text-align=left;">Dt. de Nascimento:</label></td>  
									   <td style="width:200px"><input type="date" class="form-control" name="dt_nasc" placeholder="Formato: dd/mm/yyyy" value="<?php echo $dt_nasc; ?>"></td>  
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
														if ($rowcnvo[0] == $cd_cnvo ){
														?>
															<option value="<?php echo $rowcnvo[1]; ?>" selected><?php echo $rowcnvo[0]; ?></option>
														<?php
														} else {
														?>
															<option value="<?php echo $rowcnvo[1]; ?>"><?php echo $rowcnvo[0]; ?></option>
														<?php
														}  
														$cont=$cont+1;
													}
													 ?>
											</select>
											
									   </td>  
									</tr>
									
									<tr>  
									   <td style="width:200px; text-align:left"><label>Contato:</label></td>  
									   <td style="width:200px"><input style="width:500px" class="form-control" name="nm_cnto" value="<?php echo $nm_cnto; ?>"></td>  
									</tr>
									
									<tr>  
									   <td style="text-align:left"><label>Dt. Prevs. de Admiss:</label></td>  
									   <td style="width:200px"><input type="date" class="form-control" name="dt_prvs_admss" placeholder="Formato: dd/mm/yyyy" value="<?php echo $dt_prvs_admss; ?>"></td>  
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
												<select class="form-control" id="ds_leito" name="ds_leito" style="width: 150px">
												<option value=""></option>												
															
												<?php
													$cont=1;	
													while($rowleito = pg_fetch_row($retleito)) {													
														if ($rowleito[0] == $ds_leito ){
														?>
															<option value="<?php echo $rowleito[0]; ?>" selected><?php echo $rowleito[0]; ?></option>
														<?php
														} else {
														?>
															<option value="<?php echo $rowleito[0]; ?>"><?php echo $rowleito[0]; ?></option>
														<?php
														}  
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
												<select class="form-control" style="width:200px" id="id_grvd_risco_pcnt" name="id_grvd_risco_pcnt">
												<option value=""></option>
															
												<?php
													$cont=1;	
													while($rowgrvdrisco = pg_fetch_row($retgrvdrisco)) {													
														if ($rowgrvdrisco[0] == $nm_grvd_risco_pcnt ){
														?>
															<option value="<?php echo $rowgrvdrisco[1]; ?>" selected><?php echo $rowgrvdrisco[0]; ?></option>
														<?php
														} else {
														?>
															<option value="<?php echo $rowgrvdrisco[1]; ?>"><?php echo $rowgrvdrisco[0]; ?></option>
														<?php
														}  
														$cont=$cont+1;
													}
													?>	
													
											</select>
											
									   </td>  
									</tr>
									
									<tr>  
									   <td style="width:200px; text-align:left"><label>Paciente Admitido?</label></td>  
									   <td style="width:200px">											
											<select class="form-control" style="width:100px" id="fl_pcnt_adtdo" name="fl_pcnt_adtdo">
												<?php
													if ($fl_pcnt_adtdo==""){
												?>
														<option value="" selected></option>
														<option value="0">Não</option>
														<option value="1">Sim</option>
												<?php
													}
												?>
												<?php
													if ($fl_pcnt_adtdo==0){
												?>
														<option value=""></option>
														<option value="0" selected>Não</option>
														<option value="1">Sim</option>
												<?php
													}
												?>
												<?php
													if ($fl_pcnt_adtdo==1){
												?>
														<option value=""></option>
														<option value="0">Não</option>
														<option value="1" selected>Sim</option>
												<?php
													}
												?>												
											</select>
									   </td>  
									</tr>
									
									<tr>  
									   <td style="width:200px; text-align:left"><label>Quadro Psiquiátrico:</label></td>  
									   <td style="width:200px"><textarea style="width:500px" class="form-control" name="ds_quadro_psqtr"><?php echo $ds_quadro_psqtr; ?></textarea></td>  
									</tr>
									
								</table>																
							</div>								
							<div class="modal-footer">	
								<input type="submit" class="btn btn-danger" name="altera" value="Alterar">&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" class="btn btn-primary" onclick="history.go()" value="Voltar">						
							</div>									
						</div>
						<input style="width:500px;display:none" class="form-control" name="id_plnj_pcnt_leito"  value="<?php echo $_POST['id_plnj_pcnt_leito']; ?>">
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
