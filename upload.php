<html>
<head>
<title>Upload</title>
</head>
<body>
<?php
	require_once('clases/uploadAction.php')			
?>
<label >Subir meme</label><br>
	<form action = "upload.php" method = "post" enctype="multipart/form-data">
		<input type="file" id="btnSeleccionar" value="Elegir archivo"><br>
		<input type="text" id="txtNombre"><br>
		<button type="button" id="btnSubir">subir archivo</button>

		<?php
			$dir = "tmp/"
			$fileName = $dir . basename($_FILES["btnSeleccionar"]["name"])
		?>

		<div id=respuesta>
			<!-- Se ha cargado correctamente el archivo -->
			<!-- Ha ocurrido un error al cargar el archivo -->
		</div>
	</form>

</body>
</html>
