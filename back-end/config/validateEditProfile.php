<?php
    require("protection.php");
    include("Crud.php");
    $crud= new Crud();

    $nombreSesion = $_SESSION["userName"];
    $saveUserSession = $nombreSesion;

    // PASAR SRC DE IMGPROFILE Y IMGBANNER


    if (isset($_POST["userNameEdit1"], $_POST["userNameEdit1"], $_POST["mailEdit1"], $_POST["mailEdit1"], $_POST["passwordEdit1"], $_POST["passwordEdit1"], $_FILES["bannerPhotoo"]["name"], $_FILES["fotoPerfill"]["name"])){
        
        // Recoppila todos loos datos del formulario
        $username1 = $_POST["userNameEdit1"];
        $confUsername = $_POST["userNameEdit2"];
        $mail1 = $_POST["mailEdit1"];
        $confMail = $_POST["mailEdit2"];
        $passwd1 = $_POST["passwordEdit1"];
        $confPasswd = $_POST["passwordEdit2"];
        $bannerPhoto = $_FILES["bannerPhotoo"]["name"]; // "" --> Salen vacios
        $perfilPhoto = $_FILES["fotoPerfill"]["name"]; // "" --> Salen vacios

        // Datos del usuario
        $dataUser=$crud->mostrarDatoFiltrado("usuarios", ['userName' => $saveUserSession]);
        foreach($dataUser as $key){
            $userName = $key["userName"];
            $userMail = $key["mail"];
            $userPasswd = $key["password"];
            $imgBanner = $key["imgBanner"];
            $imgProfile = $key["imgProfile"];
        }



        if (($_FILES["fotoPerfill"]["size"] < 30000000) && ($_FILES["bannerPhotoo"]["size"] < 30000000)) {
            // Comprueva si mail y conf mail son iguales, ...
            $nameProfilePhoto= time() . "_" . $_FILES["fotoPerfill"]["name"];
            $nameBannerPhoto= time() . "_" . $_FILES["bannerPhotoo"]["name"];
            $rutaProfilePhoto= "../back-end/image/profile/" . $nameProfilePhoto;
            $rutaBannerPhoto= "../back-end/image/banner/" . $nameBannerPhoto;

            // Mueve la imagen a la carpeta indeicada
            $imagenPhooto= "../image/profile/" . $nameProfilePhoto;
            $imagenBanner= "../image/banner/" . $nameBannerPhoto;
            $resultado1 = move_uploaded_file($_FILES["fotoPerfill"]["tmp_name"], $imagenPhooto);
            $resultado2 = move_uploaded_file($_FILES["bannerPhotoo"]["tmp_name"], $imagenBanner);

            
            // No me lanza el error
            if ($resultado1 == false || $resultado2 == false){
                if (($username1 == $confUsername) && ($username1 != "" && $confUsername != "")){
                    $confUsername = $username1;
                    if (($mail1 == $confMail) && ($mail1 != "" && $confMail != "")){
                        $confMail = $mail1;
                        if (($passwd1 == $confPasswd) && ($passwd1 != "" && $confPasswd != "" )){
                            $confPasswd = $passwd1;
                            if ($_FILES["fotoPerfill"]["name"] == ""){
                                $rutaProfilePhoto = $imgProfile;
                            }
                            if($_FILES["bannerPhotoo"]["name"] == ""){
                                $rutaBannerPhoto = $imgBanner;
                            }
                            if ($saveUserSession != $confUsername){
                                // Cambiar nombre se usuario a (usuarios) y el usuario de las publicaciones
                    
                                // Actualiza los datos del usuario por los nuevos
                                $coleccion = "usuarios";
                                $queActualiza = ["userName" => $nombreSesion];
                                $loQueActualiza = ['$set' => ["userName" => $confUsername, "mail" => $confMail, "password" => $confPasswd, "imgProfile" => $rutaProfilePhoto, "imgBanner" => $rutaBannerPhoto]];
                                $result = $crud->updatearDato($coleccion, $queActualiza, $loQueActualiza);
                    
                                // Actualiza las publicaaciones existentes con el usuario anterior por el nuevo
                                $coleccion = "publicaciones";
                                $queActualiza = ["userName" => $saveUserSession];
                                $loQueActualiza = ['$set' =>["userName" => $confUsername]];
                                $result = $crud->updatearDato($coleccion, $queActualiza, $loQueActualiza);
                                header("Location: ../../front-end/login.php");
                                echo "actualizado CON username<br>";
                    
                            }else{
                                // Actualiza los datos del usuario por los nuevos
                                $coleccion = "usuarios";
                                $queActualiza = ["userName" => $nombreSesion];
                                $loQueActualiza = ['$set' => ["mail" => $confMail, "password" => $confPasswd, "imgProfile" => $rutaProfilePhoto, "imgBanner" => $rutaBannerPhoto]];
                                $result = $crud->updatearDato($coleccion, $queActualiza, $loQueActualiza);
                                header("Location: ../../front-end/login.php");
                                echo "actualizado SIN username<br";
                            }
                        }else{
                            echo "ERROR (13): Los passwords no coinciden / Deven de estar llenos<br>";
                            header("Location: ../../front-end/perfilEdit.php?typeError=13"); 
                        }
                    }else{
                        echo "ERROR (12): El mail no cincide<br>";
                        // Error: mail no iguales
                        header("Location: ../../front-end/perfilEdit.php?typeError=12");
                    }
                }else{
                    echo "ERROR (11): El userName no coincide<br>";
                    // Error: usuarios no iguales
                    header("Location: ../../front-end/perfilEdit.php?typeError=11");
                }
            }else{
                echo "ERROR (5): No sube imagenes<br>";
                header("Location: ../../front-end/perfilEdit.php?typeError=5");
            }
        }else{
            echo "ERROR (6): El tamaño superior a 3MB<br";
            header("Location: ../../front-end/perfilEdit.php?typeError=6");
        }
    }
?>




<!-- // Comprueva si el nombre de usuario ya existe o si el correo ya existe en la base de datos
        
        // $datosGuardados = $crud ->mostrarDato("usuarios");
        // foreach ($datosGuardados as $key) {
        //     // echo $key["userName"] . "<br>";
        //     if ($key["mail"] == $confMail){
        //         // Mail ya existe
                // header("Location:../../front-end/perfilEdit.php?typeError=2");
        //     }else if ($key["userName"] == $confUsername){
        //         // Nombre de usuario ya existe
                // header("Location:../../front-end/perfilEdit.php?typeError=3");
        //     }
        // } -->