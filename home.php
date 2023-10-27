<?php
require_once "funciones.php";

// Recibo los datos que necesito

$cod_empleado = $_POST['cod_empleado'];
$cod_categoria = $_POST['cod_categoria'];
$consumiciones = unserialize($_POST['consumiciones']);


if (isset($_POST['cod_articulo'])) {
    $cod_art = $_POST['cod_articulo'];
    $nombre_art = $_POST['nombre_art'];
    $cantidad_art = $_POST['cantidad'];
    $precio_art = $_POST['precio'];
    // Compruebo si el articulo ya lo habia vendido anteriormente
    if (isset($consumiciones[$cod_art]['cantidad'])) {
        $consumiciones[$cod_art]['cantidad'] += intval($cantidad_art);
    } else {
        $consumiciones[$cod_art]['nombre'] = $nombre_art;
        $consumiciones[$cod_art]['cantidad'] = intval($cantidad_art);
        $consumiciones[$cod_art]['precio'] = $precio_art;
    }
}

// en caso de que un cliente quiera pagar luego se guarda en reservas
// if(isset($_POST['reservar'])){
//     $reservas = unserialize($_POST['consumiciones']);
//     $consumiciones=array();
// }else{
//     $reservas = array();
// }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/home.css">
    <title>Bar el Chema | Login</title>
</head>

<body>
    <header>
        <div class="wrapper ">
            <figure class="logo">
                <a href="index.php">
                    <img src="img/Logo.svg" alt="logo bar el chema">
                </a>
            </figure>
        </div>
        <div class="search-container">
            <form action="home.php" method="post">
                <input type="text" class="search-box" placeholder="Buscar...">
                <button class="search-button" ><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 50 50" style="fill:white;">
                        <path d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z"></path>
                    </svg>
                </button>
                <?php
                echo "<input type=hidden name=cod_empleado value='" . $cod_empleado . "'>";
                echo "<input type=hidden name=cod_categoria value=0>";
                echo "<input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>";
                ?>
            </form>

        </div>
        <form action="registro.php" class="registroProds">
            <button class="add-button">
                <span class="icon">+</span>
                Añadir Productos
            </button>
        </form>
        <?php
        $fecha = date('Y-m-d');
        echo $fecha;
        ?>
    </header>

    <main>
        <aside class="navegacion_left">

            <div class="wrapper ">
                <div class="fotoCamarero">
                    <figure class="logo">
                        <?php
                        echo "<img src=img/empleados/" . $cod_empleado . ".jpg alt=foto de empelado>";
                        $nombre = dimeNombre($cod_empleado);

                        ?>
                    </figure>
                    <h2>Nombre Empleado</h2>
                    <?php
                    while ($campo = $nombre->fetch_array()) {
                        echo " <p>" . $campo['nombre'] . "</p>";
                    }
                    ?>

                </div>
                <div class="pedidosPendientes">

                </div>
            </div>

        </aside>
        <section class="contenedor">
            <article class="categorias">
                <div class="categoriasSecciones">
                    <p>Chose Category </p>

                    <div class="itemsCategoria">
                        <?php
                        // mostrar categorias
                        $categorias = mostrarCategorias();

                        while ($campo = $categorias->fetch_array()) {
                            echo "<div class=item>";
                            echo "<label for=" . $campo['cod_tipo'] . ">";
                            echo "<figure>";
                            echo "<img src=./img/categorias/" . $campo['cod_tipo'] . ".png>";
                            echo "</figure>";
                            echo '<form action=home.php method=POST>';
                            echo "<input type=submit value='" . $campo["tipo"] . "' id=" . $campo['cod_tipo'] . ">";

                            echo "<input type=hidden name=cod_empleado value='" . $cod_empleado . "'>";
                            echo "<input type=hidden name=cod_categoria value='" . $campo['cod_tipo'] . "'>";
                            echo "<input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>";
                            echo '</form>';
                            echo "</label>";

                            echo "</div>";
                        }

                        ?>

                    </div>
                </div>


            </article>
            <article class="productos">
                <?php
                //mostrar productos por categoría
                
                $productos = mostrarProductos($cod_categoria);


                if (isset($cod_categoria)) {
                    if ($cod_categoria != 0) {
                        $productos = mostrarProductos($cod_categoria);
                        while ($campo = $productos->fetch_array()) {
                            echo "<div class=producto>";

                            echo '<form action=home.php method=POST class=form_producto>';
                            echo "<div class=product_img>";
                            echo "<figure>";
                            echo "<img src='img/productos/" . $campo['cod_art'] . ".png'>";
                            echo "</figure>";
                            echo "</div>";


                            echo "<div>";

                            echo '<select name=cantidad>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>';
                            echo "<button type=submit>";
                            echo "<p>" . $campo['nombre'] . "</p>";
                            echo "<p>" . $campo["precio"] . "</p>";
                            echo '</button>';
                            echo "</div>";

                            echo "<input type=hidden name=cod_empleado value='" . $cod_empleado . "'>";
                            echo "<input type=hidden name=cod_articulo value='" . $campo['cod_art'] . "'>";
                            echo "<input type=hidden name=nombre_art value='" . $campo['nombre'] . "'>";
                            echo "<input type=hidden name=precio value='" . $campo['precio'] . "'>";

                            echo "<input type=hidden name=cod_categoria value='" . $cod_categoria . "'>";
                            echo "<input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>";
                            // echo "<input type=hidden name=cantidad>";
                
                            echo '</form>';
                            echo "</div>";
                        }
                    } else {
                        echo '<h1>Aun no se ha seleccionado</h1>';
                    }
                }
                ?>
            </article>
        </section>


        <section class="resumenTotal">
            <?php
            $total = 0;
            echo '<form action=index.php method=POST class = form_resumen>';
            echo "<input type=hidden name=cod_empleado value='" . $cod_empleado . "'>";
            echo "<input type=hidden name=fecha value='" . $fecha . "'>";
            echo "<input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>";

            foreach ($consumiciones as $indice => $valor) {

                echo "<div class=resumenTotal_producto>";


                echo "<div class=resumenTotal_producto--item>";
                echo "<figure>";
                echo "<img src=img/productos/" . $indice . ".png alt=producto>";
                echo "</figure>";
                echo "<p>" . $valor['nombre'] . "</p>";
                echo "<p>" . $valor['precio'] . "</p>";


                echo "<div class=resumenTotal_producto--cantidad>";
                echo $valor['cantidad'];

                echo "</div> ";
                echo "</div>";





                echo "</div>";
            }
            // si se da a cobrar se entendera que fue pago por lo que el estado de activo sera 0 y si no sera 1
            
            // calcular el precio total de la venta
            foreach ($consumiciones as $indice => $valor) {
                // crearCodLineaTicket();    
                $total += $valor['cantidad'] * $valor['precio'];
            }
            echo '<h2>total: ' . $total . '</h2>';
            echo '<input type=submit name=cobrar value=cobrar>';

            // echo '<input type=submit name=guardar value=guardar>';
            echo '</form>';

            echo "<form action=imprimir.php class=imprimir method=post >";
            echo "<input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>";
            echo '<input type=submit name=imprimir value=imprimir>';

            echo "</form>";

            echo "<form action=home.php method=post class=reservar>";
            echo '<input type=submit name=reservar value=reservar>';
            echo "<input type=hidden name=cod_empleado value='" . $cod_empleado . "'>";
            echo "<input type=hidden name=cod_categoria value=0>";
            echo "<input type=hidden name=consumiciones value='" . serialize($consumiciones) . "'>";
            echo "</form>";

            ?>

            <?php

            ?>
        </section>
    </main>

</body>

</html>