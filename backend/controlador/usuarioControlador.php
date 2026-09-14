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
        $contrasenaCruda = trim($_POST['contrasena'] ?? '');

        if ($cedula === '' || $nombre === '' || $apellido === '' || $zonaUsu === '' || $email === '' || $contrasenaCruda === '') {
            echo json_encode(['exito' => false, 'error' => 'Faltan datos']);
            return;
        }

        if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
            echo json_encode(['exito' => false, 'error' => 'Email inválido']);
            return;
        }

        if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $nombre)) {
            echo json_encode(['exito' => false, 'error' => 'El nombre solo debe contener letras']);
            return;
        }

        if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $apellido)) {
            echo json_encode(['exito' => false, 'error' => 'El apellido solo debe contener letras']);
            return;
        }

        if (!preg_match('/^[0-9]+$/', $cedula)) {
            echo json_encode(['exito' => false, 'error' => 'La cédula solo debe contener números']);
            return;
        }

        $contrasena = password_hash($contrasenaCruda, PASSWORD_DEFAULT);

        $modelo = new UsuarioModelo($this->pdo);
        try {
            $modelo->Crear($cedula, $nombre, $apellido, $zonaUsu, $email, $contrasena);
            echo json_encode(['exito' => true]);
        } catch (PDOException $e) {
            echo json_encode(['exito' => false, 'error' => 'Esa cédula o email ya existe']);
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
            echo json_encode(['exito' => false, 'error' => 'Faltan datos']);
            return;
        }

         if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
            echo json_encode(['exito' => false, 'error' => 'Email inválido']);
            return;
        }

        if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $nombre)) {
            echo json_encode(['exito' => false, 'error' => 'El nombre solo debe contener letras']);
            return;
        }

        if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $apellido)) {
            echo json_encode(['exito' => false, 'error' => 'El apellido solo debe contener letras']);
            return;
        }

        if (!preg_match('/^[0-9]+$/', $cedula)) {
            echo json_encode(['exito' => false, 'error' => 'La cédula solo debe contener números']);
            return;
        }


        $modelo = new UsuarioModelo($this->pdo);
        $resultado = $modelo->Actualizar($cedula, $nombre, $apellido, $email);
        echo json_encode(['exito' => $resultado]);
    }

    public function Borrar(){
        $cedula = trim($_POST['cedula'] ?? '');

        if ($cedula === '') {
            echo json_encode(['exito' => false, 'error' => 'Falta la cédula']);
            return;
        }

        $modelo = new UsuarioModelo($this->pdo);
        $resultado = $modelo->Borrar($cedula);
        echo json_encode(['exito' => $resultado]);
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
        $contrasenaCruda = trim($_POST['contrasena'] ?? '');

        if ($cedula === '' || $nombre === '' || $apellido === '' || $email === '' || $contrasenaCruda === '') {
            echo json_encode(['exito' => false, 'error' => 'Faltan datos']);
            return;
        }

        if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
            echo json_encode(['exito' => false, 'error' => 'Email inválido']);
            return;
        }

        if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $nombre)) {
            echo json_encode(['exito' => false, 'error' => 'El nombre solo debe contener letras']);
            return;
        }

        if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $apellido)) {
            echo json_encode(['exito' => false, 'error' => 'El apellido solo debe contener letras']);
            return;
        }


        $contrasena = password_hash($contrasenaCruda, PASSWORD_DEFAULT);

        $modelo = new UsuarioModelo($this->pdo);
        try {
            $modelo->CrearEmpleado($cedula, $nombre, $apellido, $email, $contrasena);
            echo json_encode(['exito' => true]);
        } catch (PDOException $e) {
            echo json_encode(['exito' => false, 'error' => 'Esa cédula o email ya existe']);
        }
    }

    public function BorrarEmpleado(){
        $cedula = trim($_POST['cedula'] ?? '');

        if ($cedula === '') {
            echo json_encode(['exito' => false, 'error' => 'Falta la cédula']);
            return;
        }

        $modelo = new UsuarioModelo($this->pdo);
        try {
            $resultado = $modelo->BorrarEmpleado($cedula);
            echo json_encode(['exito' => $resultado]);
        } catch (PDOException $e) {
            echo json_encode(['exito' => false, 'error' => 'No se pudo eliminar el empleado']);
        }
    }


}

 
?>
