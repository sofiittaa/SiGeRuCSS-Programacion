<?php

session_start();

require_once __DIR__ . "/../conexion/conexion.php";
require_once __DIR__ . "/../auth/authApis.php";
require_once __DIR__ . "/../controlador/usuarioControlador.php";
require_once __DIR__ . "/../controlador/loginControlador.php";

header('Content-Type: application/json');

requirePost();

$controlador = new UsuarioControlador($pdo);
$login = new LoginControlador($pdo);

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

    case "usuario":
        switch ($metodo) {
            case "crear":
                // Registro público: cualquiera puede crear su cuenta de vecino.
                $controlador->Crear();
                break;
            case "listar":
                requireLogin();
                $controlador->Listar();
                break;
            case "actualizar":
                requireLogin();
                $controlador->Actualizar();
                break;
            case "borrar":
                requireRole(['admin']);
                $controlador->Borrar();
                break;
            default:
                echo json_encode(['exito' => false, 'error' => 'Acción no válida']);
        }
        break;

    case "empleado":
        // Gestionar empleados es exclusivo del admin.
        requireRole(['admin']);
        switch ($metodo) {
            case "crear":
                $controlador->CrearEmpleado();
                break;
            case "listar":
                $controlador->ListarEmpleados();
                break;
            case "borrar":
                $controlador->BorrarEmpleado();
                break;
            default:
                echo json_encode(['exito' => false, 'error' => 'Acción no válida']);
        }
        break;

    case "auth":
        switch ($metodo) {
            case "login":
                $login->login();
                break;
            case "logout":
                $login->logout();
                break;
            default:
                echo json_encode(['exito' => false, 'error' => 'Acción no válida']);
        }
        break;

    default:
        echo json_encode(['exito' => false, 'error' => 'Recurso no válido']);
}
