<html>
<?php
	require_once('clases/Archivo.php');
?>
	<head>
		<title>
			Memestime
		</title>
	</head>

	<body>
		<a href="upload.php">Subir contenido</a><br>
		<a href="search.php">Buscar</a>
		<ul>
			<?php
				$archivos = new Archivo();
				$cursor = $archivos->getArchivos(12);
				foreach($cursor as $fila){
					echo '<li><a href="image.php?image='.$fila["_id"].'">'.implode(' ', $fila["nombreImagen"]).'</a></li>';
				}
			?>
		</ul>
	</body>
</html>
