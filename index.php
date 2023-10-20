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
        insertarLineaTickets($cod_ticket, $cod_art, $cantidad, $precio);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <title>Bar el Chema | Login</title>
</head>

<body>
    <header class="navegacion">
        <div class="wrapper ">
            <figure class="logo">
                <img src="img/Logo.svg" alt="logo bar el chema">
            </figure>
        </div>

    </header>

    <main>
        <section class="empleados">
            <!-- generar un article por cada empleado -->


            <!-- <form action="home.php">
                <label for="empleado">
                    <input type="image" src="img/1.jpg" id="empleado">
                    <p>nombre: <span>Chema</span></p>

                </label>
            </form> -->



            <?php

            $respuesta = mostrarEmpleadosActivos();
            while ($campo = $respuesta->fetch_array()) {
                $consumiciones = array();
                echo "<form action=home.php method=post>";
                echo "<label for=" . $campo['cod_empleado'] . " class=tarjeta_empleados>";
                echo "<input type=image src=./img/empleados/" . $campo['cod_empleado'] . ".jpg id=" . $campo['cod_empleado'] . " class=img_empleado>";
                echo "<input type=hidden name=cod_categoria value=0>";
                echo "<input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>";
                echo "<input type=hidden name=cod_empleado value='" . $campo['cod_empleado'] . "'>";
                echo "<p>nombre: <span>" . $campo['nombre'] . "</span></p>";
                echo "</label>";
                echo '</form>';
            }

            ?>
        </section>

    </main>


</body>

</html>