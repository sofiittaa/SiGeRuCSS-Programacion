<?php

require_once __DIR__ . "/_helper.php";

echo "=== Test CRUD de Vertedero ===\n";

$cookie = loginComo(ADMIN_EMAIL, ADMIN_PASS);
assertTrue($cookie !== null, "Login como admin");
if ($cookie === null) exit;

$rutTest = "90002";

// Crear
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "vertedero.crear",
    "RUTdes" => $rutTest,
    "nomDes" => "VertederoTesting",
    "capDes" => "1000",
    "horAperDes" => "06:00",
    "horCierDes" => "20:00",
    "zonaDes" => "ZonaTest",
], $cookie);
assertTrue(($r['response']['exito'] ?? false) === true, "Crear vertedero");

// Listar y verificar que aparece
$r = postRequest(BASE_URL . "/apiGestion.php", ["accion" => "vertedero.listar"], $cookie);
$creado = null;
foreach ((array) $r['response'] as $v) {
    if (($v['RUTdes'] ?? '') == $rutTest) { $creado = $v; break; }
}
assertTrue($creado !== null, "El vertedero creado aparece en el listado");

// Actualizar
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "vertedero.actualizar",
    "RUTdes" => $rutTest,
    "nomDes" => "VertederoTestingEditado",
    "capDes" => "1200",
    "horAperDes" => "05:00",
    "horCierDes" => "21:00",
    "zonaDes" => "ZonaTestEditada",
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Actualizar vertedero");

// Borrar (limpiamos el dato de prueba)
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "vertedero.borrar",
    "RUTdes" => $rutTest,
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Borrar vertedero");
