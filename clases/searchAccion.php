<?php
	require_once('Global.php');
	require_once('conexionMongo.php');

	class memestimeBusqueda{
		var $respOk = "Busqueda completada. ";
		var $respError = "Ha ocurrido un error al realizar la busqueda. ";
		function buscar($textoBusqueda, $numSeccion, &$numResultados, &$strRespuesta){		
			$conMongo = new ConexionMongo();
			$numResultados = $conMongo->getConteoColeccionImagenesTotal($textoBusqueda);
			$cursor = $conMongo->buscarRegistro($textoBusqueda, $numSeccion);
			return $cursor;
		}
	}
?>
