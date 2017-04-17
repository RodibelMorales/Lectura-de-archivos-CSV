<?php 
	//Archivo contenedor de la clase encargada de procesar el insert a la DB 
		include('functionscsv.php');
	//Se crea una nueva instancia a para la clase
		$addData= new csvfiles();

	//Validamos si se envia informacion mediante POST en caso contrario redirigimos al formulario
		if($_FILES){
			//Optenemos el nombre del archivo agregado
			$nameFile = $_FILES['info']['name'];
			//Definimos la ruta al cual será enviado el archivo 
			$ruta="files/";
			//Abrimos la ruta
			opendir($ruta);
			//Indicamos la ruta con el nombre del archivo
			$destino = $ruta.$nameFile;
			//Verificamos si el archivo existe en el servidor de ser el resultado TRUE indicamos al usario que existe y lo redirigimos al index. 
			//if (file_exists($destino)) {
				//echo "<script language='JavaScript'> alert('El archivo ya existe, intenta con otro'); window.location='index.php';</script>";
			//}else{
				//Si el archivo no existe procedemos a validar el tipo de archivo a subir
				if ($_FILES['info']['type']=="application/vnd.ms-excel"){
					//Si es el tipo de arhico permitido lo copiamos al servidor
					if (copy($_FILES['info']['tmp_name'], $destino)) {
						echo "Se subio Archivo </br>";
						//Optenemos el archivo para lectura
						$GetFile= fopen ($destino,"r");
						//Variable definida para omitir la primer fila de datos
						$fistline=0;

						//Iniciamos un while para leer los datos poder guardalos en la DB
						while ($data = fgetcsv ($GetFile, 1000, ",")) {
							//Contamos el numero de arrays que contiene el archivo CSV
							$num = count ($data);
							//Validamos si es la primer columna para omitirla
							if ($fistline==0) {
								echo "Se omitio la primer linea </br>";
							}else{
								/*Limpieza de campos*/
								$find = array('/[()-]/', '/[\-]+/', '/&lt;{^&gt;*&gt;/');
 								$repl = array('', '-', '');
								$datos=preg_replace($find, $repl,$data);
								/*validacion de correo electronico*/
								if(filter_var($datos[5], FILTER_VALIDATE_EMAIL)){
									$info="'".$datos[0]."','".$datos[1]."','".$datos[2]."','".$datos[3]."','".$datos[4]."','".$datos[5]."',
									  '".$datos[6]."','".$datos[7]."','".$datos[8]."','".$datos[9]."','".$datos[10]."','".$datos[11]."',
									  '".$datos[12]."','".$datos[13]."','".$datos[14]."','".$datos[15]."','".$datos[16]."','".$datos[17]."',
									  '".$datos[18]."','".$datos[19]."','".$datos[20]."','".$datos[21]."','".$datos[22]."','".$datos[23]."',
									  '".$datos[24]."','".$datos[25]."','".$datos[26]."','".$datos[27]."','".$datos[28]."','".$datos[29]."',
									  '".$datos[30]."'";
									  $addData->addInfoCSV($info);
									if ($datos[2]=='') {
										echo "El campo contact_name esta vacio </br>";
										if($datos[3]==''){
											echo "el campo first name vacio </br>";
										}elseif ($datos[4]=='') {
											echo "el campo contact_lastName </br>";
										}else{
											$info="'".$datos[0]."','".$datos[1]."','".$datos[2]."','".$datos[3]."','".$datos[4]."','".$datos[5]."',
										  	'".$datos[6]."','".$datos[7]."','".$datos[8]."','".$datos[9]."','".$datos[10]."','".$datos[11]."',
										 	 '".$datos[12]."','".$datos[13]."','".$datos[14]."','".$datos[15]."','".$datos[16]."','".$datos[17]."',
										 	 '".$datos[18]."','".$datos[19]."','".$datos[20]."','".$datos[21]."','".$datos[22]."','".$datos[23]."',
										  	'".$datos[24]."','".$datos[25]."','".$datos[26]."','".$datos[27]."','".$datos[28]."','".$datos[29]."',
										  	'".$datos[30]."'";
									  		$addData->addInfoCSV($info);
										}
									}
								}else{
									echo "Upss el correo no es valido </br>";
									echo "-------------------------------> </br>";
								}
								//En caso contrario enviamos la información a la funcion para poder insertarla en la DB
								//$addData->addInfoCSV($sql);
								
							}
							//Contador
							$fistline++;
						}
					}else{
						echo "Error al subir Archivo";
					}
				}else{
					echo "El tipo de archio seleccionado no esta permitido";
				}
			//}
		}else{
			header("Location:index.php");
		}
?>