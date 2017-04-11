<?php 
	include('functionscsv.php');
	$addData= new csvfiles();
	$fp = $_FILES['info']['name'];
	$ruta="files/";
	opendir($ruta);
	$destino = $ruta.$_FILES['info']['name'];
	
	if (file_exists($destino)) {
		echo "<script language='JavaScript'> alert('El archivo ya existe, intenta con otro'); window.location='index.php';</script>";
	}else{
		if ($_FILES['info']['type']=="application/vnd.ms-excel"){
			if (copy($_FILES['info']['tmp_name'], $destino)) {
				echo "Se subio Archivo </br>";
				$fp = fopen ($destino,"r");
				$fistline=0;
				while ($data = fgetcsv ($fp, 1000, ",")) {
					$num = count ($data);
					if ($fistline==0) {
						echo "Se omitio la primer linea </br>";
					}else{
						$addData->addInfoCSV($data);
					}
					$fistline++;
				}
			}else{
				echo "Error al subir Archivo";
			}
		}else{
			echo "El tipo de archio seleccionado no esta permitido";
		}

	}
?>