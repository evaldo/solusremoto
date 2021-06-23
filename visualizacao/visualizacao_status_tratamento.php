<?php
//visualizacao_cores_risco.php
if(isset($_POST["id_status_trtmto"]))
{
	session_start();
    
	$output = '';
    include '../database.php';
	
    $pdo = database::connect();
	
    $query = "SELECT id_status_trtmto, ds_status_trtmto , case when fl_ativo=1 then 'Sim' else 'Não' end fl_ativo, cd_cor_status_trtmto from tratamento.tb_c_status_trtmto where id_status_trtmto = '".$_POST["id_status_trtmto"]."'";
	
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
        <td width="30%"><label><b>Id do Status de Tratamento:</b></label></td>  
        <td width="200%">'.$row[0].'</td>  
     </tr>
     <tr>  
        <td width="30%"><label><b>Descrição do Status de Tratamento:</b></label></td>  
        <td width="200%">'.$row[1].'</td>  
      </tr>
	  <tr>  
        <td width="30%"><label><b>Flag Ativo?</b></label></td>  
        <td width="200%">'.$row[2].'</td>  
      </tr>
	 <tr>  
        <td width="30%"><label><b>Cor no Painel:</b></label></td>  
        <td width="200%">'.$row[3].'</td>  
      </tr>';
    $output .= '</table></div>';
    echo $output;
}
?>
