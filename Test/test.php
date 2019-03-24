<?php 

    $dir = opendir("../upload/jpg/");
    $files = array();

    while ($current = readdir($dir)){ // ¿Lo está leyendo?
        if($current != "." && $current != "..") {  // Verifica si es un archivo, en caso verdadero: run X code
            if(is_dir($path.$current)) {
                echo $path.$current.'/';
                echo "Esperemos nunca ver esto";
            }
            else { // Es un archivo
                $files[] = $current;
                $key = array_search(max($files), $files); // Ejemplo Array (2 => 0000002.jpg). Output: 2
                $latest_position = array_values($files)[$key];
            }
        }
        else {
            $latest_position = "0000000";
        }
    }

    echo $latest_position;

	// if (!empty($_FILES)) {

	// 	if (is_uploaded_file($_FILES['file']['tmp_name'])) {
	// 		print_r($_FILES['file']['name'] . " - Tamaño => " . $_FILES['file']['size'] . " Bytes");
	// 	}
	// }
	// else {
	// 	echo "El archivo está vacío";
	// }

?>