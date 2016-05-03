<?php
	function head($title, $texto){
	?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>
				<?php echo $title; ?> - <?php echo $texto; ?>
			</title>
			<link href="css/bootstrap.min.css" rel="stylesheet">
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
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
			<style>
				body {
					padding-top: 70px;
					background: #1C1C1C;
				}
			</style>
		</head>

	<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Menu</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Memestime</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="upload.php">
						<span class="glyphicon glyphicon-upload" aria-hidden="true"></span>
						Subir Imagen
					</a></li>
				</ul>
				<form class="navbar-form navbar-right" method="post" action="search.php"
					role="search" enctype="multipart/form-data">
					<div class="input-group">
						<input type="text" name="txtBuscar" class="form-control " placeholder="Buscar">
						<div class="input-group-btn">
							<button type="submit" name="btnBuscar" class="btn btn-primary">
								<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							</button>
						</div>
					</div>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="logout.php">Salir</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
	<?php
	}

	function foot(){
	?>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</body>
	</html>
	<?php
	}
?>
