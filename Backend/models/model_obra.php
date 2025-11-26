<?php

class Obra
{
    private $id_obra;
    private $titulo;
    private $autor;
    private $tipo;
    private $num_actos;
    private $anio_presentacion;
    private $temporada;
    private $productor_fk; 
    private $descripcion;

    public function __construct(
        $titulo,
        $autor,
        $tipo,
        $num_actos,
        $anio_presentacion,
        $temporada,
        $productor_fk,
        $descripcion
    ) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->tipo = $tipo;
        $this->num_actos = $num_actos;
        $this->anio_presentacion = $anio_presentacion;
        $this->temporada = $temporada;
        $this->productor_fk = $productor_fk;
        $this->descripcion = $descripcion;
    }

    public function getIdObra()
    {
        return $this->id_obra;
    }

    public function setIdObra($id)
    {
        $this->id_obra = $id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    
    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }


    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getNumActos()
    {
        return $this->num_actos;
    }

    public function setNumActos($num_actos)
    {
        $this->num_actos = $num_actos;
    }

    public function getAnioPresentacion()
    {
        return $this->anio_presentacion;
    }

    public function setAnioPresentacion($anio_presentacion)
    {
        $this->anio_presentacion = $anio_presentacion;
    }

    public function getTemporada()
    {
        return $this->temporada;
    }

    public function setTemporada($temporada)
    {
        $this->temporada = $temporada;
    }
}