<?php
    require("../back-end/config/protection.php");
    include("../back-end/config/Crud.php");
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="estilos/style.css">
        <script src="https://kit.fontawesome.com/e2a9f0955b.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            $crud=new Crud;
            $nombreSesion = $_SESSION['userName'];

            $filtrado = ['userName' => $nombreSesion];
            $allData = $crud->mostrarDatoFiltrado("usuarios", $filtrado);
        ?>

        <header id="mainGeneralPerfil">
            <nav id="navegadorSuperior">
                <div class="logoView">
                    <a href="index.php">
                        <img src="imagenes/logo.webp" alt="" class="imagenLogo">
                    </a>
                    <input type="search" name="" id="" class="inputBuscar"
                        placeholder="Buscar publicaciones, usuarios y mas">
                </div>
                <div class="buttonsUser">
                    <input type="button" name="" id="" class="subirContenido" value="Subir contenido">
                    <a href="perfil.php">
                        <div>Profile</div>
                    </a>
                    <a href="../back-end/config/logout.php">
                        <div>Log out</div>
                    </a>
                </div>
            </nav>


            <section id="containerProfileGen">
                <?php
                    $typeError = 0;
                    $typeError = $_GET["typeError"];

                

                    $userData="";

                    foreach($allData as $key){

                        $userData .= '<div class="containerProfile" id="containerProfileEdit">';
                            $userData .= '<form class="containerInfoUser" id="containerInfoUserEdit" method="post" action="../back-end/config/validateEditProfile.php" enctype="multipart/form-data">';
                            $userData .= '<input type="file" name="bannerPhotoo" id="bannerPhoto" hidden>';
                                $userData .= '<label class="contenedorBanner" for="bannerPhoto">';
                                    $userData .= '<img src="' . $key["imgBanner"] . '" alt="" class="banner" id="bannerEdit">';
                                    $userData .= '<img src="' . $key["imgBanner"] . '" alt="" class="banner" id="bannerEditSave" hidden>';
                                    $userData .= '<i class="fa-solid fa-gears" id="gearBanner"></i>';
                                $userData .= '</label>';
                                $userData .= '<div class="informationProfile">';
                                    $userData .= '<input type="file" name="fotoPerfill" id="fotoPerfil" hidden>';
                                    $userData .= '<label class="contenedorPerfil" for="fotoPerfil">';
                                        $userData .= '<img src="' . $key["imgProfile"] . '" alt="" class="profilePhoto" id="profilePhtoEdit">';
                                        $userData .= '<img src="' . $key["imgProfile"] . '" alt="" class="profilePhoto" id="profilePhtoEditSave" hidden>';
                                        $userData .= '<i class="fa-solid fa-gears" id="gearEditProfile"></i>';
                                    $userData .= '</label>';
                                    $userData .= '<div for="" class="userName">';
                                        $userData .= '<h2 id="userIdEdit1">' . $key["userName"] . '</h2>';
                                    $userData .= '</div>';
                                $userData .= '</div>';
                                $userData .= "<br>";
                                if ($typeError == 11){
                                    $userData .= "ERROR: Los userName deven de ser iguales";
                                }else if ($typeError == 12){
                                    $userData .= "ERROR: Los mail deven de ser iguales";
                                }else if ($typeError == 13){
                                    $userData .= "ERROR: Los passwords deve de ser iguales";
                                }else if($typeError == 14){
                                    $dataUser .= "ERROR: Los campos password estan vacios";
                                }
                                $userData .= '<div id="personalInfoEdit">';
                                    $userData .= '<div id="edirUsername">';
                                        $userData .= '<label for="">Nombre de usuario: </label>';
                                        $userData .= '<input type="text" name="userNameEdit1" id="usernameEdit" value="' . $key["userName"] . '">';
                                    $userData .= '</div>';
                                    $userData .= '<div id="editName">';
                                        $userData .= '<label for="">Nombre: </label>';
                                        $userData .= '<input type="text" name="userNameEdit2" id="nameEdit" value="' . $key["userName"] . '">';
                                    $userData .= '</div>';
                                    $userData .= "<br>";
                                    $userData .= '<div id="editMail1">';
                                        $userData .= '<label for="">Mail: </label>';
                                        $userData .= '<input type="text" name="mailEdit1" id="mailEdit1" value="' . $key["mail"] . '">';
                                    $userData .= '</div>';
                                    $userData .= '<div id="editMail2">';
                                        $userData .= '<label for="">Confirma mail: </label>';
                                            $userData .= '<input type="text" name="mailEdit2" id="mailEdit2" value="' . $key["mail"] . '">';
                                    $userData .= '</div>';
                                    $userData .= "<br>";
                                    $userData .= '<div id="editPassword1">';
                                        $userData .= '<label for="">Contraseña</label>';
                                        $userData .= '<input type="text" name="passwordEdit1" id="passwordEdit1">';
                                    $userData .= '</div>';
                                    $userData .= '<div id="editPassword2">';
                                        $userData .= '<label for="">Confirma contraseña:</label>';
                                        $userData .= '<input type="text" name="passwordEdit2" id="passwordEdit2">';
                                    $userData .= '</div>';
                                    $userData .= "<br>";
                                $userData .= '</div>';
                                $userData .= '<input type="submit"  id="saveChanges" value="Guardar Cambios">';
                            $userData .= '</form>';
                            $userData .= "<br>";
                            
                            if ($typeError ==2){
                                $userData .= "<p>El mail ya existe</p>";
                            }else if ($typeError == 3){
                                $userData .= "<p>El nombre de usuario ya existe</p>";
                            }else if ($typeError == 5){
                                $userData .= "<p>La imagen no se ha subido</p>";
                            }else if ($typeError == 6){
                                $userData .= "<p>El tamaño es superior a 3MB</p>";
                            }
                        $userData .= '</div>';
                    }
                    echo $userData;

                    
                ?>
            </section>
            <footer id="piePagina">
                <div></div>
            </footer>
        </header>
        <script src="../back-end/config/cargarImageProfile.js"></script>
    </body>
</html>