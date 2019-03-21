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
	<!-- Modal -->
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
		<h2 align="center">Ajax File Upload Progress Bar using <strong>PHP</strong> & jQuery</h2>
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
							<input type="file" class="form-control-file" id="fileInput" multiple="true" name="fileInput" accept=".jpg, .png, .mp3, .mp4" />
						</div>
						<button type="submit" class="btn btn-outline-primary">
							<i class="fas fa-upload"></i> Upload
						</button>
						<button class="btn btn-outline-danger" id="cancel" style="display: none;">
							<i class="fas fa-ban"></i> Cancel
						</button>
					</div>
				</form>

				<!-- Subida de archivos de forma online por URL -->
				<form action="upload-url.php" method="POST" name="upload-url" id="upload-url"> 
					<div class="form-group" style="display: flex;">
						<input type="text" class="url" name="url" placeholder="URL" id="url">
						<button type="submit" value="upload" class="upload-url btn btn-primary">
							<i class="fas fa-file-upload"></i> Upload
						</button>
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
				</div>
			</div>
			<div class="col-md-5"> <!-- Área de mostrar los archivos en el CPANEL -->
				<h3>Files</h3>
				<div class="container" id="view"> <!-- Lista de archivos -->
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<span><em>https://server1567.github.io/</em></span>
						</div>
						<div class="col-md-4 col-sm-12">
							<span style="font-weight: bold;">0000652.mp3</span>
						</div>
					</div>
				</div>
				<br>
					<div class="input-group"> <!-- Búsqueda de archivos de acorde a un rango -->
						<div class="input-group-prepend">
							<span class="input-group-text">Rango a buscar</span>
						</div>
						<input type="text" placeholder="Desde" class="form-control" style="color: #212529; font-weight: bold;">
						<input type="text" placeholder="Hasta" class="form-control" style="color: #212529; font-weight: bold;">
						<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
					</div>
					<br>
					<form action="#" method="POST" id="list_view" name="list_view">
						<div class="input-group row" style="margin: 0px 5px;">
							<input type="submit" value="Seleccionar todo" class="btn btn-primary col-lg-12 col-md-12" style="color: #212529; color: white;" />
						</div>
					</form>
			</div>
		</div>
	</div>

<div class="clearfix"></div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/event.js"></script>
<script src="js/main.js"></script>
</body>
</html>