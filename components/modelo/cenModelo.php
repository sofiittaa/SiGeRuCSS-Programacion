<?php
class CentroAcopioModelo
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function ListarCentros()
    {
        $stmt = $this->pdo->prepare(
            "SELECT d.* FROM destino d
             INNER JOIN centroAcopio c ON c.RUTdes = d.RUTdes"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function CrearCentro($RUTdes, $nomDes, $capDes, $horAperDes, $horCierDes, $zonaDes)
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO destino (RUTdes, nomDes, capDes, horAperDes, horCierDes, zonaDes)
                 VALUES (:RUTdes, :nomDes, :capDes, :horAperDes, :horCierDes, :zonaDes)"
            );
            $stmt->execute([
                'RUTdes' => $RUTdes,
                'nomDes' => $nomDes,
                'capDes' => $capDes,
                'horAperDes' => $horAperDes,
                'horCierDes' => $horCierDes,
                'zonaDes' => $zonaDes
            ]);

            $stmt = $this->pdo->prepare("INSERT INTO centroAcopio (RUTdes) VALUES (:RUTdes)");
            $stmt->execute([
                'RUTdes' => $RUTdes
            ]);

            $this->pdo->commit();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function ActualizarCentro($RUTdes, $nomDes, $capDes, $horAperDes, $horCierDes, $zonaDes)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE destino
             SET nomDes = :nomDes, capDes = :capDes, horAperDes = :horAperDes, horCierDes = :horCierDes, zonaDes = :zonaDes
             WHERE RUTdes = :RUTdes"
        );
        return $stmt->execute([
            'RUTdes' => $RUTdes,
            'nomDes' => $nomDes,
            'capDes' => $capDes,
            'horAperDes' => $horAperDes,
            'horCierDes' => $horCierDes,
            'zonaDes' => $zonaDes
        ]);
    }

    public function BorrarCentro($RUTdes)
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare("DELETE FROM centroAcopio WHERE RUTdes = :RUTdes");
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
