<?php
//visualizacao_cores_risco.php
if(isset($_POST["id_status_equipe"]))
{
	session_start();
    
	$output = '';
    include '../database.php';
	
    $pdo = database::connect();
	
    $query ="SELECT status.id_status_equipe, equipe.ds_equipe, status.ds_status_equipe, case when status.fl_ativo = 1 then 'Sim' else 'Não' End Status_Ativo, case when status.fl_status_intrpe_trtmto_equipe = 1 then 'Sim' else 'Não' End Status_intrpe_trtmeto_equipe, case when status.fl_status_finaliza_trtmto_equipe = 1 then 'Sim' else 'Não' End status_finaliza_trtmto_equipe, status.cd_cor_status_equipe
				from tratamento.tb_c_status_equipe status, tratamento.tb_c_equipe equipe 
				where status.id_equipe = equipe.id_equipe and id_status_equipe = " . $_POST["id_status_equipe"] . "";
	
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
        <td width="30%"><label><b>Id Status da Equipe:</b></label></td>  
        <td width="200%">'.$row[0].'</td>  
     </tr>     
	 <tr>  
        <td width="30%"><label><b>Descrição da Equipe:</b></label></td>  
        <td width="200%">'.$row[1].'</td>  
      </tr>
	  <tr>  
        <td width="30%"><label><b>Descrição do Status:</b></label></td>  
        <td width="200%">'.$row[2].'</td>  
      </tr>
	  <tr>  
        <td width="30%"><label><b>Flag Ativo?</b></label></td>  
        <td width="200%">'.$row[3].'</td>  
     </tr>
     <tr>  
        <td width="30%"><label><b>Flag Interrompe o Tratamento?</b></label></td>  
        <td width="200%">'.$row[4].'</td>  
      </tr>
	 <tr>  
        <td width="30%"><label><b>Flag Finaliza o Tratamento?</b></label></td>  
        <td width="200%">'.$row[5].'</td>  
      </tr>
	  <tr>  
        <td width="30%"><label><b>Cor no Painel:</b></label></td>  
        <td width="200%">'.$row[6].'</td>  
      </tr>';
    $output .= '</table></div>';
    echo $output;
}
?>
