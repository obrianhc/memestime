<?php
require_once('Archivo.php');
class testArchivo extends PHPUnit_Framework_TestCase{
	public function testGetArchivos(){
		$archivo = new Archivo();
		$this->assertNotNull($archivo->getArchivos(3));
	}

	public function testGetArchivo(){
		$archivo = new Archivo();
		$this->assertNotNull($archivo->getArchivo('56b574676803fabb038b4567'));
	}
}
?>
