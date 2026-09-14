<?php
class VertederoModelo
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function ListarVertederos()
    {
        $stmt = $this->pdo->prepare(
            "SELECT d.* FROM destino d
             INNER JOIN vertedero v ON v.RUTdes = d.RUTdes"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function CrearVertedero($RUTdes, $nomDes, $capDes, $horAperDes, $horCierDes, $zonaDes, $tipoResiduo = null, $idEst = null)
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO destino (RUTdes, nomDes, capDes, horAperDes, horCierDes, zonaDes, tipoResiduo, idEst)
                 VALUES (:RUTdes, :nomDes, :capDes, :horAperDes, :horCierDes, :zonaDes, :tipoResiduo, :idEst)"
            );
            $stmt->execute([
                'RUTdes' => $RUTdes,
                'nomDes' => $nomDes,
                'capDes' => $capDes,
                'horAperDes' => $horAperDes,
                'horCierDes' => $horCierDes,
                'zonaDes' => $zonaDes,
                'tipoResiduo' => $tipoResiduo !== '' ? $tipoResiduo : null,
                'idEst' => $idEst !== '' ? $idEst : null
            ]);

            $stmt = $this->pdo->prepare("INSERT INTO vertedero (RUTdes) VALUES (:RUTdes)");
            $stmt->execute([
                'RUTdes' => $RUTdes
            ]);

            $this->pdo->commit();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function ActualizarVertedero($RUTdes, $nomDes, $capDes, $horAperDes, $horCierDes, $zonaDes, $tipoResiduo = null, $idEst = null)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE destino
             SET nomDes = :nomDes, capDes = :capDes, horAperDes = :horAperDes, horCierDes = :horCierDes, zonaDes = :zonaDes, tipoResiduo = :tipoResiduo, idEst = :idEst
             WHERE RUTdes = :RUTdes"
        );
        return $stmt->execute([
            'RUTdes' => $RUTdes,
            'nomDes' => $nomDes,
            'capDes' => $capDes,
            'horAperDes' => $horAperDes,
            'horCierDes' => $horCierDes,
            'zonaDes' => $zonaDes,
            'tipoResiduo' => $tipoResiduo !== '' ? $tipoResiduo : null,
            'idEst' => $idEst !== '' ? $idEst : null
        ]);
    }

    public function BorrarVertedero($RUTdes)
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare("DELETE FROM vertedero WHERE RUTdes = :RUTdes");
            $stmt->execute(['RUTdes' => $RUTdes]);

            $stmt = $this->pdo->prepare("DELETE FROM destino WHERE RUTdes = :RUTdes");
            $resultado = $stmt->execute(['RUTdes' => $RUTdes]);

            $this->pdo->commit();
            return $resultado;
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}
