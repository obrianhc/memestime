<?php
	class G{
		private $directorioTmp;
		private $direccionMongo;
		private $ftpServer;
		private $ftpUserName;
		private $ftpUserPass;

		function __construct(){
			$this->directorioTmp = "tmp/";
			$this->direccionMongo = "192.168.122.188";

			$this->ftpServer = "192.168.124.189";
			$this->ftpUserName = "anonymous";
			$this->ftpUserPass = "";
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
