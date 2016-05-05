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
			$this->direccionMongo = "mongodb://192.168.43.44:27017,192.168.43.185:27017/?replicaSet=Memestime";
			$this->DB = "memestime";
			$this->coleccion = "imagenes";

			$this->ftpServer = "192.168.43.15";
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
