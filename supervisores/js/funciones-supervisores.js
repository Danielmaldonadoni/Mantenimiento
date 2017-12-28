/*Funciones para supervisores con javascript creado por daniel 27-04-2017*/
///////////////////////función que agrega el listado de reportes///////////////////
function listadoReportes(num_pagina){
	var id_supervisor = document.getElementById("id_supervisor");
	var xhttp;
	if(id_supervisor.value==''){
		//No hacer nada si no hay id_reporte
		alert("No hacer nada");
	}else{
		//Si si hay id_reporte se puede hacer el listado
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				document.getElementById("listado-reportes").innerHTML = this.responseText;
				//alert(this.responseText);
			}
		};
		xhttp.open("POST", "php/listar-reportes.php?id_supervisor="+id_supervisor.value+"&num_pagina="+num_pagina, false);
		xhttp.send();
	}
}
///////////////////////Fin de la función que lista los reportes////////////////////
/////////////Esta función de jquery se ejecuta el código de adentro una véz que ha cargado la página//////////////
$(document).ready(function(){
	listadoReportes(1);

	////////Función del evento click en un Número de reporte//////////////
	$(document).on("click", ".presionar", function(){
		var id_reporte = $(this).attr("id");
		//alert(id_reporte)
		var lugar_poner_datos_ventana_emergente = document.getElementById("contenido-ventana-emergente");
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				lugar_poner_datos_ventana_emergente.innerHTML = this.responseText;
				window.location = "index.php#myModal";
			}
		};
		xhttp.open("POST", "php/datos-ventana-emergente.php?id_reporte="+id_reporte, false);
		xhttp.send();

	})
	////////Fin de la función del evento en No reporte////////////////////
});
/////////////Fin de la función que ejecuta el código una véz que ha cargado la página/////////////////////////////
/////////////Inicio de función que agrega una nueva tarea por parte del supervisor siempre y cuando este una tarea pendiente o programado//////
$(document).on("click", ".btn-agregar-tarea", function(){
	var id_reporte = $(this).attr("id");
	var rubro_slc = document.getElementById("rubro_slc");
	var descripcion_txt = document.getElementById("descripcion_txt");
	var lugar_mensaje = document.getElementById("mensaje");
	var xhttp;
	var control = 0;
	if(rubro_slc.value==''){
		$("#mensaje").html("Selecciona un rubro");
		$("#mensaje").fadeOut(100);
		$("#mensaje").removeClass("fade");
		$("#mensaje").fadeIn(1000);
		$("#mensaje").fadeOut(5000);		
		rubro_slc.focus();
		control = 1;
	}else{
		if(descripcion_txt.value==''){
			$("#mensaje").html("Agrega la descripci&oacute;n de la tarea");
			$("#mensaje").fadeOut(100);
			$("#mensaje").removeClass("fade");
			$("#mensaje").fadeIn(1000);
			$("#mensaje").fadeOut(5000);		
			descripcion_txt.focus();
			control = 1;
		}
	}
	if(control==1){
		//No hacer nada si se activo o cambio atrue control, tenemos un error o campo vacio
	}else{
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				lugar_mensaje.innerHTML = this.responseText;
				$("#mensaje").fadeOut(100);
				$("#mensaje").removeClass("fade");
				$("#mensaje").fadeIn(1000);
				$("#mensaje").fadeOut(5000);
				descripcion_txt.value="";
				setTimeout(actualizarTablaReportesVentanaEmergente(id_reporte), 5000);
			}
		};
		xhttp.open("POST", "php/insertar-tarea-reporte-por-supervisor.php?id_reporte="+id_reporte+"&rubro_slc="+rubro_slc.value+"&descripcion="+descripcion_txt.value, false);
		xhttp.send();
	}
});
/////////////Fin de la función que agrega tareas por parte del supervisor//////////////////////////////////////////////////////////////////////
////////////////////////Inicio función que actualiza las tablas de la ventana emergente/////////////////////////////////////////////////////////////
function actualizarTablaReportesVentanaEmergente(id_reporte){
	var lugar_poner_datos_actualizados_despues_agregar_tarea = document.getElementById("tareas-reporte");
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			lugar_poner_datos_actualizados_despues_agregar_tarea.innerHTML = this.responseText;
			$("#tareas-reporte").fadeOut(10);
			$("#tareas-reporte").fadeIn(3000);
			//window.location = "index.php#myModal";
		}
	};
	xhttp.open("POST", "php/actualiza-tabla-reportes-cuando-agrega-tareas-supervisor.php?id_reporte="+id_reporte, false);
	xhttp.send();
}
////////////////////////Fin de la función que actualiza las tablas de la ventana emergente//////////////////////////////////////////////////////////