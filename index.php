<?php
require_once "funciones.php";

// hacer inserción en la bbdd de la venta
if (isset($_POST['cobrar'])) {
    $cod_emp = $_POST['cod_empleado'];
    $fecha = $_POST['fecha'];
    $consumiciones = unserialize($_POST['consumiciones']);



    insertarPago($cod_emp, $fecha);
    $cod_ticket = obtenerCodTicket();
    $cod_ticket = $cod_ticket->fetch_assoc();
    $cod_ticket = $cod_ticket['max(cod_ticket)'];
    
    foreach ($consumiciones as $indice => $valor) {
        $cod_art = $indice;
        $cantidad = $valor['cantidad'];
        $precio = $valor['precio'];
        insertarLineaTickets($cod_ticket,$cod_art, $cantidad,$precio);

    }
}



$respuesta = mostrarEmpleadosActivos();
echo "<h2>Quien eres?</h2>";
while ($campo = $respuesta->fetch_array()) {
    $consumiciones = array();
    echo "<form action=home.php method=post>
            <input type=image src=./img/" . $campo['cod_empleado'] . ".jpg  width=150px>
            <input type=hidden name=cod_categoria value=0>
            <input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>
            <input type=hidden name=cod_empleado value='" . $campo['cod_empleado'] . "'>";
    echo '</form>';
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>

</body>

</html>