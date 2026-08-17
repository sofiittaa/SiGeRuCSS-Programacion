<?php
// controlador/authControlador.php

require_once __DIR__ . '/../modelo/loginModelo.php';

class LoginControlador
{
    private $modelo;

    public function __construct($pdo)
    {
        $this->modelo = new LoginModelo($pdo);
    }

    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $contrasena = trim($_POST['contrasena'] ?? '');

        if ($email === '' || $contrasena === '') {
            echo json_encode(['ok' => false, 'error' => 'Completa todos los campos']);
            return;
        }

        $usuario = $this->modelo->Login($email, $contrasena);

        if ($usuario) {
            $_SESSION['usuario_cedula'] = $usuario['cedula'];
            $_SESSION['usuario_rol'] = $usuario['rol'];
            echo json_encode(['ok' => true, 'rol' => $usuario['rol']]);
        } else {
            echo json_encode(['ok' => false, 'error' => 'Email o contraseña incorrectos']);
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        echo json_encode(['ok' => true]);
        
    }
}