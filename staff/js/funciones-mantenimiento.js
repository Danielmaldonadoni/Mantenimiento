 ////////////////////////////Función inicializar calendario////////////////////////////
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha_inicio").datepicker();
$("#fecha_termino").datepicker();
});
$(document).on("keyup", "#fecha_inicio", function(){
	$("#fecha_inicio").datepicker();
});
////////////////////////////////////Termina funciones del calendario/////////////////////////////
////////////////////////////////////Inicia función para aceptar el tooltip////////////////////////
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});
////////////////////////////////////Finaliza función de tooltip//////////////////////////////////
////////////////////////////////////Inicia funciones ocupadas en la alta de reporte//////////////
	$(document).ready(function(){
		mostrarIdReporte();
		//iniciar();
	});
	//función que agrega la lista opcional del estatus
	$(document).on("click", ".status", function(){
		var id = $(this).attr("id");//obtenemos el atributo id del elemento
		$("span.status").removeClass("status").addClass("temporal");//quitamos la clase status de los demas campos para que solo modifique uno
		//$("td.editable").removeClass("status").addClass("temporal");
		//Agregamos nuevo código html con el select que muestra las opciones del estatus 
		$(this).html("<select class='form-control' id='status"+id+"'><option style='color:#F1F1F1;'>Status</option><option>Pendiente</option><option>Programado</option><option>Realizado</option></select><a id='"+id+"' class='guardar actualizar-status enlace' >Guardar&nbsp;</a><a class='cancelar actualizar-status enlace'>Cancelar</a>");
		//alert("Hola"+id);
	});
	//Si dio click en el enlace guardar
	$(document).on("click", ".guardar", function(){
		//Obtenemos su atributo id para saber a que fila afectar en la tabla de la base de datos
		var id = $(this).attr("id");
		var status_presionado = document.getElementById("status"+id)
		var control = 0;
		var xhttp;
        //console.log(id);
        //console.log(status_presionado);
        if(status_presionado.value=="Status"){//Si es igual a Status el valor entonces viene vacio y mandamos el alert
        	alert("Seleccione un status");
        	control=1;
        }

        if(control==1){

        }else{
        	xhttp = new XMLHttpRequest();
        	xhttp.onreadystatechange = function(){
        		if(this.readyState == 4 && this.status == 200){
        			alert(this.responseText);
        			tablaContenido();
        		}
        	};
        	xhttp.open("POST", "php/actualizar-status.php?id_temporal="+id+"&status="+status_presionado.value, true);
        	xhttp.send();
        }

	});
	//Si dio un click en el enlace cancelar
	$(document).on("click", ".cancelar", function(){
		$("span.temporal").removeClass("temporal").addClass("status");//Regresamos la clase temporal
		tablaContenido();
	});

	function agregarTarea(id_reporte, id_rubro){

		var id_usuario = document.getElementById("id_usuario");
		var descripcion = document.getElementById("descripcion-"+id_reporte+"-"+id_rubro);
		var calificacion = document.getElementById("calificacion-"+id_reporte+"-"+id_rubro);
		var status = document.getElementById("status-"+id_reporte+"-"+id_rubro);
		var xhttp;
		var control = 0;
		console.log(document.getElementById("principal"));
		if(status.value=="Status"){
			alert("Seleccione un status");
			control = 1;
		}
		if(descripcion.textContent==""){
			alert("Ingrese una descripción");
			control=1;
		}
		//console.log(calificacion.textContent);

		//console.log(status.value);
		if(control==1){

		}else{
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					//document.getElementById("rubros").innerHMTL = this.responseText;
					//window.location="?op=alta";
					tablaContenido();
				}
			};
			xhttp.open("POST", "php/agregarTarea.php?id_reporte="+id_reporte+"&id_rubro="+id_rubro+"&descripcion="+descripcion.textContent+"&status="+status.value+"&id_usuario="+id_usuario.value, true);
			xhttp.send();
		}
	}
	function eliminarTarea(id_temporal){
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				tablaContenido();
			}

		};
		xhttp.open("POST", "php/eliminarTarea.php?id_temporal="+id_temporal, true);
		xhttp.send();
	}
	$(document).on("click", ".alta", function(){//función que agrega input oculto con idreporte dentro del formulario
		//alert("Hi");
		var id_reporte = document.getElementById("id_reporte");
		var lugar_reporte = document.getElementById("lugar-reporte");
		//Se agrega en un div dentro de del formmulario y ya lo podemos recibir desde el archivo php que recibe varibles
		lugar_reporte.innerHTML = "<input type='hidden' name='id_reporte' value='"+id_reporte.value+"' />"
		//alert(""+id_reporte.value);
	});
///////////////////////////////////////Finalizan las funciones ocupadas en la alta de reporte
////////////////////////////////////////Inicio de funciones para listado de reportes///////////////////////////////////
	$(document).ready(function(){
		var lugar_listar_reportes = document.getElementById("listado-reportes");
		if(lugar_listar_reportes==null){//validamos si el div para listar reportes existe
			//No hacemos nada si es null porque entonces estamos en otra seccion que no es la de listar reportes
		}else{//Si no es null entonces estamos en la sección de listar reportes y debe mostrar los reportes
			listarReportes(1);
		}
	});
	function listarReportes(num_pagina){
		var xhttp;
		var id_usuario = document.getElementById("id_usuario");
		var lugar_listar_reportes = document.getElementById("listado-reportes");
		var busqueda_slc = document.getElementById("busqueda_slc");
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				lugar_listar_reportes.innerHTML = this.responseText;
			}
		}
		xhttp.open("POST", "php/paginacion-reportes.php?id_usuario="+id_usuario.value+"&opcion="+busqueda_slc.value+"&pagina="+num_pagina, true);
		xhttp.send();
	}
			$(document).on("click",".presionar", function(e){//muestra ventana-emergente al presionas sobre el numero de reporte
			var lugar_mostrar_datos_ventana = document.getElementById("mostrar-ventana-emergente-reporte");
			var xhttp;
			var id_reporte = $(this).attr("id");
			var id_usuario = document.getElementById("id_usuario");
			//alert(id_reporte);
			//alert(id_usuario.value);
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					//alert(this.responseText);
					lugar_mostrar_datos_ventana.innerHTML = this.responseText;
					mostrarPorcentajeTotal(id_reporte);
				}
			};
			xhttp.open("POST", "php/ventana-emergente-reporte.php?id_usuario="+id_usuario.value+"&id_reporte="+id_reporte, true);
			xhttp.send();
		});
