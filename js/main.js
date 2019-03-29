$(document).ready(function(){

	// Declaración de valores de peso de los diferentes formatos disponibles
	// Nota: poner los valores en Bytes, para saber el quivalente en bytes visite esta web:
	// https://es.calcuworld.com/informatica/calculadora-de-bytes/
	const jpg = 2097152;
	const png = 2097152;
	const mp3 = 6291456;
	const mp4 = 26214400;
	const gif = 2097152;
	const bmp = 2097152;
	const pdf = 1048576;
	const txt = 716800;
	const html = 716800;
	const css = 716800;
	const js = 1048576;
	const php = 716800;
	const ogg = 6291456;
	const aac = 6291456;
	const m4a = 6291456;
	const rar = 31457280;
	const zip = 31457280;
	const flv = 26214400;
	const swf = 6291456;

	function bytesToSize(bytes) {
	    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	    if (bytes == 0) return 'n/a';
	    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	    if (i == 0) return bytes + ' ' + sizes[i];
	    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i]; // Función para convertir Bytes a su tamaño aproximado
	}

	function bytesToSizeCalc(bytes) {
	    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	    if (bytes == 0) return 'n/a';
	    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	    if (i == 0) return bytes + ' ' + sizes[i];
	    return (bytes / Math.pow(1024, i)).toFixed(1); // Función para hacer cálculos con Bytes
	}

	function modalAlert(format, size) {
		$(".modal-title").text("Límite superado");
		$(".modal-body").text("Asegurese de que los archivos ."+format+" no pesen más de "+bytesToSize(size)+"");
		$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
		$('#exampleModal').modal('show');
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
						}, false);
						return xhr;
					},
					success: function (data) {
						// Ajax recoge los datos es en esta función y le da X uso.
						$(".archivo:last-child").html("<div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+data+"</span><span class='progress-file' style='color: #28a745;'>100%</span><span class='length-file'>"+bytesToSize(archivos[1].size)+"/"+bytesToSize(archivos[1].size)+"</span></div>");

						if (archivos.length > 2) {
							if (archivos[2].type == "image/png") {
								if (archivos[2].size > png) {
									modalAlert("png", png);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "image/jpeg") {
								if (archivos[2].size > jpg) {
									modalAlert("jpg", jpg);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "audio/mp3") {
								if (archivos[2].size > mp3) {
									modalAlert("mp3", mp3);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "video/mp4") {
								if (archivos[2].size > mp4) {
									modalAlert("mp4", mp4);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "image/gif") {
								if (archivos[2].size > gif) {
									modalAlert("gif", gif);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "image/x-ms-bmp") {
								if (archivos[2].size > bmp) {
									modalAlert("bmp", bmp);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "application/pdf") {
								if (archivos[2].size > pdf) {
									modalAlert("pdf", pdf);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "text/plain") {
								if (archivos[2].size > txt) {
									modalAlert("txt", txt);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "text/css") {
								if (archivos[2].size > css) {
									modalAlert("css", css);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "application/javascript") {
								if (archivos[2].size > js) {
									modalAlert("js", js);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "text/html") {
								if (archivos[2].size > html) {
									modalAlert("html", html);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "text/php") {
								if (archivos[2].size > php) {
									modalAlert("php", php);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "audio/ogg") {
								if (archivos[2].size > ogg) {
									modalAlert("ogg", ogg);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "audio/aac") {
								if (archivos[2].size > aac) {
									modalAlert("aac", aac);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "audio/m4a") {
								if (archivos[2].size > m4a) {
									modalAlert("m4a", m4a);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "application/rar") {
								if (archivos[2].size > rar) {
									modalAlert("rar", rar);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "application/zip") {
								if (archivos[2].size > zip) {
									modalAlert("zip", zip);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "video/x-flv") {
								if (archivos[2].size > flv) {
									modalAlert("flv", flv);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else if (archivos[2].type == "application/x-shockwave-flash") {
								if (archivos[2].size > swf) {
									modalAlert("swf", swf);
								}
								else {
									peticionAJAXThirdOnion(2);
								}
							}
							else {
								$(".modal-title").text("Formato de archivo no permitido");
								$(".modal-body").text("Asegure de que los archivo tengan uno de los formatos permitidos: .PNG, .JPG, .MP3, .MP4, .GIF, .BMP, .PDF, .TXT, .CSS, .JS, .HTML, .PHP, .OGG, .AAC, .M4A, .RAR, .ZIP, .FLV, .SWF");
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
						// AJAX recoge los datos es en esta función y le da X uso.
						$(".archivo:last-child").html("<div class='nombre'><span class='nombre-txt'>Nombre</span></div><div class='datos row'><span class='name-file'>"+data+"</span><span class='progress-file' style='color: #28a745;'>100%</span><span class='length-file'>"+bytesToSize(archivos[0].size)+"/"+bytesToSize(archivos[0].size)+"</span></div>");

						if (archivos.length > 1) {
							if (archivos[1].type == "image/png") {
								if (archivos[1].size > png) {
									modalAlert("png", png);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "image/jpeg") {
								if (archivos[1].size > jpg) {
									modalAlert("jpg", jpg);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "audio/mp3") {
								if (archivos[1].size > mp3) {
									modalAlert("mp3", mp3);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "video/mp4") {
								if (archivos[1].size > mp4) {
									modalAlert("mp4", mp4);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "image/gif") {
								if (archivos[1].size > gif) {
									modalAlert("gif", gif);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "image/x-ms-bmp") {
								if (archivos[1].size > bmp) {
									modalAlert("bmp", bmp);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "application/pdf") {
								if (archivos[1].size > pdf) {
									modalAlert("pdf", pdf);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "text/plain") {
								if (archivos[1].size > txt) {
									modalAlert("txt", txt);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "text/css") {
								if (archivos[1].size > css) {
									modalAlert("css", css);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "application/javascript") {
								if (archivos[1].size > js) {
									modalAlert("js", js);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "text/html") {
								if (archivos[1].size > html) {
									modalAlert("html", html);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "text/php") {
								if (archivos[1].size > php) {
									modalAlert("php", php);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "audio/ogg") {
								if (archivos[1].size > ogg) {
									modalAlert("ogg", ogg);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "audio/aac") {
								if (archivos[1].size > aac) {
									modalAlert("aac", aac);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "audio/m4a") {
								if (archivos[1].size > m4a) {
									modalAlert("m4a", m4a);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "application/rar") {
								if (archivos[1].size > rar) {
									modalAlert("rar", rar);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "application/zip") {
								if (archivos[1].size > zip) {
									modalAlert("zip", zip);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "video/x-flv") {
								if (archivos[1].size > flv) {
									modalAlert("flv", flv);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else if (archivos[1].type == "application/x-shockwave-flash") {
								if (archivos[1].size > swf) {
									modalAlert("swf", swf);
								}
								else {
									peticionAJAXSecondOnion(1);
								}
							}
							else {
								$(".modal-title").text("Formato de archivo no permitido");
								$(".modal-body").text("Asegure de que los archivo tengan uno de los formatos permitidos: .PNG, .JPG, .MP3, .MP4, .GIF, .BMP, .PDF, .TXT, .CSS, .JS, .HTML, .PHP, .OGG, .AAC, .M4A, .RAR, .ZIP, .FLV, .SWF");
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

			if (archivos.length > 3) { // En caso de no exceder el límite procede a ejecutar X code
				// Muestra la advertencia de excesión de archivos
				$(".modal-title").text("Límite de archivos excedido");
				$(".modal-body").text("Asegurese de seleccionar no más de tres archivos por carga.");
				$('#exampleModal').modal('show');
				$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
			}
			else { // Si es menor o igual a 3 archivos ejecuta las peticiones
				// Primera capa de validaciones de formato y tamaño de archivo
				if (archivos[0].type == "image/png") {
					if (archivos[0].size > png) {
						modalAlert("png", png);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "image/jpeg") {
					if (archivos[0].size > jpg) {
						modalAlert("jpg", jpg);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "audio/mp3") {
					if (archivos[0].size > mp3) {
						modalAlert("mp3", mp3);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "video/mp4") {
					if (archivos[0].size > mp4) {
						modalAlert("mp4", mp4);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "image/gif") {
					if (archivos[0].size > gif) {
						modalAlert("gif", gif);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "image/x-ms-bmp") {
					if (archivos[0].size > bmp) {
						modalAlert("bmp", bmp);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "application/pdf") {
					if (archivos[0].size > pdf) {
						modalAlert("pdf", pdf);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "text/plain") {
					if (archivos[0].size > txt) {
						modalAlert("txt", txt);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "text/css") {
					if (archivos[0].size > css) {
						modalAlert("css", css);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "application/javascript") {
					if (archivos[0].size > js) {
						modalAlert("js", js);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "text/html") {
					if (archivos[0].size > html) {
						modalAlert("html", html);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "text/php") {
					if (archivos[0].size > php) {
						modalAlert("php", php);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "audio/ogg") {
					if (archivos[0].size > ogg) {
						modalAlert("ogg", ogg);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "audio/aac") {
					if (archivos[0].size > aac) {
						modalAlert("aac", aac);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "audio/m4a") {
					if (archivos[0].size > m4a) {
						modalAlert("m4a", m4a);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "application/rar") {
					if (archivos[0].size > rar) {
						modalAlert("rar", rar);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "application/zip") {
					if (archivos[0].size > zip) {
						modalAlert("zip", zip);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "video/x-flv") {
					if (archivos[0].size > flv) {
						modalAlert("flv", flv);
					}
					else {
						peticionAJAX(0);
					}
				}
				else if (archivos[0].type == "application/x-shockwave-flash") {
					if (archivos[0].size > swf) {
						modalAlert("swf", swf);
					}
					else {
						peticionAJAX(0);
					}
				}
				else {
					$(".modal-title").text("Formato de archivo no permitido");
					$(".modal-body").text("Asegure de que los archivo tengan uno de los formatos permitidos: .PNG, .JPG, .MP3, .MP4, .GIF, .BMP, .PDF, .TXT, .CSS, .JS, .HTML, .PHP, .OGG, .AAC, .M4A, .RAR, .ZIP, .FLV, .SWF");
					$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
					$('#exampleModal').modal('show');				
				}
			}
		}
		else {
			event.preventDefault();
		} // Petición de subir archivos localmente
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
				}
			});
		}
		else {
			event.preventDefault();
		} // Petición de subir archivos online 'URL'
	});

	$("#list-view-form").submit(function (event) {
		if ($("#desde").val() && $("#hasta").val()) {
			if ($("input[type=radio][name=SelectFormat]:checked").val()) {
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
								$("#view").append("<div class='row'><div class='col-md-8 col-sm-12'><span><em>"+ url +"</em></span></div><div class='col-md-4 col-sm-12'><span style='font-weight: bold;'>"+ name +"</span></div></div>");
							}
						}
					}
				});
			}
			else {
				event.preventDefault();
				$("#desde, #hasta").val("");
				$("#alerts-delete").fadeIn(1000, function () {
					$(this).html("<div class='alert alert-warning' role='alert' style='position: absolute;'>Te has olvidado de seleccionar el formato del archivo</div><br><br><br>");
					$(this).delay(2500).fadeOut(1000, function () {
						$(this).html("");
					});
				});
			}
		}
		else {
			event.preventDefault();
		} // Petición de obtener datos de archivos por rango
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
				$(this).delay(2500).fadeOut(1000, function () {
					$(this).html("");
				});
			});
		} // Petición de obtener datos de todos los archivos
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
					$("#delInput").val("");
					if (data == 200) {
						$("#alerts-delete").fadeIn(1000, function () {
							$(this).html("<div class='alert alert-success' role='alert' style='position: absolute;'>El archivo ha sido eliminado con éxito</div><br><br><br>");
							$(this).delay(2000).fadeOut(1000, function () {
								$(this).html("");
							});

						});
					}
					else if (data == 404) {
						$("#alerts-delete").fadeIn(1000, function () {
							$(this).html("<div class='alert alert-danger' role='alert' style='position: absolute;'>El archivo no se encuentra o ya ha sido eliminado</div><br><br><br>");
							$(this).delay(2000).fadeOut(1000, function () {
								$(this).html("");
							});

						});
					}
					else { console.log("Error desconocido"); }
					console.log(data);
				}
			});
		}
		else {
			event.preventDefault();
			$("#alerts-delete").fadeIn(1000, function () {
				$(this).html("<div class='alert alert-warning' role='alert' style='position: absolute;'>Te has olvidado de seleccionar el formato del archivo</div><br><br><br>");
				$(this).delay(2500).fadeOut(1000, function () {
					$(this).html("");
				});

			});
		}  // Petición para eliminar datos de archivos
	});
	
});