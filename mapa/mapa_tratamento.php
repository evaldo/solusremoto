<?php
		
	session_start();
	
    include '../database.php';
	
    $pdo = database::connect();
	$optconsulta = "";
	$textoconsulta = "";
	$sql="";

	$sql = "SELECT cd_pcnt
			 , ds_status_pcnt
			 , ds_local_trtmto 
			FROM tratamento.tb_hstr_pnel_mapa_risco
		WHERE dt_final_mapa_risco is null
		ORDER BY nu_seq_local_pnel asc";		
	
	if ($pdo==null){
			header(Config::$webLogin);
	}	
    $ret = pg_query($pdo, $sql);
    if(!$ret) {
        echo pg_last_error($pdo);
        exit;
    }
    $row = pg_fetch_row($ret)
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mapa de Tratamento</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <style>
    .grid {
      display: grid;
      grid-template-columns: auto auto auto;
      grid-template-rows: auto auto auto;
      grid-gap: 5px;
      position: relative;
      font-size: 12px;
      height: 150px;
    }

    .grid > * {
      border: 1px solid;
    }
  </style>
</head>
<body> 
	<br>
	<div class="container">
		<h2>Mapa de Tratamento</h2>	
	</div>
	<br>
	<hr>
	<div class="container">  
	  <form class="form-inline" action="#" method="post" >
			<input type="button" style="font-size: 11px;" value="Novo Mapa" class="btn btn-primary btn-xs insere" />&nbsp;
			<input type="button" style="font-size: 11px;" value="Novo Risco/Paiente" class="btn btn-primary btn-xs novorisco"/>&nbsp;
			<input type="button" style="font-size: 11px;" value="Exclui Risco/Paciente" class="btn btn-primary btn-xs excluirisco"/>&nbsp;	
			<input type="button" style="font-size: 11px;" value="Novo Status/Paciente" class="btn btn-primary btn-xs novostatus"/>&nbsp;
			<input type="button" style="font-size: 11px;" value="Exclui Status/Paciente" class="btn btn-primary btn-xs excluistatus"/>&nbsp;
			<input type="button" style="font-size: 11px;" value="Altera Obs/Paciente" class="btn btn-primary btn-xs alteraobs"/>&nbsp;
			<input type="button" style="font-size: 11px;" value="Finaliza Mapa" class="btn btn-primary btn-xs finalizamapa"/>&nbsp;
	  </form>		  
	</div>
	
	<hr>
			
		<br>		
		
        <div class="container"> 
		<div class="card-columns">		
		
		<?php

        $cont=1;
		$ret = pg_query($pdo, $sql);		
		
        while($row = pg_fetch_row($ret)) {	
			
		?>
			<div class="card bg-light">
         <?php		
            ?>				
				<div class="card-body text-center">
                <p class="card-text"><input type="button" name="view" value="<?php echo trim($row[2]); ?>" id="<?php echo trim($row[2]); ?>" class="btn btn-info btn-xs view_data" /></p>
				
				<?php
			
					echo "<p style='font-weight: bold'>". substr($row[0], 0, 20) . "</p>";			
				
					$pdo = database::connect();
					
					$sql="SELECT risco.ds_risco_pcnt
								 , risco.cd_cor_risco_pcnt
							FROM tratamento.tb_hstr_pnel_mapa_risco mapa_risco
							   , tratamento.tb_risco_rnado_pcnt	risco_rnado   
							   , tratamento.tb_c_risco_pcnt risco
							WHERE mapa_risco.id_hstr_pnel_mapa_risco = risco_rnado.id_hstr_pnel_mapa_risco
							  AND risco.id_risco_pcnt = risco_rnado.id_risco_pcnt
							  AND mapa_risco.cd_pcnt = ".$row[0]."
							  AND mapa_risco.dt_final_mapa_risco is null";		
					
					$ret_risco = pg_query($pdo, $sql);
					if(!$ret_risco) {
						pg_last_error($pdo);
						exit;
					}    
				
					?><div class="grid"><?php
				
					while($row_risco = pg_fetch_row($ret_risco)) 
					{																		 
						echo "<div style='background-color:".$row_risco[1]."; color:black;'>" . trim($row_risco[1]). "</div>";						
					}	
				?>
				</div>
				</div>
				</div>
				<?php
        }		
        //database::disconnect();
        ?>                
		</div>  
		</div>			
		<!-- Modal -->				
    </body>
    </html>
	<div id="dataModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Detalhes do Paciente</h4>
				</div>
				<div class="modal-body" id="detalhe_paciente">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>		
	<script>
		
		$(document).ready(function(){
			$(document).on('click', '.insere', function(){
				
				event.preventDefault();			
				$.ajax({
					type: "POST",
					url:"../mapa/insercao_mapa.php",				
					success : function(completeHtmlPage) {									
						$("html").empty();					
						$("html").append(completeHtmlPage);										
					}
				});			
			});	
		});
		
		$(document).ready(function(){
			$(document).on('click', '.novorisco', function(){
				
				event.preventDefault();			
				$.ajax({
					type: "POST",
					url:"../mapa/insercao_risco_paciente.php",				
					success : function(completeHtmlPage) {									
						$("html").empty();					
						$("html").append(completeHtmlPage);										
					}
				});			
			});	
		});
		
		$(document).ready(function(){
			$(document).on('click', '.excluirisco', function(){
				
				event.preventDefault();			
				$.ajax({
					type: "POST",
					url:"../mapa/exclui_risco_paciente.php",				
					success : function(completeHtmlPage) {									
						$("html").empty();					
						$("html").append(completeHtmlPage);										
					}
				});			
			});	
		});
		
		$(document).ready(function(){
			$(document).on('click', '.novostatus', function(){
				
				event.preventDefault();			
				$.ajax({
					type: "POST",
					url:"../mapa/insere_status_paciente_mapa.php",				
					success : function(completeHtmlPage) {									
						$("html").empty();					
						$("html").append(completeHtmlPage);										
					}
				});			
			});	
		});
		
		$(document).ready(function(){
			$(document).on('click', '.excluistatus', function(){
				
				event.preventDefault();			
				$.ajax({
					type: "POST",
					url:"../mapa/exclui_status_paciente_mapa.php",				
					success : function(completeHtmlPage) {									
						$("html").empty();					
						$("html").append(completeHtmlPage);										
					}
				});			
			});	
		});
		
		$(document).ready(function(){
			$(document).on('click', '.alteraobs', function(){
				
				event.preventDefault();			
				$.ajax({
					type: "POST",
					url:"../mapa/altera_status_paciente_mapa.php",				
					success : function(completeHtmlPage) {									
						$("html").empty();					
						$("html").append(completeHtmlPage);										
					}
				});			
			});	
		});
		
		$(document).ready(function(){
			$(document).on('click', '.finalizamapa', function(){
				
				event.preventDefault();			
				$.ajax({
					type: "POST",
					url:"../mapa/finaliza_paciente_mapa.php",				
					success : function(completeHtmlPage) {									
						$("html").empty();					
						$("html").append(completeHtmlPage);										
					}
				});			
			});	
		});
		
		$(document).on('click', '.view_data', function(){
			//$('#dataModal').modal();
			var nm_loc_nome = $(this).attr("id");
			$.ajax({
				url:"../mapa/selecao_detalhe_paciente_mapa.php",
				method:"POST",
				data:{nm_loc_nome:nm_loc_nome},
				success:function(data){
					$('#detalhe_paciente').html(data);
					$('#dataModal').modal('show');
				}
			});
		});
		
	</script>
</html>
<?php ?>