<?php

class conexionMongo{
		function insertarRegistro($idUsuario, $nombreImagen, $url){
			try{
				$conexion = new Mongo('localhost');
				$baseDatos = $conexion->selectDB('memestime');
				$coleccion = $baseDatos->selectCollection('imagenes');
				$registro = array(
					'usuario' => $idUsuario,
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

		function buscarRegistro($nombreImagen, $numeroRegistros){
			try{
				$conexion = new Mongo('localhost');
				$baseDatos = $conexion->selectDB('memestime');
				$coleccion = $baseDatos->selectCollection('imagenes');
				$cursor = $coleccion->find(array("nombreImagen" => $nombreImagen))->limit($numeroRegistros)->sort(array("fecha"=> -1));
				return $cursor;

			}catch(MongoConnectionException $e) {
				die("No es posible conectarnos a la base de datos");
			}
			catch(MongoException $e) {
				die('No es posible buscar la informacion');
			}
		}

		function buscarUsuario($idUsuario, $numeroRegistros){
			try{
				$conexion = new Mongo('localhost');
				$baseDatos = $conexion->selectDB('memestime');
				$coleccion = $baseDatos->selectCollection('imagenes');
				$cursor = $coleccion->find(array("usuario" => $idUsuario))->limit($numeroRegistros)->sort(array("fecha"=> -1));
				return $cursor;

			}catch(MongoConnectionException $e) {
				die("No es posible conectarnos a la base de datos");
			}
			catch(MongoException $e) {
				die('No es posible buscar la informacion');
			}
		}
		
		function eliminarRegistro($idObjeto){
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
