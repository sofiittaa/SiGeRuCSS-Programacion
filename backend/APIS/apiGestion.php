<?php

session_start();

require_once __DIR__ . "/../conexion/conexion.php";
require_once __DIR__ . "/../auth/authApis.php";
require_once __DIR__ . "/../controlador/contControlador.php";
require_once __DIR__ . "/../controlador/cenControlador.php";
require_once __DIR__ . "/../controlador/vertControlador.php";
require_once __DIR__ . "/../controlador/maquiControlador.php";
require_once __DIR__ . "/../controlador/camControlador.php";

header('Content-Type: application/json');

requirePost();

$contenedor = new ContenedorControlador($pdo);
$centro = new CentroAcopioControlador($pdo);
$maquinaria = new MaquinariaControlador($pdo);
$vertedero = new VertederoControlador($pdo);
$camion = new CamionControlador($pdo);

if (!isset($_POST["accion"])) {
    echo json_encode(['exito' => false, 'error' => 'No se recibió ninguna acción']);
    return;
}

$partes = explode('.', $_POST["accion"], 2);

if (count($partes) !== 2) {
    echo json_encode(['exito' => false, 'error' => 'Acción no válida']);
    return;
}

[$recurso, $metodo] = $partes;

switch ($recurso) {

    case "contenedor":
        requireRole(['empleado', 'admin']);
        switch ($metodo) {
            case "crear":
                $contenedor->Crear();
                break;
            case "listar":
                $contenedor->listar();
                break;
            case "actualizar":
                $contenedor->actualizar();
                break;
            case "borrar":
                $contenedor->borrar();
                break;
            default:
                echo json_encode(['exito' => false, 'error' => 'Acción no válida']);
        }
        break;

    case "centro":
        switch ($metodo) {
            case "listar":
                // El vecino también necesita ver el mapa de centros de acopio.
                requireLogin();
                $centro->listar();
                break;
            case "crear":
                requireRole(['empleado', 'admin']);
                $centro->crear();
                break;
            case "actualizar":
                requireRole(['empleado', 'admin']);
                $centro->actualizar();
                break;
            case "borrar":
                requireRole(['empleado', 'admin']);
                $centro->borrar();
                break;
            default:
                echo json_encode(['exito' => false, 'error' => 'Acción no válida']);
        }
        break;

    case "vertedero":
        switch ($metodo) {
            case "listar":
                // El vecino también necesita ver el mapa de vertederos.
                requireLogin();
                $vertedero->listar();
                break;
            case "crear":
                requireRole(['empleado', 'admin']);
                $vertedero->crear();
                break;
            case "actualizar":
                requireRole(['empleado', 'admin']);
                $vertedero->actualizar();
                break;
            case "borrar":
                requireRole(['empleado', 'admin']);
                $vertedero->borrar();
                break;
            default:
                echo json_encode(['exito' => false, 'error' => 'Acción no válida']);
        }
        break;

    case "maquinaria":
        // La maquinaria es de uso interno, ningún vecino necesita verla.
        requireRole(['empleado', 'admin']);
        switch ($metodo) {
            case "crear":
                $maquinaria->Crear();
                break;
            case "listar":
                $maquinaria->listar();
                break;
            case "actualizar":
                $maquinaria->actualizar();
                break;
            case "borrar":
                $maquinaria->borrar();
                break;
            default:
                echo json_encode(['exito' => false, 'error' => 'Acción no válida']);
        }
        break;

    case "camion":
        // Gestión de flota: uso interno de empleado/admin.
        requireRole(['empleado', 'admin']);
        switch ($metodo) {
            case "crear":
                $camion->crear();
                break;
            case "listar":
                $camion->listar();
                break;
            case "actualizar":
                $camion->actualizar();
                break;
            case "borrar":
                $camion->borrar();
                break;
            default:
                echo json_encode(['exito' => false, 'error' => 'Acción no válida']);
        }
        break;

    default:
        echo json_encode(['exito' => false, 'error' => 'Recurso no válido']);
}
