<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <link rel="stylesheet" href="../Estilos/style.css">
    <link rel="icon" type="image/jpg" href="../Estilos/Imagenes/Logo.jpg">
</head>
<body>

        <?php
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache"); 

            /* Bloque de codigo para evitar los warnigs y mandarlos al archivo log*/ 
            error_reporting(E_ALL); // Error/Exception engine, always use E_ALL
            ini_set('ignore_repeated_errors', TRUE); // always use TRUE
            ini_set('display_errors', FALSE); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment
            ini_set('log_errors', TRUE); // Error/Exception file logging engine.
            ini_set('error_log', '../Logs/log.txt'); // Logging file path
        ?>

        <div id = "cabecera">
            <div id = "logo">
                <a href="formPaginaPrincipal.php"><img src="../Estilos/Imagenes/banner.jpg" alt="logo"></a>
            </div>

            <div id = "menu">
                <ul>
                    <li><a href="formProductos.php">Gestionar Productos</a></li>
                    <li><a href="formProveedor.php">Gestionar Proveedor</a></li>
                    <li><a href="index.php">Cerrar Sesion</a></li>
                </ul>
            </div>
        </div>

        <div id = "form">


            <div id="form">
                <?php 
                    include_once '../Controlador/ControladorUsuario.php';
                    session_start();
                    mostrarMensajeBienvenida();
                ?>

                <h1>Gestionar datos - Proveedor</h1>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST">
                    <label for="codigo">Codigo</label>
                    <input type="text" name="codigo" id="codigo" value=<?php echo $_SESSION['proveedorCodigo'] ?> readonly>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value= <?php echo $_SESSION['proveedor']->getCorreo() ?> readonly>
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" value= required  value= <?php echo $_SESSION['proveedor']->getNombre() ?>>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" required  value= <?php echo $_SESSION['proveedor']->getApellidos() ?>>
                    <input type="submit" value="modificar" name="modificarProveedor">
                </form>
            </div>

            <?php
                if(isset($_POST["modificarProveedor"])){
                    include_once '../Controlador/ControladorUsuario.php';
                    modificarProveedor();
                }
            ?>

    </div>


    <footer class="pie">
        <!-- Sección "Dónde estamos" -->
        <div class="footer-section">
            <h4>Dónde estamos</h4>
            <div class="map-widget">
                <p>Dirección: Reino De Luque, S/N</p>
                <p>Ciudad: Luque</p>
                <p>Código Postal: 14880</p>
            </div>
        </div>
        <!-- Sección "Contacto" -->
        <div class="footer-section">
            <h4>Contacto</h4>
            <p>Teléfono: +34 123 456 789</p>
            <p>Email: info@reinodeluque.es</p>
        </div>
    
        <!-- Sección "Redes Sociales" -->
        <div class="footer-section">
            <h4>Redes Sociales</h4>
            <div class="social-icons">
                <a href="https://dnd.wizards.com/es"><img src="../Estilos/RedesSociales/facebook.png" alt="PagOficial" width="40" height="40"></a>
                <a href="https://twitter.com/MultiExt"><img src="../Estilos/RedesSociales/X.png" alt="Twitter" width="40" height="40"></a>
                <a href="https://www.instagram.com/dndwizards/"><img src="../Estilos/RedesSociales/instagram.png" alt="Instagram" width="40" height="40"></a>
                <a href="https://www.youtube.com/@lynxreviewer"><img src="../Estilos/RedesSociales/youtube.png" alt="YouTube" width="40" height="40"></a>
            </div>
        </div>
    
        <!-- Widget de verificación W3C -->
        <div class="footer-section">
            <h4>Verificado por W3C</h4>
            <p>
                <a href="http://jigsaw.w3.org/css-validator/check/referer">
                    <img style="border:0;width:88px;height:31px"
                        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
                        alt="¡CSS Válido!" />
                    </a>
            </p>
        </div>
    </footer>

</body>
</html>