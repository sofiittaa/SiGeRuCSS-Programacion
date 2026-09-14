<?php

// backend/testings/_helper.php
// Funciones reutilizables para los scripts de testing (mismo estilo que testingLogin.php,
// extendido para poder loguear y reusar la sesión en pedidos siguientes).

const BASE_URL = "http://localhost/SiGeRuCSS+/backend/APIS";

// Cuentas de prueba usadas por todos los tests.
const ADMIN_EMAIL = "adminsigeru@gmail.com";
const ADMIN_PASS = "0668aDmin";
const VECINO_TEST_EMAIL = "vecino.prueba@sigeru.com";
const VECINO_TEST_PASS = "Prueba123!";

// Hace un POST a la API y devuelve la respuesta ya decodificada + la cookie de sesión
// (para poder mandarla en el siguiente pedido y quedar "logueado" entre requests).
function postRequest(string $url, array $data, ?string $cookie = null): array
{
    $headers = "Content-type: application/x-www-form-urlencoded\r\n";
    if ($cookie !== null) {
        $headers .= "Cookie: $cookie\r\n";
    }

    $options = [
        "http" => [
            "header" => $headers,
            "method" => "POST",
            "content" => http_build_query($data),
            "ignore_errors" => true, // asi podemos leer el body aunque la respuesta sea 401/403/405
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);

    $cookieRecibida = $cookie;
    foreach ($http_response_header ?? [] as $header) {
        if (stripos($header, 'Set-Cookie:') === 0) {
            $partes = explode(';', substr($header, 11));
            $cookieRecibida = trim($partes[0]);
        }
    }

    return ['response' => $response, 'cookie' => $cookieRecibida];
}

// Loguea con el endpoint real de auth.login y devuelve la cookie de sesión, o null si falló.
function loginComo(string $email, string $contrasena): ?string
{
    $r = postRequest(BASE_URL . "/apiUsuario.php", [
        "accion" => "auth.login",
        "email" => $email,
        "contrasena" => $contrasena,
    ]);

    return ($r['response']['exito'] ?? false) ? $r['cookie'] : null;
}

// Imprime el resultado de un chequeo, con el mismo espíritu que el ✅/❌ del ejemplo del profe.
function assertTrue(bool $condicion, string $mensaje): void
{
    echo ($condicion ? "✅ " : "❌ ") . $mensaje . "\n";
}
