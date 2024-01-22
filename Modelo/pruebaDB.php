<?php

    echo "<h1>Prueba de la base de datos</h1>";
    echo "<br>";


    // Crear Proveedores de prueba
    include_once '../Modelo/Proveedor.php';

    $proveedor = new Proveedor("1", "proveedor1@gmail.com", "contrasenia1", "Proveedor1", "Apellidos1");

    echo "<h1>Proveedor</h1>";
    echo "<br>";
    echo $proveedor;
    echo "<br>";

    $proveedor2 = new Proveedor("2", "proveedor2@gmail.com", "contrasenia2", "Proveedor2", "Apellidos2");

    echo "<h1>Proveedor2</h1>";
    echo "<br>";
    echo $proveedor2;
    echo "<br>";


    // Prueba con los Productos
    include_once '../Modelo/Productos.php';

    $producto = new Producto("1", "Producto1", "Figura Seth el descamado", 1.0, 1, $proveedor);

    $producto2 = new Producto("2", "Producto2", "Libro El terror de Samug", 2.0, 2, $proveedor);

    $producto3 = new Producto("3", "Producto3", "Libro D&D", 3.0, 3, $proveedor);

    $producto4 = new Producto("4", "Producto4", "Mapa mazmorra subterranea", 4.0, 4, $proveedor2);

    $producto5 = new Producto("5", "Producto5", "Mapa ciudad Arthas", 5.0, 5, $proveedor2);

    $producto6 = new Producto("6", "Producto6", "Set inicial D&D", 6.0, 6, $proveedor2);

    echo "<h1>Producto 1</h1>";
    echo "<br>";
    echo $producto;
    echo "<br>";


    // Insertar Proveedores en la base de datos
    include_once '../Modelo/ProveedorDB.php';

    $escorrecto = ProveedorDB::insert($proveedor);

    if($escorrecto){
        echo "Proveedor insertado correctamente";
        echo "<br>";
    }else{
        echo "Error al insertar el proveedor";
        echo "<br>";
    }

    $escorrecto2 = ProveedorDB::insert($proveedor2);

    if($escorrecto2){
        echo "Proveedor2 insertado correctamente";
        echo "<br>";
    }else{
        echo "Error al insertar el proveedor2";
        echo "<br>";
    }




    // Insertar Productos en la base de datos

    include_once '../Modelo/ProductosDB.php';

    $escorrecto3 = ProductosDB::insert($producto, $proveedor);

    if($escorrecto3){
        echo "Producto insertado correctamente";
        echo "<br>";
    }else{
        echo "Error al insertar el producto";
        echo "<br>";
    }

    $escorrecto4 = ProductosDB::insert($producto2, $proveedor);

    if($escorrecto4){
        echo "Producto2 insertado correctamente";
        echo "<br>";
    }else{

        echo "Error al insertar el producto2";
        echo "<br>";
    }

    $escorrecto5 = ProductosDB::insert($producto3, $proveedor);

    if($escorrecto5){
        echo "Producto3 insertado correctamente";
        echo "<br>";
    }else{
        echo "Error al insertar el producto3";
        echo "<br>";
    }

    $escorrecto6 = ProductosDB::insert($producto4, $proveedor2);

    if($escorrecto6){
        echo "Producto4 insertado correctamente";
        echo "<br>";
    }else{
        echo "Error al insertar el producto4";
        echo "<br>";
    }

    $escorrecto7 = ProductosDB::insert($producto5, $proveedor2);

    if($escorrecto7){
        echo "Producto5 insertado correctamente";
        echo "<br>";

    }else{

        echo "Error al insertar el producto5";
        echo "<br>";
    }

    $escorrecto8 = ProductosDB::insert($producto6, $proveedor2);

    if($escorrecto8){
        echo "Producto6 insertado correctamente";
        echo "<br>";
    }else{
        echo "Error al insertar el producto6";
        echo "<br>";
    }


    // Obtener un proveedor sencillo sin productos
    $proveedor3 = ProveedorDB::getProveedor("1");

    echo "<h1>Proveedor Sencillo</h1>";
    echo $proveedor3;

    echo "<br>";

    // Obtener un proveedor completo con sus productos

    $proveedor4 = ProveedorDB::getFull("1");

    echo "<h1>Proveedor Completo</h1>";
    echo $proveedor4;


    echo "<br>";

    // Obtener un producto por descripcion

    include_once '../Modelo/ProductosDB.php';

    $productos = ProductosDB::getDescription("Libro", $proveedor);

    echo "<h1>Productos por descripcion</h1>";

    foreach ($productos as $producto) {
        echo $producto;
        echo "<br>";
    }

    echo "<br>";

    // Obtener por stock

    $productos2 = ProductosDB::getStock(2, $proveedor);

    echo "<h1>Productos por stock</h1>";

    foreach ($productos2 as $producto) {
        echo $producto;
        echo "<br>";
    }

    echo "<br>";

    // Obtener por proveedor

    $productos3 = ProductosDB::getProveedor($proveedor);

    echo "<h1>Productos por proveedor</h1>";

    foreach ($productos3 as $producto) {
        echo $producto;
        echo "<br>";
    }


    echo "<br>";

    // Update de un producto
    
    $producto7 = new Producto("7", "Producto7", "Libro D&D", 7.0, 7, $proveedor);

    $escorrecto9 = ProductosDB::update($producto7, $proveedor);

    if($escorrecto9){
        echo "Producto7 actualizado correctamente";
        echo "<br>";
    }else{
        echo "Error al actualizar el producto7";
        echo "<br>";
    }

    // Delete de un producto

    $escorrecto10 = ProductosDB::delete($producto7, $proveedor);

    if($escorrecto10){
        echo "Producto7 borrado correctamente";
        echo "<br>";

    }else{
        echo "Error al borrar el producto7";
        echo "<br>";
    }





?>