<?php

require_once __DIR__ . "/_helper.php";

echo "=== Test CRUD de Contenedor ===\n";

$cookie = loginComo(ADMIN_EMAIL, ADMIN_PASS);
assertTrue($cookie !== null, "Login como admin");
if ($cookie === null) exit;

// Crear
$r = postRequest(BASE_URL . "/apiGestion.php", [
    "accion" => "contenedor.crear",
    "zona" => "ZonaTesting",
    "capacidad" => "50",
], $cookie);
assertTrue(($r['response']['exito'] ?? false) === true, "Crear contenedor");

// Listar y buscar el que acabamos de crear
$r = postRequest(BASE_URL . "/apiGestion.php", ["accion" => "contenedor.listar"], $cookie);
$creado = null;
foreach ((array) $r['response'] as $c) {
    if (($c['zona'] ?? '') === 'ZonaTesting') { $creado = $c; break; }
}
assertTrue($creado !== null, "El contenedor creado aparece en el listado");

if ($creado !== null) {
    $idCont = $creado['idCont'];

    // Actualizar
    $r = postRequest(BASE_URL . "/apiGestion.php", [
        "accion" => "contenedor.actualizar",
        "idCont" => $idCont,
        "zona" => "ZonaTestingEditada",
        "capacidad" => "75",
    ], $cookie);
    assertTrue(($r['response']['exito'] ?? false) == true, "Actualizar contenedor");

    // Borrar (limpiamos el dato de prueba para que el test sea repetible)
    $r = postRequest(BASE_URL . "/apiGestion.php", [
        "accion" => "contenedor.borrar",
        "idCont" => $idCont,
    ], $cookie);
    assertTrue(($r['response']['exito'] ?? false) == true, "Borrar contenedor");
}
