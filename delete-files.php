<?php

	include 'list-view-all.php';

	function del_files($id) {
		unlink($id);
	}

	function del_json($ext, $input_id) {
		$json_files = get_data($ext);

		foreach ($json_files as $key => $value) {
			$id = $value->id;
			if ($id == $input_id) {
				unset($json_files[$key]);

				$fichero = fopen("JSON/" . $ext . "/data_files.json", "w+");
			    fwrite($fichero, json_encode($json_files));
			    fclose($fichero);
			}
		}
	}

	if (!empty($_POST['radio']) && isset($_POST['radio'])) {
		if (!empty($_POST['input']) && isset($_POST['input'])) {
			
			$input = $_POST['input'];
			$option = $_POST['radio'];

			switch ($option) {
				case 'jpg-3':
					$file = "upload/jpg/" . strval($input) . ".jpg";
					if (file_exists($file)) {
						del_files($file);
						del_json("jpg", intval($input));
						echo 200;
					}
					else {
						echo 404;
					}
					break;

				case 'png-3':
					$file = "upload/png/" . strval($input) . ".png";
					if (file_exists($file)) {
						del_files($file);
						del_json("png", intval($input));
						echo 200;
					}
					else {
						echo 404;
					}
					break;

				case 'mp3-3':
					$file = "upload/mp3/" . strval($input) . ".mp3";
					if (file_exists($file)) {
						del_files($file);
						del_json("mp3", intval($input));
						echo 200;
					}
					else {
						echo 404;
					}
					break;

				case 'mp4-3':
					$file = "upload/mp4/" . strval($input) . ".mp4";
					if (file_exists($file)) {
						del_files($file);
						del_json("mp4", intval($input));
						echo 200;
					}
					else {
						echo 404;
					}
					break;
			}

		}
	}
	else {
		echo "Radio no especificado. statusCode: 404";
	}

?>