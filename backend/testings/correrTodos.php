<?php

// backend/testings/correrTodos.php
// Corre todos los scripts de testing de esta carpeta, uno atrás del otro.
// Ejecutar con: php backend/testings/correrTodos.php

$archivos = glob(__DIR__ . "/testing*.php");
sort($archivos);

foreach ($archivos as $archivo) {
    echo "\n----- " . basename($archivo) . " -----\n";
    passthru(escapeshellarg(PHP_BINARY) . " " . escapeshellarg($archivo));
}
