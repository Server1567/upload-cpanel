<?php 

	if (!empty($_FILES)) {

		if (is_uploaded_file($_FILES['file']['tmp_name'])) {
			print_r($_FILES['file']['name'] . " - Tamaño => " . $_FILES['file']['size'] . " Bytes");
		}
	}
	else {
		echo "El archivo está vacío";
	}

?>