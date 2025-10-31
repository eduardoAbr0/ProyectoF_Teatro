<?php

    include_once('./miembro_dao.php');
    include_once('../model/model_miembro.php');

    $miembroDAO = new MiembroDAO();

    var_dump($_POST);

    $id = $_POST['formId'];
    $nombre = $_POST['formNombreModificar'];
    $apellido = $_POST['formPrimerApModificar'];
    $sApellido = $_POST['formSegundoApModificar'];
    $telefono = $_POST['formTelefonoModificar'];
    $email = $_POST['formEmailModificar'];
    $numcasa = $_POST['formNumCasaModificar'];
    $calle = $_POST['formCalleModificar'];
    $col = $_POST['formColoniaModificar'];
    $cp = $_POST['formCPModificar'];

    $miembro = new miembro(
        $nombre,
        $apellido,
        $sApellido,
        $telefono,
        $email,
        $numcasa,
        $calle,
        $col,
        $cp
    );

    $miembro->setId($id);

    // VALIDACIONES PHP(FALTANTES)

    $datos_correctos = true;

    // var_dump($nc);
    // var_dump($nombre);
    // var_dump($primerap);
    // var_dump($segundoap);
    // var_dump($fechanac);
    // var_dump($semestre);
    // var_dump($carrera);

    if($datos_correctos){
        $res = $miembroDAO->cambioMiembro($miembro);

        if($res){
            echo "BNNNNNNNNNN";

            header('location: ../pages/miembros.html');
        }
        else
            echo "error";
        
    }else{
        echo "DATOS INCORRECTOS";
    }

?>