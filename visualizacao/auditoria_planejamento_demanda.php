<?php

if(isset($_POST["id_plnj_pcnt_leito"]))
{
	session_start();
    
	$output = '';
    include '../database.php';
	
    $pdo = database::connect();
	
    $query = "SELECT cd_usua_incs, to_char(dt_incs, 'dd/mm/yyyy hh24:mi'), cd_usua_altr, to_char(dt_altr, 'dd/mm/yyyy hh24:mi') from integracao.tb_plnj_pcnt_leito where id_plnj_pcnt_leito = ".$_POST["id_plnj_pcnt_leito"]." ";
	
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
        <td width="30%"><label><b>Usuário que incluiu:</b></label></td>  
        <td width="200%">'.$row[0].'</td>  
     </tr>
     <tr>  
        <td width="30%"><label><b>Data de Inclusão:</b></label></td>  
        <td width="200%">'.$row[1].'</td>  
      </tr> 
	  <tr>  
        <td width="30%"><label><b>Usuário que fez a última alteração:</b></label></td>  
        <td width="200%">'.$row[2].'</td>  
     </tr>
     <tr>  
        <td width="30%"><label><b>Última data de alteração:</b></label></td>  
        <td width="200%">'.$row[3].'</td>  
      </tr>';
    $output .= '</table></div>';
    echo $output;
}
?>
