<?php

class CamionControlador{
    
    private $modelo;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../modelo/camModelo.php';
        $this->modelo = new CamionModelo($pdo);
    }

    public function crear()
    {
        $matricula = trim($_POST['matricula'] ?? '');
        $capacidad = trim($_POST['capacidad'] ?? '');

        if ($matricula === '' || $capacidad === '') {
            echo json_encode(['ok' => false, 'error' => 'Faltan datos']);
            return;
        }

        try {
            $this->modelo->CrearCamion($matricula, $capacidad);
            echo json_encode(['ok' => true]);
        } catch (PDOException $e) {
            echo json_encode(['ok' => false, 'error' => 'Esa matrícula ya existe']);
        }
    }

    public function listar()
    {
        $camiones = $this->modelo->ListarCamiones();
        echo json_encode($camiones);
    }

    public function actualizar()
    {
        $matricula = trim($_POST['matricula'] ?? '');
        $capacidad = trim($_POST['capacidad'] ?? '');

        if ($matricula === '' || $capacidad === '') {
            echo json_encode(['ok' => false, 'error' => 'Faltan datos']);
            return;
        }

        $resultado = $this->modelo->ActualizarCamion($matricula, $capacidad);
        echo json_encode(['ok' => $resultado]);
    }

    public function borrar()
    {
        $matricula = trim($_POST['matricula'] ?? '');

        if ($matricula === '') {
            echo json_encode(['ok' => false, 'error' => 'Falta la matrícula']);
            return;
        }

        $resultado = $this->modelo->BorrarCamion($matricula);
        echo json_encode(['ok' => $resultado]);
    }

}
