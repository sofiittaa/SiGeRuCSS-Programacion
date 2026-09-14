<?php
    class CamionModelo{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function ListarCamiones( ){
        $stmt = $this->pdo->prepare("SELECT * FROM camion");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function CrearCamion($matricula, $capacidad){
        $stmt = $this->pdo->prepare("INSERT INTO camion (matricula, capacidad) VALUES (:matricula, :capacidad)");
        $stmt->execute([
            'matricula' => $matricula,
            'capacidad' => $capacidad 
        ]);
        
        }

    public function ActualizarCamion( $matricula, $capacidad)
    {
        $stmt = $this->pdo->prepare("UPDATE camion SET matricula = :matricula, capacidad = :capacidad WHERE matricula = :matricula");
        return $stmt->execute([
            'matricula' => $matricula,
            'capacidad' => $capacidad
        ]);
    }

    public function BorrarCamion($matricula)
    {
        $stmt = $this->pdo->prepare("DELETE FROM camion WHERE matricula = :matricula");
        return $stmt->execute([
            'matricula' => $matricula
        ]);
    }


    }
?>