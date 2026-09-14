<?php

// Definimos la URL del endpoint de login

$url = "http://localhost/SiGeRuCSS+/backend/APIS/apiUsuario.php";

// Datos de prueba: email y contraseña para el login
$data = [
    "accion" => "auth.login",
    "email" => "testing@gmail.com",
    "contrasena" => "123456",
];  
// Configuramos la solicitud HTTP como POST
$options = [
"http" => [
"header" => "Content-type:application/x-www-form-urlencoded\r\n",
"method" => "POST", 
"content" => http_build_query($data),
],
];
// Creamos el contexto con las opciones definidas

$context = stream_context_create($options);
// Enviamos la solicitud al servidor

$result = file_get_contents($url, false, $context);
// Convertimos la respuesta JSON a un array asociativo de PHP

$response = json_decode($result, true);
// Verificamos si la respuesta tiene éxito
if ($response["exito"] === true) {
echo  "Test de login correcto, pasó\n";
} else {
echo "Test de login incorrecto, falló:\n";
}
?>

