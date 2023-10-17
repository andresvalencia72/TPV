
<?php
require_once "funciones.php";



$respuesta = ejecutaSQL($orden);
echo "<h2>Quien eres?</h2>";
while ($campo = $respuesta->fetch_array()) {
    $consumiciones=array();
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