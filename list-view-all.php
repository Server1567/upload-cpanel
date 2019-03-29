<?php

include 'upload-local.php';

// Función para obtener los datos del archivo JSON
function get_data($type) {
    $json = fopen("JSON/" . $type . "/data_files.json", "rb");
    $data = stream_get_contents($json);
    fclose($json);

    $data_processed = json_decode($data);
    return $data_processed;
}

// Función para mostrar los datos en el ListView
function show_data($data) {
	$info = array();
	settype($data, "array");
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
}


if (!empty($_POST['radio']) && isset($_POST['radio'])) {
	
	$format = $_POST['radio'];

	switch ($format) {
		case 'jpg-2':
			$data = get_data("jpg"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'png-2':
			$data = get_data("png"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'mp3-2':
			$data = get_data("mp3"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'mp4-2':
			$data = get_data("mp4"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'gif-2':
			$data = get_data("gif"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'bmp-2':
			$data = get_data("bmp"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'pdf-2':
			$data = get_data("pdf"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'txt-2':
			$data = get_data("txt"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'css-2':
			$data = get_data("css"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'js-2':
			$data = get_data("js"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'html-2':
			$data = get_data("html"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'php-2':
			$data = get_data("php"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'ogg-2':
			$data = get_data("ogg"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'aac-2':
			$data = get_data("aac"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'm4a-2':
			$data = get_data("m4a"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'rar-2':
			$data = get_data("rar"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'zip-2':
			$data = get_data("zip"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'flv-2':
			$data = get_data("flv"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;

		case 'swf-2':
			$data = get_data("swf"); // Consigue información de la Base de Datos JSON
			show_data($data);
			break;
	}

}
else { echo "SelectFormat NULL. statusCode: 404"; }

?>