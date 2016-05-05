<?php

class conexionMongo{
		function insertarRegistro($idUsuario, $nombreImagen, $url){//cambio de parametro $idUsuario por $id_Usuario
			try{
				require_once('Global.php');
				$g = new G();
				$conexion = new MongoClient($g->getDireccionMongo());
				$baseDatos = $conexion->selectDB($g->getDB());
				$coleccion = $baseDatos->selectCollection($g->getColeccion());
				$listadoNombreImagen = preg_split("/[\s]+/", trim($nombreImagen), NULL, PREG_SPLIT_NO_EMPTY);
				
				$registro = array(
					'usuario' => $idUsuario,
					'nombreImagen' => $listadoNombreImagen,
					'fecha' => new MongoDate(),
					'url' => $url
				);
				return $coleccion->insert($registro);

			}catch(MongoConnectionException $e) {
				die("No es posible conectarnos a la base de datos");
			}
			catch(MongoException $e) {
				die('No es posible almacenar la informacion');
			}
		}

		function buscarRegistro($nombreImagen, $numSeccion){//cambio de parametro $nombreImagen por $nombre_Imagen
			try{
				require_once('Global.php');
				$g = new G();
				$conexion = new MongoClient($g->getDireccionMongo());
				$baseDatos = $conexion->selectDB($g->getDB());
				$coleccion = $baseDatos->selectCollection($g->getColeccion());
				$listadoNombreImagen = preg_split("/[\s]+/", trim($nombreImagen), NULL, PREG_SPLIT_NO_EMPTY);
				if(empty($listadoNombreImagen)){
					$cursor = $coleccion->find()->limit(3)->skip(($numSeccion-1)*3);
					return $cursor;
				}
				$listadoNombreImagenRegex = array();
				foreach($listadoNombreImagen as $elemento){
					$listadoNombreImagenRegex[] = new MongoRegex("/^". $elemento ."/i");
				}
				$criterioBusqueda = array("nombreImagen"=>array('$in' => $listadoNombreImagenRegex));
				$cursor = $coleccion->find($criterioBusqueda)->limit(3)->skip(($numSeccion-1)*3);
				return $cursor;

			}catch(MongoConnectionException $e) {
				die("No es posible conectarnos a la base de datos");
			}
			catch(MongoException $e) {
				die('No es posible buscar la informacion');
			}
		}

		function getConteoColeccionImagenesTotal($nombreImagen){
			try{
				require_once('Global.php');
				$g = new G();
				$conexion = new MongoClient($g->getDireccionMongo());
				$baseDatos = $conexion->selectDB($g->getDB());
				$coleccion = $baseDatos->selectCollection($g->getColeccion());
				$listadoNombreImagen = preg_split("/[\s]+/", trim($nombreImagen), NULL, PREG_SPLIT_NO_EMPTY);
				if(empty($listadoNombreImagen)){
					$cursor = $coleccion->count();
					return $cursor;
				}
				$listadoNombreImagenRegex = array();
				foreach($listadoNombreImagen as $elemento){
					$listadoNombreImagenRegex[] = new MongoRegex("/^". $elemento ."/");
				}
				if(count($listadoNombreImagenRegex)==0)
					$listadoNombreImagenRegex = "";
				$criterioBusqueda = array("nombreImagen"=>array('$in' => $listadoNombreImagenRegex));
				$total = $coleccion->find($criterioBusqueda)->count();
				return $total;

			}catch(MongoConnectionException $e) {
				die("No es posible conectarnos a la base de datos");
			}
			catch(MongoException $e) {
				die('No es posible buscar la informacion');
			}
		}

		

		function buscarUsuario($idUsuario, $numeroRegistros){//cambio de parametro $numeroRegistros por $numero_Registros
			try{
				require_once('Global.php');
				$g = new G();
				$conexion = new MongoClient($g->getDireccionMongo());
				$baseDatos = $conexion->selectDB($g->getDB());
				$coleccion = $baseDatos->selectCollection($g->getColeccion());
				$cursor = $coleccion->find(array("usuario" => $idUsuario))->limit($numeroRegistros)->sort(array("fecha"=> -1));
				return $cursor;

			}catch(MongoConnectionException $e) {
				die("No es posible conectarnos a la base de datos");
			}
			catch(MongoException $e) {
				die('No es posible buscar la informacion');
			}
		}
		
		function eliminarRegistro($idObjeto){//cambio de parametro $idObjeto por $id_Objeto
			try{
				require_once('Global.php');
				$g = new G();
				$conexion = new MongoClient($g->getDireccionMongo());
				$baseDatos = $conexion->selectDB($g->getDB());
				$coleccion = $baseDatos->selectCollection($g->getColeccion());
				return $coleccion->remove(array("_id"=>new MongoId("$idObjeto")));

			}catch(MongoConnectionException $e) {
				die("No es posible conectarnos a la base de datos");
			}
			catch(MongoException $e) {
				die('No es posible eliminar la informacion');
			}
		}		
}
?>
