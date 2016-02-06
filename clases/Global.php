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

			$this->ftpServer = "192.168.124.189";
			$this->ftpUserName = "ubuntu";
			$this->ftpUserPass = "asdf";
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
