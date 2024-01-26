<?php


    include_once "../Modelo/Productos.php";
    include_once "../Modelo/Proveedor.php";
    include_once "../Modelo/ProductosDB.php";
    include_once "../Modelo/ProveedorDB.php";

    error_reporting(E_ALL); // Error/Exception engine, always use E_ALL
    ini_set('ignore_repeated_errors', TRUE); // always use TRUE
    ini_set('display_errors', FALSE); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment
    ini_set('log_errors', TRUE); // Error/Exception file logging engine.
    ini_set('error_log', '../Logs/log.txt'); // Logging file path

    /**
     * Carga los productos del proveedor actual y los muestra en una tabla.
     * 
     * @throws \Throwable Si ocurre un error al cargar los productos.
     */
    function cargarProductos(){
        try {
            include_once '../Modelo/Proveedor.php';
            include_once '../Modelo/ProveedorDB.php';
            // Recuperar de sesión
            session_start();
            $proveedor = $_SESSION['proveedor'];

            $productos = ProductosDB::getProveedor($proveedor);

            error_log("El codigo del proveedor es: " . $proveedor->getCodigo());
            // Productos obtenidos
            error_log("Productos obtenidos: " . count($productos));

            // Mostrar los productos en una tabla
            foreach($productos as $producto){
                echo "<tr>";
                echo "<td>" . $producto->getCodigo() . "</td>";
                echo "<td>" . $producto->getNombre() . "</td>";
                echo "<td>" . $producto->getDescripcion() . "</td>";
                echo "<td>" . $producto->getPrecio() . "</td>";
                echo "<td>" . $producto->getStock() . "</td>";
                echo "</tr>";
            }
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
            Error_log("Error en la linea " . $e->getLine() . " en el archivo " . $e->getFile() . " con el mensaje " . $e->getMessage());
        }
    }

    /**
     * Carga los productos en stock de un proveedor y los muestra en una tabla.
     * 
     * @throws \Throwable Si ocurre un error durante la ejecución.
     */
    function cargarProductosStock(){
        try {
            include_once '../Modelo/Proveedor.php';
            include_once '../Modelo/ProveedorDB.php';
            // Recuperar de sesión
            session_start();
            $proveedor = $_SESSION['proveedor'];

            $stock = $_POST["stock"];

            $productos = ProductosDB::getStock($stock, $proveedor);

            error_log("El codigo del proveedor es: " . $proveedor->getCodigo());
            
            // Productos obtenidos
            error_log("Productos obtenidos: " . count($productos));

            foreach($productos as $producto){
                echo "<tr>";
                echo "<td>" . $producto->getCodigo() . "</td>";
                echo "<td>" . $producto->getNombre() . "</td>";
                echo "<td>" . $producto->getDescripcion() . "</td>";
                echo "<td>" . $producto->getPrecio() . "</td>";
                echo "<td>" . $producto->getStock() . "</td>";
                echo "</tr>";
            }
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
            Error_log("Error en la linea " . $e->getLine() . " en el archivo " . $e->getFile() . " con el mensaje " . $e->getMessage());
        }
    }

    /**
     * Carga los productos según una descripción dada.
     * 
     * @throws Throwable Si ocurre algún error durante la ejecución.
     */
    function cargarProductosDescripcion(){
       try {
        include_once '../Modelo/Proveedor.php';
        include_once '../Modelo/ProveedorDB.php';
        // Recuperar de sesión
        session_start();
        $proveedor = $_SESSION['proveedor'];

        $descripcion = $_POST["descripcion"];

        $productos = ProductosDB::getDescription ($descripcion, $proveedor);

        error_log("El codigo del proveedor es: " . $proveedor->getCodigo());
        
        // Productos obtenidos
        error_log("Productos obtenidos: " . count($productos));

        foreach($productos as $producto){
            echo "<tr>";
            echo "<td>" . $producto->getCodigo() . "</td>";
            echo "<td>" . $producto->getNombre() . "</td>";
            echo "<td>" . $producto->getDescripcion() . "</td>";
            echo "<td>" . $producto->getPrecio() . "</td>";
            echo "<td>" . $producto->getStock() . "</td>";
            echo "</tr>";
        }
       } catch (\Throwable $e) {
        echo "Error: " . $e->getMessage();
        Error_log("Error en la linea " . $e->getLine() . " en el archivo " . $e->getFile() . " con el mensaje " . $e->getMessage());
       }

    }

    /**
     * Obtiene los productos por nombre del proveedor actual.
     *
     * @return array|null Los productos del proveedor actual o null si ocurre un error.
     */

    function obtenerProductosNombre(){
        try {
            include_once '../Modelo/Proveedor.php';
            include_once '../Modelo/ProveedorDB.php';
            // Recuperar de sesión
            session_start();
            $codigo = $_SESSION['proveedorCodigo'];
            $proveedor = ProveedorDB::getFull($codigo);
            $productos = $proveedor->getProductos();
    
            return $productos;
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
            Error_log("Error en la linea " . $e->getLine() . " en el archivo " . $e->getFile() . " con el mensaje " . $e->getMessage());
        }
    }

    /**
     * Modifica un producto en la base de datos.
     *
     * @throws \Throwable Si ocurre un error durante la modificación del producto.
     */
    function modificarProducto(){
        try {
            include_once '../Modelo/Proveedor.php';
            include_once '../Modelo/ProveedorDB.php';
            include_once '../Modelo/Productos.php';
            include_once '../Modelo/ProductosDB.php';

            $codigo = $_POST["codigo"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $stock = $_POST["stock"];

            // Falta el proveedor
            $proveedor = $_SESSION["proveedor"];
            $producto = new Producto($codigo, $nombre, $descripcion, $precio, $stock, $proveedor);

            $escorrecto = ProductosDB::update($producto, $proveedor);

            if($escorrecto){
                mostrarMensajeExito("Producto modificado correctamente");
                echo "<script>window.location.href='../Vista/formProductos.php';</script>";
            }else{
                mostrarMensajeError("Error al modificar el producto");
            }
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
            Error_log("Error en la linea " . $e->getLine() . " en el archivo " . $e->getFile() . " con el mensaje " . $e->getMessage()); 
        }
    }

    /**
     * Elimina un producto de la base de datos.
     * 
     * @throws \Throwable Si ocurre un error durante la eliminación del producto.
     */
    function eliminarProducto(){
        try {
            $proveedor = $_SESSION["proveedor"];
            $producto = $_SESSION["productoB"];
        
            $escorrecto = ProductosDB::delete($producto,$proveedor);

            if($escorrecto){
                mostrarMensajeExito("Producto eliminado correctamente");
                Error_log("Producto eliminado correctamente");
                echo "<script>window.location.href='../Vista/formPaginaPrincipal.php';</script>";
            }else{
                mostrarMensajeError("Error al eliminar el producto");
                Error_log("Error al eliminar el producto");
            }
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
            Error_log("Error en la linea " . $e->getLine() . " en el archivo " . $e->getFile() . " con el mensaje " . $e->getMessage());
        }
    }

    /**
     * Función para insertar un producto en la base de datos.
     * 
     * @return void
     */
    function insertarProducto(){
        try {
            include_once '../Modelo/Proveedor.php';
            include_once '../Modelo/ProveedorDB.php';
            include_once '../Modelo/Productos.php';
            include_once '../Modelo/ProductosDB.php';
            session_start();

            $codigo = $_POST["codigo"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $stock = $_POST["stock"];

            $proveedor = $_SESSION["proveedor"];


            $producto = new Producto($codigo, $nombre, $descripcion, $precio, $stock, $proveedor);

            $escorrecto = ProductosDB::insert($producto, $proveedor);

            if($escorrecto){
                mostrarMensajeExito("Producto insertado correctamente");
                echo "<script>window.location.href='../Vista/formProductos.php';</script>";
            }else{
                mostrarMensajeError("Error al insertar el producto");
            }
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
            Error_log("Error en la linea " . $e->getLine() . " en el archivo " . $e->getFile() . " con el mensaje " . $e->getMessage());
        }
    }

    /**
     * Carga un producto por su código y proveedor.
     *
     * @return mixed El producto cargado o null si no se encuentra.
     */
    function cargarCodigo(){
        try {
            $codigo = $_POST["codigo"];
            $proveedor = $_SESSION["proveedor"];
            $producto = ProductosDB::getByCodigo($codigo, $proveedor);
            return $producto;
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
            Error_log("Error en la linea " . $e->getLine() . " en el archivo " . $e->getFile() . " con el mensaje " . $e->getMessage());
        }
    }

?>