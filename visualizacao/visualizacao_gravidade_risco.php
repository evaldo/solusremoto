<?php
//visualizacao_grupo_acesso.php
if(isset($_POST["id_grvd_risco_pcnt"]))
{
	session_start();
    
	$output = '';
    include '../database.php';
	
    $pdo = database::connect();
	
    $query = "SELECT id_grvd_risco_pcnt, nm_grvd_risco_pcnt, cd_cor_grvd_risco
				from integracao.tb_grvd_risco_pcnt where id_grvd_risco_pcnt = '".$_POST["id_grvd_risco_pcnt"]."'";
	
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
        <td width="30%"><label><b>Id da Gravidade de Risco:</b></label></td>  
        <td width="200%">'.$row[0].'</td>  
     </tr>
     <tr>  
        <td width="30%"><label><b>Descrição da Gravidade de Risco:</b></label></td>  
        <td width="200%">'.$row[1].'</td>  
      </tr> 
	  <tr>  
        <td width="30%"><label><b>Cor da Gravidade de Risco:</b></label></td>  
        <td width="200%">'.$row[2].'</td>  
      </tr> ';
    $output .= '</table></div>';
    echo $output;
}
?>
