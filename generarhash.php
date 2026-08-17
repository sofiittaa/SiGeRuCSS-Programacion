<?php

$contrasena = '0668aDm'; // 

$hash = password_hash($contrasena, PASSWORD_DEFAULT);

echo "Contraseña: $contrasena\n";
echo "Hash generado: $hash\n";
echo "Longitud del hash: " . strlen($hash) . " caracteres\n"; // debería dar 60

?>