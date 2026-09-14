<?php

session_start();
require_once __DIR__ . "/../../backend/conexion/conexion.php";
require_once __DIR__ . "/../../backend/modelo/contModelo.php";

$modelo = new ContenedorModelo($pdo);
$contenedores = $modelo->ListarContenedores();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../themes/styleVistas.css?v=3">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Listado de contenedores</title>
</head>
<body class="bodyPanel">
    <div class="panel-listado">
    <h1 class="title">Contenedores registrados</h1>

    <div class="acciones-listado">
        <a href="../admin/panelAdmin.php" class="btn-volver">Volver</a>
        <button type="button" class="btn-nuevo" id="btnNuevoContenedor">+ Registrar nuevo contenedor</button>
    </div>

    <div class="tabla-wrapper">
    <table class="tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>zona</th>
                <th>capacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($contenedores) > 0): ?>
                <?php foreach ($contenedores as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['idCont']) ?></td>
                        <td><?= htmlspecialchars($c['zona']) ?></td>
                        <td><?= htmlspecialchars($c['capacidad']) ?></td>
                        <td>
                            <button type="button" class="btn-accion btn-editar"
                                data-idcont="<?= htmlspecialchars($c['idCont']) ?>"
                                data-zona="<?= htmlspecialchars($c['zona']) ?>"
                                data-capacidad="<?= htmlspecialchars($c['capacidad']) ?>">Editar</button>
                            <button type="button" class="btn-accion btn-eliminar" data-idcont="<?= htmlspecialchars($c['idCont']) ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay contenedores registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
    </div>

    <script src="../../ajax/contenedor/gestionContenedor.js?v=3"></script>
</body>
</html>