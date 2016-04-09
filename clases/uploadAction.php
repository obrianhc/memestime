<?php
	require_once('conexionMongo.php');
	class memestimeArchivo{
		var $respOk = "Se ha cargado correctamente el archivo con exito. ";
		var $respError = "Ha ocurrido un error al cargar el archivo. ";

		function upload($nombreUsuario, $nombreOriginal, $nombrePublicado, $tipoArchivo, $tamanhoArchivo, $isset, $nombreTemporal, &$strRespuesta){			
			require_once('Global.php');
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
			/*
			$conMongo = new ConexionMongo();
			$conMongo->insertarRegistro($nombreUsuario, trim($nombrePublicado), $global->getFtpServer() . "/files/" . $nombreMd5 . "." . $tipoArchivo);
			$strRespuesta = $this->respOk . ", :)" . $nombreUsuario;
			return true;
			*/
			
			echo "files/".$nombreMd5 . "." . $tipoArchivo.'  '.$rutaArchivoTmp;
			if (move_uploaded_file($nombreTemporal, $rutaArchivoTmp)) {
				if($this->sendPorFtp($strRespuesta, "files/".$nombreMd5 . "." . $tipoArchivo, $rutaArchivoTmp)){
					$conMongo = new ConexionMongo();
					$conMongo->insertarRegistro($nombreUsuario, trim($nombrePublicado), $global->getFtpServer() .'/files/'. $nombreMd5 . "." . $tipoArchivo);
					$strRespuesta = $strRespuesta . " , :)";
				}else{
					$strRespuesta = $this->respError . ", :(";
					return false;				
				}
				echo '<img src="ftp://' . $global->getFtpServer() ."/files/". $nombreMd5 . "." . $tipoArchivo . '">'; 
				//La imagen ya esta en el servidor ftp, ahora debemos guardar los cambios
				return true;
			}else{
				$strRespuesta = $this->respError . ": Inconvenientes en el proceso de subida del archivo no se completo";
				return false;
			}
			

			$strRespuesta = $this->respOk . " " . $rutaArchivoTmp;
			return true;
		}

		function sendPorFtp(&$strRespuesta, $rutaArchivoFtp, $rutaArchivoTmp){
			require_once('Global.php');	
			$global = new G();
			$conFtp = ftp_connect($global->getFtpServer()) or die ("Error de conexion");
			$loginResultado = ftp_login($conFtp, $global->getFtpUserName(), $global->getFtpUserPass()) or die ("Error de login");

			if(!$conFtp || !$loginResultado){
				die("La conexión a servido ftp no funciono!!");
			}
			if(ftp_put($conFtp, $rutaArchivoFtp, $rutaArchivoTmp, FTP_BINARY)){
				$strRespuesta = $this->respOk . ": Archivo subido al repositorio";
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
