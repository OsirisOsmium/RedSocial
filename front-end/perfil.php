<?php
    require("../back-end/config/protection.php");
    include ("../back-end/config/Crud.php");
    require "../../../MongoDB/vendor/autoload.php";
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DomHome-Profile</title>
    <link rel="stylesheet" href="estilos/style.css">
    <script src="https://kit.fontawesome.com/e2a9f0955b.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
        $nombreUsuario = isset($_GET['nameUser']) ? $_GET['nameUser'] : $_SESSION["userName"]; // Si no esta presente el nameUser pone null
        $esDeSession= false;
        $crud = new Crud();
        
        // Extraccion de contenido de las colecciones ('usuarios', 'publicaciones')
        $dataUser=$crud->mostrarDatoFiltrado("usuarios", ['userName' => $nombreUsuario]);
        $dataUser2=$crud->mostrarDatoFiltrado("usuarios", ['userName' => $_SESSION["userName"]]);

        $publicacionesUser=$crud->mostrarDatoFiltrado("publicaciones", ['userName' => $nombreUsuario]);
        $publicacionesUser2=$crud->mostrarDatoFiltrado("publicaciones", ['userName' => $nombreUsuario]);
        
        // Contador de publicaciones
        $contadorPublicacionoes = 0;
        foreach($publicacionesUser2 as $key){
            $contadorPublicacionoes++;
        }

        // Comprueva que es de la sessino, si lo es no muestra el contenido de (SEGUIR, DEJAR DE SEGUIR)
        // de lo contrario lo va a mostrar
        if ($nombreUsuario == $_SESSION["userName"]){
            $esDeSession=true;
        }

        //comprueva que ya sigue a esta cuenta
        $yaSigue=false;
        foreach ($dataUser2 as $key){
            foreach ($key["seguidos"] as $key2){
                if ($key2 == $nombreUsuario){
                    $yaSigue=true;
                    // echo "ENCONTRADO";
                    break;
                }
            }
        }

        // echo "noo VA";
        
        // Rocoje los datos del usuario y . guarda en variables
        foreach($dataUser as $key){
            $userName = $key["userName"];
            $imgBanner = $key["imgBanner"];
            $imgProfile = $key["imgProfile"];
            $seguidores = $key["seguidores"];
            $seguidos = $key["seguidos"];
        }
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
                <a href="subirPublicacion.php" type="button" name="" id="" class="subirContenido" value="Subir contenido">SubirContenido</a>
                <?php
                    $headerButtons = "";
                        if ($esDeSession==true){
                            $headerButtons .= '<a href="perfilEdit.php">';
                                $headerButtons .= '<div>Edit Profile</div>';
                            $headerButtons .= '</a>';
                        }
                    echo $headerButtons;
                ?>
                <a href="../back-end/config/logout.php">
                    <div>Log out</div>
                </a>
            </div>
        </nav>


        <section id="containerProfileGen">
            <div class="containerProfile">
                <div class="espacioBanner">
                    <?php echo '<img src="' . $imgBanner . '" alt="" class="banner" >';?>
                </div>
                <div class="containerInfoUser">
                    <div class="informationProfile">
                        <?php echo'<img src="' . $imgProfile .'" alt="" class="profilePhoto">';?>
                        <div class="userName">
                            <?php
                                echo "<h2>" . $userName . "</h2>";
                            ?>
                        </div>
                        <div class="personalInfrmation">
                            <div class="opcionesSeguir">
                                <?php
                                    if ($esDeSession==false){
                                        if ($yaSigue){
                                            echo '<input type="button" name="dejarSeguir" id="dejarSeguirUser" value="Dejar de Seguir" onclick = "testSeguir();">';
                                        }else{
                                            echo '<input type="button" name="seguir" id="seguirUser" value="Seguir" onclick = "testSeguir();">';
                                        }
                                    }
                                ?>
                                <!-- <input type="button" name="actNotificacion" id="actNotificacion" value="Activar Notificaciones">
                                <input type="button" name="desActNotificacion" id="desNotificacion" value="Desactivar Notificaciones"> -->

                            </div>
                            <div class="cifrasCuentas">
                                <div class="cifrasCuenta">
                                    <p id="contPublicaciones" class="contNumCuenta"><?php echo $contadorPublicacionoes;?></p>
                                    <p class="txtCuenta">Publicaciones</p>
                                </div>
                                <div class="cifrasCuenta">
                                    <p id="contSeguidores" class="contNumCuenta"><?php echo count($seguidores);?></p>
                                    <p class="txtCuenta">Seguidores</p>
                                </div>
                                <div class="cifrasCuenta">
                                    <p id="contSiguiendo" class="contNumCuenta"><?php echo count($seguidos);?></p>
                                    <p class="txtCuenta">Siguiendo</p>
                                </div>
                            </div>
                            <div class="textoUser">
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="seccionContenido">
            <div class="postsContainerProfile">
            <?php
                // echo "dentro";
                    $publicacion="";
                    foreach ($publicacionesUser as $key){
                        $imagenPerfil = $crud->getImageProfile($key["userName"]);

                        $publicacion .= "<div class='postContainer'>";

                            $publicacion .= "<div class='headerPost'>";
                                $publicacion .= "<a href='perfil.php?nameUser=" . $key["userName"] . "' class='infoUserPost'>";
                                    $publicacion .= "<img src='" . $imagenPerfil . "' alt='' class='imagenPerfil' id='profileImgId'>";
                                    $publicacion .= "<div class='infPost'>";
                                        $publicacion .= "<p id='userNameId'>" . $key["userName"] . "</p>";
                                        $publicacion .="<p id='timeId'>" . $key["dataPublication"] . "</p>";
                                    $publicacion .= "</div>";
                                $publicacion .= "</a>";
                            $publicacion .= "</div>";
                            $publicacion .= "<div class='textPostTitle' id='txtId'>";
                                $publicacion .= "<p>" . $key["titulo"] . "</p>";
                            $publicacion .= "</div>";
                            $publicacion .= "<div class='textPost' id='txtId'>";
                                $publicacion .= "<p>" . $key["descripcion"] . "</p>";
                            $publicacion .= "</div>";

                            $publicacion .= "<div class='containerImgPost'>";
                                $publicacion .= "<img src='". $key["imgPublication"] . "' alt='' class='imagenPost' id='imagenPostId'>";
                            $publicacion .= "</div>";

                            $publicacion .= "<div class='estadosPost'>";
                                $publicacion .= "<a href='../back-end/config/validateLike.php?id_publication=" . $key["_id"]. "' class='estadoPost' id='btnLike'>";
                                    // Comprueva si el usuario de la sesion existe en el array likes de la publicacion
                                    // SI esta like relleno
                                    // NO esta like vacio
                                    $existe = $crud->comprovarExiste($key["_id"], $_SESSION["userName"]);
                                    if ($existe){
                                        $publicacion .= "<i class='fa-solid fa-heart'></i>";
                                    }else{
                                        $publicacion .= "<i class='fa-regular fa-heart'></i>";
                                    }
                                    $publicacion .= "<p id='contLikes'>" . count($key["likes"]) . "</p>";
                                $publicacion .= "</a>";
                                $publicacion .= "<button class='estadoPost' id='btnComments'>";
                                    $publicacion .= "<i class='fa-regular fa-comment'></i>";
                                    $publicacion .= "<p id='contComentarios'>" . count($key["comments"]) . "</p>";
                                $publicacion .= "</button>";
                                if ($esDeSession==true){
                                    $publicacion .= "<a href='modificarPublicacion.php?publicationId=" . $key["_id"] . "' class='modPublication' id='modifyPublication'>";
                                        $publicacion .= "<i class='fa-solid fa-gears'></i>";
                                    $publicacion .= "</a>";
                                }
                            $publicacion .= "</div>";
                            
                        $publicacion .= "</div>";
                    }
                    echo $publicacion;
                    // echo $esDeSession;
                ?>
            </div>
        </section>
        <footer id="piePagina">
            <div></div>
        </footer>
    </header>
    <script>
        function testSeguir(){
            alert("Hoola mundo");
            // document.getElementsByClassName("txtCuenta").textContent = "hola mundo";
        }
            

    </script>
</body>

</html>