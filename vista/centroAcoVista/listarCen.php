<?php

session_start();
require_once __DIR__ . "/../../backend/conexion/conexion.php";
require_once __DIR__ . "/../../backend/modelo/cenModelo.php";

$modelo = new CentroAcopioModelo($pdo);
$centros = $modelo->ListarCentros();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../themes/styleVistas.css?v=3">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Listado de centros de acopio</title>
</head>
<body class="bodyPanel">
    <div class="panel-listado">
    <h1 class="title">Centros de acopio registrados</h1>

    <div class="acciones-listado">
        <a href="../admin/panelAdmin.php" class="btn-volver">Volver</a>
        <button type="button" class="btn-nuevo" id="btnNuevoCentro">+ Registrar nuevo centro de acopio</button>
    </div>

    <div class="tabla-wrapper">
    <table class="tabla">
        <thead>
            <tr>
                <th>RUT destino</th>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Hora apertura</th>
                <th>Hora cierre</th>
                <th>Zona</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($centros) > 0): ?>
                <?php foreach ($centros as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['RUTdes']) ?></td>
                        <td><?= htmlspecialchars($c['nomDes']) ?></td>
                        <td><?= htmlspecialchars($c['capDes']) ?></td>
                        <td><?= htmlspecialchars($c['horAperDes']) ?></td>
                        <td><?= htmlspecialchars($c['horCierDes']) ?></td>
                        <td><?= htmlspecialchars($c['zonaDes']) ?></td>
                        <td>
                            <button type="button" class="btn-accion btn-editar"
                                data-rutdes="<?= htmlspecialchars($c['RUTdes']) ?>"
                                data-nomdes="<?= htmlspecialchars($c['nomDes']) ?>"
                                data-capdes="<?= htmlspecialchars($c['capDes']) ?>"
                                data-horaperdes="<?= htmlspecialchars(substr($c['horAperDes'], 0, 5)) ?>"
                                data-horcierdes="<?= htmlspecialchars(substr($c['horCierDes'], 0, 5)) ?>"
                                data-zonades="<?= htmlspecialchars($c['zonaDes']) ?>">Editar</button>
                            <button type="button" class="btn-accion btn-eliminar" data-rutdes="<?= htmlspecialchars($c['RUTdes']) ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No hay centros de acopio registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
    </div>

    <script src="../../ajax/centro/gestionCentro.js?v=4"></script>
</body>
</html>
