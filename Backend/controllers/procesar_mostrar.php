<?php

include_once('./miembro_dao.php');

$alumnoDAO = new MiembroDAO();
$result = $alumnoDAO->mostrarMiembros();
$datos = [];

while ($row = mysqli_fetch_assoc($result)) {
    $datos[] = $row;
}

echo json_encode($datos);
?>