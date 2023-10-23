<?php


$consumiciones = unserialize($_POST['consumiciones']);
echo "esto imprime un ticket <br>";


foreach ($consumiciones as $indice => $valor) {
    // crearCodLineaTicket();    
    echo $valor['nombre'] ."<br>";
}
?>