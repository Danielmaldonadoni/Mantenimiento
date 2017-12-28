$(document).ready(function(){
	listarReportes(1);//para que nos muestre los reporte mandamos a llamar la función listarReporte()pasando como parametro el número 1 que indica la página inicial para mostrar reportes
});

//Esta función lista los reportes enviado la tienda y el numero de pagina a mostrar
function listarReportes(num_pagina){
	var lugar_mostrar_tabla = document.getElementById("tabla-listado");
	var tienda = document.getElementById("tienda");
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			lugar_mostrar_tabla.innerHTML = this.responseText;
		}
	}
	xhttp.open("POST", "php/tabla-listado-reportes.php?num_pagina="+num_pagina+"&tienda="+tienda.value, true);
	xhttp.send();
}
////////////////////////Fin de la función que lista los reportes
///////////////////////Función para mostrar la ventana emergente con la información///////////////
$(document).on("click", ".presionar", function(){
	var id_reporte = $(this).attr("id");
	var xhttp;
	var lugar_contenido_ventana_modal = document.getElementById("lugar_contenido_ventana_emergente");
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			lugar_contenido_ventana_modal.innerHTML = this.responseText
			mostrarPorcentajeTareasRealizadas();
		}
	}
	xhttp.open("POST", "php/ventana-emergente-reporte.php?id_reporte="+id_reporte, true);
	xhttp.send();
});
//////////////////////Fin de la función de la ventana emergente///////////////////////////////////
////////////////////////Inicio de función de mostrar porcentaje total tareas//////////////////////
function mostrarPorcentajeTareasRealizadas(){
	//alert("Hola desde tareas realizadas porcentaje");
	var id_reporte = document.getElementById("id_reporte");
	var xhttp;
	var lugar_mostrar_porcentaje_reporte = document.getElementById("porcentaje_total_txt");
	//alert(id_reporte.value;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			lugar_mostrar_porcentaje_reporte.value = this.responseText;
			encuestaCalificacionSatisfaccion();
		}
	};
	xhttp.open("POST", "php/consultar-porcentaje-tareas-realizadas.php?id_reporte="+id_reporte.value, true);
	xhttp.send();
}
////////////////////////Fin de función de mostrar de porcentaje total de acuerdo al status////////
////////////////////////Función para borrar el cero del campo calificación de la ventana emergente////
$(document).on("click", ".calificacion", function(){
	var id = $(this).attr("id");
	var valor = $(this).text();
	//alert(valor);
	if(valor=='0' || valor==''){
		$(this).text("");
	}
	//campo_calificacion.innerHTML = "";
});
////////////////////////Fin de la función que qui ta el cero al hacer click sobre el campo calificacion//
////////////////////////Inicio de la función de validación para la calificación/////////////////////
$(document).on("keyup", ".calificacion", function(){
	var valor = $(this).text();
	if(isNaN(valor) || valor=='0' || valor==''){
		$(this).text("");
	}else{
		var valor_parseado = parseInt(valor);
		if(valor_parseado>0 && valor_parseado<11){

		}else{
			alert("Solo se aceptan números del 1 al 10.");
			$(this).text("");
		}
	}
});
////////////////////////Fin de la función de validación de la calificación//////////////////////////
//////////////////////Inicio de función actualizar tarea//////////////////////////////////////////
$(document).on("click", ".actualizar-tarea", function(){
	var xhttp;
	var id_reporte = document.getElementById("id_reporte");
	var control = 1; /*Con esto validaremos si se realiza la actualización o no 1 es si y 0 no*/
	var id = $(this).attr("id");
	var comentarios = document.getElementById("comentarios"+id);
	var calificacion = document.getElementById("calificacion"+id);
	var radios_entregado_a_tiempo = document.getElementsByClassName("radios"+id);
	var valor_entregado_a_tiempo = "";
	for (var i = 0; i<radios_entregado_a_tiempo.length; i++) {
		if(radios_entregado_a_tiempo[i].checked == true){
			valor_entregado_a_tiempo = radios_entregado_a_tiempo[i].value;
		}
	}
	console.log("Tamanio del arrglo radios: "+radios_entregado_a_tiempo.length);
	console.log(comentarios.textContent);
	console.log(calificacion.textContent);
	if(calificacion.textContent=='' || calificacion.textContent == '0'){
		alert("El campo calificación es requerido.");
		document.getElementById("calificacion"+id).focus();
		control = 0;
	}else if(valor_entregado_a_tiempo==''){
		alert("Debe seleccionar al menos opción.");
		radios_entregado_a_tiempo[0].focus();
		control = 0;
	}
	//console.log(valor_entregado_a_tiempo);
	if(control==0){

	}else{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				document.getElementById("tabla-actualizar-bitacora").innerHTML = this.responseText;//Actualizamos la tabla
				//alert(this.responseText);
				$("#mensaje").fadeOut(3000);
				mostrarPorcentajeTareasRealizadas();
			}
		};
		xhttp.open("POST", "php/actualizar-bitacora.php?id_reporte="+id_reporte.value+"&comentarios="+comentarios.textContent+"&calificacion="+calificacion.textContent+"&entregado_a_tiempo="+valor_entregado_a_tiempo+"&id_bitacora="+id, true);
		xhttp.send();
	}
});
//////////////////////Fin de función actualizar tarea/////////////////////////////////////////////
//////////////función calificacion servicio///////////////////////////////////////////////////////
function encuestaCalificacionSatisfaccion(){
	var id_reporte = document.getElementById("id_reporte");
	var lugar_posicionar_encuesta = document.getElementById("encuesta-calificacion-satisfaccion");
	var xhttp;
	//alert("Hey");
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState = 4 && this.status == 200){
			$("#encuesta-calificacion-satisfaccion").addClass("fade");
			lugar_posicionar_encuesta.innerHTML = this.responseText;
			$("#encuesta-calificacion-satisfaccion").removeClass("fade");
			$("#encuesta-calificacion-satisfaccion").fadeOut();
			$("#encuesta-calificacion-satisfaccion").fadeIn(3000);
		}
	};
	xhttp.open("POST", "php/posicionar-encuesta.php?id_reporte="+id_reporte.value, false);
	xhttp.send();
}
/////////////Fin del afunción calificación servicio///////////////////////////////////////////////
//////////////Inicio de función para insertar la califcación de servicio/////////////////////////
$(document).on("click", ".insertar-calificacion-servicio", function(){
	var id_reporte = $(this).attr("id");
	console.log(id_reporte);
	var inputs_servicio = document.getElementsByClassName("servicio_rdo"+id_reporte);
	var inputs_calidad = document.getElementsByClassName("calidad_rdo"+id_reporte);
	var inputs_velocidad = document.getElementsByClassName("velocidad_rdo"+id_reporte);
	var servicio;
	var calidad;
	var velocidad;
	for (var i = 0; i<inputs_servicio.length; i++) {
		if(inputs_servicio[i].checked == true){
			servicio = inputs_servicio[i].value;
		}
	}
	for (var i = 0; i<inputs_calidad.length; i++) {
		if(inputs_calidad[i].checked == true){
			calidad = inputs_calidad[i].value;
		}
	}
	for (var i = 0; i<inputs_velocidad.length; i++) {
		if(inputs_velocidad[i].checked == true){
			velocidad = inputs_velocidad[i].value;
		}
	}
	//console.log(servicio);
	//console.log(calidad);
	//console.log(velocidad);
	if(servicio == "" && calidad == "" && velocidad == ""){
	}else{
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				document.getElementById("encuesta-calificacion-satisfaccion").innerHTML = this.responseText;
			}
		}
		xhttp.open("POST", "php/inserta-calificacion-servicio.php?id_reporte="+id_reporte+"&servicio="+servicio+"&calidad="+calidad+"&velocidad="+velocidad, false);
		xhttp.send();
	}
});
//////////////Fin de la función insertar calificación servicio///////////////////////////////////
////////////////////Función para no activar el submit del formulario de la encuesta de calificación servicio/////
function noHacerNada(){
	return false;
}
////////////////////Fin de la función para evitar submit de formulario calificación servicio/////////////////////