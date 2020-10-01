<?php
	
	session_start();		
	
    include '../database.php';
    $pdo = database::connect();
	
	error_reporting(0); 	
		
	$textoconsulta = "";
	$retSqlServer = "";
	$sql = '';
	
	$sql ="SELECT trim(smart.ds_leito) ds_leito
			, smart.ds_andar
			, smart.dt_prvs_alta
			, smart.nm_pcnt
			, smart.ds_sexo
			, smart.dt_nasc_pcnt
			, smart.nm_cnvo
			, smart.pac_reg
			, smart.dt_admss
			, smart.id_memb_equip_hosptr_mdco
			, trim(smart.nm_memb_equip_hosptr) as nm_memb_equip_hosptr
		FROM  integracao.tb_ctrl_leito_smart smart
		union
		select leito.ds_leito
			, substring(leito.loc_leito_id, 1,1) as ds_andar
			, null
			, null
			, null
			, null
			, null
			, 0
			, null
			, null
			, null
		from integracao.tb_leito leito
		where leito.ds_leito not in (select trim(ds_leito) from integracao.tb_ctrl_leito_smart)
		order by 1";
	
	$retSmart = pg_query($pdo, $sql);
	
	if(!$retSmart) {
		echo pg_last_error($pdo);	
		exit;
	}	
	
	while($rowSmart = pg_fetch_row($retSmart)) {
		
		if($rowSmart[9]==null){
			$rowSmart[9]=0;
		}
		
		$sqlCtrlLeito="SELECT COUNT(1) FROM integracao.tb_ctrl_leito WHERE trim(ds_leito) = '" . $rowSmart[0] . "'";
		
		$retCtrlLeito = pg_query($pdo, $sqlCtrlLeito);
	
		if(!$retCtrlLeito) {
			echo pg_last_error($pdo);			
			exit;
		}	
		
		$rowCtrlLeito = pg_fetch_row($retCtrlLeito);
		
		if ($rowCtrlLeito[0]==0){
			
			if ($rowSmart[2]==null){
			
				$sql = "INSERT INTO integracao.tb_ctrl_leito (cd_ctrl_leito, DS_LEITO, DS_ANDAR, DT_PRVS_ALTA, NM_PCNT, DS_SEXO, DT_NASC_PCNT, NM_CNVO, PAC_REG, DT_ADMSS, id_memb_equip_hosptr_mdco, nm_mdco) VALUES ((SELECT MAX(cd_ctrl_leito)+1 FROM integracao.tb_ctrl_leito), '" . $rowSmart[0] . "', '" . $rowSmart[1] . "', null, '" . $rowSmart[3] . "', '" . $rowSmart[4] . "', '" . $rowSmart[5] . "', '" . $rowSmart[6] . "', " .$rowSmart[7] . ", '" . $rowSmart[8] . "', " .$rowSmart[9] . ", '".$rowSmart[10]."')";	
				
			} else {
				
				$sql = "INSERT INTO integracao.tb_ctrl_leito (cd_ctrl_leito, DS_LEITO, DS_ANDAR, DT_PRVS_ALTA, NM_PCNT, DS_SEXO, DT_NASC_PCNT, NM_CNVO, PAC_REG, DT_ADMSS, id_memb_equip_hosptr_mdco, nm_mdco) VALUES ((SELECT MAX(cd_ctrl_leito)+1 FROM integracao.tb_ctrl_leito), '" . $rowSmart[0] . "', '" . $rowSmart[1] . "', '" . $rowSmart[2] . "', '" . $rowSmart[3] . "', '" . $rowSmart[4] . "', '" . $rowSmart[5] . "', '" . $rowSmart[6] . "', " .$rowSmart[7] . ", '" . $rowSmart[8] . "', " .$rowSmart[9] . ", '".$rowSmart[10]."')";	
				
			}
			
			$result = pg_query($pdo, $sql);

			if($result){
				echo "";
			}
		} else {
			
			if ($rowSmart[2]==null){
			
				$sql = "UPDATE integracao.tb_ctrl_leito SET pac_reg = " . $rowSmart[7] . ", DS_ANDAR = '" . $rowSmart[1] . "', DT_PRVS_ALTA = null, NM_PCNT = '" . $rowSmart[3] . "', DS_SEXO = '" . $rowSmart[4] . "', DT_NASC_PCNT = '" . $rowSmart[5] . "', NM_CNVO = '" . $rowSmart[6] . "', DT_ADMSS = '" .$rowSmart[8] . "', id_memb_equip_hosptr_mdco = " .$rowSmart[9] . ", nm_mdco =  '".$rowSmart[10]."' WHERE trim(DS_LEITO) = '" . $rowSmart[0] . "' ";
				
				//retirar aqui	
				//if ( $rowSmart[0]=='LEITO 307-B'){
				//	echo $sql;
				//}
				
			} else {
				
				$sql = "UPDATE integracao.tb_ctrl_leito SET pac_reg = " . $rowSmart[7] . ", DS_ANDAR = '" . $rowSmart[1] . "', DT_PRVS_ALTA = '" . $rowSmart[2] . "', NM_PCNT = '" . $rowSmart[3] . "', DS_SEXO = '" . $rowSmart[4] . "', DT_NASC_PCNT = '" . $rowSmart[5] . "', NM_CNVO = '" . $rowSmart[6] . "', DT_ADMSS = '" .$rowSmart[8] . "' , id_memb_equip_hosptr_mdco = " .$rowSmart[9] . ", nm_mdco =  '".$rowSmart[10]."' WHERE trim(DS_LEITO) = '" . $rowSmart[0] . "' ";
				
			}
							
			$result = pg_query($pdo, $sql);
			
			//retirar aqui
			//echo $sql;
			
			if($result){
				echo "";
			}
			
			$sqlCtrlLeitoTemp="SELECT nm_mdco, nm_psco, nm_trpa, ds_ocorr, ds_cid, ds_dieta, fl_fmnte, ds_const, ds_crtr_intnc, fl_status_leito, fl_acmpte, fl_rtgrd, pac_reg, id_status_leito, id_memb_equip_hosptr_mdco, id_memb_equip_hosptr_psco, id_memb_equip_hosptr_trpa FROM integracao.tb_ctrl_leito_temp WHERE pac_reg = " . $rowSmart[7] . "";
		
			$retCtrlLeitoTemp = pg_query($pdo, $sqlCtrlLeitoTemp);
		
			if(!$retCtrlLeitoTemp) {
				echo pg_last_error($pdo);		
				exit;
			}	
			
			if (pg_numrows($retCtrlLeitoTemp)>0) {
				
				$rowCtrlLeitoTemp = pg_fetch_assoc($retCtrlLeitoTemp);
			
				$sqlUpdateCtrlTemp = "UPDATE integracao.tb_ctrl_leito SET 
				fl_fmnte = '". $rowCtrlLeitoTemp['fl_fmnte'] . "', 
				fl_rtgrd = '". $rowCtrlLeitoTemp['fl_rtgrd'] . "', 
				fl_acmpte = '". $rowCtrlLeitoTemp['fl_acmpte'] . "', 
				fl_status_leito = '" . $rowCtrlLeitoTemp['fl_status_leito'] . "', " ;
				if ($rowCtrlLeitoTemp['id_status_leito']==null){
					$sqlUpdateCtrlTemp.=" id_status_leito = null , ";				
				} else {
					$sqlUpdateCtrlTemp.="id_status_leito = " . $rowCtrlLeitoTemp['id_status_leito'] . " ,";
				}				
				if ($rowCtrlLeitoTemp['id_memb_equip_hosptr_psco']==null){
					$sqlUpdateCtrlTemp.=" id_memb_equip_hosptr_psco = null, ";
				} else {
					$sqlUpdateCtrlTemp.="id_memb_equip_hosptr_psco = " . $rowCtrlLeitoTemp['id_memb_equip_hosptr_psco'] . " ,";
				}
				$sqlUpdateCtrlTemp.="nm_psco = '" . $rowCtrlLeitoTemp['nm_psco'] . "'   , ";
				if ($rowCtrlLeitoTemp['id_memb_equip_hosptr_trpa']==null){
					$sqlUpdateCtrlTemp.=" id_memb_equip_hosptr_trpa = null, ";
				} else {
					$sqlUpdateCtrlTemp.="id_memb_equip_hosptr_trpa = " . $rowCtrlLeitoTemp['id_memb_equip_hosptr_trpa'] . " ,";				}				
				$sqlUpdateCtrlTemp.="nm_trpa = '" . $rowCtrlLeitoTemp['nm_trpa'] . "'  ,				
				ds_cid = '" . $rowCtrlLeitoTemp['ds_cid'] . "'	,
				ds_dieta = '" . $rowCtrlLeitoTemp['ds_dieta'] . "',
				ds_const = '" . $rowCtrlLeitoTemp['ds_const'] . "',
				ds_ocorr = '" . $rowCtrlLeitoTemp['ds_ocorr'] . "', 
				ds_crtr_intnc = '" . $rowCtrlLeitoTemp['ds_crtr_intnc'] . "'				 
				WHERE pac_reg = " . $rowSmart[7] . "";

				$resultUpdateCtrlTemp = pg_query($pdo, $sqlUpdateCtrlTemp);
			
				if($resultUpdateCtrlTemp){
					echo "";
				}
				
				//retirar aqui				
				//echo $sqlUpdateCtrlTemp;
				
			}
		}
		
	}
	
	
	$sql = "select ds_leito from integracao.vw_ctrl_leito where pac_reg=0";		
	$retSmart = pg_query($pdo, $sql);	
	if(!$retSmart) {
		echo pg_last_error($pdo);
		
		exit;
	}				
	
	while($rowSmart = pg_fetch_row($retSmart)) {
	
		$sqlUpdateCtrl = "UPDATE integracao.tb_ctrl_leito SET 
		dt_prvs_alta = null,
		nm_pcnt = null,
		ds_sexo = null,
		dt_nasc_pcnt = null,
		nm_cnvo = null,
		pac_reg = null,
		dt_admss = null,
		fl_fmnte = null, 
		fl_rtgrd = null, 
		fl_acmpte = null, 		
		id_memb_equip_hosptr_mdco = null, 
		id_memb_equip_hosptr_psco = null, 
		id_memb_equip_hosptr_trpa = null,
		nm_mdco=null, 		
		nm_psco=null,
		nm_trpa=null,
		ds_cid = null,	
		ds_dieta = null,
		ds_const = null,
		ds_ocorr = null, 
		ds_crtr_intnc = null				 
		WHERE trim(ds_leito) = trim('" . $rowSmart[0] . "')";

		$resultUpdateCtrl = pg_query($pdo, $sqlUpdateCtrl);
	
		if($resultUpdateCtrl){
			echo "";
		}
		
		$sqlUpdateCtrl = "UPDATE integracao.tb_ctrl_leito_temp SET 						
		pac_reg = null,		
		fl_fmnte = null, 
		fl_rtgrd = null, 
		fl_acmpte = null, 		
		id_memb_equip_hosptr_mdco = null, 
		id_memb_equip_hosptr_psco = null, 
		id_memb_equip_hosptr_trpa = null,
		nm_mdco=null, 		
		nm_psco=null,
		nm_trpa=null,
		ds_cid = null,	
		ds_dieta = null,
		ds_const = null,
		ds_ocorr = null, 
		ds_crtr_intnc = null				 
		WHERE trim(ds_leito) = trim('" . $rowSmart[0] . "')";
		
		$resultUpdateCtrl = pg_query($pdo, $sqlUpdateCtrl);

		if($resultUpdateCtrl){
			echo "";
		}

	}
	
	$sqlCtrlLeito = "SELECT ds_leito
	, pac_reg
	, case when nm_mdco='' then '-' else nm_mdco end nm_mdco
	, case when nm_psco='' then '-' else nm_psco end nm_psco 
	, case when nm_trpa='' then '-' else nm_trpa end nm_trpa 
	, ds_ocorr
	, ds_cid
	, ds_dieta
	, fl_fmnte
	, ds_const
	, ds_crtr_intnc
	, fl_status_leito
	, fl_acmpte
	, fl_rtgrd
	, pac_reg
	, id_status_leito
	, id_memb_equip_hosptr_mdco
	, id_memb_equip_hosptr_psco
	, id_memb_equip_hosptr_trpa 
	FROM integracao.tb_ctrl_leito order by 1 ";			
	
	$retctrlleito = pg_query($pdo, $sqlCtrlLeito);	
	
	if(!$retctrlleito) {
		echo pg_last_error($pdo);	
		exit;
	}	
	
	while($rowctrlleito = pg_fetch_assoc($retctrlleito)) {
	
		$sqlUpdateCtrlLeitoTemp = "UPDATE integracao.tb_ctrl_leito_temp SET 
		fl_fmnte = '". $rowctrlleito['fl_fmnte'] . "', 
		fl_rtgrd = '". $rowctrlleito['fl_rtgrd'] . "', 
		fl_acmpte = '". $rowctrlleito['fl_acmpte'] . "', 
		fl_status_leito = '" . $rowctrlleito['fl_status_leito'] . "', " ;
		if ($rowctrlleito['id_status_leito']==null){
			$rowctrlleito.=" id_status_leito = null , ";				
		} else {
			$sqlUpdateCtrlLeitoTemp.="id_status_leito = " . $rowctrlleito['id_status_leito'] . " ,";
		}
		if ($rowctrlleito['id_memb_equip_hosptr_mdco']==null){
			$sqlUpdateCtrlLeitoTemp.=" id_memb_equip_hosptr_mdco = null, ";
		} else {
			$sqlUpdateCtrlLeitoTemp.="id_memb_equip_hosptr_mdco = " . $rowctrlleito['id_memb_equip_hosptr_mdco'] . " ,";
		}
		$sqlUpdateCtrlLeitoTemp.="nm_mdco = '" . $rowctrlleito['nm_mdco'] . "' , ";				
		if ($rowctrlleito['id_memb_equip_hosptr_psco']==null){
			$sqlUpdateCtrlLeitoTemp.=" id_memb_equip_hosptr_psco = null, ";
		} else {
			$sqlUpdateCtrlLeitoTemp.="id_memb_equip_hosptr_psco = " . $rowctrlleito['id_memb_equip_hosptr_psco'] . " ,";
		}
		$sqlUpdateCtrlLeitoTemp.="nm_psco = '" . $rowctrlleito['nm_psco'] . "'   , ";
		if ($rowctrlleito['id_memb_equip_hosptr_trpa']==null){
			$sqlUpdateCtrlLeitoTemp.=" id_memb_equip_hosptr_trpa = null, ";
		} else {
			$sqlUpdateCtrlLeitoTemp.="id_memb_equip_hosptr_trpa = " . $rowctrlleito['id_memb_equip_hosptr_trpa'] . " ,";				}				
		$sqlUpdateCtrlLeitoTemp.="nm_trpa = '" . $rowctrlleito['nm_trpa'] . "'  ,				
		ds_cid = '" . $rowctrlleito['ds_cid'] . "'	,
		ds_dieta = '" . $rowctrlleito['ds_dieta'] . "',
		ds_const = '" . $rowctrlleito['ds_const'] . "',
		ds_ocorr = '" . $rowctrlleito['ds_ocorr'] . "', 
		ds_crtr_intnc = '" . $rowctrlleito['ds_crtr_intnc'] . "',				 
		pac_reg = ". $rowctrlleito['pac_reg'] . "
		WHERE ds_leito = '" . $rowctrlleito['ds_leito'] . "'";
		
		$resultUpdateCtrlLeito = pg_query($pdo, $sqlUpdateCtrlLeitoTemp);
		
		if($resultUpdateCtrlLeito){
			echo "";
		}
		
		//retirar aqui	
		//if ($rowctrlleito['ds_leito']=='LEITO 414-A'){
		//	echo $sqlUpdateCtrlLeitoTemp;
		//}
		
	} 
	
	
	$atualizadadospcnt="";
		
	$sql = "SELECT fl_sist_admn from integracao.tb_c_usua_acesso where nm_usua_acesso = '".$_SESSION['usuario']."'";
	
	$ret_usua = pg_query($pdo, $sql);	
	if(!$ret_usua) {
		echo pg_last_error($pdo);
		exit;
	}
	
	$ret_usua_row = pg_fetch_row($ret_usua);
	
	if ($ret_usua_row[0]=="S"){
		$fl_sist_admn="S";						
	}else{
		$fl_sist_admn="N";			
		$sql = "SELECT distinct cd_transac_integracao from integracao.vw_acesso_transac_integracao where nm_usua_acesso = '".$_SESSION['usuario']."' and cd_transac_integracao = 'btn-xs classatualizaleito'";	
		
		$rettransac = pg_query($pdo, $sql);
		if(pg_num_rows($rettransac)==0) {
			$atualizadadospcnt = "nao_altera_dado_paciente";
		} else {
			$rettransac_row = pg_fetch_row($rettransac);
			$atualizadadospcnt = $rettransac_row[0];						
		}
	}
	
	//echo $atualizadadospcnt;
	
	
	$sql ="select  
		ds_leito,
		ds_andar,
		to_char(dt_admss, 'dd/mm/yyyy hh24:mi') as dt_admss,
		nm_pcnt,
		ds_crtr_intnc,
		to_char(dt_nasc_pcnt, 'dd/mm/yyyy') as dt_nasc_pcnt,
		nm_cnvo,
		nm_mdco,
		nm_psco,
		nm_trpa,
		case when ds_cid is null then '' else ds_cid end as ds_cid,
		case when fl_fmnte = 'true' then 
				'Sim' 
			  else 
				case when fl_fmnte = 'false' then
					'Não' 
				else	
					''
			  end end as fl_fmnte,			  
		ds_dieta,
		ds_const,
		to_char(dt_prvs_alta, 'dd/mm/yyyy hh24:mi') as dt_prvs_alta,
		case when fl_rtgrd = 'true' then 
				'Sim' 
			  else 
				case when fl_rtgrd = 'false' then
					'Não' 
				else	
					''
			  end end as fl_rtgrd,	
		case when fl_acmpte = 'true' then 
				'Sim' 
			  else 
				case when fl_acmpte = 'false' then
					'Não' 
				else	
					''
			  end end as fl_acmpte,	
		fl_status_leito,
		ds_apto_atvd_fisica,
		ds_progra,
		hr_progra,
		fl_txclg_agndd,
		dt_rlzd,
		fl_rstc_visita,
		ds_pssoa_rtrta ,
		tp_dia_leito_manut,
		pac_reg,		
		ds_ocorr,
		ds_sexo
		FROM integracao.tb_ctrl_leito
		ORDER BY 1, 3 ";//"LIMIT $itens_por_pagina OFFSET $pagina*$itens_por_pagina"
			
	$ret = pg_query($pdo, $sql);
	
	if(!$ret) {
		echo pg_last_error($pdo);		
		exit;
	}
	
	if(isset($_POST['altera'])){					
		
		if ($pdo==null){
			header(Config::$webLogin);
		}
		
		try
		{	
		
			$fl_status_leitoAnterior = "NENHUM";
		
			$sqlStatusLeito = "SELECT fl_status_leito FROM integracao.tb_ctrl_leito WHERE trim(ds_leito) = '". $_POST['nm_loc_nome'] ."'";
			
			$retStatusLeito = pg_query($pdo, $sqlStatusLeito);
		
			if(!$retStatusLeito) {
				echo pg_last_error($pdo);				
				exit;
			}	
			
			if (pg_numrows($retStatusLeito)>0) {
				
				$rowStatusLeito = pg_fetch_assoc($retStatusLeito);	
				$fl_status_leitoAnterior = $rowStatusLeito['fl_status_leito'];
				
			}			
			
			if ($_POST['fl_fmnte']=='null' || $_POST['fl_fmnte']==''){
				$fl_fmnte = 'null';
			} else {
				$fl_fmnte = $_POST['fl_fmnte'];
			}
			
			if ($_POST['fl_rtgrd']=='null' || $_POST['fl_rtgrd']==''){
				$fl_rtgrd = 'null';
			} else {
				$fl_rtgrd = $_POST['fl_rtgrd'];
			}
			
			if ($_POST['fl_acmpte']=='null' || $_POST['fl_acmpte']==''){
				$fl_acmpte = 'null';
			} else {
				$fl_acmpte = $_POST['fl_acmpte'];
			}
			
			$sql = "UPDATE integracao.tb_ctrl_leito SET 
			fl_fmnte = " . $fl_fmnte . ", 
			fl_rtgrd = " . $fl_rtgrd . ", 
			fl_acmpte = " . $fl_acmpte . ", ";
			
			if ($_POST['id_status_leito']=='null' or $_POST['id_status_leito']=='' ) {
				$_POST['id_status_leito']=5;				
			}
			
			$sql.="fl_status_leito = (select ds_status_leito from integracao.tb_status_leito where id_status_leito = " . $_POST['id_status_leito'] . ") , 
				id_status_leito = " . $_POST['id_status_leito'] . "  ,";
			
			if ($_POST['id_memb_equip_hosptr_mdco']=='null' or $_POST['id_memb_equip_hosptr_mdco']=='' ) {
				$sql.="id_memb_equip_hosptr_mdco = null , 
				nm_mdco = null  , ";
			} else {
				$sql.="id_memb_equip_hosptr_mdco = " . $_POST['id_memb_equip_hosptr_mdco'] . " , 
				nm_mdco = (select nm_memb_equip_hosptr from integracao.tb_equip_hosptr where id_memb_equip_hosptr = " . $_POST['id_memb_equip_hosptr_mdco'] . ")  , ";
			}
			if ($_POST['id_memb_equip_hosptr_psco']=='null' or $_POST['id_memb_equip_hosptr_psco']=='' ) {
				$sql.="id_memb_equip_hosptr_psco = null , 
				nm_psco = null  , ";
			} else {
				$sql.="id_memb_equip_hosptr_psco = " . $_POST['id_memb_equip_hosptr_psco'] . " , 
				nm_psco = (select nm_memb_equip_hosptr from integracao.tb_equip_hosptr where id_memb_equip_hosptr = " . $_POST['id_memb_equip_hosptr_psco'] . ") , ";
			}			
			if ($_POST['id_memb_equip_hosptr_trpa']=='null' or $_POST['id_memb_equip_hosptr_trpa']=='' ) {
				$sql.="id_memb_equip_hosptr_trpa = null , 
				nm_trpa = null  , ";
			} else {
				$sql.="id_memb_equip_hosptr_trpa = " . $_POST['id_memb_equip_hosptr_trpa'] . " , 
				nm_trpa = (select nm_memb_equip_hosptr from integracao.tb_equip_hosptr where id_memb_equip_hosptr = " . $_POST['id_memb_equip_hosptr_trpa'] . ") , ";
			}
			$sql.="ds_cid = '" . $_POST['ds_cid'] . "'	,
			ds_dieta = '" . $_POST['ds_dieta'] . "',
			ds_const = '" . $_POST['ds_const'] . "',
			ds_ocorr = '" . $_POST['ds_ocorr'] . "', 
			ds_crtr_intnc = '" . $_POST['ds_crtr_intnc'] . "', 
			cd_usua_altr = '" . $_SESSION['usuario'] . "', 
            dt_altr = current_timestamp
			WHERE trim(ds_leito) = '". $_POST['nm_loc_nome'] ."'";
			
			//retirar aqui
			//echo $sql;
			
			$result = pg_query($pdo, $sql);

			if($result){
				echo "";
			}  
			
			//--------------------------------------------------------------------------------
			//Inserir no histórico de status do leito se o status foi modificado
			if ($fl_status_leitoAnterior <> "NENHUM"){
				
				$sqlStatusLeito = "select ds_status_leito from integracao.tb_status_leito where id_status_leito = " . $_POST['id_status_leito'] . "";
			
				$retStatusLeito = pg_query($pdo, $sqlStatusLeito);
			
				if(!$retStatusLeito) {
					echo pg_last_error($pdo);
					//header(Config::$webLogin);
					exit;
				}	
				
				if (pg_numrows($retStatusLeito)>0) {
					
					$rowStatusLeito = pg_fetch_assoc($retStatusLeito);	
					if ($fl_status_leitoAnterior <> $rowStatusLeito['ds_status_leito']){
						
						$sqlHstrStatusLeito = "INSERT INTO integracao.tb_f_hstr_ocpa_leito_status VALUES ((select NEXTVAL('integracao.sq_hstr_ocpa_leito_status')), '". $_POST['nm_loc_nome'] ."', current_timestamp, '". $rowStatusLeito['ds_status_leito'] ."')";
						
						$resultHstrStatusLeito = pg_query($pdo, $sqlHstrStatusLeito);
						
						if($resultHstrStatusLeito){
							echo "";
						}
						
					}

				}
				
			}			
			//--------------------------------------------------------------------------------
			
			$sqlCtrlLeitoTemp="SELECT COUNT(1) FROM integracao.tb_ctrl_leito_temp WHERE trim(ds_leito) = '". $_POST['nm_loc_nome'] ."'";
			
			$retCtrlLeitoTemp = pg_query($pdo, $sqlCtrlLeitoTemp);
		
			if(!$retCtrlLeitoTemp) {
				echo pg_last_error($pdo);				
				exit;
			}	
			
			$rowCtrlLeitoTemp = pg_fetch_row($retCtrlLeitoTemp);
			
			if ($rowCtrlLeitoTemp[0]==0){
				
				$sql = "INSERT INTO integracao.tb_ctrl_leito_temp(
						ds_leito, nm_mdco, nm_psco, nm_trpa, ds_ocorr, ds_cid, ds_dieta, fl_fmnte, ds_const, ds_crtr_intnc, fl_status_leito, fl_acmpte, fl_rtgrd, pac_reg, id_status_leito, id_memb_equip_hosptr_mdco, id_memb_equip_hosptr_psco, id_memb_equip_hosptr_trpa) VALUES ( ";
				$sql.= "'". $_POST['nm_loc_nome'] ."',";
				if ($_POST['id_memb_equip_hosptr_mdco']=='null' or $_POST['id_memb_equip_hosptr_mdco']=='' ) {
					$sql.="null,";
				} else {
					$sql.="(select nm_memb_equip_hosptr from integracao.tb_equip_hosptr where id_memb_equip_hosptr = " . $_POST['id_memb_equip_hosptr_mdco'] . ")  , ";
				}
				if ($_POST['id_memb_equip_hosptr_psco']=='null' or $_POST['id_memb_equip_hosptr_psco']=='' ) {
					$sql.=" null  , ";
				} else {
					$sql.=" (select nm_memb_equip_hosptr from integracao.tb_equip_hosptr where id_memb_equip_hosptr = " . $_POST['id_memb_equip_hosptr_psco'] . ") , ";
				}			
				if ($_POST['id_memb_equip_hosptr_trpa']=='null' or $_POST['id_memb_equip_hosptr_trpa']=='' ) {
					$sql.=" null  , ";
				} else {
					$sql.=" (select nm_memb_equip_hosptr from integracao.tb_equip_hosptr where id_memb_equip_hosptr = " . $_POST['id_memb_equip_hosptr_trpa'] . ") , ";
				}
				$sql.= "'". $_POST['ds_ocorr'] ."',";
				$sql.= "'". $_POST['ds_cid'] ."',";
				$sql.= "'". $_POST['ds_dieta'] ."',";
				$sql.= "". $fl_fmnte .",";
				$sql.= "'". $_POST['ds_const'] ."',";
				$sql.= "'". $_POST['ds_crtr_intnc'] ."',";
				$sql.= "(select ds_status_leito from integracao.tb_status_leito where id_status_leito = " . $_POST['id_status_leito'] . ") ,";
				$sql.= "". $fl_acmpte .",";
				$sql.= "". $fl_rtgrd .",";
				$sql.= "'". $_POST['pac_reg'] ."',";
				$sql.= "'". $_POST['id_status_leito'] ."',";
				if ($_POST['id_memb_equip_hosptr_mdco']=='null' or $_POST['id_memb_equip_hosptr_mdco']=='' ) {
					$sql.=" null , ";
				} else {
					$sql.="" . $_POST['id_memb_equip_hosptr_mdco'] . " , ";
				}
				if ($_POST['id_memb_equip_hosptr_psco']=='null' or $_POST['id_memb_equip_hosptr_psco']=='' ) {
					$sql.=" null , ";
				} else {
					$sql.="" . $_POST['id_memb_equip_hosptr_psco'] . " , ";
				}
				if ($_POST['id_memb_equip_hosptr_trpa']=='null' or $_POST['id_memb_equip_hosptr_trpa']=='' ) {
					$sql.=" null  ";
				} else {
					$sql.="" . $_POST['id_memb_equip_hosptr_trpa'] . "  ";
				}
				$sql.= ")";
				
				$result = pg_query($pdo, $sql);

				if($result){
					echo "";
				}
				
				//retirar aqui
				//echo $sql;
				
			} else {
				
				$sql = "UPDATE integracao.tb_ctrl_leito_temp SET 
				fl_fmnte = " . $fl_fmnte . ", 
				fl_rtgrd = " . $fl_rtgrd . ", 
				fl_acmpte = " . $fl_acmpte . ", ";
				
				if ($_POST['id_status_leito']=='null' or $_POST['id_status_leito']=='' ) {
					$_POST['id_status_leito']=5;				
				}
				
				$sql.="fl_status_leito = (select ds_status_leito from integracao.tb_status_leito where id_status_leito = " . $_POST['id_status_leito'] . ") , 
					id_status_leito = " . $_POST['id_status_leito'] . "  ,";
				
				if ($_POST['id_memb_equip_hosptr_mdco']=='null' or $_POST['id_memb_equip_hosptr_mdco']=='' ) {
					$sql.="id_memb_equip_hosptr_mdco = null , 
					nm_mdco = null  , ";
				} else {
					$sql.="id_memb_equip_hosptr_mdco = " . $_POST['id_memb_equip_hosptr_mdco'] . " , 
					nm_mdco = (select nm_memb_equip_hosptr from integracao.tb_equip_hosptr where id_memb_equip_hosptr = " . $_POST['id_memb_equip_hosptr_mdco'] . ")  , ";
				}
				if ($_POST['id_memb_equip_hosptr_psco']=='null' or $_POST['id_memb_equip_hosptr_psco']=='' ) {
					$sql.="id_memb_equip_hosptr_psco = null , 
					nm_psco = null  , ";
				} else {
					$sql.="id_memb_equip_hosptr_psco = " . $_POST['id_memb_equip_hosptr_psco'] . " , 
					nm_psco = (select nm_memb_equip_hosptr from integracao.tb_equip_hosptr where id_memb_equip_hosptr = " . $_POST['id_memb_equip_hosptr_psco'] . ") , ";
				}			
				if ($_POST['id_memb_equip_hosptr_trpa']=='null' or $_POST['id_memb_equip_hosptr_trpa']=='' ) {
					$sql.="id_memb_equip_hosptr_trpa = null , 
					nm_trpa = null  , ";
				} else {
					$sql.="id_memb_equip_hosptr_trpa = " . $_POST['id_memb_equip_hosptr_trpa'] . " , 
					nm_trpa = (select nm_memb_equip_hosptr from integracao.tb_equip_hosptr where id_memb_equip_hosptr = " . $_POST['id_memb_equip_hosptr_trpa'] . ") , ";
				}
				
				$sql.="ds_cid = '" . $_POST['ds_cid'] . "'	,
				ds_dieta = '" . $_POST['ds_dieta'] . "',
				ds_const = '" . $_POST['ds_const'] . "',
				ds_ocorr = '" . $_POST['ds_ocorr'] . "', 
				ds_crtr_intnc = '" . $_POST['ds_crtr_intnc'] . "',
				pac_reg = " . $_POST['pac_reg'] . " 
				WHERE trim(ds_leito) = trim('". $_POST['nm_loc_nome'] ."') ";
				
				$result = pg_query($pdo, $sql);

				if($result){
					echo "";
				}
				
				//retirar aqui
				//echo $sql;
				
			}
			
			//voltar aqui
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
			<style>
				/* tables */
					
				
				.table {
					border-radius: 0px;
					width: 50%;
					margin: 0px auto;
					float: none;
					border: 1px solid black;			
				}
				
				.table-condensed{
				  font-size: 9.5px;
				}
				
				.gif_loader_image{
				  position: fixed;
				  width: 100%;
				  height: 100%;
				  left: 0px;
				  bottom: 0px;
				  z-index: 1001;
				  background:rgba(0,0,0,.8);
				  text-align:center;
				}
				.gif_loader_image img{
				  width:30px;
				  margin-top:40%;
				}
		
				
			</style>
			 <meta charset="utf-8">
			 <meta http-equiv="X-UA-Compatible" content="IE=edge">
			 <meta name="viewport" content="width=device-width, initial-scale=1">
			 <title>Gestão de Leitos</title>			 
			 <link href="../css/bootstrap.min.css" rel="stylesheet">
			 <link href="../css/style.css" rel="stylesheet">	 			 		 			 
	  
		</head>
		<body id="aplicacao" onload="removeDivsEtapasCarga();">			
			<div class="container" style="margin-left: 0px; margin-right: 0px; position:fixed; margin-top: 0px; background-color:white; max-width: 5000px; height: 130px; border: 1px solid #E6E6E6;">
				<br>
				<label style="font-weight:bold; font-size: 11px;">Nome:</label>&nbsp;
				<input style="width: 200px; font-size: 11px;" type="text" id="buscapac" onkeyup="Busca(3, 'buscapac')" placeholder="Paciente..." title="Texto da Busca"> &nbsp;
				<label style="font-weight:bold; font-size: 11px;">Car. de Inter.:</label>&nbsp;
								
				<!--<input style="width: 300px;" type="text" id="buscacarcterint" onkeyup="Busca(4, 'buscacarcterint')" placeholder="Carater Int..." title="Texto da Busca"> -->				
				
				<?php
				
					$sqlcrtrintnc = "SELECT ds_crtr_intnc FROM integracao.tb_crtr_intnc order by 1";				
				
					if ($pdo==null){
							header(Config::$webLogin);
					}	
					$retcrtrintnc = pg_query($pdo, $sqlcrtrintnc);
					if(!$retcrtrintnc) {
						echo pg_last_error($pdo);
						exit;
					}
				?>
					<select id="sl_tp_carater_inter" style="width: 100px; font-size: 11px;" onchange="BuscaExato(4, 'sl_tp_carater_inter')">
					<option value=""></option>
								
					<?php
						$cont=1;	
						while($rowcrtrintnc = pg_fetch_row($retcrtrintnc)) {													
						?>
							<option value="<?php echo $rowcrtrintnc[0]; ?>"><?php echo $rowcrtrintnc[0]; ?></option>												
						<?php 
							$cont=$cont+1;
						}
						 ?>	
						
				</select>&nbsp;	
				
				
				&nbsp;&nbsp;
				<label style="font-weight:bold; font-size: 11px;">Dieta:</label>&nbsp;
				<input style="width: 100px; font-size: 11px;" type="text" id="buscadieta" onkeyup="Busca(12, 'buscadieta')" placeholder="Dieta..." title="Texto da Busca"> &nbsp;
				<!--<input class="btn btn-primary" type="submit" value="1 Andar" id="1andar" onclick="BuscaAndar( '1')">
				&nbsp;
				<input class="btn btn-primary" type="submit" value="2 Andar" id="2andar" onclick="BuscaAndar( '2')">
				&nbsp;
				<input class="btn btn-primary" type="submit" value="3 Andar" id="3andar" onclick="BuscaAndar( '3')">
				&nbsp;
				<input class="btn btn-primary" type="submit" value="4 Andar" id="4andar" onclick="BuscaAndar( '4')">-->
				<!--<label style="font-weight:bold; font-size: 11px"> Andar: <input style="width: 50px; font-size: 11px" type="text" id="buscaandar" onkeyup="Busca(1, 'buscaandar')" placeholder="Texto da Busca..." title="Texto da Busca"> </label>-->&nbsp;	
				
				<label style="font-weight:bold; font-size: 11px;">Andar:</label>&nbsp;				
										
				<?php
				
					$sqlandar = "select '1'
							union
							select '2'
							union
							select '3'
							union
							select '4'
							order by 1";				
				
					if ($pdo==null){
							header(Config::$webLogin);
					}	
					$retandar = pg_query($pdo, $sqlandar);
					if(!$retandar) {
						echo pg_last_error($pdo);
						exit;
					}
				?>
						<select id="sl_tp_andar" style="width: 50px; font-size: 11px;" onchange="Busca(1, 'sl_tp_andar')">
					<option value=""></option>
								
					<?php
						$cont=1;	
						while($rowandar = pg_fetch_row($retandar)) {													
						?>
							<option value="<?php echo $rowandar[0]; ?>"><?php echo $rowandar[0]; ?></option>												
						<?php 
							$cont=$cont+1;
						}
						 ?>	
						
				</select>&nbsp;	
				
				
				<label style="font-weight:bold; font-size: 11px;">Médico:</label>&nbsp;				
										
				<?php
				
					$sqlmdco = "SELECT nm_memb_equip_hosptr FROM integracao.tb_equip_hosptr where tp_memb_equip_hosptr = 'MDCO' order by 1";				
				
					if ($pdo==null){
							header(Config::$webLogin);
					}	
					$retmdco = pg_query($pdo, $sqlmdco);
					if(!$retmdco) {
						echo pg_last_error($pdo);
						exit;
					}
				?>
						<select id="sl_tp_mdco" style="width: 90px; font-size: 11px;" onchange="Busca(7, 'sl_tp_mdco')">
					<option value=""></option>
					<option value="-">-</option>
								
					<?php
						$cont=1;	
						while($rowmdco = pg_fetch_row($retmdco)) {													
						?>
							<option value="<?php echo $rowmdco[0]; ?>"><?php echo $rowmdco[0]; ?></option>												
						<?php 
							$cont=$cont+1;
						}
						 ?>	
						
				</select>&nbsp;	
				
				
				<label style="font-weight:bold; font-size: 11px;">Psicólogo:</label>&nbsp;				
										
				<?php
				
					$sqlrel = "SELECT nm_memb_equip_hosptr FROM integracao.tb_equip_hosptr where tp_memb_equip_hosptr = 'PSCO' order by 1";					
				
					if ($pdo==null){
							header(Config::$webLogin);
					}	
					$retrel = pg_query($pdo, $sqlrel);
					if(!$retrel) {
						echo pg_last_error($pdo);
						exit;
					}
				?>
						<select id="sl_tp_psco" style="width: 90px; font-size: 11px;" onchange="Busca(8, 'sl_tp_psco')">
					<option value=""></option>
					<option value="-">-</option>
								
					<?php
						$cont=1;	
						while($rowrel = pg_fetch_row($retrel)) {													
						?>
							<option value="<?php echo $rowrel[0]; ?>"><?php echo $rowrel[0]; ?></option>												
						<?php 
							$cont=$cont+1;
						}
						 ?>	
						
				</select>&nbsp;	
				<label style="font-weight:bold; font-size: 11px;">Terapeuta:</label>&nbsp;				
										
				<?php
				
					$sqltrpa = "SELECT nm_memb_equip_hosptr FROM integracao.tb_equip_hosptr where tp_memb_equip_hosptr = 'TRPA' order by 1";				
				
					if ($pdo==null){
							header(Config::$webLogin);
					}	
					$rettrpa = pg_query($pdo, $sqltrpa);
					if(!$rettrpa) {
						echo pg_last_error($pdo);
						exit;
					}
				?>
						<select id="sl_tp_trpa" style="width: 90px; font-size: 11px;" onchange="Busca(9, 'sl_tp_trpa')">
					<option value=""></option>
					<option value="-">-</option>
								
					<?php
						$cont=1;	
						while($rowtrpa = pg_fetch_row($rettrpa)) {													
						?>
							<option value="<?php echo $rowtrpa[0]; ?>"><?php echo $rowtrpa[0]; ?></option>												
						<?php 
							$cont=$cont+1;
						}
						 ?>	
						
				</select>&nbsp;&nbsp;
				
				<input class="btn btn-primary" style="font-size: 11px;" type="button" value="Atendimento" name="atendimento" data-toggle="modal" data-target="#modalatendimento">
				
				<br>
				<br>
				
				<label style="font-weight:bold; font-size: 11px;">Imprimir consulta do último filtro por:</label>&nbsp;
				<select  style="font-weight:bold; font-size: 11px;" name="tprelatorio" id="tprelatorio">
				  <option value="andar" selected>Andar</option>
				  <option value="medico">Médico</option>
				  <option value="psicologo">Psicólogo</option>
				  <option value="terapeuta">Terapeuta</option>
				  <option value="mapa">Mapa</option>
				</select>
				
				<input class="btn btn-primary" style="font-size: 11px;" type="button" value="Imprimir" id="imprimir">&nbsp;				
				
				
				<label style="font-weight:bold; font-size: 11px;">Imprimir BMHOnline - </label>&nbsp;			
				<label style="font-weight:bold; font-size: 11px;">Data Inicial:</label>&nbsp;
				<input style="font-weight:bold; font-size: 11px;" type="date" id="dataInicio" name="dataInicio"> &nbsp;&nbsp;
				<label style="font-weight:bold; font-size: 11px;">a</label>&nbsp;
				<label style="font-weight:bold; font-size: 11px;">Data Final:</label>&nbsp;
				<input style="font-weight:bold; font-size: 11px;" type="date" id="dataFim" name="dataFim">&nbsp;&nbsp;
				<input style="font-size: 11px;" class="btn btn-primary" type="button" value="Imprimir" id="imprimirbmh">&nbsp;
				
				<input class="btn btn-primary" style="font-size: 11px;" type="submit" value="Exp. BMHOnline" id="exportarbmhonline">&nbsp;
				
				<input class="btn btn-primary" style="font-size: 11px;" type="submit" value="Exp. Leito" id="exportar">&nbsp;
				<input class="btn btn-primary" style="font-size: 11px;" type="button" value="Legenda" name="legenda" data-toggle="modal" data-target="#modallegenda">
				
				<!--<input class="btn btn-primary" type="submit" value="BMHOnline" id="bmhonline">-->
			</div> <!-- /#top -->
			
			<div id="list" class="row" style="margin-left: 2px; margin-right: 2px">
				
				<div class="table-responsive" style="margin-top: 130px">				
					<table id="tabela" class="display table table-responsive table-striped table-bordered table-sm table-condensed">
					
						<tr style="font-size: 11px">
							<th style="text-align:center">Leito</th>
							<th style="text-align:center">Andar</th>
							<th style="text-align:center">Admissão</th>
							<th style="text-align:center">Paciente</th>
							<th style="text-align:center">Carater de Internação</th>
							<!--<th style="text-align:center">Sexo</th>-->								
							<th style="text-align:center">Data de Nasc.</th>
							<th style="text-align:center">Convênio</th>
							<th style="text-align:center">Médico</th>
							<th style="text-align:center">Psicólogo</th>
							<th style="text-align:center">Terapeuta</th>
							<th style="text-align:center">Grupo de CID</th>
							<th style="text-align:center">Fumante</th>
							<th colspan="2" style="text-align:center">Dieta/Consistência</th>
							<th style="text-align:center">Prvs. de Alta</th>
							<!--<th style="text-align:center">Ocorrências</th>-->
							<th style="text-align:center">Retagd.</th>
							<th style="text-align:center">Acomp.</th>
							<th style="text-align:center">Status</th>
							<th colspan="3" style="text-align:center">Ações</th>
							
						</tr>
						
						<tbody>
						<?php
							
							$cont=1;										
							while($row = pg_fetch_row($ret)) {
								
								if ($row[17]=="Ocupado"){            
									$corStatus="blue";
								}else{
									if ($row[17]=="Livre"){                
										$corStatus="green";
									} else {					
										if ($row[17]=="Em Manutenção"){						
											$corStatus="red";
										} else{
											if ($row[17]=="Em Higienização"){							
												$corStatus="orange";
								
											} else{
												if ($row[17]=="Reservado"){
													$corStatus="white";
												} else{
													$corStatus="gray";
										
												}
											}
										}
									}
								}
								
							?>						
								<tr >
									<td data-toggle="tooltip" data-placement="top" title="Leito" style="font-weight:bold; color:red; background-color:#E0FFFF" id="loc_nome" value="<?php echo $row[0];?>" ><?php echo $row[0];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Andar" style="font-weight:bold; text-align:center" id="ds_andar" value="<?php echo $row[1];?>" ><?php echo $row[1];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Admissão" style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="hsp_dthre" value="<?php echo $row[2];?>" ><?php echo $row[2];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Paciente" id="pac_nome" value="<?php echo $row[3];?>"><?php echo $row[3];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Carater de Internação" id="ds_crtr_intnc" value="<?php echo $row[4];?>"><?php echo $row[4];?></td>
									
									<!--<td id="ds_crtr_intnc"><input type="text" value="<?php echo $row['DS_CRTR_INTNC'];?>" class="form-control"/></td>-->
									
									<!--<td data-toggle="tooltip" data-placement="top" title="Sexo" style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="pac_sexo" value="<?php echo $row['PAC_SEXO'];?>"><?php echo $row['PAC_SEXO'];?></td>-->
									
									<td data-toggle="tooltip" data-placement="top" title="Data de Nasc." style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="pac_nasc" value="<?php echo $row[5];?>"><?php echo $row[5];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Convênio" style="font-weight:bold; background-color:#C0C0C0"id="cnv_nome" value="<?php echo $row[6];?>"><?php echo $row[6];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Médico" id="ds_mdco" value="<?php echo $row[7];?>"><input type="text" value="<?php echo $row[7];?>" style="display:none"/><?php echo $row[7];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Psicólogo" id="ds_psgo" value="<?php echo $row[8];?>"><input type="text" value="<?php echo $row[8];?>" style="display:none"/><?php echo $row[8];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Terapeuta" id="ds_trpta" value="<?php echo $row[9];?>"><input type="text" value="<?php echo $row[9];?>" style="display:none"/><?php echo $row[9];?></td>
									
									<td  data-toggle="tooltip" data-placement="top" title="Grupo de CID" style="text-align:center; font-weight:bold; background-color:#C0C0C0" id="ds_cid" value="<?php echo $row[10];?>"><input type="text" value="<?php echo $row[10];?>" style="display:none"/><?php echo $row[10];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Fumante?" style="text-align:center" id="fl_fmnte" value="<?php echo $row[11];?>" style="width: 15px;"><input type="text" value="<?php echo $row[11];?>" style="display:none"/><?php echo $row[11];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Dieta/Consistência" style="font-weight:bold; background-color:#C0C0C0" id="ds_dieta" value="<?php echo $row[12];?>"><input type="text" value="<?php echo $row[12];?>" style="display:none"/><?php echo $row[12];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Dieta/Consistência" style="font-weight:bold; background-color:#C0C0C0" id="ds_const" value="<?php echo $row[13];?>"><input type="text" value="<?php echo $row[13];?>" style="display:none"/><?php echo $row[13];?></td>
													
									<td data-toggle="tooltip" data-placement="top" title="Prvs. de Alta" style="text-align:center" id="dt_prvs_alta" value="<?php echo $row[14];?>"><input type="text" value="<?php echo $row[14];?>" style="display:none"/><?php echo $row[14];?></td>
									
									<!--<td data-toggle="tooltip" data-placement="top" title="Ocorrências" style="text-align:center; font-weight:bold; background-color:#FFE4C4" id="ds_ocorr" value="<?php echo $row['DS_OCORR'];?>"><input type="text" value="<?php echo $row['DS_OCORR'];?>" style="display:none"/><?php echo $row['DS_OCORR'];?></td>-->
									
									<td data-toggle="tooltip" data-placement="top" title="Retaguarda?" style="text-align:center" id="fl_rtgrd" value="<?php echo $row[15];?>"><input type="text" value="<?php echo $row[15];?>" style="display:none"/><?php echo $row[15];?></td>
									
									<td data-toggle="tooltip" data-placement="top" title="Acompanhante?" style="text-align:center" id="fl_acmp" value="<?php echo $row[16];?>"><input type="text" value="<?php echo $row[16];?>" style="display:none"/><?php echo $row[16];?></td>								
									
									
									<td data-toggle="tooltip" data-placement="top" title="Status do Leito" style="text-align:center; font-weight:bold; background-color:<?php echo $corStatus;?>" id="ds_status" value="<?php echo $row[17];?>"></td>
									
									<td class="actions">
										<input type="image" src="../img/lupa_1.png"  height="23" width="23" class="btn-xs visualiza"/>
									</td>
									
									<!--<?php
										if ($atualizadadospcnt=="nao_altera_dado_paciente"){
									?>
											<td class="actions">
											<input type="image" src="../img/update_bloqueado.png"  height="23" width="23" name="atualizaleito" data-toggle="modal" data-target="#atualizaleito"/></td>
											
										<?php } else { ?>
											
											<td class="actions">
											<input type="image" src="../img/Update_2.ico"  height="23" width="23" name="atualizaleito" data-toggle="modal" data-target="#atualizaleito" class="btn-xs classatualizaleito"/></td>	
																			
									<?php } ?>-->
									
									<td class="actions">
											<input type="image" src="../img/Update_2.ico"  height="23" width="23" name="atualizaleito" data-toggle="modal" data-target="#atualizaleito" class="btn-xs classatualizaleito"/></td>
									
									<td class="actions">
										<input type="image" src="../img/imprimileito.png"  height="23" width="23"  class="btn-xs imprimileito"/>
										
									</td>
									
								</tr>
							<?php 
							
								$cont=$cont+1;
							}  ?>	
						</tbody>
					</table>
				</div>
				
			</div> <!-- /#list -->				
			<!--<div>			
				<ul class="pagination">
					<li class="page-item"><a class="page-link" href="gestaoleitos.php?pagina=0">Primeiro</a></li>
					<?php 				
					//for ($i=0; $i<$num_paginas;$i++){										
					//?>
						<li class="page-item" ><a class="page-link" href="gestaoleitos.php?pagina=<?php //echo $i;?>">
					//		<?php //echo $i+1;?></a></li>
					//<?php //} ?>
					<li class="page-item"><a class="page-link" href="gestaoleitos.php?pagina=<?php //echo $num_paginas-1; ?>">Último</a></li>
				</ul>		
			</div>-->
			 <script src="../js/jquery.min.js"></script>
			 <script src="../js/bootstrap.min.js"></script>
			 <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
			 <script>
				function BuscaExato(col, idbusca) {
					  var input, filter, table, tr, td, i, txtValue;
					  input = document.getElementById(idbusca);
					  filter = input.value.toUpperCase();
					  table = document.getElementById("tabela");
					  tr = table.getElementsByTagName("tr");
					  for (i = 0; i < tr.length; i++) {
						td = tr[i].getElementsByTagName("td")[col];
						if (td) {
							txtValue = td.innerHTML;							
							if (txtValue.toUpperCase() == filter) {
								tr[i].style.display = "";
							} else {
								tr[i].style.display = "none";
							}							
							
						}       
					}
				}
					
				 function Busca(col, idbusca) {
					  var input, filter, table, tr, td, i, txtValue;
					  input = document.getElementById(idbusca);
					  filter = input.value.toUpperCase();
					  table = document.getElementById("tabela");
					  tr = table.getElementsByTagName("tr");
					  for (i = 0; i < tr.length; i++) {
						td = tr[i].getElementsByTagName("td")[col];
						if (td) {
						  txtValue = td.textContent || td.innerText;
						  if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						  } else {
							tr[i].style.display = "none";
						  }
						}       
					  }
					}
					
					function BuscaAndar(andar) {
					  var input, filter, table, tr, td, i, txtValue;					  
					  filter = andar;					  
					  table = document.getElementById("tabela");
					  tr = table.getElementsByTagName("tr");
					  for (i = 0; i < tr.length; i++) {
						td = tr[i].getElementsByTagName("td")[1];
						if (td) {
						  txtValue = td.textContent || td.innerText;
						  if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						  } else {
							tr[i].style.display = "none";
						  }
						}       
					  }
					}
			 </script>
			 <!-- Modal -->
			 <div class="modal fade" id="modalatendimento">
				<div class="modal-dialog">			
				<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title">Núm. de Pac em Atdm. Por Prof.</h4>
						</div>
						<div class="container">
							<?php
								$sqlAlocacaoPaciente = "SELECT * FROM (
								SELECT 'Médico' as TipoProfissional
									 , nm_mdco as NomeProfissional
									 , count(nm_mdco) as QtdePacAlocado	 
								FROM integracao.tb_ctrl_leito
								group by TipoProfissional
										, nm_mdco	   
								union
								SELECT 'Psicólogo' as TipoProfissional
									 , nm_psco as NomeProfissional
									 , count(nm_psco) as QtdePacAlocado	 
								FROM integracao.tb_ctrl_leito 
								group by TipoProfissional
									   , nm_psco	   
								union
								SELECT 'Terapeuta' as TipoProfissional
									 , nm_trpa as NomeProfissional
									 , count(nm_trpa) as QtdePacAlocado
								FROM integracao.tb_ctrl_leito 
								group by TipoProfissional
									   , nm_trpa
							) as alocacao
							where alocacao.QtdePacAlocado <> 0
							  and NomeProfissional <> '' 
							  and NomeProfissional <> '-'
							order by 1, 2 ";			
							
							if ($pdo==null){
								header(Config::$webLogin);
							}
							
							$retAlocacaoPaciente = pg_query($pdo, $sqlAlocacaoPaciente);
							if(!$retAlocacaoPaciente) {
								echo pg_last_error($pdo);
								exit;
							}	
							?> 
							
							<table cellspacing="10px" cellpadding="10px">					
								<tr>
									<th>Profissional</th>				
									<th>Nome do Profissional</th>
									<th>Qtde Pac. em Atdm</th>											
								</tr>
							<?php
								while($rowAlocacaoPaciente = pg_fetch_row($retAlocacaoPaciente)) {
								?>
									<tr>
										<td><?php echo $rowAlocacaoPaciente[0];?></td>				
										<td><?php echo $rowAlocacaoPaciente[1];?></td>
										<td><?php echo $rowAlocacaoPaciente[2];?></td>
									</tr>								
								<?php
								}

							?>
							</table>						
						</div>
						<div class="modal-footer">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						</div>
					 </div>				  
				</div>
			</div>
			<div class="modal fade" id="modallegenda">
				<div class="modal-dialog">			
				<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title">Legenda</h4>
						</div>
						<div class="container">
													
							<div class="card text-white bg-primary mb-3">Ocupado</div>
							<div class="card text-white bg-success mb-3">Livre</div>
							<div class="card text-white bg-danger mb-3">Em Manutenção</div>
							<div class="card text-white bg-warning mb-3">Em Higienização</div>
							<div class="card text-dark bg-light mb-3">Reservado</div>
							<div class="card text-white bg-secondary mb-3">Interditado</div>						
						</div>
						<div class="modal-footer">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						</div>
					 </div>				  
				</div>
			</div>
			<div class="modal fade" id="modallegenda">
				<div class="modal-dialog">			
				<!-- Modal content-->
					<div class="modal-content">						
						<div class="container">													
							<div class="card text-white bg-primary mb-3">Ocupado</div>
													
						</div>
					 </div>				  
				</div>
			</div>
	</body>
	
