<?php

session_start();
require_once __DIR__ . "/../../conexion/conexion.php";
require_once __DIR__ . "/../../modelo/camModelo.php";

$modelo = new CamionModelo($pdo);
$camiones = $modelo->ListarCamiones();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../themes/styleVistas.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Listado de camiones</title>
</head>
<body>
    <h2>Camiones registrados</h2>

    <a href="/SiGeRuCSS+/components/vista/admin/panelAdmin.html" class="btn-volver">Volver</a>
    <a href="/SiGeRuCSS+/components/vista/camionVista/registroCamVista.html" class="btn-nuevo">+ Registrar nuevo camión</a>

    <br><br>
    <table border="1" cellpadding="8" cellspacing="0">
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

    <script src="/SiGeRuCSS+/ajax/camion/gestionCamion.js"></script>
</body>
</html>