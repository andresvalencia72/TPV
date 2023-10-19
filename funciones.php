<?php

function conecta()
{
    $conexion = new mysqli('127.0.0.1', 'root', '', 'tpv');
    return $conexion;
}

function desconecta($conexion)
{
    $conexion->close();
}
function mostrarEmpleadosActivos()
{
    $conexion = conecta();
    $orden = "SELECT cod_empleado,nombre FROM empleados where activo=1";
    $resultado = $conexion->query($orden);
    return $resultado;
}

function ejecutaSQL($orden)
{
    $conexion = conecta();
    $resultado = $conexion->query($orden);
    return $resultado;
}
function dimeNombre($cod_empleado)
{
    $conexion = conecta();
    $resultado = $conexion->query("SELECT nombre FROM empleados WHERE cod_empleado=$cod_empleado");
    return $resultado;
}
function mostrarCategorias()
{
    $conexion = conecta();
    $resultado = $conexion->query("SELECT cod_tipo, tipo FROM tipos where activo=1");
    return $resultado;
}
function mostrarProductos($cod_tipo)
{
    $conexion = conecta();
    $resultado = $conexion->query("SELECT cod_art, nombre, precio FROM articulos where cod_tipo=" . $cod_tipo);
    return $resultado;
}

function insertarPago($cod_empleado, $fecha)
{
    $conexion = conecta();
    $ordenInsert = "INSERT INTO `tickets` (cod_empleado, fecha, activo) values($cod_empleado,'$fecha',0)";
    $conexion->query($ordenInsert);
}



function insertarLineaTickets($cod_ticket,$cod_art, $cantidad, $precio)
{
    $conexion = conecta();
    $resultado = $conexion->query("INSERT INTO `lineas_ticket` (cod_ticket,cod_art,cantidad,precio) values($cod_ticket,$cod_art,$cantidad,$precio)");

}

function obtenerCodTicket()
{
    $conexion = conecta();
    $resultado = $conexion->query("SELECT max(cod_ticket) from tickets");
    return $resultado;
}

?>