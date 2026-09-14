<?php
class MaquiModelo
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function Listarmaquinas()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM maquinariabasica");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function CrearMaquinas($codigoActivo, $tipoMaquinaria, $numeroSerie, $modelo, $marca, $anofabricacion)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO maquinariabasica (codigoActivo, tipoMaquinaria, numeroSerie, modelo, marca, anofabricacion)
             VALUES (:codigoActivo, :tipoMaquinaria, :numeroSerie, :modelo, :marca, :anofabricacion)"
        );
        $stmt->execute([
            'codigoActivo' => $codigoActivo,
            'tipoMaquinaria' => $tipoMaquinaria,
            'numeroSerie' => $numeroSerie,
            'modelo' => $modelo,
            'marca' => $marca,
            'anofabricacion' => $anofabricacion
        ]);
    }

    public function ActualizarMaquinaria( $codigoActivo, $tipoMaquinaria, $numeroSerie, $modelo, $marca, $anofabricacion)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE maquinariabasica
             SET codigoActivo = :codigoActivo,
                 tipoMaquinaria = :tipoMaquinaria,
                 numeroSerie = :numeroSerie,
                 modelo = :modelo,
                 marca = :marca,
                 anofabricacion = :anofabricacion
             WHERE codigoActivo = :codigoActivo"
        );
        return $stmt->execute([
            'codigoActivo' => $codigoActivo,
            'tipoMaquinaria' => $tipoMaquinaria,
            'numeroSerie' => $numeroSerie,
            'modelo' => $modelo,
            'marca' => $marca,
            'anofabricacion' => $anofabricacion
        ]);
    }

    public function BorrarMaquinaria($codigoActivo)
    {
        $stmt = $this->pdo->prepare("DELETE FROM maquinariabasica WHERE codigoActivo = :codigoActivo");
        return $stmt->execute(['codigoActivo' => $codigoActivo]);
    }
}
