<?php
//select.php

error_reporting(0);

if(isset($_POST["num"]))
{
	
	$query = " SELECT sma_pac_reg, pac_nome, sma_data, sma_dthr_reg, sma_usr_login_sol, sma_usr_login_aut FROM dbo.vw_painel_farmacia WHERE num = ". $_POST["num"] ." ";
	
	$connection_string = 'DRIVER={SQL Server};SERVER=191.235.100.131,2071;DATABASE=Sd_ClinVilaVerde';

	$user = 'vilaverde';
	$pass = '&tH5#@06bJT';

	$conn = odbc_connect( $connection_string, $user, $pass );

	if( $conn ) {		 
		 $result = odbc_exec($conn, $query);
	
		if(!$result) {
			exit("Erro ao abrir a consulta no Smart");
		}    
    }
	$row=odbc_fetch_object($result);
    $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    
    $output .= '
     <tr>  
        <td width="30%"><label>Código do Paciente no Smart:</label></td>  
        <td width="200%">'.$row->sma_pac_reg.'</td>  
     </tr>
     <tr>  
        <td width="30%"><label>Nome do Paciente:</label></td>  
        <td width="200%">'.$row->pac_nome.'</td>  
      </tr>
      <tr>  
        <td width="30%"><label>Data da Solicitação:</label></td>  
        <td width="200%">'.$row->sma_data.'</td>  
      </tr>
      <tr>  
        <td width="30%"><label>Data/Hora da Solicitação:</label></td>  
        <td width="200%">'.$row->sma_dthr_reg.'</td>  
      </tr>
      <tr>  
        <td width="30%"><label>Usuário do Smart que solicitou:</label></td>  
        <td width="200%">'.$row->sma_usr_login_sol.'</td>  
      </tr>             
      <tr>  
        <td width="30%"><label>Usuário do Smart que autorizou:</label></td>  
        <td width="200%">'.$row->sma_usr_login_aut.'</td>  
      </tr>     
    ';
    $output .= '</table></div>';
    echo $output;
}
?>
