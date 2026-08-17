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

    public function CrearContenedor( $zona, $capacidad, ){
        $stmt= $this->pdo->prepare("INSERT INTO contenedor( zona, capacidad)  VALUES ( :zona, :capacidad )");
        $stmt->execute([
        'zona' => $zona,
        'capacidad' => $capacidad

        ]);
    }

    public function ActualizarContenedor($idCont, $zona, $capacidad)
    {
        $stmt = $this->pdo->prepare("UPDATE contenedor SET zona = :zona, capacidad = :capacidad WHERE idCont = :idCont");
        return $stmt->execute([
            'idCont' => $idCont,
            'zona' => $zona,
            'capacidad' => $capacidad
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

