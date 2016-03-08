<?php
	require_once 'searchAccion.php';

class testSearchAccion extends PHPUnit_Framework_TestCase{

	public function testBuscarNull(){
		$respuesta = new memestimeBusqueda();
		$criterioBusqueda = "celulares";
		$numSeccion = 1;
		$numResultados = 0;
		$strRespuesta = "todo esta bien";
		$cursor = $respuesta->buscar($criterioBusqueda,$numSeccion, $numResultados, $strRespuesta);
		$this->assertNotNull($cursor);		
	
	}
}
?>
