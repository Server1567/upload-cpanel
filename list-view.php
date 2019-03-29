<?php

include 'list-view-all.php';

// Función para mostrar los datos en el ListView
function show_data_all($ext, $desde, $hasta) {
	// Consigo los datos del JSON a través de una función declarada en 'list-view-all.php'
	$data = get_data($ext);
	
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
				case 'jpg': show_data_all("jpg", $desde, $hasta); break;
				case 'png': show_data_all("png", $desde, $hasta); break;
				case 'mp3': show_data_all("mp3", $desde, $hasta); break;
				case 'mp4': show_data_all("mp4", $desde, $hasta); break;
				case 'gif': show_data_all("gif", $desde, $hasta); break;
				case 'bmp': show_data_all("bmp", $desde, $hasta); break;
				case 'pdf': show_data_all("pdf", $desde, $hasta); break;
				case 'txt': show_data_all("txt", $desde, $hasta); break;
				case 'css': show_data_all("css", $desde, $hasta); break;
				case 'js': show_data_all("js", $desde, $hasta); break;
				case 'html': show_data_all("html", $desde, $hasta); break;
				case 'php': show_data_all("php", $desde, $hasta); break;
				case 'ogg': show_data_all("ogg", $desde, $hasta); break;
				case 'aac': show_data_all("aac", $desde, $hasta); break;
				case 'm4a': show_data_all("m4a", $desde, $hasta); break;
				case 'rar': show_data_all("rar", $desde, $hasta); break;
				case 'zip': show_data_all("zip", $desde, $hasta); break;
				case 'flv': show_data_all("flv", $desde, $hasta); break;
				case 'swf': show_data_all("swf", $desde, $hasta); break;
			}
		}
		else { echo "SelectFormat NULL. statusCode: 404"; }
	}
}

?>