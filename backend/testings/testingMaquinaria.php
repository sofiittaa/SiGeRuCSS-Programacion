<?php

require_once __DIR__ . "/_helper.php";

echo "=== Test CRUD de Maquinaria ===\n";

$cookie = loginComo(ADMIN_EMAIL, ADMIN_PASS);
assertTrue($cookie !== null, "Login como admin");
if ($cookie === null) exit;

$codigoTest = "TestActivo001";

// Crear
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "maquinaria.crear",
    "codigoActivo" => $codigoTest,
    "tipoMaquinaria" => "Compactadora",
    "numeroSerie" => "SERIE12345",
    "modelo" => "ModeloTest",
    "marca" => "MarcaTest",
    "anofabricacion" => "2024-01-01",
], $cookie);
assertTrue(($r['response']['exito'] ?? false) === true, "Crear maquinaria");

// Listar y verificar que aparece
$r = postRequest(BASE_URL . "/apiGestion.php", ["accion" => "maquinaria.listar"], $cookie);
$creado = null;
foreach ((array) $r['response'] as $m) {
    if (($m['codigoActivo'] ?? '') === $codigoTest) { $creado = $m; break; }
}
assertTrue($creado !== null, "La maquinaria creada aparece en el listado");

// Actualizar
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "maquinaria.actualizar",
    "codigoActivo" => $codigoTest,
    "tipoMaquinaria" => "Compactadora",
    "numeroSerie" => "SERIE99999",
    "modelo" => "ModeloEditado",
    "marca" => "MarcaTest",
    "anofabricacion" => "2024-06-01",
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Actualizar maquinaria");

// Borrar (limpiamos el dato de prueba)
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "maquinaria.borrar",
    "codigoActivo" => $codigoTest,
], $cookie);
assertTrue(($r['response']['exito'] ?? false) == true, "Borrar maquinaria");
