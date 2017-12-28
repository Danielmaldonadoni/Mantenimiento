<?php
//establecemos el timezone para obtener la hora local
//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
include("../php/conexion.php");
$tabla = "";
$tabla .= "<div class='container'>";
$control = 0;
$consulta = "SELECT
    R.id_reporte,
    R.titulo,
    R.descripcion,
    R.tienda,
    R.personal,
    R.fechaInicio,
    R.fechaTermino,
    CAL.servicio,
    CAL.calidad,
    CAL.velocidad,
    CAL.promedio
    FROM reportes AS R
    LEFT JOIN  encuesta_calificacion_servicio as CAL
    on CAL.id_reporte=R.id_reporte";
    $ejecutar_consulta = $conexion->query($consulta);
    if($ejecutar_consulta){
        $tabla .= "<table class='table-hover table table-condensed'>";
            $tabla .= "<figcaption>";
                $tabla .= "Reporte general de mantenimiento.";
            $tabla .= "</figcaption>";
            $tabla .= "<thead>";
                $tabla .= "<tr class='cabecera'>";
                    $tabla .= "<td>";
                        $tabla .= "No reporte";
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= utf8_decode("Título");
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= utf8_decode("Descripción");
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= "Tienda";
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= "Personal";
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= utf8_decode("Inició");
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= utf8_decode("Terminó");
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= "Servicio";
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= "Calidad";
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= "Velocidad";
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= "Promedio";
                    $tabla .= "</td>";
                $tabla .= "</tr>";
            $tabla .= "</thead>";
            $tabla .= "<tbody>";
        while($filas = $ejecutar_consulta->fetch_assoc()){
            $tabla .= "<tr>";
                $tabla .= "<td>";
                    $tabla .= $filas["id_reporte"];
                $tabla .= "</td>";
                $tabla .= "<td>";
                    $tabla .= utf8_decode($filas["titulo"]);
                $tabla .= "</td>";
                $tabla .= "<td>";
                    $tabla .= utf8_decode($filas["descripcion"]);
                $tabla .= "</td>";
                $tabla .= "<td>";
                    $tabla .= utf8_decode($filas["tienda"]);
                $tabla .= "</td>";
                $tabla .= "<td>";
                    $tabla .= utf8_decode($filas["personal"]);
                $tabla .= "</td>";
                $tabla .= "<td>";
                    $tabla .= $filas["fechaInicio"];
                $tabla .= "</td>";
                $tabla .= "<td>";
                    $tabla .= $filas["fechaTermino"];
                $tabla .= "</td>";
                if($filas["servicio"]=='' && $filas["calidad"]=='' && $filas["velocidad"]==''){
                    $tabla .= "<td style='text-align:center;' colspan='3'>";
                        $tabla .= "Sin contestar";
                    $tabla .= "</td>";
                }else{
                    $tabla .= "<td>";
                        $tabla .= $filas["servicio"];
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= $filas["calidad"];
                    $tabla .= "</td>";
                    $tabla .= "<td>";
                        $tabla .= $filas["velocidad"];
                    $tabla .= "</td>";              
                }
                $tabla .= "<td>";
                    $tabla .= round($filas["promedio"], 2);
                $tabla .= "</td>";
            $tabla .= "</tr>";
        }
        $tabla .= "</tbody>";
    $tabla .= "</table>";
    $tabla .= "</div>";
    print $tabla;
}else{
    print $consulta;
}
?>