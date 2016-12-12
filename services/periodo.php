<?php
include '../database/periodoData.php';
$today = date("Y-m-d");
$today2 = date("Y-m-d H:i:s");
$data = periodoData::getAll();
//echo date('Y-m-d', strtotime($data[0]["fechainicio"] . ' -1 day')) ."<br>";
//echo $data[0]["fechainicio"] ."<br>";
//echo $data[0]["fechainicio"] . ' -1 day';
//$stop_date = strtotime($data[0]["fechainicio"] . ' -1 day');

$today_time = new DateTime($today);
$exact_time = new DateTime($today2);
$fechainicio = new DateTime($data[0]["fechainicio"]);//->modify('+1 day');->format('Y-m-d H:i:s');
$fechainicioantes = new DateTime($data[0]["fechainicio"] . ' -1 day');
$fechafinal = new DateTime($data[0]["fechafinal"]);
$fechafinalantes = new DateTime($data[0]["fechafinal"] . ' -1 day');

echo "Hora actual: ".$exact_time->format('Y-m-d H:i:s') . " <br> \n";

if ($today_time == $fechainicioantes) { 
    echo $today_time->format('Y-m-d H:i:s') . " = ". $fechainicioantes->format('Y-m-d H:i:s');
    // A todos los usuarios activos  se les genera una notificacion y en caso de ser nesesario se envia un correo
    echo "antes fecha inicio";
}
if ($today_time == $fechainicio) { 
    echo $today_time->format('Y-m-d H:i:s') . " = ".$fechainicio->format('Y-m-d H:i:s');
    echo "hoy es la fecha inicio";
}
if ($today_time == $fechafinalantes) { 
    echo $today_time->format('Y-m-d H:i:s') . " = ".  $fechafinalantes->format('Y-m-d H:i:s');
    echo "antes de la fecha final";
}
if ($today_time == $fechafinal) { 
    echo $today_time->format('Y-m-d H:i:s') . " = ". $fechafinal->format('Y-m-d H:i:s');
    echo "hoy es la fecha final";
}
//if($data['fechainicio'] == date('Y-M-D')){
//    echo "prueba";
//}