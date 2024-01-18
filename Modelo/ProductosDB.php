<?php

    class ProductosDB
    {
        /**
         * Inserta un producto en la base de datos.
         *
         * @param Producto $producto El objeto Producto a insertar.
         * @param Proveedor $proveedor El objeto Proveedor asociado al producto.
         * @return bool Devuelve true si el producto se insertó correctamente, false en caso contrario.
         */
        public static function insert(Producto $producto, Proveedor $proveedor) : bool{
            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $conexion = Conexion::conectarDB();
            $insertadoCorrectamente = false;

            try{
                
                $sql = "INSERT INTO productos (Nombre, Descripcion, Precio, Stock, CodigoProveedor) VALUES (:Nombre, :Descripcion, :Precio, :Stock, :CodigoProveedor)";
                $sentencia = $conexion->prepare($sql);
                $insertadoCorrectamente =  $sentencia->execute([
                    "Nombre" => $producto->getNombre(),
                    "Descripcion" => $producto->getDescripcion(),
                    "Precio" => $producto->getPrecio(),
                    "Stock" => $producto->getStock(),
                    "CodigoProveedor" => $proveedor->getCodigo()
                ]);

                return $insertadoCorrectamente; 

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
    
        }

        /**
         * Obtiene los productos que coinciden con una descripción y proveedor específicos.
         *
         * @param string $descripcion La descripción a buscar en los productos.
         * @param Proveedor $proveedor El proveedor de los productos.
         * @return array Los productos que coinciden con la descripción y proveedor especificados.
         */

        public static function searchByDescription(String $descripcion, Proveedor $proveedor) : Array{

            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $conexion = Conexion::conectarDB();
            $productos = [];

            try{
                $sql = "SELECT * FROM productos WHERE Descripcion LIKE :Descripcion AND CodigoProveedor = :CodigoProveedor";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute(["Descripcion" => "%" . $descripcion . "%", "CodigoProveedor" => $proveedor->getCodigo()]);
                $sentencia->setFetchMode(PDO::FETCH_CLASS, "Producto");

                $productos = $sentencia->fetchAll();

                return $productos;

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Obtiene los productos con un stock igual o inferior al valor especificado y pertenecientes a un proveedor dado.
         *
         * @param int $stock El valor máximo del stock de los productos a obtener.
         * @param Proveedor $proveedor El proveedor al que pertenecen los productos.
         * @return array Un array de objetos Producto que cumplen con los criterios de búsqueda.
         */

        public static function searchByStock(Int $stock, Proveedor $proveedor) : Array{
            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $conexion = Conexion::conectarDB();
            $productos = [];

            try{
                $sql = "SELECT * FROM productos WHERE Stock <= :Stock AND CodigoProveedor = :CodigoProveedor";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute(["Stock" => $stock, "CodigoProveedor" => $proveedor->getCodigo()]);
                $sentencia->setFetchMode(PDO::FETCH_CLASS, "Producto");

                $productos = $sentencia->fetchAll();

                return $productos;
                
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Obtiene los productos de un proveedor específico.
         *
         * @param Proveedor $proveedor El proveedor del cual se obtendrán los productos.
         * @return array Los productos del proveedor.
         */
        public static function searchByProveedor(Proveedor $proveedor) : Array{

            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $conexion = Conexion::conectarDB();
            $productos = [];
          // $codigoProveedor = $proveedor->getCodigo();

            try{
                $sql = "SELECT * FROM productos WHERE CodigoProveedor = :CodigoProveedor";
                $sentencia = $conexion->prepare($sql);
                $sentencia->setFetchMode(PDO::FETCH_CLASS, "Producto");
                $sentencia->execute(["CodigoProveedor" => $proveedor->getCodigo()]);

                $productos = $sentencia->fetchAll();
                // mONTAR ARRAY
                return $productos;

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Borra un producto de la base de datos.
         *
         * @param string $codigo El código del producto a borrar.
         * @param Proveedor $proveedor El proveedor del producto.
         * @return bool Devuelve true si el producto se borró correctamente, false en caso contrario.
         */

        public static function delete(Producto $producto) : bool{

            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $conexion = Conexion::conectarDB();
            $borradoCorrectamente = false;
            $codigo = $producto->getProveedor()->getCodigo();

            try{
                $sql = "DELETE FROM productos WHERE Codigo = :Codigo AND CodigoProveedor = :CodigoProveedor";
                $sentencia = $conexion->prepare($sql);
                $borradoCorrectamente = $sentencia->execute(["Codigo" => $codigo, "CodigoProveedor" => $proveedor->getCodigo()]);

                return $borradoCorrectamente;

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        /**
         * Actualiza los datos de un producto en la base de datos.
         *
         * @param Producto $producto El producto con los datos actualizados.
         * @param Proveedor $proveedor El proveedor del producto.
         * @return bool Devuelve true si el producto se actualizó correctamente, false en caso contrario.
         */

        public static function update(Producto $producto) : bool{

            include_once( __DIR__ . '/../Conexion/Conexion.php');
            $conexion = Conexion::conectarDB();
            $actualizadoCorrectamente = false;
            $codigo = $producto->getProveedor()->getCodigo();
            try{
                $sql = "UPDATE productos SET Nombre = :Nombre, Descripcion = :Descripcion, Precio = :Precio, Stock = :Stock WHERE Codigo = :Codigo AND CodigoProveedor = :CodigoProveedor";
                $sentencia = $conexion->prepare($sql);
                $actualizadoCorrectamente = $sentencia->execute([
                    "Nombre" => $producto->getNombre(),
                    "Descripcion" => $producto->getDescripcion(),
                    "Precio" => $producto->getPrecio(),
                    "Stock" => $producto->getStock(),
                    "Codigo" => $producto->getCodigo(),
                    "CodigoProveedor" => $proveedor->getCodigo()
                ]);

                return $actualizadoCorrectamente;

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

    }

?>