<?php
require_once '../database/conexion_bd_teatro.php';

class ReporteDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = ConexionBD::getInstance();
    }

    public function obtenerGananciasPorObra()
    {
        $sql = "SELECT id_obra, titulo, fn_calcular_ganancia_obra(id_obra) as ganancia FROM obras";

        $res = $this->conexion->getConexion()->query($sql);

        $reporte = [];

        if ($res) {
            while ($fila = $res->fetch_assoc()) {
                $reporte[] = $fila;
            }
        }


        return $reporte;
    }
}
