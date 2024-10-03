
<html>
  <body style="text-align:center;">
    <h1>Exemple coockies</h1>

    <?php
      //Exemple CREAR una cookie
      if(isset($_GET["crearcookie"])){
        //Es crea una cookie anomenada "nomcookie" que caducarà en 10 segons
        // setcookie("nomcookie", "valor cookie", time() + (10));
        setcookie("nomcookie", "valor cookie", time() + (3600 * 2)); // En aquesta veiem que dura 3600 segons per 2, el que fan 2 hores que duraria la cookie.
        
        header('location:exemple_cookies.php');
      } 
      
      //Exemple COMPROVAR cookie
      if(isset($_COOKIE['nomcookie'])){
        echo "Missatge: El valor de la cookie és: ".$_COOKIE['nomcookie'];
      } else {
        echo "Missatge: No existeix cap cookie";
      }  

      //Exemple ELIMINAR cookie
      if(isset($_GET["eliminarcookie"])){
        setcookie("nomcookie", "", 0); //Eliminem la cookie creant-la de nou però amb una duració de 0 segons
        header('location:exemple_cookies.php');
      }

    ?>


    <br><br><a href="?crearcookie=1">Crear cookie</a><br><br>
    <a href="?eliminarcookie=1">Eliminar cookie</a>
</html>
    