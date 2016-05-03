<?php
	class G{
		private $directorioTmp;
		private $direccionMongo;
		private $ftpServer;
		private $ftpUserName;
		private $ftpUserPass;
		private $DB;
		private $coleccion;
		function __construct(){
			$this->directorioTmp = "tmp/";
			$this->direccionMongo = "127.0.0.1";
			$this->DB = "memestime";
			$this->coleccion = "imagenes";

			$this->ftpServer = "192.168.1.46";
			$this->ftpUserName = "ubuntu";
			$this->ftpUserPass = "asdf";
		}
		function getDB(){
			return $this->DB;
		}
		function getColeccion(){
			return $this->coleccion;
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
