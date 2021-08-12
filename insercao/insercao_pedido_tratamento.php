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
				<div class="modal-content" style="width:700px">
					<div class="container">						
						<h4 class="modal-title">Inclusão de Pedido de Tratamento</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">

									  <tr>  
										<td style="width:150px"><label>Paciente:</label></td>  
										<?php
										
										$sql = "SELECT cd_pcnt, nm_pcnt from tratamento.tb_c_pcnt order by 2";
										
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
											<select  id="pcnt" class="form-control" onchange=" 
														var selObj = document.getElementById('pcnt');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('cd_pcnt').value = selValue;">
														<option value="null"></option>
																									
											<?php
												$cont=1;																	
											
												while($row = pg_fetch_row($ret)) {
												?>												
													<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>																		
											<?php $cont=$cont+1;} ?>	
											</select>
										
										</td>	
									   </tr>
									   
									   <tr>
											<td style="width:50px"><label>Peso(Kg):</label></td> 
											<td style="width:10px"><input type="text" class="form-control" name="nu_peso_pcnt"></td>
									   </tr>
									   
									   <tr>
											<td style="width:50px"><label>Altura(Cm):</label></td> 
											<td style="width:10px"><input type="text" class="form-control" name="vl_altura_pcnt"></td>
									   </tr>
									   
									   <tr>
											<td style="width:50px"><label>Sup. Corp(m2):</label></td> 
											<td style="width:10px"><input type="text" class="form-control" name="vl_sup_corp"></td>
									   </tr>
										
									   <tr>
									 
										<td style="width:150px"><label>Indicação Clínica:</label></td>  
										<td style="width:200px"><textarea rows="10" cols="50" id="ds_utlma_obs_mapa_risco" class="form-control" name="ds_indic_clnic"></textarea></td> 
									 
									   </tr>
									 
									   <tr>
											<td ><label>Data do Diagnóstico:</label></td>
											<td ><input type="date" class="form-control" id="dt_diagn" name="dt_diagn"></td>
									   </tr>
									   
									   <tr>
										<td ><label>CID 10 Principal:</label></td>  
										<?php
										
										$sql = "SELECT cd_cid, ds_rsmo_cid from tratamento.tb_c_cid order by 2";
										
										if ($pdo==null){
												header(Config::$webLogin);
										}	
										$ret = pg_query($pdo, $sql);
										if(!$ret) {
											echo pg_last_error($pdo);
											exit;
										}
										?>
										<td>
											<select  id="cid" class="form-control" onchange=" 
														var selObj = document.getElementById('cid');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('cd_cid').value = selValue;">
														<option value="null"></option>
																									
											<?php
												$cont=1;																	
											
												while($row = pg_fetch_row($ret)) {
												?>												
													<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>																		
											<?php $cont=$cont+1;} ?>	
											</select>
										</td>
										
									 </tr>
									 
									 <tr>  
										<td style="width:150px"><label>Estadiamento:</label></td>  										
										<td style="width:150px">
											<select  id="ds_estmt" class="form-control" >
												<option value="I">I</option>											
												<option value="II">II</option>
												<option value="III">III</option>
												<option value="IV">IV</option>												
											</select>
										</td>	
									 </tr>
									 
									  <tr>  
										<td style="width:150px"><label>Tipo Quimio. (Linha):</label></td>  										
										<td style="width:150px">
											<select  id="ds_estmt" class="form-control" >
												<option value="1 Linha">1 Linha</option>											
												<option value="2 Linha">2 Linha</option>
												<option value="3 Linha">3 Linha</option>
												<option value="Outras">Outras</option>												
											</select>
										</td>	
									 </tr>
									 
									 <tr>  
										<td style="width:150px"><label>Finalidade:</label></td>  										
										<td style="width:150px">
											<select  id="ds_fnlde" class="form-control" >
												<option value="Paliativo">Paliativo</option>											
												<option value="Adjuvante">Adjuvante</option>
												<option value="Neo-Adjuvante">Neo-Adjuvante</option>
												<option value="Curativo">Curativo</option>												
											</select>
										</td>	
									 </tr>
									 
									 <tr>  
										<td style="width:150px"><label>Tumor:</label></td>  										
										<td style="width:150px">
											<select  id="ic_tipo_tumor" class="form-control" >
												<option value="T1">T1</option>											
												<option value="T2">T2</option>
												<option value="T3">T3</option>
												<option value="T0">T0</option>												
												<option value="TIS">TIS</option>												
												<option value="TX">TX</option>												
												<option value="Nao Se Aplica">Nao Se Aplica</option>												
											</select>
										</td>	
									 </tr>

									  <tr>  
										<td style="width:150px"><label>Nódulo:</label></td>  										
										<td style="width:150px">
											<select  id="ic_tipo_nodulo" class="form-control" >
												<option value="N1">N1</option>											
												<option value="N2">N2</option>
												<option value="N3">N3</option>
												<option value="N0">N0</option>														
												<option value="NX">NX</option>												
												<option value="Nao Se Aplica">Nao Se Aplica</option>												
											</select>
										</td>	
									 </tr>
									 
									 <tr>  
										<td style="width:150px"><label>Metástase:</label></td>  										
										<td style="width:150px">
											<select  id="ic_tipo_metastase" class="form-control" >
												<option value="M1">M1</option>											
												<option value="M0">M0</option>														
												<option value="MX">MX</option>												
												<option value="Nao Se Aplica">Nao Se Aplica</option>												
											</select>
										</td>	
									 </tr>
									 
									 <tr>
									 
											<td style="width:150px"><label>Plano Terapêutico:</label></td>  
											<td style="width:200px"><textarea rows="10" cols="50" id="ds_plano_trptco" class="form-control" name="ds_plano_trptco"></textarea></td> 
									 
									 </tr>
									 
									 <tr>
									 
											<td style="width:150px"><label>Informações Relevantes:</label></td>  
											<td style="width:200px"><textarea rows="10" cols="50" id="ds_info_rlvnte" class="form-control" name="ds_info_rlvnte"></textarea></td> 
									 
									 </tr>
									 
									 <tr>
									 
											<td style="width:150px"><label>Diagnóstico Cito/Histopatológico:</label></td>  
											<td style="width:200px"><textarea rows="10" cols="50" id="ds_diagn_cito_hstpagico" class="form-control" name="ds_diagn_cito_hstpagico"></textarea></td> 
									 
									 </tr>
									 
									 <tr>
									 
											<td style="width:150px"><label>Cirurgia:</label></td>  
											<td style="width:200px"><textarea rows="5" cols="50" id="ds_tp_cirurgia" class="form-control" name="ds_tp_cirurgia"></textarea></td> 
									 
									 </tr>
									 
									 <tr>
									 
											<td style="width:150px"><label>Área Irradiada:</label></td>  
											<td style="width:200px"><textarea rows="5" cols="50" id="ds_area_irrda" class="form-control" name="ds_area_irrda"></textarea></td> 
									 
									 </tr>
									 
									 <tr>
											<td ><label>Data de Realização:</label></td>
											<td ><input type="date" class="form-control" id="dt_rlzd" name="dt_rlzd"></td>
									 </tr>
									 
									 <tr>
											<td ><label>Data da Aplicação:</label></td>
											<td ><input type="date" class="form-control" id="dt_aplc" name="dt_aplc"></td>
									 </tr>
									 
									  <tr>
									 
											<td style="width:150px"><label>Observação/Justificativa:</label></td>  
											<td style="width:200px"><textarea rows="10" cols="50" id="ds_obs_jfta" class="form-control" name="ds_obs_jfta"></textarea></td> 
									 
									 </tr>
									 
									 <tr>
											<td style="width:50px"><label>Quantidade de Ciclos Previstos:</label></td> 
											<td style="width:10px"><input type="text" class="form-control" name="nu_qtde_ciclo_prta" id="nu_qtde_ciclo_prta"></td>
									 </tr>
									 
									 <tr>
											<td style="width:50px"><label>Ciclo Atual:</label></td> 
											<td style="width:50px"><input type="text" class="form-control" name="ds_ciclo_atual" id="ds_ciclo_atual"></td>
									 </tr>
									 
									  <tr>
											<td style="width:50px"><label>Número de Dias do Ciclo Atual:</label></td> 
											<td style="width:50px"><input type="text" class="form-control" name="ds_dia_ciclo_atual" id="ds_dia_ciclo_atual"></td>
									 </tr>
									 
									 <tr>
											<td style="width:50px"><label>Intervalo entre Ciclos (em dias):</label></td> 
											<td style="width:50px"><input type="text" class="form-control" name="ds_intrv_entre_ciclo_dia" id="ds_intrv_entre_ciclo_dia"></td>
									 </tr>
									 
									 <input type="text" id="cd_pcnt" name="cd_pcnt" style="display:none"> 
									 <input type="text" id="cd_cid" name="cd_cid" style="display:none"> 
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
