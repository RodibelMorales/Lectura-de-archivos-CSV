<?php 
	/**
	* Clase que se encargara de conectar a la DB, leer el archivo cvs, validar datos y de almacenarlos en la base de datos
	*/
	class csvfiles
	{
		private $conectaDB;
			
			public function __construct(){
				$this->conectaDB=mysqli_connect("localhost","root","","db_csv");
			}
				public function addInfoCSV($data){
					echo "<pre>";
						print_r($data);
					echo "</prep>";
				}
			public function __destruct(){
				mysqli_close($this->conectaDB);
			}
	}

?>