<?php
require_once('clases/Archivo.php');
require_once('clases/Global.php');
$global = new G();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Memestime</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script>
	  // This is called with the results from from FB.getLoginStatus().
	  function statusChangeCallback(response) {
	    console.log('statusChangeCallback');
	    console.log(response);
	    // The response object is returned with a status field that lets the
	    // app know the current login status of the person.
	    // Full docs on the response object can be found in the documentation
	    // for FB.getLoginStatus().
	    if (response.status === 'connected') {
	      // Logged into your app and Facebook.
	      testAPI();
	    } else if (response.status === 'not_authorized') {
	      // The person is logged into Facebook, but not your app.
	      //document.getElementById('status').innerHTML = 'Please log ' +
	      //  'into this app.';
	    } else {
	      // The person is not logged into Facebook, so we're not sure if
	      // they are logged into this app or not.
	      //document.getElementById('status').innerHTML = 'Please log ' +
	      //  'into Facebook.';
	    }
	  }

	  // This function is called when someone finishes with the Login
	  // Button.  See the onlogin handler attached to it in the sample
	  // code below.
	  function checkLoginState() {
	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response);
	    });
	  }

	  window.fbAsyncInit = function() {
	  FB.init({
	    appId      : '524562501077352',
	    cookie     : true,  // enable cookies to allow the server to access 
				// the session
	    xfbml      : true,  // parse social plugins on this page
	    version    : 'v2.5' // use graph api version 2.5
	  });

	  // Now that we've initialized the JavaScript SDK, we call 
	  // FB.getLoginStatus().  This function gets the state of the
	  // person visiting this page and can return one of three states to
	  // the callback you provide.  They can be:
	  //
	  // 1. Logged into your app ('connected')
	  // 2. Logged into Facebook, but not your app ('not_authorized')
	  // 3. Not logged into Facebook and can't tell if they are logged into
	  //    your app or not.
	  //
	  // These three cases are handled in the callback function.

	  FB.getLoginStatus(function(response) {
	    statusChangeCallback(response);
	  });

	  };

	  // Load the SDK asynchronously
	  (function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "//connect.facebook.net/en_US/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));

	  // Here we run a very simple test of the Graph API after login is
	  // successful.  See statusChangeCallback() for when this call is made.
	  function testAPI() {
	    console.log('Welcome!  Fetching your information.... ');
	    FB.api('/me', function(response) {
		//document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
		document.cookie = "nombre="+response.name;
		location.href = "index.php";	
	    });
	  }
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<style>
		body {
			padding-top: 70px;
			background: #1C1C1C;
		}

		#space {
			background-image: url('images/13115379_1163597593665074_893484573_n.jpg');
			font-family: "Arial Black", "Source Han Sans CN Heavy";
			color:#FE894F;
			text-shadow: #000 -1px 1px, #000 -2px 2px, #000 -3px 3px, #000 -4px 4px, #000 -5px 5px;
		}
	</style>
<head>
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
				<ul class="nav navbar-right">
					<li>
						<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
						</fb:login-button>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="jumbotron" id="space">
			<h1>Memestime</h1>
			<p>
				<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
				</fb:login-button>
			</p>
		</div>
		<div class="row">
		<?php
			$archivos = new Archivo();
			$cursor = $archivos->getArchivos(12);
			foreach($cursor as $fila){
		?>
		<div class="col-sm-12 col-md-4 col-lg-4">
			<div class="thumbnail">
				<?php echo '<img class="img-responsive img-circle" src="http://'.$global->getFtpServer().'/'.$fila['url'].'">'; ?>
				<div class="caption">
					<h3><?php echo implode(' ', $fila["nombreImagen"]); ?></h3>
				</div>
			</div>
		</div>
		<?php
			}
		?>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
