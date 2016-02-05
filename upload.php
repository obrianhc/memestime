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
			<!-- Aqui colocar mensaje de respuesta, si el archivo se subio con exito, o si hubo algun error-->
		</div>
	</form>
    

</body>
</html>
