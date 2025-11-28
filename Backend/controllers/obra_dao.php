<?php

include_once('../database/conexion_bd_teatro.php');
include_once('../models/model_obra.php');

class ObraDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new ConexionBD();
    }

    //-----METODOS ABCC---

    //ALTAS
    public function agregarObra($obra)
    {
        //INSTRUCCION SQL A EXECUTAR
        $sql = "INSERT INTO Obras (titulo, autor, tipo, num_actos, anio_presentacion, temporada, productor, descripcion)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        //INSTRUCCION STATEMENT
        $stmt = $this->conexion->getConexion()->prepare($sql);

        //ASIGNACION DE VALORES PARA EL PREPARE STATEMENT
        $titulo = $obra->getTitulo();
        $autor = $obra->getAutor();
        $tipo = $obra->getTipo();
        $numActos = $obra->getNumActos();
        $anioPresentacion = $obra->getAnioPresentacion();
        $temporada = $obra->getTemporada();
        $productor = $obra->getProductorFk();
        $descripcion = $obra->getDescripcion();

        $stmt->bind_param("sssssississ", $titulo, $autor, $tipo, $numActos, $anioPresentacion, $temporada, $productor, $descripcion);

        $res = $stmt->execute();

        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    //CAMBIOS
    public function cambioObra($obra)
    {
        $sql = "UPDATE Obras SET titulo=?, autor=?, tipo=?, num_actos=?, anio_presentacion=?, temporada=?, productor=?, descripcion=? WHERE id_obra=?";

        $stmt = $this->conexion->getConexion()->prepare($sql);

        $titulo = $obra->getTitulo();
        $autor = $obra->getAutor();
        $tipo = $obra->getTipo();
        $num_actos = $obra->getNumActos();
        $anio = $obra->getAnioPresentacion();
        $temporada = $obra->getTemporada();
        $productor = $obra->getProductorFk();
        $descripcion = $obra->getDescripcion();
        $id = $obra->getIdObra();

        $stmt->bind_param("sssiisisi", $titulo, $autor, $tipo, $num_actos, $anio, $temporada, $productor, $descripcion, $id);

        $res = $stmt->execute();
        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    //BAJAS
    public function eliminarObra($id)
    {
        $sql = "DELETE FROM Obras WHERE id_obra = ?";
        $stmt = mysqli_prepare($this->conexion->getConexion(), $sql);
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        $stmt->close();
        $this->conexion->getConexion()->close();
        return $res;
    }

    //CONSULTAS
    public function mostrarObras()
    {
        $sql = "SELECT * FROM Obras";

        $stmt = $this->conexion->getConexion()->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        return $res;
    }

    //CONSULTA ID
    public function mostrarObraDetalle($id)
    {
        $sql = "SELECT * FROM Obras WHERE id_obra = ?";
        $stmt = mysqli_prepare($this->conexion->getConexion(), $sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        $this->conexion->getConexion()->close();
        
        return $res;
    }
}
