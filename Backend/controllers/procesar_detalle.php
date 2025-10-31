<?php

include_once('./miembro_dao.php');

$miembroDAO = new MiembroDAO();

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

$result = $miembroDAO->mostrarMiembroDetalle($id);

$miembro = mysqli_fetch_assoc($result);

echo json_encode($miembro);


?>