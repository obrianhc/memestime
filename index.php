<?php
	include('header.php');
	require_once('clases/Archivo.php');
	head('Memestime','Inicio');
?>
		<ul>
			<?php
				$archivos = new Archivo();
				$cursor = $archivos->getArchivos(12);
				foreach($cursor as $fila){
					echo '<li><a href="image.php?image='.$fila["_id"].'">'.implode(' ', $fila["nombreImagen"]).'</a></li>';
				}
			?>
		</ul>
<?php
	foot();
?>
