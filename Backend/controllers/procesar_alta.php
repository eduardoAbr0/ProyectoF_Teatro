<?php

    include_once('./miembro_dao.php');
    include_once('../model/model_miembro.php');

    $miembroDAO = new MiembroDAO();

    $nombre = $_POST['formNombre'];
    $apellido = $_POST['formPrimerAp'];
    $sApellido = $_POST['formSegundoAp'];
    $telefono = $_POST['formTelefono'];
    $email = $_POST['formEmail'];
    $numcasa = $_POST['formNumCasa'];
    $calle = $_POST['formCalle'];
    $col = $_POST['formColonia'];
    $cp = $_POST['formCP'];

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
        $res = $miembroDAO->agregarMiembro($miembro);

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