<?php

   class ProveedorDB
   {

        /**
         * Registra un proveedor en la base de datos.
         *
         * @param Proveedor $proveedor El proveedor a registrar.
         * @return bool Retorna true si el proveedor se registró correctamente, de lo contrario retorna false.
         */

        public static function insertProveedor(Proveedor $proveedor) : bool{

            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $conexion = Conexion::conectarDB();

            try{

                $escorrecto = false;

                $correo = $proveedor->getCorreo();
                $contrasenia = $proveedor->getContrasenia();
                $nombre = $proveedor->getNombre();
                $apellidos = $proveedor->getApellidos();
                


                $sql = "INSERT INTO usuarios (Correo, Contrasenia, Nombre, Apellidos) VALUES (:correo, :contrasenia, :nombre, :apellidos)";
                $sentencia = $conexion->prepare($sql);
                $escorrecto = $sentencia->execute([
                    "correo" => $correo,
                    "contrasenia" => password_hash($contrasenia, PASSWORD_DEFAULT),
                    "nombre" => $nombre,
                    "apellidos" => $apellidos
                ]);

                return $escorrecto;

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Función para autenticar un proveedor en el sistema.
         *
         * @param string $email El correo electrónico del proveedor.
         * @param string $password La contraseña del proveedor.
         * @return bool Retorna true si la autenticación es exitosa, de lo contrario retorna false.
         */
        public static function searchProveedor(string $email, string $password) : Proveedor{

            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $conexion = Conexion::conectarDB();
            $proveedor = new Proveedor();

            try{

                $sql = "SELECT * FROM usuarios WHERE Correo = :Correo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute(["Correo" => $email]);

                $usuario = $sentencia->fetch();

                if($usuario && password_verify($password, $usuario['Contrasenia'])){
              
                    $proveedor->setCodigo($usuario['Codigo']);
                    $proveedor->setCorreo($usuario['Correo']);
                    $proveedor->setContrasenia($usuario['Contrasenia']);
                    $proveedor->setNombre($usuario['Nombre']);
                    $proveedor->setApellidos($usuario['Apellidos']);
                    $proveedor->setProductos(null);
                    
                }

                return $proveedor;

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Devuelve los productos de un proveedor dado su código.
         *
         * @param string $codigo El código del proveedor.
         * @return Proveedor El proveedor con sus productos.
         */
        public static function getProveedorCompleto(String $codigo) : Proveedor{

            // llamar al productos db y devolver los productos de ese proveedor
            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $conexion = Conexion::conectarDB();
            
            $productos = [];

            try {

                $proveedor = self::getProveedor($codigo);
                $productos = ProductosDB::searchByProveedor($proveedor);

                $proveedor->setProductos($productos);

                return $proveedor;


            } catch (\Throwable $th) {
                echo "Error: " . $e->getMessage();
            }

        }

        /**
         * Devuelve los datos de un proveedor dado su código.
         *
         * @param string $codigo El código del proveedor.
         * @return Proveedor El objeto Proveedor con los datos del proveedor.
         */
        public static function getProveedor(String $codigo) : Proveedor{

            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $conexion = Conexion::conectarDB();

            try{

                $sql = "SELECT * FROM proveedores WHERE Codigo = :Codigo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute(["Codigo" => $codigo]);

                $proveedor = $sentencia->fetch(PDO::FETCH_CLASS, "Proveedor");
                
                // Montar Objeto Proveedor

                $proveedor->setProductos(null);

                return $proveedor;

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Actualiza un proveedor en la base de datos.
         *
         * @param Proveedor $proveedor El proveedor a actualizar.
         * @return bool Devuelve true si la actualización fue exitosa, de lo contrario devuelve false.
         */
        
        public static function update(Proveedor $proveedor) : bool{

            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $conexion = Conexion::conectarDB();

            try{

                $escorrecto = false;

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