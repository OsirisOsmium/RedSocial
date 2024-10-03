<?php
    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <title>Red Social</title>
</head>
<body>
    <section id="registerPage">
        <div class="registerContainer">
            <div class="informationDecoration">
                <div class="informacionDescripcion">
                    <div class="informacionDescripcionTitulo">
                        <h2>Únete DomHome</h2>
                        <div class="barraInferior"></div>
                    </div>
                    <p>Crea y comparte videos o fotos en segundos. Únase o <a href="login.php">inicie sesión</a>.</p>
                </div>
                <img src="imagenes/homeautomation-01.webp" alt="" class="imagenRegister">
            </div>
            <form action="../back-end/config/validateRegister.php" method="post" enctype="multipart/form-data">
                <div class="mailForm">
                    <label for="">Correo electronico:</label>
                    <input type="email" name="registerMail" id="registerMail" placeholder="E-mail" required>
                </div>
                <div class="passwordForm">
                    <label for="">Contraseña:</label>
                    <input type="password" name="registerPasswd" id="registerPasswd" placeholder="Password" required>
                </div>
                <div class="usernameForm">
                    <label for="">Nombre de usuario</label>
                    <input type="text" name="registerUsername" id="registerUsername" placeholder="Username" required>
                </div>
                <div class="photoForm">
                    <label for="">Imagen de perfil de usuario</label>
                    <input type="file" name="rPP" id="registerPhotoProfile">
                </div>
                <div class="infoForm">
                    <input type="checkbox" name="registerPlitica" id="registerPolitica" required>
                    <label for="">Politica de privacidad</label>
                </div>
                <div class="buttonForm">
                    <input type="submit" value="Sign Up">
                </div>

                <?php
                    $typeError = 0;
                    $typeError = $_GET["typeError"];
                    if ($typeError ==2){
                        echo "<p>El mail ya existe</p>";
                    }else if ($typeError == 3){
                        echo "<p>El nombre de usuario ya existe</p>";
                    }else if ($typeError == 4){
                        echo "<p>Ha ocurido un error al recojer datos</p>";
                    }else if ($typeError == 5){
                        echo "<p>La imagen no se ha subido</p>";
                    }else if ($typeError == 6){
                        echo "<p>El tamaño es superior a 3MB</p>";
                    }
                ?>
        </div>
        </form>
    </section>
</body>
</html>