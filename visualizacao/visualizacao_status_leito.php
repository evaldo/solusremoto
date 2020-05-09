<?php
//visualizacao_cores_risco.php
if(isset($_POST['id_status_leito']))
{
	session_start();
    
	$output = '';
    include '../database.php';
	
    $pdo = database::connect();
	
    $query = "SELECT id_status_leito, ds_status_leito, fl_ativo
				from integracao.tb_status_leito
		where id_status_leito = '".$_POST['id_status_leito']."'";

	
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
        <td width="30%"><label><b>Identificador do Stauts de Leito</b></label></td>  
        <td width="200%">'.$row[0].'</td>  
     </tr>
	 <tr>  
        <td width="30%"><label><b>Descrição do Status de Leitos</b></label></td>  
        <td width="200%">'.$row[1].'</td>  
     </tr>
	 <tr>  
        <td width="30%"><label><b>Ativo?</b></label></td>  
        <td width="200%">'.$row[2].'</td>  
     </tr> ';
    $output .= '</table></div>';
    echo $output;
}
?>
