<html>
<head>
<title>Upload</title>
</head>
<body>
<?php
	require_once('clases/uploadAction.php'); // quitando....
	$strRepuesta = "";	
?>
<label >Subir meme</label><br>
	<form action = "upload.php" method = "post" enctype="multipart/form-data">
		<input type="file" name = "btnSeleccionar" id="btnSeleccionar" value="Elegir archivo"><br>
		<label >Nombre: </label><input type="text" id="txtNombre" name = "txtNombre"><br>
		<button type="submit" id="btnSubir" name = "btnSubir">subir archivo</button>

		<?php
			$nombreArchivo = basename($_FILES["btnSeleccionar"]["name"]);
			$tipoArchivo =  pathinfo($nombreArchivo,PATHINFO_EXTENSION);
			$nombreTemporal = $_FILES["btnSeleccionar"]["tmp_name"];
			$tamanhoArchivo = $_FILES["btnSeleccionar"]["size"];

			if(isset($_POST['btnSubir'])){
				$arch = new memestimeArchivo();
				$status = $arch->upload("luisfya", $nombreArchivo, $_POST["txtNombre"], $tipoArchivo, $tamanhoArchivo, isset($_POST["submit"]), $nombreTemporal, $strRepuesta);
			}
		?>

		<div id=respuesta>
			<?php
				echo $strRepuesta
			?>
			<!-- Se ha cargado correctamente el archivo -->
			<!-- Ha ocurrido un error al cargar el archivo -->
		</div>
	</form>

</body>
</html>
