<?php
    require("protection.php");
    include ("Crud.php");

    $crud=new Crud();
    $id_publication = $_GET["idPublication"];
    $nameFile = $_GET["nameFile"];
    $titlePub = $_POST["titlePub"];
    $descriptionPub = $_POST["descriptionPub"];
    $queBusca =["_id" => new MongoDB\BSON\ObjectID($id_publication)];


    $comprueva_eliminar = $_GET["eliminar"];
        if ($comprueva_eliminar == 1){
            $crud->eliminarDato("publicaciones", $queBusca);
            header("Location: ../../front-end/perfil.php");
        }else{
            if (isset($_POST["titlePub"], $_POST["descriptionPub"], $_FILES["filePub"]["name"])){
                if ($_FILES["filePub"]["name"]==""){
                    $datosAActualizar = ['$set' => ["titulo" => $titlePub, "descripcion" => $descriptionPub, "imgPublication" => $nameFile, "timeAded" => time()]];
                    try{
                        $result = $crud->updatearDato("publicaciones", $queBusca, $datosAActualizar);
    
                        if ($result->getModifiedCount() == 0) {
                            echo "No se actualizó ningún documento.";
                        } else {
                            echo "Documento actualizado con éxito. cargando imagen desde url<br>";
                            echo $nameFile;
                            
                            header("Location: ../../front-end/perfil.php");
                        }
                    }catch(Exception $e){
                        echo $e;
                    }
                }else{
                    $nameImage= time() . "_" . $_FILES["filePub"]["name"];
                    $ruta = "../image/publications/" . $nameImage;
                    if (($_FILES["filePub"]["size"] < 30000000)) {

                        $resultado = move_uploaded_file($_FILES["filePub"]["tmp_name"], $ruta);
                        $noombreImagen= "../back-end/image/publications/" . $nameImage;
                        if ($resultado == true){
                            $datosAActualizar = ['$set' => ["titulo" => $titlePub, "descripcion" => $descriptionPub, "imgPublication" => $noombreImagen, "timeAded" => time()]];
                            try{
                                $result = $crud->updatearDato("publicaciones", $queBusca, $datosAActualizar);

                                if ($result->getModifiedCount() == 0) {
                                    // No funcionoa el update
                                    echo "No se actualizó ningún documento.";
                                } else {
                                    // Funciona el update
                                    echo "Documento actualizado con éxito. Cargando imagen desde file<br>";
                                    echo $_FILES["filePub"]["name"];
                                    header("Location: ../../front-end/perfil.php");
                                }
                            }catch(Exception $e){
                                echo $e;
                            }
                        }else{
                            // Imagen no subida
                            header("Location: ../../front-end/modificarPublicacion.php?typeError=5");
                            echo $_FILES["filePub"]["name"];
                        }
                    }else{
                        // Imagen superior a 3MB
                        header("Location: ../../front-end/modificarPublicacion.php?typeError=6");
                    }
                }
            }else{
                echo ("los datos no estan completados");
            }
        }
?>