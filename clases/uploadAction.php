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
				$strRespuesta = '<div class="alert alert-danger">'
							.$this->respError 
							.": Debes de colocar un nombre para tu publicacion"
							.'</div>';
				return false;
			}

			if($tamanhoArchivo > 10000000){
				$strRespuesta = '<div class="alert alert-danger">'
							.$this->respError
							.": La imagen no debe de pesar más de 10MB"
							.'</div>';
			}

			if($isset){
				$strRespuesta = '<div class="alert alert-danger">'
							.$this->respError 
							.": Debe seleccionar subir algo"
							.'</div>';
				return false;
			}
			
			if($tipoArchivo == 'jpg' || $tipoArchivo == 'jpeg' || $tipoArchivo == 'png' || $tipoArchivo == 'gif'|| $tipoArchivo == 'bmp')
			{
				$rutaArchivoTmp = $rutaArchivoTmp . "." . $tipoArchivo;			
			}else{
				$strRespuesta = '<div class="alert alert-danger">'
							.$this->respError
							.": Formato "
							.$formatioArchivo
							." invalido"
							.'</div>';
				return false;
			}	
			if (move_uploaded_file($nombreTemporal, $rutaArchivoTmp)) {
				if($this->sendPorFtp($strRespuesta, "/files/" . $nombreMd5 . "." . $tipoArchivo, $rutaArchivoTmp)){
					$conMongo = new ConexionMongo();
					$conMongo->insertarRegistro($nombreUsuario, trim($nombrePublicado), $nombreMd5 . "." . $tipoArchivo);
					$strRespuesta = '<div class="alert alert-success">'
								.$strRespuesta
								.'</div>';
				}else{
					$strRespuesta = '<div class="alert alert-danger">'
								.$this->respError
								.'</div>';
					return false;				
				}
				echo '<img class="img-responsive" src="http://' . $global->getFtpServer() ."/". $nombreMd5 . "." . $tipoArchivo . '">'; 
				//La imagen ya esta en el servidor ftp, ahora debemos guardar los cambios
				return true;
			}else{
				$strRespuesta = '<div class="alert alert-danger">'
							.$this->respError
							.": Inconvenientes en el proceso de subida del archivo no se completo"
							.'</div>';
				return false;
			}
			

			$strRespuesta = '<div class="alert alert-info">'
						.$this->respOk
						." " 
						.$rutaArchivoTmp
						.'</div>';
			return true;
		}

		function sendPorFtp(&$strRespuesta, $rutaArchivoFtp, $rutaArchivoTmp){
			require_once('Global.php');	
			$global = new G();
			$conFtp = ftp_connect($global->getFtpServer()) or die ("Error de conexion servidor de archivos");
			$loginResultado = ftp_login($conFtp, $global->getFtpUserName(), $global->getFtpUserPass()) or die ("Error de login");

			if(!$conFtp || !$loginResultado){
				die("La conexión a servido ftp no funciono!!");
			}
			if(ftp_put($conFtp, $rutaArchivoFtp, $rutaArchivoTmp, FTP_BINARY)){
				ftp_chmod($conFtp, 0775, $rutaArchivoFtp);
				$strRespuesta = $this->respOk
							.": Archivo subido al repositorio";
				ftp_close($conFtp);
				return true;
			}else{
				$strRespuesta = $this->respError
							.": Problemas con el servidor de archivos";
				ftp_close($conFtp);
				return false;
			}
		}
	}
?>
