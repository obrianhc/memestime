<?php
	class G{
		private $directorioTmp;
		private $direccionMongo;
		private $ftpServer;
		private $ftpUserName;
		private $ftpUserPass;

		function __construct(){
			$this->directorioTmp = "tmp/";
			$this->direccionMongo = "172.0.0.1";

			$this->ftpServer = "ftp://192.168.124.189/files";
			$this->ftpUserName = "anonymous";
			$this->ftpUserPass = "user@example.com";
		}

		function getDirectorioTmp(){
			return $this->directorioTmp;
		}
		function getDireccionMongo(){
			return $this->direccionMongo;
		}
		
		function getFtpServer(){
			return $this->ftpServer;	
		}
		function getFtpUserName(){
			return $this->ftpUserName;	
		}
		function getFtpUserPass(){
			return $this->ftpUserPass;	
		}


	}			
?>