</html>

<div id="dataModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Detalhes do Paciente</h4>
			</div>
			<div class="modal-body" id="detalhe_paciente">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>			
<script>
	
	$(document).ready(function(){	  
		$('[data-toggle="tooltip"]').tooltip();		
	});
	
	$('#exportarbmhonline').click(function(){
			
			var dataInicio = document.getElementById("dataInicio").value;		
			var dataFim = document.getElementById("dataFim").value;		
			
			$.ajax({
				url : '../gestaoleitos/relatorioexcelbmhonline.php', // give complete url here
				type : 'post',
				data:{dataInicio:dataInicio, dataFim:dataFim},
				success : function(completeHtmlPage) {	
					alert("Faça o download do arquivo de impressão. Abra no Excel e solicite para Salvar Como com o nome desejado.");
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
			});
		});
	
	$('#imprimirbmh').click(function(){
			
			var dataInicio = document.getElementById("dataInicio").value;		
			var dataFim = document.getElementById("dataFim").value;		
			
			$.ajax({
				url : '../gestaoleitos/relatorio_bmhonline.php', // give complete url here
				type : 'post',
				data:{dataInicio:dataInicio, dataFim:dataFim},
				success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
			});
		});
	
	$('#exportar').click(function(){
		
		var impressao = "sim";
		
		$.ajax({
			url : '../gestaoleitos/relatorioleitos.php', // give complete url here
			type : 'post',
			data:{impressao:impressao},
			success : function(completeHtmlPage) {
				alert("Faça o download do arquivo de impressão. Abra no Excel e solicite para Salvar Como com o nome desejado.");
				$("html").empty();
				$("html").append(completeHtmlPage);
			}
		});
	});
	
	
	$('#imprimir').click(function(){
		
		var tpimpressao = document.getElementById("tprelatorio").value;
		var varsl_tp_psco = document.getElementById("sl_tp_psco").value;
		var varsl_tp_mdco = document.getElementById("sl_tp_mdco").value;
		var varsl_tp_trpa = document.getElementById("sl_tp_trpa").value;
		var varsl_tp_andar = document.getElementById("sl_tp_andar").value;
		
		$.ajax({
			url : '../gestaoleitos/relatorioportipo.php', // give complete url here
			type : 'post',
			data:{tpimpressao:tpimpressao, varsl_tp_psco:varsl_tp_psco, varsl_tp_mdco:varsl_tp_mdco, varsl_tp_trpa:varsl_tp_trpa, varsl_tp_andar:varsl_tp_andar},
			success : function(completeHtmlPage) {				
				$("html").empty();
				$("html").append(completeHtmlPage);
			}
		});
	});
	
	$('#bmhonline').click(function(){
		
		var bmhonline = "sim";
		
		$.ajax({
			url : '../gestaoleitos/bmh_online.php', // give complete url here
			type : 'post',
			data:{bmhonline:bmhonline},
			success : function(completeHtmlPage) {				
				$("html").empty();
				$("html").append(completeHtmlPage);
			}
		});
	});
	
	$(document).ready(function(){
		$("#tabela").on('click', '.loader', function(){
			
			var currentRow=$(this).closest("tr"); 							
			var nm_loc_nome_inteiro = currentRow.find("td:eq(0)").text();
			var nm_loc_nome_trim = nm_loc_nome_inteiro.trim();			
			var nm_loc_nome_replace = nm_loc_nome_trim.replace('LEITO ', '');			
			var nm_loc_nome = nm_loc_nome_replace.trim();			
												
			$.ajax({
				url:"../gestaoleitos/selecao_detalhe_paciente.php",
				method:"POST",
				data:{nm_loc_nome:nm_loc_nome},
				success:function(data){
					$('#detalhe_paciente').html(data);
					$('#dataModal').modal('show');
				}
			});
        });
	});
	
	$(document).ready(function(){
		$("#tabela").on('click', '.imprimileito', function(){
			
			var currentRow=$(this).closest("tr"); 							
			var ds_andar = currentRow.find("td:eq(1)").text();
			var nm_pcnt = currentRow.find("td:eq(3)").text();
						
			$.ajax({
				url : '../gestaoleitos/relatorioporandar.php', // give complete url here
				method:"POST",
				data:{ds_andar:ds_andar, nm_pcnt:nm_pcnt},
				success : function(completeHtmlPage) {				
					$("html").empty();
					$("html").append(completeHtmlPage);
				}
			});
        });
	});
	
	$(document).ready(function(){
		$("#tabela").on('click', '.visualiza', function(){
			
			var currentRow=$(this).closest("tr"); 							
			var nm_loc_nome_inteiro = currentRow.find("td:eq(0)").text();
			var nm_loc_nome_trim = nm_loc_nome_inteiro.trim();			
			var nm_loc_nome_replace = nm_loc_nome_trim.replace('LEITO ', '');			
			var nm_loc_nome = nm_loc_nome_replace.trim();			
			
			$.ajax({
				url:"../gestaoleitos/selecao_detalhe_paciente.php",
				method:"POST",
				data:{nm_loc_nome:nm_loc_nome},
				success:function(data){
					$('#detalhe_paciente').html(data);
					$('#dataModal').modal('show');
				}
			});
        });
	});
	
	
	
	$(document).ready(function(){
		$(document).on('click', '.classatualizaleito', function(){
			
			var currentRow=$(this).closest("tr"); 							
			var nm_loc_nome_trim = currentRow.find("td:eq(0)").text();
			var nm_loc_nome = nm_loc_nome_trim.trim();
			
			event.preventDefault();			
			$.ajax({
				type: "POST",
				url:"../gestaoleitos/atualizadadosleitoatualizacao.php",
				data:{nm_loc_nome:nm_loc_nome},				
				success : function(completeHtmlPage) {									
					$("html").empty();					
					$("html").append(completeHtmlPage);										
				}
			});			
		});	
	});
	
</script>
<?php ?>