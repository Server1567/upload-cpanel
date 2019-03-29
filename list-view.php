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
function show_data($data, $desde, $hasta) {
	$info = array();
	settype($data, "array");
	if (empty($data)) {
		echo False;
	}
	else {				
		foreach ($data as $obj) { // Itera cada dato
			$name = $obj->Nombre; // Retorna el nombre del dato
			$url = $obj->URL;     // Retorna la URL del dato
			$id = $obj->id;	      // Consigue el ID del archivo

			if ($id >= intval($desde) && $id <= intval($hasta)) {
				$array = array($url, $name);
				array_push($info, $array);
			}
		}
		echo json_encode($info);  // Manda los datos al FrontEnd(JS)
	}
}

if (!empty($_POST['desde']) && isset($_POST['desde'])) {
	if (!empty($_POST['hasta']) && isset($_POST['hasta'])) {
		if (!empty($_POST['radio']) && isset($_POST['radio'])) {
			
			$desde = $_POST['desde'];
			$hasta = $_POST['hasta'];
			$format = $_POST['radio'];

			switch ($format) {
				case 'jpg':
					$data = get_data("jpg"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'png':
					$data = get_data("png"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'mp3':
					$data = get_data("mp3"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'mp4':
					$data = get_data("mp4"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'gif':
					$data = get_data("gif"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'bmp':
					$data = get_data("bmp"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'pdf':
					$data = get_data("pdf"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'txt':
					$data = get_data("txt"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'css':
					$data = get_data("css"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'js':
					$data = get_data("js"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'html':
					$data = get_data("html"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'php':
					$data = get_data("php"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'ogg':
					$data = get_data("ogg"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'aac':
					$data = get_data("aac"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'm4a':
					$data = get_data("m4a"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'rar':
					$data = get_data("rar"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'zip':
					$data = get_data("zip"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'flv':
					$data = get_data("flv"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;

				case 'swf':
					$data = get_data("swf"); // Consigue información de la Base de Datos JSON
					show_data($data, $desde, $hasta);
					break;
			}
		}
		else { echo "SelectFormat NULL. statusCode: 404"; }
	}
}

?>