<?php

session_start();

if (($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    header('Location: ../usuarioVista/loginVista.html');
    exit;
}

require_once __DIR__ . "/../../backend/conexion/conexion.php";
require_once __DIR__ . "/../../backend/modelo/usuarioModelo.php";

$modelo = new UsuarioModelo($pdo);
$empleados = $modelo->ListarEmpleados();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../themes/styleVistas.css?v=3">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Listado de empleados</title>
</head>
<body class="bodyPanel">
    <div class="panel-listado">
    <h1 class="title">Empleados registrados</h1>

    <div class="acciones-listado">
        <a href="../admin/panelAdmin.php" class="btn-volver">Volver</a>
        <button type="button" class="btn-nuevo" id="btnNuevoEmpleado">+ Registrar nuevo empleado</button>
    </div>

    <div class="tabla-wrapper">
    <table class="tabla">
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($empleados) > 0): ?>
                <?php foreach ($empleados as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['cedula']) ?></td>
                        <td><?= htmlspecialchars($u['nombre']) ?></td>
                        <td><?= htmlspecialchars($u['apellido']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td>
                            <button type="button" class="btn-accion btn-editar"
                                data-cedula="<?= htmlspecialchars($u['cedula']) ?>"
                                data-nombre="<?= htmlspecialchars($u['nombre']) ?>"
                                data-apellido="<?= htmlspecialchars($u['apellido']) ?>"
                                data-email="<?= htmlspecialchars($u['email']) ?>">Editar</button>
                            <button type="button" class="btn-accion btn-eliminar" data-cedula="<?= htmlspecialchars($u['cedula']) ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay empleados registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
    </div>

    <script src="../../ajax/empleado/gestionEmpleado.js?v=3"></script>
</body>
</html>
