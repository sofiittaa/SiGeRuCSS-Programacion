<?php
session_start();
require_once __DIR__ . "/../../backend/auth/authApis.php";
requiereRolOrDirect(['admin']); 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Menú</title>
    <link rel="stylesheet" href="../../themes/styleVistas.css?v=3">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="header-menu">
    <div></div> 
    <h1 class="titleMenu">Menú principal de administrador</h1>
        <button class="btn-logout"><a class="text-btn" href="#" id="btnLogout">Cerrar sesión</a></button>

</div>
    <nav class="menu" id="menuOpciones">
        <a class="bloque-menu" href="../usuarioVista/listarUsuVista.php">
            <p class="text-menu2">Usuarios</p>
            <p class="text-menu">Registra nuevos usuarios, actualizalos o eliminalos</p>
        </a>
        <a class="bloque-menu" href="../camionVista/listarCamVista.php">
            <p class="text-menu2">Camiones</p>
            <p class="text-menu">Registra nuevos camiones, actualizalos o eliminalos</p>
        </a>
        <a class="bloque-menu" href="../contenedorVista/listarContVista.php">
            <p class="text-menu2">Contenedores</p>
            <p class="text-menu">Registra nuevos contenedores, actualizalos o eliminalos</p>
        </a>
        <a class="bloque-menu" href="../centroAcoVista/listarCen.php">
            <p class="text-menu2">Centros de acopio</p>
            <p class="text-menu">Registra nuevos centros de acopio, actualizalos o eliminalos</p>
        </a>
        <a class="bloque-menu" href="../empleadoVista/listarEmpVista.php">
            <p class="text-menu2">Empleados</p>
            <p class="text-menu">Registra nuevos empleados, actualizalos o eliminalos</p>
        </a>
        <a class="bloque-menu" href="../maquinariaVista/listarMaqVista.php">
            <p class="text-menu2">Maquinaria</p>
            <p class="text-menu">Registra nueva maquinaria, actualizala o eliminala</p>
        </a>
    </nav>


    <script src="../../ajax/menu.js?v=2"></script>
    <script src="../../ajax/login/login.js?v=2"></script>
</body>

</html>