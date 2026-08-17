<?php

class UsuarioControlador{
    
    private $pdo;

    public function __construct($pdo){
        require_once __DIR__ . '/../modelo/usuarioModelo.php';
        $this->pdo = $pdo;
    }

    public function Crear(){
        $cedula = trim($_POST['cedula'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $zonaUsu = trim($_POST['zonaUsu'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $contrasena = password_hash(trim($_POST['contrasena'] ?? ''), PASSWORD_DEFAULT);

        if ($cedula === '' || $nombre === '' || $apellido === '' || $zonaUsu === '' || $email === '' || $contrasena === '') {
            echo json_encode(['ok' => false, 'error' => 'Faltan datos']);
            return;
        }

        $modelo = new UsuarioModelo($this->pdo);
        try {
            $modelo->Crear($cedula, $nombre, $apellido, $zonaUsu, $email, $contrasena);
            echo json_encode(['ok' => true]);
        } catch (PDOException $e) {
            echo json_encode(['ok' => false, 'error' => 'Esa cédula o email ya existe']);
        }
    }

    public function Listar(){
        $modelo = new UsuarioModelo($this->pdo);
        echo json_encode($modelo->Listar());
    }

    public function Actualizar(){
        $cedula = trim($_POST['cedula'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($cedula === '' || $nombre === '' || $apellido === '' || $email === '') {
            echo json_encode(['ok' => false, 'error' => 'Faltan datos']);
            return;
        }

        $modelo = new UsuarioModelo($this->pdo);
        $resultado = $modelo->Actualizar($cedula, $nombre, $apellido, $email);
        echo json_encode(['ok' => $resultado]);
    }

    public function Borrar(){
        $cedula = trim($_POST['cedula'] ?? '');

        if ($cedula === '') {
            echo json_encode(['ok' => false, 'error' => 'Falta la cédula']);
            return;
        }

        $modelo = new UsuarioModelo($this->pdo);
        $resultado = $modelo->Borrar($cedula);
        echo json_encode(['ok' => $resultado]);
    }

    public function ListarEmpleados(){
        $modelo = new UsuarioModelo($this->pdo);
        echo json_encode($modelo->ListarEmpleados());
    }

    public function CrearEmpleado(){
        $cedula = trim($_POST['cedula'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $contrasena = password_hash(trim($_POST['contrasena'] ?? ''), PASSWORD_DEFAULT);

        if ($cedula === '' || $nombre === '' || $apellido === '' || $email === '' || $contrasena === '') {
            echo json_encode(['ok' => false, 'error' => 'Faltan datos']);
            return;
        }

        $modelo = new UsuarioModelo($this->pdo);
        try {
            $modelo->CrearEmpleado($cedula, $nombre, $apellido, $email, $contrasena);
            echo json_encode(['ok' => true]);
        } catch (PDOException $e) {
            echo json_encode(['ok' => false, 'error' => 'Esa cédula o email ya existe']);
        }
    }

    public function BorrarEmpleado(){
        $cedula = trim($_POST['cedula'] ?? '');

        if ($cedula === '') {
            echo json_encode(['ok' => false, 'error' => 'Falta la cédula']);
            return;
        }

        $modelo = new UsuarioModelo($this->pdo);
        try {
            $resultado = $modelo->BorrarEmpleado($cedula);
            echo json_encode(['ok' => $resultado]);
        } catch (PDOException $e) {
            echo json_encode(['ok' => false, 'error' => 'No se pudo eliminar el empleado']);
        }
    }


}

 
?>
