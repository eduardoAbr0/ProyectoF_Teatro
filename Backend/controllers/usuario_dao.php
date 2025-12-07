<?php
require_once '../database/conexion_bd_teatro.php';
require_once '../models/model_usuario.php';

class UsuarioDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new ConexionBD();
    }

    public function registrarUsuario($usuario)
    {
        $sql = "INSERT INTO usuarios (username, passw, nombre, email) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $username = $usuario->getUsername();
        $password = sha1($usuario->getPassword());
        $nombre = $usuario->getNombre();
        $email = $usuario->getEmail();

        $stmt->bind_param("ssss", $username, $password, $nombre, $email);

        $res = $stmt->execute();

        $stmt->close();
        $this->conexion->getConexion()->close();

        return $res;
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM usuarios WHERE username = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res === false) {
            $stmt->close();
            return false;
        }

        if ($row = $res->fetch_assoc()) {
            if (sha1($password) === $row['passw']) {
                $stmt->close();
                $this->conexion->getConexion()->close();
                return $row;
            }
        }

        $stmt->close();
        $this->conexion->getConexion()->close();
        return false;
    }

    public function verificarUsuario($username)
    {
        $sql = "SELECT * FROM usuarios WHERE username = ?";
        $stmt = $this->conexion->getConexion()->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res === false) {
            $stmt->close();
            return false;
        }

        $existe = $res->num_rows > 0;

        $stmt->close();
        $this->conexion->getConexion()->close();
        return $existe;
    }
}
