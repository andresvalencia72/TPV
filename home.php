<?php
require_once "funciones.php";

// Recibo los datos que necesito

$cod_empleado = $_GET['cod_empleado'];
$cod_categoria = $_GET['cod_categoria'];
$consumiciones = unserialize($_GET['consumiciones']);



if (isset($_GET['cod_articulo'])) {
    $cod_art = $_GET['cod_articulo'];
    $nombre_art =  $_GET['nombre_art'];
    $cantidad_art = $_GET['cantidad'];
    $precio_art = $_GET['precio'];
    // Compruebo si el articulo ya lo habia vendido anteriormente
    if(isset($consumiciones[$cod_art]['cantidad'])){
        $consumiciones[$cod_art]['cantidad']+=intval($cantidad_art);
    }else{
        $consumiciones[$cod_art]['nombre'] =  $nombre_art;
        $consumiciones[$cod_art]['cantidad']=intval($cantidad_art);
        $consumiciones[$cod_art]['precio']=$precio_art;

    }
    
}

// Muestro los datos. OJO: QUITAR QUE QUEDA FEO
echo "<h1>" . $cod_empleado . "</h1>";
echo "<h1>" . $cod_categoria . "</h1>";
// $format = 'D, d M Y H:i:s';

$fecha = date('Y-m-d');
echo $fecha ;

// var_dump($consumiciones);
// mostrar empleado 
$nombre = dimeNombre($cod_empleado);
while ($campo = $nombre->fetch_array()) {
    echo $campo['nombre'];
    echo '<br>';
}

// mostrar categorias
$categorias = mostrarCategorias();
while ($campo = $categorias->fetch_array()) {
    echo '<form action=home.php method=GET>';
    echo "<input type=submit value='" . $campo["tipo"] . "'>";
    // echo '<button type=submit>' . $campo["precio"] . '</button>';
    echo "<input type=hidden name=cod_empleado value='" . $cod_empleado . "'>";
    echo "<input type=hidden name=cod_categoria value='" . $campo['cod_tipo'] . "'>";
    echo "<input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>";
    echo '</form>';
}

//mostrar productos por categoría

$productos = mostrarProductos($cod_categoria);


if (isset($cod_categoria)) {
    if ($cod_categoria != 0) {
        $productos = mostrarProductos($cod_categoria);
        while ($campo = $productos->fetch_array()) {

            echo '<form action=home.php method=GET>';
            echo "<button type=submit>";
            echo "<p>" . $campo['nombre'] . "</p>";
            echo "<p>" . $campo["precio"] . "</p>";
            echo '</button>';
            echo '<select name=cantidad>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>';
            echo "<input type=hidden name=cod_empleado value='" . $cod_empleado . "'>";
            echo "<input type=hidden name=cod_articulo value='" . $campo['cod_art'] . "'>";
            echo "<input type=hidden name=nombre_art value='" . $campo['nombre'] . "'>";
            echo "<input type=hidden name=precio value='" . $campo['precio'] . "'>";

            echo "<input type=hidden name=cod_categoria value='" . $cod_categoria . "'>";
            echo "<input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>";
            // echo "<input type=hidden name=cantidad>";

            echo '</form>';
        }
    } else {
        echo '<h1>Aun no se ha seleccionado</h1>';
    }
}

//agregar un producto a ticket

// print_r($consumiciones);
echo '<form action=index.php method=get>';
foreach ($consumiciones as $indice => $valor) {
    echo $valor['nombre'];
    echo ':';
    echo $valor['cantidad'];
    echo ':';
    echo $valor['precio'];
    echo '<br>';
}


// calcular total
$total = 0;
// var_dump($consumiciones);

foreach ($consumiciones as  $indice  => $valor) {
    
    $total += $valor['cantidad']*$valor['precio'];
    
}
echo "<input type=hidden name=cod_empleado value='".$cod_empleado. "'>";
echo "<input type=hidden name=fecha value='".$fecha. "'>";
echo "<input type=hidden name=consumiciones value='".serialize($consumiciones). "'>";
// si se da a cobrar se entendera que fue pago por lo que el estado de activo sera 0 y si no sera 1
echo '<h2>total: '.$total.'</h2>';
echo '<input type=submit name=cobrar value=cobrar>';
echo '<input type=submit name=guardar value=guardar>';
echo '</form>';


// hacer inserción de pago en la BD







?>