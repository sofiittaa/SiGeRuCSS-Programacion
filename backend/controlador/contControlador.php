<?php

class ContenedorControlador {
    private $modelo;

    public function __construct($pdo) {
        require_once __DIR__ . '/../modelo/contModelo.php';
        $this->modelo = new ContenedorModelo($pdo);
    }

    public function listar() {
        $contenedores = $this->modelo->ListarContenedores();
        echo json_encode($contenedores);

        
        }

    public function Crear() {
        $zona = trim($_POST['zona'] ?? '');
        $capacidad = trim($_POST['capacidad'] ?? '');
        $idEst = trim($_POST['idEst'] ?? '');

        if ($zona === '' || $capacidad === '') {
            echo json_encode(['exito' => false, 'error' => 'Faltan datos']);
            return;
        }

        try {
            $this->modelo->CrearContenedor($zona, $capacidad, $idEst);
            echo json_encode(['exito' => true]);
        } catch (PDOException $e) {
            echo json_encode(['exito' => false, 'error' => 'No se pudo registrar el contenedor']);
        }
    }

    public function actualizar() {
        $idCont = trim($_POST['idCont'] ?? '');
        $zona = trim($_POST['zona'] ?? '');
        $capacidad = trim($_POST['capacidad'] ?? '');
        $idEst = trim($_POST['idEst'] ?? '');
        $resultado = $this->modelo->ActualizarContenedor($idCont, $zona, $capacidad, $idEst);
        echo json_encode(['exito' => $resultado]);
    }

    public function borrar() {
        $idCont = trim($_POST['idCont'] ?? '');
        $resultado = $this->modelo->BorrarContenedor($idCont);
        echo json_encode(['exito' => $resultado]);
    }

}
