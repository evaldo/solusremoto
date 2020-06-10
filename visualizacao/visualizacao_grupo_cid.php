<?php
//visualizacao_cores_risco.php
if(isset($_POST["cd_grupo_cid"]))
{
	session_start();
    
	$output = '';
    include '../database.php';
	
    $pdo = database::connect();
	
    $query = "SELECT cd_grupo_cid, ds_grupo_cid from integracao.tb_c_grupo_cid where cd_grupo_cid = '".$_POST["cd_grupo_cid"]."'";
	
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
        <td width="30%"><label><b>Código Grupo CID:</b></label></td>  
        <td width="200%">'.$row[0].'</td>  
     </tr>
     <tr>  
        <td width="30%"><label><b>Descrição do Grupo CID:</b></label></td>  
        <td width="200%">'.$row[1].'</td>  
      </tr>;';
    $output .= '</table></div>';
    echo $output;
}
?>
