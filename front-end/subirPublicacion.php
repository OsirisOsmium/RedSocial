<?php
    require ("../back-end/config/protection.php");
    include ("../back-end/config/Crud.php");
    $nombreSesion = $_SESSION['userName'];
    $crud=new Crud;
    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilos/style.css">
        <title>Dom Home - Subir Publicacion</title>
        <script src="https://kit.fontawesome.com/e2a9f0955b.js" crossorigin="anonymous"></script>
    </head>
    <body>
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

        <secction id ="seccionContenido">
            
            <div class="postsContainer">
                    <?php    
                        $imagenPerfil = $crud->getImageProfile($nombreSesion);
                    ?>
                        <form method = 'post' action="../back-end/config/validatePublication.php" enctype='multipart/form-data'>
    
                            <div class='postContainer'>
    
                                <div class='headerPost'>
                                    <div  class='infoUserPost'>
                                        <?php echo "<img src='" . $imagenPerfil . "' alt='' class='imagenPerfil' id='profileImgId'>";?>
                                        <div class='infPost'>
                                            <p><?php echo $nombreSesion;?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class='textPostTitle' id='txtId'>
                                    <label for="">Titlulo: </label>
                                    <input type='text'  name = 'pubTitle' id='titlePub'>
                                </div>
                                <div class='textPost' id='txtId'>
                                    <label for="">Descripcion: </label>
                                    <input type='text' name = 'pubDescription' id = 'descriptionPub'>
                                </div>
    
                                <div class='containerImgPost'>
                                    <img src='' alt='' class='imagenPost' id='imagenPostId'>
                                    <img src='../back-end/image/publications/FiaENz.png' alt='' class='imagenPost' id='imagenPostIdSave' hidden>
                                </div>
                                <div class='containerImgPost'>
    
                                    <input type='file' name='pubFile' id='filePub'>
                                    <label for='filePub' id='labelFilePub'>Cambiar Imagen</label>
                                </div>
    
                                <div class='estadosPost'>
                                    <div class='estadoPost' id='btnLike'>
                                        <i class='fa-regular fa-heart'></i>
                                        <p id='contLikes'>0</p>
                                    </div>
                                        
                                    <button class='estadoPost' id='btnComments'>
                                        <i class='fa-regular fa-comment'></i>
                                        <p id='contComentarios'>0</p>
                                    </button>
                                </div>
                                    
                            </div>
                            <input type='submit' value = 'Subir publicacion'>
                        <form>
                </div>
                <?php
                    $typeError = 0;
                    $typeError = $_GET["typeError"];
                    if ($typeError == 5){
                        echo "<p>La imagen no se ha subido</p>";
                    }else if ($typeError == 6){
                        echo "<p>El tamaño es superior a 3MB</p>";
                    }
                ?>
            </secction>
            <script src="../back-end/config/cargarImage.js"></script>
    </body>
</html>