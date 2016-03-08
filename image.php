<html>
<?php
	require_once('clases/Archivo.php');
	$archivo = new Archivo();
	$cursor = $archivo->getArchivo($_GET['image']);
	$dato = array();
	foreach($cursor as $fila){
		$dato = $fila;
	}
?>
	<head>
		<title>
			Memestime
		</title>
		<meta property="og:url" content="http://memestime.com" />
		<meta property="og:title" content="Memestime" />
		<meta property="og:description" content="La mas grande base de datos de memes en el mundo" />
		<meta property="og:image" content="http://<?php echo $dato['url']; ?>" />
	</head>

	<body>
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.5&appId=644141252268463";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<?php
			echo '<img src="http://'.$dato['url'].'" id="imagen" width="30%">';
		?>
		<br>
		<div class="fb-share-button" id="botonCompartir" data-href="http://<?php echo $dato['url']; ?>" data-layout="button_count">
		
		</div>
	</body>
</html>
