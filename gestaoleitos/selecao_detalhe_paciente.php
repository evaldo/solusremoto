<?php
//select.php
if(isset($_POST["nm_loc_nome"]))
{
	session_start();
    $output = '';
    include '../database.php';
    $pdo = database::connect();
    $query = "select 
			ds_leito,		
			dt_admss,
			nm_pcnt,
			ds_sexo,		
			dt_nasc_pcnt,			
			nm_cnvo,
			ds_cid,
			case when fl_fmnte = 'T' then 'Fumante' else 'Não Fumante' end,
			ds_dieta,
			ds_const,
			TO_CHAR(dt_prvs_alta,'DD/MM/YYYY hh24:mm'),
			nm_mdco,
			nm_psco,
			nm_trpa,		
			ds_ocorr,
			ds_crtr_intnc,
			fl_status_leito			
			FROM integracao.tb_ctrl_leito WHERE TRIM(replace(ds_leito, 'LEITO', '')) = '". $_POST["nm_loc_nome"] ."' ";
		
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
        <td width="30%"><label><b>Previsão de Alta</b></label></td>  
        <td width="200%">'.$row[10].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Médico</b></label></td>  
        <td width="200%">'.$row[11].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Psicólogo</b></label></td>  
        <td width="200%">'.$row[12].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Terapeuta</b></label></td>  
        <td width="200%">'.$row[13].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Ocorrência</b></label></td>  
        <td width="200%">'.$row[14].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Carater de Internação</b></label></td>  
        <td width="200%">'.$row[15].'</td>  
      </tr>
      <tr>  
        <td width="30%"><label><b>Status do Leito</b></label></td>  
        <td width="200%">'.$row[16].'</td>  
      </tr>
    ';
    $output .= '</table></div>';
    echo $output;
}
?>
