<?php

include 'list-view-all.php';

function del_files($id) { unlink($id); } // Elimino el archivo

function del_json($ext, $input_id) {  // Elimino sus datos en el JSON
	// Consigo los datos del JSON a través de una función declarada en 'list-view-all.php'
	$json_files = get_data($ext);

	foreach ($json_files as $key => $value) {

		if (is_object($json_files)) {
			$id = $value;

			foreach ($id as $i => $valor) {
				$defined_id = $valor;

				if ($input_id == $defined_id) {
					unset($json_files->$key);

					$fichero = fopen("JSON/" . $ext . "/data_files.json", "w+");
				    fwrite($fichero, json_encode($json_files));
				    fclose($fichero);
				}
			}
		}
		elseif (is_array($json_files)) {
			$id = $value->id;

			if ($input_id == $id) {
				unset($json_files[$key]);

				$fichero = fopen("JSON/" . $ext . "/data_files.json", "w+");
			    fwrite($fichero, json_encode($json_files));
			    fclose($fichero);
			}
		}
	}  
}

// Función para ejecutar las funciones de arriba 'del_files() & del_json()'

function delete($ext, $input, $ruta, $format) {
	$file = $ruta . strval($input) . $format;
	if (file_exists($file)) {
		del_files($file);
		del_json($ext, intval($input));
		echo 200;
	}
	else { echo 404; } 
}

if (!empty($_POST['radio']) && isset($_POST['radio'])) {
	if (!empty($_POST['input']) && isset($_POST['input'])) {
		
		$input = $_POST['input'];
		$option = $_POST['radio'];

		switch ($option) {
			case 'jpg-3': delete("jpg", $input, "upload/jpg/", ".jpg"); break;
			case 'png-3': delete("png", $input, "upload/png/", ".png"); break;
			case 'mp3-3': delete("mp3", $input, "upload/mp3/", ".mp3"); break;
			case 'mp4-3': delete("mp4", $input, "upload/mp4/", ".mp4"); break;
			case 'gif-3': delete("gif", $input, "upload/gif/", ".gif"); break;
			case 'bmp-3': delete("bmp", $input, "upload/bmp/", ".bmp"); break;
			case 'pdf-3': delete("pdf", $input, "upload/pdf/", ".pdf"); break;
			case 'txt-3': delete("txt", $input, "upload/txt/", ".txt"); break;
			case 'css-3': delete("css", $input, "upload/css/", ".css"); break;
			case 'js-3': delete("js", $input, "upload/js/", ".js"); break;
			case 'html-3': delete("html", $input, "upload/html/", ".html"); break;
			case 'php-3': delete("php", $input, "upload/php/", ".php"); break;
			case 'ogg-3': delete("ogg", $input, "upload/ogg/", ".ogg"); break;
			case 'aac-3': delete("aac", $input, "upload/aac/", ".aac"); break;
			case 'm4a-3': delete("m4a", $input, "upload/m4a/", ".m4a"); break;
			case 'rar-3': delete("rar", $input, "upload/rar/", ".rar"); break;
			case 'zip-3': delete("zip", $input, "upload/zip/", ".zip"); break;
			case 'flv-3': delete("flv", $input, "upload/flv/", ".flv"); break;
			case 'swf-3': delete("swf", $input, "upload/swf/", ".swf"); break;
		}
	}
}
else { echo "Radio no especificado. statusCode: 404"; }

?>