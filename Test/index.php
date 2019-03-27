<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test Unit</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="../css/upload_files.css">
</head>
<body>

<span id="info" style="margin: 50px;"></span>
<div class="spinner-grow text-info" role="status" style="display: none;">
  <span class="sr-only">Loading...</span>
</div>

<form action="url.php" id="test" method="post" enctype="multipart/form-data" name="test"> <!-- Subida de archivos de forma local -->
	<div class="form-group" style="display: inline-block; padding: 25px;">
		<div class="file-content">	
			<label for="file" class="input-label" style="margin-bottom: 10px;">
				<span class="label-span">
					<i class="fas fa-upload"></i> Ningún archivo seleccionado
				</span>
			</label>
			<input type="file" class="form-control-file" id="file" multiple name="file" accept=".jpg, .png, .mp3, .mp4" / style="display: none;">
		</div>
		<input type="text" name="url" id="url" class="form-control" placeholder="URL" />
		<button type="submit" class="btn btn-outline-primary">
			<i class="fas fa-upload"></i> Upload
		</button>
	</div>
</form>	

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- BootStrap -->
<script src="../js/bootstrap.min.js"></script>
<!-- <script src="../js/jquery.form.js"></script> -->

<script>
	$(document).ready(function(){
		$('#tests').submit(function(event){

			if($('#file').val()) {  // El archivo tiene valor?
				event.preventDefault();
				var files = document.getElementById('file').files;  // Captura los archivos en una variable

				var formData = new FormData();
				formData.append("file", files[0]);

				$.ajax({  				// Petición para enviar archivos
					url: "test.php",
					type: "POST",
					data: formData,     
					contentType: false,
					processData: false,
					cache: false,
					xhr: function() {
					    var xhr = $.ajaxSettings.xhr();

					    //Upload progress
					    xhr.upload.addEventListener("progress", function(evt){
					    	if (evt.lengthComputable) {
						        var percentComplete = Math.round((evt.loaded * 100) / evt.total);
						        //Do something with upload progress
						        console.log(String(percentComplete) + "% - " + String(0));
					    	}
					    }, false);
					    return xhr;
					},
					success: function (data) {
						console.log(data);
					}
				});	
			}
			return false;
		});

		$("#test").submit(function (event) {
			if ($("#url").val()) {
				event.preventDefault();
				var url = document.getElementById("url").value;
				var formData = new FormData();
				formData.append("url", url);

				$.ajax({
					url: "url.php",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					cache: false,
					beforeSend: function () {
						$(".spinner-grow").attr("style", "display: block;");
						console.log("Enviando información...");
					},
					success: function (data) {
						$("#info").text(data);
						console.log(data);
						$(".spinner-grow").attr("style", "display: none;")
						// Prueba Unitaria Completa. statusCode 200
					}
				});

			}
			else {
				event.preventDefault();
			}
		})
	});
</script>

</body>
</html>