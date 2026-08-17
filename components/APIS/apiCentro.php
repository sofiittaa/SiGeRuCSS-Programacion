<?php
// apis/apiCentro.php

session_start();
require_once __DIR__ . "/../conexion/conexion.php";
require_once __DIR__ . "/../controlador/cenControlador.php";

$controlador = new CentroAcopioControlador($pdo);

if (isset($_POST["accion"])) {
    switch ($_POST["accion"]) {
        case "crear":
            $controlador->crear();
            break;
        case "listar":
            $controlador->listar();
            break;
        case "modificar":
            $controlador->actualizar();
            break;
        case "borrar":
            $controlador->borrar();
            break;
        default:
            echo json_encode(['ok' => false, 'error' => 'Acción no válida']);
            break;
    }
} else {
    echo json_encode(['ok' => false, 'error' => 'No se recibió ninguna acción']);
}
