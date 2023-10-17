<?php
require_once "funciones.php";

$conexion = conecta();
$orden = "SELECT cod_empleado,nombre FROM empleados where activo=1";
$respuesta = ejecutaSQL($orden);
echo "<h2>Quien eres?</h2>";
while ($campo = $respuesta->fetch_array()) {
    $consumiciones=array();
    echo "<form action=home.php method=GET>
            <input type=image src=./img/" . $campo['nombre'] . ".jpg  width=150px>
            <input type=hidden name=cod_categoria value=0>
            <input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>
            <input type=hidden name=cod_empleado value='" . $campo['cod_empleado'] . "'>";
    echo '</form>';
}

?>