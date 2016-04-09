<?php
	require_once('clases/eliminarContenido.php');
	$id = $_POST['id'];
	$url = $_POST['ruta'];
	$eliminar = new eliminarContenido();
	$eliminar->eliminarArchivo($id, $url);
?>
