<?php

class CentroAcopioControlador
{
    private $modelo;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../modelo/cenModelo.php';
        $this->modelo = new CentroAcopioModelo($pdo);
    }

    public function listar()
    {
        $centros = $this->modelo->ListarCentros();
        echo json_encode($centros);
    }

    public function crear()
    {
        $RUTdes = trim($_POST['RUTdes'] ?? '');
        $nomDes = trim($_POST['nomDes'] ?? '');
        $capDes = trim($_POST['capDes'] ?? '');
        $horAperDes = trim($_POST['horAperDes'] ?? '');
        $horCierDes = trim($_POST['horCierDes'] ?? '');
        $zonaDes = trim($_POST['zonaDes'] ?? '');

        if ($RUTdes === '' || $nomDes === '' || $capDes === '' || $horAperDes === '' || $horCierDes === '' || $zonaDes === '') {
            echo json_encode(['ok' => false, 'error' => 'Faltan datos']);
            return;
        }

        try {
            $this->modelo->CrearCentro($RUTdes, $nomDes, $capDes, $horAperDes, $horCierDes, $zonaDes);
            echo json_encode(['ok' => true]);
        } catch (PDOException $e) {
            echo json_encode(['ok' => false, 'error' => 'No se pudo registrar el centro de acopio']);
        }
    }

    public function actualizar()
    {
        $RUTdes = trim($_POST['RUTdes'] ?? '');
        $nomDes = trim($_POST['nomDes'] ?? '');
        $capDes = trim($_POST['capDes'] ?? '');
        $horAperDes = trim($_POST['horAperDes'] ?? '');
        $horCierDes = trim($_POST['horCierDes'] ?? '');
        $zonaDes = trim($_POST['zonaDes'] ?? '');

        if ($RUTdes === '' || $nomDes === '' || $capDes === '' || $horAperDes === '' || $horCierDes === '' || $zonaDes === '') {
            echo json_encode(['ok' => false, 'error' => 'Faltan datos']);
            return;
        }

        $resultado = $this->modelo->ActualizarCentro($RUTdes, $nomDes, $capDes, $horAperDes, $horCierDes, $zonaDes);
        echo json_encode(['ok' => $resultado]);
    }

    public function borrar()
    {
        $RUTdes = trim($_POST['RUTdes'] ?? '');

        if ($RUTdes === '') {
            echo json_encode(['ok' => false, 'error' => 'Falta el RUT del destino']);
            return;
        }

        $resultado = $this->modelo->BorrarCentro($RUTdes);
        echo json_encode(['ok' => $resultado]);
    }
}
