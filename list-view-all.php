<?php

include 'upload-local.php';

function get_data($type) {
    $json = fopen("JSON/" . $type . "/data_files.json", "rb");
    $data = stream_get_contents($json);
    fclose($json);

    $data_processed = json_decode($data);
    return $data_processed;
}

if (!empty($_POST['radio']) && isset($_POST['radio'])) {
	
	$format = $_POST['radio'];

	switch ($format) {
		case 'jpg-2':
			$data = get_data("jpg"); // Consigue información de la Base de Datos JSON
			$info = array();
			if (empty($data)) {
				echo 404;
			}
			else {				
				foreach ($data as $obj) { // Itera cada dato
					$name = $obj->Nombre; // Retorna el nombre del dato
					$url = $obj->URL;     // Retorna la URL del dato
					$array = array($url, $name);
					array_push($info, $array);
				}
				echo json_encode($info);  // Manda los datos al FrontEnd(JS)
			}
			break;

		case 'png-2':
			$data = get_data("png"); // Consigue información de la Base de Datos JSON
			$info = array();
			if (empty($data)) {
				echo 404;
			}
			else {
				foreach ($data as $obj) { // Itera cada dato
					$name = $obj->Nombre; // Retorna el nombre del dato
					$url = $obj->URL;     // Retorna la URL del dato
					$array = array($url, $name);
					array_push($info, $array);
				}
				echo json_encode($info);  // Manda los datos al FrontEnd(JS)
			}
			break;

		case 'mp3-2':
			$data = get_data("mp3"); // Consigue información de la Base de Datos JSON
			$info = array();
			if (empty($data)) {
				echo 404;
			}
			else {
				foreach ($data as $obj) { // Itera cada dato
					$name = $obj->Nombre; // Retorna el nombre del dato
					$url = $obj->URL;     // Retorna la URL del dato
					$array = array($url, $name);
					array_push($info, $array);
				}
				echo json_encode($info);  // Manda los datos al FrontEnd(JS)
			}
			break;

		case 'mp4-2':
			$data = get_data("mp4"); // Consigue información de la Base de Datos JSON
			$info = array();
			if (empty($data)) {
				echo 404;
			}
			else {
				foreach ($data as $obj) { // Itera cada dato
					$name = $obj->Nombre; // Retorna el nombre del dato
					$url = $obj->URL;     // Retorna la URL del dato
					$array = array($url, $name);
					array_push($info, $array);
				}
				echo json_encode($info);  // Manda los datos al FrontEnd(JS)
			}
			break;
	}

}
else {
	echo "SelectFormat NULL. statusCode: 404";
}

?>