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
								$find = array('/[()-]/', '/[\-]+/', '/&lt;{^&gt;*&gt;/');
 								$repl = array('', '-', '');
								$datos=preg_replace($find, $repl,$data);
								$info="'".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."',
									  '".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."',
									  '".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."',
									  '".$data[18]."','".$data[19]."','".$data[20]."','".$data[21]."','".$data[22]."','".$data[23]."',
									  '".$data[24]."','".$data[25]."','".$data[26]."','".$data[27]."','".$data[28]."','".$data[29]."',
									  '".$data[30]."'";
								
								echo "<pre>";
									print_r($datos);
								echo "</pre>";
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