<?php
	require_once('clases/uploadAction.php'); // quitando....
	$strRepuesta = "";
	include('header.php');
	head('Memestime', 'Subir Archivos');	
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Subir Memes</h3>
	</div>
	<div class="panel-body">
		<form action = "upload.php" method = "post" enctype="multipart/form-data">
			<div class="form-group">
				<input type="file" name = "btnSeleccionar"
					class="form-control" id="btnSeleccionar" value="Elegir archivo">
			</div>
			<div class="form-group">
				<label for="txtNombre">Descripcion</label>
				<input type="text" class="form-control" id="txtNombre" name = "txtNombre">
			</div>
			<button type="submit" class="btn btn-primary" id="btnSubir" name = "btnSubir">Subir Archivo</button>
			<button type="reset" class="btn btn-default" id="btnCancelar" name="btnCancelar">Cancelar</button>
			<?php
				$nombreArchivo = basename($_FILES["btnSeleccionar"]["name"]);
				$tipoArchivo =  pathinfo($nombreArchivo,PATHINFO_EXTENSION);
				$nombreTemporal = $_FILES["btnSeleccionar"]["tmp_name"];
				$tamanhoArchivo = $_FILES["btnSeleccionar"]["size"];

				if(isset($_POST['btnSubir'])){
					$arch = new memestimeArchivo();
					$status = $arch->upload($_COOKIE['nombre'], $nombreArchivo, $_POST["txtNombre"], $tipoArchivo, $tamanhoArchivo, isset($_POST["submit"]), $nombreTemporal, $strRepuesta);
				}
			?>

			<div id=respuesta>
				<?php
					echo $strRepuesta
				?>
			</div>
		</form>
	</div>
</div>
<?php
	foot();
?>
