<?php

session_start();
require_once __DIR__ . "/../../conexion/conexion.php";
require_once __DIR__ . "/../../modelo/cenModelo.php";

$modelo = new CentroAcopioModelo($pdo);
$centros = $modelo->ListarCentros();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../themes/styleVistas.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Listado de centros de acopio</title>
</head>
<body>
    <h2>Centros de acopio registrados</h2>

    <a href="/SiGeRuCSS+/components/vista/admin/panelAdmin.html" class="btn-volver">Volver</a>
    <a href="/SiGeRuCSS+/components/vista/centroAcoVista/registroCenVista.html" class="btn-nuevo">+ Registrar nuevo centro de acopio</a>

    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
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

    <script src="/SiGeRuCSS+/ajax/centro/gestionCentro.js"></script>
</body>
</html>
