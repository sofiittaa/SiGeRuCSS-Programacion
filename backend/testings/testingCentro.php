<?php

require_once __DIR__ . "/_helper.php";

echo "=== Test CRUD de Centro de acopio ===\n";

$cookie = loginComo(ADMIN_EMAIL, ADMIN_PASS);
assertTrue($cookie !== null, "Login como admin");
if ($cookie === null) exit;

$rutTest = "90001";

// Crear
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "centro.crear",
    "RUTdes" => $rutTest,
    "nomDes" => "CentroTesting",
    "capDes" => "500",
    "horAperDes" => "08:00",
    "horCierDes" => "18:00",
    "zonaDes" => "ZonaTest",
], $cookie);
assertTrue(($r['response']['exito'] ?? false) === true, "Crear centro de acopio");

// Listar y verificar que aparece
$r = postRequest(BASE_URL . "/apiGestion.php", ["accion" => "centro.listar"], $cookie);
$creado = null;
foreach ((array) $r['response'] as $c) {
    if (($c['RUTdes'] ?? '') == $rutTest) { $creado = $c; break; }
}
assertTrue($creado !== null, "El centro de acopio creado aparece en el listado");

// Actualizar
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "centro.actualizar",
    "RUTdes" => $rutTest,
    "nomDes" => "CentroTestingEditado",
    "capDes" => "800",
    "horAperDes" => "07:00",
    "horCierDes" => "19:00",
    "zonaDes" => "ZonaTestEditada",
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Actualizar centro de acopio");

// Borrar (limpiamos el dato de prueba)
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "centro.borrar",
    "RUTdes" => $rutTest,
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Borrar centro de acopio");
