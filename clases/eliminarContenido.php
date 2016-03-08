<?php
	require_once('Global.php');
	require_once('conexionMongo.php');

	class eliminarContenido{
		var $respOk = "Se ha eliminado el archivo con exito";
		var $respError = "Ha ocurrido un error al eliminar el archivo";

		function eliminarArchivo($idObjeto, $rutaArchivoFtp, &strRespuesta){			

			if($this->eliminarDeFtp($strRespuesta, $rutaArchivoFtp)){
				$conMongo = new ConexionMongo();
				$conMongo->eliminarRegistro($idObjeto);
				$strRespuesta = $strRespuesta . " , :)";
			}else{
				$strRespuesta = $strRespuesta . " , :(";
				return false;				
			}
			return true;
		}

		function eliminarDeFtp(&$strRespuesta, $rutaArchivoFtp){		
			$global = new G();
			$conFtp = ftp_connect($global->getFtpServer()) or die ("Error de conexion");
			$loginResultado = ftp_login($conFtp, $global->getFtpUserName(), $global->getFtpUserPass()) or die ("Error de login");

			if(!$conFtp || !$loginResultado){
				die("La conexión a servido ftp no funciono!!");
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
