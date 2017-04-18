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
				public function addInfoCSV($sql,$correo){
					$getinfoRegistro  = mysqli_query($this->conectaDB,"SELECT contact_email FROM infocsv WHERE contact_email='".$correo."'");
					$verificaRegistro = mysqli_num_rows($getinfoRegistro);
					if ($verificaRegistro > 0) {
						echo "Ya existe un registro con este mail </br>";
					}else{
						$saveinfo=mysqli_query($this->conectaDB,"INSERT INTO infocsv (request_id,contact_sessionId,contact_name,contact_firstName,contact_lastName,contact_email,contact_phone,contact_message,contact_pageHistory,contact_areaProperty,contact_typeProperty,contact_locationProperty,contact_rangeProperty,contact_mls,contact_mlsUrl,contact_mlsAgent,contact_pdfCode,request_name,request_channel,request_channelDetail,request_source,request_url,request_page,request_date,request_status,request_persona,request_asignedTo,request_attended,request_idioma,request_optin1,request_optin2) VALUES ($sql) ");
						if ($saveinfo) {
							echo "Listo </br>";
							echo "---------> </br>";
						}else{
							echo "Error al guardar informacion : </br> INSERT INTO infocsv (request_id,contact_sessionId,contact_name,contact_firstName,contact_lastName,contact_email,contact_phone,contact_message,contact_pageHistory,contact_areaProperty,contact_typeProperty,contact_locationProperty,contact_rangeProperty,contact_mls,contact_mlsUrl,contact_mlsAgent,contact_pdfCode,request_name,request_channel,request_channelDetail,request_source,request_url,request_page,request_date,request_status,request_persona,request_asignedTo,request_attended,request_idioma,request_optin1,request_optin2) VALUES ($sql)";
						}
					}
				}
			public function __destruct(){
				mysqli_close($this->conectaDB);
			}
	}

?>