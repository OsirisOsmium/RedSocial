<?php
    //Dades d'usuari en un array per l'exemple. Normalment s'obtenen directament d'una Base de Dades.
    include 'Crud.php';

    if(isset($_POST['loginMail'], $_POST['loginPasswd'])){ //Comprovem que les dades rebudes per POST existeixen
        
        $crud = new Crud();
        // Comprovamos que el usuario existe en la db con el filtrado realizado
        $datosGuardados = $crud->mostrarDato("usuarios");

        $existenDatos = false;
        // Recorremos los datos mostrados por CRUD y comprovamos si el mail y el password coinciden con las de DB
        foreach ($datosGuardados as $key) {
            if (($key["mail"] == $_POST["loginMail"]) && ($key["password"]==$_POST["loginPasswd"])){
                $existenDatos = true;
                break;              
            }else{
                $existenDatos=false;
            }
        }
        if ($existenDatos){
            //Executem SESSIÓ per poder guardar variables de SESSIÓ
            session_start();
            // Creamos una sesion con el nombre de usuario del correo indicado
            $_SESSION['userName'] = $key['userName'];
            
            // Redirigimos al usuario hacia "index.php" con una sesion iniciada
            // La sesion es el del nombre de usuario para no exponer el correo electronico
            header("Location: ../../front-end/index.php");
        }else{
            // En caso de que el usuario introduciera un dato incorrecto de la cuenta redirigira al usuario hacia,
            // el "login.php" con un typeError 1 que mostrara su mensaje de error correspondiente
            header("Location: ../../front-end/login.php?typeError=1");
        }
    }
?>
