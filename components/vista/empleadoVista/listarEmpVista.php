<?php

session_start();
require_once __DIR__ . "/../../conexion/conexion.php";
require_once __DIR__ . "/../../modelo/usuarioModelo.php";

$modelo = new UsuarioModelo($pdo);
$empleados = $modelo->ListarEmpleados();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../themes/styleVistas.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Listado de empleados</title>
</head>
<body>
    <h2>Empleados registrados</h2>

    <a href="/SiGeRuCSS+/components/vista/admin/panelAdmin.html" class="btn-volver">Volver</a>
    <a href="/SiGeRuCSS+/components/vista/empleadoVista/registroEmpVista.html" class="btn-nuevo">+ Registrar nuevo empleado</a>

    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
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

    <script src="/SiGeRuCSS+/ajax/empleado/gestionEmpleado.js"></script>
</body>
</html>
