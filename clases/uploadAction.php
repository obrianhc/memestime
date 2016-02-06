<?php
	
	class memestimeArchivo{
		var $respOk = "Se ha cargado correctamente el archivo con exito";
		var $respError = "Ha ocurrido un error al cargar el archivo";
		
		function upload($nombreUsuario, $nombreOriginal, $nombrePublicado, $tipoArchivo, $tamanhoArchivo, $isset, $nombreTemporal, &$strRespuesta){
			include('Global.php');			
			$global = new G();

			$rutaArchivo = $directorioTmp . $nombreOriginal;
			$datetime = time();
			$nombreMd5 = md5($nombreOriginal);
			
			$rutaArchivoTmp = $global->getDirectorioTmp() . $nombreMd5 . $datetime;

			if($nombrePublicado == ""){
				$strRespuesta = $this->respError . ": Debes de colocar un nombre para tu publicacion";
				return false;
			}

			if($tamanhoArchivo > 10000000){
				$strRespuesta = $this->respError . ": La imagen no debe de pesar más de 10Mbytes";
			}

			if($isset){
				$strRespuesta = $this->respError . ": Debe de subir algo";
				return false;
			}
			
			if($tipoArchivo == 'jpg' || $tipoArchivo == 'jpeg' || $tipoArchivo == 'png' || $tipoArchivo == 'gif'|| $tipoArchivo == 'bmp')
			{
				$rutaArchivoTmp = $rutaArchivoTmp . "." . $tipoArchivo;			
			}else{
				$strRespuesta = $this->respError . ": Formato " . $formatioArchivo . " invalido";
				return false;
			}	


			if (move_uploaded_file($nombreTemporal, $rutaArchivoTmp)) {
				if($this->sendPorFtp($strRespuesta, $nombreMd5 . "." . $tipoArchivo, $rutaArchivoTmp)){
					$strRespuesta = $strRespuesta . " , :)";
				}else{
					$strRespuesta = $strRespuesta . " , :(";
					return false;				
				}
				echo '<img src="ftp://' . $global->getFtpServer() . $nombreMd5 . "." . $tipoArchivo . '">'; 
				/*La imagen ya esta en el servidor ftp, ahora debemos guardar los cambios*/
				return true;
			}else{
				$strRespuesta = $this->respError . ": Inconvenientes en el proceso de subida del archivo no se completo";
				return false;
			}
			

			$strRespuesta = $this->respOk . " " . $rutaArchivoTmp;
			return true;
		}

		function sendPorFtp(&$strRespuesta, $rutaArchivoFtp, $rutaArchivoTmp){
			include('Global.php');			
			$global = new G();
			$conFtp = ftp_connect($global->getFtpServer());
			$loginResultado = ftp_login($conFtp, $global->getFtpUserName(), $global->getFtpUserPass());
			echo "ftp";
			if(ftp_put($conFtp, $rutaArchivoFtp, $rutaArchivoTmp, FTP_BINARY)){
				$strRespuesta = $this->respOk . ": Archivo subido al repositorio";
				return true;
			}else{
				$strRespuesta = $this->respOk . ": Problemas con el servidor de archivos";
				return false;
			}
			return true;
		}
	}
?>
