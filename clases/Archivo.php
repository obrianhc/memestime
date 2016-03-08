<?php
require_once('Global.php');
class Archivo{
	public function getArchivos($numeroFicheros){
		if($numeroFicheros==0) return NULL;
		$global = new G();
		try{
			$conexion = new Mongo($global->getDireccionMongo());
			$baseDatos = $conexion->selectDB($global->getDB());
			$coleccion = $baseDatos->selectCollection($global->getColeccion());
			$cursor = $coleccion->find()->limit($numeroFicheros)->sort(array("fecha"=>-1));
			return $cursor;
		} catch(MongoConnectionException $e) {
			die("No es posible conectarnos a la base de datos");
			return NULL;
		}
		catch(MongoException $e) {
			die('No es posible obtener la informacion');
			return NULL;
		}
	}
	public function getArchivo($id){
		if($id==0) return NULL;
		$global = new G();
		try{
			$conexion = new Mongo($global->getDireccionMongo());
			$baseDatos = $conexion->selectDB($global->getDB());
			$coleccion = $baseDatos->selectCollection($global->getColeccion());
			$cursor = $coleccion->find(array("_id"=>new MongoId("$id")));
			return $cursor;
		} catch(MongoConnectionException $e) {
			die("No es posible conectarnos a la base de datos");
			return NULL;
		}
		catch(MongoException $e) {
			die('No es posible obtener la informacion');
			return NULL;
		}
	}
}
?>
