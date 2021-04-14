<?php
//visualizacao_grupo_acesso.php
if(isset($_POST["id_orig_dmnd_plnj_leito"]))
{
	session_start();
    
	$output = '';
    include '../database.php';
	
    $pdo = database::connect();
	
    $query = "SELECT id_orig_dmnd_plnj_leito, ds_orig_dmnd_plnj_leito
				from integracao.tb_orig_dmnd_plnj_leito where id_orig_dmnd_plnj_leito = '".$_POST["id_orig_dmnd_plnj_leito"]."'";
	
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
        <td width="30%"><label><b>Id da Origem da Demanda:</b></label></td>  
        <td width="200%">'.$row[0].'</td>  
     </tr>
     <tr>  
        <td width="30%"><label><b>Descrição da Origem da Demanda:</b></label></td>  
        <td width="200%">'.$row[1].'</td>  
      </tr> ';
    $output .= '</table></div>';
    echo $output;
}
?>
