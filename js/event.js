// Eventos de interacción

$(document).ready(function(){

	// Subir archivos de manera local
	$("#fileInput").on("change", function(e){
		
		var files = $(this)[0].files;

		if(files.length >= 2) {
			$(".label-span").text(files.length + " archivos listos para subir")
		}
		else if(files.length == 1) {
			var filename = e.target.value.split('\\').pop();
			$(".label-span").text(filename);
		}
		else {
			$(".label-span").html("<i class='fas fa-upload'></i> Ningún archivo seleccionado");
		}
	});

	//	Correción de bordes del botón Upload URL
	$(".upload-url").mousedown(function(){
		$(this).css({"box-shadow": "none", "border": "5px solid #196388", "background": "#196388"});
	});
	$(".upload-url").mouseup(function(){
		$(this).css({"box-shadow": "none", "border": "5px solid #2AAEF0", "background": "#2AAEF0"});
	});
});