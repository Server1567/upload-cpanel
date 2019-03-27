<?php

if (!empty($_POST['url']) && isset($_POST['url'])) {
	
	$json = fopen("../JSON/data_files.json", "rb");
	$data = stream_get_contents($json);
	fclose($json);

	$data_processed = json_decode($data);
	$new_data = '{"id":"0000004", "Nombre":"0000004.jpg", "URL": "https://server1567.github.io/"}';
	$new_data_processed = json_decode($new_data);

	array_push($data_processed, $new_data_processed);

	$fichero = fopen("../JSON/data_files.json", "w+");
	fwrite($fichero, json_encode($data_processed));
	fclose($fichero);
	print_r($data_processed);
	
}
else {
	echo "El campo está vacío";
}

?>