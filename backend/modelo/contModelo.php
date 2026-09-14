<?php
class ContenedorModelo{
    private $pdo;

    public function __construct($pdo){
        $this ->pdo = $pdo;
    }

    public function ListarContenedores(){
        $stmt = $this->pdo->prepare("SELECT * FROM contenedor");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function CrearContenedor($zona, $capacidad, $idEst = null){
        $stmt = $this->pdo->prepare("INSERT INTO contenedor (zona, capacidad, idEst) VALUES (:zona, :capacidad, :idEst)");
        $stmt->execute([
            'zona' => $zona,
            'capacidad' => $capacidad,
            'idEst' => $idEst !== '' ? $idEst : null
        ]);
    }

    public function ActualizarContenedor($idCont, $zona, $capacidad, $idEst = null)
    {
        $stmt = $this->pdo->prepare("UPDATE contenedor SET zona = :zona, capacidad = :capacidad, idEst = :idEst WHERE idCont = :idCont");
        return $stmt->execute([
            'idCont' => $idCont,
            'zona' => $zona,
            'capacidad' => $capacidad,
            'idEst' => $idEst !== '' ? $idEst : null
        ]);
    }

    public function BorrarContenedor($idCont)
    {
        $stmt = $this->pdo->prepare("DELETE FROM contenedor WHERE idCont = :idCont");
        return $stmt->execute([
            'idCont' => $idCont
        ]);
    }

}


?>
