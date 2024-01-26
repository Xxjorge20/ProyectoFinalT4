<?php

    include_once '../Modelo/ProveedorDB.php';
    include_once '../Modelo/Proveedor.php';
    error_reporting(E_ALL); // Error/Exception engine, always use E_ALL
    ini_set('ignore_repeated_errors', TRUE); // always use TRUE
    ini_set('display_errors', FALSE); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment
    ini_set('log_errors', TRUE); // Error/Exception file logging engine.
    ini_set('error_log', '../Logs/log.txt'); // Logging file path
    

    /**
     * Función para iniciar sesión de un proveedor.
     * Obtiene el email y la contraseña del proveedor desde el formulario de inicio de sesión.
     * Llama a la función login de la clase ProveedorDB para verificar las credenciales del proveedor.
     * Si las credenciales son válidas, se establece la sesión del proveedor y se redirige a la página principal.
     * Si ocurre algún error durante el proceso, se muestra un mensaje de error y se registra en el log.
     */
    function logearProveedor(){

      try {

        $email = $_POST["email"];
        $password = $_POST["password"];
        $proveedor = ProveedorDB::login($email, $password);

        if($proveedor != null){

          $_SESSION['proveedorCodigo'] = $proveedor->getCodigo();
          $_SESSION['proveedor'] = $proveedor;
          // mando un mensaje al log
          error_log("El proveedor $proveedor ha iniciado sesión correctamente");
          error_log("El codigo de la sesion es: " . $_SESSION['proveedorCodigo']);
          mostrarMensajeExito("Proveedor logeado correctamente");
          echo "<script>window.location.href='../Vista/formPaginaPrincipal.php';</script>";
          
        }
      } catch (\Throwable $th) {
        echo mostrarMensajeError("Error al iniciar sesión" . $th->getMessage() . "\n");
        error_log("Error al iniciar sesión" . $th->getMessage() . "\n");
      }
    }

    /**
     * Función para registrar un proveedor.
     *
     * Esta función recibe los datos del proveedor a través de un formulario y los utiliza para crear un objeto Proveedor.
     * Luego, utiliza la clase ProveedorDB para insertar el proveedor en la base de datos.
     * Si el registro es exitoso, muestra un mensaje de éxito y redirige al usuario a la página de inicio.
     * Si ocurre algún error durante el registro, muestra un mensaje de error.
     *
     * @return void
     */
    function registrarProveedor(){
      try {
          if(isset($_POST["registrarUsuario"])){

            $codigo = $_POST["codigo"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];

            $proveedor = new Proveedor($codigo, $email, $password, $nombre, $apellidos);

            $escorrecto = ProveedorDB::insert($proveedor);

            if($escorrecto){
                mostrarMensajeExito("Proveedor registrado correctamente");
                echo "<script>window.location.href='../Vista/index.php';</script>";
            }else{
                echo mostrarMensajeError("Error al registrar el proveedor");
            }
        }
      } catch (\Throwable $e) {
          echo mostrarMensajeError("Error al registrar el proveedor" . $e->getMessage());
          error_log("Error al registrar el proveedor" . $e->getMessage());
      }
    }
    
  /**
   * Muestra un mensaje de éxito en forma de div con un ícono y un mensaje.
   *
   * @param string $mensaje El mensaje a mostrar.
   * @return void
   */
  function mostrarMensajeExito($mensaje) {
      echo '
      <div class="success">
      <div class="success__icon">
        <svg
          fill="none"
          height="24"
          viewBox="0 0 24 24"
          width="24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z"
            fill="#393a37"
          ></path>
        </svg>
      </div>
      <div class="success__title">'.$mensaje.'</div>
      <div class="success__close">
        <svg
          height="20"
          viewBox="0 0 20 20"
          width="20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"
            fill="#393a37"
          ></path>
        </svg>
      </div>
    </div>
    <script>
        function cerrarAlerta() {
            var errorAlert = document.querySelector(".error");
            errorAlert.style.animation = "slideOutUp 0.5s ease-in-out";
            setTimeout(function() {
                errorAlert.style.display = "none";
            }, 500);
        }
        // Llamada a cerrarAlerta al hacer clic en el botón de cierre
        document.querySelector(".error__close").addEventListener("click", cerrarAlerta);
        // Llamada a cerrarAlerta después de 5 segundos
        setTimeout(cerrarAlerta, 5000);
    </script>
    ';
  }
    
    /**
     * Muestra un mensaje de error en forma de div con un ícono, título y botón de cierre.
     *
     * @param string $mensaje El mensaje de error a mostrar.
     * @return void
     */
    function mostrarMensajeError($mensaje) {
        echo '
        <div class="error">
        <div class="error__icon">
          <svg
            fill="none"
            height="24"
            viewBox="0 0 24 24"
            width="24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z"
              fill="#393a37"
            ></path>
          </svg>
        </div>
        <div class="error__title">'.$mensaje.'</div>
        <div class="error__close">
          <svg
            height="20"
            viewBox="0 0 20 20"
            width="20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"
              fill="#393a37"
            ></path>
          </svg>
        </div>
      </div>
      <script>
          /**
           * Cierra la alerta de error ocultando el div con una animación de deslizamiento hacia arriba.
           * Luego de 0.5 segundos, el div se oculta completamente.
           *
           * @return void
           */
          function cerrarAlerta() {
              var errorAlert = document.querySelector(".error");
              errorAlert.style.animation = "slideOutUp 0.5s ease-in-out";
              setTimeout(function() {
                  errorAlert.style.display = "none";
              }, 500);
          }
          // Llamada a cerrarAlerta al hacer clic en el botón de cierre
          document.querySelector(".error__close").addEventListener("click", cerrarAlerta);
          // Llamada a cerrarAlerta después de 5 segundos
          setTimeout(cerrarAlerta, 5000);
      </script>
      ';
    }
    
    /**
     * Muestra un mensaje de bienvenida al proveedor actual.
     */
    function mostrarMensajeBienvenida(){

      include_once '../Modelo/Proveedor.php';
      $proveedor = null;
      $proveedor = $_SESSION['proveedor'];
      echo "<h1> Bienvenido " . $proveedor->getNombre() . " " . $proveedor->getApellidos() . "</h1>";
      
    }

    /**
     * Función para modificar un proveedor.
     * 
     * @throws \Throwable Si ocurre un error al modificar el proveedor.
     */
    function modificarProveedor(){
      try {
                
        include_once '../Modelo/Proveedor.php';
        include_once '../Modelo/ProveedorDB.php';
        include_once '../Modelo/Productos.php';
        include_once '../Modelo/ProductosDB.php';
        if(isset($_POST["modificarProveedor"])){

            $codigo = $_POST["codigo"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];

            $proveedor = new Proveedor($codigo, $email, $password, $nombre, $apellidos);
            $productos = ProductosDB::getProveedor($proveedor);

            $proveedor->setProductos($productos);

            $escorrecto = ProveedorDB::update($proveedor);

            $_SESSION['proveedor'] = $proveedor;

            if($escorrecto){
                mostrarMensajeExito("Proveedor modificado correctamente");
                echo "<script>window.location.href='../Vista/formPaginaPrincipal.php';</script>";
            }else{
                echo mostrarMensajeError("Error al modificar el proveedor");
            }
        }
      } catch (\Throwable $e) {
          echo mostrarMensajeError("Error al modificar el proveedor" . $e->getMessage());
          error_log("Error al modificar el proveedor" . $e->getMessage());
      }
    }
    
?>


