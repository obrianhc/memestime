<?php
class testUpload{

		function upload($tipoImagen, $nombreMeme, $nombreUsuario){
			// Datos pertinentes al archivo para subir
			$md5NombreImagen = md5($nombreMeme . time());
			$url = "images.memestime.com/". $md5NombreImagen . '.' . $tipoImagen;
			// Verificamos que realmente subiremos un archivo
			if(!$isset){
				return false;
			}
			// Ahora subiremos el archivo
			if (move_uploaded_file($tempname, $target_file)) {
				$status = $this->insert_file($nombreUsuario, $nombreMeme, $url);
				if($status)
		        	return true;
		        else
		        	return false;
		    } else {
		    	return false;
		    }
		}

		function insert_file($nombreUsuario, $nombreMeme, $url){

			$conexion = new Mongo('192.168.122.188');
			$baseDatos = $conexion->selectDB('memestime');
			$coleccion = $baseDatos->selectCollection('imagenes');
			$registro = array(
				'usuario' => $nombreUsuario,
				'nombreImagen' => $nombreMeme,
				'fecha' => new MongoDate(),
				'url' => $url
			);
			$resultado = $coleccion->insert($registro) 
				or die ('Error insertando registro en mongodb');
			if($resultado)
				return true;
			else
				return false;
		}
	}
?>
