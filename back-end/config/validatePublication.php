<?php
    include("Crud.php");
    include("Protection.php");
    if (isset($_POST["pubTitle"], $_POST["pubDescription"], $_FILES["pubFile"]["name"])){
        $crud = new Crud();
        $nombre = $_FILES["pubFile"]["name"];
        $nameImage = time() . "_"  . $nombre;

        $ruta = "../image/publications/" . $nameImage;
        if (($_FILES["pubFile"]["size"] < 30000000)) {

            $resultado = move_uploaded_file($_FILES["pubFile"]["tmp_name"], $ruta);

            if ($resultado == true){
                $nombreSesion = $_SESSION['userName'];
                $arrayPublicacion = array(
                    "titulo" => $_POST["pubTitle"],
                    "descripcion" => $_POST["pubDescription"],
                    "dataPublication" => date('Y-m-d H:i:s'),
                    "likes" => [],
                    "comments" => [],
                    "timeAded" => date('Y-m-d H:i:s'),
                    "imgPublication" => "../back-end/image/publications/" . $nameImage,
                    "userName" => $nombreSesion
                );
                // Inserta la publiccion a MongoDB
                $insertarDatos = $crud->insertarDato("publicaciones", $arrayPublicacion);
                // echo $nombreSesion;
                header("Location:../../front-end/index.php");
            }else{
                header("Location:../../front-end/subirPublicacion.php?typeError=5");
                // echo "mas de 3MB";
            }
        }else{
            header("Location:../../front-end/subirPublicacion.php?typeError=6");
            // echo "Falla al subir imagen";
        }
    }




?>