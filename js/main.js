$(document).ready(function(){

	function bytesToSize(bytes) {
	    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	    if (bytes == 0) return 'n/a';
	    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	    if (i == 0) return bytes + ' ' + sizes[i];
	    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
	}
	function bytesToSizeCalc(bytes) {
	    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	    if (bytes == 0) return 'n/a';
	    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	    if (i == 0) return bytes + ' ' + sizes[i];
	    return (bytes / Math.pow(1024, i)).toFixed(1);
	}
	
	$('#upload-local').submit(function(event){
		if($('#fileInput').val()) {
			event.preventDefault();

			var barra_estado = document.getElementById('barra-progreso');
			var input = document.getElementById('fileInput');
			var file = new FormData(input.files[0]);
			var length = file.size;

			function peticionAJAXThirdOnion(third) {
				var formData = new FormData();
				formData.append("file", archivos[third]);

				var xmlhr = $.ajax({
					url: "upload-local.php",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					cache: false,
					beforeSend: function () {
						$("#files").append("<div class='archivo'><div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+archivos[2].name+"</span><span class='progress-file' style='color: #28a745;''>0%</span><span class='length-file'>"+bytesToSize(archivos[2].size)+"</span></div></div>");
					},
					xhr: function() {
						var xhr = $.ajaxSettings.xhr(); 

						// Upload progress
						xhr.upload.addEventListener("progress", function (e) {
							if (e.lengthComputable) {
								var percentageComplete = Math.round((e.loaded * 100) / e.total);
								// Testear funcionamiento
								console.log(String(percentageComplete) + "% - " + String(third))
								barra_estado.style.width = "" + percentageComplete + "%";
								var longitud_archivoCalc = bytesToSizeCalc(archivos[0].size);
								var length_uploaded = Math.floor(longitud_archivoCalc*percentageComplete)/100
								if (percentageComplete == 100) {
									$(".archivo:last-child").html("<div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+archivos[2].name+"</span><span class='progress-file' style='color: #28a745;'>"+percentageComplete+"%</span><span class='length-file'>"+length_uploaded+"/"+bytesToSize(archivos[2].size)+"</span></div>");
								}
								else {
									$(".archivo:last-child").html("<div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+archivos[2].name+"</span><span class='progress-file' style='color: #ffc107;'>"+percentageComplete+"%</span><span class='length-file'>"+length_uploaded+"/"+bytesToSize(archivos[2].size)+"</span></div>");
								}
							}
							$("#cancel").on("click", function () {
								xmlhr.abort();
								xmlhr = null;
							});
						}, false);
						return xhr;
					},
					success: function (data) { 
						console.log("Nombre => " + data); 
						// Ajax recoge los datos es en esta función y le da X uso.
						$(".archivo:last-child").html("<div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+data+"</span><span class='progress-file' style='color: #28a745;'>100%</span><span class='length-file'>"+bytesToSize(archivos[2].size)+"/"+bytesToSize(archivos[2].size)+"</span></div>");
					}	
				});
				return xmlhr;
			}
			function peticionAJAXSecondOnion(second) {
				var formData = new FormData();
				formData.append("file", archivos[second]);

				var xmlhr = $.ajax({
					url: "upload-local.php",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					cache: false,
					beforeSend: function () {
						$("#files").append("<div class='archivo'><div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+archivos[1].name+"</span><span class='progress-file' style='color: #28a745;''>0%</span><span class='length-file'>"+bytesToSize(archivos[1].size)+"</span></div></div>");
					},
					xhr: function() {
						var xhr = $.ajaxSettings.xhr(); 

						// Upload progress
						xhr.upload.addEventListener("progress", function (e) {
							if (e.lengthComputable) {
								var percentageComplete = Math.round((e.loaded * 100) / e.total);
								// Testear funcionamiento
								console.log(String(percentageComplete) + "% - " + String(second))
								barra_estado.style.width = "" + percentageComplete + "%";
								var longitud_archivoCalc = bytesToSizeCalc(archivos[0].size);
								var length_uploaded = Math.floor(longitud_archivoCalc*percentageComplete)/100
								if (percentageComplete == 100) {
									$(".archivo:last-child").html("<div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+archivos[1].name+"</span><span class='progress-file' style='color: #28a745;'>"+percentageComplete+"%</span><span class='length-file'>"+length_uploaded+"/"+bytesToSize(archivos[1].size)+"</span></div>");
								}
								else {
									$(".archivo:last-child").html("<div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+archivos[1].name+"</span><span class='progress-file' style='color: #ffc107;'>"+percentageComplete+"%</span><span class='length-file'>"+length_uploaded+"/"+bytesToSize(archivos[1].size)+"</span></div>");
								}
							}
							$("#cancel").on("click", function () {
								xmlhr.abort();
								xmlhr = null;
							});
						}, false);
						return xhr;
					},
					success: function (data) {
						console.log("Nombre => " + data);
						// Ajax recoge los datos es en esta función y le da X uso.
						$(".archivo:last-child").html("<div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+data+"</span><span class='progress-file' style='color: #28a745;'>100%</span><span class='length-file'>"+bytesToSize(archivos[1].size)+"/"+bytesToSize(archivos[1].size)+"</span></div>");

						if (archivos.length > 2) {
							if (archivos[2].type == "image/png") {
								if (archivos[2].size > 2097152) {
									$(".modal-title").text("Límite superado");
									$(".modal-body").text("Asegure de que los archivos .png no pese más de 2MB");
									$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
									$('#exampleModal').modal('show');
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "image/jpeg") {
								if (archivos[2].size > 2097152) {
									$(".modal-title").text("Límite superado");
									$(".modal-body").text("Asegure de que los archivos .jpg no pese más de 2MB");
									$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
									$('#exampleModal').modal('show');
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "audio/mp3") {
								if (archivos[2].size > 10485760) {
									$(".modal-title").text("Límite superado");
									$(".modal-body").text("Asegure de que los archivos .mp3 no pese más de 10MB");
									$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
									$('#exampleModal').modal('show');
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "video/mp4") {
								if (archivos[2].size > 209715200) {
									$(".modal-title").text("Límite superado");
									$(".modal-body").text("Asegure de que los archivos .mp4 no pese más de 200MB");
									$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
									$('#exampleModal').modal('show');
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else {
								$(".modal-title").text("Formato de archivo no permitido");
								$(".modal-body").text("Asegure de que el archivos tengan uno de los formatos permitidos: .PNG, .JPG, .MP3, .MP4");
								$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
								$('#exampleModal').modal('show');					
							}
						}
					}	
				});
				return xmlhr;
			}
			function peticionAJAX(first) {
				var xmlhr;
				var formData = new FormData();
				formData.append("file", archivos[first]);

				xmlhr = $.ajax({
					url: "upload-local.php",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					cache: false,
					beforeSend: function () {
						$("#files").append("<div class='archivo'><div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+archivos[0].name+"</span><span class='progress-file' style='color: #28a745;''>0%</span><span class='length-file'>"+bytesToSize(archivos[0].size)+"</span></div></div>");
					},
					xhr: function() {
						var xhr = $.ajaxSettings.xhr(); 
						xhr.abort();
						// Upload progress
						xhr.upload.addEventListener("progress", function (e) {

							$("#cancel").on("click", function() {
								xmlr.abort();
							});

							if (e.lengthComputable) {
								var percentageComplete = Math.round((e.loaded * 100) / e.total);
								// Testear funcionamiento
								console.log(String(percentageComplete) + "% - " + String(first))
								barra_estado.style.width = "" + percentageComplete + "%";
								var longitud_archivoCalc = bytesToSizeCalc(archivos[0].size);
								var length_uploaded = Math.floor(longitud_archivoCalc*percentageComplete)/100
								if (percentageComplete == 100) {
									$(".archivo:last-child").html("<div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+archivos[0].name+"</span><span class='progress-file' style='color: #28a745;'>"+percentageComplete+"%</span><span class='length-file'>"+length_uploaded+"/"+bytesToSize(archivos[0].size)+"</span></div>");
								}
								else {
									$(".archivo:last-child").html("<div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+archivos[0].name+"</span><span class='progress-file' style='color: #ffc107;'>"+percentageComplete+"%</span><span class='length-file'>"+length_uploaded+"/"+bytesToSize(archivos[0].size)+"</span></div>");
								}
							}
						}, false);
						return xhr;
					},
					success: function (data) {
						console.log("Nombre => " + data);
						// Ajax recoge los datos es en esta función y le da X uso.
						$(".archivo:last-child").html("<div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+data+"</span><span class='progress-file' style='color: #28a745;'>100%</span><span class='length-file'>"+bytesToSize(archivos[0].size)+"/"+bytesToSize(archivos[0].size)+"</span></div>");

						if (archivos.length > 1) {
							if (archivos[1].type == "image/png") {
								if (archivos[1].size > 2097152) {
									$(".modal-title").text("Límite superado");
									$(".modal-body").text("Asegure de que los archivos .png no pese más de 2MB");
									$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
									$('#exampleModal').modal('show');
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "image/jpeg") {
								if (archivos[1].size > 2097152) {
									$(".modal-title").text("Límite superado");
									$(".modal-body").text("Asegure de que los archivos .jpg no pese más de 2MB");
									$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
									$('#exampleModal').modal('show');
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "audio/mp3") {
								if (archivos[1].size > 10485760) {
									$(".modal-title").text("Límite superado");
									$(".modal-body").text("Asegure de que los archivos .mp3 no pese más de 10MB");
									$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
									$('#exampleModal').modal('show');
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "video/mp4") {
								if (archivos[1].size > 209715200) {
									$(".modal-title").text("Límite superado");
									$(".modal-body").text("Asegure de que los archivos .mp4 no pese más de 200MB");
									$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
									$('#exampleModal').modal('show');
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else {
								$(".modal-title").text("Formato de archivo no permitido");
								$(".modal-body").text("Asegure de que los archivos tengan uno de los formatos permitidos: .PNG, .JPG, .MP3, .MP4");
								$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
								$('#exampleModal').modal('show');				
							}
						}
					}	
				});

				return xmlhr;
				// $("#cancel").on("click", function () {
				// 	if (xmlhr && xmlhr.readyState != 4) {
				// 		xmlhr.abort();
				// 	}
				// })
			}

			var longitud_archivo = bytesToSize(length); // Longitud exacta del archivo

			// **********************************************************************************
			var archivos = document.getElementById('fileInput').files; // Obtengo los archivos
			var formData = new FormData();
			formData.append("file", archivos[0]);

			if (archivos.length > 3) {
				// Muestra la advertencia de excesión de archivos
				$(".modal-title").text("Límite de archivos excedido");
				$(".modal-body").text("Asegurese de seleccionar no más de tres archivos por carga.");
				$('#exampleModal').modal('show');
				$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
			}
			else { // Si es menor o igual a 3 archivos ejecuta las peticiones
				// Primera capa de validaciones de formato y tamaño de archivo
				if (archivos[0].type == "image/png") {
					if (archivos[0].size > 2097152) {
						$(".modal-title").text("Límite superado");
						$(".modal-body").text("Asegure de que los archivos .png no pese más de 2MB");
						$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
						$('#exampleModal').modal('show');
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "image/jpeg") {
					if (archivos[0].size > 2097152) {
						$(".modal-title").text("Límite superado");
						$(".modal-body").text("Asegure de que los archivos .jpg no pese más de 2MB");
						$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
						$('#exampleModal').modal('show');
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "audio/mp3") {
					if (archivos[0].size > 10485760) {
						$(".modal-title").text("Límite superado");
						$(".modal-body").text("Asegure de que los archivos .mp3 no pese más de 10MB");
						$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
						$('#exampleModal').modal('show');
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "video/mp4") {
					if (archivos[0].size > 209715200) {
						$(".modal-title").text("Límite superado");
						$(".modal-body").text("Asegure de que los archivos .mp4 no pese más de 200MB");
						$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
						$('#exampleModal').modal('show');
					}
					else {
						peticionAJAX(0);
					}
				}
				else {
					$(".modal-title").text("Formato de archivo no permitido");
					$(".modal-body").text("Asegure de que los archivo tengan uno de los formatos permitidos: .PNG, .JPG, .MP3, .MP4");
					$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
					$('#exampleModal').modal('show');				
				}
			}
		}
		else {
			event.preventDefault();
		}
	});

	$("#upload-url").submit(function (event) {
		if ($("#url").val()) {
			event.preventDefault();
			var url = document.getElementById("url").value;
			var formData = new FormData();
			formData.append("url", url);

			$.ajax({
				url: "upload-url.php",
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				cache: false,
				beforeSend: function () {
					$(".spinner-border").attr("style", "display: block; margin: 5px 20px;");
					$("#url").val('');
					$(".done").attr("style", "font-size: 35px; margin: 2px 15px; color: #28a745; display: none;");
				},
				success: function (data) {
					$(".spinner-border").attr("style", "display: none; margin: 5px 20px;");
					$(".done").attr("style", "font-size: 35px; margin: 2px 15px; color: #28a745; display: block;");
					$(".done").fadeOut(2000, function() {
						$(".done").attr("style", "font-size: 35px; margin: 2px 15px; color: #28a745; display: none;");
					});
					console.log(data);
				}
			});
		}

		else {
			event.preventDefault();
		}
	});
});