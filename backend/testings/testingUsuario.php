<?php

require_once __DIR__ . "/_helper.php";

echo "=== Test CRUD de Usuario (vecino) ===\n";

// Cédula única en cada corrida para que el test sea repetible sin chocar con datos previos.
$cedulaTest = "9" . substr((string) time(), -7);
$emailTest = "usuario.test.$cedulaTest@sigeru.com";

// Crear (registro público, sin necesidad de sesión)
$r = postRequest(BASE_URL . "/apiUsuario.php", [
    "accion" => "usuario.crear",
    "cedula" => $cedulaTest,
    "nombre" => "Usuario",
    "apellido" => "Testing",
    "zonaUsu" => "ZonaTest",
    "email" => $emailTest,
    "contrasena" => "Prueba123!",
]);
assertTrue(($r['response']['exito'] ?? false) === true, "Crear usuario (registro público)");

// Login como admin para poder listar/actualizar/borrar
$cookie = loginComo(ADMIN_EMAIL, ADMIN_PASS);
assertTrue($cookie !== null, "Login como admin");
if ($cookie === null) exit;

// Listar y verificar que aparece
$r = postRequest(BASE_URL . "/apiUsuario.php", ["accion" => "usuario.listar"], $cookie);
$creado = null;
foreach ((array) $r['response'] as $u) {
    if (($u['cedula'] ?? '') == $cedulaTest) { $creado = $u; break; }
}
assertTrue($creado !== null, "El usuario creado aparece en el listado");

// Actualizar
$r = postRequest(BASE_URL . "/apiUsuario.php", [
    "accion" => "usuario.actualizar",
    "cedula" => $cedulaTest,
    "nombre" => "UsuarioEditado",
    "apellido" => "TestingEditado",
    "email" => $emailTest,
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Actualizar usuario");

// Borrar (limpiamos el dato de prueba, requiere admin)
$r = postRequest(BASE_URL . "/apiUsuario.php", [
    "accion" => "usuario.borrar",
    "cedula" => $cedulaTest,
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Borrar usuario");
