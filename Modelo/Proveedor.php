<?php

    class Proveedor{

        // Atributos
        private String $Codigo;
        private String $Correo;
        private String $Contrasenia;
        private String $Nombre;
        private String $Apellidos;
        private Array $Productos;

        // Constructor
        public function __construct(String $codigo, String $correo, String $contrasenia, String $nombre, String $apellidos){
            
            $this->Codigo = $codigo;
            $this->Correo = $correo;
            $this->Contrasenia = $contrasenia;
            $this->Nombre = $nombre;
            $this->Apellidos = $apellidos;
            $this->Productos = array();
        }

        // Getters y Setters
        public function getCodigo() : String {
            return $this->Codigo;
        }

        public function setCodigo(String $codigo) : void {
            $this->Codigo = $codigo;
        }

        public function getCorreo() : String {
            return $this->Correo;
        }

        public function setCorreo(String $correo) : void {
            $this->Correo = $correo;
        }

        public function getContrasenia() : String {
            return $this->Contrasenia;
        }

        public function setContrasenia(String $contrasenia) : void {
            $this->Contrasenia = $contrasenia;
        }

        public function getNombre() : String {
            return $this->Nombre;
        }

        public function setNombre(String $nombre) : void {
            $this->Nombre = $nombre;
        }

        public function getApellidos() : String {
            return $this->Apellidos;
        }

        public function setApellidos(String $apellidos) : void {
            $this->Apellidos = $apellidos;
        }

        public function getProductos() : Array {
            return $this->Productos;
        }

        public function setProductos(Array $productos) : void {
            $this->Productos = $productos;
        }

        // Métodos

        public function __toString() : String {
            return "Código: " . $this->Codigo . "<br>" .
            "Correo: " . $this->Correo . "<br>" .
            "Contraseña: " . $this->Contrasenia . "<br>" .
            "Nombre: " . $this->Nombre . "<br>" .
            "Apellidos: " . $this->Apellidos . "<br>";
            "Productos: " . $this->Productos . "<br>";
        }


    }



?>