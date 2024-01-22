<?php

   class ProveedorDB
   {

        /**
         * Registra un proveedor en la base de datos.
         *
         * @param Proveedor $proveedor El proveedor a registrar.
         * @return bool Retorna true si el proveedor se registró correctamente, de lo contrario retorna false.
         */

        public static function insert(Proveedor $proveedor) : bool{

            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $escorrecto = false;

            try{

                $conexion = Conexion::conectarDB();
                $codigo = $proveedor->getCodigo();
                $correo = $proveedor->getCorreo();
                $contrasenia = $proveedor->getContrasenia();
                $nombre = $proveedor->getNombre();
                $apellidos = $proveedor->getApellidos();
                

                $sql = "INSERT INTO proveedor(Codigo, Correo, Contrasenia, Nombre, Apellidos) VALUES(:Codigo, :Correo, :Contrasenia, :Nombre, :Apellidos)";
                $sentencia = $conexion->prepare($sql);
                $escorrecto = $sentencia->execute([
                    "Codigo" => $codigo,
                    "Correo" => $correo,
                    "Contrasenia" => password_hash($contrasenia, PASSWORD_DEFAULT),
                    "Nombre" => $nombre,
                    "Apellidos" => $apellidos
                ]);
                

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }

            return $escorrecto;
        }

        /**
         * Función para autenticar un proveedor en el sistema.
         *
         * @param string $email El correo electrónico del proveedor.
         * @param string $password La contraseña del proveedor.
         * @return bool Retorna true si la autenticación es exitosa, de lo contrario retorna false.
         */
        public static function login(string $email, string $password) : Proveedor{

            try{
                include_once( __DIR__ . '/../Conexion/Conexion.php');
                $conexion = Conexion::conectarDB();
                $sql = "SELECT * FROM usuarios WHERE Correo = :Correo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute(["Correo" => $email]);

                $usuario = $sentencia->fetch();

                if($usuario && password_verify($password, $usuario['Contrasenia'])){
              
                    $proveedor = new Proveedor($usuario['Codigo'], $usuario['Correo'], $usuario['Contrasenia'], $usuario['Nombre'], $usuario['Apellidos']);
                    $proveedor = self::getFull($proveedor->getCodigo());

                }

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }

            return $proveedor;
        }

        /**
         * Devuelve los productos de un proveedor dado su código.
         *
         * @param string $codigo El código del proveedor.
         * @return Proveedor El proveedor con sus productos.
         */
        public static function getFull(String $codigo) : Proveedor{

            // llamar al productos db y devolver los productos de ese proveedor
            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $productos = [];

            try {

                $conexion = Conexion::conectarDB();
                $proveedor = self::getProveedor($codigo);
                $productos = ProductosDB::getProveedor($proveedor);
                $proveedor->setProductos($productos);

                


            } catch (\Throwable $th) {
                echo "Error: " . $th->getMessage();
            }

            return $proveedor;
        }

        /**
         * Devuelve los datos de un proveedor dado su código.
         *
         * @param string $codigo El código del proveedor.
         * @return Proveedor El objeto Proveedor con los datos del proveedor.
         */
        public static function getProveedor(String $codigo) : Proveedor{

            include_once( __DIR__ . '/../Conexion/Conexion.php');
            
            try{

                $conexion = Conexion::conectarDB();
                $sql = "SELECT * FROM proveedor WHERE Codigo = :Codigo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute(["Codigo" => $codigo]);

                $proveedor = $sentencia->fetch(PDO::FETCH_ASSOC);
                $proveedorObtenido = new Proveedor($proveedor['Codigo'], $proveedor['Correo'], $proveedor['Contrasenia'], $proveedor['Nombre'], $proveedor['Apellidos']);

                

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }

            return $proveedorObtenido;
        }

        /**
         * Actualiza un proveedor en la base de datos.
         *
         * @param Proveedor $proveedor El proveedor a actualizar.
         * @return bool Devuelve true si la actualización fue exitosa, de lo contrario devuelve false.
         */
        
        public static function update(Proveedor $proveedor) : bool{

            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $escorrecto = false;

            try{

                $conexion = Conexion::conectarDB();
                $codigo = $proveedor->getCodigo();
                $correo = $proveedor->getCorreo();
                $contrasenia = $proveedor->getContrasenia();
                $nombre = $proveedor->getNombre();
                $apellidos = $proveedor->getApellidos();

                $sql = "UPDATE usuarios SET Correo = :Correo, Contrasenia = :Contrasenia, Nombre = :Nombre, Apellidos = :Apellidos WHERE Codigo = :Codigo";
                $sentencia = $conexion->prepare($sql);
                $escorrecto = $sentencia->execute([
                    "Codigo" => $codigo,
                    "Correo" => $correo,
                    "Contrasenia" => password_hash($contrasenia, PASSWORD_DEFAULT),
                    "Nombre" => $nombre,
                    "Apellidos" => $apellidos
                ]);

                return $escorrecto;

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            
        }

   } 



?>