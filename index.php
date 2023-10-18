<?php
require_once "funciones.php";

// hacer inserción en la bbdd de la venta
if (isset($_GET['cobrar'])) {
    $cod_emp = $_GET['cod_empleado'];
    $fecha = $_GET['fecha'];
    $consumiciones = unserialize($_GET['consumiciones']);



    insertarPago($cod_emp, $fecha);
    $cod_ticket = obtenerCodTicket();
    // print_r($cod_ticket);
    
    // foreach ($consumiciones as $indice => $valor) {
    //     $cod_art = $indice;
    //     $cantidad = $valor['cantidad'];
    //     $precio = $valor['precio'];
    //     insertarLineaTickets($cod_ticket,$cod_art, $cantidad,$precio);

    // }
}



$respuesta = mostrarEmpleadosActivos();
echo "<h2>Quien eres?</h2>";
while ($campo = $respuesta->fetch_array()) {
    $consumiciones = array();
    echo "<form action=home.php method=GET>
            <input type=image src=./img/" . $campo['cod_empleado'] . ".jpg  width=150px>
            <input type=hidden name=cod_categoria value=0>
            <input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>
            <input type=hidden name=cod_empleado value='" . $campo['cod_empleado'] . "'>";
    echo '</form>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>

</body>

</html>