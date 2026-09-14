<?php

require_once __DIR__ . "/_helper.php";

echo "=== Test CRUD de Empleado ===\n";

$cookie = loginComo(ADMIN_EMAIL, ADMIN_PASS);
assertTrue($cookie !== null, "Login como admin");
if ($cookie === null) exit;

// Cédula única en cada corrida para que el test sea repetible.
$cedulaTest = "8" . substr((string) time(), -7);
$emailTest = "empleado.test.$cedulaTest@sigeru.com";

// Crear (exclusivo de admin)
$r = postRequest(BASE_URL . "/apiUsuario.php", [
    "accion" => "empleado.crear",
    "cedula" => $cedulaTest,
    "nombre" => "Empleado",
    "apellido" => "Testing",
    "email" => $emailTest,
    "contrasena" => "Prueba123!",
], $cookie);
assertTrue(($r['response']['exito'] ?? false) === true, "Crear empleado");

// Listar y verificar que aparece
$r = postRequest(BASE_URL . "/apiUsuario.php", ["accion" => "empleado.listar"], $cookie);
$creado = null;
foreach ((array) $r['response'] as $e) {
    if (($e['cedula'] ?? '') == $cedulaTest) { $creado = $e; break; }
}
assertTrue($creado !== null, "El empleado creado aparece en el listado");

// Actualizar (se reusa el endpoint usuario.actualizar, mismo dato base)
$r = postRequest(BASE_URL . "/apiUsuario.php", [
    "accion" => "usuario.actualizar",
    "cedula" => $cedulaTest,
    "nombre" => "EmpleadoEditado",
    "apellido" => "TestingEditado",
    "email" => $emailTest,
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Actualizar empleado (usuario.actualizar)");

// Borrar (limpiamos el dato de prueba)
$r = postRequest(BASE_URL . "/apiUsuario.php", [
    "accion" => "empleado.borrar",
    "cedula" => $cedulaTest,
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Borrar empleado");
