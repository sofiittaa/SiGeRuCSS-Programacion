<?php
session_start();
require_once __DIR__ . "/../../backend/auth/authApis.php";
requiereRolOrDirect(['empleado']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>
    <link rel="stylesheet" href="../../themes/styleVistas.css?v=3">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header>
        <h1 class="title">Panel de empleado</h1>
        <button class="btn-logout"><a class="text-btn" href="#" id="btnLogout">Cerrar sesión</a></button>
       <a class="registros" href="../camionVista/listarCamVista.php">Ver camiones de mi cuadrilla</a><br>
       <a class="registros" href="../contenedorVista/listarContVista.php">Gestionar contenedores</a><br>
       <a class="registros" href="../centroAcoVista/listarCen.php">Ver centros de acopio</a><br>
    </header>
</body>
</html>