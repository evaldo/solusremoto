<?php
//visualizacao_cores_risco.php
if(isset($_POST["id_mtvo_alta"]))
{
	session_start();
    
	$output = '';
    include '../database.php';
	
    $pdo = database::connect();
	
    $query = "SELECT id_mtvo_alta, ds_mtvo_alta from integracao.tb_mtvo_alta where id_mtvo_alta = '".$_POST["id_mtvo_alta"]."'";
	
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
        <td width="30%"><label><b>Código do Destino de Alta:</b></label></td>  
        <td width="200%">'.$row[0].'</td>  
     </tr>
     <tr>        
        <td width="30%"><label><b>Descrição do Destino de Alta:</b></label></td>  
        <td width="200%">'.$row[1].'</td>  
      </tr>';
    $output .= '</table></div>';
    echo $output;
}
?>
