<?php
class eliminarContenido{
	private $respOk;
	private $respError;

	public function __construct(){
		$this->respOk = "Se ha eliminado el archivo con exito";
		$this->respError = "Ha ocurrido un error al eliminar el archivo";
	}
	
	public function eliminarArchivo($idObjeto, $rutaArchivoFtp, &$strRespuesta){			
		require_once('conexionMongo.php');
		$conMongo = new conexionMongo();
		if($conMongo->eliminarRegistro($idObjeto)){
			if($this->eliminarDeFtp($strRespuesta, $rutaArchivoFtp)){
				$strRespuesta = $strRespuesta . " , :)";
				return true;
			} else {
				return false;
			}			
		}else{
			$strRespuesta = $strRespuesta . " , :(";
			return false;				
		}
		return true;
	}

	public function eliminarDeFtp(&$strRespuesta, $rutaArchivoFtp){
		require_once('Global.php');
		$global = new G();
		$conFtp = ftp_connect($global->getFtpServer()) or die ("Error de conexion");
		$loginResultado = ftp_login($conFtp, $global->getFtpUserName(), $global->getFtpUserPass()) or die ("Error de login");
		if(!$conFtp || !$loginResultado){
			die("La conexión a servido ftp no funciono!!");
		} else {
			ftp_chmod($conFtp, 0777, $rutaArchivoFtp);
		}
		if(ftp_delete($conFtp, $rutaArchivoFtp)){
			$strRespuesta = $this->respOk . ": Archivo eliminado del repositorio!";
			ftp_close($conFtp);
			return true;
		}else{
			$strRespuesta = $this->respError . ": Problemas con el servidor de archivos";
			ftp_close($conFtp);
			return false;
		}
	}
}
?>
