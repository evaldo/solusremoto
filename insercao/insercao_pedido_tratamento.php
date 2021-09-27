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
										<td style="width:150px"><label>Convênio:</label></td>  
										<?php
										
										$sql = "SELECT id_cnvo, cd_cnvo from tratamento.tb_c_cnvo order by 2";
										
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
											<select  id="cnvo" class="form-control" onchange=" 
														var selObj = document.getElementById('cnvo');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('cd_cnvo').value = selValue;">
														<option value="null"></option>
																									
											<?php
												$cont=1;																	
											
												while($row = pg_fetch_row($ret)) {
												?>												
													<option value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></option>																		
											<?php $cont=$cont+1;} ?>	
											</select>
										
										</td>	
									   </tr>
									   
									   <tr>  
										<td style="width:150px"><label>Tratamento:</label></td>  
										<?php
										
										$sql = "SELECT id_hstr_pnel_solic_trtmto
													 , substring(nm_pcnt, 1, 25)||'-'||ds_status_trtmto
												FROM tratamento.tb_hstr_pnel_solic_trtmto trtmto
												  WHERE trtmto.fl_trtmto_fchd = 0
													and trtmto.ds_equipe = 'Oncologistas';";
										
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
											<select  id="sel_hstr_pnel_solic_trtmto" class="form-control" onchange=" 
														var selObj = document.getElementById('sel_hstr_pnel_solic_trtmto');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('id_hstr_pnel_solic_trtmto').value = selValue;">
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
											<td style="width:10px"><input type="text" class="form-control" name="nu_peso_pcnt" value="0.0"></td>
									   </tr>
									   
									   <tr>
											<td style="width:50px"><label>Altura(Cm):</label></td> 
											<td style="width:10px"><input type="text" class="form-control" name="vl_altura_pcnt" value="0.0"></td>
									   </tr>
									   
									   <tr>
											<td style="width:50px"><label>Sup. Corp(m2):</label></td> 
											<td style="width:10px"><input type="text" class="form-control" name="vl_sup_corp" value="0.0"></td>
									   </tr>
										
									   <tr>
									 
										<td style="width:150px"><label>Indicação Clínica:</label></td>  
										<td style="width:200px"><textarea rows="6" cols="50" id="ds_utlma_obs_mapa_risco" class="form-control" name="ds_indic_clnic" value=" "></textarea></td> 
									 
									   </tr>
									   
									   <tr>
											<td ><label>Data do Diagnóstico:</label></td>
											<td ><input type="date" class="form-control" id="dt_diagn" name="dt_diagn" value="<?php $hoje = date ( 'Y-m-d' ); echo $hoje ; ?>"></td>
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
											<select  id="sl_estmt" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_estmt');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('ds_estmt').value = selValue;">
												<option value="">Escolha uma opção</option>
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
											<select  id="sl_tipo_linha_trtmto" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_tipo_linha_trtmto');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('ds_tipo_linha_trtmto').value = selValue;">
												<option value="">Escolha uma opção</option>
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
											<select  id="sl_fnlde" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_fnlde');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('ds_fnlde').value = selValue;">
												<option value="">Escolha uma opção</option>
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
											<select  id="sl_tipo_tumor" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_tipo_tumor');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('ic_tipo_tumor').value = selValue;">
												<option value="">Escolha uma opção</option>
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
											<select  id="sl_tipo_nodulo" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_tipo_nodulo');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('ic_tipo_nodulo').value = selValue;">
												<option value="">Escolha uma opção</option>
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
											<select  id="sl_tipo_metastase" class="form-control" onchange=" 
														var selObj = document.getElementById('sl_tipo_metastase');
														var selValue = selObj.options[selObj.selectedIndex].value;
														document.getElementById('ic_tipo_metastase').value = selValue;">
												<option value="">Escolha uma opção</option>
												<option value="M1">M1</option>											
												<option value="M0">M0</option>														
												<option value="MX">MX</option>												
												<option value="Nao Se Aplica">Nao Se Aplica</option>												
											</select>
										</td>	
									 </tr>
									 
									 <tr>
									 
											<td style="width:150px"><label>Plano Terapêutico:</label></td>  
											<td style="width:200px"><textarea rows="6" cols="50" id="ds_plano_trptco" class="form-control" name="ds_plano_trptco" value=" "></textarea></td> 
									 
									 </tr>
									 
									 <tr>
									 
											<td style="width:150px"><label>Informações Relevantes:</label></td>  
											<td style="width:200px"><textarea rows="6" cols="50" id="ds_info_rlvnte" class="form-control" name="ds_info_rlvnte" value=" "></textarea></td> 
									 
									 </tr>
									 
									 <tr>
									 
											<td style="width:150px"><label>Diagnóstico Cito/Histopatológico:</label></td>  
											<td style="width:200px"><textarea rows="6" cols="50" id="ds_diagn_cito_hstpagico" class="form-control" name="ds_diagn_cito_hstpagico" value=" "></textarea></td> 
									 
									 </tr>
									 
									 <tr>
									 
											<td style="width:150px"><label>Cirurgia:</label></td>  
											<td style="width:200px"><textarea rows="5" cols="50" id="ds_tp_cirurgia" class="form-control" name="ds_tp_cirurgia" value=" "></textarea></td> 
									 
									 </tr>
									 
									 <tr>
									 
											<td style="width:150px"><label>Área Irradiada:</label></td>  
											<td style="width:200px"><textarea rows="5" cols="50" id="ds_area_irrda" class="form-control" value=" " name="ds_area_irrda"></textarea></td> 
									 
									 </tr>
									 
									 <tr>
											<td ><label>Data de Realização:</label></td>
											<td ><input type="date" class="form-control" id="dt_rlzd" name="dt_rlzd" value="<?php $hoje = date ( 'Y-m-d' ); echo $hoje ; ?>"></td>
									 </tr>
									 
									 <tr>
											<td ><label>Data da Aplicação:</label></td>
											<td ><input type="date" class="form-control" id="dt_aplc" name="dt_aplc" value="<?php $hoje = date ( 'Y-m-d' ); echo $hoje ; ?>"></td>
									 </tr>
									 
									  <tr>
									 
											<td style="width:150px"><label>Observação/Justificativa:</label></td>  
											<td style="width:200px"><textarea rows="6" cols="50" id="ds_obs_jfta" class="form-control" value=" " name="ds_obs_jfta"></textarea></td> 
									 
									 </tr>
									 
									 <tr>
											<td style="width:50px"><label>Quantidade de Ciclos Previstos:</label></td> 
											<td style="width:10px"><input type="text" class="form-control" name="nu_qtde_ciclo_prta" value="0" id="nu_qtde_ciclo_prta"></td>
									 </tr>
									 
									 <tr>
											<td style="width:50px"><label>Ciclo Atual:</label></td> 
											<td style="width:50px"><input type="text" class="form-control" name="ds_ciclo_atual" value="0" id="ds_ciclo_atual"></td>
									 </tr>
									 
									  <tr>
											<td style="width:50px"><label>Número de Dias do Ciclo Atual:</label></td> 
											<td style="width:50px"><input type="text" class="form-control" name="ds_dia_ciclo_atual" value="0" id="ds_dia_ciclo_atual"></td>
									 </tr>
									 
									 <tr>
											<td style="width:50px"><label>Intervalo entre Ciclos (em dias):</label></td> 
											<td style="width:50px"><input type="text" class="form-control" value="0" name="ds_intrv_entre_ciclo_dia" id="ds_intrv_entre_ciclo_dia"></td>
									 </tr>
									 
									 <input type="text" id="cd_pcnt" name="cd_pcnt" style="display:none"> 									 
									 <input type="text" id="cd_cnvo" name="cd_cnvo" style="display:none"> 									 
									 <input type="text" id="cd_cid" name="cd_cid" style="display:none"> 									 
									 <input type="text" id="ds_estmt" name="ds_estmt" style="display:none"> 
									 <input type="text" id="id_hstr_pnel_solic_trtmto" name="id_hstr_pnel_solic_trtmto" style="display:none"> 
									 <input type="text" id="ds_tipo_linha_trtmto" name="ds_tipo_linha_trtmto" style="display:none"> 
									 <input type="text" id="ds_fnlde" name="ds_fnlde" style="display:none"> 
									 <input type="text" id="ic_tipo_tumor" name="ic_tipo_tumor" style="display:none"> 
									 <input type="text" id="ic_tipo_nodulo" name="ic_tipo_nodulo" style="display:none"> 
									 <input type="text" id="ic_tipo_metastase" name="ic_tipo_metastase" style="display:none"> 
									 
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
