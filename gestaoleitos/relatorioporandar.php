 <?php  
	
	session_start();
	
	include '../database.php';
	$pdo = database::connect();			
	
	if(isset($_POST['ds_andar'])){		
		
		$_SESSION['numeroandar']=$_POST['ds_andar'];			
		$_SESSION['nm_pcnt']=$_POST['nm_pcnt'];
	
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/style.css" rel="stylesheet">		
	</head>
	<body style="margin-right: 0; margin-left: 0">	
		<div class="container" style="width: 100%;  margin-right: 0; margin-left: 0; position: relative;">
		  <div class="modal-dialog">
				<div class="modal-content" style="width:800px">
					<div class="container">						
						<h4 class="modal-title">Emissão de Relatório de Leitos Por Andar</h4>
					</div>						
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">									
								   <tr>  
										<td style="width:150px"><label>Andar:</label></td>  
										<td style="width:150px"><label><?php echo $_POST['ds_andar'] ; ?></label></td>  
									</tr>
									<tr>
										<td style="width:150px"><label>Paciente:</label></td>  
										<td style="width:150px"><label><?php echo $_POST['nm_pcnt'] ; ?></label></td>  	
										 							
								   </tr>
								   
								</table>								
							</div>
							<div class="modal-footer">									
								<input type="submit" class="btn btn-primary impressao_relatoriopornadar" value="Imprimir o Andar" onclick="window.open('../tcpdf/relatorio/impressao_relatorioporandar.php');">
								<input type="submit" class="btn btn-primary impressao_relatorioporpaciente" value="Imprimir o Paciente" onclick="window.open('../tcpdf/relatorio/impressao_relatorioporpaciente.php');">
								<input type="submit" class="btn btn-primary" onclick="history.go()" value="Voltar">	
							</div>
						</div>
					</form>	
				</div>				
			</div>
		</div>						
		<script src="../js/jquery.min.js"></script>	 
		<script src="../js/bootstrap.min.js"></script>	 		
</body>
</html>
<script>
	
	//$('#impressao_relatoriopornadar').click(function(){
		
	//	var impressao_relatoriopornadar = "sim";
	//	var numeroandar = document.getElementById('numeroandar').value;
		
	//	window.open("../tcpdf/relatorio/impressao_relatorioporandar.php");
		
		//$.ajax({
		//	url : '../tcpdf/relatorio/impressao_relatorioporandar.php', // give complete url here
		//	type : 'post',
		//	data:{numeroandar:numeroandar},
		//	success : function(completeHtmlPage) {				
		//		$("html").empty();
		//		$("html").append(completeHtmlPage);
		//	}
		//});
		
	});
	
</script>	
<?php 
    
?>