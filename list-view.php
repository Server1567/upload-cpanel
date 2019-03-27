<?php

include 'upload-local.php';

function get_data($type) {
    $json = fopen("JSON/" . $type . "/data_files.json", "rb");
    $data = stream_get_contents($json);
    fclose($json);

    $data_processed = json_decode($data);
    return $data_processed;
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
					$info = array();

					foreach ($data as $obj) { // Itera cada dato
						$name = $obj->Nombre; // Consigue el nombre del dato
						$url = $obj->URL;     // Consigue la URL del dato
						$id = $obj->id;		  // Consigue el ID del archivo 
						if ($id >= intval($desde) && $id <= intval($hasta)) {
							$array = array($url, $name);
							array_push($info, $array);
						}
					}

					if (sizeof($info) == 0) { // En caso de que no esté el rango manda un error al FrontEnd(JS)
						echo False;
					}
					else {
						echo json_encode($info);		    	  // Manda los datos al FrontEnd(JS)	
					}
					break; // run X code

				case 'png':
					$data = get_data("png"); // Consigue información de la Base de Datos JSON
					$info = array();
					
					foreach ($data as $obj) { // Itera cada dato
						$name = $obj->Nombre; // Consigue el nombre del dato
						$url = $obj->URL;     // Consigue la URL del dato
						$id = $obj->id;		  // Consigue el ID del archivo 
						if ($id >= intval($desde) && $id <= intval($hasta)) {
							$array = array($url, $name);
							array_push($info, $array);
						}
					}

					if (sizeof($info) == 0) { // En caso de que no esté el rango manda un error al FrontEnd(JS)
						echo False;
					}
					else {
						echo json_encode($info);		    	  // Manda los datos al FrontEnd(JS)	
					}
					break; // run X code

				case 'mp3':
					$data = get_data("mp3"); // Consigue información de la Base de Datos JSON
					$info = array();
					
					foreach ($data as $obj) { // Itera cada dato
						$name = $obj->Nombre; // Consigue el nombre del dato
						$url = $obj->URL;     // Consigue la URL del dato
						$id = $obj->id;		  // Consigue el ID del archivo 
						if ($id >= intval($desde) && $id <= intval($hasta)) {
							$array = array($url, $name);
							array_push($info, $array);
						}
					}

					if (sizeof($info) == 0) { // En caso de que no esté el rango manda un error al FrontEnd(JS)
						echo False;
					}
					else {
						echo json_encode($info);		    	  // Manda los datos al FrontEnd(JS)	
					}
					break; // run X code

				case 'mp4':
					$data = get_data("mp4"); // Consigue información de la Base de Datos JSON
					$info = array();
					
					foreach ($data as $obj) { // Itera cada dato
						$name = $obj->Nombre; // Consigue el nombre del dato
						$url = $obj->URL;     // Consigue la URL del dato
						$id = $obj->id;		  // Consigue el ID del archivo 
						if ($id >= intval($desde) && $id <= intval($hasta)) {
							$array = array($url, $name);
							array_push($info, $array);
						}
					}

					if (sizeof($info) == 0) { // En caso de que no esté el rango manda un error al FrontEnd(JS)
						echo False;
					}
					else {
						echo json_encode($info);		    	  // Manda los datos al FrontEnd(JS)	
					}
					break;	 // run X code
			}

		}
		else {
			echo "SelectFormat NULL. statusCode: 404";
		}
	}
}

?>