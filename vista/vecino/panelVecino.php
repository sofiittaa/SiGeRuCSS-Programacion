<?php
session_start();
require_once __DIR__ . "/../../backend/auth/authApis.php";
requiereRolOrDirect(['vecino']); 
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
    <h1 class="titleMenu">Menú de vecino</h1>
        <button class="btn-logout"><a class="text-btn" href="#" id="btnLogout">Cerrar sesión</a></button>

</div>
    <nav class="menu" id="menuOpciones">

    </nav>


    <script src="../../ajax/menu.js?v=2"></script>
    <script src="../../ajax/login/login.js?v=2"></script>
</body>

</html>
