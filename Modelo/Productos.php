<?php

class Producto {

    // Enumeracion de los tipos de productos
    public const TIPOS = array("Libros", "Cartas", "Mapas", "Figuras", "Otros");

    // Atributos
    private String $Id;
    private String $Nombre;
    private String $Descripcion;
    private float $Precio;
    private int $Stock;
    private Proveedor $Proveedor;


    //  Getters y Setters

    public function getCodigo() : String {
        return $this->Id;
    }

    public function getNombre() : String {
        return $this->Nombre;
    }

    public function setNombre(String $nombre) : void {
        $this->Nombre = $nombre;
    }

    public function getDescripcion() : String {
        return $this->Descripcion;
    }

    public function setDescripcion(String $descripcion) : void {
        $this->Descripcion = $descripcion;
    }

    public function getPrecio() : float {
        return $this->Precio;
    }

    public function setPrecio(float $precio) : void {
        $this->Precio = $precio;
    }

    public function getStock() : int {
        return $this->Stock;
    }

    public function setStock(int $stock) : void {
        $this->Stock = $stock;
    }

    public function getProveedor() : Proveedor {
        return $this->Proveedor;
    }

    public function setProveedor(Proveedor $proveedor) : void {
        $this->Proveedor = $proveedor;
    }




    // Constructor
    public function __construct(String $id, String $nombre, String $descripcion, 
    float $precio, int $stock, Proveedor $proveedor) 
    {
        $this->Id = $id;
        $this->Nombre = $nombre;
        $this->Descripcion = $descripcion;
        $this->Precio = $precio;
        $this->Stock = $stock;
        $this->Proveedor = $proveedor;
    }


    // Métodos

    public function __toString() : String {
        return "ID: " . $this->Id . "<br>" .
        "Nombre: " . $this->Nombre . "<br>" .
        "Descripción: " . $this->Descripcion . "<br>" .
        "Precio: " . $this->Precio . "<br>" .
        "Stock: " . $this->Stock . "<br>" .
        "Proveedor: " . $this->Proveedor . "<br>";
    }


}
    
?>
