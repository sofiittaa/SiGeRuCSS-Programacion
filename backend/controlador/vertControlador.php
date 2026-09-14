<?php

class VertederoControlador
{
    private $modelo;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../modelo/vertModelo.php';
        $this->modelo = new VertederoModelo($pdo);
    }

    public function listar()
    {
        $vertederos = $this->modelo->ListarVertederos();
        echo json_encode($vertederos);
    }

    public function crear()
    {
        $RUTdes = trim($_POST['RUTdes'] ?? '');
        $nomDes = trim($_POST['nomDes'] ?? '');
        $capDes = trim($_POST['capDes'] ?? '');
        $horAperDes = trim($_POST['horAperDes'] ?? '');
        $horCierDes = trim($_POST['horCierDes'] ?? '');
        $zonaDes = trim($_POST['zonaDes'] ?? '');
        $tipoResiduo = trim($_POST['tipoResiduo'] ?? '');
        $idEst = trim($_POST['idEst'] ?? '');

        if ($RUTdes === '' || $nomDes === '' || $capDes === '' || $horAperDes === '' || $horCierDes === '' || $zonaDes === '') {
            echo json_encode(['exito' => false, 'error' => 'Faltan datos']);
            return;
        }

        try {
            $this->modelo->CrearVertedero($RUTdes, $nomDes, $capDes, $horAperDes, $horCierDes, $zonaDes, $tipoResiduo, $idEst);
            echo json_encode(['exito' => true]);
        } catch (PDOException $e) {
            echo json_encode(['exito' => false, 'error' => 'No se pudo registrar el vertedero']);
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
        $tipoResiduo = trim($_POST['tipoResiduo'] ?? '');
        $idEst = trim($_POST['idEst'] ?? '');

        if ($RUTdes === '' || $nomDes === '' || $capDes === '' || $horAperDes === '' || $horCierDes === '' || $zonaDes === '') {
            echo json_encode(['exito' => false, 'error' => 'Faltan datos']);
            return;
        }

        $resultado = $this->modelo->ActualizarVertedero($RUTdes, $nomDes, $capDes, $horAperDes, $horCierDes, $zonaDes, $tipoResiduo, $idEst);
        echo json_encode(['exito' => $resultado]);
    }

    public function borrar()
    {
        $RUTdes = trim($_POST['RUTdes'] ?? '');

        if ($RUTdes === '') {
            echo json_encode(['exito' => false, 'error' => 'Falta el RUT del destino']);
            return;
        }

        $resultado = $this->modelo->BorrarVertedero($RUTdes);
        echo json_encode(['exito' => $resultado]);
    }
}
