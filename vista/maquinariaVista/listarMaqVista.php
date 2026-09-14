<?php

session_start();
require_once __DIR__ . "/../../backend/conexion/conexion.php";
require_once __DIR__ . "/../../backend/modelo/maquiModelo.php";

$modelo = new MaquiModelo($pdo);
$maquinas = $modelo->Listarmaquinas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../themes/styleVistas.css?v=3">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Listado de maquinaria básica</title>
</head>
<body class="bodyPanel">
    <div class="panel-listado">
    <h1 class="title">Maquinaria básica registrada</h1>

    <div class="acciones-listado">
        <a href="../admin/panelAdmin.php" class="btn-volver">Volver</a>
        <button type="button" class="btn-nuevo" id="btnNuevoMaquinaria">+ Registrar nueva maquinaria</button>
    </div>

    <div class="tabla-wrapper">
    <table class="tabla">
        <thead>
            <tr>
                <th>Código activo</th>
                <th>Tipo</th>
                <th>Número de serie</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Año fabricación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($maquinas) > 0): ?>
                <?php foreach ($maquinas as $m): ?>
                    <tr>
                        <td><?= htmlspecialchars($m['codigoActivo']) ?></td>
                        <td><?= htmlspecialchars($m['tipoMaquinaria']) ?></td>
                        <td><?= htmlspecialchars($m['numeroSerie']) ?></td>
                        <td><?= htmlspecialchars($m['modelo']) ?></td>
                        <td><?= htmlspecialchars($m['marca']) ?></td>
                        <td><?= htmlspecialchars($m['anofabricacion']) ?></td>
                        <td>
                            <button type="button" class="btn-accion btn-editar"
                                data-codigoactivo="<?= htmlspecialchars($m['codigoActivo']) ?>"
                                data-tipomaquinaria="<?= htmlspecialchars($m['tipoMaquinaria']) ?>"
                                data-numeroserie="<?= htmlspecialchars($m['numeroSerie']) ?>"
                                data-modelo="<?= htmlspecialchars($m['modelo']) ?>"
                                data-marca="<?= htmlspecialchars($m['marca']) ?>"
                                data-anofabricacion="<?= htmlspecialchars($m['anofabricacion']) ?>">Editar</button>
                            <button type="button" class="btn-accion btn-eliminar" data-codigoactivo="<?= htmlspecialchars($m['codigoActivo']) ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No hay maquinaria registrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
    </div>

    <script src="../../ajax/maquinaria/gestionMaquinaria.js?v=3"></script>
</body>
</html>
