<?php

session_start();
require_once __DIR__ . "/../../backend/conexion/conexion.php";
require_once __DIR__ . "/../../backend/modelo/camModelo.php";

$modelo = new CamionModelo($pdo);
$camiones = $modelo->ListarCamiones();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../themes/styleVistas.css?v=3">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Listado de camiones</title>
</head>
<body class="bodyPanel">
    <div class="panel-listado">
    <h1 class="title">Camiones registrados</h1>

    <div class="acciones-listado">
        <a href="../admin/panelAdmin.php" class="btn-volver">Volver</a>
        <button type="button" class="btn-nuevo" id="btnNuevoCamion">+ Registrar nuevo camión</button>
    </div>

    <div class="tabla-wrapper">
    <table class="tabla">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($camiones) > 0): ?>
                <?php foreach ($camiones as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['matricula']) ?></td>
                        <td><?= htmlspecialchars($c['capacidad']) ?></td>
                        <td>
                            <button type="button" class="btn-accion btn-editar"
                                data-matricula="<?= htmlspecialchars($c['matricula']) ?>"
                                data-capacidad="<?= htmlspecialchars($c['capacidad']) ?>">Editar</button>
                            <button type="button" class="btn-accion btn-eliminar" data-matricula="<?= htmlspecialchars($c['matricula']) ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay camiones registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
    </div>

    <script src="../../ajax/camion/gestionCamion.js?v=4"></script>
</body>
</html>