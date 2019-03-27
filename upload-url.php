<?php

include 'upload-local.php';
ini_set('allow_url_include', 'On');
ini_set('max_execution_time', 3600); // Añadimos el máxima de espera de carga a 1h. (3600s)

if (!empty($_POST['url']) && isset($_POST['url'])) {

	$url = $_POST['url'];  // Conseguimos la URL
	$name_file = basename($url);  // Conseguimos el nombre del archivo en línea
	$extention = array_pop(explode(".", $name_file)); // Saca el formato del archivo

	switch ($extention) {
		case 'jpg':
			$name = strval(id_value("upload/jpg/"));
			$id = $name . "." . strval($extention); // Me une los valores en el ID final del archivos
			try {
				file_put_contents('upload/jpg/' . $id, file_get_contents($url));
				add_data($extention, $id, $name, $url);
				echo "El archivo " . $id . " se ha enviado a la nube del servidor local. statusCode: 200";
			} catch (Exception $e) {
				echo "Al parecer hubo un error del tipo: " . strval($e);
			}
			break;
		case 'png':
			$name = strval(id_value("upload/png/"));
			$id = $name . "." . strval($extention); // Me une los valores en el ID final del archivos
			try {
				file_put_contents('upload/png/' . $id, file_get_contents($url));
				add_data($extention, $id, $name, $url);
				echo "El archivo " . $id . " se ha enviado a la nube del servidor local. statusCode: 200";
			} catch (Exception $e) {
				echo "Al parecer hubo un error del tipo: " . strval($e);
			}
			break;
		case 'mp3':
			$name = strval(id_value("upload/mp3/"));
			$id = $name . "." . strval($extention); // Me une los valores en el ID final del archivos
			try {
				file_put_contents('upload/mp3/' . $id, file_get_contents($url));
				add_data($extention, $id, $name, $url);
				echo "El archivo " . $id . " se ha enviado a la nube del servidor local. statusCode: 200";
			} catch (Exception $e) {
				echo "Al parecer hubo un error del tipo: " . strval($e);
			}
			break;
		case 'mp4':
			$name = strval(id_value("upload/mp4/"));
			$id = $name . "." . strval($extention); // Me une los valores en el ID final del archivos
			try {
				file_put_contents('upload/mp4/' . $id, file_get_contents($url));
				add_data($extention, $id, $name, $url);
				echo "El archivo " . $id . " se ha enviado a la nube del servidor local. statusCode: 200";
			} catch (Exception $e) {
				echo "Al parecer hubo un error del tipo: " . strval($e);
			}
			break;

		default: // Archivos que no están en la lista de formatos admitidos
			echo "El archivo tiene un formato que no coincide con nuestra Base de Datos";
			break;
	}
}

else {
	echo "No hay información en el campo URL";
}

?>