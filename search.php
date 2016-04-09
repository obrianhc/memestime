<html>
<head>
<title>Search</title>
</head>
<body>
<?php
	require_once('clases/searchAccion.php');
	$strBuscar = "";
	$strRespuesta = "";	
	$numIndices = 0;
	$numResultados = 0;
?>
	<a href="index.php">Regresar</a>
	<label>Buscar memes</label><br>
	<form action = "search.php" method = "post" enctype="multipart/form-data">
	<label >&iquest;Que necesitas?</label><input name="txtBuscar" size="15" maxlength="128" type="text">
	<br>
	<button type="submit" id="btnBuscar" name = "btnBuscar">Buscar meme</button></br>
	<?php
		if(isset($_POST['btnBuscar'])){
			
			$strBuscar = trim($_POST["txtBuscar"]);
			//echo "Criterio de busqueda " . $strBuscar;
			$numIndices = ceil($numResultados/3);
			iniciarBusqueda(1, $strBuscar);
			
		}

		if(isset($_POST['numIndices'])){//Si ya existe el hidden, osea que ya se hizo una busqueda y mostro resultados
			
			$numIndices = $_POST['numIndices'];
			$strBuscar = trim($_POST['strLoQueBusco']);
			//echo "Criterio de busqueda " . $strBuscar;
			for ($i = 1; $i <= $numIndices; $i++) {
				if(isset($_POST['btnIrA'.$i])){
					iniciarBusqueda($i, $strBuscar);
					break;			
				}
			}
			if(isset($_POST['btnIrAPrimero'])){
				iniciarBusqueda(1, $strBuscar);
			}

			if(isset($_POST['btnIrAUltimo'])){
				iniciarBusqueda($numIndices, $strBuscar);
			}
			
		}

		function iniciarBusqueda($numSeccion, $paramStrBuscar){
			$busqueda = new memestimeBusqueda();
			echo '<input type="hidden" name="strLoQueBusco" value="'. $paramStrBuscar . '" />';
			$cursor = $busqueda->buscar($paramStrBuscar, $numSeccion, $numResultados, $strRespuesta);
			echo "Tenemos " . $numResultados . " coincidencias";
			echo "<table>";
			echo "<tr><th>Nombre</th><th>Subida por</th><th>Enlace</th></tr>";
			foreach ($cursor as $elemento) {
				echo "<tr>";
				echo "<td>" . implode(" ", $elemento["nombreImagen"]) . "</td>";
				echo "<td>" . $elemento["usuario"] . "</td>";
				echo "<td> <a href='image.php?image=".$elemento["_id"]."' >Ver</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			echo '</br>';
			$numIndices = ceil($numResultados/3);
			echo '<input type="hidden" name="numIndices" value= '. $numIndices .' />';
			echo '<button type="submit" id="btnIrAPrimero" name = "btnIrAPrimero">First</button>';
			for ($i = 1; $i <= $numIndices; $i++) {
				echo '<button type="submit" id="btnIrA'. $i .'" name = "btnIrA'.$i.'" value = '.$i.'>'.$i.'</button>';
			}
			echo '<button type="submit" id="btnIrAUltimo" name = "btnIrAUltimo">Last</button>';
		}	

		
	?>
	</form>
</body>
</html>
