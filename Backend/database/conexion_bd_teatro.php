<?php

    class ConexionBD{
        private $conexion;
        private $host = "127.0.0.1:3306";
        private $usuario = "root";
        private $password = "root";
        private $bd = "teatro_pleasantville";

        public function __construct(){
            $this->conexion = mysqli_connect($this->host, $this->usuario, $this->password, $this->bd);

            if(!$this->conexion){
                die ("ERROR EN CONEXION A BD" . mysqli_connect_error());
                echo "ERROR CONEXION";
            }

            echo "BD CONECTADA";
        }

        public function getConexion(){
            return $this->conexion;
        }
        
    }

?>