<?php
    include("Crud.php");
    if (isset($_POST['registerMail'], $_POST['registerPasswd'], $_POST['registerUsername'], $_FILES['rPP']["name"])){
        $crud = new Crud();

        $nombre = $_FILES["rPP"]["name"];
        $nameImage = time() . "_"  . $nombre;

        //$ruta = "../image/profile/" . $nameImage;
        $ruta = "../image/profile/" . $nameImage;
        if (($_FILES["rPP"]["size"] < 30000000)) {

            // No me sube la imagen a la carpeta
            $resultado = move_uploaded_file($_FILES["rPP"]["tmp_name"], $ruta);
            echo "Resultado: " . $resultado . "<br>";
            echo "Ruta: " . $ruta . "<br>";
            echo $nameImage . "<br>";
            if ($resultado == true){
                
                $arrayUsuario = array(
                    "mail" => $_POST["registerMail"],
                    "password" => $_POST["registerPasswd"],
                    "userName" => $_POST["registerUsername"],
                    "imgProfile" => "../back-end/image/profile/" . $nameImage,
                    "permisos" => 2,
                    "seguidores" => [],
                    "seguidos" => [],
                    "imgBanner" => "../back-end/image/banner/20052024-black.jpeg"
                );
                
                // . Comprueva que los datos inteoducidos (mail and userName) no existem en db
                $datosGuardados = $crud ->mostrarDato("usuarios");
                foreach ($datosGuardados as $doc) {
                    if ($doc["mail"] == $_POST["registerMail"]){
                        $datosNuevos=false;
                        header("Location:../../front-end/registre.php?typeError=2");
                    }else if ($doc["userName"] == $_POST["registerUsername"]){
                        $datosNuevos=false;
                        header("Location:../../front-end/registre.php?typeError=3");
                    }else{
                        $datosNuevos = true;
                    }
                }
                //Me lo registra igualmente     FIXED
                if ($datosNuevos==true){
                    $insertarDatos = $crud->insertarDato("usuarios", $arrayUsuario);
                    header("Location:../../front-end/login.php");
                }

            }else{
                header("Location:../../front-end/registre.php?typeError=5");
            }
        }else{
            header("Location:../../front-end/registre.php?typeError=6");
        }
    }else{
        header("Location:../../front-end/registre.php?typeError=4");
        echo "no entra";

    }
?>