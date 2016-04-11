<?php
	require_once('clases/Archivo.php');
	require_once('clases/Global.php');
	$global = new G();
	$archivo = new Archivo();
	$cursor = $archivo->getArchivo($_GET['image']);
	$dato = array();
	foreach($cursor as $fila){
		$dato = $fila;
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
	?>
	<div id="fb-root"></div>
	<!-- Your share button code -->
	<div class="fb-share-button" 
		data-href="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" 
		data-layout="button_count"></div>
<?php
	foot();
?>
