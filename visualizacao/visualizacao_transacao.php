<?php
//visualizacao_cores_risco.php
if(isset($_POST['id_acesso_transac_integracao']))
{
	session_start();
    
	$output = '';
    include '../database.php';
	
    $pdo = database::connect();
	
    $query = "SELECT transac.id_acesso_transac_integracao, menu.nm_menu_sist_integracao, transac.nm_acesso_transac_integracao, transac.cd_transac_integracao, transac.cd_form_transac_integracao FROM integracao.tb_c_acesso_transac_integracao transac, integracao.tb_c_menu_sist_integracao menu where transac.id_menu_sist_integracao = menu.id_menu_sist_integracao 
	and transac.id_acesso_transac_integracao = ".$_POST["id_acesso_transac_integracao"]." ";
	
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
        <td width="30%"><label><b>Identificador da transação:</b></label></td>  
        <td width="200%">'.$row[0].'</td>  
     </tr>
	 <tr>  
        <td width="30%"><label><b>Funcionalidade/Menu:</b></label></td>  
        <td width="200%">'.$row[1].'</td>  
     </tr>
	 <tr>  
        <td width="30%"><label><b>Nome da Transação</b></label></td>  
        <td width="200%">'.$row[2].'</td>  
     </tr>
	 <tr>  
        <td width="30%"><label><b>Código da Transação:</b></label></td>  
        <td width="200%">'.$row[3].'</td>  
     </tr>     
	 <tr>  
        <td width="30%"><label><b>Cód da Func/Menu no Integração:</b></label></td>  
        <td width="200%">'.$row[4].'</td>  
     </tr>	  ';
    $output .= '</table></div>';
    echo $output;
}
?>
