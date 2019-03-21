<?php

if (!empty($_POST['url']) && isset($_POST['url'])) {
	
	$url = $_POST['url'];
	$name = basename($url);
	try {
		ini_set('max_execution_time', 3600); // Añadimos el máxima de espera de carga a 1h. (3600s)
		file_put_contents('../upload/' . $name, file_get_contents($url));
		echo "El archivo " . $name . " se ha enviado a la nube del servidor local. statusCode: 200";
	} catch (Exception $e) {
		echo "Al parecer hubo un error del tipo: " . strval($e);
	}

}
else {
	echo "El campo está vacío";
}

?>