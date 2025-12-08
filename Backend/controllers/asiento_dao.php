<?php

include_once('../database/conexion_bd_teatro.php');

class AsientoDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = ConexionBD::getInstance();
    }

    public function mostrarAsientos()
    {
        $sql = "SELECT * FROM Asientos";
        $stmt = $this->conexion->getConexion()->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        // $this->conexion->getConexion()->close();

        return $res;
    }
}
