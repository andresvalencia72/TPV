<?php
require_once("funciones.php");
$ventas = array();
if (isset($_POST['jefe'])) {
    $contrasenia = $_POST['password'];
    if ($contrasenia == 'patata') {
        mostrarPanel();
    } else {
        header('Location:index.php');
    }
}

if(isset($_POST['fecha'])) {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $ventas = buscarProductosFechas($fecha_inicio, $fecha_fin);
   //  var_dump($ventas);
   while($valor = $ventas -> fetch_array()) {
      echo  ''.$valor[2];
   }
}

function mostrarPanel()
{
    echo "
    <a href=index.php>SALIR</a>
    <form method=post action=jefe.php>
        <label>Desde:</label>
        <input type=date name=fecha_inicio>
        <label>Hasta:</label>  
        <input type=date name=fecha_fin>
        <input type=submit name=fecha>
    </form>";

    

}


?>