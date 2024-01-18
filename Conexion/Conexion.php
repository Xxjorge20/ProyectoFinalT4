<?php

class Conexion {

    private static $conexion;

    public static function conectarDB(){   
        
        include_once( __DIR__ . '/DatosConexion.php');
        
        try {

            self::$conexion = new PDO(DSN, USER, PASSWORD);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Conectado a la base de datos <br>";

        } catch (PDOException $th) {
            echo "Error al conectar a la base de datos <br>" . $th->getMessage();
        }
        catch (Exception $e) {
            echo "Error <br>" . $e->getMessage();
        }
        
        return self::$conexion;
    }


}

?>