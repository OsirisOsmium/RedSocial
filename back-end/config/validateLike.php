<?php
    include ("protection.php");
    include ("Crud.php");

    use MongoDB\BSON\ObjectId;
use MongoDB\Operation\Count;

use function PHPSTORM_META\type;

    $crud= new Crud();

    $id_publication = $_GET["id_publication"];
    $nameSession = $_SESSION["userName"];
    $encontrado=false;
    $queBusca =["_id" => new MongoDB\BSON\ObjectID($id_publication)];


    $resultad = $crud->mostrarDatoFiltrado("publicaciones", $queBusca);

        echo "inicio fuera <br>";

    foreach($resultad as $key){
        // echo $key["userName"];
        // echo "<br>";
        if (count($key["likes"]) > 0){
            // echo "Mas de 0";
            foreach ($key["likes"] as $likes){
                if ($likes == $nameSession){

                    $encontrado=true;
                    break;
                }
            }
            if ($encontrado == true){
                // Retira el like de la publicacion
                $loQueActualiza = ['$pull' => ["likes" => $nameSession]];
                $resInsert = $crud->updatearDato("publicaciones",$queBusca, $loQueActualiza);
            }else{
                // Añade un like a la publicaccion
                $loQueActualiza = ['$push' => ["likes" => $nameSession]];
                $resInsert = $crud->updatearDato("publicaciones",$queBusca, $loQueActualiza);
            }
            // echo "busca el Like finalizado";
            header("Location:../../front-end/index.php");
        }else{
            // echo "Sin likes <br>";
            // Actualiza la publicacion
            $loQueActualiza = ['$push' => ["likes" => $nameSession]];
            $resInsert = $crud->updatearDato("publicaciones",$queBusca, $loQueActualiza);
            // echo "actualizado correctamente <br>";
            header("Location:../../front-end/index.php");
        }
    }
    // echo "<br>";
    // echo "final fuera";
?>