////////////////////////////////////Fin de funciones de listado de reportes//////////////////////////////////////
////////////////////////////////////Inicio de funciones para actualizar el estatus desde listado de reportes/////
	//función que agrega la lista opcional del estatus
	$(document).on("click", ".status-modal", function(){
		var id = $(this).attr("id");//obtenemos el atributo id del elemento
		$("span.status-modal").removeClass("status-modal").addClass("bitacora");//quitamos la clase status de los demas campos para que solo modifique uno
		$("td.editable").removeClass("editable").addClass("bitacora-modal");
		//Agregamos nuevo código html con el select que muestra las opciones del estatus 
		$(this).html("<select class='form-control' id='status"+id+"'><option style='color:#F1F1F1;'>Status</option><option>Pendiente</option><option>Programado</option><option>Realizado</option></select><a id='"+id+"' class='enlace guardar-modal actualizar-status' >Guardar&nbsp;</a><a class='enlace cancelar-modal actualizar-status'>Cancelar</a>");
		//alert("Hola"+id);
	});
	//Si dio click en el enlace guardar
	$(document).on("click", ".guardar-modal", function(){
		//Obtenemos su atributo id para saber a que fila afectar en la tabla de la base de datos
		var id = $(this).attr("id");
		var status_presionado = document.getElementById("status"+id)
		var control = 0;
		var xhttp;
		var id_reporte = document.getElementById("id_reporte").value;
        //console.log(id);
        //console.log(status_presionado);
        if(status_presionado.value=="Status"){//Si es igual a Status el valor entonces viene vacio y mandamos el alert
        	alert("Seleccione un status");
        	control=1;
        }

        if(control==1){

        }else{
        	xhttp = new XMLHttpRequest();
        	xhttp.onreadystatechange = function(){
        		if(this.readyState == 4 && this.status == 200){
        			alert(this.responseText);
        			tablaTareasContenidoModal();
        			mostrarPorcentajeTotal(id_reporte);
        		}
        	};
        	xhttp.open("POST", "php/actualizar-status-modal.php?id_bitacora="+id+"&status="+status_presionado.value, true);
        	xhttp.send();
        }

	});
	//Si dio un click en el enlace cancelar
	$(document).on("click", ".cancelar-modal", function(){
		$("span.temporal").removeClass("temporal").addClass("status");//Regresamos la clase temporal
		tablaTareasContenidoModal();
	});

	function tablaTareasContenidoModal(){
		var id_reporte = document.getElementById("id_reporte");
		//alert(id_reporte.value);
		var tabla_modal = document.getElementById("tabla-tareas-modal");//obtenemos el elemento tabla que sera reemplazado
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				//alert("hi");
				tabla_modal.innerHTML = this.responseText;
			}
		};
		xhttp.open("POST", "php/tabla-reporte-ventana-emergente.php?id_reporte="+id_reporte.value, true);//solo enviamos el id_reporte
		xhttp.send();//Realizamos la petición con está función
	}
////////////////////////////////////Fin de funciones para actualizar el estatus desde listado de reportes////////

///////////////Inicio de función para mostrar el porcentaje total de los trabajos realizados///////////////////////
function mostrarPorcentajeTotal(id_reporte){
	var input_porcentaje = document.getElementById("porcentaje_total_txt");
	//input_porcentaje.value="Hola";
	//var id_usuario = document.getElementById("id_usuario");
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 &&  this.status == 200){
			//alert(this.responseText);
			input_porcentaje.value = this.responseText;
		}
	}
	xhttp.open("POST", "php/mostrar-porcentaje-total.php?id_reporte="+id_reporte);
	xhttp.send();
}
///////////////Fin de función de porcentaje total de los trabajos realizados///////////////////////////////////////
///////////////Inicio de función para realizar búsqueda////////////////////////////////////////////////////////////
$(document).on("change", "#busqueda_slc", function(){
	//alert("Hey");
	var busqueda_slc = document.getElementById("busqueda_slc");//Obtenemos la lista
	var div_a_reemplazar_listado_reportes = document.getElementById("listado-reportes");
	var id_usuario = document.getElementById("id_usuario");
	var xhttp;//creamos variable para hacer la petición con ajax
	if(!busqueda_slc.value){

	}else{
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status== 200){
				$("#listado-reportes").fadeOut(100);
				div_a_reemplazar_listado_reportes.innerHTML = this.responseText;
				$("#listado-reportes").fadeIn(2000);
			}
		};
		xhttp.open("POST", "php/paginacion-reportes.php?id_usuario="+id_usuario.value+"&opcion="+busqueda_slc.value+"&pagina=1", true);
		xhttp.send();
	}
	//alert(busqueda_slc.value);
});
///////////////Fin de función para realizar búsquedad//////////////////////////////////////////////////////////////