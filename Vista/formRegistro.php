<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Registro</title>
    <link rel="stylesheet" href="../Estilos/style.css">
    <link rel="icon" type="image/jpg" href="../Estilos/Imagenes/Logo.jpg">
</head>
<body>
        <div id = "cabecera">
            <div id = "logo">
                <a href="index.php"><img src="../Estilos/Imagenes/banner.jpg" alt="logo"></a>
            </div>

            <div id = "menu">
                <ul>
                    <li><a href="formRegistro.php">Registrar Usuario</a></li>
                    <li><a href="index.php">Iniciar Sesion</a></li>
                </ul>
            </div>
        </div>

        <div id = "form">
        <h1>Gestion Usuario - Registrar Usuario</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
            <br>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" required>
            <br>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <br>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>   
            <br>
            <input type="submit" value="registrar Usuario" name="registrarUsuario">
            
        </form>

        <form>
            <input type="submit" value="Iniciar Sesion" name="iniciarSesion">
        </form>

    </div>
    

    <div id="respuesta">
        <?php
            include_once '../Controlador/ControladorUsuario.php';

            if(isset($_POST['registrarUsuario'])){

                $escorrecto = registrarUsuario();
                if($escorrecto){
                    // Informamos al usuario de que se ha registrado correctamente
                    echo "<script>alert('Usuario logeado correctamente');</script>";
                    // Redirigimos al usuario a la página de login
                    echo "<script>window.location.href='../Vista/formMostrarTodos.php';</script>";                 
                }else{
                    echo "<h1>Usuario no Logeado Correctamente</h1>";
                }
            }

            if(isset($_POST['iniciarSesion'])){
                // Redirigimos al usuario a la página de registro
                echo "<script>window.location.href='../Vista/index.php';</script>";
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