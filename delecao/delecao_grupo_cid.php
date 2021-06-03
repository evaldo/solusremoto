<?php
//delete_cores.php
	session_start();
	$_SESSION['cd_grupo_cid']=$_POST['cd_grupo_cid'];
	$_SESSION['ds_dtlh_cid']=$_POST['ds_dtlh_cid'];
		
?>
	<!DOCTYPE html>
	<html lang="pt-br">
	<head>
	 <meta charset="utf-8">
	 <link href="../css/bootstrap.min.css" rel="stylesheet">
	 <link href="../css/style.css" rel="stylesheet">
	</head>
	<body>	
		<div class="container">
		  <div class="modal-dialog">
				<div class="modal-content">
					<div class="container">						
						<h4 class="modal-title">Exclusão de Grupos de CID</h4>
					</div>										
					<div class="modal-body">
						<div class="table-responsive">  
							<table class="table table-bordered">
								 <tr>  
									<td width="50%"><label>Código do Grupo de CID:</label></td>  
									<td width="500%"><?php echo $_POST['cd_grupo_cid']; ?></td>  
								 </tr>
								  <tr>  
									<td width="50%"><label>Descrição do Grupo de CID:</label></td>  
									<td width="500%"><?php echo $_POST['ds_grupo_cid']; ?></td>  
								 </tr>	
								 <tr>  
									<td width="50%"><label>Detalhe do Código de CID:</label></td>  
									<td width="500%"><?php echo $_POST['ds_dtlh_cid']; ?></td>  
								 </tr>									 
							</table>
						</div>
					</div>
					<div class="modal-footer">					
						<form class="form-inline" action="#" method="post" >
							<input type="submit" class="btn btn-danger" name="deleta" value="Apagar">&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" class="btn btn-primary" onclick="history.go()" value="Voltar">
						</form>
					</div>
				</div>
			</div>
		</div>		
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</body>
	</html>
		
<?php 
    
	
?>
