
<?php

session_start();

require_once __DIR__ . "/../conexion/conexion.php";

require_once __DIR__ . "/../controlador/loginControlador.php";

header('Content-Type: application/json');

$controlador = new LoginControlador($pdo);


if (isset($_POST["accion"])) {

    switch ($_POST["accion"]) {
        case "login":
            $controlador->Login();
            break;
        case "logout":
            $controlador->logout();
            break;
        default:
            echo json_encode(['ok' => false, 'error' => 'Acción no válida']);
            break;
        
        

    }
    } else {
    echo json_encode(['ok' => false, 'error' => 'No se recibió ninguna acción']);
}



?>