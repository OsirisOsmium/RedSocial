
<?php
    require "../../../MongoDB/vendor/autoload.php";
    require ("../back-end/config/protection.php");
    include ("../back-end/config/Crud.php");
    $crud= new Crud();
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DomHome-Index</title>
    <link rel="stylesheet" href="estilos/style.css">
    <script src="https://kit.fontawesome.com/e2a9f0955b.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
        $nombreSesion = $_SESSION['userName'];
        $fullPublications = $crud->mostrarDato("publicaciones");


        $allSeguidos = $crud->mostrarDatoFiltrado("usuarios", ["userName" => $nombreSesion]);

    ?>

    <header id="mainGeneral">
        <nav id="navegadorSuperior">
            <div class="logoView">
                <a href="index.php">
                    <img src="imagenes/logo.webp" alt="" class="imagenLogo">
                </a>
                <form action="" method="post">
                    <input type="search" name="inputBuscar" id="inputBuscar" class="inputBuscar"
                    placeholder=":titulo publicacion, /usuario y mas">
                </form>
                <?php
                    // usurios ----> /
                    // titulo ----> :

                    $crud=new Crud;

                    if (isset($_POST["inputBuscar"])){
                        
                        $busqueda = $_POST["inputBuscar"];
                        $aBuscar = substr($busqueda, 1);

                        $palabra = substr($busqueda, 1);
                        // $aBuscar = "/" . $palabra . "/";

                        if ($busqueda[0] == "/"){
                            $coleccion = "publicaciones";
                            $filtrado = ['userName' => $aBuscar];
                            $fullPublications = $crud->mostrarDatoFiltrado($coleccion, $filtrado);
                        }else if ($busqueda[0] == ":"){
                            $coleccion = "publicaciones";
                            $filtrado = ['titulo' => $aBuscar];
                            $fullPublications = $crud->mostrarDatoFiltrado($coleccion, $filtrado);
                        }
                    }
                ?>
            </div>
            <div class="buttonsUser">
                <a href="subirPublicacion.php" class="subirContenido">SubirContenido</a>
                <a href="../back-end/config/logout.php" class="btnTop">
                    <div>Log out</div>
                </a>
                <a href="perfil.php" class="perfilUsuarioGeneral">
                    <?php
                        $imagenPerfil = $crud->getImageProfile($nombreSesion);
                        echo "<img src='" . $imagenPerfil . "' alt=''>";
                    ?>
                </a>
            </div>
        </nav>
        <nav id="navegadorLateralL">
            <div id="navLateralesL">
                <div>
                    <a href="index.php">
                        <i class="fa-solid fa-house"></i>
                        <p>Inicio</p>
                    </a>
                </div>
                <div>
                    <a href="">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <p>Navega</p>
                    </a>
                </div>
                <div>
                    <a href="">
                        <i class="fa-regular fa-bell"></i>
                        <p>Notificaciones</p>
                    </a>
    
                </div>
                <div>
                    <a href="">
                        <i class="fa-regular fa-message"></i>
                        <p>Mansajes</p>
                    </a>
                </div>
                <div>
                    <a href="">
                        <i class="fa-solid fa-gear"></i>
                        <p>Extra Options</p>
                    </a>
                </div>
            </div>
        </nav>
        <nav id="navegadorLateralR">
            <div id="navLateralesR">
                <div class="containerPerfiles">
                    <h2>SEGUIDOS</h2>
                    <div class="perfiles">
                        <?php
                            $seguidos="";
                            foreach ($allSeguidos as $key){
                                foreach ($key["seguidos"] as $key2){
                                    $userFollowPhoto = $crud ->getImageProfile($key2);
                                    $seguidos .= '<a href="perfil.php?nameUser=' . $key2 . '" class="perfil">';
                                        $seguidos .= '<img src="' . $userFollowPhoto .'" alt="">';
                                        $seguidos .= '<p>' . $key2 . '</p>';
                                    $seguidos .= '</a>';
                                }
                            }
                            echo $seguidos;
                        ?>
                    </div>
                </div>
                <div class="containerPerfiles">
                    <h2>COMUNIDADES</h2>
                    <div class="comunidades">
                        <li class="comunidad">
                            <img src="imagenes/comunidades/homebridge-color-round-stylized.webp" alt="">
                            <p>#Homebridge</p>
                        </li>
                        <li class="comunidad">
                            <img src="imagenes/comunidades/homeassittant.webp" alt="">
                            <p>#Home Assistant</p>
                        </li>
                        <li class="comunidad">
                            <img src="imagenes/comunidades/homekit.webp" alt="">
                            <p>#HomeKit</p>
                        </li>
                        <li class="comunidad">
                            <img src="imagenes/comunidades/googleHome.webp" alt="">
                            <p>#Google Home</p>
                        </li>
                        <li class="comunidad">
                            <img src="imagenes/comunidades/alexa.webp" alt="">
                            <p>#Alexa</p>
                        </li>
                    </div>
                </div>
            </div>
        </nav>
        <section id="seccionContenido">
            <div class="postsContainer">
                <?php
                    $publicacion="";

                    foreach ($fullPublications as $key){
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
                                    $existe = $crud->comprovarExiste($key["_id"], $nombreSesion);
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
                            $publicacion .= "</div>";
                            
                        $publicacion .= "</div>";
                    }
                    echo $publicacion;
                ?>
            </div>
        </section>
        <footer id="piePagina">
            <div></div>
        </footer>
    </header>
</body>

</html>