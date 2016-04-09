<html>
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
?>
	<head>
		<title>Memestime - <?php echo implode(' ', $dato['nombreImagen']); ?></title>
		<meta property="og:url"           content="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
		<meta property="og:type"          content="Repositorio de memes" />
		<meta property="og:title"         content="Memestime" />
		<meta property="og:description"   content="<?php echo implode(' ', $dato['nombreImagen']); ?>" />
		<meta property="og:image"         content="http://<?php echo $global->getFtpServer().'/'.$dato['url']; ?>" />

	</head>

	<body>
	<?php
		echo '<img src="http://'.$global->getFtpServer().'/'.$dato['url'].'" id="imagen" width="30%">';
	?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.5&appId=644141252268463";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

		<!-- Your share button code -->
		<div class="fb-share-button" 
			data-href="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" 
			data-layout="button_count"></div>
	</body>
</html>
