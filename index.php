<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Upload to CPANEL</title>
	<!-- Styles -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="css/upload_files.css" />
</head>
<body>
<!-- Modal  -->  <!-- Para mostrar alertas de algún error -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<h2 align="center">AJAX File Upload Progress Bar using <strong>PHP</strong> & <em>jQuery</em></h2>
	<br><br><br>
	<div class="row">
		<div class="col-md-7"> <!-- Área de mostrar los archivos a subir -->
			<h3>Upload Files</h3>
			<br>

			<form id="upload-local" action="upload-local.php" method="post" enctype="multipart/form-data" name="upload-local"> <!-- Subida de archivos de forma local -->
				<div class="form-group" style="display: inline-block;">
					<div class="file-content">	
						<label for="fileInput" class="input-label">
							<span class="label-span">
								<i class="fas fa-upload"></i> Ningún archivo seleccionado
							</span>
						</label>
						<input type="file" class="form-control-file" id="fileInput" multiple="true" name="fileInput" accept=".jpg, .png, .mp3, .mp4, .gif, .bmp, .pdf, .txt, .css, .html, .php, .ogg, .aac, .m4a, .rar, .zip, .flv, .swf" />
					</div>
					<button type="submit" class="btn btn-outline-primary">
						<i class="fas fa-upload"></i> Upload
					</button>
				</div>
			</form>

			<!-- Subida de archivos de forma online por URL -->
			<form action="upload-url.php" method="POST" name="upload-url" id="upload-url"> 
				<div class="form-group" style="display: flex;">
					<input type="text" class="url" name="url" placeholder="URL" id="url" required>
					<button type="submit" value="upload" class="upload-url btn btn-primary">
						<i class="fas fa-file-upload"></i> Upload
					</button>
					<!-- Esto se muestrás mientras se hace la petición -->
					<div class="spinner-border text-primary" role="status" style="margin: 5px 20px; display: none;">
						<span class="sr-only">Loading...</span>
					</div>
					<i class="fas fa-check done" style="font-size: 35px; margin: 2px 15px; color: #28a745; display: none;"></i>
				</div>
			</form>

			<div class="progress" id="progreso"> <!-- Barra de progreso -->
				<div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="barra-progreso"></div>
			</div>
			<br>
			<div class="container" id="files"> <!-- Archivos -->
				<!-- Acá se cargarán los archivos que han sido subidos o que se estén subiendo -->
			</div>
		</div>

		<div class="col-md-5"> <!-- Área de mostrar los archivos en el CPANEL -->
			<h3>Files</h3><br>
			<div id="alerts-delete"></div> <!-- Alertas de la acción Eliminar Archivos -->
			<!-- Formulario para eliminar archivos de acorde a lo indicado en sus campos -->
			<form action="delete-files.php" method="POST" name="delete" id="delete">
				<div class="input-group" style="justify-content: center;">
					<!-- Grupo de formatos admitidos -->
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="jpg-3" name="SelectFormat3" class="custom-control-input" value="jpg-3">
						<label class="custom-control-label" for="jpg-3">JPG</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="png-3" name="SelectFormat3" class="custom-control-input" value="png-3">
						<label class="custom-control-label" for="png-3">PNG</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="mp3-3" name="SelectFormat3" class="custom-control-input" value="mp3-3">
						<label class="custom-control-label" for="mp3-3">MP3</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="mp4-3" name="SelectFormat3" class="custom-control-input" value="mp4-3">
						<label class="custom-control-label" for="mp4-3">MP4</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="gif-3" name="SelectFormat3" class="custom-control-input" value="gif-3">
						<label class="custom-control-label" for="gif-3">GIF</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="bmp-3" name="SelectFormat3" class="custom-control-input" value="bmp-3">
						<label class="custom-control-label" for="bmp-3">BMP</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="pdf-3" name="SelectFormat3" class="custom-control-input" value="pdf-3">
						<label class="custom-control-label" for="pdf-3">PDF</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="txt-3" name="SelectFormat3" class="custom-control-input" value="txt-3">
						<label class="custom-control-label" for="txt-3">TXT</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="css-3" name="SelectFormat3" class="custom-control-input" value="css-3">
						<label class="custom-control-label" for="css-3">CSS</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="js-3" name="SelectFormat3" class="custom-control-input" value="js-3">
						<label class="custom-control-label" for="js-3">JS</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="html-3" name="SelectFormat3" class="custom-control-input" value="html-3">
						<label class="custom-control-label" for="html-3">HTML</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="php-3" name="SelectFormat3" class="custom-control-input" value="php-3">
						<label class="custom-control-label" for="php-3">PHP</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="ogg-3" name="SelectFormat3" class="custom-control-input" value="ogg-3">
						<label class="custom-control-label" for="ogg-3">OGG</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="aac-3" name="SelectFormat3" class="custom-control-input" value="aac-3">
						<label class="custom-control-label" for="aac-3">AAC</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="m4a-3" name="SelectFormat3" class="custom-control-input" value="m4a-3">
						<label class="custom-control-label" for="m4a-3">M4A</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="rar-3" name="SelectFormat3" class="custom-control-input" value="rar-3">
						<label class="custom-control-label" for="rar-3">RAR</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="zip-3" name="SelectFormat3" class="custom-control-input" value="zip-3">
						<label class="custom-control-label" for="zip-3">ZIP</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="flv-3" name="SelectFormat3" class="custom-control-input" value="flv-3">
						<label class="custom-control-label" for="flv-3">FLV</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="swf-3" name="SelectFormat3" class="custom-control-input" value="swf-3">
						<label class="custom-control-label" for="swf-3">SWF</label>
					</div>
				</div><br>
				<div class="input-group">
					<input type="text" class="form-control col-md-6" placeholder="ID Ej: 0000001" style="border-radius: 50px 0px 0px 50px; color: #212529; font-weight: bold;" id="delInput" required>
					<button type="submit" class="btn btn-danger col-md-6"><i class="fas fa-trash-alt"></i> Eliminar</button>
				</div>
				<br>	
			</form>

			<!-- Lista de archivos -->
			<div class="container" id="view">
				<!-- Acá se listarán todos los archivos de los datos JSON -->
			</div>
			<br>

			<!-- Formulario de lectura de datos JSON según el tipo y rango especificado -->
			<form action="list-view.php" method="POST" name="list-view-form" id="list-view-form">
				<div class="input-group"> <!-- Búsqueda de archivos de acorde a un rango -->
					<div class="input-group-prepend">
						<span class="input-group-text">Rango a buscar</span>
					</div>
					<input type="text" placeholder="Desde" class="form-control" style="color: #212529; font-weight: bold;" name="desde" id="desde" required>
					<input type="text" placeholder="Hasta" class="form-control" style="color: #212529; font-weight: bold;" name="hasta" id="hasta" required>
				</div><br>
				<div class="input-group" style="justify-content: center;">
					<!-- Grupo de formatos admitidos -->
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="jpg" name="SelectFormat" class="custom-control-input" value="jpg">
						<label class="custom-control-label" for="jpg">JPG</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="png" name="SelectFormat" class="custom-control-input" value="png">
						<label class="custom-control-label" for="png">PNG</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="mp3" name="SelectFormat" class="custom-control-input" value="mp3">
						<label class="custom-control-label" for="mp3">MP3</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="mp4" name="SelectFormat" class="custom-control-input" value="mp4">
						<label class="custom-control-label" for="mp4">MP4</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="gif" name="SelectFormat" class="custom-control-input" value="gif">
						<label class="custom-control-label" for="gif">GIF</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="bmp" name="SelectFormat" class="custom-control-input" value="bmp">
						<label class="custom-control-label" for="bmp">BMP</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="pdf" name="SelectFormat" class="custom-control-input" value="pdf">
						<label class="custom-control-label" for="pdf">PDF</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="txt" name="SelectFormat" class="custom-control-input" value="txt">
						<label class="custom-control-label" for="txt">TXT</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="css" name="SelectFormat" class="custom-control-input" value="css">
						<label class="custom-control-label" for="css">CSS</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="js" name="SelectFormat" class="custom-control-input" value="js">
						<label class="custom-control-label" for="js">JS</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="html" name="SelectFormat" class="custom-control-input" value="html">
						<label class="custom-control-label" for="html">HTML</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="php" name="SelectFormat" class="custom-control-input" value="php">
						<label class="custom-control-label" for="php">PHP</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="ogg" name="SelectFormat" class="custom-control-input" value="ogg">
						<label class="custom-control-label" for="ogg">OGG</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="aac" name="SelectFormat" class="custom-control-input" value="aac">
						<label class="custom-control-label" for="aac">AAC</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="m4a" name="SelectFormat" class="custom-control-input" value="m4a">
						<label class="custom-control-label" for="m4a">M4A</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="rar" name="SelectFormat" class="custom-control-input" value="rar">
						<label class="custom-control-label" for="rar">RAR</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="zip" name="SelectFormat" class="custom-control-input" value="zip">
						<label class="custom-control-label" for="zip">ZIP</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="flv" name="SelectFormat" class="custom-control-input" value="flv">
						<label class="custom-control-label" for="flv">FLV</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="swf" name="SelectFormat" class="custom-control-input" value="swf">
						<label class="custom-control-label" for="swf">SWF</label>
					</div>
				</div><br>
				<div class="input-group">
					<button type="submit" class="btn btn-primary col-md-12"><i class="fas fa-search"></i> Buscar</button>
				</div>
			</form>
			<br>

			<!-- Formulario de lectura de datos JSON según el tipo especificado -->
			<form action="list-view-all.php" method="POST" id="list-view-all" name="list-view-all">
				<div class="input-group" style="justify-content: center;">
					<!-- Grupo de formatos admitidos -->
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="jpg-2" name="SelectFormat2" class="custom-control-input" value="jpg-2">
						<label class="custom-control-label" for="jpg-2">JPG</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="png-2" name="SelectFormat2" class="custom-control-input" value="png-2">
						<label class="custom-control-label" for="png-2">PNG</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="mp3-2" name="SelectFormat2" class="custom-control-input" value="mp3-2">
						<label class="custom-control-label" for="mp3-2">MP3</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="mp4-2" name="SelectFormat2" class="custom-control-input" value="mp4-2">
						<label class="custom-control-label" for="mp4-2">MP4</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="gif-2" name="SelectFormat2" class="custom-control-input" value="gif-2">
						<label class="custom-control-label" for="gif-3">GIF</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="bmp-2" name="SelectFormat2" class="custom-control-input" value="bmp-2">
						<label class="custom-control-label" for="bmp-2">BMP</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="pdf-2" name="SelectFormat2" class="custom-control-input" value="pdf-2">
						<label class="custom-control-label" for="pdf-2">PDF</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="txt-2" name="SelectFormat2" class="custom-control-input" value="txt-2">
						<label class="custom-control-label" for="txt-2">TXT</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="css-2" name="SelectFormat2" class="custom-control-input" value="css-2">
						<label class="custom-control-label" for="css-2">CSS</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="js-2" name="SelectFormat2" class="custom-control-input" value="js-2">
						<label class="custom-control-label" for="js-2">JS</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="html-2" name="SelectFormat2" class="custom-control-input" value="html-2">
						<label class="custom-control-label" for="html-2">HTML</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="php-2" name="SelectFormat2" class="custom-control-input" value="php-2">
						<label class="custom-control-label" for="php-2">PHP</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="ogg-2" name="SelectFormat2" class="custom-control-input" value="ogg-2">
						<label class="custom-control-label" for="ogg-2">OGG</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="aac-2" name="SelectFormat2" class="custom-control-input" value="aac-2">
						<label class="custom-control-label" for="aac-2">AAC</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="m4a-2" name="SelectFormat2" class="custom-control-input" value="m4a-2">
						<label class="custom-control-label" for="m4a-2">M4A</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="rar-2" name="SelectFormat2" class="custom-control-input" value="rar-2">
						<label class="custom-control-label" for="rar-2">RAR</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="zip-2" name="SelectFormat2" class="custom-control-input" value="zip-2">
						<label class="custom-control-label" for="zip-2">ZIP</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="flv-2" name="SelectFormat2" class="custom-control-input" value="flv-2">
						<label class="custom-control-label" for="flv-2">FLV</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="swf-2" name="SelectFormat2" class="custom-control-input" value="swf-2">
						<label class="custom-control-label" for="swf-2">SWF</label>
					</div>
				</div><br>
				<div class="input-group row" style="margin: 0px 5px;">
					<input type="submit" value="Seleccionar todo" class="btn btn-primary col-lg-12 col-md-12" style="color: #212529; color: white;" />
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Para corregir posibles errores de posicionamiento de contenedores (div) -->
<div class="clearfix"></div>
<!-- Scripts -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/event.js"></script>
<script src="js/main.js"></script>
</body>
</html>