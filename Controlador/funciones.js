
    function cerrarSesion() {
        var confirmacion = confirm("¿Estás seguro de que deseas cerrar la sesión?");
        if (confirmacion) {
            // Llamada a la función PHP mediante AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "cerrarSesion.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Redirige a la página de inicio después de cerrar la sesión
                    window.location.href = "../Vista/index.php";
                }
            };
            xhr.send();
        }
    }

