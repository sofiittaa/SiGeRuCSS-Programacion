<?php

class MaquinariaControlador {
    private $modelo;

    public function __construct($pdo) {
        require_once __DIR__ . '/../modelo/maquiModelo.php';
        $this->modelo = new MaquiModelo($pdo);
    }

    public function listar() {
        $maquinas = $this->modelo->Listarmaquinas();
        echo json_encode($maquinas);
    }

    public function Crear() {
        $codigoActivo = trim($_POST['codigoActivo'] ?? '');
        $tipoMaquinaria = trim($_POST['tipoMaquinaria'] ?? '');
        $numeroSerie = trim($_POST['numeroSerie'] ?? '');
        $modelo = trim($_POST['modelo'] ?? '');
        $marca = trim($_POST['marca'] ?? '');
        $anofabricacion = trim($_POST['anofabricacion'] ?? '');

        if ($codigoActivo === '' || $tipoMaquinaria === '' || $numeroSerie === '' || $modelo === '' || $marca === '' || $anofabricacion === '') {
            echo json_encode(['exito' => false, 'error' => 'Faltan datos']);
            return;
        }

        try {
            $this->modelo->CrearMaquinas($codigoActivo, $tipoMaquinaria, $numeroSerie, $modelo, $marca, $anofabricacion);
            echo json_encode(['exito' => true]);
        } catch (PDOException $e) {
            echo json_encode(['exito' => false, 'error' => 'No se pudo registrar la maquinaria']);
        }
    }

    public function actualizar() {
        $codigoActivo = trim($_POST['codigoActivo'] ?? '');
        $tipoMaquinaria = trim($_POST['tipoMaquinaria'] ?? '');
        $numeroSerie = trim($_POST['numeroSerie'] ?? '');
        $modelo = trim($_POST['modelo'] ?? '');
        $marca = trim($_POST['marca'] ?? '');
        $anofabricacion = trim($_POST['anofabricacion'] ?? '');
        $resultado = $this->modelo->ActualizarMaquinaria($codigoActivo, $tipoMaquinaria, $numeroSerie, $modelo, $marca, $anofabricacion);
        echo json_encode(['exito' => $resultado]);
    }

    public function borrar() {
        $codigoActivo = trim($_POST['codigoActivo'] ?? '');
        $resultado = $this->modelo->BorrarMaquinaria($codigoActivo);
        echo json_encode(['exito' => $resultado]);
    }

}
