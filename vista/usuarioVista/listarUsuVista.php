<?php

session_start();
require_once __DIR__ . "/../../backend/conexion/conexion.php";
require_once __DIR__ . "/../../backend/modelo/usuarioModelo.php";

$modelo = new UsuarioModelo($pdo);
$usuarios = $modelo->Listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../themes/styleVistas.css?v=3">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Listado de usuarios</title>
</head>
<body class="bodyPanel">
    <div class="panel-listado">
    <h1 class="title">Usuarios registrados</h1>

    <div class="acciones-listado">
        <a href="../admin/panelAdmin.php" class="btn-volver">Volver</a>
        <button type="button" class="btn-nuevo" id="btnNuevoVecino">+ Registrar nuevo vecino</button>
    </div>

    <div class="tabla-wrapper">
    <table class="tabla">
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($usuarios) > 0): ?>
            <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['cedula']) ?></td>
                        <td><?= htmlspecialchars($u['nombre']) ?></td>
                        <td><?= htmlspecialchars($u['apellido']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td><?= htmlspecialchars($u['rol']) ?></td>
                        <td>
                            <?php if ($u['rol'] !== 'admin'): ?>
                            <button type="button" class="btn-accion btn-editar"
                                data-cedula="<?= htmlspecialchars($u['cedula']) ?>"
                                data-nombre="<?= htmlspecialchars($u['nombre']) ?>"
                                data-apellido="<?= htmlspecialchars($u['apellido']) ?>"
                                data-email="<?= htmlspecialchars($u['email']) ?>">Editar</button>
                            <button type="button" class="btn-accion btn-eliminar" data-cedula="<?= htmlspecialchars($u['cedula']) ?>" data-rol="<?= htmlspecialchars($u['rol']) ?>">Eliminar</button>
                            <?php else: ?>
                            <span>Acciones no disponibles</span>
                            <?php endif; ?>
                    </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay usuarios registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
    </div>

    <script src="../../ajax/usuario/gestionUsuario.js?v=2"></script>
</body>
</html>
