<?php

// backend/auth/authApis.php
// Funciones de restricción reusables para las APIs.
// Quien incluya este archivo debe haber llamado session_start() antes.

function requireLogin(): void
{
    if (!isset($_SESSION['usuario_cedula'])) {
        http_response_code(401);
        echo json_encode(['exito' => false, 'error' => 'No autenticado']);
        exit;
    }
}

function requiereRolOrDirect(array $rolesPermitidos):void{
    {
        if (!isset($_SESSION['usuario_cedula'])) {
        header('Location: ../usuarioVista/loginVista.html');
        exit;
        }
        $rol = $_SESSION['usuario_rol'] ?? '';
        if (!in_array($rol, $rolesPermitidos, true)) {
            $destino = match ($rol) {
                'admin' => '../admin/panelAdmin.php',
                'empleado' => '../empleado/panelEmpleado.php',
                default => '../vecino/panelVecino.php',
            };
            header('Location: ' . $destino);
            exit;
        }
    }
}


function requireRole(array $rolesPermitidos): void
{
    requireLogin();

    $rol = $_SESSION['usuario_rol'] ?? '';
    if (!in_array($rol, $rolesPermitidos, true)) {
        http_response_code(403);
        echo json_encode(['exito' => false, 'error' => 'No autorizado']);
        exit;
    }
}

function requirePost(): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
        http_response_code(405);
        echo json_encode(['exito' => false, 'error' => 'Método no permitido']);
        exit;
    }
}

