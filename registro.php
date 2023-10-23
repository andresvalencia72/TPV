<?php
require_once "funciones.php";

if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $activo = 1;

    insertarProductos($nombre, $precio, $categoria,$activo);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registrar Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        h1 {
            background-color: #ebba71;
            color: #fff;
            padding: 10px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px #888;
            width: 400px;
            margin: 0 auto;
        }

        label,
        input,
        textarea,
        select {
            display: block;
            margin-bottom: 10px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            padding: 15px 0px;
        }

        select {
            height: 35px;
        }

        input[type="submit"] {
            background-color: #ebba71;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Registrar Producto</h1>
    <form method="post" action="registro.php">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" required>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required>

        <label for="categoria">Categoría:</label>
        <select name="categoria">
            <?php

            $categorias = mostrarCategorias();
            foreach ($categorias as $indice => $valor) {
                echo "<option value='" . $valor['cod_tipo'] . "-". $valor['tipo']."'>" . $valor['tipo'] . "</option>";
            }

            ?>

        </select>



        <input type="submit" name="registrar">
    </form>
</body>

</html>