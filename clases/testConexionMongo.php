<?php

require_once 'conexionMongo.php';
class testConexionMongo extends PHPUnit_Framework_TestCase{

	public function testInsertarRegistroTrue(){
		$conexion = new conexionMongo();
		$respuesta = $conexion->insertarRegistro("testUser","testImage","images.memestime.com/abc124.jpg");//este es un metodo que inserta un registro de imagen en la base de datos, utiliza los parametro idUsuario, nombreImagen, url
		$this->assertTrue($respuesta);		
	
	}

	public function testBuscarRegistroNotNull(){
		$conexion = new conexionMongo();
		$respuesta = $conexion->buscarRegistro("testImage",5);//este es un metodo que busca un registro de imagen en la base de datos, utiliza los parametro nombreImagen y numeroRegistros
		$this->assertNotNull($respuesta);		
	
	}

	public function testBuscarRegistroNull(){
		$conexion = new conexionMongo();
		$respuesta = $conexion->buscarRegistro("testImage2",5);//este es un metodo que busca un registro de imagen en la base de datos, utiliza los parametro nombreImagen y numeroRegistros
		$this->assertNotNull($respuesta);		
	
	}

	public function testBuscarUsuarioNotNull(){
		$conexion = new conexionMongo();
		$respuesta = $conexion->buscarUsuario("testUser",5);//este es un metodo que busca un usuario en la base de datos, utiliza los parametro nombreImagen y numeroRegistros
		$this->assertNotNull($respuesta);		
	
	}

	public function testBuscarUsuarioNull(){
		$conexion = new conexionMongo();
		$respuesta = $conexion->buscarUsuario("testUser2",5);//este es un metodo que busca un usuario en la base de datos, utiliza los parametro nombreImagen y numeroRegistros
		$this->assertNotNull($respuesta);		
	
	}

	public function testEliminarRegistroTrue(){
		$conexionA = new conexionMongo();
		try{
			$conexionA = new Mongo('localhost');
			$baseDatosA = $conexionA->selectDB('memestime');
			$coleccionA = $baseDatosA->selectCollection('imagenes');
			$registroA = array(
				'_id' => new MongoId("4f626fdf1771a8e71a000000"),
				'usuario' => "testUserX",
				'nombreImagen' => "testImageX",
				'fecha' => new MongoDate(),
				'url' => "images.memestime.com/abc1234.jpg"
			);
			return $coleccionA->insert($registroA);

		}catch(MongoConnectionException $e) {
			die("No es posible conectarnos a la base de datos");
		}
		catch(MongoException $e) {
			die('No es posible almacenar la informacion');
		}
		$respuesta = $conexion->eliminarRegistro("4f626fdf1771a8e71a000000");//este es un metodo que elimina un registro de imagen en la base de datos, utiliza los parametro idObjeto
		$this->assertTrue($respuesta);		
	
	}

}

?>
