<?php
//select.php
if(isset($_POST["pac_reg"]))
{
	session_start();
    $output = '';
    include '../database.php';
    $pdo = database::connect();
    $query = "select 
			ds_leito,		
			to_char(dt_admss, 'dd/mm/yyyy hh24:mi') as dt_admss,
			nm_pcnt,
			ds_sexo,		
			to_char(dt_nasc_pcnt, 'dd/mm/yyyy') as dt_nasc_pcnt ,			
			nm_cnvo,
			ds_cid,
			case when fl_fmnte = 'T' then 
				'Fumante' 
			  else 
				case when fl_fmnte = 'F' then
					'Não Fumante' 
				else	
					''
			  end end as fl_fmnte,
			ds_dieta,
			ds_const,			
			nm_mdco,
			nm_psco,
			nm_trpa,		
			ds_ocorr,
			ds_crtr_intnc,
			fl_status_leito,
			cd_usua_altr,
			to_char(dt_altr, 'dd/mm/yyyy hh24:mi') as dt_altr
			FROM integracao.tb_bmh_online
			where dt_alta is not null
			  and id_mtvo_alta is null
			  and pac_reg = ". $_POST["pac_reg"] ."";
		
    $ret = pg_query($pdo, $query);
    if(!$ret) {
        echo pg_last_error($pdo);
        exit;
    }

    $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    $row = pg_fetch_row($ret);
    $output .= '
     <tr>  
        <td width="30%"><label><b>Leito</b></label></td>  
        <td width="200%">'.$row[0].'</td>  
     </tr>
     <tr>  
        <td width="30%"><label><b>Admissão</b></label></td>  
        <td width="200%">'.$row[1].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Paciente</b></label></td>  
        <td width="200%">'.$row[2].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Sexo</b></label></td>  
        <td width="200%">'.$row[3].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Nascimento</b></label></td>  
        <td width="200%">'.$row[4].'</td>  
      </tr>             
      <tr>  
        <td width="30%"><label><b>Convênio</b></label></td>  
        <td width="200%">'.$row[5].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>CID</b></label></td>  
        <td width="200%">'.$row[6].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Fumante</b></label></td>  
        <td width="200%">'.$row[7].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Dieta</b></label></td>  
        <td width="200%">'.$row[8].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Const.</b></label></td>  
        <td width="200%">'.$row[9].'</td>  
      </tr>      
      <tr>  
        <td width="30%"><label><b>Médico</b></label></td>  
        <td width="200%">'.$row[10].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Psicólogo</b></label></td>  
        <td width="200%">'.$row[11].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Terapeuta</b></label></td>  
        <td width="200%">'.$row[12].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Ocorrência</b></label></td>  
        <td width="200%">'.$row[13].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Carater de Internação</b></label></td>  
        <td width="200%">'.$row[14].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Status do Leito</b></label></td>  
        <td width="200%">'.$row[15].'</td>  
      </tr>
	  <tr>  
        <td width="30%"><label><b>Usuário que alterou:</b></label></td>  
        <td width="200%">'.$row[16].'</td>  
      </tr>
	  <tr>  
        <td width="30%"><label><b>Data da Alteração:</b></label></td>  
        <td width="200%">'.$row[17].'</td>  
      </tr>
    ';
    $output .= '</table></div>';
    echo $output;
}
?>
