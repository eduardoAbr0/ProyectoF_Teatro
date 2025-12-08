<?php
require_once 'usuario_dao.php';

class TeatroFacade
{
    private $usuarioDAO;

    public function __construct()
    {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function verificarAcceso($username, $password)
    {
        return $this->usuarioDAO->login($username, $password);
    }
}
