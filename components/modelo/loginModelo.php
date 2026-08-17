<?php

require_once __DIR__ . '/../conexion/conexion.php';


class LoginModelo
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function Login($email, $contrasena)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            return $usuario;
        } else {
            return false;
        }
    }

    
}

?>