<?php

    class ConexionBD{
        private $conexion;
        private $host = "localhost:3307";
        private $usuario = "root";
        private $password = "pizzaplaneta";
        private $bd = "Proyecto_Teatro";

        public function __construct(){
            $this->conexion = mysqli_connect($this->host, $this->usuario, $this->password, $this->bd);

            if(!$this->conexion){
                die ("ERROR EN CONEXION A BD" . mysqli_connect_error());
            }
        }

        public function getConexion(){
            return $this->conexion;
        }
        
    }

?>