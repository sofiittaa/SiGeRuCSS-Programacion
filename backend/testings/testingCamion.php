<?php

require_once __DIR__ . "/_helper.php";

echo "=== Test CRUD de Camión ===\n";

$cookie = loginComo(ADMIN_EMAIL, ADMIN_PASS);
assertTrue($cookie !== null, "Login como admin");
if ($cookie === null) exit;

$matriculaTest = "ZZZ9999";

// Crear
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "camion.crear",
    "matricula" => $matriculaTest,
    "capacidad" => "1000",
], $cookie);
assertTrue(($r['response']['exito'] ?? false) === true, "Crear camión");

// Listar y verificar que aparece
$r = postRequest(BASE_URL . "/apiGestion.php", ["accion" => "camion.listar"], $cookie);
$creado = null;
foreach ((array) $r['response'] as $c) {
    if (($c['matricula'] ?? '') === $matriculaTest) { $creado = $c; break; }
}
assertTrue($creado !== null, "El camión creado aparece en el listado");

// Actualizar
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "camion.actualizar",
    "matricula" => $matriculaTest,
    "capacidad" => "1500",
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Actualizar camión");

// Borrar (limpiamos el dato de prueba)
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "camion.borrar",
    "matricula" => $matriculaTest,
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Borrar camión");
