<?php
    include("ConexionDB.php");

    class Crud extends ConexionDB{
        /**
         * funcion de devuelve todo el contenido de una coleccion
         */
        public function mostrarDato($collection){
            try {
                $conexion = parent::conectarDB();
                $coleccion = $conexion->$collection;
                $datosGuardados = $coleccion->find();
            return $datosGuardados;
            } catch (\Throwable $th) {
                echo $th->getMessage();
            } 
        }
        /**
         * Funcion que devuelve todo el contenido de una cooleccion, filtrada por lo que le pasemos
         */
        public function mostrarDatoFiltrado($collection, $filtradoDeDato){
            try {
                $conexion = parent::conectarDB();
                $coleccion = $conexion->$collection;
                $datosFiltrado = $coleccion->find($filtradoDeDato);
                return $datosFiltrado;
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
        /**
         * Funcin para insertar datos en una coleccion determinada
         */
        public function insertarDato($collection, $datos){
            try {
                $conexion = parent::conectarDB();
                $coleccion = $conexion->$collection;
                $datosInsertados = $coleccion->insertOne($datos);
                return $datosInsertados;
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
        /**
         * Funcion para acutalizar datosde una coleccion determinada,
         * con un filtrado indicado y con el contenido que queremos que actualize
         */
        public function updatearDato($collection, $queActualiza, $loQueActualiza){
            try {
                $conexion = parent::conectarDB();
                $coleccion = $conexion->$collection;
                $datosActualizados = $coleccion->updateOne($queActualiza,$loQueActualiza);
                return $datosActualizados;
            }catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
        /**
         * Funcin para eliminar los datos de una coleccion con el filtrado indicado
         */
        public function eliminarDato($collection, $filtradoDel){
            try {
                $conexion = parent::conectarDB();
                $coleccion = $conexion->$collection;
                $datosEliminados = $coleccion->deleteOne($filtradoDel);
                return $datosEliminados;
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }


        //OTRAS OPERACIONES
        /**
         * Funcion para recuperar la imagen del usuario que le pasemos
         */
        public function getImageProfile($userName){
            try {
                $conexion = parent::conectarDB();
                $coleccion = $conexion->usuarios;
                $resultado = $coleccion->find(['userName' => $userName]);
                if ($resultado -> isDead()){
                    return "../../back-end/image/profile/profile.webp";
                }else{
                    foreach($resultado as $key){
                        return $key['imgProfile'];
                    }
                }

            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }


        /**
         * Funcion que comoprueva si un usuario existe en el array de likes de una publicacion
         */
        public function comprovarExiste($id_pub, $userName){
            $existe=false;
            try {
                $conexion =parent::conectarDB();
                $coleccion = $conexion ->publicaciones;
                $publicacion= $coleccion->find(["_id" => new MongoDB\BSON\ObjectID($id_pub)]);
                foreach ($publicacion as $key){
                    foreach ($key["likes"] as $key2){
                        if ($key2==$userName){
                            $existe=true;
                            break;
                        }
                    }
                }
                return $existe;
            }catch (Exception $th){
                echo $th->getMessage();
            }
        }
    }
?>