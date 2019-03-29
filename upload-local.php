<?php 

// Directivas de Configuración
ini_set('file_uploads', 'On');
ini_set('max_execution_time', 3600); // Añadimos el máxima de espera de carga a 1h. (3600s)
ini_set('upload_max_filesize', '200M');
ini_set('extension', 'php_openssl.dll');

// Algoritmo para sacar el nombre del último archivo de la carpeta upload/[EXTENSION]/

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
        }
    }

    // Nombramiendo del archivo por el nuevo ID, para aplicarlo al nombre
    $lista = array();

    for ($i=0; $i < strlen($latest_position); $i++) { // Descompongo el nombre del último archivo
        array_push($lista, $latest_position[$i]);
    }

    $name_file = array_slice($lista, 0, 7); // Selecciono los primero 7 caracteres en un Array
    $new_value = intval(implode($name_file)) + 1; // Obtengo el valor numérico y le sumo 1
    $final_value = str_split(strval($new_value)); // Lo vuelvo una lista de strings
    $length = 7 - sizeof($final_value); // Le resto la longitud en chr al 7 y obtengo la cantidad de 0 necesaria

    for ($i=1; $i < $length + 1; $i++) { // Le añado cada cero al principio del valor numérico
        array_unshift($final_value, "0");
    }

    $temp_id_file = implode($final_value); // Obtengo el valor numérico definido

    closedir($dir); // Cierro la carpeta

    return $temp_id_file; // Devuelvo el ID
}

// Función para añadir los datos del archivo al JSON

function add_data($type, $url, $ruta) {
    $id = strval(id_value($ruta));   // Me consigue el ID del archivo
    $name = $id . "." . strval($type); // Me une los valores en el ID final del archivos
    $target_path = $ruta . $name;

    $json = fopen("JSON/" . $type . "/data_files.json", "rb");
    $data = stream_get_contents($json);
    fclose($json);

    $data_processed = json_decode($data, true);
    $new_data = '{"id":"'. $id .'", "Nombre":"'. $name .'", "URL": "'. $url .'"}';
    $new_data_processed = json_decode($new_data);

    if (is_object($data_processed)) {
        settype($data_processed, "array");
    }
    
    array_push($data_processed, $new_data_processed);
    
    $fichero = fopen("JSON/" . $type . "/data_files.json", "w+");
    fwrite($fichero, json_encode($data_processed));
    fclose($fichero);
}

///////////////////////////////////////////////////
/////////////// SUBIDA DE ARCHIVOS ////////////////
///////////////////////////////////////////////////

// Subida de archivos de manera local | FORM
if (!empty($_FILES)) {

    if (is_uploaded_file($_FILES['file']['tmp_name'])) {  // Si el archivo se ha subido : run X code
        $extention = array_pop(explode(".", strval($_FILES['file']['name']))); // Saca el formato del archivo
        $source_path = $_FILES['file']['tmp_name'];
        switch ($extention) {
            case 'png':
                $id = strval(id_value('upload/png/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/png/' . $name;
                add_data($extention, "LOCAL", 'upload/png/');
                break;
            case 'jpg':
                $id = strval(id_value('upload/jpg/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/jpg/' . $name;
                add_data($extention, "LOCAL", 'upload/jpg/');
                break;
            case 'mp3':
                $id = strval(id_value('upload/mp3/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/mp3/' . $name;
                add_data($extention, "LOCAL", 'upload/mp3/');
                break;
            case 'mp4':
                $id = strval(id_value('upload/mp4/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/mp4/' . $name;
                add_data($extention, "LOCAL", 'upload/mp4/');
                break;
            case 'gif':
                $id = strval(id_value('upload/gif/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/gif/' . $name;
                add_data($extention, "LOCAL", 'upload/gif/');
                break;
            case 'bmp':
                $id = strval(id_value('upload/bmp/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/bmp/' . $name;
                add_data($extention, "LOCAL", 'upload/bmp/');
                break;
            case 'pdf':
                $id = strval(id_value('upload/pdf/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/pdf/' . $name;
                add_data($extention, "LOCAL", 'upload/pdf/');
                break;
            case 'txt':
                $id = strval(id_value('upload/txt/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/txt/' . $name;
                add_data($extention, "LOCAL", 'upload/txt/');
                break;
            case 'css':
                $id = strval(id_value('upload/css/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/css/' . $name;
                add_data($extention, "LOCAL", 'upload/css/');
                break;
            case 'js':
                $id = strval(id_value('upload/js/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/js/' . $name;
                add_data($extention, "LOCAL", 'upload/js/');
                break;
            case 'html':
                $id = strval(id_value('upload/html/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/html/' . $name;
                add_data($extention, "LOCAL", 'upload/html/');
                break;
            case 'php':
                $id = strval(id_value('upload/php/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/php/' . $name;
                add_data($extention, "LOCAL", 'upload/php/');
                break;
            case 'ogg':
                $id = strval(id_value('upload/ogg/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/ogg/' . $name;
                add_data($extention, "LOCAL", 'upload/ogg/');
                break;
            case 'aac':
                $id = strval(id_value('upload/aac/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/aac/' . $name;
                add_data($extention, "LOCAL", 'upload/aac/');
                break;
            case 'm4a':
                $id = strval(id_value('upload/m4a/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/m4a/' . $name;
                add_data($extention, "LOCAL", 'upload/m4a/');
                break;
            case 'rar':
                $id = strval(id_value('upload/rar/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/rar/' . $name;
                add_data($extention, "LOCAL", 'upload/rar/');
                break;
            case 'zip':
                $id = strval(id_value('upload/zip/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/zip/' . $name;
                add_data($extention, "LOCAL", 'upload/zip/');
                break;
            case 'flv':
                $id = strval(id_value('upload/flv/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/flv/' . $name;
                add_data($extention, "LOCAL", 'upload/flv/');
                break;
            case 'swf':
                $id = strval(id_value('upload/swf/'));   // Me consigue el ID del archivo
                $name = $id . "." . strval($extention); // Me une los valores en el ID final del archivos
                $target_path = 'upload/swf/' . $name;
                add_data($extention, "LOCAL", 'upload/swf/');
                break;
        }
        
        // Mueve el archivo a su destino y Manda el ID al FrontEnd(JS)
        if (move_uploaded_file($source_path, $target_path)) { echo $name; }
    }
}

?>