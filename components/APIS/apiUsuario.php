
<?php

session_start();

require_once __DIR__ . "/../conexion/conexion.php";

require_once __DIR__ . "/../controlador/usuarioControlador.php";

header('Content-Type: application/json');

$controlador = new UsuarioControlador($pdo);


if (isset($_POST["accion"])) {

    switch ($_POST["accion"]) {
        case "crear":
            $controlador->Crear();
            break;
        case "listar":
            $controlador->Listar();
            break;
        case "actualizar":
            $controlador->Actualizar();
            break;
        case "borrar":
            $controlador->Borrar();
            break;
        case "listarEmpleados":
            $controlador->ListarEmpleados();
            break;
        case "crearEmpleado":
            $controlador->CrearEmpleado();
            break;
        case "borrarEmpleado":
            $controlador->BorrarEmpleado();
            break;
        default:
            echo json_encode(['ok' => false, 'error' => 'Acción no válida']);
            break;

    }
    } else {
    echo json_encode(['ok' => false, 'error' => 'No se recibió ninguna acción']);
}



?>