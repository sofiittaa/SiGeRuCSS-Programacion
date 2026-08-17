<?php
class UsuarioModelo
{
    private $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function Listar()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario");
        $stmt->execute();
        return $stmt->fetchAll();
    }



    public function Crear($cedula, $nombre, $apellido, $zonaUsu, $email, $contrasena)
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare("INSERT INTO usuario (cedula, nombre, apellido, email, contrasena, rol) VALUES (:cedula, :nombre, :apellido, :email, :contrasena, 'vecino')");
            $stmt->execute([
                'cedula' => $cedula,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'email' => $email,
                'contrasena' => $contrasena
            ]);

            $stmt = $this->pdo->prepare("INSERT INTO vecino (cedula, zonaUsu) VALUES (:cedula, :zonaUsu)");
            $stmt->execute([
                'cedula' => $cedula,
                'zonaUsu' => $zonaUsu
            ]);

            $this->pdo->commit();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function Actualizar($cedula, $nombre, $apellido, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE usuario SET nombre = :nombre, apellido = :apellido, email = :email WHERE cedula = :cedula");
        return $stmt->execute([
            'cedula' => $cedula,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email
        ]);
    }

    public function Borrar($cedula)
    {
        $stmt = $this->pdo->prepare("DELETE FROM usuario WHERE cedula = :cedula");
        return $stmt->execute([
            'cedula' => $cedula
        ]);
    }

    public function ListarEmpleados()
    {
        $stmt = $this->pdo->prepare(
            "SELECT u.* FROM usuario u
             INNER JOIN empleado e ON e.cedula = u.cedula"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function CrearEmpleado($cedula, $nombre, $apellido, $email, $contrasena)
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare("INSERT INTO usuario (cedula, nombre, apellido, email, contrasena, rol) VALUES (:cedula, :nombre, :apellido, :email, :contrasena, 'empleado')");
            $stmt->execute([
                'cedula' => $cedula,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'email' => $email,
                'contrasena' => $contrasena
            ]);

            $stmt = $this->pdo->prepare("INSERT INTO empleado (cedula) VALUES (:cedula)");
            $stmt->execute([
                'cedula' => $cedula
            ]);

            $this->pdo->commit();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function BorrarEmpleado($cedula)
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare("DELETE FROM empleado WHERE cedula = :cedula");
            $stmt->execute(['cedula' => $cedula]);

            $stmt = $this->pdo->prepare("DELETE FROM usuario WHERE cedula = :cedula");
            $resultado = $stmt->execute(['cedula' => $cedula]);

            $this->pdo->commit();
            return $resultado;
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}


?>
