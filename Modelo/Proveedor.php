<?php

    class Proveedor{

        // Atributos
        private int $Codigo;
        private String $Correo;
        private String $Contrasenia;
        private String $Nombre;
        private String $Apellidos;
        private Array $Productos;

        // Constructor
        public function __construct(String $correo, String $contrasenia, String $nombre, String $apellidos){
            $this->Correo = $correo;
            $this->Contrasenia = $contrasenia;
            $this->Nombre = $nombre;
            $this->Apellidos = $apellidos;
            $this->Productos = array();
        }

        // Getters y Setters
        public function getCodigo() : int {
            return $this->Codigo;
        }

        public function setCodigo(int $codigo) : void {
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
            return "Código: " . $this->codigo . "<br>" .
                    "Correo electrónico: " . $this->correo . "<br>" .
                    "Contraseña: " . $this->contrasenia . "<br>" .
                    "Nombre: " . $this->nombre . "<br>" .
                    "Apellidos: " . $this->apellidos . "<br>";
        }


    }



?>