<?php

require_once __DIR__ . "/_helper.php";

echo "=== Test de roles (seguridad y separación de endpoints) ===\n";

// Este test necesita una cuenta de rol "vecino" ya registrada con estas credenciales.
$cookieVecino = loginComo(VECINO_TEST_EMAIL, VECINO_TEST_PASS);
assertTrue($cookieVecino !== null, "Login como vecino de prueba");

if ($cookieVecino !== null) {
    $r = postRequest(BASE_URL . "/apiGestion.php", [
        "accion" => "contenedor.listar",
    ], $cookieVecino);
    assertTrue(($r['response']['exito'] ?? true) === false, "Vecino NO puede listar contenedores (debe rechazarse)");

    $r = postRequest(BASE_URL . "/apiGestion.php", [
        "accion" => "camion.listar",
    ], $cookieVecino);
    assertTrue(($r['response']['exito'] ?? true) === false, "Vecino NO puede listar camiones (debe rechazarse)");

    $r = postRequest(BASE_URL . "/apiUsuario.php", [
        "accion" => "empleado.listar",
    ], $cookieVecino);
    assertTrue(($r['response']['exito'] ?? true) === false, "Vecino NO puede listar empleados (debe rechazarse)");
}

$cookieAdmin = loginComo(ADMIN_EMAIL, ADMIN_PASS);
assertTrue($cookieAdmin !== null, "Login como admin");

if ($cookieAdmin !== null) {
    $r = postRequest(BASE_URL . "/apiGestion.php", [
        "accion" => "contenedor.listar",
    ], $cookieAdmin);
    assertTrue(is_array($r['response']), "Admin SI puede listar contenedores");
}

// Sin sesión ninguna, ni contenedor.listar debería andar.
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "contenedor.listar",
]);
assertTrue(($r['response']['exito'] ?? true) === false, "Sin sesión, contenedor.listar debe rechazarse (401)");
