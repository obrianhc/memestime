<?php
	require_once('clases/Archivo.php');
	require_once('clases/Global.php');
	require_once('clases/eliminarContenido.php');
	$global = new G();
	$archivo = new Archivo();
	$eliminar = new eliminarContenido();
	$strRespuesta = "";
	$cursor = $archivo->getArchivo($_GET['image']);
	$dato = array();
	foreach($cursor as $fila){
		$dato = $fila;
	}
	if(isset($_POST['btnEliminar'])){
		if($eliminar->eliminarArchivo($_GET['image'], 'files/'.$dato['url'], $strRespuesta)){
			echo $strRespuesta;
			header('location: index.php');
		}else{
			echo $strRespuesta;
		}
	}
	include('header.php');
	head('Memestime', implode(' ', $dato['nombreImagen']));
?>
	<head>
		<meta property="og:url"           content="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
		<meta property="og:type"          content="Repositorio de memes" />
		<meta property="og:title"         content="Memestime" />
		<meta property="og:description"   content="<?php echo implode(' ', $dato['nombreImagen']); ?>" />
		<meta property="og:image"         content="http://<?php echo $global->getFtpServer().'/'.$dato['url']; ?>" />

	</head>

	<?php
	echo '<img src="http://'.$global->getFtpServer().'/'.$dato['url'].'" id="imagen" width="30%">';
	if($dato['usuario']==$_COOKIE['nombre']){
		?>
		<form name="formEliminar" action="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" method="post">
			<input type='submit' name='btnEliminar' value="Eliminar Meme">
		</form>
		<?php
	}

	?>
	<div id="fb-root"></div>
	<!-- Your share button code -->
	<div class="fb-share-button" 
		data-href="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" 
		data-layout="button_count"></div>
<?php
	foot();
?>
