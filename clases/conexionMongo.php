<?php

class conexionMongo{
		function insertarRegistro($idUsuario, $nombreImagen, $url){//cambio de parametro $idUsuario por $id_Usuario
			try{
				$conexion = new Mongo('localhost');
				$baseDatos = $conexion->selectDB('memestime');
				$coleccion = $baseDatos->selectCollection('imagenes');
				$registro = array(
					'usuario' => $id_Usuario,
					'nombreImagen' => $nombreImagen,
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

		function buscarRegistro($nombreImagen, $numeroRegistros){//cambio de parametro $nombreImagen por $nombre_Imagen
			try{
				$conexion = new Mongo('localhost');
				$baseDatos = $conexion->selectDB('memestime');
				$coleccion = $baseDatos->selectCollection('imagenes');
				$cursor = $coleccion->find(array("nombreImagen" => $nombre_Imagen))->limit($numeroRegistros)->sort(array("fecha"=> -1));
				return $cursor;

			}catch(MongoConnectionException $e) {
				die("No es posible conectarnos a la base de datos");
			}
			catch(MongoException $e) {
				die('No es posible buscar la informacion');
			}
		}

		function buscarUsuario($idUsuario, $numeroRegistros){//cambio de parametro $numeroRegistros por $numero_Registros
			try{
				$conexion = new Mongo('localhost');
				$baseDatos = $conexion->selectDB('memestime');
				$coleccion = $baseDatos->selectCollection('imagenes');
				$cursor = $coleccion->find(array("usuario" => $idUsuario))->limit($numero_Registros)->sort(array("fecha"=> -1));
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
				$conexion = new Mongo('localhost');
				$baseDatos = $conexion->selectDB('memestime');
				$coleccion = $baseDatos->selectCollection('imagenes');
				return $coleccion->remove(array("_id"=>$idObjeto));

			}catch(MongoConnectionException $e) {
				die("No es posible conectarnos a la base de datos");
			}
			catch(MongoException $e) {
				die('No es posible eliminar la informacion');
			}
		}		
}
?>
