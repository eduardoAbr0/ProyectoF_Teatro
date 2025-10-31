<?php

include_once('miembro_dao.php');


$miembroDAO = new MiembroDAO();
$result = $miembroDAO->mostrarMiembros();
$datos = [];

while ($row = mysqli_fetch_assoc($result)) {
    $datos[] = $row;
}

echo json_encode($datos);
?>