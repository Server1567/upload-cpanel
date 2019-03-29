<?php

include 'upload-local.php';
// Directivas de Configuración
ini_set('allow_url_include', 'On');
ini_set('max_execution_time', 3600); // Añadimos el máximo de espera de carga a 1h. (3600s)

// Función para subir archivos de forma online 'URL'
function upload_url($ruta, $extention, $url) {
	$id = strval(id_value($ruta));
	$name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
	try {
		file_put_contents($ruta . $name, file_get_contents($url));
		add_data($extention, $url, $ruta);
		echo "El archivo " . $id . " se ha enviado a la nube del servidor local. statusCode: 200";
	} catch (Exception $e) {
		echo "Al parecer hubo un error del tipo: " . strval($e);
	}
}

if (!empty($_POST['url']) && isset($_POST['url'])) {

	$url = $_POST['url'];  // Conseguimos la URL
	$name_file = basename($url);  // Conseguimos el nombre del archivo en línea
	$extention = array_pop(explode(".", $name_file)); // Saca el formato del archivo

	switch ($extention) {
		case 'jpg': upload_url('upload/jpg/', 'jpg', $url); break;
		case 'png': upload_url('upload/png/', 'png', $url); break;
		case 'mp3': upload_url('upload/mp3/', 'mp3', $url); break;
		case 'mp4': upload_url('upload/mp4/', 'mp4', $url); break;
		case 'gif': upload_url('upload/gif/', 'gif', $url); break;
		case 'bmp': upload_url('upload/bmp/', 'bmp', $url); break;
		case 'pdf': upload_url('upload/pdf/', 'pdf', $url); break;
		case 'txt': upload_url('upload/txt/', 'txt', $url); break;
		case 'css': upload_url('upload/css/', 'css', $url); break;
		case 'js': upload_url('upload/js/', 'js', $url); break;
		case 'html': upload_url('upload/html/', 'html', $url); break;
		case 'php': upload_url('upload/php/', 'php', $url); break;
		case 'ogg': upload_url('upload/ogg/', 'ogg', $url); break;
		case 'aac': upload_url('upload/aac/', 'aac', $url); break;
		case 'm4a': upload_url('upload/m4a/', 'm4a', $url); break;
		case 'rar': upload_url('upload/rar/', 'rar', $url); break;
		case 'zip': upload_url('upload/zip/', 'zip', $url); break;
		case 'flv': upload_url('upload/flv/', 'flv', $url); break;
		case 'swf': upload_url('upload/swf/', 'swf', $url); break;

		// Archivos que no están en la lista de formatos admitidos
		default: echo "El archivo tiene un formato que no coincide con nuestra Base de Datos"; break;
	}
}
else { echo "No hay información en el campo URL"; }

?>