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

	$("#list-view-form").submit(function (event) {
		if ($("#desde").val() && $("#hasta").val()) {
			if ($("input[type=radio]:checked").val()) {
				event.preventDefault();

				var desde = document.getElementById("desde").value;
				var hasta = document.getElementById("hasta").value;
				var radio = $("input[type=radio]:checked").val();

				var formData = new FormData();
				formData.append("desde", desde);
				formData.append("hasta", hasta);
				formData.append("radio", radio);

				$.ajax({
					url: "list-view.php",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					cache: false,
					success: function (data) {
						$("#view").html("");

						if (data == false) {
							$("#view").append("<div class='row'><div class='col-md-8 col-sm-12'><span><em style='color: #dc3545; font-weight: bold;'>Archivos no encontrados en el rango</em></span></div></div>");	
						}
						else {
							var info = JSON.parse(data);
							for( var key in info) {
								var url = info[key][0];
								var name = info[key][1];
								console.log("URL => " + url + " Nombre => " + name);
								$("#view").append("<div class='row'><div class='col-md-8 col-sm-12'><span><em>"+ url +"</em></span></div><div class='col-md-4 col-sm-12'><span style='font-weight: bold;'>"+ name +"</span></div></div>");
							}
						}
					}
				});
			}
			else {
				event.preventDefault();
				$("#alerts-delete").fadeIn(1000, function () {
					$(this).html("<div class='alert alert-warning' role='alert' style='position: absolute;'>Te has olvidado de seleccionar el formato del archivo</div><br><br><br>");
					$(this).delay(2500).fadeOut(1000);
				});
			}
		}
		else {
			event.preventDefault();
		}
	});

	$("#list-view-all").submit(function (event) {
		if ($("input[type=radio][name=SelectFormat2]:checked").val()) {
			event.preventDefault();
			var radio = $("input[type=radio][name=SelectFormat2]:checked").val();

			var formData = new FormData();
			formData.append("radio", radio);

			$.ajax({
				url: "list-view-all.php",
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				cache: false,
				success: function (data) {
					if (data == 404) {
						console.log(data);
						$("#view").html("<div class='row'><div class='col-md-8 col-sm-12'><span><em style='color: #dc3545; font-weight: bold;'>No hay archivos de este formato</em></span></div></div>");
					}
					else {
						var info = JSON.parse(data);
						$("#view").html("");

						for( var key in info) {
							var url = info[key][0];
							var name = info[key][1];
							$("#view").append("<div class='row'><div class='col-md-8 col-sm-12'><span><em>"+ url +"</em></span></div><div class='col-md-4 col-sm-12'><span style='font-weight: bold;'>"+ name +"</span></div></div>")
						}
					}
				}
			});
		}
		else {
			event.preventDefault();
			$("#alerts-delete").fadeIn(1000, function () {
				$(this).html("<div class='alert alert-warning' role='alert' style='position: absolute;'>Te has olvidado de seleccionar el formato del archivo</div><br><br><br>");
				$(this).delay(2500).fadeOut(1000);
			});
		}
	});

	$("#delete").submit(function (event) {
		if ($("input[type=radio][name=SelectFormat3]:checked").val()) {
			event.preventDefault();

			var radio = $("input[type=radio][name=SelectFormat3]:checked").val();
			var delInput = document.getElementById("delInput").value;
			var formData = new FormData();
			formData.append("radio", radio);
			formData.append("input", delInput)

			$.ajax({
				url: "delete-files.php",
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				cache: false,
				success: function (data) {
					if (data == 200) {
						$("#alerts-delete").fadeIn(1000, function () {
							$(this).html("<div class='alert alert-success' role='alert' style='position: absolute;'>El archivo ha sido eliminado con éxito</div><br><br><br>");
							$(this).delay(2000).fadeOut(1000);
						});
					}
					else if (data == 404) {
						$("#alerts-delete").fadeIn(1000, function () {
							$(this).html("<div class='alert alert-danger' role='alert' style='position: absolute;'>El archivo no se encuentra o ya ha sido eliminado</div><br><br><br>");
							$(this).delay(2000).fadeOut(1000);
						});
					}
				}
			});
		}
		else {
			event.preventDefault();
			$("#alerts-delete").fadeIn(1000, function () {
				$(this).html("<div class='alert alert-warning' role='alert' style='position: absolute;'>Te has olvidado de seleccionar el formato del archivo</div><br><br><br>");
				$(this).delay(2500).fadeOut(1000);
			});
		}
	});
	
});