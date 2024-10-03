<?php
    // require "C:/xampp/htdocs/MongoDB/vendor/autoload.php"; // include Composer goodies
    require "/Applications/XAMPP/xamppfiles/htdocs/MongoDB/vendor/autoload.php";
    class ConexionDB{
        public function conectarDB(){
            try{
                // Relizamos la conexion con mongoDb Compass
                $cliente = new MongoDB\Client("mongodb://127.0.0.1:27017");
                // Devolvemos la conexion con la base de datos seleccionada
                return $cliente->selectDatabase("domhome");
            }catch (\Throwable $th) {
                // En caso de error durante la conexion a mongoDB, salta el "try catch" y mostrara el registro de error
                echo $th->getMessage();
            }
        }
    }
?>