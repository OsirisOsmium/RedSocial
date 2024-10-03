<?php
    require ("../../../MongoDB/vendor/autoload.php");
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
    <title>DomHome-ModifyPublication</title>
    <link rel="stylesheet" href="estilos/style.css">
    <script src="https://kit.fontawesome.com/e2a9f0955b.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $id_publicacion = $_GET["publicationId"];
        $nombreSesion = $_SESSION['userName'];
        $fullPublications = $crud->mostrarDato("publicaciones");
        $queBusca = ["_id" => new MongoDB\BSON\ObjectID($id_publicacion)];

        $fullPublications = $crud->mostrarDatoFiltrado("publicaciones", $queBusca);

    ?>

    <header id="mainGeneral">
        <nav id="navegadorSuperior">
            <div class="logoView">
                <a href="index.php">
                    <img src="imagenes/logo.webp" alt="" class="imagenLogo">
                </a>
                
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
        <!-- <nav id="navegadorLateralR">
            <div id="navLateralesR">
                <div class="containerPerfiles">
                    <h2>SEGUIDORES</h2>
                    <div class="perfiles">
                        <a href="" class="perfil">
                            <img src="imagenes/profile.webp" alt="">
                            <p>ShaneCreates</p>
                        </a>
                        <a href="" class="perfil">
                            <img src="imagenes/profile.webp" alt="">
                            <p>eddie_dsuza</p>
                        </a>
                        <a href="" class="perfil">
                            <img src="imagenes/profile.webp" alt="">
                            <p>domHome</p>
                        </a>
                        <a  href="perfil.php" class="perfil">
                            <img src="imagenes/profile.webp" alt="">
                            <p>OsirisOsmium</p>
                        </a>
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
        </nav> -->
        <secction id ="seccionContenido">
            
        <div class="postsContainer">
                <?php
                    $publicacion="";

                    foreach ($fullPublications as $key){
                        //crear un form y añadir los datos como value
                        $imagenPerfil = $crud->getImageProfile($key["userName"]);

                        $publicacion .= "<form method = 'post' action = '../back-end/config/validateModification.php?idPublication=" . $key["_id"] . "&nameFile=" . $key["imgPublication"] . "' enctype='multipart/form-data'>";

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
                                    $publicacion .= "<input type='text' value='" . $key["titulo"] . "' name = 'titlePub' id='titlePub'>";
                                    // $publicacion .= "<p>" . $key["titulo"] . "</p>";
                                $publicacion .= "</div>";
                                $publicacion .= "<div class='textPost' id='txtId'>";
                                    $publicacion .= "<input type='text' value='" . $key["descripcion"] . "' name = 'descriptionPub' id = 'descriptionPub'>";
                                    // $publicacion .= "<p>" . $key["descripcion"] . "</p>";
                                $publicacion .= "</div>";

                                $publicacion .= "<div class='containerImgPost'>";
                                    $publicacion .= "<img src='". $key["imgPublication"] . "' alt='' class='imagenPost' id='imagenPostId'>";
                                    $publicacion .= "<img src='". $key["imgPublication"] . "' alt='' class='imagenPost' id='imagenPostIdSave' hidden>";
                                    // $publicacion .= "<input type='file'>";
                                $publicacion .= "</div>";
                                $publicacion .= "<div class='containerImgPost'>";

                                    // La idea es al subir una imagen se muestra un tipo de preview de la imagen que de vera, es decir se vera el comoo se vera la publicacion
                                    $publicacion .= "<input type='file' name='filePub' id='filePub'>";
                                    $publicacion .= "<label for='filePub' id='labelFilePub'>Cambiar Imagen</label>";
                                $publicacion .= "</div>";

                                $publicacion .= "<div class='estadosPost'>";
                                    $publicacion .= "<div href='../back-end/config/validateLike.php?id_publication=" . $key["_id"]. "' class='estadoPost' id='btnLike'>";
                                        $publicacion .= "<i class='fa-regular fa-heart'></i>";
                                        $publicacion .= "<p id='contLikes'>" . count($key["likes"]) . "</p>";
                                    $publicacion .= "</div>";
                                    
                                    $publicacion .= "<div class='estadoPost' id='btnComments'>";
                                        $publicacion .= "<i class='fa-regular fa-comment'></i>";
                                        $publicacion .= "<p id='contComentarios'>" . count($key["comments"]) . "</p>";
                                    $publicacion .= "</div>";
                                $publicacion .= "</div>";
                                
                            $publicacion .= "</div>";
                            $publicacion .= "<input type='submit' value = 'Actualizar datos'>";
                        $publicacion .= "<form>";
                    }
                    echo $publicacion;
                    echo "<a href='../back-end/config/validateModification.php?eliminar=1&idPublication=" . $id_publicacion . "' id='eliminarPub'>Elimninar publicacion</a>";
                    $typeError = 0;
                    $typeError = $_GET["typeError"];
                    if ($typeError == 5){
                        echo "<p>La imagen no se ha subido</p>";
                    }else if ($typeError == 6){
                        echo "<p>El tamaño es superior a 3MB</p>";
                    }
                ?>
            </div>
        </secction>
    </header>
    <script src = "../back-end/config/cargarImage.js"></script>
</body>
</html>