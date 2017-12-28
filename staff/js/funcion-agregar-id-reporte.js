	function tablaContenido(){
		var id_reporte = document.getElementById("id_reporte");
		console.log(id_reporte.value);
		var lugar_rempleza_tabla = document.getElementById("rubros");
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				//alert("Hola");
				lugar_rempleza_tabla.innerHTML = this.responseText;
				console.log("Hello");
			}
		};
		xhttp.open("POST", "php/tabla-rubros.php?id_reporte="+id_reporte.value, true);
		xhttp.send();
	}


function mostrarIdReporte(nodo)
{
	var xhttp;
	xhttp = new XMLHttpRequest();
	var id_reporte = document.getElementById("mostrar-id-reporte");
	if(id_reporte!=null){
    xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) 
		{
				id_reporte.innerHTML = this.responseText;
				tablaContenido();
			}
		};
		xhttp.open("GET", "php/select-id-reporte.php", true);
		xhttp.send();
	}
}
//Funcion qué agrega el porcentaje total
function mostrarPorcentajeTotal(){
	var xhttp;
	var id_reporte = document.getElementById("id_reporte");
	xhttp = new XMLHttpRequest();
	var place = document.getElementById("porcentaje_txt");//lugar donde pondremos el porcentaje-total
	console.log(place);
    xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) 
		{
			place.value = parseInt(this.responseText);
			place.value +="%";
		}
	};
	xhttp.open("GET", "php/porcentaje-total.php?id_reporte="+id_reporte.value, true);
	xhttp.send();
}