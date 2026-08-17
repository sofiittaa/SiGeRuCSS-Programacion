<?php

session_start();
require_once __DIR__ . "/../../conexion/conexion.php";
require_once __DIR__ . "/../../modelo/contModelo.php";

$modelo = new ContenedorModelo($pdo);
$contenedores = $modelo->ListarContenedores();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../themes/styleVistas.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Listado de contenedores</title>
</head>
<body>
    <h2>Contenedores registrados</h2>

    <a href="/SiGeRuCSS+/components/vista/admin/panelAdmin.html" class="btn-volver">Volver</a>
    <a href="/SiGeRuCSS+/components/vista/contenedorVista/registroContVista.html" class="btn-nuevo">+ Registrar nuevo contenedor</a>

    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
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

    <script src="/SiGeRuCSS+/ajax/contenedor/gestionContenedor.js"></script>
</body>
</html>