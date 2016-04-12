<?php
	function head($title, $texto){
	?>
	<html>
		<head>
			<title>
				<?php echo $title; ?> - <?php echo $texto; ?>
			</title>
			<script>
				(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.5&appId=644141252268463";
					  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));

				window.fbAsyncInit = function() {
					FB.init({
						appId      : '524562501077352',
						cookie     : true,  // enable cookies to allow the server to access 
								// the session
						xfbml      : true,  // parse social plugins on this page
						version    : 'v2.5' // use graph api version 2.5
					});
					
					FB.getLoginStatus(function(response) {
						if(response.status!='connected'){
							location.href="login.php";
						}
					});
				}
			</script>
		</head>

	<body>
	<a href="index.php">Inicio</a>
	<a href="search.php">Buscar</a>
	<a href="upload.php">Subir Archivo</a>
	<a href="logout.php">Salir</a><br>
	<?php
	}

	function foot(){
	?>
	</body>
	</html>
	<?php
	}
?>
