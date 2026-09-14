<?php

// Si DB_HOST está definida (la setea docker-compose.yml para el contenedor "app"),
// usamos esa. Si no existe (corriendo directo con XAMPP), usamos localhost.
$dbHost = getenv('DB_HOST') ?: 'localhost';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=SiGeRu", 'sofiittaa', 'sofi123.20');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
