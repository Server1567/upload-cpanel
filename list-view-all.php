<?php

// Función para obtener los datos del archivo JSON
function get_data($type) {
    $json = fopen("JSON/" . $type . "/data_files.json", "rb");
    $data = stream_get_contents($json);
    fclose($json);

    $data_processed = json_decode($data);
    return $data_processed;
}

// Función para mostrar los datos en el ListView
function show_data($ext) {
	$data = get_data($ext); // Consigue información de la Base de Datos JSON
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
		case 'jpg-2': show_data("jpg"); break;
		case 'png-2': show_data("png"); break;
		case 'mp3-2': show_data("mp3"); break;
		case 'mp4-2': show_data("mp4"); break;
		case 'gif-2': show_data("gif"); break;
		case 'bmp-2': show_data("bmp"); break;
		case 'pdf-2': show_data("pdf"); break;
		case 'txt-2': show_data("txt"); break;
		case 'css-2': show_data("css"); break;
		case 'js-2': show_data("js"); break;
		case 'html-2': show_data("html"); break;
		case 'php-2': show_data("php"); break;
		case 'ogg-2': show_data("ogg"); break;
		case 'aac-2': show_data("aac"); break;
		case 'm4a-2': show_data("m4a"); break;
		case 'rar-2': show_data("rar"); break;
		case 'zip-2': show_data("zip"); break;
		case 'flv-2': show_data("flv"); break;
		case 'swf-2': show_data("swf"); break;
	}
}
else { echo "SelectFormat NULL. statusCode: 404"; }

?>