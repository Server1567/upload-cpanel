<?php 

// Directivas de Configuración
ini_set('file_uploads', 'On');
ini_set('max_execution_time', 3600); // Añadimos el máxima de espera de carga a 1h. (3600s)
ini_set('upload_max_filesize', '200M');
ini_set('extension', 'php_openssl.dll');

// Algoritmo para sacar el nombre del ultimo archivo de la carpeta upload/

function id_value($directory) {

    $dir = opendir($directory);
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
            echo "Hola";
        }
    }

    // Nombramiendo del archivo por el nuevo ID, para aplicarlo al nombre
    $lista = array();

    for ($i=0; $i < strlen($latest_position); $i++) { // Descompongo el nombre del ultimo archivo
        array_push($lista, $latest_position[$i]);
    }

    $name_file = array_slice($lista, 0, 7); // Selecciono los primero 7 caracteres en un Array
    $new_value = intval(implode($name_file)) + 1; // Obtengo el valor numérico y le sumo 1
    $final_value = str_split(strval($new_value)); // Lo vuelvo una lista de strings
    $length = 7 - sizeof($final_value); // Le resto la longitud en chr al 7 y obtengo la cantidad de 0 necesaria

    for ($i=1; $i < $length + 1; $i++) { // Le añado cada cero al principio del valor numerico
        array_unshift($final_value, "0");
    }

    $temp_id_file = implode($final_value); // Obtengo el valor numerico definido

    closedir($dir); // Cierro la carpeta

    return $temp_id_file; // Devuelvo el ID
}

///////////////////////////////////////////////////
///////////////////////////////////////////////////

// Subida de archivos de manera local | FORM
if (!empty($_FILES)) {

    if (is_uploaded_file($_FILES['file']['tmp_name'])) {  // Si el archivo se ha subido : run X code
        $extention = array_pop(explode(".", strval($_FILES['file']['name']))); // Saca el formato del archivo
        $source_path = $_FILES['file']['tmp_name'];
        switch ($extention) {
            case 'png':
                $name = strval(id_value("upload/png/"));
                $id = $name . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/png/' . $id;
                break;
            case 'jpg':
                $name = strval(id_value("upload/jpg/"));
                $id = $name . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/jpg/' . $id;
                break;
            case 'mp3':
                $name = strval(id_value("upload/mp3/"));
                $id = $name . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/mp3/' . $id;
                break;
            case 'mp4':
                $name = strval(id_value("upload/mp4/"));
                $id = $name . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/mp4/' . $id;
                break;
        }
        
        if (move_uploaded_file($source_path, $target_path)) {
            echo $id; // Manda el ID al FrontEnd(JS)
        }

    }
}

?>