<html>
<head>
<title>Upload</title>
</head>
<body>
	<p>Subir meme</p>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<input type="file" id="btnSeleccionar"><br/>
		<input type="text" id="txtNombre"><br/>
		<button type="button" id="btnSubir">subir archivo</button>

		<div id=respuesta>
			<!-- Se ha cargado correctamente el archivo -->
			<!-- Ha ocurrido un error al cargar el archivo -->
		</div>
	</form>
</body>
</html>
