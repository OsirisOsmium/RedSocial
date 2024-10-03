<?php
    include ("crud.php");


    // usurios ----> /
    // titulo ----> :



    $crud=new Crud;

    if (isset($_POST["inputBuscar"])){
        
        $busqueda = $_POST["inputBuscar"];
        $aBuscar = substr($busqueda, 1);

        if ($busqueda[0] == "/"){
            $coleccion = "publicaciones";
            $filtrado = ['userName' => $aBuscar];
            $allDataFilter = $crud->mostrarDatoFiltrado($coleccion, $filtrado);
        }else if ($busqueda[0] == ":"){
            $coleccion = "publicaciones";
            $filtrado = ['titulo' => $aBuscar];
            $allDataFilter = $crud->mostrarDatoFiltrado($coleccion, $filtrado);
        }
    }
?>