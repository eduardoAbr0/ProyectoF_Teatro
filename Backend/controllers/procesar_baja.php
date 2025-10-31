<?php
include_once('miembro_dao.php');

$miembroDAO = new MiembroDAO();

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

$result = $miembroDAO->eliminarMiembro($id);
?>