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
    <section id="loginPage">
        <div class="loginContainer">
            <div class="cavezeraLogIn">
                <h1>Log In</h1>
                <div class="barraInferior"></div>
            </div>
            <!-- El metodo redirije los datos de formulario hacia la autentificacion de sesion para verificar si el usuario existe dentro de la base de datos -->
            <form action="../back-end/config/session_authentication.php" method="post">
                <!-- clave de correo electronico -->
                <div class="mailUsernameForm">
                    <p>Correo electronico:</p>
                    <input type="text" name="loginMail" id="loginMail" required placeholder="E-mail">
                </div>
                <!-- Contraseña del usuario -->
                <div class="passwordForm">
                    <p>Contraseña:</p>
                    <input type="password" name="loginPasswd" id="loginPasswd" required placeholder="Password">
                </div>
                <!-- Boton para enviar formulario -->
                <div class="buttonForm">
                    <input type="submit" value="Sign Up">
                </div>
                <div class="infoLogin">
                    <?php
                        $typeError = 0;
                        $typeError = $_GET["typeError"];
                        if ($typeError==1){
                            echo "<p>El nombre de usuario o contraseña incorrecto</p>";
                        }
                    ?>
                </div>
            </form>
            <div class="additionalForm">
                <a href="">Forgot Password?</a>
                <a href="registre.php">Sign Up</a>
            </div>
        </div>
    </section>
</body>
</html>