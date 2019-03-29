<?php

include 'list-view-all.php';

function del_files($id) { unlink($id); } // Elimino el archivo

function del_json($ext, $input_id) {
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
	}  // Elimino sus datos en el JSON
}

function delete($ext, $file, $input) {
	if (file_exists($file)) {
		del_files($file);
		del_json($ext, intval($input));
		echo 200;
	}
	else {
		echo 404;
	} // Función para ejecutar las funciones de arriba 'del_files() & del_json()'
}

if (!empty($_POST['radio']) && isset($_POST['radio'])) {
	if (!empty($_POST['input']) && isset($_POST['input'])) {
		
		$input = $_POST['input'];
		$option = $_POST['radio'];

		switch ($option) {
			case 'jpg-3':
				$file = "upload/jpg/" . strval($input) . ".jpg";
				delete("jpg", $file, $input);
				break;

			case 'png-3':
				$file = "upload/png/" . strval($input) . ".png";
				delete("png", $file, $input);
				break;

			case 'mp3-3':
				$file = "upload/mp3/" . strval($input) . ".mp3";
				delete("mp3", $file, $input);
				break;

			case 'mp4-3':
				$file = "upload/mp4/" . strval($input) . ".mp4";
				delete("mp4", $file, $input);
				break;

			case 'gif-3':
				$file = "upload/gif/" . strval($input) . ".gif";
				delete("gif", $file, $input);
				break;

			case 'bmp-3':
				$file = "upload/bmp/" . strval($input) . ".bmp";
				delete("bmp", $file, $input);
				break;

			case 'pdf-3':
				$file = "upload/pdf/" . strval($input) . ".pdf";
				delete("pdf", $file, $input);
				break;

			case 'txt-3':
				$file = "upload/txt/" . strval($input) . ".txt";
				delete("txt", $file, $input);
				break;
				
			case 'css-3':
				$file = "upload/css/" . strval($input) . ".css";
				delete("css", $file, $input);
				break;
				
			case 'js-3':
				$file = "upload/js/" . strval($input) . ".js";
				delete("js", $file, $input);
				break;
				
			case 'html-3':
				$file = "upload/html/" . strval($input) . ".html";
				delete("html", $file, $input);
				break;
				
			case 'php-3':
				$file = "upload/php/" . strval($input) . ".php";
				delete("php", $file, $input);
				break;
				
			case 'ogg-3':
				$file = "upload/ogg/" . strval($input) . ".ogg";
				delete("ogg", $file, $input);
				break;
				
			case 'aac-3':
				$file = "upload/aac/" . strval($input) . ".aac";
				delete("aac", $file, $input);
				break;
				
			case 'm4a-3':
				$file = "upload/m4a/" . strval($input) . ".m4a";
				delete("m4a", $file, $input);
				break;
				
			case 'rar-3':
				$file = "upload/rar/" . strval($input) . ".rar";
				delete("rar", $file, $input);
				break;
				
			case 'zip-3':
				$file = "upload/zip/" . strval($input) . ".zip";
				delete("zip", $file, $input);
				break;
				
			case 'flv-3':
				$file = "upload/flv/" . strval($input) . ".flv";
				delete("flv", $file, $input);
				break;
				
			case 'swf-3':
				$file = "upload/swf/" . strval($input) . ".swf";
				delete("swf", $file, $input);
				break;
		}
	}
}
else { echo "Radio no especificado. statusCode: 404"; }

?>